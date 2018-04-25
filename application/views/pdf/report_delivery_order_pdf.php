<?PHP  

$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<style type="text/css">
	
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 10pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 18mm;
		padding-top: 8mm;
        margin: 10mm auto;
	    border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
  
</style>
<body>

<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>

<?PHP 
$bulan_kas = date("m",strtotime($dt->TGL_TRX));
$bulan_kas = tgl_to_romawi($bulan_kas);
$tahun_kas = date("Y",strtotime($dt->TGL_TRX));

$no_bukti_real = $dt->NO_BUKTI."/DO/MCN.PAS/".$bulan_kas."/".$tahun_kas;

function tgl_to_romawi($var){
	if($var == "01"){
	 	$var = "I";
	 } else if($var == "02"){
	 	$var = "II";
	 } else if($var == "03"){
	 	$var = "III";
	 } else if($var == "04"){
	 	$var = "IV";
	 } else if($var == "05"){
	 	$var = "V";
	 } else if($var == "06"){
	 	$var = "VI";
	 } else if($var == "07"){
	 	$var = "VII";
	 } else if($var == "08"){
	 	$var = "VIII";
	 } else if($var == "09"){
	 	$var = "IX";
	 } else if($var == "10"){
	 	$var = "X";
	 } else if($var == "11"){
	 	$var = "XI";
	 } else if($var == "12"){
	 	$var = "XII";
	 }

	 return $var;
}

function tgl_to_bulan($var){
	if($var == "01"){
	 	$var = "Januari";
	 } else if($var == "02"){
	 	$var = "Februari";
	 } else if($var == "03"){
	 	$var = "Maret";
	 } else if($var == "04"){
	 	$var = "April";
	 } else if($var == "05"){
	 	$var = "Mei";
	 } else if($var == "06"){
	 	$var = "Juni";
	 } else if($var == "07"){
	 	$var = "Juli";
	 } else if($var == "08"){
	 	$var = "Agustus";
	 } else if($var == "09"){
	 	$var = "September";
	 } else if($var == "10"){
	 	$var = "Oktober";
	 } else if($var == "11"){
	 	$var = "November";
	 } else if($var == "12"){
	 	$var = "Desember";
	 }

	 return $var;
}
?>

<font face="Arial">
<div class="page">

<div style="text-align: center;"><img style="width: 100%; height:10%;" alt="" src="<?=$base_url2;?>assets/img/header.png">
</div>
<br>
<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr align="center">
      <td> <font size="5"><strong><span style="text-decoration: underline;">DELIVERY ORDER</span></strong>
      </font></td>
    </tr>
    <tr>
      <td style="vertical-align: top; text-align: center;"><strong>No. : <?=$no_bukti_real;?></strong>
      </td>
    </tr>
  </tbody>
</table>
<br>

<br>
<font size="3">
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
<tbody>
	<tr>
		<td style="vertical-align: top; width: 10%;">Pembeli<br>
		</td>
		<td style="vertical-align: top; width: 5%;">:<br>
		</td>
		<td style="vertical-align: top; width: 85%;"><?=$dt->PELANGGAN;?>		</td>
	</tr>
	<tr>
		<td style="vertical-align: top; width: 98px;"><br>
		</td>
		<td style="vertical-align: top; width: 7px;"><br>
		</td>
		<td style="vertical-align: top; width: 583px;"><br>
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top; width: 98px;">Tujuan<br>
		</td>
		<td style="vertical-align: top; width: 7px;">:<br>
		</td>
		<td style="vertical-align: top; width: 583px;     line-height: 5px;"><?=$dt->ALAMAT_TUJUAN;?>		</td>
	</tr>
	<tr>
		<td style="vertical-align: top; width: 98px;"><br>
		</td>
		<td style="vertical-align: top; width: 7px;"><br>
		</td>
		<td style="vertical-align: top; width: 583px;">	</td>
	</tr>
</tbody>
</table>
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="vertical-align: top; width: 10%;">Tanggal<br>
</td>
<td style="vertical-align: top; width: 5%;">:<br>
</td>
<td style="vertical-align: top; width: 50%;"><?php
							$tanggal_a = date("d",strtotime($dt->TGL_DO));
							$tanggal_b = date("m",strtotime($dt->TGL_DO));
							$tanggal_ba = tgl_to_bulan($tanggal_b);
							$tanggal_c = date("Y",strtotime($dt->TGL_DO));

					 echo $tanggal_a.' '.$tanggal_ba.' '.$tanggal_c; ?></td>
<td style="vertical-align: top; width: 15%;">Alat Angkut<br>
</td>
<td style="vertical-align: top; width: 5%;">:<br>
</td>
<td style="vertical-align: top; width: 18%;"><?=$dt->ALAT_ANGKUT;?>
</td>
</tr>
<tr>
<td style="vertical-align: top; width: 74px;">No. PO<br>
</td>
<td style="vertical-align: top; width: 8px;">: 
</td>
<td style="vertical-align: top; width: 319px;"><?=$dt->NO_PO;?></td>
<td style="vertical-align: top; width: 89px;">No. Pol.<br>
</td>
<td style="vertical-align: top; width: 19px;">:<br>
</td>
<td style="vertical-align: top; width: 155px;"><?=$dt->NO_POL;?></td>
</tr>
</tbody>
</table>
<p>
</p>

<?PHP 
$sql = "SELECT SUM(QTY) AS QTY FROM ak_penjualan_new_detail WHERE ID_PENJUALAN = '$dt->ID' ";
$dt_sql = $this->db->query($sql)->row();

?>

<table style="border-collapse: collapse; width: 100%; text-align: left; margin-left: auto; margin-right: auto;" border="3" cellpadding="0" cellspacing="0">
	<colgroup><col style="width: 149pt;" width="198"> 
	<col style="width: 85pt;" width="113"> 
	<col style="width: 59pt;" width="78"> 
	<col style="width: 83pt;" width="111"> 
	</colgroup><tbody>
		<tr style="height: 15pt;" height="20">
			<td class="xl65" style="height: 15pt; width: 137px; text-align: center;"><b>Jenis Produk</b></td>
			<td class="xl66" style="border-left: medium none; width: 127px; text-align: center;"><b>Volume</b>
			(L)</td>
			<td colspan="2" class="xl67" style="border-left: medium none; width: 142pt; text-align: center;" width="189"><b>No. Segel</b></td>
		</tr>
		<tr style="height: 15pt;" height="20">
			<td class="xl66" style="border-top: medium none; height: 15pt; text-align: center; width: 137px;" height="20"><br>Solar HSD <br>(High Speed Diesel)<br><br></td>
			<td class="xl66" style="border-top: medium none; border-left: medium none; text-align: center; width: 127px;"><?=str_replace(',', '.', number_format($dt_sql->QTY));?><br></td>
			<td colspan="2" class="xl67" style="border-left: medium none; vertical-align: center;text-align: center;">
			<?=$dt->SEGEL_ATAS;?>			
			</td>
		</tr>
		<tr style="height: 15pt;" height="20">
		<td colspan="2" class="xl67" style="height: 15pt; text-align: center; vertical-align: middle; width: 127px;"><b>Spesifikasi</b></td>
		<td colspan="2" class="xl67" style="border-left: medium none; text-align: center; vertical-align: middle;"><b>Keterangan</b></td>
		</tr>
		<tr style="height: 15pt;" height="20">
			<td colspan="2" class="xl67" style="height: 15pt; width: 127px;" height="20">&nbsp;
			<font size="2">
			<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
				<tbody>
					<tr>
						<td style="vertical-align: top; width: 20%;">Temperatur<br>
						</td>
						<td style="vertical-align: top; width: 5%;">:<br>
						</td>
						<td style="vertical-align: top; width: 75%;"><?=$dt->TEMPERATUR;?>	<br>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;">Density<br>
						</td>
						<td style="vertical-align: top; width: 18px;">:<br>
						</td>
						<td style="vertical-align: top; width: 263px;"><?=$dt->DENSITY;?>	<br>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;">Flash Point<br>
						</td>
						<td style="vertical-align: top; width: 18px;">:<br>
						</td>
						<td style="vertical-align: top; width: 263px;"><?=$dt->FLASH_POINT;?>	<br>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;">Water Content<br>
						</td>
						<td style="vertical-align: top; width: 18px;">:<br>
						</td>
						<td style="vertical-align: top; width: 263px;"><?=$dt->WATER_CONTENT;?>	<br>
						</td>
					</tr>
				</tbody>
			</table>
			</font>
			<br>
			</td>
			<td colspan="2" class="xl67" style="border-left: medium none; text-align: center;">Sebelum Minyak dibongkar/diterima harap diperiksa<br>
				<b>Segel</b> dan <b>Isinya</b><br>
				<br>
				Klaim tidak dilayani setelah dibongkar<br>
			</td>
		</tr>
		<tr style="height: 15pt;" height="20">
			<td class="xl66" style="border-top: medium none; height: 15pt; text-align: center; vertical-align: middle; width: 137px;"><b>Mengetahui</b></td>
			<td class="xl66" style="border-top: medium none; border-left: medium none; text-align: center; vertical-align: middle; width: 127px;"><b>Transportir/Sopir</b></td>
			<td colspan="2" class="xl67" style="border-left: medium none; text-align: center; vertical-align: middle;"><b>Penerima</b></td>
		</tr>
		<tr style="height: 15pt;" height="20">
			<td rowspan="3" class="xl68" style="border-top: medium none; height: 45pt; width: 137px;" height="60">&nbsp;<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div style="text-align: center;"><?=$dt->OPERATOR;?>	<br>
			</div>
			</td>
			<td rowspan="3" class="xl68" style="border-top: medium none; width: 127px;">&nbsp;<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div style="text-align: center;"><?=$dt->SOPIR;?>	<br>
			</div>
			</td>
			<td colspan="2" class="xl67" style="border-left: medium none;">&nbsp;<br>
			<br>
			<br>
			<br>
			<br>
			</td>
		</tr>
		<tr style="height: 15pt;" height="20">
			<td class="xl66" style="border-top: medium none; border-left: medium none; height: 15pt; text-align: center; vertical-align: middle;"><b>Jam Masuk</b></td>
			<td class="xl66" style="border-top: medium none; border-left: medium none; text-align: center; vertical-align: middle;"><b>Jam Keluar</b></td>
		</tr>
			<tr style="height: 15pt;" height="20">
			<td class="xl66" style="border-top: medium none; border-left: medium none; height: 15pt; text-align: center; vertical-align: middle;">&nbsp;</td>
			<td class="xl66" style="border-top: medium none; border-left: medium none;">&nbsp;</td>
			</tr>
     </tbody>
</table>
<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="vertical-align: top; width: 342px;"><small>1. Lembar
Putih untuk Supplier (untuk penagihan)</small><br>
      </td>
      <td style="vertical-align: top; width: 197px;"><small>3. Lembar
Kuning untuk Sopir</small> </td>
      <td style="vertical-align: top; width: 200px;"><br>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top; width: 342px;"><small>2. Lembar
Merah untuk Customer</small> </td>
      <td style="vertical-align: top; width: 197px;"><small>4. Lembar
Hijau untuk Arsip</small> </td>
      <td style="vertical-align: top; width: 200px;"><br>
      </td>
    </tr>
  </tbody>
</table>

</font></div><font size="3">

</font>
</body>

