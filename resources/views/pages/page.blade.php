@extends('layouts.page')

@section('link', Breadcrumbs::render('page', $page))
@section('title', $page->title)
@section('body')
    <div class="page">
        {!! $page->content !!}
    </div>
@endsection
