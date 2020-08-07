<form action="{{route('usuarios.destroy',$usuarios->id)}}" method="POST" style="display:inline-block">
@method('DELETE')
@csrf
<button type="submit" class="btn btn-danger">Eliminar</button>

</form>