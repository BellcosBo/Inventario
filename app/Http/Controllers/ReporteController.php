<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ReporteController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = auth()->user()->id;
        $fechaini = substr(Carbon::now()->startOfMonth(), 0, 10);
        $fechafin = substr(Carbon::now()->endOfMonth(), 0, 10);
        $asignaciones = DB::select('select DISTINCT asignaciones.docentry,asignaciones.fecha,cliente_direcciones.direcciones,clientes.paterno from asignaciones,cliente_direcciones,clientes where cliente_direcciones.id_direccion=asignaciones.id_direccion and asignaciones.cod_cliente=cliente_direcciones.cod_cliente and clientes.codigo=cliente_direcciones.cod_cliente and ' . '"' . $fechafin . '"' . '>=fecha and ' . '"' . $fechaini . '"' . ' <=fecha and idUsuario=' . $user);
       //dd($asignaciones);
       $c=0;
        return view('reporte.index',compact('asignaciones','c'));
    }

    public function listaStock($docentry){
        $listastock=DB::select('SELECT da.id_detalle,da.cantidad,da.codProd,p.codigo2 FROM detalleasignaciones as da,productos as p WHERE p.codigo=da.codProd and da.docentry= '.$docentry);
        $c=0;
        return view('reporte.listaStock',compact('listastock','c'));
    }
    public function reporteGeneral(){
        $user = Auth::user();
        $rol = $user->roles->implode('name',', ');
        //dd($rol);
        $consultores=DB::select('SELECT u.id,u.name,u.email,r.name as role FROM users as u,model_has_roles as mr,roles as r WHERE u.id=mr.model_id and mr.role_id=r.id and r.name="editor"');
        switch ($rol){
            case 'super-admin':
                $saludo='Bienvenido Super Admin';
                return view('reporte.reporteGeneral',compact('consultores'));
            break;
            case 'moderador':
                $saludo='Bienvenido moderador';
                return view('reporte.reporteGeneral',compact('consultores'));
            break;
            case 'editor':
                return redirect()->to('home');
            break;
            
        }
    }
}
