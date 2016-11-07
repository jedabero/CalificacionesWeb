<?php

use Calificaciones\Modelo\Mapeadores\Usuario as MapeadorUsuario;
use Calificaciones\Modelo\Dominio\Usuario as Usuario;

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends C_Controller {

    public function listar()
    {
        $mapeador = new MapeadorUsuario($this->adaptador);

        $users = $mapeador->todos();

        $this->salida_json(200, $users);
    }

	public function buscar($id)
	{
        $mapeador = new MapeadorUsuario($this->adaptador);

        $user = $mapeador->buscar($id);

		$this->salida_json(200, $user);
	}

    public function guardar($id = null)
    {
        $mapeador = new MapeadorUsuario($this->adaptador);

        $usuario = Usuario::crear($this->json_input());
        $usuario->setId($id);

        $mapeador->guardar($usuario);
	}

}
