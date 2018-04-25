<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_realisasi_pendapatan_biaya.xls");
?>


<style>
.gridth {
    background: #388ed1;
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 14px;
}
.gridtd {
    background: #FFFFF0;
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
    background: #388ed1;
    font-size: 18px;
}

</style>

<table cellspacing="0"> 
    <tr>
        <td align="left" >
            <h4>
                PT. PRIMA ELEKTRIK POWER <br>
                DIVISI <?=strtoupper($dt_unit->NAMA_UNIT);?>
            </h4>
        </td>
    </tr>

    <tr>
        <td align="center">
            <h4>
                REALISASI PENDAPATAN, BIAYA, HASIL USAHA BULAN <?=strtoupper($bulan_txt);?> <?=$tahun;?>
            </h4>
        </td>
    </tr>

    <tr>
        <td align="center">
        </td>
    </tr>

    <tr>
        <td style="vertical-align:top;">
            <table align="left" class="grid">
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
        </td>
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