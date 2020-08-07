@extends('layouts.plantilla')
@section('content')
<form action="{{route('guardarStock')}}" method="POST">
    @csrf
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Productos</h2>
            <input type="hidden" name="idEDir" value="{{$docentry}}">
            <input type="hidden" name="prod" value="{{$prod}}">
            <input type="hidden" name="posicion" value="{{$posicion}}">
        </div>
    </div>
    <br>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="row">
            <div class="col-lg-4">
                <br>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary block full-width m-b">Guardar</button>
                </div>
            </div>
            <div class="col-lg-12">
                <br>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Ingrese el stock </h5>
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
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Codigo de Barra</th>
                                    <th>Stock</th>
                                    <th>Ingresado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($producto as $item)
                                <tr class="gradeX">
                                    <td>{{$item->codigo}}</td>
                                    <td>{{$item->codigo2}} </td>
                                    <td>{{$item->grupo2}} </td>
                                    <td class="center"> <input type="number" name="stock[]" class="form-control" placeholder="Ingrese stock" value="0"></td>
                                    <td>{{$valores[$item->codigo]}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection