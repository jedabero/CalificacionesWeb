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
use Calificaciones\Soporte\Coleccion;

class Grupo extends MapeadorBase
{
    /**
     * @const string
     */
    const TABLA = "grupos";

    /**
     * @param mixed $usuario_id
     *
     * @return Coleccion|null
     */
    public function todos($usuario_id = null)
    {
        $condicion = is_null($usuario_id) ? null : ['usuario_id' => $usuario_id];
        $registros = $this->getAdaptador()->listar(self::TABLA, $condicion);

        $todos = Coleccion::crear();

        if ($registros == null) {
            #throw new \InvalidArgumentException("No existen Grupos");
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
        if (is_null($grupo->getId())) {
            $id = $this->getAdaptador()->guardar(self::TABLA, $grupo->toArray());
            $grupo->setId($id);
        } else {
            $this->getAdaptador()->actualizar(self::TABLA, $grupo->toArray(), ['id' => $grupo->getId()]);
        }
    }

    public function mapea(array $registro): ModeloGrupo
    {
        return ModeloGrupo::crear($registro);
    }

}