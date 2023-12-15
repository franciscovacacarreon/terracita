let map;
let marker;
let metodoPago = 1; //efectivo


$(document).ready(function () {
    cargarDatosCliente();
    cargarDetalleProducto();

    $("#registrarme-nav").addClass("d-none");
    $("#nav-carrito-search").addClass("d-none");
});

$(document).on("click", "#ubicacion-actual-btn", () => {
    ubicacionActualReady();
});

$(document).on("click", "#seguir-comprando", () => {
    const enlaceTemporal = document.createElement('a');
    enlaceTemporal.href = rutaLocal + "cliente-web";
    enlaceTemporal.click();
});

$(document).on("click", "#confirmar-pedido", () => {
    if (validar($("#direccion"))) {
        saveUbicacion();
    }
});

function paypal(idPedido) {
    const precio = $("#price").val();
    const url = rutaLocal + "cliente-web-paypal/payment/" + precio + "/"  + idPedido;
    $.ajax({
        url: url,
        type: "GET",
        success: function (response) {
            console.log(response)
            window.open(response, "_blank")
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}


function savePedido(idUbicacion) {
    let carritomall = JSON.parse(localStorage.getItem('carritomall'));
    const clienteMall = JSON.parse(localStorage.getItem('clientemall'));
    ccarritomall = castearCarrito(carritomall);
    const data = {};
    const montos = montoTotal(carritomall, 0);
    data.monto = parseFloat(montos.monto);
    data.fecha = obtenerFechaActual();
    data.id_repartidor = null;
    data.id_cliente = clienteMall.id_cliente;
    data.id_tipo_pago = 1; //Corregir
    data.id_ubicacion = idUbicacion; 
    data.estado_pedido = "Pendiente"; 
    data.items_menu = carritomall;
    datosEnviar = JSON.stringify(data);
    const url = rutaApiRest + "pedido";
    // console.log(datosEnviar);
    showLoader();
    $.ajax({
        url: url,
        type: "POST",
        data: datosEnviar,
        success: function (response) {
            console.log(response);
            const status = response.status;
            if (status == 200) {
                const data = response.data;
                paypal(data.id_pedido);
                // const alerta = alertify.alert("Correcto", "¡Súper, hiciste tu pedido correctamente!");
                // setTimeout(function(){
                //     alerta.close();
                //     window.location.href = "cliente-web-detalle/" + data.id_pedido;

                // }, 1000);

                
                localStorage.removeItem('carritomall');

            } else {
                alertify.alert(
                    "Error",
                    "Error, ocurrio un problema!"
                );
            }
            
            hideLoader();
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
            
            hideLoader();
        }

    });
}

function saveUbicacion() {
    const data = {};
    data.latitud = $("#latitud").val();
    data.longitud = $("#longitud").val();
    data.referencia = $("#direccion").val();
    const url = rutaApiRest + "ubicacion";
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: data,
        success: function (response) {
            console.log(response);
            savePedido(response.msg.id_ubicacion);
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function cargarDatosCliente() {
    const clientemall = JSON.parse(localStorage.getItem('clientemall'));
    $("#nombre-usuario").text(clientemall.user.name);
    $("#nombre").val(clientemall.nombre);
    $("#paterno").val(clientemall.paterno);
    $("#telefono").val(clientemall.telefono);
    $("#correo").val(clientemall.correo);
}

function cargarDetalleProducto() {
    const carritomall = JSON.parse(localStorage.getItem('carritomall'));
    const contenedor = $("#detalle-productos");
    const cabecera = `
        <div class="col-6"><strong>Producto</strong></div>
        <div class="col-6 text-right"><strong>Subtotal</strong></div>
    `;
    contenedor.append(cabecera);
    let total = 0;
    carritomall.forEach(element => {
        total += element.sub_monto;
        const cuerpo = `
            <div class="col-6"><span>${element.nombre}</span></div>
            <div class="col-2 text-center"><span> x${element.cantidad}</span></div>
            <div class="col-4 text-right"><span>${element.sub_monto} Bs.</span></div>
        `;
        contenedor.append(cuerpo);
    });
    $("#total").text(total + " " + "Bs.");
    $("#price").val(montoDolar(total));
}

function montoTotal(array, descuentoCliente) {
    let monto = 0;
    const descuento = descuentoCliente;

    array.forEach(element => {
        monto += parseFloat(element.sub_monto);
    });

    // const montoDescuento = calcularMontoConDescuento(monto, descuento).toFixed(2);

    return {
        monto: monto,
        monto_descuento: 0 
    };
}


function montoDolar(monto) {
    return (monto / 6.9).toFixed(2);
}

function castearCarrito(carrito) {
    carrito.forEach(element => {
        element.id_menu = element.pivot.id_menu;
    });
    return carrito;
}

function obtenerFechaActual() {
    var fechaActual = new Date();
    var año = fechaActual.getFullYear();
    var mes = ('0' + (fechaActual.getMonth() + 1)).slice(-2); // Agrega un cero al mes si es necesario
    var dia = ('0' + fechaActual.getDate()).slice(-2); // Agrega un cero al día si es necesario

    var fechaFormateada = año + '-' + mes + '-' + dia;
    return fechaFormateada;
}

$("input[type='radio']").change(function () {
    if ($(this).is(":checked")) {
        var radioId = $(this).attr("id");
        if (radioId == "pago-paypal") {
            $("#price").removeClass("d-none");
            $("#label-price").removeClass("d-none");
            metodoPago = 2;
        } else {
            $("#price").addClass("d-none");
            $("#label-price").addClass("d-none");
            metodoPago = 1;
        }
    }
});


/// GOOGLE MAPS
function initMap() {
    const latitud = -17.7962;
    const longitud = -63.1814;
    $("#latitud").val(latitud);
    $("#longitud").val(longitud);
    var myLatLng = { lat: latitud, lng: longitud };
    var mapOptions = {
      center: myLatLng,
      zoom: 8,
      streetViewControl: false,
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      draggable: true,
      title: 'Mi marcador',
    });

    markerListenerDragend(marker);
    mapListenerClick(map, marker);
    initAutoComplete(map, marker);
}

function mapListenerClick(map, marker) {
    map.addListener('click', function(event) {
        const clickedLat = event.latLng.lat();
        const clickedLng = event.latLng.lng();

        marker.setPosition(event.latLng);

        $("#latitud").val(clickedLat);
        $("#longitud").val(clickedLng);

        localizacionInversa(event);

    });
}

function markerListenerDragend(marker) {
    google.maps.event.addListener(marker, 'dragend', function(event) {
        const latitud = this.getPosition().lat();
        const longitud = this.getPosition().lng();

        $("#latitud").val(latitud);
        $("#longitud").val(longitud);

        localizacionInversa(event);

    });
}

function initAutoComplete(map, marker) {
    const inputDireccionCliente = document.getElementById("direccion");

    //establecer limites geográficos para Bolivia
    const center = {
        lat: -16.290154,
        lng: -63.588653
    };

    const defaultBounds = {
        north: center.lat + 0.5, 
        south: center.lat - 0.5, 
        east: center.lng + 0.5, 
        west: center.lng - 0.5, 
    };

    const options = {
        bounds: defaultBounds, 
        componentRestrictions: { country: "bo" }, 
        fields: ["address_components", "geometry", "icon", "name"],
        strictBounds: false,
        types: [],
    };

    let autoComplete = new google.maps.places.Autocomplete(inputDireccionCliente, options);

    autoComplete.addListener('place_changed', function(){
        const place = autoComplete.getPlace();

        if (place.geometry && place.geometry.location) {
            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location);
            $("#latitud").val(place.geometry.location.lat());
            $("#longitud").val(place.geometry.location.lng());

            smoothZoom(map, 13, 500);

        } else {
            console.log("La ubicación del lugar no está definida correctamente.");
        }
    });
}

function localizacionInversa(event) {
    // Obtener la dirección inversa utilizando Geocoding
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'location': event.latLng }, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                const formattedAddress = results[0].formatted_address;
                $("#direccion").val(formattedAddress);
            }
        }
    });
}

// Función para realizar el zoom suave
function smoothZoom(map, targetZoom, duration) {
    const currentZoom = map.getZoom();
    const steps = Math.abs(currentZoom - targetZoom);
    const delay = duration / steps;

    if (currentZoom < targetZoom) {
      for (let i = currentZoom; i < targetZoom; i++) {
        setTimeout(function () {
          map.setZoom(i + 1);
        }, i * delay);
      }
    } else if (currentZoom > targetZoom) {
      for (let i = currentZoom; i > targetZoom; i--) {
        setTimeout(function () {
          map.setZoom(i - 1);
        }, (currentZoom - i) * delay);
      }
    }
}

function ubicacionActual() {
    return new Promise(function(resolve, reject) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                resolve(pos);

            }, function() {
                reject("Error al obtener la ubicación");
            });
        } else {
            reject("El navegador no soporta la geolocalización");
        }
    });
}

function ubicacionActual() {
    return new Promise(function(resolve, reject) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                resolve(pos);

            }, function() {
                reject("Error al obtener la ubicación");
            });
        } else {
            reject("El navegador no soporta la geolocalización");
        }
    });
}

function ubicacionActualReady() {
    ubicacionActual()
        .then((posicion) => {

            localizacionInversa({ latLng: posicion });
            $("#latitud").val(posicion.lat);
            $("#longitud").val(posicion.lng);
            
            map.setCenter(posicion);
            marker.setPosition(posicion);

            smoothZoom(map, 13, 500);

            console.log('Ubicación obtenida correctamente:', posicion);
        })
        .catch((error) => {
            initMap();
            console.log("Error al obtener la ubicación:", error);
    });
}