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
                LAPORAN POSISI SALDO
            </h3>
            <h5>PT PRIMA ELEKTRIK POWER</h5>
            
            <hr/>
        </td>
    </tr>
</table>
<br>
<br>

	
    

    <table style="width: 100%;">
        <tr>
           
            <th style="width: 10%;text-align: center;"></th>
            <th style="width: 10%;text-align: center;">Saldo Buku</th>
            <th style="width: 20%;text-align: center;">Saldo Efektif</th>
            <th style="width: 10%;text-align: center;">Saldo Bank</th>
        </tr>
    
        <?php 
    $u = 0;

    foreach ($dt as $key => $value) {
        
    ?>

        <tr style="">
            <td style="padding: 5px;border-top: 1px dotted;border-bottom: 1px dotted;text-align: center;"></td>
            <td style="padding: 5px;border-top: 1px dotted;border-bottom: 1px dotted;text-align: left;"><?=$valu->TGL_KELUAR; ?></td>
            <td style="padding: 5px;border-top: 1px dotted;border-bottom: 1px dotted;text-align: center;"><?=$valu->kuantitas; ?></td>
            <td style="padding: 5px;border-top: 1px dotted;border-bottom: 1px dotted;text-align: center;"><?=$valu->NILAI; ?></td>
        </tr>
        <?php 
            }
            ?>
    <tr>
        <td><strong>Total</strong></td>
        <td><strong></strong></td>
        <td><strong></strong></td>
        <td><strong></strong></td>
    </tr>
            
    </table>
     
        
        


	



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