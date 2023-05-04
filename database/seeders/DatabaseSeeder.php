<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\JobTitle;
use App\Models\Location;
use App\Models\Salary;
use App\Models\Employment_type;
use App\Models\Dataset;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $dataset = Dataset::create([
            "data_set_name" => "data_set_name",
            "data_set_url" => "data_set_url",
        ]);

        JobTitle::create([
            "title" => "title",
            "dataset_id" => $dataset -> id
        ]);

        Location::create([
            "location" => "location"
        ]);

        Salary::create([
            "salary" => "salary"
        ]);

        Employment_type::create([
            "type" => "Type"
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
