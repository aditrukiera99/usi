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
    font-size: 15px;
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

.grid td{
  border-left: 1px solid black;
  border-right: : 1px solid black;
}

.kolom_header{
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
    font-size: 14px;
}

</style>

<?PHP 
    $voc_now = "";
    $old_voc = "";
?>

<table cellspacing="0" align="left"> 
    <tr align="center">
        <td align="left">
            <h5>
                PT. Prima Elektrik Power <br> <br>
                DIVISI <?=strtoupper($dt_unit->NAMA_UNIT);?>    
            </h5>
        </td>
    </tr>
</table>

<hr>

<table align="center">
    <tr>
        <td align="center">
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
</table>

<table align="center" class="grid">
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
    $width_in_mm = $width_in_inches * 17.4;
    $height_in_mm = $height_in_inches * 22.4;
    $html2pdf = new HTML2PDF('L','A4','en');
    $html2pdf->pdf->SetTitle('Laporan Mutasi Hutang');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_mutasi_hutang.pdf');
?>