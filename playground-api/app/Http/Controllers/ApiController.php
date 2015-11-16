<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Input;
Use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;


class ApiController extends Controller
{
    
    public function __construct(EncrypterContract $encrypter)
    {
        $this->encrypter = $encrypter;
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function login(Request $request)
    {        

        $authorization = $request->headers->get('Authorization');

        $ha = base64_decode(substr($authorization, 6));
        list($email, $password) = explode(':', $ha);

        //return response()->json(['token' => $email . ' ' . $password]);

        if (Auth::attempt(array('email' => $email, 'password' => $password))) {
            return response()->json(['message' => 'Boom! I hope :) ']);
        } else {
            return 'failed: ' . Input::get('email') . ' ' . Input::get('password');
        }
    }

    public function getToken(Request $request)
    {
        return response()->json(['token' => csrf_token()]);
    }
}