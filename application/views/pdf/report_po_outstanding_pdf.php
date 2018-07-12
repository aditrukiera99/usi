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
      <span><strong>Laporan PO Outstanding</strong></span><br>
      <span style="font-size: 60%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">NO</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">NO PO</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">TANGGAL</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">TANGGAL BUTUH</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">NAMA SUPPLIER</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">ITEM</td>
          <td colspan="2" style="border: 1px solid black; text-align: center;">QTY</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">SISA</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">STATUS</td>
        </tr>
        <tr>
          <td style="border: 1px solid black; text-align: center;">PO</td>
          <td style="border: 1px solid black; text-align: center;">REALISASI</td>
        </tr>
      </thead>
      <tbody>
      <?php
        $no = 0;
        foreach ($data as $key => $value) {
          $no++;
          $id = $value->ID;
      ?>
        <tr>          
          <td style="border: 1px solid black; text-align: center;"><?php echo $no; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->NO_PO; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo $value->TANGGAL; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->TGL_BTH; ?></td>
          <td style="border: 1px solid black;" colspan="2"><?php echo $value->SUPPLIER; ?></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;">NEW</td>
        </tr>
      <?php
          $sql = "
            SELECT
              a.ID,
              a.ID_PENJUALAN,
              a.NAMA_PRODUK,
              a.QTY
            FROM ak_penerimaan_detail a
            WHERE a.ID_PENJUALAN = '$id'
          ";
          $qry = $this->db->query($sql);
          $res = $qry->result();

          foreach ($res as $key => $val) {
      ?>
          <tr>
            <td style="border: 1px solid black;">&nbsp;</td>
            <td style="border: 1px solid black;">&nbsp;</td>
            <td style="border: 1px solid black;">&nbsp;</td>
            <td style="border: 1px solid black;">&nbsp;</td>
            <td style="border: 1px solid black;">&nbsp;</td>
            <td style="border: 1px solid black;"><?php echo $val->NAMA_PRODUK; ?></td>
            <td style="border: 1px solid black; text-align: right;"><?php echo number_format($val->QTY); ?></td>
            <td style="border: 1px solid black; text-align: right;">-</td>
            <td style="border: 1px solid black; text-align: right;"><?php echo number_format($val->QTY); ?></td>
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
