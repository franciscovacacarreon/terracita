let cliente = {};

$(document).ready(function (params) {
});

$("#btn-registrar").click(() => {
    if (validar($("#nombre")) && 
        validar($("#paterno")) && 
        validar($("#telefono")) && 
        validar($("#correo"))) {
        saveCliente();
    } 
});

function saveCliente() {
    const data = {};
    data.nombre = $("#nombre").val();
    data.paterno = $("#paterno").val();
    // data.materno = $("#materno").val();
    data.telefono = $("#telefono").val();
    data.correo = $("#correo").val();
    data.descuento = 0;
    data.compras_realizadas = 0; //Default
    const url = rutaApiRest + "cliente";
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: data,
        success: function (response) {
            console.log(response);
            const status = response.status;
            if (status == 200) {
                const alerta = alertify.alert("Correcto", "¡Súper, te registraste correctamente!");
                setTimeout(function(){
                    alerta.close();
                }, 1000);

                
                cliente = data;
                cliente.persona = response.data; //response.data = persona
                cliente.id_cliente = cliente.persona.id_persona

                saveUser(cliente.persona.id_persona);
                
                console.log(cliente);
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


function saveUser(idCliente) {
    const formData = new FormData();

    formData.append('name', $("#usuario").val());
    formData.append('email', $("#correo").val());
    formData.append('password', $("#password").val());
    formData.append('id_rol', 4);
    formData.append('id_persona', idCliente);

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
            cliente.user = response.data; //response.data contiene el objeto user creado

            localStorage.setItem('clientemall', JSON.stringify(cliente));
            window.location.href = "cliente-web";
        },
        error: function (data, textStatus, jqXHR, error) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
            console.log(error);
        }
    });
}


// function initMap() {
//     var myLatLng = { lat: -34.397, lng: 150.644 };
//     var mapOptions = {
//       center: myLatLng,
//       zoom: 8
//     };
//     var map = new google.maps.Map(document.getElementById('map'), mapOptions);
//     var marker = new google.maps.Marker({
//       position: myLatLng,
//       map: map,
//       title: 'Mi marcador'
//     });
//   }
