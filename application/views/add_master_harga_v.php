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
						<label class="control-label"> NAMA PELANGGAN </label>
						<div class="controls">
							
								<select required data-placeholder="Pilih main grup..." class="chzn-select" tabindex="2" style="width:300px;" name="kode_sh">
									<?php 

										$pel = $this->db->query("SELECT * FROM ak_pelanggan")->result();

										foreach ($pel as $key => $value) {
											?>
												<option value="<?=$value->KODE_PELANGGAN;?>"><?=$value->KODE_PELANGGAN;?> - <?=$value->NAMA_PELANGGAN;?></option>
											<?php
										}
									?>
								</select>
								
							
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> NAMA PRODUK </label>
						<div class="controls">
							
								<select required data-placeholder="Pilih main grup..." class="chzn-select" tabindex="2" style="width:300px;" name="nama_produk">
									<?php 

										$pro = $this->db->query("SELECT * FROM ak_produk")->result();

										foreach ($pro as $key => $row) {
											?>
												<option value="<?=$row->ID;?>"><?=$row->NAMA_PRODUK;?></option>
											<?php
										}
									?>
								</select>
								
							
						</div>
					</div>

					
					<div class="control-group">
						<label class="control-label"> Harga Beli </label>
						<div class="controls">
							<input type="text" class="span6" value="0" onkeyup="FormatCurrency(this);" name="harga_beli" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Harga Jual </label>
						<div class="controls">
							<input required type="text" class="span6" onkeyup="FormatCurrency(this);" value="0" name="harga_jual" style="font-size: 14px;">
						</div>
					</div>
					

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="simpan" value="SIMPAN MASTER HARGA">
						
						<button type="button" onclick="batal_klik();" class="btn"> BATAL </button>
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