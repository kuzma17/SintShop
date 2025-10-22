@extends('layouts.app')
@php($model = $page)

@section('content')
    <x-slider></x-slider>
    <div class="container">
        <x-categories></x-categories>
        <br>
        <div class="content-text">
            <h2>{{$page->name}}</h2>
            {!! $page->content !!}
        </div>

        <x-new-products></x-new-products>
    </div>
    <br>
    <br>
    {{--Map  --}}
    <div class="map" >
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2749.5715034842556!2d30.72722550262451!3d46.43737208134875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c633bcf388a7a1%3A0xb057ec8d9af7469d!2z0KHQmNCd0KIt0JzQkNCh0KLQldCgINCc0KfQnw!5e0!3m2!1sru!2sua!4v1692978755359!5m2!1sru!2sua" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
