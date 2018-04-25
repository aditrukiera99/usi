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
                PT. Prima Elektrik Power  <br>
                UNIT <?=strtoupper($dt_unit->NAMA_UNIT);?>    
            </h5>
        </td>
    </tr>
</table>

<table cellspacing="0" align="center"> 
    <tr>
        <td align="center">
            <h4>
                REALISASI PENDAPATAN, BIAYA, HASIL USAHA BULAN <?=strtoupper($bulan_txt);?> <?=$tahun;?>
            </h4>
        </td>
    </tr>
</table>

<table align="center" class="grid">
    <tr>
        <th style='text-align:center;' class='kolom_header'> URAIAN </th>
        <th style='text-align:center;' class='kolom_header'> RKAP </th>
        <th style='text-align:center;' class='kolom_header'> RKP </th>
        <th style='text-align:center;' class='kolom_header'> REALISASI</th>
        <th style='text-align:center;' class='kolom_header'> REALISASI</th>
        <th style='text-align:center;' class='kolom_header'> %</th>
        <th style='text-align:center;' class='kolom_header'> %</th>
    </tr>

    <tr>
        <th style='text-align:center;' class='kolom_header'></th>
        <th style='text-align:center;' class='kolom_header'>TH <?=$tahun;?> </th>
        <th style='text-align:center;' class='kolom_header'><?=strtoupper($bulan_txt);?></th>
        <th style='text-align:center;' class='kolom_header'>BULAN INI</th>
        <th style='text-align:center;' class='kolom_header'>S/D BULAN INI</th>
        <th style='text-align:center;' class='kolom_header'>(4 : 3)</th>
        <th style='text-align:center;' class='kolom_header'>(5 : 2)</th>
    </tr>

    <tr>
        <td class='gridtd' style='text-align:center;'>1</td>
        <td class='gridtd' style='text-align:center;'>2</td>
        <td class='gridtd' style='text-align:center;'>3</td>
        <td class='gridtd' style='text-align:center;'>4</td>
        <td class='gridtd' style='text-align:center;'>5</td>
        <td class='gridtd' style='text-align:center;'>6</td>
        <td class='gridtd' style='text-align:center;'>7</td>
    </tr>

    <tr>
        <td class='gridtd' align='center'>Pendapatan</td>
        <td class='gridtd' align='right'><?=format_akuntansi($pend_rkap_tahun->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($pend_rkap_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($pend_real_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($pend_real_sd_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'>0</td>
        <td class='gridtd' align='right'>0</td>
    </tr>

    <tr>
        <td class='gridtd' align='center'>Biaya</td>
        <td class='gridtd' align='right'><?=format_akuntansi($biaya_rkap_tahun->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($biaya_rkap_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($biaya_real_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($biaya_real_sd_bulan->TOTAL);?></td>
        <td class='gridtd' align='right'>0</td>
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
        <th style='text-align:center;' class='kolom_header'>Hasil Usaha</th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($pend_rkap_tahun->TOTAL - $biaya_rkap_tahun->TOTAL);?></th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($pend_rkap_bulan->TOTAL - $biaya_rkap_bulan->TOTAL);?></th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($pend_real_bulan->TOTAL - $biaya_real_bulan->TOTAL);?></th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($pend_real_sd_bulan->TOTAL - $biaya_real_sd_bulan->TOTAL);?></th>
        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi(0);?></th>
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
    $html2pdf->pdf->SetTitle('Laporan Realisasi Pendapatan dan Biaya');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_realisasi_pendapatan_dan_biaya.pdf');
?>