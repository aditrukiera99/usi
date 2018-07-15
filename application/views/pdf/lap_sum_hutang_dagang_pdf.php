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
      <span><strong>SUMMARY HUTANG DAGANG</strong></span><br>
      <span style="font-size: 80%;">DARI PERIODE : <?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <td>&nbsp;</td>
          <td style="text-align:left;">Mata Uang</td>
          <td style="text-align:left;">IDR</td>
        </tr>
        <tr>
          <td style="border: 1px solid black; text-align: center;">NO</td>
          <td style="border: 1px solid black; text-align: center;">SUPPLIER</td>
          <td style="border: 1px solid black; text-align: center;">SALDO AWAL</td>
          <td style="border: 1px solid black; text-align: center;">PEMBELIAN</td>
          <td style="border: 1px solid black; text-align: center;">PELUNASAN</td>
          <td style="border: 1px solid black; text-align: center;">SALDO AKHIR HUTANG</td>
        </tr>
      </thead>
      <tbody>
      <?php
        $no = 0;
        $saldo_awal = 0;
        $pembelian = 0;
        $pelunasan = 0;
        $saldo_akhir = 0;

        foreach ($data as $key => $value) {
          $no++;
          $saldo_awal = $value->SALDO_AWAL;
          $pembelian = $value->PEMBELIAN;
          $pelunasan = $value->PELUNASAN;
          $saldo_akhir = $saldo_awal + ($pelunasan-$pembelian);
      ?>
        <tr>
          <td style="border: 1px solid black; text-align: center;"><?php echo $no; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->PELANGGAN; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo_awal); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($pembelian); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($pelunasan); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo_akhir); ?></td>
        </tr>
      <?php
        }
      ?>
      </tbody>
    </table>
    <br>
    <br>
    <table style="border-collapse: collapse; width: 50%; font-size: 80%;">
      <tbody>
        <tr>
          <td colspan="3" style="border: 1px solid black; text-align: center;">DALAM RUPIAH (IDR)</td>
        </tr>
        <tr>
          <td style="border: 1px solid black; text-align: center;">SALDO AWAL</td>
          <td style="border: 1px solid black; text-align: center;">PEMBELIAN</td>
          <td style="border: 1px solid black; text-align: center;">PELUNASAN</td>
        </tr>
        <tr>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo_awal); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($pembelian); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($pelunasan); ?></td>
        </tr>
        <tr>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;"><?php echo number_format($saldo_awal); ?></td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;"><?php echo number_format($pembelian); ?></td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;"><?php echo number_format($pelunasan); ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
