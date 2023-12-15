@extends('cliente_web.layoutweb')


@section('contentweb')

<section class="book_section layout_padding mt-3">
    <div class="row">
        <div class="col-lg-8">
            <div class="container p-3">
                <div class="row">
                    <div class="col-12 form-group d-flex justify-content-center">
                        <h3 class="tex-title tex-center"><i class="fas fa-id-card"></i> Tus datos</h5>
                    </div>
    
                    <div class="col-md-6 form-group">
                        <input placeholder="Nombre" type="text" class="form-control" id="nombre" name="nombre" disabled>
                    </div>
                    <div class="col-md-6 form-group ">
                        <input placeholder="apellido" type="text" class="form-control" id="paterno" name="paterno" disabled>
                    </div>
    
                    <div class="col-md-6 form-group ">
                        <input placeholder="telefono" type="tel" class="form-control" id="telefono" name="telefono" disabled>
                    </div>
                    <div class="col-md-6 form-group ">
                        <input placeholder="Correo" type="text" class="form-control" id="correo" name="correo" disabled>
                    </div>
                    
                    <div class="col-md-12 form-group my-2">
                        <h3 class="titulo_h3"><i class="fas fa-map-marker"></i>
                            Tu dirección
                        </h3>
                        <input id="direccion" type="text" class="form-control" placeholder="Escribe tu dirección">
                    </div>


    
                    <div class="col-12 form-group">
                        <input class="d-none" type="text" name="" id="latitud">
                        <input class="d-none" type="text" name="" id="longitud">
    
                        <div id="map-container">
                            <div id="map"></div>
                            <button id="ubicacion-actual-btn" type="button" title="Ubicación actual">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>

        <div class="col-lg-4">
            <div class="my-3 container">
                <h4>Tu pedido (Monto total no incluye el envío)</h4>
                <div id="detalle-productos" class="row">
                </div>
                <ul class="list d-flex justify-content-end">
                    <p class="font-weight-bold">Total: <span id="total"></span></p>
                </ul>
                <div class="my-2">
                    <hr>
                    <h4>Métodos de pago</h4>
                    <div class="d-flex justify-content-start align-items-center my-2">
                        <div class="form-check mx-2">
                            <input class="form-check-input" type="radio"  name="flexRadioDefault" id="pago-efectivo" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              Efectivo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="pago-paypal">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Paypal
                              </label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <label id="label-price" for="" class="form-label mx-1 d-none">Precio en dólares ($): </label>
                        <input class="form-control col-4 d-none" type="text" id="price" name="price" disabled>
                    </div>
                </div>
                <div>
                    <button id="confirmar-pedido" class="btn btn-warning my-2" style="width: 100%;">
                        <i class="fas fa-credit-card" aria-hidden="true"></i> Confirmar pedido
                    </button>
                    
                    <button id="seguir-comprando" class="btn btn-secondary" style="width: 100%;">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Seguir comprando
                    </button>
                </div>
            </div>
        </div>
        

    </div>
</section>


@endsection

@section('clienteweb-css')
    <style>
        #map {
            width: 100%;
            height: 400px;
        }
        #ubicacion-actual-btn {
            position: absolute;
            bottom: 110px;
            right: 25px;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 2px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            font-weight: 400;
            padding: 10px 20px;
            white-space: nowrap;
            z-index: 1;
            width: 10px;
        }

        #ubicacion-actual-btn:hover {
            background-color: #f8f8f8;
        }
    </style>
@endsection

  @section('clienteweb-js')
        <!-- Maps -->
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVIXqy33ZmOtGAUY8b5gnC0exNaFB_9l4&libraries=places,directions,geometry&callback=initMap"
      type="text/javascript"></script>

      <script src="{{asset('/terracita/js/cliente_web/confirmar.js')}}"></script>

  @endsection