@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de Usuarios</div>
                <div class="card-body">
                    @can('create users')
                    <div class="row justify-content-end pb-2">
                        <a href="{{url('/usuarios/create')}}" class="btn btn-success">Nuevo Usuario</a>
                    </div>
                    @endcan
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                    @foreach($users as $usuarios)
                        <tr>
                            <td>{{$usuarios->name}}</td>
                            <td>{{$usuarios->email}}</td>
                            <td>{{$usuarios->roles->implode('name', ',')}}</td>
                            <td>
                            @can('update users')
                                <a href="{{url('/usuarios/'.$usuarios->id).'/edit'}}" class="btn btn-primary">Editar</a>
                            @endcan
                            @can('delete users')
                                @include('usuarios.delete',['usuarios'=>$usuarios])
                            @endcan
                            </td>
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