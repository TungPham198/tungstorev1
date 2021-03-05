@extends('backend.auth') @section('meta')
<title>Register</title>
<meta content="Responsive bootstrap 4 admin template" name="description"> @endsection @section('content') @section('content')
<div class="col-md-8 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4 mt-3">
                <a href="index.html">
                    <span><img src="assets\images\logo-dark.png" alt="" height="30"></span>
                </a>
            </div>
            @if(session('notice'))
            <p class="text-success text-center">
                {{session('notice')}}
            </p>
            @endif @if(session('error'))
            <p class="text-danger text-center">
                {{session('error')}}
            </p>
            @endif
            <form action="{{ route('admin.register') }}" method="POST" class="p-2">
                @csrf
                <div class="form-group">
                    <label for="username">Name</label>
                    <input class="form-control" type="text" id="username" name="name" value="{{ old('name') }}" placeholder="Michael Zenaty">
                    @if($errors->has('name'))
                        <p class="text-danger mt-2">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="emailaddress">Email address</label>
                    <input class="form-control" type="email" id="emailaddress" name="email" value="{{ old('email')}}" placeholder="john@deo.com">
                    @if($errors->has('email'))
                        <p class="text-danger mt-2">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" required="" name="password" id="password" value="{{ old('password')}}" placeholder="Enter your password">
                    @if($errors->has('password'))
                        <p class="text-danger mt-2">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input class="form-control" type="number
                    " value="{{ old('phone')}}" name="phone" id="phone" placeholder="Enter your phone">
                    @if($errors->has('phone'))
                        <p class="text-danger mt-2">{{ $errors->first('phone') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Gender</label>
                    <div class="col-sm-12">
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio1" {{ (old('gender') == config('constants.GENDER.MALE')) ? "checked" : "" }} value="{{ config('constants.GENDER.MALE') }}" name="gender">
                            <label for="inlineRadio1"> Male </label>
                        </div>
                        <div class="radio form-check-inline">
                            <input type="radio" id="inlineRadio2" {{ (old('gender') == config('constants.GENDER.FEMALE')) ? "checked" : "" }} value="{{ config('constants.GENDER.FEMALE') }}" name="gender">
                            <label for="inlineRadio2"> Female </label>
                        </div>
                        @if($errors->has('gender'))
                        <p class="text-danger mt-2">{{ $errors->first('gender') }}</p>
                    @endif
                    </div>
                </div>
                <div class="form-group mb-4 pb-3">
                    <div class="custom-control custom-checkbox checkbox-primary">
                        <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                        <label class="custom-control-label" for="checkbox-signin">I accept <a href="#">Terms and Conditions</a></label>
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" type="submit"> Sign Up Free </button>
                </div>
            </form>
        </div>
        <!-- end card-body -->
    </div>
    <!-- end card -->

    <div class="row mt-4">
        <div class="col-sm-12 text-center">
            <p class="text-muted mb-0">Already have an account? <a href="{{ route('admin.login') }}" class="text-dark ml-1"><b>Sign In</b></a></p>
        </div>
    </div>

</div>
@endsection