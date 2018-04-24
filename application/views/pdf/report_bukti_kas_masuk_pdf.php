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

<table style="width: 100%;border-collapse: collapse;">
	<tr>
		<td style="width: 50%;text-align: left;">PT PRIMA ELEKTRIK POWER</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: left;border: 1px solid black;border-left: 1px solid black;">Tipe</td>
		<td style="width: 15%;text-align: left;border: 1px solid black;">Bukti A</td>
	</tr>
	<tr>
		<td style="width: 50%;text-align: left;">Sumangko Wringin Anom Gresik</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: left;border: 1px solid black;">Tgl</td>
		<td style="width: 15%;text-align: left;border: 1px solid black;">9-11-2018</td>
	</tr>
	<tr>
		<td style="width: 50%;text-align: left;">Jawa Timur - Indonesia</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: left;border: 1px solid black;">No</td>
		<td style="width: 15%;text-align: left;border: 1px solid black;">0000001</td>
	</tr>
</table>


<br>
<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline;">
                BUKTI KAS MASUK (BKM)
            </h4>
            <label>
                <?php echo $dt_det->NO_BUKTI; ?>
            </label>
        </td>
    </tr>
</table>
<br>
<br>


<div style="height: 300px;">
<table style="width: 100%;height: 300px;">
	
		<tr>
			<td>Telah Terima Dari</td>
			<td>:</td>
			<td><?php echo $dt_det->nama_pelanggan; ?></td>
		</tr>

		<tr>
			<td>Sebesar</td>
			<td>:</td>
			<td>Rp.<?php echo $dt_det->NILAI; ?>.00</td>
		</tr>

		<tr>
			<td>Terbilang</td>
			<td>:</td>
			<td><?php echo $dt_det->TERBILANG; ?></td>
		</tr>

		<tr>
			<td>Penerimaan Untuk</td>
			<td>:</td>
			<td><?php echo $dt_det->UNTUK; ?></td>
		</tr>
	
	
</table>
</div>
<div style="width:100%;">
	<h5 style="float: right;">Gresik, Selasa 9/10/2017</h5>
</div>
<div style="height: 300px;">
<table style="width: 100%;border: 1px solid black;border-collapse: collapse;">
	<tr>
			<th style="width: 20%;padding: 5px 5px 5px 5px;text-align: center;">Fiat</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px;text-align: center;">Acc</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px;text-align: center;">Akuntansi</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px;text-align: center;">Kasir</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px;text-align: center;">Keterangan</th>
	</tr>

	<tr>
		<td style="height: 100px;border: 1px solid black;"> </td>
		<td style="height: 100px;border: 1px solid black;"> </td>
		<td style="height: 100px;border: 1px solid black;"> </td>
		<td style="height: 100px;border: 1px solid black;"> </td>
		<td style="height: 100px;border: 1px solid black;"> </td>
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
    $html2pdf->pdf->SetTitle('Laporan Arus Kas');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_arus_kas.pdf');
?>