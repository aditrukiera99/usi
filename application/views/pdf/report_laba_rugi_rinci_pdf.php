<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

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
    background: #FFF;
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


<table align="center" style="width:100%;">
    <tr>
        <td align="center" >
            <h5>
                PT. Prima Elektrik Power <br>
                <u>Divisi <?=strtoupper($dt_unit->NAMA_UNIT);?></u>
            </h5>
        </td>
    </tr>
</table>

<table align="center" style="width:100%;">
    <tr>
        <td align="center">
            <h4>
                RUGI LABA PER <?=strtoupper($bulan_txt);?> <?=$tahun;?>
            </h4>
        </td>
    </tr>
</table>

<table align="center" class="grid">
    <tr>
        <th style='text-align:center;' class='kolom_header'> NO </th>
        <th style='text-align:center;' class='kolom_header'> PERKIRAAN </th>
        <th style='text-align:center;' class='kolom_header'> TARGET <?=$tahun;?></th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> S/D BULAN LALU</th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> BULAN LAPOR</th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> S/D BULAN INI</th>
        <th style='text-align:center;' class='kolom_header'> %</th>
        <th style='text-align:center;' class='kolom_header'> %</th>
    </tr>

    <tr>
        <th style='text-align:center;' class='kolom_header'></th>
        <th style='text-align:center;' class='kolom_header'></th>
        <th style='text-align:center;' class='kolom_header'></th>
        <th style='text-align:center;' class='kolom_header'>RKP</th>
        <th style='text-align:center;' class='kolom_header'>REALISASI</th>
        <th style='text-align:center;' class='kolom_header'>RKP</th>
        <th style='text-align:center;' class='kolom_header'>REALISASI</th>
        <th style='text-align:center;' class='kolom_header'>RKP</th>
        <th style='text-align:center;' class='kolom_header'>REALISASI</th>
        <th style='text-align:center;' class='kolom_header'>BRK</th>
        <th style='text-align:center;' class='kolom_header'>1 TAHUN</th>
    </tr>

    <!-- PENDAPATAN -->
    <?PHP 
    $pend_target = 0;
    $pend_rkap_lalu = 0;
    $pend_real_lalu = 0;
    $pend_rkap_skrg = 0;
    $pend_real_skrg = 0;
    $pend_rkap_sd_ini = 0;
    $pend_real_sd_ini = 0;

    $grup = $this->model->get_grup_kode_akun('PENDAPATAN', $dt_unit->ID, $bulan, $tahun, $bulan_depan, $tahun_depan);
    foreach ($grup as $key => $row) {

        $pend_target += $row->TARGET;
        $pend_rkap_lalu += $row->RKAP_LALU;
        $pend_real_lalu += $row->DEBET_LALU + $row->KREDIT_LALU;

        $pend_rkap_skrg += $row->RKAP_SKRG;
        $pend_real_skrg += $row->DEBET + $row->KREDIT;

        $pend_rkap_sd_ini += $row->RKAP_SD_INI;
        $pend_real_sd_ini += $row->DEBET_SD_INI + $row->KREDIT_SD_INI;

        echo "<tr>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->TARGET)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->RKAP_LALU)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_LALU + $row->KREDIT_LALU)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->RKAP_SKRG)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET + $row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->RKAP_SD_INI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_SD_INI + $row->KREDIT_SD_INI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
        echo "</tr>";


        $kode_akun = $this->model->get_sub_kode_akun($row->KODE_GRUP, $dt_unit->ID, $bulan, $tahun, $bulan_depan, $tahun_depan);
        foreach ($kode_akun as $key => $row2) {
            echo "<tr>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->TARGET)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->RKAP_LALU)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_LALU + $row2->KREDIT_LALU)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->RKAP_SKRG)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET + $row2->KREDIT)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->RKAP_SD_INI)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_SD_INI + $row2->KREDIT_SD_INI)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
            echo "</tr>";
        }
    }
    ?>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
    </tr>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:left;' class='gridtd'><b>Total Pendapatan</b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($pend_target);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($pend_rkap_lalu);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($pend_real_lalu);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($pend_rkap_skrg);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($pend_real_skrg);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($pend_rkap_sd_ini);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($pend_real_sd_ini);?></b></td>
        <td style='text-align:right;' class='gridtd'><b>0</b></td>
        <td style='text-align:right;' class='gridtd'><b>0</b></td>
    </tr>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
    </tr>

    <!-- BIAYA / BEBAN -->

    <?PHP 
    $biaya_target = 0;
    $biaya_rkap_lalu = 0;
    $biaya_real_lalu = 0;
    $biaya_rkap_skrg = 0;
    $biaya_real_skrg = 0;
    $biaya_rkap_sd_ini = 0;
    $biaya_real_sd_ini = 0;

    $grup = $this->model->get_grup_kode_akun('BIAYA', $dt_unit->ID, $bulan, $tahun, $bulan_depan, $tahun_depan);
    foreach ($grup as $key => $row) {
        $biaya_target += $row->TARGET;
        $biaya_rkap_lalu += $row->RKAP_LALU;
        $biaya_real_lalu += $row->DEBET_LALU + $row->KREDIT_LALU;

        $biaya_rkap_skrg += $row->RKAP_SKRG;
        $biaya_real_skrg += $row->DEBET + $row->KREDIT;

        $biaya_rkap_sd_ini += $row->RKAP_SD_INI;
        $biaya_real_sd_ini += $row->DEBET_SD_INI + $row->KREDIT_SD_INI;

        echo "<tr>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->TARGET)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->RKAP_LALU)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_LALU + $row->KREDIT_LALU)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->RKAP_SKRG)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET + $row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->RKAP_SD_INI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_SD_INI + $row->KREDIT_SD_INI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
        echo "</tr>";


        $kode_akun = $this->model->get_sub_kode_akun($row->KODE_GRUP, $dt_unit->ID, $bulan, $tahun, $bulan_depan, $tahun_depan);
        foreach ($kode_akun as $key => $row2) {
            echo "<tr>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->TARGET)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->RKAP_LALU)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_LALU + $row2->KREDIT_LALU)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->RKAP_SKRG)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET + $row2->KREDIT)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->RKAP_SD_INI)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_SD_INI + $row2->KREDIT_SD_INI)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
            echo "</tr>";
        }
    }
    ?>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
    </tr>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:left;' class='gridtd'><b>Total Biaya Exploitasi</b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($biaya_target);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($biaya_rkap_lalu);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($biaya_real_lalu);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($biaya_rkap_skrg);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($biaya_real_skrg);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($biaya_rkap_sd_ini);?></b></td>
        <td style='text-align:right;' class='gridtd'><b><?=format_akuntansi($biaya_real_sd_ini);?></b></td>
        <td style='text-align:right;' class='gridtd'><b>0</b></td>
        <td style='text-align:right;' class='gridtd'><b>0</b></td>
    </tr>

    <tr>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
        <td style='text-align:center;' class='gridtd'></td>
    </tr>

    <tr>
        <th style='text-align:center;' class='kolom_header'></th>
        <th style='text-align:left;' class='kolom_header'><b>LABA / RUGI SEBELUM PAJAK</b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_target - $biaya_target);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_rkap_lalu - $biaya_rkap_lalu);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_real_lalu - $biaya_real_lalu);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_rkap_skrg - $biaya_rkap_skrg);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_real_skrg - $biaya_real_skrg);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_rkap_sd_ini - $biaya_rkap_sd_ini);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($pend_real_sd_ini - $biaya_real_sd_ini);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b>0</b></th>
        <th style='text-align:right;' class='kolom_header'><b>0</b></th>
    </tr>
</table>

<?PHP 
    function format_akuntansi($value)
    {
        if($value >= 0){
            $value = number_format($value, 2, '.', ',');
        } else {
            $value = number_format(abs($value), 2, '.', ',');
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
    $html2pdf = new HTML2PDF('L','LEGAL','en');
    $html2pdf->pdf->SetTitle('Laporan Laba Rugi');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_laba_rugi.pdf');
?>