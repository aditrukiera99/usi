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
    font-size: 14px;
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

<?PHP  if($data_usaha->HEADER_LAPORAN != "" || $data_usaha->HEADER_LAPORAN != null){ ?>

<?PHP 
$jml_kolom = $this->master_model_m->get_jml_kolom_laporan('JU');
$jml_kolom2 = $this->master_model_m->get_jml_kolom_laporan('JU') + 1;
?>

<table align="center">
    <tr>
        <td>
            <img src="<?=$base_url2;?>files/laporan/<?=$data_usaha->HEADER_LAPORAN;?>" width="200" height="100" alt="">
        </td>
    </tr>
</table>

<?PHP } ?>


<table align="center" style="width:100%;">
    <tr>
        <td align="center">
            <h3>
                Laporan Jurnal Umum <br>
                <?=$judul;?>
            </h3>

            <h2 style="margin-top:-10px;"> <?=$data_usaha->NAMA_LAPORAN;?> </h2>
        </td>
    </tr>
</table>


<table align="center" class="grid" style="width:100%;">
    <?php

        $u          = 1 ;
        $baris      = 0 ;
        $kolom      = 0 ;
        $debet      = 0 ;
        $kredit     = 0 ;
        $old_koper  = '' ;
        $next_koper = '' ;
        $last_key   = end(array_keys($data));
        $total_debet  = 0;
        $total_kredit = 0;
        $debet2  = 0;
        $kredit2 = 0;

        foreach ($data as $key => $row) {
            $nilDebet   = str_replace(',', '.', $row->DEBET);
            $nilKredit  = str_replace(',', '.', $row->KREDIT); 
            $koper      = trim($row->NO_VOUCHER);  

            $no_jp = "";

            if($row->NO_JP != "" || $row->NO_JP != null){
                $no_jp = "<font style='color:#983114;'> (JP : ".$row->NO_JP.") </font>";
            }         

            $debet2  += $nilDebet;
            $kredit2 += $nilKredit;

            if ($old_koper != $koper) {
                
                echo "<tr>" ;
                    echo "<td style='background:#FFF; border:none; height:25px;' class='isi_no_border' colspan='".$jml_kolom2."'>  </td>" ;
                echo "</tr>" ;

                echo "<tr>" ;
                echo "<td style='vertical-align:middle; height:15px; background:#FFF; border-bottom:1px solid black; border-left:none; border-right:none;' class='isi_no_border' colspan='".$jml_kolom2."'> NO BUKTI : <b style='color:#2980B9;'>".$row->NO_VOUCHER."</b> <b> | ".$row->TGL."</b> </td>" ;
                echo "</tr>" ;

                echo "<tr>" ;
                echo "<td style='vertical-align:middle; height:15px; background:#FFF; border-bottom:1px solid black; border-left:none; border-right:none;' class='isi_no_border' colspan='".$jml_kolom2."'> URAIAN : <b> ".$row->URAIAN."  ".$no_jp." </b> </td>" ;
                echo "</tr>" ;



                echo "<tr>" ;
                echo "<th style='text-align:center; width:10%;' class='kolom_header'> No </th>" ;

                if($this->master_model_m->cek_kolom('JU', 'kode_akun'))
                echo "<th style='text-align:center; width:35%;' class='kolom_header'> Kode Akun </th>" ;

                if($this->master_model_m->cek_kolom('JU', 'debet'))
                echo "<th style='text-align:center; width:25%;' class='kolom_header'> Debet </th>" ;

                if($this->master_model_m->cek_kolom('JU', 'kredit'))
                echo "<th style='text-align:center; width:25%;' class='kolom_header'> Kredit </th>" ;

                echo "</tr>" ;

                $old_koper = $koper ;
            }

            echo "<tr>" ;
            echo "<td class='gridtd' align='center'>".$u++."</td>" ;
            
            if($this->master_model_m->cek_kolom('JU', 'kode_akun'))
            echo "<td class='gridtd'>(".$row->KODE_AKUN.") - ".$row->NAMA_AKUN."</td>" ;
            
            if($this->master_model_m->cek_kolom('JU', 'debet'))
            echo "<td align='right' class='gridtd'>".number_format($nilDebet, 2, '.', ',')."</td>" ; 
            
            if($this->master_model_m->cek_kolom('JU', 'kredit'))
            echo "<td align='right' class='gridtd'>".number_format($nilKredit, 2, '.', ',')."</td>" ; 

            echo "</tr>" ;

            $debet  += $nilDebet;
            $kredit += $nilKredit;

            
            if($jml_kolom == 3){
            if ($key < $last_key) {
                $k          = $key + 1;
                $next_koper = trim($data[$k]->NO_VOUCHER) ;
            }

            if ($koper != $next_koper || $key >= $last_key) {
                echo "<tr>" ;
                echo "<td class='gridtd' colspan='2'> <b> JUMLAH </b> </td>" ;
                echo "<td align='right' class='gridtd'> <b> ".number_format($debet, 2, '.', ',')." </b> </td>" ;
                echo "<td align='right' class='gridtd'> <b> ".number_format($kredit, 2, '.', ',')." </b> </td>" ;
                echo "</tr>" ;
                
                // $debet       = 0 ;
                // $kredit      = 0 ; 
                // $u           = 1 ;
                  
                $debet  = 0;
                $kredit = 0;

                $u = 1;    

            }
            }

            

            

        }

        if($jml_kolom == 3){
        if(count($data) > 0){

        echo "<tr>" ;
                    echo "<td style='background:#FFF; border-left:none; border-right:none; height:25px;' class='' colspan='4'>  </td>" ;
        echo "</tr>" ;

        echo "<tr>" ;
                        echo "<td class='gridtd' colspan='2'> <b> SUB TOTAL </b> </td>" ;
                        echo "<td align='right' class='gridtd'><b>".number_format($debet2, 2, '.', ',')."</b></td>" ;
                        echo "<td align='right' class='gridtd'><b>".number_format($kredit2, 2, '.', ',')."</b></td>" ;
        echo "</tr>" ;

        }
        }

        $debet2 = 0;
        $kredit2 = 0;
    ?>

</table>

<?PHP if(count($data) == 0){ ?>

<table align="center" class="grid" style="width:100%;">
    <tr>
        <th style='text-align:center; width:25%;' class='kolom_header'> No </th>
        <th style='text-align:center; width:25%;' class='kolom_header'> Kode Akun </th>
        <th style='text-align:center; width:25%;' class='kolom_header'> Debet </th>
        <th style='text-align:center; width:25%;' class='kolom_header'> Kredit </th>
    </tr>
    <tr>
        <td class='gridtd' colspan='4' align="center"> <b> Tidak ada data yang dapat ditampilkan </b> </td>
    </tr>
</table>

<?PHP } ?>


<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 17.4;
    $height_in_mm = $height_in_inches * 22.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle('Laporan Jurnal Umum');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_jurnal_umum.pdf');
?>