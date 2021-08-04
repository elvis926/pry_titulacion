<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Publication;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\Users as UsersResource;

class UserController extends Controller
{
    public function index( User $user)
    {
        $user=$user->users;
        return response()->json(UsersResource::Collection($user),200);
    }
    public function show(User $user)
    {
        $user=$user->users()->where('id', $user->id)->firstOrFail();
        return response()->json($user, 200); 
    }
}
