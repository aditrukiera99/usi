<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_aset_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_produk($keyword, $id_klien){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $sql = "
        SELECT a.*, b.GRUP, c.SUB_GRUP FROM ak_aset_list a 
        JOIN ak_aset_grup b ON a.ID_GRUP = b.ID 
        LEFT JOIN ak_aset_subgrup c ON a.ID_SUB = c.ID 
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_produk($id){
         $sql = " DELETE FROM ak_aset_list WHERE ID = $id"; 
        $this->db->query($sql);
    }

    function cari_produk_by_id($id){
        $sql = "
        SELECT * FROM ak_produk WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }


    function simpan_aset($tipe_aset, $grup_aset, $sub_grup_aset, $nama_aset, $kode_akun){

        $sql = "
        INSERT INTO ak_aset_list
        (TIPE, ID_GRUP, ID_SUB, NAMA_ASET, KODE_AKUN)
        VALUES 
        ('$tipe_aset', '$grup_aset', '$sub_grup_aset', '$nama_aset', '$kode_akun')
        ";

        $this->db->query($sql);
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

    function get_all_grup_aset(){
        $sql = "
        SELECT * FROM ak_aset_grup ORDER BY ID ASC
        ";

        return $this->db->query($sql)->result();
    }

}

?>