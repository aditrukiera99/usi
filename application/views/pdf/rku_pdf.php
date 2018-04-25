<?PHP  ob_start(); ?>

<style>
.gridth {
    background: #1793d1;
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 14px;
}
.gridtd {
    vertical-align: middle;
    font-size: 14px;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
}

.grid td {
    border-left: 1px solid black;
    border-right: 1px solid black;
    border-top: 1px solid black;
    border-bottom: 1px solid black;
}

.kolom_header{
    height: 5px;
    padding:5px;
    vertical-align: middle;
    background: #388ed1;
}

</style>


<table cellspacing="0" align="center"> 
    <tr align="center">
        <td align="center">
            <h5>
                PT. Prima Elektrik Power <br><br>
                DIVISI <?=strtoupper($dt_unit->NAMA_UNIT);?>    
            </h5>
        </td>
    </tr>
</table>

<table cellspacing="0" align="center"> 
    <tr>
        <td align="center">
            <h4>
                RINGKASAN LAPORAN KEUANGAN<br>
                <?PHP if($filter == "Bulanan"){ ?>
                s/d <?=strtoupper($bulan_txt);?> <?=$tahun;?>
                <?PHP } else { ?>
                PER <?=$tahun;?>
                <?PHP } ?>
            </h4>
        </td>
    </tr>
</table>

<table align="center" class="grid">
    <tr>
        <th style='text-align:center;' class='kolom_header'> NO </th>
        <th style='text-align:center;' class='kolom_header'> URAIAN </th>
        <th style='text-align:center;' class='kolom_header'> RKAP </th>
        <th style='text-align:center;' class='kolom_header'> S/D BULAN LALU </th>
        <th style='text-align:center;' class='kolom_header'> BULAN LAPORAN </th>
        <th style='text-align:center;' class='kolom_header'> S/D BULAN LAPOR</th>
        <th style='text-align:center;' class='kolom_header'> % THD RKAP</th>
    </tr>

    <tr>
        <td class='gridtd' align='center'>1</td>
        <td class='gridtd' align='left'>Pendapatan</td>
        <td class='gridtd' align='right'><?=format_akuntansi($pend_rkap_tahun->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($pend_rkap_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($pend_real_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($pend_real_sd_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'>0</td>
    </tr>

    <tr>
        <td class='gridtd' align='center'>2</td>
        <td class='gridtd' align='left'>Biaya</td>
        <td class='gridtd' align='right'><?=format_akuntansi($biaya_rkap_tahun->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($biaya_rkap_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($biaya_real_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($biaya_real_sd_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'>0</td>
    </tr>

    <tr>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>
    
    <tr>
        <th style='text-align:center;' class='kolom_header'>3</th>
        <th style='text-align:left;' class='kolom_header'>Hasil Usaha</th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($pend_rkap_tahun->TOTAL - $biaya_rkap_tahun->TOTAL);?></th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($pend_rkap_bulan->TOTAL - $biaya_rkap_bulan->TOTAL);?></th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($pend_real_bulan->TOTAL - $biaya_real_bulan->TOTAL);?></th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($pend_real_sd_bulan->TOTAL - $biaya_real_sd_bulan->TOTAL);?></th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi(0);?></th>
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
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 22.4;
    $height_in_mm = $height_in_inches * 2.4;
    $html2pdf = new HTML2PDF('P','LEGAL','en');
    $html2pdf->pdf->SetTitle('Laporan RKU');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_rku.pdf');
?>