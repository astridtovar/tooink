<?php

define('RUTA_PRINCIPAL', __DIR__);
define('PROYECTO', '/tooink/');
define('PROYECTO_RECURSOS_CSS',  PROYECTO. 'vista/css/');
define('PROYECTO_RECURSOS_JS', PROYECTO. 'vista/js/');
define('PROYECTO_RECURSOS_IMGS', PROYECTO. 'vista/imgs/');
define('PROYECTO_RECURSOS_IMGS_USERS', PROYECTO. 'vista/imgs/imgs-users/');
define('PROYECTO_RECURSOS_PLUGINS', PROYECTO. 'vista/plugins/');
define('URL_PRINCIPAL', PROYECTO . 'index.php');
define('URL_INICIAR_SESION', RUTA_PRINCIPAL . './vista/iniciarsesion.php');

define('INICIAR_SESION', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'iniciarSesion',
    'url' => URL_PRINCIPAL . '/usuario/iniciarsesion'));

define('DESVIO', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'desvio',
    'url' => URL_PRINCIPAL . '/gracias'));

define('CAMBIAR_CLAVE_MODAL', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'cambiarClaveModal',
    'url' => URL_PRINCIPAL . '/usuario/cambiarclave'));

define('CAMBIAR_CLAVE_TATUADOR', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'cambiarClaveTatuador',
    'url' => URL_PRINCIPAL . '/usuario/tatuador/cambiarclave'));

define('CAMBIAR_CLAVE_CLIENTE', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'cambiarClaveCliente',
    'url' => URL_PRINCIPAL . '/usuario/cliente/cambiarclave'));

define('CAMBIAR_CLAVE', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'cambiarClave',
    'url' => URL_PRINCIPAL . '/usuario/guardarclave'));

define('REESTABLECER_CLAVE_INDEX', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'reestablecerClaveIndex',
    'url' => URL_PRINCIPAL . '/usuario/reestablecerclave'));

define('REESTABLECER_CLAVE', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'reestablecerClave',
    'url' => URL_PRINCIPAL . '/usuario/reestablecerclave/enviar'));

define('URL_PRINCIPAL_DIRECTORIO', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'directorioTatuadores',
    'url' => URL_PRINCIPAL));

define('DIRECTORIO_TATUADORES', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'directorioTatuadores',
    'url' => URL_PRINCIPAL . '/directoriotatuadores'));

define('PERFIL_TATUADOR', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'perfilTatuador',
    'url' => URL_PRINCIPAL . '/directoriotatuadores/perfil'));

define('USUARIO_AUTENTICAR', array(
    'clase' => 'UsuarioControl', 
    'metodo' => 'autenticar',
    'url' => URL_PRINCIPAL . '/usuario/autenticar'));

define('ADMINISTRADOR_PRINCIPAL', array(
    'clase' => 'AdminControl', 
    'metodo' => 'index',
    'url' => URL_PRINCIPAL . '/administrador'));

define('ADMINISTRADOR_REGISTRO', array(
    'clase' => 'AdminControl', 
    'metodo' => 'registrarUsuario',
    'url' => URL_PRINCIPAL . '/administrador/registro'));

define('ADMINISTRADOR_GUARDAR_USUARIO', array(
    'clase' => 'AdminControl', 
    'metodo' => 'guardarUsuario',
    'url' => URL_PRINCIPAL . '/administrador/registro/guardado'));

define('ADMINISTRADOR_CONSULTA', array(
    'clase' => 'AdminControl', 
    'metodo' => 'ConsultarUsuarios',
    'url' => URL_PRINCIPAL . '/administrador/consulta'));

define('ADMINISTRADOR_ACTIVAR', array(
    'clase' => 'AdminControl', 
    'metodo' => 'activarUsuario',
    'url' => URL_PRINCIPAL . '/administrador/consulta/activar'));

define('ADMINISTRADOR_INFORMACION', array(
    'clase' => 'AdminControl', 
    'metodo' => 'indexInformacion',
    'url' => URL_PRINCIPAL . '/administrador/informacion'));

define('ADMIN_INFORMACION_GUARDAR', array(
    'clase' => 'AdminControl', 
    'metodo' => 'guardarInformacion',
    'url' => URL_PRINCIPAL . '/administrador/informacion/guardar'));

define('ADMIN_CAMBIAR_F_PERFIL', array(
    'clase' => 'AdminControl', 
    'metodo' => 'guardarFotoPerfil',
    'url' => URL_PRINCIPAL . '/administrador/informacion/fotoperfil/guardar'));

define('TATUADOR_PRINCIPAL', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'index',
    'url' => URL_PRINCIPAL . '/tatuador/informacion'));

define('TATUADOR_INFO_GUARDAR', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'guardarInformacion',
    'url' => URL_PRINCIPAL . '/tatuador/informacion/guardar'));

define('TATUADOR_INFO_CAMBIAR_FOTOP', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'cambiarFotoPerfil',
    'url' => URL_PRINCIPAL . '/tatuador/informacion/cambiarFotoPerfil'));

define('TATUADOR_INFO_GUARDAR_FOTOP', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'guardarFotoPerfil',
    'url' => URL_PRINCIPAL . '/tatuador/informacion/guardarFotoPerfil'));

define('TATUADOR_INFO_ELIMINAR_CONTACTO', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'eliminarContacto',
    'url' => URL_PRINCIPAL . '/tatuador/informacion/eliminar/contacto'));

define('TATUADOR_INFO_ELIMINAR_ESTILO', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'eliminarEstilo',
    'url' => URL_PRINCIPAL . '/tatuador/informacion/eliminar/estilo'));

define('TATUADOR_PORTAFOLIO', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'portafolio',
    'url' => URL_PRINCIPAL . '/tatuador/portafolio'));

define('TATUADOR_PORTAFOLIO_AGREGAR', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'agregarTrabajo',
    'url' => URL_PRINCIPAL . '/tatuador/portafolio/agregartrabajo'));

define('TATUADOR_PORTAFOLIO_GUARDAR', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'guardarTrabajo',
    'url' => URL_PRINCIPAL . '/tatuador/portafolio/agregartrabajo/guardar'));

define('TATUADOR_PORTAFOLIO_ELIMINAR', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'eliminarTrabajo',
    'url' => URL_PRINCIPAL . '/tatuador/portafolio/agregartrabajo/eliminar'));

define('TATUADOR_AGENDA', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'agenda',
    'url' => URL_PRINCIPAL . '/tatuador/agenda'));

define('TATUADOR_AGENDA_ESPACIOS', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'consultarEspacios',
    'url' => URL_PRINCIPAL . '/tatuador/agenda/espacios'));

define('TATUADOR_AGENDA_CREAR_DISP', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'generarRegistrosAgenda',
    'url' => URL_PRINCIPAL . '/tatuador/agenda/crear'));

define('TATUADOR_AGENDA_BUSCAR_C', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'buscarCliente',
    'url' => URL_PRINCIPAL . '/tatuador/agenda/cliente'));

define('TATUADOR_CITA_AGENDAR', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'agendarCita',
    'url' => URL_PRINCIPAL . '/tatuador/agenda/guardarcita'));

define('TATUADOR_CITA_CONSULTAR', array(
    'clase' => 'CitaControl', 
    'metodo' => 'consultarEventos',
    'url' => URL_PRINCIPAL . '/tatuador/agenda/citas'));
//
//define('TATUADOR_CITA_MODIFICAR', array(
//    'clase' => 'TatuadorControl', 
//    'metodo' => 'modificarCita',
//    'url' => URL_PRINCIPAL . '/tatuador/agenda/cita/modificar'));

define('TATUADOR_CITA_CANCELAR_CONFIR', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'confiCancelarEvento',
    'url' => URL_PRINCIPAL . '/tatuador/agenda/cita/confirmar'));

define('TATUADOR_CITA_CANCELAR', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'eliminarCita',
    'url' => URL_PRINCIPAL . '/tatuador/agenda/cita/cancelar'));

define('TATUADOR_RESERVAS', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'consultarReservas',
    'url' => URL_PRINCIPAL . '/tatuador/reservas'));

define('TATUADOR_ACEPTAR_RESERVA', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'aceptarReserva',
    'url' => URL_PRINCIPAL . '/tatuador/reservas/aceptar'));

define('TATUADOR_DENEGAR_RESERVA', array(
    'clase' => 'TatuadorControl', 
    'metodo' => 'denegarReserva',
    'url' => URL_PRINCIPAL . '/tatuador/reservas/denegar'));

define('CLIENTE_PRINCIPAL', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'index',
    'url' => URL_PRINCIPAL . '/cliente/directorio'));

define('CLIENTE_REGISTRO', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'registroCliente',
    'url' => URL_PRINCIPAL . '/cliente/registro'));

define('CLIENTE_REGISTRO_GUARDAR', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'guardarRegistro',
    'url' => URL_PRINCIPAL . '/cliente/guardado'));

define('CLIENTE_PERFIL_TATUADOR', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'perfilTatuador',
    'url' => URL_PRINCIPAL . '/cliente/directorio/perfil'));

define('CLIENTE_CONSULTAR_CITAS', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'consultarMisCitas',
    'url' => URL_PRINCIPAL . '/cliente/citas'));

define('CLIENTE_RESERVAR_CITA_INDEX', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'indexReservarCita',
    'url' => URL_PRINCIPAL . '/cliente/reservar'));

define('CLIENTE_RESERVAR_CITA', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'reservarCita',
    'url' => URL_PRINCIPAL . '/cliente/reservar/guardar'));

define('CLIENTE_VOTAR_IMG', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'votarImagen',
    'url' => URL_PRINCIPAL . '/cliente/votar'));

define('CLIENTE_INFORMACION', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'indexInformacion',
    'url' => URL_PRINCIPAL . '/cliente/informacion'));

define('CLIENTE_INFORMACION_GUARDAR', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'guardarInformacion',
    'url' => URL_PRINCIPAL . '/cliente/informacion/guardar'));

define('CLIENTE_CAMBIAR_F_PERFIL', array(
    'clase' => 'ClienteControl', 
    'metodo' => 'guardarFotoPerfil',
    'url' => URL_PRINCIPAL . '/cliente/informacion/fotoperfil/guardar'));

define('CERRAR_SESION', array(
    'clase' => 'UsuarioControl',
    'metodo' => 'cerrarSesion',
    'url' => URL_PRINCIPAL . '/menu/cerrarSesion'));