<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class ClienteWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex()
    {
        return view('cliente_web.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getForm()
    {
        return view('cliente_web.form');
    }

    public function getConfirmar()
    {
        return view('cliente_web.confirmar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
