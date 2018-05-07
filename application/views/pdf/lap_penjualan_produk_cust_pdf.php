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
      <span><strong>Laporan Penjualan Produk Detail Customer</strong></span><br>
      <span style="font-size: 100%;"><?=$judul;?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border: 1px solid black; border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody>
        <tr>
          <td style="border: 1px solid black;">No</td>
          <td style="border: 1px solid black;">Kode Item <br> Kode Customer</td>
          <td style="border: 1px solid black;">Nama Item <br> Nama Customer</td>
          <td style="border: 1px solid black;">Qty</td>
          <td style="border: 1px solid black;">Nilai</td>
          <td style="border: 1px solid black;">Kurs</td>
          <td style="border: 1px solid black;">Nilai IDR</td>
        </tr>
        <?PHP 
        $no = 0;
        $total_all = 0;
        foreach ($data as $key => $row) {
          $no++;
          $total_all += $row->JML * $row->HARGA;
        ?>
        <tr>
          <td class="tg-yw4l" rowspan="2"><?=$no;?></td>
          <td class="tg-yw4l" rowspan="2"><?=$row->NAMA_PRODUK;?></td>
          <td class="tg-yw4l" rowspan="2"><?=$row->KODE_PRODUK;?></td>
          <td class="tg-yw4l" rowspan="2"></td>
          <td class="tg-yw4l" rowspan="2" style="text-align: right;"><?=number_format($row->JML*$row->HARGA);?></td>
          <td class="tg-yw4l" rowspan="2"></td>
          <td class="tg-yw4l" rowspan="2" style="text-align: right;"><?=number_format($row->JML*$row->HARGA);?></td>
        </tr>

        <?PHP 
        $sql_det = "
        SELECT c.NAMA_PELANGGAN, b.QTY, b.TOTAL FROM ak_penjualan a 
        JOIN ak_penjualan_detail b ON a.ID = b.ID_PENJUALAN
        JOIN ak_pelanggan c ON a.ID_PELANGGAN = b.ID
        ";
        $dt_det = $this->db->query($sql_det)->result();
        foreach ($dt_det as $key => $row_det) {
        ?>
        <tr>
          <td class="tg-yw4l"></td>
          <td class="tg-yw4l"><?=$row_det->NAMA_PELANGGAN;?></td>
          <td class="tg-yw4l"></td>
          <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->QTY);?></td>
          <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->TOTAL);?></td>
          <td class="tg-yw4l" style="text-align: right;">1.00</td>
          <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->TOTAL);?></td>
        </tr>  
        <?PHP } ?>

      <?PHP } ?>
      </tbody>
    </table>
  </body>
</html>
