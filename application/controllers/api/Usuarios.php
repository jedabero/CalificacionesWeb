<?php

use Calificaciones\Modelo\DbAdaptador;
use Calificaciones\Modelo\Mapeadores\MapeadorUsuario;

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function get($id)
	{
		$this->load->database();
        $adaptador = new DbAdaptador($this->db);
        $mapeador = new MapeadorUsuario($adaptador);

        $user = $mapeador->buscar($id);
		echo json_encode($user);
	}

}
