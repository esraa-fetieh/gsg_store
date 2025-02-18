@extends('layouts.admin')
@section('title','Edit category')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Categories</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
@endsection
@section('content')
<form action="{{route('categories.update',$category->id)}}" method="post" >
   @method('put')
   @csrf
   @include('admin.categories._form',[
             'button'=>'Update'

    ])
</form>
@endsection

