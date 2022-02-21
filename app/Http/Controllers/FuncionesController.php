<?php

namespace App\Http\Controllers;

use App\Funcion;

use Illuminate\Http\Request;

class FuncionesController extends Controller
{
    public function index() {
        $funciones = Funcion::all();
        $argumentos = array();
        $argumentos['funciones'] = $funciones;

        return view('funciones.index',$argumentos);
    }

    public function create() {
        return view('funciones.create');
    }

    public function store(Request $request){
        
        $funcionnueva = new Funcion();
        $funcionnueva->pelicula = $request->input('pelicula');
        $funcionnueva->fecha = $request->input('fecha');
        $funcionnueva->hora = $request->input('hora');
        

        if ($funcionnueva->save()) {

            return redirect()->route('funciones.index')->
                with('Exito','La funcion ha sido creada con exito');
        }
        return redirect()->route('funciones.index')->returnwith('error', "No se pudo añadir la nueva funcion");

    }

    public function destroy($id) {
        $funcion = Funcion::find($id);
    
        if($funcion->delete()) {
            return redirect()->
            route('funciones.index')-> 
            with('Exito', 'La función ha sido eliminada');
    
        }
        return redirect()->route('funciones.index')->
        with('Error', 'No se ha podido eliminar la funcion');
    }
    

}
