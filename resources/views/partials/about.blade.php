@extends('layout')

@section('content')
<section class="first_about">
    <div class="container">
        <h3>{!! $meta->getMeta('about_title') !!}</h3>
        <ul>
            <li><a href="{{route('home')}}">{!! $meta->getMeta('about_menu_home') !!}</a></li>
            <li><a href="">{!! $meta->getMeta('about_menu_about')!!}</a></li>
        </ul>
    </div>
</section>
<section class="about_info">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>{!! $meta->getMeta('about_text')!!}</h3>
            </div>
            <div class="col-md-6">
                <h4>{!! $item->title !!}</h4>
                <p>{!! $item->body !!}</p>
            </div>
        </div>
    </div>
</section>
<section class="about_contacts">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>{!! $meta->getMeta('about_cont')!!}</h3>
            </div>
            <div class="col-md-6">
                <div class="about_contacts_block">
                    <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{settings()->getOption('contact::adress')}}</span>
                    <span><i class="fa fa-phone" aria-hidden="true"></i> {{settings()->getOption('contact::phone')}}</span>
                    <span><i class="fa fa-paper-plane" aria-hidden="true"></i> {{settings()->getOption('contact::email')}}</span>
                </div>
                <div class="about_contacts_social">
                    <h4>{!! $meta->getMeta('about_social')!!}</h4>
                    <a href="{{settings()->getOption('contact::facebook')}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> </a>
                    <a href="{{settings()->getOption('contact::pinterest')}}" target="_blank"><i class="fa fa-pinterest-square" aria-hidden="true"></i> </a>
                    <a href="{{settings()->getOption('contact::instagram')}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i> </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection