<?php

use Calificaciones\Modelo\Mapeadores\Periodo as MapeadorPeriodo;

defined('BASEPATH') OR exit('No direct script access allowed');

class Periodos extends C_Controller {

    /**
     * @var \Calificaciones\Modelo\Mapeadores\Periodo
     */
    protected $mapeador;


    public function __construct($cargarDb = true)
    {
        parent::__construct($cargarDb);
        $this->mapeador = new MapeadorPeriodo($this->adaptador);
    }


    public function listar()
    {
        $datos = $this->json_input();
        $grupo_id = array_key_exists('grupo_id', $datos) ? $datos['grupo_id'] : null;

        $periodos = $this->mapeador->todos($grupo_id);

        $this->salida_json(200, [ 'success' => true, 'periodos' => $periodos ]);
    }

    public function buscar($id)
    {
        $periodo = $this->mapeador->buscar($id);

        $this->salida_json(200, [ 'success' => true, 'periodo' => $periodo ]);
    }

    public function guardar($id = null)
    {
        $datos = $this->json_input();
        $grupo_id = array_key_exists('grupo_id', $datos) ? $datos['grupo_id'] : null;
        $periodo = $this->mapeador->mapea($datos['periodo']);
        if (is_null($periodo->getGrupoId())) {
            $periodo->setGrupoId($grupo_id);
        }
        $periodo->setId($id);

        $this->mapeador->guardar($periodo);

        $this->salida_json(200, [ 'success' => true, 'id' => $periodo->getId(), 'periodo'=> $periodo ]);
    }

}
