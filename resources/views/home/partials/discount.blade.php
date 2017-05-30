<div class="container">
    <h3 class="title"><span>{{$meta->getMeta('discount_title')}}</span></h3>
    <!-- <img class="img-responsive title_bar" src="/assets/images/bar_title.png" alt=""> -->
    <h4 class="subtile">{{$meta->getMeta('discount_subtitle')}}</h4>
    <div class="row">
        <div class="products_sale__slider_block">
            <div class="products_sale_slider">
                @foreach($onSale as $item)
                    <div class="col-md-3 col-xs-6">
                        <a href="{{route('show_product', ['product'=>$item->id,'title'=>str_slug($item->title)])}}">
                            <div class="products_block">
                                <div class="products_block_head"
                                     style="background:url({{$item->present()->renderCoverImage()}}); background-size: cover;">
                                    <div class="hover_produs">
                                        <div class="add_to_favorite" data-id="{{$item->id}}" href="">
                                            <i @if(\Auth::check()) @if(count($isFavorite->getById($item->id)) > 0 )  class="fa fa-heart"
                                               @else class="fa fa-heart-o"
                                               @endif @else class="fa fa-heart-o"
                                               @endif aria-hidden="true"></i></div>
                                    </div>
                                </div>
                                <div class="products_block_body">
                                    <h5>{{$item->present()->renderTitle()}}</h5>
                                    {!! $item->present()->renderPrice() !!}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <span class="next_products_sale"></span>
            <span class="prev_products_sale"></span>
            <span class="slide_bar"></span>
        </div>
    </div>
</div>