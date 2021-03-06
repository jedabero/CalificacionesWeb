<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 15/11/16
 * Time: 07:32 AM
 */

namespace Calificaciones\Modelo\Mapeadores;


use Calificaciones\Modelo\Dominio\Asignatura as ModeloAsignatura;
use Calificaciones\Modelo\Mapeadores\Nota as MapeadorNota;
use Calificaciones\Modelo\MapeadorBase;
use Calificaciones\Soporte\Coleccion;

class Asignatura extends MapeadorBase
{

    /**
     * @const string
     */
    const TABLA = "asignaturas";

    /**
     * @param mixed $periodo_id
     * @param bool $cargar
     *
     * @return Coleccion|null
     */
    public function todos($periodo_id = null, $cargar = true)
    {
        $condicion = is_null($periodo_id) ? null : ['periodo_id' => $periodo_id];
        $registros = $this->getAdaptador()->listar(self::TABLA, $condicion);

        $todos = Coleccion::crear();

        if ($registros == null) {
            return $todos;
        }

        $mapeador = null;
        if ($cargar) {
            $mapeador = new MapeadorNota($this->getAdaptador());
        }

        foreach ($registros as $registro) {
            $asignatura = $this->mapea($registro);
            if ($cargar) {
                $asignatura->setNotas($mapeador->todos($asignatura->getId()));
            }
            $todos[] = $asignatura;
        }
        return $todos;
    }

    /**
     * @param mixed $id
     * @param boolean $cargar
     *
     * @return ModeloAsignatura
     */
    public function buscar($id, $cargar = true): ModeloAsignatura
    {
        $registro = $this->getAdaptador()->buscarPorId(self::TABLA, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Asignatura #$id no existe");
        }

        $asignatura = $this->mapea($registro);

        if ($cargar) {
            $mapeador = new MapeadorNota($this->getAdaptador());
            $asignatura->setNotas($mapeador->todos($id));
        }

        return $asignatura;
    }

    /**
     * @param ModeloAsignatura $asignatura
     *
     */
    public function guardar(ModeloAsignatura $asignatura)
    {
        $datos = $asignatura->toArray(false);
        unset($datos['notas']);
        if (is_null($asignatura->getId())) {
            $id = $this->getAdaptador()->guardar(self::TABLA, $datos);
            $asignatura->setId($id);
        } else {
            $this->getAdaptador()->actualizar(self::TABLA, $datos, ['id' => $asignatura->getId()]);
        }
    }

    public function mapea(array $registro): ModeloAsignatura
    {
        return ModeloAsignatura::crear($registro);
    }

}