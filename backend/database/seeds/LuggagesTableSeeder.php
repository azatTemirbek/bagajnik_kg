<?php

use Illuminate\Database\Seeder;

class LuggagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Luggage::class,50)->create();
    }
}
