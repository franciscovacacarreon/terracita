let iteMenu = [];
let tipoMenu = [];
let table = $("#tabla-tipo-menu");

$(document).ready( () => {
    cargarItemMenu();
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
        success: function (data) {
            console.log(data); 
        },
        error: function (error) {
            console.error('Error al enviar la solicitud:', error);
        }
    });
}

function cargarItemMenu() {
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

function cargarSelect(array, id = 0) {
    const select = $("#id_tipo_menu");
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


function saveItemTipoMenu() {
    const data = {};
    data.nombre = $("#nombre").val();
    const url = rutaApiRest + "tipo-menu";
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: data,
        success: function (response) {
            console.log(response);
            const status = response.status;
            if (status == 200) {
                alertify.alert(
                    "Correcto",
                    "¡Súper, se inserto correctamente!"
                );
                $("#nombre").val("");
                $("#modal-nuevo-tipo-menu").modal('hide');
                cargarItemMenu();
            } else {
                alertify.alert(
                    "Correcto",
                    "Error, ocurrio un problema!"
                );
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
    }
}