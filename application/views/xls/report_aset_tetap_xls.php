<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_aset_tetap.xls");
?>

<style>
.gridth {
    background: #1793d1;
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 15px;
}
.gridtd {
    vertical-align: middle;
    font-size: 17px;
    height: 25px;
    padding-left: 5px;
    padding-right: 5px;
    border-left: 1px solid black;
    border-right: 1px solid black;
}
.grid {
    border-collapse: collapse;
}

table th {
  border: 1px solid black;
}

.grid td{
  border-left: 1px solid black;
  border-right: 1px solid black;
  border-top: 1px solid black;
  border-bottom: 1px solid black;
}

.kolom_header{
    height: 40px;
    background: #388ed1;
    padding-left: 5px;
    padding-right: 5px;
    font-size: 17px;
}

</style>

<?PHP 
    $voc_now = "";
    $old_voc = "";
?>

<table cellspacing="0" align="left"> 
    <tr align="center">
        <td align="left" colspan="7">
            <h5>
                PD CITRA MANDIRI JAWA TENGAH <br>
                UNIT <?=strtoupper($dt_unit->NAMA_UNIT);?>    
            </h5>
        </td>
    </tr>
</table>


<table align="center">
    <tr>
        <td align="center" colspan="7">
            <h4>
                DAFTAR AKTIVA TETAP BERUJUD DAN AKUMULASI PENYUSUTAN <br>
                <?=strtoupper($judul);?>   
            </h4>
        </td>
    </tr>
</table>

<table align="center" class="grid">
    <tr>
        <th style='vertical-align: middle; text-align:center; width:5%;' class='kolom_header'> NO </th>
        <th style='vertical-align: middle; text-align:center; width:5%;' class='kolom_header'> </th>
        <th style='vertical-align: middle; text-align:center; width:9%;' class='kolom_header'> NAMA AKTIVA </th>
        <th style='vertical-align: middle; text-align:center; width:9%;' class='kolom_header'> TAHUN PEROLEHAN </th>
        <th style='vertical-align: middle; text-align:center; width:9%;' class='kolom_header'> HARGA PEROLEHAN </th>
        <th style='vertical-align: middle; text-align:center; width:9%;' class='kolom_header'> TARIF PENYUSUTAN </th>
        <th style='vertical-align: middle; text-align:center; width:9%;' class='kolom_header'> AKUMULASI PENYUSUTAN S/D TAHUN <?php echo $tahun - 1 ;?> </th>
        <th style='vertical-align: middle; text-align:center; width:9%;' class='kolom_header'> PENYUSUTAN S/D <?=$bln_txt;?> <?=$tahun;?> </th>
        <th style='vertical-align: middle; text-align:center; width:9%;' class='kolom_header'> AKUMULASI PENYUSUTAN S/D <?=$bln_txt;?> <?=$tahun;?> </th>
        <th style='vertical-align: middle; text-align:center; width:9%;' class='kolom_header'> NILAI BUKU AKHIR S/D <?=$bln_txt;?> <?=$tahun;?>  </th>
    </tr>
    
    <tr>
        <?PHP 
        foreach ($data as $key => $row) {
        ?>
        <tr>
            <td align="center"><b><?=num_to_alpha($key+1);?></b></td>
            <td align="center"></td>
            <td><b><?=$row->GRUP;?></b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <?PHP 
        $dt_sub = $this->db->query("SELECT * FROM ak_aset_subgrup WHERE ID_GRUP = '$row->ID' ")->result();
        if(count($dt_sub) > 0){ 
            foreach ($dt_sub as $key2 => $row2) {
        ?>
        <tr>
            <td align="right">&nbsp;</td>
            <td align="center"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td align="right"></td>
            <td align="center"><b><?=$key2+1;?></b></td>
            <td><b><?=$row2->SUB_GRUP;?></b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td align="right">&nbsp;</td>
            <td align="center"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?PHP 
            $dt_list = $this->db->query("
                SELECT a.*, b.*
                FROM ak_aset_list a 
                LEFT JOIN(
                    SELECT ID_ASET, TH_PEROLEHAN, HARGA_PEROLEHAN, TARIF_SUSUT, AKUMULASI_SUSUT_1, SUSUT_SD_NOW, AKUMULASI_SUSUT_2, NILAI_BUKU_AKHIR
                    FROM ak_aset_nilai 
                    WHERE BULAN = '$bulan' AND TAHUN = '$tahun'
                ) b ON a.ID = b.ID_ASET
                WHERE a.ID_GRUP = '$row->ID' AND a.ID_SUB = '$row2->ID'
            ")->result();
            foreach ($dt_list as $key3 => $row3) {
            ?>
            <tr>
                <td align="right"></td>
                <td align="center"><?=$key3+1;?></td>
                <td><?=$row3->NAMA_ASET;?></td>

                <td style="text-align: center;"><?=$row3->TH_PEROLEHAN;?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->HARGA_PEROLEHAN);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->TARIF_SUSUT);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->AKUMULASI_SUSUT_1);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->SUSUT_SD_NOW);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->AKUMULASI_SUSUT_2);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->NILAI_BUKU_AKHIR);?></td>
            </tr>
            <?PHP 
            }
        }
        ?>

        <?PHP } else { ?>

        <?PHP 
            $dt_list = $this->db->query("
                SELECT a.*, b.*
                FROM ak_aset_list a 
                LEFT JOIN(
                    SELECT ID_ASET, TH_PEROLEHAN, HARGA_PEROLEHAN, TARIF_SUSUT, AKUMULASI_SUSUT_1, SUSUT_SD_NOW, AKUMULASI_SUSUT_2, NILAI_BUKU_AKHIR
                    FROM ak_aset_nilai 
                    WHERE BULAN = '$bulan' AND TAHUN = '$tahun'
                ) b ON a.ID = b.ID_ASET
                WHERE a.ID_GRUP = '$row->ID' AND a.ID_SUB = 0
            ")->result();
            foreach ($dt_list as $key3 => $row3) {
            ?>
            <tr>
                <td align="right"></td>
                <td align="center"><?=$key3+1;?></td>
                <td><?=$row3->NAMA_ASET;?></td>
                <td style="text-align: center;"><?=$row3->TH_PEROLEHAN;?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->HARGA_PEROLEHAN);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->TARIF_SUSUT);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->AKUMULASI_SUSUT_1);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->SUSUT_SD_NOW);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->AKUMULASI_SUSUT_2);?></td>
                <td style="text-align: right;"><?=format_akuntansi($row3->NILAI_BUKU_AKHIR);?></td>
            </tr>
            <?PHP 
            }
        ?>

        <?PHP } ?>

        <?PHP } ?>
    </tr>
</table>


<?PHP if(count($data) == 0){ ?>

<table align="center" class="grid" style="width:100%;">
    <tr>
        <td class='gridtd' align="center"> <b> Tidak ada data yang dapat ditampilkan </b> </td>
    </tr>
</table>

<?PHP } ?>

<?PHP 
    function format_akuntansi($value)
    {
        if($value > 0){
            $value = number_format($value, 2);
        } else if($value == 0){
            $value = "";
        } else if($value == ""){
            $value = "";
        } else {
            $value = number_format(abs($value), 2);
        } 
        return $value;
    }

    function num_to_alpha($val){
        $alp = "";
        if($val == 1){
            $alp = "A";
        }

        if($val == 2){
            $alp = "B";
        }

        if($val == 3){
            $alp = "C";
        }

        if($val == 4){
            $alp = "D";
        }

        if($val == 5){
            $alp = "E";
        }

        if($val == 6){
            $alp = "F";
        }

        if($val == 7){
            $alp = "G";
        }

        if($val == 8){
            $alp = "H";
        }

        if($val == 9){
            $alp = "I";
        }

        return $alp;
    }
?>




<?PHP
    exit();
?>