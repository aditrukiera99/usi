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
      <span><strong>Summary Piutang Customer</strong></span><br>
      <span style="font-size: 100%;"><?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <thead>
        <tr>   
          <td style="border-top: 0px solid black; text-align:left;">Mata Uang :</td>
          <td style="border: 1px solid black; text-align:left;">IDR</td>
          <td colspan="9" style="border-top: 0px solid black;"></td>
        </tr>
       
        <tr>
          <td rowspan="2" style="border: 1px solid black;">NAMA CUSTOMER</td>
          <td colspan="4" style="border: 1px solid black;">MASING - MASING MATA UANG</td>
          <td style="border: 1px solid black;"></td>
          <td colspan="5" style="border: 1px solid black;">DALAM RUPIAH (IDR)</td>
          
        </tr>

        <tr>
            <td style="border: 1px solid black;">SALDO AWAL</td>
            <td style="border: 1px solid black;">PENJUALAN</td>
            <td style="border: 1px solid black;">PELUNASAN</td>
            <td style="border: 1px solid black;">SALDO AKHIR</td>

            <td style="border: 1px solid black;"></td>

            <td style="border: 1px solid black;">SALDO AWAL</td>
            <td style="border: 1px solid black;">PENJUALAN</td>
            <td style="border: 1px solid black;">PELUNASAN</td>
            <td style="border: 1px solid black;">SELISIH KURS</td>
            <td style="border: 1px solid black;">SALDO AKHIR</td>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($data as $key => $value) {
          $id_pelanggan = $value->ID_PELANGGAN;
          $where = "1 = 1";
          $where2 = "1 = 1";

          if($value->ID_PELANGGAN != null){
            $where = $where." AND TGL_TRX LIKE '%-$bulan-$tahun%' AND ID_PELANGGAN = '$id_pelanggan'";
            $where2 = $where2." AND a.TGL_TRX LIKE '%-$bulan-$tahun%' AND a.ID_PELANGGAN = '$id_pelanggan'";
          }else{
            $where = $where." AND TGL_TRX LIKE '%-$bulan-$tahun%'";
            $where2 = $where2." AND a.TGL_TRX LIKE '%-$bulan-$tahun%'";
          }

          $sql = "
            SELECT
              a.ID_PELANGGAN,
              a.PELANGGAN,
              a.TGL_TRX,
              SUM(a.SUB_TOTAL) AS PENJUALAN,
              SUM(a.TOTAL_DO) AS PELUNASAN
            FROM(
              SELECT
                a.ID_PELANGGAN,
                a.PELANGGAN,
                a.TGL_TRX,
                (b.QTY * b.HARGA_SATUAN) AS TOTAL_DO,
                a.SUB_TOTAL
              FROM ak_penjualan a
              LEFT JOIN (
                SELECT * FROM ak_delivery_order
                WHERE $where
              ) b ON b.NO_SO = a.NO_BUKTI
              WHERE $where2
            ) a
            GROUP BY a.ID_PELANGGAN
          ";

          $query = $this->db->query($sql);
          $row = $query->row();
          $saldo_akhir = $value->SALDO_BLN_LALU - ($row->PENJUALAN - $row->PELUNASAN);
      ?>
        <tr>
          <td style="border: 1px solid black;"><?php echo $row->PELANGGAN; ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->SALDO_BLN_LALU); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($row->PENJUALAN); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($row->PELUNASAN); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo_akhir); ?></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($value->SALDO_BLN_LALU); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($row->PENJUALAN); ?></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($row->PELUNASAN); ?></td>
          <td style="border: 1px solid black; text-align: right;">0.00</td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($saldo_akhir); ?></td>
        </tr>
      <?php
        }
      ?>
    </table>
    <div style="clear:both"></div>
    <br>
   
  </body>
</html>

