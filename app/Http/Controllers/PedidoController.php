<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Http\Resources\PedidoCollection;
use App\Http\Resources\PedidoResource;
use App\Models\Cliente;
use App\Models\DetallePedido;
use App\Models\MenuItemMenu;
use App\Models\Persona;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    #API REST
    public function index()
    {
        $pedidos = Pedido::with(['detallePedido', 
                                'repartidor', 
                                'cliente', 
                                'tipoPago',
                                'ubicacion',
                        ])
                ->get();

         foreach ($pedidos as $pedido) {

             if ($pedido['repartidor'] != null) {
                $idRepartidor = $pedido['repartidor']['id_repartidor'];
                $personaRepartidor = Persona::findOrFail($idRepartidor);
                $pedido['repartidor']['persona'] = $personaRepartidor; 
             }


             $idCliente = $pedido['cliente']['id_cliente'];
             $personaCliente = Persona::findOrFail($idCliente);
             $pedido['cliente']['persona'] = $personaCliente; 
        }

        return new PedidoCollection($pedidos);
    }

    public function store(StorePedidoRequest $request)
    {
        try {
            $datos = $request->json()->all();

            //Insertar nota de venta
            $pedido = Pedido::create([
                'monto' => $datos['monto'],
                'fecha' => $datos['fecha'],
                'id_repartidor' => $datos['id_repartidor'],
                'id_cliente' => $datos['id_cliente'],
                'id_tipo_pago' => $datos['id_tipo_pago'],
                'estado_pedido' => $datos['estado_pedido'],
                'id_ubicacion' => $datos['id_ubicacion'],
            ]);

            //insertar detalle pedido
            $idPedido = $pedido->id_pedido;
            $items = $datos['items_menu'];

            foreach ($items as $item) {
                DetallePedido::create([
                    'id_pedido' => $idPedido,
                    'id_item_menu' => $item['id_item_menu'],
                    'id_menu' => $item['id_menu'],
                    'sub_monto' => $item['sub_monto'],
                    'cantidad' => $item['cantidad'],
                ]);

                
                //actualizar cantidad en menu_item_menu con sql puro (porque es llave compuesta)
               /* $menuItemMenu = MenuItemMenu::where('id_menu', $item['id_menu'])
                    ->where('id_item_menu', $item['id_item_menu'])
                    ->first();

                $sql = "UPDATE menu_item_menu 
                        SET cantidad = ? 
                        WHERE id_menu = ? 
                        AND id_item_menu = ?";
                $cantidad = $menuItemMenu->cantidad - (int)$item['cantidad'];

                DB::update($sql, [
                    $cantidad,
                    $item['id_menu'],
                    $item['id_item_menu'],
                ]); */
            }

            $response = [
                'message' => 'Registro insertado correctamente.',
                'status' => 200,
                'data' => $pedido,
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


    public function show(Pedido $pedido)
    {
        $pedido = $pedido->load('detallePedido', 
                                'repartidor', 
                                'cliente', 
                                'tipoPago',
                                'ubicacion',
                            );

        $pedido['cliente']['persona'] = Persona::findOrFail($pedido['cliente']['id_cliente']);
        if ($pedido['repartidor'] != null) {
            $pedido['repartidor']['persona'] = Persona::findOrFail($pedido['repartidor']['id_repartidor']);
        }
        
        return new PedidoResource($pedido);
    }

    public function showPedidoCliente($idCliente)
    {
        $cliente = Cliente::find($idCliente)->load('pedido');
        return $cliente;
        
        return new PedidoResource($cliente);
    }


    //Sin uso
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        $response = [];

        try {

            $datos = $request->json()->all();
            if (!$pedido) {
                $response = [
                    'message' => 'Pedido no encontrado.',
                    'status' => 404,
                ];
            } else {

                // Actualizar nota
                $pedido->update([
                    'monto' => $datos['monto'],
                    'fecha' => $datos['fecha'],
                    'id_repartidor' => $datos['id_repartidor'],
                    'id_cliente' => $datos['id_cliente'],
                    'id_tipo_pago' => $datos['id_tipo_pago'],
                    'estado_pedido' => $datos['estado_pedido'],
                ]);


                $idPedido = $pedido->id_pedido;
                $items = $request->get('items_menu');

                // Eliminar registros existentes
                DetallePedido::where('id_pedido', $idPedido)->delete();

                // Insertar nuevos registros actualizados
                foreach ($items as $item) {
                    DetallePedido::create([
                        'id_pedido' => $idPedido,
                        'id_item_menu' => $item['id_item_menu'],
                        'id_menu' => $item['id_menu'],
                        'sub_monto' => $item['sub_monto'],
                        'cantidad' => $item['cantidad'],
                    ]);
                }

                $response = [
                    'message' => 'Registro actualizado correctamente.',
                    'status' => 200,
                    'data' => $pedido,
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

    //Sin uso
    public function destroy(Pedido $pedido)
    {
        $response = [];
        try {

            $pedido->update(['estado' => 0]);
            $response = [
                'message' => 'Registro eliminado correctamente.',
                'status' => 200,
                'msg' => $pedido
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

     //Sin uso
    public function eliminados()
    {
        $data = Pedido::where('estado', 0);
        return new PedidoCollection($data->get());
    }

     //Sin uso
    public function restaurar(Pedido $pedido)
    {
        $response = [];
        try {
            $pedido->update(['estado' => 1]);

            $response = [
                'message' => 'Se restauró correctamente.',
                'status' => 200,
                'msg' => $pedido
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
