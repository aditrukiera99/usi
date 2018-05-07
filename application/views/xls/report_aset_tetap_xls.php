<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_aset_tetap.xls");
?>

<style>
.gridth {
    background: #1cc7d0;
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
    background: #1cc7d0;
    padding-left: 5px;
    padding-right: 5px;
    font-size: 17px;
}

</style>

<?PHP 
    $voc_now = "";
    $old_voc = "";
?>

<table align="left">
    <tr>
        <td align="left" style="line-height: 7px;">
            <h3 style="font-weight: bold;">
                PT. UNITED SHIPPING INDONESIA
            </h3>
            <font style="font-size: 9px;">GONDOSULI NO. 08 RT 005 RW 006, KETABANG, GENTENG, SURABAYA</font>
        </td>
    </tr>
</table>

<table align="center">
    <tr>
        <td align="center" colspan="10">
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
    
        <?PHP 
        $sub_tot_1 = 0;
        $sub_tot_2 = 0;
        $sub_tot_3 = 0;
        $sub_tot_4 = 0;
        $sub_tot_5 = 0;
        $sub_tot_6 = 0;

        foreach ($data as $key => $row) {
            $tot_1 = 0;
            $tot_2 = 0;
            $tot_3 = 0;
            $tot_4 = 0;
            $tot_5 = 0;
            $tot_6 = 0;
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
                $tot_1 += $row3->HARGA_PEROLEHAN;
                $tot_2 += $row3->TARIF_SUSUT;
                $tot_3 += $row3->AKUMULASI_SUSUT_1;
                $tot_4 += $row3->SUSUT_SD_NOW;
                $tot_5 += $row3->AKUMULASI_SUSUT_2;
                $tot_6 += $row3->NILAI_BUKU_AKHIR;

                $sub_tot_1 += $row3->HARGA_PEROLEHAN;
                $sub_tot_2 += $row3->TARIF_SUSUT;
                $sub_tot_3 += $row3->AKUMULASI_SUSUT_1;
                $sub_tot_4 += $row3->SUSUT_SD_NOW;
                $sub_tot_5 += $row3->AKUMULASI_SUSUT_2;
                $sub_tot_6 += $row3->NILAI_BUKU_AKHIR;
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
                $tot_1 += $row3->HARGA_PEROLEHAN;
                $tot_2 += $row3->TARIF_SUSUT;
                $tot_3 += $row3->AKUMULASI_SUSUT_1;
                $tot_4 += $row3->SUSUT_SD_NOW;
                $tot_5 += $row3->AKUMULASI_SUSUT_2;
                $tot_6 += $row3->NILAI_BUKU_AKHIR;

                $sub_tot_1 += $row3->HARGA_PEROLEHAN;
                $sub_tot_2 += $row3->TARIF_SUSUT;
                $sub_tot_3 += $row3->AKUMULASI_SUSUT_1;
                $sub_tot_4 += $row3->SUSUT_SD_NOW;
                $sub_tot_5 += $row3->AKUMULASI_SUSUT_2;
                $sub_tot_6 += $row3->NILAI_BUKU_AKHIR;
            ?>
            <tr>
                <td align="right"></td>
                <td align="center"><?=$key3+1;?></td>
                <td><?=$row3->NAMA_ASET;?></td>
                <td  style="text-align: center;"><?=$row3->TH_PEROLEHAN;?></td>
                <td  style="text-align: right;"><?=format_akuntansi($row3->HARGA_PEROLEHAN);?></td>
                <td  style="text-align: right;"><?=format_akuntansi($row3->TARIF_SUSUT);?></td>
                <td  style="text-align: right;"><?=format_akuntansi($row3->AKUMULASI_SUSUT_1);?></td>
                <td  style="text-align: right;"><?=format_akuntansi($row3->SUSUT_SD_NOW);?></td>
                <td  style="text-align: right;"><?=format_akuntansi($row3->AKUMULASI_SUSUT_2);?></td>
                <td  style="text-align: right;"><?=format_akuntansi($row3->NILAI_BUKU_AKHIR);?></td>
            </tr>
            <?PHP 
            }
        ?>

        <?PHP } ?>

        <tr>
            <td align="right"></td>
            <td align="center"></td>
            <td style="text-align: center;"><b>JUMLAH <?=num_to_alpha($key+1);?></b></td>
            <td  style="text-align: center;"></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($tot_1);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($tot_2);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($tot_3);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($tot_4);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($tot_5);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($tot_6);?></b></td>
        </tr>

        <?PHP } ?>
        <tr>
            <td align="right"></td>
            <td align="center"></td>
            <td style="text-align: center;"><b>JUMLAH SELURUH AKTIVA</b></td>
            <td  style="text-align: center;"></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($sub_tot_1);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($sub_tot_2);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($sub_tot_3);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($sub_tot_4);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($sub_tot_5);?></b></td>
            <td  style="text-align: right;"><b><?=format_akuntansi($sub_tot_6);?></b></td>
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