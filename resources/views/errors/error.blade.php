@extends('layouts.page')

@section('body')
    <div class="flex justify-center max-w-5xl min-h-screen pb-16 mx-auto" style="padding: 50px 10px">
        <div class="leading-none text-center text-black md:text-left">
            <h1 class="mb-2 text-5xl font-extrabold">{{ $errorCode }}</h1>
            <p class="text-xl text-gray-900">
                @isset($title)
                    {{ $title }}
                @else
                    {{__('errors.error_404')}}
                @endisset

                @if($homeLink ?? false)
                    <a href="{{ url('/') }}"
                       class="font-bold underline transition duration-300 hover:text-blue-600">{{__('errors.go_home')}}</a>
                @endif
            </p>
        </div>
    </div>
@endsection
