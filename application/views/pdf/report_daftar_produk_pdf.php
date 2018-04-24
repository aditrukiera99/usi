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
    $html2pdf->pdf->SetTitle('Laporan Daftar Produk');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('laporan_daftar_produk.pdf');
?>