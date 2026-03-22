<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bazar;
use App\Models\Meal;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    private function mealCount($meal)
    {
        $count = 0;

        if ($meal->breakfast) $count += 0.5;
        if ($meal->lunch)     $count += 1;
        if ($meal->dinner)    $count += 1;

        return $count;
    }

    public function index()
    {
        $user = Auth::user();
        $today = now()->toDateString();


        // Meals
        $myMeals = Meal::where('user_id', $user->id)->get();
        $todayMeal = Meal::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();


        $myWeekMeals = Meal::where('user_id', $user->id)
            ->whereBetween('date', [
                now()->subDays(6)->toDateString(),  // 6 days before today
                now()->toDateString()               // today
            ])
            ->get();


        // Payments
        $myPayments = Payment::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        $total_paid_from_payments = $myPayments->sum('amount');

        // Calculate user’s total meal
        $total_meal = $myMeals->sum(fn($m) => $this->mealCount($m));

        $total_week_meal = $myWeekMeals->sum(fn($m) => $this->mealCount($m));

       
        // Total meals of the floor
        $floor_users = User::where('meal_floor', $user->meal_floor)->pluck('id');

        $allMeals = Meal::whereIn('user_id', $floor_users)->with('user')->get();

        $current_total_meal = $allMeals->sum(fn($m) => $this->mealCount($m));

        // Total bazar
        $total_cost = Bazar::sum('cost');

        // Cost per meal
        $cost_per_meal = $current_total_meal > 0
            ? round($total_cost / $current_total_meal, 2)
            : 0;

        // User’s due
        $amount_due = round(($total_meal * $cost_per_meal) - $total_paid_from_payments, 2);

        return view('user.dashboard', [
            'total_meal'      => round($total_meal, 1),
            'total_week_meal' => round($total_week_meal, 1),
            'meal_breakfast'  => $todayMeal->breakfast ?? false,
            'meal_lunch'      => $todayMeal->lunch ?? false,
            'meal_dinner'     => $todayMeal->dinner ?? false,
            'todayMeal'       => $todayMeal,
            'cost_per_meal'   => $cost_per_meal,
            'amount_due'      => $amount_due,
            'myPayments'      => $myPayments,
            'payment_stats'   => [
                'total_paid' => $total_paid_from_payments,
                'last_payment' => $myPayments->first(),
                'payment_count' => $myPayments->count(),
                'average_payment' => $myPayments->count() > 0
                    ? round($total_paid_from_payments / $myPayments->count(), 2)
                    : 0,
            ],
            'meal_floor' => $user->meal_floor ?? 1,
        ]);
    }


    public function saveMeal(Request $request)
    {
        $user = Auth::user();
        $now = now();
        $today = $now->toDateString();

        $meal = Meal::firstOrNew([
            'user_id' => $user->id,
            'date'    => $today,
        ]);

        // Correct cutoff times using app timezone
        $breakfastCutoff = now()->setTime(6, 0);
        $lunchCutoff     = now()->setTime(11, 30);
        $dinnerCutoff    = now()->setTime(17, 0);

        $breakfast = $request->boolean('breakfast');
        $lunch     = $request->boolean('lunch');
        $dinner    = $request->boolean('dinner');

        if ($breakfast != $meal->breakfast && $now->gte($breakfastCutoff)) {
            return back()->with('error', 'Breakfast booking time is over!');
        }
        if ($lunch != $meal->lunch && $now->gte($lunchCutoff)) {
            return back()->with('error', 'Lunch booking time is over!');
        }
        if ($dinner != $meal->dinner && $now->gte($dinnerCutoff)) {
            return back()->with('error', 'Dinner booking time is over!');
        }

        $meal->breakfast = $breakfast;
        $meal->lunch     = $lunch;
        $meal->dinner    = $dinner;
        $meal->save();

        return back()->with('success', 'Meals saved successfully!');
    }


    public function saveMealOff(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'meals'      => 'required|array|min:1',
            'meals.*'    => 'in:breakfast,lunch,dinner',
            'reason'     => 'nullable|string|max:500',
        ]);

        $period = CarbonPeriod::create($validated['start_date'], $validated['end_date']);

        foreach ($period as $date) {

            $meal = Meal::firstOrNew([
                'user_id' => $user->id,
                'date'    => $date->format('Y-m-d'),
            ]);

            // Turn OFF only the selected meals — do not turn ON others
            foreach (['breakfast', 'lunch', 'dinner'] as $type) {
                if (in_array($type, $validated['meals'])) {
                    $meal->$type = false;
                }
            }

            $meal->save();
        }

        return back()->with('success', 'Meal off request processed.');
    }


    public function paymentHistory()
    {
        $user = Auth::user();

        $payments = Payment::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('user.payment-history', [
            'payments'   => $payments,
            'total_paid' => $payments->sum('amount'),
        ]);
    }


    public function paymentDetails($id)
    {
        $user = Auth::user();

        $payment = Payment::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('user.payment-details', compact('payment'));
    }
}
