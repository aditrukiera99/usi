<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

.chzn-container {
    width: 30% !important;
}
</style>

<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-plus"></i> Update Harga </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Harga</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Update Harga </li>
		</ul>
	</div>
</div>

<div class="row-fluid" id="add_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url();?>harga_c">
					<div class="control-group">
						<label class="control-label"> Tgl Update </label>
						<div class="controls">
							<input readonly type="text"  class="span4" value="<?=date('d/m/Y');?>" name="tgl">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Produk / Barang </label>
						<div class="controls">
							<input readonly type="text"  class="span4" value="<?=$dt->NAMA_PRODUK;?>" name="produk">
							<input readonly type="hidden"  class="span4" value="<?=$dt->ID;?>" name="id_produk">
						</div>
					</div>


					<div class="control-group">
						<label class="control-label"> Harga Beli </label>
						<div class="controls">
							<input required type="text"  class="span4" value="" name="harga_beli" onkeyup="FormatCurrency(this);">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Harga Jual </label>
						<div class="controls">
							<input required type="text"  class="span4" value="" name="harga_jual" onkeyup="FormatCurrency(this);">
						</div>
					</div>

					<div class="form-actions">
                        <?PHP if($user->LEVEL == "USERs"){ ?>
                        <input type="submit" class="btn btn-info" name="update" value="AJUKAN HARGA">
                        <?PHP } else { ?>
                        <input type="submit" class="btn btn-info" name="update" value="SIMPAN HARGA">
                        <?PHP } ?>
                        <a href="<?=base_url();?>harga_c" class="btn"> BATAL </a>
                    </div>

				</form>
			</div>
		</div>
	</div>
</div>
</script>