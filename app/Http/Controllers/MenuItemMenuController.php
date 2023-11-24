<?php

namespace App\Http\Controllers;

use App\Models\MenuItemMenu;
use App\Http\Requests\StoreMenuItemMenuRequest;
use App\Http\Requests\UpdateMenuItemMenuRequest;
use App\Http\Resources\MenuItemMenuCollection;
use App\Http\Resources\MenuItemMenuResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class MenuItemMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemMenu = MenuItemMenu::all();
        return new MenuItemMenuCollection($itemMenu);
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
    public function store(StoreMenuItemMenuRequest $request)
    {
        {
            $response = [];
            try {
                //crear nuevo tipo menu
                $data = MenuItemMenu::create($request->all());
                $newData = new MenuItemMenuResource($data);
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

    public function storeMenuItem($id_menu, $items)
    {
        {
            $response = [];
            try {

                $array = [];
                $i = 0;
                foreach ($items as $item) {
                    $menuItemMenu = new MenuItemMenu();
                    $menuItemMenu->id_menu = $id_menu;
                    $menuItemMenu->id_item_menu = $item['id_item_menu'];
                    $menuItemMenu->cantidad = $item['cantidad'];
                    $menuItemMenu->save();
                    $array[$i] = $menuItemMenu;
                    $i++;
                }
                $response = [
                    'message' => 'Registros insertados correctamente.',
                    'status' => 200,
                    'msg' => $array
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
    public function show(MenuItemMenu $menuItemMenu)
    {
        return new MenuItemMenuResource($menuItemMenu);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItemMenu $menuItemMenu)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuItemMenuRequest $request, MenuItemMenu $menuItemMenu)
    {
        $response = [];
        try {

            $menuItemMenu->update($request->all());
            
            $response = [
                'message' => 'Registro actualizado correctamente.',
                'status' => 200,
                'msg' => $menuItemMenu
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
    public function destroy(MenuItemMenu $menuItemMenu)
    {
        $response = [];
        try {

            $menuItemMenu->update(['estado' => 0]);
            $response = [
                'message' => 'Registro eliminado correctamente.',
                'status' => 200,
                'msg' => $menuItemMenu
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
