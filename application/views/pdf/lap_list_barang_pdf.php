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
            <h4 style="text-decoration: underline;">
                PENERIMAAN BARANG
            </h4>
            <label></label>
        </td>
    </tr>
</table>
<br>
<br>
<table style="border: 1px; border-collapse: collapse;">
	<tr>
		<th style="width: 5%;">No</th>
		<th style="width: 20%;">No SPB</th>
		<th style="width: 10%;">Tanggal</th>
		<th style="width: 20%;">Nama Barang</th>
		<th style="width: 10%;">Kuantitas</th>
		<th style="width: 10%;">Satuan</th>
		<th style="width: 25%;">Keterangan</th>
	</tr>
	<?php 
	$i = 0;
	foreach ($dt as $key => $value) {
		$i++;
	?>
	<tr style="border: 1px; border-collapse: collapse;">
		<td><?php echo $i; ?></td>
		<td><?=$value->no_spb;?></td>
		<td><?=$value->tanggal;?></td>
		<td><?=$value->nama_produk;?></td>
		<td><?=$value->kuantitas;?></td>
		<td><?=$value->satuan;?></td>
		<td><?=$value->keterangan;?></td>
	</tr>
	<?php } ?>
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
    $html2pdf->pdf->SetTitle('Cetak Purchase Order');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_purchase_order.pdf');
?>