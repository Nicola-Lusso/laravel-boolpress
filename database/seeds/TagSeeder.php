<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Tag;
use App\Post;

class TagSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) { 
            $newTag = new Tag();
            $name = $faker->sentence(1);

            while (Tag::where('name', $name)->first()) {
                $name = $faker->sentence(1);
            }

            $newTag->name = $name;
            $newTag->slug = Str::slug($newTag->name);
            $newTag->save();
        }
    }
}