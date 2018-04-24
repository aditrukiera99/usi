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
                LAPORAN PEMBELIAN BARANG
            </h3>
            <h5>PT PRIMA ELEKTRIK POWER</h5>
            
            <hr/>
        </td>
    </tr>
</table>
<br>
<br>

	<?php 

        foreach ($dt as $key => $value) {
           
    ?>
    <h4><?=$value->no_po;?></h4>
	
    <table style="width: 100%;">
        <tr>
            <th>No</th>
            <th style="width: 30%;text-align: center;">Detail Barang</th>
            <th style="width: 20%;text-align: center;">Supplier</th>
            <th style="width: 10%;text-align: center;">Dokumen OPB</th>
            <th style="width: 10%;text-align: center;">Pesan</th>
            <th style="width: 10%;text-align: center;">Harga</th>
            <th style="width: 10%;text-align: center;">Satuan</th>
        </tr>
        <?php 
            $i = 0;
            $a = 0;

            $td = $this->db->query("SELECT tb.no_po , tbd.nama_produk, tbd.kuantitas , tbd.penerimaan , tbd.satuan , tb.tanggal, ms.nama_divisi , tbd.harga, tbd.no_opb , tbd.total , tbd.satuan FROM tb_purchase_order tb , tb_purchase_order_detail tbd , master_divisi ms WHERE ms.id_divisi = tb.divisi AND tb.id_purchase = tbd.id_induk  ")->result();

            foreach ($td as $key => $valu) {
               $i++;
        
        ?>
        <tr>
            <td><?php echo $i;?></td>
            <td style="border-top: 1px dotted;border-bottom: 1px dotted;text-align: left;"><?=$valu->nama_produk; ?></td>
            <td style="border-top: 1px dotted;border-bottom: 1px dotted;text-align: center;"><?=$value->supplier; ?></td>
            <td style="border-top: 1px dotted;border-bottom: 1px dotted;text-align: center;"><?=$valu->no_opb; ?></td>
            <td style="border: 1px dotted;border: 1px dotted;text-align: right;padding-right: 3px;"><?=$valu->kuantitas; ?></td>
            <td style="border: 1px dotted;border: 1px dotted;text-align: right;padding-right: 3px;"><?=$valu->total; ?></td>
            <td style="border: 1px dotted;border: 1px dotted;text-align: right;padding-right: 3px;"><?=$valu->satuan; ?></td>
        </tr>
        <?php 
            }
            ?>
                </table>
                <?php
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
    $html2pdf = new HTML2PDF('L','A4','en');
    $html2pdf->pdf->SetTitle('Cetak Pembelian');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_purchase_order.pdf');
?>