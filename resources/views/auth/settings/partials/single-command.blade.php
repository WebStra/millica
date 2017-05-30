@extends('layout')

@section('content')
    <section class="basket">
        <div class="container">
            <h3 class="title"><span>{!! $meta->getMeta('step_title') !!}</span></h3>
            <div class="checkout">
                <div class="row">
                    <div class="col-md-4">
                        <div class="cart_box">
                            <div class="title_box">
                                <h3><img class="check_yes" src="/assets/images/check.png"
                                         alt="">{!! $meta->getMeta('step_sub_title') !!}
                                    {{--<a href="{{route('step_two')}}" class="modify_data">modifica</a>--}}</h3>
                            </div>
                            <hr>
                            <span class="cart_box_item">{!! $meta->getMeta('step_name') !!}: {{$comand->delname}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_phone') !!}
                                : {{$comand->delphone}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_adress') !!}
                                : {{$comand->deladress}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_judet') !!}
                                : {{$comand->deljudet}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_localitate') !!}
                                : {{$comand->dellocation}}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cart_box">
                            <div class="title_box">
                                <h3><img class="check_yes" src="/assets/images/check.png"
                                         alt="">{!! $meta->getMeta('step_fact') !!}
                                    {{--<a href="{{route('step_two')}}" class="modify_data">modifica</a>--}}</h3>
                            </div>
                            <hr>
                            <span class="cart_box_item">{!! $meta->getMeta('step_name') !!}: {{$comand->facname}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_phone') !!}
                                : {{$comand->facphone}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_adress') !!}
                                : {{$comand->facadress}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_judet') !!}
                                : {{$comand->facjudet}}</span>
                            <span class="cart_box_item">{!! $meta->getMeta('step_localitate') !!}
                                : {{$comand->faclocation}}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cart_box">
                            <div class="title_box">
                                <h3><img class="check_yes" src="/assets/images/check.png"
                                         alt="">{!! $meta->getMeta('step_modifica') !!}
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
                                <h3><img class="check_yes" src="/assets/images/check.png"
                                         alt="">{!! $meta->getMeta('step_products') !!}</h3>
                            </div>
                            @foreach($basketProducts as $item)
                                <hr>
                                <div class="comand_products_list">
                                    <span>{{$item->quantity}} x {{$item->getProduct->title}}</span>
                                    <span style="float: right; display: block">{{$item->getProduct->price}} RON</span>
                                </div>
                            @endforeach
                            <br><br>
                            <div class="comand_products_list">
                                <span>{!! $meta->getMeta('step_cost') !!}</span>
                                <span style="float: right; display: block"> @if($sumPriceProducts < 200) 15 RON @else <b
                                            style="color:#0ddb51;">{!! $meta->getMeta('step_gratuit') !!}</b> @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        Status Tranzactie:
                        @if($comand->card_status == 'confirmed')
                            <b>Suma a fost incasata in curind produsul va fi livrat!</b>
                        @elseif($comand->card_status == 'confirmed_pending')
                            <b>Tranzactia este in curs de verificare antifrauda!</b>
                        @elseif($comand->card_status == 'paid_pending')
                            <b>Tranzactia este in curs de verificare!</b>
                        @elseif($comand->card_status == 'paid')
                            <b>Tranzactia este in curs de procesare.!</b>
                        @elseif($comand->card_status == 'canceled')
                            <b>Tranzactia este anulata.!</b>
                        @elseif($comand->card_status == 'credit')
                            <b>Banii au fost returnati posesorului de card!</b>
                        @elseif($comand->payment == 'curier')
                            <b>Se achita la curier!</b>
                        @else
                            <b>Tranzactia a fost stopata!</b>
                        @endif
                    </div>
                    <div class="col-xs-6">
                        <div style="text-align: right">
                            <h4>Cost Total
                                : @if($sumPriceProducts > 200) {{$sumPriceProducts}} @else {{$sumPriceProducts + 15}} @endif
                                RON</h4>
                            @if(!$comand->awb_code && $comand->payment_status == 'curier')
                                <a style="float: right; display: block; text-align: center; max-width:250px; padding: 10px 20px; background: #000; color: #fff;"
                                   href="{{route('cancel_comand',['id'=>$comand->confirm_code])}}">Anuleaza comanda</a>
                            @elseif($comand->active == 0)
                                <b style="color:red; font-size: 15px; float: right;">Comanda a fost anulata!!</b>
                            @else
                                <b style="color:red; font-size: 15px; float: right;">Comanda a fost procesata!</b>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection