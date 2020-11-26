@extends('layouts.app')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <b>Login</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
           <h6>{{ Session::get('no') }}</h6>
            <p class="login-box-msg">Enter Your OTP</p>
            <form method="POST" action="/otpcheck">
           @csrf

                <div class="input-group mb-3">
                    <input type="username" id="otp" name="otp" pattern="[0-9]+" title="number only" minlength="4" maxlength="4" class="form-control" required autofocus placeholder="OTP">
                        <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-info" type="submit">submit</button>
            </form>                
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

@endsection
