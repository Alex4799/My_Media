@extends('admin.layout.main')
@section('contect')

<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List</h3>

            <div class="card-tools">
                <form action="{{route('admin#list')}}" method="get">
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
            @if (session('deleSuccess'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('deleSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($userData as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->gender}}</td>
                    <td>
                    @if (Auth::user()->id!=$item->id)
                    <a href="{{route('admin#listDelete',$item->id)}}">
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a>
                    @endif
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
