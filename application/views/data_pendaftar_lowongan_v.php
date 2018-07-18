<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

#tes td {
	vertical-align: middle;
}
</style>
<input type="hidden" name="tr_utama_count" id="tr_utama_count" value="1">
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

<?PHP if($msg == 11){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Pengubahan Grup Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 22){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Penghapusan Grup Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 33){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Grup Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<div class="row-fluid" id="view_data">
	<div class="span12">
		
		<br>
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="responsive table table-striped table-bordered" id="data-table">
					<thead>
						<tr>
							<th align="center"> NO </th>
							<th align="center"> NAMA</th>						
							<th align="center"> TTL </th>						
							<th align="center"> NO KTP </th>						
							<th align="center"> TELEPON </th>						
							<th align="center"> AKSI </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						$no = 0;
						foreach ($dt as $key => $row) { 
							$no++;
						?>
						<tr>
							<td align="center" style="text-align: center;"> <?=$no;?> </td>
							<td> <?=$row->NAMA;?> </td>
							<td> <?=$row->TANGGAL_LAHIR;?> </td>
							<td> <?=$row->NO_KTP;?> </td>
							<td> <?=$row->TELEPON;?> </td>
							<td align="center"> <a href="<?=base_url();?>data_lowongan_c/edit_lowongan_kerja/<?=$row->ID;?>"><button style="padding: 2px 10px;" type="button" class="btn btn-small btn-primary"> DETAIL </button> </a>
							</td>
							

						
						</tr>
						<?PHP } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid" id="add_data" style="display:none;">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-plus"></i> Tambah Lowongan Kerja </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> NAMA LOWONGANAN </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="nama" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> TANGGAL MULAI </label>
						<div class="controls">
							<div id="datetimepicker4" class="input-append date ">
								<input  style="width: 80%;" value="<?=date('d-m-Y');?>" required name="tgl_awal" onclick="$('#add_on_pick').click();" data-format="dd-MM-yyyy" type="text">
								<span class="add-on "><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> TANGGAL AKHIR </label>
						<div class="controls">
						<div id="datetimepicker5" class="input-append date ">
								<input  style="width: 80%;" value="<?=date('d-m-Y');?>" required name="tgl_akhir" onclick="$('#add_on_pick').click();" data-format="dd-MM-yyyy" type="text">
								<span class="add-on "><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>


					<div class="control-group">
						<label class="control-label"> MAKSIMAL USIA </label>
						<div class="controls">
							<input type="number" class="usia" class="span6"  name="maksimal_umur">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> KEBUTUHAN SERTIFIKAT </label>
						<div class="controls" id="sertifikat_id" class="span6">
							<select name="sertifikat[]" id="sertifikat" class="span6">
								<?php 

									$ser = $this->db->query("SELECT * FROM ak_sertifikat")->result();
									foreach ($ser as $key => $value) {
										?>
											<option value="<?=$value->ID;?>"><?=$value->NAMA;?></option>
										<?php
									}
								?>
							</select>
						</div>
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
							<textarea required type="text" class="span6" value="" name="keterangan" style="font-size: 14px;" rows="5"></textarea>
						</div>
					</div>

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="simpan" value="SIMPAN LOWONGAN">
						
						<button type="button" onclick="batal_klik();" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div style="display:none;" id="copy_ag">
	<td align="center" style="vertical-align:middle;"> 
		<div class="control-group">
			<div class="controls">
				<select  required data-placeholder="Pilih ..." class="cek_select" tabindex="2"  name="kode_akun_det[]" style="width: 100%;">
					<option value="">Pilih ...</option>
					
					<option value=""> </option>
					
				</select>
			</div>
		</div>
	</td>
</div>

<div class="row-fluid" id="edit_data" style="display:none;">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-edit"></i> Ubah Transportir </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> NAMA LOWONGANAN </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="nama" id="edit_nama" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> TANGGAL MULAI </label>
						<div class="controls">
							<div id="datetimepicker1" class="input-append date ">
								<input  style="width: 80%;" value="" required name="tgl_awal" data-format="dd-MM-yyyy" onclick="$('#add_on_pick').click();" type="text" id="edit_tgl_mulai">
								<span class="add-on "><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> TANGGAL AKHIR </label>
						<div class="controls">
							<div id="datetimepicker2" class="input-append date ">
								<input  style="width: 80%;" value="" required name="tgl_akhir" data-format="dd-MM-yyyy" onclick="$('#add_on_pick').click();" type="text" id="edit_tgl_akhir">
								<span class="add-on "><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>


					<div class="control-group">
						<label class="control-label"> MAKSIMAL USIA </label>
						<div class="controls">
							<input type="number" class="usia" class="span6"  name="maksimal_umur" id="edit_usia">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> KEBUTUHAN SERTIFIKAT </label>
						<div class="controls" id="sertifikat_id" class="span6">
							<select name="sertifikat[]" id="sertifikat" class="span6">
								<?php 

									$ser = $this->db->query("SELECT * FROM ak_sertifikat")->result();
									foreach ($ser as $key => $value) {
										?>
											<option value="<?=$value->ID;?>"><?=$value->NAMA;?></option>
										<?php
									}
								?>
							</select>
						</div>
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
							<textarea required type="text" class="span6" value="" id="edit_keterangan" name="keterangan" style="font-size: 14px;" rows="5"></textarea>
						</div>
					</div>

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="edit" value="UBAH TRANSPORTIR">
						
						<button type="button" onclick="batal_edit_klik();" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
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
         
        <p>Apakah anda yakin ingin mengajukan penghapusan data ini? </p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->





<script type="text/javascript">
function ubah_data_produk(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>data_lowongan_c/cari_lowongan_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#edit_nama').val(result.NAMA);
			$('#edit_tgl_mulai').val(result.TGL_AWAL);
			$('#edit_tgl_akhir').val(result.TGL_AKHIR);
			$('#edit_usia').val(result.MAKSIMAL_UMUR);
			$('#edit_keterangan').val(result.KETERANGAN);

	        $('#view_data').hide();
	        $('#edit_data').fadeIn('slow');
		}
	});
}

function tmbh_sertifikat() {
	
	var jml_tr = $('#tr_utama_count').val();
	var i = parseInt(jml_tr) + 1;


	$isi_1 = 
	'<select class="span7" style="margin-top:5px;" name="supply_point" >'+
	'								<option>--Supply Point--</option>'+
	'								<?php foreach ($sertifikat as $key => $sp) { ?>'+
	'								<option value="<?=$sp->ID;?>"><?=$sp->NAMA;?></option>'+
	'								<?php } ?>'+
	'							</select>';

	$('#sertifikat_id').append($isi_1);
	$('#tr_utama_count').val(i);

}

function tambah_klik(){
	$('#view_data').hide();
	$('#add_data').fadeIn('slow');
}

function edit_klik(){
	$('#view_data').hide();
	$('#edit_data').fadeIn('slow');
}

function batal_klik(){
	$('#add_data').hide();
	$('#view_data').fadeIn('slow');
}

function batal_edit_klik(){
	$('#edit_data').hide();
	$('#view_data').fadeIn('slow');
}

function hapus_klik(id){
	$('#dialog-btn').click(); 
	$('#id_hapus').val(id);
}



</script>