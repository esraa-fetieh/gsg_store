<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product= Product::join('categories','categories.id','=','products.category_id')
        ->select([
            'products.*',
            'categories.name as category_name'
        ])
        ->paginate();
        $success=session()->get('success');
        return view('admin.products.index',[
            'products'=>$product,
            'success'=>$success,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.products.create',[
            'categories'=>$categories,
            'product'=>new Product(),
        ]
    );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Product::validateRules());
        $request->merge([
            'slug'=>Str::slug($request->post('name')),
        ]);
        $product=Product::create($request->all());
        return redirect()->route('products.index')
          ->with('success',"product ($product->name) created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::findOrFail($id);
        return view('admin.products.show',[
            'product'=>$product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::findOrFail($id);
        return view('admin.products.edit',[
            'product'=>$product,
            'categories'=> Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::findorFail($id);
        $request->validate(Product::validateRules());
        if($request->hasFile('image')){
            $file=$request->file('image');//uploaded file object
            //$file->getClientOriginalName();// return file name
            //$file->getClientOriginalExtension();
            //$file->getClientMimeType();//audio/mp3 or image/jpg
            //$file->getType();
            //$file->getSize();

            //filesystem - Disks
            //local:storage/app
            //public:storage/app/public
            //s3:amazon Drive
            //custom: defined by us
            $image_path=$file->store('uploads',[
                'disk'=>'public',
            ]);
            $request->merge([
                'image_path'=>$image_path

            ]);




        }
        $product->update($request->all());
        return redirect()->route('products.index')
          ->with('success',"product ($product->name) updated.");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findorFail($id);
        $product->delete();
        Storage::delete($product->image_path);
        return redirect()->route('products.index')
        ->with('success',"product ($product->name) deleted.");

    }
}
