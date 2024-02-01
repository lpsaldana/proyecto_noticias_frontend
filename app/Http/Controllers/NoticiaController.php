<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticiaController extends Controller
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

    public function principal()
    {
        $client = new \GuzzleHttp\Client();
        try{
            $response = $client->request('GET',$this->URL."/admin/noticias");
            $data = json_decode($response->getBody());
            return view('fragmentos/principal', ['msg' => '', 'base_url'=> $this->BASE_URL,'noticias'=>$data->data]);
        }catch(\GuzzleHttp\Exception\ClientException $e){
            return view('fragmentos/principal', ['msg' => '', 'base_url'=> $this->BASE_URL,'noticias'=>[]]);
        }
    }

    
}
