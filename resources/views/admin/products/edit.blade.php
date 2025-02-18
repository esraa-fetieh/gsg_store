@extends('layouts.admin')
@section('title','Edit product')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Products</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
@endsection
@section('content')
<form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data" >
   @method('put')
   @csrf
   @include('admin.products._form',[
             'button'=>'Update'

    ])
</form>
@endsection

