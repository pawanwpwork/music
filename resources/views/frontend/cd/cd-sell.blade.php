@extends('layouts.app')

@section('content')
 <div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="box">
                    @include('layouts.message') 
                    <div class="cdsell__form-wrap box-inner" id="cdSellForm">
                        <h1 class="heading">CD Sell</h1>
                        <form action="{{route('cd-sell.post')}}" class="classifiedPostForm row" enctype="multipart/form-data" method="POST">
                            @csrf()
                            <div class="formfield col-md-6 col-12">
                                <label for="frmTitle">Title</label>
                                <input type="text" name="name" id="frmTitle" value="{{old('name')}}">
                            </div>
                            <div class="formfield col-md-6 col-12">
                                <label for="frmArtist">Artist</label>
                                <input type="text" name="artist" id="frmArtist" value="{{old('artist')}}">
                            </div>
                            <div class="formfield col-md-6 col-12">
                                <label for="frmProductCode">Product Code</label>
                                <input type="text" name="sku" id="frmProductCode" value="{{old('sku')}}">
                            </div>
                            <div class="formfield col-md-6 col-12">
                                <label for="frmLabelCode">Label Code / Label</label>
                                <input type="text" name="model" id="frmLabelCode" value="{{old('model')}}">
                            </div>
                            <div class="formfield col-md-6 col-12">
                                <label for="frmPrice">Price</label>
                                <input type="number" name="price" id="frmPrice" min="1" value="{{old('price',1)}}">
                            </div>
                             <div class="formfield col-md-6 col-12">
                                <label for="frmQuantity">Quantity</label>
                                <input type="number" name="quantity" id="frmQuantity" min="1" value="{{old('quantity',1)}}">
                            </div>
                            <div class="formfield formfield-upload col-md-6 col-12" id="uploadImg">
                                <label for="frmFrontCover">Front Cover</label>
                                <input type="file" name="image" id="frmFrontCover">
                            </div>
                            <div class="formfield formfield-upload col-md-6 col-12" id="uploadImg1">
                                <label for="frmBackCover">Back Cover</label>
                                <input type="file" name="back_image" id="frmBackCover">
                            </div>
                            <div class="formfield col-12">
                                <label for="frmEventDesc">Description</label>
                                <textarea name="description" id="frmEventDesc">{{old('description')}}</textarea>
                            </div>
                            
                            <div class="formfield formfield-submit col-12">
                                <input type="submit" value="Post">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $('#frmTotalDays').keyup(function(){
        var totalDays = $('#frmTotalDays').val();
        var rate = $('#frmEventRate').val();
        $('#frmSubTotal').val(totalDays * rate);
    });

    $(window).on('load',function(){
        var date1 = $('#frmStartDate').datepicker('getDate');
        var date2 = $('#frmEndDate').datepicker('getDate');
        var diff  = 0;
        if (date1 && date2) {
            diff = Math.floor((date2.getTime() - date1.getTime()) / 86400000);
        }
        var totalDays = diff + 1;
        var rate = '{{ isset($rate->classified_per_day_rate) ? $rate->classified_per_day_rate : 6 }}';
        $("#frmTotalDays").val(totalDays);
        $('#frmSubTotal').val(totalDays * rate);
    });
</script>
@endsection