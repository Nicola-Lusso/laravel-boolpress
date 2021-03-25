<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Post;
use App\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for($i = 0; $i <10; $i++) {
          $newPost = new Post();
          $newPost->user_id = 1;
        //   $newPost->title = $faker->sentence(4);
          $newPost->content = $faker->text(100);

          $users = User::all()->toArray();

          $newPost->user_id = $users[rand(0, Count($users)-1)]["id"];

          $slug = Str::slug($newPost->title);
          $post = POST::where("slug", $slug)->first();
          $contatore = 1; 

          while($post) {
            $slug = $slug . "-" . $contatore;
            $post = POST::where("slug", $slug)->first();
            $contatore++;
          }

          $newPost->slug = $slug;

          $newPost->save();
        }
    }
}