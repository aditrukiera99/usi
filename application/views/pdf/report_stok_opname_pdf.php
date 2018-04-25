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
  border-bottom: : 1px solid black;
}

.kolom_header{
    height: 30px;
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
                PT. Prima Elektrik Power <br><br>
                Divisi <?=strtoupper($dt_unit->NAMA_UNIT);?>    
            </h5>
        </td>
    </tr>
</table>

<hr>

<table align="center">
    <tr>
        <td align="center">
            <h4>
                LAPORAN STOCK OPNAME <br>
                <?=strtoupper($judul);?>   
            </h4>
        </td>
    </tr>
</table>


<table align="center" class="grid">
    <tr>
        <th style='vertical-align: middle; text-align:center; width:15%;' class='kolom_header'> NO OPNAME </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> TGL </th>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> CATATAN </th>
        <th style='vertical-align: middle; text-align:center; width:15%;' class='kolom_header'> ITEM </th>
        <th style='vertical-align: middle; text-align:center; width:13%;' class='kolom_header'> QTY ON HAND </th>
        <th style='vertical-align: middle; text-align:center; width:13%;' class='kolom_header'> QTY FISIK </th>
        <th style='vertical-align: middle; text-align:center; width:13%;' class='kolom_header'> SELISIH QTY </th>
    </tr>
    <?PHP 
    $no = 0;

    foreach ($data as $key => $row) {
        $no++;   


        echo "<tr>" ;
            echo "<td class='gridtd' style='text-align:center;'>".$row->NO_OPNAME."</td>";
            echo "<td class='gridtd' style='text-align:center;'>".$row->TGL."</td>";
            echo "<td class='gridtd' style='text-align:left;'>".$row->CATATAN."</td>";

            $dt_detail = $this->model->get_data_opname_detail_id($row->ID);
            foreach ($dt_detail as $key => $row_det) {
                echo "<tr>" ;
                if($key > 0){
                    echo "<td class='gridtd' style='text-align:left;' colspan='3'></td>";
                }
                echo "<td class='gridtd' style='text-align:left;'>".$row_det->NAMA_PRODUK."</td>";
                echo "<td class='gridtd' style='text-align:right;'>".$row_det->QTY_HAND."</td>";
                echo "<td class='gridtd' style='text-align:right;'>".$row_det->QTY_FISIK."</td>";
                echo "<td class='gridtd' style='text-align:right;'>".$row_det->SELISIH_QTY."</td>";
                echo "</tr>" ;

            }

        echo "</tr>" ; 
    }
    ?>


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
    $html2pdf->pdf->SetTitle('Laporan Stok Opname');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_stok_opname.pdf');
?>