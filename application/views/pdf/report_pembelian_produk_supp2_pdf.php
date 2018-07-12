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
      <span><strong>Laporan Pembelian Produk Detail Supplier</strong></span><br>
      <span style="font-size: 100%;">PERIODE <?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <th rowspan="2" style="border: 1px solid black; text-align:center;">No</th>
          <th rowspan="2" style="border: 1px solid black; text-align:center;">Nama Item <br> Nama Supplier</th>
          <th rowspan="2" style="border: 1px solid black; text-align:center;">Kode Item <br> Kode Supplier</th>
          <th colspan="2" style="border: 1px solid black; text-align:center;">S/D <?php echo strtoupper($bulan_lalu); ?></th>
          <th colspan="2" style="border: 1px solid black; text-align:center;"><?php echo strtoupper($bulan); ?></th>
          <th colspan="2" style="border: 1px solid black; text-align:center;">S/D <?php echo strtoupper($bulan); ?></th>
        </tr>
        <tr>
          <th style="border: 1px solid black; text-align:center;">Qty</th>
          <th style="border: 1px solid black; text-align:center;">Nilai</th>
          <th style="border: 1px solid black; text-align:center;">Qty</th>
          <th style="border: 1px solid black; text-align:center;">Nilai</th>
          <th style="border: 1px solid black; text-align:center;">Qty</th>
          <th style="border: 1px solid black; text-align:center;">Nilai</th>
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
          $qty_bln_lalu = $value->QTY_BLN_LALU;
          $total_lalu = $value->TOTAL_LALU;
          $qty = $value->QTY;
          $total = $value->TOTAL;

          $qty_skg = $qty_bln_lalu + $qty;
          $tot_skg = $total_lalu + $total;

          $tot1 += $total_lalu;
          $tot2 += $total;
          $tot3 += $tot_skg;
      ?>
        <tr>
          <td style="border-left:1px solid black; text-align:center; "><?php echo $no; ?></td>
          <td style="border-left:1px solid black;">
            <?php echo $value->NAMA_PRODUK; ?><br>
            <font style="color: blue;"><?php echo $value->SUPPLIER; ?></font>
          </td>
          <td style="border-left:1px solid black;">
            <?php echo $value->KODE_PRODUK; ?><br>
            <font style="color: blue;"><?php echo $value->KODE_SUP; ?></font>
          </td>
          <td style="border-left:1px solid black; text-align: right;">
            <br>
            <font style="color: blue;"><?php echo number_format($qty_bln_lalu); ?></font>
          </td>
          <td style="border-left:1px solid black; text-align: right;">
            <?php echo number_format($total_lalu); ?><br>
            <font style="color: blue;"><?php echo number_format($total_lalu); ?></font>
          </td>
          <td style="border-left:1px solid black; text-align: right;">
            <br>
            <font style="color: blue;"><?php echo number_format($qty); ?></font>
          </td>
          <td style="border-left:1px solid black; text-align: right;">
            <?php echo number_format($total); ?><br>
            <font style="color: blue;"><?php echo number_format($total); ?></font>
          </td>
          <td style="border-left:1px solid black; text-align: right;">
            <br>
            <font style="color: blue;"><?php echo number_format($qty_skg); ?></font>
          </td>
          <td style="border-left:1px solid black; border-right:1px solid black; text-align: right;">
            <?php echo number_format($tot_skg); ?><br>
            <font style="color: blue;"><?php echo number_format($tot_skg); ?></font>
          </td>
        </tr>
      <?php
        }
      ?>

        <tr>
          <td colspan="3" style="border: 1px solid black; text-align: center;">TOTAL</td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot1); ?></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot2); ?></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot3); ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
