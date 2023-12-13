// const rutaApiRest = "http://terracita.store/api/v1/";
// const rutaLocal = "http://terracita.store/";

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
