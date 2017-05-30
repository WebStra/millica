@extends('layout')

@section('content')
    <section class="first_section_slide">
        @include('home.partials.slide')
    </section>
    <section class="first_colection">
        @include('home.partials.colection')
    </section>
    <section class="first_products">
        @include('home.partials.products')
    </section>
    <section class="first_info">
        @include('home.partials.subscribe')
    </section>
    @if(count($onSale) >0)
        <section class="products_sale">
            @include('home.partials.discount')
        </section>
    @endif
@endsection