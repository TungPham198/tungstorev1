@extends('backend.auth') @section('meta')
<title>Login Page</title>
<meta content="Responsive bootstrap 4 admin template" name="description"> @endsection @section('content')
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

            <form action="{{ route('admin.login') }}" method="POST" class="p-2">
                @csrf
                <div class="form-group">
                    <label for="emailaddress">Email address</label>
                    <input class="form-control" type="email" id="emailaddress" name="email" required="" placeholder="john@deo.com">
                </div>
                <div class="form-group">
                    <a href="page-recoverpw.html" class="text-muted float-right">Forgot your password?</a>
                    <label for="password">Password</label>
                    <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
                </div>

                <div class="form-group mb-4 pb-3">
                    <div class="custom-control custom-checkbox checkbox-primary">
                        <input name="remember" type="checkbox" class="custom-control-input" id="checkbox-signin">
                        <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" type="submit"> Sign In </button>
                </div>
            </form>
        </div>
        <!-- end card-body -->
    </div>
    <!-- end card -->
    <div class="row mt-4">
        <div class="col-sm-12 text-center">
            <p class="text-muted mb-0">Don't have an account? <a href="{{ route('admin.register') }}" class="text-dark ml-1"><b>Sign Up</b></a></p>
        </div>
    </div>
</div>
@endsection