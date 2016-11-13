<?php

use Calificaciones\Modelo\Mapeadores\Usuario as MapeadorUsuario;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 9/11/16
 * Time: 12:34 PM
 */
class Autenticacion extends C_Controller
{
    
    public function login()
    {
        $respuesta = [ 'success' => true ];
        $datos = $this->json_input();
        $mapeador = new MapeadorUsuario($this->adaptador);
        $usuario = null;
        try {
            $usuario = $mapeador->buscarUsuario($datos['usuario'], $datos['contrasena']);
            $this->load->library('session');
            $this->session->set_userdata([
                'logged_in' => true,
                'usuario' => $usuario
            ]);
            $respuesta['mensaje'] = "Autenticado correctamente";
            $respuesta['conectado'] = true;
            $respuesta['session_id'] = session_id();
            $usuario->unsetContrasena();
            $respuesta['usuario'] = $usuario;
        } catch(\InvalidArgumentException $iae) {
            $respuesta['success'] = false;
            $respuesta['mensaje'] = "Ingrese credenciales correctas";
            $respuesta['conectado'] = false;
        }
        $this->salida_json(200, $respuesta);
        session_write_close();
    }

    public function logout()
    {
        $this->salida_json(200, [ 'success' => session_destroy() ]);
    }
    
}