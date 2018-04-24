<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index(){
		$msg = 0;
		$dt_unit = $this->db->query("SELECT * FROM ak_unit ORDER BY ID")->result();



		$data = array(
			'page' => '',
			'act' => '',
			'msg' => '',
			'act2' => '',
			'msg'  => $msg,
			'dt_unit'  => $dt_unit,
		);
		$this->load->view('front_v', $data);
	}


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */