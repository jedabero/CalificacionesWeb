<?php

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Usuario;

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
            throw new \InvalidArguentException("Usuario #$id no existe");
        }

        return $this->mapeaRegistroAUsuario($registro);
    }

    private function mapeaRegistroAUsuario(array $registro): Usuario
    {
        # code...
    }
}
