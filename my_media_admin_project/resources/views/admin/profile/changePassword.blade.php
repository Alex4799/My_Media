@extends('admin.layout.main')

@section('contect')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

                @if (session('passWorng'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('passWorng')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

              <form class="form-horizontal" method="post" action="{{route('admin#changePassword')}}">
                @csrf

                <div class="form-group row">
                  <label for="inputName" class="col-sm-3 col-form-label">Old Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" placeholder="Enter Your Old Password.....">
                            @error('oldPassword')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                    </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-3 col-form-label">New Password</label>
                  <div class="col-sm-9">
                    <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" placeholder="Enter Your New Password.....">
                        @error('newPassword')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                  </div>

                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Comfirm Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="comfirmPassword" class="form-control @error('comfirmPassword') is-invalid @enderror" placeholder="Enter Your Comfirm Password.....">
                        @error('comfirmPassword')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group float-end">
                    <input type="submit" class="btn btn-secondary">
                </div>

              </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
