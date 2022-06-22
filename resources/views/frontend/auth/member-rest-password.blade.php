@extends('layouts.app')

@section('content')
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                <div class="contactpage__wrap">
                    <section class="section__login">
                          @include('layouts.message')
                        <h1 class="heading-page">My Account</h1>
                        <h2 class="heading">Reset Password</h2>
                        <div class="loginform__wrap box-inner">
                            <form action="{{route('frontend.member.reset.password.post',$email)}}" class="loginform" method="POST">
                                @csrf()
                                <div class="formfield">
                                    <label for="loginName">Email address</label>
                                    <input type="text" name="email" value="{{$decryptEmail}}" readonly="readonly">
                                </div>
                                <div class="formfield">
                                    <label for="loginName">New Password</label>
                                    <input type="password" name="password" >
                                    @if($errors->has('password'))
                                        <span class="error-message">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>
                                 <div class="formfield">
                                    <label for="loginName">Confirm Password</label>
                                    <input type="password" name="password_confirmation">
                                </div>
                                <div class="formfield formfield-submit">
                                    <input type="submit" value="Reset">
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection