@extends('layout')

@section('content')
    <section class="basket">
        <div class="container">
            <h3 class="title"> <span>{!! $meta->getMeta('step_title') !!}</span></h3>
            <div class="checkout">
                <div class="row">
                    <div class="col-md-4">
                        <div class="cart_box">
                            <div class="title_box">
                                <h3><img class="check_yes" src="/assets/images/check.png" alt="">{!! $meta->getMeta('step_sub_title') !!}
                                    {{--<a href="{{route('step_two')}}" class="modify_data">modifica</a>--}}</h3>
                            </div>
                            <hr>
                            <span class="cart_box_item">{!! $meta->getMeta('step_name') !!}: {{$comand->delname}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_phone') !!}: {{$comand->delphone}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_adress') !!}: {{$comand->deladress}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_judet') !!}: {{$comand->deljudet}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_localitate') !!}: {{$comand->dellocation}}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cart_box">
                            <div class="title_box">
                                <h3><img class="check_yes" src="/assets/images/check.png" alt="">{!! $meta->getMeta('step_fact') !!}
                                    {{--<a href="{{route('step_two')}}" class="modify_data">modifica</a>--}}</h3>
                            </div>
                            <hr>
                            <span class="cart_box_item">{!! $meta->getMeta('step_name') !!}: {{$comand->facname}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_phone') !!}: {{$comand->facphone}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_adress') !!}: {{$comand->facadress}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_judet') !!}: {{$comand->facjudet}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_localitate') !!}: {{$comand->faclocation}}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cart_box">
                            <div class="title_box">
                                <h3><img class="check_yes" src="/assets/images/check.png" alt="">{!! $meta->getMeta('step_modifica') !!}
                                    {{--<a href="{{route('step_two')}}" class="modify_data">modifica</a>--}}</h3>
                            </div>
                            <hr>
                            <div>
                                @if($comand->payment == 'card')
                                    <h4>{!! $meta->getMeta('step_card') !!}</h4>
                                    <span>{!! $meta->getMeta('step_comand') !!}</span>
                                @else
                                    <h4>{!! $meta->getMeta('step_ramburs') !!}</h4>
                                    <span>{!! $meta->getMeta('step_message') !!}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="cart_box">
                            <div class="title_box">
                                <h3><img class="check_yes" src="/assets/images/check.png" alt="">{!! $meta->getMeta('step_products') !!}</h3>
                            </div>
                            @foreach($basketProducts as $item)
                                <hr>
                                <div class="comand_products_list">
                                    <span>{{$item->quantity}} x {{$item->getProduct->title}}</span>
                                    <span style="float: right; display: block">{{$item->price}} RON</span>
                                </div>
                            @endforeach
                            <br><br>
                            <div class="comand_products_list">
                                <span>{!! $meta->getMeta('delivery_last_step') !!}</span>
                                <span style="float: right; display: block"> @if($sumPriceProducts < 200) 15 RON @else <b style="color:#0ddb51;">{!! $meta->getMeta('step_gratuit') !!}</b> @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div style="text-align: right">
                            <h2>{!! $meta->getMeta('step_costs') !!}: @if($sumPriceProducts > 200) {{$sumPriceProducts}} @else {{$sumPriceProducts + 15}} @endif RON</h2>
                            @if($comand->payment == 'card')
                                <div>
                                    <form action="{{route('paymentRedirect')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="text" name="billing_first_name"
                                               style="display:none;" value="{{$comand->facname}}"/>
                                        <input type="text" name="billing_last_name"
                                               style="display:none;" value="{{$comand->facname}}"/>
                                        <textarea type="text" name="billing_address"
                                                  style="display:none;">{{$comand->facadress}}</textarea>
                                        <input type="text" name="billing_email"
                                               style="display:none;" value="{{\Auth::user()->email}}"/>
                                        <input type="text" name="billing_mobile_phone"
                                               style="display:none;" value="{{$comand->facphone}}"/>
                                        <input type="text" name="shipping_first_name"
                                               style="display:none;" value="{{$comand->delname}}"/>
                                        <input type="text" name="shipping_last_name"
                                               style="display:none;" value="{{$comand->delname}}"/>
                                        <textarea type="text" name="shipping_address"
                                                  style="display:none;">value="{{$comand->deladress}}"</textarea>
                                        <input type="text" name="shipping_email"
                                               style="display:none;" value="{{\Auth::user()->email}}"/>

                                        <input type="text" name="shipping_mobile_phone"
                                               style="display:none;" value="{{$comand->delphone}}"/>

                                        <input type="text" name="price"
                                               style="display:none;" value="{{$comand->price}}"/>

                                        <input type="text" name="product_code"
                                               style="display:none;" value="{{$comand->confirm_code}}"/>
                                        <input style="float: right; padding: 10px 30px; display: block; margin-top: 20px; background: #000; color:#fff; border: none;" class="next_step_basket" type="submit" value="Continua">
                                    </form>
                                </div>
                                @else
                                <a style="float: right; padding: 10px 30px; display: block; margin-top: 20px;" class="next_step_basket" href="{{route('courier_comand',['confirm_code'=>$comand->confirm_code])}}">{!! $meta->getMeta('step_submit') !!}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection