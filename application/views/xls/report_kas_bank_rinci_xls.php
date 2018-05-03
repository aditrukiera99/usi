<?PHP  
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_kas_bank_rinci.xls");
?>

<style>
.gridth {
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    font-size: 12px;
}
.gridtd {
    vertical-align: middle;
    font-size: 12px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
    border-collapse: collapse;
}

.grid td, table th {
  border: 1px solid black;
  padding-top:5px;
  padding-bottom:5px;
}

.kolom_header{
    font-size: 12px;
}

</style>

<table align="left" style="margin-left: 15px;">
    <tr>
        <td align="left" style="line-height: 7px;">
            <h3 style="font-weight: bold;">
                PT. UNITED SHIPPING INDONESIA
            </h3>
            <font style="font-size: 9px;">GONDOSULI NO. 08 RT 005 RW 006, KETABANG, GENTENG, SURABAYA</font>
        </td>
    </tr>
</table>

<table align="center" style="width:100%;">
    <tr>
        <td align="center" style="line-height: 7px;">
            <h3>
                LAPORAN PERINCIAN KAS-BANK  <br>                
            </h3>
            <?=$judul;?>
        </td>
    </tr>
</table>

<table align="left" style="width:100%;">
    <tr>
        <td align="left" style="width: 15%;"></td>
        <td align="left"></td>
        <td align="center" style="width: 10%;">Mata Uang</td>
        <td align="left" style="width: 25%; border-bottom: 1px solid;">IDR</td>
    </tr>
    <tr>
        <td align="left"></td>
        <td align="left"></td>
        <td align="center" style="width: 10%;">BANK</td>
        <td align="right"><b><?=$data_sa->NAMA_AKUN;?></b></td>
    </tr>
</table>


<table align="center" class="grid" style="width: 100%;">
    <tr>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> TANGGAL </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> NO BUKTI </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> URAIAN  </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> KODE ACCT  </th>
        <th style='width: 15%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> NO REFF/NAMA ACCT  </th>
        <th style='width: 20%;vertical-align: middle; text-align:center;' class='kolom_header' colspan="2"> MUTASI  </th>
        <th style='width: 10%;vertical-align: middle; text-align:center;' class='kolom_header' rowspan="2"> SALDO AKHIR  </th>
    </tr>
    <tr>
        <th style='vertical-align: middle; text-align:center;' class='kolom_header'> PENERIMAAN </th>
        <th style='vertical-align: middle; text-align:center;' class='kolom_header'> PENGELUARAN </th>
    </tr>
    <?PHP 
    $tot_terima = 0;
    $tot_keluar = 0;
    $tot_saldo_akhir = 0;

    echo "<tr>" ;
        echo "<td class='gridtd' style='text-align:left;'></td>" ;
        echo "<td class='gridtd' style='text-align:left;'>SALDO AWAL</td>" ;
        echo "<td class='gridtd' style='text-align:left;'></td>" ;
        echo "<td class='gridtd' style='text-align:left;'></td>" ;
        echo "<td class='gridtd' style='text-align:left;'></td>" ;
        echo "<td class='gridtd' style='text-align:right;'></td>" ;
        echo "<td class='gridtd' style='text-align:right;'></td>" ;
        echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($data_sa->SALDO_AWAL)."</td>" ;
    echo "</tr>" ; 

    $saldo_awal = $data_sa->SALDO_AWAL;
    $saldo_akhir = 0;
    foreach ($data as $key => $row) {

        $saldo_akhir = $saldo_awal + ($row->NILAI_TERIMA - $row->NILAI_KELUAR);

        echo "<tr>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->TGL."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->NO_VOUCHER."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->URAIAN."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->KODE_AKUN."</td>" ;
            echo "<td class='gridtd' style='text-align:left;'>".$row->NAMA_AKUN."</td>" ;
            echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->NILAI_TERIMA)."</td>" ;
            echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($row->NILAI_KELUAR)."</td>" ;
            echo "<td class='gridtd' style='text-align:right;'>".format_akuntansi($saldo_akhir)."</td>" ;
        echo "</tr>" ; 

        $saldo_awal = $saldo_akhir;

        $tot_terima += $row->NILAI_TERIMA;
        $tot_keluar += $row->NILAI_KELUAR;  

    }
    ?>

    <tr>
        <th style='border: 1px solid #000 !important; text-align:center;' class='gridtd'  colspan="5">SUBTOTAL</th>
        <th style='border: 1px solid #000 !important; text-align:right;' class='gridtd'><b><?=format_akuntansi($tot_terima);?></b></th>
        <th style='border: 1px solid #000 !important; text-align:right;' class='gridtd'><b><?=format_akuntansi($tot_keluar);?></b></th>
        <th style='border: 1px solid #000 !important; text-align:right;' class='gridtd'><b><?=format_akuntansi($tot_terima - $tot_keluar);?></b></th>
    </tr>
</table>


<?PHP 
    function format_akuntansi($value)
    {
        if($value > 0){
            $value = number_format($value, 2);
        } else if($value == 0){
            $value = 0;
        } else {
            $value = "(".number_format(abs($value), 2).")";
        }
        return $value;
    }
?>

<?PHP
    exit();
?>