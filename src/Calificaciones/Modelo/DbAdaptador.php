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
     *
     * @return array|null
     */
    public function listar($tabla)
    {
        return $this->db->get($tabla)->result_array();
    }

    /**
     * @param string $tabla
     * @param int $id
     *
     * @return array|null
     */
    public function buscarPorId($tabla, int $id)
    {
        return $this->db->get_where($tabla, ['id' => $id])->row_array();
    }

    /**
     * @param string $tabla
     * @param array $datos
     *
     */
    public function guardar($tabla, array $datos)
    {
        $this->db->insert($tabla, $datos);
    }

    /**
     * @param string $tabla
     * @param array $datos
     * @param array $condicion
     *
     */
    public function actualizar($tabla, array $datos, array $condicion)
    {
        $this->db->update($tabla, $datos, $condicion);
    }
}
