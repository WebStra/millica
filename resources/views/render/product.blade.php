<div class="row">
    @foreach($products as $item)
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