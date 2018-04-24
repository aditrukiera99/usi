<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title'    	=> 'Dashboard',
				'sub_menu' 	=> 'dashboard',
				'sub_menu1'	=> 'dashboard',
				'page' 	   	=> 'dashboard_v',
				'menu' 	   	=> 'dashboard_menu',
				'menu2'		=> '',
			);

		$this->load->view('home_v',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */