@extends('administrator::layout')

@section('content')
    <div class="content body">
        <form action="{{route('create_promo_code')}}" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="promo_code">Promo Code</label>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success random_generate">Genereaza Automat</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control" id="promo_code" placeholder="Enter code"
                                   name="code">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?php $category = \App\Category::get(); ?>
                    <div class="form-group">
                        <label for="categ">Selecteaza categoria:</label>
                        <select name="category[]" id="categ" class="js-example-basic-multiple form-control"
                                multiple="multiple">
                            @foreach($category as $item)
                                <option value="{!! $item->id !!}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Data Start:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="start_date" class="form-control pull-right datepicker">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Data Sfirsit:</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="end_date" class="form-control pull-right datepicker">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Selecteaza tipul:</label>
                        <select class="form-control" name="type">
                            <option value="procent">Promo Procent</option>
                            <option value="bani">Promo Bani</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="valoare">Suma sau procentul reducerii:</label>
                        <input type="text" class="form-control" id="valoare" placeholder="Valoarea" name="value">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 40px;">Creaza Promo
                        Cod
                    </button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Promo Codu-ri create</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Codul</th>
                            <th>Category</th>
                            <th>Tip Oferta</th>
                            <th>Valoare</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Statut Oferta</th>
                            <th>Setari</th>
                        </tr>
                        <?php $i = 1; ?>
                        @foreach($code as $item)

                            <tr>
                                <td>{{$i++}}.</td>
                                <td>{{$item->code}}</td>
                                <td>@foreach($item->getPromoCategory as $category)
                                        [{{\App\Category::where('id',$category->category_id)->first()->title}}],
                                    @endforeach
                                </td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->value}} @if($item->type == 'procent') % @else RON @endif</td>
                                <td>{{$item->start_date}}</td>
                                <td>{{$item->end_date}}</td>
                                <td>
                                    @if(\Carbon\Carbon::parse($item->end_date) > \Carbon\Carbon::now() && \Carbon\Carbon::parse($item->start_date) <= \Carbon\Carbon::now())

                                        <span class="badge bg-green">Zile ramase: {{\Carbon\Carbon::parse($item->end_date)->diffInDays()}}</span>
                                    @elseif(\Carbon\Carbon::parse($item->end_date) > \Carbon\Carbon::now() && \Carbon\Carbon::parse($item->start_date) >= \Carbon\Carbon::now())
                                        <span class="badge bg-orange">Oferta incepe in: @if(\Carbon\Carbon::parse($item->start_date)->diffInDays() > 0) {{\Carbon\Carbon::parse($item->start_date)->diffInDays()}} @else {{\Carbon\Carbon::parse($item->start_date)->diffInHours()}} @endif
                                            zile</span>
                                    @else
                                        <span class="badge bg-red">Codul a expirat</span>
                                    @endif
                                </td>
                                <td><a href="{{route('delete_promo_code',['id'=>$item->id])}}"
                                       class="btn btn-danger btn-xs">Sterge</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Promo Utilizate</h3>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Codul</th>
                                <th>Utilizari</th>
                                <th>Setari</th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach($usedCodes as $item)

                                <tr>
                                    <td>{{$i++}}.</td>
                                    <td>{{$item->code}}</td>
                                    <td><span class="badge bg-green">{{$item->count}}</span></td>
                                    <td><a href="{{route('delete_used_codes',['id'=>$item->id])}}"
                                           class="btn btn-danger btn-xs">Sterge</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistica grafica</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>

    <script>
        $('.random_generate').click(function (e) {
            e.preventDefault();

            var random = makeid();

            $('#promo_code').val(random);

        });

        function makeid() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            for (var i = 0; i < 10; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }
    </script>

    <script>
        //Date picker
        $('.datepicker').datepicker({
            autoclose: true
        });
    </script>

    <script>
        var donut = new Morris.Donut({
            element: 'sales-chart',
            resize: true,
            colors: [@foreach($usedCodes as $color) '{{'#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT)}}', @endforeach],
            data: [
                    @foreach($usedCodes as $item)
                {
                    label: '{{$item->code}}', value: '{{$item->count}}'
                },
                @endforeach
            ],
            hideHover: 'auto'
        });
    </script>
@endsection

