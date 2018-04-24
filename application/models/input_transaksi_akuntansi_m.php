<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_transaksi_akuntansi_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_list_akun_all($id_klien){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user  = $sess_user['id'];
        $user     = $this->master_model_m->get_user_info($id_user);

        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE  UNIT = '$user->UNIT'
        ORDER BY KODE_AKUN
        ";

        return $this->db->query($sql)->result();
    }

    function get_no_trx_akun($id_klien){

        $bln = date('m');
        $thn = date('Y');

        $sql = "
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'TRANSAKSI_AKUN' AND BULAN = $bln AND TAHUN = $thn
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_trx_akuntansi($id_klien, $no_trx_akun, $no_bukti, $total_debet_all, $total_kredit_all, $tgl_trx, $tipe, $kontak, $uraian, $unit){
        $total_debet_all   = str_replace(',', '', $total_debet_all);
        $total_kredit_all  = str_replace(',', '', $total_kredit_all);

        $sql = "
        INSERT INTO ak_input_voucher 
            (ID_KLIEN, NO_VOUCHER, NO_BUKTI, TGL, DEBET, KREDIT, URAIAN, KONTAK, TIPE, UNIT)
        VALUES 
            ($id_klien, '$no_trx_akun', '$no_bukti', '$tgl_trx', $total_debet_all, $total_kredit_all, '$uraian', '$kontak', '$tipe', '$unit')
        ";

         $this->db->query($sql);

    }

    function ubah_trx_akuntansi($id_klien, $no_trx_akun, $no_bukti, $total_debet_all, $total_kredit_all, $tgl_trx, $tipe, $kontak, $uraian){

        $sql = "
        UPDATE ak_input_voucher SET TGL = '$tgl_trx', URAIAN = '$uraian'
        WHERE ID_KLIEN = $id_klien AND NO_VOUCHER = '$no_trx_akun'
        ";

         $this->db->query($sql);

    }

    function delete_detail_voucher($id_klien, $no_trx_akun){
        $sql = "
        DELETE FROM ak_input_voucher_detail WHERE ID_KLIEN = $id_klien AND NO_VOUCHER_DETAIL = '$no_trx_akun'
        ";

        $this->db->query($sql);
    }


    function simpan_trx_akuntansi_detail($id_klien, $no_trx_akun, $kode_akun, $debet_row, $kredit_row, $no_bukti){
        $debet_row   = str_replace(',', '', $debet_row);
        $kredit_row  = str_replace(',', '', $kredit_row);

        $sql = "
        INSERT INTO ak_input_voucher_detail
            (ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, DEBET, KREDIT, NO_BUKTI)
        VALUES 
            ($id_klien, '$no_trx_akun', '$kode_akun', $debet_row, $kredit_row, '$no_bukti')
        ";

         $this->db->query($sql);
    }

    function repair_detail_voucher($id_klien, $no_trx_akun, $no_bukti){
        $sql = "
        UPDATE ak_input_voucher_detail SET NO_VOUCHER_DETAIL = '$no_trx_akun'
        WHERE ID_KLIEN = $id_klien AND NO_BUKTI = '$no_bukti'
        ";

        $this->db->query($sql);
    }

    function save_next_nomor($id_klien, $tipe, $no_trx){

        $bln = date('m');
        $thn = date('Y');

        $sql_del = "
        DELETE FROM ak_nomor WHERE TIPE = '$tipe' AND ID_KLIEN = $id_klien AND BULAN = $bln AND TAHUN = $thn
        ";

        $this->db->query($sql_del);

        $sql = "
        INSERT INTO ak_nomor 
        (ID_KLIEN, TIPE, NEXT, BULAN, TAHUN)
        VALUES 
        ($id_klien, '$tipe', $no_trx, $bln, $thn)
        ";

        $this->db->query($sql);
    }

    function update_penjualan_pembelian($id_klien, $no_bukti, $no_trx_akun){
        $sql = "
        UPDATE ak_pembelian SET NO_TRX_AKUN = '$no_trx_akun'
        WHERE ID_KLIEN = $id_klien AND NO_BUKTI = '$no_bukti'
        ";

        $this->db->query($sql);

        $sql_2 = "
        UPDATE ak_penjualan SET NO_TRX_AKUN = '$no_trx_akun'
        WHERE ID_KLIEN = $id_klien AND NO_BUKTI = '$no_bukti'
        ";

        $this->db->query($sql_2);

        $sql_3 = "
        UPDATE ak_transaksi_lainnya SET NO_TRX_AKUN = '$no_trx_akun'
        WHERE ID_KLIEN = $id_klien AND NO_BUKTI = '$no_bukti'
        ";

        $this->db->query($sql_3);
    }

    function simpan_piutang($id_klien, $no_trx, $tgl_trx, $total_all, $tipe){

        $total_all       = str_replace(',', '', $total_all);
        $sql = "
        INSERT INTO ak_hutang_piutang 
        (ID_KLIEN, NO_BUKTI, TGL, KODE_AKUN, DEBET, KREDIT, TIPE)
        VALUES 
        ($id_klien, '$no_trx', '$tgl_trx', '1-1200', 0, $total_all, '$tipe')
        ";

        $this->db->query($sql);
    }

    function simpan_hutang($id_klien, $no_trx, $tgl_trx, $total_all, $tipe){

        $total_all       = str_replace(',', '', $total_all);
        $sql = "
        INSERT INTO ak_hutang_piutang 
        (ID_KLIEN, NO_BUKTI, TGL, KODE_AKUN, DEBET, KREDIT, TIPE)
        VALUES 
        ($id_klien, '$no_trx', '$tgl_trx', '2-2000', $total_all, 0, '$tipe')
        ";

        $this->db->query($sql);
    }

    function get_nilai_hutang_piutang($id_klien, $no_bukti, $tipe){
        $sql = "
        SELECT * FROM ak_hutang_piutang WHERE ID_KLIEN = $id_klien AND NO_BUKTI = '$no_bukti' AND TIPE = '$tipe'
        ";

        return $this->db->query($sql)->row();
    }

    function hapus_voucher($id_klien, $no_voucher_hps){
        $sql_1 = "
        DELETE FROM ak_input_voucher WHERE NO_VOUCHER = '$no_voucher_hps' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_1);

        $sql_2 = "
        DELETE FROM ak_input_voucher_detail WHERE NO_VOUCHER_DETAIL = '$no_voucher_hps' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_2);

        $sql_3 = "
        DELETE FROM ak_jurnal_penye WHERE NO_VOUCHER = '$no_voucher_hps' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_3);

        $sql_4 = "
        DELETE FROM ak_jurnal_penye_detail WHERE NO_VOUCHER = '$no_voucher_hps' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_4);

        $sql_5 = "
        DELETE FROM ak_jurnal_kas_bank WHERE NO_VOUCHER = '$no_voucher_hps' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_5);

        $sql_6 = "
        UPDATE ak_pembelian SET NO_TRX_AKUN = NULL WHERE ID_KLIEN = $id_klien AND NO_TRX_AKUN = '$no_voucher_hps'
        ";

        $this->db->query($sql_6);

        $sql_7 = "
        UPDATE ak_penjualan SET NO_TRX_AKUN = NULL WHERE ID_KLIEN = $id_klien AND NO_TRX_AKUN = '$no_voucher_hps'
        ";

        $this->db->query($sql_7);
    }

    
}

?>