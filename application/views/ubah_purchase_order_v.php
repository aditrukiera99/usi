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
<input id="tr_utama_count_trans" value="1" type="hidden"/>
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
						<input type="text" id="pelanggan" name="pelanggan" value="<?=$dt->PELANGGAN;?>" readonly style="background:#FFF; width: 70%;">
						<!-- <input type="hidden" id="pelanggan_sel" name="pelanggan_sel" readonly style="background:#FFF;">
						<input type="hidden" id="kota_tujuan" name="kota_tujuan" readonly style="background:#FFF;"> -->
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
						<!-- <input type="hidden" id="unit" name="unit" value="<?=$user->UNIT;?>"> -->
					</div>
				</div>
			</div>
		</div>

	


	</div>
</div>

<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span6">
		<div class="control-group" style="margin-left: 10px;">
			<!-- <button style="margin-bottom: 15px;margin-right: 10px;" onclick="input_from(this, 'Manual');" type="button" class="btn_from btn btn-default btn_from_selected">Pembelian Solar</button>
			<a href="<?php echo base_url(); ?>purchase_order_c/new_invoice_umum"><button style="margin-bottom: 15px;"  type="button" class="btn_from btn btn-default">Pembelian Umum</button></a> -->
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. Transaksi </b> </label>
			<div class="controls">
				<input type="text" class="span11" value="<?=$dt->NO_PO;?>" name="no_trx" id="no_trx" style="font-size: 15px;width: 86%;" readonly>
	<!-- 			<input type="hidden" class="span8" value="<?=$no_transaksi;?>" name="no_trx2" id="no_trx2">
				<input type="hidden" class="span8" value="<?=$no_bukti_real2;?>" name="no_do" id="no_trx2"> -->
			</div>
		</div>


		

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Tanggal Transaksi </b> </label>
				<div class="controls">
					<div id="datetimepicker1" class="input-append date ">
						<input style="width: 80%;" value="<?=$dt->TGL_TRX;?>" readonly required name="tgl_trx" data-format="dd-MM-yyyy" type="text">
						<span class="add-on ">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Jatuh Tempo </b> </label>
			<!-- <label class="control-label" style="margin-top: 5px;margin-bottom: 10px;"> <input type="radio" name="jt_status" > <b style="font-size: 14px;"> Tanggal Terima Barang </b> </label>
			<label class="control-label" style="margin-top: 5px;margin-bottom: 10px;"> <input type="radio" name="jt_status" > <b style="font-size: 14px;"> Tanggal Terima Invoice </b> </label> -->
				<div class="controls">
					<div id="datetimepicker1" class="input-append date ">
						<input type="text" name="hari_tempo" value="<?=$dt->JATUH_TEMPO;?>" readonly style="width: 10%;margin-right: 5px;" onkeyup="jam_dinding(this.value);">

						<?php 
							if($dt->PENERIMAAN_STATUS == '1'){
								$date=date_create("$dt->TGL_PENERIMAAN");
								date_add($date,date_interval_create_from_date_string("30 days"));
								echo date_format($date,"Y-m-d");
						?>
						<input readonly style="width: 68%;" value="<?php echo date_format($date,"Y-m-d"); ?>" id="jam_dinding_jadi" name="jatuh_tempo" type="text">
						<?php 
							}else if($dt->TGL_INVOICE != '' && $dt->PENERIMAAN_STATUS == '1'){
								$date_2=date_create("$dt->TGL_INVOICE");
								date_add($date_2,date_interval_create_from_date_string("33 days"));
								echo date_format($date_2,"Y-m-d");
						?>
							<input readonly style="width: 68%;" value="<?php echo date_format($date_2,"Y-m-d");?>" id="jam_dinding_jadi" name="jatuh_tempo" type="text">
						<?php } ?>
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
					<textarea rows="4" readonly id="memo_lunas" name="memo_lunas" style="resize:none; height: 87px; width: 85%;"><?=$dt->MEMO;?></textarea>
				</div>
		</div> 

	</div>

	<!-- <div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Transportir </b> </label>
				<div class="controls" >
					<table id="transpor_data">
						<tr>
							<td>
								<select name="transportir[]" id="trans_1" class="span12">
									<?php 
										foreach ($trans as $key => $value_t) {
											?>
												<option value="<?=$value_t->ID;?>"><?=$value_t->NAMA;?></option>
											<?php
										}
									?>
								</select>
							</td>
							<td></td>
						</tr>
					</table>
					
					<br>
					<button class="btn btn-info" name="transpor" type="button" id="transpor" onclick="tambah_trans();">TAMBAH DATA</button>
				</div>
		</div>

	</div> -->

</div>

<div class="row-fluid" style="background: #F5EADA; ">
	<div class="span6" style="margin-left: 10px;">
		<div class="control-group">
		    <label class="control-label"> <b style="font-size: 14px;"> Customer </b> </label>
			<div class="controls">
				<div class="input-append">
						<input type="text" id="pelanggan_cust" value="<?=$dt->NAMA_CUSTOMER;?>" name="pelanggan_cust" readonly style="background:#FFF; width: 70%;" readonly>
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

						<?php 
							$id_dt = $dt->ID;
							$det = $this->db->query("SELECT * FROM ak_pembelian_detail WHERE ID_PENJUALAN = '$id_dt' ")->result();

							foreach ($det as $key => $dt_t) {
								

						?>
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
											<input type="text" readonly id="nama_produk_1" name="nama_produk[]" value="<?=$dt_t->NAMA_PRODUK;?>" readonly style="background:#FFF; width: 60%;">
											<input type="hidden" id="id_produk_1" name="produk[]" readonly style="background:#FFF;">
											<input type="hidden" id="jenis_produk_1" name="jenis_produk[]" readonly style="background:#FFF;" value="">
											<button style="width: 30%;" onclick="show_pop_barang(1);" type="button" class="btn">Cari</button>
											
										</div>
									</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input onkeyup="FormatCurrency(this); always_one(1); hitung_total(1);disc_txt();" onchange="" id="qty_1" style="font-size: 18px; text-align:center; width: 80%;" type="text"  value="<?=$dt_t->QTY;?>" name="qty[]" readonly>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input onkeyup="FormatCurrency(this); hitung_total(1);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="<?=$dt_t->HARGA_SATUAN;?>" name="harga_modal[]" id="harga_modal_1" readonly>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input required onkeyup="FormatCurrency(this);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="<?php echo number_format($dt_t->HARGA_SATUAN * $dt_t->QTY,2);?>" name="harga_invoice[]" id="harga_invoice_1" readonly>
									<input type="hidden" name="jml_harga[]" id="jml_harga_1" readonly>
									
								</div>
							</td>


							<td style='background:#FFF; text-align:center; vertical-align: middle;'> 
								<button  style="width: 100%;" onclick="hapus_row_pertama();" type="button" class="btn btn-danger"> Hapus </button>
							</td>
						</tr>
					<?php } ?>
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
							<h3 style="color: green;" id="subtotal_h">Rp <?php echo number_format($dt->SUB_TOTAL,2);?></h3>
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
							<h3> <input type="checkbox" name="pbbkb" checked="checked" value="ada" id="pajak_pbbkb_ck" onchange="pajak_pbbkb(this.value);hitung_total_pajak();harga_final();"> PBBKB : </h3> 

						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pbbkb">Rp. <?php echo number_format($dt->PBBKB,2);?></h3>
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
							<h3 style="color: green;" id="total_ppn">Rp. <?php echo number_format($dt->PPN,2);?></h3>
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
							<h3 style="color: green;" id="total_pph_15">Rp. <?php echo number_format($dt->PPH_15,2);?></h3>
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
							<h3 style="color: green;" id="total_pph_21">Rp. <?php echo number_format($dt->PPH_21,2);?></h3>
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
							<h3 style="color: green;" id="total_pph_22">Rp. <?php echo number_format($dt->PPH_22,2);?></h3>
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
							<h3 style="color: green;" id="total_pph_23">Rp. <?php echo number_format($dt->PPH_23,2);?></h3>
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
							<h3 style="color: green;" id="tot_disc">Rp. <?php echo number_format($dt->TOTAL,2);?></h3>
							<input type="hidden" name="tot_disc" id="tot_disc_txt">
							<input type="hidden" name="tot_semua_pajak" id="total_semua_pajak">
							<input type="hidden" name="penampung_total" id="penampung_total">
							<input type="hidden" name="total_hasil_pajak" id="total_hasil_pajak">
						</div>
					</div>
					<input type="hidden" name="sts_lunas" id="sts_lunas" value="1" />

					<!-- <input type="submit" value="Simpan Pembelian" name="simpan" class="btn btn-success"> -->
					<button class="btn" onclick="window.location='<?=base_url();?>purchase_order_c' " type="button"> Kembali </button>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Detail -->


</form>




