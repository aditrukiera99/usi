<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_rincian_hutang.xls");
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
    font-size: 15px;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
    border: 1px solid #999;
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
}

</style>

<table cellspacing="0"> 
    <tr>
        <td align="center" colspan="2">
            <h4>
                RINCIAN HUTANG AFILIASI KANTOR PUSAT <br>
                UNIT <?=strtoupper($dt_unit->NAMA_UNIT);?><br>
                <?PHP if($filter == "Bulanan"){ ?>
                BULAN <?=strtoupper($bulan_txt);?> <?=$tahun;?>
                <?PHP } else { ?>
                PER <?=$tahun;?>
                <?PHP } ?>
            </h4>
        </td>
    </tr>

    <tr>
        <td style="vertical-align:top;">
            <table align="left" class="grid">
                    <tr>
                        <th style='text-align:center;' class='kolom_header'> NO </th>
                        <th style='text-align:center;' class='kolom_header'> KETERANGAN </th>
                        <th style='text-align:center;' class='kolom_header'> SALDO AWAL </th>
                        <th style='text-align:center;' class='kolom_header'> PENAMBAHAN </th>
                        <th style='text-align:center;' class='kolom_header'> PENGURANGAN </th>
                        <th style='text-align:center;' class='kolom_header'> SALDO AKHIR</th>
                    </tr>

                    <?PHP 
                    $no=0;

                    $tot_saldo_awal = 0;
                    $tot_debet = 0;
                    $tot_kredit = 0;
                    $tot_saldo_akhir = 0;

                    foreach ($dt as $key => $row) {
                        $no++;
                        $get_saldo_awal = $this->model->get_saldo_awal($bulan, $tahun, $row->KODE_AKUN, $dt_unit->ID);
                        $get_mutasi     = $this->model->get_mutasi($bulan, $tahun, $row->KODE_AKUN, $dt_unit->ID);
                        $saldo_akhir = $get_saldo_awal->SALDO_AWAL + ($get_mutasi->DEBET - $get_mutasi->KREDIT);

                        $tot_saldo_awal += $get_saldo_awal->SALDO_AWAL;
                        $tot_debet      += $get_mutasi->DEBET;
                        $tot_kredit     += $get_mutasi->KREDIT;
                        $tot_saldo_akhir += $saldo_akhir;

                        echo "<tr>";
                            echo "<td class='gridtd' align='center'>".$no."</td>";
                            echo "<td class='gridtd' align='left'><b>".$row->ALIAS."</b></td>";
                            echo "<td class='gridtd' align='right'>".format_akuntansi($get_saldo_awal->SALDO_AWAL)."</td>";
                            echo "<td class='gridtd' align='right'>".format_akuntansi($get_mutasi->DEBET)."</td>";
                            echo "<td class='gridtd' align='right'>".format_akuntansi($get_mutasi->KREDIT)."</td>";
                            echo "<td class='gridtd' align='right'>".format_akuntansi($saldo_akhir)."</td>";
                        echo "</tr>";
                    }
                    ?>
                    
                    <tr>
                        <th style='text-align:right;' class='kolom_header'></th>
                        <th style='text-align:center;' class='kolom_header'> JUMLAH </th>
                        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($tot_saldo_awal);?></th>
                        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($tot_debet);?></th>
                        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($tot_kredit);?></th>
                        <th style='text-align:right;' class='kolom_header'><?=format_akuntansi($tot_saldo_akhir);?></th>
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