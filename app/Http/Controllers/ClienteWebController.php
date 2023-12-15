<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class ClienteWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex()
    {
        return view('cliente_web.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getForm()
    {
        return view('cliente_web.form');
    }

    public function getConfirmar()
    {
        return view('cliente_web.confirmar');
    }

    public function getDetallePedido(Request $request, $idPedido)
    {
        return view('cliente_web.detalle_pedido', ['idPedido' => $idPedido]);
    }

    public function getMisPedidos(Request $request, $idCliente)
    {
        return view('cliente_web.mis_pedidos', ['idCliente' => $idCliente]);
    }

    public function getPaypal()
    {
        return view('cliente_web.paypal.index');
    }

    #paypal
    public function payment(Request $request, $price, $idPedido)
    {
        $provider = new PayPalClient; //Instancia de paypal
        $provider->setApiCredentials(config('paypal')); //obtener credenciales de la api
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                "return_url" => asset("/cliente-web-detalle/$idPedido"),
                "cancel_url" => asset('/cliente-web-paypal/cancel')
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $price,
                    ],
                ],
            ],
        ]);
        

        // $provider->setCurrency('EUR');
    
        // dd($response);

        if (isset($response['id'])  &&  $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel']  == 'approve') {
                    return $link['href'];
                }
            }
        } else {
            return redirect(asset('/cliente-web-paypal/cancel'));
        }  
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient; 
        $provider->setApiCredentials(config('paypal')); 
        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token); //capturar la respuesta de la orde
        // dd($response);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return "Paypal success";
        } else {
            return redirect(asset('/cliente-web-paypal/cancel'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function cancel()
    {
        return "Paypal is canceled";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
