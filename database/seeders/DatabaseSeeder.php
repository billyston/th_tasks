<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table( 'users' ) -> insert(
        [
            'resource_id' => generateAlphaNumericResource(15),
            'name' => 'Michael',
            'email' => 'michael@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

            "created_at"                => date("Y-m-d H:i:s"),
            "updated_at"                => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'projects' ) -> insert(
        [
            'resource_id' => generateAlphaNumericResource(15),

            'name' => 'Task Hub',
            'description' => 'Some description goes here...',

            "created_at"                => date("Y-m-d H:i:s"),
            "updated_at"                => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'statuses' ) -> insert(
        [
            'resource_id' => generateAlphaNumericResource(15),

            'name' => 'To Do',
            'description' => 'Some description goes here...',

            'project_id' => 1,

            "created_at"                => date("Y-m-d H:i:s"),
            "updated_at"                => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'priorities' ) -> insert
        (
            array
            (
                0 =>
                array
                (
                    'resource_id' => generateAlphaNumericResource( 8 ),
                    'name' => 'Urgent',
                    'color' => 'red',

                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                ),
                1 =>
                array
                (
                    'resource_id' => generateAlphaNumericResource( 8 ),
                    'name' => 'High',
                    'color' => 'yellow',

                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                ),
                2 =>
                array
                (
                    'resource_id' => generateAlphaNumericResource( 8 ),
                    'name' => 'Normal',
                    'color' => 'blue',

                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                ),
                3 =>
                array
                (
                    'resource_id' => generateAlphaNumericResource( 8 ),
                    'name' => 'Low',
                    'color' => 'gray',

                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                ),
            )
        );
        DB::table( 'tasks' ) -> insert(
        [
            'resource_id' => generateAlphaNumericResource(15),
            'priority_id' => 2,
            'status_id' => 1,
            'user_id' => 1,

            'name' => 'Create the API project',

            "start_date" => date("Y-m-d"),
            "due_date" => date("Y-m-d"),

            "created_at"                => date("Y-m-d H:i:s"),
            "updated_at"                => date("Y-m-d H:i:s"),
        ]);
    }
}
