<div class="filter">
    <form name="filter" method="GET" action="{{route('admin.attributes.index')}}">
        <div class="row">
            <div class="col-auto" >
                <i class="fa-solid fa-filter"></i> Фильтр
            </div>
            <div class="col-1">
                <input type="text" name="id" value="{{request('id')}}" class="form-control form-control-sm" placeholder="id">
            </div>
            <div class="col-2">
                <input type="text" name="attribute" value="{{request('attribute')}}" class="form-control form-control-sm" placeholder="Имя">
            </div>
            <div class="col">
                <select name="type" class="form-control form-control-sm">
                    <option value="">Тип</option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}" @selected(request('category') == $type->id)>{{$type->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="category" class="form-control form-control-sm">
                    <option value="">Категория</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @selected(request('category') == $category->id)>{{$category->title_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-blue">Применить</button>
            </div>
            <div class="col-auto">
                <a href="{{route('admin.attributes.index')}}">
                    <span class="btn btn-sm btn-secondary">Reset</span>
                </a>
            </div>
        </div>
    </form>
</div>
