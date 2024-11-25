<?php

namespace Database\Seeders;
 use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //orm
        Category::create([
            'name'=>'Category Model',
            'slug'=>'category-model',
            'status'=>'draft',
        ]);




        //query builder
       /* \DB::table('categories')->insert([
            'name'=>'My First Category',
            'slug'=>'my-first-category',
            'status'=>'active',
        ]);
        \DB::table('categories')->insert([
            'name'=>'Sub Category',
            'slug'=>'sub-category',
            'parent_id'=>1,
            'description'=>'active',
        ]);*/
    }
}
