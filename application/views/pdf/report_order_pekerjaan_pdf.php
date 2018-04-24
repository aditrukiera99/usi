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
		<td style="width: 15%;text-align: right;border: 1px solid black;"><?=$dt->tanggal;?></td>
	</tr>
	<tr>
		<td style="width: 50%;text-align: left;">Jawa Timur - Indonesia</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: right;border: 1px solid black;">No</td>
		<td style="width: 15%;text-align: right;border: 1px solid black;"><?=$dt->id_opek;?></td>
	</tr>
</table>


<br>
<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline;">
                ORDER PEKERJAAN (OPEK)
            </h4><br>
            <h5><?=$dt->no_opek;?></h5>
        </td>
    </tr>
</table>
<br>
<br>
<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;border: 1px solid black;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 50%;text-align:left;font-size: 15px;">DIVISI : <?=$dt->nama_divisi;?></td>
			<td style="width: 50%;text-align:left;font-size: 15px;">UNTUK PEMBELIAN</td>
		</tr>
	</table>
</div>
<br>
<div style="height: 300px;">
<table style="width: 100%;height: 300px;">
	
		<tr>
			<th style="width: 5%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">No</th>
			<th style="width: 45%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Pekerjaan</th>
			<th style="width: 50%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Keterangan</th>
		</tr>
		

		<?php 
		$i = 0;
			foreach ($dt_det as $key => $value) {
			$i++;
		?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?=$value->nama;?></td>
			<td><?=$value->keterangan;?></td>
			
		</tr>
		<?php } ?>
		
</table>
</div>
<label>Catatan Umum</label><br>
<label>1.Waktu Pekerjaan : <?=$dt->lama_hari;?> Hari</label><br>
<label>2.Proyek tersebut diatas diperlukan paling lambat : <?=$dt->limit_proyek;?></label><br>
<label>Refrensi</label><br><br>
<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;border: 1px solid black;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 50%;text-align:left;font-size: 15px;"><?=$dt->refrensi;?></td>
		</tr>
	</table>
</div>

<table style="width: 100%;">
	<tr>
		<td style="width: 30%;text-align: center;">Mengetahui</td>
		<td style="width: 30%;text-align: center;">Disetujui Oleh</td>
		<td style="width: 30%;text-align: center;">Diajukan Oleh </td>
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
<label>Tembusan Kepada : 1. Bag.Gudang 2.Accounting 3.Arsip Kabag Pemakai</label>

<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('OPEK');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_arus_kas.pdf');
?>