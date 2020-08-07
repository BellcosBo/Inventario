@extends('layouts.plantilla')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Elija la SubFamilia</h2>
        <br>
        <form action="{{route('buscarProd')}}" method="GET">
            <!-- {!! csrf_field()!!}-->
            <div class="col-lg-6">
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="nameprod"  value="producto" name="elegir" checked="">
                    <label for="inlineRadio1">Nombre Producto </label>
                </div>
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="codBarra" value="codBarra" name="elegir" >
                    <label for="inlineRadio1">Codigo de Barra </label>
                </div>
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="codProd" value="codProd" name="elegir">
                    <label for="inlineRadio1">Codigo de Producto </label>
                </div>
                <br>
                <label>Ingresar el  Dato</label>
                <div class="form-group">
                    <input type="hidden" name="idRDir" value="{{$docentry2}}">
                    <input type="text" name="nameProd" class="form-control" placeholder="Ingresar el  Dato" value="">
                </div>
            </div>
            <br>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary block full-width m-b">Buscar</button>
            </div>
        </form>
    </div>
</div>
<br>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>SubFamilias</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>SubFamilia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subfamilia as $item)
                                <tr class="gradeX">
                                    <td>{{$c++}}</td>
                                    <td>{{$item->grupo1}} </td>
                                    <td class="center"> <a href="{{route('producto',[$item->grupo1,$docentry2])}}" class="btn btn-primary btn-xs">Seleccionar</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>SubFamilia</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script2')
<script src="js/plugins/dataTables/datatables.min.js"></script>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },

                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });
</script>

@endsection