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
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Produksi</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Lakukan Produksi </li>
		</ul>
	</div>
</div>

<form action="<?=base_url().$post_url;?>" method="post">
<div class="row-fluid">
<div class="span12" style="background: #F5EADA">
	<div class="span4">
		<div class="row-fluid" style="background: #F5EADA; padding-top: 15px;">
			<div class="span10">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Pilih Item Produksi </b> </label>
					<div class="controls">
						<input type="hidden" name="id_produksi" id="id_produksi">
						<select  required data-placeholder="Pilih item..." class="chzn-select" tabindex="2" style="width:500px;" name="item" id="item" onchange="get_item_detail(this.value);">
							<option value=""></option>
							<?PHP 
                            foreach ($dt as $key => $row) {
                                echo "<option value='".$row->ID."'>".$row->NAMA_PRODUK."</option>";
                            }
                            ?>
						</select>
					</div>
				</div>
			</div>	
		</div>

		<div class="row-fluid" style="background: #F5EADA; padding-top: 15px;">
			<div class="span10">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Stok saat ini </b> </label>
					<div class="controls">
						<input readonly type="text" class="span12" value="" name="stock" id="stock" style="font-size: 15px; background: #FFF;">
					</div>
				</div>
			</div>	
		</div>

		<div class="row-fluid" style="background: #F5EADA; padding-top: 15px;">
			<div class="span10">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Harga Jual saat ini (Rp) </b> </label>
					<div class="controls">
						<input readonly type="text" class="span12" value="" name="harga_jual" id="harga_jual" style="font-size: 15px; background: #FFF;">
					</div>
				</div>
			</div>	
		</div>

		<div class="row-fluid" style="background: #F5EADA;">
			<div class="span8">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;" id="satuan_txt"> Jumlah Produksi </b> </label>
					<div class="controls">
						<input onkeyup="FormatCurrency(this); set_qty();" required  type="text" class="span12" value="" name="jml_produksi" id="jml_produksi" style="font-size: 15px; background: #FFF;">
					</div>
				</div>
			</div>	
		</div>

		<div class="row-fluid" style="background: #F5EADA;">
			<div class="span12">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;" id="satuan_txt"> Kode Akun Produksi </b> </label>
					<div class="controls">
						<select  required data-placeholder="Pilih ..." class="chzn-select" tabindex="2" id="kode_akun" name="kode_akun" style="width: 100%;">
								<option value="">Pilih ...</option>
							<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
								<option value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
							<?PHP } ?>				
						</select>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<div class="span8">
		<center>
		<h3 class="page-header"> BAHAN BAKU </h3>	
		</center>
		<table class="stat-table table table-hover">
			<thead>
				<tr>
					<th align="center"> Bahan </th>
					<th align="center"> Stok </th>
					<th align="center"> Qty Produksi </th>
					<th align="center"> Sisa Stok </th>
				</tr>						
			</thead>
			<tbody id="data_bahan">
				<tr><td colspan="4" style="text-align: center;"><b>Pilih Item Produksi terlebih dahulu</b></td></tr>
			</tbody>
		</table>

		<div class="form-actions">

			<!-- <div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Harga Jual Baru</b> </label>
				<div class="controls">
					<input type="text" id="last_avg" name="last_avg" value="" style="background:#FFF; width: 90%; font-size: 13px;" onkeyup="FormatCurrency(this);">
				</div>
			</div> -->

			<center>
			<input type="submit" value="LAKUKAN PRODUKSI" name="simpan" class="btn btn-info">
			</center>
		</div>
	</div>
</div>
</div>
</form>

<br>
<center>
<h3 class="page-header"><i class="icon-time"></i> HISTORY PRODUKSI </h3>	
</center>

<div class="row-fluid view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="stat-table table table-hover" id="data-table">
					<thead>
						<tr>
							<th align="center"> TGL / WAKTU </th>
							<th align="center"> ITEM PRODUKSI </th>
							<th align="center"> JML PRODUKSI </th>
							<th align="center"> KODE AKUN </th>
							<th align="center"> KEPERLUAN BAHAN </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						$no = 0;
						foreach ($dt_history as $key => $row) { 
						?>
						<tr>
							<td align="left"   style="text-align: left; font-size: 13px;"> <?=$row->TGL;?> <br> <?=$row->WAKTU;?> </td>							
							<td align="left"   style="text-align: left; font-size: 13px;"> <?=$row->NAMA_PRODUK;?> </td>							
							<td align="center" style="text-align: center; font-size: 13px;"> <?=$row->JML_PRODUKSI;?> <?=$row->SATUAN;?> </td>													
							<td align="center" style="text-align: center; font-size: 13px;"> <?=$row->KODE_AKUN;?> </td>													
							<td align="left" style="text-align: left; font-size: 13px;">
								<?PHP 
								$barang_baku = $this->model->get_keperluan_bahan($row->ID_PRODUKSI);
								foreach ($barang_baku as $key => $row2) {
									echo "- ".$row2->BAHAN." : <b>".$row2->QTY_PRODUKSI." ".$row2->SATUAN."</b> <br>";
								}
								?>
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

function set_qty(){
	var jml_produksi = $('#jml_produksi').val();
	if(jml_produksi == 0 || jml_produksi == ""){
		jml_produksi = 1;
	}

	get_bahan_baku();
}

function get_item_detail(id){
	$.ajax({
		url : '<?php echo base_url(); ?>produksi_c/get_item_detail',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(result){
			$('#stock').val(result.STOK+' '+result.SATUAN);
			$('#satuan_txt').html('Jumlah Produksi ('+result.SATUAN+')');
			$('#harga_jual').val(NumberToMoney(result.HARGA_JUAL).split('.00').join(''));
			$('#last_avg').val(NumberToMoney(result.HARGA_JUAL).split('.00').join(''));
			$('#jml_produksi').val(1);
			$('#id_produksi').val(result.ID_PRODUKSI);
			$('#jml_produksi').focus();

			get_bahan_baku();
		}
	});
}

function get_bahan_baku(){

	var id_produksi  = $('#id_produksi').val();
	var jml_produksi = $('#jml_produksi').val().split(',').join('');
	if(jml_produksi == 0 || jml_produksi == ""){
		jml_produksi = 1;
	}

	$.ajax({
		url : '<?php echo base_url(); ?>produksi_c/get_bahan_baku',
		data : {id_produksi:id_produksi},
		type : "POST",
		dataType : "json",
		success : function(result){
			var isi = "";
			$.each(result,function(i,res){
				var sisa = parseFloat(res.STOK) - (parseFloat(res.QTY * jml_produksi));
                isi += '<tr>'+
                			'<input type="hidden" name="id_bahan[]" value="'+res.ID+'" />'+
                			'<input type="hidden" name="nama_bahan[]" value="'+res.NAMA_PRODUK+'" />'+
                			'<input type="hidden" name="qty_produksi[]" value="'+parseFloat(res.QTY * jml_produksi)+'" />'+
                			'<input type="hidden" name="sisa_stok[]" value="'+sisa+'" />'+
                			'<input type="hidden" name="satuan[]" value="'+res.SATUAN+'" />'+
                            '<td align="center">'+res.NAMA_PRODUK+'</td>'+
                            '<td align="center" style="text-align:center;">'+res.STOK+' '+res.SATUAN+'</td>'+
                            '<td align="center" style="text-align:center;">'+parseFloat(res.QTY * jml_produksi)+' '+res.SATUAN+'</td>'+
                            '<td align="center" style="text-align:center;">'+sisa+' '+res.SATUAN+'</td>'+
                        '</tr>';
            });

            $('#data_bahan').html(isi);

		}
	});
}
</script>