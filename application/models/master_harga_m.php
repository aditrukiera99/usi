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

    function supply_kenter(){
        $sql = "
        SELECT * FROM ak_gudang
        ";

        return $this->db->query($sql)->result();
    }

    function get_supply_point($id_barang){
        $sql = "
        SELECT g.* FROM ak_gudang g, ak_pajak_supply sp , tb_pelanggan_supply ts WHERE ts.ID_SUPPLY_POINT = sp.ID AND sp.ID_SUPPLY = g.ID AND ts.ID_PELANGGAN = '$id_barang'
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

    function get_data_master($id,$id_produk){
        $sql = "
        SELECT p.NAMA_PELANGGAN as NAMPEL , pr.NAMA_PRODUK as NAMPROD , mh.* FROM ak_master_harga mh, ak_produk pr , ak_pelanggan p WHERE mh.ID_PELANGGAN = p.KODE_PELANGGAN AND mh.ID_PRODUK = pr.ID AND mh.ID_PELANGGAN = '$id' AND mh.ID_PRODUK = '$id_produk'";

        return $this->db->query($sql)->row();
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

    function simpan_master_harga($kode_sh,$nama_produk,$harga_beli,$harga_jual,$periode,$aksi_on){
       
       $harga_beli_a            = str_replace(',','', $harga_beli);
       $harga_jual_a           = str_replace(',','', $harga_jual);

        $sql = "
        INSERT INTO ak_master_harga
        (ID_PELANGGAN,ID_PRODUK,HARGA_BELI,HARGA_JUAL,STATUS,KODE_PERIODE,TAHUN,SUPPLY_POINT)
        VALUES 
        ('$kode_sh', '$nama_produk', '$harga_beli_a', '$harga_jual_a', '0','$periode',YEAR(CURDATE()),'$aksi_on')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function simpan_master_harga_update($kode_sh,$nama_produk,$harga_beli,$harga_jual,$periode,$sp_point){
       

       $harga_beli_a            = str_replace(',','', $harga_beli);
       $harga_jual_a           = str_replace(',','', $harga_jual);

        $sql = "
        INSERT INTO ak_master_harga
        (ID_PELANGGAN,ID_PRODUK,HARGA_BELI,HARGA_JUAL,STATUS,UPDATED_AT,KODE_PERIODE,SUPPLY_POINT)
        VALUES 
        ('$kode_sh', '$nama_produk', '$harga_beli_a', '$harga_jual_a', '0',CURDATE(),'$periode','$sp_point')
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


    function simpan_master_harga_ganti($id_master,$harga_beli,$harga_jual){
        
        $harga_beli_a            = str_replace(',','', $harga_beli);
        $harga_jual_a           = str_replace(',','', $harga_jual);

        $sql = "
        UPDATE ak_master_harga SET 
            HARGA_BELI = '$harga_beli_a' , HARGA_JUAL = '$harga_jual_a'
        WHERE ID = '$id_master'
        ";

        $this->db->query($sql);
    }

}

?>