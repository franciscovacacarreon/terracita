@extends('cliente_web.layoutweb')


@section('contentweb')

<section class="book_section layout_padding mt-3">
    <div class="container">
      <div class="heading_container">
        <h4>
          <i class="fas fa-user-plus"></i> Crea una cuenta para hacer tu pedido
        </h4>
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
                <p id="correo-advertencia" class="form-label text-danger d-none">Correo no disponible</p>
                
              </div>
              <div>
                <input id="password" type="password" class="form-control" placeholder="Contraseña" />
                <p class="form-label text-danger d-none password-advertencia">Las contraseñas no coinciden</p>
              </div>
              <div>
                <input id="password-repite" type="password" class="form-control" placeholder="Repite la Contraseña" />
                <p class="form-label text-danger d-none password-advertencia">Las contraseñas no coinciden</p>

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

@section('clienteweb-css')
  <style>
      .heading_container {
          text-align: center;
          margin-bottom: 30px;
      }

      .form_container {
          background-color: #f8f9fa;
          padding: 20px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          margin-bottom: 20px;
      }

      .btn_box {
          margin-top: 20px;
      }

      .map_container {
          margin-top: 20px;
      }

      #map {
          width: 100%;
          height: 350px;
          border-radius: 10px;
      }
  </style>
@endsection

  @section('clienteweb-js')

      <script src="{{asset('/terracita/js/cliente_web/form_cliente.js')}}"></script>

  @endsection