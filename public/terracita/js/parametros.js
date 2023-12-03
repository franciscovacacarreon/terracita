const rutaApiRest = "http://localhost/terracita/public/api/v1/";
const rutaLocal = "http://localhost/terracita/public/";
let spinner;

function validar(campo) {
    if (!campo.val()) {
        campo.addClass("validarIncorrecto");
        return false;
    } else {
        campo.removeClass("validarIncorrecto");
        return true;
    }
}

function showLoader() {
    const target = document.getElementById('loader-container');
    spinner = new Spinner().spin(target);
}

function hideLoader() {
    if (spinner) {
        spinner.stop();
    }
}
