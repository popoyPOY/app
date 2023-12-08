<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Laravel\Sanctum\HasApiTokens;


class AuthController extends Controller
{
    protected $model;

    public function __construct() {
        $this->model = new User();
    }   
    
    public function login(Request $request)
    {
        try {
            $validation = [
                'email' => 'required | email',
                'password' => 'required | string' 
           ];

            $this->validate($request, $validation);

            $credentials = $request->only(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response(['message' => "account doesn't exist"], 404);
            }

            $user = $this->model->where('email', $request->email)->first();
            $token = $user->createToken($request->email)->plainTextToken;


            return response(['token' => $token], 200);
            
        } catch (\Throwable $e) {
            return response(['message' => $e->getMessage()], 400);
        }

    }

    public function createAccount(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            $this->model->create($request->all());
            return response(['message' => "Successfully created"], 201);
        } catch (\Throwable $e) {
            return response(['message' => $e->getMessage()], 400);
        }

    }

}
