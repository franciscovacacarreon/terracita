<?php

namespace App\Http\Controllers;

use App\Filters\TipoMenuFilter;
use App\Models\TipoMenu;
use App\Http\Requests\StoreTipoMenuRequest;
use App\Http\Requests\UpdateTipoMenuRequest;
use App\Http\Resources\TipoMenuCollection;
use App\Http\Resources\TipoMenuResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class TipoMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new TipoMenuFilter();
        $queryItems = $filter->transform($request);
        $tipoMenu = TipoMenu::where($queryItems)->where('estado', 1);
        return new TipoMenuCollection($tipoMenu->get());
        // return new TipoMenuCollection($tipoMenu->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTipoMenuRequest $request)
    {
        $response = [];
        try {
            //crear nuevo tipo menu
            $tipoMenu = TipoMenu::create($request->all());
            $newTipoMenu = new TipoMenuResource($tipoMenu);
            $response = [
                'message' => 'Registro insertado correctamente.',
                'status' => 200,
                'msg' => $newTipoMenu
            ];

        } catch (QueryException | ModelNotFoundException $e) {
            $response = [
                'message' => 'Error al insertar el registro.',
                'status' => 500,
                'error' => $e
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => 'Error general al insertar el registro.',
                'status' => 500,
                'error' => $e
            ];
        }
        return json_encode($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoMenu $tipoMenu)
    {
        return new TipoMenuResource($tipoMenu);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoMenu $tipoMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipoMenuRequest $request, TipoMenu $tipoMenu)
    {
        $success = $tipoMenu->update($request->all());
        $response = [];
        if ($success) {
            $response = [
                'message' => 'La actualización fue exitosa',
                'status' => 200,
                'msg' => $tipoMenu
            ];
        } else {
            $response = [
                'message' => 'La actualización falló',
                'status' => 500
            ];
        }
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoMenu $tipoMenu)
    {
        $response = [];
        try {
            $tipoMenu->update(['estado' => 0]);

            $response = [
                'message' => 'Se eliminó correctamente.',
                'status' => 200,
                'msg' => $tipoMenu
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => 'La error al eliminar',
                'status' => 500,
                'error' => $e
            ];
        }
        return json_encode($response);
    }
}
