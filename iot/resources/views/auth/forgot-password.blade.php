@extends('auth.auth')
@section('content-auth')
<div class="login-box">
    <h1 class="text-center mb-5" style="margin-bottom: 10px !important;">
        <img src="assets/img/logo.png" class="" style="width: 60px; height: 60px;"/>
        App IoT Admin</h1>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-12 login-box-form p-4">
            <h3 class="mb-4">Forgot password</h3>
            <form action="" class="mt-2">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control mt-0" placeholder="Email address" aria-label="enail" aria-describedby="basic-addon1">
                </div>

                <div class="form-group">
                    <button class="btn btn-theme btn-block p-2 mb-1">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
