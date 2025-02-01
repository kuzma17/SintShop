<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-4 col-md-3">
                <h5>@lang('menu.navigation')</h5>
                <ul>
                    <li><a href="{{route('home')}}">@lang('menu.main')</a></li>
                    <li><a href="{{route('page', 'about')}}">@lang('menu.about')</a></li>
                    <li><a href="{{route('page', 'payment-delivery')}}">@lang('menu.payment_delivery')</a></li>
                    <li><a href="{{route('page', 'contacts')}}">@lang('menu.contacts')</a></li>
                    <li><a href="">@lang('menu.sale')</a></li>
                    <li><a href="">@lang('menu.stock')</a></li>
{{--                    <li><a href="">@lang('menu.login')</a></li>--}}
                </ul>
            </div>
            <div class="col-4 col-md-3">
                <h5>@lang('menu.categories')</h5>
                <ul>
                    <li><a href="{{route('catalog', 'computers')}}">@lang('menu.computers')</a></li>
                    <li><a href="{{route('catalog', 'monitors')}}">@lang('menu.monitors')</a></li>
                    <li><a href="{{route('catalog', 'notepads')}}">@lang('menu.notepads')</a></li>
                    <li><a href="{{route('catalog', 'printers')}}">@lang('menu.printers')</a></li>
                    <li><a href="{{route('catalog', 'mfu')}}">@lang('menu.mfu')</a></li>
                    <li><a href="{{route('catalog', 'laser-cartridges')}}">@lang('menu.cartridges_laser')</a></li>
                    <li><a href="{{route('catalog', 'jet-cartridges')}}">@lang('menu.cartridges_jet')</a></li>
                </ul>
            </div>
            <div class="col-4 col-md-3">
                <h5>@lang('menu.services')</h5>
                <ul>
                    <li><a href="{{route('page', 'repair')}}">@lang('menu.repair')</a></li>
                    <li><a href="{{route('page', 'replacing-cartridges')}}">@lang('menu.replacing_cartridges')</a></li>
                    <li><a href="{{route('page', 'delivery')}}">@lang('menu.delivery')</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3">
                <x-contacts></x-contacts>
                <x-social></x-social>
            </div>
        </div>
        <div class="copyright">
            Copyright 2023 @ Designed by <a href="mailto:webkuzma@gmail.com">Kuzma</a>
        </div>
        <div id="top-scroll" class="top-scroll">
            <a href="#" title="вверх"><span class="fas fa-angle-up"></span></a>
        </div>
    </div>
</div>
