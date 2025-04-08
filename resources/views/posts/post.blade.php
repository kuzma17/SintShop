@extends('layouts.post')

@section('title', $post->title)
@section('keywords', $post->keywords)
@section('description', $post->description)

@section('link', Breadcrumbs::render('post', $post))
@section('name_post', $post->name)
@section('body')
<div class="post">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($post->callback || $post->image)
            <div class="" style="width: 400px; float: right; margin: 0 0 15px 0; padding: 0 15px 15px 15px">
                @if($post->callback) @include('layouts.callback') @endif
                @if($post->image) <img style="width: 100%; height: auto" src="{{asset('/images/posts/'.$post->image)}}"></span> @endif
            </div>
    @endif
        {!! $post->content !!}
</div>
    <div class="clearfix"></div>
@endsection
