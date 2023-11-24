<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Menu::where('estado', 1);
        return new MenuCollection($data->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        {
            $response = [];
            try {

                $data = Menu::create($request->all());
                $newData = new MenuResource($data);
                $response = [
                    'message' => 'Registro insertado correctamente.',
                    'status' => 200,
                    'msg' => $newData
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return new MenuResource($menu);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $response = [];
        try {

            $menu->update($request->all());
            
            $response = [
                'message' => 'Registro actualizado correctamente.',
                'status' => 200,
                'msg' => $menu
            ];

        } catch (QueryException | ModelNotFoundException $e) {
            $response = [
                'message' => 'Error en la BD al actualizar el registro.',
                'status' => 500,
                'error' => $e
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => 'Error general al actualizar el registro.',
                'status' => 500,
                'error' => $e
            ];
        }
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $response = [];
        try {

            $menu->estado = 0;
            $menu->update();
            $response = [
                'message' => 'Registro eliminado correctamente.',
                'status' => 200,
                'msg' => $menu
            ];

        } catch (QueryException | ModelNotFoundException $e) {
            $response = [
                'message' => 'Error en la BD al eliminar el registro.',
                'status' => 500,
                'error' => $e
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => 'Error general al eliminar el registro.',
                'status' => 500,
                'error' => $e
            ];
        }
        return json_encode($response);
        }
}
