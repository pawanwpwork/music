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
                            <div class="preview__col-img col-md-7">
                                <div class="preview-preview">
                                    <div class="row">
                                        <div class="preview-preview--col col-md-6">
                                            <div class="preview-img preview-img-front square">
                                                <img src="images/album-cover1.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="preview-preview--col col-md-6">
                                            <div class="preview-img preview-img-back square">
                                                <img src="images/cd-back.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="preview__col-cont col-md-5">
                                <h2 class="heading">Live In Texas</h2>
                                <div class="preview-price">
                                    <span>$ 7.00</span>
                                </div>
                                <div class="preview-desc">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae laudantium
                                        dolores architecto ea molestiae accusantium ex, assumenda illo dolorem a provident laboriosam est exercitationem debitis reprehenderit, aspernatur optio consectetur ipsum.</p>
                                </div>
                                <div class="preview-cart">
                                    <form action="" class="preview-cart-form">
                                        <div class="preview-cart-quantity">
                                            <input type="number" value="1">
                                        </div>
                                        <div class="preview-cart-button">
                                            <button href="#">Add to Cart</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="preview-meta">
                                    <span class="preview-category">
                                        <strong>Category:</strong>
                                        <a href="#">Album</a>
                                    </span>
                                    <span class="preview-tags">
                                        <strong>Tags:</strong>
                                        <a href="#">metal</a>
                                        <a href="#">rock</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section-preview section-preview-bot">
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
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis possimus
                                    exercitationem aliquam ratione et voluptatibus dolor ipsam autem, sit
                                    recusandae?</p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente nihil fugit voluptas nostrum id, placeat ut est in non deserunt quod repellendus reprehenderit ullam animi! Repellendus animi quidem nobis rem deleniti ex iure aperiam voluptatum?</p>
                            </div>
                            <div role="tabpanel" class="preview-tab tab-pane fade" id="buzz">
                                <h2 class="heading">Reviews</h2>
                                <p>There are no reviews yet.</p>
                                <p>Be the first to review “Live in Concert”</p>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <form action="" class="review-form">
                                    <h3>Your Rating</h3>
                                    <div class="rating__wrap clearfix">
                                        <fieldset class="rating">
                                            <input type="radio" id="star5" name="rating" value="5" /><label class="full"
                                                for="star5" title="Awesome - 5 stars"></label>
                                            <input type="radio" id="star4half" name="rating" value="4 and a half" /><label
                                                class="half" for="star4half" title="Wow - 4.5 stars"></label>
                                            <input type="radio" id="star4" name="rating" value="4" /><label class="full"
                                                for="star4" title="Pretty good - 4 stars"></label>
                                            <input type="radio" id="star3half" name="rating" value="3 and a half" /><label
                                                class="half" for="star3half" title="Good - 3.5 stars"></label>
                                            <input type="radio" id="star3" name="rating" value="3" /><label class="full"
                                                for="star3" title="Kinda Good - 3 stars"></label>
                                            <input type="radio" id="star2half" name="rating" value="2 and a half" /><label
                                                class="half" for="star2half" title="Meh - 2.5 stars"></label>
                                            <input type="radio" id="star2" name="rating" value="2" /><label class="full"
                                                for="star2" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" id="star1half" name="rating" value="1 and a half" /><label
                                                class="half" for="star1half" title="Bad - 1.5 stars"></label>
                                            <input type="radio" id="star1" name="rating" value="1" /><label class="full"
                                                for="star1" title="Sucks - 1 star"></label>
                                            <input type="radio" id="starhalf" name="rating" value="half" /><label
                                                class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                        </fieldset>
                                    </div>
                                    <div class="formfield">
                                        <label for="frmReviewText">Your review*</label>
                                        <textarea name="frmReviewText" id="frmReviewText"></textarea>
                                    </div>
                                    <div class="formfield">
                                        <label for="frmReviewName">Name*</label>
                                        <input type="text" name="frmReviewName" id="frmReviewName">
                                    </div>
                                    <div class="formfield">
                                        <label for="frmReviewEmail">Email*</label>
                                        <input type="email" name="frmReviewEmail" id="frmReviewEmail">
                                    </div>
                                    <div class="formfield formfield-submit">
                                        <input type="submit" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="box">
                <div class="relatedproducts__wrap">
                    <h2 class="heading">Related Products</h2>
                    <!-- homepage owl slider -->
                    <div class="relatedslider owl-carousel owl-theme">
                        <div class="item">
                            <div class="product__box">
                                <div class="product__thumbnail square">
                                    <img class="product-img" src="images/albumcover/album6-1-300x300.jpg" alt="">
                                    <div class="product-overlay">
                                        <a href="#" class="product-link product-link--view"><i class="fa fa-folder-open"></i>
                                            View</a>
                                        <a href="#" class="product-link product-link--cart"><i class="fa fa-cart-plus"></i>
                                            Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product__cont">
                                    <div class="product-title"><a href="#">The Air Tide</a></div>
                                    <div class="product-price">$15.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product__box">
                                <div class="product__thumbnail square">
                                    <img class="product-img" src="images/albumcover/album4-1-300x300.jpg" alt="">
                                    <div class="product-overlay">
                                        <a href="#" class="product-link product-link--view"><i class="fa fa-folder-open"></i>
                                            View</a>
                                        <a href="#" class="product-link product-link--cart"><i class="fa fa-cart-plus"></i>
                                            Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product__cont">
                                    <div class="product-title"><a href="#">La lalacious</a></div>
                                    <div class="product-price">$6.15</div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product__box">
                                <div class="product__thumbnail square">
                                    <div class="product-notice">Sale!</div>
                                    <img class="product-img" src="images/albumcover/album3-1-300x300.jpg" alt="">
                                    <div class="product-overlay">
                                        <a href="#" class="product-link product-link--view"><i class="fa fa-folder-open"></i>
                                            View</a>
                                        <a href="#" class="product-link product-link--cart"><i class="fa fa-cart-plus"></i>
                                            Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product__cont">
                                    <div class="product-title"><a href="#">Behind the light</a></div>
                                    <div class="product-price">$3.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product__box">
                                <div class="product__thumbnail square">
                                    <img class="product-img" src="images/albumcover/album2-1-300x300.jpg" alt="">
                                    <div class="product-overlay">
                                        <a href="#" class="product-link product-link--view"><i class="fa fa-folder-open"></i>
                                            View</a>
                                        <a href="#" class="product-link product-link--cart"><i class="fa fa-cart-plus"></i>
                                            Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product__cont">
                                    <div class="product-title"><a href="#">Live in Texas</a></div>
                                    <div class="product-price">$12.25</div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product__box">
                                <div class="product__thumbnail square">
                                    <div class="product-notice product-notice--slanted">Sale!</div>
                                    <img class="product-img" src="images/albumcover/album1-1-300x300.jpg" alt="">
                                    <div class="product-overlay">
                                        <a href="cd-single.php" class="product-link product-link--view"><i class="fa fa-folder-open"></i>
                                            View</a>
                                        <a href="#" class="product-link product-link--cart"><i class="fa fa-cart-plus"></i>
                                            Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product__cont">
                                    <div class="product-title"><a href="#">Living Things</a></div>
                                    <div class="product-price">$7.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection