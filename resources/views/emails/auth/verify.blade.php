<?php $link = route('home') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300,500,700,900,100,300italic,400italic,500italic,700italic' rel='stylesheet' type='text/css'>
</head>

<body>
<div style="background: #dedede;padding: 50px 90px 90px 80px; width: 800px; margin: auto;">
    <img style="margin: auto;display: block;" src="//millica.ro/assets/images/millica_logo.png" alt="">
    <div style="background: #fff;margin-top: 100px; padding-bottom: 170px;">
        <div style="background: #000; padding: 7px; width:100%;">
            <h3 style="font-weight: 400; font-size: 70px; color: #fff;text-align: center;">Bine ai venit pe Millica.ro</h3>
        </div>
        <h4 style="font-weight: 400;font-size: 25px;color: #000;margin-top: 70px;text-align: center;">Îți mulțumim pentru crearea unui cont pe Millica</h4>
        <h4 style="font-weight: 400;font-size: 25px;color: #000;margin-top: 70px;text-align: center;">Poți accesa contul tău pentru a plasa comenzi
            <a href="{{$link}}">aici!</a></h4>
    </div>
</div>
</body>

</html>