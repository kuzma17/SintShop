<div class="top-menu">
    <ul class="nav ">
        <li><a href="{{route('page', 'about')}}">@lang('menu.about')</a></li>
        <li><a href="#">@lang('menu.payment_delivery')</a></li>
        <li><a href="#">@lang('menu.contacts')</a></li>
        <li><login
            auth_user="{{auth()->check()}}"
            ></login>
        </li>
    </ul>
</div>
