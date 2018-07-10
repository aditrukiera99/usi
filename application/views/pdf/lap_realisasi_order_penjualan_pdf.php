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
      <span><strong>LAPORAN REALISASI ORDER PENJUALAN</strong></span><br>
      <!-- <span style="font-size: 100%;">10-Mar-2018 - 1-Mar-2018</span> -->
    </div>
<!-- <div style="float:left;text-align: left;">
    <span style="font-size: 60%;">

    	<br>PEMASOK : PT.CIPTA DAVIA MANDIRI (IDR)
    	<br>ALAMAT  : GEDUNG PAM TOWER LT.0 JL.JEND SUDIRMAN STAL KUDA KOMP.BSB NO.47 RT.019
    	<br>TELPON
     
  </div> -->
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <tbody>
        <?php
          foreach ($data_pemasok as $key => $val) {
        ?>
          <tr><td>&nbsp;</td></tr>
          <tr>
            <td>Pemasok</td>
            <td>:</td>
            <td><?php echo $val->PELANGGAN; ?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $val->ALAMAT; ?></td>
          </tr>
          <tr>
            <td>Telepon</td>
            <td>:</td>
            <td><?php echo $val->NO_TELP; ?></td>
          </tr>
          <tr><td>&nbsp;</td></tr>
          <tr>
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;">No</td>
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;" colspan="2">No. dan Tanggal SO</td>       
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;">Nama Barang</td>
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;">Kuantitas</td>
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;">Satuan</td>
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;">Harga Satuan<br>(Rp)</td>
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;">Jumlah Harga<br>(RP)</td>
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;" colspan="2">No.& Tanggal S.JALAN</td>
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;">Kuantitas</td>
            <td style="border: 1px solid black; border-top: 1px solid black; text-align: center;">Sisa</td>
          </tr>

          <?PHP 
          $no = 0;
          $total = 0;

          $s = "
            SELECT
              a.ID,
              a.NO_BUKTI,
              a.ID_PELANGGAN,
              a.PELANGGAN,
              a.TGL_TRX,
              a.PRODUK AS NAMA_PRODUK,
              a.QTY,
              a.HARGA_SATUAN,
              a.NO_SO,
              a.STATUS,
              a.NOMER_DO,
              a.NOMER_PO,
              a.NOMER_LPB,
              a.ID_PRODUK,
              b.SUB_TOTAL,
              b.TOTAL,
              b.PPN,
              b.MEMO,
              b.STATUS_PO,
              b.NO_SJ,
              b.TGL_SJ,
              c.SATUAN
            FROM ak_delivery_order a
            LEFT JOIN ak_penjualan b ON b.NO_BUKTI = a.NO_SO
            LEFT JOIN ak_penjualan_detail c ON c.ID_PENJUALAN = b.ID
            WHERE a.ID = '".$val->ID."'
            ORDER BY a.ID
          ";
          $q = $this->db->query($s)->result();

          foreach ($q as $key => $row) { 
            $no++;
            $total += $row->TOTAL;
          ?>
          <tr>
            <td style="border: 1px solid black;"><?=$no;?></td>
            <td style="border-bottom: 1px solid black;"><?=$row->NO_BUKTI;?></td>
            <td style="border-bottom: 1px solid black;"><?=$row->TGL_TRX  ;?></td>
            <td style="border: 1px solid black;"><?=$row->NAMA_PRODUK;?></td>
            <td style="border: 1px solid black; text-align: right;"><?=$row->QTY;?></td>
            <td style="border: 1px solid black;"><?=$row->SATUAN;?></td>
            <td style="border: 1px solid black; text-align: right;"><?=number_format($row->HARGA_SATUAN);?></td>
            <td style="border: 1px solid black; text-align: right;"><?=number_format($row->TOTAL);?></td>
            <td style="border-bottom: 1px solid black;"><?=$row->NO_SJ;?></td>
            <td style="border-bottom: 1px solid black;"><?=$row->TGL_SJ;?></td>
            <td style="border: 1px solid black; text-align: right;"><?=$row->QTY;?></td>
            <td style="border: 1px solid black; text-align: right;">0.00</td>
          </tr>
        <?PHP 
          }
        }
        ?>
		    <tr>
          <td style="border-top: 1px solid black;"></td>
          <td style="border-top: 1px solid black;"></td>
          <td style="border-top: 1px solid black;"></td>
          <td colspan="4" style="border: 1px solid black;">GRAND TOTAL</td>
          <td style="border: 1px solid black; text-align: right;"><?=number_format($total);?></td>
          <td style="border-top: 1px solid black;"></td>
          <td style="border-top: 1px solid black;"></td>
          <td style="border-top: 1px solid black;"></td>
          <td style="border-top: 1px solid black;"></td>
      	</tr>

      </tbody>
    </table>
    <div style="clear:both"></div>
    <br>
   
  </body>
</html>
