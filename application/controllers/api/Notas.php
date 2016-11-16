<?php

/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 15/11/16
 * Time: 06:42 PM
 */

use Calificaciones\Modelo\Mapeadores\Nota as MapeadorNota;

defined('BASEPATH') OR exit('No direct script access allowed');

class Notas extends C_Controller
{
    /**
     * @var \Calificaciones\Modelo\Mapeadores\Nota
     */
    protected $mapeador;

    public function __construct($cargarDb = true)
    {
        parent::__construct($cargarDb);
        $this->mapeador = new MapeadorNota($this->adaptador);
    }

    public function listar()
    {
        $datos = $this->json_input();
        $asignatura_id = array_key_exists('asignatura_id', $datos) ? $datos['asignatura_id'] : null;

        $notas = $this->mapeador->todos($asignatura_id);

        $this->salida_json(200, [ 'success' => true, 'notas' => $notas ]);
    }

    public function buscar($id)
    {
        $nota = $this->mapeador->buscar($id);

        $this->salida_json(200, [ 'success' => true, 'nota' => $nota ]);
    }

    public function guardar($id = null)
    {
        $datos = $this->json_input();
        $asignatura_id = array_key_exists('asignatura_id', $datos) ? $datos['asignatura_id'] : null;
        $nota = $this->mapeador->mapea($datos['nota']);
        if (is_null($nota->getAsignaturaId())) {
            $nota->setAsignaturaId($asignatura_id);
        }
        $nota->setId($id);

        $this->mapeador->guardar($nota);

        $this->salida_json(200, [ 'success' => true, 'id' => $nota->getId(), 'nota'=> $nota ]);
    }
}