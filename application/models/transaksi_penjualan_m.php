<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_penjualan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_supplier(){
        $sql = "SELECT * FROM ak_supplier ORDER BY ID";
        return $this->db->query($sql)->result();
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
        // if($keyword != "" || $keyword != null){
        //     $where = $where." AND (a.KODE_AKUN LIKE '%$keyword%' OR a.NAMA_AKUN LIKE '%$keyword%' ) ";
        // }

        $sql = "
        SELECT * FROM ak_penjualan
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function supply($id){
        $sql = "
        SELECT * FROM ak_gudang
        ";

        return $this->db->query($sql)->result();
    }

    function get_penjualan_invoice($keyword, $id_klien){

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
        // if($keyword != "" || $keyword != null){
        //     $where = $where." AND (a.KODE_AKUN LIKE '%$keyword%' OR a.NAMA_AKUN LIKE '%$keyword%' ) ";
        // }

        $sql = "
        SELECT * FROM ak_penjualan WHERE STATUS_INV = '1'
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_penjualan_invoice_baru($keyword, $id_klien){

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
        // if($keyword != "" || $keyword != null){
        //     $where = $where." AND (a.KODE_AKUN LIKE '%$keyword%' OR a.NAMA_AKUN LIKE '%$keyword%' ) ";
        // }

        $sql = "
        SELECT a.*, b.ID AS ID_PENJUALAN FROM ak_invoice a
        LEFT JOIN ak_penjualan b ON a.NOMER_INVOICE = b.NO_INV
        ORDER BY a.ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_penjualan_inv($id){

        

        $sql = "
        SELECT * FROM ak_invoice WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx($id){
        $sql = "
        SELECT * FROM ak_penjualan
        WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_inv($id){
        $sql = "
        SELECT * FROM ak_invoice
        WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
        $sql = "
        SELECT * FROM ak_penjualan_detail 
        WHERE ID_PENJUALAN = '$id'
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_trx_loses($id){
        $sql = "
        SELECT * FROM ak_penjualan
        WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail_loses($id){
        $sql = "
        SELECT * FROM ak_penjualan_detail 
        WHERE ID_PENJUALAN = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trxx_detail($id){
        $sql = "
        SELECT * FROM ak_penjualan_detail 
        WHERE ID_PENJUALAN = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail_a($id){
        $sql = "
        SELECT * FROM ak_penjualan_detail 
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
        DELETE FROM ak_penjualan WHERE ID = $id_hapus
        ";

        $this->db->query($sql_1);
    }

    function get_penjualan_filter($keyword, $id_klien, $tgl_awal, $tgl_akhir){


        $where = "1 = 1";
        $where = $where." AND STR_TO_DATE(TGL_TRX,'%d-%m-%Y') >= STR_TO_DATE('$tgl_awal','%d-%m-%Y')  AND STR_TO_DATE(TGL_TRX,'%d-%m-%Y') <= STR_TO_DATE('$tgl_akhir','%d-%m-%Y')";

        $sql = "
        SELECT * FROM ak_penjualan_new WHERE $where
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
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

    function get_so_detail($id){
        $sql = "
        SELECT * FROM ak_penjualan WHERE ID = $id
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
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'Penjualan'
        ";

        return $this->db->query($sql)->row();
    }

    function get_no_trx_pembelian($id_klien){
        $sql = "
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'Pembelian'
        ";

        return $this->db->query($sql)->row();
    }

    function get_no_trx_lpb($id_klien){
        $sql = "
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'Penerimaan_barang'
        ";

        return $this->db->query($sql)->row();
    }

    function get_no_trx_do($id_klien){
        $sql = "
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'Delivery_order'
        ";

        return $this->db->query($sql)->row();
    }

    function get_no_trx_inv($id_klien){
        $sql = "
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'Invoice'
        ";

        return $this->db->query($sql)->row();
    }

    function get_no_trx_sj($id_klien){
        $sql = "
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'Surat_jalan'
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
        SELECT g.NAMA as NAMA_GUDANG , g.ID as GUDANG_ID , ms.NAMA_BPPKB , ms.PAJAK , p.* , mh.HARGA_JUAL as HARGA_CUY , p.PPN as PPN_COY FROM ak_pelanggan p , ak_gudang g , ak_pajak_supply ms , ak_master_harga mh  WHERE p.ID_SUPPLY_POINT = g.ID AND p.KODE_PELANGGAN = mh.ID_PELANGGAN AND mh.status = '0' AND p.ID = $id_pel
        ";

        return $this->db->query($sql)->row();
    }

    function get_supplier_detail($id_pel){
        $sql = "
        SELECT * FROM ak_supplier WHERE ID = $id_pel
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

    function get_produk_detail_do($id_produk){
        $sql = "
        SELECT * FROM ak_delivery_order WHERE ID = $id_produk
        ";

        return $this->db->query($sql)->row();
    }

    function get_produk_detail_mh($id_produk){
        $sql = "
        SELECT pr.NAMA_PRODUK , mh.HARGA_JUAL , mh.ID_PRODUK , pr.ID as PRD FROM ak_master_harga mh , ak_produk pr WHERE mh.ID_PRODUK = pr.ID AND mh.ID = '$id_produk' 
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

    function simpan_penjualan_so($no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $tgl_trx, $sub_total, $keterangan, $ppn , $nilai_pph ,$nilai_pbbkb , $nilai_qty_total , $ppn_oat ,$no_po_pelanggan,$penampung_oat,$nomer_so,$qty_total,$tipe_so,$supply_point,$jatuh_tempo)
    {

        $sql = "
        INSERT INTO ak_penjualan
        (
            NO_BUKTI,
            ID_PELANGGAN,
            PELANGGAN,
            ALAMAT,
            TGL_TRX,
            SUB_TOTAL,
            TOTAL,
            MEMO,
            UNIT,
            PPN,
            PPH,
            PBBKB,
            OAT,
            STATUS_LPB,
            STATUS_DO,
            STATUS_PO,
            PO_PELANGGAN,
            NOMER_SO,
            SISA,
            KUANTITAS,
            TIPE_PENJUALAN,
            SUPPLY_POINT,
            JATUH_TEMPO,
            TUTUP_OUTSTANDING

        )
        VALUES 
        (
           '$no_trx', 
           '$id_pelanggan', 
           '$pelanggan', 
           '$alamat_tagih', 
           '$tgl_trx', 
           '$sub_total', 
           '0', 
           '$keterangan', 
           '13', 
           '$ppn', 
           '$nilai_pph', 
           '$nilai_pbbkb', 
           '$penampung_oat',
           '0',
           '0',
           '0',
           '$no_po_pelanggan',
           '$nomer_so',
           '$qty_total',
           '$qty_total',
           '$tipe_so',
           '$supply_point',
           '$jatuh_tempo',
           'Belum'
        )
        ";

        $this->db->query($sql);
    }

    function simpan_pembelian_po($no_po, $id_supplier, $supplier, $tgl_trx, $sub_total, $keterangan, $ppn , $nilai_pph ,$nilai_pbbkb , $no_so)
    {

        $sql = "
        INSERT INTO ak_pembelian
        (
            ID_KLIEN,
            NO_PO,
            ID_PELANGGAN,
            PELANGGAN,
            TGL_TRX,
            SUB_TOTAL,
            MEMO,
            UNIT,
            PPN,
            PPH,
            PBBKB,
            NO_SO

        )
        VALUES 
        (
           '13', 
           '$no_po', 
           '$id_supplier', 
           '$supplier', 
           '$tgl_trx', 
           '$sub_total', 
           '$keterangan',
           '13',
           '$ppn', 
           '$nilai_pph', 
           '$nilai_pbbkb', 
           '$no_so'
        )
        ";

        $this->db->query($sql);
    }

    function simpan_penerimaan_barang($no_lpbe, $id_supplier, $supplier, $keterangan, $no_po ,$nilai_pbbkb)
    {

        $sql = "
        INSERT INTO ak_penerimaan_barang
        (
            NO_BUKTI,
            ID_SUPPLIER,
            SUPPLIER,
            MEMO,
            NO_PO,
            PBBKB,
            STATUS

        )
        VALUES 
        (
           '$no_lpbe',
           '$id_supplier', 
           '$supplier', 
           '$keterangan',
           '$no_po',
           '$nilai_pbbkb', 
           '0'
        )
        ";

        $this->db->query($sql);
    }

    function simpan_delivery_order($no_deo, $id_pelanggan, $pelanggan, $nama_produk , $qty , $segel_atas ,$meter_atas,$no_pol,$segel_bawah,$meter_bawah,$nama_kapal,$temperatur,$sg_meter,$keterangan, $no_trx)
    {

        $sql = "
        INSERT INTO ak_delivery_order
        (
            NO_BUKTI,
            ID_PELANGGAN,
            PELANGGAN,
            PRODUK,
            QTY,
            SEGEL_ATAS,
            METER_AWAL,
            NO_KENDARAAN,
            SEGEL_BAWAH,
            METER_AKHIR,
            NAMA_KAPAL,
            TEMPERATUR,
            SG_METER,
            KETERANGAN,
            NO_SO,
            STATUS


        )
        VALUES 
        (
           '$no_deo',
           '$id_pelanggan', 
           '$pelanggan', 
           '$nama_produk',
           '$qty',
           '$segel_atas', 
           '$meter_atas', 
           '$no_pol', 
           '$segel_bawah', 
           '$meter_bawah', 
           '$nama_kapal', 
           '$temperatur', 
           '$sg_meter', 
           '$keterangan', 
           '$no_trx', 
           '0'
        )
        ";

        $this->db->query($sql);
    }

    function ubah_penjualan($id, $no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $tgl_trx, $tgl_jatuh_tempo, $id_pajak, $sub_total, $pajak_total, $total_all, $sts_lunas, $memo_lunas, $akun_piutang, $kode_akun_pajak){
         $sql = "
            UPDATE ak_penjualan SET ID_PELANGGAN = $id_pelanggan, PELANGGAN = '$pelanggan', ALAMAT = '$alamat_tagih', TGL_TRX = '$tgl_trx', ID_PAJAK = $id_pajak, SUB_TOTAL = $sub_total, NILAI_PAJAK = $pajak_total,
            TOTAL = $total_all, LUNAS = $sts_lunas, MEMO = '$memo_lunas', KODE_AKUN_PIUTANG = '$akun_piutang', KODE_AKUN_PAJAK = '$kode_akun_pajak'    
            WHERE ID = $id

        ";

        $this->db->query($sql);
    }

    function ubah_penjualan_detail($id,$no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $kota_tujuan, $no_po, $no_do, $tgl_trx, $keterangan, $jatuh_tempo, $no_pol, $sopir, $alat_angkut, $segel_atas, $segel_bawah, $broker, $temperatur, $density, $flash_point, $water_content, $tgl_do, $tgl_sj, $tgl_inv, $tgl_kwi, $operator){
         $sql = "
            UPDATE ak_penjualan_new SET 

                NO_BUKTI = '$no_trx', 
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
                OPERATOR ='$operator' 

            WHERE ID = $id

        ";

        $this->db->query($sql);
    }

    function ubah_penjualan_so($no_trx,$no_po_pelanggan, $keterangan, $hari_tempo,$tgl_trx){
        $sql = "
            UPDATE ak_penjualan SET
                PO_PELANGGAN = '$no_po_pelanggan',
                MEMO = '$keterangan',
                JATUH_TEMPO = '$hari_tempo',
                TGL_TRX = '$tgl_trx'
            WHERE ID = $no_trx
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

    function simpan_detail_penjualan($id_penjualan, $val, $kode_akun, $nama_produk, $qty, $harga_modal, $total_id){
        
        $qty            = str_replace(',', '', $qty);
        $harga_modal    = str_replace(',', '', $harga_modal);

        $sql = "
        INSERT INTO ak_penjualan_detail 
        (
            ID_KLIEN,
            ID_PENJUALAN,
            NAMA_PRODUK,
            QTY,
            SATUAN,
            HARGA_SATUAN,
            TOTAL,
            ID_PRODUK
        )
        VALUES 
        (
        '13',
        '$id_penjualan',
        '$nama_produk', 
        '$qty', 
        'LITER', 
        '$harga_modal', 
        '$total_id', 
        '$val'
        )
        ";

        $this->db->query($sql);
    }

    function simpan_detail_pembelian($id_penjualan, $val, $kode_akun, $nama_produk, $qty, $harga_modal, $total_id){
        
        $qty            = str_replace(',', '', $qty);
        $harga_modal    = str_replace(',', '', $harga_modal);

        $sql = "
        INSERT INTO ak_pembelian_detail 
        (
            ID_KLIEN,
            ID_PENJUALAN,
            NAMA_PRODUK,
            QTY,
            SATUAN,
            HARGA_SATUAN,
            TOTAL,
            ID_PRODUK
        )
        VALUES 
        (
        '13',
        '$id_penjualan',
        '$nama_produk', 
        '$qty', 
        'LITER', 
        '$harga_modal', 
        '$total_id', 
        '$val'
        )
        ";

        $this->db->query($sql);
    }

    function simpan_detail_penerimaan($id_penjualan, $val, $kode_akun, $nama_produk, $qty, $harga_modal, $total_id){
        
        $qty            = str_replace(',', '', $qty);
        $harga_modal    = str_replace(',', '', $harga_modal);

        $sql = "
        INSERT INTO ak_penerimaan_detail 
        (
            ID_KLIEN,
            ID_PENJUALAN,
            NAMA_PRODUK,
            QTY,
            SATUAN,
            HARGA_SATUAN,
            TOTAL,
            ID_PRODUK
        )
        VALUES 
        (
        '13',
        '$id_penjualan',
        '$nama_produk', 
        '$qty', 
        'LITER', 
        '$harga_modal', 
        '$total_id', 
        '$val'
        )
        ";

        $this->db->query($sql);
    }

    function ubah_detail_penjualan($id_penjualan, $id_produk, $kode_akun, $nama_produk, $qty, $harga_modal){
       
        $harga_modal    = str_replace(',', '', $harga_modal);
       

        $sql = "
        UPDATE ak_penjualan_detail SET HARGA_SATUAN = $harga_modal 
        WHERE ID_PENJUALAN = $id_penjualan
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

    function insert_tb_invoice($no_do,$no_trx,$no_invoice,$tgl_trx,$qty,$harga_modal,$pelanggan,$pelanggan_sel,$nama_produk,$qty_diterima,$tgl_jt){
        $qty       = str_replace(',', '', $qty);
        $sql = "
        INSERT INTO ak_invoice 
        (NOMER_DO, NOMER_SO, NOMER_INVOICE, TGL_TRX, QTY,HARGA_SATUAN,ID_CUSTOMER,CUSTOMER,NAMA_PRODUK,QTY_DITERIMA,TGL_JATUH_TEMPO)
        VALUES 
        ($no_do, '$no_trx', '$no_invoice', '$tgl_trx', '$qty','$harga_modal','$pelanggan','$pelanggan_sel','$nama_produk','$qty_diterima','$tgl_jt')
        ";

        $this->db->query($sql);
    }

    function hapus_detail_trx($id){
        $sql = "
        DELETE FROM ak_penjualan_detail WHERE ID_PENJUALAN = '$id'
        ";

        $this->db->query($sql);
    }

    function hapus_invoice($id){
        $sql = "
        DELETE FROM ak_invoice WHERE ID = '$id'
        ";

        $this->db->query($sql);
    }

    function update_status_standing($id_klien){
        
        $sql = "
        UPDATE ak_penjualan SET TUTUP_OUTSTANDING = 'Belum'
        WHERE NO_BUKTI = $id_klien
        ";

        $this->db->query($sql);
    }

    function edit_status($id_klien){
        
        $sql = "
        UPDATE ak_delivery_order SET STATUS = '0'
        WHERE NO_BUKTI = $id_klien
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

    function edit_status_invoice($no_invoice,$qty_diterima,$no_trx,$no_bukti_real,$sisa_so){

        if($sisa_so > 0){
            $statue = 'Konfirmasi';
        }else{
            $statue = 'Selesai';
        }
       
        $sql = "
        UPDATE ak_penjualan SET NO_INV = '$no_invoice' , QTY_DITERIMA = '$qty_diterima' , STATUS_INV = '1' , NOMER_INV = '$no_bukti_real' ,TUTUP_OUTSTANDING = '$statue'
        WHERE NO_BUKTI = '$no_trx'
        ";

        $this->db->query($sql);
    }

    function edit_status_invoice_br($no_trx){

        // $loses = $qty - 3 - $qty_diterima;
       
        $sql = "
        UPDATE ak_penjualan SET NO_INV = '' , QTY_DITERIMA = '' , STATUS_INV = '0' , NOMER_INV = ''
        WHERE ID = '$no_trx'
        ";

        $this->db->query($sql);
    }

    function edit_status_do($no_do){

        // $loses = $qty - 3 - $qty_diterima;
       
        $sql = "
        UPDATE ak_delivery_order SET STATUS = '1'
        WHERE NO_BUKTI = '$no_do'
        ";

        $this->db->query($sql);
    }


    function edit_invoice($no_so,$memo,$tgl_trx){

        
       
        $sql = "
        UPDATE ak_invoice SET KETERANGAN = '$memo' , TGL_TRX = '$tgl_trx'
        WHERE ID = '$no_so'
        ";

        $this->db->query($sql);
    }

    function update_status_outstanding($no_so){

        
       
        $sql = "
        UPDATE ak_penjualan SET TUTUP_OUTSTANDING = 'Konfirmasi'
        WHERE NO_BUKTI = '$no_so'
        ";

        $this->db->query($sql);
    }

    function update_hapus_do($id){

        
       
        $sql = "
        UPDATE ak_delivery_order SET STATUS_HAPUS_DO = '1'
        WHERE ID = '$id'
        ";

        $this->db->query($sql);
    }

    function update_do_hapus($id){

       
        $sql = "
        UPDATE ak_delivery_order SET STATUS_HAPUS_DO = ''
        WHERE NO_BUKTI = '$id'
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