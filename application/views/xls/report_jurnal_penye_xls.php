<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_jurnal_penyesuaian.xls");
?>


<style>
.gridth {
    background: #1793d1;
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 17px;
}
.gridtd {
    vertical-align: middle;
    font-size: 17px;
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
    height: 35px;
    padding: 10px;
    vertical-align: middle;
    background: #388ed1;
}

</style>

<table align="center" style="width:100%;">
    <tr>
        <td align="center" colspan="4">
            <h3>
                Laporan Jurnal Penyesuaian <br>
                <?=$judul;?>
            </h3>

            <h4 style="margin-top:-10px;"> UNIT <?=strtoupper($dt_unit->NAMA_UNIT);?> </h4>
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
            $koper      = trim($row->NO_BUKTI);           

            $debet2  += $nilDebet;
            $kredit2 += $nilKredit;

            if ($old_koper != $koper) {
                
                echo "<tr>" ;
                    echo "<td style='background:#FFF; border:none; height:25px;' class='isi_no_border' colspan='4'>  </td>" ;
                echo "</tr>" ;

                echo "<tr>" ;
                echo "<td style='vertical-align:middle; background:#FFF; border-bottom:1px solid black; border-left:none; border-right:none;' class='isi_no_border' colspan='4'> NO BUKTI : <b style='color:#2980B9;'>".$row->NO_BUKTI."</b> <b> | ".$row->TGL."</b> </td>" ;
                echo "</tr>" ;

                echo "<tr>" ;
                echo "<td style='vertical-align:middle; background:#FFF; border-bottom:1px solid black; border-left:none; border-right:none;' class='isi_no_border' colspan='4'> URAIAN : <b> ".$row->URAIAN." (Disesuaikan dari ".$row->NO_VOUCHER.") </b> </td>" ;
                echo "</tr>" ;



                echo "<tr>" ;
                echo "<th style='text-align:center; width:10%;' class='kolom_header'> No </th>" ;
                echo "<th style='text-align:center; width:35%;' class='kolom_header'> Kode Akun </th>" ;
                echo "<th style='text-align:center; width:25%;' class='kolom_header'> Debet </th>" ;
                echo "<th style='text-align:center; width:25%;' class='kolom_header'> Kredit </th>" ;
                echo "</tr>" ;

                $old_koper = $koper ;
            
            }

            echo "<tr>" ;
            echo "<td class='gridtd' align='center'>".$u++."</td>" ;
            echo "<td class='gridtd'>(".$row->KODE_AKUN.") - ".$row->NAMA_AKUN."</td>" ;
            echo "<td align='right' class='gridtd'>".number_format($nilDebet, 2, '.', ',')."</td>" ; 
            echo "<td align='right' class='gridtd'>".number_format($nilKredit, 2, '.', ',')."</td>" ; 
            echo "</tr>" ;

            $debet  += $nilDebet;
            $kredit += $nilKredit;            

            if ($key < $last_key) {
                $k          = $key + 1;
                $next_koper = trim($data[$k]->NO_BUKTI) ;
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
    exit();
?>