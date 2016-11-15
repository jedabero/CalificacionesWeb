<?php

/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 15/11/16
 * Time: 06:33 PM
 */

use Calificaciones\Modelo\Mapeadores\Asignatura as MapeadorAsignatura;

defined('BASEPATH') OR exit('No direct script access allowed');

class Asignaturas extends C_Controller
{

    /**
     * @var \Calificaciones\Modelo\Mapeadores\Asignatura
     */
    protected $mapeador;

    public function __construct($cargarDb = true)
    {
        parent::__construct($cargarDb);
        $this->mapeador = new MapeadorAsignatura($this->adaptador);
    }

    public function listar()
    {
        $datos = $this->json_input();
        $periodo_id = array_key_exists('periodo_id', $datos) ? $datos['periodo_id'] : null;

        $asignaturas = $this->mapeador->todos($periodo_id);

        $this->salida_json(200, [ 'success' => true, 'asignaturas' => $asignaturas ]);
    }

    public function buscar($id)
    {
        $asignatura = $this->mapeador->buscar($id);

        $this->salida_json(200, [ 'success' => true, 'asignatura' => $asignatura ]);
    }

    public function guardar($id = null)
    {
        $datos = $this->json_input();
        $periodo_id = array_key_exists('periodo_id', $datos) ? $datos['periodo_id'] : null;
        $asignatura = $this->mapeador->mapea($datos['asignatura']);
        if (is_null($asignatura->getPeriodoId())) {
            $asignatura->setPeriodoId($periodo_id);
        }
        $asignatura->setId($id);

        $this->mapeador->guardar($asignatura);

        $this->salida_json(200, [ 'success' => true, 'id' => $asignatura->getId(), 'asignatura'=> $asignatura ]);
    }

}