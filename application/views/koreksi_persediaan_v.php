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
			<h3 class="page-header"> <i class="icon-minus"></i>  Koreksi Persediaan</h3>
			<a class="btn btn-info view_data" href="<?=base_url();?>koreksi_persediaan_c/add_new" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> INPUT KOREKSI
			</a>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Persediaan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Koreksi Persediaan</li>
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
							<th align="center"> Aksi </th>
							<th align="center"> Kode Akun </th>
							<th align="center"> No Koreksi </th>
							<th align="center"> Tipe </th>
							<th align="center"> Tanggal </th>
							<th align="center"> No. Ref </th>
							<th align="center"> Catatan </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP foreach ($dt as $key => $row) { ?>
						<tr>
							<td style="text-align: center;">
								<a style="padding: 2px 10px;" href="<?=base_url();?>koreksi_persediaan_c/detail/<?=$row->ID;?>" class="btn btn-small btn-info"> Detail </a>
							</td>
							<td style="text-align: left;"><?=$row->KODE_AKUN;?> <br> <?=$row->NAMA_AKUN;?></td>
							<td style="text-align: center;"><?=$row->NO_KOREKSI;?></td>
							<td style="text-align: center;"><?=$row->TIPE;?></td>
							<td style="text-align: center;"><?=$row->TGL;?></td>
							<td style="text-align: center;"><?=$row->NO_REF;?></td>
							<td style="text-align: left;"><?=$row->CATATAN;?></td>
						</tr>
						<?PHP } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


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