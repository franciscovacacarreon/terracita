<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    #WEB
    public function getIndex()
    {
        // $usuarioAutenticado = Auth::user();
        // $user = User::findOrFail($usuarioAutenticado->id);
        // return $user->load('rol', 'persona');
        return view('terracita.user.index');
    }

    #API REST
    public function index()
    {
        $data = User::where('estado', 1)->with('rol')->with('persona');
        return new UserCollection($data->get());
    }

    public function store(StoreUserRequest $request)
    {
        $response = [];

        try {
            // Inicia una transacción
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'id_rol' => (int)($request->get('id_rol')),
                'id_persona' => (int)($request->get('id_persona')),
            ]);


            $destinationPath = 'images/user/';
            $nombre_campo = 'profile_photo_path';
            $this->uploadImage($request, $user, $nombre_campo, $destinationPath);

            DB::commit();

            $response = [
                'message' => 'Registro insertado correctamente.',
                'status' => 200,
                'data' => $user,
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

    public function show(User $user)
    {
        $user->load('rol', 'persona');
        return new UserResource($user);
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $response = [];

        try {

            if (!$user) {
                $response = [
                    'message' => 'User no encontrado.',
                    'status' => 404,
                ];
            } else {

                DB::beginTransaction();

                $user->update([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                    'id_rol' => (int)($request->get('id_rol')),
                    'id_persona' => (int)($request->get('id_persona')),
                ]);


                //Falta eliminar la imagen anterior
                $destinationPath = 'images/user/';
                $nombre_campo = 'profile_photo_path';
                $this->uploadImage($request, $user, $nombre_campo, $destinationPath);

                DB::commit();

                $response = [
                    'message' => 'Registro actualizado correctamente.',
                    'status' => 200,
                    'data' => $user,
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

    public function destroy(User $user)
    {
        $response = [];
        try {

            $user->update(['estado' => 0]);
            $response = [
                'message' => 'Registro eliminado correctamente.',
                'status' => 200,
                'msg' => $user
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
        $data = User::where('estado', 0)->with('rol')->with('persona');
        return new UserCollection($data->get());
    }

    public function restaurar(User $user)
    {
        $response = [];
        try {
            $user->update(['estado' => 1]);

            $response = [
                'message' => 'Se restauró correctamente.',
                'status' => 200,
                'msg' => $user
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

    public function uploadImage($request, $data, $imagen, $destinationPath) 
    {
        if ($request->hasFile($imagen)) {
            $file = $request->file($imagen);
            $filename = time() . '-' . $data->getKey() . '.' . $file->getClientOriginalExtension();
            $uploadSuccess = $file->move($destinationPath, $filename);

            if ($uploadSuccess) {
                $data->profile_photo_path = $destinationPath . $filename;
                $data->save(); // Guardar los cambios en el modelo
            }
        }
    }
}
