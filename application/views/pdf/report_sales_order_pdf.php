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

<?php 
$bulan_kas = date("m",strtotime($dt->TGL_TRX));

		if($bulan_kas == "01"){
	    $var = "I";
	   } else if($bulan_kas == "02"){
	    $var = "II";
	   } else if($bulan_kas == "03"){
	    $var = "III";
	   } else if($bulan_kas == "04"){
	    $var = "IV";
	   } else if($bulan_kas == "05"){
	    $var = "V";
	   } else if($bulan_kas == "06"){
	    $var = "VI";
	   } else if($bulan_kas == "07"){
	    $var = "VII";
	   } else if($bulan_kas == "08"){
	    $var = "VIII";
	   } else if($bulan_kas == "09"){
	    $var = "IX";
	   } else if($bulan_kas == "10"){
	    $var = "X";
	   } else if($bulan_kas == "11"){
	    $var = "XI";
	   } else if($bulan_kas == "12"){
	    $var = "XII";
	   }

$tahun_kas = date("Y",strtotime($dt->TGL_TRX));
?>

<br>
<table style="width: 100%;">
    <tr>
        <td style="text-align: center;width: 100%;">
            <h3 style="font-weight: bold;text-align: center;">
                SALES ORDER (SO)
            </h3>
        </td>
        
    </tr>
    <tr>
    	<td align="left">
        	<h3 style="font-weight: bold;text-align: left;">
                PT. UNITED SHIPPING INDONESIA
            </h3>
        </td>
    </tr>
</table>
<div style="width: 100%;padding-bottom: 10px;padding-left:5px;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">Tanggal</td>
			<td style="width: 40%;text-align:left;font-size: 15px;">: <b><?=$dt->TGL_TRX;?></b></td>
			<td style="width: 40%;text-align:left;font-size: 15px;"><b>Customer</b></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">Nomor SO</td>
			<td style="width: 40%;text-align:left;font-size: 15px;">: <?=$dt->NOMER_SO;?></td>
			<td  style="width:40%;text-align:left;font-size: 15px;" rowspan="2"><?=$dt->PELANGGAN;?><br><?=$dt->ALAMAT;?></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">Refrensi No</td>
			<td style="width: 40%;text-align:left;font-size: 15px;"> </td>
			<td  style="width:40%;text-align:left;font-size: 15px;"></td>
		</tr>
	</table>
</div>
<div>
<table style="border-collapse: collapse;border:1px solid black;">
	
		<tr>
			<th style="width: 40%;padding: 5px 5px 5px 5px;text-align: center; ">Keterangan</th>
			<th style="width: 15%;padding: 5px 5px 5px 5px;text-align: center; ">QTY</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px;text-align: center; ">Harga (Rp.)</th>
			<th style="width: 25%;padding: 5px 5px 5px 5px;text-align: center; ">Jumlah (Rp.)</th>
			
		</tr>
	
		

			
			
				<?php
				$tutik = 0;
			foreach ($dt_deti as $key => $va) {
				
				?>
				<tr>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;"><?=$va->NAMA_PRODUK;?></td>
					<td style="text-align:center;padding: 5px;border-left: 1px solid black;border-right: 1px solid black;"><?php echo number_format($va->QTY,2);?> Ltr</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($va->TOTAL / $va->QTY, 2);?></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($va->TOTAL, 2);?></td>
				</tr>
				<?php
				
			}
			?>
			
			<?php 
				if($dt->OAT == '0' || $dt->OAT == ''){

				}else{
					$oati_sat = $dt->OAT / $va->QTY;
					?>
					<tr>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;">Transportasi FEE</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;"><?php echo number_format($va->QTY,2);?> Ltr</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($oati_sat, 2);?><</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($dt->OAT, 2);?></td>
					</tr>
					<?php 
				}
				?>
			
			<tr>
				<td style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;height: 150px;"></td>
				<td style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
				<td style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
				<td style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
			</tr>

		<tr>
			<td></td>
			
			<td style="border-right: 1px solid black;"></td>
			<td style="border:1px solid black;padding: 5px;">Sub Total<br>PPN<br>Total</td>
			<td style="border:1px solid black;padding: 5px;text-align: right;"><?=number_format($dt->SUB_TOTAL + $oati, 2);?><br><?=number_format($dt->PPN, 2);?><br><?php $totali = 0; $totali =$dt->SUB_TOTAL + $dt->PPN + $dt->OAT; echo number_format($totali, 2); ?></td>
		</tr>
</table>
<table style="width: 55%;">
	<tr>
		<td style="width: 35%;text-align: center;height: 50px;">Sales Officer</td>
		<td style="width: 35%;text-align: center;">Purchase</td>
		<td style="width: 35%;text-align: center;">Manager</td>
	</tr>
	<tr>
		<td style="width: 35%;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
		<td style="width: 35%;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
		<td style="width: 35%;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
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
    $html2pdf->pdf->SetTitle('Cetak Sales Order');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_sales_order.pdf');
?>