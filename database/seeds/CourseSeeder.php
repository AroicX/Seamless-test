<?php

use App\Course;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Course');
    	for ($i=0; $i <= 20 ; $i++) { 

    		DB::table('courses')->insert([
                'title' => $faker->name,
    			'code' => $faker->imageUrl($width = 500, $height = 500),
    			'unit' => $faker->paragraph(1),

    		]);
    	}
    }
}

