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
<table align="center">
    <tr>
        <td align="center">
            <h4>
                Kartu Mutasi Barang  
            </h4>
        </td>
    </tr>
</table>
<br>

<table style="float: left;width: 100%;">
	<tr>
		<td style="width: 10%;">NAMA BARANG</td>
		<td style="width: 5%;">:</td>
		<td style="width: 10%;">Batu Bara</td>
		<td style="width: 50%;"></td>
		<td style="width: 10%;">KODE BARANG</td>
		<td style="width: 5%;">:</td>
		<td style="width: 10%;">FUB00031</td>
	</tr>
	<tr>
		<td style="width: 10%;">SATUAN</td>
		<td style="width: 5%;">:</td>
		<td style="width: 10%;">Kg</td>
		<td style="width: 50%;"></td>
		<td style="width: 10%;">Cetak Tanggal</td>
		<td style="width: 5%;">=</td>
		<td style="width: 10%;">Selasa, 9 Januari 2018</td>
	</tr>
</table>

<br>
<br>
<table style="width: 100%" class="grid">
	
		<tr>
			<th style="width: 15%">Tanggal</th>
			<th style="width: 20%">No Dokumen</th>
			<th style="width: 20%">Keterangan</th>
			<th style="width: 15%">Masuk</th>
			<th style="width: 15%">Keluar</th>
			<th style="width: 15%">Saldo</th>
		</tr>
	
		<tr>
			<td>9-01-2010</td>
			<td>SIE_GUDANG/00178/2018</td>
			<td>BARANG KELUAR</td>
			<td>1,201,000</td>
			<td>0</td>
			<td>4,201,000</td>
		</tr>
		<tr>
			<td>9-01-2010</td>
			<td>SIE_GUDANG/00178/2018</td>
			<td>BARANG KELUAR</td>
			<td>201,000</td>
			<td>0</td>
			<td>4,201,000</td>
		</tr>
		<tr>
			<td>9-01-2010</td>
			<td>SIE_GUDANG/00178/2018</td>
			<td>BARANG KELUAR</td>
			<td>0</td>
			<td>701,000</td>
			<td>701,000</td>
		</tr>
		<tr>
			<td>9-01-2010</td>
			<td>SIE_GUDANG/00178/2018</td>
			<td>BARANG MASUK</td>
			<td>81,000</td>
			<td>0</td>
			<td>91,000</td>
		</tr>
		<tr>
			<td>9-01-2010</td>
			<td>SIE_GUDANG/00178/2018</td>
			<td>BARANG MASUK</td>
			<td>4,201,000</td>
			<td>0</td>
			<td>4,201,000</td>
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
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle('Laporan Arus Kas');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_arus_kas.pdf');
?>