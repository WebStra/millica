@extends('layout')

@section('content')

    <div class="container">
        <div class="col-xs-12">
            <div class="resend_email">
            <h3{!! $meta->getMeta('send_email') !!}</h3>
                <form action="{{route('resend_verify_email')}}" method="post">
                    {{csrf_field()}}
                    <input class="resend_token_button" type="submit" value="Resend Code">
                </form>
            </div>
        </div>
    </div>

@endsection