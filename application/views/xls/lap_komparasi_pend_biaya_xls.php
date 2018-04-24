<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_komparasi_pend_biaya.xls");
?>


<style>
.gridth {
    background: #b1d4e5;
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 13px;
    width: 100px;
}
.gridtd {
    vertical-align: middle;
    font-size: 13px;
    height: 30px;
    padding-left: 10px;
    padding-right: 10px;
    border: 1px solid;
    width: 100px;
}
.grid {
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
  width: 100px;
}

.grid td {
    border: 1px solid;
}

.kolom_header{
    height: 30px;
    padding: 10px;
    vertical-align: middle;
    background: #b1d4e5;
    font-size: 13px;
    border: 1px solid;
    width: 100px;
}

</style>
<!-- TAHAP PERTAMA -->
<?PHP 
$tot_pend_0  = 0;
$tot_pend_1  = 0; $tot_pend_11 = 0; $tot_pend_21 = 0;
$tot_pend_2  = 0; $tot_pend_12 = 0; $tot_pend_22 = 0;
$tot_pend_3  = 0; $tot_pend_13 = 0; $tot_pend_23 = 0;
$tot_pend_4  = 0; $tot_pend_14 = 0; $tot_pend_24 = 0;
$tot_pend_5  = 0; $tot_pend_15 = 0; $tot_pend_25 = 0;
$tot_pend_6  = 0; $tot_pend_16 = 0; $tot_pend_26 = 0;
$tot_pend_7  = 0; $tot_pend_17 = 0; $tot_pend_27 = 0;
$tot_pend_8  = 0; $tot_pend_18 = 0; $tot_pend_28 = 0;
$tot_pend_9  = 0; $tot_pend_19 = 0; $tot_pend_29 = 0;
$tot_pend_10 = 0; $tot_pend_20 = 0; $tot_pend_30 = 0;

$tot_biaya_0  = 0;
$tot_biaya_1  = 0; $tot_biaya_11 = 0; $tot_biaya_21 = 0;
$tot_biaya_2  = 0; $tot_biaya_12 = 0; $tot_biaya_22 = 0;
$tot_biaya_3  = 0; $tot_biaya_13 = 0; $tot_biaya_23 = 0;
$tot_biaya_4  = 0; $tot_biaya_14 = 0; $tot_biaya_24 = 0;
$tot_biaya_5  = 0; $tot_biaya_15 = 0; $tot_biaya_25 = 0;
$tot_biaya_6  = 0; $tot_biaya_16 = 0; $tot_biaya_26 = 0;
$tot_biaya_7  = 0; $tot_biaya_17 = 0; $tot_biaya_27 = 0;
$tot_biaya_8  = 0; $tot_biaya_18 = 0; $tot_biaya_28 = 0;
$tot_biaya_9  = 0; $tot_biaya_19 = 0; $tot_biaya_29 = 0;
$tot_biaya_10 = 0; $tot_biaya_20 = 0; $tot_biaya_30 = 0;

$tot_pend2_0  = 0;
$tot_pend2_1  = 0; $tot_pend2_11 = 0; $tot_pend2_21 = 0; 
$tot_pend2_2  = 0; $tot_pend2_12 = 0; $tot_pend2_22 = 0;
$tot_pend2_3  = 0; $tot_pend2_13 = 0; $tot_pend2_23 = 0;
$tot_pend2_4  = 0; $tot_pend2_14 = 0; $tot_pend2_24 = 0;
$tot_pend2_5  = 0; $tot_pend2_15 = 0; $tot_pend2_25 = 0;
$tot_pend2_6  = 0; $tot_pend2_16 = 0; $tot_pend2_26 = 0;
$tot_pend2_7  = 0; $tot_pend2_17 = 0; $tot_pend2_27 = 0;
$tot_pend2_8  = 0; $tot_pend2_18 = 0; $tot_pend2_28 = 0;
$tot_pend2_9  = 0; $tot_pend2_19 = 0; $tot_pend2_29 = 0;
$tot_pend2_10 = 0; $tot_pend2_20 = 0; $tot_pend2_30 = 0;

$tot_biaya2_0  = 0;
$tot_biaya2_1  = 0; $tot_biaya2_11 = 0; $tot_biaya2_21 = 0;
$tot_biaya2_2  = 0; $tot_biaya2_12 = 0; $tot_biaya2_22 = 0;
$tot_biaya2_3  = 0; $tot_biaya2_13 = 0; $tot_biaya2_23 = 0;
$tot_biaya2_4  = 0; $tot_biaya2_14 = 0; $tot_biaya2_24 = 0;
$tot_biaya2_5  = 0; $tot_biaya2_15 = 0; $tot_biaya2_25 = 0;
$tot_biaya2_6  = 0; $tot_biaya2_16 = 0; $tot_biaya2_26 = 0;
$tot_biaya2_7  = 0; $tot_biaya2_17 = 0; $tot_biaya2_27 = 0;
$tot_biaya2_8  = 0; $tot_biaya2_18 = 0; $tot_biaya2_28 = 0;
$tot_biaya2_9  = 0; $tot_biaya2_19 = 0; $tot_biaya2_29 = 0;
$tot_biaya2_10 = 0; $tot_biaya2_20 = 0; $tot_biaya2_30 = 0;

$nilaitot_pend_unit = 0;
$nilaitot_biaya_unit = 0;

$nilaitot_pend_kanpus = 0;
$nilaitot_biaya_kanpus = 0;

$nilaitot_pend_kompliasi = 0;
$nilaitot_biaya_kompliasi = 0;
?>
<h4>Pendapatan</h4>
<table align="left" class="grid">
    <tr>
        <th style='text-align:center; width: 300px;' class='kolom_header' rowspan="2"> NO </th>
        <th style='text-align:center; width: 300px;' class='kolom_header' rowspan="2"> URAIAN </th>
        <th style='text-align:center; width: 500px;' class='kolom_header' colspan="3"> S.D BULAN <?=$bulan_txt;?> <?=$tahun;?> </th>
        <th style='text-align:center; width: 300px;' class='kolom_header' rowspan="2"> % </th>
        <th style='text-align:center; width: 300px;' class='kolom_header' rowspan="2"> % </th>
    </tr>

    <tr>
        <th style='text-align:center; width: 300px;' class='kolom_header'> RKAP <?=$tahun;?> </th>
        <th style='text-align:center; width: 300px;' class='kolom_header'> RKAP S/D BULAN </th>
        <th style='text-align:center; width: 300px;' class='kolom_header'> REALISASI </th>
    </tr>

    <tr>
        <th style='text-align:center; width: 300px;' class='kolom_header'> 1 </th>
        <th style='text-align:center; width: 300px;' class='kolom_header'> 2 </th>
        <th style='text-align:center; width: 300px;' class='kolom_header'> 3 </th>
        <th style='text-align:center; width: 300px;' class='kolom_header'> 4 </th>
        <th style='text-align:center; width: 300px;' class='kolom_header'> 5 </th>
        <th style='text-align:center; width: 300px;' class='kolom_header'> 6 </th>
        <th style='text-align:center; width: 300px;' class='kolom_header'> 7 </th>
    </tr>

    <?PHP foreach ($get_unit as $key => $unit) {  ?>
    <tr>
        <td style='text-align:center;' class='gridtd'><?=$key+1;?></td>
        <td style='text-align:left;' class='gridtd'><?=$unit->NAMA_UNIT;?></td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
    </tr>
    <?PHP } ?>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:left;' class='gridtd'><b>Jml unit - unit</b></td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
    </tr>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:left;' class='gridtd'><b>Kantor Pusat</b></td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
    </tr>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:left;' class='gridtd'><b>Jml unit dan Kanpus</b></td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
    </tr>

    
</table>

<br><br>

<h4>Biaya</h4>
<table align="left" class="grid">
    <tr>
        <th style='text-align:center;' class='kolom_header' rowspan="2"> NO </th>
        <th style='text-align:center; width: 300px;' class='kolom_header' rowspan="2"> URAIAN </th>
        <th style='text-align:center;' class='kolom_header' colspan="3"> S.D BULAN <?=$bulan_txt;?> <?=$tahun;?> </th>
        <th style='text-align:center;' class='kolom_header' rowspan="2"> % </th>
        <th style='text-align:center;' class='kolom_header' rowspan="2"> % </th>
    </tr>

    <tr>
        <th style='text-align:center;' class='kolom_header'> RKAP <?=$tahun;?> </th>
        <th style='text-align:center;' class='kolom_header'> RKAP S/D BULAN </th>
        <th style='text-align:center;' class='kolom_header'> REALISASI </th>
    </tr>

    <tr>
        <th style='text-align:center;' class='kolom_header'> 1 </th>
        <th style='text-align:center;' class='kolom_header'> 2 </th>
        <th style='text-align:center;' class='kolom_header'> 3 </th>
        <th style='text-align:center;' class='kolom_header'> 4 </th>
        <th style='text-align:center;' class='kolom_header'> 5 </th>
        <th style='text-align:center;' class='kolom_header'> 6 </th>
        <th style='text-align:center;' class='kolom_header'> 7 </th>
    </tr>

    <?PHP foreach ($get_unit as $key => $unit) {  ?>
    <tr>
        <td style='text-align:center;' class='gridtd'><?=$key+1;?></td>
        <td style='text-align:left;' class='gridtd'><?=$unit->NAMA_UNIT;?></td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
    </tr>
    <?PHP } ?>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:left;' class='gridtd'><b>Jml unit - unit</b></td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
    </tr>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:left;' class='gridtd'><b>Kantor Pusat</b></td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
    </tr>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:left;' class='gridtd'><b>Jml unit dan Kanpus</b></td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
        <td style='text-align:right;' class='gridtd'>0</td>
    </tr>

    
</table>

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