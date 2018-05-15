<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

#tes td {
	vertical-align: middle;
}

#lap_kategori_produk_chzn{
	width: 100% !important;
}
</style>

<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-hdd"></i>  Daftar Produk </h3>

			<button type="button" class="btn btn-info view_data" onclick="tambah_klik();" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> TAMBAH DATA PRODUK 
			</button>

			<button data-toggle='modal' data-target='#laporan_modal'  type="button" class="btn btn-warning view_data" style="float: right; margin-right: 10px;"> 
				<i class="icon-print" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> CETAK
			</button>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Produk </li>
		</ul>
	</div>
</div>

<?PHP if($msg == 11){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Pengubahan Produk telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 22){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Penghapusan Produk telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 33){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Produk telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<div class="row-fluid view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="stat-table table table-hover" id="data-table">
					<thead>
						<tr>
							<th align="center"> No </th>
							<th align="center"> Tipe </th>
							<th align="center"> Kode Produk </th>
							<th align="center"> Nama Produk </th>
							<!-- <th align="center"> Kategori </th> -->
							<!-- <th align="center"> Satuan </th> -->
							<th align="center"> Stok </th>
							<!-- <th align="center"> Tax </th> -->
							<!-- <th align="center"> Harga Beli </th>
							<th align="center"> Harga Jual </th> -->
							<th align="center"> Status </th>
							<th align="center"> Kode Akun </th>
							<th align="center"> Aksi </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						$no = 0;
						foreach ($dt as $key => $row) { 
							$no++;
						?>
						<tr>
							<td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > <?=$no;?> </td>
							<td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > BAHAN <?=$row->TIPE;?> </td>
							<td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > <?=$row->KODE_PRODUK;?> </td>
							<td <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > <?=$row->NAMA_PRODUK;?> </td>
							<!-- <td <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > <?=$row->KATEGORI_PRODUK;?> </td> -->
							<td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > <?=$row->SATUAN;?> </td>
							<!-- <td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > <?=$row->STOK;?> <?=$row->SATUAN;?> </td> -->
							<!-- <td align="left" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > PPN : <?=$row->PPN;?>% <br> PPH : <?=$row->PPH;?>% <br> SERVICE : <?=$row->SERVICE;?>% </td>
							<td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > <?=number_format($row->HARGA);?> </td>
							<td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > <?=number_format($row->HARGA_JUAL);?> </td> -->
							<td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C; text-align:center;'"; } ?> style="text-align: center;" >
								<?PHP if($row->APPROVE == 0){
									echo "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan</font>";
								} else if($row->APPROVE == 1){
									echo "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan Edit</font>";
								} else if($row->APPROVE == 2){
									echo "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan Hapus</font>";
								} else {
									echo "<font style='color:green; font-weight:bold;'>Approved</font>";
								} ?>

								<!-- SETUJU / TIDAK -->
								<?PHP if($row->APPROVE != 3){ ?>
									<?PHP if($user->LEVEL == "MANAGER"){ ?>
										<?PHP $appr = $this->master_model_m->get_data_persetujuan('produk', $row->ID); ?>
										<div class="btn-group">
											<button style="padding: 2px 10px;" data-toggle="dropdown" class="btn btn-danger dropdown-toggle"> Auth <span class="caret"></span>
											</button>
											<ul class="dropdown-menu" style="background-color:rgba(255, 255, 255, 1); min-width: 120px;">
												<li>
												<a href="javascript:;" onclick="persetujuan('<?=$appr->ID;?>', 'SETUJU', '<?=$appr->ITEM;?>', '<?=$appr->ID_ITEM;?>', '<?=$appr->JENIS;?>');">Setuju</a>
												</li>
												<li>
												<a href="javascript:;" onclick="persetujuan('<?=$appr->ID;?>', 'TIDAK SETUJU', '<?=$appr->ITEM;?>', '<?=$appr->ID_ITEM;?>', '<?=$appr->JENIS;?>');">Tidak Setuju</a>
												</li>
											</ul>
										</div>
									<?PHP } ?>
								<?PHP } ?>
							</td>
							<td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C;'"; } ?> > <?=$row->KODE_AKUN;?> </td>
							<td align="center" <?PHP if($kode_produk == $row->KODE_PRODUK){ echo "style='background: #CDE69C; text-align:center;'"; } ?> style="text-align: center;" >								
								<?PHP if($row->APPROVE == 3){ ?>
									<div class="btn-group">
										<button style="padding: 2px 10px;" data-toggle="dropdown" class="btn btn-info dropdown-toggle"> Aksi <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" style="background-color:rgba(255, 255, 255, 1); min-width: 100px;">
											<li>
											<a onclick="ubah_data_produk(<?=$row->ID;?>);" href="javascript:;">Ubah</a>
											</li>
											<li>
											<a onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" href="javascript:;">Hapus</a>
											</li>
										</ul>
									</div>
								<?PHP } else {
									echo "-";
								} ?>
							</td>
						</tr>
						<?PHP } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class="row-fluid" id="add_data" style="display:none;">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-plus"></i> Tambah Data Produk </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">

					<div class="control-group" style="display: none;">
						<label class="control-label"> <b style="font-size: 14px;"> Tipe Barang </b> </label>
						<div class="controls">
							<label class="radio inline">
							<input type="radio" value="JADI" name="tipe_barang" onclick="get_kode_akun(this.value);">
							Barang Jadi </label>

							<label class="radio inline">
							<input type="radio" value="BAKU" name="tipe_barang" onclick="get_kode_akun(this.value);">
							Barang Baku </label>

							<label class="radio inline">
							<input type="radio" value="PEMBANTU" name="tipe_barang" onclick="get_kode_akun(this.value);">
							Barang Pembantu </label>

							<label class="radio inline">
							<input type="radio" value="JASA" name="tipe_barang" onclick="get_kode_akun(this.value);">
							Jasa </label>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Kode Akun Produk</b> </label>
						<div class="controls">
							<select  data-placeholder="Pilih ..." class="chzn-select" tabindex="2" id="kode_akun_sel" name="kode_akun_sel" style="width: 300px;" onchange="$('#kode_akun').val(this.value);">
									<option value="">Pilih ...</option>
								<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
									<option value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
								<?PHP } ?>				
							</select>
							<input type="hidden" class="span12" value="" name="kode_akun" id="kode_akun">
						</div>
					</div>

					<!-- <div class="control-group">
						<label class="control-label"> <b>Kategori Produk</b> </label>
						<div class="controls">
							<select  data-placeholder="Pilih ..." class="chzn-select" tabindex="2" id="kategori_produk" name="kategori_produk" style="width: 300px;">
									<option value="">Pilih ...</option>
								<?PHP foreach ($get_all_kategori_produk as $key => $row) { ?>
									<option value="<?=$row->NAMA_KATEGORI;?>"> <?=$row->NAMA_KATEGORI;?></option>
								<?PHP } ?>				
							</select>
						</div>
					</div> -->


					<div class="control-group">
						<label class="control-label"> <b> Kode Produk </b> </label>
						<div class="controls">
							<input required type="text" class="span12" value="" name="kode_produk">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Nama Produk </b> </label>
						<div class="controls">
							<input required type="text" class="span12" value="" name="nama_produk">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Satuan</b> </label>
						<div class="controls">
							<input type="text" required class="span12" value="" name="satuan">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Harga Beli</b> </label>
						<div class="controls">
							<input type="text" required onkeyup="FormatCurrency(this);" class="span12" value="0" name="harga_beli">
						</div>
					</div>

					<div class="control-group" style="display: none;">
						<label class="control-label"> <b>Harga Jual</b> </label>
						<div class="controls">
							<input type="text" onkeyup="FormatCurrency(this);" class="span12" value="0" name="harga_jual">
						</div>
					</div>	

					<div class="control-group">
						<label class="control-label"> <b> Deskripsi Produk</b> </label>
						<div class="controls">
							<textarea rows="3" class="span12" name="deskripsi"></textarea>
						</div>
					</div>

					<div class="control-group" style="display: none;">
						<label class="control-label"><b>Include Pajak?</b></label>
						<div class="controls">
							<label class="checkbox">
							<input type="checkbox" value="" onclick="cek_pajak(this);">
							Ya </label>
						</div>
					</div>

					<div class="control-group pajak" style="display: none;">
						<label class="control-label"> <b>Pajak PPN</b> </label>
						<div class="controls">
							<div class="input-append">
								<input id="appendedInput" type="text" value="0" name="ppn"  style="width: 15%;" onkeyup="FormatCurrency(this);">
								<span class="add-on">%</span>
							</div>
						</div>
					</div>

					<div class="control-group pajak" style="display: none;">
						<label class="control-label"> <b>Pajak PPH</b> </label>
						<div class="controls">
							<div class="input-append">
								<input id="appendedInput" type="text" value="0" name="pph"  style="width: 15%;" onkeyup="FormatCurrency(this);">
								<span class="add-on">%</span>
							</div>
						</div>
					</div>

					<div class="control-group pajak" style="display: none;">
						<label class="control-label"> <b>Service</b> </label>
						<div class="controls">
							<div class="input-append">
								<input id="appendedInput" type="text" value="0" name="service"  style="width: 15%;" onkeyup="FormatCurrency(this);">
								<span class="add-on">%</span>
							</div>
						</div>
					</div>

					<div class="form-actions">
                        <?PHP if($user->LEVEL == "USER"){ ?>
                        <input type="submit" class="btn btn-info" name="simpan" value="AJUKAN PRODUK">
                        <?PHP } else { ?>
                        <input type="submit" class="btn btn-info" name="simpan" value="SIMPAN PRODUK">
                        <?PHP } ?>
                        <button type="button" onclick="batal_klik();" class="btn"> BATAL </button>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid" id="edit_data" style="display:none;">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-edit"></i> Ubah Data Produk </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">

					<div class="control-group">
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
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Kode Akun Produk</b> </label>
						<div class="controls">
							<select onchange="$('#kode_akun_ed').val(this.value);" disabled data-placeholder="Pilih ..." class="chzn-select" tabindex="2" id="kode_akun_ed_sel" name="kode_akun_ed_sel" style="width: 300px;">
									<option value="">Pilih ...</option>
								<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
									<option value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
								<?PHP } ?>				
							</select>
							<input required type="hidden" class="span12" value="" name="kode_akun_ed" id="kode_akun_ed">
						</div>
					</div>

					<!-- <div class="control-group">
						<label class="control-label"> <b>Kategori Produk</b> </label>
						<div class="controls">
							<select  data-placeholder="Pilih ..." class="chzn-select" tabindex="2" id="kategori_produk_ed" name="kategori_produk_ed" style="width: 300px;">
									<option value="">Pilih ...</option>
								<?PHP foreach ($get_all_kategori_produk as $key => $row) { ?>
									<option value="<?=$row->NAMA_KATEGORI;?>"> <?=$row->NAMA_KATEGORI;?></option>
								<?PHP } ?>				
							</select>
						</div>
					</div> -->


					<div class="control-group">
						<label class="control-label"> <b> Kode Produk </b> </label>
						<div class="controls">
							<input readonly type="text" class="span12" value="" name="kode_produk_ed" id="kode_produk_ed" >
							<input type="hidden" class="span12" value="" name="id_produk" id="id_produk" >
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Nama Produk </b> </label>
						<div class="controls">
							<input required type="text" class="span12" value="" name="nama_produk_ed" id="nama_produk_ed" >
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Satuan</b> </label>
						<div class="controls">
							<input type="text"  class="span4" value="" name="satuan_ed" id="satuan_ed" >
						</div>
					</div>

					<div class="control-group" style="display: none;">
						<label class="control-label"> <b>Harga Beli</b> </label>
						<div class="controls">
							<input type="text" required onkeyup="FormatCurrency(this);" class="span14" value="0" name="harga_beli_ed" id="harga_beli_ed">
						</div>
					</div>

					<div class="control-group" style="display: none;">
						<label class="control-label"> <b>Harga Jual</b> </label>
						<div class="controls">
							<input type="text" required onkeyup="FormatCurrency(this);" class="span14" value="0" name="harga_jual_ed" id="harga_jual_ed">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Deskripsi Produk</b> </label>
						<div class="controls">
							<textarea rows="3" class="span12" name="deskripsi_ed" id="deskripsi_ed" ></textarea>
						</div>
					</div>

					<div class="control-group" style="display: none;">
						<label class="control-label"><b>Include Pajak?</b></label>
						<div class="controls">
							<label class="checkbox">
							<input type="checkbox" value="" checked="" onclick="cek_pajak_edit(this);">
							Ya </label>
						</div>
					</div>

					<div class="control-group pajak_ed">
						<label class="control-label"> <b>Pajak PPN</b> </label>
						<div class="controls">
							<div class="input-append">
								<input id="appendedInput" type="text" value="0" name="ppn_ed"  style="width: 15%;" onkeyup="FormatCurrency(this);">
								<span class="add-on">%</span>
							</div>
						</div>
					</div>

					<div class="control-group pajak_ed">
						<label class="control-label"> <b>Pajak PPH</b> </label>
						<div class="controls">
							<div class="input-append">
								<input id="appendedInput" type="text" value="0" name="pph_ed"  style="width: 15%;" onkeyup="FormatCurrency(this);">
								<span class="add-on">%</span>
							</div>
						</div>
					</div>

					<div class="control-group pajak_ed">
						<label class="control-label"> <b>Service</b> </label>
						<div class="controls">
							<div class="input-append">
								<input id="appendedInput" type="text" value="0" name="service_ed"  style="width: 15%;" onkeyup="FormatCurrency(this);">
								<span class="add-on">%</span>
							</div>
						</div>
					</div>

					<div class="form-actions">
						<?PHP if($user->LEVEL == "USER"){ ?>
                        <input type="submit" class="btn btn-info" name="edit" value="AJUKAN PENGUBAHAN PRODUK">
                        <?PHP } else { ?>
                        <input type="submit" class="btn btn-info" name="edit" value="UBAH PRODUK">
                        <?PHP } ?>
                        <button type="button" onclick="batal_edit_klik();" class="btn"> BATAL </button>
					</div>
				</form>
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
         
        <p>Apakah anda yakin ingin mengajukan penghapusan data ini? </p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->

<!-- MODAL SETUJU / TIDAK -->
<button id="appr_btn" data-toggle="modal" data-target="#approval_modal" class="btn btn-warning" style="display: none;">a</button>
<div id="approval_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body">
            <div class="row-fluid">
                <div class="span12" style="font-size: 15px;">
                    <div class="control-group" style="margin-left: 10px;">
                        <label class="control-label"> <b style="font-size: 14px;"> AKSI </b> </label>
                        <div class="controls">
                            <input type="text" style="font-weight: bold;" class="span12" value="" readonly name="apr_aksi" id="apr_aksi">
                            <input type="hidden" class="span12" value="" readonly name="id_persetujuan" id="id_persetujuan">
                            <input type="hidden" class="span12" value="" readonly name="item" id="item">
                            <input type="hidden" class="span12" value="" readonly name="id_item" id="id_item">
                            <input type="hidden" class="span12" value="" readonly name="jenis" id="jenis">
                        </div>
                    </div>

                    <div class="control-group" style="margin-left: 10px;">
                        <label class="control-label"> <b style="font-size: 14px;"> ALASAN </b> </label>
                        <div class="controls">
                            <textarea rows="3" id="apr_alasan" name="apr_alasan" style="resize:none; height: 60px; width: 400px;"></textarea>
                        </div>
                    </div> 
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="save_persetujuan();" class="btn btn-success">Terapkan</button>
        <button type="button" id="tutup_modal_appr" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div id="laporan_modal" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Tampilkan Laporan</h4>
	      </div>
	      <div class="modal-body" style="height: 350px;">
	      <!-- LAPORAN -->
	       <div class="row-fluid">
	            <div class="span12">
	                <div class="content-widgets light-gray">
	                    <form id="form_laporan" method="post" action="<?=base_url();?>produk_c" target="_blank">
	                    <div class="widget-container">
	                        <div class="row-fluid">
	                            <div class="span12">
	                                <div class="control-group">
	                                    <label class="control-label"> <b style="font-size: 14px;"> Pilih Laporan </b> </label>
	                                    <div class="controls">
	                                        <select   class="chzn-select" tabindex="2"  name="lap_kategori_produk" id="lap_kategori_produk">
												<option value="">Semua Kategori</option>
												<?PHP foreach ($get_all_kategori_produk as $key => $row) { ?>
												<option value="<?=$row->NAMA_KATEGORI;?>"> <?=$row->NAMA_KATEGORI;?></option>
												<?PHP } ?>
	                                        </select>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-actions">
	                            <center>
	                                <input class="btn btn-danger" type="submit" name="pdf" value="CETAK PDF" id="cetak_pdf_beranda"/>                      
	                                <input class="btn btn-success" type="submit" name="excel" value="CETAK EXCEL" id="cetak_xls_beranda"/>                      
	                            </center>
	                        </div>
	                    </div>
	                    </form>
	                </div>
	            </div>
	       </div>
	      <!-- END LAPORAN -->
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="tutup_modal_appr" class="btn btn-default" data-dismiss="modal">Tutup</button>
	      </div>
	    </div>
  	</div>
</div>

<script type="text/javascript">
function cari_produk(keyword) {
	$.ajax({
		url : '<?php echo base_url(); ?>produk_c/cari_produk',
		data : {keyword:keyword},
		type : "GET",
		dataType : "json",
		success : function(result){
			$isi = "";
			if(result.length == 0){
				$isi = "<tr><td colspan='8' style='text-align:center;'> <b> Tidak ada data yang ditampilkan </b> </td></tr>";
			} else {
				$.each(result, function(i, field){

				var approve = field.APPROVE;
				var approve_txt = "";
				var manage = "";
				if(approve == 0){
					approve_txt = "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan</font>";
					manage = "<td style='text-align:center;'>-</td>";
				} else if(approve == 1){
					approve_txt = "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan Edit</font>";
					manage = "<td style='text-align:center;'>-</td>";
				} else if(approve == 2){
					approve_txt = "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan Hapus</font>";
					manage = "<td style='text-align:center;'>-</td>";
				} else {
					approve_txt = "<font style='color:green; font-weight:bold;'>Approved</font>";
					manage =   "<td style='text-align:center;'>"+
									"<button onclick='ubah_data_produk("+field.ID+");' type='button' class='btn btn-small btn-warning'> Ubah </button> &nbsp;"+
									"<button onclick='hapus_klik("+field.ID+");' type='button' class='btn btn-small btn-danger'> Hapus</button>"+
								"</td>";
				}

				$isi += 
					"<tr>"+
						"<td style='text-align:center;'>"+parseInt(i+1)+"</td>"+
						"<td style='text-align:center;'>"+field.KODE_PRODUK+"</td>"+
						"<td>"+field.NAMA_PRODUK+"</td>"+
						"<td style='text-align:center;'>"+field.SATUAN+"</td>"+
						"<td style='text-align:center;'>"+field.STOK+" "+field.SATUAN+"</td>"+
						"<td style='text-align:center;'>"+NumberToMoney(field.HARGA).split('.00').join('')+"</td>"+
						"<td style='text-align:center;'>"+approve_txt+"</td>"+
						manage+
					"</tr>";
				});
			}

			$('#tes').html($isi);
		}
	});
}

function ubah_data_produk(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>produk_c/cari_produk_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#id_produk').val(result.ID);
			$('#kode_produk_ed').val(result.KODE_PRODUK);
			$('#nama_produk_ed').val(result.NAMA_PRODUK);
			$('#satuan_ed').val(result.SATUAN);
			$('#deskripsi_ed').val(result.DESKRIPSI);
			$('#kode_akun_ed_sel').val(result.KODE_AKUN);
			$('#kategori_produk_ed').val(result.KATEGORI_PRODUK);
			$('#kode_akun_ed').val(result.KODE_AKUN);

			$('input[name="ppn_ed"]').val(result.PPN);
			$('input[name="pph_ed"]').val(result.PPH);
			$('input[name="service_ed"]').val(result.SERVICE);

			$('#harga_jual_ed').val(NumberToMoney(result.HARGA_JUAL).split('.00').join(''));
			$('#harga_beli_ed').val(NumberToMoney(result.HARGA).split('.00').join(''));

			$('.'+result.TIPE).prop('checked', true);

			if(result.TIPE == "JASA"){
				$('#kode_akun_ed_sel').prop('disabled', false);
			} else {
				$('#kode_akun_ed_sel').prop('disabled', true);
			}

			$("#kode_akun_ed_sel").trigger("liszt:updated");
			$("#kategori_produk_ed").trigger("liszt:updated");

	        //$("#kategori_ed").chosen("destroy");

	        $('.view_data').hide();
	        $('#edit_data').fadeIn('slow');
		}
	});
}

function detail_supplier(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>produk_c/cari_supplier_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#det_nama_pelanggan').html(result.NAMA_SUPPLIER);
			$('#det_npwp').html(result.NPWP);
			$('#det_no_telp').html(result.NO_TELP);
			$('#det_no_hp').html(result.NO_HP);
			$('#det_email').html(result.EMAIL);
			
			$('#det_alamat_tagih').html(result.ALAMAT_TAGIH);
			$('#det_waktu').html(result.WAKTU);
			$('#det_waktu_edit').html(result.WAKTU_EDIT);


		}
	});
}

function tambah_klik(){
	$('.view_data').hide();
	$('#add_data').fadeIn('slow');
}

function batal_klik(){
	$('#add_data').hide();
	$('.view_data').fadeIn('slow');
}

function batal_edit_klik(){
	$('#edit_data').hide();
	$('.view_data').fadeIn('slow');
}

function hapus_klik(id){
	$('#dialog-btn').click(); 
	$('#id_hapus').val(id);
}

function persetujuan(id, act, item, id_item, jenis){
        
    $('#apr_aksi').val(act);
    $('#id_persetujuan').val(id);
    $('#item').val(item);
    $('#id_item').val(id_item);
    $('#jenis').val(jenis);
    $('#apr_alasan').val('');

    $('#appr_btn').click();
}

function save_persetujuan(){

    var apr_aksi = $('#apr_aksi').val();
    var id_persetujuan = $('#id_persetujuan').val();
    var item = $('#item').val();
    var id_item = $('#id_item').val();
    var jenis = $('#jenis').val();
    var apr_alasan = $('#apr_alasan').val();

    var jml_persetujuan = $('#jml_appr_'+item).html();
    var jml_now = parseFloat(jml_persetujuan) - 1;

    $('#appr_'+id_persetujuan).hide();
    if(jml_now == 0){
        var isi =  '<div class="post_list clearfix">'+
                        '<div class="post_block clearfix">'+  
                            '<h4>Tidak ada pengajuan untuk saat ini</h4>'+
                        '</div>'+
                    '</div>';
         $('#'+item).html(isi);
    }
    $('#jml_appr_'+item).html(jml_now);

    $.ajax({
        type:"POST",
        url: '<?=base_url();?>beranda_c/simpan_persetujuan',
        data: {
            apr_aksi : apr_aksi,
            id_persetujuan : id_persetujuan,
            item : item,
            id_item : id_item,
            jenis : jenis,
            apr_alasan : apr_alasan,
        },
        dataType : 'json',
        success: function(res){
            window.location.reload();
        }
    });
}

function cek_pajak(e){
	$('input[name="ppn"]').val('0');
	$('input[name="pph"]').val('0');
	$('input[name="service"]').val('0');
	if ($(e).is(':checked')) {
		$('.pajak').show();
	} else {
		$('.pajak').hide();
	}
}

function cek_pajak_edit(e){
	$('input[name="ppn_ed"]').val('0');
	$('input[name="pph_ed"]').val('0');
	$('input[name="service_ed"]').val('0');
	if ($(e).is(':checked')) {
		$('.pajak_ed').show();
	} else {
		$('.pajak_ed').hide();
	}
}

function get_kode_akun(val){
	if(val == "BAKU"){
		$("#kode_akun").val("120.02.01");
		$("#kode_akun_sel").val("120.02.01");
		$('#kode_akun_sel').prop('disabled', true);
	} else if(val == "PEMBANTU"){
		$("#kode_akun").val("120.02.02");
		$("#kode_akun_sel").val("120.02.02");
		$('#kode_akun_sel').prop('disabled', true);
	} else if(val == "JADI"){
		$("#kode_akun").val("120.02.04");
		$("#kode_akun_sel").val("120.02.04");
		$('#kode_akun_sel').prop('disabled', true);
	} else {
		$("#kode_akun").val("");
		$("#kode_akun_sel").val("");
		$('#kode_akun_sel').prop('disabled', false);
	}



	$("#kode_akun_sel").trigger("liszt:updated");
}

function get_kode_akun_ed(val){
	if(val == "BAKU"){
		$("#kode_akun_ed").val("120.02.01");
		$("#kode_akun_ed_sel").val("120.02.01");
		$('#kode_akun_ed_sel').prop('disabled', true);
	} else if(val == "PEMBANTU"){
		$("#kode_akun_ed").val("120.02.02");
		$("#kode_akun_ed_sel").val("120.02.02");
		$('#kode_akun_ed_sel').prop('disabled', true);
	} else if(val == "JADI"){
		$("#kode_akun_ed").val("120.02.04");
		$("#kode_akun_ed_sel").val("120.02.04");
		$('#kode_akun_ed_sel').prop('disabled', true);
	} else {
		$("#kode_akun_ed").val("");
		$("#kode_akun_ed_sel").val("");
		$('#kode_akun_ed_sel').prop('disabled', false);
	}



	$("#kode_akun_ed_sel").trigger("liszt:updated");
}

</script>