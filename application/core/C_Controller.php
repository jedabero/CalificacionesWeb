<?php

use Calificaciones\Modelo\DbAdaptador;

/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 07:21 AM
 */
class C_Controller extends CI_Controller
{
    /**
     * @var DbAdaptador
     */
    protected $adaptador;

    public function __construct($cargarDb = true)
    {
        parent::__construct();

        if ($cargarDb) {
            $this->load->database();
            $this->adaptador = new DbAdaptador($this->db);
        }
    }

    protected function salida_json($status, $datos)
    {
        $json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $this->output->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output($json);
    }

}