<?php

class PostsTableSeeder extends Seeder {

    public function run()
    {
        $posts = array(
        	['title' => 'This is my first post', 'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam, ipsam, nihil eius impedit labore accusantium deleniti aperiam. Necessitatibus, magnam, excepturi.'],
    		['title' => 'And the second post', 'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam, ipsam, nihil eius impedit labore accusantium deleniti aperiam. Necessitatibus, magnam, excepturi.']
        );

        // Uncomment the below to run the seeder
        DB::table('posts')->insert($posts);
    }

}