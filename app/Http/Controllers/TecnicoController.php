<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Tecnico;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\Tecnicos as TecnicoResource;

class UserController extends Controller
{
    public function index(Tecnico $tecnico)
    {
        $tecnico=$tecnico->tecnicos;
        return response()->json(TecnicoResource::Collection($tecnico),200);
    }
    public function show(Tecnico $tecnico)
    {
        $this->authorize('view', $tecnico);
        return response()->json(new TecnicoResource($tecnico),200);
    }
    public function store(Request $request)
    {
        //$this->authorize('create', Comentario::class);
        $request->validate([
            'nombre'=>'required|string',
            'email'=>'required|string',
            'telefono'=>'required|string',
            'direccion'=>'required|string',
            'descripcion'=>'required|string',
            'estudios'=>'required|string'
        ]);
        $tecnico = Tecnico::create($request->all());
        return response()->json($tecnico, 201);
    }
    public function update(Request $request, Tecnico $tecnico)
    {
        $this->authorize('update',$tecnico);
        $request->validate([
            'nombre'=>'required|string',
            'email'=>'required|string',
            'telefono'=>'required|string',
            'direccion'=>'required|string',
            'descripcion'=>'required|string',
            'estudios'=>'required|string'
        ]);
        $tecnico->update($request->all());
        return response()->json($tecnico, 200);
    }
    public function delete(Request $request, Tecnico $tecnico)
    {
        $this->authorize('delete',$tecnico);
        $tecnico->delete();
        return response()->json(null, 204);
    }
}
