<?php

use Calificaciones\Modelo\Mapeadores\Grupo as MapeadorGrupo;

defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos extends C_Controller {

    /**
     * @var \Calificaciones\Modelo\Mapeadores\Grupo
     */
    protected $mapeador;

    /**
     * @var \Calificaciones\Modelo\Dominio\Usuario
     */
    protected $usuario;

    public function __construct($cargarDb = true)
    {
        parent::__construct($cargarDb);
        $this->mapeador = new MapeadorGrupo($this->adaptador);
        $this->load->library('session');
        $this->usuario = $this->session->usuario;// TODO handle no session
    }


    public function listar()
    {
        $grupos = $this->mapeador->todos($this->usuario->getId());

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
        $grupo->setUsuario($this->usuario);
        $grupo->setId($id);

        $this->mapeador->guardar($grupo);

        $this->salida_json(200, [ 'success' => true, 'id' => $grupo->getId() ]);
	}

}
