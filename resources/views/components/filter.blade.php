<div>
    <filter-goods
            :attributes="{{json_encode($filters)}}"
            :selected="{{json_encode($selected)}}"
            :min_price="{{$min_price}}"
            :max_price="{{$max_price}}"
    ></filter-goods>
</div>