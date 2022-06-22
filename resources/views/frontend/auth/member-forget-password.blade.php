@extends('layouts.app')

@section('content')
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                <div class="contactpage__wrap">
                    <section class="section__login">
                        <h1 class="heading-page">My Account</h1>
                        <h2 class="heading">Forgot Password</h2>
                        <div class="loginform__wrap box-inner">
                            <form action="{{route('frontend.member.reset.password')}}" class="loginform" method="POST">
                                @csrf()
                                <div class="formfield">
                                    <label for="loginName">Email address</label>
                                    <input type="text" name="email" id="email_address">
                                </div>
                                <div class="formfield formfield-submit">
                                    <input type="submit" value="Send Link">
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