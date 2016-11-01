<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodos extends CI_Controller {

	public function get($id)
	{
		$this->load->database();
		echo json_encode($this->db->get('periodos')->result_array());
	}

}
