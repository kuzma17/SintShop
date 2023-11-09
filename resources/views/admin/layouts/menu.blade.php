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
            <a href="{{route('admin.orders.index')}}">
                <i class="fa-solid fa-cart-plus"></i> Заказы &nbsp; <x-admin.new-orders-badge></x-admin.new-orders-badge>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.clients.index')}}">
                <i class="fa-solid fa-user-group"></i> Клиенты &nbsp; <x-admin.new-users-badge></x-admin.new-users-badge>
            </a>
        </li>
    </ul>
</div>
