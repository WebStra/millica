<header class="head_bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <a class="logo_header_" href="{{route('home')}}"><img class=" logo img-responsive"
                                                                      src="/assets/images/logo.png" alt=""></a>
            </div>
            <div class="col-sm-5">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        @if(\Auth::user())
                            <a class="visible-xs name_on_xs" href="{{route('change_profile')}}"><img
                                        src="/assets/images/icon/om.png">{{\Auth::user()->firstname}} {{\Auth::user()->lastname}}
                            </a>
                        @endif
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="menu nav">
                                <li><a href="{{route('home')}}">{!! $meta->getMeta('menu_home') !!}</a></li>
                                <div class="dropdown">
                                    <li>
                                        <a class="dropbtn visible-xs"
                                           href="#">{!! $meta->getMeta('menu_products') !!}</a>
                                        <a class="dropbtn hidden-xs"
                                           href="{{route('all_products')}}">{!! $meta->getMeta('menu_products') !!}</a>
                                    </li>
                                    <div class="dropdown-content">
                                        <a class="visible-xs" href="{{route('all_products')}}">Toate Produsele</a>
                                        @foreach($category as $item)
                                            <a href="{{route('get_category',['id'=>$item->id, 'title'=>str_slug($item->title)])}}">{{$item->title}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <li>
                                    <a href="{{ route('show_about',['page' => 'about'] ) }}">{!! $meta->getMeta('menu_about') !!}</a>
                                </li>
                                <li><a href="{{route('get_sale_products')}}">{!! $meta->getMeta('menu_discount') !!}</a>
                                </li>
                                <li><a href="{{route('blog_index')}}">{!! $meta->getMeta('menu_blog') !!}</a></li>
                                <li><a href="{{route('view_contacts')}}">{!! $meta->getMeta('menu_contacts') !!}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-sm-5">
                <div class="head_info">
                    <a href="" class="hidden-xs"><img
                                src="/assets/images/icon/phone.png"> {{settings()->getOption('contact::phone')}}</a>
                    <a href="" class="open_search_input loop">
                        <img src="/assets/images/icon/loop.png">
                    </a>

                    <a class="header_bar_basket_link" href="{{route('show_favorite')}}">
                        <img width="25" src="/assets/images/heart.png">
                        <span class="basket_product_count my_favorite_products"> ({{(isset($countFavoriteProducts)) ? $countFavoriteProducts : '0'}})</span>
                    </a>

                    <a class="header_bar_basket_link" href="{{route('view_basket')}}">
                        <img width="23" src="/assets/images/icon/cos.png">
                        <span class="basket_product_count"> ({{(isset($itemInBasket)) ? $itemInBasket : '0'}})</span>
                    </a>
                    @if(!\Auth::user())
                        <a href="{{route('get_login')}}">{!! $meta->getMeta('menu_log') !!}</a>
                        <a href="{{route('get_register')}}">{!! $meta->getMeta('menu_inreg') !!}</a>
                    @else
                        <div class="dropdown hidden-xs">
                            <li><a href="">{{\Auth::user()->firstname}} {{\Auth::user()->lastname}} <img
                                            src="/assets/images/icon/om.png"></a></li>
                            <div class="dropdown-content">
                                <a href="{{route('change_profile')}}">Setari</a>
                                <a onclick="return confirm('Sunteti sigur?');"
                                   href="{{route('logout')}}">{!! $meta->getMeta('menu_exit') !!}</a>
                            </div>
                        </div>
                    @endif
                    <div class="dropdown lang_dropdown" style="display: none;">
                        <button class="my_lang_drop dropdown-toggle" type="button" data-toggle="dropdown">
                            <img src="/assets/images/icon/flag_{{$languages['current']->slug}}.png">{{$languages['current']->slug}}
                            <img class="lang_arrow" src="/assets/images/icon/arrow_select.png" alt="">
                        </button>
                        @if(isset($languages['other']))
                            <ul class="dropdown-menu lang_menu">
                                @foreach($languages['other'] as $lang)
                                    <li>
                                        <a href="/{{ $lang->slug }}"><img
                                                    src="/assets/images/icon/flag_{{$lang->slug}}.png">{{$lang->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@include('partials.header.search')