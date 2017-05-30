@extends('layout')
@section('content')
    <section class="basket">
        <div class="container">
            <h3 class="title"><span>{!! $meta->getMeta('steptwo_title') !!}</span></h3>
            @if (count($errors) > 0)
                <br>
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('last_step')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="key" value="{{$key}}">
                <div class="checkout">
                    <h2 class="step-title">
                        <span class="step-number">1</span>
                        {!! $meta->getMeta('steptwo_livrare') !!} </h2>
                    <div class="cart_box">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-12">
                                    <h4 class="checkout_form_title">{!! $meta->getMeta('steptwo_person') !!}</h4>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="deliveryname">{!! $meta->getMeta('steptwo_name') !!}</label>
                                        <input type="text" class="form-control" id="deliveryname" name="deliveryname"
                                               value="{{\Auth::user()->firstname}} {{\Auth::user()->lastname}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="deliveryphone">{!! $meta->getMeta('steptwo_phone') !!}</label>
                                        <input type="text" class="form-control" id="deliveryphone" name="deliveryphone"
                                               value="@if(\Auth::user()->phone){{\Auth::user()->phone}}@else{{old('deliveryphone')}}@endif">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <h4 class="checkout_form_title">{!! $meta->getMeta('steptwo_adress') !!}</h4>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="deliveriAdress">{!! $meta->getMeta('steptwo_adress_label') !!}</label>
                                        <input type="text" class="form-control" id="deliveriAdress"
                                               name="deliveryadress" value="{{\Auth::user()->adress}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <br>
                                        <label for="deliveryjudet">{!! $meta->getMeta('steptwo_judet') !!}</label>
                                        <select name="deliveryjudet" id="deliveryjudet"
                                                class="selectpicker form-control"
                                                data-live-search="true">
                                            <option value="">{!! $meta->getMeta('steptwo_judet_select') !!}</option>
                                            @foreach($cityes as $city)
                                                <option @if(\Auth::user()->judet == $city) selected
                                                        @endif value="{{$city}}">{{$city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <br>
                                        <label for="deliveryjlocation">{!! $meta->getMeta('steptwo_local') !!}</label>
                                        <div class="deliveryjudet">
                                            <select name="deliveryjlocation" id="deliveryjlocation"
                                                    class="form-control" @if(!\Auth::user()->location)) disabled @endif>
                                                @if(\Auth::user()->location)
                                                    <option value="{{\Auth::user()->location}}">{{\Auth::user()->location}}</option>
                                                @else
                                                    <option>{!! $meta->getMeta('steptwo_jud') !!}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout">
                    <h2 class="step-title">
                        <span class="step-number">2</span>
                        {!! $meta->getMeta('steptwo_facturare') !!} </h2>
                    <div class="cart_box">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-12">
                                    <h4 class="checkout_form_title">{!! $meta->getMeta('steptwo_persoane') !!}</h4>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="facturarename">{!! $meta->getMeta('steptwo_name') !!}</label>
                                        <input type="text" class="form-control" id="facturarename" name="facturarename"
                                               value="{{\Auth::user()->firstname}} {{\Auth::user()->lastname}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="facturarephone">{!! $meta->getMeta('steptwo_phone') !!}</label>
                                        <input type="text" class="form-control" id="facturarephone"
                                               name="facturarephone"
                                               value="@if(\Auth::user()->phone){{\Auth::user()->phone}}@else{{old('facturarephone')}}@endif">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <h4 class="checkout_form_title">{!! $meta->getMeta('steptwo_adress_fact') !!}</h4>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="facturareadress">{!! $meta->getMeta('steptwo_adress') !!}</label>
                                        <input type="text" class="form-control" id="facturareadress"
                                               name="facturareadress" value="{{\Auth::user()->adress}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <br>
                                        <label for="facturarejudet">{!! $meta->getMeta('steptwo_judet') !!}</label>
                                        <select name="facturarejudet" id="facturarejudet"
                                                class="selectpicker form-control"
                                                data-live-search="true">
                                            <option value="">{!! $meta->getMeta('steptwo_judet_select') !!}</option>
                                            @foreach($cityes as $city)
                                                <option @if(\Auth::user()->judet == $city) selected
                                                        @endif value="{{$city}}">{{$city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <br>
                                        <label for="facturarelocation">{!! $meta->getMeta('steptwo_local') !!}</label>
                                        <div class="locations">
                                            <select name="facturarelocation" id="facturarelocation"
                                                    class="form-control" @if(!\Auth::user()->location)) disabled @endif>
                                                @if(\Auth::user()->location)
                                                    <option value="{{\Auth::user()->location}}">{{\Auth::user()->location}}</option>
                                                @else
                                                    <option>{!! $meta->getMeta('steptwo_judet_select') !!}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <br>
                                        <label for="cnp">{!! $meta->getMeta('steptwo_cnp') !!}</label>
                                        <input type="text" class="form-control" id="cnp"
                                               name="cnp" value="{{old('cnp')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout">
                    <h2 class="step-title">
                        <span class="step-number">3</span>
                        {!! $meta->getMeta('steptwo_plata') !!} </h2>
                    <div class="cart_box">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="radio">
                                    <label><input checked type="radio" name="paymentMethod"
                                                  value="curier">{!! $meta->getMeta('steptwo_ramb') !!}</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="paymentMethod"
                                                  value="card">{!! $meta->getMeta('steptwo_card') !!}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout">
                    <h2 class="step-title">
                        <span class="step-number">4</span>
                        {!! $meta->getMeta('steptwo_date') !!} </h2>
                    <div class="cart_box">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <p class="cont_perosnal_info">{!! $meta->getMeta('steptwo_text') !!}
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="contname">{!! $meta->getMeta('steptwo_name') !!}</label>
                                        <input type="text" class="form-control" id="contname" name="contname"
                                               value="{{\Auth::user()->firstname}} {{\Auth::user()->lastname}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="contphone">{!! $meta->getMeta('steptwo_phone') !!}</label>
                                        <input type="text" class="form-control" id="contphone" name="contphone"
                                               value="{{\Auth::user()->phone}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="checkbox" name="confirm" value="1" id="rights" style="vertical-align: middle" checked>
                    <label style="position: relative; top: 3px; left: 5px; color: black;"
                           for="rights">{!! $meta->getMeta('steptwo_termeni') !!}</label>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="prices_basket">
                            <div class="total_price">{!! $meta->getMeta('steptwo_total') !!}:
                                <span>{{$sumPriceProducts}}</span> RON
                            </div>
                            <div class="">{!! $meta->getMeta('steptwo_cost') !!}: @if($sumPriceProducts >= 200)<span>Gratuit</span> @else
                                    <span>15 RON</span>@endif</div>
                            <div class="">{!! $meta->getMeta('steptwo_subtotal') !!}: @if($sumPriceProducts >= 200)
                                    <span>{{$sumPriceProducts}}</span> @else
                                    <span>{{$sumPriceProducts + 15}}</span>@endif
                            </div>
                            <button type="submit"
                                    class="next_step_basket">{!! $meta->getMeta('steptwo_next') !!}</button>
                        </div>
                    </div>
                </div>
            </form>
            <br><br>
        </div>
    </section>
@endsection

@section('js')

    <script>
        $('select[name=deliveryjudet]').change(function () {
            var judet = $("select[name=deliveryjudet] option:selected").val();
            $.ajax({
                url: '{{route('get_location')}}',
                method: 'POST',
                dataType: 'json',
                data: {judet: judet},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('select[name=deliveryjlocation]').html(response).removeAttr('disabled');
                    $('select[name=facturarelocation]').html(response).removeAttr('disabled');
                    $('select[name=facturarejudet]').val(judet).change();
                }
            });
        });
    </script>

    <script>
        $('select[name=facturarejudet]').change(function () {
            var judet = $("select[name=facturarejudet] option:selected").val();
            $.ajax({
                url: '{{route('get_location')}}',
                method: 'POST',
                dataType: 'json',
                data: {judet: judet},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('select[name=facturarelocation]').html(response);
                    $('select[name=facturarelocation]').removeAttr('disabled');

                }
            });
        });
    </script>

    <script>
        $('#deliveryjlocation').change(function () {
            var curent = $("select[name=deliveryjlocation] option:selected").val();
            $("select[name=facturarelocation]").val(curent);
        });
    </script>

    <script>
        fbq('track', 'AddPaymentInfo');
    </script>

@endsection
