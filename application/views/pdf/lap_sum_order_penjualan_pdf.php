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
      <span><strong>Laporan Summary Order Penjualan</strong></span><br>
      <span style="font-size: 100%;"><?=$judul;?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody>
      
        <tr>
          <td rowspan="2" style="border: 1px solid black;">TANGGAL</td>
          <td rowspan="2" style="border: 1px solid black;">NO SO</td>
              
          <td colspan="2" style="border: 1px solid black;">CUSTOMER</td>
          <td rowspan="2" style="border: 1px solid black;">NO REF.</td>
          <td rowspan="2" style="border: 1px solid black;">TANGAL <br>KIRIM </td>
          <td rowspan="2" style="border: 1px solid black;">KETERANGAN</td>
          <td rowspan="2" style="border: 1px solid black;">TOTAL</td>
          <td rowspan="2" style="border: 1px solid black;">KURS</td>
          <td rowspan="2" style="border: 1px solid black;">TOTAL <br>IDR</td>
          <td rowspan="2" style="border: 1px solid black;">STATUS</td>
          
        </tr>
        <tr>
          <td style="border: 1px solid black;">NAMA</td>
          <td style="border: 1px solid black;">LOKASI</td>
        <!--   <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td> -->
        </tr>

        <?PHP 
        $total = 0;
        foreach ($data as $key => $row) { 
          $total += $row->SUB_TOTAL;
          $status = '';
          if($row->STATUS == '0'){
            $status = 'NEW';
          }else{
            $status = 'COMPLETE';
          }
        ?>
        <tr>
          <td style="border: 1px solid black;"><?=$row->TGL_TRX;?></td>
          <td style="border: 1px solid black;"><?=$row->NO_BUKTI;?></td>
          <td style="border: 1px solid black;"><?=$row->PELANGGAN;?></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"><?=$row->STATUS_PO;?></td>
          <td style="border: 1px solid black;"><?=$row->TGL_TRX;?></td>
          <td style="border: 1px solid black;"><?=$row->MEMO;?></td>
          <td style="border: 1px solid black; text-align: right;"><?=number_format($row->SUB_TOTAL);?></td>
          <td style="border: 1px solid black;">1.00</td>
          <td style="border: 1px solid black; text-align: right;"><?=number_format($row->SUB_TOTAL);?></td>
          <td style="border: 1px solid black;"><?=$status;?></td>
        </tr>
        <?PHP } ?>


<!-- <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody> -->
        <!-- <tr>
          <td colspan="14" style="border: 1px solid black;"> <br> </td>
        </tr> -->
        <tr>
          <td colspan="9" style="
          border-left:1px solid black;
          border-right:0px solid black;
          border-top:1px solid black;
          border-bottom:1px solid black;">TOTAL</td>

          <td colspan="1" style="
          border-left:0px solid black;
          border-right:0px solid black;
          border-top:1px solid black;
          border-bottom:1px solid black; text-align: right; font-weight: bold;"><?=number_format($total);?></td>

          <td colspan="1" style="
          border-left:0px solid black;
          border-right:1px solid black;
          border-top:1px solid black;
          border-bottom:1px solid black;"></td>
        </tr>

<!-- 
  </tbody>
      </table> -->


        <!-- <tr>
          <td style="border: 1px solid black;">x</td>
          <td colspan="4" style="border: 1px solid black;">TOTAL</td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td></td>
          <td style="border: 1px solid black;">x</td>
          <td style="border: 1px solid black;"></td>
        </tr> -->
      </tbody>
    </table>
    <div style="clear:both"></div>
    <br>
   
  </body>
</html>
