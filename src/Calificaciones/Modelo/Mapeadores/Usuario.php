<?php

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Usuario as ModeloUsuario;
use Calificaciones\Modelo\DbAdaptador;

/**
 * 
 */
class Usuario
{
    /**
     * @const string
     */
    const TABLA_USUARIOS = "usuarios";
    
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
        $registros = $this->adaptador->listar(self::TABLA_USUARIOS);

        if ($registros == null) {
            throw new \InvalidArgumentException("No existen Usuarios");
        }

        $todos = [];
        foreach ($registros as $registro) {
            $todos[] = $this->mapeaRegistroAUsuario($registro);
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
        $registro = $this->adaptador->buscarPorId(self::TABLA_USUARIOS, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Usuario #$id no existe");
        }

        return $this->mapeaRegistroAUsuario($registro);
    }

    /**
     * @param ModeloUsuario $usuario
     *
     */
    public function guardar(ModeloUsuario $usuario)
    {
        if (!is_null($usuario->getId())) {
            $this->adaptador->actualizar(self::TABLA_USUARIOS, $usuario->toArray(), ['id' => $usuario->getId()]);
        } else {
            $this->adaptador->guardar(self::TABLA_USUARIOS, $usuario->toArray());
        }
    }

    private function mapeaRegistroAUsuario(array $registro): ModeloUsuario
    {
        return ModeloUsuario::crear($registro);
    }
}
