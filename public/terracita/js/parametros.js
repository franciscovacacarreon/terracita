const rutaApiRest = "http://localhost/terracita/public/api/v1/";
const rutaLocal = "http://localhost/terracita/public/";

function validar(campo) {
    if (!campo.val()) {
        campo.addClass("validarIncorrecto");
        return false;
    } else {
        campo.removeClass("validarIncorrecto");
        return true;
    }
}