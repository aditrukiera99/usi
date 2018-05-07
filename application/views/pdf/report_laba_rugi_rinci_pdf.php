<?PHP  ob_start(); ?>

<style>
.gridth {
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 20px;
}
.gridtd {
    vertical-align: middle;
    font-size: 14px;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
    border-collapse: collapse;
}

.grid td, table th {
  border: 1px solid black;
}

.kolom_header{
    height: 20px;
}

</style>



<table align="center" style="width:100%;">
    <tr>
        <td align="center">
            <h3>
                Laporan Laba Rugi <br>
                <?=$judul;?>
            </h3>
        </td>
    </tr>
</table>

<?PHP if(count($dt) > 0) { ?>

<table align="center" class="grid" style="width:100%;">
    <?php

        echo "<tr>" ;
            echo "<th style='text-align:center; width:5%;'  class='kolom_header'> No </th>" ;
            echo "<th style='text-align:center; width:15%;' class='kolom_header'> Kode Akun </th>" ;
            echo "<th style='text-align:center; width:50%;' class='kolom_header'> Nama Akun </th>" ;
            echo "<th style='text-align:center; width:30%;' class='kolom_header'> Jumlah </th>" ;
        echo "</tr>" ;

        $u          = 1 ;
        $baris      = 0 ;
        $kolom      = 0 ;
        $debet      = 0 ;
        $kredit     = 0 ;
        $old_koper  = '' ;
        $koper2  = '' ;
        $next_koper = '' ;
        $last_key   = end(array_keys($dt));
        $total_debet  = 0;
        $total_kredit = 0;
        $debet2  = 0;
        $kredit2 = 0;

        $total_pend_penjualan = 0;
        $total_harga_pokok_penjualan = 0;
        $total_biaya_operasional = 0;
        $total_pendapatan_lain = 0;
        $total_biaya_lain = 0;

        foreach ($dt as $key => $row) {
            $nilDebet   = str_replace(',', '.', $row->JML);
            $nilKredit  = str_replace(',', '.', $row->JML); 
            $koper      = trim($row->KATEGORI);  
            $warna      = trim($row->WARNA);  

            $koper2      = trim($row->KATEGORI);
            if($koper == "Penjualan"){
                $koper2 = "Pendapatan dari Penjualan";
            } else if($koper == "Beban"){
                $koper2 = "Biaya Operasional";
            } else if($koper == "Beban Lain-lain"){
                $koper2 = "Biaya Lainnya";
            }

            if($row->TIPE == 'K'){
                $nilDebet  = str_replace(',', '.', $row->JML * -1); 
            } else {
                $nilDebet  = str_replace(',', '.', $row->JML); 
            }

            // TOTAL PER BAGIAN

            if($koper2 == "Pendapatan dari Penjualan"){
                $total_pend_penjualan += $nilDebet;
            } else if($koper2 == "Harga Pokok Penjualan"){
                $total_harga_pokok_penjualan += $nilDebet;
            } else if($koper2 == "Biaya Operasional"){
                $total_biaya_operasional += $nilDebet;
            } else if($koper2 == "Pendapatan Lain-lain"){
                $total_pendapatan_lain += $nilDebet;
            } else if($koper2 == "Biaya Lainnya"){
                $total_biaya_lain += $nilDebet;
            }

            // END OF TOTAL PER BAGIAN

            $debet2  += $nilDebet;
            $kredit2 += $nilKredit;

            if ($old_koper != $koper) {

                echo "<tr>" ;
                    echo "<td class='kolom_header' align='left' colspan='4'> <b style='font-size:14px;'> ".$koper2." </b> </td>" ;
                echo "</tr>" ;               

                $old_koper = $koper ;
            }

            echo "<tr>" ;
            echo "<td class='gridtd' align='center'>".$u++."</td>" ;
            echo "<td class='gridtd' align='center'>".$row->KODE_AKUN."</td>" ;
            echo "<td class='gridtd'>".$row->NAMA_AKUN."</td>" ;
            echo "<td align='right' class='gridtd'>".format_akuntansi($nilDebet)."</td>" ; 
            echo "</tr>" ;

            $debet  += $nilDebet;
            $kredit += $nilKredit;
            

            if ($key < $last_key) {
                $k          = $key + 1;
                $next_koper = trim($dt[$k]->KATEGORI) ;
            }

            if ($koper != $next_koper || $key >= $last_key) {
                echo "<tr>" ;
                echo "<td style='color:".$warna.";' class='gridtd' colspan='3' align='right'> <b> Total ".$koper2." </b> </td>" ;
                echo "<td style='color:".$warna.";' align='right' class='gridtd'> <b> ".format_akuntansi($debet)." </b> </td>" ;
                echo "</tr>" ;

                if($koper2 == "Harga Pokok Penjualan"){

                    $laba_kotor = $total_pend_penjualan - $total_harga_pokok_penjualan;

                    echo "<tr>" ;
                    echo "<td style='color:#002663;' class='gridtd' colspan='3' align='right'> <b> Laba Kotor </b> </td>" ;
                    echo "<td style='color:#002663;' align='right' class='gridtd'> <b> ".format_akuntansi($laba_kotor)." </b> </td>" ;
                    echo "</tr>" ; 
                }

                if($koper2 == "Biaya Operasional"){

                    $pend_bersih_operasional = $total_pend_penjualan - $total_harga_pokok_penjualan - $total_biaya_operasional;

                    echo "<tr>" ;
                    echo "<td style='color:#002663;' class='gridtd' colspan='3' align='right'> <b> Pendapatan Bersih Operasional </b> </td>" ;
                    echo "<td style='color:#002663;' align='right' class='gridtd'> <b> ".format_akuntansi($pend_bersih_operasional)." </b> </td>" ;
                    echo "</tr>" ; 
                }

                if($koper2 == "Biaya Lainnya"){

                    $pend_bersih = $total_pend_penjualan - $total_harga_pokok_penjualan - $total_biaya_operasional + $total_pendapatan_lain - $total_biaya_lain;

                    echo "<tr>" ;
                    echo "<td style='color:#002663;' class='gridtd' colspan='3' align='right'> <b> PENDAPATAN BERSIH </b> </td>" ;
                    echo "<td style='color:#002663;' align='right' class='gridtd'> <b> ".format_akuntansi($pend_bersih)." </b> </td>" ;
                    echo "</tr>" ; 
                }

                $debet  = 0;
                $kredit = 0;

                $u = 1;    

            }

        }

    ?>

</table>

<?PHP } else { ?>

<table align="center" class="grid" style="width:100%;">
    <tr>
        <th style='text-align:center; width:25%;' class='kolom_header'> No </th>
        <th style='text-align:center; width:25%;' class='kolom_header'> Kode Akun </th>
        <th style='text-align:center; width:25%;' class='kolom_header'> Nama Akun </th>
        <th style='text-align:center; width:25%;' class='kolom_header'> Jumlah </th>
    </tr>
    <tr>
        <td class='gridtd' colspan='4' align="center"> <b> Tidak ada data yang dapat ditampilkan </b> </td>
    </tr>
</table>

<?PHP } ?>

<?PHP 
    function format_akuntansi($value)
    {
        if($value >= 0){
            $value = number_format($value, 2, '.', ',');
        } else {
            $value = number_format(abs($value), 2, '.', ',');
            $value = "(".$value.")";
        }

        return $value;
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
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle('Laporan Laba Rugi');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_laba_rugi.pdf');
?>