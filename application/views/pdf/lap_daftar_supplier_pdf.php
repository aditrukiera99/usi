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
                DAFTAR SUPPLIER
            </h3>
            <h5>PT PRIMA ELEKTRIK POWER</h5>
            
            <hr/>
        </td>
    </tr>
</table>
<br>
<br>
<hr style="border : 1px double black ">
	<?php 

        foreach ($dt as $key => $value) {
           
    ?>
    <hr style="border: 1px dotted black;">
    <table style="width: 100%;">
        <tr>
            <td style="width: 10%;">Kode</td>
            <td style="width: 5%;">=</td>
            <td style="width: 20%;"><?=$value->kode_supplier;?></td>
            <td style="width: 7%;">Nama</td>
            <td style="width: 5%;">=</td>
            <td style="width: 30%;"><?=$value->nama_supplier;?></td>
        </tr>
        <tr>
            <td style="width: 10%;">Telepon</td>
            <td style="width: 5%;">=</td>
            <td style="width: 20%;"><?=$value->telp;?></td>
            <td style="width: 7%;">Alamat</td>
            <td style="width: 5%;">=</td>
            <td style="width: 30%;"><?=$value->alamat_supplier;?></td>
        </tr>

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
    $html2pdf->pdf->SetTitle('Cetak Daftar Supplier');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('cetak_purchase_order.pdf');
?>