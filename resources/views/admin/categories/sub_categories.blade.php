@foreach($categories as $category)
    <div class="row cat_item" style="margin-left: {{$margin_left}}px">
        <div class="col-1">{{$category->id}}</div>
        <div class="col" >{{$category->name_ru}}</div>
        <div class="col">@if($category->image) <img src="/images/{{$category->image}}"> @endif</div>
        <div class="col">{{$category->sort}}</div>
        <div class="col">
            <x-admin.active
                    :status="$category->active"
            ></x-admin.active>
        </div>
        <div class="col">
            <a href="{{route('admin.categories.edit', $category->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>
            <form name="destroy_good" method="POST" style="margin: -30px 0 0 20px" action="{{route('admin.categories.destroy', $category->id)}}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-link" style="color: red" title="Удалить" onclick="return confirm('Вы уверены что хотите удалить объект?')">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </form>
        </div>
    </div>
        @if($category->children->isNotEmpty())
            @include('admin.categories.sub_categories', ['categories' => $category->children, 'margin_left' => (int)$margin_left + 20])
        @endif

@endforeach
