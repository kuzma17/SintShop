<div class="filter">
    <form name="filter" method="GET" action="{{route('admin.clients.index')}}">
        <div class="row">
            <div class="col-auto" >
                <i class="fa-solid fa-filter"></i> Фильтр
            </div>
            <div class="col-1">
                <input type="text" name="id" value="{{request('id')}}" class="form-control form-control-sm" placeholder="id">
            </div>
            <div class="col-2">
                <input type="text" name="name" value="{{request('name')}}" class="form-control form-control-sm" placeholder="Имя">
            </div>
            <div class="col-2">
                <input-phone
                    name="user_phone"
                    placeholder="Телефон клиента"
                    class="form-control-sm"
                    model-value="{{request('user_phone')}}"
                ></input-phone>
            </div>
            <div class="col">
                <select name="created_at" class="form-control form-control-sm">
                    <option value="">Период</option>
                    <option value="today" @selected(request('created_at') == 'today')>Сегодня</option>
                    <option value="day_7" @selected(request('created_at') == 'day_7')>7 дней</option>
                    <option value="day_14" @selected(request('created_at') == 'day_14')>14 дней</option>
                    <option value="month_1" @selected(request('created_at') == 'month_1')>Месяц</option>
                    <option value="month_3" @selected(request('created_at') == 'month_3')>3 месяца</option>
                    <option value="month_6" @selected(request('created_at') == 'month_6')>6 месяцев</option>
                    <option value="month_12" @selected(request('created_at') == 'month_12')>12 месяцев</option>
                    <option value="all" @selected(request('created_at') == 'all')>За все время</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-blue">Применить</button>
            </div>
            <div class="col-auto">
                <a href="{{route('admin.clients.index')}}">
                    <span class="btn btn-sm btn-secondary">Reset</span>
                </a>
            </div>
        </div>
    </form>
</div>
