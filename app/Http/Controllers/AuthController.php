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

            $response = $http->post('http://reading.loc/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '1',
                    'client_secret' => 'RMynxgXc0c6ga3nd2RZXoCt1U0GJNLApyowlevd7',
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ],
            ]);
    
            return $response->getBody();

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->getCode() === 400){
                return response()->json('Please enter password and email');
            } else if($e->getCode() === 401){
                return response()->json('Envalid password or email');
            }
            return response()->json('Something went wrong');
        }

    }
    public function logout(){

        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json('Logged out');
    }
}
