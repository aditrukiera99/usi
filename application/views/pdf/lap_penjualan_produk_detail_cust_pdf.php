<html>
<head></head>
<title>harian</title>
<body class="body" onload="window.print()">

<b style="font-family: arial;" ><font size="5px">PT.UNITED SHIPPING INDONESIA</b></font>
<br>
<br><font face="arial" size="1px">GONDUSULI No.08 RT.006 RW.006 KETABANG , GENTENG SURABAYA
<br><br>01-31-534607 
<br>
<p align="center"><br><b><font size="3px">Laporan Penjualan Produk Detail Customer</b>
<br><b>TANGGAL : <?=$judul;?></font></b></p></font>
<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 100%">
<colgroup>
<col style="width: 46px">
<col style="width: 321px">
<col style="width: 249px">
<col style="width: 102px">
<col style="width: 113px">
<col style="width: 99px">
<col style="width: 67px">
</colgroup>
  <tr >
    <th class="tg-baqh"><b>No</b></th>
    <th class="tg-baqh"><b>Nama Item<br><b>Nama Customer</b></th>
    <th class="tg-baqh"><b>Kode Item</b><br><b>Kode Customer</b></th>
    <th class="tg-baqh"><b>Qty</b></th>
    <th class="tg-yw4l"><b>Nilai</b></th>
    <th class="tg-yw4l"><b>Kurs</b></th>
    <th class="tg-yw4l"><b>Nilai IDR</b></th>
  </tr>
  <?PHP 
  $no = 0;
  $total_all = 0;
  foreach ($data as $key => $row) {
    $no++;
    $total_all += $row->JML * $row->HARGA;
  ?>
  <tr>
    <td class="tg-yw4l" style="color: blue;"><?=$no;?></td>
    <td class="tg-yw4l" style="color: blue;"><?=$row->NAMA_PRODUK;?></td>
    <td class="tg-yw4l" style="color: blue;"><?=$row->KODE_PRODUK;?></td>
    <td class="tg-yw4l" style="color: blue;"></td>
    <td class="tg-yw4l" style="color: blue; text-align: right;"><?=number_format($row->JML*$row->HARGA);?></td>
    <td class="tg-yw4l" style="color: blue;"></td>
    <td class="tg-yw4l" style="color: blue; text-align: right;"><?=number_format($row->JML*$row->HARGA);?></td>
  </tr>

  <?PHP 
  $sql_det = "
  SELECT c.NAMA_PELANGGAN, c.KODE_PELANGGAN, b.QTY, b.TOTAL FROM ak_penjualan a 
  JOIN ak_penjualan_detail b ON a.ID = b.ID_PENJUALAN
  JOIN ak_pelanggan c ON c.ID = a.ID_PELANGGAN
  WHERE b.ID_PRODUK = '$row->ID'
  ";
  $dt_det = $this->db->query($sql_det)->result();
  foreach ($dt_det as $key => $row_det) {
  ?>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"><?=$row_det->NAMA_PELANGGAN;?></td>
    <td class="tg-yw4l"><?=$row_det->KODE_PELANGGAN;?></td>
    <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->QTY);?></td>
    <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->TOTAL);?></td>
    <td class="tg-yw4l" style="text-align: right;">1.00</td>
    <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->TOTAL);?></td>
  </tr>  
  <?PHP } ?>

  <?PHP } ?>
  <tr style="font-weight: bold;">
    <td class="tg-baqh" colspan="3"><b>Total</b></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" style="text-align: right;"><?=number_format($total_all);?></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" style="text-align: right;"><?=number_format($total_all);?></td>
  </tr>
</table>

</body>

</html>