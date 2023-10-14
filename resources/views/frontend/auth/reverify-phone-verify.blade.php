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
                        <h2 class="heading">Phone Verify</h2>
                        <div class="loginform__wrap box-inner">
                            <form action="{{route('frontend.member.resend.phone.verify.code')}}" class="loginform" method="POST">
                                @csrf()
                                <div class="formfield">
                                    <label for="frmZipcode">Country Code</label>
                                    <select 
                                        class="form-control" 
                                        id="frmCountryCode" 
                                        name="country_code"
                                      >
                                        <option value="+977">Nepal</option>
                                        <option value="+1">Canada +1</option>
                                        <option value="+44">United Kingdom +44</option>
                                        <option value="+1">United States +1</option>
                                    </select>
                                </div>
                
                                <div class="formfield">
                                    <label for="loginName">Phone Number</label>
                                    <input type="text" name="phone">
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