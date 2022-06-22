@extends('layouts.app')

@section('content')
<!-- site content -->
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                <div class="musiciansearch__wrap">
                    <h2 class="heading">Musician Search</h2>
                    <div class="box-inner">
                        <form action="{{route('musican.search.result')}}" class="musiciansearch-form" method="GET">
                            <div class="row">
                                <div class="formfield col-md-6">
                                    <label for="frmMusicianName">Musician First name</label>
                                    <input type="text" name="first_name" id="first_name" placeholder="Musician First Name">
                                </div>
                                 <div class="formfield col-md-6">
                                    <label for="frmMusicianName">Musician Last name</label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Musician Last Name">
                                </div>
                            </div>
                            <div class="formfield musiciansearch-category">
                                <label>Musician Category</label>
                                <div class="row">
                                    @if(isset($categories) && count($categories) > 0)
                                        @foreach($categories as $key => $cat)
                                            <div class="formfield col-md-3">
                                                <div class="form-check customcheckbox">
                                                    <input type="checkbox" cat_name="{{$cat}}" name="music_category[]" value="{{$key}}" id="frmMusic{{$cat}}">
                                                    <label for="frmMusic{{$cat}}">{{$cat}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="formfield">
                                <span id="categoryShow" onclick="$('.musiciansearch-category .formfield').show();$(this).hide()">..View
                                    All Categories</span>
                            </div>
                            <div class="formfield formfield-submit">
                                <input type="submit" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection