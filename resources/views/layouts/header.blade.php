<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-4 col-md-4">
                <div class="row">
                    <div class="col-12 col-md-3 p-0">
                        <div class="logo">
                            <a href="{{route('home')}}">
                                <img src="{{asset('/images/logo_santa.jpg')}}" alt="{{__('seo.site_title')}}">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 phone-block">
                        <x-Offices></x-Offices>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-8 col-md-4">
                        <div class="clock">
                            <svg class="icon">
                                <use xlink:href="#fa-clock"></use>
                            </svg>
                            <span class="time-work_text">@lang('main.we_working'): </span><span>9.00 - 18.00</span>
                        </div>
                    </div>
                    <div class="col-7 col-md-7 p-0 top-menu">
                        <x-top-menu></x-top-menu>
                    </div>
                    <div class="col-4 col-md-1 p-0">
                        <x-language-swicher></x-language-swicher>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 search_block">
                        <x-search></x-search>
                    </div>
                    <div class="col-8 col-md-2 p-0">
                        <x-social></x-social>
                    </div>
                    <div class="col-4 col-md-1">
                        <x-cart-icon></x-cart-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="phone-block_mobile">
            <x-Offices></x-Offices>
        </div>
        <div class="search_block-mobile">
            <x-search></x-search>
        </div>
    </div>
    <x-main-menu></x-main-menu>

</div>
