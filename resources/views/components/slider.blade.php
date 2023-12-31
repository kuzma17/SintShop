<div class="slider">
    <div id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($sliders as $slider)
                <button type="button" data-bs-target="#cslide" data-bs-slide-to="{{ $loop->index }}"  @if($loop->first) class="active" @endif></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($sliders as $slider)
                <div class="carousel-item @if($loop->first) active @endif">
                    <a href="">
                        <img src="/images/{{$slider.'_'.$locale}}.jpg" class="d-block w-100" alt="...">
                    </a>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
</div>
