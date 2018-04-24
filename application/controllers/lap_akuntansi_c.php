<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_akuntansi_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('divisi_m','divisi');
		$this->load->model('lap_akuntansi_m','model');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }

        $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	public function index()
	{
		if($this->input->post('cetak')){
			$lap = $this->input->post('lap');
			if($lap == "JU"){
				$this->cetakJU();
			} else if($lap == "JS"){
				$this->cetakJS();
			} else if($lap == "JF"){
				$this->cetakJF();
			} else if($lap == "BUKUBESAR"){
				$this->cetakBukBes();
			} else if($lap == "NERACA"){
				$this->cetakNeraca();
			} else if($lap == "LABARUGI"){
				$this->cetakLabaRugi();
			}
		}

		$data = array(
				'title' 	 		=> 'Laporan Akuntansi',
				'page'  	 		=> 'lap_akuntansi_v',
				'sub_menu' 	 		=> 'Akunting',
				'sub_menu1'	 		=> 'Laporan Akuntansi',
				'menu' 	   	 		=> 'master_data',
				'menu2'		 		=> 'divisi',
				'lihat_data' 		=> $this->divisi->lihat_data_divisi(),
				'lihat_departemen'  => $this->divisi->lihat_data_depart(),
				'url_simpan' 		=> base_url().'divisi_c/simpan',
				'url_hapus'  		=> base_url().'divisi_c/hapus',
				'url_ubah'	 		=> base_url().'divisi_c/ubah_divisi',
			);
		
		$this->load->view('home_v',$data);
	}

	function cetakJU(){

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$view = "pdf/lap_jurnal_umum_pdf";
		

        $dt = $this->db->query("
        	SELECT a.*, b.NAMA_AKUN FROM ak_input_voucher_detail a 
        	JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN
        	WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.TIPE = 'JU'
        	ORDER BY a.ID ASC
        ")->result();
		
		$data = array(
			'title' 		=> 'LAPORAN JURNAL UMUM',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
			'judul'			=> $this->datetostr($bulan)." ".$tahun,
		);
		$this->load->view($view,$data);
	}

	function cetakJS(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$view = "pdf/lap_jurnal_sementara_pdf";
		

        $dt = $this->db->query("
        	SELECT a.*, b.NAMA_AKUN FROM ak_input_voucher_detail a 
        	JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN
        	WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.TIPE = 'JS'
        	ORDER BY a.ID ASC
        ")->result();
		
		$data = array(
			'title' 		=> 'LAPORAN JURNAL SEMENTARA',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
			'judul'			=> $this->datetostr($bulan)." ".$tahun,
		);
		$this->load->view($view,$data);
	}

	function cetakJF(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$view = "pdf/lap_jurnal_final_pdf";
		

        $dt = $this->db->query("
        	SELECT a.*, b.NAMA_AKUN FROM ak_input_voucher_detail a 
        	JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN
        	WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.TIPE = 'JF'
        	ORDER BY a.ID ASC
        ")->result();
		
		$data = array(
			'title' 		=> 'LAPORAN JURNAL FINAL',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
			'judul'			=> $this->datetostr($bulan)." ".$tahun,
		);
		$this->load->view($view,$data);
	}

	function cetakBukBes(){

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$view = "pdf/lap_buku_besar_pdf";
		

        $dt = $this->db->query("
        SELECT a.*, b.NAMA_AKUN FROM (	
        	SELECT a.NO_BUKTI, b.TGL, b.KETERANGAN, a.KODE_AKUN, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT
            FROM ak_input_voucher_detail a
            JOIN ak_input_voucher b ON a.ID_VOUCHER = b.ID
            WHERE b.TGL LIKE '%-$bulan-$tahun%'
            GROUP BY a.NO_BUKTI, b.TGL, b.KETERANGAN, a.KODE_AKUN
        ) a JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN

        ORDER BY a.KODE_AKUN ASC, a.TGL,  a.DEBET DESC
        ")->result();
		
		$data = array(
			'title' 		=> 'LAPORAN BUKU BESAR',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
			'judul'			=> $this->datetostr($bulan)." ".$tahun,
		);
		$this->load->view($view,$data);
	}

	function cetakLabaRugi(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$view = "pdf/lap_laba_rugi_pdf";
		

        $dt = $this->db->query("

        SELECT a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
            SELECT a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, d.KATEGORI, d.URUT, d.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
            LEFT JOIN (
                SELECT a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                    SELECT DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                    FROM ak_input_voucher VOUCHER
                    JOIN ak_input_voucher_detail DETAIL ON VOUCHER.ID = DETAIL.ID_VOUCHER
                    WHERE VOUCHER.TGL LIKE '%-$bulan-$tahun%'
                    GROUP BY DETAIL.KODE_AKUN

                    UNION ALL 

                    SELECT KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT
                    FROM  ak_input_voucher_lainnya
                    WHERE TGL LIKE '%-$bulan-$tahun%'
                    GROUP BY KODE_AKUN
                ) a
            ) b ON a.KODE_AKUN = b.KODE_AKUN
            JOIN ak_grup_kode_akun c ON a.KODE_GRUP = c.KODE_GRUP
            JOIN ak_setup_urut_labarugi d ON d.KATEGORI = c.TMP_LR
            GROUP BY a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, d.KATEGORI, d.URUT, d.WARNA
        ) a 
        ORDER BY a.URUT, a.KODE_AKUN
        ")->result();
		
		$data = array(
			'title' 		=> 'LAPORAN BUKU BESAR',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
			'judul'			=> $this->datetostr($bulan)." ".$tahun,
		);
		$this->load->view($view,$data);
	}

	function cetakNeraca(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$view = "pdf/lap_neraca_pdf";
		
		$dt = "";
		$dt_aktiva = $this->model->get_lap_neraca_bulanan($bulan, $tahun, 'AKTIVA');
		$dt_wajib =  $this->model->get_lap_neraca_bulanan($bulan, $tahun, 'KEWAJIBAN');

		$laba      = $this->model->cetak_laba_rugi_bulanan($bulan, $tahun, 'NOW');
		$laba_lalu = $this->model->cetak_laba_rugi_bulanan($bulan, $tahun, 'LALU');

		
		$data = array(
			'title' 		=> 'LAPORAN BUKU BESAR',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
			'dt_aktiva'     => $dt_aktiva,
			'dt_wajib'      => $dt_wajib,
			'laba'          => $laba,
			'laba_lalu'     => $laba_lalu,
			'judul'			=> $this->datetostr($bulan)." ".$tahun,
		);
		$this->load->view($view,$data);
	}

	function datetostr($var){

		 if($var == "01"){
		 	$var = "Januari";
		 } else if($var == "02"){
		 	$var = "Februari";
		 } else if($var == "03"){
		 	$var = "Maret";
		 } else if($var == "04"){
		 	$var = "April";
		 } else if($var == "05"){
		 	$var = "Mei";
		 } else if($var == "06"){
		 	$var = "Juni";
		 } else if($var == "07"){
		 	$var = "Juli";
		 } else if($var == "08"){
		 	$var = "Agustus";
		 } else if($var == "09"){
		 	$var = "September";
		 } else if($var == "10"){
		 	$var = "Oktober";
		 } else if($var == "11"){
		 	$var = "November";
		 } else if($var == "12"){
		 	$var = "Desember";
		 }

		 return $var;

	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */