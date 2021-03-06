<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 07:21 AM
 */

use Calificaciones\Modelo\DbAdaptador;


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

    protected function json_input()
    {
        return json_decode($this->input->raw_input_stream, true);
    }

    protected function salida_json($status, $datos)
    {
        $json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $this->output->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output($json);
    }

}