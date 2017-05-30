<section class="related_articles">
    <div class="container">
        <h3>{!! $meta->getMeta('related_articles') !!}</h3>
        <div class="row">
            @foreach($related as $item)
                <div class="col-sm-4">
                    <div class="post_block">
                        <div class="post_block_head"
                             style="background: url({{str_replace('\\', '/', $item->image)}})no-repeat center center;background-size: cover;"></div>
                        <div class="post_block_body">
                            <h3>{!! str_limit($item->title,$limit=50,$end='..') !!}</h3>
                            <span>{{$item->author}}</span>
                            <span> {{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</span>
                            <p>
                                {!! str_limit($item->body,$limit=170,$end='..') !!}
                            </p>
                            <a href="{{route('blog_single',['id'=>$item->id,'title'=>str_slug($item->title)])}}">{!! $meta->getMeta('related_articles_all') !!}<img src="/assets/images/icon/arrow_4.png" alt=""></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>