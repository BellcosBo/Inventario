<?php

namespace App\Http\Controllers;

use App\Asignacione;
use App\Detalleasignacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $existe = array();
        $codCliente = '';
        return view('cliente.index', compact('existe', 'codCliente'));
    }

    public function buscar(Request $request)
    {

        if (trim($request->codCliente) != "") {
            $codCliente = $request->codCliente;
            $existe = DB::table('clientes')
                ->where('clientes.paterno', 'LIKE', "%" . $request->codCliente . "%")
                ->select('clientes.*')
                ->get();
            //dd( $existe);
            return view('cliente.index', compact('existe', 'codCliente'));
        }

        $existe = array();
        $codCliente = '';
        return view('cliente.index', compact('existe', 'codCliente'));
    }
    public function direcciones($codCliente)
    {
        $cliente = $codCliente;
        $direccion = DB::table('cliente_direcciones as cd')
            ->where('cd.cod_cliente', '=', $cliente)
            ->select('*')->get();
        return view('cliente.buscar', compact('direccion', 'cliente'));
    }
    public function guardar(Request $request)
    {

        $user = auth()->user()->id;
        $fecha = Carbon::createFromFormat('m/d/Y', $request->fecha)->format('Y-m-d');
        $fecha2 = Carbon::now();
        $existe = DB::select('SELECT COUNT(*) as cant FROM asignaciones WHERE fecha='.'"'.$fecha.'"'.' and id_direccion=' .$request->idDireccion. ' and idUsuario=' .$user);
        //dd($existe);
        if ($existe[0]->cant == 0) {
            $guardar = new Asignacione;
            $guardar->fecha = $fecha;
            $guardar->FechaCreacion = $fecha2;
            $guardar->cod_Cliente = $request->codCliente;
            $guardar->id_direccion = $request->idDireccion;
            $guardar->idUsuario = $user;
            if ($guardar->save()) {
                return redirect()->to('cliente');
            }
        }
      // dd('okno');
         return redirect()->to('cliente');
    }
    public function salasAsignadas()
    {
        $user = auth()->user()->id;
        /*$salaRep = DB::table('asignaciones as asig')
            ->join('users as u', 'u.id', '=', 'asig.idUsuario')
            ->join('cliente_direcciones as cd', 'cd.id_direccion', '=', 'asig.id_direccion')
            ->join('clientes as c', 'c.codigo', '=', 'cd.cod_cliente')
            ->where('asig.idUsuario', '=', $user)
            ->select('asig.docentry', 'asig.fecha', 'c.paterno', 'cd.direcciones')
            ->get();*/
        $salaRep = DB::select('SELECT a.docentry,a.fecha,c.paterno,cd.direcciones
            FROM asignaciones as a, users as u, cliente_direcciones as cd, clientes as c
            WHERE 
            a.idUsuario=u.id and cd.id_direccion=a.id_direccion and a.cod_cliente=cd.cod_cliente
            and c.codigo=cd.cod_cliente and
            a.idUsuario=' . $user);
        $c = 1;
        return view('cliente.listadoSala', compact('salaRep', 'c'));
    }

    public function subfamilia($docentry)
    {
        $subfamilia = DB::select('SELECT DISTINCT productos.grupo1 FROM productos ORDER by productos.grupo1 ASC');
        $docentry2 = $docentry;
        $c = 1;
        //dd($subfamilia);
        return view('cliente.subfamilia', compact('subfamilia', 'docentry2', 'c'));
    }

    public function producto($grupo1, $docentry2)
    {
        //$subfamilia=DB::select('SELECT * FROM productos WHERE grupo1 LIKE %'.$grupo1.'%');
        $docentry = $docentry2;
        $valores = array();
        $producto = DB::table('productos as p')
            ->where('p.grupo1', '=', $grupo1)
            ->select('p.*')->get();
        $prod =  $grupo1;
        $posicion = 'subfamilia';
        $c = 0;
        foreach ($producto as $item) {
            $prodcant = DB::select('select count(cantidad)as cant from detalleasignaciones as da where da.codProd=' . $item->codigo . ' and docentry=' . $docentry);
            $prodcant2 = DB::select('select cantidad from detalleasignaciones as da where da.codProd=' . $item->codigo . ' and docentry=' . $docentry);

            if ($prodcant[0]->cant == 0) {
                $valores[$item->codigo] = 0;
            } else {
                $valores[$item->codigo] = $prodcant2[0]->cantidad;
            }
        }
        //  dd( $valores);

        return view('cliente.producto', compact('producto', 'docentry', 'prod', 'posicion', 'valores'));
    }

    public function buscarProd(Request $request)
    {
        if (trim($request->nameProd) != "") {
            $docentry = $request->idRDir;
            $prod = $request->nameProd;
            $valores = array();
            //dd($docentry);
            if ($request->elegir == 'producto') {
                $producto = DB::select('select * from productos as p where p.codigo2 LIKE "%' . $prod . '%"');
                $posicion = 'buscarBarra';
            } elseif ($request->elegir == 'codBarra') {
                $producto = DB::select('select * from productos as p where p.grupo2 LIKE "%' . $prod . '%"');
                $posicion = 'buscarProd';
            } else {
                $producto = DB::select('select * from productos as p where p.codigo LIKE "%' . $prod . '%"');
                $posicion = 'buscarCod';
            }

            foreach ($producto as $item) {
                $prodcant = DB::select('select count(cantidad)as cant from detalleasignaciones as da where da.codProd=' . $item->codigo . ' and docentry=' . $docentry);
                $prodcant2 = DB::select('select cantidad from detalleasignaciones as da where da.codProd=' . $item->codigo . ' and docentry=' . $docentry);

                if ($prodcant[0]->cant == 0) {
                    $valores[$item->codigo] = 0;
                } else {
                    $valores[$item->codigo] = $prodcant2[0]->cantidad;
                }
            }
            //dd( $existe);

            return view('cliente.producto', compact('producto', 'docentry', 'prod', 'posicion', 'valores'));
        }
        $existe = array();
        $codCliente = '';
        return view('cliente.index', compact('existe', 'codCliente'));
    }
    public function guardarStock(Request $request)
    {
        $stockProd = $request->stock;
        if ($request->posicion == 'buscarBarra' || $request->posicion == 'buscarProd' || $request->posicion == 'buscarCod') {
            if ($request->posicion == 'buscarBarra') {
                $producto = DB::select('select * from productos as p where p.codigo2 LIKE "%' . $request->prod . '%"');
            } elseif ($request->posicion == 'buscarProd') {
                $producto = DB::select('select * from productos as p where p.grupo2 LIKE "%' . $request->prod . '%"');
            } else {
                $producto = DB::select('select * from productos as p where p.codigo LIKE "%' . $request->prod . '%"');
            }
            //dd($stockProd);
            for ($i = 0; $i < sizeof($stockProd); $i++) {
                if (intval($stockProd[$i]) > 0 ||  intval($stockProd[$i])  < 0) {
                    //crear el guardar
                    //echo($stockProd[$i]);
                    $prodcant = DB::select('select count(cantidad)as cant from detalleasignaciones as da where da.codProd=' . $producto[$i]->codigo . ' and docentry=' . $request->idEDir);
                    $prodcant2 = DB::select('select cantidad,id_detalle from detalleasignaciones as da where da.codProd=' . $producto[$i]->codigo . ' and docentry=' . $request->idEDir);
                    if ($prodcant[0]->cant == 0) {
                        $guardar = new Detalleasignacione;
                        $guardar->cantidad = $stockProd[$i];
                        $guardar->codProd = $producto[$i]->codigo;
                        $guardar->docentry = $request->idEDir;
                        $guardar->save();
                    } else {
                        $newCant = intval($stockProd[$i]) + $prodcant2[0]->cantidad;
                        // dd($newCant );
                        DB::table('detalleasignaciones as da')
                            ->where('da.id_detalle', $prodcant2[0]->id_detalle)
                            ->update(array('da.cantidad' => intval($newCant)));
                    }
                }
                //dd($stockProd[$i]);
            }
        } else {

            $producto = DB::table('productos as p')
                ->where('p.grupo1', '=',  $request->prod)
                ->select('p.*')->get();
            for ($i = 0; $i < sizeof($stockProd); $i++) {
                if (intval($stockProd[$i]) > 0 ||  intval($stockProd[$i])  < 0) {
                    //crear el guardar
                    $prodcant = DB::select('select count(cantidad)as cant from detalleasignaciones as da where da.codProd=' . $producto[$i]->codigo . ' and docentry=' . $request->idEDir);
                    $prodcant2 = DB::select('select cantidad,id_detalle from detalleasignaciones as da where da.codProd=' . $producto[$i]->codigo . ' and docentry=' . $request->idEDir);

                    if ($prodcant[0]->cant == 0) {

                        $guardar = new Detalleasignacione;
                        $guardar->cantidad = $stockProd[$i];
                        $guardar->codProd = $producto[$i]->codigo;
                        $guardar->docentry = $request->idEDir;
                        $guardar->save();
                    } else {

                        $newCant = intval($stockProd[$i]) + $prodcant2[0]->cantidad;
                        DB::table('detalleasignaciones as da')
                            ->where('da.id_detalle', $prodcant2[0]->id_detalle)
                            ->update(array('da.cantidad' => $newCant));
                    }
                }
                // dd('ok no');
            }
        }
        $id = $request->idEDir;
        return redirect()->to('/subfamilia.' . $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /* 
  public function listacliente(){
        $cliente=Cliente::all();
        return view('cliente.listacliente',compact('cliente'));
    }
    public function direcciones($codCliente){
        $direccion=DB::table('clientedireccions as cd')
        ->where('cd.codCliente','=',$codCliente)
        ->select('*')->get();
        $codClientes=$codCliente;
        return view('cliente.direcciones',compact('direccion','codClientes'));
    }

  
  public function guardar(Request $request)
    {
        $user = auth()->user()->id;
        $fecha = Carbon::createFromFormat('m/d/Y', $request->fecha)->format('Y-m-d');
        $existe = DB::table('empleadodirs as ed')
            ->where('ed.idUser', '=', $user)
            ->where('ed.idCDir', '=', $request->idDireccion)
            ->where('ed.fecha', '=', $fecha)
            ->select(DB::raw('count(ed.idUser) as idUser'))
            ->get();

        if ($existe[0]->idUser == 0) {
            $guardar = new EmpleadoDir;
            $guardar->idUser = $user;
            $guardar->idCDir = $request->idDireccion;
            $guardar->fecha = $fecha;
            if ($guardar->save()) {
                $existeCliente = 0;
                $codCliente = '';
                $direccion = '';
                return view('cliente.index', compact('existeCliente', 'codCliente', 'direccion'));
            }
        }
        $codCliente = $request->codCliente;

        $direccion = DB::table('clientes as c')
            ->join('clientedireccions as cd', 'cd.codCliente', '=', 'c.codCliente')
            ->where('c.codCliente', '=', $request->codCliente)
            ->select('c.codCliente', 'cd.id', 'c.nombreCliente', 'cd.direccion')
            ->get();
        return view('cliente.buscar', compact('codCliente', 'direccion'));
    }*/
    /*public function indexSala()
    {
        $user = auth()->user()->id;
        $salaRep = DB::table('empleadodirs as ed')
            ->join('clientedireccions as cd', 'cd.id', '=', 'ed.idCDir')
            ->join('clientes as c', 'c.codCliente', '=', 'cd.codCliente')
            ->where('ed.idUser', '=', $user)
            ->select('ed.id', 'ed.idUser', 'ed.idCDir', 'ed.fecha', 'cd.direccion', 'c.nombreCliente')
            ->get();
        return view('cliente.listadoSala', compact('salaRep'));
    }*/
    /*public function subfamilia($id)
    {
        $subfamilia = Subfamilia::all();
        $idRDir = $id;
        return view('cliente.subfamilia', compact('subfamilia', 'idRDir'));
        //dd($subfamilia);
    }*/
    /* public function producto($id, $idRDir)
    {
        //dd($idRDir);
        $idEDir = $idRDir;
        $idSFamilia = $id;

        $existe = DB::table('cabezeraprods as cp')
            ->where('cp.idEDir', '=', $idEDir)
            ->where('cp.idSFamilia', '=', $idSFamilia)
            ->where('cp.estado', '=', '1')
            ->select(DB::raw('count(cp.idCabProd) as idCabProd'))
            ->get();

       // if ($existe[0]->idCabProd == 0) {
            $producto = DB::table('productos as p')
                ->where('p.idSFamilia', '=', $id)
                ->select('p.codProd', 'p.detalle', 'p.codBarra', 'p.idSFamilia')
                ->get();
            return view('cliente.producto', compact('producto', 'idEDir', 'idSFamilia'));
       // } else {
            //echo('ok');
         //   $subfamilia = Subfamilia::all();
          //  $idRDir = $id;
          //  return view('cliente.subfamilia', compact('subfamilia', 'idRDir'));
       // }
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function guardarStock(Request $request)
    {
        $idEDir = $request->idEDir;
        $idSFamilia = $request->idSFamilia;
        $stockProd = $request->stock;
        $c = 0;
        $producto = DB::table('productos as p')
            ->where('p.idSFamilia', '=', $idSFamilia)
            ->select('p.codProd', 'p.detalle', 'p.codBarra', 'p.idSFamilia')
            ->get();
        for ($i = 0; $i < sizeof($stockProd); $i++) {
            if ($stockProd[$i] > 0) {
                //crear el guardar
                $guardar = new Detalledirprod;
                $guardar->codProd = $producto[$i]->codProd;
                $guardar->idEDir = $idEDir;
                $guardar->cant = $stockProd[$i];
                $guardar->save();
            } else {
                $c++;
            }
        }
        if ($c == sizeof($stockProd)) {

            return view('cliente.producto', compact('producto', 'idEDir', 'idSFamilia'));
        }
        $estado=1;
        $guardar2 = new Cabezeraprod;
        $guardar2->idEDir = $idEDir;
        $guardar2->idSFamilia = $idSFamilia;
        $guardar2->estado = $estado;
        $guardar2->save();
        $user = auth()->user()->id;
        $subfamilia = Subfamilia::all();
        $idRDir = $idEDir;
        return view('cliente.subfamilia', compact('subfamilia', 'idRDir'));
    }*/
}
