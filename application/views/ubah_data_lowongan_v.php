<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-bookmark"></i>  HRD </h3>
			<button type="button" class="btn btn-info view_data" onclick="tambah_klik();" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> TAMBAH LOWONGAN BARU
			</button>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data </a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Lowongan </li>
		</ul>
	</div>
</div>


<div class="row-fluid" id="add_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-plus"></i> Ubah Lowongan Kerja </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> NAMA LOWONGANAN </label>
						<div class="controls">
							<input required type="text" class="span12" value="<?=$dt->NAMA?>" name="nama" style="font-size: 14px;">
							<input required type="hidden" class="span12" value="<?=$dt->ID?>" name="id" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> TANGGAL MULAI </label>
						<div class="controls">
							<div id="datetimepicker4" class="input-append date ">
								<input  style="width: 80%;" value="<?=$dt->TGL_AWAL;?>" required name="tgl_awal" onclick="$('#add_on_pick').click();" data-format="dd-MM-yyyy" type="text">
								<span class="add-on "><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> TANGGAL AKHIR </label>
						<div class="controls">
						<div id="datetimepicker5" class="input-append date ">
								<input  style="width: 80%;" value="<?=$dt->TGL_AKHIR;?>" required name="tgl_akhir" onclick="$('#add_on_pick').click();" data-format="dd-MM-yyyy" type="text">
								<span class="add-on "><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>


					<div class="control-group">
						<label class="control-label"> MAKSIMAL USIA </label>
						<div class="controls">
							<input type="number" class="usia" class="span6" value="<?=$dt->MAKSIMAL_UMUR;?>"  name="maksimal_umur">
						</div>
					</div>

					
					<div class="control-group" id="sur">
						<label class="control-label"> KEBUTUHAN SERTIFIKAT </label>
						<?php 
							$idl = $dt->ID;
							$cek_sert = $this->db->query("SELECT * FROM ak_lowongan_sertifikat WHERE ID_LOWONGAN = '$idl' ")->result();
							$i=0;


							foreach ($cek_sert as $key => $vl) {
							$i++;
						?>
						<div class="controls" id="sertifikat_id_<?php echo $i;?>" class="span12">

							<select name="sertifikat[]" id="sertifikat" class="span10" style="float: left;margin-bottom: 10px;">
								<?php 
									$idser = $vl->ID_SERTIFIKAT;
									$dt_ser = $this->db->query("SELECT * FROM ak_sertifikat WHERE ID = '$idser'")->row();

								?>
								<option value="<?=$vl->ID_SERTIFIKAT;?>"><?=$dt_ser->NAMA;?></option>
								<?php 

									$ser = $this->db->query("SELECT * FROM ak_sertifikat")->result();
									foreach ($ser as $key => $value) {
										if($vl->ID_SERTIFIKAT == $value->ID){

										}else{
										?>
											<option value="<?=$value->ID;?>"><?=$value->NAMA;?></option>
										<?php
										}
									}
								?>
							</select>
							<button class="span2 btn-danger" onclick="hapus_row(<?php echo $i; ?>)" style="float: left;">HAPUS</button>
							
						</div>
					<?php } ?>
					</div>

					<div class="control-group">
						<label class="control-label">  </label>
						<div class="controls">
							<button type="button" id="tmbh_sertifikat_btn" onclick="tmbh_sertifikat();" class="btn btn-success">Tambah Sertifikat</button>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> KETERANGAN </label>
						<div class="controls">
							<textarea required type="text" class="span6" value="" name="keterangan" style="font-size: 14px;" rows="5"><?=$dt->KETERANGAN;?></textarea>
						</div>
					</div>

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="simpan_ubah" value="SIMPAN LOWONGAN">
						
						<a href="<?=base_url();?>data_lowongan_c"><button type="button" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php 
$id_dt = $dt->ID;
$slc_cn  = $this->db->query("SELECT COUNT(*) as jm FROM ak_lowongan_sertifikat WHERE ID_LOWONGAN = '$id_dt'")->row(); ?>

<input type="hidden" id="tr_utama_count" value="1" name="">

<script type="text/javascript">
	
	function hapus_row (id) {
		$('#sertifikat_id_'+id).remove();
	}

	function tmbh_sertifikat() {
	
		var jml_tr = $('#tr_utama_count').val();
		var i = parseInt(jml_tr) + 1;


		$isi_1 = 
		'<div class="controls" id="sertifikat_id_<?php echo $i;?>" class="span12">'+

		'					<select name="sertifikat[]" id="sertifikat" class="span10" style="float: left;margin-bottom: 10px;">'+
		'						<?php foreach ($ser as $key => $value) { ?>'+
										
		'									<option value="<?=$value->ID;?>"><?=$value->NAMA;?></option>'+
		'								<?php } ?>'+
		'					</select>'+
		'					<button class="span2 btn-danger" onclick="hapus_row(<?php echo $i; ?>)" style="float: left;">HAPUS</button>'+
		'							</div>';

		$('#sur').append($isi_1);
		$('#tr_utama_count').val(i);

	}
</script>