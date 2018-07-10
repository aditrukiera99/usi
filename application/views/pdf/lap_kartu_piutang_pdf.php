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
      <span><strong>KARTU PIUTANG</strong></span><br>
      <span style="font-size: 100%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
    <thead>
        MATA UANG  : <b>IDR</b>
        <br><br>
        CUSTOMER &nbsp : <b>PT.PUTRA PERKASA ABADI (IDR) </b>
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td rowspan="2" style="border: 1px solid black;">TANGGAL</td>
          <td rowspan="2" style="border: 1px solid black;">TRANSAKSI</td>
          <td rowspan="2" style="border: 1px solid black;">NO TRANSAKSI</td>
          <td rowspan="2" style="border: 1px solid black;">KETERANGAN</td>
          <td colspan="3" style="border: 1px solid black;">JUMLAH</td>
        </tr>
        <tr>
          <td style="border: 1px solid black;">FAKTUR</td>
          <td style="border: 1px solid black;">PELUNASAN</td>
          <td style="border: 1px solid black;">SALDO</td>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;">PELUNASAN</td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
      </tr>
      <?php
        $saldo_bln_lalu = 0;
        foreach ($data as $key => $value) {
          if($value->SALDO_BLN_LALU < 0){
            $saldo_bln_lalu = str_replace(',', '', $value->SALDO_BLN_LALU);
          }else{
            $saldo_bln_lalu = $value->SALDO_BLN_LALU;
          }
      ?>
      <tr>
        <td style="border: 1px solid black; text-align: left;"><?php echo $bln_wingi; ?></td>
        <td style="border: 1px solid black; text-align: left;">Saldo</td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo_bln_lalu); ?></td>
      </tr>
      <?php
        }

        $where = "1 = 1";
        $where2 = "1 = 1";

        if($filter == "Harian"){
          $where = $where." AND STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') 
                            AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')";
        }else{
          $where = $where." AND a.TGL LIKE '%-$bulan-$tahun%'";
        }

        $sql = "
          SELECT
            a.ID,
            a.TGL,
            a.NO_VOUCHER,
            a.TIPE,
            IFNULL(b.SUB_TOTAL,0) AS SUB_TOTAL,
            IFNULL((c.QTY * c.HARGA_SATUAN),0) AS TOTAL_DO,
            b.NOMER_SO
          FROM ak_input_voucher a
          LEFT JOIN ak_penjualan b ON a.NO_BUKTI = b.NO_BUKTI
          LEFT JOIN ak_delivery_order c ON c.NO_SO = a.NO_BUKTI
          WHERE $where
        ";

        $dt = $this->db->query($sql)->result();
        $tot_faktur = 0;
        $tot_pelunasan = 0;

        foreach ($dt as $key => $value) {
          $saldo = $saldo_bln_lalu - $value->TOTAL_DO;
          $tot_faktur += $value->SUB_TOTAL;
          $tot_pelunasan += $value->TOTAL_DO;
      ?>
      <tr>
        <td style="border: 1px solid black; text-align: left;"><?php echo $value->TGL; ?></td>
        <td style="border: 1px solid black; text-align: left;"><?php echo $value->TIPE; ?></td>
        <td style="border: 1px solid black; text-align: left;"><?php echo $value->NO_VOUCHER; ?></td>
        <td style="border: 1px solid black; text-align: left;"><?php echo $value->NOMER_SO; ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->SUB_TOTAL); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->TOTAL_DO); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo); ?></td>
      </tr>
      <?php
        }
      ?>
      <tr>
        <td></td>
        <td></td>
        <td>Total</td>
        <td><?php echo number_format($tot_faktur); ?></td>
        <td><?php echo number_format($tot_pelunasan); ?></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="7">&nbsp;</td>
      </tr>
      <tr>
        <td style="border: 1px solid black;" colspan="4"></td>
        <td style="border: 1px solid black; text-align: center;">PENJUALAN</td>
        <td style="border: 1px solid black; text-align: center;">PELUNASAN</td>
        <td style="border: 1px solid black; text-align: center;">SALDO</td>
      </tr>
      <tr>
        <td style="border: 1px solid black;" colspan="4"></td>
        <td style="border: 1px solid black; text-align: center;">FAKTUR</td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td style="border: 1px solid black;" colspan="4" style="text-align: center;">SALDO AWAL</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo_bln_lalu); ?></td>
        <td style="border: 1px solid black; text-align: right;"></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo_bln_lalu); ?></td>
      </tr>
      <tr>
        <td style="border: 1px solid black;" colspan="4" style="text-align: center;">GRAND TOTAL PIUTANG</td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot_faktur); ?></td>
        <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo_bln_lalu); ?></td>
        <td style="border: 1px solid black; text-align: right;">0.00</td>
      </tr>
    </tbody>
  </table>
  <div style="clear:both"></div>
  <br>
   
  </body>
</html>

