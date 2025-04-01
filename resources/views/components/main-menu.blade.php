<div class="menu">
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> @lang('main.menu')
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('menu.computer_tech')
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('catalog', 'computers')}}">@lang('menu.computers')</a></li>
                                <li><a class="dropdown-item" href="{{route('catalog', 'monitors')}}">@lang('menu.monitors')</a></li>
                                <li><a class="dropdown-item" href="{{route('catalog', 'notepads')}}">@lang('menu.notepads')</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('menu.print_tech')
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('catalog', 'printers')}}">@lang('menu.printers')</a></li>
                                <li><a class="dropdown-item" href="{{route('catalog', 'mfu')}}">@lang('menu.mfu')</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('menu.cartridges')
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('catalog', 'laser-cartridges')}}">@lang('menu.laser')</a></li>
                                <li><a class="dropdown-item" href="{{route('catalog', 'jet-cartridges')}}">@lang('menu.jet')</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('catalog', 'sale')}}">
                                @lang('menu.sale')
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('menu.services')
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('page', 'repair')}}">@lang('menu.repair')</a></li>
                                <li><a class="dropdown-item" href="{{route('page', 'replacing-cartridges')}}">@lang('menu.replacing_cartridges')</a></li>
                                <li><a class="dropdown-item" href="{{route('page', 'delivery')}}">@lang('menu.delivery')</a></li>
                            </ul>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#">@lang('menu.sale')</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#">@lang('menu.stock')</a>--}}
{{--                        </li>--}}
                    </ul>
                    <ul class="navbar-nav mobile-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('page', 'about')}}">@lang('menu.about')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('page', 'payment-delivery')}}">@lang('menu.payment_delivery')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('page', 'contacts')}}">@lang('menu.contacts')</a>
                        </li>
                        <li class="nav-item">
                            <login
                                auth_user="{{auth()->check()}}"
                            ></login>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>
