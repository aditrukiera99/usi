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
      <span><strong>Laporan Summary Order Pembelian</strong></span><br>
      <span style="font-size: 60%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border: 1px solid black; border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <td rowspan="2" style="border: 1px solid black; text-align:center;">TANGGAL</td>
          <td rowspan="2" style="border: 1px solid black; text-align:center;">NO PO</td>
          <td colspan="2" style="border: 1px solid black; text-align:center;">SUPPLIER</td>
          <td rowspan="2" style="border: 1px solid black; text-align:center;">KIRIM KE</td>
          <td rowspan="2" style="border: 1px solid black; text-align:center;">TANGGAL DATANG</td>
          <td rowspan="2" style="border: 1px solid black; text-align:center;">KETERANGAN</td>
          <td rowspan="2" style="border: 1px solid black; text-align:center;">TOTAL</td>
          <td rowspan="2" style="border: 1px solid black; text-align:center;">KURS</td>
          <td rowspan="2" style="border: 1px solid black; text-align:center;">TOTAL IDR</td>
          <td rowspan="2" style="border: 1px solid black; text-align:center;">STATUS</td>
        </tr>
        <tr>
          <td style="border: 1px solid black; text-align:center;">NAMA</td>
          <td style="border: 1px solid black; text-align:center;">LOKASI</td>
        </tr>
      </thead>
      <tbody>
      <?php
        $total = 0;
        foreach ($data as $key => $value) {
          $total += $value->TOTAL;
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
          <td style="border: 1px solid black;">NEW</td>
        </tr>
      <?php
        }
      ?>
        <tr>
          <td colspan="9" style="border: 1px solid black; text-align: center;">TOTAL</td>
          <td colspan="2" style="border: 1px solid black; text-align: left;"><?php echo number_format($total); ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
