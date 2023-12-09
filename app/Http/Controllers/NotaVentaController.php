<?php

namespace App\Http\Controllers;

use App\Models\NotaVenta;
use App\Http\Requests\StoreNotaVentaRequest;
use App\Http\Requests\UpdateNotaVentaRequest;
use App\Http\Resources\NotaVentaCollection;
use App\Http\Resources\NotaVentaResource;
use App\Models\DetalleVenta;
use App\Models\ItemMenu;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class NotaVentaController extends Controller
{
    protected $user;

    public function __construct()
    {
        
    }

    #WEB
    public function getIndex()
    {   
        return view('terracita.nota_venta.index');
    }

    public function getCreate()
    {
        $usuarioAutenticado = Auth::user();
        $user = User::findOrFail($usuarioAutenticado->id);
        $user = $user->load('rol', 'persona');
        return view('terracita.nota_venta.create', ['user' => $user]);
    }
    public function getEdit() 
    {
        return view('terracita.nota_venta.edit');
    }

    #API REST
    public function index()
    {

        $notaVentas = NotaVenta::with('detalleVenta')
                ->with(['detalleVenta', 
                        'empleado', 
                        'cliente', 
                        'tipoPago'
                        ])
                ->get();

        foreach ($notaVentas as $notaVenta) {
            $idEmpleado = $notaVenta['empleado']['id_empleado'];
            $idCliente = $notaVenta['cliente']['id_cliente'];
            $personaEmpleado = Persona::findOrFail($idEmpleado);
            $personaCliente = Persona::findOrFail($idCliente);
            $notaVenta['empleado']['persona'] = $personaEmpleado; 
            $notaVenta['cliente']['persona'] = $personaCliente; 
        }

        return new NotaVentaCollection($notaVentas);
    }

    public function store(StoreNotaVentaRequest $request)
    {
        try {
            $datos = $request->json()->all();

            $notaVenta = NotaVenta::create([
                'monto' => $datos['monto'],
                'fecha' => $datos['fecha'],
                'id_empleado' => $datos['id_empleado'],
                'id_cliente' => $datos['id_cliente'],
                'id_tipo_pago' => $datos['id_tipo_pago'],
            ]);

            $idNotaVenta = $notaVenta->id_nota_venta;
            $items = $datos['items_menu'];

            foreach ($items as $item) {
                DetalleVenta::create([
                    'id_nota_venta' => $idNotaVenta,
                    'id_item_menu' => $item['id_item_menu'],
                    'id_menu' => $item['id_menu'],
                    'sub_monto' => $item['sub_monto'],
                    'cantidad' => $item['cantidad'],
                ]);
            }

            $response = [
                'message' => 'Registro insertado correctamente.',
                'status' => 200,
                'data' => $notaVenta,
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => 'Error al insertar el registro.',
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return $response;
    }


    public function show(NotaVenta $notaVenta)
    {
        return new NotaVentaResource($notaVenta);
    }


    public function update(UpdateNotaVentaRequest $request, NotaVenta $notaVenta)
    {
        $response = [];

        try {

            $datos = $request->json()->all();
            if (!$notaVenta) {
                $response = [
                    'message' => 'NotaVenta no encontrado.',
                    'status' => 404,
                ];
            } else {

                // Actualizar nota
                $notaVenta->update([
                    'monto' => $datos['monto'],
                    'fecha' => $datos['fecha'],
                    'id_empleado' => $datos['id_empleado'],
                    'id_cliente' => $datos['id_cliente'],
                    'id_tipo_pago' => $datos['id_tipo_pago'],
                ]);


                $idNotaVenta = $notaVenta->id_nota_venta;
                $items = $request->get('items_menu');

                // Eliminar registros existentes
                DetalleVenta::where('id_nota_venta', $idNotaVenta)->delete();

                // Insertar nuevos registros actualizados
                foreach ($items as $item) {
                    DetalleVenta::create([
                        'id_nota_venta' => $idNotaVenta,
                        'id_item_menu' => $item['id_item_menu'],
                        'id_menu' => $item['id_menu'],
                        'sub_monto' => $item['sub_monto'],
                        'cantidad' => $item['cantidad'],
                    ]);
                }

                $response = [
                    'message' => 'Registro actualizado correctamente.',
                    'status' => 200,
                    'data' => $notaVenta,
                ];
            }
        } catch (\Exception $e) {

            $response = [
                'message' => 'Error al actualizar el registro.',
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        // Laravel manejará automáticamente la conversión a JSON
        return $response;
    }



    public function destroy(NotaVenta $notaVenta)
    {
        $response = [];
        try {

            $notaVenta->update(['estado' => 0]);
            $response = [
                'message' => 'Registro eliminado correctamente.',
                'status' => 200,
                'msg' => $notaVenta
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
        $data = NotaVenta::where('estado', 0);
        return new NotaVentaCollection($data->get());
    }

    public function restaurar(NotaVenta $notaVenta)
    {
        $response = [];
        try {
            $notaVenta->update(['estado' => 1]);

            $response = [
                'message' => 'Se restauró correctamente.',
                'status' => 200,
                'msg' => $notaVenta
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