<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_harga_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_master_harga(){
        $sql = "
        SELECT p.NAMA_PELANGGAN as NAMPEL , pr.NAMA_PRODUK as NAMPROD , mh.* FROM ak_master_harga mh , ak_pelanggan p , ak_produk pr 
        WHERE mh.ID_PELANGGAN = p.KODE_PELANGGAN AND mh.ID_PRODUK = pr.ID AND mh.STATUS = 0
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_pelanggan(){
        $sql = "
        SELECT * FROM ak_pelanggan
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_pelanggan_detail($id){
         $sql = "
        SELECT p.NAMA_PELANGGAN as NAMPEL , pr.NAMA_PRODUK as NAMPROD , mh.* FROM ak_master_harga mh , ak_pelanggan p , ak_produk pr 
        WHERE mh.ID_PELANGGAN = p.KODE_PELANGGAN AND mh.ID_PRODUK = pr.ID AND mh.ID = '$id'
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->row();
    }


    function hapus_kategori($id){
        
            $sql = " DELETE FROM ak_master_harga WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function hapus_kategori_semua($id){
        
            $sql = " DELETE FROM ak_master_harga WHERE ID_PELANGGAN = $id"; 
            $this->db->query($sql);
        
    }

    function cari_master_harga_by_id($id){
        $sql = "
        SELECT * FROM ak_master_harga WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_master_harga($kode_sh,$nama_produk,$harga_beli,$harga_jual){
       
       $harga_beli_a            = str_replace(',','', $harga_beli);
       $harga_jual_a           = str_replace(',','', $harga_jual);

        $sql = "
        INSERT INTO ak_master_harga
        (ID_PELANGGAN,ID_PRODUK,HARGA_BELI,HARGA_JUAL,STATUS,CREATED_AT)
        VALUES 
        ('$kode_sh', '$nama_produk', '$harga_beli_a', '$harga_jual_a', '0',CURDATE())
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function simpan_master_harga_update($kode_sh,$nama_produk,$harga_beli,$harga_jual){
       

       $harga_beli_a            = str_replace(',','', $harga_beli);
       $harga_jual_a           = str_replace(',','', $harga_jual);

        $sql = "
        INSERT INTO ak_master_harga
        (ID_PELANGGAN,ID_PRODUK,HARGA_BELI,HARGA_JUAL,STATUS,UPDATED_AT)
        VALUES 
        ('$kode_sh', '$nama_produk', '$harga_beli_a', '$harga_jual_a', '0',CURDATE())
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_master_harga($id_grup, $no_polisi, $merk, $tahun, $no_rangka, $no_mesin, $kapasitas, $sopir){
        

        $sql = "
        UPDATE ak_master_harga SET 
            NOPOL = '$no_polisi', 
            MERK = '$merk',
            TAHUN = '$tahun',
            NORANGKA = '$no_rangka',
            NOMESIN = '$no_mesin',
            KAPASITAS = '$kapasitas',
            SOPIR = '$sopir'
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }

    function update_status_master($id_master){
        

        $sql = "
        UPDATE ak_master_harga SET 
            STATUS = '1'
        WHERE ID = '$id_master'
        ";

        $this->db->query($sql);
    }

}

?>