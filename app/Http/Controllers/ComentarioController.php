<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Http\Resources\Comments as CommentResource;
use App\Http\Resources\CommentCollection;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Comment::class);
        return new CommentCollection(Comentario::paginate(3));
    }
    public function show(Comentario $comentario)
    {
        $this->authorize('view', $comentario);
        return response()->json(new CommentResource($comentario),200);
    }
    public function store(Request $request)
    {
        //$this->authorize('create', Comentario::class);
        $request->validate([
            'text'=>'required|string'
        ]);

        $comment = Comentario::create($request->all());
        return response()->json($comment, 201);
    }
    public function update(Request $request, Comentario $comentario)
    {
        $this->authorize('update',$comentario);
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
