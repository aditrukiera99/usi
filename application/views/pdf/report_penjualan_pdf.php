<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<style>
.gridth {
    background: #1793d1;
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 15px;
}
.gridtd {
    vertical-align: middle;
    font-size: 14px;
    height: 15px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
}

.grid td{
  border-left: 1px solid black;
  border-right: : 1px solid black;
}

.kolom_header{
    height: 30px;
    background: #388ed1;
    padding-left: 5px;
    padding-right: 5px;
    font-size: 14px;
}

</style>

<?PHP 
    $voc_now = "";
    $old_voc = "";
?>

<table cellspacing="0" align="left"> 
    <tr align="center">
        <td align="left">
            <h5>
                PT. Prima Elektrik Power <br> <br>
                DIVISI <?=strtoupper($dt_unit->NAMA_UNIT);?>    
            </h5>
        </td>
    </tr>
</table>

<hr>

<table align="center">
    <tr>
        <td align="center">
            <h4>
                LAPORAN PENJUALAN <br>
                <?=strtoupper($judul);?>   
            </h4>
        </td>
    </tr>
</table>

<table align="center" class="grid">
    <tr>
        <th style='vertical-align: middle; text-align:center; width:5%;' class='kolom_header'> NO </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> TANGGAL </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> INVOICE </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> NAMA BARANG </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> PELANGGAN </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> JUMLAH </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> TOT NILAI </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> TOT HPP </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> LABA KTR </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> % </th>
    </tr>
    <?PHP 
    $no = 0;
    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
    echo "</tr>" ;

    $subtotal = 0;

    $tot_qty = 0;
    $tot_nilai = 0;
    $tot_hpp = 0;
    $tot_laba = 0;
    $tot_prosen = 0;

    foreach ($data as $key => $row) {
        $subtotal += $row->TOTAL;
        $no++;   

        $hpp = $row->QTY * $row->HARGA_BELI;
        $laba_kotor = $row->TOTAL - $hpp;

        $prosen = ($laba_kotor / $hpp) * 100;
        $prosen_txt = number_format((float)$prosen, 2, '.', '');

        $tot_qty += $row->QTY;
        $tot_nilai += $row->TOTAL;
        $tot_hpp += $hpp;
        $tot_laba += $laba_kotor;
        $tot_prosen += $prosen;

        echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$no."</td>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$row->TGL_TRX."</td>" ;
                echo "<td class='gridtd' style='text-align:left;'>".$row->NO_BUKTI."</td>" ;
                echo "<td class='gridtd' style='text-align:left;'>".$row->NAMA_PRODUK."</td>" ; 
                echo "<td class='gridtd' style='text-align:left;'>".$row->PELANGGAN."</td>" ; 
                echo "<td class='gridtd' style='text-align:center;'>".$row->QTY."</td>" ;                 
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->TOTAL)."</td>" ; 
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($hpp)."</td>" ; 
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($laba_kotor)."</td>" ; 
                echo "<td class='gridtd' style='text-align:center;'>".$prosen_txt."%</td>" ; 
            echo "</tr>" ; 

        $old_voc = $row->ID;
    }
    ?>

    <?PHP 
    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
    echo "</tr>" ;
    ?>

    <tr>
        <th style='text-align:center;' class='kolom_header' colspan="5"> </th>
        <th style='text-align:center;' class='kolom_header'><b><?=$tot_qty;?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_nilai);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_hpp);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_laba);?></b></th>
        <th style='text-align:center;' class='kolom_header'><b><?=number_format((float)$tot_prosen, 2, '.', '');?>%</b></th>
    </tr>
</table>

<?PHP if(count($data) == 0){ ?>

<table align="center" class="grid" style="width:100%;">
    <tr>
        <td class='gridtd' align="center"> <b> Tidak ada data yang dapat ditampilkan </b> </td>
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
            $value = number_format(abs($value), 2);
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
    $width_in_mm = $width_in_inches * 17.4;
    $height_in_mm = $height_in_inches * 22.4;
    $html2pdf = new HTML2PDF('L','A4','en');
    $html2pdf->pdf->SetTitle('Laporan Penjualan');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_penjualan.pdf');
?>