@extends('layouts.admin')
@section('title')<h2> products <a href="{{route('products.create')}}">Create</a></h2>@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
@endsection
@section('content')
   @if($success)
     <div>
        {{$success}}
     </div>
   @endif

    <table class="table">
     <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Qty.</th>
        <th scope="col">Status</th>
       <th scope="col">Created At</th>
       <th scope="col">Edit</th>
       <th scope="col">Delete</th>
      </tr>
     </thead>
     <tbody>
    @foreach($products as $product)
      <tr>
        <td><img src="{{asset('storage/'. $product->image_path)}}" width="60"></img></td>
        <td>{{$product->name}}</td>
        <td>{{$product->category_name}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->status}}</td>
        <td>{{$product->created_at}}</td>
        <td><a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-dark">Edit</a></td>
        <td><form action="{{route('products.destroy',$product->id)}}" method="post" >
               @method('Delete')
               @csrf
               <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>

      </tr>
    @endforeach

    </tbody>
   </table>
   {{$products->links()}}
@endsection

