@extends('admin.layout.main')
@section('contect')

<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
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
              <th>View Count</th>
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
                    <td><i class="fa-solid fa-eye me-1"></i>{{$post->post_count}}</td>
                    <td>
                    <a href="{{route('admin#trendPostDetail',$post->id)}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
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
