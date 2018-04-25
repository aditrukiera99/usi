<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_komparasi_neraca.xls");
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
$tot_aktiva_0  = 0;
$tot_aktiva_1  = 0; $tot_aktiva_11 = 0; $tot_aktiva_21 = 0;
$tot_aktiva_2  = 0; $tot_aktiva_12 = 0; $tot_aktiva_22 = 0;
$tot_aktiva_3  = 0; $tot_aktiva_13 = 0; $tot_aktiva_23 = 0;
$tot_aktiva_4  = 0; $tot_aktiva_14 = 0; $tot_aktiva_24 = 0;
$tot_aktiva_5  = 0; $tot_aktiva_15 = 0; $tot_aktiva_25 = 0;
$tot_aktiva_6  = 0; $tot_aktiva_16 = 0; $tot_aktiva_26 = 0;
$tot_aktiva_7  = 0; $tot_aktiva_17 = 0; $tot_aktiva_27 = 0;
$tot_aktiva_8  = 0; $tot_aktiva_18 = 0; $tot_aktiva_28 = 0;
$tot_aktiva_9  = 0; $tot_aktiva_19 = 0; $tot_aktiva_29 = 0;
$tot_aktiva_10 = 0; $tot_aktiva_20 = 0; $tot_aktiva_30 = 0;

$tot_wajib_laba  = 0;
$tot_wajib_0  = 0;
$tot_wajib_1  = 0; $tot_wajib_11 = 0; $tot_wajib_21 = 0;
$tot_wajib_2  = 0; $tot_wajib_12 = 0; $tot_wajib_22 = 0;
$tot_wajib_3  = 0; $tot_wajib_13 = 0; $tot_wajib_23 = 0;
$tot_wajib_4  = 0; $tot_wajib_14 = 0; $tot_wajib_24 = 0;
$tot_wajib_5  = 0; $tot_wajib_15 = 0; $tot_wajib_25 = 0;
$tot_wajib_6  = 0; $tot_wajib_16 = 0; $tot_wajib_26 = 0;
$tot_wajib_7  = 0; $tot_wajib_17 = 0; $tot_wajib_27 = 0;
$tot_wajib_8  = 0; $tot_wajib_18 = 0; $tot_wajib_28 = 0;
$tot_wajib_9  = 0; $tot_wajib_19 = 0; $tot_wajib_29 = 0;
$tot_wajib_10 = 0; $tot_wajib_20 = 0; $tot_wajib_30 = 0;


$tot_unit_aktiva = 0;
$tot_unit_wajib  = 0;
$tot_unit_laba  = 0;

$tot_kanpus_aktiva = 0;
$tot_kanpus_wajib  = 0;
$tot_kanpus_laba  = 0;

$tot_komp_aktiva  = 0;
$tot_komp_wajib   = 0;
$tot_komp_laba  = 0;

?>


<table cellspacing="0"> 
    <!-- <tr>
        <td align="left" >
            <h5>
                PERUSAHAAN DAERAH CITRA MANDIRI <br>
                JAWA TENGAH <br>    
            </h5>
        </td>
    </tr>
    <tr>
        <td align="center" colspan="2">
            <h4>
                LAPORAN NERACA <br>
                UNIT : <?=strtoupper($dt_unit->NAMA_UNIT);?><br>
                <?PHP if($filter == "Bulanan"){ ?>
                PER <?=strtoupper($bulan_txt);?> <?=$tahun;?>
                <?PHP } else { ?>
                PER <?=$tahun;?>
                <?PHP } ?>
            </h4>
        </td>
    </tr> -->

    <tr>
        <td style="vertical-align:top;">
            <table align="right" class="grid">
                    <tr>
                        <th style='text-align:center;' class='kolom_header' colspan="3" rowspan="2"> NOMOR AKUN </th>
                        <th style='text-align:center;' class='kolom_header'> URAIAN </th>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<th class='kolom_header' style='text-align:center;'>".$unit->NAMA_UNIT."</th>";
                        }
                        ?>

                        <th style='text-align:center;' class='kolom_header'> JUMLAH UNIT </th>
                        <th style='text-align:center;' class='kolom_header'> KANTOR PUSAT </th>
                        <th style='text-align:center;' class='kolom_header'> KOMPILASI </th>
                    </tr>

                    <tr>
                        <th style='text-align:center;' class='kolom_header'></th>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<th class='kolom_header' style='text-align:center;'>(Rp)</th>";
                        }
                        ?>

                        <th style='text-align:center;' class='kolom_header'>(Rp)</th>
                        <th style='text-align:center;' class='kolom_header'>(Rp)</th>
                        <th style='text-align:center;' class='kolom_header'>(Rp)</th>
                    </tr>

                    <!-- ASET LANCAR -->
                    <tr>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='left'><b>ASET LANCAR</b></td>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<td class='gridtd' align='right'></td>";
                        }
                        ?>

                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                    </tr>

                    <!-- AKTIVA -->

                    <?PHP 
                    $grup = $this->model->get_grup_kode_akun('ASET LANCAR');
                    foreach ($grup as $key => $row) {
                        // $total_aset += $row->DEBET - $row->KREDIT;
                        // $total_aset_lalu += $row->DEBET_LALU - $row->KREDIT_LALU;
                        echo "<tr>";
                            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

                            // UNIT
                            $jml_unit = 0;
                            foreach ($get_unit as $key => $unit) {
                                $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, $unit->ID, $bulan, $tahun);
                                if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT)."</b></td>";
                                    $jml_unit += $get_nilai_grup->DEBET - $get_nilai_grup->KREDIT;
                                    ${"tot_aktiva_" . $key} += $get_nilai_grup->DEBET - $get_nilai_grup->KREDIT;                        
                                } else if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }
                            }

                            // JUMLAH UNIT
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    
                            $tot_unit_aktiva += $jml_unit; 

                            // KANPUS
                            $nilai_kanpus = 0;
                            $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, 17, $bulan, $tahun);
                            if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT)."</b></td>"; 
                                $nilai_kanpus = $get_nilai_grup->DEBET - $get_nilai_grup->KREDIT;
                                $tot_kanpus_aktiva += $nilai_kanpus;          
                            } else if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                            }

                            // KOMPILASI
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>";
                            $tot_komp_aktiva += $nilai_kanpus + $jml_unit; 

                        echo "</tr>";

                        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP);
                        $no = 0;
                        foreach ($sub as $key => $row2) {
                            $no++;
                            echo "<tr>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                                
                                // UNIT
                                $jml_unit = 0;
                                foreach ($get_unit as $key => $unit) {
                                    $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, $unit->ID, $bulan, $tahun);
                                    if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT)."</b></td>";
                                        $jml_unit += $get_nilai_sub->DEBET - $get_nilai_sub->KREDIT;                            
                                    } else if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }
                                }

                                // JUMLAH UNIT
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                // KANPUS
                                $nilai_kanpus = 0;
                                $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, 17, $bulan, $tahun);
                                if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT)."</b></td>"; 
                                    $nilai_kanpus = $get_nilai_sub->DEBET - $get_nilai_sub->KREDIT;                  
                                } else if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }

                                // KOMPILASI
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 

                            echo "</tr>";

                            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB);
                            $no2 = 0;
                            foreach ($kode_akun as $key => $row3) {
                                $no2++;
                                echo "<tr>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                                    echo "<td class='gridtd' align='left'>".$row3->NAMA_AKUN."</td>";

                                    // UNIT
                                    $jml_unit = 0;
                                    foreach ($get_unit as $key => $unit) {
                                        $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, $unit->ID, $bulan, $tahun);
                                        if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT)."</b></td>";
                                            $jml_unit += $get_nilai_akun->DEBET - $get_nilai_akun->KREDIT;                            
                                        } else if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                        }
                                    }

                                    // JUMLAH UNIT
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                    // KANPUS
                                    $nilai_kanpus = 0;
                                    $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, 17, $bulan, $tahun);
                                    if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT)."</b></td>"; 
                                        $nilai_kanpus = $get_nilai_akun->DEBET - $get_nilai_akun->KREDIT;                  
                                    } else if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }

                                    // KOMPILASI
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 
                                echo "</tr>";
                            }

                        }
                    }
                    ?>

                    <!-- ASET TIDAK LANCAR -->
                    <tr>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='left'><b>ASET TIDAK LANCAR</b></td>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<td class='gridtd' align='right'></td>";
                        }
                        ?>

                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                    </tr>

                    <?PHP 
                    $grup = $this->model->get_grup_kode_akun('ASET TIDAK LANCAR');
                    foreach ($grup as $key => $row) {
                        // $total_aset += $row->DEBET - $row->KREDIT;
                        // $total_aset_lalu += $row->DEBET_LALU - $row->KREDIT_LALU;
                        echo "<tr>";
                            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

                            // UNIT
                            $jml_unit = 0;
                            foreach ($get_unit as $key => $unit) {
                                $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, $unit->ID, $bulan, $tahun);
                                if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT)."</b></td>";
                                    $jml_unit += $get_nilai_grup->DEBET - $get_nilai_grup->KREDIT;
                                    ${"tot_aktiva_" . $key} += $get_nilai_grup->DEBET - $get_nilai_grup->KREDIT;                     
                                } else if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }
                            }

                            // JUMLAH UNIT
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";
                            $tot_unit_aktiva += $jml_unit; 

                            // KANPUS
                            $nilai_kanpus = 0;
                            $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, 17, $bulan, $tahun);
                            if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT)."</b></td>"; 
                                $nilai_kanpus = $get_nilai_grup->DEBET - $get_nilai_grup->KREDIT;
                                $tot_kanpus_aktiva += $nilai_kanpus;                    
                            } else if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                            }

                            // KOMPILASI
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 
                            $tot_komp_aktiva += $nilai_kanpus + $jml_unit;  

                        echo "</tr>";

                        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP);
                        $no = 0;
                        foreach ($sub as $key => $row2) {
                            $no++;
                            echo "<tr>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                                
                                // UNIT
                                $jml_unit = 0;
                                foreach ($get_unit as $key => $unit) {
                                    $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, $unit->ID, $bulan, $tahun);
                                    if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT)."</b></td>";
                                        $jml_unit += $get_nilai_sub->DEBET - $get_nilai_sub->KREDIT;                            
                                    } else if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }
                                }

                                // JUMLAH UNIT
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                // KANPUS
                                $nilai_kanpus = 0;
                                $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, 17, $bulan, $tahun);
                                if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT)."</b></td>"; 
                                    $nilai_kanpus = $get_nilai_sub->DEBET - $get_nilai_sub->KREDIT;                  
                                } else if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }

                                // KOMPILASI
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 

                            echo "</tr>";

                            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB);
                            $no2 = 0;
                            foreach ($kode_akun as $key => $row3) {
                                $no2++;
                                echo "<tr>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                                    echo "<td class='gridtd' align='left'>".$row3->NAMA_AKUN."</td>";

                                    // UNIT
                                    $jml_unit = 0;
                                    foreach ($get_unit as $key => $unit) {
                                        $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, $unit->ID, $bulan, $tahun);
                                        if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT)."</b></td>";
                                            $jml_unit += $get_nilai_akun->DEBET - $get_nilai_akun->KREDIT;                            
                                        } else if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                        }
                                    }

                                    // JUMLAH UNIT
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                    // KANPUS
                                    $nilai_kanpus = 0;
                                    $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, 17, $bulan, $tahun);
                                    if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT)."</b></td>"; 
                                        $nilai_kanpus = $get_nilai_akun->DEBET - $get_nilai_akun->KREDIT;                  
                                    } else if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }

                                    // KOMPILASI
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 
                                echo "</tr>";
                            }

                        }
                    }
                    ?>

                    <tr>
                        <th style='text-align:center;' class='kolom_header'></th>
                        <th style='text-align:center;' class='kolom_header'></th>
                        <th style='text-align:center;' class='kolom_header'></th>
                        <th style='text-align:center;' class='kolom_header'><b>TOTAL ASET</b></th>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<th class='kolom_header' align='right'>".format_akuntansi(${"tot_aktiva_" . $key})."</th>";
                        }
                        ?>

                        <th class='kolom_header' align='right'><?=format_akuntansi($tot_unit_aktiva);?></th>
                        <th class='kolom_header' align='right'><?=format_akuntansi($tot_kanpus_aktiva);?></th>
                        <th class='kolom_header' align='right'><?=format_akuntansi($tot_komp_aktiva);?></th>
                    </tr>

                    <!-- KEWAJIBAN DAN EKUITAS -->
                    <tr>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='left'><b>KEWAJIBAN DAN EKUITAS</b></td>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<td class='gridtd' align='right'></td>";
                        }
                        ?>

                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                    </tr>

                    <tr>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='left'><b>KEWAJIBAN LANCAR</b></td>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<td class='gridtd' align='right'></td>";
                        }
                        ?>

                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                    </tr>

                    <?PHP 
                    $grup = $this->model->get_grup_kode_akun('KEWAJIBAN LANCAR');
                    foreach ($grup as $key => $row) {
                        // $total_aset += $row->DEBET - $row->KREDIT;
                        // $total_aset_lalu += $row->DEBET_LALU - $row->KREDIT_LALU;
                        echo "<tr>";
                            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

                            // UNIT
                            $jml_unit = 0;
                            foreach ($get_unit as $key => $unit) {
                                $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, $unit->ID, $bulan, $tahun);
                                if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1) )."</b></td>";
                                    $jml_unit += ($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1);
                                    ${"tot_wajib_" . $key} += ($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1);                       
                                } else if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }
                            }

                            // JUMLAH UNIT
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    
                            $tot_unit_wajib += $jml_unit;

                            // KANPUS
                            $nilai_kanpus = 0;
                            $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, 17, $bulan, $tahun);
                            if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1))."</b></td>"; 
                                $nilai_kanpus = ($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1); 
                                $tot_kanpus_wajib += $nilai_kanpus;                
                            } else if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                            }

                            // KOMPILASI
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>";
                            $tot_komp_wajib += $nilai_kanpus + $jml_unit;

                        echo "</tr>";

                        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP);
                        $no = 0;
                        foreach ($sub as $key => $row2) {
                            $no++;
                            echo "<tr>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                                
                                // UNIT
                                $jml_unit = 0;
                                foreach ($get_unit as $key => $unit) {
                                    $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, $unit->ID, $bulan, $tahun);
                                    if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1))."</b></td>";
                                        $jml_unit += ($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1);                            
                                    } else if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }
                                }

                                // JUMLAH UNIT
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                // KANPUS
                                $nilai_kanpus = 0;
                                $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, 17, $bulan, $tahun);
                                if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1))."</b></td>"; 
                                    $nilai_kanpus = ($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1);                  
                                } else if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }

                                // KOMPILASI
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 

                            echo "</tr>";

                            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB);
                            $no2 = 0;
                            foreach ($kode_akun as $key => $row3) {
                                $no2++;
                                echo "<tr>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                                    echo "<td class='gridtd' align='left'>".$row3->NAMA_AKUN."</td>";

                                    // UNIT
                                    $jml_unit = 0;
                                    foreach ($get_unit as $key => $unit) {
                                        $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, $unit->ID, $bulan, $tahun);
                                        if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1))."</b></td>";
                                            $jml_unit += ($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1);                            
                                        } else if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                        }
                                    }

                                    // JUMLAH UNIT
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                    // KANPUS
                                    $nilai_kanpus = 0;
                                    $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, 17, $bulan, $tahun);
                                    if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1))."</b></td>"; 
                                        $nilai_kanpus = ($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1);                  
                                    } else if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }

                                    // KOMPILASI
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 
                                echo "</tr>";
                            }

                        }
                    }
                    ?>

                    <!-- KEWAJIBAN LAIN LAIN -->
                    <tr>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='left'><b>KEWAJIBAN LAIN LAIN</b></td>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<td class='gridtd' align='right'></td>";
                        }
                        ?>

                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                    </tr>

                    <?PHP 
                    $grup = $this->model->get_grup_kode_akun('KEWAJIBAN LAIN LAIN');
                    foreach ($grup as $key => $row) {
                        // $total_aset += $row->DEBET - $row->KREDIT;
                        // $total_aset_lalu += $row->DEBET_LALU - $row->KREDIT_LALU;
                        echo "<tr>";
                            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

                            // UNIT
                            $jml_unit = 0;
                            foreach ($get_unit as $key => $unit) {
                                $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, $unit->ID, $bulan, $tahun);
                                if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1) )."</b></td>";
                                    $jml_unit += ($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1);
                                    ${"tot_wajib_" . $key} += ($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1);                       
                                } else if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }
                            }

                            // JUMLAH UNIT
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    
                            $tot_unit_wajib += $jml_unit;

                            // KANPUS
                            $nilai_kanpus = 0;
                            $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, 17, $bulan, $tahun);
                            if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1))."</b></td>"; 
                                $nilai_kanpus = ($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1); 
                                $tot_kanpus_wajib += $nilai_kanpus;                
                            } else if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                            }

                            // KOMPILASI
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>";
                            $tot_komp_wajib += $nilai_kanpus + $jml_unit;

                        echo "</tr>";

                        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP);
                        $no = 0;
                        foreach ($sub as $key => $row2) {
                            $no++;
                            echo "<tr>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                                
                                // UNIT
                                $jml_unit = 0;
                                foreach ($get_unit as $key => $unit) {
                                    $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, $unit->ID, $bulan, $tahun);
                                    if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1))."</b></td>";
                                        $jml_unit += ($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1);                            
                                    } else if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }
                                }

                                // JUMLAH UNIT
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                // KANPUS
                                $nilai_kanpus = 0;
                                $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, 17, $bulan, $tahun);
                                if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1))."</b></td>"; 
                                    $nilai_kanpus = ($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1);                  
                                } else if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }

                                // KOMPILASI
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 

                            echo "</tr>";

                            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB);
                            $no2 = 0;
                            foreach ($kode_akun as $key => $row3) {
                                $no2++;
                                echo "<tr>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                                    echo "<td class='gridtd' align='left'>".$row3->NAMA_AKUN."</td>";

                                    // UNIT
                                    $jml_unit = 0;
                                    foreach ($get_unit as $key => $unit) {
                                        $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, $unit->ID, $bulan, $tahun);
                                        if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1))."</b></td>";
                                            $jml_unit += ($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1);                            
                                        } else if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                        }
                                    }

                                    // JUMLAH UNIT
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                    // KANPUS
                                    $nilai_kanpus = 0;
                                    $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, 17, $bulan, $tahun);
                                    if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1))."</b></td>"; 
                                        $nilai_kanpus = ($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1);                  
                                    } else if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }

                                    // KOMPILASI
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 
                                echo "</tr>";
                            }

                        }
                    }
                    ?>
                    <!-- EKUITAS -->
                    <tr>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='left'><b>EKUITAS</b></td>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<td class='gridtd' align='right'></td>";
                        }
                        ?>

                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                    </tr>

                    <?PHP 
                    $grup = $this->model->get_grup_kode_akun('EKUITAS');
                    foreach ($grup as $key => $row) {
                        // $total_aset += $row->DEBET - $row->KREDIT;
                        // $total_aset_lalu += $row->DEBET_LALU - $row->KREDIT_LALU;
                        echo "<tr>";
                            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='center'></td>";
                            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

                            // UNIT
                            $jml_unit = 0;
                            foreach ($get_unit as $key => $unit) {
                                $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, $unit->ID, $bulan, $tahun);
                                if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1) )."</b></td>";
                                    $jml_unit += ($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1);
                                    ${"tot_wajib_" . $key} += ($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1);                       
                                } else if($get_nilai_grup){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }
                            }

                            // JUMLAH UNIT
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    
                            $tot_unit_wajib += $jml_unit;

                            // KANPUS
                            $nilai_kanpus = 0;
                            $get_nilai_grup = $this->model->get_nilai_grup($row->KODE_GRUP, 17, $bulan, $tahun);
                            if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1))."</b></td>"; 
                                $nilai_kanpus = ($get_nilai_grup->DEBET - $get_nilai_grup->KREDIT) * (-1); 
                                $tot_kanpus_wajib += $nilai_kanpus;                
                            } else if($get_nilai_grup){
                                echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                            }

                            // KOMPILASI
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>";
                            $tot_komp_wajib += $nilai_kanpus + $jml_unit;

                        echo "</tr>";

                        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP);
                        $no = 0;
                        foreach ($sub as $key => $row2) {
                            $no++;
                            echo "<tr>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                                echo "<td class='gridtd' align='center'></td>";
                                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                                
                                // UNIT
                                $jml_unit = 0;
                                foreach ($get_unit as $key => $unit) {
                                    $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, $unit->ID, $bulan, $tahun);
                                    if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1))."</b></td>";
                                        $jml_unit += ($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1);                            
                                    } else if($get_nilai_sub){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }
                                }

                                // JUMLAH UNIT
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                // KANPUS
                                $nilai_kanpus = 0;
                                $get_nilai_sub = $this->model->get_nilai_sub($row->KODE_GRUP, $row2->KODE_SUB, 17, $bulan, $tahun);
                                if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1))."</b></td>"; 
                                    $nilai_kanpus = ($get_nilai_sub->DEBET - $get_nilai_sub->KREDIT) * (-1);                  
                                } else if($get_nilai_sub){
                                    echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                }

                                // KOMPILASI
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 

                            echo "</tr>";

                            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB);
                            $no2 = 0;
                            foreach ($kode_akun as $key => $row3) {
                                $no2++;
                                echo "<tr>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'></td>";
                                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                                    echo "<td class='gridtd' align='left'>".$row3->NAMA_AKUN."</td>";

                                    // UNIT
                                    $jml_unit = 0;
                                    foreach ($get_unit as $key => $unit) {
                                        $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, $unit->ID, $bulan, $tahun);
                                        if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1))."</b></td>";
                                            $jml_unit += ($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1);                            
                                        } else if($get_nilai_akun){
                                            echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                        }
                                    }

                                    // JUMLAH UNIT
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";    

                                    // KANPUS
                                    $nilai_kanpus = 0;
                                    $get_nilai_akun = $this->model->get_nilai_akun($row3->KODE_AKUN, 17, $bulan, $tahun);
                                    if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>".format_akuntansi(($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1))."</b></td>"; 
                                        $nilai_kanpus = ($get_nilai_akun->DEBET - $get_nilai_akun->KREDIT) * (-1);                  
                                    } else if($get_nilai_akun){
                                        echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                                    }

                                    // KOMPILASI
                                    echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>"; 
                                echo "</tr>";
                            }

                        }
                    }
                    ?>

                    <tr>
                        <td class='gridtd' align='center'><b>330</b></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='center'></td>
                        <td class='gridtd' align='left'><b>Laba (rugi) Tahun Berjalan</b></td>
                        <?PHP 
                        // UNIT
                        $jml_unit = 0;
                        foreach ($get_unit as $key => $unit) {
                            $get_laba_rugi = $this->model->get_laba_rugi(330, $unit->ID, $bulan, $tahun);
                            if($get_laba_rugi){
                                echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_laba_rugi->DEBET - $get_laba_rugi->KREDIT)."</b></td>";
                                $jml_unit += $get_laba_rugi->DEBET - $get_laba_rugi->KREDIT;
                                ${"tot_wajib_" . $key} += $get_laba_rugi->DEBET - $get_laba_rugi->KREDIT;                            
                            } else if($get_laba_rugi){
                                echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                            }
                        }

                        // JUMLAH UNIT
                        echo "<td class='gridtd' align='right'><b>".format_akuntansi($jml_unit)."</b></td>";
                        $tot_unit_laba += $jml_unit;

                        // KANPUS
                        $nilai_kanpus = 0;
                        $get_laba_rugi = $this->model->get_laba_rugi(330, 17, $bulan, $tahun);
                        if($get_laba_rugi){
                            echo "<td class='gridtd' align='right'><b>".format_akuntansi($get_laba_rugi->DEBET - $get_laba_rugi->KREDIT)."</b></td>"; 
                            $nilai_kanpus = $get_laba_rugi->DEBET - $get_laba_rugi->KREDIT;
                            $tot_kanpus_laba += $nilai_kanpus;            
                        } else if($get_laba_rugi){
                            echo "<td class='gridtd' align='right'><b>0</b></td>";                                  
                        }

                        // KOMPILASI
                        echo "<td class='gridtd' align='right'><b>".format_akuntansi($nilai_kanpus + $jml_unit)."</b></td>";
                        $tot_komp_laba +=  $nilai_kanpus + $jml_unit;
                        ?>
                    </tr>


                    <tr>
                        <th style='text-align:center;' class='kolom_header'></th>
                        <th style='text-align:center;' class='kolom_header'></th>
                        <th style='text-align:center;' class='kolom_header'></th>
                        <th style='text-align:center;' class='kolom_header'><b>TOTAL KEWAJIBAN DAN EKUITAS</b></th>
                        <?PHP 
                        foreach ($get_unit as $key => $unit) { 
                            echo "<th class='kolom_header' align='right'><b>".format_akuntansi(${"tot_wajib_" . $key})."</b></th>";
                        }
                        ?>

                        <th class='kolom_header' align='right'><b><?=format_akuntansi($tot_unit_wajib + $tot_unit_laba);?></b></th>
                        <th class='kolom_header' align='right'><b><?=format_akuntansi($tot_kanpus_wajib + $tot_kanpus_laba);?></b></th>
                        <th class='kolom_header' align='right'><b><?=format_akuntansi($tot_komp_wajib + $tot_komp_laba);?></b></th>
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