<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Solicitud;
use App\Models\Postulacion;
use App\Models\Comentario;
use App\Http\Resources\Solicituds as SolicitudResource;
use App\Http\Resources\SolicitudCollection;
use App\Http\Resources\Postulacion as PostulacionResource;
use App\Http\Resources\PostulacionCollection;
use App\Http\Resources\Comments as ComentarioResource;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\Users as UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::user();
        return response()->json(compact('token','user'))
            ->withCookie(
              'token',
              $token,
              config('jwt.ttl'), // ttl => time to live
              '/', // path
              null, // domain
              config('app.env') !== 'local', // secure
              true, // httpOnly
              false,
              config('app.env') !== 'local' ? 'None' : 'Lax' // SameSite
            );
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'=>'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role')
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201)->withCookie(
            'token',
            $token,
            config('jwt.ttl'), // ttl => time to live
            '/', // path
            null, // domain
            config('app.env') !== 'local', // secure
            true, // httpOnly
            false,
            config('app.env') !== 'local' ? 'None' : 'Lax' // SameSite
        );      
    }
    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(new UserResource($user),200);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

//            Cookie::queue(Cookie::forget('token'));
//            $cookie = Cookie::forget('token');
//            $cookie->withSameSite('None');
            return response()->json([
                "status" => "Realizado con ??xito",
                "message" => "Cierre de sesi??n exitoso"
            ], 200)
                ->withCookie('token', null,
                    config('jwt.ttl'),
                    '/',
                    null,
                    config('app.env') !== 'local',
                    true,
                    false,
                    config('app.env') !== 'local' ? 'None' : 'Lax'
                );
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(["message" => "No se pudo cerrar la sesi??n."], 500);
        }
    }

    public function showUserSolicitud(User $user){
        //$this->authorize('viewUserPublications', User::class);
        $solicitudes = Solicitud::where('cliente_id', $user['id'])->get();
        return response()->json(new SolicitudCollection($solicitudes), 200);
    }

    public function showUserPostulacion(User $user){
        //$this->authorize('viewUserPublications', User::class);
        $postulaciones = Postulacion::where('tecnico_id', $user['id'])->where('estado','=','Espera')->get();
        return response()->json(new PostulacionCollection($postulaciones), 200);
    }

    public function showPostulacionAsignado(User $user){
        //$this->authorize('viewUserPublications', User::class);
        $postulaciones = Postulacion::where('tecnico_id', $user['id'])->where('estado','=','Asignado')->get();
        return response()->json(new PostulacionCollection($postulaciones), 200);
    }

    public function showPostulacionTerminado(User $user){
        //$this->authorize('viewUserPublications', User::class);
        $postulaciones = Postulacion::where('tecnico_id', $user['id'])->where('estado','=','Terminado')->get();
        return response()->json(new PostulacionCollection($postulaciones), 200);
    }

    public function showUserComments(User $user){
        //$this->authorize('viewUserPublications', User::class);
        $comentarios = Comentario::where('user_id', $user['id'])->get();
        return response()->json(new CommentCollection($comentarios), 200);
    }

    public function show(User $user)
    {
        return response()->json(new UserResource($user),200);
    }

    public function showRoleTecnic(User $user)
    {
        $user = User::where('role','=','ROLE_TECNICO')->get();
        return response()->json(new UserCollection($user), 200);
    }

    public function showRoleClient(User $user)
    {
        $user = User::where('role','=','ROLE_CLIENTE')->get();
        return response()->json(new UserCollection($user), 200);
    }
}