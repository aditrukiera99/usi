<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_daftar_produk.xls");
?>


<style>
.gridth {
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 14px;
}
.gridtd {
    vertical-align: middle;
    font-size: 18px;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
    border: 1px solid #999;
    width: 200px;
}
.grid {
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
}

.grid td {
    border: 1px solid #999;
}

.kolom_header{
    height: 35px;
    padding: 10px;
    vertical-align: middle;
    font-size: 18px;
}

</style>

<table cellspacing="0" align="left"> 
    <tr align="center">
        <td align="left">
            <h5>
                PT. PRIMA ELEKTRIK POWER <br>
                DIVISI <?=strtoupper($dt_unit->NAMA_UNIT);?>    
            </h5>
        </td>
    </tr>
</table>

<table align="center">
    <tr>
        <td align="center">
            <h4>
                LAPORAN DAFTAR PRODUK <br>
                <?=strtoupper($judul);?>   
            </h4>
        </td>
    </tr>
</table>


<table align="center" class="grid">
    <tr>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> NO </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> KODE PRODUK </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> NAMA PRODUK </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> KATEGORI </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> SATUAN </th>
        <th style='vertical-align: middle; text-align:center; width:10%;' class='kolom_header'> STOK </th>
        <th style='vertical-align: middle; text-align:center; width:12%;' class='kolom_header'> HARGA BELI </th>
        <th style='vertical-align: middle; text-align:center; width:12%;' class='kolom_header'> HARGA JUAL </th>
    </tr>
    <?PHP 
    $no = 0;

    foreach ($data as $key => $row) {
        $no++;   


        echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$no."</td>";
                echo "<td class='gridtd' style='text-align:center;'>".$row->KODE_PRODUK."</td>";
                echo "<td class='gridtd' style='text-align:left;'>".$row->NAMA_PRODUK."</td>";
                echo "<td class='gridtd' style='text-align:left;'>".$row->KATEGORI_PRODUK."</td>";
                echo "<td class='gridtd' style='text-align:center;'>".$row->SATUAN."</td>";    
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->STOK)."</td>";
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->HARGA)."</td>";
                echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->HARGA_JUAL)."</td>";
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
            $value = "(".$value.")";
        }

        return $value;
    }
?>


<?PHP
    exit();
?>