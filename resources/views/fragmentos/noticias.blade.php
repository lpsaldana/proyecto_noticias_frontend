@extends('template')
@section('cuerpo')
    <div class="container">
        <div class="row">
            <div class="card-col-12">
                <div class="card-body">
                    <h5 class="card-title">Administracion de noticia</h5>
                    <div class="container">
                        <a href="{{$base_url}}index.php/admin/noticias/nuevo" class="btn btn-success col-2">Nuevo</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Título</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($noticias as $item)
                                    <tr>
                                        <td>{{$loop ->iteration}}</td>
                                        <td>{{$item->titulo}}</td>
                                        <td>{{$item->fecha}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>    
        </div>
    </div>
@endsection