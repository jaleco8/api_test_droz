<?php

namespace App\Http\Controllers;

use App\Models\User;
use Google_Client;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    /**
     * Validar el token de google
     * Guardar el usuario en la base de datos si no existe
     * Generar un token de autenticación con jwt
     */

    public function loginGoogle(Request $request)
    {
        $token = $request->token; // El token de Google que se recibe del cliente
        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);  // Especifica el ID del cliente de Google
        $payload = $client->verifyIdToken($token);

        if ($payload) {
            //return response()->json($payload, 200);
            $userEmail = $payload['email'];
            // Si el token es válido, puedes buscar al usuario en tu base de datos con el ID de Google
            // Si el usuario no existe, puedes crearlo
            $user = User::firstOrCreate(['email' => $userEmail], [
                'name' => $payload['name'],
                'email' => $payload['email'],
                'password' => bcrypt('password'),
                'last_login' => now()
            ]);

            // Modificar a user last_login
            $user->last_login = now();
            $user->save();
            // y generar un token JWT para ese usuario.
            $token = JWTAuth::fromUser($user);

            return response()->json(['token' => $token], 200);
        } else {
            // Si el token no es válido, puedes devolver un error.
            return response()->json(['error' => 'Invalid Google token'], 401);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return response()->json(null, 204);
    }
}
