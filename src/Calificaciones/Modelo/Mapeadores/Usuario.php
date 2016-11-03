<?php

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Usuario as ModeloUsuario;
use Calificaciones\Modelo\MapeadorBase;

/**
 * 
 */
class Usuario extends MapeadorBase
{
    /**
     * @const string
     */
    const TABLA = "usuarios";

    /**
     *
     * @return array|null
     */
    public function todos()
    {
        $registros = $this->getAdaptador()->listar(self::TABLA);

        if ($registros == null) {
            throw new \InvalidArgumentException("No existen Usuarios");
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
     * @return ModeloUsuario
     */
    public function buscar($id): ModeloUsuario
    {
        $registro = $this->getAdaptador()->buscarPorId(self::TABLA, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Usuario #$id no existe");
        }

        return $this->mapea($registro);
    }

    /**
     * @param ModeloUsuario $usuario
     *
     */
    public function guardar(ModeloUsuario $usuario)
    {
        if (!is_null($usuario->getId())) {
            $this->getAdaptador()->actualizar(self::TABLA, $usuario->toArray(), ['id' => $usuario->getId()]);
        } else {
            $this->getAdaptador()->guardar(self::TABLA, $usuario->toArray());
        }
    }

    function mapea(array $registro): ModeloUsuario
    {
        return ModeloUsuario::crear($registro);
    }
}
