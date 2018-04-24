<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pegawai_m','pegawai');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 		=> 'Master Pegawai',
				'page'  	 		=> 'pegawai_v',
				'sub_menu' 	 		=> 'master data',
				'sub_menu1'	 		=> 'master pegawai',
				'menu' 	   	 		=> 'master_data',
				'menu2'		 		=> 'pegawai',
				'lihat_data' 		=> $this->pegawai->lihat_data_pegawai(),
				'lihat_status'  	=> $this->pegawai->lihat_data_status(),
				'lihat_keluarga'    => $this->pegawai->lihat_data_keluarga(),
				'lihat_departemen'  => $this->pegawai->lihat_data_departemen(),
				'lihat_jabatan'     => $this->pegawai->lihat_data_jabatan(),
				'url_simpan'		=> base_url().'pegawai_c/simpan',
				'url_hapus' 		=> base_url().'pegawai_c/hapus',
				'url_ubah'			=> base_url().'pegawai_c/ubah_divisi',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$id_pegawai 		= $this->input->post('id_pegawai');
		if ($id_pegawai == '') {

			$id_status 			= $this->input->post('id_status');
			$nik 				= $this->input->post('nik');
			$nama 				= $this->input->post('nama');
			$alamat 			= $this->input->post('alamat');
			$jenis_kelamin 		= $this->input->post('jenis_kelamin');
			$tempat_lahir 		= $this->input->post('tempat_lahir');
			$tanggal_lahir		= $this->input->post('tanggal_lahir');
			$kota 				= $this->input->post('kota');
			$agama 				= $this->input->post('agama');
			$pendidikan 		= $this->input->post('pendidikan');
			$id_keluarga 		= $this->input->post('id_keluarga');
			$id_depart 			= $this->input->post('id_depart');
			$id_jabatan 		= $this->input->post('id_jabatan');
			$kode_gaji 			= $this->input->post('kode_gaji');
			$tgl_masuk 			= $this->input->post('tgl_masuk');
			$tgl_keluar 		= $this->input->post('tgl_keluar');
			$jamsostek			= $this->input->post('jamsostek');
			$mutasi 			= $this->input->post('mutasi');
			$pengalaman_kerja	= $this->input->post('pengalaman_kerja');
			$kursus 			= $this->input->post('kursus');
			$foto 	  			= "";
								  if(!empty($_FILES['userfile']['name'])){
				 				 	$foto = str_replace(' ', '_', $_FILES['userfile']['name']);
				 				 	$this->ngupload('userfile');
				 				  }
			$id_user 			= $this->input->post('id_user');
			$tipe_jadwal 		= $this->input->post('tipe_jadwal');
			$nama_bank 			= $this->input->post('nama_bank');
			$ket_depart 		= $this->input->post('ket_depart');
			$digaji 			= $this->input->post('digaji');
			$no_rekening 		= $this->input->post('no_rekening');
	
			$this->pegawai->simpan_data_pegawai($id_status,$nik,$nama,$alamat,$jenis_kelamin,$tempat_lahir,$tanggal_lahir,
									 		    $kota,$agama,$pendidikan,$id_keluarga,$id_depart,$id_jabatan,$kode_gaji,$tgl_masuk,$tgl_keluar,
									 		    $jamsostek,$mutasi,$pengalaman_kerja,$kursus,$foto,$id_user,$tipe_jadwal,$nama_bank,$ket_depart,
									 		    $digaji,$no_rekening);
			$this->session->set_flashdata('sukses','1');
			redirect('pegawai_c');
		} else {
			$id 				= $this->input->post('id_pegawai');
			$id_status 			= $this->input->post('id_status');
			$nik 				= $this->input->post('nik');
			$nama 				= $this->input->post('nama');
			$alamat 			= $this->input->post('alamat');
			$jenis_kelamin 		= $this->input->post('jenis_kelamin');
			$tempat_lahir 		= $this->input->post('tempat_lahir');
			$tanggal_lahir		= $this->input->post('tanggal_lahir');
			$kota 				= $this->input->post('kota');
			$agama 				= $this->input->post('agama');
			$pendidikan 		= $this->input->post('pendidikan');
			$id_status_keluarga = $this->input->post('id_keluarga');
			$id_depart 			= $this->input->post('id_depart');
			$id_jabatan 		= $this->input->post('id_jabatan');
			$kode_gaji 			= $this->input->post('kode_gaji');
			$tgl_masuk 			= $this->input->post('tgl_masuk');
			$tgl_keluar 		= $this->input->post('tgl_keluar');
			$jamsostek			= $this->input->post('jamsostek');
			$mutasi 			= $this->input->post('mutasi');
			$pengalaman_kerja	= $this->input->post('pengalaman_kerja');
			$kursus 			= $this->input->post('kursus');
			$foto 	  			= "";
								  if(!empty($_FILES['userfile']['name'])){
				 				 	$foto = str_replace(' ', '_', $_FILES['userfile']['name']);
				 				 	$this->ngupload('userfile');
				 				  }
			$id_user 			= $this->input->post('id_user');
			$tipe_jadwal 		= $this->input->post('tipe_jadwal');
			$nama_bank 			= $this->input->post('nama_bank');
			$ket_depart 		= $this->input->post('ket_depart');
			$digaji 			= $this->input->post('digaji');
			$no_rekening 		= $this->input->post('no_rekening');
	
			$this->pegawai->ubah_data_pegawai($id,$id_status,$nik,$nama,$alamat,$jenis_kelamin,$tempat_lahir,										  					  		  $tanggal_lahir,$kota,$agama,$pendidikan,$id_keluarga,$id_depart,$id_jabatan,
											  $kode_gaji,$tgl_masuk,$tgl_keluar,$jamsostek,$mutasi,$pengalaman_kerja,$kursus,	
											  $foto,$id_user,$tipe_jadwal,$nama_bank,$ket_depart,$digaji,$no_rekening);
			$this->session->set_flashdata('sukses','1');
			redirect('pegawai_c');
		}
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->pegawai->hapus_pegawai($id);
		$this->session->set_flashdata('hapus','1');
		redirect('pegawai_c');
	}

	function data_pegawai_id()
	{
		$id   = $this->input->post('id');
		$data = $this->pegawai->data_pegawai_id($id);
		echo json_encode($data);
	}

	function ubah_pegawai()
	{
		$id 				= $this->input->post('id_divisi_modal');
		$kode_divisi_modal  = $this->input->post('kode_divisi_modal');
		$nama_divisi_modal  = $this->input->post('nama_divisi_modal');
		
		$this->divisi->ubah_data_divisi($id,$kode_divisi_modal,$nama_divisi_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('divisi_c');	
		// echo "1";
	}

	private function set_ngupload_options(){   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = './foto/';
	    $config['allowed_types'] = '*';
	    $config['max_size']      = '0';
	    $config['overwrite']     = FALSE;

	    return $config;
	}

	function ngupload($file){   
	    $this->load->library('upload');

	    $files = $_FILES;
	    if(isset($_FILES[$file])){
	        $_FILES[$file]['name'] = str_replace(' ', '_', $files[$file]['name']);
	        $_FILES[$file]['type'] = $files[$file]['type'];
	        $_FILES[$file]['tmp_name'] = $files[$file]['tmp_name'];
	        $_FILES[$file]['error'] = $files[$file]['error'];
	        $_FILES[$file]['size'] = $files[$file]['size'];    

	        $this->upload->initialize($this->set_ngupload_options());
	        $this->upload->do_upload($file);
	        $gambar = $this->upload->data();

	        // echo $files[$file]['name'][$i];
	        // print_r($gambar);
	        // die();
	    }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */