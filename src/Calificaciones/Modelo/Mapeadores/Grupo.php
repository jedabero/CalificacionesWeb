<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 07:39 AM
 */

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Grupo as ModeloGrupo;
use Calificaciones\Modelo\MapeadorBase;

class Grupo extends MapeadorBase
{
    /**
     * @const string
     */
    const TABLA = "grupos";

    /**
     *
     * @return array|null
     */
    public function todos()
    {
        $registros = $this->getAdaptador()->listar(self::TABLA);

        if ($registros == null) {
            throw new \InvalidArgumentException("No existen Grupos");
        }

        $todos = [];
        foreach ($registros as $registro) {
            $todos[] = $this->mapea($registro);
        }
        return $todos;
    }

    /**
     * @param mixed $id
     *
     * @return ModeloGrupo
     */
    public function buscar($id): ModeloGrupo
    {
        $registro = $this->getAdaptador()->buscarPorId(self::TABLA, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Grupo #$id no existe");
        }

        return $this->mapea($registro);
    }

    /**
     * @param ModeloGrupo $grupo
     *
     */
    public function guardar(ModeloGrupo $grupo)
    {
        if (!is_null($grupo->getId())) {
            $this->getAdaptador()->actualizar(self::TABLA, $grupo->toArray(), ['id' => $grupo->getId()]);
        } else {
            $this->getAdaptador()->guardar(self::TABLA, $grupo->toArray());
        }
    }

    private function mapea(array $registro): ModeloGrupo
    {
        return ModeloGrupo::crear($registro);
    }

}