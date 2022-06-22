@extends('layouts.app')

@section('content')
    <!-- site content -->
    <div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="classified__wrap">
                    <div class="row classified__row">
                        <div class="classified__col classified__col-main col-lg-8">
                            <div class="box">
                                <h1 class="heading-page">Classified for Sale</h1>
                                <p class="product__resultcount">Showing all {{isset($classifiedCount) ? count($classifiedCount) : ''}} results</p>
                                <div class="product__wrap">
                                    @if(isset($classifiedProducts) && count($classifiedCount))
                                    <div class="row product__row">
                                        @foreach($classifiedProducts as $classifiedProduct)
                                            <div class="product__col col-lg-4 col-md-6">
                                                <div class="product__box">
                                                    <div class="product__thumbnail square">
                                                        <div class="product-notice product-notice--slanted">Sale!</div>
                                                        <img class="product-img" src="{{route('admin.product.storage',$classifiedProduct->id)}}"
                                                            alt="">
                                                        <div class="product-overlay">
                                                            <a href="{{ route('classified.single-page', $classifiedProduct->alias) }}" class="product-link product-link--view"><i class="fa fa-folder-open"></i>View</a>
                                                            @if( $classifiedProduct->category_id != 8 )
                                                                <form action="{{route('frontend.classified.addtocart',encrypt($classifiedProduct->id))}}" class="preview-cart-form" method="POST">
                                                                    @csrf()
                                                                   
                                                                    <input type="hidden" value="1" name="quantity">
                                                                   
                                                                    <div class="preview-cart-button">
                                                                        <button type="submit" class="product-link product-link--cart" style="color:#FFF;cursor: pointer;padding:"><i class="fa fa-cart-plus"></i>Add to Cart</button>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="product__cont">
                                                        <div class="product-title"><a href="{{ route('classified.single-page', $classifiedProduct->alias) }}">{{ $classifiedProduct->name ?? '' }}</a></div>
                                                        @if( $classifiedProduct->price != 0 )
                                                            <div class="product-price">${{ number_format( $classifiedProduct->price , 2 ) ?? '' }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <p>No Products Found!</p>
                                    @endif
                                </div>
                            </div>

                             @if( $totalEvent > $perPage )
                            <nav aria-label="Page navigation" style="background: #000;padding: 30px;">
                              <ul class="pagination">
                                @if( $maxNumPage > 1 )
                                <li>
                                  <a href="{{\Request::url()}}?page={{isset($page) ? ( $page-1 ) : 1}}" aria-label="Previous">
                                    <span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                                  </a>
                                </li>
                                @endif
                                @for( $i=1;$i<=$maxNumPage;$i++ )
                                @if( $page == 0 )
                                @php 
                                    $page = 1;
                                @endphp
                                @else
                                    @php 
                                        $page = $page;
                                    @endphp
                                @endif
                                <li @if($page == $i) class="active" @endif><a href="{{\Request::url()}}?page={{$i}}">{{$i}}</a></li>
                                @endfor
                                @if($page != $maxNumPage)
                                <li>
                                  <a href="{{\Request::url()}}?page={{isset($page) ? ( $page+1 ) : 1}}" aria-label="Next">
                                    <span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                  </a>
                                </li>
                                @endif
                              </ul>
                            </nav>
                            @endif
                        </div>
                        <div class="classified__col classified__col-side col-lg-4">
                            @if( isset($category) && $category->id != 8 )
                            <div class="box">

                                <h2 class="heading">Filter</h2>

                                <div class="filter__wrap">
                                    
                                    <div class="filter-slider" id="filter-slider"></div>

                                    <form method="get">

                                        <p class="filter-display">
                                            <label for="amount">Price range:</label>
                                            <input name="filter_min" type="text" id="filter-amount_min" maxlength="3" value="{{request('filter_min')}}">
                                            <span class="filter-display--spacer">-</span>
                                            <input name="filter_max" type="text" id="filter-amount_max" maxlength="3"  value="{{request('filter_max')}}">
                                        </p>

                                        <button type="submit" class="filter-button">Filter</button>

                                    </form>
                                </div>

                            </div>
                            @endif
                            <div class="box">
                                <h2 class="heading">Classified Category</h2>
                                <div class="eventcategory__wrap">
                                    <ul class="eventcategory-list">
                                        @foreach($categories as $category)
                                            @if(in_array($category->id, [5,6,7,8]))
                                              <li><a href="{{route('product.classified.category',$category->alias)}}">{{$category->name}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head-css')
<link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
@endsection

@section('scripts')
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
    //price slider jquery intialize
$(function () {

    var $this             = $('#filter-slider');
    var amount_min        = $('#filter-amount_min');
    var amount_max        = $('#filter-amount_max');
    
    if( amount_min.val().length > 0){
        var amount_min_filter = parseInt(amount_min.val());    
    }
    else{
        var amount_min_filter = 0;    
    }


    if( amount_max.val().length > 0){
        
        var amount_max_filter = parseInt(amount_max.val()); 
    }

    else{

        var amount_max_filter = 50;    
    }
   
    $this.slider({
        range: true,
        min: 0,
        max: 1000 ,
        values: [amount_min_filter, amount_max_filter],
        slide: function (event, ui) {
            $(amount_min).val(ui.values[0]);
            $(amount_max).val(ui.values[1]);
        }
    });

    $(amount_min).val($this.slider('values', 0));
    $(amount_max).val($this.slider('values', 1));
    $(amount_min).change(function () {
        $this.slider('values', 0, $(this).val());
    });

    $(amount_max).change(function () {
        $this.slider('values', 1, $(this).val());
    })
});
</script>
@endsection
