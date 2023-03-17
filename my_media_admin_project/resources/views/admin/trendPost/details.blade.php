@extends('admin.layout.main')

@section('contect')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class=" text-decoration-none text-dark" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></div>
                        </div>
                        @if (session('detailUpdate'))
                            <div class="alert alert-success alert-dismissible fade show col-6 offset-6" role="alert">
                                {{session('detailUpdate')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-3 offset-1">
                                    <div class="image">
                                        <img src="@if ($post->image==null)
                                        {{asset('default_image/download.png')}}
                                    @else
                                        {{asset('postImage/'.$post->image)}}
                                    @endif" class="w-100 rounded shadow">
                                </div>
                            </div>
                            <div class="col-6 offset-1">
                                <div class=" m-3"><h3>{{$post->title}}</h3></div>
                                <div class=" m-3"><p>{{$post->description}}</p></div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
