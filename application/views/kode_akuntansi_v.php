<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

	$('#hapus').click(function(){
		$('#popup_hapus').css('display','block');
		$('#popup_hapus').show();
	});

	$('#close_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_ubah').click(function(){
		$('#popup_ubah').css('display','none');
		$('#popup_ubah').hide();
	});

	$("#tambah_kode_akun").click(function(){
		$("#tambah_kode_akun").hide();
		$("#table_kode_akun").hide();
		$("#form_kode_akun").show();
	});

	$("#batal").click(function(){
		$("#form_kode_akun").hide();
		$("#tambah_kode_akun").show();
		$("#table_kode_akun").show();
	});
});

function get_data_depart2(kode)
{
	// var kode = $('#nama_divisi_tmp').val();
	$.ajax({
		url: '<?php echo base_url(); ?>m_departemen_c/get_data_depart',
		type:'POST',
		dataType:'json',
		data:{kode:kode},
		async:false,
		success: function (res) {
			$("#nama_depart").val(res.nama_depart);
		}
	});
}

function loading(){
	$('#popup_load').css('display','block');
	$('#popup_load').show();
}

function hapus_toas(){
	toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success("Data Berhasil Dihapus!", "Terhapus");
}

function hapus_divisi(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>kode_akuntansi_c/data_kode_akun_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['NAMA_AKUN']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_kode_akun(id)
{
		$('#popup_ubah').css('display','block');
		$('#popup_ubah').show();
	
		$.ajax({
			url : '<?php echo base_url(); ?>kode_akuntansi_c/data_kode_akun_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_akun_modal').val(id);
				$('#kode_akun_modal').val(row['KODE_AKUN']);
				$('#nama_akun_modal').val(row['NAMA_AKUN']);
				$('#tipe_modal').val(row['TIPE']);
				$('#grup_modal').val(row['KODE_GRUP']);

				$("#grup_modal").select2("destroy");

				$("#grup_modal").select2();
			}
		});
}

function berhasil(){
	toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success("Data Berhasil Disimpan!", "Berhasil");
}

</script>

<div class="row" id="form_kode_akun" style="display:none;">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Tambah Kode Akuntansi </span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Grup Kode Akun</label>
							<div class="col-md-4">
								<select onchange="$('#kode_akun').val(this.value); $('#kode_akun').focus();" class="form-control input-large select2me input-sm" id="grup" name="grup" data-placeholder="Select..." required>
									<option value=""></option>
									<?php 
										foreach ($lihat_data_grup as $value){
									?>
										<option value="<?php echo $value->KODE_GRUP; ?>"><?php echo $value->KODE_GRUP; ?></option>
									<?php	
										}
									?>
								</select>	
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Kode Akun</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="kode_akun" name="kode_akun" required>
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nama Akun</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="nama_akun" name="nama_akun" required>
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tipe</label>
							<div class="col-md-3">
								<select class="form-control" name="tipe" id="tipe">
									<option value="D">Debet</option>
									<option value="K">Kredit</option>
								</select>
							</div>
						</div>

					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" class="btn blue">Simpan</button>
								<button type="button" id="batal" class="btn red">Batal Dan Kembali</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>

<button id="tambah_kode_akun" class="btn green">
Tambah Data Kode Akun <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="table_kode_akun" style="display:block;">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table Kode Akuntansi
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>		
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
				<thead>
				<tr>
					<th style="text-align:center;"> No</th>
					<th style="text-align:center;"> Grup Akun</th>
					<th style="text-align:center;"> Kode Akun</th>
					<th style="text-align:center;"> Nama Akun</th>
					<th style="text-align:center;"> Tipe</th>
					<th style="text-align:center;"> Aksi </th>
				</tr>
				</thead>
				<tbody>
					<?php 
					$no = 0 ;
					foreach ($lihat_data as $value) {
						$no++;
					?>
				<tr>
					<td style="text-align:center; vertical-align:"><?php echo $no; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->KODE_GRUP; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->KODE_AKUN; ?></td>
					<td style="text-align:left; vertical-align:"><?php echo $value->NAMA_AKUN; ?></td>
					<td style="text-align:left; vertical-align:"><?php if($value->TIPE == "D"){ echo "Debet"; } else { echo "Kredit"; } ?></td>
					<td style="text-align:center; vertical-align: middle;">
						<a class="btn default btn-xs purple" id="ubah" onclick="ubah_kode_akun(<?php echo $value->ID?>);"><i class="fa fa-edit"></i> Ubah </a>
						<a class="btn default btn-xs red" id="hapus" onclick="hapus_divisi(<?php echo $value->ID?>);"><i class="fa fa-trash-o"></i> Hapus </a>
					</td>
				</tr>
					<?php 
						}
					?>
				</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>

<div id="popup_ubah">
	<div class="window_ubah">
		<div class="tab-content">
			<div id="tab_0" class="tab-pane active">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-pencil"></i>Ubah Kode Akuntansi
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<div class="portlet-body form">
					<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah;?>">
						<div class="form-body">
							<input type="hidden" name="id_akun_modal" id="id_akun_modal">
							<div class="form-group">
								<label class="col-md-3 control-label" for="form_control_1">Grup Kode Akun</label>
								<div class="col-md-4">
									<select class="form-control input-large select2me input-sm" data-placeholder="Select..." id="grup_modal" name="grup_modal" required>
										<option value=""></option>
										<?php 
											foreach ($lihat_data_grup as $value){
										?>
											<option value="<?php echo $value->KODE_GRUP; ?>"><?php echo $value->KODE_GRUP; ?></option>
										<?php	
											}
										?>
									</select>	
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="form_control_1">Kode Akun</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="kode_akun_modal" id="kode_akun_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label" for="form_control_1">Nama Akun</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="nama_akun_modal" id="nama_akun_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label" for="form_control_1">Tipe</label>
								<div class="col-md-3">
									<select class="form-control" name="tipe_modal" id="tipe_modal">
										<option value="D">Debet</option>
										<option value="K">Kredit</option>
									</select>
								</div>
							</div>

						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-10">
									<button type="submit" class="btn blue">Simpan</button>
									<button type="button" id="batal_ubah" class="btn default">Batal</button>
								</div>
							</div>
						</div>
				</div>
			</form>
		</div>
										<!-- END FORM-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="popup_hapus">
	<div class="window_hapus">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button class="bootbox-close-button close" type="button" id="close_hapus">×</button>
					<div class="bootbox-body" id="msg"></div>
				</div>
				<div class="modal-footer">
					<form action="<?php echo $url_hapus; ?>" method="post">
						<input type="hidden" name="id_hapus" id="id_hapus" value="">
						<input type="button" class="btn btn-default" data-bb-handler="cancel" value="Batal" id="batal_hapus">
						<input type="submit" class="btn btn-primary" data-bb-handler="confirm" value="Hapus" id="hapus" onclick="loading();">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	<?php
		if($this->session->flashdata('sukses')){
	?>
		berhasil();
	<?php 
		}elseif($this->session->flashdata('hapus')){
	?>
		hapus_toas();
	<?php
		}
	?>
});
</script>