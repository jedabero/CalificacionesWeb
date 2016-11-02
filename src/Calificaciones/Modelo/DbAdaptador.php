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
     *
     * @return array|null
     */
    public function todosUsuarios()
    {
        return $this->db->get_where('usuarios')->result_array();
    }

    /**
    * @param int $id
    *
    * @return array|null
    */
    public function buscarUsuarioPorId(int $id)
    {
        return $this->db->get_where('usuarios', ['id' => $id])->row_array();
    }
}
