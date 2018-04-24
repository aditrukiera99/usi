<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurnal_sementara_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jurnal_sementara_m','model');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$get_nomor					= $this->master_model_m->get_nomor_dokumen('JS');
		$userinfo					= $this->master_model_m->get_user_info();

		if($this->input->post('save')){
			$data = array(
		        'NO_VOUCHER'      => addslashes($this->input->post('no_bukti')),
		        'TOTAL'      => str_replace(',', '', $this->input->post('total_all')),
		        'TGL'      => addslashes($this->input->post('tgl')),
		        'KETERANGAN'      => addslashes($this->input->post('ket')),
				'USER_INPUT'      => $userinfo->id,
				'DEPARTEMEN'      => $userinfo->departemen,
				'TIPE'      => 'JS',
		    );

		    $this->db->insert('ak_input_voucher',$data);

		    $id_voucher = $this->db->insert_id();

		    $no_bukti   = $this->input->post('no_bukti');
		    $kode_akun  = $this->input->post('kode_akun');
		    $debet      = $this->input->post('debet');
		    $kredit     = $this->input->post('kredit');
		    $keterangan = $this->input->post('keterangan');

		    foreach ($kode_akun as $key => $val) {
		    	$this->model->save_akuntansi($id_voucher, $no_bukti, date('d-m-Y'), $val, $debet[$key], $kredit[$key], $keterangan[$key]);
		    }

		    $this->master_model_m->update_nomor("JS");
		    $this->session->set_flashdata('sukses','1');

		} else if($this->input->post('edit')){
			$id_edit = $this->input->post('id_edit');

		    $data = array(
		        'NO_VOUCHER'      => addslashes($this->input->post('no_bukti')),
		        'TOTAL'      => str_replace(',', '', $this->input->post('total_all')),
		        'TGL'      => addslashes($this->input->post('tgl')),
		        'KETERANGAN'      => addslashes($this->input->post('ket'))
		    );


		    $this->db->where('ID', $id_edit);
    		$this->db->update('ak_input_voucher', $data);

		    $this->session->set_flashdata('sukses','1');
		}

		$data = array(
				'title' 	 		=> 'Jurnal Sementara',
				'page'  	 		=> 'jurnal_sementara_v',
				'sub_menu' 	 		=> 'Akunting Sistem',
				'sub_menu1'	 		=> 'Jurnal Sementara',
				'menu' 	   	 		=> 'akunting_sistem',
				'menu2'		 		=> 'jurnal_sementara',
				'lihat_data' 		=> $this->model->lihat_data(),
				'url_simpan' 		=> base_url().'jurnal_sementara_c',
				'url_hapus'  		=> base_url().'jurnal_sementara_c/hapus',
				'url_ubah'	 		=> base_url().'jurnal_sementara_c',
				'get_nomor'	 		=> $get_nomor,
			);
		
		$this->load->view('home_v',$data);
	}

	function add_new(){
		$userinfo					= $this->master_model_m->get_user_info();
		$get_nomor					= $this->master_model_m->get_nomor_dokumen('JS')."/JS/".$userinfo->nama_divisi."/".$this->tgl_to_romawi(date('m'))."/".date('Y');
		$data = array(
				'title' 	 		=> 'Tambah Jurnal Sementara (JS)',
				'page'  	 		=> 'add_jurnal_sementara_v',
				'sub_menu' 	 		=> 'Akunting Sistem',
				'sub_menu1'	 		=> 'Jurnal Sementara',
				'menu' 	   	 		=> 'akunting_sistem',
				'menu2'		 		=> 'jurnal_sementara',
				'lihat_data' 		=> $this->model->lihat_data(),
				'lihat_data_supp' 	=> $this->db->get('master_supplier')->result(),
				'lihat_data_akun' 	=> $this->db->get('ak_kode_akuntansi')->result(),
				'url_simpan' 		=> base_url().'jurnal_sementara_c',
				'url_hapus'  		=> base_url().'jurnal_sementara_c',
				'url_ubah'	 		=> base_url().'jurnal_sementara_c',
				'get_nomor'	 		=> $get_nomor,
			);
		
		$this->load->view('home_v',$data);
	}

	function edit($id){
		$userinfo					= $this->master_model_m->get_user_info();


		$data = array(
				'title' 	 		=> 'Ubah Bukti Jurnal Sementara (JS)',
				'page'  	 		=> 'edit_jurnal_sementara_v',
				'sub_menu' 	 		=> 'Akunting Sistem',
				'sub_menu1'	 		=> 'Jurnal Sementara',
				'menu' 	   	 		=> 'akunting_sistem',
				'menu2'		 		=> 'jurnal_sementara',
				'dt' 				=> $this->model->lihat_data_id($id),
				'dt_detail' 		=> $this->model->lihat_data_detail_id($id),
				'lihat_data_supp' 	=> $this->db->get('master_supplier')->result(),
				'lihat_data_akun' 	=> $this->db->get('ak_kode_akuntansi')->result(),
				'url_simpan' 		=> base_url().'jurnal_sementara_c',
				'url_hapus'  		=> base_url().'jurnal_sementara_c',
				'url_ubah'	 		=> base_url().'jurnal_sementara_c',
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


	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->db->where('ID', $id);
   		$this->db->delete('ak_input_voucher'); 

   		$this->db->where('ID_VOUCHER', $id);
   		$this->db->delete('ak_input_voucher_detail'); 


		$this->session->set_flashdata('hapus','1');
		redirect('jurnal_sementara_c');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */