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
            <h3 style="text-decoration: underline;">
                PEMINJAMAN BARANG
            </h3>
            <h5>PT PRIMA ELEKTRIK POWER</h5>
            
            <hr/>
        </td>
    </tr>
</table>
<br>
<br>

	
	<?php 
	$i = 0;
    $a = 0;
    ?>
    <table style="width: 100%;">
        <tr>
            <th style="width: 30%;text-align: center;">Dokumen</th>
            <th style="width: 20%;">Barang</th>
            <th style="width: 20%;">Departemen</th>
            <th style="width: 10%;">Diambil</th>
            <th style="width: 10%;">Sisa</th>
            <th style="width: 10%;">Satuan</th>
        </tr>
    <?php
	foreach ($dt as $key => $value) {
		$i++;
	?>
  
        <tr>
            
            <td><?=$value->no_spb; ?></td>
            <td><?=$value->nama_produk; ?></td>
            <td><?=$value->nama_divisi; ?></td>
            <td><?=$value->kuantitas; ?></td>
            <td><?=$value->sisa_jumlah; ?></td>
            <td><?=$value->satuan; ?></td>
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