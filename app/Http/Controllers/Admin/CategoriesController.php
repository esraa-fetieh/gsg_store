<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\support\str;
use App\Http\Requests\CategoryRequest;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //return collection of category model object
        $entries=Category::all();
        $success=session()->get('success');
        //session()->forget('success');
        return view('admin.categories.index',[
            'categories'=>$entries,
            'title'=>'categories list',
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
        //
        $parents=Category::all();
        $category=new Category();
        return view('admin.categories.create',compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // $rules=[
        //     'name'=>'required|string|max:255|min:5|unique:categories,name',
        //     'parent_id'=>'nullable|int|exists:categories,id',
        //     'description'=>'nullable|min:5',
        //     'status'=>'required|in:active,draft',
        //     'image'=>'image|max:512000|dimensions:min_width=300,min_height=300'

        // ];
      //1
    //   $clean= $request->validate($rules);
      //2
      //$clean=$this->validate($request,$rules);

        //
        $request->merge([
            'slug'=> Str::slug($clean['name']),
            'status'=>'active',
        ]);
        $category=Category::create($request->all());
        //return redirect()->route('categories.index');
        return to_route('categories.index')->with('success','category created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category=Category::find($id);
        $parents=Category::where('id','<>',$category->id)->get();
        return view('admin.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

    //     $rules=[
    //         'name'=>'required|string|max:255|min:5',
    //         'parent_id'=>'nullable|int|exists:categories,id',
    //         'description'=>'nullable|min:5',
    //         'status'=>'required|in:active,draft',
    //         'image'=>'image|max:512000|dimensions:min_width=300,min_height=300'

    //     ];
    //   //1
    //   $clean= $request->validate($rules,[
    //     'name.require'=>'هذاالحقل مطلوب',
    //   ]);
        //Category::where('id','=',$id)->update($request->all())

        $category=Category::find($id);
        //
        /*$category->name=$request->post('name');
        $category->parent_id=$request->post('parent_id');
        $category->description=$request->post('description');
        $category->status=$request->post('status');
        $category->save(); */
        //$category->fill($request->all())->save();
        $category->update($request->all());

        return redirect(route('categories.index'))->with('success','category updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        //session()->put('success','category deleted');
        session()->flash('success','category deleted');
        //
        return redirect(route('categories.index'));
    }
}
