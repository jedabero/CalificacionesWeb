<?php

use Calificaciones\Modelo\Mapeadores\Grupo as MapeadorGrupo;

defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos extends C_Controller {

    /**
     * @var MapeadorGrupo
     */
    protected $mapeador;

    public function __construct($cargarDb = true)
    {
        parent::__construct($cargarDb);
        $this->mapeador = new MapeadorGrupo($this->adaptador);
    }


    public function listar()
    {
        $this->load->library('session');
        $usuario_id = $this->session->usuario->getId();// TODO handle no session
        $grupos = $this->mapeador->todos($usuario_id);

        $this->salida_json(200, [ 'success' => true, 'grupos' => $grupos ]);
    }

	public function buscar($id)
	{
        $grupo = $this->mapeador->buscar($id);

		$this->salida_json(200, [ 'success' => true, 'grupo' => $grupo ]);
	}

    public function guardar($id = null)
    {
        $datos = $this->json_input();
        $grupo = $this->mapeador->mapea($datos['grupo']);
        $grupo->setId($id);

        $this->mapeador->guardar($grupo);

        $this->salida_json(200, [ 'success' => true, 'id' => $grupo->getId() ]);
	}

}
