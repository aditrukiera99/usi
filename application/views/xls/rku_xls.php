<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Ringkasan_laporan_keuangan.xls");
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
            <h3>
                PT. PRIMA ELEKTRIK POWER <br>
                DIVISI <?=strtoupper($dt_unit->NAMA_UNIT);?><br>    
            </h3>
        </td>
    </tr>

    <tr>
        <td align="left" colspan="2">
            <h5>
                RINGKASAN LAPORAN KEUANGAN<br>
                DIVISI <?=strtoupper($dt_unit->NAMA_UNIT);?><br>
                <?PHP if($filter == "Bulanan"){ ?>
                s/d <?=strtoupper($bulan_txt);?> <?=$tahun;?>
                <?PHP } else { ?>
                PER <?=$tahun;?>
                <?PHP } ?>
            </h5>
        </td>
    </tr>

    <tr>
        <td style="vertical-align:top;">
            <table align="left">
                <tr>
                    <td> 1 </td>
                    <td> Kas </td>
                    <td> Rp </td>
                    <td style="text-align: left;"> 0,00 </td>
                </tr>
                <tr>
                    <td> 2 </td>
                    <td> Bank </td>
                    <td> Rp </td>
                    <td style="text-align: left;"> 0,00 </td>
                </tr>
                <tr>
                    <td> 3 </td>
                    <td> Piutang Dagang </td>
                    <td> Rp </td>
                    <td style="text-align: left;"> 0,00 </td>
                </tr>
                <tr>
                    <td> 4 </td>
                    <td> Persediaan </td>
                    <td> Rp </td>
                    <td style="text-align: left;"> 0,00 </td>
                </tr>
                <tr>
                    <td> 5 </td>
                    <td> Hutang Dagang </td>
                    <td> Rp </td>
                    <td style="text-align: left;"> 0,00 </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td><h4>Pendapatan, Biaya, Hasil Usaha</h4></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>

    <tr>
        <td style="vertical-align:top;">
            <table align="left" class="grid">
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