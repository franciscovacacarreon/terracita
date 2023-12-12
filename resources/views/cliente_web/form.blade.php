@extends('cliente_web.layoutweb')


@section('contentweb')

<section class="book_section layout_padding mt-3">
    <div class="container">
      <div class="heading_container">
        <h2>
          Create una cuenta para hacer tu pedido
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            
              <div>
                <input id="usuario" type="text" class="form-control" placeholder="Nombre de usuario" />
              </div>
              <div>
                <input id="nombre" type="text" class="form-control" placeholder="Nombre" />
              </div>
              <div>
                <input id="paterno" type="text" class="form-control" placeholder="Apellido" />
              </div>
              <div>
                <input id="telefono" type="text" class="form-control" placeholder="Telefono" />
              </div>
              {{-- <div>
                <input type="date" class="form-control">
              </div> --}}
              <div class="btn_box">
                <button id="btn-registrar">
                    Registrarme
                </button>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form_container">
              <div>
                <input id="correo" type="email" class="form-control" placeholder="Tu Correo" />
              </div>
              <div>
                <input id="password" type="password" class="form-control" placeholder="Contraseña" />
              </div>
              <div>
                <input id="password-repite" type="password" class="form-control" placeholder="Repite la Contraseña" />
              </div>
              {{-- <div>
                <input type="date" class="form-control">
              </div> --}}
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            <input type="text" hidden id="latitud">
            <input type="text" hidden id="longitud">
            <div id="map" style="height: 350px;"></div>
          <div>
          </div>
        </div>
      </div>
    </div>
</section>


@endsection

  @section('clienteweb-js')
        <!-- Maps -->
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVIXqy33ZmOtGAUY8b5gnC0exNaFB_9l4&libraries=places,directions,geometry&callback=initMap"
      type="text/javascript"></script>

      <script src="{{asset('/terracita/js/cliente_web/form_cliente.js')}}"></script>

  @endsection