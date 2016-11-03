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
    const TABLA = "usuarios";
    
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
        $registro = $this->adaptador->buscarPorId(self::TABLA, $id);

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
            $this->adaptador->actualizar(self::TABLA, $usuario->toArray(), ['id' => $usuario->getId()]);
        } else {
            $this->adaptador->guardar(self::TABLA, $usuario->toArray());
        }
    }

    private function mapea(array $registro): ModeloUsuario
    {
        return ModeloUsuario::crear($registro);
    }
}
