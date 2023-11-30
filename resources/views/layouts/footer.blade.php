<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-4 col-md-3">
                <h5>@lang('menu.navigation')</h5>
                <ul>
                    <li><a href="">@lang('menu.main')</a></li>
                    <li><a href="{{route('page', 'about')}}">@lang('menu.about')</a></li>
                    <li><a href="">@lang('menu.payment_delivery')</a></li>
                    <li><a href="">@lang('menu.contacts')</a></li>
                    <li><a href="">@lang('menu.sale')</a></li>
                    <li><a href="">@lang('menu.stock')</a></li>
                    <li><a href="">@lang('menu.login')</a></li>
                </ul>
            </div>
            <div class="col-4 col-md-3">
                <h5>@lang('menu.categories')</h5>
                <ul>
                    <li><a href="{{route('catalog', ['computers', 1])}}">@lang('menu.computers')</a></li>
                    <li><a href="{{route('catalog', ['monitors', 2])}}">@lang('menu.monitors')</a></li>
                    <li><a href="{{route('catalog', ['notepads', 3])}}">@lang('menu.notepads')</a></li>
                    <li><a href="{{route('catalog', ['printers', 4])}}">@lang('menu.printers')</a></li>
                    <li><a href="{{route('catalog', ['mfu', 5])}}">@lang('menu.mfu')</a></li>
                    <li><a href="{{route('catalog', ['laser-cartridges', 6])}}">@lang('menu.cartridges_laser')</a></li>
                    <li><a href="{{route('catalog', ['jet-cartridges', 7])}}">@lang('menu.cartridges_jet')</a></li>
                </ul>
            </div>
            <div class="col-4 col-md-3">
                <h5>@lang('menu.services')</h5>
                <ul>
                    <li><a href="">@lang('menu.repair')</a></li>
                    <li><a href="">@lang('menu.replacing_cartridges')</a></li>
                    <li><a href="">@lang('menu.delivery')</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3">
                <x-contacts></x-contacts>
                <x-social></x-social>
            </div>
        </div>
        <div class="copyright">
            Copyright 2023 @ Designed by <a href="mailto:v.kuzma@mail.ru">Kuzma</a>
        </div>
        <div id="top-scroll" class="top-scroll">
            <a href="#" title="вверх"><span class="fas fa-angle-up"></span></a>
        </div>
    </div>
</div>
