<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://reading.loc/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'qot8jW23gx4MsQfBiwZDepPAqhNzXmG0gWYGOvwg',
                'username' => $request->username,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);

    }
}
