@extends('layout')

@section('content')
    <div class="container">
        <h3 class="title"><span>{!! $meta->getMeta('sale_tile') !!}</span></h3>
        <!-- <img class="img-responsive title_bar" src="/assets/images/bar_title.png" alt=""> -->
    </div>
    <section class="products_section">
        <div class="container">
            <div class="row bord_bottom">
                <div class="col-md-3 col-sm-4">
                    @include('product.partials.filters')
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="products_block_all">
                        <span>Total: <strong class="count_filtering_products"> {{$count}} </strong> {!! $meta->getMeta('sale_text') !!}</span>
                    </div>
                    <div class="show_all_products">
                        <div class="row">
                            @foreach($products as $item)
                                <div class="col-sm-3 col-xs-6">
                                    <a href="{{route('show_product', ['product'=>$item->id,'title'=>str_slug($item->title)])}}">
                                        <div class="products_block">
                                            <div class="products_block_head"
                                                 style="background:url({{$item->present()->renderCoverImage()}}); background-size: cover;">
                                                <div class="hover_produs">
                                                    <div class="add_to_favorite" data-id="{{$item->id}}" href="">
                                                        <i @if(count($isFavorite->getById($item->id)) > 0 )  class="fa fa-heart"
                                                           @else class="fa fa-heart-o"
                                                           @endif aria-hidden="true"></i></div>
                                                </div>
                                            </div>
                                            <div class="products_block_body">
                                                <h5>{{$item->present()->renderTitle()}}</h5>
                                                {!! $item->present()->renderPrice() !!}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        @include('product.partials.pagination')
                    </div>
                </div>
            </div>
            <div class="products_block_all">
                <span>Total: <strong class="count_filtering_products"> {{$count}} </strong> {!! $meta->getMeta('sale_text_last') !!}</span>
            </div>
        </div>
    </section>
@endsection

@section('js')

    <script>
        if (window.innerWidth < 768) {
            var expanded = false;

            $('.selectBox').click(function () {

                var $this = $(this).parent('div.products_details_body').children('div.checkboxes');

                if (!expanded) {
                    $this.show();
                    expanded = true;
                } else {
                    $this.hide();
                    expanded = false;
                }
            });
        }
    </script>
    
    <script>
        (function ($) {
            // On production change this value.
            var status_site = "{{ config('app.env') }}";

            function isEnabled(elm) {
                return elm.data('value') == 1;
            }

            function getCurrentUrlLink() {
                if (status_site == 'local') {
                    return window.location.protocol + '//'
                            + window.location.hostname
                            + window.location.pathname;
                }

                return window.location.protocol + '//'
                        + window.location.hostname
                        + ':' + window.location.port
                        + window.location.pathname;
            }

            function getUrlVars() {
                var vars = {}, hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

                if (hashes[0] != getCurrentUrlLink()) {
                    $.each(hashes, function (k, item) {
                        hash = item.split('=');
                        vars[hash[0]] = hash[1];
                    });

                    return vars;
                }

                return {};
            }

            function updateUrl(element) {
                var state = '';
                var title = 'Milica Filter';
                var url = getCurrentUrlLink();
                var vars = getUrlVars();
                var newVars = {};

                if (isEnabled(element)) {
                    newVars[element.attr("name")] = "on";

                    vars = $.extend(vars, newVars);
                } else {
                    if (vars[element.attr("name")]) {
                        delete vars[element.attr("name")];
                    }
                }

                var params = '';
                var $i = 0;
                var paramSeparator;
                $.each(vars, function (paramName, paramValue) {
                    if ($i == 0) {
                        paramSeparator = '?'
                    } else {
                        paramSeparator = '&';
                    }

                    params += paramSeparator + paramName + '=' + paramValue;
                    $i++;
                });
                $i = 0;

                window.history.pushState(state, title, url + params);
            }

            $("form.filtre input").on("change", function () { // only checkbox
                var $this = $(this); // this input changed
                var form = $this.parents('form'); // serialize the form
                var output_content = $('div.filter-result');

                output_content.html("Loading ...");

                if (isEnabled($this)) {
                    $this.data('value', 0);
                } else {
                    $this.data('value', 1);
                }
                updateUrl($this);

                $.ajax({
                    type: 'POST',
                    url: '{{route('filter_sale')}}',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('div.show_all_products').html(response.products);
                        $('strong.count_filtering_products').html(response.count);
                    }
                });
            });
        }(jQuery));
    </script>

@endsection