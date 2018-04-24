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
			<h3 class="page-header"> <i class="icon-legal"></i> Input Perencanaan </h3>


		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Input Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Input Perencanaan </li>
		</ul>
	</div>
</div>

<div class="row-fluid ">
	<div class="span6">
		<form method="post" action="<?=base_url();?>transaksi_lainnya_c">
		<div class="control-group">
			<label class="control-label" style="font-weight: bold; font-size: 13px;">Tampilkan berdasarkan tanggal :</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-calendar"></i></span>
					<input required type="text" name="tgl" id="reservation" value="<?=$tgl_full;?>"/>
					<input type="submit" name="cari" style="margin-top: 1px; height: 33px;" class="btn btn-warning" value="Cari"/>
				</div>
			</div>
		</div>
		</form>
	</div>

	<div class="span6">
		<button onclick="window.location='<?=base_url();?>input_rkap_c/new_rkap';" style="float: right; margin-top: 12px;" type="button" class="btn btn-info opt_btn"> <i class="icon-plus"></i> Buat Perencanaan Baru </button>
	</div>
</div>



<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="responsive table table-striped table-bordered" id="data-table">
					<thead>
						<tr>
							<th style="background:#6a737b; color:#fff;" align="center"> KODE AKUN </th>
							<th style="background:#6a737b; color:#fff;" align="center"> TAHUN </th>
							<th style="background:#6a737b; color:#fff;" align="center"> TOTAL RKAP </th>
							<th style="background:#6a737b; color:#fff;" align="center"> AKSI </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP  
						foreach ($dt as $key => $row) {
							$nama_akun = "";

							$get_nama_akun_1 = $this->model->get_nama_akun($row->KODE_AKUN, 'grup');
							$get_nama_akun_2 = $this->model->get_nama_akun($row->KODE_AKUN, 'sub');
							$get_nama_akun_3 = $this->model->get_nama_akun($row->KODE_AKUN, 'akun');

							if($get_nama_akun_1){
								$nama_akun = $get_nama_akun_1->NAMA_GRUP;
							} else if($get_nama_akun_2){
								$nama_akun = $get_nama_akun_2->NAMA_SUB;
							} else if($get_nama_akun_3){
								$nama_akun = $get_nama_akun_3->NAMA_AKUN;
							}
						?>
							<tr>
								<td style="font-size:14px; text-align:left; vertical-align:middle;"> (<?=$row->KODE_AKUN;?>) <?=$nama_akun;?> </td>
								<td style="font-size:14px; text-align:center; vertical-align:middle;"> <?=$row->TAHUN;?> </td>
								<td style="font-size:14px; text-align:right; vertical-align:middle;"> <?=number_format($row->TOTAL);?> </td>
								<td style="font-size:14px; text-align:center; vertical-align:middle;">
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"> Aksi <span class="caret"></span>
									</button>
									<ul class="dropdown-menu" style="background-color:rgba(255, 255, 255, 1);">
										<li>
										<a onclick="hapus_klik('<?=$row->ID;?>');" href="javascript:;">HAPUS</a>
										<a onclick="get_detail_rkap('<?=$row->ID;?>');" href="javascript:;">DETAIL</a>
										</li>
									</ul>
								</div>
								</td>
							</tr>
						<?PHP }	?>
					</tbody>
				</table>
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
         
        <p id="hapus_txt">Apakah anda yakin ingin menghapus data ini?</p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->

<!-- MODAL DETAIL -->
<button id="detail_btn" data-toggle="modal" data-target="#detail_modal" class="btn btn-warning" style="display: none;">a</button>
<div id="detail_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail RKAP</h4>
      </div>
      <div class="modal-body">
      	<div class="row-fluid">
      		<div class="span6">
      			<div class="control-group">
					<label class="control-label"> KODE AKUN </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="kode_akun">
					</div>
				</div>
      		</div>
      	</div>
      	<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label"> JANUARI </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="januari">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> FEBRUARI </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="februari">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> MARET </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="maret">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> APRIL </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="april">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> MEI </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="mei">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> JUNI </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="juni">
					</div>
				</div>
			</div>

			<div class="span6">
				<div class="control-group">
					<label class="control-label"> JULI </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="juli">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> AGUSTUS </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="agustus">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> SEPTEMBER </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="september">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> OKTOBER </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="oktober">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> NOVEMBER </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="november">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"> DESEMBER </label>
					<div class="controls">
						<input type="text" readonly class="span12" style="background: #FFF;" value="" name="desember">
					</div>
				</div>
			</div>
		</div>

		<hr>

		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label"> <b style="font-size: 14px;"> TOTAL RKAP </b> </label>
					<div class="controls">
						<input style="background: #FFF; font-weight: bold; font-size: 13px;" type="text" readonly class="span12" value="" name="total_rkap" id="total_rkap">
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">TUTUP</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

function get_detail_rkap(id){
	$('#detail_btn').click();
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>input_rkap_c/get_detail_rkap',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('input[name="kode_akun"]').val(result.KODE_AKUN);

			$('input[name="januari"]').val(NumberToMoney(result.JANUARI).split('.00').join(''));
			$('input[name="februari"]').val(NumberToMoney(result.FEBRUARI).split('.00').join(''));
			$('input[name="maret"]').val(NumberToMoney(result.MARET).split('.00').join(''));
			$('input[name="april"]').val(NumberToMoney(result.APRIL).split('.00').join(''));
			$('input[name="mei"]').val(NumberToMoney(result.MEI).split('.00').join(''));
			$('input[name="juni"]').val(NumberToMoney(result.JUNI).split('.00').join(''));
			$('input[name="juli"]').val(NumberToMoney(result.JULI).split('.00').join(''));
			$('input[name="agustus"]').val(NumberToMoney(result.AGUSTUS).split('.00').join(''));
			$('input[name="september"]').val(NumberToMoney(result.SEPTEMBER).split('.00').join(''));
			$('input[name="oktober"]').val(NumberToMoney(result.OKTOBER).split('.00').join(''));
			$('input[name="november"]').val(NumberToMoney(result.NOVEMBER).split('.00').join(''));
			$('input[name="desember"]').val(NumberToMoney(result.DESEMBER).split('.00').join(''));
			$('input[name="total_rkap"]').val(NumberToMoney(result.TOTAL).split('.00').join(''));
		}
	});
}


function hapus_klik(id){
	$('#dialog-btn').click(); 
	$('#id_hapus').val(id);
}
</script>