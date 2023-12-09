
let user = [];
let rol = [];
let userEliminados = [];
let table = $("#tabla-user");
let tableEliminados = $("#tabla-user-eliminados");
let empleados = [];
let repartidores = [];
let clientes = [];


$(document).ready(() => {
    cargarUser();
    cargarRol();
    cargarEmpleado();
    cargarRepartidor();
    cargarCliente();
});

$("#btn-nuevo-user").click(() => {
    $("#modal-nuevo-user").modal('show');
});

$("#guardar-user").click(() => {
    if (validar($("#name")) && 
        validar($("#email")) && 
        validar($("#password")) && 
        validar($("#password-repite")) &&
        verifyEmail() &&
        verifyPassword() &&
        validarSelect($("#id-rol"))  && 
        validarSelect($("#id-persona"))) 
        {
        saveUser();
    } else {
        if (!validarSelect($("#id-rol"))  ||  !validarSelect($("#id-persona"))) {
            const alerta = alertify.alert("Advertencia", "Debe seleccionar un rol y persona");
            setTimeout(function(){
                alerta.close();
            }, 2500);
        }
    }
});

$("#actualizar-user").click(() => {
    const id = $("#actualizar-user").attr('name');
    if (validar($("#name-edit")) && 
        validar($("#email-edit")) && 
        validar($("#password-edit")) && 
        validar($("#password-repite-edit")) &&
        verifyEmailEdit(id) &&
        verifyPasswordEdit() &&
        validarSelect($("#id-rol-edit"))  && 
        validarSelect($("#id-persona-edit"))) 
        {
        updateUser(id);
    }  
});

$(document).on("click", ".edit", function() {
    const id = $(this).attr("data-edit");

    const userEdit = user.find((element) => {
        return element.id == id;
    });
    
    $("#name-edit").val(userEdit.name);
    $("#email-edit").val(userEdit.email);
    $("#imagen-edit").attr('src', userEdit.profile_photo_path);
    $("#actualizar-user").attr("name", id);
    $("#modal-edit-user").modal('show');

    vistaPreviaEdit();
    cargarSelect(rol, userEdit.id_rol, $("#id-rol-edit"));
    seleccionarPersona(userEdit.id_rol, userEdit.id_persona, $("#id-persona-edit"));
});

$(document).on("click", ".delete", function() {
    const id = $(this).attr("data-delete");
    alertify.confirm("¿Está seguro de eliminar este registro?", "Se borrará el registro",
    function() {
        deleteUser(id);
    },
    function() {
        alertify.error('Cancelado');
    });
});


$(document).on("click", ".restore", function() {
    const id = $(this).attr("data-restore");
    alertify.confirm("Restaurar", "Se restaurará el registro",
    function() {
        restoreUser(id);
    },
    function() {
        alertify.error('Cancelado');
    });
});

$('#id-rol').on('select2:select', function (e) {
    const data = e.params.data;
    const idRol = parseInt(data.id);
    const idPersona = 0;
    seleccionarPersona(idRol, idPersona, $("#id-persona"));
});

$('#id-rol-edit').on('select2:select', function (e) {
    const data = e.params.data;
    const idRol = parseInt(data.id);
    const idPersona = 0;
    seleccionarPersona(idRol, idPersona, $("#id-persona-edit"));
});

$("#email").on('input', function () {
    verifyEmail();
});

function seleccionarPersona(idRol, idPersona, selectPersona) {
    switch (idRol) {
        case 1:
            cargarSelectPersona(empleados, idPersona, selectPersona);
            break;
        case 2:
            cargarSelectPersona(empleados, idPersona, selectPersona);
            break;
        case 3:
            cargarSelectPersona(repartidores, idPersona, selectPersona);
            break;
        case 4:
            cargarSelectPersona(clientes, idPersona, selectPersona);
            break;
        default:
            cargarSelectPersona(empleados, idPersona, selectPersona);
            break;
    }
}

function cargarUser() {
    const url = rutaApiRest + "user";
    showLoader();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);
            user = response.data;
            cargarTablaUser(user, false, table);
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
    cargarUserEliminados();
}

function cargarTablaUser(user, eliminados = false, table) {
    const userObject = [];
    user.forEach(element => {
        const object = {};
        object.id = element.id;
        object.name = element.name;
        object.email = element.email;
        object.rol = element.rol !== null ? element.rol.nombre : "";
        object.persona = element.persona !== null ? element.persona.nombre + " " + element.persona.paterno: "";
        object.imagen_td = `<img src="${ rutaLocal + element.profile_photo_path}" class="imagen">`;

        const accionRestarurar = `<a data-restore="${element.id}" class="btn btn-info btn-sm restore" title="Resturar"><i class="bi bi-arrow-bar-up"></i></a>`;
        const accionIndex = `<a data-edit="${element.id}" class="btn btn-warning btn-sm edit" title="Editar"><i class="bi bi-pencil"></i></a>
                             <a data-delete="${element.id}" class="btn btn-danger btn-sm delete" title="Borrar"><i class="fa fa-trash"></i></a>`;
        
        object.acciones = eliminados == true ? accionRestarurar : accionIndex;
                        
        userObject.push(object);
    });

    table.bootstrapTable('load', userObject);
}

function saveUser() {
    const formData = new FormData();
    const rolSelect = $("#id-rol").val();
    const personaSelect = $("#id-persona").val();
    const idRol = rolSelect[0];
    const idPersona = personaSelect[0];

    formData.append('name', $("#name").val());
    formData.append('email', $("#email").val());
    formData.append('password', $("#password").val());
    formData.append('id_rol', idRol);
    formData.append('id_persona', idPersona);

    const imagenInput = $("#imagen")[0];
    if (imagenInput.files.length > 0) {
        formData.append('profile_photo_path', imagenInput.files[0]);
    }

    const url = rutaApiRest + "user";
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: formData,
        contentType: false, 
        processData: false,
        success: function (response) {
            console.log(response);
            const status = response.status;
            if (status == 200) {
                const alerta = alertify.alert("Correcto", "¡Súper, se insertó correctamente!");
                setTimeout(function(){
                    alerta.close();
                }, 1000);

                cargarUser();
                limpiarInput();
            } else {
                alertify.alert(
                    "Error",
                    "¡Ocurrió un problema!"
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


function updateUser(id) {
    const formData = new FormData();
    const rolSelect = $("#id-rol-edit").val();
    const personaSelect = $("#id-persona-edit").val();
    const idRol = rolSelect[0];
    const idPersona = personaSelect[0];

    formData.append('name', $("#name-edit").val());
    formData.append('email', $("#email-edit").val());
    formData.append('password', $("#password-edit").val());
    formData.append('id_rol', idRol);
    formData.append('id_persona', idPersona);

    const imagenInput = $("#imagen-edit")[0];
    if (imagenInput.files.length > 0) {
        formData.append('profile_photo_path', imagenInput.files[0]);
    }

    const url = rutaApiRest + "user/" + id;
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            const status = response.status;
            if (status == 200) {
                const alerta = alertify.alert("Correcto", "¡Súper, se actualizó correctamente!");
                setTimeout(function(){
                    alerta.close();
                }, 1000);

                cargarUser();
                limpiarInput();
            } else {
                alertify.alert(
                    "Error",
                    "¡Ocurrió un problema!"
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


function deleteUser(id) {
    const url = rutaApiRest + "user/" + id;
    $.ajax({
        url: url,
        type: "DELETE",
        dataType: "json",
        success: function (response) {
            console.log(response);
            const status = response.status;
            if (status == 200) {
                const alerta = alertify.alert(
                    "Correcto",
                    "¡Súper, se eliminó correctamente!"
                );
                setTimeout(function(){
                    alerta.close();
                }, 1000);

                cargarUser();
            } else {
                alertify.alert(
                    "Error",
                    "¡Ocurrio un problema!"
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

function cargarUserEliminados() {
    const url = rutaApiRest + "user-eliminados";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            userEliminados = response.data;
            console.log(response);
            cargarTablaUser(userEliminados, true, tableEliminados)

        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }
    });
}

function restoreUser(id) {
    const url = rutaApiRest + "user-restaurar/" + id;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);
            const status = response.status;
            if (status == 200) {
                const alerta = alertify.alert(
                    "Correcto",
                    "¡Súper, se restauró correctamente!"
                );
                setTimeout(function(){
                    alerta.close();
                }, 1000);

                cargarUser();
                cargarUserEliminados();
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

function limpiarInput() {
    $("#name").val("");
    $("#email").val("");
    $("#password").val("");
    $("#password-repite").val("");
    $("#id-rol").val("");
    $("#id-persona").val("");
    $("#modal-nuevo-user").modal('hide');

    $("#name-edit").val("");
    $("#email-edit").val("");
    $("#password-edit").val("");
    $("#password-repite-edit").val("");
    $("#id-rol-edit").val("");
    $("#id-persona-edit").val("");
    $("#modal-edit-user").modal('hide');
}

function cargarRol() {
    const url = rutaApiRest + "rol";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            rol = response.data;
            const idRol = 0;
            const selectGuardar = $("#id-rol");
            const selectEditar = $("#id-rol-edit");
            cargarSelect(rol, idRol, selectGuardar);
            cargarSelect(rol, idRol, selectEditar);
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function cargarEmpleado() {
    const url = rutaApiRest + "empleado";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            empleados = response.data;
            const idPersona = 0;
            const selectGuardar = $("#id-persona");
            const selectEditar = $("#id-persona-edit");
            cargarSelectPersona(empleados, idPersona, selectGuardar);
            cargarSelectPersona(empleados, idPersona, selectEditar);
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function cargarRepartidor() {
    const url = rutaApiRest + "repartidor";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            repartidores = response.data;
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
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }

    });
}

function cargarSelect(array, id = 0, select) {
    select.empty();
    array.forEach(element => {
        let selected = "";
        if (id == element.id_rol) {
            selected = "selected";
        }
        select.append(
            `<option value="${element.id_rol}" ${selected}>${element.nombre}</option>`
          );
    });
    select.select2({
        width: '100%', 
        theme: "classic",
        maximumSelectionLength: 1
    });
}

function cargarSelectPersona(array, id = 0, select) {
    select.empty();
    array.forEach(empleado => {
        const element = empleado.persona;
        let selected = "";
        if (id == element.id_persona) {
            selected = "selected";
        }
        select.append(
            `<option value="${element.id_persona}" ${selected}>${element.nombre + " " + element.paterno}</option>`
          );
    });
    select.select2({
        width: '100%', 
        theme: "classic",
        maximumSelectionLength: 1
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

function mostrarVistaPreviaEdit() {
    const inputImagen = document.getElementById('imagen-edit');
    const vistaPrevia = document.getElementById('vista-previa-edit');

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

function vistaPreviaEdit() {
    try {
        const inputImagen = document.getElementById('imagen-edit');
        const vistaPrevia = document.getElementById('vista-previa-edit');

        vistaPrevia.src = inputImagen.src;
        vistaPrevia.style.display = 'block';
    } catch (error) {
        
    }
}

//Mejorar, para que no haya mucho codigo repetido

function verifyEmail() {
    const mailTemp = $("#email").val();
    const userMail = user.find(element => element.email == mailTemp);
    let result = true;
    if (userMail != undefined) {
        setTimeout(() => {
            $("#email-advertencia").removeClass("d-none");
            $("#email-advertencia").text("Correo no disponible");
            result = false;
        }, 1000);
    } else {
        $("#email-advertencia").addClass("d-none");
    }
    return result;
}

function verifyPassword() {
    const password = document.getElementById('password').value;
    const repeatPassword = document.getElementById('password-repite').value;
    const advertencias = document.querySelectorAll('.password-advertencia');
    let result = true;

    if (password.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return;
    }

    if (password !== repeatPassword) {
        advertencias[0].classList.remove('d-none');
        advertencias[1].classList.remove('d-none');
        result = false;
    } else {
        advertencias[0].classList.add('d-none');
        advertencias[1].classList.add('d-none');
    }
    return result;
}


function verifyEmailEdit(id) {
    const mailTemp = $("#email-edit").val();
    const userMail = user.find(element => element.email == mailTemp);
    let result = true;
    if (userMail != undefined) {
        if (!(userMail.email == mailTemp  &&  userMail.id == id)) {
            setTimeout(() => {
                $("#email-advertencia-edit").removeClass("d-none");
                $("#email-advertencia-edit").text("Correo no disponible");
                result = false;
            }, 1000);
        } else {
            $("#email-advertencia-edit").addClass("d-none");
        }
    } else {
        $("#email-advertencia-edit").addClass("d-none");
    }
    return result;
}

function verifyPasswordEdit() {
    const password = document.getElementById('password-edit').value;
    const repeatPassword = document.getElementById('password-repite-edit').value;
    const advertencias = document.querySelectorAll('.password-advertencia-edit');
    let result = true;

    if (password.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return;
    }

    if (password !== repeatPassword) {
        advertencias[0].classList.remove('d-none');
        advertencias[1].classList.remove('d-none');
        result = false;
    } else {
        advertencias[0].classList.add('d-none');
        advertencias[1].classList.add('d-none');
    }
    return result;
}


// Mostrar contraseña
document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });

    const togglePasswordRepite = document.getElementById('toggle-password-repite');
    const passwordRepiteInput = document.getElementById('password-repite');

    togglePasswordRepite.addEventListener('click', function () {
        const type = passwordRepiteInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordRepiteInput.setAttribute('type', type);
    });
});

