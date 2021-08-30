<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Comment as CommentResource;
use App\Http\Resources\CommentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ComentarioController extends Controller
{
    private static $rules=[
        'text' => 'required|string|max:2000',
    ];

    private static $messages=[
        'text.required' => 'Falta el contenido del mensaje',
    ];

    public function index()
    {
        return new CommentCollection(Comentario::paginate(5));
    }
    public function show(Comentario $comentario)
    {
        $this->authorize('view', $comentario);
        return response()->json(new CommentResource($comentario),200);
    }
    public function store(Request $request)
    {
        $request -> validate(self::$rules, self::$messages);
        $comentario = Comentario::create($request->all());
        return response()->json($comentario, 201);
    }
    public function update(Request $request, Comentario $comentario)
    {
        //$this->authorize('update',$comentario);
        $request->validate([
            'text'=>'required|string'
        ]);
        $comentario->update($request->all());
        return response()->json($comentario, 200);
    }
    public function delete(Request $request, Comentario $comentario)
    {
        $this->authorize('delete',$comentario);
        $comentario->delete();
        return response()->json(null, 204);
    }
}
