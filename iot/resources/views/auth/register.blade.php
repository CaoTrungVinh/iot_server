@extends('auth.auth')
@section('content-auth')
    <div class="login-box">
        <h1 class="text-center mb-5"><i class="fa fa-rocket text-primary"></i> Sleekadmin</h1>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-12 login-box-info">
                <h3 class="mb-4">Sign in</h3>
                <p class="mb-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.</p>
                <p class="text-center"><a href="{{route('adLogin')}}" class="btn btn-light">Login here</a></p>
            </div>
            <div class="col-md-6 col-sm-6 col-12 login-box-form p-4">
                <h3 class="mb-2">Sign up</h3>
                <small class="text-muted bc-description">Create new account</small>

                {{--          form Register         --}}
                <form method="post" action="{{route('register')}}" class="register">
                    @csrf
                    <p class="form">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control mt-0" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="r_userName" id="r_userName" value="{{old('r_firstname')}}" />
                    </div>
                    @error('r_userName')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </p>
                    <p class="form">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control mt-0" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" name="r_email" id="r_email" value="{{old('r_email')}}" />
                    </div>
                    @error('r_email')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </p>
                    <p class="form">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="r_pass" id="r_pass" />
                    </div>
                    @error('r_pass')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </p>
                    <p class="form">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control mt-0" placeholder="Repeat Password" aria-label="Repeat Password" aria-describedby="basic-addon1" name="r_repass" id="r_repass" />
                    </div>
                    @error('r_repass')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </p>

                    <div class="form-group">
                        <input type="submit" class="btn btn-theme btn-block p-2 mb-1" name="register" value="Register" />
                        {{--                    <button class="btn btn-theme btn-block p-2 mb-1">Register</button>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<!-- Script to active register
    ================================================== -->
@section('lastScript')
    @if ($register ?? ''!='')
        <script>
            $( document ).ready(function() {
                $('.tabs-nav a[href$="{{$register}}"]').parent("li").click();
            });
        </script>
    @endif
@endsection()
