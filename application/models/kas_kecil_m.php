<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kas_kecil_m extends CI_Model
{
    function __construct() {
          parent::__construct();
          $this->load->database();
    }

    function get_penjualan($keyword, $id_klien){

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
        $sql = "
        SELECT * FROM ak_kas_kecil 
        ORDER BY ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_penjualan_filter($keyword, $id_klien, $tgl_awal, $tgl_akhir){


        $where = "1 = 1";
        $where = $where." AND STR_TO_DATE(TGL,'%d-%m-%Y') >= STR_TO_DATE('$tgl_awal','%d-%m-%Y')  AND STR_TO_DATE(TGL,'%d-%m-%Y') <= STR_TO_DATE('$tgl_akhir','%d-%m-%Y')";

        $sql = "
        SELECT * FROM ak_kas_kecil 
        WHERE $where
        ORDER BY ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_trx($no_voucher){
        $sql = "
        SELECT a.*, b.NAMA_AKUN FROM ak_input_voucher a 
        LEFT JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN
        WHERE NO_VOUCHER = '$no_voucher'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($no_voucher){
        $sql = "
        SELECT a.* FROM ak_input_voucher_detail a
        WHERE NO_VOUCHER_DETAIL = '$no_voucher' AND DEBET > 0
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_trxx_detail($id){
        $sql = "
        SELECT * FROM ak_pembelian_new_detail 
        WHERE ID_PENJUALAN = '$id'
        ";

        return $this->db->query($sql)->result();
    }

    function get_PO_detail($id){
        $sql = "
        SELECT * FROM ak_pembelian 
        WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_PO_detail2($id){
        $sql = "
        SELECT * FROM ak_pembelian_detail 
        WHERE ID_PENJUALAN = '$id'
        ";

        return $this->db->query($sql)->result();
    }

    function hapus_voucher($id_klien, $no_voc){
        $sql_1 = "
        DELETE FROM ak_input_voucher WHERE NO_VOUCHER = '$no_voc' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_1);

        $sql_2 = "
        DELETE FROM ak_input_voucher_detail WHERE NO_VOUCHER_DETAIL = '$no_voc' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_2);

        $sql_3 = "
        DELETE FROM ak_jurnal_kas_bank WHERE NO_VOUCHER = '$no_voc' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_3);
    }

    function hapus_trx_penjualan($id_hapus){
        $sql_1 = "
        DELETE FROM ak_kas_kecil WHERE ID = $id_hapus
        ";

        $this->db->query($sql_1);
    }

    

    function get_kas_bank2($keyword, $id_klien){
        $where = "1=1";
        if($keyword != "" || $keyword != null){
            $where = $where." AND (KODE_AKUN LIKE '%$keyword%' OR NAMA_AKUN LIKE '%$keyword%' ) ";
        }

        $sql = "
        SELECT a.*, IFNULL(b.TOTAL, 0) AS TOTAL FROM ak_kode_akuntansi a
        LEFT JOIN (
            SELECT a.KODE_AKUN, (a.DEBET - a.KREDIT) AS TOTAL FROM (
                SELECT KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT
                FROM ak_penerimaan_kas_bank WHERE ID_KLIEN = $id_klien
                GROUP BY KODE_AKUN
            ) a
        ) b ON a.KODE_AKUN = b.KODE_AKUN
        WHERE $where AND a.ID_KLIEN = $id_klien AND a.KATEGORI = 'Credit Card'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_produk($id){
        $sql = "
        DELETE FROM ak_produk WHERE ID = $id
        ";

        $this->db->query($sql);
    }

    function cari_produk_by_id($id){
        $sql = "
        SELECT * FROM ak_produk WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }


    function simpan_akun($id_klien, $nama_akun, $nomor_akun, $deskripsi, $kategori){
        $sql = "
            INSERT INTO ak_kode_akuntansi
            (ID_KLIEN, KODE_AKUN, NAMA_AKUN, KATEGORI, DESKRIPSI)
            VALUES 
            ($id_klien, '$nomor_akun', '$nama_akun', '$kategori', '$deskripsi')
        ";

        $this->db->query($sql);
    }

    function get_last_kas_bank($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien AND KATEGORI = 'Kas & Bank'
        ORDER BY ID DESC LIMIT 1
        ";

        return $this->db->query($sql)->row();
    }

    function get_last_cc($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien AND KATEGORI = 'Credit Card'
        ORDER BY ID DESC LIMIT 1
        ";

        return $this->db->query($sql)->row();
    }

    function get_list_akun($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien AND (KATEGORI = 'Kas & Bank' OR KATEGORI = 'Credit Card')
        ";

        return $this->db->query($sql)->result();
    }

    function get_list_akun_all($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien
        ";

        return $this->db->query($sql)->result();
    }

    function get_pel_sup($id_klien){
        $sql = "
        SELECT ID, NAMA_PELANGGAN AS NAMA FROM ak_pelanggan
        WHERE ID_KLIEN = $id_klien
        ";

        return $this->db->query($sql)->result();
    }

    function get_no_trx_penjualan($id_klien){
        $sql = "
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'KK'
        ";

        return $this->db->query($sql)->row();
    }

    function save_next_nomor($id_klien, $tipe, $no_trx){
        $sql_del = "
        DELETE FROM ak_nomor WHERE TIPE = '$tipe' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_del);

        $sql = "
        INSERT INTO ak_nomor 
        (ID_KLIEN, TIPE, NEXT)
        VALUES 
        ($id_klien, '$tipe', $no_trx)
        ";

        $this->db->query($sql);
    }

    function simpan_kas_bank($id_klien, $kode_akun_setor, $yang_membayar, $tgl_trx, $no_trx, $total_all){
        $sql = "
        INSERT INTO ak_penerimaan_kas_bank
        (ID_KLIEN, KODE_AKUN, NO_BUKTI, TGL, DEBET, KREDIT, TIPE, KONTAK)
        VALUES 
        ($id_klien, '$kode_akun_setor', '$no_trx', '$tgl_trx', $total_all, 0, 'PENERIMAAN', '$yang_membayar')
        ";

        $this->db->query($sql);
    }


    function get_id_kas_bank($id_klien, $no_trx){
        $sql  = "
        SELECT * FROM ak_penerimaan_kas_bank WHERE ID_KLIEN = $id_klien AND NO_BUKTI = '$no_trx'
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_kas_bank_detail($id_klien, $id_kas_bank, $no_trx, $kode_akun, $deskripsi, $nilai){
        
        $nilai = str_replace(',', '', $nilai);
        $deskripsi = addslashes($deskripsi);

        $sql = "
        INSERT INTO ak_penerimaan_kas_bank_detail
        (ID_KAS_BANK, ID_KLIEN, NO_BUKTI, KODE_AKUN, DESKRIPSI, NILAI)
        VALUES 
        ($id_kas_bank, $id_klien, '$no_trx', '$kode_akun', '$deskripsi', $nilai)
        ";

        $this->db->query($sql);
    }

    function proses_trf_bank_1($id_klien, $trf_dari, $no_trx, $tgl_trx, $nilai_trf, $memo){
        $sql = "
        INSERT INTO ak_penerimaan_kas_bank 
        (ID_KLIEN, KODE_AKUN, NO_BUKTI, TGL, DEBET, KREDIT, DESKRIPSI, TIPE)
        VALUES 
        ($id_klien, '$trf_dari', '$no_trx', '$tgl_trx', 0, $nilai_trf, '$memo', 'TRANSFER UANG')
        ";

        $this->db->query($sql);
    }

    function proses_trf_bank_2($id_klien, $trf_dari, $no_trx, $tgl_trx, $nilai_trf, $memo){
        $sql = "
        INSERT INTO ak_penerimaan_kas_bank 
        (ID_KLIEN, KODE_AKUN, NO_BUKTI, TGL, DEBET, KREDIT, DESKRIPSI, TIPE)
        VALUES 
        ($id_klien, '$trf_dari', '$no_trx', '$tgl_trx', $nilai_trf, 0, '$memo', 'TRANSFER UANG')
        ";

        $this->db->query($sql);
    }

    function simpan_kas_bank_kirim_uang($id_klien, $kode_akun_setor, $yang_membayar, $tgl_trx, $no_trx, $total_all){
        $sql = "
        INSERT INTO ak_penerimaan_kas_bank
        (ID_KLIEN, KODE_AKUN, NO_BUKTI, TGL, DEBET, KREDIT, TIPE, KONTAK)
        VALUES 
        ($id_klien, '$kode_akun_setor', '$no_trx', '$tgl_trx', 0, $total_all, 'PENERIMAAN', '$yang_membayar')
        ";

        $this->db->query($sql);
    }

    function get_pelanggan_detail($id_pel){
        $sql = "
        SELECT * FROM ak_pelanggan WHERE ID = $id_pel
        ";

        return $this->db->query($sql)->row();
    }

    function get_all_produk($id_klien){
        $sql = "
        SELECT * FROM ak_produk WHERE ID_KLIEN = $id_klien
        ";

        return $this->db->query($sql)->result();
    }

    function get_produk_detail($id_produk){
        $sql = "
        SELECT * FROM ak_produk WHERE ID = $id_produk
        ";

        return $this->db->query($sql)->row();
    }

    function get_pajak($id_klien){
        $sql = "
        SELECT * FROM ak_setup_pajak WHERE ID_KLIEN = $id_klien ORDER BY ID
        ";

        return $this->db->query($sql)->result();
    }

    function get_pajak_prosen($id_pajak){
        $sql = "
        SELECT * FROM ak_setup_pajak WHERE ID = $id_pajak
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_penjualan($no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $kota_tujuan, $no_po, $no_do, $tgl_trx, $keterangan, $jatuh_tempo, $no_pol, $sopir, $alat_angkut, $segel_atas, $segel_bawah, $broker, $temperatur, $density, $flash_point, $water_content, $tgl_do, $tgl_sj, $tgl_inv, $tgl_kwi, $operator,$atas_nama, $transport, $tgl_ambil)
    {

        $sql = "
        INSERT INTO ak_pembelian_new
        (
            NO_BUKTI,
            ID_PELANGGAN,
            PELANGGAN,
            ALAMAT_TUJUAN,
            KOTA,
            NO_PO,
            NO_DO,
            TGL_TRX,
            KETERANGAN,
            JATUH_TEMPO,
            NO_POL,
            SOPIR,
            ALAT_ANGKUT,
            SEGEL_ATAS,
            SEGEL_BAWAH,
            BROKER,
            TEMPERATUR,
            DENSITY,
            FLASH_POINT,
            WATER_CONTENT,
            TGL_DO,
            TGL_SJ,
            TGL_INV,
            TGL_KWI,
            OPERATOR,
            ATAS_NAMA,
            TRANSPORT,
            TGL_PENGAMBILAN
        )
        VALUES 
        (
           '$no_trx', 
           '$id_pelanggan', 
           '$pelanggan', 
           '$alamat_tagih', 
           '$kota_tujuan', 
           '$no_po', 
           '$no_do', 
           '$tgl_trx', 
           '$keterangan', 
           '$jatuh_tempo', 
           '$no_pol', 
           '$sopir', 
           '$alat_angkut', 
           '$segel_atas', 
           '$segel_bawah', 
           '$broker', 
           '$temperatur', 
           '$density', 
           '$flash_point', 
           '$water_content', 
           '$tgl_do', 
           '$tgl_sj', 
           '$tgl_inv', 
           '$tgl_kwi', 
           '$operator',
           '$atas_nama', 
           '$transport',
           '$tgl_ambil'
        )
        ";

        $this->db->query($sql);
    }

    function ubah_penjualan($id, $no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $tgl_trx, $tgl_jatuh_tempo, $id_pajak, $sub_total, $pajak_total, $total_all, $sts_lunas, $memo_lunas, $akun_piutang, $kode_akun_pajak){
         $sql = "
            UPDATE ak_pembelian_new SET ID_PELANGGAN = $id_pelanggan, PELANGGAN = '$pelanggan', ALAMAT = '$alamat_tagih', TGL_TRX = '$tgl_trx', ID_PAJAK = $id_pajak, SUB_TOTAL = $sub_total, NILAI_PAJAK = $pajak_total,
            TOTAL = $total_all, LUNAS = $sts_lunas, MEMO = '$memo_lunas', KODE_AKUN_PIUTANG = '$akun_piutang', KODE_AKUN_PAJAK = '$kode_akun_pajak'    
            WHERE ID = $id

        ";

        $this->db->query($sql);
    }

    function update_nilai_voucher($no_trx, $nilai_total){
        $nilai_total = str_replace(',', '', $nilai_total);
        $sql = "
        UPDATE ak_input_voucher SET KREDIT = '$nilai_total'
        WHERE NO_VOUCHER = '$no_trx'
        ";
        $this->db->query($sql);
    }

    function ubah_pembelian_new($id,$no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $kota_tujuan, $no_po, $no_do, $tgl_trx, $keterangan, $jatuh_tempo, $no_pol, $sopir, $alat_angkut, $segel_atas, $segel_bawah, $broker, $temperatur, $density, $flash_point, $water_content, $tgl_do, $tgl_sj, $tgl_inv, $tgl_kwi, $operator,$atas_nama, $transport, $tgl_ambil){
         $sql = "
            UPDATE ak_pembelian_new SET 

            NO_BUKTI = '$no_trx' ,
            ID_PELANGGAN = '$id_pelanggan',
            PELANGGAN = '$pelanggan',
            ALAMAT_TUJUAN = '$alamat_tagih',
            KOTA = '$kota_tujuan',
            NO_PO = '$no_po',
            NO_DO = '$no_do',
            TGL_TRX = '$tgl_trx',
            KETERANGAN = '$keterangan',
            JATUH_TEMPO = '$jatuh_tempo',
            NO_POL = '$no_pol',
            SOPIR = '$sopir',
            ALAT_ANGKUT = '$alat_angkut',
            SEGEL_ATAS = '$segel_atas',
            SEGEL_BAWAH = '$segel_bawah',
            BROKER = '$broker',
            TEMPERATUR = '$temperatur',
            DENSITY = '$density',
            FLASH_POINT = '$flash_point',
            WATER_CONTENT = '$water_content',
            TGL_DO = '$tgl_do',
            TGL_SJ = '$tgl_sj',
            TGL_INV = '$tgl_inv',
            TGL_KWI = '$tgl_kwi',
            OPERATOR = '$operator',
            ATAS_NAMA = '$atas_nama',
            TRANSPORT = '$transport',
            TGL_PENGAMBILAN = '$tgl_ambil'
             
            WHERE ID = '$id'

        ";

        $this->db->query($sql);
    }

    function get_id_penjualan($id_klien, $no_trx){
        $sql = "
        SELECT * FROM ak_penjualan WHERE ID_KLIEN = $id_klien AND NO_BUKTI = '$no_trx'
        ORDER BY ID DESC LIMIT 1
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_detail_penjualan_kasbank($no_voucher, $no_reff, $kode_akun, $ket, $debet, $kredit){
        
        $debet   = str_replace(',', '', $debet);
        $kredit   = str_replace(',', '', $kredit);
        $ket     = addslashes($ket); 

        $sql = "
        INSERT INTO ak_input_voucher_detail 
        (
        NO_VOUCHER_DETAIL,
        KODE_AKUN,
        DEBET,
        KREDIT,
        NO_BUKTI,
        KET
        )
        VALUES 
        (
        '$no_voucher',
        '$kode_akun', 
        '$debet', 
        '$kredit', 
        '$no_reff',
        '$ket'
        )
        ";

        $this->db->query($sql);
    }

    function simpan_detail_penjualan($no_voucher, $no_reff, $kode_akun, $ket, $nilai){
        
        $nilai   = str_replace(',', '', $nilai);
        $ket     = addslashes($ket); 

        $sql = "
        INSERT INTO ak_input_voucher_detail 
        (
            NO_VOUCHER_DETAIL,
            KODE_AKUN,
            DEBET,
            KREDIT,
            NO_BUKTI,
            KET
        )
        VALUES 
        (
        '$no_voucher',
        '$kode_akun', 
        '$nilai', 
        '0', 
        '$no_reff',
        '$ket'
        )
        ";

        $this->db->query($sql);
    }

    function simpan_piutang($id_klien, $no_trx, $tgl_trx, $total_all, $tipe){

        $total_all       = str_replace(',', '', $total_all);
        $sql = "
        INSERT INTO ak_hutang_piutang 
        (ID_KLIEN, NO_BUKTI, TGL, KODE_AKUN, DEBET, KREDIT, TIPE)
        VALUES 
        ($id_klien, '$no_trx', '$tgl_trx', '1-1200', $total_all, 0, '$tipe')
        ";

        $this->db->query($sql);
    }

    function simpan_ke_trx_akuntansi_detail($id_klien, $kode_akun, $sub_total, $no_trx){
        $sub_total       = str_replace(',', '', $sub_total);
        $sql = "
        INSERT INTO ak_input_voucher_detail 
        (ID_KLIEN, KODE_AKUN, DEBET, KREDIT, NO_BUKTI)
        VALUES 
        ($id_klien, '$kode_akun', 0, $sub_total, '$no_trx')
        ";

        $this->db->query($sql);
    }

    function hapus_detail_trx($id){
        $sql = "
        DELETE FROM ak_pembelian_new_detail WHERE ID_PENJUALAN = '$id'
        ";

        $this->db->query($sql);
    }

    function hapus_detail_cust($id){
        $sql = "
        DELETE FROM ak_pembelian_customer WHERE ID_PEMBELIAN = '$id'
        ";

        $this->db->query($sql);
    }

    function update_stok($id_klien, $id_produk, $qty){
        $qty          = str_replace(',', '', $qty);
        $sql = "
        UPDATE ak_produk SET STOK = STOK - $qty
        WHERE ID = $id_produk
        ";

        $this->db->query($sql);
    }

    function get_broker(){
        $sql = "
        SELECT * FROM ak_broker
        ORDER BY ID DESC 
        ";

        return $this->db->query($sql)->result();
    }

}

?>