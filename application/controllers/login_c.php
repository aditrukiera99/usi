<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array(
			'title'	 => 'Login',
			'url' 	 => base_url().'login_c/login',
		);

		$this->load->view('login_v',$data);
	}

	function login()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$sql   = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";
		$data  = $this->db->query($sql);
		$count = $data->num_rows();

		if ($count == 1) {
			$dt = $data->row();

			$session = array(
					   'id'		   => $dt->id,
					   'nama_user' => $dt->nama_user,
					   'departemen' => $dt->departemen,
					   'level' => $dt->level,
					   'foto' 	   => $dt->foto,
			);

			$this->session->set_userdata('sign_in',$session);
			$session_data = $this->session->userdata('sign_in');

			redirect('dashboard_c');
		
		}else{
		
			redirect('login_c');
		}
	}

	public function logout()
	{
		$session = $this->session->userdata('sign_in');
		$this->session->unset_userdata('sign_in');
		$this->session->sess_destroy();
		// print_r($session['id_user']);
		// die();
		redirect(base_url(), 'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */