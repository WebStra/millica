<div class="container">
    <ul class="products_nav">
        <li class="active">
            <a href="#1a" data-toggle="tab">{!! $meta->getMeta('prod_detail_about') !!}</a>
        </li>
        <li><a href="#2a" data-toggle="tab">{!! $meta->getMeta('prod_detail_review') !!} (<span class="fb-comments-count" data-href="{{\Request::url()}}"></span>)</a>
        </li>
        <li><a href="#3a" data-toggle="tab">{!! $meta->getMeta('prod_detail_livrare') !!}</a>
        </li>
    </ul>
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a">
            <p>{!! $product->body !!}</p>
        </div>
        <div class="tab-pane" id="2a">
            @include('partials.comments',['url'=>\Request::url()])
        </div>
        <div class="tab-pane" id="3a">
            <p>{!! $product->delivery !!}</p>
        </div>
    </div>
</div>