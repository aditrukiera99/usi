<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-bookmark"></i>  Master Harga </h3>
			
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Master Harga </li>
		</ul>
	</div>
</div>
<div class="row-fluid" id="add_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-plus"></i> Tambah Master Harga </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">

					
					<div class="control-group">
						<label class="control-label"> KODE SH </label>
						<div class="controls">
							
								<input type="hidden" name="id_master" style="font-size: 14px;" class="span6" value="<?=$dt->ID;?>">
								<input type="text" name="kode_sh" style="font-size: 14px;" class="span6" value="<?=$dt->ID_PELANGGAN;?>">
								
							
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> NAMA PELANGGAN </label>
						<div class="controls">
							
								<input type="text" readonly name="nama_pel" style="font-size: 14px;" class="span6" value="<?=$dt->NAMPEL;?>">
								
							
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> NAMA PRODUK </label>
						<div class="controls">
							
								<input type="hidden" name="id_produk" style="font-size: 14px;" class="span6" value="<?=$dt->ID_PRODUK;?>">
								<input type="text" readonly name="nama_produk" style="font-size: 14px;" class="span6" value="<?=$dt->NAMPROD;?>">
								
							
						</div>
					</div>

					<!-- <div class="control-group">
						<label class="control-label"> Periode </label>
						<div class="controls">
							<input type="text" name="periode">
						</div>
					</div> -->

					
					<div class="control-group">
						<label class="control-label"> Harga Beli </label>
						<div class="controls">
							<input type="text" class="span6" value="<?php echo number_format($dt->HARGA_BELI,2);?>" name="harga_beli" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Harga Jual </label>
						<div class="controls">
							<input required type="text" class="span6" value="<?php echo number_format($dt->HARGA_JUAL,2);?>" name="harga_jual" style="font-size: 14px;">
						</div>
					</div>
					

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="simpan_ganti" value="SIMPAN MASTER HARGA">
						
						<button type="button" onclick="window.location='<?=base_url();?>master_harga_c'" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function show_pop_pelanggan(id){
	    get_popup_pelanggan();
	    ajax_pelanggan();
	}

	`
</script>