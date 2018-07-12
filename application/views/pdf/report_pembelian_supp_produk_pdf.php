<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style type="text/css" media="print">
    @page {
        size: landscape;
    }
    .body {
      margin:.5in 13.6pt 0in 13.6pt;
      mso-header-margin:.5in;
      mso-footer-margin:.5in;
      mso-paper-source:4;
    }
    .one-third{
      width: 28%;
      float: left;
      margin: 2% 0 3% 4%;
      text-align: center;
    }
</style>
  <body class="body" onload="window.print()">
    <div style="float:left;">
      <span style="font-size: 120%;"><strong>PT. UNITED SHIPPING INDONESIA</strong></span><br>
      <span style="font-size: 60%;">GONDOSULI No. 08 RT 005 RW 006, KETABANG, GENTENG SURABAYA<br>
      62-31-5346207</span>
    </div>
    <div style="clear: both;"></div>
    <center>
    <div>
      <span><strong>Laporan Pembelian Produk Detail Supplier</strong></span><br>
      <span style="font-size: 100%;">TANGGAL : <?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <th style="border: 1px solid black;">No</th>
          <th style="border: 1px solid black;">Nama Item <br> Nama Supplier</th>
          <th style="border: 1px solid black;">Kode Item <br> Kode Supplier</th>
          <th style="border: 1px solid black;">Qty</th>
          <th style="border: 1px solid black;">Harga</th>
          <th style="border: 1px solid black;">Nilai</th>
          <th style="border: 1px solid black;">Kurs</th>
          <th style="border: 1px solid black;">Nilai IDR</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 0;
          $nilai = 0;
          $total = 0;

          foreach ($data as $key => $value) {
            $no++;
            $id_supplier = $value->ID_SUPPLIER;
            $nilai = $value->NILAI;
        ?>
        <tr>
          <td style="text-align:center; border-left: 1px solid black;"><?php echo $no; ?></td>
          <td style="border-left: 1px solid black;"><?php echo $value->SUPPLIER; ?></td>
          <td style="border-left: 1px solid black;"><?php echo $value->KODE_SUP; ?></td>
          <td style="border-left: 1px solid black;">&nbsp;</td>
          <td style="border-left: 1px solid black;">&nbsp;</td>
          <td style="border-left: 1px solid black; text-align: right;"><?php echo number_format($nilai,2,',','.'); ?></td>
          <td style="border-left: 1px solid black;">&nbsp;</td>
          <td style="border-left: 1px solid black; border-right: 1px solid black; text-align: right;"><?php echo number_format($value->TOTAL); ?></td>
        </tr>
        <?php
            $sql = "
              SELECT
                a.ID,
                b.TGL_TRX,
                a.NAMA_PRODUK,
                a.QTY,
                a.HARGA_SATUAN,
                a.TOTAL
              FROM ak_penerimaan_detail a
              LEFT JOIN ak_penerimaan_barang b ON b.ID = a.ID_PENJUALAN
              WHERE b.ID_SUPPLIER = '$id_supplier'
              AND STR_TO_DATE(b.TGL_TRX, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') 
              AND STR_TO_DATE(b.TGL_TRX, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
            ";
            $qry = $this->db->query($sql);
            $res = $qry->result();

            foreach ($res as $ky => $val) {
              $total += $val->TOTAL;
        ?>
            <tr>
              <td style="text-align:center; border-left: 1px solid black;">&nbsp;</td>
              <td style="border-left: 1px solid black;"><?php echo $val->NAMA_PRODUK; ?></td>
              <td style="text-align:center; border-left: 1px solid black;">&nbsp;</td>
              <td style="border-left: 1px solid black; text-align: right;"><?php echo number_format($val->QTY); ?></td>
              <td style="border-left: 1px solid black; text-align: right;"><?php echo number_format($val->HARGA_SATUAN); ?></td>
              <td style="border-left: 1px solid black; text-align: right;"><?php echo number_format($val->TOTAL); ?></td>
              <td style="border-left: 1px solid black; text-align: right;">1.00</td>
              <td style="border-left: 1px solid black; border-right: 1px solid black; text-align: right;"><?php echo number_format($val->TOTAL); ?></td>
            </tr>
        <?php
            }
          }
        ?>

        <tr>
          <td colspan="3" style="border: 1px solid black; text-align: right;">TOTAL</td>
          <td style="border: 1px solid black;">&nbsp;</td>
          <td style="border: 1px solid black;">&nbsp;</td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($nilai,2,',','.'); ?></td>
          <td style="border: 1px solid black;">&nbsp;</td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($total); ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
