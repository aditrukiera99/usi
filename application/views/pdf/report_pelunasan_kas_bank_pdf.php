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
                Laporan Pelunasan Kas / Bank  <br>                
            </h3>
            <?=$judul;?>
        </td>
    </tr>
</table>

<table align="left" style="width:100%;">
    <tr>
        <td align="left" style="width: 10%;">Mata Uang</td>
        <td align="left" style="width: 25%; border-bottom: 1px solid;">IDR</td>
    </tr>
</table>


<table align="center" class="grid" style="width: 100%;">
    <tr>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> TANGGAL </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> NO VOUCHER </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> CUSTOMER  </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> KAS/BANK  </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> KETERANGAN  </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> TOTAL  </th>
        <th style='width: 20%;vertical-align: middle; text-align:center;' class='kolom_header' colspan="2"> BG/CHEQUE  </th>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> STATUS  </th>
    </tr>
    <tr>
        <th style='vertical-align: middle; text-align:center;' class='kolom_header'> NO </th>
        <th style='vertical-align: middle; text-align:center;' class='kolom_header'> TGL. JTEMPO </th>
    </tr>
    <?PHP 

    foreach ($data as $key => $row) {

        echo "<tr>" ;
            echo "<td class='gridtd' style='text-align:right;'>".$row->TGL."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->NO_VOUCHER."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->KONTAK."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->NAMA_AKUN."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->URAIAN."</td>" ;
            echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->TOTAL)."</td>" ;
            echo "<td class='gridtd' style='text-align:right;'></td>" ;
            echo "<td class='gridtd' style='text-align:right;'></td>" ;
            echo "<td class='gridtd' style='text-align:left;'>NEW</td>" ;
        echo "</tr>" ; 
    }
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
    $html2pdf->pdf->SetTitle('Laporan Kas Bank Rinci');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_kas_bank_rinci.pdf');
?>