<div class="filter">
    <form name="filter" method="GET" action="{{route('admin.goods.index')}}">
        <div class="row">
            <div class="col-auto" >
                <i class="fa-solid fa-filter"></i> Фильтр
            </div>
            <div class="col-1">
                <input type="text" name="id" value="{{request('id')}}" class="form-control form-control-sm" placeholder="id">
            </div>
            <div class="col">
                <select name="category" class="form-control form-control-sm">
                    <option value="">Категория</option>
                    @php($categories = \App\Models\Category::all())
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @selected(request('category') == $category->id)>{{$category->title_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <input type="text" name="slug" value="{{request('slug')}}" class="form-control form-control-sm" placeholder="slug">
            </div>
            <div class="col-2">
                <input type="text" name="code" value="{{request('code')}}" class="form-control form-control-sm" placeholder="code">
            </div>
            <div class="col">
                <input type="text" name="title" value="{{request('title')}}" class="form-control form-control-sm" placeholder="Наименование">
            </div>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" name="sale" type="checkbox" value="1" id="flexCheckDefault" @checked(request('sale'))>
                    <label class="form-check-label" for="flexCheckDefault">
{{--                        <span class="badge rounded-pill text-bg-warning">SALE</span>--}}
                        <img src="/images/sale.png" class="sale_icon">
                    </label>
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-blue">Применить</button>
            </div>
            <div class="col-auto">
                <a href="{{route('admin.goods.index')}}">
                    <span class="btn btn-sm btn-secondary">Reset</span>
                </a>
            </div>
        </div>
    </form>
</div>
