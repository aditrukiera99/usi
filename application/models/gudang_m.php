<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gudang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_gudang(){
        $sql = "
        SELECT * FROM ak_gudang
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        
            $sql = " DELETE FROM ak_gudang WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function hapus_kategori_pajak($id){
        
            $sql = " DELETE FROM ak_pajak_supply WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function hapus_kategori_pajak_induk($id){
        
            $sql = " DELETE FROM ak_pajak_supply WHERE ID_SUPPLY = $id"; 
            $this->db->query($sql);
        
    }

    function cari_gudang_by_id($id){
        $sql = "
        SELECT * FROM ak_gudang WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function cari_pajak_by_id($id){
        $sql = "
        SELECT * FROM ak_pajak_supply WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_gudang($nama,$kapasitas,$penanggung_jawab,$kode){
       
        $kapasitas    = str_replace(',', '', $kapasitas);

        $sql = "
        INSERT INTO ak_gudang
        (NAMA,KAPASITAS ,PENANGGUNG_JAWAB,ISI,KODE_SUPPLY_POINT)
        VALUES 
        ('$nama', '$kapasitas', '$penanggung_jawab','0','$kode')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function tambah_master_stock($id_sp,$id_produk,$nama_produk){
       
      

        $sql = "
        INSERT INTO ak_master_stock
        (ID_PRODUK,NAMA_PRODUK ,ISI,KODE_SUPPLY_POINT)
        VALUES 
        ('$id_produk', '$nama_produk','0','$id_sp')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function simpan_pajak($id_supply,$nama_bppkb,$prosentase){
       

        $sql = "
        INSERT INTO ak_pajak_supply
        (ID_SUPPLY,NAMA_BPPKB ,PAJAK)
        VALUES 
        ('$id_supply', '$nama_bppkb', '$prosentase')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_gudang($id_grup,$nama,$kapasitas,$penanggung_jawab){
        
        $kapasitas    = str_replace(',', '', $kapasitas);

        $sql = "
        UPDATE ak_gudang SET 
            NAMA = '$nama',
            KAPASITAS = '$kapasitas',
            PENANGGUNG_JAWAB = '$penanggung_jawab'
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }

    function edit_pajak($id_grup,$nama_pajak,$prosentase_pajak){
        

        $sql = "
        UPDATE ak_pajak_supply SET 
            NAMA_BPPKB = '$nama_pajak',
            PAJAK = '$prosentase_pajak'
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }


}

?>