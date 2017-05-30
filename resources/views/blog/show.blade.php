@extends('layout')

@section('content')
    @include('blog.partials.header')
    <section class="blog_open">
        <div class="container">
            <h3 class="title"><span>{!! $post->title !!}</span></h3>
            <div class="blog_open_title">
                <span>postat de: {{$post->author}}</span>
                <span>{{\Carbon\Carbon::parse($post->creadted_at)->format('d.m.Y')}}</span>
            </div>
            <div class="blog_open_img"
                 style="background: url({{str_replace('\\','/', $post->image)}})no-repeat center center; background-size: cover;"></div>
            <div class="blog_open_text">
                {!! $post->body !!}
            </div>
            @include('partials.share')

            @include('partials.comments',['url'=>\Request::url()])
            {{----}}
            {{--<div class="previous_articles">--}}
                {{--<a href=""><img src="/assets/images/icon/arrow_left.png" alt="">{!! $meta->getMeta('blog_last') !!}</a>--}}
            {{--</div>--}}
        </div>
    </section>

    @include('blog.partials.related')
@endsection