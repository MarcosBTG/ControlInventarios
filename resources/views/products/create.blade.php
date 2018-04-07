
@extends('layouts.app')
@section('title', 'S.C.Inventario')

@section('content')

@if (Session::has('message'))
<div class="alert alert-success"></div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro de nuevos de productos.</div>

                <div class="panel-body">
                    <form action="{{ url('products/store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-md-6 col-md-offset-3">
                                <label for="sku">SKU:</label>
                                <input name="sku" id="sku" type="text" class="form-control" placeholder="Ingresa el código SKU" value="{{ old('sku')}}" autofocus>
                                <div class="alert-danger">
                                    @foreach ($errors->get('sku') as $error)
                                    {{ $error}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-md-offset-3">
                                <label for="name">Nombre:</label>
                                <input name="name" id="name" type="text" class="form-control" placeholder="Ingresa nombre del producto" value="{{ old('name')}}">
                                <div class="alert-danger">
                                    @foreach ($errors->get('name') as $error)
                                    {{ $error}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-md-offset-3">
                                <label for="description">Descripci&oacute;n:</label>
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Describe el producto" value="{{ old('description')}}"></textarea>
                                <div class="alert-danger">
                                    @foreach ($errors->get('description') as $error)
                                    {{ $error}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-md-6 col-md-offset-5">
                                <input type="submit" class="btn btn-success right" data-position="right" id="btn_registrar" value="Registrar">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{ url('/products/index')}}" class="btn btn-primary">Regresar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection