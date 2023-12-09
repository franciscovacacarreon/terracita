let notaVentas = [];
let itemsMenu = [];
let itemsCarrito = [];
let catalogoMenus = [];
let userAutenticado = user; //user es un objeto que lo obtenemos de create.blade.php
let clientes = [];
let idMenu = 0;
let idCliente = 0;

$(document).ready( () => {
    const carritoStorage = JSON.parse(localStorage.getItem('carritoVenta'));
    if (carritoStorage) {
        if (carritoStorage.length > 0) {
            cargarItemMenuAgregado(carritoStorage);
            itemsCarrito = carritoStorage;
        }
    }
    cargarCatalogoMenu();
    cargarCliente();
    $("#fecha").val(obtenerFechaActual());
});

$("#guardar-nota-venta").click(() => {
    if (itemsCarrito.length > 0) {
        saveNotaVenta();
    } 
});

//Buscadores para los items
$('#buscar').on('keyup', function () {
    realizarBusqueda('#buscar', '.buscar-disponible');
});

$('#buscar-add').on('keyup', function () {
    realizarBusqueda('#buscar-add', '.buscar-agregado');
});

//boton para agregar del card para agregar item
$(document).on("click", ".agregar-disponible", function(e) {
    const idItemMenu = this.name;
    const itemAdd = itemsMenu.find(item => item.id_item_menu == idItemMenu);
    if (!itemAdd.add) {
        itemAdd.add = true;
        itemAdd.sub_monto = itemAdd.precio;
        itemAdd.id_menu = idMenu;

        itemsCarrito.push(itemAdd);
        cargarItemMenuAgregado(itemsCarrito);
        
        $("#monto").val(montoTotal(itemsCarrito));

        localStorage.setItem('carritoVenta', JSON.stringify(itemsCarrito));
    }
});

//boton del card para eliminar item
$(document).on("click", ".eliminar-item-add", function(e) {
    const idItemMenu = this.name;
    const itemADelete = itemsMenu.find(item => item.id_item_menu == idItemMenu);
    itemADelete.add = false;
    const newItemTemp = itemsCarrito.filter(deleteItem => deleteItem.id_item_menu != idItemMenu);
    itemsCarrito = newItemTemp;

    cargarItemMenuAgregado(itemsCarrito);

    $("#monto").val(montoTotal(itemsCarrito));

    localStorage.setItem('carritoVenta', JSON.stringify(itemsCarrito));
});

//boton del card para sumar cantidad
$(document).on("click", ".btn-plus-agregado", function(e) {
    const idItemMenu = this.name;
    const itemAddCantidad = itemsCarrito.find(item => item.id_item_menu == idItemMenu);
    const inputCantidad = $("#" + idItemMenu);
    const spanSubmonto = $("#submonto-" + idItemMenu);
    const cantidadActualInput = inputCantidad.val();
    const cantidad = parseInt(cantidadActualInput) + 1;
    itemAddCantidad.cantidad = cantidad;
    itemAddCantidad.sub_monto = cantidad * itemAddCantidad.precio;
    
    inputCantidad.val(cantidad);
    spanSubmonto.text(itemAddCantidad.sub_monto);

    $("#monto").val(montoTotal(itemsCarrito));
    
    localStorage.setItem('carritoVenta', JSON.stringify(itemsCarrito));
});

//boton del card para restar cantidad
$(document).on("click", ".btn-minus-agregado", function(e) {
    const idItemMenu = this.name;
    const itemAddCantidad = itemsCarrito.find(item => item.id_item_menu == idItemMenu);
    const inputCantidad = $("#" + idItemMenu);
    const spanSubmonto = $("#submonto-" + idItemMenu);
    const cantidadActualInput = inputCantidad.val();
    let cantidad = parseInt(cantidadActualInput);
    if (cantidad > 1){
        cantidad -= 1;
        itemAddCantidad.cantidad = cantidad;
        itemAddCantidad.sub_monto = cantidad * itemAddCantidad.precio;

        inputCantidad.val(cantidad);
        spanSubmonto.text(itemAddCantidad.sub_monto);

        $("#monto").val(montoTotal(itemsCarrito));

        localStorage.setItem('carritoVenta', JSON.stringify(itemsCarrito));
    }
});

//listener para el input cantidad controlar cantidades negativas
$(document).on("keyup", ".input-cantidad", function(e) {
    const id = this.id;
    const inputCantidad = $("#" + id);
    if (parseInt(inputCantidad.val()) <= 0) {
        const alerta = alertify.alert("Error", "No se permiten cantidades negativas");
        setTimeout(function(){
            alerta.close();
        }, 1000);
        inputCantidad.val(1);
    }
});

//evento select
$('#id-cliente').on('select2:select', function (e) {
    const data = e.params.data;
    idCliente = parseInt(data.id);
    console.log(idCliente);
});

function cargarCardItemsMenu(items) {
    const contenedorCards = $("#content-card-disponible");
    contenedorCards.html("");
    items.forEach(item => {
        item.add = false;
        item.cantidad = 1;
        const cardCuerpo = `
        <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
            <div class="card card-sm menu-card buscar-disponible" style="width: 10rem;">
                <img src="${rutaLocal + item.imagen}" alt="${item.nombre}">
                    <div class="menu-card-content">
                        <h3>${item.nombre}</h3>
                        <p>${item.descripcion}</p>
                        <p>Precio: <span class="menu-card-price">Bs ${item.precio}</span></p>
                        <button class="add-to-cart-btn agregar-disponible" name="${item.id_item_menu}">Agregar</button>
                    </div>
            </div>
        </div>
        `;
        contenedorCards.append(cardCuerpo);
    });
}

function cargarItemMenuAgregado(items) {
    const contenedorAgregados = document.getElementById("content-card-add");
    contenedorAgregados.innerHTML = "";
    items.forEach(item => {
        const cuerpoCard = `
                <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
                    <div class="card card-sm menu-card buscar-agregado" style="width: 10rem; height: 225px">
                        <img src="${rutaLocal + item.imagen}" alt="${item.nombre}">
                        <div class="menu-card-content">
                            <h3>${item.nombre}</h3>
                            <p>Precio: <span class="menu-card-price">Bs ${item.precio}</span></p>
                            <p>Submonto: <span class="menu-card-price" id="submonto-${item.id_item_menu}">Bs ${item.sub_monto}</span></p>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control form-control-sm input-cantidad" value="${item.cantidad}" id="${item.id_item_menu}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success btn-sm mx-1  btn-plus-agregado" name="${item.id_item_menu}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-warning btn-sm btn-minus-agregado" name="${item.id_item_menu}">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center my-1">
                                    
                                   <button type="button" class="btn btn-info btn-sm mx-1 ver-item-add" name="${item.id_item_menu}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                    
                                    <button class="btn btn-danger btn-sm mx-1 eliminar-item-add" name="${item.id_item_menu}">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        `;
        contenedorAgregados.innerHTML += cuerpoCard;
    });
}

function cargarCatalogoMenu() {
    const fecha = obtenerFechaActual();
    const url = rutaApiRest + "menu-fecha/" + fecha;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            catalogoMenus = response.data;
            if (catalogoMenus.length > 0) {
                itemsMenu = menusDia.item_menus;
            }
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function cargarCliente() {
    const url = rutaApiRest + "cliente";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            clientes = response.data;
            cargarSelectClientes(clientes);
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function cargarSelectClientes(array, id = 0) {
    const select = $("#id-cliente");
    array.forEach(element => {
        let selected = "";
        if (id == element.id_cliente) {
            selected = "selected";
        }
        select.append(
            `<option value="${element.id_cliente}" ${selected}>${element.persona.nombre + " " + element.persona.paterno}</option>`
          );
    });
    select.select2({
        width: '100%', 
        theme: "classic",
        // maximumSelectionLength: 1
    });
}
function saveNotaVenta() {
    const data = {};
    data.monto = parseFloat($("#monto").val());
    data.fecha = $("#fecha").val();
    data.id_empleado = userAutenticado.id_persona;
    data.id_cliente = idCliente;
    data.id_tipo_pago = 1; //Corregir
    data.items_menu = itemsCarrito;
    datosEnviar = JSON.stringify(data);
    const url = rutaApiRest + "nota-venta";
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
                const alerta = alertify.alert("Correcto", "¡Súper, se insertó correctamente!");
                setTimeout(function(){
                    alerta.close();
                }, 1000);

                $("#nombre").val("");

                itemsCarrito = [];
                localStorage.removeItem('carritoVenta');
                cargarItemMenuAgregado(itemsCarrito);
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

function realizarBusqueda(botonBuscar, claseBusqueda) {
    var searchText = $(botonBuscar).val().toLowerCase();

    // Iterar sobre cada elemento con la clase proporcionada y mostrar/ocultar según la búsqueda
    $(claseBusqueda).each(function () {
        var cardText = $(this).text().toLowerCase();
        if (cardText.includes(searchText)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

function montoTotal(array) {
    let monto = 0;
    array.forEach(element => {
        monto += parseFloat(element.sub_monto);
    });
    return monto;
}

function obtenerFechaActual() {
    var fechaActual = new Date();
    var año = fechaActual.getFullYear();
    var mes = ('0' + (fechaActual.getMonth() + 1)).slice(-2); // Agrega un cero al mes si es necesario
    var dia = ('0' + fechaActual.getDate()).slice(-2); // Agrega un cero al día si es necesario

    var fechaFormateada = año + '-' + mes + '-' + dia;
    return fechaFormateada;
}

