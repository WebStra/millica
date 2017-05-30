@extends('layout')

@section('content')
    <section class="login">
        <div class="container">
            <!-- form registration -->
            <div class="registration_form">
                <h3>{!! $meta->getMeta('login_page_title') !!}</h3>
                <form action="{{route('post_login')}}" method="post">
                    {{csrf_field()}}
                    <input type="text" name="email" placeholder="{!! $meta->getMeta('login_name') !!}" value="{{old('email')}}">
                    <input type="password" name="password" placeholder="{!! $meta->getMeta('login_password') !!}" value="{{old('password')}}">
                    <input type="submit" value="{!! $meta->getMeta('login_submit') !!}">
                </form>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <span> {!! $meta->getMeta('login_missing_account') !!}<a  href="{{route('get_register')}}">{!! $meta->getMeta('login_missing_account_create') !!}</a></span>
                <br>
                <span> {!! $meta->getMeta('login_remember_password') !!}<a href="{{route('reset_password')}}">{!! $meta->getMeta('login_reset') !!}</a></span>
            </div>
            <!-- end form registration -->
        </div>
    </section>
@endsection
