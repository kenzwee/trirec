<?php

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
        $this->call([
        users_table_seeder::class,
        profiles_table_seeder::class,
        posts_table_seeder::class
        ]);
    }
    

}
