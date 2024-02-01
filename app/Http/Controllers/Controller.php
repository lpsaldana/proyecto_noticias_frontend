<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

session_start();
class Controller extends BaseController
{
    //
    public $URL = "http://localhost:3000/users";
    public $BASE_URL = "http://localhost/proyectoNoticias/public/";
}
