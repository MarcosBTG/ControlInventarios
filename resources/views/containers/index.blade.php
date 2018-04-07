
@extends('layouts.app')
@section('title', 'S.C.Inventario')

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
                                <input id="filtrar"  type="text"  class="form-control"  placeholder="Ingresa el SKU o el nombre del producto" >
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col col-md-6 col-md-offset-9">
                                <a href="/products/create" class="btn btn-primary small">Agregar Contenedor</a>
                            </div>
                            <div class="col col-md-6 col-md-offset-4">
                                {{ $products->links()}}
                            </div>
                        <div class="row"> 
                            <div class="col-12 col-md-12">
                                <div class="card card-table">

                                    @if(sizeof($products) > 0)
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-borderless table-hover">
                                            <thead>
                                                <tr>
                                                    <th>SKU</th>
                                                    <th>Nombre</th>
                                                    <th>Descripci&oacute;n</th>
                                                    <th>Contenedor</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                @foreach ($products as $product)
                                                <tr>
                                                    <td>{{$product->sku}}</td>
                                                    <td>{{$product->name}}</td>
                                                    <td>{{$product->description}}</td>
                                                    <td>{{$product->container_id}}</td>
                                                    <td>
                                                        <a class="icon" href="/products/{{$product->id}}/edit"><i class="material-icons">mode_edit</i></a>
                                                        <a class="icon" href="#"><i class="material-icons">clear</i></a>
                                                        <a class="icon" href="#"><i class="material-icons">local_shipping</i></a>
                                                        <a class="icon" href="#"><i class="material-icons">remove_red_eye</i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <div class="alert alert-danger">
                                                <p>Al parecer no se ha registrado productos. Registra uno.</p>
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