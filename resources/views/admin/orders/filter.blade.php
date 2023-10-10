<div class="filter">
    <form name="filter" method="GET" action="{{route('admin.orders.index')}}">
        <div class="row">
            <div class="col-auto" >
                <i class="fa-solid fa-filter"></i> Фильтр
            </div>
            <div class="col-1">
                <input type="text" name="id" value="{{request('id')}}" class="form-control form-control-sm" placeholder="id">
            </div>
            <div class="col-2">
{{--                <input type="text" name="user" value="{{request('user')}}" class="form-control form-control-sm" placeholder="клиент">--}}
                <input-phone
                    name="phone"
                    placeholder="Телефон клиента"
                    class="form-control-sm"
                ></input-phone>
            </div>
            <div class="col">
                <select name="created_at" class="form-control form-control-sm">
                    <option value="">Период</option>
                    <option value="today">Сегодня</option>
                    <option value="day_7">7 дней</option>
                    <option value="day_14">14 дней</option>
                    <option value="month_1">Месяц</option>
                    <option value="month_3">3 месяца</option>
                    <option value="month_6">6 месяцев</option>
                    <option value="month_12">12 месяцев</option>
                    <option value="all">За все время</option>

                </select>
            </div>
            <div class="col">
                <select name="status" class="form-control form-control-sm">
                    <option value="">Статус</option>
                    @php($statuses = \App\Models\Status::active()->sort()->get())
                    @foreach($statuses as $status)
                        <option value="{{$status->id}}">{{$status->title_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-blue">Применить</button>
            </div>
            <div class="col-auto">
                <a href="{{route('admin.orders.index')}}">
                    <span class="btn btn-sm btn-secondary">Reset</span>
                </a>
            </div>
        </div>
    </form>
</div>
