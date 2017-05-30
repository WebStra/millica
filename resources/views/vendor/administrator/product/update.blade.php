@extends('administrator::layout')

@section('content')
    <style>
        .custom-header {
            background: #605ca8;
            color: #fff;
            padding: 5px;
            text-align: center;
        }

        li span {
            font-weight: 800;
        }

        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
            width: 85%;
        }
        .sizes_same,
        .same_prod{
            background:#f1f1f1;
        }
        form {
            background: #fff;
            padding: 10px 0;
            width:100%;
            color: #000;
        }
    </style>
    <div class="col-md-12">

        {!! Form::open(['url' => route('upload-post',['id'=>$_REQUEST['id']]), 'method' => 'post', 'class' => 'dropzone', 'files'=>true, 'id'=>'real-dropzone']) !!}

        <div class="dz-message">

        </div>

        <div class="fallback">
            <input name="file[]" type="file" multiple/>
        </div>

        <div class="dropzone-previews" id="dropzonePreview">

        </div>

        <h4 style="text-align: center;color:#428bca;">Drop images in this area <span
                    class="glyphicon glyphicon-hand-down"></span></h4>

        {!! Form::close() !!}

        <div class="jumbotron how-to-create">
            <ul>
                <li>Images are uploaded as soon as you drop them</li>
                <li>Maximum allowed size of image is 8MB</li>
            </ul>
        </div>

        <!-- Dropzone Preview Template -->
        <div id="preview-template" style="display: none;">

            <div class="dz-preview dz-file-preview">
                <div class="dz-image"><img data-dz-thumbnail=""></div>

                <div class="dz-details">
                    <div class="dz-size"><span data-dz-size=""></span></div>
                    <div class="dz-filename"><span data-dz-name=""></span></div>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

                <div class="dz-success-mark">
                    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                        <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                        <title>Check</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                           sketch:type="MSPage">
                            <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                                  id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475"
                                  fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                        </g>
                    </svg>
                </div>

                <div class="dz-error-mark">
                    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                        <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                        <title>error</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                           sketch:type="MSPage">
                            <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474"
                               stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                                      id="Oval-2" sketch:type="MSShapeGroup"></path>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
<div class="col-xs-12">
    <H3>Produs Curent Titlu: <b>{{$getProduct->title}}</b></H3>
</div>
    <div class="col-xs-12 col-sm-12">
        <br><br>
        <h4><b>Produse Asemanatoare</b></h4>
        <div class="same_prod">
            <form class="form-inline" action="{{route('add_same_prod')}}" method="post">
                {{csrf_field()}}
                <select name="this_id" class="myselect" style="color:#000;">
                    @foreach($categoryProduct as $item)
                        <option value="{{$item->id}}"
                                data-content="<img width='30' src='{{$item->present()->renderCoverImage()}}' alt='' /> {{$item->title}} ">{{$item->title}}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" value="{{$_REQUEST['id']}}" name="product_id">
                <button type="submit" class="btn btn-default" style="height: 60px;">Adauga</button>
            </form>

            <table class="table" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Imagine</th>
                    <th>Titlu</th>
                    <th>Setari</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sameProducts as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td><img width="40" src="{{$item->getProduct->present()->renderCoverImage()}}" alt=""></td>
                        <td>{{$item->getProduct->title}}</td>
                        {{--<td>{{$item->getProduct->color}}</td>--}}
                        <td><a href="{{route('delete_same',['id'=>$item->id])}}"><span class="label label-danger">Sterge</span></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <br><br>
    </div>
    <hr>

    <div class="col-xs-12 col-sm-12">
        <h4><b>Marimile produsului</b></h4>
        <div class="sizes_same">
            <form class="form-inline" action="{{route('add_sizes')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="product_id" value="<?php echo $_REQUEST['id']; ?>">
                <div class="form-group">
                    <label for="addSize">Marime:</label>
                    <input style="height: 35px;" type="text" class="form-control" id="addSize" placeholder="Enter Size"
                           name="size">
                </div>
                <div class="form-group">
                    <label for="quantitySize">Cantitate:</label>
                    <input style="height: 35px;" type="text" class="form-control" id="quantitySize"
                           placeholder="Cantitate"
                           name="quantity">
                </div>
                <button type="submit" class="btn btn-default" style="height: 35px;">Adauga</button>
            </form>

            <table class="table" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Marime</th>
                    <th>Cantitate</th>
                    <th>Setari</th>
                </tr>
                </thead>
                <tbody>
                @foreach($prodSizes as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>
                            <form style="background:transparent;" method="post">
                                {{csrf_field()}}
                                <input type="text" name="count_size" value="{{$item->count}}">
                                <input type="hidden" name="size_id" value="{{$item->id}}">
                                <input class="submit_this_form" type="submit" style="background:green;color:#fff;border: none;height: 26px;border-radius:3px;" value="Salveaza">
                            </form>
                        </td>
                        <td><a href="{{route('delete_sizes',['id'=>$item->id])}}"><span class="label label-danger">Sterge</span></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <hr>
    <div class="col-xs-12">
        <h3>Filters</h3>
        <div class="row">
            <div class="col-md-4">
                <select id='sizes' multiple='multiple'>
                    @foreach($sizes as $item)
                        <option @if(count(\App\Product::where('id', $_REQUEST['id'])->withAnyTags($item->title)->first()) > 0) {{'selected'}} @endif value='{{$item->title.'~size'}}'>{{$item->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <select id='colors' multiple='multiple'>
                    @foreach($colors as $item)
                        <option @if(count(\App\Product::where('id', $_REQUEST['id'])->withAnyTags($item->title)->first()) > 0) {{'selected'}} @endif value='{{$item->title.'~color'}}'>{{$item->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <select id='season' multiple='multiple'>
                    @foreach($season as $item)
                        <option @if(count(\App\Product::where('id', $_REQUEST['id'])->withAnyTags($item->title)->first()) > 0) {{'selected'}} @endif value='{{$item->title.'~sezon'}}'>{{$item->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <br>
                <select id='adding' multiple='multiple'>
                    @foreach($aditional as $item)
                        <option @if(count(\App\Product::where('id', $_REQUEST['id'])->withAnyTags($item->title)->first()) > 0) {{'selected'}} @endif value='{{$item->title.'~aditional'}}'>{{$item->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {!! Form::hidden('csrf-token', csrf_token(), ['id' => 'csrf-token']) !!}
    <?php $id = $_REQUEST['id']; ?>
@endsection

@section('js')

    <script>
        $('.submit_this_form').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form').serialize();

            $.ajax({
                type: 'POST',
                url: '{{route('update_size')}}',
                data:form,
                dataType: 'json',
                success: function (data) {

                }
            });

        });
    </script>

    <script>
        $('#sizes').multiSelect({
            afterSelect: function (values) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('add_filter',['id'=>$id])}}',
                    data: {value: values, _token: $('#csrf-token').val()},
                    dataType: 'html',
                    success: function (data) {

                    }
                });
            },
            afterDeselect: function (values) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('delete_filter',['id'=>$id])}}',
                    data: {value: values, _token: $('#csrf-token').val()},
                    dataType: 'html',
                    success: function (data) {

                    }
                });
            },
            selectableHeader: "<div class='custom-header'>Marimi disponibile</div>",
            selectionHeader: "<div class='custom-header'>Marimi atasate</div>",
        });

        $('#colors').multiSelect({
            afterSelect: function (values) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('add_filter',['id'=>$id])}}',
                    data: {value: values, _token: $('#csrf-token').val()},
                    dataType: 'html',
                    success: function (data) {

                    }
                });
            },
            afterDeselect: function (values) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('delete_filter',['id'=>$id])}}',
                    data: {value: values, _token: $('#csrf-token').val()},
                    dataType: 'html',
                    success: function (data) {

                    }
                });
            },
            selectableHeader: "<div class='custom-header'>Culori disponibile</div>",
            selectionHeader: "<div class='custom-header'>Culori atasate</div>",
        });

        $('#season').multiSelect({
            afterSelect: function (values) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('add_filter',['id'=>$id])}}',
                    data: {value: values, _token: $('#csrf-token').val()},
                    dataType: 'html',
                    success: function (data) {

                    }
                });
            },
            afterDeselect: function (values) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('delete_filter',['id'=>$id])}}',
                    data: {value: values, _token: $('#csrf-token').val()},
                    dataType: 'html',
                    success: function (data) {

                    }
                });
            },
            selectableHeader: "<div class='custom-header'>Sezoane disponibile</div>",
            selectionHeader: "<div class='custom-header'>Sezoane atasate</div>",
        });

        $('#adding').multiSelect({
            afterSelect: function (values) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('add_filter',['id'=>$id])}}',
                    data: {value: values, _token: $('#csrf-token').val()},
                    dataType: 'html',
                    success: function (data) {

                    }
                });
            },
            afterDeselect: function (values) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('delete_filter',['id'=>$id])}}',
                    data: {value: values, _token: $('#csrf-token').val()},
                    dataType: 'html',
                    success: function (data) {

                    }
                });
            },
            selectableHeader: "<div class='custom-header'>Alte filtre</div>",
            selectionHeader: "<div class='custom-header'>Atasate</div>",
        });
    </script>

    <script type="text/javascript">
        var photo_counter = 0;
        Dropzone.options.realDropzone = {
            uploadMultiple: false,
            parallelUploads: 100,
            maxFilesize: 8,
            previewsContainer: '#dropzonePreview',
            previewTemplate: document.querySelector('#preview-template').innerHTML,
            addRemoveLinks: true,
            dictRemoveFile: 'Sterge',
            dictFileTooBig: 'Image is bigger than 8MB',

            // The setting up of the dropzone
            init: function () {

                // Add server images
                var myDropzone = this;

                $.get('{{route('prod_images',['id'=>$id])}}', function (data) {

                    $.each(data.images, function (key, value) {
                        var file = {name: value.original, size: value.size};
                        myDropzone.options.addedfile.call(myDropzone, file);
                        myDropzone.options.thumbnail.call(myDropzone, file, '/upload/products/' + value.server);
                        myDropzone.emit("complete", file);
                        photo_counter++;
                        $("#photoCounter").text("(" + photo_counter + ")");
                    });
                });

                this.on("removedfile", function (file) {

                    $.ajax({
                        type: 'POST',
                        url: 'delete/image',
                        data: {id: file.name, _token: $('#csrf-token').val()},
                        dataType: 'html',
                        success: function (data) {
                            var rep = JSON.parse(data);
                            if (rep.code == 200) {
                                photo_counter--;
                                $("#photoCounter").text("(" + photo_counter + ")");
                            }

                        }
                    });

                });
            },
            error: function (file, response) {
                if ($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.message;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            },
            success: function (file, done) {
                photo_counter++;
                $("#photoCounter").text("(" + photo_counter + ")");
            }
        }
    </script>


@endsection

