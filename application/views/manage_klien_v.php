<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-user"></i>  Direktur & Klien </h3>

		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li class="active"> Direktur & Klien </li>
		</ul>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<span style="float:left;">
			<a href="<?=base_url();?>manage_klien_c/add_new_user" class="btn btn-info"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> Tambah Baru 
			</a>
		</span>
	</div>
</div>
<br>
<div class="row-fluid">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3>Data User unit <?=strtoupper($unit);?></h3>
			</div>
			<div class="widget-container">				
				<table class="responsive table table-striped table-bordered" id="data-table">
				<thead>
				<tr>
					<th style="text-align:center;">
						 Username
					</th>
					<th style="text-align:center;">
						 Nama Lengkap
					</th>
					<th style="text-align:center;">
						 Level
					</th>
					<th style="text-align:center;">
						 Login Terakhir
					</th>
					<th style="text-align:center;">
						 Manage
					</th>
				</tr>
				</thead>
				<tbody>
				<?PHP 
				foreach ($dt as $key => $row) {
				?>
				<tr>
					<td><?=$row->USERNAME;?></td>
					<td><?=$row->NAMA;?></td>
					<td>DIREKTUR</td>
					<td style="text-align:center;">
						<?PHP 
						$get_last_login = $this->master_model_m->get_last_login($row->ID);
						if($get_last_login){
							echo $get_last_login->TGL."<br>".$get_last_login->JAM;
						} else {
							echo "-";
						}
						?>
					</td>
					<td style="text-align:center;">
						<button onclick="ubah_data_user('<?=$row->ID;?>');" data-toggle="modal" data-target="#myModal" class="btn btn-warning"><i class="icon-edit"></i> Ubah</button>
						<button onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" type="button" class="btn btn-danger"> <i class="icon-remove"></i> Hapus</button>
					</td>
				</tr>
				<?PHP } ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah User</h4>
      </div>
      <form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
      <div class="modal-body">
      	<div class="control-group">
			<label class="control-label"> <b> Username </b> </label>
			<div class="controls">
				<input type="text" readonly class="span3" value="" name="username" id="username">
			</div>
		</div>

        <div class="control-group">
			<label class="control-label"> <b> Nama Lengkap </b> </label>
			<div class="controls">
				<input type="hidden" required class="span3" value="" name="id_edit" id="id_edit">
				<input type="text" required class="span3" value="" name="nama_lengkap" id="nama_lengkap">
			</div>
		</div>		

		<div class="control-group">
			<label class="control-label"> <b> Password </b> </label>
			<div class="controls">
				<input type="password" placeholder="Kosongi jika tidak ingin mengubah password" class="span3" value="" name="password" id="password">
			</div>
		</div>
      </div>
      <div class="modal-footer">
      	<input type="submit" class="btn btn-success" name="edit_user" value="Simpan">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
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
         
        <p>Apakah anda yakin ingin menghapus data user ini?</p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->

<script type="text/javascript">
function ubah_data_user(id){
	$.ajax({
		url : '<?php echo base_url(); ?>user_management_c/get_data_user',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(result){
			$('#id_edit').val(result.ID);
			$('#nama_lengkap').val(result.NAMA);
			$('#username').val(result.USERNAME);
		}
	});
}
</script>