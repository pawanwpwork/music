@extends('layouts.app')

@section('content')
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                <div class="contactpage__wrap">
                    <section class="section__login">
                        <h1 class="heading-page">Please verify your phone from code you have received.</h1>
                        <h2 class="heading">Verify Phone</h2>
                        <div class="loginform__wrap box-inner">
                            <form action="{{route('frontend.member.phone.verify',$phoneNumber)}}" class="loginform" method="POST">
                                @csrf()
                                <div class="formfield">
                                    <label for="loginName">Verification Code</label>
                                    <input type="text" name="verification_code" id="verification_code">
                                </div>
                                <div class="formfield formfield-submit">
                                    <input type="submit" value="Verify">
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
