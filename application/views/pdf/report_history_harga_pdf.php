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
      <span><strong>HISTORI HARGA PEMBELIAN</strong></span><br>
      <span style="font-size: 100%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border: 1px solid black; border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <td style="border: 1px solid black; text-align: center;">TANGGAL</td>
          <td style="border: 1px solid black; text-align: center;">NO TRANSAKSI</td>
          <td style="border: 1px solid black; text-align: center;">SUPPLIER</td>
          <td style="border: 1px solid black; text-align: center;">HARGA<br>Tanpa PPN</td>
          <td style="border: 1px solid black; text-align: center;">HARGA<br>+PPN</td>
          <td style="border: 1px solid black; text-align: center;">DISKON</td>
          <td style="border: 1px solid black; text-align: center;">HARGA AKHIR</td>
          <td style="border: 1px solid black; text-align: center;">KURS</td>
          <td style="border: 1px solid black; text-align: center;">HARGA AKHIR 2</td>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($data as $key => $value) {
      ?>
        <tr>
          <td style="border: 1px solid black;"><?php echo $value->TGL_TRX; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->NOMER_LPB; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->SUPPLIER; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->HRG_TNP_PPN); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->HARGA_SATUAN); ?></td>
          <td style="border: 1px solid black; text-align: right;">0.00</td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->HARGA_SATUAN); ?></td>
          <td style="border: 1px solid black; text-align: right;">1.00</td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->HARGA_SATUAN); ?></td>
        </tr>
      <?php
        }
      ?>
      </tbody>
    </table>
  </body>
</html>
