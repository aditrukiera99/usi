<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_servis_kefarmasian.xls");
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
    font-size: 17px;
    height: 25px;
    padding-left: 5px;
    padding-right: 5px;
    border: 1px solid black;
}
.grid {
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
}

.grid td{
  border: 1px solid black;
}

.kolom_header{
    height: 40px;
    padding-left: 5px;
    padding-right: 5px;
    font-size: 17px;
}

</style>

<?PHP 
    $voc_now = "";
    $old_voc = "";
?>

<table cellspacing="0" align="left"> 
    <tr align="center">
        <td align="left" colspan="7">
            <h5>
                PT. PRIMA ELEKTRIK POWER <br>
                DIVISI <?=strtoupper($dt_unit->NAMA_UNIT);?>    
            </h5>
        </td>
    </tr>
</table>


<table align="center">
    <tr>
        <td align="center" colspan="7">
            <h4>
                LAPORAN SERVICE KEFARMASIAN <br>
                <?=strtoupper($judul);?>    
            </h4>
        </td>
    </tr>
</table>

<table align="center" class="grid">
    <tr>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> NO </th>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> NAMA JASA </th>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> HARGA </th>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> JASA DIPAKAI </th>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> PENDAPATAN JASA </th>
    </tr>
    <?PHP 
    $no = 0;

    foreach ($data as $key => $row) {
        $no++;   
        echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$no."</td>";
                echo "<td class='gridtd' style='text-align:center;'>".$row->NAMA_PRODUK."</td>";
                echo "<td class='gridtd' style='text-align:right;'>Rp ".format_akuntansi($row->HARGA_JUAL)."</td>";
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->TOTAL_QTY)."</td>";
                echo "<td class='gridtd' style='text-align:right;'>Rp ".format_akuntansi($row->HARGA_JUAL * $row->TOTAL_QTY)."</td>";
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
    exit();
?>