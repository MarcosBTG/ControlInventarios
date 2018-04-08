
@extends('layouts.app')
@section('title', 'S.C.Inventario')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edici&oacute;n de productos.</div>

                <div class="panel-body">
                    <form method="post" action="/products/{{$product->id}}/update">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="form-row">
                            <div class="form-group col-md-6 col-md-offset-3">
                                <label for="sku">SKU:</label>
                                <input name="sku" id="sku" type="text" class="form-control" placeholder="Ingresa el código SKU" value="{{ $product->sku}}" autofocus>
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
                                <input name="name" id="name" type="text" class="form-control" placeholder="Ingresa nombre del producto" value="{{ $product->name}}">
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
                                <input type='text' class="form-control col-form-label-lg" name="description" id="description" placeholder="Describe el producto" value="{{ $product->description}}">
                                <div class="alert-danger">
                                    @foreach ($errors->get('description') as $error)
                                    {{ $error}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-md-6 col-md-offset-6">
                                <button type="submit" value="Guardar" class="btn btn-success btn-sm"><i class="material-icons small">save</i></button>&nbsp;&nbsp;
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
