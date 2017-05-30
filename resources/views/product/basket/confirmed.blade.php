@extends('layout')

@section('content')
    <section class="basket">
        <div class="container">
            <div class="checkout">
                <div class="row">
                    <div class="cart_box" style="text-align: center;">
                        <img width="200" src="/assets/images/succes.png" alt="">
                        <h2>{!! $meta->getMeta('products_confirmation_title') !!}</h2>
                        @if($comand->payment == 'curier')
                            Vezi Comanda: <a href="{{route('show_comand',['id'=>$comand->confirm_code])}}">Comanda</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        fbq('track', 'InitiateCheckout');
    </script>
@endsection