<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_penjualan.xls");
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
    font-size: 17px;
    height: 25px;
    padding-left: 5px;
    padding-right: 5px;
    border-left: 1px solid black;
    border-right: 1px solid black;
}
.grid {
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
}

.grid td{
  border-left: 1px solid black;
  border-right: 1px solid black;
}

.kolom_header{
    height: 40px;
    background: #388ed1;
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
                PD CITRA MANDIRI JAWA TENGAH <br>
                UNIT <?=strtoupper($dt_unit->NAMA_UNIT);?>    
            </h5>
        </td>
    </tr>
</table>


<table align="center">
    <tr>
        <td align="center" colspan="7">
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
    exit();
?>