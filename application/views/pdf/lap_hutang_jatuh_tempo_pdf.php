<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style type="text/css" media="print">
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
      <span><strong>HUTANG JATUH TEMPO</strong></span><br>
      <span style="font-size: 80%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <td style="border-right:1px solid black; border-top:1px solid black; text-align: center;">Mata Uang</td>
          <td style="border-right:1px solid black; border-top:1px solid black; text-align: center;">IDR</td>
          <td colspan="3" style="border-top:1px solid black; text-align: center;"></td>
        </tr>
        <tr>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">NO TRANSAKSI</td>
          <td colspan="2" style="border: 1px solid black; text-align: center;">SUPPLIER</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">TANGGAL JATUH TEMPO</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">TOTAL</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">KURS</td>
          <td rowspan="2" style="border: 1px solid black; text-align: center;">TOTAL 2</td>
        </tr>
        <tr>
          <td style="border: 1px solid black; text-align: center;">NAMA</td>
          <td style="border: 1px solid black; text-align: center;">LOKASI</td>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($data as $key => $value) {
          $tgl = $value->TGL_WALIK;
          $tempo = $value->JATUH_TEMPO;
          $date = strtotime("+".$tempo." days", strtotime($tgl));
          $tgl_tempo = date("d-m-Y", $date);
      ?>
        <tr>
          <td style="border: 1px solid black;"><?php echo $value->NOMER_PO; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->PELANGGAN; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->KOTA; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo $tgl_tempo; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->SUB_TOTAL); ?></td>
          <td style="border: 1px solid black; text-align: right;">1.00</td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->SUB_TOTAL); ?></td>
        </tr>
      <?php
        }
      ?>
      </tbody>
    </table>
  </body>
</html>
