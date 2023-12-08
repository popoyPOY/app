<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Tokens;


class UserController extends Controller
{

    protected $model;

    public function __construct() {
        $this->model = new Tokens();
    } 

    public function Account(Request $request) {
        try {

            $token = $request->header('Authorization');

            //$email = $this->model()->where('token', $token)->first();


            return response()->json($request->user(), 200);
        } catch (\Throwable $th) {

            $data = ['error' => $th];

            return response($th);
        }
    }

    public function Logout(Request $request) {
        try {
               
            $request->user()->currentAccessToken()->delete();

            return response(['message' => 'Token has been revoked.'], 200);

        } catch (\Throwable $th) {
            return response(['message' => 'Error', 500]);
        }
    }
}
