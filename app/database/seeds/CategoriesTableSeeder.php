<?php

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        $categories = array(
        	['title' => 'Tech'],
        	['title' => 'Food'],
        	['title' => 'New'],
        	['title' => 'HTML'],
        	['title' => 'CSS'],
        	['title' => 'laravel']
        );

        // Uncomment the below to run the seeder
        DB::table('categories')->insert($categories);
    }

}