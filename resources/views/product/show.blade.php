@extends('layout')

@section('meta')
    <link rel="image_src" href="{{$product->present()->renderCoverImage()}}">
    <meta property="og:url" content="{{ Request::fullUrl() }}"/>
    <meta property="og:title" content="{{$product->present()->renderFullTitle()}}"/>
    <meta property="og:description" content="{{ str_limit($product->body,$limit=200,$end='..') }}"/>
    <meta property="og:image" content="{{$product->present()->renderCoverImage()}}"/>
    <meta name="description" content="{{ str_limit($product->body,$limit=200,$end='..') }}"/>
    <script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
@endsection
@section('link')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/noUiSlider/9.2.0/nouislider.min.css"/>
@endsection
@section('content')
    <section class="products_open">
        <div class="container">
            <div class="row">
                <div class="col-sm-1 hidden-xs">
                    <div id="gal1">
                        @foreach($product->present()->renderImages() as $item)
                            <a style="display: block" href="#" data-image="{{$item->full_name}}"
                               data-zoom-image="{!! $item->full_name !!}">
                                <img class="img-responsive" id="thumbs" src="{{$item->full_name}}"/>
                            </a>
                            <br>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-4 hidden-xs">
                    <div class="blue">
                        <div class="" style="position: relative;">
                            <img class="img-responsive" id="img_01" src="{{$product->present()->renderCoverImage()}}"
                                 data-zoom-image="{{$product->present()->renderCoverImage()}}"/>
                        </div>
                        <br><br><br><br>
                    </div>
                </div>
                <div style="display: none;" class="gallery_slide_res visible-xs">
                    @foreach($product->present()->renderImages() as $item)
                        <div>
                            <img class="img-responsive" src="{!! $item->full_name !!}" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-7">
                    <div class="products_open_description">
                        <h3>{{$product->present()->renderFullTitle()}}</h3>
                        <br><br>
                        {{--@include('partials.vote')--}}

                        <form class="product_open_form" method="post">
                            {{csrf_field()}}
                            <div class="products_open_price">
                                {!! $product->present()->renderProductPrice()!!}
                            </div>
                            <div class="products_open_color">
                                <h3>Culore: </h3>
                                {{--<input type="hidden" name="color" value="{{$product->color}}">--}}
                                <div class="basket-size">
                                    <select name="color" class="form-control">
                                        @foreach($product->tags->where('model','color') as $tag)
                                            <option value="{{str_slug($tag->name)}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="products_open_size">
                                <br>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h3>selecteaza marimea</h3>
                                        <div class="basket-size">
                                            <select class="product_sizes" name="size" class="form-control">
                                                @foreach($productSizes as $item)
                                                    <option data-quantity="{{$item->count}}"
                                                            value="{{str_slug($item->title)}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h3>Cantitate</h3>
                                        <div class="handle-counter">
                                            <button type="button" class="counter-minus decrement_value">-
                                            </button>
                                            <input class="quantity" name="quantity" type="text" value="1"
                                                   max="{{isset($prodSize->count) ? $prodSize->count : 1}}"
                                                   readonly="readonly">
                                            <button type="button" class="counter-plus increment_value">+
                                            </button>
                                        </div>

                                        <p id="stock_epuizat" style="display:none; color: red; font-weight: 800;">stoc
                                            epuizat</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <input @if($product->quantity > 0) class="place_product" @else class="stock_limit"
                                   @endif  id="place_product" type="submit" value="Pune in cos">
                        </form>
                        <div class="products_share">
                            <span>Share</span>
                            @include('share.index',['item'=>$product])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="products_open_tabs">
        @include('product.partials.product-detail')
    </section>
    @if(count($sameProducts) > 0)
        <section class="assorted">
            <div class="container">
                <h3>{!! $meta->getMeta('same_color_products') !!}</h3>
                <div class="row">
                    <div class="assorted_slider_block">
                        @include('product.partials.asort')
                        <span class="next_assorted"></span>
                        <span class="prev_assorted"></span>
                        @if(count($sameProducts) < 5)
                            <span class="slide_bar"></span>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="similar_products">
        <div class="container">
            <h3>{!! $meta->getMeta('same_category_products') !!}</h3>
            <div class="row">
                <div class="similar_products_slider_block">
                    @include('product.partials.somecategory')
                    <span class="next_similar_products"></span>
                    <span class="prev_similar_products"></span>
                    <span class="slide_bar"></span>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // $(".handle-counter").counting();
    </script>
    <script>
        if ($('.product_sizes option:selected').data('quantity') > 0) {
            $('.handle-counter').show();
            $('#stock_epuizat').hide();
        } else {
            $('.handle-counter').hide();
            $('#stock_epuizat').show();
        }
    </script>

    <script>
        $('.product_sizes').change(function () {

            var quantity = $('.product_sizes option:selected').data('quantity');

            if (quantity > 0) {
                var value = $('input[name=quantity]').val();
                if (value > quantity) {
                    console.log(value + ' ' + quantity);
                    //$(".handle-counter").counting();
                    $('input[name=quantity]').val(quantity);
                }
                var count = $('input[name=quantity]').attr('max', quantity);
                $('.handle-counter').show();
                $('.place_product').removeAttr("disabled");
                $('#stock_epuizat').hide();
            } else {
                $('.handle-counter').hide();
                $('.place_product').attr("disabled", "disabled");
                $('#stock_epuizat').show();
            }

        });
    </script>

    {{--@if(\Auth::check())--}}
    <script>
        $('.place_product').click(function (event) {
            event.preventDefault();
            var form = $(this).parent(form).serialize();
            var quantity = $('.product_sizes option:selected').data('quantity');
            if (quantity > 0) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('add_to_baket',['product'=>$product->id])}}',
                    data: form,
                    dataType: 'json',
                    success: function (data) {
                        if (data.succes) {
                            toastr.success('Produsul a fost adaugat in cos');

                            $('.basket_product_count').html('(' + data.count + ')');
                        }
                    }
                });
            } else {
                toastr.warning('Stoc epuizat');
            }
        });
    </script>
    {{--@else--}}
    {{--<script>--}}
    {{--$('.place_product').click(function (event) {--}}
    {{--event.preventDefault();--}}
    {{--toastr.warning('Trebuie sa va autentificati');--}}
    {{--});--}}
    {{--</script>--}}
    {{--@endif--}}

    <script>
        fbq('track', 'ViewContent', {
            value: '{{$product->price}}',
            currency: 'RON'
        });
    </script>

@endsection