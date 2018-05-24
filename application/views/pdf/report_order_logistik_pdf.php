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




<table align="center" style="border-collapse: collapse;width: 100%;">
    <tr>
        <td align="center" style="border:1px solid black; padding: 5px 5px 5px 5px;width:17%; ">
            <h1 style="font-weight: bold;">
                PT. USI
            </h1>
        </td>
        <td style="border:1px solid black; padding: 5px 5px 5px 5px;width: 70%; ">
        	
        	<h1 align="center" style="font-weight: bold;">
                PERMINTAAN PENGADAAN BARANG
            </h1>

        </td>
        <td style="border:1px solid black; padding: 5px 5px 5px 5px;width: 13%;">No. Form :</td>
        
    </tr>
    
</table>
<br>
<br>
<table>
	<tr>
		<td style="padding-bottom: 10px;">Tanggal</td>
		<td>:</td>
		<td><?=$dt->TGL_TRX;?></td>
	</tr>
	<tr>
		<td style="padding-bottom: 10px;">Nama Kapal</td>
		<td>:</td>
		<td></td>
	</tr>
	<tr>
		<td style="padding-right: 30px;">Wilayah Operasional</td>
		<td style="padding-right: 10px;">:</td>
		<td><?=$dt->NAMA_POINT;?></td>
	</tr>
</table>
<br>
<br>
<br>

<table style="width: 100%; border: 1px solid black;border-collapse: collapse;">
	<tr>
		<td style="width: 5%;border: 1px solid black;padding: 5px 5px 5px 5px;">No.</td>
		<td style="width: 50%;border: 1px solid black;padding: 5px 5px 5px 5px;" align="center">Jenis</td>
		<td style="width: 10%;border: 1px solid black;padding: 5px 5px 5px 5px;" align="center" >Jumlah</td>
		<td style="width: 35%;border: 1px solid black;padding: 5px 5px 5px 5px;"  align="center">Keterangan</td>
	</tr>
	<?php 
		$i = 0;
	foreach ($dt_det as $key => $value){
		$i++;
	?>
	<tr>
		<td style="border: 1px solid black;padding: 5px 5px 5px 5px;" align="center"><?php echo $i;?></td>
		<td style="border: 1px solid black;padding: 5px 5px 5px 5px;"><?=$value->NAMA_PRODUK;?></td>
		<td style="border: 1px solid black;padding: 5px 5px 5px 5px;" align="center"><?=$value->QTY;?></td>
		<td style="border: 1px solid black;padding: 5px 5px 5px 5px;"><?=$value->KETERANGAN;?></td>
	</tr>	
<?php } ?>

	<?php 
		$a = $i + 1;
		for($a;$a<19;$a++){
			?>
			<tr>
				<td style="border: 1px solid black;padding: 5px 5px 5px 5px;" align="center"><?php echo $a;?></td>
				<td style="border: 1px solid black;padding: 5px 5px 5px 5px;"></td>
				<td style="border: 1px solid black;padding: 5px 5px 5px 5px;" align="center"></td>
				<td style="border: 1px solid black;padding: 5px 5px 5px 5px;"></td>
			</tr>	
			<?php
		}
	?>
	<tr>
		<td colspan="4" style="height: 50px;border: 1px solid black;padding: 7px 7px 7px 7px;"><h4><?=$dt->KETERANGAN;?></h4></td>
	</tr>
</table>


<table style="width: 55%;">
	<tr>
		<td style="width: 45%;text-align: center;height: 80px;">Hormat Kami</td>
		<td style="width: 45%;text-align: center;">Mengetahui</td>
	</tr>
	<tr>
		<td style="width: 35%;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
		<td style="width: 35%;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
	</tr>
</table>



<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Cetak Sales Order');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_sales_order.pdf');
?>