let menus = [];
let table = $("#tabla-menu");
let tableEliminados = $("#tabla-rol-eliminados");

$(document).ready( () => {
    cargarMenu();
});


$(document).on("click", ".edit", function() {

    const idMenu = $(this).attr("data-edit");
    const menuEdit = menus.find(element => element.id_menu == idMenu);
    localStorage.setItem('menuEdit', JSON.stringify(menuEdit));
    window.location.href = 'menu-edit';
});

function cargarMenu() {
    const url = rutaApiRest + "menu";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            menus = response.data;
            menus.forEach(element => {
                element.acciones = 
                        `
                        <a data-edit="${element.id_menu}" class="btn btn-warning btn-sm edit" title="Editar"><i class="fa fa-edit"></i></a>
                        <a data-delete="${element.id_menu}" class="btn btn-danger btn-sm delete" title="Borrar"><i class="fa fa-trash"></i></a>
                        `;
            });

            table.bootstrapTable('load', menus);

        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function detailFormatter(index, row) {
    var detalleHtml = `
        <div class="table-detail">
            <h5 class="detail-heading">Detalles del catálogo menú</h5>
            <table class="table table-bordered detail-table">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
    `;

    if (row.item_menus) {
        row.item_menus.forEach(function (detalle, index) {
            // Alternar colores de fondo para filas
            var backgroundColor = index % 2 === 0 ? '#f5f5f5' : '#ffffff';

            detalleHtml += `
                <tr style="background-color: ${backgroundColor};">
                    <td>${detalle.pivot.id_item_menu}</td>
                    <td>${detalle.nombre}</td>
                    <td>${detalle.pivot.cantidad}</td>
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

