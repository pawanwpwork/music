

<div id="carousel1" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
    @forelse($sliderImages as $key => $image)
        <div class="carousel-item @if($key == 0) active @endif">
            <img src="{{(isset($image->image) ? route('admin.slider-image.storage',$image->id) : asset('assets/images/bg1-1.png'))}}" alt="">
        </div>
    @empty
        <div class="carousel-item active">
            <img src="{{asset('assets/images/bg1-1.png')}}" alt="">
        </div>
        <div class="carousel-item">
            <img src="{{asset('assets/images/bg2-1.png')}}" alt="">
        </div>
        <div class="carousel-item">
            <img src="{{asset('assets/images/bg3-1.png')}}" alt="">
        </div>
    @endforelse
    </div>
</div>