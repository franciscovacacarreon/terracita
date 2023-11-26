let iteMenu = [];
let tipoMenu = [];
let table = $("#tabla-item-menu");

$(document).ready( () => {
    cargarItemMenu();
    cargarTipoMenu();
});

$("#btn-nuevo-item-menu").click(() => {
    $("#modal-nuevo-item-menu").modal('show');
});

$("#guardar-item-menu").click(() => {
    if (validar($("#nombre")) &&
        validar($("#precio")) &&
        validar($("#descripcion"))) {
        saveItemMenu();
    } 
});

$(document).on("click", ".edit", function() {
    const id_tipo_menu = $(this).attr("data-edit");

    tipoMenu.forEach(element => {
      if(element.id_tipo_menu == id_tipo_menu ) {
        $("#nombre-edit").val(element.nombre);
      }
    });

    $("#actualizar-item-menu").attr("name", id_tipo_menu);
    $("#modal-editar-item-menu").modal('show');
});

function saveItemMenu() {
    // Obtener datos del formulario
    const nombre = document.getElementById('nombre').value;
    const precio = document.getElementById('precio').value;
    const descripcion = document.getElementById('descripcion').value;
    const id_tipo_menu = document.getElementById('id_tipo_menu').value;
    const imagen = document.getElementById('imagen').files[0]; // Obtener el archivo de imagen

    // Crear un objeto FormData para enviar datos binarios (como archivos)
    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('precio', precio);
    formData.append('descripcion', descripcion);
    formData.append('id_tipo_menu', id_tipo_menu);
    formData.append('imagen', imagen);

    const url = rutaApiRest + "item-menu";
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            console.log(response);
            const status = response.status;
            if (status == 200) {
                alertify.alert(
                    "Correcto",
                    "¡Súper, se inserto correctamente!"
                );
                limpiarInput();
            } else {
                alertify.alert(
                    "Correcto",
                    "Error, ocurrio un problema!"
                );
            }
        },
        error: function (error) {
            console.error('Error al enviar la solicitud:', error);
        }
    });
}

function cargarItemMenu() {
    const url = rutaApiRest + "item-menu";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);
            iteMenu = response.data;
            cargarAcciones(iteMenu);
            table.bootstrapTable('load', iteMenu);

        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function cargarAcciones(data) {
    data.forEach(element => {
        element.imagen_td = `<img src="${ rutaLocal + element.imagen}" class="imagen">`;
        element.acciones = 
                `
                <a data-edit="${element.id_tipo_menu}" class="btn btn-warning btn-sm edit" title="Editar"><i class="bi bi-pencil"></i></a>
                <a data-delete="${element.id_tipo_menu}" class="btn btn-danger btn-sm delete" title="Borrar"><i class="fa fa-trash"></i></a>
                `;
    });
}

function cargarSelect(array, id = 0) {
    const select = $("#id_tipo_menu");
    select.empty();
    array.forEach(element => {
        let selected = "";
        if (id == element.id_tipo_menu) {
            selected = "selected";
        }
        select.append(
            `<option value="${element.id_tipo_menu}" ${selected}>${element.nombre}</option>`
          );
    });
}

function cargarTipoMenu() {
    const url = rutaApiRest + "tipo-menu";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            tipoMenu = response.data;
            cargarSelect(tipoMenu);
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function mostrarVistaPrevia() {
    const inputImagen = document.getElementById('imagen');
    const vistaPrevia = document.getElementById('vista-previa');

    const archivo = inputImagen.files[0];

    if (archivo) {
        const lector = new FileReader();

        lector.onload = function(e) {
            vistaPrevia.src = e.target.result;
            vistaPrevia.style.display = 'block';
        };

        lector.readAsDataURL(archivo);
    } else {
        vistaPrevia.style.display = 'none';
        vistaPrevia.src = '';  
    }
}

function limpiarInput() {
    $("#nombre").val("");
    $("#precio").val("");
    $("#descripcion").val("");
    $("#id_tipo_menu").val("0");
    $("#imagen").val("");
    $("#modal-nuevo-tipo-menu").modal('hide');
    mostrarVistaPrevia();
}