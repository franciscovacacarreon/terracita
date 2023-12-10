const rutaApiRest = "http://66.29.135.157/api/v1/";
const rutaLocal = "http://66.29.135.157/";
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

function validarSelect(campo) {
    var selectedValues = campo.val();
    if (selectedValues == "" || selectedValues.length === 0) {
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
