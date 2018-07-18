<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

#tes td {
	vertical-align: middle;
}

.table th, .table td {
    /*padding: 1px !important;*/
	font-size: 12px !important;
	padding-left: 5px !important;
	padding-right: 5px !important;
	padding-top: 4px !important;
	padding-bottom: 4px !important;

}
</style>

<?PHP 
$kode_kas_full = "";
if($last_kas_bank->KODE_AKUN != "" || $last_kas_bank->KODE_AKUN != null ){
	$kode_kas_last = $last_kas_bank->KODE_AKUN;
	$kode_kas = explode("-", $kode_kas_last);
	$kode_kas1 = $kode_kas[0];
	$kode_kas2 = $kode_kas[1];
	$kode_kas_res = intval($kode_kas2) + 1;

	$kode_kas_full = $kode_kas1."-".$kode_kas_res;
} else {
	$kode_kas_full = "1-1000";
}


$kode_cc_full = "";

if($last_cc->KODE_AKUN != "" || $last_cc->KODE_AKUN != null ){
	$kode_cc_last = $last_cc->KODE_AKUN;
	$kode_cc = explode("-", $kode_cc_last);
	$kode_cc1 = $kode_cc[0];
	$kode_cc2 = $kode_cc[1];
	$kode_cc_res = intval($kode_cc2) + 1;

	$kode_cc_full = $kode_cc1."-".$kode_cc_res;
} else {
	$kode_cc_full = "2-2101";
}


?>


<input type="hidden" class="span12" value="<?=$kode_kas_full;?>" id="last_kode_kas">
<input type="hidden" class="span12" value="<?=$kode_cc_full;?>" id="last_kode_cc">

<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-random"></i> Invoice </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Penjualan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Invoice </li>
		</ul>
	</div>
</div>

<div class="row-fluid ">
	<div class="span6">
		<form method="post" action="<?=base_url();?>transaksi_penjualan_c">
		<div class="control-group">
			<label class="control-label" style="font-weight: bold; font-size: 13px;">Tampilkan berdasarkan tanggal :</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-calendar"></i></span>
					<input required type="text" name="tgl" id="reservation" value="<?=$tgl_full;?>"/>
					<input type="submit" name="cari" style="margin-top: 1px; height: 33px;" class="btn btn-warning" value="Cari"/>
				</div>
			</div>
		</div>
		</form>
	</div>

	<div class="span6">
		<button onclick="window.location='<?=base_url();?>transaksi_penjualan_c/buka_invoice_baru';" style="float: right; margin-top: 12px;" type="button" class="btn btn-info opt_btn"> <i class="icon-plus"></i> Buat Invoice Baru </button>
	</div>

	
</div>



<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="stat-table table table-hover" id="data-table">
					<thead>
						<tr>
							<th align="center"> Aksi </th>
							<th align="center"> Cetak By SO </th>
							<th align="center"> Cetak By DO </th>
							<th align="center"> Cetak Bahan Bakar </th>
							<th align="center"> Cetak Transport </th>
							<th align="center"> No. Invoice </th>
							<th align="center"> No. So </th>
							<th align="center"> No. Do </th>
							<th align="center"> Tanggal </th>
							<th align="center"> Customer </th>
							<th align="center"> Volume </th>
							<!-- <th align="center"> Harga </th> -->
						</tr>						
					</thead>
					<tbody id="tes">
						<?php  foreach ($dt as $key => $row) { 
							
							$nmr_so = $row->NOMER_SO;
							
							$sql = "SELECT * FROM ak_penjualan WHERE NO_BUKTI = '$nmr_so' ";
							$dt_sql = $this->db->query($sql)->row();


							if($dt_sql->TUTUP_OUTSTANDING == 'Konfirmasi'){

							}else{
							?>


							<input type="hidden" id="sts_pembukuan_<?=$row->ID;?>" value="<?=$row->NO_TRX_AKUN;?>" />
							<tr>
								<td align="center">		
									<!-- <?php if($dt_sql->SISA > 0 && $dt_sql->TUTUP_OUTSTANDING == 'Selesai'){
										?>
										<button onclick="tutup_outs('<?=$dt_sql->NO_BUKTI;?>');" data-toggle="modal" data-target="#modal_detail" type="button" class="btn btn-success" style="font-size: 15px; padding-right: 8px;"> <i class="icon-print"></i>
										</button>
									<?php } else if ($dt_sql->TUTUP_OUTSTANDING == 'Konfirmasi') {
										?>
										<button onclick="tutup_outs('<?=$dt_sql->NO_BUKTI;?>');" data-toggle="modal" data-target="#modal_detail_konfirmasi" type="button" class="btn btn-success" style="font-size: 15px; padding-right: 8px;"> <i class="icon-print"></i>
										</button>
									
									<?php } ?> -->
									
									<button  onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" class="btn btn-danger" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-trash"></i></button>
									
									
									<a class="btn btn-warning" href="<?=base_url();?>transaksi_penjualan_c/ubah_invoice_baru/<?=$row->ID;?>" style="font-size: 15px; padding-right: 8px;"><i class="icon-edit"></i></a>
									
								</td>

								<td align="center">	
									<!-- <a target="blank" href="<?=base_url();?>transaksi_penjualan_c/cetak_loses/<?=$row->ID;?>" class="btn btn-info" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a> -->
									<a target="blank" href="<?=base_url();?>transaksi_penjualan_c/cetak_by_so/<?=$row->ID;?>" class="btn btn-info" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a>
								</td>

								<td align="center">	
									<!-- <a target="blank" href="<?=base_url();?>transaksi_penjualan_c/cetak_loses/<?=$row->ID;?>" class="btn btn-info" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a> -->
									<a target="blank" href="<?=base_url();?>transaksi_penjualan_c/cetak_inv/<?=$row->ID;?>" class="btn btn-primary" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a>
								</td>


								<td align="center">	
									<?php 

									if($dt_sql->OAT){
										?> <a target="blank" href="<?=base_url();?>transaksi_penjualan_c/cetak_bbm/<?=$row->ID;?>" class="btn btn-primary" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a>

								<?php
									}else{
							     ?> 

								<?php 	} ?>
								</td>

								<td align="center">	
									<?php 

										if($dt_sql->OAT){
											?> <a target="blank" href="<?=base_url();?>transaksi_penjualan_c/cetak_transport/<?=$row->ID;?>" class="btn btn-primary" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a>

								<?php
										}else{
									?>
									
									<?php } ?>
								</td>
								
								<td style="font-size:14px; text-align:left; vertical-align:middle;text-align: center;">   <?=$dt_sql->NOMER_INV;?> </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;text-align: center;">   <?=$row->NOMER_SO;?> </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;text-align: center;">   <?=$row->NOMER_DO;?> </td>
								<td style="font-size:14px; text-align:center; vertical-align:middle;"> <?=$row->TGL_TRX;?> </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;">   <?=$row->ID_CUSTOMER;?> </td>

								<td style="font-size:14px; text-align:right; vertical-align:middle;text-align: center;"> <?=number_format($row->QTY);?> L </td>
								<!-- <td style="font-size:14px; text-align:right; vertical-align:middle;"> <?=number_format($dt_detail->HARGA_JUAL);?> </td> -->
								<!-- <td style="font-size:14px; text-align:center; vertical-align:middle;">
									<?PHP if($row->NO_TRX_AKUN == "" || $row->NO_TRX_AKUN == null ){ 
										echo "<b style='color:red;'> Belum Dibukukan </b>"; 
										echo "<br>";
										echo "<a style='padding: 2px 10px;' href='".base_url()."input_transaksi_akuntansi_c/index/j/".$row->ID."'> (Proses Pembukuan) </a>";
									} else { 
										echo "<b style='color:green;'> Sudah Dibukukan </b> <br> (".$row->NO_TRX_AKUN.") "; 
									} ?> 
								</td> -->
								
							</tr>

						<?PHP } }	?>
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
         
        <p id="hapus_txt">Apakah anda yakin ingin menghapus data ini?</p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->


<!-- Modal Detail -->
<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi Tutup Outstanding</h4>
      </div>
      <div class="modal-body">
        

		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<address>
					<strong> Terdapat transaksi yang belum diselesaikan , apakah anda ingin melakukan tutup outstanding pada transaksi ini ? </strong><br>
					<font id="det_no_transaksi"> Jika ya akan menuggu konfirmasi dari manager , jika tidak silahkan selesaikan transaksi </font> 
				</address>
				<form id="tutup_out" method="post" action="<?=base_url().$post_url;?>">
					<input type="hidden" name="nomor_solokot" id="nomor_solokot">
				</form>
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" onclick="$('#tutup_out').submit();" >Konfirmasi Tutup Outstanding</button>
        <a href="<?=base_url();?>delivery_order_new_c/new_delivery_order"><button type="button" class="btn btn-default" >Tidak</button></a>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_detail_konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi Tutup Outstanding</h4>
      </div>
      <div class="modal-body">
        

		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<address>
					<strong> Transaksi ini masih menunggu konfirmasi dari manager untuk mensetujui tutup outstanding </strong><br>
					<!-- <font id="det_no_transaksi"> Jika ya akan menuggu konfirmasi dari manager , jika tidak silahkan selesaikan transaksi </font>  -->
				</address>
				
			</div>
		</div>

      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">

function tutup_outs(id){
	$('#nomor_solokot').val(id);
}

function hapus_trx(id){
	$('#id_hapus').val(id);
	var sts = $('#sts_pembukuan_'+id).val();

	if(sts == ""){
		$('#hapus_txt').html('Apakah anda yakin ingin menghapus data ini?');
	} else {
		$('#hapus_txt').html('Transaksi ini telah dibukukan. Jika anda menghapus data ini, maka semua data pembukuan terkait transaksi ini akan dihapuskan. <br> Apakah anda yakin untuk menghapus data ini ?');
	}

	$('#dialog-btn').click(); 
}

function get_kode_akun(val){

	var last_kode_kas = $('#last_kode_kas').val(); 
	var last_kode_cc = $('#last_kode_cc').val();

	if(val == "Kas & Bank"){
		$('#kode_akun').val(last_kode_kas);
	} else if(val == "Credit Card"){
		$('#kode_akun').val(last_kode_cc);
	}
} 

function cari_kas_bank(keyword) {
	$.ajax({
		url : '<?php echo base_url(); ?>kas_bank_c/cari_kas_bank',
		data : {keyword:keyword},
		type : "GET",
		dataType : "json",
		success : function(result){
			$isi = "";
			if(result.length == 0){
				$isi = "<tr><td colspan='3' style='text-align:center;'> <b> Tidak ada kode akun yang dapat ditampilkan </b> </td></tr>";
			} else {
				$.each(result, function(i, field){
				$isi += 
					"<tr>"+
						"<td style='text-align:center;'> <b> "+field.KODE_AKUN+" </b> </td>"+
						"<td style='text-align:left;'> <b> "+field.NAMA_AKUN+" </b> </td>"+
						"<td style='text-align:right;'> <b> 0 </b> </td>"+
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
		url : '<?php echo base_url(); ?>kas_bank_c/cari_produk_by_id',
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



	        //$("#kategori_ed").chosen("destroy");

	        $('#view_data').hide();
	        $('#edit_data').fadeIn('slow');
		}
	});
}

function detail_transaksi(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>transaksi_penjualan_c/detail_transaksi',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(result){
			var res = result['dt'];
			var res_det = result['dt_detail'];

			$('#det_no_transaksi').html(res.NO_BUKTI);
			$('#det_nama_pelanggan').html(res.PELANGGAN);
			$('#det_alamat_tujuan').html(res.ALAMAT_TUJUAN);
			$('#det_kota').html(res.KOTA);
			$('#det_nopol').html(res.NO_POL);
			$('#det_sopir').html(res.SOPIR);
			$('#det_po').html(res.NO_PO);
			$('#det_do').html(res.NO_DO);
			$('#det_segel_atas').html(res.SEGEL_ATAS);
			$('#det_segel_bawah').html(res.SEGEL_BAWAH);
			
			$('#det_nama_produk').html(res_det.NAMA_PRODUK);
			$('#det_qty').html(res_det.QTY+' liter');
			$('#det_modal').html('Rp '+res_det.MODAL);
			$('#det_hjual').html('Rp '+res_det.HARGA_JUAL);
			$('#det_hinv').html('Rp '+res_det.HARGA_INVOICE);

			$('#popup_load').hide();


		}
	});
}

function tambah_klik(){
	$('.opt_btn').hide();
	$('#view_data').hide();
	$('#add_data').fadeIn('slow');
}

function batal_klik(){
	$('#add_data').hide();
	$('.opt_btn').show();
	$('#view_data').fadeIn('slow');
}

function batal_edit_klik(){
	$('#edit_data').hide();
	$('#view_data').fadeIn('slow');
}

function hapus_klik(id){
	$('#dialog-btn').click(); 
	$('#id_hapus').val(id);
}
</script>