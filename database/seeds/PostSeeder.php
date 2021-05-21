<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str; //necessario per lo slug
use Illuminate\Support\Facades\Auth;

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
            $new_post->content = $faker->text();
            
            // genero lo slug
            $slug = Str::slug($new_post->title, '-');
            $slug_base = $slug;

            //verifico che lo slug non sia già presente nel db
            $slug_present = Post::where('slug', $slug)->first();
            $counter = 1;

            //ciclo fino a quando slug_present diventa true
            while($slug_present) {
                $slug = $slug_base.'-'.$counter;
                $counter++; 
                $slug_present = Post::where('slug', $slug)->first();
            }

            $new_post->slug = $slug;

            //perchè ho solo 1 utente
            $new_post->user_id = 1;

            $new_post->save();
        }
    }
}
