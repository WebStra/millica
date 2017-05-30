@extends('administrator::layout')

@section('content')
    <div class="content body">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Produse Comandate:</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <th>ID</th>
                            <th>Imagine</th>
                            <th>Denumire</th>
                            <th>Cantitate</th>
                            <th>Culoare</th>
                            <th>Marime</th>
                            <th>Pret</th>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($productscomand as $item)
                                <?php  $product = $item->getProduct()->first(); ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img width="50" height="70" src="{{$product->present()->renderCoverImage()}}"
                                             alt=""></td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->color}}</td>
                                    <td>{{$item->size}}</td>
                                    <td>{{$product->price}} RON</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Date client pentru Livrare</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td>Nume:</td>
                                <td>{{$comand->delname}}</td>
                            </tr>
                            <tr>
                                <td>Telefon:</td>
                                <td>{{$comand->delphone}}</td>
                            </tr>
                            <tr>
                                <td>Adresa:</td>
                                <td>{{$comand->deladress}}</td>
                            </tr>
                            <tr>
                                <td>Judet:</td>
                                <td>{{$comand->deljudet}}</td>
                            </tr>
                            <tr>
                                <td>Localitate:</td>
                                <td>{{$comand->dellocation}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Date client pentru Facturare</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td>Nume:</td>
                                <td>{{$comand->facname}}</td>
                            </tr>
                            <tr>
                                <td>Telefon:</td>
                                <td>{{$comand->facphone}}</td>
                            </tr>
                            <tr>
                                <td>Adresa:</td>
                                <td>{{$comand->facadress}}</td>
                            </tr>
                            <tr>
                                <td>Judet:</td>
                                <td>{{$comand->facjudet}}</td>
                            </tr>
                            <tr>
                                <td>Localitate:</td>
                                <td>{{$comand->faclocation}}</td>
                            </tr>
                            <tr>
                                <td>CNP:</td>
                                <td>{{$comand->cnp}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Date suplimentare</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td>Nume cont:</td>
                                <td>{{$comand->contname}}</td>
                            </tr>
                            <tr>
                                <td>Nume phone:</td>
                                <td>{{$comand->contphone}}</td>
                            </tr>
                            <tr>
                                <td>Metoda de plata:</td>
                                <td>{{$comand->payment}}</td>
                            </tr>
                            <tr>
                                <td>Livrare:</td>
                                <td>
                                    @if($comand->price >= 200)
                                        <span class="label label-success">Livrare Gratuita</span>
                                    @else
                                        <span class="label label-warning">Livrare cu plata</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Total spre achitare:</td>
                                <td><b>{{$comand->price}} RON </b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        @if(!$comand->awb_code)
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Genereaza AWB pentru produs</h3>
                        </div>
                        <form action="{{route('generate_awb')}}" method="post">
                            <div class="box-body">
                                {{csrf_field()}}
                                <input type="hidden" name="confirm_code" value="{{$comand->confirm_code}}">
                                <div class="row">

                                    <div class="col-sm-4">
                                        <br>
                                        <label for="plicuri">Nr. Plicuri</label>
                                        <input class="form-control" id="plicuri" type="text" name="plic"
                                               value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <br>
                                        <label for="colete">Nr.Colete</label>
                                        <input class="form-control" id="colete" type="text" name="colet"
                                               value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <br>
                                        <label for="greutate">Greutate</label>
                                        <input class="form-control" id="greutate" type="text" name="greutate"
                                               value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <br>
                                        <label for="inaltime">Inaltime</label>
                                        <input class="form-control" id="inaltime" type="text" name="inaltime"
                                               value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <br>
                                        <label for="latime">Latime</label>
                                        <input class="form-control" id="latime" type="text" name="latime"
                                               value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <br>
                                        <label for="valoare">Valoare declarata</label>
                                        <input class="form-control" id="valoare" type="text" name="value"
                                               value="0">
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <label for="expeditor">Persoana Contact(Expeditor *Nume Prenume) </label>
                                        <input class="form-control" id="expeditor" type="text" name="persoana">
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <label for="continut">Continut </label>
                                        <input class="form-control" id="continut" type="text" name="continut">
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <label for="detalii">Observatii </label>
                                        <textarea class="form-control" id="detalii" name="detalii"></textarea>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Genereaza</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <a data-toggle="modal" data-target="#myModal"
                   style="background: #000;display: inline-block;max-width: 200px;text-align: center;padding: 15px;font-size: 18px;color: #fff;font-weight: 800;"
                   href="#">Vezi AWB</a>

                <a style="background: #000;display: inline-block;max-width: 200px;text-align: center;padding: 15px;font-size: 18px;color: #fff;font-weight: 800;"
                   href="https://www.selfawb.ro/view_awb_pdf.php?nr={{$comand->awb_code}}" target="_blank">Descarca
                    AWB</a>
            </div>
    @endif
    <!-- /.box-body -->
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width:680px; text-align: center; margin:0 auto;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {!! \FanCourier::getAwb(['nr'=>$comand->awb_code]) !!}
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')

@endsection

