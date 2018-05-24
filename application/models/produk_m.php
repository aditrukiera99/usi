<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_produk($keyword, $id_klien){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);
        $where_unit = "1=1";
        if($user->LEVEL == "ADMIN"){
            $where_unit = "1=1";
        } else {
            $where_unit = "UNIT = ".$user->UNIT;
        }

        $where = "1=1";
        if($keyword != "" || $keyword != null){
            $where = $where." AND (NAMA_PRODUK LIKE '%$keyword%' OR KODE_PRODUK LIKE '%$keyword%' ) ";
        }

        $sql = "
        SELECT * FROM ak_produk
        WHERE $where AND ID_KLIEN = $id_klien AND $where_unit
        ORDER BY APPROVE ASC, ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_produk_detail($id){

         $sql = "
        SELECT * FROM ak_produk WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function get_list_akun_all($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_produk($id){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        if($user->LEVEL == 'USER'){
            $sql = "UPDATE ak_produk SET APPROVE = 2 WHERE ID = '$id'";
            $this->db->query($sql);
        } else {
            $sql = " DELETE FROM ak_produk WHERE ID = $id"; 
            $this->db->query($sql);
        }
    }

    function cari_produk_by_id($id){
        $sql = "
        SELECT * FROM ak_produk WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }


    function simpan_produk($id_klien, $kode_produk, $nama_produk, $satuan, $deskripsi, $harga_jual, $harga_beli, $unit, $ppn, $pph, $service, $kode_akun, $tipe, $kategori_produk){

        if($satuan == "" || $satuan == null){
            $satuan = "-";
        }

        if($deskripsi == "" || $deskripsi == null){
            $deskripsi = "-";
        }

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 0;
        }

        $stok = 0;
        if($tipe == "JASA"){
            $stok = 9999;
        }



        $sql = "
        INSERT INTO ak_produk
        (ID_KLIEN, KODE_PRODUK, NAMA_PRODUK, SATUAN, DESKRIPSI, HARGA_JUAL, HARGA, APPROVE, UNIT, PPH, PPN, SERVICE, KODE_AKUN, TIPE, STOK, KATEGORI_PRODUK)
        VALUES 
        ($id_klien, '$kode_produk', '$nama_produk', '$satuan', '$deskripsi', '0', '0', '$approve', '$unit', '$pph', '$ppn', '$service', '$kode_akun', '$tipe', '$stok', '$kategori_produk')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_produk($id_produk, $kode_produk_ed, $nama_produk_ed, $satuan_ed, $deskripsi_ed, $harga_jual, $harga_beli, $ppn_ed, $pph_ed, $service_ed, $kode_akun, $tipe_barang, $kategori_produk){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
        UPDATE ak_produk SET 
        KODE_PRODUK = '$kode_produk_ed', NAMA_PRODUK = '$nama_produk_ed', SATUAN = '$satuan_ed', 
        DESKRIPSI = '$deskripsi_ed', HARGA = '$harga_beli', HARGA_JUAL = '$harga_jual', APPROVE = '$approve',
        PPN = '$ppn_ed', PPH = '$pph_ed', SERVICE = '$service_ed', KODE_AKUN = '$kode_akun', TIPE = '$tipe_barang', KATEGORI_PRODUK = '$kategori_produk'
        WHERE ID = '$id_produk'
        ";

        $this->db->query($sql);
    }

    function edit_produk_detail($kode_produk_ed, $id_produk, $nama_produk_ed, $satuan_ed, $deskripsi_ed){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
        UPDATE ak_produk SET 
        KODE_PRODUK = '$kode_produk_ed', NAMA_PRODUK = '$nama_produk_ed', SATUAN = '$satuan_ed', DESKRIPSI = '$deskripsi_ed'
        WHERE ID = '$id_produk'
        ";

        $this->db->query($sql);
    }

    function get_all_kategori_produk(){
        $sql = "SELECT * FROM ak_kategori_produk ORDER BY ID DESC ";
        return $this->db->query($sql)->result();
    }

    function get_produk_by_kategori($lap_kategori_produk, $unit){
        if($lap_kategori_produk == ""){
            $sql = "
            SELECT * FROM ak_produk
            ORDER BY ID DESC
            ";
        } else {
            $sql = "
            SELECT * FROM ak_produk WHERE KATEGORI_PRODUK = '$lap_kategori_produk'
            ORDER BY ID DESC
            ";
        }        

        return $this->db->query($sql)->result();
    }

}

?>