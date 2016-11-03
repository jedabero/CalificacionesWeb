<?php

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Usuario;
use Calificaciones\Modelo\Repositorios\Usuarios as RepositorioUsuarios;

/**
 * 
 */
class MapeadorUsuario
{
    
    /**
     * @var RepositorioUsuarios
     */
    private $repositorio;

    function __construct(RepositorioUsuarios $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function todos()
    {
        $registros = $this->repositorio->todos();

        if ($registros == null) {
            throw new \InvalidArgumentException("No existen Usuarios");
        }

        $todos = [];
        foreach ($registros as $registro) {
            $todos[] = $this->mapeaRegistroAUsuario($registro);
        }
        return $todos;
    }

    public function buscar($id): Usuario
    {
        $registro = $this->repositorio->buscar($id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Usuario #$id no existe");
        }

        return $this->mapeaRegistroAUsuario($registro);
    }

    public function guardar(Usuario $usuario)
    {
        $this->repositorio->guardar((array) $usuario);
    }

    private function mapeaRegistroAUsuario(array $registro): Usuario
    {
        return Usuario::crear($registro);
    }
}
