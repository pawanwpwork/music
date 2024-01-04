@extends('layouts.app')

@section('content')
    <!-- site content -->
    <div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="classified__wrap">
                    <div class="row classified__row">
                        <div class="classified__col classified__col-main col-lg-12">
                            <div class="box">
                                <h1 class="heading-page">Classified for Sale</h1>
                                <p class="product__resultcount">Showing all {{isset($classifiedProducts) ? count($classifiedProducts) : ''}} results</p>
                                <div class="product__wrap">
                                    @if(isset($classifiedProducts) && count($classifiedProducts) > 0)
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
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head-css')

@endsection

@section('scripts')

@endsection
