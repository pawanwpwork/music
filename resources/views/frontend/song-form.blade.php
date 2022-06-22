@extends('layouts.app')

@section('content')

 <!-- site content -->
    <div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="box">
                    <div class="radioPost__form-wrap box-inner" id="radioPostForm">
                        <h1 class="heading">Post a song</h1>
                        @include('layouts.message')
                        <form action="{{route('frontend.song.post')}}" class="radioPostForm row" method="POST" enctype="multipart/form-data">
                        	@csrf()
                            <div class="formfield form-important col-12">
                                <label for="frmSongTitle">Song Title</label>
                                <input type="text" name="title" id="frmSongTitle" placeholder="Song Title" value="{{old('title')}}">
                            </div>
                            <div class="formfield form-important col-lg-6 col-12">
                                <label for="frmSongLabel">Label</label>
                                <input type="text" name="label" id="frmSongLabel" placeholder="Label" value="{{old('label')}}">
                            </div>
                            <div class="formfield form-important col-lg-6 col-12">
                                <label for="frmSongArtist">Artist</label>
                                <input type="text" name="artist" id="frmSongArtist" placeholder="Artist" value="{{old('artist')}}">
                            </div>
                            <div class="formfield form-important col-lg-6 col-12">
                                <label for="frmSongDuration">Duration</label>
                                <input type="text" name="duration" id="frmSongDuration" placeholder="hh:mm:ss" value="{{old('duration')}}">
                            </div>
                            <div class="formfield form-important formfield-upload col-12">
                                <label for="frmSongLyric">Exploited Lyric</label>
                                <input type="file" name="lyrics" id="frmSongLyric" class="form-control">
                            </div>
                            <div class="formfield form-important formfield-upload col-12">
                                <label for="frmSongFile">Upload File / Song</label>
                                <input type="file" name="song" id="frmSongFile" class="form-control">
                            </div>
                             <div class="formfield col-12">
                                <input type="checkbox" name="terms_condition" requied> I accept your <a href="#" title="Terms and condition" style="color:red;">Terms & Condtion.</a>
                            </div>
                            <div class="formfield formfield-submit col-12">
                                <input type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection