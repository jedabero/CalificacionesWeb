<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 14/11/16
 * Time: 08:54 PM
 */

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Periodo as ModeloPeriodo;
use Calificaciones\Modelo\Mapeadores\Asignatura as MapeadorAsignatura;
use Calificaciones\Modelo\MapeadorBase;
use Calificaciones\Soporte\Coleccion;

class Periodo extends MapeadorBase
{

    /**
     * @const string
     */
    const TABLA = "periodos";

    /**
     * @param mixed $grupo_id
     *
     * @return Coleccion|null
     */
    public function todos($grupo_id = null)
    {
        $condicion = is_null($grupo_id) ? null : ['grupo_id' => $grupo_id];
        $registros = $this->getAdaptador()->listar(self::TABLA, $condicion, [ 'orden' ]);

        $todos = Coleccion::crear();

        if ($registros == null) {
            return $todos;
        }

        foreach ($registros as $registro) {
            $todos[] = $this->mapea($registro);
        }
        return $todos;
    }

    /**
     * @param mixed $id
     * @param boolean $cargar
     *
     * @return ModeloPeriodo
     */
    public function buscar($id, $cargar = true): ModeloPeriodo
    {
        $registro = $this->getAdaptador()->buscarPorId(self::TABLA, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Periodo #$id no existe");
        }

        $periodo = $this->mapea($registro);

        if ($cargar) {
            $mapeador = new MapeadorAsignatura($this->getAdaptador());
            $periodo->setAsignaturas($mapeador->todos($id));
        }

        return $periodo;
    }

    /**
     * @param ModeloPeriodo $periodo
     *
     */
    public function guardar(ModeloPeriodo $periodo)
    {
        $datos = $periodo->toArray(false);
        unset($datos['asignaturas']);
        if (is_null($periodo->getId())) {
            $id = $this->getAdaptador()->guardar(self::TABLA, $datos);
            $periodo->setId($id);
        } else {
            $this->getAdaptador()->actualizar(self::TABLA, $datos, ['id' => $periodo->getId()]);
        }
    }

    public function mapea(array $registro): ModeloPeriodo
    {
        return ModeloPeriodo::crear($registro);
    }

}