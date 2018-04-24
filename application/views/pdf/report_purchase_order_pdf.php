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
		<td style="width: 15%;text-align: right;border: 1px solid black;"><?=$dt->id_purchase;?></td>
	</tr>
</table>


<br>
<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline;">
                PURCHASE ORDER (PO)
            </h4>
            <label><?=$dt->no_po;?></label>
        </td>
    </tr>
</table>
<br>
<br>
<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 50%;text-align:left;font-size: 15px;">Kepada :</td>
			<td style="width: 50%;text-align:left;font-size: 15px;"><?=$dt->supplier;?></td>
		</tr>
	</table>
</div>
<br>
<div style="height: 300px;">
<table style="width: 100%;height: 300px;">
	
		<tr>
			<th style="width: 5%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">No</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Nama Barang</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Jumlah</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Harga</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Disc</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Total</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">No OPB</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Keterangan</th>
			
		</tr>
		<?php
		$i = 0;
		foreach ($dt_det as $key => $value) {
		$i++;

		
		 ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?=$value->nama_produk;?></td>
			<td><?=$value->kuantitas;?></td>
			<td><?=$value->harga;?></td>
			<td><?=$value->disc;?></td>
			<td><?=$value->total;?></td>
			<td><?=$value->no_opb;?></td>
			<td><?=$value->keterangan;?></td>
			
		</tr>
		<?php } ?>
		
		
	
</table>
</div>
<br>
<table>
	<tr>
		<td>Harap segera memberitahukan kepada kami</td>
		<td>DPP</td>
		<td></td>
		<td style="float: right;"><?=$dt->sub_total;?>,00</td>
	</tr>
	<tr>
		<td>bila syarat tersebut tidak terpenuhi</td>
		<td>Discount</td>
		<td><?=$dt->dc_po;?>%</td>
		<td style="float: right;">Rp.<?=$dt->po_text;?>,00</td>
	</tr>
	<tr>
		<td></td>
		<td>PPN</td>
		<td><?=$dt->dc_ppn;?>%</td>
		<td style="float: right;">Rp.<?=$dt->ppn_text;?>,00</td>
	</tr>
	<tr>
		<td></td>
		<td>Total</td>
		<td></td>
		<td style="float: right;">Rp.<?=$dt->total;?>,00</td>
	</tr>
</table>
<br>
<label>Terbilang : Tujuh Ratus Ribu Tiga Puluh Enam Ribu Rupiah</label><br>
<div style="height: 200px;">
<table style="width: 100%;border-collapse: collapse;">
	<tr>
			<th style="text-align:center;width: 50%;padding: 5px 5px 5px 5px; border: 1px solid black;">Type of Payment</th>
			<th style="text-align:center;width: 50%;padding: 5px 5px 5px 5px; border: 1px solid black;">Note</th>
			
		</tr>
		<tr>
			<td style="height: 150px;border: 1px solid black;padding: 5px 5px 5px 5px;"><?=$dt->terms;?></td>
			<td style="height: 150px;border: 1px solid black;"></td>
		</tr>
</table>
</div>

<table style="width: 100%;">
	<tr>
		<td style="width: 25%;text-align: center;">Supplier</td>
		<td style="width: 25%;text-align: center;">Mengetahui</td>
		<td style="width: 25%;text-align: center;">Menyetujui</td>
		<td style="width: 25%;text-align: center;">Yang Membuat</td>
	</tr>
</table>
<br>
<br>
<br>
<br>
<br>
<table style="width: 100%;">
	<tr>
		<td style="width: 25%;text-align: center;">(...................................)</td>
		<td style="width: 25%;text-align: center;">(...................................)</td>
		<td style="width: 25%;text-align: center;">(...................................)</td>
		<td style="width: 25%;text-align: center;">(...................................)</td>
	</tr>
</table>
<br>
<label>Tembusan Kepada : 1.Arsip (Supplier)  2. Copy (Arsip Pembelian) 3. Copy (Akuntansi) 4.Copy (Gudang)</label>

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