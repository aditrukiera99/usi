<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<style>
.gridth {
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    font-size: 12px;
}
.gridtd {
    vertical-align: middle;
    font-size: 12px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
    border-collapse: collapse;
}

.grid td, table th {
  border: 1px solid black;
  padding-top:5px;
  padding-bottom:5px;
}

.kolom_header{
    font-size: 12px;
}

</style>

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
                Laporan Penerimaan Kas / Bank  <br>                
            </h3>
            <?=$judul;?>
        </td>
    </tr>
</table>

<table align="center" class="grid" style="width: 100%;">
    <tr>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header'> Mata Uang :</th>
        <th style='width: 10%;vertical-align: middle; text-align:left;' class='kolom_header'>&nbsp;&nbsp;&nbsp; IDR </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' colspan="6">  </th>
    </tr>
    <tr>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header'> TANGGAL </th>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header'> NO TRANSAKSI </th>
        <th style='width: 20%;vertical-align: middle; text-align:center;' class='kolom_header'> KAS/BANK  </th>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header'> KETERANGAN  </th>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header'> TOTAL  </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header'> NO CHEQUE  </th>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header'> JATUH TEMPO  </th>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header'> STATUS  </th>
    </tr>
    <?PHP 
    $subtotal = 0;
    foreach ($data as $key => $row) {
        $subtotal += $row->TOTAL;
        echo "<tr>" ;
            echo "<td class='gridtd' style='text-align:right;'>".$row->TGL."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->NO_VOUCHER."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->NAMA_AKUN."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'></td>" ;
            echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->TOTAL)."</td>" ;
            echo "<td class='gridtd' style='text-align:right;'></td>" ;
            echo "<td class='gridtd' style='text-align:right;'></td>" ;
            echo "<td class='gridtd' style='text-align:left;'>NEW</td>" ;
        echo "</tr>" ; 

        if($jns_laporan == "rinci"){
        $dt_detail = $this->db->query(" SELECT a.*, b.NAMA_AKUN FROM ak_input_voucher_detail a 
                                        LEFT JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN
                                        WHERE a.NO_VOUCHER_DETAIL = '".$row->NO_VOUCHER."' AND KREDIT > 0
                                    ")->result();
        foreach ($dt_detail as $key_2 => $row_det) {
        echo "<tr>" ;
            echo "<td class='gridtd' style='font-size:10px; text-align:left;'>".$row_det->NAMA_AKUN."</td>" ;
            echo "<td class='gridtd' style='font-size:10px; text-align:left;'>".$row_det->KODE_AKUN."</td>" ;
            echo "<td class='gridtd' style='font-size:10px; text-align:left;' colspan='2'>".$row_det->KET."</td>" ;
            echo "<td class='gridtd' style='font-size:10px; text-align:right;'>".format_akuntansi($row_det->KREDIT)."</td>" ;
        echo "</tr>" ; 
        }
        }
    }


    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:right;' colspan='4'>TOTAL</td>" ;
        echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($subtotal)."</td>" ;
        echo "<td class='gridtd' style='text-align:right;' colspan='3'></td>" ;
    echo "</tr>" ; 

    ?>
</table>


<?PHP 
    function format_akuntansi($value)
    {
        if($value > 0){
            $value = number_format($value, 2);
        } else if($value == 0){
            $value = 0;
        } else {
            $value = "(".number_format(abs($value), 2).")";
        }
        return $value;
    }
?>

<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 26.4;
    $height_in_mm = $height_in_inches * 26.4;
    $html2pdf = new HTML2PDF('L','A4','en');
    $html2pdf->pdf->SetTitle('Laporan Penerimaan Kas/Bank');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_penerimaan_kas_bank.pdf');
?>