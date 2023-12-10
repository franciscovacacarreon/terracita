<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use App\Models\MenuItemMenu;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('terracita.menu.index');
    }

    public function getCreate()
    {
        return view('terracita.menu.create');
    }

    #API REST
    public function index()
    {
        $menus = Menu::where('estado', 1)->with('itemMenus')->get();
        return new MenuCollection($menus);
    }

    public function indexFecha(Request $request, $fecha)
    {
        $menus = Menu::where('fecha', $fecha)
                    ->where('estado', 1)
                    ->with('itemMenus')
                    ->get();
        return new MenuCollection($menus);
    }

    public function store(StoreMenuRequest $request)
    {
        $response = [];

        try {

            DB::beginTransaction();
            //Insertar el menú
            $menu = Menu::create([
                'nombre' => $datos['nombre'],
                'descripcion' => $datos['descripcion'],
                'fecha' => $datos['fecha'],
            ]);

            //Insertar menu_item_menu
            $idMenu = $menu->id_menu;
            $items = $request->get('items_menu');
            foreach ($items as $item) {
                MenuItemMenu::create([
                    'id_menu' => $idMenu,
                    'id_item_menu' => $item['id_item_menu'],
                    'cantidad' => $item['cantidad'],
                ]);
            }

            DB::commit();

            $response = [
                'message' => 'Registro insertado correctamente.',
                'status' => 200,
                'data' => $menu,
            ];
        } catch (QueryException | ModelNotFoundException $e) {

            // Deshace la transacción en caso de error
            DB::rollBack();
            $response = [
                'message' => 'Error al insertar el registro.',
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        } catch (\Exception $e) {

            // Deshace la transacción en caso de error
            DB::rollBack();
            $response = [
                'message' => 'Error general al insertar el registro.',
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }

    public function show(Menu $menu)
    {
        return new MenuResource($menu);
    }


    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $response = [];
        $datos = $request->json()->all();
        try {

            if (!$menu) {
                $response = [
                    'message' => 'Menu no encontrado.',
                    'status' => 404,
                ];
            } else {

                DB::beginTransaction();

                DB::beginTransaction();
                //actualizar el menú
                $menu->update([
                    'nombre' => $datos['nombre'],
                    'descripcion' => $datos['descripcion'],
                ]);

                //actualizar menu_item_menu
                $idMenu = $menu->id_menu;
                $items = $datos['items_menu'];

                foreach ($items as $item) {
                    $itemUpdate = MenuItemMenu::where('id_menu', $idMenu)
                                  ->where('id_item_menu', $item['id_item_menu'])
                                  ->first();
                    if ($itemUpdate) {
                        MenuItemMenu::where('id_menu', $idMenu)
                                ->where('id_item_menu', $item['id_item_menu'])
                                ->update(['cantidad' => $item['cantidad']]);
                    } else {
                        MenuItemMenu::create([
                            'id_menu' => $idMenu,
                            'id_item_menu' => $item['id_item_menu'],
                            'cantidad' => $item['cantidad'],
                        ]);
                    }
                }

                DB::commit();

                $response = [
                    'message' => 'Registro actualizado correctamente.',
                    'status' => 200,
                    'data' => $menu,
                ];
            }
        } catch (QueryException | ModelNotFoundException $e) {
            DB::rollBack();
            $response = [
                'message' => 'Error al actualizar el registro.',
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'message' => 'Error general al actualizar el registro.',
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }

    public function destroy(Menu $menu)
    {
        $response = [];
        try {

            $menu->update(['estado' => 0]);
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

    public function eliminados()
    {
        $data = Menu::where('estado', 0)->with('itemMenus');
        return new MenuCollection($data->get());
    }

    public function restaurar(Menu $menu)
    {
        $response = [];
        try {
            $menu->update(['estado' => 1]);

            $response = [
                'message' => 'Se restauró correctamente.',
                'status' => 200,
                'msg' => $menu
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => 'La error al resturar.',
                'status' => 500,
                'error' => $e
            ];
        }
        return response()->json($response);
    }
}
