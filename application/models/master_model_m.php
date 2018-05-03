<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_model_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_user_info($id_user){
		$sql = "
		SELECT a.*, IFNULL(b.NAMA_PERUSAHAAN, '-') AS NAMA_PERUSAHAAN, c.NAMA_UNIT FROM ak_user a 
		LEFT JOIN ak_profil_usaha b ON a.ID_KLIEN = b.ID_KLIEN
		LEFT JOIN ak_unit c ON a.UNIT = c.ID
		WHERE a.ID = $id_user
		";

		return $this->db->query($sql)->row();
	}

    function get_list_akun_bank(){
        $sql = "
        SELECT a.* FROM ak_kode_akuntansi a 
        LEFT JOIN ak_grup_kode_akun b ON a.KODE_GRUP = b.KODE_GRUP
        WHERE b.ID = 1
        ORDER BY a.ID
        ";

        return $this->db->query($sql)->result();
    }


	function data_usaha($id_klien){
		$sql = "
		SELECT * FROM ak_profil_usaha WHERE ID_KLIEN = $id_klien
		";

		return $this->db->query($sql)->row();
	}

	function get_data_usaha(){
		$sql = "
		SELECT * FROM ak_profil_usaha
		";

		return $this->db->query($sql)->row();
	}

	function cek_master($id, $menu, $level){
		if($level == "ADMIN"){
			return true;
		} else if($level == "MANAGER"){
			return true;
		} else {
			$sql = "
	        SELECT * FROM ak_hak_akses WHERE ID_USER = '$id' AND MENU_1 = '$menu'
	        ";

	        $jml = count($this->db->query($sql)->result());

	        if($jml > 0){
	            return true;
	        } else {
	            return false;
	        }
		}        
    }

    function cek_anak($id, $menu, $level){

    	if($level == "ADMIN"){
			return true;
		} else if($level == "MANAGER"){
			return true;
		} else {
			$sql = "
	        SELECT * FROM ak_hak_akses WHERE ID_USER = '$id' AND MENU_2 = '$menu'
	        ";

	        $jml = count($this->db->query($sql)->result());

	        if($jml > 0){
	            return true;
	        } else {
	            return false;
	        }
		}
        
    }

    function get_jml_kolom_laporan($laporan){
    	$sql = "
    	SELECT * FROM ak_kolom_laporan WHERE LAPORAN = '$laporan'
    	";

    	$jml = count($this->db->query($sql)->result());
    	return $jml;
    }

    function cek_kolom($laporan, $kolom){
    	$sql = "
    	SELECT * FROM ak_kolom_laporan WHERE LAPORAN = '$laporan' AND KOLOM = '$kolom'
    	";

    	$jml = count($this->db->query($sql)->result());
        if($jml > 0){
            return true;
        } else {
            return false;
        }
    }

    function simpan_persetujuan($item, $id_item, $jenis, $id_user, $deskripsi_persetujuan){
    	$tgl = date('d-m-Y, H:i');
		$user = $this->get_user_info($id_user);
		$unit = $user->UNIT;

		if($user->LEVEL == "USER"){
			$sql = "
	    	INSERT INTO ak_persetujuan 
	    	(ITEM, ID_ITEM, JENIS, USER_INPUT, TGL_INPUT, DESKRIPSI, TINDAKAN, UNIT)
	    	VALUES 
	    	('$item', '$id_item', '$jenis', '$id_user', '$tgl', '$deskripsi_persetujuan', 0, '$unit')
	    	";

	    	$this->db->query($sql);
		} 

    	
    }

    function simpan_log($id_user, $deskripsi){
    	$tgl = date('d-m-Y');
    	$jam = date('H:i');

    	$user = $this->get_user_info($id_user);
		$unit = $user->UNIT;

    	$sql = "
    	INSERT INTO ak_log_aktifitas 
    	(ID_USER, TGL, JAM, DESKRIPSI, UNIT)
    	VALUES 
    	('$id_user', '$tgl', '$jam', '$deskripsi', '$unit')
    	";

    	$this->db->query($sql);
    }

    function get_aktif(){
    	$sql = "
    	SELECT * FROM ak_profil_usaha
    	";

    	return $this->db->query($sql)->row()->AKTIF;
    }

    function get_last_login($id){
    	$sql = "
    	SELECT * FROM ak_log_aktifitas 
    	WHERE ID_USER = '$id' AND DESKRIPSI LIKE '%Login%'
    	ORDER BY ID DESC LIMIT 1
    	";

    	return $this->db->query($sql)->row();
    }

    function get_unit_by_id($id_unit){
    	$sql = "
    	SELECT * FROM ak_unit 
    	WHERE ID = '$id_unit'
    	";

    	return $this->db->query($sql)->row();
    }

    function get_data_persetujuan($item, $id_item){
    	$sql = "
    	SELECT * FROM ak_persetujuan 
    	WHERE ITEM = '$item' AND ID_ITEM = '$id_item' AND TINDAKAN = 0
    	";

    	return $this->db->query($sql)->row();
    }

    function get_data_pengajuan_produk($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'produk'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_supplier($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'supplier'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_pelanggan($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'pelanggan'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_kode_akun($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'kode_akun'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_kategori_akun($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'kategori_akun'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_kode_grup($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'kode_grup'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_sub_kode_grup($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'kode_sub'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_setting_app(){
        $sql = "
        SELECT * FROM ak_profil_usaha
        ";

        return $this->db->query($sql)->row();
    }

    function get_list_akun_all(){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user  = $sess_user['id'];
        $user     = $this->master_model_m->get_user_info($id_user);

        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE UNIT = '$user->UNIT'
        ORDER BY KODE_AKUN
        ";

        return $this->db->query($sql)->result();
    }

}

?>