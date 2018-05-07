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
      <span><strong>DAFTAR CUSTOMER</strong></span><br>
      <!-- <span style="font-size: 100%;">01-Jan-2018 - 19- Mar-2018</span> -->
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;font-family: Arial;">
      <tbody>
        
       <tr style="font-weight: bold">
          <td height="40px" style="border: 1px solid black;">NO</td>
          <td style="border: 1px solid black;">KODE</td>
          <td style="border: 1px solid black;">NAMA</td>
          <td style="border: 1px solid black;">LOKASI</td>
          <td style="border: 1px solid black;">ALAMAT</td>
          <td style="border: 1px solid black;">LIMIT PIUTANG</td>
          <td style="border: 1px solid black;">KONTAK</td>
          <td style="border: 1px solid black;">PHONE</td>
          <td style="border: 1px solid black;">FAX</td>
          <td style="border: 1px solid black;">SALES</td>
          <td style="border: 1px solid black;">STATUS</td>
        </tr>

		

<!-- ------------ISI--------------- -->
    <?PHP
    $no = 0;
    foreach ($data as $key => $row) { 
      $no++;
    ?>
    <tr style="font-weight: bold">
      <td  style="border: 1px solid black;"><?=$no;?></td>
      <td  style="border: 1px solid black;">-</td>
      <td  style="border: 1px solid black;"><?=$row->NAMA_PELANGGAN;?></td>
      <td  style="border: 1px solid black;"><?=$row->ALAMAT_KIRIM;?></td>
      <td  style="border: 1px solid black;"><?=$row->ALAMAT_TAGIH;?></td>
      <td  style="border: 1px solid black;">0.00</td>
      <td  style="border: 1px solid black;"><?=$row->NO_TELP;?></td>
      <td  style="border: 1px solid black;"><?=$row->NO_HP;?></td>
      <td  style="border: 1px solid black;">-</td>
      <td  style="border: 1px solid black;">-</td>
      <td  style="border: 1px solid black;">Y</td>
	  </tr>
    <?PHP } ?>  

<!-- --------------------------- -->





    </table>
    <div style="clear:both"></div>
    <br>
   
  </body>
</html>

