<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/js-form.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

	$("#kode_barang").focus();

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

	$("#tambah_barang").click(function(){
		$("#tambah_barang").fadeOut('slow');
		$("#table_barang").fadeOut('slow');
		$("#form_barang").fadeIn('slow');
	});

	$("#batal").click(function(){
		$("#tambah_barang").fadeIn('slow');
		$("#table_barang").fadeIn('slow');
		$("#form_barang").fadeOut('slow');
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

function hapus_barang(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>barang_c/data_barang_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['nama_barang']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_barang(id)
{
		$('#popup_ubah').css('display','block');
		$('#popup_ubah').show();
	
		$.ajax({
			url : '<?php echo base_url(); ?>barang_c/data_barang_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_barang_modal').val(id);
				$('#kode_barang_modal').val(row['kode_barang']);
				$('#nama_barang_modal').val(row['nama_barang']);
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

function get_nama_satuan(){
	var a = $("#id_satuan :selected").text();
	$('#nama_satuan').val(a);
}

function get_nama_supplier(){
	var a = $("#id_supplier :selected").text();
	$('#nama_supplier').val(a);
}

function get_nama_kategori(){
	var a = $("#id_kategori :selected").text();
	$('#nama_kategori').val(a);
}

</script>

<div class="row" id="form_barang" style="display:none; ">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Barang </span>
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
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Kode Barang</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="kode_barang" name="kode_barang" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Nama Barang</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="nama_barang" name="nama_barang" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nama Satuan</label>
							<div class="col-md-4">
								<select class="form-control input-large select2me input-sm" id="id_satuan" name="id_satuan" data-placeholder="Select..." onchange="get_nama_satuan();">
									<option value="">Tanpa Satuan</option>
									<?php 
										foreach ($lihat_satuan as $value){
									?>
										<option value="<?php echo $value->id_satuan; ?>"><?php echo $value->nama_satuan; ?></option>
									<?php	
										}
									?>
								</select>
								<input type="hidden" name="nama_satuan" id="nama_satuan">	
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Harga Jual</label>
							<div class="col-md-4 input-group left-addon">
								<span class="input-group-addon">Rp.</span>
								<input type="text" onkeyup="FormatCurrency(this);" class="form-control" id="harga_jual" name="harga_jual" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Harga Beli</label>
								<div class="col-md-4 input-group left-addon">
									<span class="input-group-addon">Rp.</span>
									<input type="text" onkeyup="FormatCurrency(this);" class="form-control" id="harga_beli" name="harga_beli" >
									<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nama Supplier</label>
							<div class="col-md-4">
								<select class="form-control input-large select2me input-sm" id="id_supplier" name="id_supplier" data-placeholder="Select..." onchange="get_nama_supplier();">
									<option value=""></option>
									<?php 
										foreach ($lihat_supplier as $value){
									?>
										<option value="<?php echo $value->id_supplier; ?>"><?php echo $value->nama_supplier; ?></option>
									<?php	
										}
									?>
								</select>	
								<input type="hidden" name="nama_supplier" id="nama_supplier">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Kategori Barang</label>
							<div class="col-md-4">
								<select class="form-control input-large select2me input-sm" id="id_kategori" name="id_kategori" data-placeholder="Select..." onchange="get_nama_kategori();">
									<option value=""></option>
									<?php 
										foreach ($lihat_kategori as $value){
									?>
										<option value="<?php echo $value->id_kategori; ?>"><?php echo $value->nama_kategori; ?></option>
									<?php	
										}
									?>
								</select>
								<input type="hidden" name="nama_kategori" id="nama_kategori">	
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Gambar Barang</label>
							<div class="col-md-4">
								<input type="file" name="userfiles" class="form-control">
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

<button id="tambah_barang" class="btn green">
Tambah Data Barang <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="table_barang" style="display:block; ">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table Barang
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
					<th style="text-align:center;"> Kode Barang</th>
					<th style="text-align:center;"> Nama Barang</th>
					<th style="text-align:center;"> Harga Jual</th>
					<th style="text-align:center;"> Harga Beli</th>
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
					<td style="text-align:center; vertical-align:"><?php echo $value->kode_barang; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->nama_barang; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->harga_jual; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->harga_beli; ?></td>
					<td style="text-align:center; vertical-align: middle;">
						<a class="btn default btn-xs purple" id="ubah" onclick="ubah_data_barang(<?php echo $value->id_barang?>);"><i class="fa fa-edit"></i> Ubah </a>
						<a class="btn default btn-xs red" id="hapus" onclick="hapus_barang(<?php echo $value->id_barang?>);"><i class="fa fa-trash-o"></i> Hapus </a>
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
							<i class="fa fa-pencil"></i>Ubah Barang
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<div class="portlet-body form">
					<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah;?>" enctype="multipart/form-data">
						<div class="form-body">
							<input type="hidden" name="id_barang_modal" id="id_barang_modal">

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Kode Barang</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="kode_barang_modal" id="kode_barang_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Nama barang</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="nama_barang_modal" id="nama_barang_modal" >
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