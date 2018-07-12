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
      <span style="font-size: 100%;">TANGGAL : <?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
    <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <tbody>
        <tr>
          <td style="border: 1px solid black; text-align:center;">No</td>
          <td style="border: 1px solid black; text-align:center;">Nama Item <br> Nama Supplier</td>
          <td style="border: 1px solid black; text-align:center;">Kode Item <br> Kode Supplier</td>
          <td style="border: 1px solid black; text-align:center;">QTY</td>
          <td style="border: 1px solid black; text-align:center;">HARGA IDR</td>
          <td style="border: 1px solid black; text-align:center;">NILAI IDR</td>
        </tr>
        <?php
          $no = 0;
          $total = 0;
          foreach ($data as $key => $value) {
            $no++;
            $total += $value->TOTAL;
        ?>
        <tr>
          <td style="border-left: 1px solid black; text-align:center;"><?php echo $no; ?></td>
          <td style="border-left: 1px solid black;">
            <?php echo $value->NAMA_PRODUK; ?><br>
            <font style="color: blue;"><?php echo $value->SUPPLIER; ?></font>
          </td>
          <td style="border-left: 1px solid black;">
            <?php echo $value->KODE_PRODUK; ?><br>
            <font style="color: blue;"><?php echo $value->KODE_SUP; ?></font>
          </td>
          <td style="border-left: 1px solid black; text-align: right;">
            <?php echo number_format($value->QTY); ?><br>
            <font style="color: blue;"><?php echo number_format($value->QTY); ?></font>
          </td>
          <td style="border-left: 1px solid black; text-align: right;">
            <br>
            <font style="color: blue;"><?php echo number_format($value->HARGA_SATUAN); ?></font>
          </td>
          <td style="border-left: 1px solid black; border-right: 1px solid black; text-align: right;">
            <?php echo number_format($value->TOTAL); ?><br>
            <font style="color: blue;"><?php echo number_format($value->TOTAL); ?></font>
          </td>
        </tr>
        <?php
          }
        ?>

        <tr>
          <td colspan="3" style="border: 1px solid black; text-align: center;"><b>TOTAL</b></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($total); ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
