<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_c extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array(
			'page' => 'company_v', 
		);

		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	public function sign_out(){

		$sess_user = $this->session->userdata('masuk_akuntansi');


		$this->session->unset_userdata('masuk_akuntansi');
		$this->session->sess_destroy();

		redirect('login_c');	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */