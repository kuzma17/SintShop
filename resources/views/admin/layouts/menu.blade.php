<div class="menu">

    <ul>
        <li class="menu-item">
            <a href="{{route('admin.categories.index')}}">
                <i class="fa-solid fa-bars"></i> Категории
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.goods.index')}}">
                <i class="fa-solid fa-cubes"></i> Продукты
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.attributes.index')}}">
                <i class="fa-regular fa-rectangle-list"></i> Атрибуты
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.orders.index')}}">
                <i class="fa-solid fa-cart-plus"></i> Заказы &nbsp; <x-admin.new-orders-badge></x-admin.new-orders-badge>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.clients.index')}}">
                <i class="fa-solid fa-user-group"></i> Клиенты &nbsp; <x-admin.new-users-badge></x-admin.new-users-badge>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.pages.index')}}">
                <i class="fa-regular fa-file-lines"></i> Страницы
            </a>
        </li>
{{--        <li class="menu-item">--}}
{{--            <a href="{{route('admin.settings.index')}}">--}}
{{--                <i class="fa-solid fa-gear"></i> Параметры--}}
{{--            </a>--}}
{{--        </li>--}}

        @can('admin')
        <li class="menu-item">
            <a href="{{route('admin.users.index')}}">
                <i class="fa-solid fa-user"></i> Пользователи
            </a>
        </li>
        @endcan
    </ul>
</div>
