<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;

class CalificacionController extends Controller
{
    public function index()
    {
        return new CalificacionCollection(Calificacion::paginate(3));
    }
    public function show(Calificacion $calificacion)
    {
        $this->authorize('view', $calificacion);
        return response()->json(new CalificacionResource($calificacion),200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'calificacion'=>'required|string'
        ]);

        $calificacion = Calificacion::create($request->all());
        return response()->json($calificacion, 201);
    }
    public function update(Request $request, Calificacion $calificacion)
    {
        $this->authorize('update',$calificacion);
        $request->validate([
            'text'=>'required|string'
        ]);
        $calificacion->update($request->all());
        return response()->json($calificacion, 200);
    }
    public function delete(Request $request, Calificacion $calificacion)
    {
        $this->authorize('delete',$calificacion);
        $calificacion->delete();
        return response()->json(null, 204);
    }
}
