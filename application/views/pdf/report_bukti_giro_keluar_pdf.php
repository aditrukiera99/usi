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

<table style="width: 100%">
	<tr>
		<td style="width: 50%;text-align: left;">PT PRIMA ELEKTRIK POWER</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: right;border: 1px solid black;">Tipe</td>
		<td style="width: 15%;text-align: right;border: 1px solid black;">Bukti A</td>
	</tr>
	<tr>
		<td style="width: 50%;text-align: left;">Sumangko Wringin Anom Gresik</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: right;border: 1px solid black;">Tgl</td>
		<td style="width: 15%;text-align: right;border: 1px solid black;">9-11-2018</td>
	</tr>
	<tr>
		<td style="width: 50%;text-align: left;">Jawa Timur - Indonesia</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: right;border: 1px solid black;">No</td>
		<td style="width: 15%;text-align: right;border: 1px solid black;">0000001</td>
	</tr>
</table>


<br>
<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline;">
                BUKTI GIRO KELUAR (BGK)
            </h4>
            <label><?=$dt_det->NO_BUKTI;?></label>
        </td>
    </tr>
</table>
<br>
<br>
<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;">
	<table style="width: 100%;">
		<tr>
			<td style="text-align:left;font-size: 15px;">Dikeluarkan Kepada : <?=$dt_det->NAMA_PELANGGAN;?></td>
		</tr>
	</table>
</div>

<div style="height: 300px;">
<table style="width: 100%;height: 300px;border-collapse: collapse;">
		<tr>
			<td colspan="3" style="text-align: center;border: 1px solid black;">Fiat</td>
		</tr>
	
		<tr>
			
			<th style="width: 32%;padding: 5px 5px 5px 5px; border: 1px solid black;text-align: center;">No Giro</th>
			<th style="width: 32%;padding: 5px 5px 5px 5px; border: 1px solid black;text-align: center;">Nilai</th>
			<th style="width: 32%;padding: 5px 5px 5px 5px; border: 1px solid black;text-align: center;">Keterangan</th>
		</tr>
	
		<tr >
			<td style="height: 200px;border:1px solid black;text-align: center;"><?=$dt_det->NO_GIRO;?></td>
			<td style="height: 200px;border:1px solid black;text-align: center;">Rp.<?=$dt_det->NILAI;?></td>
			<td style="height: 200px;border:1px solid black;text-align: center;"><?=$dt_det->KETERANGAN;?></td>
			
		</tr>
		
		
		
	
</table>
</div>


<table style="width: 100%;">
	<tr>
		<td style="width: 30%;text-align: center;">Akunting</td>
		<td style="width: 30%;text-align: center;">Kasir</td>
		<td style="width: 30%;text-align: center;">Penerima</td>
	</tr>
</table>
<br>
<br>
<br>
<br>
<br>
<table style="width: 100%;">
	<tr>
		<td style="width: 30%;text-align: center;">(...................................)</td>
		<td style="width: 30%;text-align: center;">(...................................)</td>
		<td style="width: 30%;text-align: center;">(...................................)</td>
	</tr>
</table>
<br>


<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Laporan Arus Kas');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_arus_kas.pdf');
?>