@extends('admin.layout.main')
@section('contect')
    <div class="col-10 offset-1">

        <form class="card p-3" method="post" action="{{route('admin#postUpdate')}}" enctype="multipart/form-data">
            @csrf
            <h3>Post Edit Page</h3>
            <hr>
            <div class="row">
                <div class="col-4">
                    <label for="">Image</label>
                    <div>
                        <img src="@if ($post->image==null)
                            {{asset('default_image/download.png')}}
                        @else
                            {{asset('postImage/'.$post->image)}}
                        @endif" class="w-100 rounded shadow">
                    </div>

                    <input type="file" name="image" class="form-control my-3">

                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-8">
                    <div class="form-group">

                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your email...." value="{{old('name',$post->title)}}">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                    </div>

                    <input type="hidden" name="id" value="{{$post->id}}">

                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Enter your description....">{{old('description',$post->description)}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                    </div>

                    <div class="form-group">

                        <label for="exampleInputEmail1">Category</label>

                        <select name="category" class="form-control">
                            <option value="">Chose Your Category</option>
                            @foreach ($category as $item)
                            <option value="{{$item->id}}" @if ($item->id ==$post->category_id) selected @endif>{{$item->title}}</option>
                            @endforeach
                        </select>

                            @error('category')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                    </div>


                </div>
            </div>
        </form>
    </div>
@endsection
