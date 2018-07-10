<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style type="text/css">
  @page {
      size: landscape;
  }
    /*.body {
      margin:.5in 13.6pt 0in 13.6pt;
      mso-header-margin:.5in;
      mso-footer-margin:.5in;
      mso-paper-source:4;
    }*/
    
    #tabel{
      border-collapse: collapse;
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
      <span><strong>Laporan SO OUTSTANDING</strong></span><br>
      <span style="font-size: 100%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table id="tabel" style="width: 100%; font-size: 80%;">
      <thead>
          <tr>
            <th rowspan="2" style="border: 1px solid black;">No</th>
            <th rowspan="2" style="border: 1px solid black;">No. SO</th>
            <th rowspan="2" style="border: 1px solid black;">TANGGAL</th>
            <th rowspan="2" style="border: 1px solid black;">TANGGAL BUTUH</th>
            <th rowspan="2" style="border: 1px solid black;">NAMA CUSTOMER</th>
            <th rowspan="2" style="border: 1px solid black;">ITEM</th>
            <th colspan="2" style="border: 1px solid black;">QTY</th>
            <th rowspan="2" style="border: 1px solid black;">SISA</th>
          </tr>
          <tr>
              <th style="border: 1px solid black;">SO</th>
              <th style="border: 1px solid black;">REALISASI</th>
          </tr>
      </thead>
      <tbody>
        <!-- <tr>
          <td style="border-top: 0px solid black;"></td>
          <td style="border-top: 0px solid black; text-align:left;">Mata Uang :</td>
          <td style="border: 0px solid black; text-align:left;">IDR</td>
          <td colspan="9" style="border-top: 0px solid black;"></td>
        </tr> -->
      <?php
          $no = 0;
          $total = 0;
          foreach ($data as $key => $value) {
            $no++;
            $total += $value->QTY;
      ?>
        <tr>
            <td style="text-align: center;"><?php echo $no; ?></td>
            <td><?php echo $value->NO_SO; ?></td>
            <td style="text-align: right;"><?php echo $value->TGL_TRX; ?></td>
            <td style="text-align: right;"><?php echo $value->TGL_TRX; ?></td>
            <td><?php echo $value->PELANGGAN; ?></td>
            <td><?php echo $value->PRODUK; ?></td>
            <td style="text-align: right;"><?php echo number_format($value->QTY); ?></td>
            <td style="text-align: right;">-</td>
            <td style="text-align: right;"><?php echo number_format($value->QTY); ?></td>
        </tr>
      <?php
          }
      ?>

      <tr>
          <td colspan="5" style="border-top: 1px solid black;">TOTAL</td>
          <td style="border-top: 1px solid black;">TOTAL</td>
          <td style="border: 1px solid black; border-bottom: 1px solid black; text-align: right;"><?php echo number_format($total); ?></td>
          <td style="border: 1px solid black; border-bottom: 1px solid black; text-align: right;">-</td>
          <td style="border: 1px solid black; border-bottom: 1px solid black; text-align: right;"><?php echo number_format($total); ?></td>
      </tr>

    </table>
    <div style="clear:both"></div>
    <br>
   
  </body>
</html>
