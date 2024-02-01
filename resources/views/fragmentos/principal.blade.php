@extends('template')
@section('cuerpo')
    <div class="container">
        <div class="row">
            @foreach($noticias as $item)
                <div class="col-4" style="padding: 5px">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->titulo}}</h5>
                            <p class="card-text">{{$item->cuerpo}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection