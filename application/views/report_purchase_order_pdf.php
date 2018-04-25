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
		<td><img style="width: 100%;height: 100px;" src="<?=$base_url2;?>assets/img/header.png"></td>
	</tr>
	
</table>


<br>
<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline;">
                PURCHASE ORDER (PO)
            </h4>
            <label>NO : 0011/PO/MCN/II/2018</label>
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
			<td style="width: 80%;text-align:left;font-size: 15px;">  &nbsp; Up. <?=$dt->ATAS_NAMA;?></td>
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
			<td colspan="2">Dengan ini kami PT. MITRA CENTRAL NIAGA dengan <b>Nomor NPWP : 72.413.138.8-624.000</b> mengajukan permohonan pembelian barang (Solar Industri/HSD) kepada PT.Elnusa Petrofin dengan rincian sebagai berikut :</td>
		</tr>
	</table>
</div>
<br>
<div>
<table style="border-collapse: collapse;border:1px solid black;">
	
		<tr>
			<th style="width: 5%;padding: 5px 5px 5px 5px; ">NO</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px; ">NAMA</th>
			<th style="width: 30%;padding: 5px 5px 5px 5px; ">KUANTITAS (LITER)</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px; ">HARGA SATUAN</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px; ">JUMLAH</th>
			
		</tr>
	
		<tr>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">1</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">SIE_GUDANG/00178/2018</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">30</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">Kg</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">0</td>
			
		</tr>
		<tr>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">1</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">SIE_GUDANG/00178/2018</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">30</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">Kg</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">0</td>
			
		</tr>
</table>
</div>
<br>
<table>
	<tr>
		<td colspan="2">Keterangan</td>
	</tr>
	<tr>
		<td colspan="2">- Harga Loco Kilang dan Include PPN,PPh dan PBBKB</td>
	</tr>
	<tr>
		<td>- Tujuan</td>
		<td>: PT Mitra Central Niaga</td>
	</tr>
	<tr>
		<td></td>
		<td>: JL. Komodor Yos Sudarso, Pasuruan</td>
	</tr>
	<tr>
		<td>- Transportir yang dipakai</td>
		<td>: PT Mitra Central Niaga</td>
	</tr>
	<tr>
		<td>- Nopol</td>
		<td>: N 8114 UW</td>
	</tr>

	<tr>
		<td>- Data Customer</td>
		<td>: 1. PT. Hutama Karya, Grati</td>
	</tr>

	<tr>
		<td></td>
		<td>: 2. PT. Waskita Beton Precast, Gresik</td>
	</tr>

</table>
<br>
<div style="height: 200px;">
<table style="width: 100%;border-collapse: collapse;">
	<tr>
		<td style="width: 50%;">&nbsp;</td>
		<td style="width: 50%">
			<table>
			<tr>
				<td>Pasuruan, 06 Februari 2018</td>
			</tr>
			<tr>
				<td>Hormat Kami</td>
			</tr>
			<tr>
				<td>PT. MITRA CENTRAL NIAGA</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>ABD.WACHID</td>
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
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Cetak Purchase Order');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_purchase_order.pdf');
?>