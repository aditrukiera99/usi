<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<head>

  
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Cetak Penawaran Beli</title>
  

  
  
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

<h1 align="center"><u>SALES CONFIRMATION ORDER</u></h1>

<div style="width: 50%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;float: right;">
	<table style="width: 100%; font-size: 13px;float: right;border:1px solid black;border-collapse: collapse;">
		<tr>
			<td style="width: 60%;text-align:left;font-size: 15px;border:1px solid black;padding: 10px;">Tanggal Pemesanan</td>
			<td style="width: 40%;text-align:left;font-size: 15px;border:1px solid black;padding: 10px;">: <?=$dt->TGL_TRX;?></td>
		</tr>
	</table>
  <table style="width: 100%; font-size: 13px;float: right;border:1px solid black;border-collapse: collapse;margin-top: 10px;">
    <tr>
      <td style="width: 60%;text-align:left;font-size: 15px;border:1px solid black;padding: 10px;">Nomor Pemesanan</td>
      <td style="width: 40%;text-align:left;font-size: 15px;border:1px solid black;padding: 10px;">: <?=$dt->NOMER_PO;?></td>
    </tr>
  </table>
</div>
<div style="float: left;padding-top: 40px;padding-left: 5px;width: 100%;">
  <table style="width: 100%">
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">SUPPLIER</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  PT.PERTAMINA (PERSERO)</td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Nama Perusahaan</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  PT. UNITED SHIPPING INDONESIA</td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Ship To</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  898122</td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Sold To</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  769-314</td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">NPWP</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  02.622.627-4.611.000</td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Alamat</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  JL. GONDOSULI NO.8 <br>SURABAYA</td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">No. Telp/Fax</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  031-5471841</td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Jenis BBM</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  <?=$dt_detil->NAMA_PRODUK;?></td>
    </tr>
    <?php 
      $id = $dt->ID;
      $pel = $this->db->query("SELECT g.NAMA , mh.HARGA_BELI FROM ak_gudang g , ak_master_harga mh , ak_pembelian p , ak_pelanggan pl WHERE p.ID_CUSTOMER = pl.KODE_PELANGGAN AND pl.ID_SUPPLY_POINT = g.ID AND pl.KODE_PELANGGAN = mh.ID_PELANGGAN AND p.ID = '$id' ")->row();


    ?>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Depot Pengambilan</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  <?=$pel->NAMA;?></td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Tujuan Pengiriman</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;"> <label style=""> <?=$dt->PELANGGAN;?></label><br><p style="padding-left: 27px;"><?=$dt->ALAMAT;?></p></td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Jumlah Volume</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;">  <?php echo number_format($dt_detil->QTY,0);?> Liter</td>
    </tr>

    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Harga Satuan (Rp/Ltr)</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;"> Rp. <?php echo number_format($pel->HARGA_BELI,2);?></td>
    </tr>

    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Harga Total</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;"> Rp. <?php echo number_format($pel->HARGA_BELI * $dt_detil->QTY ,2);?></td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Jumlah Total</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;"> Rp. <?php echo number_format($pel->HARGA_BELI * $dt_detil->QTY,2);?></td>
    </tr>
    <tr style="padding-top: 5px;">
      <td style="width: 27%;">Transportir</td>
      <td style="width: 3%;">:</td>
      <td style="width: 70%;"><label>
       
        <?php 
          foreach ($trans_det as $key => $trn) {
            echo $trn->NAMAS;
            echo '<br>';
          }


        ?>
      </label>

      </td>
    </tr>
    
    
  </table>
</div>
<br>
<div style="float: right;width: 30%;">
    <table style="width: 100%;">
      <tr>
        <td style="height: 150px;">Pemesanan</td>
      </tr>
      <tr>
        <td>(Herman Kwandy)</td>
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