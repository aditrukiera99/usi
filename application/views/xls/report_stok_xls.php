<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_stok_persediaan.xls");
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

<table align="left">
    <tr>
        <td align="left" style="line-height: 7px;">
            <h3 style="font-weight: bold;">
                PT. UNITED SHIPPING INDONESIA
            </h3>
            <font style="font-size: 9px;">GONDOSULI NO. 08 RT 005 RW 006, KETABANG, GENTENG, SURABAYA</font>
        </td>
    </tr>
</table>
<br>
<table align="center">
    <tr>
        <td align="center">
            <h4>
                 LAPORAN DAFTAR STOK PERSEDIAAN  
            </h4>
        </td>
    </tr>
</table>
<br>

<table align="center" class="grid">
    <tr>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> NO </th>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> KODE PRODUK </th>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> NAMA PRODUK </th>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> STOK </th>
        <th style='vertical-align: middle; text-align:center; width:20%;' class='kolom_header'> HARGA </th>
    </tr>
    <?PHP 
    $no = 0;

    foreach ($data as $key => $row) {
        $no++;   
        $total_terima = $this->model->get_penerimaan_item(1, $row->NAMA_PRODUK);
        $total_keluar = $this->model->get_pengeluaran_item(1, $row->NAMA_PRODUK);
        $stok = $total_terima->TOTAL - $total_keluar->TOTAL;

        echo "<tr>" ;
            echo "<td class='gridtd' style='text-align:center;'>".$no."</td>";
            echo "<td class='gridtd' style='text-align:center;'>".$row->KODE_PRODUK."</td>";
            echo "<td class='gridtd' style='text-align:left;'>".$row->NAMA_PRODUK."</td>";
            echo "<td class='gridtd' style='text-align:center;'>".$stok." ".$row->SATUAN."</td>";
            echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->HARGA)."</td>";
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