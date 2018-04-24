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
    font-size: 20px;
}
.gridtd {
    background: #FFFFF0;
    vertical-align: middle;
    font-size: 14px;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
    background: #FAEBD7;
    border-collapse: collapse;
}

.grid td, table th {
  border: 1px solid black;
}

.kolom_header{
    height: 20px;
}

</style>




<br>
<table align="center">
    <tr>
        <td align="center">
            <h4>
                LAPORAN JURNAL FINAL <br>
                <?=$judul;?>
            </h4>
        </td>
    </tr>
</table>


<div style="width: 100%;">
    <table style="border: 1px; border-collapse: collapse; width: 100%;">
        <tr>
            <th style="width: 10%; text-align: center; height: 25px; vertical-align: middle;">Tanggal</th>
            <th style="width: 20%; text-align: center; height: 25px; vertical-align: middle;">No. Dokumen</th>
            <th style="width: 10%; text-align: center; height: 25px; vertical-align: middle;">Kode</th>
            <th style="width: 25%; text-align: center; height: 25px; vertical-align: middle;">Nama Akuntansi</th>
            <th style="width: 12%; text-align: center; height: 25px; vertical-align: middle;">Debet</th>
            <th style="width: 12%; text-align: center; height: 25px; vertical-align: middle;">Kredit</th>
        </tr>
        <?php 
        $i = 0;
        $tot_debet = 0;
        $tot_kredit = 0;
        foreach ($dt as $key => $value) {
            $tot_debet += $value->KREDIT;
            $tot_kredit += $value->DEBET;
        ?>
        <tr style="border: 1px; border-collapse: collapse;">
            <td style="border:1px dotted; text-align: center;"><?=$value->TGL;?></td>
            <td style="border:1px dotted; text-align: left;"><?=$value->NO_BUKTI;?></td>
            <td style="border:1px dotted; text-align: center;"><?=$value->KODE_AKUN;?></td>
            <td style="border:1px dotted; text-align: left;"><?=$value->NAMA_AKUN;?></td>
            <td style="border:1px dotted; text-align: right;"><?=number_format($value->DEBET);?></td>
            <td style="border:1px dotted; text-align: right;"><?=number_format($value->KREDIT);?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="4" style="border:1px dotted;  text-align: center;"><b>Jumlah Total</b></td>
            <td style="border:1px dotted; text-align: right;"><b><?=number_format($tot_debet);?></b></td>
            <td style="border:1px dotted; text-align: right;"><b><?=number_format($tot_kredit);?></b></td>
        </tr>
    </table>
</div>



<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Cetak Jurnal Final');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('jurnal_final.pdf');
?>