<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

#tes td {
	vertical-align: middle;
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
			<h3 class="page-header"><i class="icon-money"></i> Input Saldo Awal </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Input Saldo Awal </li>
		</ul>
	</div>
</div>

<!-- <div class="row-fluid ">
	<div class="span4">
		<div class="board-widgets green" style="background:#6ec06e;">
			<div class="board-widgets-head clearfix">
				<h4 class="pull-left" style="font-size: 18px;"> Saldo Kas & Bank </h4>
			</div>
			<div class="board-widgets-content" style="background:#FFF; color:#666;">
				<span class="n-counter">Rp 7,500,000</span><span class="n-sources">Total saldo saat ini</span>
			</div>
		</div>
	</div>
</div>
 -->

<button onclick="tambah_klik();" style="float:left; margin-bottom: 10px;" type="button" class="btn btn-info opt_btn"> <i class="icon-plus"></i> Input Saldo Awal </button>
<br>

<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">

			<div class="widget-container">


				<table class="stat-table table table-hover" id="data-table">
					<thead>
						<tr>
							<th style="" align="center"> Tgl Input </th>
							<th style="" align="center"> Kode Akun </th>
							<th style="" align="center"> Nama Akun </th>
							<th style="" align="center"> Saldo (Rp) </th>

						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						foreach ($dt as $key => $row) {
							$tgl = strtotime($row->TGL);
						?>
						<tr>
							<td><?=date('d/m/Y',$tgl);?> </td>
							<td><?=$row->KODE_AKUN;?> </td>
							<td><?=$row->NAMA_AKUN;?> </td>
							<td><?=number_format($row->DEBET);?> </td>
						</tr>
						<?PHP }	?>
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
				<h3> <i class="icon-plus"></i> Tambah Data Akun Kas & Bank </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> <b> Tanggal Input </b> </label>
						<div class="controls">
							<input readonly type="text" class="span12" value="<?=date('d-m-Y');?>" style="background: #FFF; width: 25%;" name="tgl" id="tgl">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Kode Akun </b> </label>
						<div class="controls">
							<select  required data-placeholder="Pilih ..." class="chzn-select" tabindex="2" id="kode_akun" name="kode_akun" style="width: 400px;">
								<option value="">Pilih ...</option>
								<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
								<option value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
								<?PHP } ?>				
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Saldo Awal </b> </label>
						<div class="controls">
							<input required onkeyup="FormatCurrency(this);" type="text" class="span12" value="0" name="saldo_awal" id="saldo_awal">
							<span class="help-inline" style="color:red;"> Penting!! Isikan saldo awal pada akun baru ini. </span>
						</div>
					</div>					

					<div class="control-group">
						<label class="control-label"> <b> Uraian </b> </label>
						<div class="controls">
							<textarea rows="3" class="span12" name="deskripsi"></textarea>
						</div>
					</div>					


					<div class="form-actions">
						<input type="submit" class="btn btn-info" name="simpan" value="Simpan Saldo Awal">
						<button type="button" onclick="batal_klik();" class="btn"> Batal dan Kembali </button>
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
							<input type="text"  class="span12" value="" name="satuan_ed" id="satuan_ed" >
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Deskripsi Produk</b> </label>
						<div class="controls">
							<textarea rows="3" class="span12" name="deskripsi_ed" id="deskripsi_ed" ></textarea>
						</div>
					</div>


					<div class="form-actions">
						<input type="submit" class="btn btn-info" name="edit" value="Ubah Data Produk">
						<button type="button" onclick="batal_edit_klik();" class="btn"> Batal dan Kembali </button>
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
         
        <p>Apakah anda yakin ingin menghapus data ini?</p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->




<script type="text/javascript">

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