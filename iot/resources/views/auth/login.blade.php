@extends('auth.auth')
@section('content-auth')

<div class="login-box">
    <h1 class="text-center mb-5"><i class="fa fa-rocket text-primary"></i> Sleekadmin</h1>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-12 login-box-info">
            <h3 class="mb-4">Sign up</h3>
            <p class="mb-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.</p>
            <p class="text-center"><a href="{{route('register')}}" class="btn btn-light">Register here</a></p>
        </div>
        <div class="col-md-6 col-sm-6 col-12 login-box-form p-4">
            <h3 class="mb-2">Login</h3>
            <small class="text-muted bc-description">Sign in with your credentials</small>
            <form action="" class="mt-2">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control mt-0" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="text" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                </div>

                <div class="form-group">
                    <button class="btn btn-theme btn-block p-2 mb-1">Login</button>
                    <a href="{{route('forgot_password')}}">
                        <small class="text-theme"><strong>Forgot password?</strong></small>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection