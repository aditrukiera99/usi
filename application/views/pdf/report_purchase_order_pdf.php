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

<?PHP 
function tgl_to_bulan($var){
	if($var == "01"){
	 	$var = "Januari";
	 } else if($var == "02"){
	 	$var = "Februari";
	 } else if($var == "03"){
	 	$var = "Maret";
	 } else if($var == "04"){
	 	$var = "April";
	 } else if($var == "05"){
	 	$var = "Mei";
	 } else if($var == "06"){
	 	$var = "Juni";
	 } else if($var == "07"){
	 	$var = "Juli";
	 } else if($var == "08"){
	 	$var = "Agustus";
	 } else if($var == "09"){
	 	$var = "September";
	 } else if($var == "10"){
	 	$var = "Oktober";
	 } else if($var == "11"){
	 	$var = "November";
	 } else if($var == "12"){
	 	$var = "Desember";
	 }

	 return $var;
}
?>

<table style="width: 100%">
	<tr>
		<td><img style="width: 100%;height: 100px;" src="<?=$base_url2;?>assets/img/header.png"></td>
	</tr>
	
</table>


<br>
<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline; margin-bottom: 0px;">
                PURCHASE ORDER (PO)
            </h4>
            <label>NO : <?=$dt->NO_BUKTI;?></label>
        </td>
    </tr>
</table>
<br>
<br>
<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">Kepada</td>
			<td style="width: 80%;text-align:left;font-size: 15px;">: <b><?=$dt->PELANGGAN;?></b></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;"></td>
			<td style="width: 80%;text-align:left;font-size: 15px;">  &nbsp; Up: <?=$dt->ATAS_NAMA;?></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;"></td>
			<td style="width: 80%;text-align:left;font-size: 15px;"> &nbsp; Di</td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;"></td>
			<td style="width: 80%;text-align:left;font-size: 15px;"> &nbsp; <?=$dt->KOTA;?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">Dengan Hormat,</td>
		</tr>
		<tr>
			<td colspan="2">Dengan ini kami PT. MITRA CENTRAL NIAGA dengan <b>Nomor NPWP : 72.413.138.8-624.000</b> mengajukan permohonan pembelian barang (Solar Industri/HSD) kepada <?=$dt->PELANGGAN;?> dengan rincian sebagai berikut :</td>
		</tr>
	</table>
</div>
<br>
<div>
<table style="border-collapse: collapse;border:1px solid black; margin-left: 9px; width: 94%;">
	
		<tr>
			<th style="text-align: center; width: 5%;padding: 5px 5px 5px 5px; ">NO</th>
			<th style="text-align: center; width: 25%;padding: 5px 5px 5px 5px; ">NAMA</th>
			<th style="text-align: center; width: 25%;padding: 5px 5px 5px 5px; ">KUANTITAS (LITER)</th>
			<th style="text-align: center; width: 25%;padding: 5px 5px 5px 5px; ">HARGA SATUAN</th>
			<th style="text-align: center; width: 20%;padding: 5px 5px 5px 5px; ">JUMLAH</th>
			
		</tr>

		
		<tr>
			<td style="vertical-align: middle; border:1px solid black;padding: 5px 5px 5px 5px;">1</td>
			<td style="vertical-align: middle; border:1px solid black;padding: 5px 5px 5px 5px; text-align: center;">SOLAR HSD <br> (HIGH SPEED DIESEL)</td>
			<td style="vertical-align: middle; text-align: center; border:1px solid black;padding: 5px 5px 5px 5px;"><?=$dt_det->QTY;?></td>
			<td style="vertical-align: middle; border:1px solid black;padding: 5px 5px 5px 5px; text-align: center;"><font align="left">Rp.</font><font align="right" style="float: right;"><?=number_format($dt_det->MODAL);?>.00</font></td>
			<td style="vertical-align: middle; border:1px solid black;padding: 5px 5px 5px 5px; text-align: right;"><font align="left">Rp.</font><font align="right" style="float: right;"> <?=number_format($dt_det->HARGA_INVOICE);?>.00</font></td>
			
		</tr>

		<tr>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;"></td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;" colspan="3" align="center"> JUMLAH </td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px; text-align: right;" ><font align="left">Rp.</font><font align="right" style="float: right;"> <?=number_format($dt_det->HARGA_INVOICE);?>.00</font></td>
		</tr>

</table>
</div>
<br>
<table style="margin-left: 8px;">
	<tr>
		<td colspan="2">Keterangan</td>
	</tr>.
</table>
<table style="margin-left: 30px;">
	<tr>
		<!-- <td colspan="2">- Harga Loco Kilang dan Include PPN,PPh dan PBBKB</td> -->
		<td colspan="2">- Harga Loco Kilang dan Include PPN</td>
	</tr>
	<tr>
		<td>- Tujuan</td>
		<td>: PT Mitra Central Niaga</td>
	</tr>
	<tr>
		<td></td>
		<td>: <?=$dt->ALAMAT_TUJUAN; ?></td>
	</tr>
	
	<tr>
		<td>- Tanggal Pengambilan</td>
		<td>: <?PHP echo date("d F Y", strtotime($dt->TGL_PENGAMBILAN)); ?> </td>
	</tr>

	<tr>
		<td>- Nomor Polisi</td>
		<td>: <?=$dt->NO_POL; ?></td>
	</tr>
	<tr>
		<td>- Pengemudi</td>
		<td>: <?=$dt->SOPIR; ?></td>
	</tr>
	<?php 
		if(count($dt_det_cust) > 0){

	?>
	<tr>
		<td>- Data Customer</td>
		<td>
			<Br>
		<?PHP foreach ($dt_det_cust as $key => $row) { ?>
			 : <?=$key+1;?>. <?=$row->NAMA_CUSTOMER;?> <br>
		<?PHP } ?>
	</td>
	</tr>
	<?php } ?>



</table>
<br>
<div style="height: 200px;">
<table style="width: 100%;border-collapse: collapse;">
	<tr>
		<td style="width: 60%;">&nbsp;</td>
		<td style="width: 40%">
			<table>
			<tr>
				<td>Pasuruan, 
					
					<?php
							$tanggal_a = date("d");
							$tanggal_b = date("m");
							$tanggal_ba = tgl_to_bulan($tanggal_b);
							$tanggal_c = date("Y");

					 echo $tanggal_a.' '.$tanggal_ba.' '.$tanggal_c; ?>
				</td>
			</tr>
			<tr>
				<td>Hormat Kami</td>
			</tr>
			<tr>
				<td>PT. MITRA CENTRAL NIAGA</td>
			</tr>
		
			<tr>
				<td>
					<img src="<?=$base_url2;?>assets/stempel.jpg" style="width: 80%;"> <br>
				&nbsp;&nbsp;&nbsp;&nbsp;ABD.WACHID</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>


<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 17.4;
    $height_in_mm = $height_in_inches * 22.4;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Laporan Purchase Order');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_purchase_order.pdf');
?>