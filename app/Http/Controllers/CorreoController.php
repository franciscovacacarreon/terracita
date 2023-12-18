<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CorreoController extends Controller
{
    public function getEnviar() 
    {
        return view("terracita.correo.enviar");
    }

    public function getEnviados() 
    {
        return view("terracita.correo.enviados");
    }

    public function getRecibidos() 
    {
        return view("terracita.correo.recibidos");
    }
}
