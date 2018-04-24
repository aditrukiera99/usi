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
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
}

.grid td {
    border-left: 1px solid black;
    border-right: 1px solid black;
    /*border-top: 1px solid black;
    border-bottom: 1px solid black;*/
}

.kolom_header{
    height: 5px;
    padding:5px;
    vertical-align: middle;
    background: #388ed1;
}

</style>

<table cellspacing="0" align="left"> 
    <tr>
        <td align="left" >
            <h5>
                PT. Prima Elektrik Power <br><br>
                DIVISI <?=strtoupper($dt_unit->NAMA_UNIT);?>
            </h5>
        </td>
    </tr>
</table>

<table cellspacing="0" align="center"> 
    <tr>
        <td align="center">
            <h4>
                <?PHP if($filter == "Bulanan"){ ?>
                LAPORAN ARUS KAS BULAN <?=strtoupper($bulan_txt);?> <?=$tahun;?> <br>
                <?PHP } else { ?>
                LAPORAN ARUS KAS TAHUN <?=$tahun;?> <br>
                <?PHP } ?>
            </h4>
        </td>
    </tr>
</table>

<table align="left" class="custom">
    <!-- SALDO AWAL -->
    <tr>
        <td style='text-align:center;'> <b>I</b> </td>
        <td style='text-align:left;' colspan="3"> <b>Saldo Awal</b> </td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>1. Kas</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>2. Bank</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:left;' colspan="4"></td>
    </tr>
    <tr>
        <td style='text-align:center;' colspan="3"> <b>Jumlah</b> </td>
        <td style='text-align:right; border-top:3px solid #000;'> <b>0,00</b> </td>
    </tr>

    <!-- Penerimaan Kas Bank -->
    <tr>
        <td style='text-align:center;'> <b>II</b> </td>
        <td style='text-align:left;' colspan="3"> <b>Penerimaan Kas Bank</b> </td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>1. Penjualan</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>2. Pendapatan Lain</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>3. Bunga Jasa Giro</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>4. Piutang Dagang</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>5. Retur BPJS Ketenagakerjaan</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>6. Retur BPJS Kesehatan</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>7. Retur Pembelian Tunai</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>8. Retur Hutang Dagang</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>9. Terima Pinjaman Modal</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:left;' colspan="4"></td>
    </tr>
    <tr>
        <td style='text-align:center;' colspan="3"> <b></b> </td>
        <td style='text-align:right; border-top:3px solid #000;'> <b>0,00</b> </td>
    </tr>
    <!-- JUMLAH SALDO AWAL + PENERIMAAN -->
    <tr>
        <td style='text-align:center;' colspan="3"> <h4>Jumlah</h4> </td>
        <td style='text-align:right; border-top:3px solid #000;'> <h4>0,00</h4> </td>
    </tr>

    <!-- Pengeluaran Kas Bank -->
    <tr>
        <td style='text-align:center;'> <b>III</b> </td>
        <td style='text-align:left;' colspan="3"> <b>Pengeluaran Kas Bank</b> </td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>1. Pembelian Tunai</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>2. PPN Keluaran</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>3. PPH Ps 22</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>4. Biaya Pemasaran</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>5. Biaya Administrasi</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>6. Service</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>7. Harga Poko Penjualan</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>8. Bayar Hutang Dagang</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>9. Bayar Angsuran Pinjaman</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>10. Setor UBJ</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>11. Setor Simpanan Dana</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>12. Setor PAD pelunasan</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>13. Pengeluaran Investasi</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>14. Pengurangan Harga</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>15. Bayar Hutang Biaya THR</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:left;' colspan="4"></td>
    </tr>
    <tr>
        <td style='text-align:center;' colspan="3"> <b></b> </td>
        <td style='text-align:right; border-top:3px solid #000;'> <b>0,00</b> </td>
    </tr>
    <!-- JUMLAH PENERIMAAN - PENGELUARAN -->
    <tr>
        <td style='text-align:center;' colspan="3"> <h4>Jumlah</h4> </td>
        <td style='text-align:right; border-top:3px solid #000;'> <h4>0,00</h4> </td>
    </tr>

    <!-- SALDO AKHIR -->
    <tr>
        <td style='text-align:center;'> <b>IV</b> </td>
        <td style='text-align:left;' colspan="3"> <b>Saldo Akhir</b> </td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>1. Kas</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:center;'> </td>
        <td style='text-align:left;'>2. Bank</td>
        <td style='text-align:right;'>0,00</td>
        <td style='text-align:right;'></td>
    </tr>
    <tr>
        <td style='text-align:left;' colspan="4"></td>
    </tr>
    <tr>
        <td style='text-align:center;' colspan="3"> <b>Jumlah</b> </td>
        <td style='text-align:right; border-top:3px solid #000;'> <b>0,00</b> </td>
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
            $value = number_format(abs($value), 2);
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
    $html2pdf = new HTML2PDF('P','LEGAL','en');
    $html2pdf->pdf->SetTitle('Laporan Arus Kas');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_arus_kas.pdf');
?>