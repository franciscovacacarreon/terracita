<?php

namespace App\Http\Controllers;

use App\Models\NotaVenta;
use App\Http\Requests\StoreNotaVentaRequest;
use App\Http\Requests\UpdateNotaVentaRequest;
use App\Http\Resources\NotaVentaCollection;
use App\Http\Resources\NotaVentaResource;
use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\ItemMenu;
use App\Models\MenuItemMenu;
use App\Models\Persona;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    
    public function getComprobantePdf($id)
    {
        // URL de la página cuyo HTML deseas convertir a PDF
        $url = asset('/nota-venta-comprobante/'.$id);

        // Obtener el contenido HTML de la página
        $html = file_get_contents($url);

        // Opciones de configuración de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        // Instancia de Dompdf con las opciones
        $dompdf = new Dompdf($options);

        // Cargar el HTML
        $dompdf->loadHtml($html);

        // Renderizar el PDF
        $dompdf->render();

        // Enviar el PDF al navegador
        $dompdf->stream("documento.pdf", array("Attachment" => false));
    }

    public function getComprobante($id) 
    {
        $venta = NotaVenta::findOrFail($id)->load('cliente', 'empleado');
        $venta['detalle_venta'] = DetalleVenta::where('id_nota_venta', $venta['id_nota_venta'])->get();
        $venta['persona_cliente'] = Persona::findOrFail($venta['cliente']['id_cliente']);
        $venta['persona_empleado'] = Persona::findOrFail($venta['empleado']['id_empleado']);

        $i = 0;
        $ventaDetalle = [];
        foreach ($venta['detalle_venta'] as $detalle) {
            $detalle['item_menu'] = ItemMenu::findOrFail($detalle['id_item_menu'])->load('tipoMenu');
            $ventaDetalle[$i] = $detalle;
            $i++;
        }

        $venta['detalle_venta_item'] = $ventaDetalle;

        return view('terracita.nota_venta.comprobante_venta', ['venta' => $venta]);
    }

    #API REST
    public function index()
    {
        //
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
    public function store(StoreNotaVentaRequest $request)
    {
        try {
            $datos = $request->json()->all();

            //Insertar nota de venta
            $notaVenta = NotaVenta::create([
                'monto' => $datos['monto'],
                'fecha' => $datos['fecha'],
                'id_empleado' => $datos['id_empleado'],
                'id_cliente' => $datos['id_cliente'],
                'id_tipo_pago' => $datos['id_tipo_pago'],
            ]);

            //insertar detalle de venta
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

                
                //actualizar cantidad en menu_item_menu con sql puro (porque es llave compuesta)
                $menuItemMenu = MenuItemMenu::where('id_menu', $item['id_menu'])
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

    /**
     * Display the specified resource.
     */
    public function show(NotaVenta $notaVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaVenta $notaVenta)
    {
        //
    }

    //Sin uso
    public function update(UpdateNotaVentaRequest $request, NotaVenta $notaVenta)
    {
        //
    }

    //Sin uso
    public function destroy(NotaVenta $notaVenta)
    {
        //
    }

     //Sin uso
    public function eliminados()
    {
        $data = NotaVenta::where('estado', 0);
        return new NotaVentaCollection($data->get());
    }

     //Sin uso
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
