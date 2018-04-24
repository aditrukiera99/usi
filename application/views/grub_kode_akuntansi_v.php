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

	$("#tambah_grub_kode_akun").click(function(){
		$("#tambah_grub_kode_akun").hide();
		$("#table_grub_kode_akun").hide();
		$("#form_grub_kode_akun").show();
	});

	$("#batal").click(function(){
		$("#form_grub_kode_akun").hide();
		$("#tambah_grub_kode_akun").show();
		$("#table_grub_kode_akun").show();
	});
});

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

function hapus_grub_kode_akun(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>grub_kode_akuntansi_c/data_grub_kode_akun_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['NAMA_GRUP']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_grub_kode_akun(id)
{
		$('#popup_ubah').css('display','block');
		$('#popup_ubah').show();
	
		$.ajax({
			url : '<?php echo base_url(); ?>grub_kode_akuntansi_c/data_grub_kode_akun_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_kode_grub_modal').val(id);
				$('#grub_modal').val(row['GRUP']);
				$('#kode_grub_modal').val(row['KODE_GRUP']);
				$('#nama_grub_modal').val(row['NAMA_GRUP']);
				$('#unit_modal').val(row['UNIT']);
				$('#approve_modal').val(row['APPROVE']);
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

<div class="row" id="form_grub_kode_akun" style="display:none;">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Grup Kode Akun </span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only blue" href="javascript:;">
					<i class="icon-cloud-upload"></i>
					</a>
					<a class="btn btn-circle btn-icon-only green" href="javascript:;">
					<i class="icon-wrench"></i>
					</a>
					<a class="btn btn-circle btn-icon-only red" href="javascript:;">
					<i class="icon-trash"></i>
					</a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tipe Akun</label>
							<div class="col-md-3">
								<select class="form-control" name="grub" id="grub">
									<option value="Aktiva Lancar">Aktiva Lancar</option>
									<option value="Aktiva Tidak Lancar">Aktiva Tidak Lancar</option>
									<option value="Beban Usaha">Beban Usaha</option>
									<option value="Ekuitas">Ekuitas</option>
									<option value="Kewajiban Jangka Panjang">Kewajiban Jangka Panjang</option>
									<option value="Pendapatan / Beban Lain-lain">Pendapatan / Beban Lain-lain</option>
									<option value="Pendapatan Usaha">Pendapatan Usaha</option>
									<option value="Laba / Rugi Sebelum Pajak">Laba / Rugi Sebelum Pajak</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Kode Grup</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="kode_grub" name="kode_grub" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nama Grup</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="nama_grub" name="nama_grub" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input" style="display: none;">
							<label class="col-md-2 control-label" for="form_control_1">Unit</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="unit" name="unit" value="1" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input" style="display: none;">
							<label class="col-md-2 control-label" for="form_control_1">Aprove</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="approve" name="approve" value="3" >
								<div class="form-control-focus">
								</div>
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

<button id="tambah_grub_kode_akun" class="btn green">
Tambah Data Grup Kode Akun <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="table_grub_kode_akun" style="display:block;">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table Grup Kode Akun
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
					<th style="text-align:center;"> Tipe Akun</th>
					<th style="text-align:center;"> Kode Grup</th>
					<th style="text-align:center;"> Nama Grup</th>
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
					<td style="text-align:center; vertical-align:"><?php echo $value->GRUP; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->KODE_GRUP; ?></td>
					<td style="text-align:left; vertical-align:"><?php echo $value->NAMA_GRUP; ?></td>
					<td style="text-align:center; vertical-align: middle;">
						<a class="btn default btn-xs purple" id="ubah" onclick="ubah_data_grub_kode_akun(<?php echo $value->ID?>);"><i class="fa fa-edit"></i> Ubah </a>
						<a class="btn default btn-xs red" id="hapus" onclick="hapus_grub_kode_akun(<?php echo $value->ID?>);"><i class="fa fa-trash-o"></i> Hapus </a>
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
							<i class="fa fa-pencil"></i>Ubah Grup Kode Akun
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<div class="portlet-body form">
					<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah;?>" enctype="multipart/form-data">
						<div class="form-body">
							<input type="hidden" name="id_kode_grub_modal" id="id_kode_grub_modal">

							<div class="form-group">
								<label class="col-md-3 control-label" for="form_control_1">Grup</label>
								<div class="col-md-4">
									<select class="form-control" name="grub_modal" id="grub_modal">
										<option value="Aktiva Lancar">Aktiva Lancar</option>
										<option value="Aktiva Tidak Lancar">Aktiva Tidak Lancar</option>
										<option value="Beban Usaha">Beban Usaha</option>
										<option value="Ekuitas">Ekuitas</option>
										<option value="Kewajiban Jangka Panjang">Kewajiban Jangka Panjang</option>
										<option value="Pendapatan / Beban Lain-lain">Pendapatan / Beban Lain-lain</option>
										<option value="Pendapatan Usaha">Pendapatan Usaha</option>
										<option value="Laba / Rugi Sebelum Pajak">Laba / Rugi Sebelum Pajak</option>
									</select>
								</div>
							</div>



							<div class="form-group">
								<label class="col-md-3 control-label" for="form_control_1">Kode Grup</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="kode_grub_modal" id="kode_grub_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label" for="form_control_1">Nama Grup</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="nama_grub_modal" id="nama_grub_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input" style="display: none;">
								<label class="col-md-3 control-label" for="form_control_1">Unit</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="unit_modal" id="unit_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input" style="display: none;">
								<label class="col-md-3 control-label" for="form_control_1">Approve</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="approve_modal" id="approve_modal" >
									<div class="form-control-focus">
									</div>
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