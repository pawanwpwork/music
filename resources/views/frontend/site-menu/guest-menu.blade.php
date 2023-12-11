<ul class="navul">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="has-submenu">
        <a href="{{ route('about') }}">About Us</a>
        <ul>
            <li><a href="{{route('page.detail',['alias' => 'faq'])}}">FAQ</a></li>
             <li><a href="{{route('page.detail',['alias' => 'disclaimer'])}}">Disclaimer</a></li>
            <li><a href="{{route('page.detail',['alias' => 'term-and-conditions'])}}">Term and Conditions</a></li>
            <li><a href="{{route('page.detail',['alias' => 'privacy-policy'])}}">Privacy & Policy</a></li>
        </ul>
    </li>
    <li class="has-submenu"><a href="{{ route('event.view') }}">Events</a>
        <ul>
            <li><a href="{{ route('event.view') }}">View Event</a></li>
        </ul>
    </li>
    <li class="has-submenu"><a href="{{ route('classified.buy') }}">Classified</a>
        <ul>
            <li><a href="{{ route('product.classified.category',['alias'=>'classified-equipment'] ) }}">Classified > Classified Equipment</a></li>
            <li><a href="{{ route('product.classified.category',['alias'=>'classified-misc'] ) }}">Classified > Classified Misc</a></li>
            <li><a href="{{ route('product.classified.category',['alias'=>'classified-services'] ) }}">Classified  > Classified Services</a></li>
        </ul>
    </li>

    <li><a href="{{ route('cd.store') }}">Cd Store</a></li>

    <li class="has-submenu">
        <a href="{{route('radio.listen')}}" target="_blank">Radio</a>
        <ul>
            <li><a href="{{route('radio.listen')}}" >Listen to Music</a></li>
        </ul>
    </li>
    <li>
        <a href="{{ route('contact') }}">Contact Us</a>
    </li>
</ul>