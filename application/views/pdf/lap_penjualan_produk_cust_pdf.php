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
    <table style="border: 1px solid black; border-collapse: collapse; width: 100%; font-size: 80%;">
      <tbody>
        <tr>
          <td style="border: 1px solid black; text-align: center;">No</td>
          <td style="border: 1px solid black; text-align: center;">Kode Item <br> Kode Customer</td>
          <td style="border: 1px solid black; text-align: center;">Nama Item <br> Nama Customer</td>
          <td style="border: 1px solid black; text-align: center;">Qty</td>
          <td style="border: 1px solid black; text-align: center;">Nilai</td>
          <td style="border: 1px solid black; text-align: center;">Kurs</td>
          <td style="border: 1px solid black; text-align: center;">Nilai IDR</td>
        </tr>

        <?PHP 
          $no = 0;
          $total_all = 0;
          $qty_tot = 0;
          $nilai_tot = 0;
          foreach ($data as $key => $row) {
            $no++;
            $total_all += $row->JML * $row->HARGA_SATUAN;
            $qty_tot = $row->JML;
            $nilai_tot = $row->NILAI;
        ?>
        <tr>
          <td class="tg-yw4l" style="text-align: center;"><?=$no;?></td>
          <td class="tg-yw4l" style="border-left: 1px solid #000;"><?=$row->NAMA_PRODUK;?></td>
          <td class="tg-yw4l" style="border-left: 1px solid #000;"><?=$row->KODE_PRODUK;?></td>
          <td class="tg-yw4l" style="border-left: 1px solid #000; text-align: right;"><?=number_format($row->JML);?></td>
          <td class="tg-yw4l" style="border-left: 1px solid #000; text-align: right;"><?=number_format($row->NILAI);?></td>
          <td class="tg-yw4l"></td>
          <td class="tg-yw4l" style="border-left: 1px solid #000; text-align: right;"><?=number_format($row->NILAI);?></td>
        </tr>

        <?PHP
          $sql_det = '';
          if($filter == "Harian"){
            $sql_det = "
              SELECT
                a.ID,
                a.NO_BUKTI,
                a.KODE_PELANGGAN,
                a.PELANGGAN AS NAMA_PELANGGAN,
                a.TGL_TRX,
                SUM(a.JML_BLN_SKG) AS QTY,
                SUM(a.NILAI_BLN_SKG) AS TOTAL
              FROM(
                SELECT
                  a.ID,
                  a.NO_BUKTI,
                  b.KODE_PELANGGAN,
                  a.PELANGGAN,
                  a.TGL_TRX,
                  a.QTY AS JML_BLN_SKG,
                  (a.QTY * a.HARGA_SATUAN) AS NILAI_BLN_SKG
                FROM ak_delivery_order a
                LEFT JOIN ak_pelanggan b ON b.ID = a.ID_PELANGGAN
                WHERE STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') 
                AND STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
              ) a
              GROUP BY a.TGL_TRX
            ";
          }else{
            $sql_det = "
              SELECT
                a.ID,
                a.NO_BUKTI,
                a.KODE_PELANGGAN,
                a.PELANGGAN AS NAMA_PELANGGAN,
                a.TGL_TRX,
                SUM(a.JML_BLN_SKG) AS QTY,
                SUM(a.NILAI_BLN_SKG) AS TOTAL
              FROM(
                SELECT
                  a.ID,
                  a.NO_BUKTI,
                  b.KODE_PELANGGAN,
                  a.PELANGGAN,
                  a.TGL_TRX,
                  a.QTY AS JML_BLN_SKG,
                  (a.QTY * a.HARGA_SATUAN) AS NILAI_BLN_SKG
                FROM ak_delivery_order a
                LEFT JOIN ak_pelanggan b ON b.ID = a.ID_PELANGGAN
                WHERE a.TGL_TRX LIKE '%-$bulan_skg-$tahun%'
              ) a
              GROUP BY a.TGL_TRX
            ";
          }

            $dt_det = $this->db->query($sql_det)->result();
            foreach ($dt_det as $key => $row_det) {
        ?>
            <tr>
              <td class="tg-yw4l"></td>
              <td class="tg-yw4l" style="border-left: 1px solid #000;"><?=$row_det->NAMA_PELANGGAN;?></td>
              <td class="tg-yw4l" style="border-left: 1px solid #000;"></td>
              <td class="tg-yw4l" style="border-left: 1px solid #000; text-align: right;"><?=number_format($row_det->QTY);?></td>
              <td class="tg-yw4l" style="border-left: 1px solid #000; text-align: right;"><?=number_format($row_det->TOTAL);?></td>
              <td class="tg-yw4l" style="border-left: 1px solid #000; text-align: right;">1.00</td>
              <td class="tg-yw4l" style="border-left: 1px solid #000; text-align: right;"><?=number_format($row_det->TOTAL);?></td>
            </tr> 
        <?PHP 
            } 
          } 
        ?>
            <tr>
              <td colspan="3" style="text-align: right; border:1px solid #000;">TOTAL</td>
              <td style="text-align: right; border:1px solid #000;"><?=number_format($qty_tot);?></td>
              <td style="text-align: right; border:1px solid #000;"><?=number_format($nilai_tot);?></td>
              <td style="border:1px solid #000;"></td>
              <td style="text-align: right; border:1px solid #000;"><?=number_format($nilai_tot);?></td>
            </tr>
      </tbody>
    </table>
  </body>

</html>
