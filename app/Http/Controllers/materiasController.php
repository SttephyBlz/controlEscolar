<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Alumnos;
use App\alumnos_grupos;

class materiasController extends Controller
{
    public function cargar($id){

    	$alumno=Alumnos::find($id);

    	$gruposid=DB::table('alumnos_grupos')
    		->join('grupos', 'grupos.id', '=', 'alumnos_grupos.grupo_id')
    		->where('alumnos_grupos.alumno_id', '=', $id)
    		->pluck('grupos.id');

    	$lista=DB::table('grupos')
    		->whereNotIn('grupos.id', $gruposid)
    		->join('materias', 'materias.id', '=', 'grupos.materia_id')
    		->join('maestros', 'maestros.id', '=', 'grupos.maestro_id')
    		->select('grupos.id', 'materias.nombre', 'grupos.hora', 'grupos.clave')
    		->get();

    	$materias=DB::table('grupos')
    		->whereIn('grupos.id', $gruposid)
    		->join('materias', 'materias.id', '=', 'grupos.materia_id')
    		->join('maestros', 'maestros.id', '=', 'grupos.maestro_id')
    		->select('grupos.id', 'materias.nombre', 'grupos.hora', 'grupos.clave', 'grupos.aula', 'materias.clave AS mc')
    		->get();

    	return view('cargarMaterias', compact('lista', 'materias', 'alumno'));

    }

    public function cargarGrupo($id, Request $datos){
        $alumnos_grupos=new alumnos_grupos();
        $alumnos_grupos->alumno_id=$id;
        $alumnos_grupos->grupo_id=$datos->input('grupo_id');
        $alumnos_grupos->save();

        return redirect('/cargarMaterias/'.$id);
    }

    public function bajaGrupo($id, $idg){
        DB::table('alumnos_grupos')
            ->where('alumnos_grupos.grupo_id', '=', $idg)
            ->where('alumnos_grupos.alumno_id', '=', $id)
            ->delete();

            return redirect('/cargarMaterias/'.$id);
    }
}
















