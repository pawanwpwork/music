@extends('layouts.app')

@section('content')
<!-- site content -->
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                <div class="preview__wrap">
                    <section class="section-preview section-preview-top">
                        <div class="row">
                            <div class="preview__col-img col-md-5">
                                <div class="preview-preview">
                                    <div class="row">
                                        <div class="preview-preview--col col-12">
                                            @if(isset($classifiedProduct->id))
                                            <div class="preview-img square">
                                                <img src="{{route('admin.product.storage',$classifiedProduct->id)}}" alt="">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="preview__col-cont col-md-7">
                                <h2 class="heading">{{ $classifiedProduct->name ?? '' }}</h2>
                                @if($classifiedProduct->price != 0)
                                    <div class="preview-price">
                                        <span>${{ number_format( $classifiedProduct->price , 2 ) ?? '' }}</span>
                                    </div>
                                @endif
                                <div class="preview-desc">
                                    <p>{!! $classifiedProduct->description ?? '' !!}</p>
                                </div>
                                @if( isset($classifiedProduct->category[0]->id) && $classifiedProduct->category[0]->id != 8 )
                                <div class="preview-cart">
                                    <form action="{{route('frontend.classified.addtocart',encrypt($classifiedProduct->id))}}" class="preview-cart-form" method="POST">
                                        @csrf()
                                        <div class="preview-cart-quantity">
                                            <input type="number" value="1" name="quantity" min="1" max="{{$classifiedProduct->quantity}}">
                                        </div>
                                        <div class="preview-cart-button">
                                            <button type="submit">Add to Cart</button>
                                        </div>
                                    </form>
                                </div>
                                @endif

                                @if(isset($classifiedProduct->category[0]->id) && $classifiedProduct->category[0]->id == 8 )
                                <div class="preview-cart">
                                    <div class="preview-cart-button">
                                       <button type="submit"> <a href="{{route('classified.service.form',$classifiedProduct->alias)}}">Enquire now</a> </button>
                                    </div>
                                </div>
                                @endif
                                <div class="preview-meta">
                                    @if(isset($classifiedProduct->category ))
                                    <span class="preview-category">
                                        <strong>Category:</strong>
                                        <a href="#">
                                        @foreach($classifiedProduct->category as $key => $category)
                                            {{ $category->name }}
                                            @if($key != count($classifiedProduct->category) - 1)
                                                ,
                                            @endif
                                        @endforeach
                                        </a>
                                    </span>
                                    @endif

                    
                                    @if(isset($classifiedProduct->product_tag))
                                    @php 
                                        $productTags = explode(',',$classifiedProduct->product_tag);
                                    @endphp
                                    @if(isset($productTags) && count($productTags) > 0)
                                    <span class="preview-tags">
                                        <strong>Tags:</strong>
                                        
                                        @foreach($productTags as $pTag)
                                        <a href="#">{{$pTag}}</a>
                                        @endforeach
                                    </span>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section-preview section-preview-bot">
                        @include('layouts.message')
                        <ul class="nav nav-tabs preview-tab-link" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#preview" role="tab" data-toggle="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Reviews</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="preview-tab tab-pane fade in active show" id="preview">
                                <h2 class="heading">Description</h2>
                                {!! $classifiedProduct->description ?? '' !!}
                            </div>
                            <div role="tabpanel" class="preview-tab tab-pane fade" id="buzz">
                                @php 
                                    $reviews = App\Models\ProductReview::where('product_id',$classifiedProduct->id)->where('status',1)->get();
                                @endphp
                                <h2 class="heading">Reviews</h2>
                                @if( isset( $reviews ) && count( $reviews ) > 0 )
                                @foreach( $reviews as $rev )
                                @php  $member = App\Models\Member::find($rev->member_id);@endphp
                                    @if( isset( $member  ) )
                                    <p><strong>{{ $member->first_name ?? '' }} {{ $member->last_name ?? '' }}:</strong> {{ $rev->review }}</p>
                                    @endif
                                @endforeach
                                @else
                                <p>There are no reviews yet.</p>
                                @endif
                                <p>Be the first to review “Live in Concert”</p>
                                <p>Your email address will not be published. Required fields are marked *</p>



                                @if(Auth::guard('member')->check())
                                <form action="{{route('frontend.product.review',encrypt($classifiedProduct->id))}}" method="POST" class="review-form">
                                    @csrf()
                                    <h3>Your Rating</h3>
                                    <div class="rating__wrap clearfix">
                                        <fieldset class="rating">
                                            
                                            <input type="radio" id="star5" name="rating" value="5">
                                            <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                            <input type="radio" id="star4half" name="rating" value="4.5" />
                                            <label class="half" for="star4half" title="Wow - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3.5" />
                                            <label class="half" for="star3half" title="Good - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class="full" for="star3" title="Kinda Good - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2.5" />
                                            <label class="half" for="star2half" title="Meh - 2.5 stars"></label>
                                            
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1.5" />
                                            <label class="half" for="star1half" title="Bad - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class="full" for="star1" title="Sucks - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="0.5" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                        </fieldset>
                                    </div>

                                    <div class="formfield">
                                        <label for="frmReviewText">Your review*</label>
                                        <textarea name="review" id="frmReviewText"></textarea>
                                    </div>
                                    <div class="formfield">
                                        <label for="frmReviewName">Name*</label>
                                        <input type="text" name="review_name" id="frmReviewName" value="{{Auth::guard('member')->user()->first_name}} {{Auth::guard('member')->user()->last_name}}" readonly>
                                    </div>
                                    <div class="formfield">
                                        <label for="frmReviewEmail">Email*</label>
                                        <input type="email" name="review_email" id="frmReviewEmail" value="{{Auth::guard('member')->user()->email}}" readonly>
                                    </div>
                                    <div class="formfield formfield-submit">
                                        <input type="submit" value="Submit">
                                    </div>
                                </form>
                                @else
                                <p>Please Login first and click <a href="{{route('music.login')}}">here</a></p>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="box">
                <div class="relatedproducts__wrap">
                    <h2 class="heading">Related Products</h2>
                    <!-- homepage owl slider -->
                    @if(isset($relatedProducts) && count($relatedProducts) > 0)
                    <div class="relatedslider owl-carousel owl-theme">

                    @foreach($relatedProducts as $related)
                        <div class="item">
                            <div class="product__box">
                                <div class="product__thumbnail">
                                    <img class="product-img" src="{{route('admin.product.storage',$related->id)}}" alt="">
                                    <div class="product-overlay">
                                        <a href="{{ route('classified.single-page', $related->alias) }}" class="product-link product-link--view"><i class="fa fa-folder-open"></i>
                                            View</a>
                                        <a href="{{ route('classified.single-page', $related->alias) }}" class="product-link product-link--cart"><i class="fa fa-cart-plus"></i>
                                            Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product__cont">
                                    <div class="product-title"><a href="#">{{ $related->name ?? ''}}</a></div>
                                    <div class="product-price">${{ $related->price ?? ''}}.00</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p>No Related Product</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection