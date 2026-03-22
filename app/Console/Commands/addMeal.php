<?php

namespace App\Console\Commands;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Console\Command;

class AddMeal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:meal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a meal record for all users on floor 3 if not already created today';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $today = today();

        foreach ($users as $user) {
            $meal = Meal::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'date' => $today,
                ],
                [
                    'breakfast' => true,
                    'lunch' => true,
                    'dinner' => true,
                ]
            );

            $this->info("Meal added for user: {$user->name}");
        }

        $this->info('✅ All meals processed successfully.');
    }
}
