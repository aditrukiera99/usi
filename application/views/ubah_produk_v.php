<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-hdd"></i>  Daftar Produk </h3>

			<!-- <button type="button" class="btn btn-info view_data" onclick="tambah_klik();" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> TAMBAH DATA PRODUK 
			</button>

			<button data-toggle='modal' data-target='#laporan_modal'  type="button" class="btn btn-warning view_data" style="float: right; margin-right: 10px;"> 
				<i class="icon-print" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> CETAK
			</button> -->
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Produk </li>
		</ul>
	</div>
</div>

<div class="row-fluid" id="edit_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-edit"></i> Ubah Data Produk </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">

					<!-- <div class="control-group">
						<label class="control-label"> <b style="font-size: 14px;"> Tipe Barang </b> </label>
						<div class="controls">
							<label class="radio inline">
							<input type="radio" value="JADI" name="tipe_barang_ed" class="JADI" required onclick="get_kode_akun_ed(this.value);">
							Barang Jadi </label>

							<label class="radio inline">
							<input type="radio" value="BAKU" name="tipe_barang_ed" class="BAKU" required onclick="get_kode_akun_ed(this.value);">
							Barang Baku </label>

							<label class="radio inline">
							<input type="radio" value="PEMBANTU" name="tipe_barang_ed" class="PEMBANTU" required onclick="get_kode_akun_ed(this.value);">
							Barang Pembantu </label>

							<label class="radio inline">
							<input type="radio" value="JASA" name="tipe_barang_ed" class="JASA" required onclick="get_kode_akun_ed(this.value);">
							Jasa </label>


						</div>
					</div> -->

				


					<div class="control-group">
						<label class="control-label"> <b> Kode Produk </b> </label>
						<div class="controls">
							<input readonly type="text" class="span12" value="<?=$dt->KODE_PRODUK;?>" name="kode_produk_ed" id="kode_produk_ed" >
							<input type="hidden" class="span12" value="<?=$dt->ID;?>" name="id_produk" id="id_produk" >
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Nama Produk </b> </label>
						<div class="controls">
							<input required type="text" class="span12" value="<?=$dt->NAMA_PRODUK;?>" name="nama_produk_ed" id="nama_produk_ed" >
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Satuan</b> </label>
						<div class="controls">
							<input type="text"  class="span4" value="<?=$dt->SATUAN;?>" name="satuan_ed" id="satuan_ed" >
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Deskripsi Produk</b> </label>
						<div class="controls">
							<textarea rows="3" class="span12" name="deskripsi_ed" id="deskripsi_ed" ><?=$dt->DESKRIPSI;?></textarea>
						</div>
					</div>


					<!-- <div class="control-group pajak_ed">
						<label class="control-label"> <b>Service</b> </label>
						<div class="controls">
							<div class="input-append">
								<input id="appendedInput" type="text" value="0" name="service_ed"  style="width: 15%;" onkeyup="FormatCurrency(this);">
								<span class="add-on">%</span>
							</div>
						</div>
					</div> -->

					<div class="form-actions">
						
                        <input type="submit" class="btn btn-info" name="ubah_produk" value="AJUKAN PENGUBAHAN PRODUK">
                        
                        <a href="<?=base_url();?>produk_c"><button type="button" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>