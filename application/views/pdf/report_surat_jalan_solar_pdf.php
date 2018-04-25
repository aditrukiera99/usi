<?PHP  
 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<head>
  
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>Cetak Surat Jalan No. 0076</title>
    <style>
    body {
        width: 100%;
        height: 90%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 11pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 18mm;
		padding-top: 5mm;
        margin: 5mm auto;
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

 <script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
  
</head>
<body>

<?PHP 
$bulan_kas = date("m",strtotime($dt->TGL_TRX));
$bulan_kas = tgl_to_romawi($bulan_kas);
$tahun_kas = date("Y",strtotime($dt->TGL_TRX));

$no_bukti_real = $dt->NO_BUKTI."/SJ/MCN.PAS/".$bulan_kas."/".$tahun_kas;

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
<?PHP 
$sql = "SELECT SUM(QTY) AS QTY FROM ak_penjualan_new_detail WHERE ID_PENJUALAN = '$dt->ID' ";
$dt_sql = $this->db->query($sql)->row();

?>

<font face="Arial">
<div class="page">
<div style="text-align: center;">
<img style="width: 100%; height: 8%;" alt="" src="<?=$base_url2;?>assets/img/header.png">
</div>
<br>
<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr align="center">
      <td> <font size="3"><strong><span style="text-decoration: underline;">SURAT JALAN</span></strong>
      </font></td>
    </tr>
    <tr>
      <td style="vertical-align: top; text-align: center;"><strong>No. : <?=$no_bukti_real;?></strong>
      </td>
    </tr>
  </tbody>
</table>
<br>
<font size="2">
<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto; font-size: 13px;" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td style="vertical-align: top; width: 10%;">Pembeli <br>
		</td>
		<td style="vertical-align: top; width: 2%;">:</td>
		<td style="vertical-align: top; width: 54%;"><?=$dt->PELANGGAN;?>	</td>
		<td style="vertical-align: top; width: 10%;">No. PO </td>
		<td style="vertical-align: top; width: 2%;">:<br>
		</td>
		<td style="vertical-align: top; width: 28%;"><?=$dt->NO_PO;?></td>
	</tr>
	<tr>
		<td style="vertical-align: top; width: 181px;"> 
		</td>
		<td style="vertical-align: top; width: 10px;">
		</td>
		<td style="vertical-align: top; width: 322px;">
		</td>
		<td style="vertical-align: top; width: 203px;">
		</td>
		<td style="vertical-align: top; width: 6px;">
		</td>
		<td style="vertical-align: top; width: 291px;">
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top; width: 171px;">Tujuan
		</td>
		<td style="vertical-align: top; width: 10px;">: </td>
		<td style="vertical-align: top; width: 322px; line-height: 0px; padding-top: 9px; padding-bottom: 20px;"><?=$dt->ALAMAT_TUJUAN;?>	
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top;">
		</td>
		<td style="vertical-align: top;">
		</td>
		<td style="vertical-align: top;">	
		</td>
	</tr>
	</tbody>
</table>
<table style="border-collapse: collapse; width: 100%; text-align: left; margin-left: auto; margin-right: auto;     font-size: 13px;" border="4" cellpadding="3" cellspacing="">
	<colgroup><col style="width: 143pt;" width="190"> 
	<col style="width: 62pt;" width="82"> 
	<col style="width: 48pt;" width="64"> 
	<col style="width: 75pt;" width="100"> 
	<col style="width: 118pt;" width="157"> 
  </colgroup><tbody>
	<tr style="height: 10pt;" height="32">
		<td class="xl65" style="height: 5pt; width: 23%; text-align: center;"><b>Jenis Produk</b></td>
		<td class="xl65" style="border-left: medium none; width: 15%;">
		<div style="text-align: center;"><b>Volume<br>
        (Liter)</b></div>
        </td>
		<td colspan="2" rowspan="2" class="xl66" style="width: 36%;">
			<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto;     font-size: 13px;" border="0" cellpadding="1" cellspacing="0">
				<tbody>
				<tr>
					<td style="vertical-align: top; width: 25%;">Tanggal
					</td>
					<td style="vertical-align: top; width: 5%;">:
					</td>
					<td style="vertical-align: top; width: 38%;"><?php
							$tanggal_a = date("d",strtotime($dt->TGL_SJ));
							$tanggal_b = date("m",strtotime($dt->TGL_SJ));
							$tanggal_ba = tgl_to_bulan($tanggal_b);
							$tanggal_c = date("Y",strtotime($dt->TGL_SJ));

					 echo $tanggal_a.' '.$tanggal_ba.' '.$tanggal_c; ?>				<br>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top; width: 75px;">Alat Angkut<br>
					</td>
					<td style="vertical-align: top; width: 12px;">:
					</td>
					<td style="vertical-align: top; width: 102px;"><?=$dt->ALAT_ANGKUT;?>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top; width: 75px;">No. Pol
					</td>
					<td style="vertical-align: top; width: 12px;">:
					</td>
					<td style="vertical-align: top; width: 102px;"><?=$dt->NO_POL;?>					</td>
				</tr>
				<tr>
					<td style="vertical-align: top; width: 75px;">No Segel
					</td>
					<td style="vertical-align: top; width: 12px;">:
					</td>
					<td style="vertical-align: top; width: 102px;"><?=$dt->SEGEL_ATAS;?>					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;"><br>
					</td>
					<td style="vertical-align: top;"><br>
					</td>
					<td style="vertical-align: top;"><?=$dt->SEGEL_BAWAH;?>					</td>
				</tr>
				</tbody>
			</table>
        <br>
		</td>
		<td class="xl72" style="width: 118pt; text-align: center;" width="25%"><b>Keterangan</b></td>
	</tr>
    <tr style="height: 60pt;" height="10">
		<td class="xl65" style="border-top: medium none; height: 15pt; width: 167px; text-align: center;" height="15">Solar HSD <br> (High Speed Diesel)</td>
		<td class="xl66" style="border-top: medium none; border-left: medium none; text-align: center; width: 89px;"><?=str_replace(',', '.', number_format($dt_sql->QTY));?></td>
		<td rowspan="3" class="xl69" style="border-bottom: 2pt solid black; width: 118pt; text-align: center;" width="157">Sebelum Minyak dibongkar/diterima harap diperiksa<br>
		<span style="font-weight: bold;">Segel</span> dan <span style="font-weight: bold;">isinya</span><br>
		
		<br>
		Klaim tidak dilayani setelah muatan dibongkar
		</td>
    </tr>
	<tr style="height: 10pt;" height="10">
		<td class="xl65" style="border-top: medium none; height: 10pt; width: 167px; text-align: center;" height="40"><b>Admin</b></td>
		<td colspan="2" class="xl65" style="border-left: medium none; width: 251px; text-align: center;"><b>Transportir/Sopir</b></td>
		<td class="xl65" style="border-top: medium none; border-left: medium none; width: 75pt; text-align: center;" width="100"><b>Penerima</b></td>
	</tr>
	<tr style="height: 10pt;" height="10">
		<td class="xl67" style="border-top: medium none; height: 16.5pt; text-align: center; width: 167px;" height="15">&nbsp;<br>
		<br>
		<br>
		
		<br><?=$dt->OPERATOR;?>		</td>
		<td colspan="2" class="xl68" style="border-left: medium none; text-align: center; width: 251px;">&nbsp;<br>
		
		<br>
		<br>
		<br><?=$dt->SOPIR;?>		</td>
		<td class="xl67" style="border-top: medium none; border-left: medium none; text-align: center;">&nbsp;<br>
    <br>
    <br>
	<br>
	<br>
	</td>
	</tr>
</tbody>
</table>
<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto; font-size: 13px;" border="0" cellpadding="0" cellspacing="0">
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
</font></div><font size="2">
</font>

</body>