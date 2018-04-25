<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<head>
  
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>Cetak Dokumen No. 0076</title>
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
<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>  
  
</head>
<body>
<?PHP 
$bulan_kas = date("m",strtotime($dt->TGL_TRX));
$bulan_kas = tgl_to_romawi($bulan_kas);
$tahun_kas = date("Y",strtotime($dt->TGL_TRX));

$no_bukti_real = $dt->NO_BUKTI."/INV/MCN.PAS/".$bulan_kas."/".$tahun_kas;

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
<img style="width: 100%; height: 130px;" alt="" src="<?=$base_url2;?>assets/img/header.png">
</div>
<br>
<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr align="center">
      <td> <font size="4"><strong><span style="text-decoration: underline;">INVOICE (FAKTUR TAGIHAN)</span></strong>
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
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td style="vertical-align: top; width: 10%;">Pembeli<br>
			</td>
			<td style="vertical-align: top; width: 3%;">:<br>
			</td>
			<td style="vertical-align: top; width: 73%;"><?=$dt->PELANGGAN;?>		</td>
		</tr>
		<tr>
			<td style="vertical-align: top; width: 111px;"><br>
			</td>
			<td style="vertical-align: top; width: 17px;"><br>
			</td>
			<td style="vertical-align: top; width: 935px;"><br>
		    </td>
		</tr>
		<tr>
			<td style="vertical-align: top; width: 111px;">Tujuan<br>
			</td>
			<td style="vertical-align: top; width: 17px;">:<br>
			</td>
			<td style="vertical-align: top; width: 935px; line-height: 3px; padding-top: 10px;"><?=$dt->ALAMAT_TUJUAN;?>		</td>
		</tr>
		<tr>
			<td style="vertical-align: top; width: 111px;"><br>
			</td>
			<td style="vertical-align: top; width: 17px;"><br>
			</td>
			<td style="vertical-align: top; width: 935px;">	</td>
		</tr>
	</tbody>
</table>

</font>
<br>
<font size="2">

<font size="3">
    </font><table style="text-align: left; width: 100%; " border="2" cellpadding="" cellspacing="1">

  <tbody>
    <tr>
      <td style="width: 5%; text-align: center; padding: 10px;"><strong>No.</strong>
      </td>
      <td style="width: 30%; text-align: center; padding: 10px;"><strong>Jenis Produk</strong>
      </td>
      <td style="width: 15%; text-align: center; padding: 10px;"><strong>Volume (L)</strong>
      </td>
      <td style="width: 20%; text-align: center; padding: 10px;"><strong>Harga Satuan</strong>

      </td>
      <td style="width: 20%; text-align: center; padding: 10px;"><strong>Jumlah Harga </strong>

      </td>
    </tr>

    <tr>
      <td style="padding-top:20px; vertical-align: top; width: 87px; text-align: center;">1<br>
      </td>
      <td style="padding-top:20px; vertical-align: top; width: 275px;">
      Harga Dasar Solar / HSD
      <br>

      <?PHP 
        $harga_satuan = $dt_det->HARGA_INVOICE;
        $harga_satuan2 = "";
      ?>

      <?PHP if($dt_det->PAJAK == "PPN"){?>
      PPN 10 %
      <?PHP 
      $harga_satuan  =  $dt_det->HARGA_INVOICE/1.1;
      $harga_satuan2 =  $dt_det->HARGA_INVOICE - $harga_satuan;
      } 
      ?>
      <br>      
      <br>
      <br>
      <br>
      <br>
      </td>
      <td style="padding-top:20px; vertical-align: top; text-align: center;"><?=str_replace(',', '.', number_format($dt_sql->QTY));?>      </td>
      <td style="padding-top:20px; padding-right: 20px; vertical-align: top; text-align: right"><?=number_format($harga_satuan, 0, ',', '.');?> <br>
	  
	  
	    <?PHP if($dt_det->PAJAK == "PPN"){ ?>
	    <span style="padding-right: 4px;"><?=number_format($harga_satuan2, 0, ',', '.');?></span>	   
      <?PHP } ?>
      </td>
      <td style="padding-top:20px; padding-right: 20px; vertical-align: top; text-align: right">
         <?=number_format($harga_satuan*$dt_sql->QTY, 0, ',', '.');?>
	       <?PHP if($dt_det->PAJAK == "PPN"){ ?>
         <?=number_format($harga_satuan2*$dt_sql->QTY, 0, ',', '.');?>   
         <?PHP } ?>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top; width: 87px;"><br>
      </td>
      <td style="vertical-align: top; width: 275px;">Harga<br>
      </td>
      <td style="vertical-align: top; text-align: center;"><?=str_replace(',', '.', number_format($dt_sql->QTY));?>     </td>
      <td style="vertical-align: top; text-align: right; padding-right: 20px;"> 
        <?=number_format($dt_det->HARGA_INVOICE, 0, ',', '.');?>   	      
      </td>
      <td style="vertical-align: top; text-align: right; padding-right: 20px;">
        <font size="3"><strong><span style="text-decoration: underline;"><?=number_format($dt_det->HARGA_INVOICE * $dt_sql->QTY, 0, ',', '.');?>        </span></strong></font>
      </td>
    </tr>
    <tr>
      <td colspan="5" rowspan="1" style="vertical-align: top; width: 87px;">Terbilang : <font size="3"><i><b> <?PHP echo terbilang($dt_det->HARGA_INVOICE * $dt_sql->QTY, $style=3); ?> Rupiah</b></i></font>
      </td>
    </tr>

    <tr>
      <td colspan="5" rowspan="1" style="vertical-align: top; width: 87px; height: 140px;">
        <?=$dt->KETERANGAN;?>
      </td>
    </tr>

    <tr>
      <td colspan="5" rowspan="1" style="vertical-align: top; width: 87px;">
      <table style="text-align: left; width: 100%; font-size: 13px;" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td style="vertical-align: top; width: 562px;">
            <?php 
                if($dt_det->PAJAK == 'PPN'){
              ?>
              <b>No. Rekening :</b><br>
  			       &nbsp;&nbsp;&nbsp;1. Bank BCA 0893799777  - PT Mitra Central Niaga, Pasuruan <br>
               &nbsp;&nbsp;&nbsp;2. Bank Mandiri 1440077799937 - PT. Mitra Central Niaga, Pasuruan<br>			
        			 <?php }else{ ?>
        			      <b>No. Rekening :</b><br>
               &nbsp;&nbsp;&nbsp;1. Bank BCA 0890588000  - a/n ABD. WACHID<br>
               &nbsp;&nbsp;&nbsp;2. Bank Mandiri 1440067773777 - a/n ABD. WACHID
            <?php } ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            </td>
            <td style="vertical-align: top; width: 369px; text-align: center;">Pasuruan, <?PHP 
                    $tanggal_a = date("d");
              $tanggal_b = date("m");
              $tanggal_ba = tgl_to_bulan($tanggal_b);
              $tanggal_c = date("Y");

           echo $tanggal_a.' '.$tanggal_ba.' '.$tanggal_c;  ?> <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <span style="font-weight: bold; text-decoration: underline;">ABD. Wachid</span><br>
Pimpinan<br>
            </td>
          </tr>
        </tbody>
      </table>
</td>
    </tr>
  </tbody>
</table><font size="3">


</font></font></div><font size="2"><font size="3">
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