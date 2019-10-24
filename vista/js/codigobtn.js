var btnAgregarContacto;
var btnAgregarEstilo;
var btnAgregarExpe;
var btnEliminarContacto;
var btnEliminar;
var btnEliminarExpe;

window.onload = function () {
    btnAgregarContacto = document.getElementById('agregar_contacto');
    btnAgregarEstilo = document.getElementById('agregar_estilo');
    btnAgregarExpe = document.getElementById('agregar_experiencia');
    btnAgregarContacto.onclick = agregarContacto;
    btnAgregarEstilo.onclick = agregarEstilo;
    btnAgregarExpe.onclick = agregarExpe;
}

function agregarContacto(argument) {
    var contenedorContactos = document.getElementById('contactos');
    var hidden = document.createElement("input");
    hidden.setAttribute("type", "hidden");
    hidden.setAttribute("name", "con_id_contacto[]");
    hidden.setAttribute("value", "");
    contactos.appendChild(hidden);

    var inputs = document.createElement("input");
    inputs.setAttribute("id", "contacto");
    inputs.setAttribute("type", "text");
    inputs.setAttribute("name", "con_descripcion_contacto[]");
    inputs.classList.add('form-control');
    inputs.setAttribute("value", "");
    contactos.appendChild(inputs);

    btnEliminarContacto = document.createElement("input");
    //btnEliminarContacto.setAttribute("src", "<?= PROYECTO_RECURSOS_IMGS ?>/iconos/rounded-delete-button-with-minus.png");
    btnEliminarContacto.setAttribute("id", "btnBuscar");
    btnEliminarContacto.setAttribute("type", "button");
    btnEliminarContacto.setAttribute("class", "button btn-danger");
    btnEliminarContacto.setAttribute("value", "Eliminar");
    contactos.appendChild(btnEliminarContacto);
    btnEliminarContacto.onclick = eliminarContacto;
}

function agregarEstilo(e) {
    var click = e.target;
    if (click = document.getElementById('estiloslistaoculto')) {
        click.classList.add('selectEstilos');

        btnEliminar = document.createElement("input");
        btnEliminar.setAttribute("id", "btnBuscar");
        btnEliminar.setAttribute("type", "button");
        btnEliminar.setAttribute("class", "button");
        btnEliminar.setAttribute("value", "x");
        btnEliminar.classList.add('btn-primary');
        estilos.appendChild(btnEliminar);
        btnEliminar.onclick = eliminarEstilo;
    }
}

//function agregarEstilo(argument) {
//    var contenedorEstilos = document.getElementById('listaE');
////    var lista = document.createElement("select");
////    lista.setAttribute("id", "listaEstilos");
////    estilosAgregar.appendChild(lista);
//    
//    var opcion = document.createElement("option");
//    opcion.setAttribute("id", "estilo");
//    opcion.setAttribute("name", "est_descripcion[]");
//    opcion.setAttribute("value", "");
//    opcion.textContent = "<?php echo $consulta->descripcion; ?>";
//    
//    listaE.appendChild(opcion);
//
//    btnEliminar = document.createElement("input");
//    btnEliminar.setAttribute("id", "btnBuscar");
//    btnEliminar.setAttribute("type", "button");
//    btnEliminar.setAttribute("class", "button");
//    btnEliminar.setAttribute("value", "x");
//    btnEliminar.classList.add('btn-primary');
//    estilos.appendChild(btnEliminar);
//    btnEliminar.onclick = eliminarEstilo;
//}

function agregarExpe(argument) {
    var contenedorExpe = document.getElementById('experiencias');
    var inputs = document.createElement("input");
    inputs.setAttribute("id", "experiencia");
    inputs.setAttribute("type", "text");
    inputs.setAttribute("name", "est_experiencia");
    inputs.classList.add('form-control');
    experiencias.appendChild(inputs);

    btnEliminarExpe = document.createElement("input");
    btnEliminarExpe.setAttribute("id", "btnBuscar");
    btnEliminarExpe.setAttribute("type", "button");
    btnEliminarExpe.setAttribute("class", "button");
    btnEliminarExpe.setAttribute("value", "x");
    btnEliminarExpe.classList.add('btn-primary');
    experiencias.appendChild(btnEliminarExpe);
    btnEliminarExpe.onclick = eliminarExpe;
}

function eliminarContacto() {
    var contenedorContactos = document.getElementById('contactos');
    var contacto = document.getElementById("contacto");
    var button = document.getElementById("btnBuscar");
    contacto.remove();
    button.remove();
}

function eliminarEstilo(e) {
    var click = e.target;
    var button = document.getElementById("btnBuscar");
    if (click = document.getElementById('estiloslista')) {
        click.classList.remove('selectEstilos');
        click.classList.add('selectEstilosOculto');
        button.remove();
    }
}

function eliminarExpe() {
    var contenedorExpe = document.getElementById('experiencias');
    var experiencia = document.getElementById("experiencia");
    var button = document.getElementById("btnBuscar");
    experiencia.remove();
    button.remove();
}
