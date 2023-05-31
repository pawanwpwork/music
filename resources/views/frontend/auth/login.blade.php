@extends('layouts.app')

@section('content')
<div class="container">
    <div class="box">
        <div class="contactpage__wrap">
            <section class="section__login">
                <h1 class="heading-page">My Account</h1>
                <h2 class="heading">Login</h2>
                <div class="loginform__wrap box-inner">
                    @include('layouts.message')
                    <form action="{{route('music.login')}}" class="loginform" method="post">
                        @csrf
                        <div class="formfield">
                            <label for="loginName">E-Mail Address</label>
                            <input type="text" name="email" value="{{old('email')}}" placeholder="E-Mail Address" class="form-control" autocomplete="off">

                            @if($errors->has('email'))
                                <span class="error-message">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        
                       <div class="formfield">
                            <label for="loginPassword">Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control" value="{{old('password')}}" autocomplete="off" id="exampleInputPassword1">
                            @if($errors->has('password'))
                                <span class="error-message">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                            <span  class="show-password" onClick="togglePasswordType();"><i class="fa fa-eye"></i></span>
                        </div>
                       
                        <div class="checkbox">								
                        <label><input id="input-qlremember1" type="checkbox" name="remember" value="1"> Remember Me</label>
                        </div>						
                        
                        <div class="formfield formfield-submit">
                            <input type="submit" value="Login" class="btn btn-primary form-control">
                        </div>
                        <div class="formfield lost-password">
                            <a href="{{route('frontend.member.forgot.password')}}">Forgotten Password</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    function togglePasswordType() {
        var x = document.getElementById("exampleInputPassword1");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection