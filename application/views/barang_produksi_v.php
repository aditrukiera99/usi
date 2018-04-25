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
			<h3 class="page-header"> <i class="icon-angle-right"></i>  Produksi </h3>
			<a class="btn btn-info view_data" href="<?=base_url();?>barang_produksi_c/add_new" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> INPUT KOMPOSISI PRODUK
			</a>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Produksi</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Komposisi Produk </li>
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
							<th align="center"> Kode Akun </th>
							<th align="center"> Nama Item </th>
							<th align="center"> Deskripsi </th>
							<th align="center"> Satuan </th>
							<th align="center"> Stock </th>
							<th align="center" style="width: 25%;"> Bahan Baku </th>
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
							<td align="left"   style="text-align: left; font-size: 13px;"> <?=$row->KODE_AKUN;?> <br> <?=$row->NAMA_AKUN;?> </td>							
							<td align="left"   style="text-align: left; font-size: 13px;"> <?=$row->NAMA_PRODUK;?> </td>							
							<td align="left"   style="text-align: left; font-size: 13px;"> <?=$row->DESKRIPSI;?> </td>							
							<td align="center" style="text-align: center; font-size: 13px;"> <?=$row->SATUAN;?> </td>													
							<td align="center" style="text-align: center; font-size: 13px;"> <?=$row->STOK;?> </td>													
							<td align="left" style="text-align: left; font-size: 13px;">
								<?PHP 
								$barang_baku = $this->model->get_barang_baku($row->ID_PRODUKSI);
								foreach ($barang_baku as $key => $row2) {
									echo "- ".$row2->NAMA_PRODUK." : <b>".$row2->QTY." ".$row2->SATUAN."</b> <br>";
								}
								?>
							</td>
							<td align="center" style="text-align: center;">
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"> Aksi <span class="caret"></span>
									</button>
									<ul class="dropdown-menu" style="background-color:rgba(255, 255, 255, 1); min-width: 100px;">
										<li>
										<a href="<?=base_url();?>barang_produksi_c/ubah/<?=$row->ID_PRODUKSI;?>">Ubah</a>
										</li>
										<li>
										<a onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID_PRODUKSI;?>');" href="javascript:;">Hapus</a>
										</li>
									</ul>
								</div>								
							</td>												
						</tr>
						<?PHP } ?>
					</tbody>
				</table>
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

			$('input[name="ppn_ed"]').val(result.PPN);
			$('input[name="pph_ed"]').val(result.PPH);
			$('input[name="service_ed"]').val(result.SERVICE);

			$('#harga_jual_ed').val(NumberToMoney(result.HARGA_JUAL).split('.00').join(''));
			$('#harga_beli_ed').val(NumberToMoney(result.HARGA).split('.00').join(''));



	        //$("#kategori_ed").chosen("destroy");

	        $('.view_data').hide();
	        $('#edit_data').fadeIn('slow');
		}
	});
}
</script>