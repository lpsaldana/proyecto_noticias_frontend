<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function verLogin()
    {
        return view('login', ['nombre' => 'HOLA2']);
    }

    public function login(Request $request)
    {
        $name = $request->input('correo');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET',$this->URL."/admin/noticias");
        echo $response->getStatusCode();
        echo $response->getBody();

        //return view('login',['nombre'=>'HOLA2']);
    }
}
