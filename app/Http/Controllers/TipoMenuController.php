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
    
    #NORMAL
    public function getIndex() {
        return view('terracita.tipo_menu.index');
    }


    #API REST
    public function index(Request $request)
    {
        $filter = new TipoMenuFilter();
        $queryItems = $filter->transform($request);
        $tipoMenu = TipoMenu::where($queryItems)->where('estado', 1);
        return new TipoMenuCollection($tipoMenu->get());
        // return new TipoMenuCollection($tipoMenu->paginate()->appends($request->query()));
    }

    public function create()
    {
        
    }

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

    public function show(TipoMenu $tipoMenu)
    {
        return new TipoMenuResource($tipoMenu);
    }

    public function edit(TipoMenu $tipoMenu)
    {
        //
    }

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
