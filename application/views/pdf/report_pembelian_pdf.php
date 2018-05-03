<?PHP 
ob_start(); 
?>
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
  <body class="body">

    <table align="left" style="margin-left: 15px;">
        <tr>
            <td align="left" style="line-height: 7px;">
                <h3 style="font-weight: bold;">
                    PT. UNITED SHIPPING INDONESIA
                </h3>
                <font style="font-size: 9px;">GONDOSULI NO. 08 RT 005 RW 006, KETABANG, GENTENG, SURABAYA</font>
            </td>
        </tr>
    </table>

    <table align="center" style="width:100%;">
        <tr>
            <td align="center" style="line-height: 7px;">
                <h3>
                    Laporan Pembelian Produk  <br>                
                </h3>
                <b>TANGGAL : <?=$judul;?></b>
            </td>
        </tr>
    </table>

    

  <br>
  <table style="border: 1px solid black; border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;" align="center">
      <tbody>
        <tr style="font-weight: bold;">
          <td rowspan="2" style="width: 5%; border: 1px solid black;">No</td>
          <td rowspan="2" style="width: 15%; border: 1px solid black;">Nama Item <br> Nama Supplier</td>
          <td rowspan="2" style="width: 7%; border: 1px solid black;">Kode Item <br> Kode Supplier </td>
          <td rowspan="2" style="width: 7%; border: 1px solid black;">Tanggal</td>
          <td rowspan="2" style="width: 10%; border: 1px solid black;">No Faktur</td>
          <td rowspan="2" style="width: 10%; border: 1px solid black;">No Reff</td>
          <td rowspan="2" style="width: 7%; border: 1px solid black;">Jml</td>
          <td rowspan="2" style="width: 7%; border: 1px solid black;">Sat</td>
          <td style="border: 1px solid black;">Jml x Harga</td>
          <td style="border: 1px solid black;">Jml x Diskon</td>
          <td rowspan="2" style="width: 7%; border: 1px solid black;">Total</td>
          <td rowspan="2" style="width: 7%; border: 1px solid black;">Kurs</td>
          <td rowspan="2" style="width: 7%; border: 1px solid black;">Total IDR</td>
        </tr>
        <tr style="font-weight: bold;">
          <td style="border: 1px solid black;">Harga @</td>
          <td style="border: 1px solid black;">Diskon @</td>
        </tr>
        <?PHP 
        $no = 0;
        $tot_harga = 0;
        $subtotal = 0;
        foreach ($data as $key => $row) { 
            $no++;
        ?>
        <tr style="color: blue;">
          <td style="border: 1px solid black;"><?=$no;?></td>
          <td style="border: 1px solid black; text-align: left;"><?=$row->NAMA_PRODUK;?></td>
          <td style="border: 1px solid black;"><?=$row->KODE_PRODUK;?></td>
          <td style="border: 1px solid black;" colspan="10"></td>
        </tr>

        <?PHP 
        $dt_detail = $this->db->query(
            "SELECT a.*, b.QTY, b.SATUAN, b.HARGA_SATUAN, b.TOTAL FROM ak_pembelian a
             LEFT JOIN ak_pembelian_detail b ON a.ID = b.ID_PENJUALAN 
             WHERE b.ID_PRODUK = '".$row->ID."'
        ")->result();

        foreach ($dt_detail as $key2 => $row_det) {

            $tot_harga += $row_det->HARGA_SATUAN;
            $subtotal += $row_det->TOTAL;

            echo "<tr>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:right;'></td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:left;'>".$row_det->PELANGGAN."</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:left;'></td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:left;'>".$row_det->TGL_TRX."</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:left;'>".$row_det->NO_PO."</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:left;'>".$row_det->NO_SO."</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:right;'>".$row_det->QTY."</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:right;'>".$row_det->SATUAN."</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:right;'>".number_format($row_det->HARGA_SATUAN)."</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:right;'>0.00</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:right;'>".number_format($row_det->TOTAL)."</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:right;'>1.00</td>" ;
                echo "<td class='gridtd' style='border: 1px solid black; text-align:right;'>".number_format($row_det->TOTAL)."</td>" ;
            echo "</tr>" ; 
        }

        ?>
        <?PHP } ?>
        <tr>
          <td colspan="6" style="font-weight: bold; border: 1px solid black;">TOTAL</td>
          <td style="text-align: right; font-weight: bold; border: 1px solid black;"></td>
          <td style="text-align: right; font-weight: bold; border: 1px solid black;"></td>
          <td style="text-align: right; font-weight: bold; border: 1px solid black;"><?=number_format($tot_harga);?></td>
          <td style="text-align: right; font-weight: bold; border: 1px solid black;">0.00</td>
          <td style="text-align: right; font-weight: bold; border: 1px solid black;"><?=number_format($subtotal);?></td>
          <td style="text-align: right; font-weight: bold; border: 1px solid black;"></td>
          <td style="text-align: right; font-weight: bold; border: 1px solid black;"><?=number_format($subtotal);?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>

<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 26.4;
    $height_in_mm = $height_in_inches * 26.4;
    $html2pdf = new HTML2PDF('L','A4','en');
    $html2pdf->pdf->SetTitle('Laporan');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_pembelian_produk.pdf');
?>