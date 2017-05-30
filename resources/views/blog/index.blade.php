@extends('layout')

@section('content')
    @include('blog.partials.header')
    <section class="post">
        <div class="container">
            <h3 class="title"><span>{!! $meta->getMeta('post_title') !!}</span></h3>
            <div class="row">
                @foreach($posts as $item)
                    <div class="col-sm-4">
                        <div class="post_block">
                            <div class="post_block_head"
                                 style="background: url({{str_replace('\\','/', $item->image)}})no-repeat center center;background-size: cover;"></div>
                            <div class="post_block_body">
                                <h3>{!! str_limit($item->title,$limit=50,$end='..') !!}</h3>
                                <span>{{$item->author}}</span>
                                <span> {{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</span>
                                <p>
                                    {!! str_limit($item->body,$limit=170,$end='..') !!}
                                </p>

                                <a href="{{route('blog_single',['id'=>$item->id,'title'=>str_slug($item->title)])}}">{!! $meta->getMeta('post_all') !!}<img src="/assets/images/icon/arrow_4.png"
                                                  alt=""></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection