<?php

namespace App\Http\Controllers;

use App\Filters\TipoMenuFilter;
use App\Models\TipoMenu;
use App\Http\Requests\StoreTipoMenuRequest;
use App\Http\Requests\UpdateTipoMenuRequest;
use App\Http\Resources\TipoMenuCollection;
use App\Http\Resources\TipoMenuResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class TipoMenuController extends Controller
{
    
    #WEB
    public function getIndex() {
        
        $usuarioAutenticado = Auth::user();
        $user = User::findOrFail($usuarioAutenticado->id);
        if (!($user->hasPermissionTo('items'))) {
            return redirect()->to('admin/rol-error');
        };

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

    public function store(StoreTipoMenuRequest $request)
    {
        $response = [];
        try {

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

    public function eliminados()
    {
        $tipoMenuEliminados = TipoMenu::where('estado', 0);
        return new TipoMenuCollection($tipoMenuEliminados->get()); 
    }

    public function restaurar(TipoMenu $tipoMenu) {
        $response = [];
        try {
            $tipoMenu->update(['estado' => 1]);

            $response = [
                'message' => 'Se restauró correctamente.',
                'status' => 200,
                'msg' => $tipoMenu
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => 'La error al resturar.',
                'status' => 500,
                'error' => $e
            ];
        }
        return json_encode($response);
    }
}
