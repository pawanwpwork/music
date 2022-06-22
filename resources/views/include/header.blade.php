<header class="header">
    <div class="container">
        <div class="row header__row">
            <div class="header__logo col-lg-2 col-6">
                @php $siteSetting = siteSetting(); @endphp
                <a href="{{ route('home') }}">
                <div class="logo">
                    <img src="{{asset('assets/images/music-logo.jpg')}}">
                </div>
                <h1>{{ (isset($siteSetting->title) ? ($siteSetting->title) : 'All Music All Artist') }}</h1>
                </a>
            </div>
            <div class="header__nav col-lg-8 col-4">
                <div class="navigation__wrap">
                    <div class="navigation">
                        @if(Auth::guard('member')->check() && getMemberShipPayment( Auth::guard('member')->user()->id ) )
                        @include('frontend.site-menu.member-menu')
                        @else
                        @include('frontend.site-menu.guest-menu')
                        @endif
                        <div class="accounthead app-md">
                            <ul>
                                @if(Auth::guard('member')->check())
                                <li class="accounthead-signup"><a href="{{route('frontend.member.dashboard')}}" title="My Account">Profile</a></li>
                                @else
                                <li class="accounthead-signup"><a href="{{ route('signUp') }}">Signup</a></li>
                                <li class="accounthead-login"><a href="{{ route('music.login') }}">Login</a></li>
                                 @endif
                            </ul>
                        </div>
                    </div>
                    <span class="navicon-button x nav-toggle app-md">
                        <div class="navicon"></div>
                    </span>
                </div>
            </div>
            <div class="header__side col-lg-2 col-2">
                <div class="accounthead">
                    <ul>
                        @if(Auth::guard('member')->check())

                          <li class="accounthead-profile">
                          <ul class="navul">
                              <li class="accounthead-profile has-submenu">
                                <a href="{{route('frontend.member.dashboard')}}" title="Profile">Profile</a>
                                <ul>
                                  <li><a href="{{route('frontend.member.dashboard')}}" title="My Account">My Account</a></li>
                                   <li><a href="{{route('frontend.account.order')}}" title="Order History">Order History</a></li>
                                  <li><a href="{{ route('music.logout') }}" title="Logout">Logout</a></li>
                                </ul>
                              </li>
                          </ul>
                        </li>
                        @else
                        <li class="accounthead-signup dis-md" title="Signup"><a href="{{ route('signUp') }}">Signup</a></li>
                        <li class="accounthead-login dis-md" title="Login"><a href="{{ route('music.login') }}">Login</a></li>
                        @endif
                        
                        @if(auth()->guard('member')->user())
                        @php 
                            $headerCartItems =  getCartByMemberId(auth()->guard('member')->user()->id); 
                            $cartTotal  = 0;
                        @endphp
                        <li class="cart">
                            
                            <a href="#">
                                <span class="cart__items-count">{{count($headerCartItems)}}</span>
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            
                            <div class="cart__items">
                                <div class="cart__items-content">
                                    <ul class="cart__items-list">
                                        @if(isset($headerCartItems) && count($headerCartItems))
                                        @foreach($headerCartItems as $cart)
                                            @php 
                                                $itemsByType = itemByTypeHelper($cart);
                                                $cartTotal = $cartTotal + $itemsByType['total'];
                                            @endphp
                                        <li>
                                            <a href="{{$itemsByType['item_url']}}">
                                                <span class="cart__items-img"><img src="{{$itemsByType['image']}}"
                                                        alt=""></span>
                                                <span class="cart__items-name">{{$itemsByType['product_name']}}</span>
                                                <span class="cart__items-quantity">{{$itemsByType['quantity']}} <span class="cart__items-amount"><span class="cart__items-currency">$</span>{{$itemsByType['total']}}</span></span>

                                            </a>
                                            <span class="cart__items-remove"><i class="fa fa-times"></i></span>
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="cart__items-empty">
                                            <p>No products in the cart.</p>
                                        </li>
                                        @endif
                                    </ul>
                                    @if(isset($headerCartItems) && count($headerCartItems))
                                    <div class="cart__items-subtotal">
                                        <span class="cart__items-subtotal--title">Subtotal:</span>
                                        <span class="cart__items-subtotal--amount"> <span
                                                class="cart__items-currency">$</span>{{$cartTotal}}</span>
                                    </div>
                                    <div class="cart__items-link">
                                        <a href="{{route('frontend.cart')}}">View Cart <i class="fa fa-angle-right"></i></a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>