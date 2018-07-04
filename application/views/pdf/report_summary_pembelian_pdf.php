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
      <span><b style="font-size: 22px;">Laporan Summary Pembelian</b></span><br>
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
          <td colspan="2" style="border: 1px solid black;">SUPPLIER</td>
          <td rowspan="2" style="border: 1px solid black;">NO REF.</td>
          <td rowspan="2" style="border: 1px solid black;">TANGGAL J.TEMPO</td>
          <td rowspan="2" style="border: 1px solid black;">GUDANG</td>
          <td rowspan="2" style="border: 1px solid black;">KETERANGAN</td>
          <td rowspan="2" style="border: 1px solid black;">TOTAL</td>
          <td rowspan="2" style="border: 1px solid black;">STATUS</td>
        </tr>
        <tr style="font-weight: bold;">
          <td style="border: 1px solid black;">NAMA</td>
          <td style="border: 1px solid black;">LOKASI</td>
        </tr>
        <?PHP 
        $total = 0;
        foreach ($data as $key => $row) { 
          $total += $row->TOTAL;
        ?>
        <tr>
          <td style="border: 1px solid black;"><?=$row->TGL_TRX;?></td>
          <td style="border: 1px solid black;"><?=$row->NOMER_LPB;?></td>
          <td style="border: 1px solid black;"><?=$row->SUPPLIER;?></td>
          <td style="border: 1px solid black;"><?=$row->KOTA;?></td>
          <td style="border: 1px solid black;"><?=$row->NOMER_PO;?></td>
          <td style="border: 1px solid black;"><?=$row->TGL_TRX;?></td>
          <td style="border: 1px solid black;"><?=$row->NAMAG;?></td>
          <td style="border: 1px solid black;"><?=$row->MEMO;?></td>
          <td style="border: 1px solid black; text-align: right;"><?=number_format($row->TOTAL,2);?></td>
          <td style="border: 1px solid black; ">NEW</td>
        </tr>
        <?PHP } ?>
        <tr>
          <td colspan="8" style="border: 1px solid black; font-weight: bold;">TOTAL</td>
          <td colspan="2" style="border: 1px solid black; font-weight: bold;"><?=number_format($total,2);?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
