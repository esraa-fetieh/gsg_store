<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category= Category::inRandomOrder()->limit(1)->first(['id']);
      $name=$this->faker->words(2,true);
      $status=['active','draft'];
        return [
            'name'=>$name,
            'slug'=>str::slug($name),
            'category_id'=>$category? $category->id:null,
            'description'=>$this->faker->words(20,true),
            'image_path'=>$this->faker->imageUrl,
            'status'=>$status[rand(0,1)],
            'price'=>$this->faker->randomFloat(2,50,2000),
            'quantity'=>$this->faker->randomFloat(0,0,30),
        ];
    }
}
