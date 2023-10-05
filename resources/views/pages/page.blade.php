@extends('layouts.page')

{{--@section('link', Breadcrumbs::render('cart'))--}}

@section('title', $page->title)

@section('body')
    {!! $page->content !!}
@endsection
