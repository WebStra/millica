@extends('layout')

@section('content')
    <section class="termens">
        <div class="container">
            <h3 class="title"><span>{{$item->title}}</span></h3>
            <div class="row">
                <div class="col-xs-12">
                    <p>{!! $item->body !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
