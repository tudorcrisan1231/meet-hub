@extends('layouts.main')
@section('content')
<main class="main-container ">
    <h1 class="logo">MeetHub</h1>
    <div class="cotainer-login">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="register-login-title">Register User</h3>
                    <div class="form-login">
                        <form action="{{ route('register.custom') }}" method="POST" style="width: 90%">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="input" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email_address" class="input"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password"  class="input"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="checkbox" style="gap:.5rem;">
                                    <input type="checkbox" class="check" name="remember" id="checkbox" style="width:max-content !important;">
                                    <label for="checkbox">
                                         Remember Me
                                    </label>
                                </div>
                                <button type="submit" class="button_login_register">SignUp</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="already-an-account">
            Already an account?
        <a class="register-login" href="{{route('login')}}">LOGIN</a>
        </div>
        <div>
            <p class="Terms_register">Read our terms and conditions <span>Click</span></p>
        </div>
    </div>
    </div>
    
</main>
@endsection