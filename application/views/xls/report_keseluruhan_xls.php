<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Ringkasan_keseluruhan.xls");
?>


<style>
.gridth {
    background: #388ed1;
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 14px;
}
.gridtd {
    background: #FFFFF0;
    vertical-align: middle;
    font-size: 18px;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
    border: 1px solid #999;
    width: 200px;
}
.grid {
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
}

.grid td {
    border: 1px solid #999;
}

.kolom_header{
    height: 35px;
    padding: 10px;
    vertical-align: middle;
    background: #388ed1;
    font-size: 18px;
}

</style>

<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline;">
                <u>LAPORAN KESELURUHAN</u>
            </h4>
            
        </td>
    </tr>
</table>
<br>

<div>
<table style="border-collapse: collapse;border:1px solid black;" align="center">
    
        <tr>
            <th style="padding: 5px 5px 5px 5px; " align="center">Tanggal</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">No.Do</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Nopol</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Marketing</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Pelanggan dan Tujuan</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Volume</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Harga Beli</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Harga Jual</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Harga Invoice</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Ppn/Non Ppn</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Cash Back</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Profit</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Tempo</th>
            <th style="padding: 5px 5px 5px 5px; " align="center">Tanggal Jatuh Tempo</th>
        </tr>
        <?PHP foreach ($data as $key => $row) { 
            $jatuh_tempo = $row->JATUH_TEMPO;
            if($row->PAJAK == "PPN"){
                $cashback = ($row->HARGA_INVOICE - $row->HARGA_JUAL) * 0.9 * $row->QTY;             
            } else {
                $cashback = ($row->HARGA_INVOICE - $row->HARGA_JUAL)  * $row->QTY;              
            }

            $profit = ($row->HARGA_JUAL - $row->MODAL) * $row->QTY;
        ?>
        <tr>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->TGL_TRX;?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->NO_BUKTI;?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->NO_POL;?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->BROKER;?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="left"><?=$row->PELANGGAN;?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=number_format($row->QTY);?> <?=$row->SATUAN;?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($row->MODAL);?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($row->HARGA_JUAL);?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($row->HARGA_INVOICE);?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center">
                <?PHP if($row->PAJAK == "PPN") {
                    echo "PPN";
                } else {
                    echo "Non";
                }?>
            </td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($cashback);?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="right">Rp <?=number_format($profit);?></td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?=$row->JATUH_TEMPO;?> Hari</td>
            <td style="padding: 5px 5px 5px 5px;border:1px solid black; " align="center"><?PHP echo date('d-m-Y', strtotime($row->TGL_TRX. ' + '.$jatuh_tempo.' days')); ?></td>
        </tr>
        <?PHP } ?>
        
</table>
</div>
<br>



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
    exit();
?>