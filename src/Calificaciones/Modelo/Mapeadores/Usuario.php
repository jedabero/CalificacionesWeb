<?php

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Usuario as ModeloUsuario;
use Calificaciones\Modelo\MapeadorBase;
use Calificaciones\Modelo\Mapeadores\Grupo as MapeadorGrupo;

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
     * @param boolean $cargarGrupos
     *
     * @return array|null
     */
    public function todos($cargarGrupos = true)
    {
        $registros = $this->getAdaptador()->listar(self::TABLA);

        if ($registros == null) {
            throw new \InvalidArgumentException("No existen Usuarios");
        }

        $mapeador = null;
        if ($cargarGrupos) {
            $mapeador = new MapeadorGrupo($this->getAdaptador());
        }

        $todos = [];
        foreach ($registros as $registro) {
            $usuario = $this->mapea($registro);
            if ($cargarGrupos) {
                $usuario->setGrupos($mapeador->todos($usuario->getId()));
            }
            $todos[] = $usuario;
        }
        return $todos;
    }

    /**
     * @param mixed $id
     * @param boolean $cargarGrupos
     *
     * @return ModeloUsuario
     */
    public function buscar($id, $cargarGrupos = true): ModeloUsuario
    {
        $registro = $this->getAdaptador()->buscarPorId(self::TABLA, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Usuario #$id no existe");
        }

        $usuario = $this->mapea($registro);

        if ($cargarGrupos) {
            $mapeador = new MapeadorGrupo($this->getAdaptador());
            $usuario->setGrupos($mapeador->todos($id));
        }

        return $usuario;
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
