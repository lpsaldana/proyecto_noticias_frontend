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

    public function noticias(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $session = $_SESSION["user"];
        try{
            $response = $client->request('GET',$this->URL."/admin/noticias/user/".$session->external,['headers'=>['api-token'=> $session->token]]);
            $data = json_decode($response->getBody());
            return view('fragmentos/noticias', ['msg' => '', 'base_url'=> $this->BASE_URL,'noticias'=>$data->data]);
        }catch(\GuzzleHttp\Exception\ClientException $e){
            return view('fragmentos/noticias', ['msg' => '', 'base_url'=> $this->BASE_URL,'noticias'=>[]]);
        }
    }

    public function view_guardar(Request $request)
    {
        return view('fragmentos/regNoticia', ['msg' => '', 'base_url'=> $this->BASE_URL]);
    }

    public function guardar(Request $request)
    {
        $titulo = $request->input('titulo');
        $cuerpo = $request->input('cuerpo');
        $session = $_SESSION["user"];
        $client = new \GuzzleHttp\Client();
        try{
            $response = $client->request('POST',$this->URL."/admin/noticias/guardar",[
                "json"=>[
                    "titulo"=> $titulo,
                    "cuerpo"=> $cuerpo,
                    "fecha"=>date('Y-m-d'),
                    "external"=>$session->external
                ],['headers'=>['api-token'=> $session->token]] 
            ]);
            $data = json_decode($response->getBody());
            if($response->getStatusCode() == 200){
                return redirect('/admin/noticias');
            }
        }catch(\GuzzleHttp\Exception\ClientException $e){
            if($e->hasResponse()){
                $dataE = $e->getResponse();
                $dataError = json_decode($dataE->getBody());
                if(is_string($dataError->data)){
                    return view('fragmentos/regNoticia', ['msg' => $dataError->data,'base_url'=>$this->BASE_URL]);
                }else{
                    $data = $dataError->data->errors; 
                    $aux="";
                    foreach ($data as $e) {
                        $aux.= $aux.$e->msg."\n";
                    }
                    return view("fragmentos/regNoticia", ["msg"=> $aux,"base_url"=>$this->BASE_URL]);
                }
            }else{
                return view("fragmentos/regNoticia", ["msg"=> $e->getMessage(),"base_url"=>$this->BASE_URL]);
            }
        }
        
    }

    public function view_editar(Request $request, $external)
    {
        $client = new \GuzzleHttp\Client();
        try{
            $response = $client->request('GET',$this->URL."/admin/noticias/".$external);
            $data = json_decode($response->getBody());
            return view('fragmentos/modNoticia', ['msg' => '', 'base_url'=> $this->BASE_URL,'noticias'=>$data->data]);
        }catch(\GuzzleHttp\Exception\ClientException $e){
            return view('admin/noticias');
        }
        //return view('fragmentos/moidificarNoticia', ['msg' => '', 'base_url'=> $this->BASE_URL]);
    }

    public function modificar(Request $request)
    {
        $titulo = $request->input('titulo');
        $cuerpo = $request->input('cuerpo');
        $external = $request->input('external');
        $session = $_SESSION["user"];
        $client = new \GuzzleHttp\Client();
        try{
            $response = $client->request('POST',$this->URL."/admin/noticias/modificar",[
                "json"=>[
                    "titulo"=> $titulo,
                    "cuerpo"=> $cuerpo,
                    "external"=>$external
                ],['headers'=>['api-token'=> $session->token]] 
            ]);
            $data = json_decode($response->getBody());
            if($response->getStatusCode() == 200){
                return redirect('/admin/noticias');
            }
        }catch(\GuzzleHttp\Exception\ClientException $e){
            if($e->hasResponse()){
                $dataE = $e->getResponse();
                $dataError = json_decode($dataE->getBody());
                if(is_string($dataError->data)){
                    return view('fragmentos/modNoticia', ['msg' => $dataError->data,'base_url'=>$this->BASE_URL]);
                }else{
                    $data = $dataError->data->errors; 
                    $aux="";
                    foreach ($data as $e) {
                        $aux.= $aux.$e->msg."\n";
                    }
                    return view("fragmentos/modNoticia", ["msg"=> $aux,"base_url"=>$this->BASE_URL]);
                }
            }else{
                return view("fragmentos/modNoticia", ["msg"=> $e->getMessage(),"base_url"=>$this->BASE_URL]);
            }
        }
        
    }
    
}
