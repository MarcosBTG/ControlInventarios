
@extends('layouts.app')
@section('title', 'S.C.Inventario')

@section('content')
@if (Session::has('exito'))
<div class="alert alert-success">
    <center><strong>{{Session::get('exito')}}</strong></center>
</div>
@endif
@if (Session::has('actualizado'))
<div class="alert alert-success">
    <center><strong>Whoops!</strong> Al parecer algo cambio.<br><br></center>
    <center><strong>{{Session::get('actualizado')}}</strong></center>
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">
    <center><strong>Whoops!</strong> Al parecer algo está mal.<br><br></center>
    <center><strong>{{Session::get('error')}}</strong></center>
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cat&aacute;logo de productos.
                    <a href="/products/show" class="btn btn-primary small col-md-offset-6">Ver Historial de productos</a>
                </div>
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
                                                            <a class="icon" href="/products/{{$product->id}}/delete" onclick = 'return confirm(" ¿Seguro que quieres eliminar? ")'><i class="material-icons">clear</i></a>
                                                            <a class="icon" href="/products/{{$product->id}}/submit"><i class="material-icons">local_shipping</i></a>
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
                                    <form method="post" id="delete">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                    </form>
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
<script src="{{ asset('/js/products/products.js')}}" type="text/javascript"></script>
@endsection