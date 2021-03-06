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
      <span><strong>Laporan Sisa Piutang Dagang</strong></span><br>
      <span style="font-size: 100%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
    <thead>
        <tr>
          <td style="border: 1px solid black; text-align:left;"></td>
          <td style="border: 1px solid black; text-align:left;">Mata Uang :</td>
          <td style="border: 1px solid black; text-align:left;">IDR</td>
          <td colspan="9" style="border-top: 0px solid black;"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black;">NO</td>
          <td style="border: 1px solid black;">NO TRANSAKSI</td>
          <td style="border: 1px solid black;">CUSTOMER</td>
          <td style="border: 1px solid black;">TANGGAL</td>
          <td style="border: 1px solid black;">TANGGAL<br>JATUH TEMPO</td>
          <td style="border: 1px solid black;">TOTAL</td>
          <td style="border: 1px solid black;">RETUR</td>
          <td style="border: 1px solid black;">TERBAYAR</td>
          <td style="border: 1px solid black;">SISA</td>
        </tr>
    </thead>
    <tbody>
      <?php
        $no = 0;
        $total = 0;
        $tot_retur = 0;
        $tot_bayar = 0;
        $tot_sisa = 0;

        foreach ($data as $key => $value) {
          $no++;
          $sisa = $value->TOTAL_DO - $value->SUB_TOTAL;
          $total += $value->TOTAL_DO;
          $tot_retur += 0;
          $tot_bayar += $value->SUB_TOTAL;
          $tot_sisa += $sisa;
      ?>
      <tr>
        <td style="border: 1px solid black;"><?php echo $no; ?></td>
        <td style="border: 1px solid black;"><?php echo $value->NO_BUKTI; ?></td>
        <td style="border: 1px solid black;"><?php echo $value->PELANGGAN; ?></td>
        <td style="border: 1px solid black;"><?php echo $value->TGL_TRX; ?></td>
        <td style="border: 1px solid black;"><?php echo $value->TGL_TRX; ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->TOTAL_DO); ?></td>
        <td style="border: 1px solid black; text-align: right;">0.00</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->SUB_TOTAL); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($sisa); ?></td>
      </tr>
      <?php
        }
      ?>

      <tr style="font-weight: bold;">
        <td style="border: 1px solid black;"></td>
        <td colspan="4" style="border: 1px solid black;">TOTAL</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($total); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot_retur); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot_bayar); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot_sisa); ?></td>
      </tr>
    </tbody>
  </table>
    <div style="clear:both"></div>
    <br>
   
  </body>
</html>

