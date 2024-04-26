@extends('layouts.page')

@section('title', $page->title)
@section('keywords', $page->keywords)
@section('description', $page->description)

@section('link', Breadcrumbs::render('page', $page))
@section('name_page', $page->name)
@section('body')
    <div class="page">
        {!! $page->content !!}
    </div>
@endsection
