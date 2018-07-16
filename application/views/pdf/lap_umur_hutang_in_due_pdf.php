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
      <span style="font-size: 120%;"><strong>LAPORAN UMUR HUTANG PER SUPPLIER PER FAKTUR<br><?php echo $judul; ?></strong></span>
    </div>
    <div style="clear: both;"></div>
  <div style="clear: both;"></div>
  <br>
    <table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <thead>
        <tr>
          <td></td>
          <td style="text-align:left;">Mata Uang</td>
          <td style="text-align:left;">IDR</td>
        </tr>
        <tr style="text-align:center; background-color: #BBDFEB;">
          <td style="border: 1px solid black;">NO</td>
          <td style="border: 1px solid black;">NO FAKTUR</td>
          <td style="border: 1px solid black;">TERMIN<br>(DAYS)</td>
          <td style="border: 1px solid black;">TANGGAL</td>
          <td style="border: 1px solid black;">TANGGAL JATUH TEMPO</td>
          <td style="border: 1px solid black;">TOTAL</td>
          <td style="border: 1px solid black;">RETUR</td>
          <td style="border: 1px solid black;">TERBAYAR</td>
          <td style="border: 1px solid black;">NILAI INVOICE</td>
          <td style="border: 1px solid black;">IN DUE<br>(current)</td>
        </tr>
      </thead>
      <tbody>
      <?php
        $total = 0;
        $tot_bayar = 0;
        $tot_invoice = 0;

        foreach ($data as $value) {
          $id_pelanggan = $value->ID_PELANGGAN;
          $invoice = $value->NILAI_INVOICE - $value->SUB_TOTAL;
      ?>
        <tr>
          <td style="border: 1px solid black;">&nbsp;</td>
          <td style="border: 1px solid black;">&nbsp;</td>
          <td style="border: 1px solid black;"><?php echo $value->PELANGGAN; ?></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; text-align: right;"><?php echo number_format($invoice); ?></td>
          <td style="border: 1px solid black;"></td>
        </tr>
      <?php
          $sql = "
            SELECT
              a.ID,
              a.NOMER_PO,
              a.NO_PO,
              a.ID_PELANGGAN,
              a.PELANGGAN,
              a.TGL_TRX,
              a.SUB_TOTAL AS TOTAL,
              a.JATUH_TEMPO,
              b.TERBAYAR,
              STR_TO_DATE(a.TGL_TRX, '%d-%m-%Y') AS TGL_WALIK
            FROM ak_pembelian a
            LEFT JOIN(
              SELECT
                a.ID,
                a.ID_PENJUALAN,
                SUM(a.TOTAL) AS TERBAYAR,
                b.NO_PO
              FROM ak_penerimaan_detail a
              LEFT JOIN ak_penerimaan_barang b ON b.ID = a.ID_PENJUALAN
              GROUP BY b.NO_PO
            ) b ON b.NO_PO = a.NO_PO
            WHERE a.ID_PELANGGAN = '$id_pelanggan'
          ";
          $qry = $this->db->query($sql);
          $res = $qry->result();

          $no = 0;

          foreach ($res as $key => $val) {
            $no++;
            $tgl = $val->TGL_WALIK;
            $tempo = $val->JATUH_TEMPO;
            $date = strtotime("+".$tempo." days", strtotime($tgl));
            $tgl_tempo = date("d-m-Y", $date);
            $nilai_invoice = $val->TERBAYAR - $val->TOTAL;
            $total += $val->TOTAL;
            $tot_bayar += $val->TERBAYAR;
            $tot_invoice += $nilai_invoice;
      ?>
          <tr>
            <td style="border: 1px solid black; text-align: center;"><?php echo $no; ?></td>
            <td style="border: 1px solid black;"><?php echo $val->NOMER_PO; ?></td>
            <td style="border: 1px solid black; text-align: right;">0</td>
            <td style="border: 1px solid black; text-align: right;"><?php echo $val->TGL_TRX; ?></td>
            <td style="border: 1px solid black; text-align: right;"><?php echo $tgl_tempo; ?></td>
            <td style="border: 1px solid black; text-align: right;"><?php echo number_format($val->TOTAL); ?></td>
            <td style="border: 1px solid black;">Rp -</td>
            <td style="border: 1px solid black; text-align: right;"><?php echo number_format($val->TERBAYAR); ?></td>
            <td style="border: 1px solid black; text-align: right;"><?php echo number_format($nilai_invoice); ?></td>
            <td style="border: 1px solid black; text-align: right;">-</td>
          </tr>
      <?php
          }
        }
      ?>

        <tr>
          <td colspan="5" style="border: 1px solid black; font-weight: bold; text-align: right;">GRAND TOTAL</td>
          <td style="border: 1px solid black; font-weight: bold; text-align: right;">Rp <?php echo number_format($total); ?></td>
          <td style="border: 1px solid black; font-weight: bold;">Rp -</td>
          <td style="border: 1px solid black; font-weight: bold; text-align: right;">Rp <?php echo number_format($tot_bayar); ?></td>
          <td style="border: 1px solid black; font-weight: bold; text-align: right;"><?php echo number_format($tot_invoice); ?></td>
          <td style="border: 1px solid black; font-weight: bold; text-align: right;">-</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
