@extends('admin.layout.main')
@section('contect')

<div class="col-4">
        <form class="card p-3" method="post" action="{{route('admin#postCreate')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your email....">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea name="description" class="form-control" cols="30" rows="5" placeholder="Enter your description...."></textarea>
                    @error('description')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" class="form-control">
                    @error('image')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Category</label>

                <select name="category" class="form-control">
                    <option value=''>Choose your option</option>
                    @foreach ($categories as $category)
                        <option value={{$category->id}}>{{$category->title}}</option>
                    @endforeach
                </select>
                    @error('category')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
            </div>

            <button type="submit" class="btn btn-primary col-4">Create</button>
        </form>
</div>

<div class="col-8">

    @if (session('createSucc'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('createSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('deleteSuc'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('deleteSuc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('updateSucc'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{session('updateSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Post</h3>

        <div class="card-tools">
            <form action="{{route('admin#post')}}" method="get">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="search_key" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Post ID</th>
              <th>Image</th>
              <th>Post Name</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td class="col-1">
                        <img src="@if ($post->image==null)
                            {{asset('default_image/download.png')}}
                        @else
                            {{asset('postImage/'.$post->image)}}
                        @endif" class="w-100 rounded shadow">
                    </td>
                    <td>{{$post->title}}</td>
                    <td>
                    <a href="{{route('admin#postEditPage',$post->id)}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                    <a href="{{route('admin#postDelete',$post->id)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

@endsection
