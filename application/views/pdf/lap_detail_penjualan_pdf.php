<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style type="text/css" media="print">
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
      <span><strong>LAPORAN DETAIL PENJUALAN</strong></span><br>
      <span style="font-size: 80%;">Periode <?=$judul;?></span>
    </div>
  </center>
  <br>
  <div style="clear: both;"></div>
  <?PHP foreach ($data as $key => $row) { ?>
  <table style="font-size: 80%;">
    <thead>
      <th></th>
      <th></th>
      <th></th>
    </thead>
    <tbody>
      <tr>
        <td><strong>TANGGAL</strong></td>
        <td style="width: 50%;"><?=$row->TGL_TRX;?></td>
        <td ><strong>PELANGGAN</strong></td>
        <td><?=$row->PELANGGAN;?></td>
      </tr>
      <tr>
        <td><strong>NO FAKTUR</strong></td>
        <td style="text-transform: uppercase; width: 50%;"><?=$row->NO_BUKTI;?></td>
        <td><strong>LOKASI</strong></td>
        <td><?=$row->ALAMAT;?></td>
      </tr>
    </tbody>
  </table>
  <br>
  <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
    <tbody>
      <tr style="text-align:center;">
        <td style="border-bottom: 1px solid black;"><strong>Kode Barang</strong></td>
        <td style="border-bottom: 1px solid black;"><strong>Nama Barang</strong></td>
        <td style="border-bottom: 1px solid black;"><strong>Jumlah</strong></td>
        <td style="border-bottom: 1px solid black;"><strong>Satuan</strong></td>
        <td style="border-bottom: 1px solid black;"><strong>Harga</strong></td>
        <td style="border-bottom: 1px solid black;"><strong>Disc Rp</strong></td>
        <td style="border-bottom: 1px solid black;"><strong>Disc %</strong></td>
        <td style="border-bottom: 1px solid black;"><strong>Subtotal</strong></td>
      </tr>
      <?PHP 
      $dt_det = $this->db->query("
        SELECT
          a.ID,
          a.NO_BUKTI,
          a.ID_PELANGGAN,
          a.PELANGGAN,
          a.TGL_TRX,
          d.KODE_PRODUK,
          a.PRODUK AS NAMA_PRODUK,
          a.QTY,
          a.HARGA_SATUAN,
          a.NO_SO,
          a.STATUS,
          a.NOMER_DO,
          a.NOMER_PO,
          a.NOMER_LPB,
          a.ID_PRODUK,
          b.SUB_TOTAL AS TOTAL,
          b.PPN,
          b.MEMO,
          b.STATUS_PO,
          c.SATUAN
        FROM ak_delivery_order a
        LEFT JOIN ak_penjualan b ON b.NO_BUKTI = a.NO_SO
        LEFT JOIN ak_penjualan_detail c ON c.ID_PENJUALAN = b.ID
        LEFT JOIN ak_produk d ON d.ID = a.ID_PRODUK
        WHERE a.ID = '".$row->ID."'
        ORDER BY a.ID 
        ")->result();
      $total_all = 0;
      foreach ($dt_det as $key => $row_det) {
        $total_all += $row_det->TOTAL;
      ?>
      <tr style="text-align:center;">
        <td><?=$row_det->KODE_PRODUK;?></td>
        <td><?=$row_det->NAMA_PRODUK;?></td>
        <td><?=$row_det->QTY;?></td>
        <td><?=$row_det->SATUAN;?></td>
        <td><?=number_format($row_det->HARGA_SATUAN);?></td>
        <td>0.00</td>
        <td></td>
        <td style="text-align:right;"><?=number_format($row_det->TOTAL);?></td>
      </tr>
      <?PHP } ?>
      <tr>
        <td colspan="6" style="border-top: 1px solid black;"></td>
        <td style="border-top: 1px solid black;"><strong>TOTAL</strong></td>
        <td style="border-top: 1px solid black; text-align: right;"><?=number_format($total_all);?></td>
      </tr>
      <tr>
        <td colspan="6"></td>
        <td style="float: left;"><strong>DISC</strong></td>
        <td style="text-align: right;">0.00</td>
      </tr>
      <tr>
        <td colspan="6"></td>
        <td><strong>PPN</strong></td>
        <td style="text-align: right;">0.00</td>
      </tr>
      <tr>
        <td colspan="6"></td>
        <td><strong>TOTAL NET</strong></td>
        <td style="text-align: right;"><strong><?=number_format($total_all);?></strong></td>
      </tr>
      <!-- <tr>
        <td colspan="5">&nbsp;</td>
        <td>GRAND TOTAL FAKTUR</td>
      </tr> -->
    </tbody>
  </table>
  <?PHP } ?>
  </body>
</html>
