@extends('auth.settings.layout')

@section('section')

    <div class="settings_account">
        <h3>{{$meta->getMeta('settings_password_modify')}}</h3>
        <form action="{{route('update_password')}}" method="post">
            {{csrf_field()}}
            <input type="password" name="old_password" placeholder="{{$meta->getMeta('password_old')}}">
            <input type="password" name="password" placeholder="{{$meta->getMeta('password_profile')}}">
            <input type="password" name="password_confirmation" placeholder="{{$meta->getMeta('password_profile_confirm')}}">
            <input type="submit" value="{{$meta->getMeta('save_password')}}">
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