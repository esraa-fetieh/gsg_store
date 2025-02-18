<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    const STATUS_ACTIVE='active';
    const STATUS_DRAFT='draft';

    protected $fillable=[
        'name','slug','description','image_path','price','sale_price','quantity','weight','width','height',
        'length','status','category_id',
    ];

    public static  function validateRules()
    {
        return[
            'name'=>'required|max:255',
            'category_id'=>'required|int|exists:categories,id',
            'description'=>'nullable',
            'image'=>'nullable|image|dimensions:min_width=300,min_hieght=300',
            'price'=>'nullable|numeric|min:0',
            'sale_price'=>'nullable|numeric|min:0',
            'quantity'=>'nullable|int|min:0',
            'sku'=>'nullable|unique:products,sku',
            'width'=>'nullable|numeric|min:0',
            'height'=>'nullable|numeric|min:0',
            'weight'=>'nullable|numeric|min:0',
            'status'=>'in:' . self::STATUS_ACTIVE. ',' . self::STATUS_DRAFT ,

        ];

    }
}
