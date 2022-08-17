<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        $user = User::factory()->create( [
            'name' => 'Jewel Hasan',
            'email' => 'jewelhasan47@yahoo.com',
            "password" => bcrypt('123123')
        ] );

        Listing::factory( 6 )->create( [
            'user_id' => $user->id,
        ] );


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
