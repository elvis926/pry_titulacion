<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Solicituds as SolicitudResource;
use App\Http\Resources\SolicitudCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SolicitudController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Comment::class);
        return new SolicitudsCollection(Solicitud::paginate(10));
    }
    public function show(Solicitud $solicitud)
    {
        $this->authorize('view', $solicitud);
        return response()->json(new SolicitudResource($solicitud),200);
    }
    public function store(Request $request)
    {
       // $this->authorize('create', Solicitud::class);
        $request->validate([
            'descripcionPC'=>'required|string',
            'fechaIni'=>'required|date',
            'fechaFin'=>'required|date',
            'dano'=>'required|string',
            'descripcion'=>'required|string'
        ]);

        $solicitud = Solicitud::create($request->all());
        return response()->json($solicitud, 201);
    }
    public function update(Request $request, Solicitud $solicitud)
    {
        $this->authorize('update',$solicitud);
        $request->validate([
            'descripcionPC'=>'required|string',
            'fechaIni'=>'required|date',
            'fechaFin'=>'required|date',
            'dano'=>'required|string',
            'descripcion'=>'required|string'
        ]);
        $solicitud->update($request->all());
        return response()->json($solicitud, 200);
    }
    public function delete(Request $request, Solicitud $solicitud)
    {
        $this->authorize('delete',$solicitud);
        $solicitud->delete();
        return response()->json(null, 204);
    }
}
