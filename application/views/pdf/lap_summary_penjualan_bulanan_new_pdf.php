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
      <span><b style="font-size: 22px;">Laporan Summary Penjualan</b></span><br>
      <span style="font-size: 70%;"><?=$judul;?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border: 1px solid black; border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody>
        <tr style="font-weight: bold;">
          <td rowspan="2" style="border: 1px solid black;">TANGGAL</td>
          <td rowspan="2" style="border: 1px solid black;">NO FAKTUR</td>
          <td colspan="2" style="border: 1px solid black;">CUSTOMER</td>
          <td rowspan="2" style="border: 1px solid black;">NO REF.</td>
          <td rowspan="2" style="border: 1px solid black;">TANGGAL KIRIM</td>
          <td rowspan="2" style="border: 1px solid black;">KETERANGAN</td>
          <td rowspan="2" style="border: 1px solid black;">TOTAL</td>
          <td rowspan="2" style="border: 1px solid black;">KURS</td>
          <td rowspan="2" style="border: 1px solid black;">TOTAL IDR</td>
          <td rowspan="2" style="border: 1px solid black;">STATUS</td>
        </tr>
        <tr style="font-weight: bold;">
          <td style="border: 1px solid black;">NAMA</td>
          <td style="border: 1px solid black;">LOKASI</td>
        </tr>
        <?PHP 
        $total_1 = 0;
        $total_2 = 0;
        $total_3 = 0;
        foreach ($data as $key => $row) {
          
        ?>
        <tr>
          <td style="border: 1px solid black; text-align: center;"><?=$row->TGL_TRX;?></td>
          <td style="border: 1px solid black;"><?=$row->NO_SO;?></td>
          <td style="border: 1px solid black;"><?=$row->PELANGGAN;?></td>
          <td style="border: 1px solid black;">-</td>
          <td style="border: 1px solid black;">-</td>
          <td style="border: 1px solid black; text-align: center;"><?=$row->TGL_TRX;?></td>
          <td style="border: 1px solid black;"><?="MEMO";?></td>
          <td style="border: 1px solid black; text-align: right;"><?=number_format(0);?></td>
          <td style="border: 1px solid black; text-align: right;">1.00</td>
          <td style="border: 1px solid black; text-align: right;"><?=number_format(0);?></td>
          <td style="border: 1px solid black; "><?php echo $row->STATUS; ?></td>
        </tr>
        <?PHP } ?>
        <tr>
          <td colspan="7" style="border: 1px solid black; font-weight: bold;">GRAND TOTAL</td>
          <td style="border: 1px solid black; font-weight: bold; text-align: right;"><?=number_format(0);?></td>
          <td style="border: 1px solid black; font-weight: bold; text-align: right;"><?=number_format(0);?></td>
          <td style="border: 1px solid black; font-weight: bold; text-align: right;"><?=number_format(0);?></td>
          <td style="border: 1px solid black;"></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
