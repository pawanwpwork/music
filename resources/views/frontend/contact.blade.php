@extends('layouts.app')

@section('content')
@php $siteSetting = siteSetting(); @endphp
    <div class="container">
        <div class="box">
            <div class="contactpage__wrap">
                <section class="section__contact section__contact__map">
                    <h1 class="heading-page">Contact Us</h1>
                    <div class="contact__map">
                        {!!$siteSetting->iframe!!}
                    </div>
                </section>
                <section class="section__contact section__contact-footer">
                    <div class="row">
                        <div class="col-lg-7 contact__col">
                            <h2 class="heading">Contact Form</h2>
                            <div class="contact__form-wrap">
                                @include('layouts.message')
                                <form action="{{route('frontend.contact.post')}}" method="POST" class="contact__form row">
                                    @csrf()
                                    <div class="formfield col-md-6">
                                        <input type="text" name="name" value="" placeholder="Your Name" class="form-control"></div>
                                    <div class="formfield col-md-6">
                                        <input type="email" name="email" value="" placeholder="E-Mail Address" class="form-control"></div>
                                    <div class="formfield col-12">
                                        <input type="text" name="subject" placeholder="Subject" class="form-control">
                                    </div>
                                    <div class="formfield col-12">
                                        <textarea name="enquiry" placeholder="Enquiry" class="form-control"></textarea></div>
                                    <div class="formfield formfield-submit col-12">
                                        <input type="submit" value="Submit" class="form-control">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5 contact__col">
                            <h2 class="heading">Get in Touch</h2>
                            <address class="contact__address">
                                
                                <strong>{{ (isset($siteSetting->title) ? ($siteSetting->title) : 'AllMusicAllArtist') }}</strong>
                                <p>{{ (isset($siteSetting->address_1) ? ($siteSetting->address_1) : '') }}<br>
                                {{ (isset($siteSetting->address_2) ? ($siteSetting->address_2) : '') }}</p>
                                <p>Mobile: <a href="tel:{{ (isset($siteSetting->mobile) ? ($siteSetting->mobile) : '') }}">{{ (isset($siteSetting->mobile) ? ($siteSetting->mobile) : '') }}</a></p>
                                <p>Email: <a href="mailto:{{ (isset($siteSetting->email) ? ($siteSetting->email) : '') }}">{{ (isset($siteSetting->email) ? ($siteSetting->email) : '') }}</a></p>
                            </address>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection