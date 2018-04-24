<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurnal_final_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jurnal_final_m','model');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$get_nomor					= $this->master_model_m->get_nomor_dokumen('JF');
		$userinfo					= $this->master_model_m->get_user_info();

		if($this->input->post('save')){
			$data = array(
		        'NO_VOUCHER'      => addslashes($this->input->post('no_bukti')),
		        'TOTAL'      => str_replace(',', '', $this->input->post('total_all')),
		        'TGL'      => addslashes($this->input->post('tgl')),
		        'KETERANGAN'      => addslashes($this->input->post('ket')),
				'USER_INPUT'      => $userinfo->id,
				'DEPARTEMEN'      => $userinfo->departemen,
				'TIPE'      => 'JF',
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

		    $this->master_model_m->update_nomor("JF");
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
				'title' 	 		=> 'Jurnal Final',
				'page'  	 		=> 'jurnal_final_v',
				'sub_menu' 	 		=> 'Akunting Sistem',
				'sub_menu1'	 		=> 'Jurnal Final',
				'menu' 	   	 		=> 'akunting_sistem',
				'menu2'		 		=> 'jurnal_final',
				'lihat_data' 		=> $this->model->lihat_data(),
				'url_simpan' 		=> base_url().'jurnal_final_c',
				'url_hapus'  		=> base_url().'jurnal_final_c/hapus',
				'url_ubah'	 		=> base_url().'jurnal_final_c',
				'get_nomor'	 		=> $get_nomor,
			);
		
		$this->load->view('home_v',$data);
	}

	function add_new(){
		$userinfo					= $this->master_model_m->get_user_info();
		$get_nomor					= $this->master_model_m->get_nomor_dokumen('JF')."/JF/".$userinfo->nama_divisi."/".$this->tgl_to_romawi(date('m'))."/".date('Y');
		$data = array(
				'title' 	 		=> 'Tambah Jurnal Final (JF)',
				'page'  	 		=> 'add_jurnal_final_v',
				'sub_menu' 	 		=> 'Akunting Sistem',
				'sub_menu1'	 		=> 'Jurnal Final',
				'menu' 	   	 		=> 'akunting_sistem',
				'menu2'		 		=> 'jurnal_final',
				'lihat_data' 		=> $this->model->lihat_data(),
				'lihat_data_supp' 	=> $this->db->get('master_supplier')->result(),
				'lihat_data_akun' 	=> $this->db->get('ak_kode_akuntansi')->result(),
				'url_simpan' 		=> base_url().'jurnal_final_c',
				'url_hapus'  		=> base_url().'jurnal_final_c',
				'url_ubah'	 		=> base_url().'jurnal_final_c',
				'get_nomor'	 		=> $get_nomor,
			);
		
		$this->load->view('home_v',$data);
	}

	function edit($id){
		$userinfo					= $this->master_model_m->get_user_info();


		$data = array(
				'title' 	 		=> 'Ubah Bukt Jurnal Final (JU)',
				'page'  	 		=> 'edit_jurnal_final_v',
				'sub_menu' 	 		=> 'Akunting Sistem',
				'sub_menu1'	 		=> 'Jurnal Final',
				'menu' 	   	 		=> 'akunting_sistem',
				'menu2'		 		=> 'jurnal_final',
				'dt' 				=> $this->model->lihat_data_id($id),
				'dt_detail' 		=> $this->model->lihat_data_detail_id($id),
				'lihat_data_supp' 	=> $this->db->get('master_supplier')->result(),
				'lihat_data_akun' 	=> $this->db->get('ak_kode_akuntansi')->result(),
				'url_simpan' 		=> base_url().'jurnal_final_c',
				'url_hapus'  		=> base_url().'jurnal_final_c',
				'url_ubah'	 		=> base_url().'jurnal_final_c',
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
   		$this->db->delete('ak_input_voucher'); 

   		$this->db->where('ID_VOUCHER', $id);
   		$this->db->delete('ak_input_voucher_detail'); 


		$this->session->set_flashdata('hapus','1');
		redirect('jurnal_final_c');
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

	function get_data_bukti(){
		$keyword = $this->input->post('keyword');
		$data = $this->model->get_data_bukti($keyword);

		echo json_encode($data); 
	}

	function get_bukti_detail(){
		$id = $this->input->post('id');
		$data = $this->model->get_data_bukti_detail($id);

		echo json_encode($data); 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */