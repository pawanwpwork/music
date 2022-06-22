<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle profile-image-sm" src="{{asset('assets/backend/img/student.png')}}" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </strong>
                            </span>
                            <span class="text-muted text-xs block">Admin <b class="caret"></b></span>
                        </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                       <!--  <li><a href="contact.php">Mailbox</a></li> -->
                        <!-- <li class="divider"></li> -->
                        <li>
                            <a href="{{ route('logout') }}" 
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
                <div class="logo-element">
                    <img alt="image" class="img-circle profile-image-sm" src="img/student.png" />
                </div>
            </li>
            <li>
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="{!! (Request::is(['admin/category*', 'admin/product*', 'admin/song*', 'admin/review*'])? 'active' : '') !!}">
                <a href="#"><i class="fa fa-tags fw"></i> 
                    <span class="nav-label">Catalog</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse {!! (Request::is('admin/category*')? 'in' : '') !!}">
                    <li>
                        <a href="{{route('admin.category.list')}}" class="{!! (Request::is('admin/category*')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Categories</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product.list') }}" class="{!! (Request::is('admin/product/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Products</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.song.list') }}" class="{!! (Request::is('admin/song/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Songs</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.review.list') }}" class="{!! (Request::is('admin/review/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Reviews</span></a>
                    </li>
                </ul>
            </li>

            <li class="{!! (Request::is('admin/band-dj*')? 'active' : '') !!}">
                <a href="#"><i class="fa fa-music"></i> 
                    <span class="nav-label">Band/Dj</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse {!! (Request::is('admin/band-dj*')? 'in' : '') !!}">
                    <li>
                        <a href="{{route('admin.banddjeventtype.list')}}" class="{!! (Request::is('admin/band-dj/event/*')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Types of Event</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.banddjagegroup.list')}}"  class="{!! (Request::is('admin/band-dj/age/*')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Age of Members</span></a>
                    </li>

                     <li>
                        <a href="{{route('admin.banddjbook.list')}}"  class="{!! (Request::is('admin/band-dj/book/*')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Booking Band/Dj</span></a>
                    </li>
                 
                </ul>
            </li>

            <li class="{!! (Request::is('admin/event*')? 'active' : '') !!}">
                <a href="#"><i class="fa fa-calendar"></i> 
                    <span class="nav-label">Events</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse {!! (Request::is('admin/event*')? 'in' : '') !!}">
                    <li>
                        <a href="{{ route('admin.event.list') }}" class="{!! (Request::is('admin/event/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Booking Events</span></a>
                    </li>
                    
                </ul>
            </li>

            <li class="{!! (Request::is('admin/member*')? 'active' : '') !!}">
                <a href="#"><i class="fa fa-user"></i> 
                    <span class="nav-label">Members</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse {!! (Request::is('admin/member*')? 'in' : '') !!}">
                    <li>
                        <a href="{{ route('admin.member.list') }}" class="{!! (Request::is('admin/member/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Members</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.genre.list') }}" class="{!! (Request::is('admin/genre/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Music Genre</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.music-category.list') }}" class="{!! (Request::is('admin/music-category/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Music Category</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.member.restore.list') }}" class="{!! (Request::is('admin/member/restore/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Members Restore</span></a>
                    </li>
                    <!-- <li>
                        <a href="{{ route('admin.member.list') }}" class="{!! (Request::is('admin/member/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Membership Type</span></a>
                    </li> -->
                </ul>
            </li>
            
              <li class="{!! (Request::is(['admin/order*'])? 'active' : '') !!}">
                <a href="#"><i class="fa fa-shopping-cart"></i> 
                    <span class="nav-label">Order</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse {!! (Request::is(['admin/order*'])? 'in' : '') !!}">
                    <li>
                        <a href="{{ route('admin.order.pending') }}" class="{!! (Request::is('admin/order/pending')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Pending</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.order.success') }}" class="{!! (Request::is('admin/order/sucess')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Success</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.order.cancel') }}" class="{!! (Request::is('admin/order/cancel')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Cancel</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{route('admin.service.inquiry')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Service Enquiry</span></a>
            </li>

            <li class="{!! (Request::is(['admin/site-setting*','admin/rate-setting*', 'admin/slider-image*', 'admin/member-setting/list'])? 'active' : '') !!}">
                <a href="#"><i class="fa fa-cog"></i> 
                    <span class="nav-label">Settings</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse {!! (Request::is(['admin/site-setting*', 'admin/slider-image*'])? 'in' : '') !!}">
                    <li>
                        <a href="{{ route('admin.site-setting.create') }}" class="{!! (Request::is('admin/site-setting/create')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Site Identity</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.slider-image.list') }}" class="{!! (Request::is('admin/slider-image/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Slider Image</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.member-setting.list') }}" class="{!! (Request::is('admin/member-setting/list')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Member Setting</span></a>
                    </li>

                    <li>
                        <a href="{{ route('admin.rate-setting.index') }}" class="{!! (Request::is('admin/rate-setting/index')? 'active' : '') !!}"><i class="fa fa-angle-double-right"></i> <span class="nav-label">Rate Setting</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{route('admin.contact.list')}}"><i class="fa fa-book"></i> <span class="nav-label">Contact List</span></a>
            </li>

             <li>
                <a href="{{route('admin.page.list')}}"><i class="fa fa-book"></i> <span class="nav-label">Pages</span></a>
            </li>
        </ul>

    </div>
</nav>