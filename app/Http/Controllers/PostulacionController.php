<?php

namespace App\Http\Controllers;

use App\Models\Postulacion;
use App\Models\User;
use App\Models\Solicitud;
use App\Http\Resources\Postulacion as PostulacionResource;
use App\Http\Resources\PostulacionCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PostulacionController extends Controller
{
    public function index()
    {
        
        return new PostulacionCollection(Postulacion::paginate(6));
    }
    public function show(Postulacion $postulacion)
    {
       
        return response()->json(new PostulacionResource($postulacion),200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'estado'=>'required|string',
            'solicitud_id'=>'required|exists:solicituds,id'
            
        ]);

        $postulacion = Postulacion::create($request->all());
        return response()->json($postulacion, 201);
    }
    public function update(Request $request, Postulacion $postulacion)
    {
       // $this->authorize('update',$postulacion);
        $request->validate([
            'estado'=>'required|string',            
        ]);
        $postulacion->update($request->all());
        return response()->json($postulacion, 200);
    }
    public function delete(Request $request, Postulacion $postulacion)
    {
        $this->authorize('delete',$postulacion);
        $postulacion->delete();
        return response()->json(null, 204);
    }

    
}
