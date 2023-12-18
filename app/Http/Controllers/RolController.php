<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;
use App\Http\Resources\RolCollection;
use App\Http\Resources\RolResource;
use App\Models\Empleado;
use App\Models\Repartidor;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Rules\Role;

class RolController extends Controller
{
    #WEB
    public function getIndex()
    {
        $usuarioAutenticado = Auth::user();
        $user = User::findOrFail($usuarioAutenticado->id);
        if (!($user->hasPermissionTo('usuarios'))) {
            return redirect()->to('admin/rol-error');
        };
        return view('terracita.rol.index');
    }

    public function getError()
    {
        return view('terracita.rol.error_rol');
    }

    #API REST
    public function index()
    {
        $roles = Rol::where('estado', 1);
        return new RolCollection($roles->get());
    }

    public function store(StoreRolRequest $request)
    {
        $response = [];
        try {

            $rol = Rol::create($request->all());
            $newRol = new RolResource($rol);
            $response = [
                'message' => 'Registro insertado correctamente.',
                'status' => 200,
                'msg' => $newRol
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
        return response()->json($response);
    }

    public function show(Rol $rol)
    {
        return new RolResource($rol);
    }

    public function update(UpdateRolRequest $request, Rol $rol)
    {
        $success = $rol->update($request->all());
        $response = [];
        if ($success) {
            $response = [
                'message' => 'La actualización fue exitosa',
                'status' => 200,
                'msg' => $rol
            ];
        } else {
            $response = [
                'message' => 'La actualización falló',
                'status' => 500
            ];
        }
        return response()->json($response);
    }

    public function destroy(Rol $rol)
    {
        $response = [];
        try {
            $rol->update(['estado' => 0]);

            $response = [
                'message' => 'Se eliminó correctamente.',
                'status' => 200,
                'msg' => $rol
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => 'La error al eliminar',
                'status' => 500,
                'error' => $e
            ];
        }
        return response()->json($response);
    }

    public function eliminados()
    {
        $rolEliminados = Rol::where('estado', 0);
        return new RolCollection($rolEliminados->get());
    }

    public function restaurar(Rol $rol)
    {
        $response = [];
        try {
            $rol->update(['estado' => 1]);

            $response = [
                'message' => 'Se restauró correctamente.',
                'status' => 200,
                'msg' => $rol
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

    public function asignarRoles()
    {

        $response = [];
        try {

            $admins = User::where('id_rol', 1)->get();
            $empleados = User::where('id_rol', 2)->get();
            $repartidores = User::where('id_rol', 3)->get();

            foreach ($admins as $admin) {
                $admin->assignRole('Administrador');
            }

            foreach ($empleados as $empleado) {
                $empleado->assignRole('Cajero');
            }

            foreach ($repartidores as $repartidor) {
                $repartidor->assignRole('Repartidor');
            }

            $response = [
                'message' => 'Roles asignados correctamente.',
                'status' => 200,
                'msg' => 0
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => 'La error al asignar roles.',
                'status' => 500,
                'error' => $e
            ];
        }
        return response()->json($response);
    }
}
