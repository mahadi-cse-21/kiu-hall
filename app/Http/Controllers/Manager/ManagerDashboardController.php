<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Bazar;
use App\Models\GuestMeal;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Meal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
{

  public function index()
    {
        $manager = Auth::user();
        $floor = $manager->meal_floor; // Manager's floor
        $today = now()->format('Y-m-d');

        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Total payment by floor users
        $store_payment = Payment::whereHas('user', fn($q) => $q->where('meal_floor', $floor))
            ->sum('amount');

        // Total bazar cost for this floor
        $bazar_total_cost = Bazar::where('bazar_floor', $floor)->sum('cost');

        // Get all active users on manager's floor
        $users = User::where('status', 'active')
            ->where('meal_floor', $floor)
            ->get();

        // Get all payments for floor users
        $payments = Payment::whereHas('user', fn($q) => $q->where('meal_floor', $floor))
            ->with('user')
            ->get();

        // Today's meals count (weighted: breakfast 0.5, lunch 1, dinner 1)
        $todayMealsCount = Meal::whereDate('date', $today)
            ->whereHas('user', fn($q) => $q->where('meal_floor', $floor))
            ->selectRaw(
                'SUM(
                    CASE WHEN breakfast = 1 THEN 0.5 ELSE 0 END +
                    CASE WHEN lunch = 1 THEN 1 ELSE 0 END +
                    CASE WHEN dinner = 1 THEN 1 ELSE 0 END
                ) as total_meals'
            )
            ->value('total_meals') ?? 0;

        // Get all meals for the current month (floor users only)
        $meals = Meal::with('user')
            ->whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->whereHas('user', fn($q) => $q->where('meal_floor', $floor))
            ->get();

        // Meals for today
        $todayMeals = Meal::with('user')
            ->whereDate('date', $today)
            ->whereHas('user', fn($q) => $q->where('meal_floor', $floor))
            ->get();

      
        // Meal stats for today
        $today_breakfast = $todayMeals->where('breakfast', true)->count();
        $today_lunch = $todayMeals->where('lunch', true)->count();
        $today_dinner = $todayMeals->where('dinner', true)->count();

        $mealStats = [
            'breakfast' => $today_breakfast,
            'lunch' => $today_lunch,
            'dinner' => $today_dinner,
        ];

        // Total payment for current month
        $totalPayment = Payment::whereHas('user', fn($q) => $q->where('meal_floor', $floor))
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->sum('amount') ?? 0;

        return view('manager.dashboard', compact(
            'users',
            'payments',
            'todayMealsCount',
            'totalPayment',
            'store_payment',
            'meals',
            'bazar_total_cost',
            'mealStats',
            'today_breakfast',
            'today_lunch',
            'today_dinner',
            'today'
        ));
    }

    public function addPayment(Request $request)
    {
        $manager = Auth::user();
        $floorUsers = User::where('meal_floor', $manager->meal_floor)->pluck('id');

        $request->validate([
            'user_id' => 'required|in:' . implode(',', $floorUsers->toArray()),
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'notes' => 'nullable|string|max:500'
        ]);

        Payment::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'notes' => $request->notes
        ]);

        return redirect()->back()->with('success', 'Payment added successfully!');
    }

    public function updateMealStatus(Request $request)
    {
        $manager = Auth::user();
        $floorUsers = User::where('meal_floor', $manager->meal_floor)->pluck('id');

        $request->validate([
            'user_id' => 'required|in:' . implode(',', $floorUsers->toArray()),
            'meal_type' => 'required|in:breakfast,lunch,dinner',
            'status' => 'required|boolean',
            'date' => 'required|date',
        ]);

        $meal = Meal::firstOrCreate(
            ['user_id' => $request->user_id, 'date' => $request->date]
        );

        $meal->{$request->meal_type} = $request->status;
        $meal->save();

        return response()->json(['success' => true]);
    }

    public function updatemeal(Request $request)
    {
        $manager = Auth::user();
        $floorUsers = User::where('meal_floor', $manager->meal_floor)->pluck('id');

        $validated = $request->validate([
            'meals' => 'required|array',
        ]);

        $updatedCount = 0;
        $createdCount = 0;
        $unchangedCount = 0;

        $userIds = [];
        $dates = [];

        foreach ($validated['meals'] as $userId => $userDates) {
            if (!in_array($userId, $floorUsers->toArray())) continue;
            $userIds[] = $userId;
            foreach ($userDates as $date => $mealData) {
                if (is_array($mealData) && isset($mealData['date'])) {
                    $dates[] = $mealData['date'];
                }
            }
        }

        $existingMeals = Meal::whereIn('user_id', array_unique($userIds))
            ->whereIn('date', array_unique($dates))
            ->get()
            ->keyBy(fn($meal) => $meal->user_id . '_' . $meal->date->format('Y-m-d'));

        foreach ($validated['meals'] as $userId => $userDates) {
            if (!in_array($userId, $floorUsers->toArray())) continue;

            foreach ($userDates as $date => $mealData) {
                if (!is_array($mealData)) continue;

                $actualDate = $mealData['date'] ?? $date;
                $actualUserId = $mealData['user_id'] ?? $userId;

                $newBreakfast = isset($mealData['breakfast']) && $mealData['breakfast'] == '1';
                $newLunch = isset($mealData['lunch']) && $mealData['lunch'] == '1';
                $newDinner = isset($mealData['dinner']) && $mealData['dinner'] == '1';

                $mealKey = $actualUserId . '_' . $actualDate;

                if (isset($existingMeals[$mealKey])) {
                    $existingMeal = $existingMeals[$mealKey];

                    $hasChanges = $existingMeal->breakfast != $newBreakfast ||
                        $existingMeal->lunch != $newLunch ||
                        $existingMeal->dinner != $newDinner;

                    if ($hasChanges) {
                        $existingMeal->update([
                            'breakfast' => $newBreakfast,
                            'lunch' => $newLunch,
                            'dinner' => $newDinner,
                        ]);
                        $updatedCount++;
                    } else {
                        $unchangedCount++;
                    }
                } else {
                    if ($newBreakfast || $newLunch || $newDinner) {
                        Meal::create([
                            'user_id' => $actualUserId,
                            'date' => $actualDate,
                            'breakfast' => $newBreakfast,
                            'lunch' => $newLunch,
                            'dinner' => $newDinner,
                        ]);
                        $createdCount++;
                    }
                }
            }
        }

        $message = "Meal update completed! Created: {$createdCount}, Updated: {$updatedCount}, Unchanged: {$unchangedCount}";

        return redirect()->back()->with('success', $message);
    }

    public function addbazar(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'names' => 'nullable|string|max:255',
        ]);

        Bazar::updateOrCreate(
            ['date' => $validated['date'], 'bazar_floor' => Auth::user()->meal_floor],
            [
                'description' => $validated['description'],
                'cost' => $validated['amount'],
                'names' => $validated['names'],
            ]
        );

        return redirect()->back()->with('success', 'Bazar record added successfully!');
    }

    public function guestmeal(Request $request)
    {
        $manager = Auth::user();
        $floorUsers = User::where('meal_floor', $manager->meal_floor)->pluck('id');

        $validated = $request->validate([
            'user_id' => 'required|in:' . implode(',', $floorUsers->toArray()),
            'number_of_guest_meal' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        GuestMeal::updateOrCreate(
            [
                'user_id' => $validated['user_id'],
                'date' => $validated['date'],
            ],
            [
                'number_of_guest_meal' => (float) $validated['number_of_guest_meal'],
            ]
        );

        return redirect()->back()->with('success', 'Guest meal saved successfully!');
    }

    public function payment()
    {
        $floor = Auth::user()->meal_floor;
        // Get all active users on manager's floor
        $users = User::where('status', 'active')
            ->where('meal_floor', $floor)
            ->get();

        // Get all payments for floor users
        $payments = Payment::whereHas('user', fn($q) => $q->where('meal_floor', $floor))
            ->with('user')
            ->get();
        return view('manager.payment',compact('users','payments'));
    }

    public function meals()
    {
        $floor = Auth::user()->meal_floor;
         $currentMonth = now()->month;
        $currentYear = now()->year;
        
        // Get all active users on manager's floor
        $users = User::where('status', 'active')
            ->where('meal_floor', $floor)
            ->get();
        $meals = Meal::with('user')
            ->whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->whereHas('user', fn($q) => $q->where('meal_floor', $floor))
            ->get();
        
        return view('manager.meal',compact('floor','users','meals'));
    }

    public function bazars()
    {
          $floor = Auth::user()->meal_floor;
         $users = User::where('status', 'active')
            ->where('meal_floor', $floor)
            ->get();
        return view('manager.bazars',compact('users'));
    }

    public function guest()
    {
        $floor = Auth::user()->meal_floor;
         $users = User::where('status', 'active')
            ->where('meal_floor', $floor)
            ->get();
        return view('manager.guest',compact('users'));
    }
}
