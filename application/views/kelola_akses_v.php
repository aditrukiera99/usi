<style type="text/css">
.ck_custom_master
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  padding: 10px;
}

.ck_custom
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.3); /* IE */
  -moz-transform: scale(1.3); /* FF */
  -webkit-transform: scale(1.3); /* Safari and Chrome */
  -o-transform: scale(1.3); /* Opera */
  padding: 10px;
}
</style>

<?PHP if($msg == 33){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Hak Akses telah tersimpan. Klik <a style="color: yellow;" href="<?=base_url();?>user_management_c">disini</a> untuk melihat daftar user.
</div>
<?PHP } ?>

<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-sitemap"></i> Kelola Hak Akses </h3>

		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Pengaturan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li><a href="#">User Management</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Kelola Hak Akses </li>
		</ul>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> Daftar Menu </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> <b> Nama Lengkap </b> </label>
						<div class="controls">
							<input type="text" readonly placeholder="Nama Lengkap" class="span12" value="<?=$dt_user->NAMA;?>" name="nama_lengkap">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Username </b> </label>
						<div class="controls">
							<input type="text" readonly placeholder="" class="span12" value="<?=$dt_user->USERNAME;?>" name="username">
						</div>
					</div>
					<hr>
					<div class="row-fluid">
						<div class="span3">
							<!-- master -->
							<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
							  <input id="master_data" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'Master Data')){ ?> checked <?PHP } ?>> Master Data
							</div>

								<!-- anak -->
								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Kategori Akun')){ ?> checked <?PHP } ?> value="Daftar Kategori Akun"> Daftar Grup Kode Akun
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Kode Akun')){ ?> checked <?PHP } ?> value="Daftar Kode Akun"> Daftar Kode Akun
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Divisi')){ ?> checked <?PHP } ?> value="Daftar Divisi"> Daftar Divisi
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Supply Point')){ ?> checked <?PHP } ?> value="Daftar Supply Point"> Daftar Supply Point
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Pelanggan')){ ?> checked <?PHP } ?> value="Pelanggan"> Customer
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Supplier')){ ?> checked <?PHP } ?> value="Supplier"> Supplier
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Produk')){ ?> checked <?PHP } ?> value="Produk"> Produk
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Master Kendaraan')){ ?> checked <?PHP } ?> value="Daftar Master Kendaraan"> Daftar Master Kendaraan
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Master Harga')){ ?> checked <?PHP } ?> value="Daftar Master Harga"> Daftar Master Harga
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Master Data"/>
								  <input name="menu_2[]" class="c_master_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Kode Akun')){ ?> checked <?PHP } ?> value="Daftar Kode Akun"> Daftar Master Transportir
								</div>
						</div>

						<div class="span3">
							<!-- master -->
							<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
							  <input id="input_data" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'Aset')){ ?> checked <?PHP } ?>> Aset
							</div>
								<!-- anak -->
								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_input_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Grup Aset')){ ?> checked <?PHP } ?> value="Daftar Grup Aset"> Daftar Grup Aset
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_input_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Sub Grup Aset')){ ?> checked <?PHP } ?> value="Daftar Sub Grup Aset"> Daftar Sub Grup Aset
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_input_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Harga & Penyusutan')){ ?> checked <?PHP } ?> value="Daftar Harga & Penyusutan"> Daftar Harga & Penyusutan
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_input_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Aset Tetap')){ ?> checked <?PHP } ?> value="Daftar Aset Tetap"> Daftar Aset Tetap
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_input_data ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Laporan Aset Tetap')){ ?> checked <?PHP } ?> value="Daftar Laporan Aset Tetap"> Daftar Laporan Aset Tetap
								</div>
						</div>

						<div class="span3">
							<!-- master -->
							<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
							  <input id="aset" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'Aset')){ ?> checked <?PHP } ?>> Armada
							</div>
								<!-- anak -->
								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_aset ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Kapal')){ ?> checked <?PHP } ?> value="Daftar Kapal"> Daftar Kapal
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_aset ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Kendaraan')){ ?> checked <?PHP } ?> value="Daftar Kendaraan"> Daftar Kendaraan
								</div>
						</div>

						<div class="span3">
							<!-- master -->
							<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
							  <input id="persedian" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'Aset')){ ?> checked <?PHP } ?>> Persediaan
							</div>
								<!-- anak -->
								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_persedian ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Stock')){ ?> checked <?PHP } ?> value="Daftar Stock"> Daftar Stock
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_persedian ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Stock Opname')){ ?> checked <?PHP } ?> value="Daftar Stock Opname"> Daftar Stock Opname
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Data"/>
								  <input name="menu_2[]" class="c_persedian ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Daftar Master Persediaan')){ ?> checked <?PHP } ?> value="Daftar Master Persediaan"> Daftar Master Persediaan
								</div>
						</div>

						</div>

						<!-- <div class="span3">
							
							<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
							  <input id="laporan_akuntansi" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'Laporan Akuntansi')){ ?> checked <?PHP } ?>> Laporan Akuntansi
							</div>
								
								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Laporan Akuntansi"/>
								  <input name="menu_2[]" class="c_laporan_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Laporan Buku Besar')){ ?> checked <?PHP } ?> value="Laporan Buku Besar"> Laporan Buku Besar
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Laporan Akuntansi"/>
								  <input name="menu_2[]" class="c_laporan_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Laporan Laba Rugi')){ ?> checked <?PHP } ?> value="Laporan Laba Rugi"> Laporan Laba Rugi
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Laporan Akuntansi"/>
								  <input name="menu_2[]" class="c_laporan_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Laporan Jurnal Umum')){ ?> checked <?PHP } ?> value="Laporan Jurnal Umum"> Laporan Jurnal Umum
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Laporan Akuntansi"/>
								  <input name="menu_2[]" class="c_laporan_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Laporan Arus Kas')){ ?> checked <?PHP } ?> value="Laporan Arus Kas"> Laporan Arus Kas
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Laporan Akuntansi"/>
								  <input name="menu_2[]" class="c_laporan_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Jurnal Bayar Kas Bank')){ ?> checked <?PHP } ?> value="Jurnal Bayar Kas Bank"> Jurnal Bayar Kas Bank
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Laporan Akuntansi"/>
								  <input name="menu_2[]" class="c_laporan_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Jurnal Penyesuaian')){ ?> checked <?PHP } ?> value="Jurnal Penyesuaian"> Jurnal Penyesuaian
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Laporan Akuntansi"/>
								  <input name="menu_2[]" class="c_laporan_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Laporan Neraca')){ ?> checked <?PHP } ?> value="Laporan Neraca"> Laporan Neraca
								</div>
						</div>						
					</div> -->

					<hr style="background:#ccc; height: 2px;">
					
					<div class="row-fluid">
						
						<div class="span3">
								
								<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
								  <input id="pembelian" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'Pembelian')){ ?> checked <?PHP } ?>> Pembelian
								</div>
									
									<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
									  <input type="hidden" name="menu1[]" value="Input Data"/>
									  <input name="menu_2[]" class="c_pembelian ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Purchase Order')){ ?> checked <?PHP } ?> value="Purchase Order"> Purchase Order
									</div>

									<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
									  <input type="hidden" name="menu1[]" value="Input Data"/>
									  <input name="menu_2[]" class="c_pembelian ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Penerimaan Barang')){ ?> checked <?PHP } ?> value="Penerimaan Barang"> Penerimaan Barang
									</div>
							</div>

					<div class="span3">
							
						<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
						  <input id="penjualan" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'Penjualan')){ ?> checked <?PHP } ?>> Penjualan
						</div>
							
							<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
							  <input type="hidden" name="menu1[]" value="Input Data"/>
							  <input name="menu_2[]" class="c_penjualan ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Penjualan')){ ?> checked <?PHP } ?> value="Penjualan"> Penjualan
							</div>

							<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
							  <input type="hidden" name="menu1[]" value="Input Data"/>
							  <input name="menu_2[]" class="c_penjualan ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Delivery Order')){ ?> checked <?PHP } ?> value="Delivery Order"> Delivery Order
							</div>

							<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
							  <input type="hidden" name="menu1[]" value="Input Data"/>
							  <input name="menu_2[]" class="c_penjualan ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Invoice')){ ?> checked <?PHP } ?> value="Invoice"> Invoice
							</div>
					</div>

					<div class="span3">
							
						<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
						  <input id="hrd" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'HRD')){ ?> checked <?PHP } ?>> HRD
						</div>
							
							<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
							  <input type="hidden" name="menu1[]" value="Input Data"/>
							  <input name="menu_2[]" class="c_hrd ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Data Pegawai')){ ?> checked <?PHP } ?> value="Data Pegawai"> Data Pegawai
							</div>

							<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
							  <input type="hidden" name="menu1[]" value="Input Data"/>
							  <input name="menu_2[]" class="c_hrd ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Set Gaji Pegawai')){ ?> checked <?PHP } ?> value="Set Gaji Pegawai"> Set Gaji Pegawai
							</div>
					</div>

					<div class="span3">
							
							<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
							  <input id="input_akuntansi" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'Input Akuntansi')){ ?> checked <?PHP } ?>> Input Akuntansi
							</div>
								
								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Akuntansi"/>
								  <input name="menu_2[]" class="c_input_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Transaksi Akuntansi')){ ?> checked <?PHP } ?> value="Transaksi Akuntansi"> Transaksi Akuntansi
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Akuntansi"/>
								  <input name="menu_2[]" class="c_input_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Jurnal Bayar Kas Bank')){ ?> checked <?PHP } ?> value="Jurnal Bayar Kas Bank"> Jurnal Bayar Kas Bank
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Akuntansi"/>
								  <input name="menu_2[]" class="c_input_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Jurnal Penyesuaian')){ ?> checked <?PHP } ?> value="Jurnal Penyesuaian"> Jurnal Penyesuaian
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Input Akuntansi"/>
								  <input name="menu_2[]" class="c_input_akuntansi ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Hapus Transaksi Akun')){ ?> checked <?PHP } ?> value="Hapus Transaksi Akun"> Hapus Transaksi Akun
								</div>
						</div>
					</div>

					<hr style="background:#ccc; height: 2px;">

					<div class="row-fluid">
						<div class="span3">
							<!-- master -->
							<div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
							  <input id="pengaturan" class="ck_custom_master" type="checkbox" <?php if($this->model->cek_master($id, 'Pengaturan')){ ?> checked <?PHP } ?>> Pengaturan
							</div>
								<!-- anak -->
								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Pengaturan"/>
								  <input name="menu_2[]" class="c_pengaturan ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Profil Perusahaan')){ ?> checked <?PHP } ?> value="Profil Perusahaan"> Profil Perusahaan
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Pengaturan"/>
								  <input name="menu_2[]" class="c_pengaturan ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Pengaturan Akun')){ ?> checked <?PHP } ?> value="Pengaturan Akun"> Pengaturan Akun
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Pengaturan"/>
								  <input name="menu_2[]" class="c_pengaturan ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'Pengaturan Laporan')){ ?> checked <?PHP } ?> value="Pengaturan Laporan"> Pengaturan Laporan
								</div>

								<div class="checkbox checkbox-primary" style="font-size:12px; margin-bottom:10px; margin-left:20px;">
								  <input type="hidden" name="menu1[]" value="Pengaturan"/>
								  <input name="menu_2[]" class="c_pengaturan ck_custom" type="checkbox" <?php if($this->model->cek_anak($id, 'User Management')){ ?> checked <?PHP } ?> value="User Management"> User Management
								</div>
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" class="btn btn-success" name="simpan" value="Simpan Hak Akses">
						<a href="<?=base_url();?>user_management_c" class="btn"> Batal dan Kembali </a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$('#master_data').click(function(event) {   
    if(this.checked) {
        $('.c_master_data').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.c_master_data').each(function() {
            this.checked = false;                        
        });
    }
});

$('#input_data').click(function(event) {   
    if(this.checked) {
        $('.c_input_data').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.c_input_data').each(function() {
            this.checked = false;                        
        });
    }
});

$('#input_akuntansi').click(function(event) {   
    if(this.checked) {
        $('.c_input_akuntansi').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.c_input_akuntansi').each(function() {
            this.checked = false;                        
        });
    }
});

$('#laporan_akuntansi').click(function(event) {   
    if(this.checked) {
        $('.c_laporan_akuntansi').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.c_laporan_akuntansi').each(function() {
            this.checked = false;                        
        });
    }
});

$('#pengaturan').click(function(event) {   
    if(this.checked) {
        $('.c_pengaturan').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.c_pengaturan').each(function() {
            this.checked = false;                        
        });
    }
});
</script>