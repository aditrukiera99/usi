<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Broker_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_pelanggan($keyword, $id_klien){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $sql = "
        SELECT * FROM ak_broker
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_pelanggan($id){
        $sql = " DELETE FROM ak_broker WHERE ID = $id"; 
        $this->db->query($sql);
    }

    function cari_pelanggan_by_id($id){
        $sql = "
        SELECT * FROM ak_broker WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }


    function simpan_pelanggan($id_klien, $nama_broker, $ktp, $npwp, $alamat, $no_telp, $no_hp, $email){


        $sql = "
        INSERT INTO ak_broker
        (NAMA, ALAMAT, TELP, NO_KTP, NO_NPWP, HP, EMAIL)
        VALUES 
        ('$nama_broker', '$alamat', '$no_telp', '$ktp', '$npwp', '$no_hp', '$email')
        ";

        $this->db->query($sql);

    }

    function edit_pelanggan($id_broker, $nama_broker_ed, $ktp_ed, $npwp_ed, $alamat_ed, $no_telp_ed, $no_hp_ed, $email_ed){

        $sql = "
        UPDATE ak_broker SET 
            NAMA = '$nama_broker_ed',
            NO_KTP = '$ktp_ed',
            NO_NPWP = '$npwp_ed',
            ALAMAT = '$alamat_ed',
            TELP = '$no_telp_ed',
            HP = '$no_hp_ed',
            EMAIL = '$email_ed'
        WHERE ID = $id_broker
        ";

        $this->db->query($sql);
    }

    function simpan_broker($id_pelanggan, $broker_nama, $broker_alamat, $broker_telp, $broker_ktp, $broker_npwp, $broker_komisi){
        $sql = "
        INSERT INTO ak_broker 
        (ID_CUSTOMER, NAMA, ALAMAT, TELP, NO_KTP, NO_NPWP, KOMISI)
        VALUES 
        ('$id_pelanggan', '$broker_nama', '$broker_alamat', '$broker_telp', '$broker_ktp', '$broker_npwp', '$broker_komisi')
        ";

        $this->db->query($sql);

    }

}

?>