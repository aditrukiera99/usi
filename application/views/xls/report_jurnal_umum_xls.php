<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_jurnal_memorial.xls");
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
    height: 15px;
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

<table align="center" style="width:100%;">
    <tr>
        <td align="center" colspan="5">
            <h4>
                JURNAL MEMORIAL
                <?=strtoupper($judul);?> <br>   
                UNIT : <?=strtoupper($dt_unit->NAMA_UNIT);?>        
            </h4>
        </td>
    </tr>
</table>


<table align="center" class="grid" style="width:100%;">
    <tr>
        <th style='text-align:center; width:15%;' class='kolom_header'> TANGGAL </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> NO AKUN </th>
        <th style='text-align:center; width:50%;' class='kolom_header'> KETERANGAN </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> DEBET </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> KREDIT </th>
    </tr>
    <?PHP 
    $no = 0;
    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
    echo "</tr>" ;

    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
    echo "</tr>" ;

    $totalDebet = 0;
    $totalKredit = 0;

    foreach ($data as $key => $row) {
        $totalDebet += $row->DEBET;
        $totalKredit += $row->KREDIT;

        $nilDebet  = format_akuntansi($row->DEBET);
        $nilKredit = format_akuntansi($row->KREDIT);

        if($nilDebet == 0){
            $nilDebet = '';
        }

        if($nilKredit == 0){
            $nilKredit = '';
        }

        $no++;   
        if($no == 1){
            echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$row->TGL."</td>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$row->KODE_AKUN."</td>" ;
                echo "<td class='gridtd'>".$row->NAMA_AKUN."</td>" ;
                echo "<td class='gridtd' style='text-align:right;'>".$nilDebet."</td>" ; 
                echo "<td class='gridtd' style='text-align:right;'>".$nilKredit."</td>" ; 
            echo "</tr>" ; 
        } else {
            echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'>".$row->KODE_AKUN."</td>" ;
                echo "<td class='gridtd'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row->NAMA_AKUN."</td>" ;
                echo "<td class='gridtd' style='text-align:right;'>".$nilDebet."</td>" ; 
                echo "<td class='gridtd' style='text-align:right;'>".$nilKredit."</td>" ; 
            echo "</tr>" ; 
        }
        

        if($row->NO_VOUCHER != $old_voc && $old_voc != ""){
            $no = 0;
            echo "<tr>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
                echo "<td class='gridtd' style='text-align:center;'></td>" ;
            echo "</tr>" ;
        }

        $old_voc = $row->NO_VOUCHER;
    }
    ?>

    <?PHP 
    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
        echo "<td class='gridtd' style='text-align:center;'></td>" ;
    echo "</tr>" ;
    ?>

    <tr>
        <th style='text-align:center; width:15%;' class='kolom_header'></th>
        <th style='text-align:center; width:15%;' class='kolom_header'></th>
        <th style='text-align:left; width:35%;' class='kolom_header'><b>JUMLAH</b></th>
        <th style='text-align:right; width:15%;' class='kolom_header'><b><?=format_akuntansi($totalDebet);?></b></th>
        <th style='text-align:right; width:15%;' class='kolom_header'><b><?=format_akuntansi($totalKredit);?></b></th>
    </tr>
</table>

<?PHP if(count($data) == 0){ ?>

<table align="center" class="grid" style="width:100%;">
    <tr>
        <th style='text-align:center; width:15%;' class='kolom_header'> No </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Tanggal </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Uraian </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Nomor Bukti </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Debet </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Kredit </th>
    </tr>
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
            $value = number_format(abs($value), 2);
        }

        return $value;
    }
?>



<?PHP
    exit();
?>