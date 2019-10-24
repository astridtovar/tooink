var clave;
var clave_conf;

window.onload = function () {
    btnRegistrar = document.getElementById('btnCambiarClave');
    btnRegistrar.onclick = validacion;
}

function validacion() {

    clave = document.getElementById('clave_nueva').value;
    clave_conf = document.getElementById('clave_conf').value;

    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,15}$/.test(clave))) {
        alert('La contraseña debe tener entre 8 y 15 caracteres entre al menos 1 letra mayuscula, minuscula, digito y caracteres especial.');
        return false;
    }else{
        if (clave !== clave_conf) {
            alert("La contraseña nueva y la confirmación de la misma no coinciden.");
            return false;
        }
    }
    return true;
}