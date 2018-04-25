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
</table>

<table align="center" class="grid">
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
    $html2pdf->pdf->SetTitle('Laporan Rincian Hutang');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_rincian_hutang.pdf');
?>