@extends('layout')

@section('content')
    <section class="settings">
        <div class="container">
            <div class="container">
                <h3 class="title"><span>{!! $meta->getMeta('settings_name') !!}</span></h3>
                <div class="row">
                    <div class="col-sm-3">
                        @include('auth.settings.partials.menu')
                    </div>
                    <div class="col-sm-9">
                        @yield('section')
                    </div>
                </div>
                <div class="last_bar">
                    <span>{!! $meta->getMeta('settings_choose') !!}</span>
                </div>
            </div>
        </div>
    </section>
@endsection
