<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sub_grup_kode_akun_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_grup($keyword, $unit){
        $sql = "
        SELECT * FROM ak_grup_kode_akun
        WHERE UNIT = '$unit'
        ORDER BY ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_subgrup($keyword, $unit){
        $sql = "
        SELECT * FROM ak_sub_grup_kode_akun
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
            $sql = "UPDATE ak_sub_grup_kode_akun SET APPROVE = 2 WHERE ID = '$id'";
            $this->db->query($sql);
        } else {
            $sql = " DELETE FROM ak_sub_grup_kode_akun WHERE ID = $id"; 
            $this->db->query($sql);
        }
    }

    function cari_subgrup_by_id($id){
        $sql = "
        SELECT * FROM ak_sub_grup_kode_akun WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_sub_grup($unit, $grup, $kode_sub, $nama_sub){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
        INSERT INTO ak_sub_grup_kode_akun
        (KODE_GRUP, KODE_SUB, NAMA_SUB, UNIT, APPROVE)
        VALUES 
        ('$grup', '$kode_sub', '$nama_sub', '$unit', '$approve')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_subgrup($id_sub, $nama_sub_grup_ed){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
        UPDATE ak_sub_grup_kode_akun SET 
            NAMA_SUB = '$nama_sub_grup_ed', 
            APPROVE = '$approve'
        WHERE ID = '$id_sub'
        ";

        $this->db->query($sql);
    }

}

?>