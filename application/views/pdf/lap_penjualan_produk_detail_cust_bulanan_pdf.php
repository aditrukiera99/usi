<html>
<head></head>
<title>bulanan</title>
<body class="body" onload="window.print()">

<b style="font-family: arial;" ><font size="5px">PT.UNITED SHIPPING INDONESIA</b></font>
<br>
<br><font face="arial" size="1px">GONDUSULI No.08 RT.006 RW.006 KETABANG , GENTENG SURABAYA
<br><br>01-31-534607 
<br>
<p align="center"><br><b><font size="3px">Laporan Penjualan Produk Detail Customer ( Bulanan )</b>
<br><b>BULAN : <?=$judul;?></font></b></p></font>
<br>


<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-us36{border-color:inherit;vertical-align:top}
.tg .tg-7btt{font-weight:bold;border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 90%">
<colgroup>
<col style="width: 29px">
<col style="width: 204px">
<col style="width: 206px">
<col style="width: 116px">
<col style="width: 140px">
<col style="width: 105px">
<col style="width: 111px">
<col style="width: 140px">
<col style="width: 158px">
</colgroup>
  <tr>
    <th class="tg-amwm" rowspan="2">No</th>
    <th class="tg-amwm" rowspan="2">Nama Item<br>Nama Customer</th>
    <th class="tg-amwm" rowspan="2">Kode Item<br>Kode Customer</th>
    <th class="tg-amwm" colspan="2">S/D <?=$bulan_lalu_txt;?></th>
    <th class="tg-amwm" colspan="2"><?=$bulan_txt;?></th>
    <th class="tg-amwm" colspan="2">S/D <?=$bulan_txt;?></th>
  </tr>
  <tr>
    <td class="tg-amwm">QTY</td>
    <td class="tg-amwm">Nilai</td>
    <td class="tg-amwm">QTY</td>
    <td class="tg-amwm">Nilai</td>
    <td class="tg-amwm">QTY</td>
    <td class="tg-amwm">Nilai</td>
  </tr>
  <?PHP 
  $no = 0;
  $total_all = 0;
  foreach ($data as $key => $row) {
    $no++;
    $total_all += $row->JML * $row->HARGA;
  ?>
  <tr>
    <td class="tg-yw4l" style="color:blue;"><?=$no;?></td>
    <td class="tg-yw4l" style="color:blue;"><?=$row->NAMA_PRODUK;?></td>
    <td class="tg-yw4l" style="color:blue;"><?=$row->KODE_PRODUK;?></td>
    <td class="tg-yw4l" style="color:blue;"></td>
    <td class="tg-yw4l" style="color:blue;"></td>
    <td class="tg-yw4l" style="color:blue;"></td>
    <td class="tg-yw4l" style="color:blue;"></td>
    <td class="tg-yw4l" style="color:blue;"></td>
    <td class="tg-yw4l" style="color:blue;"></td>
  </tr>

  <?PHP 
  $sql_det = "
  SELECT c.NAMA_PELANGGAN, b.QTY, b.TOTAL FROM ak_penjualan a 
  JOIN ak_penjualan_detail b ON a.ID = b.ID_PENJUALAN
  JOIN ak_pelanggan c ON c.ID = a.ID_PELANGGAN
  WHERE b.ID_PRODUK = '$row->ID'
  ";

  $total_1 = 0;
  $total_2 = 0;
  $dt_det = $this->db->query($sql_det)->result();
  foreach ($dt_det as $key => $row_det) {
      $total_1 += $row_det->QTY;
      $total_2 += $row_det->TOTAL;
  ?>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"><?=$row_det->NAMA_PELANGGAN;?></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" style="text-align: right;"></td>
    <td class="tg-yw4l" style="text-align: right;"></td>
    <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->QTY);?></td>
    <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->TOTAL);?></td>
    <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->QTY);?></td>
    <td class="tg-yw4l" style="text-align: right;"><?=number_format($row_det->TOTAL);?></td>
  </tr>  
  <?PHP } ?>

  <?PHP } ?>
  <tr>
    <td class="tg-yw4l" style="font-weight: bold;" colspan="3">TOTAL</td>
    <td class="tg-yw4l" style="text-align: right; font-weight: bold;"></td>
    <td class="tg-yw4l" style="text-align: right; font-weight: bold;"></td>
    <td class="tg-yw4l" style="text-align: right; font-weight: bold;"><?=number_format($total_1);?></td>
    <td class="tg-yw4l" style="text-align: right; font-weight: bold;"><?=number_format($total_2);?></td>
    <td class="tg-yw4l" style="text-align: right; font-weight: bold;"><?=number_format($total_1);?></td>
    <td class="tg-yw4l" style="text-align: right; font-weight: bold;"><?=number_format($total_2);?></td>
  </tr>
</table>

</body>

</html>