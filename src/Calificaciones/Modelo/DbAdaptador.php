<?php

namespace Calificaciones\Modelo;

/**
 * 
 */
class DbAdaptador
{
    
    /**
    * @var object
    */
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
    * @param int $id
    *
    * @return array|null
    */
    public function buscarUsuarioPorId(int $id)
    {
        return $this->db->get_where('usuarios', ['id' => $id])->result_array();
    }
}
