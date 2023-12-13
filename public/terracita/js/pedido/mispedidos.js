let pedidos = [];
let repartidores = [];
let table = $("#tabla-pedido");

$(document).ready(() => {
    cargarPedido();
    cargarClientesAsync();
});

$(document).on("click", ".Entregar", function () {
    const idPedido = $(this).attr("data-id");
    const pedido = pedidos.find(element => element.id_pedido == idPedido);
    const idRepartidor = user.id_persona; //User viene de la vista mispedidos
    if (pedido.estado_pedido != "Entregado") {
        alertify.confirm("Entregar", "¿Está seguro de Entregar el pedido?",
            function () {
                updatePedido(idPedido, "Entregado", idRepartidor);
            },
            function () {
                alertify.error('Rechazado');
        });
    } else {
        const alerta = alertify.alert("Confirmado", "El pedido ya se encuentra confirmado");
        setTimeout(function () {
            alerta.close();
        }, 1000);
    }
});


$(document).on("click", ".detalle", function () {
    const idPedido = $(this).attr("data-id");
    const enlaceTemporal = document.createElement('a');
    enlaceTemporal.href = rutaLocal + "pedido/detalle/" + idPedido;
    enlaceTemporal.click();
});


function cargarPedido() {
    // showLoader();
    const url = rutaApiRest + "pedido";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            pedidos = response.data;
            const objectRow = [];

            pedidos = pedidos.filter(pedidoUser => pedidoUser.id_repartidor == user.id_persona);

            pedidos.forEach(element => {

                const object = {};
                object.id_pedido = element.id_pedido;
                object.cliente = element.cliente.persona.nombre + " " + element.cliente.persona.paterno;
                object.telefono = element.cliente.persona.telefono;
                object.estado_pedido = element.estado_pedido;
                object.repartidor = element.id_repartidor == null ? null : element.repartidor.persona.nombre + " " +
                    element.repartidor.persona.paterno;
                object.metodo_pago = element.tipo_pago.nombre;
                object.monto = element.monto;
                object.detalle_pedido = element.detalle_pedido;

                object.acciones =
                    `
                        <a data-id="${object.id_pedido}" class="btn btn-primary btn-sm Entregar" title="Entregar"><i class="fa fa-check"></i></a>
                        <a data-id="${object.id_pedido}" class="btn btn-secondary btn-sm detalle" title="Detalles"><i class="fa fa-eye"></i></a>
                        `;

                objectRow.push(object);
            });

            cargarItemMenu(objectRow);
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


function cargarItemMenu(pedidos) {
    const url = rutaApiRest + "item-menu";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);
            const itemsMenu = response.data;

            //Construir el objeto de pedidos con el detalle + itemMenu
            pedidos.forEach(pedido => {
                const detallePedido = pedido.detalle_pedido;
                detallePedido.forEach(detalle => {
                    detalle.item_menu = itemsMenu.find(item => item.id_item_menu == detalle.id_item_menu);
                });
            });


            table.bootstrapTable('load', pedidos);

            console.log(pedidos);
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function updatePedido(idPedido, estadoPedido, idRepartidor = null) {
    const data = {};
    data.id_repartidor = idRepartidor;
    data.estado_pedido = estadoPedido;
    datosEnviar = JSON.stringify(data);
    const url = rutaApiRest + "pedido/" + idPedido;
    console.log(datosEnviar);

    showLoader();
    $.ajax({
        url: url,
        type: "POST",
        data: datosEnviar,
        success: function (response) {
            console.log(response);
            const status = response.status;
            if (status == 200) {

                const alerta = alertify.alert("Confirmado", "¡Súper, todo salió correctamente!");
                setTimeout(function () {
                    alerta.close();;
                }, 1000);

                cargarPedido();
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


function cargarRepartidorPromise() {
    return new Promise((resolve, reject) => {
        const url = rutaApiRest + "repartidor";
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (response) {
                console.log(response);
                const repartidores = response.data;
                resolve(repartidores);
            },
            error: function (data, textStatus, jqXHR, error) {
                console.log(data);
                console.log(textStatus);
                console.log(jqXHR);
                console.log(error);
                reject(error); // Rechaza la Promise en caso de error
            }
        });
    });
}

async function cargarClientesAsync() {
    try {
        repartidores = await cargarRepartidorPromise();
        cargarSelectRepartidor(repartidores);
    } catch (error) {
    }
}

function cargarSelectRepartidor(array, id = 0) {
    const select = $("#id-repartidor");
    select.empty();
    array.forEach(element => {
        let selected = "";
        if (id == element.id_repartidor) {
            selected = "selected";
        }
        select.append(
            `<option value="${element.id_repartidor}" ${selected}>${element.persona.nombre + " " + element.persona.paterno}</option>`
        );
    });
    select.select2({
        width: '100%',
        theme: "classic",
        // maximumSelectionLength: 1
    });
}


//detalle venta, para la tabla principal
function detailFormatter(index, row) {
    var detalleHtml = `
        <div class="table-detail">
            <h5 class="detail-heading">Detalles del pedido</h5>
            <table class="table table-bordered detail-table">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Submonto</th>
                    </tr>
                </thead>
                <tbody>
    `;

    if (row.detalle_pedido) {
        row.detalle_pedido.forEach(function (detalle, index) {
            // Alternar colores de fondo para filas
            var backgroundColor = index % 2 === 0 ? '#f5f5f5' : '#ffffff';

            detalleHtml += `
                <tr style="background-color: ${backgroundColor};">
                    <td>${detalle.item_menu.id_item_menu}</td>
                    <td>${detalle.item_menu.nombre}</td>
                    <td>${detalle.cantidad}</td>
                    <td>${detalle.item_menu.precio}</td>
                    <td>${detalle.sub_monto}</td>
                </tr>
            `;
        });
    }

    detalleHtml += `
                </tbody>
            </table>
        </div>
    `;

    return detalleHtml;
}

function rowStyle(row, index) {
    var estadoPedido = row.estado_pedido;
    var estilo = null;

    switch (estadoPedido) {
        case 'Pendiente':
            estilo = 'bg-warning';
            break;
        case 'Confirmado':
            estilo = 'bg-info';
            break;
        case 'Entregado':
            estilo = 'bg-success';
            break;
        case 'Rechazado':
            estilo = 'bg-danger';
            break;
    }

    // Devuelve siempre un objeto, incluso si el estilo es null
    return { classes: estilo };
}


