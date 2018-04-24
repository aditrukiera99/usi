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
            <h4 style="text-decoration: underline;">
                KARTU MUTASI BARANG
            </h4>
            <label></label>
        </td>
    </tr>
</table>
<!-- <br>
<br>
<table>
    <tr>
        <td align="left">Kode Barang</td>
        <td align="center">:</td>
        <td align="left">ABC-91834</td>
    </tr>

    <tr>
        <td align="left">Nama Barang</td>
        <td align="center">:</td>
        <td align="left">Coba Barang</td>
    </tr>

    <tr>
        <td align="left">Satuan</td>
        <td align="center">:</td>
        <td align="left">Kg</td>
    </tr>
</table>

<hr><hr style="margin-top: -10px;"> -->

<div style="width: 100%;">
    <table style="border: 1px; border-collapse: collapse; width: 100%;">
        <tr>
            <th style="width: 10%; text-align: center; height: 25px; vertical-align: middle;">Tanggal</th>
            <th style="width: 20%; text-align: center; height: 25px; vertical-align: middle;">No. Dokumen</th>
            <th style="width: 20%; text-align: center; height: 25px; vertical-align: middle;">Keterangan</th>
            <th style="width: 10%; text-align: center; height: 25px; vertical-align: middle;">Satuan</th>
            <th style="width: 8%; text-align: center; height: 25px; vertical-align: middle;">Masuk</th>
            <th style="width: 8%; text-align: center; height: 25px; vertical-align: middle;">Keluar</th>
            <th style="width: 8%; text-align: center; height: 25px; vertical-align: middle;">Saldo</th>
        </tr>
        <?php 
        $i = 0;
        foreach ($dt as $key => $value) {
            $i++;
        ?>
        <tr style="border: 1px; border-collapse: collapse;">
            <td style="text-align:center; border:1px dotted"><?=$value->tanggal;?></td>
            <td style="border:1px dotted"><?=$value->no_spb;?></td>
            <td style="border:1px dotted"><?=$value->nama_produk;?></td>
            <td style="border:1px dotted"><?=$value->satuan;?></td>
            <td style="text-align:right; border:1px dotted"><?=$value->kuantitas;?></td>
            <td style="text-align:right; border:1px dotted">0</td>
            <td style="text-align:right; border:1px dotted"><?=$value->kuantitas;?></td>
        </tr>
        <?php } ?>
    </table>
</div>



<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Cetak Kartu Stok');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('kartu_stok.pdf');
?>