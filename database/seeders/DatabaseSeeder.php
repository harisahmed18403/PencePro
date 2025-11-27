<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lick;
use App\Models\Spit;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Lick::factory(2000)->create(['user_id' => $user->id])->each(function ($lick) {
            if (rand(0, 1)) {
                $spitRevenue = rand($lick->cost - 100 > 0 ? $lick->cost - 100 : 0, $lick->cost + 500);
                Spit::create([
                    'lick_id' => $lick->id,
                    'revenue' => $spitRevenue,
                    'date' => $lick->date
                ]);

                $lick->update(['profit' => $lick->profit + $spitRevenue]);
            }
        });
    }
}
