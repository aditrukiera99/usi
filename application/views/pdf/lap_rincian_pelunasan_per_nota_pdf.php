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
      <span><strong>Laporan Perincian Pelunasan Tiap Note Penjualan</strong></span><br>
      <span style="font-size: 100%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border-collapse: collapse; width: 100%; font-size: 80%;font-family: Arial;">
    <thead>
        <tr style="font-weight: bold">
          <td rowspan="2" style="border: 1px solid black; text-align: center;">TANGGAL</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">NO FAKTUR</td>
          <td colspan="2" style="border: 1px solid black; text-align: center;">CUSTOMER</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">TANGGAL<br>J.TEMPO</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">GUDANG</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">DISKON</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">TOTAL</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">TOTAL BERSIH</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">STATUS</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">KETERANGAN</td>
        </tr>

        <tr style="font-weight: bold;">
          <td style="border: 1px solid black;"> NO FAKTUR</td>
          <td style="border: 1px solid black;"> LOKASI </td>
        </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $key => $value) {
      ?>
      <tr>
        <td style="border: 1px solid black; text-align: right;"><?php echo $value->TGL_TRX; ?></td>
        <td style="border: 1px solid black;"><?php echo $value->NO_SO; ?></td>
        <td style="border: 1px solid black;"><?php echo $value->PELANGGAN; ?></td>
        <td style="border: 1px solid black;">-</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo $value->TGL_TRX; ?></td>
        <td style="border: 1px solid black;">-</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo '0.00'; ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->NILAI); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->NILAI); ?></td>
        <td style="border: 1px solid black;">LUNAS</td>
        <td style="border: 1px solid black;">-</td>
  	  </tr>

      <tr>
        <td style="border: 1px solid black;"><?php echo $value->TGL_TRX; ?></td>
        <td style="border: 1px solid black;"><?php echo $value->NO_SO; ?></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;">Mandiri USI</td>
        <td style="border: 1px solid black; text-align: right;">201801</td>
        <td style="border: 1px solid black; text-align: right;">-</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->NILAI); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->NILAI); ?></td>
      </tr>

      <tr style="font-weight: bold">
        <td colspan="6" style="border: 1px solid black; text-align: center;">TOTAL</td>
        <td style="border: 1px solid black;">-</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->NILAI); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->NILAI); ?></td>
        <td bgcolor="yellow" style="text-align: right;">SISA</td>
        <td bgcolor="yellow" style="text-align: right;">-</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>

  <div style="clear:both"></div>
  <br>
 
</body>

</html>

