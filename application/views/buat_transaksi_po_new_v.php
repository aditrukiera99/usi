<script src="http://cdn.wysibb.com/js/jquery.wysibb.min.js"></script>
<link rel="stylesheet" href="http://cdn.wysibb.com/css/default/wbbtheme.css" type="text/css" />
<script>
$(function() {
$("#editor").wysibb();
})
</script>

<?PHP 
$no_transaksi = 1;
if($no_trx->NEXT != "" || $no_trx->NEXT != null ){
	$no_transaksi = $no_trx->NEXT+1;
}

$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$sess_user = $this->session->userdata('masuk_akuntansi');
$id_user = $sess_user['id'];
$user = $this->master_model_m->get_user_info($id_user);

$bulan_kas = date('m');
$bulan_kas = tgl_to_romawi($bulan_kas);
$tahun_kas = date('Y');

$no_bukti_real = str_pad($no_transaksi, 3, '0', STR_PAD_LEFT)."/PO/MCN/".$bulan_kas."/".$tahun_kas;
$no_bukti_real2 = str_pad($no_transaksi, 3, '0', STR_PAD_LEFT)."/DO/MCN/".$bulan_kas."/".$tahun_kas;

function tgl_to_romawi($var){
	if($var == "01"){
	 	$var = "I";
	 } else if($var == "02"){
	 	$var = "II";
	 } else if($var == "03"){
	 	$var = "III";
	 } else if($var == "04"){
	 	$var = "IV";
	 } else if($var == "05"){
	 	$var = "V";
	 } else if($var == "06"){
	 	$var = "VI";
	 } else if($var == "07"){
	 	$var = "VII";
	 } else if($var == "08"){
	 	$var = "VIII";
	 } else if($var == "09"){
	 	$var = "IX";
	 } else if($var == "10"){
	 	$var = "X";
	 } else if($var == "11"){
	 	$var = "XI";
	 } else if($var == "12"){
	 	$var = "XII";
	 }

	 return $var;
}

$bukti_kas = 'BK/'.$bulan_kas.'/'.$tahun_kas;


?>

<style type="text/css">

input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 10px;
}

</style>
<input id="tr_utama_count" value="1" type="hidden"/>
<input id="tr_utama_count2" value="0" type="hidden"/>
<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-plus"></i>  Order Pembelian </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Pembelian</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li> Order Pembelian <span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Buat Pembelian Baru </li>
		</ul>
	</div>
</div>

<form action="<?=base_url().$post_url;?>" method="post">

<div class="breadcrumb" style="background:#E0F7FF;">
	<div class="row-fluid">

		<div class="span4">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Supplier </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="pelanggan" name="pelanggan" readonly style="background:#FFF; width: 70%;">
						<input type="hidden" id="pelanggan_sel" name="pelanggan_sel" readonly style="background:#FFF;">
						<input type="hidden" id="kota_tujuan" name="kota_tujuan" readonly style="background:#FFF;">
						<button onclick="show_pop_pelanggan();" type="button" class="btn">Cari</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="span3">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Divisi </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="unit_txt" name="unit_txt" readonly style="background:#FFF; width: 90%" value="<?=$user->NAMA_UNIT;?>">
						<input type="hidden" id="unit" name="unit" value="<?=$user->UNIT;?>">
					</div>
				</div>
			</div>
		</div>

	


	</div>
</div>

<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span6">
		<div class="control-group" style="margin-left: 10px;">
			<button style="margin-bottom: 15px;margin-right: 10px;" onclick="input_from(this, 'Manual');" type="button" class="btn_from btn btn-default btn_from_selected">Pembelian Solar</button>
			<a href="<?php echo base_url(); ?>purchase_order_c/new_invoice_umum"><button style="margin-bottom: 15px;"  type="button" class="btn_from btn btn-default">Pembelian Umum</button></a>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. Transaksi </b> </label>
			<div class="controls">
				<input type="text" class="span11" value="<?=$no_transaksi;?>" name="no_trx" id="no_trx" style="font-size: 15px;" readonly>
				<input type="hidden" class="span8" value="<?=$no_transaksi;?>" name="no_trx2" id="no_trx2">
				<input type="hidden" class="span8" value="<?=$no_bukti_real2;?>" name="no_do" id="no_trx2">
			</div>
		</div>

		<!-- <div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Kode SH </b> </label>
			<div class="controls">
				<input type="text" class="span11" value="" name="kode_sh" style="font-size: 15px;">
			</div>
		</div> -->

		

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Tanggal Transaksi </b> </label>
				<div class="controls">
					<div id="datetimepicker1" class="input-append date ">
						<input readonly style="width: 80%;" value="<?=date('d-m-Y');?>" required name="tgl_trx" data-format="dd-MM-yyyy" type="text">
						<span class="add-on ">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Jatuh Tempo </b> </label>
			<label class="control-label" style="margin-top: 5px;margin-bottom: 10px;"> <input type="radio" name="jt_status" > <b style="font-size: 14px;"> Tanggal Terima Barang </b> </label>
			<label class="control-label" style="margin-top: 5px;margin-bottom: 10px;"> <input type="radio" name="jt_status" > <b style="font-size: 14px;"> Tanggal Terima Invoice </b> </label>
				<div class="controls">
					<div id="datetimepicker1" class="input-append date ">
						<input type="text" name="hari_tempo" style="width: 10%;margin-right: 5px;" onkeyup="jam_dinding(this.value);">
						<input style="width: 68%;" value="" id="jam_dinding_jadi" name="jatuh_tempo" type="text">
						<input style="width: 68%;" value="<?=date('Y-m-d');?>" name="jatuh_tempo" type="hidden" id="jam_dinding_val">
						<span class="add-on ">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Keterangan </b> </label>
				<div class="controls">
					<textarea rows="4" id="memo_lunas" name="memo_lunas" style="resize:none; height: 87px; width: 85%;"></textarea>
				</div>
		</div> 

	</div>

</div>


<!-- <div class="row-fluid" style="background: #F5EADA; ">
	<div class="span6" style="margin-left: 10px;">
		<div class="control-group">
		    <label class="control-label"> <b style="font-size: 14px;"> Supply Point </b> </label>
			<div class="controls">
				<select class="span11" name="supply_point" onchange="get_supply_point(this.value);">
						<option>--Supply Point--</option>
						<?php 
							foreach ($supply as $key => $sp) {
							
						?>
						<option value="<?=$sp->ID;?>"><?=$sp->NAMA;?></option>
						<?php } ?>
					</select>
			</div>
		</div>
		<div class="control-group">
		    <table class="stat-table table table-hover" style="width: 92%;">
		    	<thead>
		    		<th align="center">Nama</th>
		    		<th align="center">Pajak (%)</th>
		    		<th align="center">Aksi</th>
		    	</thead>
		    	<tbody id="data_supply">
		    		
		    	</tbody>
		    </table>
		</div>
	</div>
</div> -->

<div class="row-fluid" style="background: #F5EADA; ">
	<div class="span6" style="margin-left: 10px;">
		<div class="control-group">
		    <label class="control-label"> <b style="font-size: 14px;"> Customer </b> </label>
			<div class="controls">
				<div class="input-append">
						<input type="text" id="pelanggan_cust" name="pelanggan_cust" readonly style="background:#FFF; width: 70%;">
						<input type="hidden" id="alamat_tagih_cust" name="alamat_tagih_cust" readonly style="background:#FFF; width: 70%;">
						<input type="hidden" id="kode_sh_cust" name="kode_sh_cust" readonly style="background:#FFF; width: 70%;">
						<input type="hidden" id="aksi_on" name="aksi_on" readonly style="background:#FFF; width: 70%;">
						
						<button onclick="show_pop_customer();" type="button" class="btn">Cari</button>
					</div>
			</div>
		</div>
	</div>
</div>


<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head orange">
				<h3> </h3>
			</div>
			<div class="widget-container">
				<button data-toggle="modal" data-target="#modal_spek" type="button" class="btn btn-warning" style="display: none;"> 
					<i class="icon-plus"></i> Spesifikasi 
				</button>
				<br><br>
				<table class="stat-table table table-hover">
					<thead>
						<tr>
							
							<th align="center" style="width: 20%;"> Refrensi SO </th>
							<th align="center"> No SH </th>
							<th align="center"> Produk / Item </th>
							<th align="center"> Qty </th>
							<th align="center"> Harga Satuan </th>
							<th align="center"> Jumlah </th>
							<th align="center"> # </th>
						</tr>
					</thead>
					<tbody id="tes">
						<tr id="tr_1" class="tr_utama">
							

							<td style="vertical-align:middle;"> 

								<div class="control-group">
									<div class="controls">
										<div class="input-append">
											<input type="text" id="nomor_so_1" name="nomor_so[]" readonly style="background:#FFF; width: 60%;">
											<button style="width: 30%;" onclick="show_pop_produk(1);" type="button" class="btn">Cari</button>
										</div>
									</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input type="text" name="kode_sh_so[]" value="" id="kode_sh_1">
								</div>
							</td>

							<td style="vertical-align:middle;"> 

								<div class="control-group">
									<div class="controls">
										<div class="input-append">
											<input type="text" id="nama_produk_1" name="nama_produk[]" readonly style="background:#FFF; width: 60%;">
											<input type="hidden" id="id_produk_1" name="produk[]" readonly style="background:#FFF;">
											<input type="hidden" id="jenis_produk_1" name="jenis_produk[]" readonly style="background:#FFF;" value="">
											<button style="width: 30%;" onclick="show_pop_barang(1);" type="button" class="btn">Cari</button>
											
										</div>
									</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input onkeyup="FormatCurrency(this); always_one(1); hitung_total(1);disc_txt();" onchange="" id="qty_1" style="font-size: 18px; text-align:center; width: 80%;" type="text"  value="" name="qty[]">
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input onkeyup="FormatCurrency(this); hitung_total(1);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="harga_modal[]" id="harga_modal_1">
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input required onkeyup="FormatCurrency(this);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="harga_invoice[]" id="harga_invoice_1">
									<input type="hidden" name="jml_harga[]" id="jml_harga_1">
									
								</div>
							</td>


							<td style='background:#FFF; text-align:center; vertical-align: middle;'> 
								<button  style="width: 100%;" onclick="hapus_row_pertama();" type="button" class="btn btn-danger"> Hapus </button>
							</td>
						</tr>
					</tbody>
				</table>

				<button style="margin-bottom: 15px;" onclick="tambah_data();hitung_total_semua();" type="button" class="btn btn-info"><i class="icon-plus"></i> Tambah Baris Data </button>

			</div>
		</div>
	</div>
</div>

<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head orange">
				<h3> </h3>
			</div>
			<div class="widget-container">

				<div class="row-fluid" style="margin-top: 10px; display: none;">
					<div style="margin-bottom: 15px;" class="span3">
						<h3> Total :</h3> 
					</div>

					<div style="margin-bottom: 15px;" class="span4">
						<h3 id="total_txt" style="color:green;"> Rp. 0.00 </h3> 
					</div>
				</div>

				

				<div class="form-actions">
					<center>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> Sub Total :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="subtotal_h">Rp</h3>
							<input type="hidden" name="subtotal_txt" id="inp_sub_total">
							<input type="hidden" name="qty_total" id="inp_qty_total">
						</div>
					</div>

					<!-- <div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> Discount :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<div class="input-append">
							<input type="text" name="discount" id="discount" onkeyup="disc_txt(this.value);">
							<span class="add-on">%</span>
						</div>
						</div>
					</div> -->

					

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> <input type="checkbox" name="pbbkb" checked="checked" value="ada" id="pajak_pbbkb_ck" onchange="pajak_pbbkb(this.value);hitung_total_pajak();harga_final();"> PBBKB :</h3> 

						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pbbkb"></h3>
							<input type="hidden" name="penampung_pbbkb" id="penampung_pbbkb" value="0">
							
							<input type="hidden" name="pajak_pbbkb_validasi" id="pajak_pbbkb_validasi">
							<input type="hidden" name="total_pbbkb_text" id="total_pbbkb_text">
						</div>
					</div>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> <input type="checkbox" name="ppn" checked="checked" value="ada" id="pajak_ppn_ck" onchange="pajak_ppn(this.value);hitung_total_pajak();harga_final();"> PPN :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_ppn"></h3>
							<input type="hidden" name="penampung_ppn" id="penampung_ppn" value="0">
							<input type="hidden" name="pajak_ppn_validasi" id="pajak_ppn_validasi">
							<input type="hidden" name="total_ppn_text" id="total_ppn_text">
						</div>
					</div>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3><input type="checkbox" name="pph_15" checked="checked" value="ada" id="pajak_pph_15_ck" onchange="pajak_pph_15(this.value);hitung_total_pajak();harga_final();"> PPH 15 :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pph_15"></h3>
							<input type="hidden" name="penampung_pph_15" id="penampung_pph_15" value="0">
							<input type="hidden" name="pajak_pph_15_validasi" id="pajak_pph_15_validasi">
							<input type="hidden" name="total_pph_15_text" id="total_pph_15_text">
						</div>
					</div>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3><input type="checkbox" name="pph_21" checked="checked" value="ada" id="pajak_pph_21_ck" onchange="pajak_pph_21(this.value);hitung_total_pajak();harga_final();"> PPH 21 :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pph_21"></h3>
							<input type="hidden" name="penampung_pph_21" id="penampung_pph_21" value="0">
							<input type="hidden" name="pajak_pph_21_validasi" id="pajak_pph_21_validasi">
							<input type="hidden" name="total_pph_21_text" id="total_pph_21_text">
						</div>
					</div>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3><input type="checkbox" name="pph_22" checked="checked" value="ada" id="pajak_pph_22_ck" onchange="pajak_pph_22(this.value);hitung_total_pajak();harga_final();"> PPH 22 :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pph_22"></h3>
							<input type="hidden" name="penampung_pph_22" id="penampung_pph_22" value="0">
							<input type="hidden" name="pajak_pph_22_validasi" id="pajak_pph_22_validasi">
							<input type="hidden" name="total_pph_22_text" id="total_pph_22_text">
						</div>
					</div>

					

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> <input type="checkbox" name="pph_23" checked="checked" value="ada" style="" id="pajak_pph_23_ck" onchange="pajak_pph_23(this.value);hitung_total_pajak();harga_final();"> PPH 23 :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pph_23"></h3>
							<input type="hidden" name="penampung_pph_23" id="penampung_pph_23" value="0">
							<input type="hidden" name="pajak_pph_23_validasi" id="pajak_pph_23_validasi">
							<input type="hidden" name="total_pph_23_text" id="total_pph_23_text">
						</div>
					</div>

					<!-- <div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> OAT :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="oat"></h3>
						</div>
					</div> -->

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> Total :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="tot_disc"></h3>
							<input type="hidden" name="tot_disc" id="tot_disc_txt">
							<input type="hidden" name="tot_semua_pajak" id="total_semua_pajak">
							<input type="hidden" name="penampung_total" id="penampung_total">
							<input type="hidden" name="total_hasil_pajak" id="total_hasil_pajak">
						</div>
					</div>
					<input type="hidden" name="sts_lunas" id="sts_lunas" value="1" />

					<input type="submit" value="Simpan Pembelian" name="simpan" class="btn btn-success">
					<button class="btn" onclick="window.location='<?=base_url();?>purchase_order_c' " type="button"> Batal dan Kembali </button>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Detail -->


</form>




<script type="text/javascript">

function disc_txt(){
	var sub_total = $('#inp_sub_total').val();
	var harga_modal = $('#harga_modal_1').val();
	var qty = $('#qty_1').val();

	harga_modal   = harga_modal.split(',').join('');
	qty   = qty.split(',').join('');

	var jml_pajak = $('#pajak_pbbkb_validasi').val();
	var jml_pajak_ppn = $('#pajak_ppn_validasi').val();
	var jml_pajak_pph_23 = $('#pajak_pph_23_validasi').val();
	var jml_pajak_pph_15 = $('#pajak_pph_15_validasi').val();
	var jml_pajak_pph_21 = $('#pajak_pph_21_validasi').val();
	var jml_pajak_pph_22 = $('#pajak_pph_22_validasi').val();

	// var total = parseFloat(disc/100) * parseFloat(sub_total);
	// var total_diskon = sub_total - (parseFloat(disc/100) * parseFloat(sub_total));
	var sub_total_satuan = sub_total / qty;

	var total_pbbkb = (jml_pajak/100) * sub_total_satuan ;
	var koma_pbbkb = total_pbbkb.toFixed(2);
	var semua_pbbkb = koma_pbbkb * qty;


	var total_ppn = (jml_pajak_ppn/100) * sub_total_satuan ;
	var semua_ppn = total_ppn * qty;

	var total_pph_23 = (jml_pajak_pph_23/100) * sub_total_satuan ;
	var koma_pph_23 = total_pph_23.toFixed(2);
	var semua_pph_23 = koma_pph_23 * qty;

	var total_pph_15 = (jml_pajak_pph_15/100) * sub_total_satuan ;
	var koma_pph_15 = total_pph_15.toFixed(2);
	var semua_pph_15 = koma_pph_15 * qty;

	var total_pph_21 = (jml_pajak_pph_21/100) * sub_total_satuan ;
	var koma_pph_21 = total_pph_21.toFixed(2);
	var semua_pph_21 = koma_pph_21 * qty;

	var total_pph_22 = (jml_pajak_pph_22/100) * sub_total_satuan ;
	var koma_pph_22 = total_pph_22.toFixed(2);
	var semua_pph_22 = koma_pph_22 * qty;

	
	var total_kabeh = parseFloat(sub_total) + parseFloat(semua_pbbkb) + parseFloat(semua_ppn) + parseFloat(semua_pph_23) + parseFloat(semua_pph_15) + parseFloat(semua_pph_21) + parseFloat(semua_pph_22);


	$('#total_pbbkb').html('Rp. '+acc_format(semua_pbbkb, "").split('.00').join('') );
	$('#total_ppn').html('Rp. '+acc_format(semua_ppn, "").split('.00').join('') );
	$('#total_pph_23').html('Rp. '+acc_format(semua_pph_23, "").split('.00').join('') );
	$('#total_pph_15').html('Rp. '+acc_format(semua_pph_15, "").split('.00').join('') );
	$('#total_pph_21').html('Rp. '+acc_format(semua_pph_21, "").split('.00').join('') );
	$('#total_pph_22').html('Rp. '+acc_format(semua_pph_22, "").split('.00').join('') );
	$('#tot_disc').html('Rp. '+acc_format(total_kabeh, "").split('.00').join('') );



	$('#total_pbbkb_text').val(semua_pbbkb);
	$('#total_ppn_text').val(semua_ppn);
	$('#total_pph_23_text').val(semua_pph_23);
	$('#total_pph_15_text').val(semua_pph_15);
	$('#total_pph_21_text').val(semua_pph_21);
	$('#total_pph_22_text').val(semua_pph_22);

	$('#penampung_pbbkb').val(semua_pbbkb);
	$('#penampung_ppn').val(semua_ppn);
	$('#penampung_pph_23').val(semua_pph_23);
	$('#penampung_pph_15').val(semua_pph_15);
	$('#penampung_pph_21').val(semua_pph_21);
	$('#penampung_pph_22').val(semua_pph_22);

	$('#tot_disc_txt').val(sub_total);
	$('#total_semua_pajak').val(sub_total);



}

function pajak_pbbkb(){
	var sub_total = $('#total_semua_pajak').val();
	var pajak_pbbkb = $('#total_pbbkb_text').val();
	var checkBox = document.getElementById("pajak_pbbkb_ck");

	if(checkBox.checked == true){
		// var total = parseFloat(sub_total) + parseFloat(pajak_pbbkb);
		// $('#total_semua_pajak').val(total);
		$('#total_pbbkb').html('Rp. '+acc_format(parseFloat(pajak_pbbkb), "").split('.00').join('') );
		$('#penampung_pbbkb').val(pajak_pbbkb);
	}else if(checkBox.checked == false){
		$('#penampung_pbbkb').val('0');
		$('#total_pbbkb').html('Rp. '+acc_format(0, "").split('.00').join('') );

	}

}



function pajak_ppn(){
	var sub_total = $('#total_semua_pajak').val();
	var pajak_ppn = $('#total_ppn_text').val();
	var checkBox = document.getElementById("pajak_ppn_ck");

	if(checkBox.checked == true){
		// var total = parseFloat(sub_total) + parseFloat(pajak_ppn);
		// $('#total_semua_pajak').val(total);
		$('#total_ppn').html('Rp. '+acc_format(parseFloat(pajak_ppn), "").split('.00').join('') );
		$('#penampung_ppn').val(pajak_ppn);
	}else if(checkBox.checked == false){
		$('#penampung_ppn').val('0');
		$('#total_ppn').html('Rp. '+acc_format(0, "").split('.00').join('') );
	}

}

function pajak_pph_21(){
	var sub_total = $('#total_semua_pajak').val();
	var pajak_pph_21 = $('#total_pph_21_text').val();
	var checkBox = document.getElementById("pajak_pph_21_ck");

	if(checkBox.checked == true){
		// var total = parseFloat(sub_total) + parseFloat(pajak_pph_21);
		// $('#total_semua_pajak').val(total);
		$('#total_pph_21').html('Rp. '+acc_format(parseFloat(pajak_pph_21), "").split('.00').join('') );
		$('#penampung_pph_21').val(pajak_pph_21);
	}else if(checkBox.checked == false){
		$('#penampung_pph_21').val('0');
		$('#total_pph_21').html('Rp. '+acc_format(0, "").split('.00').join('') );
	}

}

function pajak_pph_15(){
	var sub_total = $('#total_semua_pajak').val();
	var pajak_pph_15 = $('#total_pph_15_text').val();
	var checkBox = document.getElementById("pajak_pph_15_ck");

	if(checkBox.checked == true){
		// var total = parseFloat(sub_total) + parseFloat(pajak_pph_15);
		// $('#total_semua_pajak').val(total);
		$('#total_pph_15').html('Rp. '+acc_format(parseFloat(pajak_pph_15), "").split('.00').join('') );
		$('#penampung_pph_15').val(pajak_pph_15);
	}else if(checkBox.checked == false){
		$('#penampung_pph_15').val('0');
		$('#total_pph_15').html('Rp. '+acc_format(0, "").split('.00').join('') );
	}

}

function pajak_pph_23(){
	var sub_total = $('#total_semua_pajak').val();
	var pajak_pph_23 = $('#total_pph_23_text').val();
	var checkBox = document.getElementById("pajak_pph_23_ck");

	if(checkBox.checked == true){
		// var total = parseFloat(sub_total) + parseFloat(pajak_pph_23);
		// $('#total_semua_pajak').val(total);
		$('#total_pph_23').html('Rp. '+acc_format(parseFloat(pajak_pph_23), "").split('.00').join('') );
		$('#penampung_pph_23').val(pajak_pph_23);
	}else if(checkBox.checked == false){
		$('#penampung_pph_23').val('0');
		$('#total_pph_23').html('Rp. '+acc_format(0, "").split('.00').join('') );
	}

}

function pajak_pph_22(){
	var sub_total = $('#total_semua_pajak').val();
	var pajak_pph_22 = $('#total_pph_22_text').val();
	var checkBox = document.getElementById("pajak_pph_22_ck");

	if(checkBox.checked == true){
		// var total = parseFloat(sub_total) + parseFloat(pajak_pph_22);
		// $('#total_semua_pajak').val(total);
		$('#total_pph_22').html('Rp. '+acc_format(parseFloat(pajak_pph_22), "").split('.00').join('') );
		$('#penampung_pph_22').val(pajak_pph_22);
	}else if(checkBox.checked == false){
		$('#penampung_pph_22').val('0');
		$('#total_pph_22').html('Rp. '+acc_format(0, "").split('.00').join('') );
	}

}

function hitung_total_pajak(){
	var pajak_pbbkb = $('#penampung_pbbkb').val();
	var pajak_ppn = $('#penampung_ppn').val();
	var pajak_pph_21 = $('#penampung_pph_21').val();
	var pajak_pph_15 = $('#penampung_pph_15').val();
	var pajak_pph_23 = $('#penampung_pph_23').val();
	var pajak_pph_22 = $('#penampung_pph_22').val();

	var total = parseFloat(pajak_pbbkb) + parseFloat(pajak_ppn) + parseFloat(pajak_pph_21) + parseFloat(pajak_pph_15) + parseFloat(pajak_pph_23) + parseFloat(pajak_pph_22); 


	$('#penampung_total').val(total);


	// var sub_total = $('#inp_sub_total').val();

	// var total_semua = parsefloat(sub_total) + parsefloat(total);

	// $('#total_semua_pajak').val(total);

}

function harga_final(){
	var total_semua_pajak = $('#inp_sub_total').val();
	var penampung_total = $('#penampung_total').val();

	var martis = parseInt(total_semua_pajak) + parseInt(penampung_total);
	

	$('#tot_disc').html('Rp. '+acc_format(martis, "").split('.00').join('') );
	$('#total_hasil_pajak').val(martis);

	
}

function hapus_row_pertama(){
	$('#nama_produk_1').val('');
	$('#id_produk_1').val('');
	$('#qty_1').val('');
	$('#satuan_1').val('');
	$('#harga_satuan_1').val('');
	$('#jumlah_1').val('');
}

function simpan_add_produk(){
	var kode_produk = $('#kode_produk_add').val();
	var nama_produk = $('#nama_produk_add').val();
	var satuan 		= $('#satuan_add').val();
	var deskripsi   = $('#deskripsi_add').val();
	var harga       = $('#harga_satuan_add').val();

	if(kode_produk == ""){
		alert("Kode Produk Harus di isi.");
	} else if(nama_produk == ""){
		alert("Nama Produk Harus di isi.");
	} else if(satuan == ""){
		alert("Satuan Produk Harus di isi.");
	} else if(harga == ""){
		alert("Harga Produk Harus di isi.");
	} else {
		$.ajax({
			url : '<?php echo base_url(); ?>transaksi_penjualan_c/simpan_add_produk',
			data : {
				kode_produk:kode_produk,
				nama_produk:nama_produk,
				satuan:satuan,
				deskripsi:deskripsi,
				harga:harga,
			},
			type : "POST",
			dataType : "json",
			success : function(result){
				$('#tutup_add_produk').click();
				$.gritter.add({
		            title: 'Notifikasi',
		            position: 'bottom-right',
		            text: 'Data Produk berhasil terimpan.'
		        });
		        return false;
			}
		});
	}

}

function show_pop_produk(no){
	get_popup_produk();
    ajax_produk(no);
}

function show_pop_barang(no){
	get_popup_barang();
    ajax_barang(no);
}

function get_popup_barang(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari Produk...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th> KODE PRODUK </th>'+
                '                        <th style="white-space:nowrap;"> NAMA PRODUK </th>'+
                '                        <th> HARGA </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
        $('#popup_koang').remove();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function get_popup_produk(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari Produk...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th> NO SO </th>'+
                '                        <th style="white-space:nowrap;"> Tanggal Transaksi </th>'+
                '                        <th> CUSTOMER </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
        $('#popup_koang').remove();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_produk(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>purchase_order_c/get_produk_popup',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;
                nama_pel = res.STOK+" "+res.SATUAN;
                if(res.TIPE == "JASA"){
                	nama_pel = "UNLIMITED";
                }



                isine += '<tr onclick="get_produk_detail(\'' +res.ID+ '\',\'' +id_form+ '\',\'' +res.NO_BUKTI+ '\');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.NO_BUKTI+'</td>'+
                            '<td align="left">'+res.TGL_TRX+'</td>'+
                             '<td align="center">'+res.PELANGGAN+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='5' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_produk(id_form);
            });
        }
    });
}

function ajax_barang(id_form){
   var keyword = $('#search_koang_pro').val();
   var kode = $('#kode_sh_1').val();
    $.ajax({
        url : '<?php echo base_url(); ?>purchase_order_c/get_produk_popup_po',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
            kode : kode,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;
               



                isine += '<tr onclick="get_barang_detail(\'' +res.HARGA_BELI+ '\',\'' +res.ID+ '\',\'' +res.NAMA_PRODUK+ '\');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.KODE_PRODUK+'</td>'+
                            '<td align="left">'+res.NAMA_PRODUK+'</td>'+
                             '<td align="center">Rp '+NumberToMoney(res.HARGA_BELI).split('.00').join('')+'</td>'+
                        '</tr>';
                        
                $('input[name="nama_produk[]"]').val(res.NAMA_PRODUK);
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='5' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 

            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_produk(id_form);
            });

        }
    });
}

function show_pop_pelanggan(id){
	$('#popup_koang').remove();
    get_popup_pelanggan();
    ajax_pelanggan();
}

function show_pop_customer(id){
	$('#popup_koang').remove();
    get_popup_customer();
    ajax_customer();
}

function get_popup_pelanggan(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Supplier...">'+
                '    <div class="table-responsive" style="max-height: 500px; overflow-y: scroll;">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap;"> NAMA SUPPLIER / PERUSAHAAN </th>'+
                '                        <th> ALAMAT </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function get_popup_customer(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Supplier...">'+
                '    <div class="table-responsive" style="max-height: 500px; overflow-y: scroll;">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap;"> NAMA CUSTOMER / PERUSAHAAN </th>'+
                '                        <th> KODE SH </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_pelanggan(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>transaksi_pembelian_c/get_pelanggan_popup',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;
                nama_pel = res.NAMA_SUPPLIER;
                if(res.TIPE == "Perusahaan"){
                	nama_pel = res.NAMA_SUPPLIER+" <b> ("+res.NAMA_USAHA+")</b>";
                }

                isine += '<tr onclick="get_supplier_detail('+res.ID+');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+nama_pel+'</td>'+
                            '<td align="center">'+res.ALAMAT_TAGIH+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='5' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_pelanggan();
            });
        }
    });
}

function ajax_customer(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>purchase_order_c/get_pelanggan_popup',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;
                nama_pel = res.NAMA_SUPPLIER;
                if(res.TIPE == "Perusahaan"){
                	nama_pel = res.NAMA_SUPPLIER+" <b> ("+res.NAMA_USAHA+")</b>";
                }

                isine += '<tr onclick="get_customer_detail('+res.ID+');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.NAMA_PELANGGAN+'</td>'+
                            '<td align="center">'+res.KODE_PELANGGAN+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='5' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_pelanggan();
            });
        }
    });
}

function get_supplier_detail(id_pel){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>transaksi_pembelian_c/get_supplier_detail',
		data : {id_pel:id_pel},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			// $('#alamat_tagih').val(result.ALAMAT_TAGIH);
			$('#pelanggan').val(result.NAMA_USAHA);
			$('#kota_tujuan').val(result.KOTA);
			$('#pelanggan_sel').val(id_pel);

			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		}
	});
}

function get_customer_detail(id_pel){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>purchase_order_c/get_supplier_detail',
		data : {id_pel:id_pel},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			// $('#alamat_tagih').val(result.ALAMAT_TAGIH);
			$('#kode_sh_1').val(result.KODE_PELANGGAN);
			$('#harga_modal_1').val(result.HARGA_CUY);
			$('#pelanggan_cust').val(result.NAMA_PELANGGAN);
			$('#alamat_tagih_cust').val(result.ALAMAT_TAGIH);
			$('#kode_sh_cust').val(result.KODE_PELANGGAN);
			$('#pajak_pbbkb_validasi').val(result.PAJAK_PBBKB);
			$('#pajak_ppn_validasi').val(result.PPN);
			$('#pajak_pph_23_validasi').val(result.PPH23);
			$('#pajak_pph_15_validasi').val(result.PPH15);
			$('#pajak_pph_21_validasi').val(result.PPH_21);
			$('#pajak_pph_22_validasi').val(result.PPH_22);
			$('#aksi_on').val(result.ID_SUPPLY_POINT);

			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		}
	});
}



function cek_islunas(){
	if($("#is_lunas").is(':checked')){
	    $('#piutang_row').hide(); 
	    $('#sts_lunas').val(1); 
	} else {
	    $('#piutang_row').show(); 
	    $('#sts_lunas').val(0); 
	}
}

function hitung_total(id){


	var qty           = $('#qty_'+id).val();
	var harga_modal   = $('#harga_modal_'+id).val();

	qty           = qty.split(',').join('');
	harga_modal   = harga_modal.split(',').join('');

	if(qty           == "" || qty 	        == null){ qty           = 0; }
	if(harga_modal   == "" || harga_modal   == null){ harga_modal   = 0; }


	var profit = parseFloat(harga_modal) * parseFloat(qty) ;
	$('#harga_invoice_'+id).val('Rp. '+acc_format(profit, ""));
	$('#harga_invoice2_'+id).val(profit);
	$('#jml_harga_'+id).val(profit);

	hitung_total_semua();
}

function get_produk_detail(id, no_form,nomor_so){
    var id_produk = id;
    $.ajax({
		url : '<?php echo base_url(); ?>purchase_order_c/get_produk_detail',
		data : {id_produk:id_produk},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#qty_'+no_form).val(result.QTY);
			$('#harga_modal_'+no_form).val(result.HARGA_BELI);
			$('#nomor_so_'+no_form).val(nomor_so);
			$('#harga_invoice_'+no_form).val(result.TOTAL);
			$('#id_produk_'+no_form).val(id_produk);
			$('#nama_produk_'+no_form).val(result.NAMA_PRODUK);
			$('#kode_sh_'+no_form).val(result.KODE_PELANGGAN);



			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		    $('#popup_koang').remove();

		    
		}
	});

	hitung_total_semua();

}

// form_direk(){
// 	window.location.href = "<?php echo base_url(); ?>purchase_order_c/new_invoice_umum";
// }

function get_barang_detail(harga,id,nama_produk){
    $('#nama_produk_1').val(nama_produk);
    $('#id_produk_1').val(id);
    $('#harga_modal_1').val(harga);

    $('#search_koang_pro').val("");
    $('#popup_koang').css('display','none');
    $('#popup_koang').hide();
    $('#popup_koang').remove();

}

function always_one(id){


	// var max = parseInt($('#qty_max_'+id).val());
	// if(a > max){
	// 	$('#qty_'+id).val(max);
	// }
}

function tambah_data() {
	var value =$('#copy_select').html();
	var jml_tr = $('#tr_utama_count').val();
	var i = parseInt(jml_tr) + 1;

	var coa = $('#copy_ag').html();

	$isi_1 = 
	'<tr id="tr_'+i+'" class="tr_utama">'+
		'<td class="center" style="vertical-align:middle;" id="td_chos_'+i+'">'+
			'<div class="control-group">'+
				'<div class="controls">'+
					'<div class="input-append">'+
						'<input type="text" id="nomor_so_'+i+'" name="nomor_so[]" readonly style="background:#FFF; width: 60%">'+
						'<input type="hidden" id="id_produk_'+i+'" name="produk[]" readonly style="background:#FFF;">'+
						'<input type="hidden" id="jenis_produk_'+i+'" name="jenis_produk[]" readonly style="background:#FFF;" value="">'+
						'<button style="width: 30%" onclick="show_pop_produk('+i+');" type="button" class="btn">Cari</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</td>'+
		'<td align="center" style="vertical-align:middle;">'+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this); always_one('+i+');" onchange="" id="kode_sh_'+i+'" style="font-size: 18px; text-align:center; width: 80%;" type="text"  value="" name="kode_sh[]">'+
			'</div>'+
		'</td>'+
		'<td class="center" style="vertical-align:middle;" id="td_chos_'+i+'">'+
			'<div class="control-group">'+
				'<div class="controls">'+
					'<div class="input-append">'+
						'<input type="text" id="nama_produk_'+i+'" name="nama_produk[]" readonly style="background:#FFF; width: 60%">'+
						'<input type="hidden" id="id_produk_'+i+'" name="produk[]" readonly style="background:#FFF;">'+
						'<input type="hidden" id="jenis_produk_'+i+'" name="jenis_produk[]" readonly style="background:#FFF;" value="">'+
						'<button style="width: 30%;" onclick="show_pop_barang('+i+');" type="button" class="btn">Cari</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</td>'+
		'<td align="center" style="vertical-align:middle;">'+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this); always_one('+i+'); hitung_total('+i+');" onchange="" id="qty_'+i+'" style="font-size: 18px; text-align:center; width: 80%;" type="text"  value="" name="qty[]">'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this); hitung_total('+i+');" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="harga_modal[]" id="harga_modal_'+i+'">'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input required onkeyup="FormatCurrency(this);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="harga_invoice[]" id="harga_invoice_'+i+'">'+
				'<input type="hidden" name="jml_harga[]" id="jml_harga_'+i+'">'+
			'</div>'+
		'</td>'+

		'<td class="center" style="background:#FFF; text-align:center;">'+
			'<button style="width: 100%;" onclick="hapus_row('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
		'</td>'+
	'</tr>';

	$('#tes').append($isi_1);
	$('#tr_'+i).find('.cek_select').attr('class', 'cek_select_'+i);
	$('#tr_utama_count').val(i);
	$(".cek_select_"+i).chosen();

}
function tambah_data2() {
	
	var jml_tr = $('#tr_utama_count2').val();
	var i = parseInt(jml_tr) + 1;

	

	$isi_1 = 
	'<tr id="tr2_'+i+'" class="tr_utama">'+
		
		
		'<td align="center" style="vertical-align:middle;">'+
			'<div class="controls">'+
				'<label>'+i+'</label>'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input type="text" name="data_cust[]" class="span12">'+
			'</div>'+
		'</td>'+

		'<td class="center" style="background:#FFF; text-align:center;">'+
			'<button style="width: 100%;" onclick="hapus_row1('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
		'</td>'+
	'</tr>';

	$('#data_cust').append($isi_1);
	$('#tr_utama_count2').val(i);

}


function get_pelanggan_det(id_pel){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_pelanggan_detail',
		data : {id_pel:id_pel},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();

			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		    $('#popup_koang').remove();

			$('#alamat_tagih').val(result.ALAMAT_TAGIH);
			$('#pelanggan').val(result.NAMA_PELANGGAN);
			$('#kota_tujuan').val(result.ALAMAT_KIRIM);
			$('#pelanggan_sel').val(id_pel);
		}
	});
}

function hitung_total_semua(){
	var sum = 0;

	var harga_invoice = $('#harga_modal_1').val();
	var qty = $('#qty_1').val();
	var jml_pajak = $('#pajak_pbbkb_validasi').val();
	var jml_pajak_ppn = $('#pajak_ppn_validasi').val();
	var jml_pajak_pph_23 = $('#pajak_pph_23_validasi').val();
	var jml_pajak_pph_15 = $('#pajak_pph_15_validasi').val();
	var jml_pajak_pph_21 = $('#pajak_pph_21_validasi').val();
	var jml_pajak_pph_22 = $('#pajak_pph_22_validasi').val();

	$("input[name='jml_harga[]']").each(function(idx, elm) {
		var tot = elm.value.split(',').join('');
		if(tot > 0){
    		sum += parseFloat(tot);
		}
    });


	harga_invoice           = harga_invoice.split(',').join('');
	qty   					= qty.split(',').join('');

	var jadi = (parseFloat(harga_invoice) / ( 1 + parseFloat(jml_pajak/100) + parseFloat(jml_pajak_ppn/100) + parseFloat(jml_pajak_pph_23/100) + parseFloat(jml_pajak_pph_15/100) + parseFloat(jml_pajak_pph_21/100) + parseFloat(jml_pajak_pph_22/100) ));

	var jadi_total = jadi.toFixed(2);

	var semuanya = jadi_total * qty;

    $('#inp_sub_total').val(semuanya);

    $('#subtotal_h').html('Rp. '+acc_format(semuanya, ""));
}

function hitung_pajak(id_pajak){
	$('#popup_load').show();
	if(id_pajak > 0){
		$.ajax({
			url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_pajak_prosen',
			data : {id_pajak:id_pajak},
			type : "GET",
			dataType : "json",
			success : function(result){
				$('#pajak_prosen').val(result.PROSEN);
				$('#kode_akun_pajak').val(result.PAJAK_PENJUALAN);
				hitung_total_semua();
				$('#popup_load').hide();
			}
		});
	} else {
		$('#pajak_prosen').val(0);
		$('#kode_akun_pajak').val('');
		hitung_total_semua();
		$('#popup_load').hide();
	}

	
}

function hapus_row (id) {
	$('#tr_'+id).remove();
	hitung_total_semua();
}

function hapus_row1 (id) {
	$('#tr2_'+id).remove();
}

function acc_format(n, currency) {
	return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}

function get_supply_point(id) {
	
        $.ajax({
            url : '<?php echo base_url(); ?>purchase_order_c/get_supply_point',
            data : {id:id},
            type : "POST",
            dataType : "json",
            success : function(result){   
                var isine = "";
                if(result.length > 0){
                    $.each(result,function(i,res){

                        isine += '<tr>'+
                                    '<td style="text-align:center;">'+res.NAMA_BPPKB+'</td>'+
                                    '<td style="text-align:center;">'+res.PAJAK+' %</td>'+
                                    '<td style="text-align:center;">'+
                                    	'<input type="radio" value="'+res.ID+'" name="aksi_on_1">'+
                                    '</td>'+
                                '</tr>';
                    });
                } else {
                    isine = "<tr><td colspan='6' style='text-align:center;'> There are no transaction for this data </td></tr>";
                }

                $('#data_supply').html(isine);
            }
        });
    }

   function jam_dinding(id){
   	var dateString = $('#jam_dinding_val').val();

	var startDate = new Date(dateString);

	// seconds * minutes * hours * milliseconds = 1 day 
	var day = (60 * 60 * 24 * 1000) * id;

	var endDate = new Date(startDate.getTime('dd-MM-yyyy')+ day);
	var tgl = endDate.toString("dd-MM-yyyy");
	 $('#jam_dinding_jadi').val(tgl);

   }
</script>