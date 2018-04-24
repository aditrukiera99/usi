<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_mutasi_hutang.xls");
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
}

</style>

<table cellspacing="0"> 
    <tr>
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
                DAFTAR MUTASI HUTANG<br>
                UNIT : <?=strtoupper($dt_unit->NAMA_UNIT);?><br>
                <?PHP if($filter == "Bulanan"){ ?>
                PER <?=strtoupper($bulan_txt);?> <?=$tahun;?>
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
                    <th style='text-align:center;' class='kolom_header'> NAMA PBF </th>
                    <th style='text-align:center;' class='kolom_header'> SALDO AWAL </th>
                    <th style='text-align:center;' class='kolom_header'> PEMBELIAN </th>
                    <th style='text-align:center;' class='kolom_header'> PELUNASAN </th>
                    <th style='text-align:center;' class='kolom_header'> SALDO AKHIR </th>
                </tr>

                <?PHP 
                $tot_saldo_awal = 0;
                $tot_hutang_lagi = 0;
                $tot_mutasi = 0;
                $tot_saldo_akhir = 0;
                foreach ($data as $key => $row) {
                    $saldo_akhir = ($row->SALDO_AWAL + $row->HUTANG_LAGI) - $row->MUTASI;

                    $tot_saldo_awal += $row->SALDO_AWAL;
                    $tot_hutang_lagi += $row->HUTANG_LAGI;
                    $tot_mutasi += $row->MUTASI;
                    $tot_saldo_akhir += $saldo_akhir;
                ?>
                <tr>
                    <td class='gridtd' align='center'> <?=$key+1;?> </td>
                    <td align='left' class='gridtd'><?=$row->NAMA_SUPPLIER;?></td>
                    <td align='right' class='gridtd'><?=number_format($row->SALDO_AWAL);?></td>
                    <td align='right' class='gridtd'><?=number_format($row->HUTANG_LAGI);?></td>
                    <td align='right' class='gridtd'><?=number_format($row->MUTASI);?></td>
                    <td align='right' class='gridtd'><?=number_format($saldo_akhir);?></td>
                </tr>
                <?PHP } ?>
                <tr>
                    <th style='text-align:center;' class='kolom_header'></th>
                    <th style='text-align:left;' class='kolom_header'>JUMLAH</th>
                    <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_saldo_awal);?></b></th>
                    <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_hutang_lagi);?></b></th>
                    <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_mutasi);?></b></th>
                    <th style='text-align:right;' class='kolom_header'><b><?=format_akuntansi($tot_saldo_akhir);?></b></th>
                </tr>
            </table>
        </td>
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
    exit();
?>