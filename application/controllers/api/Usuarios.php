<?php

use Calificaciones\Modelo\DbAdaptador;
use Calificaciones\Modelo\Mapeadores\Usuario as MapeadorUsuario;
use Calificaciones\Modelo\Dominio\Usuario as Usuario;

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function listar()
    {
        $this->load->database();
        $adaptador = new DbAdaptador($this->db);
        $mapeador = new MapeadorUsuario($adaptador);

        $users = $mapeador->todos();
        $this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

	public function buscar($id)
	{
		$this->load->database();
        $adaptador = new DbAdaptador($this->db);
        $mapeador = new MapeadorUsuario($adaptador);

        $user = $mapeador->buscar($id);
		$this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($user, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
	}

    public function guardar($id = null)
    {
        $this->load->database();
        $adaptador = new DbAdaptador($this->db);
        $mapeador = new MapeadorUsuario($adaptador);

        $usuario = Usuario::crear($this->input->post());
        $usuario->setId($id);

        $mapeador->guardar($usuario);
	}

}
