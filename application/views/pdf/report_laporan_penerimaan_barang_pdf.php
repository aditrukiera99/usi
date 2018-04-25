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
                LAPORAN PENERIMAAN BARANG (LPB)
            </h4>
            <label>001/PB/MCN/II/2018</label>
        </td>
    </tr>
</table>
<br>
<br>
<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;border: 1px solid black;">
	<table style="width: 100%;">
		<tr>
			<td style="text-align:left;font-size: 15px;">PO No. : 001/PO/MCN/II/2018</td>
		</tr>
		<tr>
			<td style="text-align:left;font-size: 15px;">Diterima Dari : [SUSMA0838] SURYA MAKMUR AGUNG SEJAHTERA</td>
		</tr>
	</table>
</div>
<br>
<div style="height: 300px;">
<table style="width: 100%;height: 300px;">
	
		<tr>
			
			<th style="width: 15%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Kode Barang</th>
			<th style="width: 25%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Nama Barang</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Jumlah</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Satuan</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Harga</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Total Harga</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Keterangan</th>
		</tr>
	
		<tr>
			<td>1</td>
			<td>SIE_GUDANG/00178/2018</td>
			<td>30</td>
			<td>Kg</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			
		</tr>
		<tr>
			<td>1</td>
			<td>SIE_GUDANG/00178/2018</td>
			<td>30</td>
			<td>Kg</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			
		</tr>
		<tfoot>
			<tr>
				<td colspan="3"></td>
				<td>Total</td>
				<td colspan="2">Rp.9.000.000,00</td>
				<td></td>
			</tr>
		</tfoot>
		
	
</table>
</div>


<table style="width: 100%;">
	<tr>
		<td style="width: 30%;text-align: center;">Pembelian</td>
		<td style="width: 30%;text-align: center;">Akunting</td>
		<td style="width: 30%;text-align: center;">Gudang</td>
	</tr>
</table>
<br>
<br>
<br>
<br>
<br>
<table style="width: 100%;">
	<tr>
		<td style="width: 30%;text-align: center;">(...................................)</td>
		<td style="width: 30%;text-align: center;">(...................................)</td>
		<td style="width: 30%;text-align: center;">(...................................)</td>
	</tr>
</table>
<br>


<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Laporan Arus Kas');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_arus_kas.pdf');
?>