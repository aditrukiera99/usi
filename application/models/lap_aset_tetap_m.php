<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_aset_tetap_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_list_akun_all($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien
        ORDER BY KODE_AKUN
        ";

        return $this->db->query($sql)->result();
    }


    function get_lap_aset($bulan, $tahun){
        $sql = "
        SELECT * FROM ak_aset_grup ORDER BY ID
        ";

        return $this->db->query($sql)->result();
    }
}

?>