<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="row">
                    <div class="col-12 col-md-auto">
                        <div class="logo">
                            <a href="{{route('home')}}">
                                <img src="/images/logo.png">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="phone">
                            <i class="fa-solid fa-phone"></i> +38 (067) 5576567
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="clock">
                            <i class="fa-regular fa-clock"></i> @lang('main.we_working'): 9.00 - 18.00
                        </div>
                    </div>
                    <div class="col-7 col-md-7 p-0 top-menu">
                        <x-top-menu></x-top-menu>
                    </div>
                    <div class="col-6 col-md-1 p-0">
                        <x-language-swicher></x-language-swicher>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 search_block">
                        <x-search></x-search>
                    </div>
                    <div class="col-6 col-md-2">
                        <x-social></x-social>
                    </div>
                    <div class="col-6 col-md-1">
                        <x-cart-icon></x-cart-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="search_block-mobile">
        <x-search></x-search>
    </div>
    <x-main-menu></x-main-menu>

</div>
