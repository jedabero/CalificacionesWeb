<?php

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Usuario;
use Calificaciones\Modelo\DbAdaptador;

/**
 * 
 */
class MapeadorUsuario
{
    
    /**
     * @var DbAdaptador
     */
    private $adaptador;

    function __construct(DbAdaptador $adaptador)
    {
        $this->adaptador = $adaptador;
    }

    public function buscar($id): Usuario
    {
        $registro = $this->adaptador->buscarUsuarioPorId($id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Usuario #$id no existe");
        }

        return $this->mapeaRegistroAUsuario($registro);
    }

    private function mapeaRegistroAUsuario(array $registro): Usuario
    {
        return Usuario::crear($registro);
    }
}
