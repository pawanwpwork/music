<ul class="navul">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="has-submenu">
        <a href="{{ route('about') }}">About Us</a>
        <ul>
            <li><a href="{{route('page.detail',['alias' => 'faq'])}}">FAQ</a></li>
              <li><a href="{{route('page.detail',['alias' => 'disclaimer'])}}">Disclaimer</a></li>
            <li><a href="{{route('page.detail',['alias' => 'term-and-conditions'])}}">Term and Conditions</a></li>
        </ul>
    </li>
    @if($memberAccess->post_event == 1 || $memberAccess->view_event == 1)
    <li class="has-submenu"><a href="{{ route('event.view') }}">Events</a>
        <ul>
           
            @if($memberAccess->view_event == 1)
                <li><a href="{{ route('event.view') }}">View Event</a></li>
            @endif

             @if($memberAccess->post_event == 1)
                <li><a href="{{ route('event.post') }}">Post Event</a></li>
            @endif

        </ul>
    </li>
    @endif
    @if($memberAccess->request_to_book_band == 1)
    <li><a href="{{ route('book-band.post') }}">Book a Band/DJ</a></li>
    @endif
    @if($memberAccess->view_classified == 1 || $memberAccess->post_classified == 1)
    <li class="has-submenu"><a href="{{ route('classified.buy') }}">Classified</a>
        <ul>
            @if($memberAccess->view_classified == 1)
            <li><a href="{{ route('product.classified.category',['alias'=>'classified-equipment'] ) }}">Classified > Classified Equipment</a></li>
            <li><a href="{{ route('product.classified.category',['alias'=>'classified-misc'] ) }}">Classified > Classified Misc</a></li>
            <li><a href="{{ route('product.classified.category',['alias'=>'classified-services'] ) }}">Classified  > Classified Services</a></li>
            <!-- <li><a href="{{ route('classified.buy') }}">view</a></li> -->
            @endif
            
            @if($memberAccess->post_classified == 1)
                <li><a href="{{ route('classified.sell') }}">Post Your Classified</a></li>
            @endif
        </ul>
    </li>
    @endif
    @if($memberAccess->cd_store == 1 || $memberAccess->cd_sell == 1)
    <li class="has-submenu"><a href="{{ route('cd.store') }}">Cd STORE</a>
        <ul>
            @if($memberAccess->cd_store == 1)
            <li>
                <a href="{{ route('cd.store') }}">Cd Store</a>
            </li>
            @endif
            @if($memberAccess->cd_sell == 1)
            <li class="has-submenu">
                <a href="{{ route('cd.sell') }}">Sell Your Cd</a>
                <!-- <ul>
                    <li><a href="{{route('page.detail',['alias' => 'we-stock-and-sell-your-cd'])}}">CONSIGNMENT AGREEMENT</a></li>
                </ul> -->
            </li>
            @endif
        </ul>
    </li>
    @endif

    @if($memberAccess->musian_search == 1)
    <li><a href="{{ route('musician.search') }}">Musician Search</a></li>
    @endif
    
    @if($memberAccess->radio_listen == 1 || $memberAccess->radio_submit == 1)
    <li class="has-submenu">
        <a href="{{route('radio.listen')}}" target="_blank">Listen to Music</a>
        <ul>
            
            @if($memberAccess->radio_submit == 1)
                <li><a href="{{route('frontend.song.form')}}">Submit a Song</a></li>
            @endif

            @if($memberAccess->radio_listen == 1)
                <li><a href="{{route('radio.listen')}}">Listen to Music</a> </li>
            @endif

        </ul>
    </li>
    @endif
    @if($memberAccess->contact_us == 1)
        <li>
            <a href="{{ route('contact') }}">Contact Us</a>
           <!--  <ul>
              
                <li><a href="{{route('page.detail',['alias' => 'term-and-conditions'])}}">Term and Conditions</a></li>
            </ul> -->
        </li>
    @endif
</ul>