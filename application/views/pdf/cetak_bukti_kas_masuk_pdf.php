<?PHP  
// ob_start(); 
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
<table align="left">
    <tr>
    	<td align="left" style="line-height: 7px;">
        	<h3 style="font-weight: bold;">
                PT. UNITED SHIPPING INDONESIA
            </h3>
            <font style="font-size: 9px;">GONDOSULI NO. 08 RT 005 RW 006, KETABANG, GENTENG, SURABAYA</font>
        </td>
    </tr>
</table>

<table align="center">
    <tr>
        <td align="center">
            <h3 style="font-weight: bold;">
                BUKTI KAS/BANK MASUK
            </h3>
        </td>        
    </tr>
</table>

<div style="width: 100%;padding-top: 10px;padding-bottom: 10px;padding-left:5px;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 10%;text-align:left;font-size: 14px;"><b>No. BKM</b></td>
			<td style="width: 30%;text-align:left;font-size: 14px;">: <?=$dt->NO_VOUCHER;?></td>
			<td style="width: 15%;text-align:left;font-size: 14px;"><b>Tanggal</b></td>
			<td style="width: 40%;text-align:left;font-size: 14px;">: <?PHP echo date("d F Y", strtotime($dt->TGL)); ?> </td>
		</tr>
		<tr>
			<td style="width: 10%;text-align:left;font-size: 14px;"><b>Bank</b></td>
			<td style="width: 30%;text-align:left;font-size: 14px;">: <?=$dt->NAMA_AKUN;?></td>
			<td  style="width:15%;text-align:left;font-size: 14px;"><b>Diterima dari</b></td>
			<td  style="width:40%;text-align:left;font-size: 14px;"> : <?=$dt->KONTAK;?></td>
		</tr>
	</table>
</div>
<br>
<div>
<table style="border-collapse: collapse;border:1px solid black;">
	
		<tr>
			<th style="width: 15%;padding: 5px 5px 5px 5px;text-align: center; ">No. Perkiraan</th>
			<th style="width: 50%;padding: 5px 5px 5px 5px;text-align: center; ">Keterangan</th>
			<th style="width: 35%;padding: 5px 5px 5px 5px;text-align: center; ">Nilai</th>			
		</tr>
	
				
			<?php
			foreach ($dt_det as $key => $va) {
			?>
				<tr>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"><?=$va->KODE_AKUN;?></td>
					<td style="text-align:left;padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"><?=$va->KET;?></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black; text-align: right;">Rp.<?=number_format($va->KREDIT, 2);?></td>
				</tr>
			<?php
			}
			?>
		
		<tr>
			<td style="border-left: :1px solid black;border-bottom: :1px solid black;padding: 5px;"><b></b></td>
			<td style="border:1px solid black;padding: 5px; text-align: right;"><b>TOTAL</b></td>
			<td style="border:1px solid black; border-left: none; padding: 5px; text-align: right;">Rp <?=number_format($dt->DEBET, 2);?></td>
		</tr>
		<tr>
			<td colspan="3"><b>Terbilang : </b> <?PHP echo terbilang($dt->DEBET, $style=4); ?> Rupiah</td>
		</tr>
</table>


<br><br><br>

<table style="border-collapse: collapse;border:1px solid black;">
	
		<tr>
			<th style="width: 25%;padding: 5px 5px 5px 5px;text-align: center; ">Penerima,</th>
			<th style="width: 25%;padding: 5px 5px 5px 5px;text-align: center; ">Kasir,</th>
			<th style="width: 25%;padding: 5px 5px 5px 5px;text-align: center; ">Pembukuan,</th>			
			<th style="width: 25%;padding: 5px 5px 5px 5px;text-align: center; ">Devisi Manager,</th>			
		</tr>
	
				
			<?php
			foreach ($dt_det as $key => $va) {
			?>
				<tr>
					<td style="height:65px; padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
					<td style="padding: 5px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
				</tr>
			<?php
			}
			?>
		
</table>
</div>

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


<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Cetak Bukti Kas Keluar');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('bukti_kas_keluar.pdf');
?>