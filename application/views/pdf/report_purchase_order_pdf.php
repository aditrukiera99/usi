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
<table align="center">
    <tr>
        <td align="center">
            <h3 style="font-weight: bold;">
                PURCHASE ORDER (PO)
            </h3>
        </td>
        
    </tr>
    <tr>
    	<td align="left">
        	<h3 style="font-weight: bold;">
                PT. UNITED SHIPPING INDONESIA
            </h3>
        </td>
    </tr>
</table>
<br>
<br>
<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 17%;text-align:left;font-size: 15px;">Tanggal</td>
			<td style="width: 3%">:</td>
			<td style="width: 40%;text-align:left;font-size: 15px;"> <b><?=$dt->TGL_TRX;?></b></td>
			<td style="width: 40%;text-align:left;font-size: 15px;"><b>Kepada Yth :</b></td>
		</tr>
		<tr>
			<td style="width: 17%;text-align:left;font-size: 15px;height: 40px;">Nomor</td>
			<td style="width: 3%">:</td>
			<td style="width: 40%;text-align:left;font-size: 15px;"> <?=$dt->NOMER_PO;?></td>
			<td  style="width:40%;text-align:left;font-size: 15px;"><?=$dt->PELANGGAN;?></td>
		</tr>
		<!-- <tr>
			<td style="width: 17%;text-align:left;font-size: 15px;height: 40px;">Refrensi No</td>
			<td style="width: 3%">:</td>
			<td style="width: 40%;text-align:left;font-size: 15px;"> SO <?=$dt_det->NO_SO;?></td>
			<td  style="width:40%;text-align:left;font-size: 15px;"></td>
		</tr> -->
		<?php 
			$no_so_det = $dt_det->NO_SO;
			$data_pelanggan = $this->db->query("SELECT p.KODE_PELANGGAN , p.NAMA_PELANGGAN , p.ALAMAT_TAGIH FROM ak_pelanggan p, ak_penjualan ap WHERE  ap.ID_PELANGGAN = p.ID AND ap.NO_BUKTI = '$no_so_det' ")->row();

			$id_sp = $dt->PAJAK_SUPPLY;
			$dt_supp = $this->db->query("SELECT g.NAMA as NAMAG FROM ak_gudang g , ak_pembelian p WHERE p.PAJAK_SUPPLY = g.ID AND g.ID = '$id_sp'")->row();

		?>
		
		<tr>
			<td style="width: 17%;text-align:left;font-size: 15px;">Client</td>
			<td style="width: 3%">:</td>
			<td style="width: 40%;text-align:left;font-size: 15px;"> <?=$dt->NAMA_CUSTOMER;?> </td>
			<td  style="width:40%;text-align:left;font-size: 15px;">Alamat :</td>
		</tr>
		<tr>
			<td style="width: 17%;text-align:left;font-size: 15px;">No SH</td>
			<td style="width: 3%">:</td>
			<td style="width: 40%;text-align:left;font-size: 15px;"> <?=$dt->ID_CUSTOMER;?> </td>
			<td  style="width:40%;text-align:left;font-size: 15px;" rowspan="3"><label><?=$dt->ALAMAT_CUSTOMER;?></label></td>
		</tr>
		<tr>
			<td style="width: 17%;text-align:left;font-size: 15px;">No SP</td>
			<td style="width: 3%">:</td>
			<td style="width: 40%;text-align:left;font-size: 15px;"> 769314 </td>
			<td  style="width:40%;text-align:left;font-size: 15px;"></td>
		</tr>
		
	</table>
	<table style="width: 100%;">
		<tr>
			<td style="width: 17%;text-align:left;font-size: 15px;">Supply Point</td>
			<td style="width: 3%">:</td>
			<td style="width: 40%;text-align:left;font-size: 15px;"><?=$dt_supp->NAMAG;?></td>
			<td  style="width:40%;text-align:left;font-size: 15px;"></td>
			
		</tr>
	</table>
</div>
<br>
<div>
<table style="border-collapse: collapse;border:1px solid black;">
	
		<tr>
			<th style="width: 40%;padding: 5px 5px 5px 5px;text-align: center; ">KETERANGAN</th>
			<th style="width: 15%;padding: 5px 5px 5px 5px;text-align: center; ">QTY</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px;text-align: center; ">HARGA (Rp.)</th>
			<th style="width: 25%;padding: 5px 5px 5px 5px;text-align: center; ">JUMLAH</th>
			
		</tr>
	
		
			
				
				<tr>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;"><?=$dt_det->NAMA_PRODUK;?></td>
					<td style="text-align:center;padding: 5px;border-left: 1px solid black;border-right: 1px solid black;"><?php echo number_format($dt_det->KUI);?> Ltr</td>

					<?php 
						
						// $kod = $dt->ID_CUSTOMER;
						// $kod = $dt->PAJAK_SUPPLY;
						// $pajak_pel = $this->db->query("SELECT * FROM ak_pelanggan WHERE KODE_PELANGGAN = '$kod' ")->row();
						// // $pajak_supply = $this->db->query("SELECT * FROM ak_pajak_supply WHERE KODE_PELANGGAN = '$kod' ")->row();

						// $harga_satuan = round($dt_det->HARGA_SATUAN / (1 + (10/100) + ($pajak_pel->PAJAK_PBBKB/100) + ($pajak_pel->PPH_21/100) + ($pajak_pel->PPH_23/100) + ($pajak_pel->PPH_22/100) + ($pajak_pel->PPH_15/100)  ),2);

					?>

					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?php echo number_format($dt->SUB_TOTAL/$dt_det->KUI,2);?></td>

					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?php echo number_format($dt->SUB_TOTAL,2);?></td>
				</tr>

				

			<tr> 
			<?php 
				if($dt->PBBKB == '0'){
					
				}else{
					
					// $jumlah_pbbkb_satuan = number_format(($pajak_pel->PAJAK_PBBKB/100)*$harga_satuan,2);
					// $jumlah_pbbkb = $jumlah_pbbkb_satuan * $dt_det->KUI;
					?>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;">PBBKB</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;"><?php echo number_format($dt_det->KUI);?>  Ltr</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($dt->PBBKB/$dt_det->KUI, 2);?></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($dt->PBBKB, 2);?></td>
					<?php 
				}
				?>
			</tr>

			<tr>
			<?php 
				if($dt->PPH_21 == '0'){
					
				}else{
					
					$jumlah_pph_21_satuan = number_format(($pajak_pel->PPH_21/100)*$harga_satuan,2);
					$jumlah_pph_21 = $jumlah_pph_21_satuan * $dt_det->KUI;
					?>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;">PPH 21</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;"><?php echo number_format($dt_det->KUI);?>  Ltr</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($dt->PPH_21/$dt_det->KUI, 2);?></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($dt->PPH_21, 2);?></td>
					<?php 
				}
				?>
			</tr>

			<tr>
			<?php 
				if($dt->PPH_23 == '0'){

				}else{

					$jumlah_pph_23_satuan = number_format(($pajak_pel->PPH23/100) * $harga_satuan,2);
					$jumlah_pph_23 = $jumlah_pph_23_satuan * $dt_det->KUI;
					?>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;">PPH 23</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;"><?php echo number_format($dt_det->KUI);?>   Ltr</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?php echo number_format($dt->PPH_23/$dt_det->KUI, 2);?></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($dt->PPH_23, 2);?></td>
					<?php 
				}
				?>
			</tr>

			<tr>
			<?php 
				if($dt->PPH_15 == '0'){

				}else{

					$jumlah_pph_15_satuan = number_format(($pajak_pel->PPH15/100) * $harga_satuan,2);
					$jumlah_pph_15 = $jumlah_pph_15_satuan * $dt_det->KUI;
					?>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;">PPH 15</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;"><?php echo number_format($dt_det->KUI);?>   Ltr</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?php echo number_format($dt->PPH_15/$dt_det->KUI, 2);?></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($dt->PPH_15, 2);?></td>
					<?php 
				}
				?>
			</tr>

			<tr>
			<?php 
				if($dt->PPH_22 == '0'){

				}else{

					$jumlah_pph_22_satuan = number_format(($pajak_pel->PPH_22/100) * $harga_satuan,2);
					$jumlah_pph_22 = $jumlah_pph_22_satuan * $dt_det->KUI;
					?>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;">PPH 22</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: center;"><?php echo number_format($dt_det->KUI);?>   Ltr</td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?php echo number_format($dt->PPH_22/$dt_det->KUI, 2);?></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;text-align: right;"><?=number_format($dt->PPH_22, 2);?></td>
					<?php 
				}
				?>
			</tr>

			
			<tr>
				<td style="height: 150px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
				<td style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
				<td style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
				<td style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
			</tr>
				

		<tr>
			<td></td>
			<td style="border-right: 1px solid black;"></td>
			<td style="border:1px solid black;padding: 5px;">Sub Total<br>PPN<br>Total</td>
			<td style="border:1px solid black;padding: 5px;text-align: right;"><?=number_format($dt->SUB_TOTAL+$dt->PBBKB+$dt->PPH_21+$dt->PPH_23+$dt->PPH_15+$dt->PPH_22, 2);?><br>
				<?php
					if($dt->PPN == '0'){
						$jl_ppn = 0;
					}else{
						$jl_ppn = (10/100) * ($dt_det->KUI*$harga_satuan);
					}
				 ?>

				<?php echo number_format($dt->PPN, 2);?>
				<br><?php $totali = 0; $totali = ($dt_det->KUI*$harga_satuan) + $jumlah_pbbkb + $jumlah_pph_21 + $jl_ppn + $jumlah_pph_23 + $jumlah_pph_22 + $jumlah_pph_15 ; echo number_format($dt->TOTAL, 2); ?></td>
		</tr>
</table>
<br>
<br>
<table style="width: 55%;">
	<tr>
		<?php 
			if($dt->TYPE_CETAK == 'SOLAR'){

			}else{
		?>
		<td style="width: 45%;text-align: center;height: 80px;">Hormat Kami</td>
		<?php } ?>
		<td style="width: 45%;text-align: center;height: 80px;">Mengetahui</td>
	</tr>
	<tr>
		<?php 
			if($dt->TYPE_CETAK == 'SOLAR'){

			}else{
		?>
		<td style="width: 35%;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
		<?php } ?>
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