@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, quasi beatae recusandae et illo qui saepe. Tempora, provident, illo velit optio consequatur porro explicabo sint ipsa animi debitis repellendus itaque!</p>
                    <p>Hic, dolore, cumque, ut eum ipsa a consectetur laudantium amet dolorum possimus consequuntur esse distinctio assumenda nulla at quae est odit vitae porro voluptates eveniet cupiditate ipsam reiciendis quas repellat?</p>
                    <p>Hic, dolore, cumque, ut eum ipsa a consectetur laudantium amet dolorum possimus consequuntur esse distinctio assumenda nulla at quae est odit vitae porro voluptates eveniet cupiditate ipsam reiciendis quas repellat?</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
