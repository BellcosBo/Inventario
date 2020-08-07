@extends('layouts.plantilla')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Generar Ruta</h2>
    </div>
</div>
<br>
<div class="row wrapper border-bottom white-bg page-heading">
<br>
    <div class="row">
        <form action="{{route('buscar')}}" method="GET">
           <!-- {!! csrf_field()!!}-->
            <div class="col-lg-12">
                <div class="col-lg-2">
                    <label>Ingresar Nombre del Cliente</label>
                    <div class="form-group">
                        <input type="text" name="codCliente" class="form-control" placeholder="Nombre del cliente" value="{{$codCliente}}">
                    </div>
                </div>
                <br>
                <div class="col-lg-1">
                    <button type="submit" class="btn btn-primary block full-width m-b">Buscar</button>
                </div>
            </div>
        </form>
        <div class="col-lg-12">
            <br>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Direcciones de Salas de Roposicion </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>CI/NIT</th>
                                <th>Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($existe as $item)
                            <tr>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->paterno}}</td>
                                <td>{{$item->ci_nit}}</td>
                                <td class="center"> <a href="{{route('direcciones',$item->codigo)}}" class="btn btn-primary btn-xs">Seleccionar</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection