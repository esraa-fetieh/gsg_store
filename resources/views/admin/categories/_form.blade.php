
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $message)
        <li>{{$message}}</li>
        @endforeach

    </ul>

</div>

@endif
<div class="form-group">
     <label for="">Category Name</label>
     <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name' ,$category->name)}}" >
     @error('name')
      <p class="invalid-feedback">{{$message}}</p>
     @enderror
  </div>
  <div class="form-group">
     <label for="">Parent</label>
     <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
        <option value="">No Parent</option>
        @foreach($parents as $parent)
          <option value="{{old('parent_id' ,$category->paren_id)}}" @if($parent->id == $category->parent_id) selected @endif >{{$parent->name}}</option>
        @endforeach
     </select>
     @error('parent_id')
      <p class="invalid-feedback">{{$message}}</p>
     @enderror
  </div>
  <div class="form-group">
     <label for="">Description</label>
     <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{old('description' ,$category->descreption)}}</textarea>
     @error('description')
      <p class="invalid-feedback">{{$message}}</p>
     @enderror
  </div>
  <div class="form-group">
     <label for="">Image</label>
     <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
     @error('image')
      <p class="invalid-feedback">{{$message}}</p>
     @enderror
  </div>
  <div class="form-group">
     <label for="">status</label>
     <div class="form-check" >
       <input type="radio" class="form-check-input" name="status" id="status-active" value="active" @if(old('status' , $category->status)=='active') checked @endif>
       <label class="form-check-label" for="status-active">
        Active
       </label>
     </div>
     <div class="form-check" >
       <input type="radio" class="form-check-input" name="status" id="status-draft" value="draft" @if(old('status' , $category->status)=='draft') checked @endif>
       <label class="form-check-label" for="status-draft">
        Draft
       </label>

     </div>
     @error('status')
      <p class="text-danger">{{$message}}</p>
     @enderror
  </div>
  <div class="form-group" >
     <button type="submit" class="btn btn-primary">{{$button}} </button>
  </div>

