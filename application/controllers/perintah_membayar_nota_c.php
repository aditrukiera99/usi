<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perintah_membayar_nota_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('perintah_membayar_nota_m','model');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$get_nomor					= $this->master_model_m->get_nomor_dokumen('PM');
		$userinfo					= $this->master_model_m->get_user_info();

		if($this->input->post('save')){
			$data = array(
		        'NO_BUKTI'      => addslashes($this->input->post('no_bukti')),
				'KEPADA' => addslashes($this->input->post('kepada')),
				'UNTUK' => addslashes($this->input->post('untuk')),
				'NILAI'      => str_replace(',', '', $this->input->post('nilai')),
				'TGL'            => date('d-m-Y'),
				'USER_INPUT'      => $userinfo->id,
				'DEPARTEMEN'      => $userinfo->departemen
		    );

		    $this->db->insert('tb_perintah_bayar_nota',$data);

		    $no_bukti   = $this->input->post('no_bukti');
		    $kode_akun  = $this->input->post('kode_akun');
		    $debet      = $this->input->post('debet');
		    $kredit     = $this->input->post('kredit');
		    $keterangan = $this->input->post('keterangan');

		    foreach ($kode_akun as $key => $val) {
		    	$this->model->save_akuntansi($no_bukti, date('d-m-Y'), $val, $debet[$key], $kredit[$key], $keterangan[$key]);
		    }

		    $this->master_model_m->update_nomor("PM");
		    $this->session->set_flashdata('sukses','1');

		} else if($this->input->post('edit')){
			$id_edit = $this->input->post('id_edit');
			$data = array(
		        'NO_BUKTI' => addslashes($this->input->post('no_bukti')),
				'KEPADA'   => addslashes($this->input->post('kepada')),
				'UNTUK'    => addslashes($this->input->post('untuk')),
				'NILAI'    => str_replace(',', '', $this->input->post('nilai')),
				'TGL'      => date('d-m-Y')
		    );

		    $this->db->where('ID', $id_edit);
    		$this->db->update('tb_perintah_bayar_nota', $data);

		    $this->session->set_flashdata('sukses','1');
		}

		$data = array(
				'title' 	 		=> 'Perintah Membayar Nota(PM)',
				'page'  	 		=> 'perintah_membayar_nota_v',
				'sub_menu' 	 		=> 'Flow Sistem',
				'sub_menu1'	 		=> 'Perintah Membayar Nota',
				'menu' 	   	 		=> 'flow_sistem',
				'menu2'		 		=> 'perintah_membayar_nota',
				'lihat_data' 		=> $this->model->lihat_data(),
				'url_simpan' 		=> base_url().'perintah_membayar_nota_c',
				'url_hapus'  		=> base_url().'perintah_membayar_nota_c',
				'url_ubah'	 		=> base_url().'perintah_membayar_nota_c',
				'get_nomor'	 		=> $get_nomor,
			);
		
		$this->load->view('home_v',$data);
	}

	function add_new(){
		$userinfo					= $this->master_model_m->get_user_info();
		$get_nomor					= $this->master_model_m->get_nomor_dokumen('PM')."/PM/".$userinfo->nama_divisi."/".$this->tgl_to_romawi(date('m'))."/".date('Y');
		$data = array(
				'title' 	 		=> 'Tambah Data Perintah Membayar Nota (PM)',
				'page'  	 		=> 'add_perintah_membayar_nota_v',
				'sub_menu' 	 		=> 'Flow Sistem',
				'sub_menu1'	 		=> 'Perintah Membayar Nota',
				'menu' 	   	 		=> 'flow_sistem',
				'menu2'		 		=> 'perintah_membayar_nota',
				'lihat_data' 		=> $this->model->lihat_data(),
				'lihat_data_akun' 	=> $this->db->get('ak_kode_akuntansi')->result(),
				'url_simpan' 		=> base_url().'perintah_membayar_nota_c',
				'url_hapus'  		=> base_url().'perintah_membayar_nota_c',
				'url_ubah'	 		=> base_url().'perintah_membayar_nota_c',
				'get_nomor'	 		=> $get_nomor,
			);
		
		$this->load->view('home_v',$data);
	}

	function edit($id){
		$userinfo					= $this->master_model_m->get_user_info();


		$data = array(
				'title' 	 		=> 'Edit Data Perintah Membayar Nota (PM)',
				'page'  	 		=> 'edit_perintah_membayar_nota_v',
				'sub_menu' 	 		=> 'Flow Sistem',
				'sub_menu1'	 		=> 'Perintah Membayar Nota',
				'menu' 	   	 		=> 'flow_sistem',
				'menu2'		 		=> 'perintah_membayar_nota',
				'dt' 				=> $this->model->lihat_data_id($id),
				'lihat_data_akun' 	=> $this->db->get('ak_kode_akuntansi')->result(),
				'url_simpan' 		=> base_url().'perintah_membayar_nota_c',
				'url_hapus'  		=> base_url().'perintah_membayar_nota_c',
				'url_ubah'	 		=> base_url().'perintah_membayar_nota_c',
			);
		
		$this->load->view('home_v',$data);
	}

	function tgl_to_romawi($var){
	  if($var == "01"){
	    $var = "I";
	   } else if($var == "02"){
	    $var = "II";
	   } else if($var == "03"){
	    $var = "III";
	   } else if($var == "04"){
	    $var = "IV";
	   } else if($var == "05"){
	    $var = "V";
	   } else if($var == "06"){
	    $var = "VI";
	   } else if($var == "07"){
	    $var = "VII";
	   } else if($var == "08"){
	    $var = "VIII";
	   } else if($var == "09"){
	    $var = "IX";
	   } else if($var == "10"){
	    $var = "X";
	   } else if($var == "11"){
	    $var = "XI";
	   } else if($var == "12"){
	    $var = "XII";
	   }

	   return $var;
	}

	function simpan()
	{
		$grup        = $this->input->post('grup');
		$kode_akun 	 = $this->input->post('kode_akun');
		$nama_akun 	 = $this->input->post('nama_akun');
		$tipe 	     = $this->input->post('tipe');

		$data = array(
	        'KODE_GRUP'      => addslashes($this->input->post('grup')),
			'KODE_AKUN' => addslashes($this->input->post('kode_akun')),
			'NAMA_AKUN' => addslashes($this->input->post('nama_akun')),
			'TIPE'      => addslashes($this->input->post('tipe'))
	    );

	    $this->db->insert('ak_kode_akuntansi',$data);

		$this->session->set_flashdata('sukses','1');
		redirect('kode_akuntansi_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->db->where('ID', $id);
   		$this->db->delete('tb_perintah_bayar_nota'); 

		$this->session->set_flashdata('hapus','1');
		redirect('perintah_membayar_nota_c');
	}

	function data_kode_akun_id()
	{
		$id = $this->input->post('id');
		$data = $this->model->data_kode_akun_id($id);
		echo json_encode($data);
	}

	function ubah_kode_akun()
	{
		$id 				= $this->input->post('id_akun_modal');
		
		$data = array(
	        'KODE_GRUP' => addslashes($this->input->post('grup_modal')),
			'KODE_AKUN' => addslashes($this->input->post('kode_akun_modal')),
			'NAMA_AKUN' => addslashes($this->input->post('nama_akun_modal')),
			'TIPE'      => addslashes($this->input->post('tipe_modal'))
	    );

		$this->db->where('ID', $id);
    	$this->db->update('ak_kode_akuntansi', $data);

		$this->session->set_flashdata('sukses','1');
		redirect('kode_akuntansi_c');	
		// echo "1";
	}

	public function get_data_depart()
	{
		$kode =$this->input->post('kode');
		$sql  ="select * from master_departemen where id_depart = $kode ";
		$data = $this->db->query($sql)->row();

		echo json_encode($data); 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */