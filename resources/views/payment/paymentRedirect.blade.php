@extends('layout')

@section('content')
    <div class="container">
        <div class="col-xs-12">
            <div class="checkout">
            <div class="cart_box" style="text-align: center">
                <br>
                <img width="200" src="/assets/images/succes.png" alt="">
                <p>
                    <form name="frmPaymentRedirect" method="post" action="<?php echo $paymentUrl;?>">
                        <input type="hidden" name="env_key" value="<?php echo $objPmReqCard->getEnvKey();?>"/>
                        <input type="hidden" name="data" value="<?php echo $objPmReqCard->getEncData();?>"/>
                <p>
                    Vei fi redirectat catre pagina de plati securizata a mobilpay.ro
                </p>
                <p>
                    Pentru a continua apasa <input style="max-height: 50px; vertical-align: middle;" type="image" src="//www.neoit.ro/img/mobilpay-mare.gif"/>
                </p>
                </form>
                </p>
            </div>
                </div>
        </div>
    </div>
@endsection