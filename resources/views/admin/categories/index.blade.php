@extends('layouts.admin')
@section('title')<h2>{{$title}} <a href="{{route('categories.create')}}">Create</a></h2>@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Slug</th>
        <th scope="col">Parent ID</th>
        <th scope="col">Status</th>
       <th scope="col">Created At</th>
       <th scope="col">Edit</th>
       <th scope="col">Delete</th>
      </tr>
     </thead>
     <tbody>
    @foreach($categories as $category)
      <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->slug}}</td>
        <td>{{$category->parent_id}}</td>
        <td>{{$category->status}}</td>
        <td>{{$category->created_at}}</td>
        <td><a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-dark">Edit</a></td>
        <td><form action="{{route('categories.destroy',$category->id)}}" method="post" >
               @method('Delete')
               @csrf
               <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>

      </tr>
    @endforeach

    </tbody>
   </table>
@endsection

