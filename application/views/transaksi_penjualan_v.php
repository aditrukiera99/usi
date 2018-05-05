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
			<h3 class="page-header"> <i class="icon-random"></i> Order Penjualan </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Penjualan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Order Penjualan </li>
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
		<button onclick="window.location='<?=base_url();?>transaksi_penjualan_c/new_invoice';" style="float: right; margin-top: 12px;" type="button" class="btn btn-info opt_btn"> <i class="icon-plus"></i> Buat Penjualan Baru </button>
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
							<th align="center"> Confirmation </th>
							<th align="center"> No. Transaksi </th>
							<th align="center"> Tanggal </th>
							<th align="center"> Customer </th>
							<th align="center"> Volume </th>
							<!-- <th align="center"> Harga </th> -->
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP  foreach ($dt as $key => $row) { ?>
							<?PHP $dt_detail = $this->model->get_data_trx_detail($row->ID); ?>

							<?PHP 
							$sql = "SELECT SUM(QTY) AS QTY FROM ak_penjualan_detail WHERE ID_PENJUALAN = '$row->ID' ";
							$dt_sql = $this->db->query($sql)->row();

							?>


							<input type="hidden" id="sts_pembukuan_<?=$row->ID;?>" value="<?=$row->NO_TRX_AKUN;?>" />
							<tr>
								<td align="center">
									<!-- <button  onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" class="btn btn-danger" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-trash"></i></button> -->						
									<a class="btn btn-warning" href="<?=base_url();?>transaksi_penjualan_c/ubah_data/<?=$row->ID;?>" style="font-size: 15px; padding-right: 8px;"><i class="icon-edit"></i></a>						
									<!-- <button onclick="detail_transaksi(<?=$row->ID;?>);" data-toggle="modal" data-target="#modal_detail" class="btn btn-info" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-eye-open"></i></button> -->
									<a target="blank" href="<?=base_url();?>transaksi_penjualan_c/cetak/<?=$row->ID;?>" class="btn btn-success" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a>
								</td>
								<td align="center">
									<a target="blank" href="<?=base_url();?>transaksi_penjualan_c/cetak_confirm/<?=$row->ID;?>" class="btn btn-info" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a>
								</td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;">   <?=$row->NO_BUKTI;?> </td>
								<td style="font-size:14px; text-align:center; vertical-align:middle;"> <?=$row->TGL_TRX;?> </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;">   <?=$row->PELANGGAN;?> </td>

								<td style="font-size:14px; text-align:right; vertical-align:middle;"> <?=number_format($dt_sql->QTY);?> L </td>
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
						<?PHP }	?>
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
        <h4 class="modal-title" id="myModalLabel">Detail Penjualan</h4>
      </div>
      <div class="modal-body">
        

		<div class="row-fluid">
			<div class="span6" style="font-size: 15px;">
				<address>
					<strong> No. Transaksi </strong><br>
					<font id="det_no_transaksi"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Nama Customer </strong><br>
					<font id="det_nama_pelanggan"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Alamat Tujuan </strong><br>
					<font id="det_alamat_tujuan"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Kota Tujuan</strong><br>
					<font id="det_kota"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> No Polisi </strong><br>
					<font id="det_nopol"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Sopir </strong><br>
					<font id="det_sopir"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> No. PO </strong><br>
					<font id="det_po"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> NO. DO </strong><br>
					<font id="det_do"> Dr. Aristo Jason </font> 
				</address>
			</div>
			<div class="span6" style="font-size: 15px;">
				<address style="margin-top: 18px;">
					<strong> Nama Produk </strong><br>
					<font id="det_nama_produk"> Dr. Aristo Jason </font> 
				</address>

				<address>
					<strong> No. Segel Atas </strong><br>
					<font id="det_segel_atas"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> No. Segel Bawah </strong><br>
					<font id="det_segel_bawah"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Volume </strong><br>
					<font id="det_qty"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Modal </strong><br>
					<font id="det_modal"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Harga Jual </strong><br>
					<font id="det_hjual"> Dr. Aristo Jason </font> 
				</address>

				<address style="margin-top: 18px;">
					<strong> Harga Invoice </strong><br>
					<font id="det_hinv"> Dr. Aristo Jason </font> 
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