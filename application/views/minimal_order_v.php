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
			<h3 class="page-header"> <i class="icon-money"></i> Master Minimal Order  </h3>
			<a class="btn btn-info view_data" href="<?=base_url();?>harga_c/add_new" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> INPUT MINIMAL ORDER BARU
			</a>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Master Minimal Order </li>
		</ul>
	</div>
</div>


<div class="row-fluid view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="stat-table table table-hover" id="data-table">
					<thead>
						<tr>
							<th align="center"> Aksi </th>
							<th align="center"> Nama Item </th>
							<th align="center"> Minimal Order </th>
							<th align="center"> Tanggal Update </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						$no = 0;
						foreach ($dt as $key => $row) { 
							$no++;
							$tgl_update = strtotime($row->TGL_UPDATE);
						?>
						<tr>
							<td align="center" style="text-align: center;">
							<button onclick="get_produk_detail(<?=$row->ID;?>);" data-toggle='modal' data-target='#modal_detail_harga' class="btn btn-small btn-info"> 
								<i class="icon-eye-open"></i> History 
							</button>

							<button onclick="get_produk_data(<?=$row->ID;?>, <?=$row->ID_HARGA;?>);" type="button" data-toggle='modal' data-target='#modal_edit_harga' class="btn btn-small btn-warning">
							 <i class="icon-pencil"></i> Edit 
							</button>	

							<a href="<?=base_url();?>harga_c/update_harga/<?=$row->ID;?>" class="btn btn-small btn-danger"> <i class="icon-plus"></i> Update Harga</a>							
							</td>
							<td align="left" style="text-align: left; font-size: 13px;"> <?=$row->NAMA_PRODUK;?> </td>							
							<td align="right" style="text-align: right; font-size: 13px;"> Rp <?=number_format($row->HARGA);?> </td>							
							<td align="right" style="text-align: right; font-size: 13px;"> Rp <?=number_format($row->HARGA_JUAL);?> </td>							
							<td align="center" style="text-align: center; font-size: 13px;"> <?=date('d/m/Y',$tgl_update);?> </td>							
						</tr>
						<?PHP } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit Harga -->
<div class="modal fade" id="modal_edit_harga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Edit Harga </h4>
      </div>
      <form method="post" action="<?=base_url();?>harga_c">
      <div class="modal-body">   
		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Nama Produk </b> </label>
					<div class="controls">
						<input style="font-size: 15px;" type="text" readonly class="span12" value="" name="nama_produk_ed" id="nama_produk_ed">
						<input type="hidden" class="span12" value="" name="id_produk_ed" id="id_produk_ed">
						<input type="hidden" class="span12" value="" name="id_harga_ed" id="id_harga_ed">
					</div>
				</div>

				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Harga Beli </b> </label>
					<div class="controls">
						<input required style="font-size: 15px;" type="text" onkeyup="FormatCurrency(this);" class="span12" value="" name="harga_beli_ed" id="harga_beli_ed">
					</div>
				</div>

				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Harga Jual </b> </label>
					<div class="controls">
						<input required style="font-size: 15px;" type="text" onkeyup="FormatCurrency(this);" class="span12" value="" name="harga_jual_ed" id="harga_jual_ed">
					</div>
				</div>
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <button id="tutup_add_produk" type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" class="btn btn-info" value="Simpan Harga" name="edit">
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Detail Harga -->
<div class="modal fade" id="modal_detail_harga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> History Harga </h4>
      </div>
      <div class="modal-body">   
      	<center>
        <table class="stat-table table table-hover" id="data-table">
			<thead>
				<tr>
					<th align="center"> Nama Produk / Barang </th>
					<th align="center"> Harga Beli </th>
					<th align="center"> Harga Jual </th>
					<th align="center"> Tanggal Update </th>
				</tr>						
			</thead>
			<tbody id="history_data">

			</tbody>
		</table>
		</center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

function get_produk_data(id, id_harga){
	$('#id_harga_ed').val(id_harga);
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>harga_c/cari_produk_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#id_produk_ed').val(result.ID);
			$('#nama_produk_ed').val(result.NAMA_PRODUK);
			$('#harga_beli_ed').val(NumberToMoney(result.HARGA).split('.00').join(''));
			$('#harga_jual_ed').val(NumberToMoney(result.HARGA_JUAL).split('.00').join(''));
		}
	});
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