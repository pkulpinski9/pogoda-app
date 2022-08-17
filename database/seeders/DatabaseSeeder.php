<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
             'name' => 'admin',
             'password' => '$2y$10$3LFXc/naw.siIm/h4QIIN.M2eKV01WMIdgtb855suV2AAEG0Xa3Am', //adminadmin
             'email' => 'admin@email.com',
         ]);
        \App\Models\User::factory()->create([
            'name' => 'admin2',
            'password' => '$2y$10$D4wiShBvp9sU1t1ayHJGTON7XA/HVqVU/WF56td235LyUSyXa1qdy', //adminadmin2
            'email' => 'admin2@email.com',
        ]);
    }
}
