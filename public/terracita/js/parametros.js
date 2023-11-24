const rutaApiRest = "http://localhost/terracita/public/api/v1/";

function validar(campo) {
    if (!campo.val()) {
        campo.addClass("validarIncorrecto");
        return false;
    } else {
        campo.removeClass("validarIncorrecto");
        return true;
    }
}