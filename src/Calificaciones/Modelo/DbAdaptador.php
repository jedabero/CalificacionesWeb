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
    public function listar(string $tabla, $condiciones = [], $order_bys = [])
    {
        if (count($condiciones) > 0) {
            $this->db->where($condiciones);
        }
        foreach ($order_bys as $key => $value) {
            if (is_numeric($key)) {
                $this->db->order_by($value);
            } else {
                $this->db->order_by($key, $value);
            }

        }

        return $this->db->get($tabla)->result_array();
    }

    /**
     * @param string $tabla
     * @param array $condiciones
     *
     * @return array|null
     */
    public function buscar(string $tabla, $condiciones = [])
    {
        return $this->db->get_where($tabla, $condiciones)->row_array();
    }

    /**
     * @param string $tabla
     * @param int $id
     *
     * @return array|null
     */
    public function buscarPorId(string $tabla, int $id)
    {
        return $this->buscar($tabla, ['id' => $id]);
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
