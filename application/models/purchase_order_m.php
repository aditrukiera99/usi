<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order_m extends CI_Model
{
    function __construct() {
          parent::__construct();
          $this->load->database();
    }

    function simpan_pembelian_po($no_trx, $id_pelanggan, $pelanggan, $tgl_trx, $sub_total, $keterangan, $penampung_ppn , $penampung_pph_21 ,$penampung_pbbkb ,$penampung_pph_15 ,$penampung_pph_23 , $no_trx, $supply_point,$jatuh_tempo,$pajak_supply,$total_hasil_pajak,$pelanggan_cust,$alamat_tagih_cust,$kode_sh_cust,$no_bukti_real,$penampung_pph_22,$hari_tempo,$qty_total)
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
            PPH_23,
            PPH_21,
            PPH_15,
            PBBKB,
            NO_SO,
            SUPPLY_POINT,
            TGL_JATUH_TEMPO,
            KODE_SH,
            PAJAK_SUPPLY,
            ID_CUSTOMER,
            NAMA_CUSTOMER,
            ALAMAT_CUSTOMER,
            TOTAL,
            NOMER_PO,
            PPH_22,
            PENERIMAAN_STATUS,
            JATUH_TEMPO,
            SISA_QTY,
            KUANTITAS

        )
        VALUES 
        (
           '13', 
           '$no_trx', 
           '$id_pelanggan', 
           '$pelanggan', 
           '$tgl_trx', 
           '$sub_total', 
           '$keterangan',
           '13',
           '$penampung_ppn', 
           '$penampung_pph_23', 
           '$penampung_pph_21', 
           '$penampung_pph_15', 
           '$penampung_pbbkb', 
           '$no_so',
           '$sp',
           '$jatuh_tempo',
           '$kode_sh_cust',
           '$pajak_supply',
           '$kode_sh_cust',
           '$pelanggan_cust',
           '$alamat_tagih_cust',
           '$total_hasil_pajak',
           '$no_bukti_real',
           '$penampung_pph_22',
           '0',
           '$hari_tempo',
           '$qty_total',
           '$qty_total'
           
        )
        ";

        $this->db->query($sql);
    }

    function simpan_pembelian_po_umum($no_trx,$id_pelanggan, $pelanggan, $tgl_trx, $sub_total, $keterangan,$supply_point)
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
            SUPPLY_POINT

        )
        VALUES 
        (
           '13', 
           '$no_trx', 
           '$id_pelanggan', 
           '$pelanggan', 
           '$tgl_trx', 
           '$sub_total', 
           '$keterangan',
           '13',
           '$supply_point'
        )
        ";

        $this->db->query($sql);
    }

     function get_supply_point($id_barang){
        $sql = "
        SELECT * FROM ak_pajak_supply WHERE ID_SUPPLY = '$id_barang'
        ";

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
        SELECT * FROM ak_pembelian 
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    
    function dt_purchase_order($id){
        $sql = "
        SELECT * FROM ak_pembelian
        WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }


    function get_data_trx($id){
        $sql = "
        SELECT * FROM ak_pembelian
        WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trans_detail($id){
        $sql = "
        SELECT mt.NAMA as NAMAS FROM ak_pembelian_trans pt , ak_master_transportir mt 
        WHERE pt.ID_TRANSPORTIR = mt.ID AND pt.ID_PO = '$id'
        ";

        return $this->db->query($sql)->result();
    }

    function trans($id){
        $sql = "
        SELECT * FROM ak_master_transportir
        
        ";

        return $this->db->query($sql)->result();
    }

    function get_supplier_detail($id_pel){
        $sql = "
        SELECT mh.HARGA_BELI as HARGA_CUY , p.* FROM ak_pelanggan p , ak_master_harga mh WHERE p.KODE_PELANGGAN = mh.ID_PELANGGAN AND mh.STATUS = '0' AND p.ID = $id_pel
        ";

        return $this->db->query($sql)->row();
    }

    function supply($id){
        $sql = "
        SELECT * FROM ak_gudang
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_trx_detail_trans($id){
        $sql = "
        SELECT * FROM ak_pembelian_detail 
        WHERE ID_PENJUALAN = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
        $sql = "
        SELECT SUM(QTY) as KUI , SUM(TOTAL) as TOTAL_SE , HARGA_SATUAN , NAMA_PRODUK , NO_SO FROM ak_pembelian_detail 
        WHERE ID_PENJUALAN = '$id' AND QTY > 0
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trxx_detail($id){
        $sql = "
        SELECT SUM(QTY) as QTY , HARGA_SATUAN FROM ak_pembelian_detail 
        WHERE ID_PENJUALAN = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_cust_detail($id){
        $sql = "
        SELECT * FROM ak_pembelian_customer 
        WHERE ID_PEMBELIAN = '$id'
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
        DELETE FROM ak_pembelian WHERE ID = $id_hapus
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
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'Pembelian'
        ";

        return $this->db->query($sql)->row();
    }

    function get_no_trx_umum($id_klien){
        $sql = "
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'Umum'
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
        SELECT p.KODE_PELANGGAN , pd.* FROM ak_penjualan_detail pd , ak_pelanggan p , ak_penjualan ap WHERE pd.ID_PENJUALAN = ap.ID AND ap.ID_PELANGGAN = p.ID AND pd.ID_PENJUALAN = $id_produk
        ";

        return $this->db->query($sql)->row();
    }

    function get_produk_detail_langsung($id_produk){
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

    function simpan_detail_penjualan($id_penjualan, $id_produk, $kode_akun, $nama_produk, $qty, $harga_modal, $harga_invoice){
        
        $qty            = str_replace(',', '', $qty);
        $harga_modal    = str_replace(',', '', $harga_modal);
        $harga_invoice  = str_replace(',', '', $harga_invoice);

        $sql = "
        INSERT INTO ak_pembelian_detail 
        (
            ID_PENJUALAN,
            KODE_AKUN,
            ID_PRODUK,
            NAMA_PRODUK,
            QTY,
            MODAL,
            HARGA_INVOICE
        )
        VALUES 
        (
        '$id_penjualan',
        '$kode_akun', 
        '$id_produk', 
        '$nama_produk', 
        '$qty', 
        '$harga_modal',  
        '$harga_invoice'
        )
        ";

        $this->db->query($sql);
    }

    function simpan_detail_pembelian($id_penjualan, $val, $kode_akun, $nama_produk, $qty, $harga_modal, $total_id,$no_po, $no_so){
        
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
            ID_PRODUK,
            NO_PO,
            NO_SO
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
        '$val',
        '$no_po',
        '$no_so'
        )
        ";

        $this->db->query($sql);
    }

    function simpan_detail_transportir($id_penjualan, $val){
        
       
        $sql = "
        INSERT INTO ak_pembelian_trans
        (
            ID_TRANSPORTIR,
            ID_PO,
            TGL_TRX
        )
        VALUES 
        (
        '$val',
        '$id_penjualan',
        CURDATE()
        )
        ";

        $this->db->query($sql);
    }

    function simpan_detail_pembelian_umum($id_pembelian, $val, $qty, $harga_modal, $harga_invoice, $no_trx){
        
        $qty            = str_replace(',', '', $qty);
        $harga_modal    = str_replace(',', '', $harga_modal);
        $total = $qty * $harga_modal ;

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
            NO_PO
        )
        VALUES 
        (
        '13',
        '$id_pembelian',
        '$val', 
        '$qty', 
        'LITER', 
        '$harga_modal', 
        '$total',
        '$no_trx'
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
        DELETE FROM ak_pembelian_detail WHERE ID_PENJUALAN = '$id'
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

    function update_status_so($nomor_so){
       
        $sql = "
        UPDATE ak_penjualan SET STATUS_PO = '1'
        WHERE NO_BUKTI = '$nomor_so'
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