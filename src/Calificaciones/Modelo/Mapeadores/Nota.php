<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 15/11/16
 * Time: 01:19 PM
 */

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Nota as ModeloNota;
use Calificaciones\Modelo\MapeadorBase;
use Calificaciones\Soporte\Coleccion;

class Nota extends MapeadorBase
{

    /**
     * @const string
     */
    const TABLA = "notas";

    /**
     * @param mixed $asignatura_id
     *
     * @return Coleccion|null
     */
    public function todos($asignatura_id = null)
    {
        $condicion = is_null($asignatura_id) ? null : ['asignatura_id' => $asignatura_id];
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
     * @return ModeloNota
     */
    public function buscar($id): ModeloNota
    {
        $registro = $this->getAdaptador()->buscarPorId(self::TABLA, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Asignatura #$id no existe");
        }

        return $this->mapea($registro);
    }

    /**
     * @param ModeloNota $nota
     *
     */
    public function guardar(ModeloNota $nota)
    {
        $datos = $nota->toArray(false);
        if (is_null($nota->getId())) {
            $id = $this->getAdaptador()->guardar(self::TABLA, $datos);
            $nota->setId($id);
        } else {
            $this->getAdaptador()->actualizar(self::TABLA, $datos, ['id' => $nota->getId()]);
        }
    }

    public function mapea(array $registro): ModeloNota
    {
        return ModeloNota::crear($registro);
    }

}