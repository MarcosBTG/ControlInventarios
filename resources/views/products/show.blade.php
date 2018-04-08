
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
                <div class="panel-heading">Cat&aacute;logo de productos.</div>

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
                                <a href="/products/create" class="btn btn-primary small">Agregar Producto</a>
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
                                                        <th>&Uacute;ltimo Contenedor</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="buscar">
                                                    @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{$product->sku}}</td>
                                                        <td>{{$product->name}}</td>
                                                        <td>{{$product->description}}</td>
                                                        <td>{{$product->container_id}}</td>
                                                        
                                                        @if($product->status == 0)
                                                        <td class="rojo"> Eliminado </td>
                                                        @elseif($product->status == 2)
                                                            <td class="amarillo"> Enviado </td>
                                                    @else
                                                        <td class="verde"> Activo </td>
                                                    @endif
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
    </div>
</div>
@endsection
@section('javascript')
<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="{{ asset('js/products/filter_catalogue.js') }}" type="text/javascript"></script>
@endsection