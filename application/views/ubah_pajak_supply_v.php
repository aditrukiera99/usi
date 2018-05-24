<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-bookmark"></i>  SUPPLY POINT </h3>
			<button type="button" class="btn btn-info view_data" onclick="tambah_klik();" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> TAMBAH SUPPLY POINT
			</button>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> SUPPLY POINT </li>
		</ul>
	</div>
</div>

<div class="row-fluid" id="edit_data_pajak" >
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-edit"></i> Ubah Data Pajak </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> Nama </label>
						<div class="controls">
							<input required type="text" class="span6" value="<?=$dt->NAMA_BPPKB;?>" id="nama_pajak" name="nama_pajak" style="font-size: 14px;">
							<input required type="hidden" class="span6" value="<?=$dt->ID;?>" id="id_gr_pajak" name="id_gr_pajak" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Prosentase </label>
						<div class="controls">
							<input required type="text" class="span6" value="<?=$dt->PAJAK;?>" id="prosentase_pajak" name="prosentase_pajak" style="font-size: 14px;">
						</div>
					</div>

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="edit_pajak" value="UBAH PAJAK">
						
						<button type="button" onclick="batal_edit_klik_pajak();" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>