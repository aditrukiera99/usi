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




<br>
<table align="center">
    <tr>
        <td align="center">
            <h3 style="text-decoration: underline;">
                PENYELESAIAN JASA 
            </h3>
            <h5>PT PRIMA ELEKTRIK POWER</h5>
            
            <hr/>
        </td>
    </tr>
</table>
<br>
<br>

	
	<?php 
	$i = 0;
    $a = 0;
	foreach ($dt as $key => $value) {
		$i++;
	?>

    <h4><?php echo $i; ?>.[<?=$value->tanggal;?>] <?=$value->no_spb;?></h4>
    <hr>
    <?php 
        $ch = $value->id_penyelesaian;
        $cui = $this->db->query("SELECT * FROM tb_penyelesaian_jasa_detail WHERE id_induk = '$ch'")->result();

    ?>
    <table style="width: 100%;">
        <tr>
            <th style="width: 5%;text-align: center;">No</th>
            <th style="width: 30%;">Supplier</th>
            <th style="width: 20%;">Keterangan Pekerjaan</th>
            <th style="width: 10%;">% Selesai</th>
            <th style="width: 10%;">Nilai Jasa</th>
            <th style="width: 20%;">Dokumen Reff</th>
        </tr>
        <?php 
            foreach ($cui as $key => $valu) {
             $a++;
            
        ?>
        <tr>
            <td><?php echo $a; ?></td>
            <td><?=$value->nama_supplier; ?></td>
            <td><?=$valu->keterangan; ?></td>
            <td><?=$valu->akhir; ?></td>
            <td><?=$valu->nilai_jasa; ?></td>
            <td><?=$valu->no_spk; ?></td>
        </tr>
        <?php 
            }
        ?>
        <tr>
            <td colspan="6"><hr style="border: 1px dotted;" /></td>
        </tr>
        
    </table>

	
	<?php } ?>


<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('L','A4','en');
    $html2pdf->pdf->SetTitle('Cetak penyelesian jasa');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_purchase_order.pdf');
?>