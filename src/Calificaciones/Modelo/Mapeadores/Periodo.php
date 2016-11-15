<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 14/11/16
 * Time: 08:54 PM
 */

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Periodo as ModeloPeriodo;
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
        $registros = $this->getAdaptador()->listar(self::TABLA, $condicion);

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
     *
     * @return ModeloPeriodo
     */
    public function buscar($id): ModeloPeriodo
    {
        $registro = $this->getAdaptador()->buscarPorId(self::TABLA, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Periodo #$id no existe");
        }

        return $this->mapea($registro);
    }

    /**
     * @param ModeloPeriodo $periodo
     *
     */
    public function guardar(ModeloPeriodo $periodo)
    {
        if (is_null($periodo->getId())) {
            $id = $this->getAdaptador()->guardar(self::TABLA, $periodo->toArray());
            $periodo->setId($id);
        } else {
            $this->getAdaptador()->actualizar(self::TABLA, $periodo->toArray(), ['id' => $periodo->getId()]);
        }
    }

    public function mapea(array $registro): ModeloPeriodo
    {
        return ModeloPeriodo::crear($registro);
    }

}