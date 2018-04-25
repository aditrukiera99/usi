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
    <tr>
        <td align="center">
            <h4>
                LAPORAN HASIL PENDAPATAN <?=$tahun;?><br>
                UNIT <?=strtoupper($dt_unit->NAMA_UNIT);?><br>
                <?PHP if($filter == "Bulanan"){ ?>
                BULAN <?=strtoupper($bulan_txt);?> <?=$tahun;?>
                <?PHP } else { ?>
                PER <?=$tahun;?>
                <?PHP } ?>
            </h4>
        </td>
    </tr>
</table>

<table align="center" class="grid">
    <tr>
        <th style='text-align:center;' class='kolom_header' rowspan="2"> URAIAN </th>
        <th style='text-align:center;' class='kolom_header' rowspan="2"> REK </th>
        <th style='text-align:center;' class='kolom_header' rowspan="2"> RKAP 2017 </th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> s/d Bulan Yang Lalu</th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> Bulan <?=$bulan_txt;?> <?=$tahun;?></th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> Realisasi sd Bulan ini</th>
        <th style='text-align:center;' class='kolom_header' rowspan="2"> % BRK </th>
        <th style='text-align:center;' class='kolom_header' rowspan="2"> % RAP 1TH </th>
    </tr>

    <tr>
        <th style='text-align:center;' class='kolom_header'> RKP </th>
        <th style='text-align:center;' class='kolom_header'> Realisasi </th>
        <th style='text-align:center;' class='kolom_header'> RKP </th>
        <th style='text-align:center;' class='kolom_header'> Realisasi </th>
        <th style='text-align:center;' class='kolom_header'> RKP </th>
        <th style='text-align:center;' class='kolom_header'> Realisasi </th>
    </tr>

    <tr>
        <th style='text-align:center;' class='kolom_header'> 1 </th>
        <th style='text-align:center;' class='kolom_header'> 2 </th>
        <th style='text-align:center;' class='kolom_header'> 3 </th>
        <th style='text-align:center;' class='kolom_header'> 4 </th>
        <th style='text-align:center;' class='kolom_header'> 5</th>
        <th style='text-align:center;' class='kolom_header'> 6</th>
        <th style='text-align:center;' class='kolom_header'> 7</th>
        <th style='text-align:center;' class='kolom_header'> 8</th>
        <th style='text-align:center;' class='kolom_header'> 9</th>
        <th style='text-align:center;' class='kolom_header'> 10</th>
        <th style='text-align:center;' class='kolom_header'> 11</th>
    </tr>

    <?PHP 
    $grup = $this->model->get_grup_kode_akun('PENDAPATAN', $dt_unit->ID, $bulan, $tahun, $bulan_depan, $tahun_depan);

    $pend_target = 0;
    $pend_rkap_lalu = 0;
    $pend_real_lalu = 0;
    $pend_rkap_skrg = 0;
    $pend_real_skrg = 0;
    $pend_rkap_sd_ini = 0;
    $pend_real_sd_ini = 0;

    foreach ($grup as $key => $row) {

        $pend_target += $row->TARGET;
        $pend_rkap_lalu += $row->RKAP_LALU;
        $pend_real_lalu += $row->DEBET_LALU + $row->KREDIT_LALU;

        $pend_rkap_skrg += $row->RKAP_SKRG;
        $pend_real_skrg += $row->DEBET + $row->KREDIT;

        $pend_rkap_sd_ini += $row->RKAP_SD_INI;
        $pend_real_sd_ini += $row->DEBET_SD_INI + $row->KREDIT_SD_INI;

        echo "<tr>";
            echo "<td class='gridtd' align='left'><b>".strtoupper($row->NAMA_GRUP)."</b></td>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->TARGET)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->RKAP_LALU)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_LALU + $row->KREDIT_LALU)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->RKAP_SKRG)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET + $row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->RKAP_SD_INI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_SD_INI + $row->KREDIT_SD_INI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>0</b></td>";
            echo "<td class='gridtd' align='right'><b>0</b></td>";
        echo "</tr>";

        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP, $dt_unit->ID, $bulan, $tahun, $bulan_depan, $tahun_depan);
        $no = 0;
        foreach ($sub as $key => $row2) {
            $no++;
            echo "<tr>";
                echo "<td class='gridtd' align='left'>&nbsp;&nbsp;&nbsp;".$no.". ".$row2->NAMA_SUB."</td>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->TARGET)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->RKAP_LALU)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_LALU + $row2->KREDIT_LALU)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->RKAP_SKRG)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET + $row2->KREDIT)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->RKAP_SD_INI)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_SD_INI + $row2->KREDIT_SD_INI)."</td>";

                echo "<td class='gridtd' align='right'>0</td>";
                echo "<td class='gridtd' align='right'>0</td>";
            echo "</tr>";

            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB, $dt_unit->ID, $bulan, $tahun, $bulan_depan, $tahun_depan);
            $no2 = 0;
            foreach ($kode_akun as $key => $row3) {
                $no2++;
                echo "<tr>";
                    echo "<td class='gridtd' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$no.".".$no2." ".$row3->NAMA_AKUN."</td>";
                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->TARGET)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->RKAP_LALU)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_LALU + $row3->KREDIT_LALU)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->RKAP_SKRG)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET + $row3->KREDIT)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->RKAP_SD_INI)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_SD_INI + $row3->KREDIT_SD_INI)."</td>";

                    echo "<td class='gridtd' align='right'>0</td>";
                    echo "<td class='gridtd' align='right'>0</td>";
                echo "</tr>";
            }

        }
    }
    ?>
    
    <tr>
        <th style='text-align:left;' class='kolom_header' colspan="2"> JUMLAH PENDAPATAN </th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_target);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_rkap_lalu);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_real_lalu);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_rkap_skrg);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_real_skrg);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_rkap_sd_ini);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_real_sd_ini);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b>0</b></th>
        <th style='text-align:right;' class='kolom_header'><b>0</b></th>
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
    $html2pdf = new HTML2PDF('L','LEGAL','en');
    $html2pdf->pdf->SetTitle('Laporan Hasil Pendapatan');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_hasil_pendapatan.pdf');
?>