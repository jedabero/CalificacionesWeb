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
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param string $tabla
     * @param array $condiciones
     *
     * @return array|null
     */
    public function listar(string $tabla, $condiciones = [])
    {
        if (count($condiciones) > 0) {
            $this->db->where($condiciones);
        }
        return $this->db->get($tabla)->result_array();
    }

    /**
     * @param string $tabla
     * @param int $id
     *
     * @return array|null
     */
    public function buscarPorId(string $tabla, int $id)
    {
        return $this->db->get_where($tabla, ['id' => $id])->row_array();
    }

    /**
     * @param string $tabla
     * @param array $datos
     *
     * @return int the inserted id
     */
    public function guardar(string $tabla, array $datos)
    {
        $this->db->insert($tabla, $datos);
        return $this->db->insert_id();
    }

    /**
     * @param string $tabla
     * @param array $datos
     * @param array $condicion
     *
     */
    public function actualizar(string $tabla, array $datos, array $condicion)
    {
        $this->db->update($tabla, $datos, $condicion);
    }
}
