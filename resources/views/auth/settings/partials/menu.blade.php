<?php $menu =\Route::currentRouteName(); ?>
<div class="myaccount">
    <div class="head_myaccount">
        <span>{{$meta->getMeta('settings_title')}}</span>
    </div>
    <div class="body_myaccount">
        <ul>
            <li class="{{($menu == 'change_profile') ? 'active' : ''}}">
                <a href="{{route('change_profile')}}">{{$meta->getMeta('settings_settings')}}
                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                </a>
            </li>
            <li class="{{($menu == 'change_password') ? 'active' : ''}}">
                <a href="{{route('change_password')}}">{{$meta->getMeta('settings_password')}}
                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                </a>
            </li>
            <li class="{{($menu == 'show_favorite') ? 'active' : ''}}">
                <a href="{{route('show_favorite')}}">{{$meta->getMeta('settings_favorite')}}
                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                </a>
            </li>
            <li class="{{($menu == 'comand_page') ? 'active' : ''}}">
                <a href="{{route('comand_page')}}">Comenzile mele
                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a onclick="return window.confirm('Sunteti sigur ca doriti sa parasiti pagina?')"
                   href="{{route('logout')}}">{{$meta->getMeta('settings_quit')}}
                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </div>
</div>