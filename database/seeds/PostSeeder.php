<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str; //necessario per lo slug

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i<10; $i++) {
            $new_post = new Post();

            $new_post->title = $faker->sentence(rand(1,5));
            $new_post->message = $faker->text();
            
            $new_post->slug = Str::slug($new_post->title, '-');

            $new_post->save();
        }
    }
}
