<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

#tes td {
	vertical-align: middle;
}
</style>

<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-tags"></i> Input Harga dan Penyusutan</h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Aset</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Input Harga dan Penyusutan </li>
		</ul>
	</div>
</div>


<div class="row-fluid view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<form  method="post" action="<?=base_url().$post_url;?>">
				<div class="controls controls-row">
					<div class="row-fluid">
						<div class="span4">
							<label class="control-label"> <b style="font-size: 14px;"> Bulan Input </b> </label>
							<select class="span12" name="bulan">
								<option <?PHP if($bulan == '01' ){ echo "selected"; } ?> value="01"> Januari </option>
								<option <?PHP if($bulan == '02' ){ echo "selected"; } ?> value="02"> Februari </option>
								<option <?PHP if($bulan == '03' ){ echo "selected"; } ?> value="03"> Maret </option>
								<option <?PHP if($bulan == '04' ){ echo "selected"; } ?> value="04"> April </option>
								<option <?PHP if($bulan == '05' ){ echo "selected"; } ?> value="05"> Mei </option>
								<option <?PHP if($bulan == '06' ){ echo "selected"; } ?> value="06"> Juni </option>
								<option <?PHP if($bulan == '07' ){ echo "selected"; } ?> value="07"> Juli </option>
								<option <?PHP if($bulan == '08' ){ echo "selected"; } ?> value="08"> Agustus </option>
								<option <?PHP if($bulan == '09' ){ echo "selected"; } ?> value="09"> September </option>
								<option <?PHP if($bulan == '10' ){ echo "selected"; } ?> value="10"> Oktober </option>
								<option <?PHP if($bulan == '11' ){ echo "selected"; } ?> value="11"> November </option>
								<option <?PHP if($bulan == '12' ){ echo "selected"; } ?> value="12"> Desember </option>
							</select>
						</div>
						<div class="span4">
							<label class="control-label"> <b style="font-size: 14px;"> Tahun Input </b> </label>
							<select class="span12" name="tahun">
								<option <?PHP if($tahun == '2016' ){ echo "selected"; } ?> value="2016"> 2016 </option>
								<option <?PHP if($tahun == '2017' ){ echo "selected"; } ?> value="2017"> 2017 </option>
								<option <?PHP if($tahun == '2018' ){ echo "selected"; } ?> value="2018"> 2018 </option>
								<option <?PHP if($tahun == '2019' ){ echo "selected"; } ?> value="2019"> 2019 </option>
								<option <?PHP if($tahun == '2020' ){ echo "selected"; } ?> value="2020"> 2020 </option>
							</select>
						</div>

						<div class="span4">
							<input type="submit" name="tampilkan" class="btn btn-info" value="Tampilkan Form" style="margin-top: 18px;" />
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>

		<?PHP if($sts == 1){ ?>
		<form  method="post" action="<?=base_url().$post_url;?>">
		<input type="hidden" name="bulan_input" value="<?=$bulan;?>">
		<input type="hidden" name="tahun_input" value="<?=$tahun;?>">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<div class="tab-widget">
					<ul class="nav nav-tabs" id="myTab2">
						<?PHP 
						foreach ($dt_grup as $key => $row) {
							$act = "";
							if($key == 0){
								$act = "active";
							} else {
								$act = "";
							}
						?>
						<li class="<?=$act;?>"><a href="#grup_<?=$row->ID;?>"><i class=" icon-envelope-alt"></i> <?=$row->GRUP;?> </a></li>
						<?PHP } ?>
					</ul>
					<div class="tab-content">
						<?PHP 
						foreach ($dt_grup as $key => $row) {
							$act = "";
							if($key == 0){
								$act = "active";
							} else {
								$act = "";
							}

							$dt_sub = $this->db->query("SELECT * FROM ak_aset_subgrup WHERE ID_GRUP = '$row->ID' ")->result();
						?>
						<div class="tab-pane <?=$act;?>" id="grup_<?=$row->ID;?>">
							<table>
								<thead>
									<tr>
										<td style="text-align: center; vertical-align: middle; width: 20%;">Nama Aktiva</td>
										<td style="text-align: center; vertical-align: middle; width: 10%;">Th Perolehan</td>
										<td style="text-align: center; vertical-align: middle; width: 10%;">Harga Perolehan</td>
										<td style="text-align: center; vertical-align: middle; width: 10%;">Tarif Penyusutan</td>
										<td style="text-align: center; vertical-align: middle; width: 10%;">Akumulasi Penyusutan SD <?=$tahun-1;?></td>
										<td style="text-align: center; vertical-align: middle; width: 10%;">Penyusutan S/D <?=$bln_txt;?> <?=$tahun;?></td>
										<td style="text-align: center; vertical-align: middle; width: 10%;">Akumulasi Penyusutan S/D <?=$bln_txt;?> <?=$tahun;?></td>
										<td style="text-align: center; vertical-align: middle; width: 10%;">Nilai Buku Akhir S/D <?=$bln_txt;?> <?=$tahun;?></td>
									</tr>
								</thead>
								<tbody>
									<?PHP 
									if(count($dt_sub) == 0){
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
									foreach ($dt_list as $key => $row_data) {
									?>
									<tr>
										<input type="hidden" name="id_aset[]" value="<?=$row_data->ID;?>">
										<input type="hidden" name="id_grup[]" value="<?=$row_data->ID_GRUP;?>">
										<input type="hidden" name="id_sub[]" value="<?=$row_data->ID_SUB;?>">
										<input type="hidden" name="nama_aset[]" value="<?=$row_data->NAMA_ASET;?>">
										<input type="hidden" name="tipe[]" value="<?=$row_data->TIPE;?>">
										<input type="hidden" name="kode_akun[]" value="<?=$row_data->KODE_AKUN;?>">
										<td><?=$row_data->NAMA_ASET;?></td>
										<td><input style="width: 80%; text-align: center;" type="text" value="<?=$row_data->TH_PEROLEHAN;?>" name="th_perolehan[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->HARGA_PEROLEHAN;?>" name="harga_perolehan[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->TARIF_SUSUT;?>" name="tarif_susut[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->AKUMULASI_SUSUT_1;?>" name="akumulasi_susut_1[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->SUSUT_SD_NOW;?>" name="susut_sd_now[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->AKUMULASI_SUSUT_2;?>" name="akumulasi_susut_2[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->NILAI_BUKU_AKHIR;?>" name="nilai_buku_akhir[]"></td>
									</tr>
									<?PHP } 
									} else { 
									?>

									<?PHP foreach ($dt_sub as $key2 => $row2) { ?>
									<tr>
										<td><b><?=$key2+1;?>. <?=$row2->SUB_GRUP;?></b></td>
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
									foreach ($dt_list as $key => $row_data) {
									?>
									<tr>
										<input type="hidden" name="id_aset[]" value="<?=$row_data->ID;?>">
										<input type="hidden" name="id_grup[]" value="<?=$row_data->ID_GRUP;?>">
										<input type="hidden" name="id_sub[]" value="<?=$row_data->ID_SUB;?>">
										<input type="hidden" name="nama_aset[]" value="<?=$row_data->NAMA_ASET;?>">
										<input type="hidden" name="tipe[]" value="<?=$row_data->TIPE;?>">
										<input type="hidden" name="kode_akun[]" value="<?=$row_data->KODE_AKUN;?>">
										<td><?=$row_data->NAMA_ASET;?></td>
										<td><input style="width: 80%; text-align: center;" type="text" value="<?=$row_data->TH_PEROLEHAN;?>" name="th_perolehan[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->HARGA_PEROLEHAN;?>" name="harga_perolehan[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->TARIF_SUSUT;?>" name="tarif_susut[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->AKUMULASI_SUSUT_1;?>" name="akumulasi_susut_1[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->SUSUT_SD_NOW;?>" name="susut_sd_now[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->AKUMULASI_SUSUT_2;?>" name="akumulasi_susut_2[]"></td>
										<td><input style="width: 80%; text-align: right;" type="text" onkeyup="FormatCurrency(this);" value="<?=$row_data->NILAI_BUKU_AKHIR;?>" name="nilai_buku_akhir[]"></td>
									</tr>
									<?PHP }
									?>

									<?PHP } 
									} ?>
								</tbody>
							</table>
						</div>
						<?PHP } ?>						
					</div>
				</div>
			</div>

			<div class="form-actions">
				<center>
                <input type="submit" class="btn btn-info" name="simpan" value="SIMPAN NILAI PEROLEHAN DAN PENYUSUTAN">
				</center>					
            </div>
		</div>
		</form>
		<?PHP } ?>
	</div>
</div>

<!-- Modal Add Kategori -->
<div class="modal fade" id="modal_add_kategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Add Grup Aset </h4>
      </div>
      <form method="post" action="<?=base_url();?>grup_aset_c">
      <div class="modal-body">   
		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Nama Grup </b> </label>
					<div class="controls">
						<input style="font-size: 15px;" type="text" required class="span12" value="" name="nama_grup" id="nama_grup">
					</div>
				</div>
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" class="btn btn-info" value="Simpan Grup" name="simpan">
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Harga -->
<div class="modal fade" id="modal_edit_kategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Edit Grup Aset </h4>
      </div>
      <form method="post" action="<?=base_url();?>grup_aset_c">
      <div class="modal-body">   
		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Nama Grup </b> </label>
					<div class="controls">
						<input style="font-size: 15px;" type="text" required class="span12" value="" name="nama_grup_ed" id="nama_grup_ed">
						<input type="hidden" name="id_grup" id="id_grup">
					</div>
				</div>
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" class="btn btn-info" value="Ubah Grup" name="edit">
      </div>
      </form>
    </div>
  </div>
</div>

<!-- HAPUS MODAL -->
<a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>
<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete" method="post" action="<?=base_url().$post_url;?>">
            <input type="hidden" name="id_hapus" id="id_hapus" value="" />
        </form>   
         
        <p>Apakah anda yakin ingin menghapus data ini? </p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->

<script type="text/javascript">

function get_grup_data(id, nama_kategori){
	$('#id_grup').val(id);
	$('#nama_grup_ed').val(nama_kategori);
}

function get_produk_detail(id){
	$('#history_data').html('');
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>harga_c/get_history_harga',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			var isi = "";
			$.each(result, function(i, field){
				isi += 
				"<tr>"+
					"<td style='text-align:left; font-size:14px;'>  "+field.NAMA_PRODUK+" </td>"+
					"<td style='text-align:right; font-size:14px;'> "+NumberToMoney(field.HARGA_BELI).split('.00').join('')+"  </td>"+
					"<td style='text-align:right; font-size:14px;'> "+NumberToMoney(field.HARGA_JUAL).split('.00').join('')+"  </td>"+
					"<td style='text-align:center; font-size:14px;'> "+field.TGL_UPDATE+"  </td>"+
				"</tr>";
			});

			$('#history_data').html(isi);
			$('#popup_load').hide();
		}
	});
}
</script>