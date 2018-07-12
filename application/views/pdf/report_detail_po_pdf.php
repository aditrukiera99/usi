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
      <span><strong>Laporan Detail Order Pembelian</strong></span><br>
      <span style="font-size: 60%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <td rowspan="2" style="border: 1px solid black;">TANGGAL</td>
          <td rowspan="2" style="border: 1px solid black;">NO PO</td>
          <td colspan="2" style="border: 1px solid black;">SUPPLIER</td>
          <td rowspan="2" style="border: 1px solid black;">KIRIM KE</td>
          <td rowspan="2" style="border: 1px solid black;">TANGGAL DATANG</td>
          <td rowspan="2" style="border: 1px solid black;">KETERANGAN</td>
          <td rowspan="2" style="border: 1px solid black;">TOTAL</td>
          <td rowspan="2" style="border: 1px solid black;">KURS</td>
          <td rowspan="2" style="border: 1px solid black;">TOTAL IDR</td>
          <td rowspan="2" style="border: 1px solid black;">STATUS</td>
        </tr>
        <tr>
          <td style="border: 1px solid black;">NAMA</td>
          <td style="border: 1px solid black;">LOKASI</td>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($data as $key => $value) {
          $id = $value->ID;
      ?>
        <tr>
          <td style="border: 1px solid black; text-align: right;"><?php echo $value->TGL_TRX; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->NO_PO; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->SUPPLIER; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->KOTA; ?></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo $value->TGL_DTG; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->KETERANGAN; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->TOTAL); ?></td>
          <td style="border: 1px solid black; text-align: right;">1.00</td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->TOTAL); ?></td>
          <td style="border: 1px solid black;">COMPLETE</td>
        </tr>        
      <?php
          $sql = "
            SELECT
              a.ID,
              a.ID_PENJUALAN,
              a.NAMA_PRODUK,
              b.SATUAN,
              a.HARGA_SATUAN,
              a.QTY,
              a.TOTAL
            FROM ak_penerimaan_detail a
            LEFT JOIN ak_produk b ON b.ID = a.ID_PRODUK
            WHERE a.ID_PENJUALAN = '$id'
          ";
          $qry = $this->db->query($sql);
          $res = $qry->result();

          foreach ($res as $key => $val) {
      ?>
          <tr>
            <td></td>
            <td></td>
            <td style="border: 1px solid black;"><?php echo $val->NAMA_PRODUK; ?></td>
            <td style="border: 1px solid black; text-align: right;"><?php echo number_format($val->HARGA_SATUAN); ?></td>
            <td style="border: 1px solid black; text-align: right;"><?php echo $val->SATUAN; ?></td>
            <td style="border: 1px solid black; text-align: right;"><?php echo number_format($val->QTY); ?></td>
            <td style="border: 1px solid black; text-align: right;">0</td>
            <td style="border: 1px solid black;">&nbsp;</td>
            <td style="border: 1px solid black; text-align: right;"><?php echo number_format($val->TOTAL); ?></td>
            <td style="border: 1px solid black;">&nbsp;</td>
            <td style="border: 1px solid black;">&nbsp;</td>
          </tr>
      <?php
          }
        }
      ?>
      </tbody>
    </table>
  </body>
</html>
