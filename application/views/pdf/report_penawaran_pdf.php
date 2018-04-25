<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<head>

  
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Cetak Penawaran</title>
  

  
  
  <style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 10mm;
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

    p{
        margin-top: 1px !important;
    	margin-bottom: 1px !important;
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

$no_bukti_real = $dt->NO_BUKTI."/KW/MCN.PAS/".$bulan_kas."/".$tahun_kas;
$no_bukti_real2 = $dt->NO_BUKTI."/INV/MCN.PAS/".$bulan_kas."/".$tahun_kas;

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


<font face="helvetica">
<div class="page">
<table style="width: 100%">
	<tr>
		<td><img style="width: 100%;height: 130px;" src="<?=$base_url2;?>assets/img/header.png"></td>
	</tr>
	
</table>


<br>

<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;">
	<table style="width: 100%; font-size: 13px;">
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">Nomor</td>
			<td style="width: 80%;text-align:left;font-size: 15px;">: <?=$dt->NO_BUKTI;?></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">Perihal</td>
			<td style="width: 80%;text-align:left;font-size: 15px;">: <b><?=$dt->MEMO;?></b></td>
		</tr>
		
	</table>
</div>

<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;">
	<table style="width: 90%;     font-size: 13px;">
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;">Kepada Yth</td>
			<td style="width: 80%;text-align:left;font-size: 15px;"></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;" colspan="2"><?=$dt->PELANGGAN;?> <br> Up. <?=$dt->UP;?></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;" colspan="2"></td>
		</tr>
		<tr>
			<td style="width: 20%;text-align:left;font-size: 15px;" colspan="2"></td>
		</tr>
		<tr>
			<td colspan="2">Dengan Hormat,</td>
		</tr>
		<tr>
			<td colspan="2">Bersama Ini Kami PT.MITRA CENTRAL NIAGA mengajukan penawaran BBM Solar Industri / HSD, perusahaan yang <br> bapak/ibu pimpin, Barang yang ditawarkan sebagai berikut</td>
		</tr>
	</table>
</div>
<br>
<div>
<table style="border-collapse: collapse;border:1px solid black; width: 94%; margin-left:8px;     font-size: 13px;">
	
		<tr>
			<th style="border: 1px solid; width: 5%;padding: 5px 5px 5px 5px; " align="center">NO</th>
			<th style="border: 1px solid; width: 30%;padding: 5px 5px 5px 5px; " align="center">URAIAN</th>
			<th style="border: 1px solid; width: 30%;padding: 5px 5px 5px 5px; " align="center">MINIMAL ORDER</th>
			<th style="border: 1px solid; width: 30%;padding: 5px 5px 5px 5px; " align="center">HARGA SATUAN(Rp)/Liter</th>
			
		</tr>

		<tr>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px;">1</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px; text-align: center;">SOLAR HSD <br> (HIGH SPEED DIESEL)</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px; text-align: center;"><?=$dt_det->QTY;?> Liter</td>
			<td style="border:1px solid black;padding: 5px 5px 5px 5px; text-align: center;">Rp. <?=number_format($dt_det->HARGA_SATUAN);?></td>		
		</tr>

</table>
</div>
<br>
<table style="margin-left: 5px;     font-size: 13px;">
	<tr>
		<td>Keterangan</td>
	</tr>

	<tr>
		<td style="font-size: 13px;"><?=$dt->KETERANGAN_PENAWARAN;?></td>
	</tr>

	<tr>
		<td>Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih</td>
	</tr>
	

</table>
<br>
<div style="height: 200px;">
<table style="width: 100%;border-collapse: collapse;     font-size: 13px;">
	<tr>
		<td style="width: 50%;">&nbsp;</td>
		<td style="width: 50%">
			<table>
			<tr>
				<td>Pasuruan,
                    <?php
                            $tanggal_a = date("d");
                            $tanggal_b = date("m");
                            $tanggal_ba = tgl_to_bulan($tanggal_b);
                            $tanggal_c = date("Y");

                     echo $tanggal_a.' '.$tanggal_ba.' '.$tanggal_c; ?>
                </td>
			</tr>
			<tr>
				<td>Hormat Kami</td>
			</tr>
			<tr>
				<td>PT. MITRA CENTRAL NIAGA</td>
			</tr>
			<tr>
				<td><img src="<?=$base_url2;?>assets/stempel.jpg" style="width: 80%;"></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ABD.WACHID</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>


</div>
</font>
</body>


<?PHP 
function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
}


function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}
?>