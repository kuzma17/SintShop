@extends('layouts.app')

@section('content')
    <x-slider></x-slider>
    <div class="container">
        <x-categories></x-categories>
        <br>
{{--        <div class="">--}}
{{--            <h3>@lang('home.repair_equipment')</h3>--}}
{{--            <h5>@lang('home.repair_office_equipment')</h5>--}}
{{--            <p>--}}
{{--                <a href="{{route('page', 'repair_mfp')}}">@lang('home.repair_mfp')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_laptops')}}">@lang('home.repair_laptops')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_printers')}}">@lang('home.repair_printers')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_computers')}}">@lang('home.repair_computers')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_scanners')}}">@lang('home.repair_scanners')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'epair_replacement_cartridges')}}">@lang('home.epair_replacement_cartridges')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_plotters')}}">@lang('home.repair_plotters')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_ups')}}">@lang('home.repair_ups')</a>--}}
{{--            </p>--}}

{{--            <h5>@lang('home.repair_home_appliance')</h5>--}}

{{--            <p>--}}
{{--                <a href="{{route('page', 'repair_tv-sets')}}">@lang('home.repair_tv-sets')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_microwave_oven')}}">@lang('home.repair_microwave_oven')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_small_appliance')}}">@lang('home.repair_small_appliance')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_multicookers')}}">@lang('home.repair_multicookers')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_robot_vacuums')}}">@lang('home.repair_robot_vacuums')</a> &nbsp;--}}
{{--                <a href="{{route('page', 'repair_food_processors')}}">@lang('home.repair_food_processors')</a>--}}
{{--            </p>--}}

{{--        </div>--}}
        <div class="">
            <h1>{{$text->name}}</h1>
            {!! $text->content !!}
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
