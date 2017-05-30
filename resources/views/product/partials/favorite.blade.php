@extends('auth.settings.layout')

@section('section')
    <section class="products_section">
        <div class="products_block_all">
            <span>{!! $meta->getMeta('products_altele') !!} <strong>{{count($products)}}</strong> {!! $meta->getMeta('products_favorite') !!}</span>
        </div>
        <div class="show_all_products">
            <div class="row">
                @if(count($products) > 0)
                    @foreach($products as $item)
                        <div class="col-md-3 col-xs-6">
                            <a href="{{route('show_product',['product'=>$item->product_id,'title'=>str_slug($item->getProduct->title)])}}">
                                <div class="products_block">
                                    <div class="products_block_head"
                                         style="background:url({{$item->getProduct->present()->renderCoverImage()}}); background-size: cover;">
                                        <div class="hover_produs">
                                            <div class="add_to_favorite" data-id="{{$item->getProduct->id}}" href="">
                                                <i @if(count($isFavorite->getById($item->getProduct->id)) > 0 )  class="fa fa-heart"
                                                   @else class="fa fa-heart-o"
                                                   @endif aria-hidden="true"></i></div>
                                        </div>
                                    </div>
                                    <div class="products_block_body">
                                        <h5>{{$item->getProduct->present()->renderTitle()}}</h5>
                                        {!! $item->getProduct->present()->renderPrice() !!}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <p>{{$meta->getMeta('favorite_not_found')}}</p>
                    </div>
                @endif
            </div>
            @include('product.partials.pagination')
        </div>
    </section>
@endsection
