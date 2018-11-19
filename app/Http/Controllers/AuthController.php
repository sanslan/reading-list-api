<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user,201);

    }
    public function login(Request $request){
        

        try {
            $http = new \GuzzleHttp\Client;

            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ],
            ]);
    
            return $response->getBody();

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->getCode() === 400){
                return response()->json('Please enter password and email',400);
            } else if($e->getCode() === 401){
                return response()->json('Envalid password or email',401);
            }
            return response()->json('Something went wrong',500);
        }

    }
    public function logout(){

        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json('Logged out');
    }
}
