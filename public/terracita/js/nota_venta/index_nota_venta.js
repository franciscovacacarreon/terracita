let notaVentas = [];
let table = $("#tabla-nota-venta");
let tableEliminados = $("#tabla-rol-eliminados");

$(document).ready( () => {
    cargarNotaVenta();
});


function cargarNotaVenta() {
    const url = rutaApiRest + "nota-venta";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            notaVentas = response.data;

            notaVentas.forEach(element => {
                element.cliente_td = element.cliente.persona.nombre;
                element.empleado_td = element.empleado.persona.nombre;
                element.metodo_pago = element.tipo_pago.nombre;
                element.acciones = 
                        `
                        <a data-pdf="${element.id_nota_venta}" class="btn btn-warning btn-sm edit" title="Editar"><i class="fa fa-edit"></i></a>
                        `;
            });

            cargarItemMenu();
            table.bootstrapTable('load', notaVentas);

        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

//detalle venta, para la tabla principal
function detailFormatter(index, row) {
    var detalleHtml = `
        <div class="table-detail">
            <h5 class="detail-heading">Detalles del catálogo menú</h5>
            <table class="table table-bordered detail-table">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Submonto</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
    `;

    if (row.detalle_venta) {
        row.detalle_venta.forEach(function (detalle, index) {
            // Alternar colores de fondo para filas
            var backgroundColor = index % 2 === 0 ? '#f5f5f5' : '#ffffff';

            detalleHtml += `
                <tr style="background-color: ${backgroundColor};">
                    <td>${detalle.item_menu.id_item_menu}</td>
                    <td>${detalle.item_menu.nombre}</td>
                    <td>${detalle.item_menu.precio}</td>
                    <td>${detalle.sub_monto}</td>
                    <td>${detalle.cantidad}</td>
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

function cargarItemMenu() {
    const url = rutaApiRest + "item-menu";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            const itemsMenu = response.data;

            //Construir el objeto de notaVentas con el detalle + itemMenu
            notaVentas.forEach(element => {
                const detalleVenta = element.detalle_venta;
                detalleVenta.forEach(element2 => {
                    element2.item_menu = itemsMenu.find(item => item.id_item_menu == element2.id_item_menu);
                });
            });

            console.log(notaVentas);
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}



