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
			<h3 class="page-header"> Penawaran Barang </h3>


		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Pembelian</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Penawaran Barang </li>
		</ul>
	</div>
</div>

<div class="row-fluid ">
	<div class="span6">
		<form method="post" action="<?=base_url();?>penawaran_barang_c">
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
		<button onclick="window.location='<?=base_url();?>penawaran_barang_beli_c/new_input';" style="float: right; margin-top: 12px;" type="button" class="btn btn-info opt_btn"> <i class="icon-plus"></i> Buat Penawaran Baru </button>
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
							<th align="center"> Tanggal </th>
							<th align="center"> Nomor </th>
							<th align="center"> Pelanggan </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP  foreach ($dt as $key => $row) { ?>
							<input type="hidden" id="sts_pembukuan_<?=$row->ID;?>" value="<?=$row->NO_TRX_AKUN;?>" />
							<tr>
								<td align="center">
									<a target="blank" href="<?=base_url();?>penawaran_barang_beli_c/cetak/<?=$row->ID;?>" class="btn btn-info" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-print"></i></a>

									<a style="font-size: 15px; padding-right: 8px;" class="btn btn-danger" onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" href="javascript:;"><i class="icon-trash"></i></a>						
									<a class="btn btn-warning" href="<?=base_url();?>penawaran_barang_beli_c/ubah_data/<?=$row->ID;?>" style="font-size: 15px; padding-right: 8px;"><i class="icon-edit"></i></a>						
									<a href="<?=base_url();?>penawaran_barang_beli_c/detail/<?=$row->ID;?>" class="btn btn-info" type="button" style="font-size: 15px; padding-right: 8px;"><i class="icon-eye-open"></i></a>
								</td>
								<td style="font-size:14px; text-align:center; vertical-align:middle;"> <?=$row->TGL_TRX;?> </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;"> <?=$row->NO_BUKTI;?> </td>
								<td style="font-size:14px; text-align:left; vertical-align:middle;"> <?=$row->PELANGGAN;?> </td>

								
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

function detail_supplier(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>kas_bank_c/cari_supplier_by_id',
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