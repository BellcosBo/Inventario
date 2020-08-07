@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edtar Usuario
                    </div>
                    <div class="card-body">
                        <form action="{{route('usuarios.update',$usuario->id)}}" method="post">
                        @csrf
                        @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" required class="form-control" value="{{$usuario->name}}" >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" required class="form-control" value="{{$usuario->email}}" >
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" required class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <select class="form-control" name="rol" id="rol">
                                    @foreach ($roles as $key => $values)
                                    @if($usuario->hasRole($values))
                                    <option value="{{$values}}" selected> {{$values}}</option>
                                    @else
                                    <option value="{{$values}}" > {{$values}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="justify-content-end">
                                <input type="submit"  value="enviar" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection