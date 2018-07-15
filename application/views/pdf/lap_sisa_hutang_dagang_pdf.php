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
      <span><strong>LAPORAN SISA HUTANG DAGANG</strong></span><br>
      <span style="font-size: 100%;"><?php echo $judul; ?></span>
    </div>
    <hr style="border: 0.5px solid black;">
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <td></td>
          <td style="text-align:left;">Mata Uang :</td>
          <td style="border: 1px solid black; text-align:left;">IDR</td>
          <td colspan="9" style="border: 1px solid black;"></td>
        </tr>
        <tr>
          <td style="border: 1px solid black;">NO</td>
          <td style="border: 1px solid black;">NO TRANSAKSI</td>
          <td style="border: 1px solid black;">SUPPLIER</td>
          <td style="border: 1px solid black;">TANGGAL</td>
          <td style="border: 1px solid black;">TANGGAL JATUH TEMPO</td>
          <td style="border: 1px solid black;">TOTAL</td>
          <td style="border: 1px solid black;">RETUR</td>
          <td style="border: 1px solid black;">TERBAYAR</td>
          <td style="border: 1px solid black;">SISA</td>
          <td style="border: 1px solid black;">KURS</td>
          <td style="border: 1px solid black;">TOTAL</td>
          <td style="border: 1px solid black;">RETUR</td>
        </tr>
      </thead>
      <tbody>
      <?php
        $no = 0;
        $tot1 = 0;
        $tot2 = 0;
        $tot3 = 0;

        foreach ($data as $key => $value) {
          $no++;
          $tgl = $value->TGL_WALIK;
          $tempo = $value->JATUH_TEMPO;
          $date = strtotime("+".$tempo." days", strtotime($tgl));
          $tgl_tempo = date("d-m-Y", $date);

          $total = $value->SUB_TOTAL;
          $terbayar = $value->TOTAL;
          $sisa = $terbayar - $total;

          $tot1 += $total;
          $tot2 += $terbayar;
          $tot3 += $sisa;
      ?>
        <tr>
          <td style="border: 1px solid black;"><?php echo $no; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->NOMER_PO; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->PELANGGAN; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo $value->TGL_TRX; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo $tgl_tempo; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($total); ?></td>
          <td style="border: 1px solid black; text-align: right;">0.00</td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($terbayar); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($sisa); ?></td>
          <td style="border: 1px solid black; text-align: right;">1.00</td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($sisa); ?></td>
          <td style="border: 1px solid black; text-align: right;">0.00</td>
        </tr>
      <?php
        }
      ?>
        <tr>
          <td style="border: 1px solid black;">&nbsp;</td>
          <td colspan="4" style="border: 1px solid black; text-align: center; font-weight: bold;">TOTAL</td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;"><?php echo number_format($tot1); ?></td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;">0.00</td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;"><?php echo number_format($tot2); ?></td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;"><?php echo number_format($tot3); ?></td>
          <td>&nbsp;</td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;"><?php echo number_format($tot3); ?></td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;">0.00</td>
        </tr>
      </tbody>
    </table>
    <br>
    <br>
    <table style="border-collapse: collapse; width: 31%; text-align:center; font-size: 80%;">
      <thead>
        <tr>
          <td style="border: 1px solid black;">NO</td>
          <td style="border: 1px solid black;">NO TRANSAKSI</td>
          <td style="border: 1px solid black;">TERBAYAR</td>
          <td style="border: 1px solid black;">SISA</td>
        </tr>
      </thead>
      <tbody>
      <?php
        $n = 0;
        $tot_bayar = 0;
        $tot_sisa = 0;

        foreach ($data as $key => $value) {
          $n++;
          $total = $value->SUB_TOTAL;
          $terbayar = $value->TOTAL;
          $sisa = $terbayar - $total;

          $tot_bayar += $terbayar;
          $tot_sisa += $sisa;
      ?>
        <tr>
          <td style="border: 1px solid black; text-align: center;"><?php echo $n; ?></td>
          <td style="border: 1px solid black;"><?php echo $value->NOMER_PO; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($terbayar); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($sisa); ?></td>
        </tr>
      <?php
        }
      ?>
        <tr>
          <td>&nbsp;</td>
          <td style="border: 1px solid black;">&nbsp;</td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;"><?php echo number_format($tot_bayar); ?></td>
          <td style="border: 1px solid black; text-align: right; font-weight: bold;"><?php echo number_format($tot_sisa); ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
