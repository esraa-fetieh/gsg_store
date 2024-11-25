<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\str;
use DB;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      $category= DB::table('categories')->inRandomOrder()->limit(1)->first(['id']);
      $name=$this->faker->words(2,true);
      $status=['active','draft'];
        return [
            'name'=>$name,
            'slug'=>str::slug($name),
            'parent_id'=>$category? $category->id:null,
            'description'=>$this->faker->words(20,true),
            'image_path'=>$this->faker->imageUrl,
            'status'=>$status[rand(0,1)],
            //
        ];
    }
}
