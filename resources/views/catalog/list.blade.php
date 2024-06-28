@foreach($goods as $good)
    <x-card-good
            :good=$good
    ></x-card-good>
@endforeach
<div>
    {{$goods->links()}}
</div>