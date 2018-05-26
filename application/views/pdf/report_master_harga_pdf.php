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
       
        <td style="padding: 5px 5px 5px 5px;width: 100%; ">
        	
        	<h1 align="center">
                <?=$dt->NAMPEL;?>
            </h1>
            <h3 align="center"><?=$dt->NAMPROD;?></h3>
            <h3 align="center"><?=$dt->TAHUN;?></h3>
        </td>
    </tr>
    
</table>
<table style="border-collapse: collapse;width: 100%;">
	<tr>
		<td style="border: 1px solid black;width: 10%;text-align: center;">No</td>
		<td style="border: 1px solid black;width: 30%;text-align: center;">PERIODE</td>
		<td style="border: 1px solid black;width: 30%;text-align: center;">HARGA BELI</td>
		<td style="border: 1px solid black;width: 30%;text-align: center;">HARGA JUAL</td>
	</tr>
	<?php 
		$idp = $dt->ID_PELANGGAN;
		$idpr = $dt->ID_PRODUK;
		$sql = $this->db->query("SELECT * FROM ak_master_harga WHERE ID_PELANGGAN = '$idp' AND ID_PRODUK = '$idpr'")->result();
		$a = 0;
		foreach ($sql as $key => $row) {
			$a++;
			?>
			<tr>
				<td style="border: 1px solid black;text-align: center;font-size: bold;"><?php echo $a; ?></td>
				<td style="border: 1px solid black;text-align: center;"><?=$row->KODE_PERIODE;?></td>
				<td style="border: 1px solid black;text-align: center;"><?=$row->HARGA_BELI;?></td>
				<td style="border: 1px solid black;text-align: center;"><?=$row->HARGA_JUAL;?></td>
			</tr>
			<?php	
		}

	?>
	<tr>
		
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