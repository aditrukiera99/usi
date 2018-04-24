<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>





<br>
<table align="center">
    <tr>
        <td align="center">
            <h3 style="text-decoration: underline;">
                LAPORAN PEMAKAIAN BARANG
            </h3>
            <h5>PT PRIMA ELEKTRIK POWER</h5>
            
            <hr/>
        </td>
    </tr>
</table>
<br>
<br>

	<?php 
    $u = 0;

    foreach ($dt as $key => $value) {
        
    ?>
    <h4>[<?=$value->tanggal;?>] <?=$value->no_bon;?></h4>

    <table style="width: 100%;">
        <tr>
            <th>No</th>
            <th style="width: 35%;text-align: center;">Barang</th>
            <th style="width: 15%;text-align: center;">Jumlah</th>
            <th style="width: 10%;text-align: center;">Satuan</th>
            <th style="width: 30%;text-align: center;">Keterangan</th>
        </tr>
    <?php 
            $i = 0;
            $id_ind = $value->id_bon_gudang_final;
            $jmkl = 0;
            $td = $this->db->query("SELECT * FROM tb_bon_gudang_final_detail WHERE id_induk = '$id_ind'")->result();

            foreach ($td as $key => $valu) {
               $i++;
            
            $jmkl += $valu->kuantitas;
        ?>

        <tr style="">
            <td style="padding: 5px;border-top: 1px dotted;border-bottom: 1px dotted;text-align: center;"><?php echo $i;?></td>
            <td style="padding: 5px;border-top: 1px dotted;border-bottom: 1px dotted;text-align: left;"><?=$valu->nama_produk; ?></td>
            <td style="padding: 5px;border-top: 1px dotted;border-bottom: 1px dotted;text-align: center;"><?=$valu->kuantitas; ?></td>
            <td style="padding: 5px;border-top: 1px dotted;border-bottom: 1px dotted;text-align: center;"><?=$valu->satuan; ?></td>
            <td style="padding: 5px;border-top: 1px dotted;border-bottom: 1px dotted;text-align: left;"><?=$valu->keterangan; ?></td>
        </tr>
        <?php 
            }
            ?>
            <tr>
                <td colspan="2">Jumlah Barang yang Dikeluarkan</td>
                <td style="text-align: center;"><?php echo $jmkl; ?></td>
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
    $html2pdf->pdf->SetTitle('Cetak Order Pekerjaan');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_purchase_order.pdf');
?>