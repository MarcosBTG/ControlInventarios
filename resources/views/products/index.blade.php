
@extends('layouts.app')
@section('title', 'S.C.Inventario')

@section('content')

@if (Session::has('message'))
<div class="alert alert-success">
    <p>El álbum ha sido creado</p>
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

                        <div class="row"><a href="/products/create" class="btn btn-primary small">Agregar Producto</a></div>
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
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                @foreach ($products as $product)
                                                <tr>
                                                    <td>{{$product->sku}}</td>
                                                    <td>{{$product->name}}</td>
                                                    <td>{{$product->description}}</td>
                                                    <td>
                                                        <a class="btn tooltipped" href="#" data-position="right" data-delay="50" data-tooltip="Editar"><i class="material-icons">mode_edit</i></a>
                                                        <a class="btn tooltipped" href="#" data-position="right" data-delay="50" data-tooltip="Deceas eliminarme"><i class="material-icons">clear</i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                            <div class="alert alert-danger">
                                                <p>Al parecer no se ha registrado productos. Registra uno.</p>
                                            </div>
                                            </tbody>
                                            <nav>
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
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