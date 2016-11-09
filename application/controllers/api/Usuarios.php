<?php

use Calificaciones\Modelo\Mapeadores\Usuario as MapeadorUsuario;

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends C_Controller {

    public function listar()
    {
        $mapeador = new MapeadorUsuario($this->adaptador);

        $users = $mapeador->todos();

        $this->salida_json(200, [ 'success' => true, 'usuarios' => $users ]);
    }

	public function buscar($id)
	{
        $mapeador = new MapeadorUsuario($this->adaptador);

        $user = $mapeador->buscar($id);

		$this->salida_json(200, [ 'success' => true, 'usuario' => $user ]);
	}

    public function guardar($id = null)
    {
        $mapeador = new MapeadorUsuario($this->adaptador);

        $usuario = $mapeador->mapea($this->json_input());
        $usuario->setId($id);

        $mapeador->guardar($usuario);

        $this->salida_json(200, [ 'success' => true, 'id' => $usuario->getId() ]);
	}

}
