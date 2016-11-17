<?php

/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 16/11/16
 * Time: 06:12 PM
 */
class Estadisticas extends C_Controller
{

    /**
     * @var \Calificaciones\Modelo\Dominio\Usuario
     */
    protected $usuario;

    public function __construct($cargarDb = true)
    {
        parent::__construct($cargarDb);
        $this->load->library('session');
        $this->usuario = $this->session->usuario;// TODO handle no session
    }

    public function index()
    {
        $query = $this->db->select('COUNT(DISTINCT grupos.id) grupos, COUNT(DISTINCT periodos.id) periodos, COUNT(DISTINCT asignaturas.id) asignaturas')
            ->join('periodos', 'grupos.id = periodos.grupo_id')
            ->join('asignaturas', 'periodos.id = asignaturas.periodo_id')
            ->get_where('grupos', [ 'grupos.usuario_id' => $this->usuario->getId() ]);
        $this->salida_json(200, [ 'success' => true, 'estadisticas' => $query->row() ]);
    }

}