<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 07:39 AM
 */

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Grupo as ModeloGrupo;
use Calificaciones\Modelo\DbAdaptador;

class Grupo
{
    /**
     * @const string
     */
    const TABLA = "grupos";

    /**
     * @var DbAdaptador
     */
    private $adaptador;

    function __construct(DbAdaptador $adaptador)
    {
        $this->adaptador = $adaptador;
    }

    /**
     *
     * @return array|null
     */
    public function todos()
    {
        $registros = $this->adaptador->listar(self::TABLA);

        if ($registros == null) {
            throw new \InvalidArgumentException("No existen Usuarios");
        }

        $todos = [];
        foreach ($registros as $registro) {
            $todos[] = $this->mapeaRegistroAGrupo($registro);
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
        $registro = $this->adaptador->buscarPorId(self::TABLA, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Usuario #$id no existe");
        }

        return $this->mapeaRegistroAGrupo($registro);
    }

    /**
     * @param ModeloGrupo $grupo
     *
     */
    public function guardar(ModeloGrupo $grupo)
    {
        if (!is_null($grupo->getId())) {
            $this->adaptador->actualizar(self::TABLA, $grupo->toArray(), ['id' => $grupo->getId()]);
        } else {
            $this->adaptador->guardar(self::TABLA, $grupo->toArray());
        }
    }

    private function mapeaRegistroAGrupo(array $registro): ModeloGrupo
    {
        return ModeloGrupo::crear($registro);
    }

}