@extends('auth.settings.layout')

@section('section')
    <section class="basket">
            <table class="table">
                <thead>
                <tr>
                    <th>Numele</th>
                    <th>Adresa</th>
                    <th>Data</th>
                    <th>Detalii</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comand as $item)
                    <tr class="">
                        <td>{{$item->facname}}</td>
                        <td>{{$item->facadress}}</td>
                        <td>{{$item->created_at}}</td>
                        <td><a href="{{route('show_comand',['id'=>$item->confirm_code])}}">Vezi detalii</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </section>
@endsection