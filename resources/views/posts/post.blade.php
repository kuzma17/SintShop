@extends('layouts.post')

{{--@section('title', $post->title ?? '')--}}
{{--@section('keywords', $post->keywords ?? '')--}}
{{--@section('description', $post->description ?? '')--}}

@php($seo = $post)

@section('link', Breadcrumbs::render('post', $post))
@section('name_post', $post->name)
@section('body')
<div class="post">
    @if($post->image)
            <div class="" style="width: 400px; float: right; padding: 0 0 10px 10px">
                @if($post->image) <img style="width: 100%; height: auto" src="{{asset('/images/posts/'.$post->image)}}"></span> @endif
            </div>
    @endif
        <div class="content-text">
            {!! $post->content !!}
        </div>
</div>
    <div class="clearfix"></div>
@endsection
