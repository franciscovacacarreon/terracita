<?php

namespace App\Http\Controllers;

use App\Models\ItemMenu;
use App\Http\Requests\StoreItemMenuRequest;
use App\Http\Requests\UpdateItemMenuRequest;
use App\Http\Resources\ItemMenuCollection;
use App\Http\Resources\ItemMenuResource;
use App\Http\Resources\TipoMenuResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PhpParser\Node\Stmt\Return_;

class ItemMenuController extends Controller
{

    #API REST

    public function index()
    {
        $itemMenu = ItemMenu::where('estado', 1);
        return new ItemMenuCollection($itemMenu->get());
    }

    public function create()
    {
        //
    }

    public function store(StoreItemMenuRequest $request)
    {
        $response = [];
        try {
            
            $data = ItemMenu::create($request->all());
            $newData = new ItemMenuResource($data);

            // Subir la imagen
            $destinationPath = 'images/item_menu/';
            $nombre_campo = 'imagen';
            $this->uploadImage($request, $data, $nombre_campo, $destinationPath);


            $response = [
                'message' => 'Registro insertado correctamente.',
                'status' => 200,
                'msg' => $newData
            ];

        } catch (QueryException | ModelNotFoundException $e) {
            $response = [
                'message' => 'Error en la BD al insertar el registro.',
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

    public function uploadImage($request, ItemMenu $data, $imagen, $destinationPath) 
    {
        if ($request->hasFile($imagen)) {
            $file = $request->file($imagen);
            $filename = time() . '-' . $data->getKey() . '.' . $file->getClientOriginalExtension();
            $uploadSuccess = $file->move($destinationPath, $filename);

            if ($uploadSuccess) {
                $data->imagen = $destinationPath . $filename;
                $data->save(); // Guardar los cambios en el modelo
            }
        }
    }

    public function show(ItemMenu $itemMenu)
    {
        return new ItemMenuResource($itemMenu);
    }

    public function edit(ItemMenu $itemMenu)
    {
        //
    }

    public function update(UpdateItemMenuRequest $request, ItemMenu $itemMenu)
    {
        $response = [];
        try {

            $itemMenu->update($request->all());

            // Subir la imagen
            $destinationPath = 'images/item_menu/';
            $nombre_campo = 'imagen';
            $this->uploadImage($request, $itemMenu, $nombre_campo, $destinationPath);

            
            $response = [
                'message' => 'Registro actualizado correctamente.',
                'status' => 200,
                'msg' => $itemMenu
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

    public function destroy(ItemMenu $itemMenu)
    {
        $response = [];
        try {

            $itemMenu->update(['estado' => 0]);
            $response = [
                'message' => 'Registro eliminado correctamente.',
                'status' => 200,
                'msg' => $itemMenu
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
