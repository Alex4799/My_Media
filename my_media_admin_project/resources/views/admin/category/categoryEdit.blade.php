@extends('admin.layout.main')
@section('contect')
    <div class="col-6 offset-3">

        <form class="card p-3" method="post" action="{{route('admin#categoryUpdate')}}">
            @csrf
            <div class="form-group">
                <h3>Category Edit Page</h3>
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your email...." value="{{$category->title}}">
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            <input type="hidden" name="id" value="{{$category->id}}">

            <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Enter your description....">{{$category->description}}</textarea>
                @error('description')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary col-4">Update</button>
        </form>
    </div>
@endsection
