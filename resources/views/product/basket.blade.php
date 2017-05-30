@extends('layout')

@section('content')
    <section class="basket">
        <div class="container">
            <h3 class="title"><span>{!! $meta->getMeta('basket_title') !!}</span></h3>
            <div class="row">
                <div class="col-xs-12">
                    <div class="basket_head">
                        <span>{!! $meta->getMeta('basket_total') !!}
                            : <strong>{{count($basketProducts)}}</strong> {!! $meta->getMeta('basket_tproducts') !!}</span>
                    </div>
                    @foreach($basketProducts as $item)
                        <?php  $getProduct = $item->getProduct()->first();
                        $productSizes = $getProduct->getSizes;
                        ?>
                        <div class="basket_body">
                            <a class="prod_delete"
                               href="{{route('delete_product_basket', ['id'=>$item->id])}}"><strong>{!! $meta->getMeta('basket_delete') !!}</strong>
                                &times;</a>
                            <a class="basket_product_title"
                               href="{{route('show_product',['product'=>$getProduct->id, 'title'=>$getProduct->title])}}">{!! $getProduct->title !!}</a>
                            {{--@include('partials.vote')--}}
                            <div class="row">
                                <div class="col-sm-2">
                                    <img width="90" height="130" src="{{$getProduct->present()->renderCoverImage()}}">
                                </div>
                                <form method="post">
                                    {{csrf_field()}}
                                    <div class="col-sm-3">
                                        <h3>{!! $meta->getMeta('basket_size') !!}</h3>
                                        <div class="basket-sizes">
                                            <select style="width: 100%; height: 35px; margin:0 auto;"
                                                    class="product_sizes" name="sizes" class="form-control">
                                                @foreach($productSizes as $size)
                                                    <option @if(str_slug($item->size) == str_slug($size->title)) selected="selected"
                                                            @endif data-quantity="{{$size->count}}"
                                                            value="{{str_slug($size->title)}}">{{$size->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <h3>{!! $meta->getMeta('basket_quantity') !!}</h3>
                                        <div class="handle-counter" style="max-width: 130px; margin:0 auto;">
                                            <button type="button" class="counter-minus decrement_value">-
                                            </button>
                                            <input class="quantity" name="count" type="text" value="{{$item->quantity}}"
                                                   max="{{isset($prodSize->count) ? $prodSize->count : 1}}"
                                                   readonly="readonly">
                                            <button type="button" class="counter-plus increment_value">+
                                            </button>
                                        </div>
                                        <p id="stock_epuizat" style="display:none; color: red; font-weight: 800;">stoc
                                            epuizat</p>
                                    </div>
                                    <div class="col-sm-2 col-xs-6">
                                        <h3>{!! $meta->getMeta('basket_color') !!}</h3>
                                        <div class="basket_price">
                                            {{$item->color}}
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-xs-6">
                                        <h3>{!! $meta->getMeta('basket_price') !!}</h3>
                                        <div class="basket_price">
                                            {!! $getProduct->present()->renderPrice() !!}
                                        </div>
                                    </div>
                                    <input type="hidden" name="item" value="{{$item->id}}">
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if(count($basketProducts))
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="prices_basket">
                                    <br>
                                    <label for="promo_cod">Adauga card cadou:</label>
                                    <div class="form-group has-feedback promo_code">
                                        <input type="text" class="form-control" id="promo_cod"
                                               name="promo_cod" value="{{old('promo_cod')}}">
                                        <span id="validate_code" class="form-control-feedback fa "></span>
                                    </div>
                                    <div class="total_price">{!! $meta->getMeta('basket_total_prod') !!}:
                                        <span>{{$sumPriceProducts}}</span> RON
                                    </div>
                                    <div class="">{!! $meta->getMeta('basket_cost') !!}: <span class="del_status"> @if($sumPriceProducts < 200)
                                                15 RON @else GRATUIT @endif</span></div>
                                    <div class="">Subtotal: <span
                                                class="subtotal">@if($sumPriceProducts < 200){{$sumPriceProducts + 15}} @else {{$sumPriceProducts}} @endif </span>
                                        RON
                                    </div>
                                    @if(!\Auth::check())
                                        <a class="next_step_basket"
                                           href="{{route('get_login')}}">{!! $meta->getMeta('basket_next') !!}</a>
                                    @else
                                        <a class="next_step_basket"
                                           href="{{route('step_two')}}">{!! $meta->getMeta('basket_next') !!}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <br><br>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

    <script>
        $('#promo_cod').on('change', function () {
            var value = $(this).val();
            $.ajax({
                method: 'post',
                url: '{{route('check_promo_code')}}',
                dataType: 'json',
                data: {code: value},
                success: function (data) {
                    if (data.success) {
                        $('.promo_code').addClass('has-success').removeClass('has-error');
                        $('#validate_code').addClass('fa-check').removeClass('fa-times');
                        toastr.success('Card confirmat aveti reducere de: -' + data.discount);
                        $('.total_price span').html(data.price);
                        if (data.price >= 200) {
                            $('.subtotal').html(data.price);
                        } else {
                            $('.subtotal').html(data.price + 15);
                            $('.del_status').html('15 RON').css('color', 'black');
                        }
                    }
                    if (data.error) {
                        $('.promo_code').addClass('has-error').removeClass('has-success');
                        $('#validate_code').addClass('fa-times').removeClass('fa-check');
                        toastr.error('Cod inexistent!');
                    }
                    if (data.expired) {
                        $('.promo_code').addClass('has-error').removeClass('has-success');
                        $('#validate_code').addClass('fa-times').removeClass('fa-check');
                        toastr.warning('Codul a expirat!');
                    }
                    if (data.start) {
                        $('.promo_code').addClass('has-error').removeClass('has-success');
                        $('#validate_code').addClass('fa-times').removeClass('fa-check');
                        toastr.warning('Promotia incepe din data de: ' + data.start_date);
                    }
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
        });
    </script>

    <script>

        $('form select').on('change', function () {
            var this_ = $(this).parents('form');
            updateProduct(this_);
        });

        $(' .handle-counter button').click(function () {
            var this_ = $(this).parents('form');
            updateProduct(this_);
        });

        function updateProduct(this_) {
            var form = this_.serialize();
            $.ajax({
                url: '{{route('update_product_basket')}}',
                method: 'POST',
                dataType: 'json',
                data: form,
                success: function (data) {
                    $('.total_price span').html(data.count);
                    if (data.count > 200) {
                        $('.del_status').html('GRATUIT').css('color', 'green');
                        $('.subtotal').html(data.count);
                    } else {
                        $('.del_status').html('15 RON').css('color', 'black');
                        $('.subtotal').html(data.count + 15);
                    }
                }
            });
        }

    </script>

    <script>
        $('.product_sizes').change(function () {

            var quantity = $('.product_sizes option:selected').data('quantity');

            if (quantity > 0) {
                var value = $('input[name=count]').val();
                if (value > quantity) {
                    $('input[name=quantity]').val(quantity);
                }
                var count = $('input[name=count]').attr('max', quantity);
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

    <script>
        fbq('track', 'AddToCart', {
            value: '{{$sumPriceProducts}}',
            currency: 'RON'
        });
    </script>

    <script>
        $('.not_auth_user').click(function(){
            toastr.warning('Pentru a finisa comanda este nevoie sa va autentificati!');
        });
    </script>

@endsection
