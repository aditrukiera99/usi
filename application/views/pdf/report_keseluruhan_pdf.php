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

<!-- <table style="width: 100%">
	<tr>
		<td><img style="width: 100%;height: 100px;" src="<?=$base_url2;?>assets/img/header.png"></td>
	</tr>
	
</table>
 -->

<br>
<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline;">
                <u>LAPORAN KESELURUHAN</u>
            </h4>
            
        </td>
    </tr>
</table>
<br>

<div>
<table style="border-collapse: collapse;border:1px solid black; font-size: 13px;" align="center">
	
		<tr>
			<th style="padding: 5px 5px 5px 5px; " align="center">Tanggal</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">No.Do</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Nopol</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Marketing</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Pelanggan dan Tujuan</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Volume</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Harga Beli</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Harga Jual</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Harga Invoice</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Ppn/Non Ppn</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Cash Back</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Profit</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Tempo</th>
			<th style="padding: 5px 5px 5px 5px; " align="center">Tanggal Jatuh Tempo</th>
		</tr>
		<?PHP foreach ($data as $key => $row) { 
			$jatuh_tempo = $row->JATUH_TEMPO;
			if($row->PAJAK == "PPN"){
				$cashback = ($row->HARGA_INVOICE - $row->HARGA_JUAL) * 0.9 * $row->QTY;				
			} else {
				$cashback = ($row->HARGA_INVOICE - $row->HARGA_JUAL)  * $row->QTY;				
			}

			$profit = ($row->HARGA_JUAL - $row->MODAL) * $row->QTY;
		?>
		<tr>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->TGL_TRX;?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->NO_BUKTI;?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->NO_POL;?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->BROKER;?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="left"><?=$row->PELANGGAN;?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=number_format($row->QTY);?> <?=$row->SATUAN;?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($row->MODAL);?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($row->HARGA_JUAL);?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($row->HARGA_INVOICE);?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center">
				<?PHP if($row->PAJAK == "PPN") {
					echo "PPN";
				} else {
					echo "Non";
				}?>
			</td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($cashback);?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($profit);?></td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->JATUH_TEMPO;?> Hari</td>
			<td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?PHP echo date('d-m-Y', strtotime($row->TGL_TRX. ' + '.$jatuh_tempo.' days')); ?></td>
		</tr>
		<?PHP } ?>
		
</table>
</div>
<br>





<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('L','LEGAL','en');
    $html2pdf->pdf->SetTitle('Cetak Ringkasan Keseluruhan');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_ringkasan_keseluruhan.pdf');
?>