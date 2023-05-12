@extends('layouts.main')
@section('content')
<main class="main-container">
    <h1 class="logo">MeetHub</h1>
    <div class="cotainer-login">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="title-login">Login</h3>
                    <div class="form-login">
                        <form method="POST" action="{{ route('login.custom') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input  type="text" placeholder="Email" id="email" class="input-login" name="email" required
                                    autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="input-login" name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="button-login">Signin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="already-an-account">
            Already an account?
        <a class="register-login" href="{{route('register-user')}}">REGISTER</a>
        </div>
        
    </div>
</main>
@endsection