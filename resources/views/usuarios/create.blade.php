@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Nuevo Usuario
                    </div>
                    <div class="card-body">
                        <form action="{{url('usuarios')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" require class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" require class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" require class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <select class="form-control" name="rol" id="rol">
                                    @foreach ($roles as $key => $values)
                                    <option value="{{$values}}"> {{$values}}</option>
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