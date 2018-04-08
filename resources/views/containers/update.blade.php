
@extends('layouts.app')
@section('title', 'S.C.Inventario')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edici&oacute;n de contenedor.</div>

                <div class="panel-body">
                    <form method="post" action="/containers/{{$container->id}}/update">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="form-row">
                            <fieldset disabled>
                                <div class="form-group col-md-6 col-md-offset-3">
                                    <label for="ubication_id">Ubicaci&oacute;n actual:</label>
                                    @if($container->ubication_id == 1)
                                        <input name="ubication_id" id="ubication_id" type="text" class="form-control" value="recibo">
                                    @elseif($container->ubication_id == 2)    
                                        <input name="ubication_id" id="ubication_id" type="text" class="form-control" value="almacenaje">
                                    @else    
                                        <input name="ubication_id" id="ubication_id" type="text" class="form-control" value="surtido">
                                    @endif
                                    <div class="alert-danger">
                                        @foreach ($errors->get('ubication_id') as $error)
                                        {{ $error}}<br>
                                        @endforeach
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group col-md-6 col-md-offset-3">
                                <label class="mr-sm-2" for="Select">Seleccione nueva ubicaci&oacute;n</label>
                                <select class="form-control" id="Select" name="select_ubication">
                                    <option selected>Selecciona ubicaci&oacute;n...</option>
                                    @foreach($ubications as $ubication)
                                        @if($ubication->id == 1)
                                            <option value="{{ $ubication->id }}">Recibo</option>
                                        @elseif($ubication->id == 2)
                                            <option value="{{ $ubication->id }}">Almacenaje</option>
                                        @else
                                            <option value="{{ $ubication->id }}">Surtido</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="alert-danger">
                                    @foreach ($errors->get('select_ubication') as $error)
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
