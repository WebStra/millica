<section class="last_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>{!! $meta->getMeta('footer_a') !!}<strong> & </strong>{!! $meta->getMeta('footer_l') !!}</h3>
                <ul>
                    @foreach($pages->getByType('payment_delivery') as $page)
                        <li><a href="{{ route('show_page',['page' => $page->slug] ) }}">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-offset-1 col-sm-3">
                <h3>{!! $meta->getMeta('footer_help') !!}</h3>
                <ul>
                    <li><a href="{{route('view_contacts')}}">{!! $meta->getMeta('footer_contacts') !!}</a></li>
                    @foreach($pages->getByType('help') as $page)
                        <li><a href="{{ route('show_page',['page' => $page->slug] ) }}">{{ $page->title }}</a></li>
                    @endforeach
                    <li><a href="http://www.anpc.gov.ro" target="_blank">{!! $meta->getMeta('footer_anccp') !!}</a></li>
                </ul>
            </div>
            <div class="col-sm-offset-1 col-sm-3">
                <h3>despre noi</h3>
                <ul>
                    <li><a href="{{ route('show_about',['page' => 'about'] ) }}">{!! $meta->getMeta('footer_menu_about') !!}</a></li>
                    <li><a href="{{route('all_products')}}">{!! $meta->getMeta('footer_menu_prod') !!}</a></li>
                    {{--<li><a href="/favorite_products.php">{!! $meta->getMeta('footer_menu_fav') !!}</a></li>--}}
                    <li><a href="{{route('blog_index')}}">{!! $meta->getMeta('footer_menu_blog') !!}</a></li>
                    <li><a href="{{route('get_sale_products')}}">{!! $meta->getMeta('footer_menu_discount') !!}</a></li>
                </ul>
            </div>
        </div>
        <img class="logo_last img-responsive" src="/assets/images/logo_last.png">
    </div>
    <div class="last_contacts">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="last_contacts_block">
                        <img src="/assets/images/icon/ic7_1.png">
                        <span>{!! $meta->getMeta('footer_title_adress') !!}<br>{{settings()->getOption('contact::adress')}}</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="last_contacts_block">
                        <img src="/assets/images/icon/ic7_2.png">
                        <span>{!! $meta->getMeta('footer_title_phone') !!}<br>{{settings()->getOption('contact::phone')}}</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="last_contacts_block">
                        <img src="/assets/images/icon/ic7_3.png">
                        <span>{!! $meta->getMeta('footer_title_email') !!} <br>{{settings()->getOption('contact::email')}}</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="last_contacts_block">
                        <img src="/assets/images/icon/ic7_4.png">
                        <span>{!! $meta->getMeta('footer_title_program') !!} <br>{{settings()->getOption('contact::orar')}}</span>
                    </div>
                </div>
            </div>
            <ul class="social">
                <li>
                    <a href="{{settings()->getOption('contact::facebook')}}" target="_blank"><i
                                class="fa fa-facebook-square" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="{{settings()->getOption('contact::instagram')}}" target="_blank"><i class="fa fa-instagram"
                                                                                                 aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="{{settings()->getOption('contact::pinterest')}}" target="_blank"><i
                                class="fa fa-pinterest-square" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <span>Copyright © 2017.</span>
            </div>
            <div class="col-sm-offset-2 col-sm-4">
                <ul>
                    <li>
                        <a href=""><i class="fa fa-cc-visa" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-cc-mastercard" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

@include('partials.assets.js')