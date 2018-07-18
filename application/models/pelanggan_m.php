<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_pelanggan($keyword, $id_klien){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $where = "1=1";
        if($keyword != "" || $keyword != null){
            $where = $where." AND NAMA_PELANGGAN LIKE '%$keyword%' ";
        }

        $where_unit = "1=1";
        if($user->LEVEL == "ADMIN"){
            $where_unit = "1=1";
        } else {
            $where_unit = "UNIT = ".$user->UNIT;
        }

        $sql = "
        SELECT * FROM ak_pelanggan
        WHERE $where AND $where_unit
        ORDER BY APPROVE ASC, ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_pelanggan($id){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        if($user->LEVEL == 'USER'){
            $sql = "UPDATE ak_pelanggan SET APPROVE = 2 WHERE ID = '$id'";
            $this->db->query($sql);
        } else {
            $sql = " DELETE FROM ak_pelanggan WHERE ID = $id"; 
            $this->db->query($sql);
        }
    }

    function cari_pelanggan_by_id($id){
        $sql = "
        SELECT p.* , tb.NAMA_BANK , tb.NOMOR_REKENING FROM ak_pelanggan p , tb_rekening_bank tb WHERE p.REKENING = tb.ID AND p.ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_pelanggan_dup($id){
        $sql = "
        SELECT * FROM ak_pelanggan WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function get_master_tipe(){
        $sql = "
        SELECT * FROM ak_master_tipe
        ";

        return $this->db->query($sql)->result();
    }

    function supply_kenter(){
        $sql = "
        SELECT * FROM ak_gudang
        ";

        return $this->db->query($sql)->result();
    }


    function simpan_pelanggan($id_klien,$kode_pelanggan, $nama_pelanggan, $npwp, $alamat_tagih, $alamat_kirim, $no_telp, $no_hp, $email, $tipe, $nama_usaha, $tdp, $siup, $unit, $wilayah, $limit_beli,$ppn,$pph_23 ,$pph_15,$pajak_pbbkb,$kode_customer,$lokasi,$pph_21,$supply_point,$aksi_on,$oat,$tipe_perusahaan,$pph_22,$rek_bank){
        $tgl = date('d-m-Y');
        $jam = date('H:i');
        $waktu = $tgl.", ".$jam;

        if($npwp == "" || $npwp == null){
            $npwp = "-";
        }

        if($no_telp == "" || $no_telp == null){
            $no_telp = "-";
        }

        if($no_hp == "" || $no_hp == null){
            $no_hp = "-";
        }

        if($email == "" || $email == null){
            $email = "-";
        }

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 0;
        }

        $sql = "
        INSERT INTO ak_pelanggan
        (ID_KLIEN,KODE_PELANGGAN, NAMA_PELANGGAN, NPWP, ALAMAT_TAGIH, ALAMAT_KIRIM, NO_TELP, NO_HP, EMAIL, WAKTU, WAKTU_EDIT, TIPE, NAMA_USAHA, TDP, SIUP, APPROVE, UNIT, WILAYAH, LIMIT_BIAYA,PPN,PPH23,PPH15,PAJAK_PBBKB,KODE_CUSTOMER,LOKASI,PPH_21,ID_SUPPLY_POINT,ID_PAJAK_PBBKB,OAT,PPH_22,REKENING)
        VALUES 
        ($id_klien,'$kode_pelanggan', '$tipe_perusahaan.$nama_pelanggan', '$npwp', '$alamat_tagih', '$alamat_kirim', '$no_telp', '$no_hp', '$email', '$waktu', '-', '$tipe', '$nama_usaha', '$tdp', '$siup', '$approve', '$unit', '$wilayah','$limit_beli','$ppn','$pph_23' ,'$pph_15','$pajak_pbbkb','$kode_customer','$lokasi','$pph_21','$supply_point','$aksi_on','$oat','$pph_22','$rek_bank')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_pelanggan($id_pelanggan, $nama_pelanggan_ed, $npwp_ed, $alamat_tagih_ed, $alamat_kirim_ed, $no_telp_ed, $no_hp_ed, $email_ed, $tipe_ed, $nama_usaha_ed, $tdp_ed, $siup_ed,$ppn,$pph_23,$pph_15,$pph_21,$oat,$pph_22){

        $tgl = date('d-m-Y');
        $jam = date('H:i');
        $waktu = $tgl.", ".$jam;

        if($npwp_ed == "" || $npwp_ed == null){
            $npwp_ed = "-";
        }

        if($no_telp_ed == "" || $no_telp_ed == null){
            $no_telp_ed = "-";
        }

        if($no_hp_ed == "" || $no_hp_ed == null){
            $no_hp_ed = "-";
        }

        if($email_ed == "" || $email_ed == null){
            $email_ed = "-";
        }

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
        UPDATE ak_pelanggan SET 
        NAMA_PELANGGAN = '$nama_pelanggan_ed', NPWP = '$npwp_ed', ALAMAT_TAGIH = '$alamat_tagih_ed', ALAMAT_KIRIM = '$alamat_kirim_ed', NO_TELP = '$no_telp_ed',
        NO_HP = '$no_hp_ed', EMAIL = '$email_ed', WAKTU_EDIT = '$waktu', TIPE = '$tipe_ed', NAMA_USAHA = '$nama_usaha_ed', TDP = '$tdp_ed', SIUP = '$siup_ed', APPROVE = '$approve' , PPN = '$ppn' , PPH23 = '$pph_23' , PPH15 = '$pph_15' , PPH_21 = '$pph_21' , OAT = '$oat' , PPH_22 = '$pph_22'
        WHERE ID = $id_pelanggan
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

    function simpan_master_harga($kode_pelanggan,$nama_pelanggan,$value,$nama_produk,$harga_beli,$harga_jual){
        $sql = "
        INSERT INTO ak_master_harga 
        (ID_PELANGGAN, NAMA_PELANGGAN, ID_PRODUK, NAMA_PRODUK, HARGA_BELI, HARGA_JUAL, STATUS,CREATED_AT)
        VALUES 
        ('$kode_pelanggan', '$nama_pelanggan', '$value', '$nama_produk', '$harga_beli', '$harga_jual', '0',CURDATE())
        ";

        $this->db->query($sql);

    }

    function simpan_supply($kode_pelanggan,$nama){
        $sql = "
        INSERT INTO tb_pelanggan_supply 
        (ID_SUPPLY_POINT, ID_PELANGGAN)
        VALUES 
        ('$nama', '$kode_pelanggan')
        ";

        $this->db->query($sql);

    }

    function insert_pelanggan_supply($id_sp,$kode_sh){
        $sql = "
        INSERT INTO tb_pelanggan_supply 
        (ID_SUPPLY_POINT, ID_PELANGGAN)
        VALUES 
        ('$id_sp', '$kode_sh')
        ";

        $this->db->query($sql);

    }

    function update_pelanggan_supply($id_sp,$id){
        $sql = "
        UPDATE tb_pelanggan_supply SET  
        ID_SUPPLY_POINT = '$id_sp' WHERE ID = '$id'
        ";

        $this->db->query($sql);

    }

}

?>