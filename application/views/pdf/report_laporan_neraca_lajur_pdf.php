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
    border: 1px solid black;
}

.kolom_header{
    height: 5px;
    padding:5px;
    vertical-align: middle;
    background: #388ed1;
}

</style>


<table cellspacing="0" align="left"> 
    <tr>
        <td align="left" >
            <h5>
                PT. Prima Elektrik Power <br>    
            </h5>
        </td>
    </tr>
</table>

<table cellspacing="0" align="center"> 
    <tr>
        <td align="center">
            <h4>
                UNIT <?=strtoupper($dt_unit->NAMA_UNIT);?><br>
                <?PHP if($filter == "Bulanan"){ ?>
                NERACA PER <?=strtoupper($bulan_txt);?> <?=$tahun;?>
                <?PHP } else { ?>
                NERACA PER <?=$tahun;?>
                <?PHP } ?>
            </h4>
        </td>
    </tr>
</table>

<table align="center" class="grid">
    <tr>
        <th style='text-align:center;' class='kolom_header'> NOMOR </th>
        <th style='text-align:center;' class='kolom_header'> PERKIRAAN </th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> NERACA AWAL </th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> NERACA MUTASI</th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> JURNAL MEMORIAL</th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> LABA RUGI</th>
        <th style='text-align:center;' class='kolom_header' colspan="2"> SALDO AKHIR</th>
    </tr>

    <tr>
        <th style='text-align:center;' class='kolom_header'>AKUN</th>
        <th style='text-align:center;' class='kolom_header'></th>

        <th style='text-align:center;' class='kolom_header'>DEBET</th>
        <th style='text-align:center;' class='kolom_header'>KREDIT</th>

        <th style='text-align:center;' class='kolom_header'>DEBET</th>
        <th style='text-align:center;' class='kolom_header'>KREDIT</th>

        <th style='text-align:center;' class='kolom_header'>DEBET</th>
        <th style='text-align:center;' class='kolom_header'>KREDIT</th>

        <th style='text-align:center;' class='kolom_header'>DEBET</th>
        <th style='text-align:center;' class='kolom_header'>KREDIT</th>

        <th style='text-align:center;' class='kolom_header'>DEBET</th>
        <th style='text-align:center;' class='kolom_header'>KREDIT</th>
    </tr>

    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='left'><b>ASET LANCAR</b></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>

    <?PHP 
    $tot_aktiva_na_deb = 0;
    $tot_aktiva_na_kre = 0;
    $tot_aktiva_mutasi_deb = 0;
    $tot_aktiva_mutasi_kre = 0;
    $tot_aktiva_memo_deb = 0;
    $tot_aktiva_memo_kre = 0;
    $tot_aktiva_lb_deb = 0;
    $tot_aktiva_lb_kre = 0;
    $tot_aktiva_sa_deb = 0;
    $tot_aktiva_sa_kre = 0;

    $tot_pasiva_na_deb = 0;
    $tot_pasiva_na_kre = 0;
    $tot_pasiva_mutasi_deb = 0;
    $tot_pasiva_mutasi_kre = 0;
    $tot_pasiva_memo_deb = 0;
    $tot_pasiva_memo_kre = 0;
    $tot_pasiva_lb_deb = 0;
    $tot_pasiva_lb_kre = 0;
    $tot_pasiva_sa_deb = 0;
    $tot_pasiva_sa_kre = 0;


    $grup = $this->model->get_grup_kode_akun('ASET LANCAR', $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
    foreach ($grup as $key => $row) {

        $neraca_awal = $row->DEBET_LALU - $row->KREDIT_LALU;
        $neraca_mutasi = $row->DEBET_MUTASI - $row->KREDIT_MUTASI;
        $neraca_memo = $row->DEBET - $row->KREDIT;
        $neraca_lb = 0;

        $deb_sa = 0;
        $kre_sa = 0;

        $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
        if($neraca_saldo_akhir > 0){
            $deb_sa = $neraca_saldo_akhir;
            $kre_sa = 0;
        } else {
            $deb_sa = 0;
            $kre_sa = $neraca_saldo_akhir;
        }

        $tot_aktiva_na_deb += $row->DEBET_LALU;
        $tot_aktiva_na_kre += $row->KREDIT_LALU;

        $tot_aktiva_mutasi_deb += $row->DEBET_MUTASI;
        $tot_aktiva_mutasi_kre += $row->KREDIT_MUTASI;

        $tot_aktiva_memo_deb += $row->DEBET;
        $tot_aktiva_memo_kre += $row->KREDIT;

        $tot_aktiva_lb_deb +=  0;
        $tot_aktiva_lb_kre +=  0;

        $tot_aktiva_sa_deb +=  $deb_sa;
        $tot_aktiva_sa_kre +=  $kre_sa;


        echo "<tr>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_LALU)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_LALU)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_MUTASI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_MUTASI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";



            echo "<td class='gridtd' align='right'><b>".format_akuntansi($deb_sa)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($kre_sa)."</b></td>";
        echo "</tr>";

        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
        $no = 0;
        foreach ($sub as $key => $row2) {
            $no++;

            $neraca_awal = $row2->DEBET_LALU - $row2->KREDIT_LALU;
            $neraca_mutasi = $row2->DEBET_MUTASI - $row2->KREDIT_MUTASI;
            $neraca_memo = $row2->DEBET - $row2->KREDIT;
            $neraca_lb = 0;

            $deb_sa = 0;
            $kre_sa = 0;

            $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
            if($neraca_saldo_akhir > 0){
                $deb_sa = $neraca_saldo_akhir;
                $kre_sa = 0;
            } else {
                $deb_sa = 0;
                $kre_sa = $neraca_saldo_akhir;
            }

            echo "<tr>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_LALU)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_LALU)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_MUTASI)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_MUTASI)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($deb_sa)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($kre_sa)."</td>";
            echo "</tr>";

            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
            $no2 = 0;
            foreach ($kode_akun as $key => $row3) {
                $no2++;

                $neraca_awal = $row3->DEBET_LALU - $row3->KREDIT_LALU;
                $neraca_mutasi = $row3->DEBET_MUTASI - $row3->KREDIT_MUTASI;
                $neraca_memo = $row3->DEBET - $row3->KREDIT;
                $neraca_lb = 0;

                $deb_sa = 0;
                $kre_sa = 0;

                $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
                if($neraca_saldo_akhir > 0){
                    $deb_sa = $neraca_saldo_akhir;
                    $kre_sa = 0;
                } else {
                    $deb_sa = 0;
                    $kre_sa = $neraca_saldo_akhir;
                }

                echo "<tr>";
                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                    echo "<td class='gridtd' align='left'>".$row3->NAMA_AKUN."</td>";
                    
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_LALU)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT_LALU)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_MUTASI)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT_MUTASI)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($deb_sa)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($kre_sa)."</td>";
                echo "</tr>";
            }

        }
    }
    ?>

    <!-- ASET TIDAK LANCAR -->
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='left'><b>ASET TIDAK LANCAR</b></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>

    <?PHP 
    $grup = $this->model->get_grup_kode_akun('ASET TIDAK LANCAR', $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
    foreach ($grup as $key => $row) {

        $neraca_awal = $row->DEBET_LALU - $row->KREDIT_LALU;
        $neraca_mutasi = $row->DEBET_MUTASI - $row->KREDIT_MUTASI;
        $neraca_memo = $row->DEBET - $row->KREDIT;
        $neraca_lb = 0;

        $deb_sa = 0;
        $kre_sa = 0;

        $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
        if($neraca_saldo_akhir > 0){
            $deb_sa = $neraca_saldo_akhir;
            $kre_sa = 0;
        } else {
            $deb_sa = 0;
            $kre_sa = $neraca_saldo_akhir;
        }

        $tot_aktiva_na_deb += $row->DEBET_LALU;
        $tot_aktiva_na_kre += $row->KREDIT_LALU;

        $tot_aktiva_mutasi_deb += $row->DEBET_MUTASI;
        $tot_aktiva_mutasi_kre += $row->KREDIT_MUTASI;

        $tot_aktiva_memo_deb += $row->DEBET;
        $tot_aktiva_memo_kre += $row->KREDIT;

        $tot_aktiva_lb_deb +=  0;
        $tot_aktiva_lb_kre +=  0;

        $tot_aktiva_sa_deb +=  $deb_sa;
        $tot_aktiva_sa_kre +=  $kre_sa;


        echo "<tr>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_LALU)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_LALU)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_MUTASI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_MUTASI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";



            echo "<td class='gridtd' align='right'><b>".format_akuntansi($deb_sa)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($kre_sa)."</b></td>";
        echo "</tr>";

        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
        $no = 0;
        foreach ($sub as $key => $row2) {
            $no++;

            $neraca_awal = $row2->DEBET_LALU - $row2->KREDIT_LALU;
            $neraca_mutasi = $row2->DEBET_MUTASI - $row2->KREDIT_MUTASI;
            $neraca_memo = $row2->DEBET - $row2->KREDIT;
            $neraca_lb = 0;

            $deb_sa = 0;
            $kre_sa = 0;

            $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
            if($neraca_saldo_akhir > 0){
                $deb_sa = $neraca_saldo_akhir;
                $kre_sa = 0;
            } else {
                $deb_sa = 0;
                $kre_sa = $neraca_saldo_akhir;
            }

            echo "<tr>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_LALU)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_LALU)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_MUTASI)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_MUTASI)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($deb_sa)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($kre_sa)."</td>";
            echo "</tr>";

            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
            $no2 = 0;
            foreach ($kode_akun as $key => $row3) {
                $no2++;

                $neraca_awal = $row3->DEBET_LALU - $row3->KREDIT_LALU;
                $neraca_mutasi = $row3->DEBET_MUTASI - $row3->KREDIT_MUTASI;
                $neraca_memo = $row3->DEBET - $row3->KREDIT;
                $neraca_lb = 0;

                $deb_sa = 0;
                $kre_sa = 0;

                $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
                if($neraca_saldo_akhir > 0){
                    $deb_sa = $neraca_saldo_akhir;
                    $kre_sa = 0;
                } else {
                    $deb_sa = 0;
                    $kre_sa = $neraca_saldo_akhir;
                }

                echo "<tr>";
                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                    echo "<td class='gridtd' align='left'>".$row3->NAMA_AKUN."</td>";
                    
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_LALU)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT_LALU)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_MUTASI)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT_MUTASI)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($deb_sa)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($kre_sa)."</td>";
                echo "</tr>";
            }

        }
    }
    ?>

    <tr>
        <th style='text-align:center;' class='kolom_header' colspan='2'><b>TOTAL AKTIVA</b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_na_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_na_kre);?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_mutasi_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_mutasi_kre);?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_memo_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_memo_kre);?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_lb_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_lb_kre);?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_sa_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_aktiva_sa_kre);?></b></th>
    </tr>

    <!-- KEWAJIBAN DAN EKUITAS -->
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='left'><b>KEWAJIBAN DAN EKUITAS</b></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>

    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='left'><b>KEWAJIBAN LANCAR</b></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>

    <?PHP 
    $grup = $this->model->get_grup_kode_akun('KEWAJIBAN LANCAR', $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
    foreach ($grup as $key => $row) {

        $neraca_awal = $row->DEBET_LALU - $row->KREDIT_LALU;
        $neraca_mutasi = $row->DEBET_MUTASI - $row->KREDIT_MUTASI;
        $neraca_memo = $row->DEBET - $row->KREDIT;
        $neraca_lb = 0;

        $deb_sa = 0;
        $kre_sa = 0;

        $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
        if($neraca_saldo_akhir > 0){
            $deb_sa = $neraca_saldo_akhir;
            $kre_sa = 0;
        } else {
            $deb_sa = 0;
            $kre_sa = $neraca_saldo_akhir;
        }

        $tot_pasiva_na_deb += $row->DEBET_LALU;
        $tot_pasiva_na_kre += $row->KREDIT_LALU;

        $tot_pasiva_mutasi_deb += $row->DEBET_MUTASI;
        $tot_pasiva_mutasi_kre += $row->KREDIT_MUTASI;

        $tot_pasiva_memo_deb += $row->DEBET;
        $tot_pasiva_memo_kre += $row->KREDIT;

        $tot_pasiva_lb_deb +=  0;
        $tot_pasiva_lb_kre +=  0;

        $tot_pasiva_sa_deb +=  $deb_sa;
        $tot_pasiva_sa_kre +=  $kre_sa;


        echo "<tr>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_LALU)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_LALU)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_MUTASI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_MUTASI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";



            echo "<td class='gridtd' align='right'><b>".format_akuntansi($deb_sa)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($kre_sa)."</b></td>";
        echo "</tr>";

        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
        $no = 0;
        foreach ($sub as $key => $row2) {
            $no++;

            $neraca_awal = $row2->DEBET_LALU - $row2->KREDIT_LALU;
            $neraca_mutasi = $row2->DEBET_MUTASI - $row2->KREDIT_MUTASI;
            $neraca_memo = $row2->DEBET - $row2->KREDIT;
            $neraca_lb = 0;

            $deb_sa = 0;
            $kre_sa = 0;

            $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
            if($neraca_saldo_akhir > 0){
                $deb_sa = $neraca_saldo_akhir;
                $kre_sa = 0;
            } else {
                $deb_sa = 0;
                $kre_sa = $neraca_saldo_akhir;
            }

            echo "<tr>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_LALU)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_LALU)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_MUTASI)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_MUTASI)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($deb_sa)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($kre_sa)."</td>";
            echo "</tr>";

            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
            $no2 = 0;
            foreach ($kode_akun as $key => $row3) {
                $no2++;

                $neraca_awal = $row3->DEBET_LALU - $row3->KREDIT_LALU;
                $neraca_mutasi = $row3->DEBET_MUTASI - $row3->KREDIT_MUTASI;
                $neraca_memo = $row3->DEBET - $row3->KREDIT;
                $neraca_lb = 0;

                $deb_sa = 0;
                $kre_sa = 0;

                $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
                if($neraca_saldo_akhir > 0){
                    $deb_sa = $neraca_saldo_akhir;
                    $kre_sa = 0;
                } else {
                    $deb_sa = 0;
                    $kre_sa = $neraca_saldo_akhir;
                }

                echo "<tr>";
                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                    echo "<td class='gridtd' align='left'>".$row3->NAMA_AKUN."</td>";
                    
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_LALU)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT_LALU)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_MUTASI)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT_MUTASI)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($deb_sa)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($kre_sa)."</td>";
                echo "</tr>";
            }

        }
    }
    ?>

    <!-- KEWAJIBAN LAIN LAIN -->
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='left'><b>KEWAJIBAN LAIN LAIN</b></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>

    <?PHP 
    $grup = $this->model->get_grup_kode_akun('KEWAJIBAN LAIN LAIN', $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
    foreach ($grup as $key => $row) {

        $neraca_awal = $row->DEBET_LALU - $row->KREDIT_LALU;
        $neraca_mutasi = $row->DEBET_MUTASI - $row->KREDIT_MUTASI;
        $neraca_memo = $row->DEBET - $row->KREDIT;
        $neraca_lb = 0;

        $deb_sa = 0;
        $kre_sa = 0;

        $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
        if($neraca_saldo_akhir > 0){
            $deb_sa = $neraca_saldo_akhir;
            $kre_sa = 0;
        } else {
            $deb_sa = 0;
            $kre_sa = $neraca_saldo_akhir;
        }

        $tot_pasiva_na_deb += $row->DEBET_LALU;
        $tot_pasiva_na_kre += $row->KREDIT_LALU;

        $tot_pasiva_mutasi_deb += $row->DEBET_MUTASI;
        $tot_pasiva_mutasi_kre += $row->KREDIT_MUTASI;

        $tot_pasiva_memo_deb += $row->DEBET;
        $tot_pasiva_memo_kre += $row->KREDIT;

        $tot_pasiva_lb_deb +=  0;
        $tot_pasiva_lb_kre +=  0;

        $tot_pasiva_sa_deb +=  $deb_sa;
        $tot_pasiva_sa_kre +=  $kre_sa;


        echo "<tr>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_LALU)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_LALU)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_MUTASI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_MUTASI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";



            echo "<td class='gridtd' align='right'><b>".format_akuntansi($deb_sa)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($kre_sa)."</b></td>";
        echo "</tr>";

        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
        $no = 0;
        foreach ($sub as $key => $row2) {
            $no++;

            $neraca_awal = $row2->DEBET_LALU - $row2->KREDIT_LALU;
            $neraca_mutasi = $row2->DEBET_MUTASI - $row2->KREDIT_MUTASI;
            $neraca_memo = $row2->DEBET - $row2->KREDIT;
            $neraca_lb = 0;

            $deb_sa = 0;
            $kre_sa = 0;

            $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
            if($neraca_saldo_akhir > 0){
                $deb_sa = $neraca_saldo_akhir;
                $kre_sa = 0;
            } else {
                $deb_sa = 0;
                $kre_sa = $neraca_saldo_akhir;
            }

            echo "<tr>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_LALU)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_LALU)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_MUTASI)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_MUTASI)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($deb_sa)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($kre_sa)."</td>";
            echo "</tr>";

            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
            $no2 = 0;
            foreach ($kode_akun as $key => $row3) {
                $no2++;

                $neraca_awal = $row3->DEBET_LALU - $row3->KREDIT_LALU;
                $neraca_mutasi = $row3->DEBET_MUTASI - $row3->KREDIT_MUTASI;
                $neraca_memo = $row3->DEBET - $row3->KREDIT;
                $neraca_lb = 0;

                $deb_sa = 0;
                $kre_sa = 0;

                $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
                if($neraca_saldo_akhir > 0){
                    $deb_sa = $neraca_saldo_akhir;
                    $kre_sa = 0;
                } else {
                    $deb_sa = 0;
                    $kre_sa = $neraca_saldo_akhir;
                }

                echo "<tr>";
                    echo "<td class='gridtd' align='center'>".$row3->KODE_AKUN."</td>";
                    echo "<td class='gridtd' align='left'>".$row3->NAMA_AKUN."</td>";
                    
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_LALU)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT_LALU)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET_MUTASI)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT_MUTASI)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->DEBET)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($row3->KREDIT)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";

                    echo "<td class='gridtd' align='right'>".format_akuntansi($deb_sa)."</td>";
                    echo "<td class='gridtd' align='right'>".format_akuntansi($kre_sa)."</td>";
                echo "</tr>";
            }

        }
    }
    ?>
    <!-- EKUITAS -->
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='left'><b>EKUITAS</b></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>

    <?PHP 
    $grup = $this->model->get_grup_kode_akun('EKUITAS', $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
    foreach ($grup as $key => $row) {
    if($row->KODE_GRUP != 330){
        $neraca_awal = $row->DEBET_LALU - $row->KREDIT_LALU;
        $neraca_mutasi = $row->DEBET_MUTASI - $row->KREDIT_MUTASI;
        $neraca_memo = $row->DEBET - $row->KREDIT;
        $neraca_lb = 0;

        $deb_sa = 0;
        $kre_sa = 0;

        $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
        if($neraca_saldo_akhir > 0){
            $deb_sa = $neraca_saldo_akhir;
            $kre_sa = 0;
        } else {
            $deb_sa = 0;
            $kre_sa = $neraca_saldo_akhir;
        }

        $tot_pasiva_na_deb += $row->DEBET_LALU;
        $tot_pasiva_na_kre += $row->KREDIT_LALU;

        $tot_pasiva_mutasi_deb += $row->DEBET_MUTASI;
        $tot_pasiva_mutasi_kre += $row->KREDIT_MUTASI;

        $tot_pasiva_memo_deb += $row->DEBET;
        $tot_pasiva_memo_kre += $row->KREDIT;

        $tot_pasiva_lb_deb +=  0;
        $tot_pasiva_lb_kre +=  0;

        $tot_pasiva_sa_deb +=  $deb_sa;
        $tot_pasiva_sa_kre +=  $kre_sa;


        echo "<tr>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_LALU)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_LALU)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_MUTASI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_MUTASI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";



            echo "<td class='gridtd' align='right'><b>".format_akuntansi($deb_sa)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($kre_sa)."</b></td>";
        echo "</tr>";

        $sub = $this->model->get_sub_kode_akun($row->KODE_GRUP, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
        $no = 0;
        foreach ($sub as $key => $row2) {
            $no++;

            $neraca_awal = $row2->DEBET_LALU - $row2->KREDIT_LALU;
            $neraca_mutasi = $row2->DEBET_MUTASI - $row2->KREDIT_MUTASI;
            $neraca_memo = $row2->DEBET - $row2->KREDIT;
            $neraca_lb = 0;

            $deb_sa = 0;
            $kre_sa = 0;

            $neraca_saldo_akhir = $neraca_awal + $neraca_mutasi + $neraca_memo;
            if($neraca_saldo_akhir > 0){
                $deb_sa = $neraca_saldo_akhir;
                $kre_sa = 0;
            } else {
                $deb_sa = 0;
                $kre_sa = $neraca_saldo_akhir;
            }

            echo "<tr>";
                echo "<td class='gridtd' align='center'>".$row->KODE_GRUP.".".$row2->KODE_SUB."</td>";
                echo "<td class='gridtd' align='left'>".$row2->NAMA_SUB."</td>";
                
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_LALU)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_LALU)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET_MUTASI)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT_MUTASI)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->DEBET)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($row2->KREDIT)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi(0)."</td>";

                echo "<td class='gridtd' align='right'>".format_akuntansi($deb_sa)."</td>";
                echo "<td class='gridtd' align='right'>".format_akuntansi($kre_sa)."</td>";
            echo "</tr>";

            $kode_akun = $this->model->get_kode_akun($row->KODE_GRUP, $row2->KODE_SUB, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
            $no2 = 0;
        }
    }
    }
    ?>

    <?PHP
    $kode_akun = $this->model->get_kode_akun(330, 0, $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
    foreach ($kode_akun as $key => $row3) {

    $neraca_awal = $row3->DEBET_LALU - $row3->KREDIT_LALU;
    $deb_na = 0;
    $kre_na = 0;
    if($neraca_awal > 0){
        $deb_na = 0;
        $kre_na = $neraca_awal;
    } else {
        $deb_na = $neraca_awal;
        $kre_na = 0;
    }

    $neraca_memo = $row3->DEBET - $row3->KREDIT;
    $deb_memo = 0;
    $kre_memo = 0;
    if($neraca_memo > 0){
        $deb_memo = $neraca_memo;
        $kre_memo = 0;
    } else {
        $deb_memo = 0;
        $kre_memo = $neraca_memo;
    }

    $deb_sa = 0;
    $kre_sa = 0;
    $neraca_saldo_akhir = $neraca_awal + $neraca_memo;
    if($neraca_saldo_akhir > 0){
        $deb_sa = 0;
        $kre_sa = $neraca_saldo_akhir;
    } else {
        $deb_sa = $neraca_saldo_akhir;
        $kre_sa = 0;
    }

    $tot_pasiva_na_deb += $deb_na;
    $tot_pasiva_na_kre += $kre_na;

    $tot_pasiva_mutasi_deb += 0;
    $tot_pasiva_mutasi_kre += 0;

    $tot_pasiva_memo_deb += 0;
    $tot_pasiva_memo_kre += 0;

    $tot_pasiva_lb_deb +=  $deb_memo;
    $tot_pasiva_lb_kre +=  $kre_memo;

    $tot_pasiva_sa_deb +=  $deb_sa;
    $tot_pasiva_sa_kre +=  $kre_sa;

    ?>
    <tr>
        <td class='gridtd' align='center'><b>330</b></td>
        <td class='gridtd' align='left'><b>Laba (rugi) Tahun Berjalan</b></td>

        <td class='gridtd' align='right'><?=format_akuntansi($deb_na);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($kre_na);?></td>

        <td class='gridtd' align='right'><?=format_akuntansi(0);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi(0);?></td>

        <td class='gridtd' align='right'><?=format_akuntansi(0);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi(0);?></td>

        <td class='gridtd' align='right'><?=format_akuntansi($deb_memo);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($kre_memo);?></td>

        <td class='gridtd' align='right'><?=format_akuntansi($deb_sa);?></td>
        <td class='gridtd' align='right'><?=format_akuntansi($kre_sa);?></td>
    </tr>
    <?PHP } ?>

    <!-- PENDAPATAN -->
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='left'><b>PENDAPATAN</b></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>

    <?PHP 
    $grup = $this->model->get_grup_kode_akun('PENDAPATAN', $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
    foreach ($grup as $key => $row) {

        $neraca_mutasi = $row->DEBET_MUTASI - $row->KREDIT_MUTASI;
        $neraca_memo = $row->DEBET - $row->KREDIT;

        $deb_sa = 0;
        $kre_sa = 0;

        $neraca_lb =  $neraca_mutasi + $neraca_memo;
        if($neraca_lb > 0){
            $deb_sa = $neraca_lb;
            $kre_sa = 0;
        } else {
            $deb_sa = 0;
            $kre_sa = $neraca_lb;
        }

        $tot_pasiva_na_deb += 0;
        $tot_pasiva_na_kre += 0;

        $tot_pasiva_mutasi_deb += $row->DEBET_MUTASI;
        $tot_pasiva_mutasi_kre += $row->KREDIT_MUTASI;

        $tot_pasiva_memo_deb += $row->DEBET;
        $tot_pasiva_memo_kre += $row->KREDIT;

        $tot_pasiva_lb_deb +=  $deb_sa;
        $tot_pasiva_lb_kre +=  $kre_sa;

        $tot_pasiva_sa_deb += 0;
        $tot_pasiva_sa_kre += 0;


        echo "<tr>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_MUTASI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_MUTASI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($deb_sa)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($kre_sa)."</b></td>";


            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
        echo "</tr>";
    }
    ?>

    <!-- BIAYA -->
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>
    <tr>
        <td class='gridtd' align='center'></td>
        <td class='gridtd' align='left'><b>BIAYA</b></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
        <td class='gridtd' align='right'></td>
    </tr>

    <?PHP 
    $grup = $this->model->get_grup_kode_akun('BIAYA', $dt_unit->ID, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter);
    foreach ($grup as $key => $row) {

        $neraca_mutasi = $row->DEBET_MUTASI - $row->KREDIT_MUTASI;
        $neraca_memo = $row->DEBET - $row->KREDIT;

        $deb_sa = 0;
        $kre_sa = 0;

        $neraca_lb =  $neraca_mutasi + $neraca_memo;
        if($neraca_lb > 0){
            $deb_sa = $neraca_lb;
            $kre_sa = 0;
        } else {
            $deb_sa = 0;
            $kre_sa = $neraca_lb;
        }

        $tot_pasiva_na_deb += 0;
        $tot_pasiva_na_kre += 0;

        $tot_pasiva_mutasi_deb += $row->DEBET_MUTASI;
        $tot_pasiva_mutasi_kre += $row->KREDIT_MUTASI;

        $tot_pasiva_memo_deb += $row->DEBET;
        $tot_pasiva_memo_kre += $row->KREDIT;

        $tot_pasiva_lb_deb +=  $deb_sa;
        $tot_pasiva_lb_kre +=  $kre_sa;

        $tot_pasiva_sa_deb += 0;
        $tot_pasiva_sa_kre += 0;


        echo "<tr>";
            echo "<td class='gridtd' align='center'><b>".$row->KODE_GRUP."</b></td>";
            echo "<td class='gridtd' align='left'><b>".$row->NAMA_GRUP."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET_MUTASI)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT_MUTASI)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->DEBET)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($row->KREDIT)."</b></td>";

            echo "<td class='gridtd' align='right'><b>".format_akuntansi($deb_sa)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi($kre_sa)."</b></td>";


            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
            echo "<td class='gridtd' align='right'><b>".format_akuntansi(0)."</b></td>";
        echo "</tr>";
    }
    ?>

    <tr>
        <th style='text-align:center;' class='kolom_header' colspan='2'><b>TOTAL PASIVA</b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_na_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_na_kre);?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_mutasi_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_mutasi_kre);?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_memo_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_memo_kre);?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_lb_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_lb_kre);?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_sa_deb);?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_pasiva_sa_kre);?></b></th>
    </tr>

    <tr>
        <th style='text-align:center;' class='kolom_header' colspan='2'><b>JUMLAH TOTAL</b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_na_deb) + abs($tot_pasiva_na_deb));?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_na_kre) + abs($tot_pasiva_na_kre));?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_mutasi_deb) + abs($tot_pasiva_mutasi_deb));?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_mutasi_kre) + abs($tot_pasiva_mutasi_kre));?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_memo_deb) + abs($tot_pasiva_memo_deb));?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_memo_kre) + abs($tot_pasiva_memo_kre));?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_lb_deb) + abs($tot_pasiva_lb_deb));?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_lb_kre) + abs($tot_pasiva_lb_kre));?></b></th>

        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_sa_deb) + abs($tot_pasiva_sa_deb));?></b></th>
        <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi(abs($tot_aktiva_sa_kre) + abs($tot_pasiva_sa_kre));?></b></th>
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
    $html2pdf->pdf->SetTitle('Laporan Neraca Lajur');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_neraca_lajur.pdf');
?>