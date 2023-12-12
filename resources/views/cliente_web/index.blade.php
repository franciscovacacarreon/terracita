@extends('cliente_web.layoutweb')


@section('contentweb')


<div class="hero_area">
  {{-- Imagen de carrusel --}}
  <div class="bg-box">
    <img src="{{asset('/feane/images/hero-bg.jpg')}}" alt="">
  </div>

  <!-- slider section -->
  <section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Bienvenido a Mi Terracita
                  </h1>
                  <p>
                    Sumérgete en una experiencia culinaria única en nuestro acogedor restaurante. Descubre la deliciosa fusión de sabores en cada platillo, cuidadosamente preparado para satisfacer tus antojos. Deleita tus sentidos con nosotros.
                  </p>
                  <div class="btn-box">
                    <a href="#section-items" class="btn1">
                      ¡Ordena Ahora!
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item ">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Explora los Sabores en Mi Terracita
                  </h1>
                  <p>
                    Deleita tu paladar con nuestras exquisitas opciones de fast food. Cada bocado es una explosión de sabor y frescura. En Mi Terracita, no solo ofrecemos comida rápida, ofrecemos una experiencia gastronómica inolvidable.
                  </p>
                  <div class="btn-box">
                    <a href="#section-items" class="btn1">
                      ¡Haz tu Pedido Ahora!
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Descubre Mi Terracita
                  </h1>
                  <p>
                    Suma momentos especiales con nosotros. En Mi Terracita, creamos no solo comidas, sino recuerdos. Ven y disfruta de la atmósfera acogedora mientras te entregamos delicias irresistibles que te harán volver por más.
                  </p>
                  <div class="btn-box">
                    <a href="#section-items" class="btn1">
                      ¡Ordénalo Ya!
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>
    </div>
  </section>
  <!-- end slider section -->
</div>

<section class="food_section layout_padding-bottom mt-3" id="section-items">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Menú del día
      </h2>
    </div>

    <ul class="filters_menu" id="ul-tipo-menu">
      <li data-filter=".fries">Fries</li>
    </ul>

    <div class="filters-content">
      <div class="row grid" id="contenido-item-menu">
        
      </div>
    </div>
    <div class="btn-box">
      <a href="">
        View More
      </a>
    </div>
  </div>


{{-- modal carrito --}}
<!-- Modal -->
<div class="modal fade" id="carritoModal" tabindex="-1" role="dialog" aria-labelledby="carritoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="carritoModalLabel"><i class="fas fa-receipt"></i> Detalle del carrito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body overflow-auto">
        <p>Monto total: <span id="monto"></span></p>
        <div class="row container d-flex justify-content-center align-items-center" id="content-modal-carrito">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-shopping-cart"></i> Seguir comprando</button>
        <button type="button" class="btn btn-dark" id="proceder-pagar"><i class="fas fa-money-check"></i> Proceder a pagar</button>
      </div>
    </div>
  </div>
</div>

{{-- end modal carrito --}}

{{-- Botón flotante --}}
<div class="floating-cart-button" id="boton-flotante">
  <span id="total-item" class="text-white"></span>
  <a id="open-cart" href="alg" class="text-warning" data-toggle="modal" data-target="#carritoModal">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito
  </a>
</div>
{{-- end boton flotante --}}





@endsection

@section('clienteweb-css')
    <style>
        /* .img-content {
          padding: 0px!important;
        } */
      
    </style> 
@endsection


@section('clienteweb-js')
  <script src="{{asset('/terracita/js/cliente_web/index_cliente_web.js')}}"></script>
  <script src="{{asset('/terracita/js/cliente_web/form_cliente.js')}}"></script>
@endsection