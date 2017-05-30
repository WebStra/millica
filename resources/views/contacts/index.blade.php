@extends('layout')

@section('content')
    <section class="contacts_info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h3>{!! $meta->getMeta('contatcs_title') !!}</h3>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form action="{{route('send_contact_form')}}" method="post">
                        {{csrf_field()}}
                        <label for="name"> {!! $meta->getMeta('contatcs_name') !!}</label>
                        <input type="text" name="name" id="name" value="{{old('name')}}">
                        <label for="email">{!! $meta->getMeta('contatcs_email') !!}</label>
                        <input type="text" name="email" id="email" value="{{old('email')}}">
                        <label for="phone">{!! $meta->getMeta('contatcs_phone') !!}</label>
                        <input type="text" name="phone" id="phone" value="{{old('phone')}}">
                        <label for="subject">{!! $meta->getMeta('contatcs_subject') !!}</label>
                        <textarea name="body" id="subject" value="{{old('body')}}"></textarea>
                        <input type="submit" value="{!! $meta->getMeta('contatcs_send') !!}">
                    </form>
                </div>
                <div class="col-sm-offset-1 col-sm-3">
                    <h3>{!! $meta->getMeta('contatcs_t') !!}</h3>
                    <div class="contacts_details">
                        <span><i class="fa fa-map-marker" aria-hidden="true"></i>{{settings()->getOption('contact::adress')}}</span>
                        <span><i class="fa fa-phone" aria-hidden="true"></i>{{settings()->getOption('contact::phone')}}</span>
                        <span><i class="fa fa-paper-plane-o" aria-hidden="true"></i>{{settings()->getOption('contact::email')}}</span>
                    </div>
                    <div class="contacts_program">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <h4>{!! $meta->getMeta('contatcs_program') !!}</h4>
                        <span>{!! $meta->getMeta('contatcs_orar') !!}</span>
                    </div>
                    <div class="contacts_social">
                        <h4>{!! $meta->getMeta('contatcs_social_title') !!}</h4>
                        <a href="{{settings()->getOption('contact::facebook')}}"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                        <a href="{{settings()->getOption('contact::instagram')}}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="{{settings()->getOption('contact::pinterest')}}"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection