@extends('auth.settings.layout')

@section('section')
    <div class="settings_account">
        <h3>{!! $meta->getMeta('profile_settings_title') !!}</h3>
        <form action="{{route('update_profile')}}" method="post">
            {{csrf_field()}}
            <input type="text" name="firstname" placeholder="{!! $meta->getMeta('profile_firstname') !!}" value="{{Auth::user()->firstname}}">
            <input type="text" name="lastname" placeholder="{!! $meta->getMeta('profile_lastname') !!}" value="{{Auth::user()->lastname}}">
            <input type="text" name="email" placeholder="{!! $meta->getMeta('profile_email') !!}" value="{{Auth::user()->email}}">

            <h3>Informatii Livrare</h3>
            <select name="judet"
                    class=""
                    data-live-search="true">
                <option value="">{!! $meta->getMeta('profile_judet') !!}</option>
                @foreach($cityes as $city)
                    <option @if(\Auth::user()->judet == $city) selected @endif value="{{$city}}">{{$city}}</option>
                @endforeach
            </select>
            <div class="deliveryjudet">
                @if(strlen(\Auth::user()->location) != 0)
                    <select name="location">
                        {!! $location !!}
                    </select>
                @else
                    <select name="location" disabled>
                        <option>{!! $meta->getMeta('profile_location') !!}</option>
                    </select>
                @endif
            </div>
            <input type="text" name="adress" placeholder="{!! $meta->getMeta('profile_location_addre') !!}" value="{{Auth::user()->adress}}">

            <input type="submit" value="{!! $meta->getMeta('profile_location_save')!!}">
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
    </div>
@endsection

@section('js')
    <script>
        $('select[name=judet]').change(function () {
            var judet = $("select[name=judet] option:selected").val();
            $.ajax({
                url: '{{route('get_location')}}',
                method: 'POST',
                dataType: 'json',
                data: {judet: judet},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('select[name=location]').html(response);
                    $('select[name=location]').removeAttr('disabled');
                }
            });
        });
    </script>
@endsection