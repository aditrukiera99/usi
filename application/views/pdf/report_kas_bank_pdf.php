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
    font-size: 14px;
}
.gridtd {
    vertical-align: middle;
    font-size: 14px;
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
                LAPORAN KAS-BANK <?=$judul_2;?> <br>                
            </h3>
            <?=$judul;?>
        </td>
    </tr>
</table>

<table align="center" class="grid" style="width: 100%;">
    <tr>
        <th style='width: 5%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> NO </th>
        <th style='width: 30%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> BANK </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> SALDO AWAL  </th>
        <th style='width: 30%;vertical-align: middle; text-align:center;' class='kolom_header' colspan="2"> MUTASI  </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> SALDO AKHIR  </th>
    </tr>
    <tr>
        <th style='vertical-align: middle; text-align:center;' class='kolom_header'> PENERIMAAN </th>
        <th style='vertical-align: middle; text-align:center;' class='kolom_header'> PENGELUARAN </th>
    </tr>
    <?PHP 
    $no = 0;

    foreach ($data as $key => $row) {
        $no++;   

        echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$no."</td>" ;
                echo "<td class='gridtd' style='text-align:left;'>".$row->NAMA_AKUN."</td>" ;
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->SALDO_AWAL)."</td>" ;
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->PENERIMAAN)."</td>" ;
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->PENGELUARAN)."</td>" ;
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->SALDO_AWAL + ($row->PENERIMAAN - $row->PENGELUARAN) )."</td>" ;
            echo "</tr>" ; 

    }
    ?>

    <!-- <tr>
        <th style='border: 1px solid #000 !important; text-align:center;' class='kolom_header'  colspan="7">SUBTOTAL</th>
        <th style='border: 1px solid #000 !important; text-align:center;' class='kolom_header'><b><?=format_akuntansi($tot_qty);?> LITER</b></th>
        <th style='border: 1px solid #000 !important; text-align:right;' class='kolom_header'><b>Rp <?=format_akuntansi($tot_nilai);?></b></th>
        <th style='border: 1px solid #000 !important; text-align:right;' class='kolom_header'><b>Rp <?=format_akuntansi($tot_hpp);?></b></th>
        <th style='border: 1px solid #000 !important; text-align:right;' class='kolom_header'><b>Rp <?=format_akuntansi($tot_laba);?></b></th>
        <th style='border: 1px solid #000 !important; text-align:center;' class='kolom_header'><b> <?=number_format((float)$tot_prosen, 2, '.', '');?>%</b></th>
    </tr> -->
</table>

<?PHP if(count($data) == 0){ ?>

<table align="center" class="grid" style="width:100%;">
    <tr>
        <td class='gridtd' colspan='6' align="center"> <b> Tidak ada data yang dapat ditampilkan </b> </td>
    </tr>
</table>

<?PHP } ?>

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
    $html2pdf = new HTML2PDF('P',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle('Laporan Kas Bank');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_kas_bank.pdf');
?>