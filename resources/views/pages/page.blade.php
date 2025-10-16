@extends('layouts.page')

@php($seo = $page)

@section('link', Breadcrumbs::render('page', $page))
@section('name_page', $page->name)
@section('body')
    <div class="content-text">
        {!! $page->content !!}
    </div>
@endsection
