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
<?php
function formatTanggal($tgl){
  //22-11-2016
  $d = substr($tgl,0,2);
  $m = substr($tgl,3,2);
  $y = substr($tgl,6);

  $strBulan = "";

  if($m == '01'){
    $strBulan = "Jan";
  }else if($m == '02'){
    $strBulan = "Feb";
  }else if($m == '03'){
    $strBulan = "Mar";
  }else if($m == '04'){
    $strBulan = "Apr";
  }else if($m == '05'){
    $strBulan = "Mei";
  }else if($m == '06'){
    $strBulan = "Jun";
  }else if($m == '07'){
    $strBulan = "Jul";
  }else if($m == '08'){
    $strBulan = "Agt";
  }else if($m == '09'){
    $strBulan = "Sep";
  }else if($m == '10'){
    $strBulan = "Okt";
  }else if($m == '11'){
    $strBulan = "Nov";
  }else if($m == '12'){
    $strBulan = "Des";
  }
  return $d."-".$strBulan."-".$y;
}
?>
<body class="body" onload="window.print()">
  <div style="float:left;">
    <span style="font-size: 120%;"><strong>PT. UNITED SHIPPING INDONESIA</strong></span><br>
    <span style="font-size: 60%;">GONDOSULI No. 08 RT 005 RW 006, KETABANG, GENTENG SURABAYA<br>
    62-31-5346207</span>
  </div>
  <div style="clear: both;"></div>
  <center>
    <div>
      <span><strong>PIUTANG JATUH TEMPO</strong></span><br>
      <span style="font-size: 100%; font-weight: bold;"><?php echo $judul; ?></span>
    </div>
  </center>
  <hr>
  <div style="clear: both;"></div>
  <br>
  <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
    <thead>
      <tr>
        <td style="text-align:left;">MATA UANG :</td>
        <td style="border-top: 1px solid black; text-align:left;">IDR</td>
        <td colspan="9" style="border-top: 1px solid black;"></td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
        <td rowspan="2" style="border: 1px solid black; text-align:center;">NO TRANSAKSI</td>
        <td colspan="2" style="border: 1px solid black; text-align:center;">CUSTOMER</td>
        <td rowspan="2" style="border: 1px solid black; text-align:center;">TANGGAL JATUH TEMPO</td>
        <td rowspan="2" style="border: 1px solid black; text-align:center;">TOTAL</td>
        <td rowspan="2" style="border: 1px solid black; text-align:center;">TERBAYAR</td>
        <td rowspan="2" style="border: 1px solid black; text-align:center;">SISA</td>
        <td rowspan="2" style="border: 1px solid black; text-align:center;">KURS</td>
        <td rowspan="2" style="border: 1px solid black; text-align:center;">TERBAYAR</td>
        <td rowspan="2" style="border: 1px solid black; text-align:center;">SISA</td>
      </tr>

      <tr>
        <td style="border: 1px solid black; text-align:center;">NAMA</td>
        <td style="border: 1px solid black; text-align:center;">LOKASI</td>
      </tr>
    </thead>
    <tbody>
    <?php
      $total = 0;
      $tot_terbayar = 0;
      $tot_sisa = 0;

      foreach ($data as $key => $value) {
        $sisa = $value->TOTAL_DO - $value->SUB_TOTAL;
        $terbayar = '-';
        if($value->SUB_TOTAL != 0){
          $terbayar = $value->SUB_TOTAL;
        }else{
          $terbayar = $terbayar;
        }

        $total += $value->TOTAL_DO;
        $tot_terbayar += $value->SUB_TOTAL;
        $tot_sisa += $sisa;
    ?>
      <tr>
        <td style="border: 1px solid black; text-align: center;"><?php echo $value->NO_BUKTI; ?></td>
        <td style="border: 1px solid black;"><?php echo $value->PELANGGAN; ?></td>
        <td style="border: 1px solid black;">-</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo formatTanggal($value->TGL_TRX); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->TOTAL_DO); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($terbayar); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($sisa); ?></td>
        <td style="border: 1px solid black; text-align: right;">1.00</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($terbayar); ?></td>
        <td style="border-right: 1px solid black; text-align: right;"><?php echo number_format($sisa); ?></td>
      </tr>
    <?php
      }
    ?>
    
      <tr>
        <td colspan="4" style="border: 1px solid black; text-align: center;">TOTAL</td>
        <td  style="border: 1px solid black; text-align: right;"><?php echo number_format($total); ?></td>
        <td  style="border: 1px solid black; text-align: right;"><?php echo number_format($tot_terbayar); ?></td>
        <td  style="border: 1px solid black; text-align: right;"><?php echo number_format($tot_sisa); ?></td>
        <td  style="border: 0px solid black;"></td>
        <td  style="border: 1px solid black; text-align: right;"><?php echo number_format($tot_terbayar); ?></td>
        <td  style="border: 1px solid black; text-align: right;"><?php echo number_format($tot_sisa); ?></td>
      </tr>
    </tbody>
  </table>
  <div style="clear:both"></div>
  <br>
</body>

</html>