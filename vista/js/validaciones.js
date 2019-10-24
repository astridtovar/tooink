var btnRegistrar;
var rol;
var nombre;
var apellido;
var tipoDoc;
var numeroDoc;
var fechaNac;
var fechaExp;
var contacto;
var correo;
var clave;
var fechaNac1;

window.onload = function () {
    btnRegistrar = document.getElementById('btnRegistrar');
    btnRegistrar.onclick = validacion;
}

function validacion() {

    rol = document.forms['form']['usu_id_rol'].selectedIndex;
    tipoDoc = document.forms['form']['usu_id_tipo_doc'].selectedIndex;
    numeroDoc = document.getElementById('usu_numero_doc').value;
    fechaExp = document.getElementById('datepicker-autoclose').value;
    fechaNac = document.getElementById('datepicker-autoclose_2').value;
    contacto = document.getElementById('con_descripcion_contacto').value;
    nombre = document.getElementById('usu_nombre').value;
    apellido = document.getElementById('usu_apellido').value;
    correo = document.getElementById('usu_correo').value;
    correo2 = document.getElementById('usu_confirmar_correo').value;
    clave = document.getElementById('usu_clave').value;
    clave2 = document.getElementById('usu_confirmar_clave').value;

    if (rol == null || rol == 0) {
        alert('Por favor seleccione un rol.');
        return false;
    }
    if (tipoDoc == null || tipoDoc == 0) {
        alert('Por favor seleccione un tipo de documento.');
        return false;
    }

    if (!(/^(?=.*\d)[0-9\A-Z]{8,10}$/.test(numeroDoc)) || numeroDoc == 0) {
        alert('Por favor ingrese un numero de documento valido.');
        return false;
    }

    if (fechaExp != '') {
        var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
        if ((fechaExp.match(RegExPattern))) {

            var today = new Date();
            today.setHours(0, 0, 0, 0);
            var expedicion = new Date(fechaExp);

            if (expedicion >= today) {
                alert("La fecha de expedición del documento no puede ser mayor o igual al día de hoy.");
                return false;
            }
        } else {
            alert("Formato de fecha de expedición del documento no valido.");
            return false;
        }
    } else {
        alert("Por favor ingrese una fecha de expedición del documento.");
        return false;
    }

    if (fechaNac != '') {
        var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
        if ((fechaNac.match(RegExPattern))) {

            var today = new Date();
            var nacimiento = new Date(fechaNac);
            var rest = nacimiento.getFullYear() - today.getFullYear();
            if (rest > -18) {
                if (nacimiento.getMonth() >= today.getMonth()) {
                    if (nacimiento.getDay() >= today.getDay()) {
                        alert("Eres menor de edad, no puedes registrarte en nuestro sistema.");
                        return false;
                    } else {
                        alert("Eres menor de edad, no puedes registrarte en nuestro sistema.");
                        return false;
                    }
                } else {
                    alert("Eres menor de edad, no puedes registrarte en nuestro sistema.");
                    return false;
                }
            }
        } else {
            alert("Formato de fecha de nacimiento no valido.");
            return false;
        }
    } else {
        alert("Por favor ingrese una fecha de nacimiento.");
        return false;
    }

    if (contacto.length === 0 || (/^\s+$/.test(contacto))) {
        alert('Por favor ingrese un contacto valido.');
        return false;
    }

    if (nombre.length === 0 || nombre.length >= 20 || /^\s+$/.test(nombre)) {
        alert('Por favor ingrese un nombre valido.');
        return false;
    }

    if (apellido.length === 0 || apellido.length >= 20 || /^\s+$/.test(apellido)) {
        alert('Por favor ingrese un apellido valido.');
        return false;
    }

    if (!(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo))) {
        alert('Por favor ingrese un correo electronico valido.');
        return false;
    }

    if (correo2 == null || correo2 == '') {
        alert("Por favor confirme el correo electronico.");
    } else {
        if (correo !== correo2) {
            alert("Los correos no coinciden.");
            return false;
        }
    }

    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,15}$/.test(clave))) {
        alert('La contraseña debe tener entre 8 y 15 caracteres entre al menos 1 letra mayuscula, minuscula, digito y caracteres especial.');
        return false;
    }

    if (clave2 == null || clave2 == '') {
        alert("Por favor confirme la contraseña.");
    } else {
        if (clave !== clave2) {
            alert("Las contraseñas no coinciden.");
            return false;
        }
    }

    return true;
}