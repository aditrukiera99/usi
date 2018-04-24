<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_komparasi_laba_rugi.xls");
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
<table align="left" class="grid">
    <tr>
        <th style='height:65px; text-align:center; width: 300px;' class='kolom_header'> URAIAN </th>
        <th style='height:65px; text-align:center; width: 50px;' class='kolom_header'> NO REK </th>
        <?PHP 
        foreach ($get_unit as $key => $unit) {    
        ?>
        <th style='height:65px; text-align:center; width: 100px !important;' class='kolom_header'> <?=$unit->NAMA_UNIT;?> </th>
        <?PHP 
        } 
        ?>
        <th style='height:65px; text-align:center; width: 100px !important;' class='kolom_header'> JUMLAH UNIT </th>
        <th style='height:65px; text-align:center; width: 100px !important;' class='kolom_header'> KANTOR PUSAT </th>
        <th style='height:65px; text-align:center; width: 100px !important;' class='kolom_header'> KOMPILASI </th>
    </tr>

    <!-- PENDAPATAN -->
    <?PHP 
    echo "<tr>";
        echo "<td class='gridtd' align='left'><b>I. PENDAPATAN USAHA</b></td>";
        echo "<td class='gridtd' align='center'></td>";
        foreach ($get_unit as $key => $unit) { 
            echo "<td class='gridtd' align='right'></td>";
        }

        echo "<td class='gridtd' align='center'></td>";
        echo "<td class='gridtd' align='center'></td>";
        echo "<td class='gridtd' align='center'></td>";
    echo "</tr>";

    $grup = $this->model->get_grup_kode_akun('PENDAPATAN');
    $no_utama = 0;
    foreach ($grup as $key => $row) {
        $no_utama++;
        echo "<tr>";
            echo "<td class='gridtd' align='left'><b>".$no_utama.". ".$row->NAMA_GRUP."</b></td>";
            echo "<td class='gridtd' align='center'>".$row->KODE_GRUP."</td>";
            foreach ($get_unit as $key => $unit) { 
                echo "<td class='gridtd' align='right'></td>";
            }

            echo "<td class='gridtd' align='right'></td>";
            echo "<td class='gridtd' align='right'></td>";
            echo "<td class='gridtd' align='right'></td>";
        echo "</tr>";

        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP);
        $no = 0;
        foreach ($sub as $key => $row2) {
            $no++;
            $nilai_pend_unit = 0;
            echo "<tr>";
                echo "<td class='gridtd' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$no.". ".$row2->NAMA_SUB."</b></td>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                foreach ($get_unit as $key => $unit) { 
                    $get_laba_rugi_sub = $this->model->get_laba_rugi_sub($row->KODE_GRUP, $row2->KODE_SUB, $unit->ID, $bulan, $tahun);
                    $nilai = 0;
                    if($get_laba_rugi_sub){
                        $nilai = format_akuntansi($get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT);
                        $nilai_pend_unit += $get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT;                     
                    }

                    echo "<td class='gridtd' align='right'>".$nilai."</td>";

                }

                echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_pend_unit)."</td>";

                $nilaitot_pend_unit += $nilai_pend_unit;

                $get_laba_rugi_sub = $this->model->get_laba_rugi_sub($row->KODE_GRUP, $row2->KODE_SUB, 17, $bulan, $tahun);
                $nilai_kanpus = 0;
                $nilai_kanpus2 = 0;
                if($get_laba_rugi_sub){
                    $nilai_kanpus = format_akuntansi($get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT);
                    $nilai_kanpus2 = $get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT;
                    $nilaitot_pend_kanpus += $get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT;
                }
                echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_kanpus2)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_pend_unit + $nilai_kanpus2)."</td>";                         
            echo "</tr>";

            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB);
            $no2 = 0;       
            foreach ($kode_akun as $key => $row3) {
                $nilai_pend_unit = 0;
                $no2++;
                echo "<tr>";
                    echo "<td class='gridtd' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$no.".".$no2." ".$row3->NAMA_AKUN."</td>";
                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                    foreach ($get_unit as $key => $unit) { 
                        $get_laba_rugi_akun = $this->model->get_laba_rugi_akun($row3->KODE_AKUN, $unit->ID, $bulan, $tahun);
                        $nilai = 0;
                        $nilai2 = 0;
                        if($get_laba_rugi_akun){
                            $nilai = format_akuntansi($get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT);
                            $nilai2 = $get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT;
                            $nilai_pend_unit += $get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT;
                        }

                        ${"tot_pend_" . $key} += $nilai2;
                        echo "<td class='gridtd' align='right'>".$nilai."</td>";

                    }

                    echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_pend_unit)."</td>";
                    $get_laba_rugi_akun = $this->model->get_laba_rugi_akun($row->KODE_GRUP, $row2->KODE_SUB, 17, $bulan, $tahun);
                    $nilai_kanpus = 0;
                    $nilai_kanpus2 = 0;
                    if($get_laba_rugi_akun){
                        $nilai_kanpus = format_akuntansi($get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT);
                        $nilai_kanpus2 = $get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT;
                    }
                    echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_kanpus2)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_pend_unit + $nilai_kanpus2)."</td>";  
                echo "</tr>";

                
            }

        }
    }
    ?>

    <tr>
        <td style='text-align:center; width: 300px;' class='gridtd'> <b>JUMLAH PENDAPATAN</b></td>
        <td style='text-align:center; width: 50px;' class='gridtd'></td>
        <?PHP 
        foreach ($get_unit as $key => $unit) {  
        ?>
        <td style='text-align:right;' class='gridtd'><b> <?PHP echo format_akuntansi(${"tot_pend_" . $key}); ?> </b></td>
        <?PHP 
        } 
        ?>

        <td style='text-align:right;' class='gridtd'><b> <?PHP echo format_akuntansi($nilaitot_pend_unit); ?> </b></td>
        <td style='text-align:right;' class='gridtd'><b> <?PHP echo format_akuntansi($nilaitot_pend_kanpus); ?> </b></td>
        <td style='text-align:right;' class='gridtd'><b> <?PHP echo format_akuntansi($nilaitot_pend_unit + $nilaitot_pend_kanpus); ?> </b></td>
    </tr>

    <tr>
        <th style='text-align:center; width: 300px;' class='kolom_header'></th>
        <th style='text-align:center; width: 50px;' class='kolom_header'></th>
        <?PHP 
        foreach ($get_unit as $key => $unit) {    
        ?>
        <th style='text-align:center; width: 100px !important;' class='kolom_header'></th>
        <?PHP 
        } 
        ?>

        <th style='text-align:center; width: 100px !important;' class='kolom_header'></th>
        <th style='text-align:center; width: 100px !important;' class='kolom_header'></th>
        <th style='text-align:center; width: 100px !important;' class='kolom_header'></th>
    </tr>

    <!-- BIAYA -->

    <?PHP 
    echo "<tr>";
        echo "<td class='gridtd' align='left'><b>II. BEBAN / BIAYA</b></td>";
        echo "<td class='gridtd' align='center'></td>";
        foreach ($get_unit as $key => $unit) { 
            echo "<td class='gridtd' align='right'></td>";
        }

        echo "<td class='gridtd' align='right'></td>";
        echo "<td class='gridtd' align='right'></td>";
        echo "<td class='gridtd' align='right'></td>";
    echo "</tr>";

    $grup = $this->model->get_grup_kode_akun('BIAYA');
    $no_utama = 0;
    foreach ($grup as $key => $row) {
        $no_utama++;
        echo "<tr>";
            echo "<td class='gridtd' align='left'><b>".$no_utama.". ".$row->NAMA_GRUP."</b></td>";
            echo "<td class='gridtd' align='center'>".$row->KODE_GRUP."</td>";
            foreach ($get_unit as $key => $unit) { 
                echo "<td class='gridtd' align='right'></td>";
            }

            echo "<td class='gridtd' align='right'></td>";
            echo "<td class='gridtd' align='right'></td>";
            echo "<td class='gridtd' align='right'></td>";
        echo "</tr>";

        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP);
        $no = 0;
        foreach ($sub as $key => $row2) {
            $nilai_biaya_unit = 0;
            $no++;
            echo "<tr>";
                echo "<td class='gridtd' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$no.". ".$row2->NAMA_SUB."</b></td>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                foreach ($get_unit as $key => $unit) {
                    $get_laba_rugi_sub = $this->model->get_laba_rugi_sub($row->KODE_GRUP, $row2->KODE_SUB, $unit->ID, $bulan, $tahun);
                    $nilai = 0;
                    if($get_laba_rugi_sub){
                        $nilai = format_akuntansi($get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT);
                        $nilai_biaya_unit += $get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT;
                    }

                    echo "<td class='gridtd' align='right'>".$nilai."</td>";

                }
                echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_biaya_unit)."</td>";

                $nilaitot_biaya_unit += $nilai_biaya_unit;

                $get_laba_rugi_sub = $this->model->get_laba_rugi_sub($row->KODE_GRUP, $row2->KODE_SUB, 17, $bulan, $tahun);
                $nilai_kanpus = 0;
                $nilai_kanpus2 = 0;
                if($get_laba_rugi_sub){
                    $nilai_kanpus = format_akuntansi($get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT);
                    $nilai_kanpus2 = $get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT;
                    $nilaitot_biaya_kanpus += $get_laba_rugi_sub->DEBET + $get_laba_rugi_sub->KREDIT;
                }
                echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_kanpus2)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_biaya_unit + $nilai_kanpus2)."</td>";                           
            echo "</tr>";

            

            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB);
            $no2 = 0;
            foreach ($kode_akun as $key => $row3) {
                $nilai_biaya_unit = 0;
                $no2++;
                echo "<tr>";
                    echo "<td class='gridtd' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$no.".".$no2." ".$row3->NAMA_AKUN."</td>";
                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                    foreach ($get_unit as $key => $unit) { 
                        $get_laba_rugi_akun = $this->model->get_laba_rugi_akun($row3->KODE_AKUN, $unit->ID, $bulan, $tahun);
                        $nilai = 0;
                        $nilai2 = 0;
                        if($get_laba_rugi_akun){
                            $nilai = format_akuntansi($get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT);
                            $nilai2 = $get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT;
                            $nilai_biaya_unit += $get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT;
                        }

                        ${"tot_biaya_" . $key} += $nilai2;
                        echo "<td class='gridtd' align='right'>".$nilai."</td>";
                    }

                    echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_biaya_unit)."</td>";
                    $get_laba_rugi_akun = $this->model->get_laba_rugi_akun($row->KODE_GRUP, $row2->KODE_SUB, 17, $bulan, $tahun);
                    $nilai_kanpus = 0;
                    $nilai_kanpus2 = 0;
                    if($get_laba_rugi_akun){
                        $nilai_kanpus = format_akuntansi($get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT);
                        $nilai_kanpus2 = $get_laba_rugi_akun->DEBET + $get_laba_rugi_akun->KREDIT;                        
                    }
                    echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_kanpus2)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($nilai_biaya_unit + $nilai_kanpus2)."</td>"; 
                echo "</tr>";

                
            }

        }
    }
    ?>

    <tr>
        <td style='text-align:center; width: 300px;' class='gridtd'> <b>JUMLAH BEBAN / BIAYA </b></td>
        <td style='text-align:center; width: 50px;' class='gridtd'></td>

        <?PHP foreach ($get_unit as $key => $unit) { ?>
        <td style='text-align:right;' class='gridtd'><b> <?PHP echo format_akuntansi(${"tot_biaya_" . $key}); ?> </b></td>
        <?PHP } ?>

        <td style='text-align:right;' class='gridtd'><b> <?PHP echo format_akuntansi($nilaitot_biaya_unit); ?> </b></td>
        <td style='text-align:right;' class='gridtd'><b> <?PHP echo format_akuntansi($nilaitot_biaya_kanpus); ?> </b></td>
        <td style='text-align:right;' class='gridtd'><b> <?PHP echo format_akuntansi($nilaitot_biaya_unit + $nilaitot_biaya_kanpus); ?> </b></td>
    </tr>

    <tr>
        <th style='text-align:center; width: 300px;' class='kolom_header'> TOTAL HASIL USAHA </th>
        <th style='text-align:center; width: 50px;' class='kolom_header'> </th>
        <?PHP 
        foreach ($get_unit as $key => $unit) { 
  
        ?>
        <th style='text-align:right; width: 100px !important;' class='kolom_header'> <?PHP echo format_akuntansi(${"tot_pend_" . $key} - ${"tot_biaya_" . $key}); ?> </th>
        <?PHP 
            
        } 
        ?>

        <th style='text-align:right; width: 100px !important;' class='kolom_header'> <?PHP echo format_akuntansi($nilaitot_pend_unit - $nilaitot_biaya_unit); ?> </th>
        <th style='text-align:right; width: 100px !important;' class='kolom_header'> <?PHP echo format_akuntansi($nilaitot_pend_kanpus - $nilaitot_biaya_kanpus); ?> </th>
        <th style='text-align:right; width: 100px !important;' class='kolom_header'> <?PHP echo format_akuntansi(($nilaitot_pend_kanpus - $nilaitot_biaya_kanpus) + ($nilaitot_pend_unit - $nilaitot_biaya_unit)); ?> </th>
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