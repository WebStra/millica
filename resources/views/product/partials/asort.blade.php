<div class="assorted_slider">
    @foreach($sameProducts as $same)
        <div class="col-md-3 col-xs-6">
            <a href="{{route('show_product', ['product'=>$same->getProduct->id,'title'=>str_slug($same->getProduct->title)])}}">
                <div class="products_block">
                    <div class="products_block_head"
                         style="background:url({{$same->getProduct->present()->renderCoverImage()}}); background-size: cover;">
                        <div class="hover_produs">
                            <div class="add_to_favorite" data-id="{{$same->getProduct->id}}" href="">
                                <i @if(count($isFavorite->getById($item->product_id)) > 0 )  class="fa fa-heart"
                                   @else class="fa fa-heart-o"
                                   @endif aria-hidden="true"></i></div>
                        </div>
                    </div>
                    <div class="products_block_body">
                        <h5>{{$same->getProduct->present()->renderTitle()}}</h5>
                        {!! $same->getProduct->present()->renderPrice() !!}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>