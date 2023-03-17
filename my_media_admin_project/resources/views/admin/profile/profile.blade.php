@extends('admin.layout.main')

@section('contect')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

                @if (session('profileUpdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('profileUpdate')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

              <form class="form-horizontal" method="post" action="{{route('admin#updateProfile')}}">
                @csrf

                <div class="form-group row">
                  <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name" value="{{old('name',$data->name)}}">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                </div>

                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" value="{{old('name',$data->email)}}">
                    @error('email')
                      <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>

                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-9">
                      <input type="text" name="phone" class="form-control" placeholder="Enter Your Phone" value="{{$data->phone}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <textarea name="address" cols="30" rows="5" class="form-control" placeholder="Enter Your Address">{{$data->address}}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-9">
                        <select name="gender" class="form-control" >
                            <option value="" @if ($data->gender=='') selected @endif>Choose Your Option</option>
                            <option value="male" @if ($data->gender=='male') selected @endif>Male</option>
                            <option value="female" @if ($data->gender=='female') selected @endif>Female</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                  <div class="offset-sm-3 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Submit</button>
                  </div>
                </div>

              </form>

              <div class=" row">
                <div class="offset-sm-8 ">
                  <a href="{{route('admin#changePasswordPage')}}">Change Password</a>
                </div>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
