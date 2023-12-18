<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CorreoController extends Controller
{
    public function getIndex() 
    {
        return view("terracita.correo.index");
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
