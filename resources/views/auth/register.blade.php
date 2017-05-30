@extends('layout')

@section('content')
    <section class="login">
        <div class="container">
            <div class="registration_form">
                <h3>{!! $meta->getMeta('register_title') !!}</h3>
                <form action="{{route('post_register')}}" method="post">
                    {{csrf_field()}}
                    <input type="text" name="firstname" placeholder="{{$meta->getMeta('register_name')}}" value="{{old('firstname')}}">
                    <input type="text" name="lastname" placeholder="{{$meta->getMeta('register_last_name')}}" value="{{old('lastname')}}">
                    <input type="text" name="email" placeholder="{{$meta->getMeta('register_email')}}" value="{{old('email')}}">
                    <input type="text" name="phone" placeholder="{{$meta->getMeta('register_phone')}}" value="{{old('phone')}}">
                    <input type="password" name="password" placeholder="{{$meta->getMeta('register_password')}}">
                    <input type="password" name="password_confirmation" placeholder="{{$meta->getMeta('register_confirm_password')}}">
                    <input type="submit" value="{{$meta->getMeta('register_submit')}}">
                </form>
                <span>{{$meta->getMeta('register_missing_acc')}} <a  href="{{route('get_login')}}">{{$meta->getMeta('register_login')}}</a></span>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
