@extends('admin.layout.main')
@section('contect')

<div class="col-4">
        <form class="card p-3" method="post" action="{{route('admin#categoryCreate')}}">
            @csrf
            <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your category name....">
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Enter your description...."></textarea>
                @error('description')
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

    @if (session('deleteSucc'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('deleteSucc')}}
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
        <h3 class="card-title">Category</h3>

        <div class="card-tools">
            <form action="{{route('admin#category')}}" method="get">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
              <th>Category ID</th>
              <th>Category Name</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->title}}</td>
                    <td>{{$category->description}}</td>
                    <td>
                    <a href="{{route('admin#categoryEditPage',$category->id)}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                    <a href="{{route('admin#categoryDelete',$category->id)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
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
