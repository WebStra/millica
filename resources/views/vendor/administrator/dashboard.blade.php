@extends('administrator::layout')

@section('content')
    <div class="content body">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Comenzile Millica</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Utilizator</th>
                            <th>Telefon</th>
                            <th>Status</th>
                            <th>Pret</th>
                            <th>Livrare</th>
                            <th>CNP</th>
                            <th>Data</th>
                            <th>Generat AWB</th>
                            <th>Vezi comanda</th>
                            <th>Sterge</th>
                        </tr>
                        @foreach($comand as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->delname}}</td>
                                <td>{{$item->delphone}}</td>
                                <td>
                                    @if($item->payment_status == 'pending')
                                        <span class="label label-danger">Ne achitat</span>
                                    @elseif($item->payment_status == 'paid')
                                        <span class="label label-success">Achitat</span>
                                    @elseif($item->payment_status == 'curier')
                                        <span class="label label-warning">Plata la Curier</span>
                                    @endif
                                </td>
                                <td>{{$item->price}} RON</td>
                                <td>
                                    @if($item->price >= 200)
                                        <span class="label label-success">Livrare Gratuita</span>
                                    @else
                                        <span class="label label-warning">Livrare cu plata</span>
                                    @endif
                                </td>
                                <td>{{$item->cnp}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>@if($item->awb_code) <i class="fa fa-fw fa-check" style="color: #605ca8;"></i>@else <i style="color: red;" class="fa fa-times" aria-hidden="true"></i> @endif </td>
                                <td><a href="{{route('admin_comand',['id'=>$item->confirm_code])}}">Vezi Detalii</a></td>
                                <td><a href="{{route('delete_comand',['code'=>$item->confirm_code])}}"><span class="label label-danger">&times;</span></a></td>
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
@endsection

@section('js')

@endsection

