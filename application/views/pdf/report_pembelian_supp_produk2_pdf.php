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
      <span><strong>Laporan Pembelian Per Supplier Detail Produk</strong></span><br>
      <span style="font-size: 100%;">PERIODE <?php echo $judul; ?></span>
    </div>
  </center>
  <div style="clear: both;"></div>
  <br>
  <table style="border: 1px solid black; border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <th rowspan="2" style="border: 1px solid black; text-align:center;">No</th>
          <th rowspan="2" style="border: 1px solid black; text-align:center;">Nama Supplier <br> Nama Item</th>
          <th rowspan="2" style="border: 1px solid black; text-align:center;">Kode Supplier <br> Kode Item</th>
          <th colspan="2" style="border: 1px solid black; text-align:center;">S/D <?php echo strtoupper($bulan_lalu); ?></th>
          <th colspan="2" style="border: 1px solid black; text-align:center;"><?php echo strtoupper($bulan); ?></th>
          <th colspan="2" style="border: 1px solid black; text-align:center;">S/D <?php echo strtoupper($bulan); ?></th>
        </tr>
        <tr>
          <th style="border: 1px solid black; text-align:center;">Qty</th>
          <th style="border: 1px solid black; text-align:center;">Nilai</th>
          <th style="border: 1px solid black; text-align:center;">Qty</th>
          <th style="border: 1px solid black; text-align:center;">Nilai</th>
          <th style="border: 1px solid black; text-align:center;">Qty</th>
          <th style="border: 1px solid black; text-align:center;">Nilai</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $no = 0;
        $tot1 = 0;
        $tot2 = 0;
        $tot3 = 0;

        foreach ($data as $key => $value) {
          $no++;
          $id_supplier = $value->ID_SUPPLIER;
          $nilai_lalu = $value->TOTAL_BLN_LALU;
          $nilai = $value->TOTAL;
          $nilai_skg = $nilai_lalu + $nilai;

          $tot1 += $nilai_lalu;
          $tot2 += $nilai;
          $tot3 += $nilai_skg;
      ?>
        <tr>
          <td style="border-left:1px solid black; text-align:center; "><?php echo $no; ?></td>
          <td style="border-left:1px solid black;">
            <?php echo $value->SUPPLIER; ?>
          </td>
          <td style="border-left:1px solid black;">
            <?php echo $value->KODE_SUP; ?>
          </td>
          <td style="border-left: 1px solid black;"></td>
          <td style="border-left: 1px solid black; text-align: right;"><?php echo number_format($nilai_lalu); ?></td>
          <td style="border-left: 1px solid black;"></td>
          <td style="border-left: 1px solid black; text-align: right;"><?php echo number_format($nilai); ?></td>
          <td style="border-left: 1px solid black;"></td>
          <td style="border-left: 1px solid black; border-right: 1px solid black; text-align: right;"><?php echo number_format($nilai_skg); ?></td>
        </tr>
      <?php
          $sql = "
            SELECT
              a.ID,
              a.KODE_SUP,
              a.ID_SUPPLIER,
              a.SUPPLIER,
              a.KODE_PRODUK,
              a.NAMA_PRODUK,
              SUM(a.QTY_BLN_LALU) AS QTY_BLN_LALU,
              SUM(a.HARGA_SATUAN_BLN_LALU) AS HARGA_SATUAN_BLN_LALU,
              SUM(a.TOTAL_LALU) AS TOTAL_LALU,
              SUM(a.QTY) AS QTY,
              SUM(a.HARGA_SATUAN) AS HARGA_SATUAN,
              SUM(a.TOTAL) AS TOTAL
            FROM(
              SELECT
                a.ID,
                b.KODE_SUP,
                a.ID_SUPPLIER,
                a.SUPPLIER,
                c.KODE_PRODUK,
                d.NAMA_PRODUK,
                IFNULL(e.QTY,0) AS QTY_BLN_LALU,
                IFNULL(e.HARGA_SATUAN,0) AS HARGA_SATUAN_BLN_LALU,
                IFNULL(e.TOTAL,0) AS TOTAL_LALU,
                '0' AS QTY,
                '0' AS HARGA_SATUAN,
                '0' AS TOTAL
              FROM ak_penerimaan_barang a
              LEFT JOIN ak_supplier b ON b.ID = a.ID_SUPPLIER
              LEFT JOIN ak_penerimaan_detail d ON d.ID_PENJUALAN = a.ID
              LEFT JOIN ak_produk c ON c.ID = d.ID_PRODUK
              LEFT JOIN(
                SELECT
                  b.TGL_TRX,
                  a.ID_PENJUALAN,
                  a.QTY,
                  a.HARGA_SATUAN,
                  a.TOTAL
                FROM ak_penerimaan_detail a
                LEFT JOIN ak_penerimaan_barang b ON b.ID = a.ID_PENJUALAN
                WHERE b.TGL_TRX LIKE '%-$bulan_lalu-$tahun%'
              ) e ON e.ID_PENJUALAN = a.ID

              UNION ALL

              SELECT
                a.ID,
                b.KODE_SUP,
                a.ID_SUPPLIER,
                a.SUPPLIER,
                c.KODE_PRODUK,
                d.NAMA_PRODUK,
                '0' AS QTY_BLN_LALU,
                '0' AS HARGA_SATUAN_BLN_LALU,
                '0' AS TOTAL_LALU,
                IFNULL(e.QTY,0) AS QTY,
                IFNULL(e.HARGA_SATUAN,0) AS HARGA_SATUAN,
                IFNULL(e.TOTAL,0) AS TOTAL
              FROM ak_penerimaan_barang a
              LEFT JOIN ak_supplier b ON b.ID = a.ID_SUPPLIER
              LEFT JOIN ak_penerimaan_detail d ON d.ID_PENJUALAN = a.ID
              LEFT JOIN ak_produk c ON c.ID = d.ID_PRODUK
              LEFT JOIN(
                SELECT
                  b.TGL_TRX,
                  a.ID_PENJUALAN,
                  a.QTY,
                  a.HARGA_SATUAN,
                  a.TOTAL
                FROM ak_penerimaan_detail a
                LEFT JOIN ak_penerimaan_barang b ON b.ID = a.ID_PENJUALAN
                WHERE b.TGL_TRX LIKE '%-$bulan-$tahun%'
              ) e ON e.ID_PENJUALAN = a.ID
            ) a
            WHERE a.ID_SUPPLIER = '$id_supplier'
            GROUP BY a.ID
            ORDER BY a.ID ASC
          ";

          $dt = $this->db->query($sql)->result();

          foreach ($dt as $k => $val) {
            $qty_bln_lalu = $val->QTY_BLN_LALU;
            $total_lalu = $val->TOTAL_LALU;
            $qty = $val->QTY;
            $total = $val->TOTAL;

            $qty_skg = $qty_bln_lalu + $qty;
            $tot_skg = $total_lalu + $total;
      ?>
          <tr>
            <td style="border-left:1px solid black; text-align:center; ">&nbsp;</td>
            <td style="border-left:1px solid black;">
              <font style="color: blue;"><?php echo $val->NAMA_PRODUK; ?></font>
            </td>
            <td style="border-left:1px solid black;">
              <font style="color: blue;"><?php echo $val->KODE_PRODUK; ?></font>
            </td>
            <td style="border-left:1px solid black; text-align: right;">
              <font style="color: blue;"><?php echo number_format($qty_bln_lalu); ?></font>
            </td>
            <td style="border-left:1px solid black; text-align: right;">
              <font style="color: blue;"><?php echo number_format($total_lalu); ?></font>
            </td>
            <td style="border-left:1px solid black; text-align: right;">
              <font style="color: blue;"><?php echo number_format($qty); ?></font>
            </td>
            <td style="border-left:1px solid black; text-align: right;">
              <?php echo number_format($total); ?><br>
              <font style="color: blue;"><?php echo number_format($total); ?></font>
            </td>
            <td style="border-left:1px solid black; text-align: right;">
              <font style="color: blue;"><?php echo number_format($qty_skg); ?></font>
            </td>
            <td style="border-left:1px solid black; border-right:1px solid black; text-align: right;">
              <?php echo number_format($tot_skg); ?><br>
              <font style="color: blue;"><?php echo number_format($tot_skg); ?></font>
            </td>
          </tr>
      <?php
          }
        }
      ?>

        <tr>
          <td colspan="3" style="border: 1px solid black; text-align: center;">TOTAL</td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot1); ?></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot2); ?></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($tot3); ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
