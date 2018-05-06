<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_jurnal_bayar_kas_m extends CI_Model
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
        SELECT a.* FROM ak_kode_akuntansi a 
        JOIN ak_grup_kode_akun b ON a.KODE_GRUP = b.KODE_GRUP
        WHERE b.ID = 1
        ORDER BY a.KODE_AKUN
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

    function get_no_trx_penjualan($id_klien){
        $sql = "
        SELECT * FROM ak_nomor WHERE TIPE = 'HUTANG'
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_pelunasan_hutang($no_hutang, $no_bukti, $tgl_cek, $id_atas_nama, $atas_nama, $kode_akun_add, $nominal){
        $sql = "
        INSERT INTO ak_pelunasan_hutang 
            (NO_HUTANG, NO_BUKTI, KODE_AKUN, NILAI, TGL, ID_ATAS_NAMA, ATAS_NAMA)
        VALUES 
            ('$no_hutang', '$no_bukti', '$kode_akun_add', '$nominal', '$tgl_cek', '$id_atas_nama', '$atas_nama')
        ";

         $this->db->query($sql);
    }

    function update_no_bukti($no_bukti, $no_hutang){
        $sql = "
        UPDATE ak_input_voucher SET 
            NO_HUTANG = '$no_hutang',
            IS_LUNAS = 1
        WHERE NO_VOUCHER = '$no_bukti'
        ";

         $this->db->query($sql);
    }

    function simpan_trx_akuntansi($id_klien, $no_trx_akun, $no_bukti, $total_debet_all, $total_kredit_all, $tgl_trx, $tipe, $kontak, $uraian){
        $total_debet_all   = str_replace(',', '', $total_debet_all);
        $total_kredit_all  = str_replace(',', '', $total_kredit_all);

        $sql = "
        INSERT INTO ak_input_voucher 
            (ID_KLIEN, NO_VOUCHER, NO_BUKTI, TGL, DEBET, KREDIT, URAIAN, KONTAK, TIPE)
        VALUES 
            ($id_klien, '$no_trx_akun', '$no_bukti', '$tgl_trx', $total_debet_all, $total_kredit_all, '$uraian', '$kontak', '$tipe')
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

    function simpan_jbk($id_klien, $no_trx_akun, $no_giro, $kode_akun, $tgl_cek, $debet, $kredit, $uraian, $atas_nama, $sisa_hutang, $unit){
        $sql = "
        INSERT INTO ak_jurnal_kas_bank
        (ID_KLIEN, NO_VOUCHER, CEK_GIRO, KODE_AKUN, TGL_CEK, DEBET, KREDIT, URAIAN, KONTAK, SISA_HUTANG, UNIT, TIPE)
        VALUES 
        ($id_klien, '$no_trx_akun', '$no_giro', '$kode_akun', '$tgl_cek', $debet, $kredit, '$uraian', '$atas_nama', $sisa_hutang, '$unit' , 'HUTANG')
        ";

        $this->db->query($sql);
    }

    
}

?>