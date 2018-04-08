
@extends('layouts.app')
@section('title', 'S.C.Inventario')
@section('css')
<style>
    .rojo{
        color: #ff0000;
    }
    .amarillo{
        color: #ff9900;
    }
    .verde{
        color: #2ca02c;
    }
</style>

@section('content')

@if (Session::has('message'))
<div class="alert alert-success"></div>
@endif

@if (Session::has('exito'))
<div class="alert alert-success">
    <strong>{{Session::get('exito')}}</strong>
</div>
@endif
@if (Session::has('actualizado'))
<div class="alert alert-success">
    <strong>Whoops!</strong> Al parecer algo cambió.<br><br>
    <strong>{{Session::get('actualizado')}}</strong>
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">
    <strong>Whoops!</strong> Al parecer algo está mal.<br><br>
    <strong>{{Session::get('error')}}</strong>
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cat&aacute;logo de contenedores.</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="container-fluid">
                        <div class="row">
                            <div class="input-group"><span class="input-group-addon"> Buscar </span>
                                <input id="filtrar"  type="text"  class="form-control"  placeholder="Ingresa el identificador del contenedor" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6 col-md-offset-9">
                                {{ $containers->links()}}
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-12 col-md-12">
                                <div class="card card-table">

                                    @if(sizeof($containers) > 0)
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-borderless table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Identificador</th>
                                                    <th>Tipo</th>
                                                    <th>Ubicaci&oacute;n</th>
                                                    <th>Capacidad</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                @foreach ($containers as $container)
                                                <tr>
                                                    <td>{{$container->id}}</td>
                                                    @if($container->type == 1)
                                                        <td>Caja</td>
                                                    @else
                                                        <td>Tarima</td>
                                                    @endif
                                                    @if($container->ubication_id == 1)
                                                        <td>Recibo</td>
                                                    @elseif($container->ubication_id == 2)
                                                        <td>Almacenaje</td>
                                                    @else
                                                        <td>Surtido</td>
                                                    @endif
                                                    
                                                    @if($container->capacity == 1000)
                                                        <td class="rojo">{{$container->capacity}} productos</td>
                                                    @elseif($container->capacity >= 500 && $container->capacity <= 999)
                                                        <td class="amarillo">{{$container->capacity}} productos</td>
                                                    @else
                                                    <td class="verde">{{$container->capacity}} productos</td>
                                                    @endif
                                                    <td>
                                                        <a class="icon" href="/containers/{{$container->id}}/edit"><i class="material-icons">mode_edit</i></a>
                                                        <a class="icon" href="#"><i class="material-icons">remove_red_eye</i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <div class="alert alert-danger">
                                                <p>Al parecer no se han registrado contenedores. Los contenedores se crean al agregar productos.</p>
                                            </div>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('javascript')
    <script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/products/filter_catalogue.js') }}" type="text/javascript"></script>
    @endsection