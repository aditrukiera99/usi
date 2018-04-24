<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grup_kode_akun_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_grup($keyword, $unit){
        $sql = "
        SELECT * FROM ak_grup_kode_akun
        WHERE UNIT = '$unit'
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        if($user->LEVEL == 'USER'){
            $sql = "UPDATE ak_grup_kode_akun SET APPROVE = 2 WHERE ID = '$id'";
            $this->db->query($sql);
        } else {
            $sql = " DELETE FROM ak_grup_kode_akun WHERE ID = $id"; 
            $this->db->query($sql);
        }
    }

    function cari_grup_by_id($id){
        $sql = "
        SELECT * FROM ak_grup_kode_akun WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_grup($unit, $grup, $kode_grup, $nama_grup){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 0;
        }

        $sql = "
        INSERT INTO ak_grup_kode_akun
        (GRUP, KODE_GRUP, NAMA_GRUP, UNIT, APPROVE)
        VALUES 
        ('$grup', '$kode_grup', '$nama_grup', '$unit', '$approve')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_grup($id_grup, $nama_grup_ed){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
        UPDATE ak_grup_kode_akun SET 
            NAMA_GRUP = '$nama_grup_ed', 
            APPROVE = '$approve'
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }

}

?>