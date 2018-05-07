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
			<h3 class="page-header"> <i class="icon-tags"></i> Sub Grup Aset </h3>
			<button data-toggle='modal' data-target='#modal_add_kategori' class="btn btn-info view_data"  style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> INPUT SUB GRUP ASET
			</button>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Aset</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Sub Grup Aset  </li>
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
							<th align="center" style="width: 30%;"> Aksi </th>
							<th align="center"> Grup </th>
							<th align="center"> Nama Sub Grup </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						$no = 0;
						foreach ($dt as $key => $row) { 
							$no++;
						?>
						<tr>
							<td align="center" style="text-align: center;">
							<button onclick="get_grup_data(<?=$row->ID;?>, '<?=$row->ID_GRUP;?>', '<?=$row->SUB_GRUP;?>');" type="button" data-toggle='modal' data-target='#modal_edit_kategori' class="btn btn-small btn-warning">
							 <i class="icon-pencil"></i> Edit 
							</button>	

							<a onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');"  class="btn btn-small btn-danger"> <i class="icon-trash"></i> Hapus</a>							
							</td>
							<td align="left" style="text-align: left; font-size: 13px;"> <?=$row->GRUP;?> </td>														
							<td align="left" style="text-align: left; font-size: 13px;"> <?=$row->SUB_GRUP;?> </td>														
						</tr>
						<?PHP } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Add Kategori -->
<div class="modal fade" id="modal_add_kategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Add Sub Grup Aset </h4>
      </div>
      <form method="post" action="<?=base_url();?>sub_grup_aset_c">
      <div class="modal-body">   
		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Grup Aset </b> </label>
					<div class="controls">
						<select  data-placeholder="Pilih ..." class="" tabindex="2" id="id_grup" name="id_grup" style="width: 300px;">
								<option value="">Pilih ...</option>
							<?PHP foreach ($get_all_grup as $key => $row) { ?>
								<option value="<?=$row->ID;?>"> <?=$row->GRUP;?></option>
							<?PHP } ?>				
						</select>
					</div>
				</div>

				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Nama Sub Grup </b> </label>
					<div class="controls">
						<input style="font-size: 15px;" type="text" required class="span12" value="" name="nama_sub_grup" id="nama_sub_grup">
					</div>
				</div>
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" class="btn btn-info" value="Simpan Sub Grup" name="simpan">
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
        <h4 class="modal-title" id="myModalLabel"> Edit Sub Grup Aset</h4>
      </div>
      <form method="post" action="<?=base_url();?>sub_grup_aset_c">
      <div class="modal-body">   
		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Grup Aset </b> </label>
					<div class="controls">
						<select  data-placeholder="Pilih ..." class="" tabindex="2" id="id_grup_ed" name="id_grup_ed" style="width: 300px;">
							<option value="">Pilih ...</option>
							<?PHP foreach ($get_all_grup as $key => $row) { ?>
							<option value="<?=$row->ID;?>"> <?=$row->GRUP;?></option>
							<?PHP } ?>				
						</select>
					</div>
				</div>


				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Nama Sub Grup </b> </label>
					<div class="controls">
						<input style="font-size: 15px;" type="text" required class="span12" value="" name="nama_sub_ed" id="nama_sub_ed">
						<input type="hidden" name="id_sub" id="id_sub">
					</div>
				</div>
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" class="btn btn-info" value="Ubah Sub Grup" name="edit">
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

function get_grup_data(id, grup, subgrup){
	$('#id_sub').val(id);
	$('#id_grup_ed').val(grup);
	$('#nama_sub_ed').val(subgrup);
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