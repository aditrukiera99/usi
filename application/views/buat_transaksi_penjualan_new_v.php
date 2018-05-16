<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
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
$no_pembeli = 1;
if($no_pem->NEXT != "" || $no_pem->NEXT != null ){
	$no_pembeli = $no_pem->NEXT+1;
}

$no_lpbe = 1;
if($no_lpb->NEXT != "" || $no_lpb->NEXT != null ){
	$no_lpbe = $no_lpb->NEXT+1;
}

$no_deo = 1;
if($no_do->NEXT != "" || $no_do->NEXT != null ){
	$no_deo = $no_do->NEXT+1;
}

$no_inv = 1;
if($inv->NEXT != "" || $inv->NEXT != null ){
	$no_inv = $inv->NEXT+1;
}

$no_surat_jalan = 1;
if($sj->NEXT != "" || $sj->NEXT != null ){
	$no_surat_jalan = $sj->NEXT+1;
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

$no_bukti_real = str_pad($no_transaksi, 4, '0', STR_PAD_LEFT);

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

#cke_1_top{
	display: none;
}
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
<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-plus"></i>  Buat Penjualan </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Penjualan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li> Edit Penjualan <span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Buat Penjualan Baru </li>
		</ul>
	</div>
</div>

<form action="<?=base_url().$post_url;?>" method="post">

<div class="breadcrumb" style="background:#E0F7FF;">
	<div class="row-fluid">
		<div class="span5">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Pelanggan </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="pelanggan" name="pelanggan" readonly style="background:#FFF; width: 70%;">
						<input type="hidden" id="pelanggan_sel" name="pelanggan_sel" readonly style="background:#FFF;">
						<!-- <input type="hidden" id="kota_tujuan" name="kota_tujuan" readonly style="background:#FFF;"> -->
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
		<!-- <div class="span3">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Supplier </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="supplier" name="supplier" readonly style="background:#FFF; width: 70%;">
						<input type="hidden" id="supplier_sel" name="supplier_sel" readonly style="background:#FFF;">
						
						<button onclick="show_pop_supplier();" type="button" class="btn">Cari</button>
					</div>
				</div>
			</div>
		</div> -->
	</div>
</div>

<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. SO </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="<?=$no_bukti_real;?>" name="no_trx" id="no_trx" style="font-size: 15px;">
				<input type="hidden" class="span8" value="<?=$no_transaksi;?>" name="no_trx2" id="no_trx2">
			</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Alamat Tujuan </b> </label>
				<div class="controls">
					
					<textarea name="alamat_tagih" class="span12" rows="5" id="alamat_tagih"></textarea>
				</div>
	
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Jatuh Tempo </b> </label>
				<div class="controls">
					<div id="" class="input-append date ">
						<input type="text" name="hari_tempo" style="width: 10%;margin-right: 5px;" onkeyup="jam_dinding(this.value);">
						<input style="width: 76%;" value="" id="jam_dinding_jadi" name="jatuh_tempo" type="text">
						<input style="width: 68%;" value="<?=date('Y-m-d');?>" name="jatuh_tempo" type="hidden" id="jam_dinding_val">
						<span class="add-on ">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
		</div>
	</div>


	<div class="span4">
		<!-- <div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. PO </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="<?=$no_pembeli;?>" name="no_po" id="no_po" style="font-size: 15px;">
				<input type="hidden" class="span12" value="<?=$no_lpbe;?>" name="no_lpbe" id="no_lpbe" style="font-size: 15px;">
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
			<label class="control-label"> <b style="font-size: 14px;"> Supply Point</b> </label>
			<div class="controls">
				<input type="text" name="supply_point_tempat" class="span5" id="supply_point_nama">
				<input type="text" name="supply_pajak_tempat" class="span5" id="supply_pajak_nama">
				<input type="text" name="pajak_tempat" class="span1" id="pajak_nama">
			</div>
		</div>

	</div>


	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. PO Pelanggan </b> </label>
			<div class="controls">
				<input type="text" class="span10" value="" name="no_po_pelanggan" id="" style="font-size: 15px;">
			</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Keterangan </b> </label>
				<div class="controls">
					<textarea rows="4" id="memo_lunas" name="memo_lunas" style="resize:none; height: 87px; width: 80%;"></textarea>
				</div>
		</div> 
	</div>

</div>

<!-- <div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	
	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Dikirim Dengan </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="Truck / Kapal" name="dikirim" id="dikirim" style="font-size: 15px;">
			</div>
		</div>
	</div>

	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Segel Atas  </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="" name="segel_atas" id="segel_atas" style="font-size: 15px;">
			</div>
		</div>
	</div>

	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Meter Awal  </b> </label>
			<div class="controls">
				<input type="text" class="span10" value="" name="meter_atas" id="meter_atas" style="font-size: 15px;">
			</div>
		</div>
	</div>

	

</div>

<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	

	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No Kendaraan </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="" name="no_pol" id="no_pol" style="font-size: 15px;">
			</div>
		</div>
	</div>
	

	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Segel Bawah </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="" name="segel_bawah" id="segel_bawah" style="font-size: 15px;">
			</div>
		</div>
	</div>

	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Meter Akhir </b> </label>
			<div class="controls">
				<input type="text" class="span10" value="" name="meter_bawah" id="meter_bawah" style="font-size: 15px;">
			</div>
		</div>
	</div>

	
</div>

<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	

	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Nama Kapal </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="" name="nama_kapal" id="sopir" style="font-size: 15px;">
			</div>
		</div>
	</div>
	
	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Temperatur </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="" name="temperatur" id="dikirim" style="font-size: 15px;">
			</div>
		</div>
	</div>


	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> SG Meter </b> </label>
			<div class="controls">
				<input type="text" class="span10" value="" name="sg_meter" id="dikirim" style="font-size: 15px;">
			</div>
		</div>
	</div>
</div> -->



<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head orange">
				<h3> </h3>
			</div>
			<div class="widget-container">
				<!-- <button data-toggle="modal" data-target="#modal_spek" type="button" class="btn btn-warning"> 
					<i class="icon-plus"></i> Spesifikasi 
				</button> -->
				<table class="stat-table table table-hover">
					<thead>
						<tr>
							<!-- <th align="center" style="width: 25%;"> Kode Akun </th> -->
							<th align="center" style="width: 20%;"> Produk / Item </th>
							<th align="center"> Qty </th>
							<th align="center"> Harga Jual </th>
							<th align="center"> # </th>
						</tr>
					</thead>
					<tbody id="tes">
						<tr id="tr_1" class="tr_utama">
							<!-- <td align="left" style="vertical-align:middle;"> 
								<div class="control-group">
										<div class="controls">
											<select  required data-placeholder="Pilih ..." class="chzn-select" tabindex="2"  name="kode_akun[]" onchange="samakan_4(this.value);">
												<option value="">Pilih ...</option>
												<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
												<?PHP 
												$sel = "";
												if('401.01.01' == $akun_all->KODE_AKUN) { 
													$sel = "selected";
												} else {
													$sel = "";
												}
												?>
												<option <?=$sel;?>  value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
												<?PHP } ?>				
											</select>
										</div>								
								</div>
							</td> -->

							<td style="vertical-align:middle;"> 

								<div class="control-group">
									<div class="controls">
										<div class="input-append">
											<input type="text" id="nama_produk_1" name="nama_produk[]" readonly style="background:#FFF; width: 60%;" >
											<input type="hidden" id="id_produk_1" name="produk[]" readonly style="background:#FFF;">
											<input type="hidden" id="jenis_produk_1" name="jenis_produk[]" readonly style="background:#FFF;" value="">
											<button style="width: 30%;" onclick="show_pop_produk(1);" type="button" class="btn">Cari</button>
										</div>
									</div>
									
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input onkeyup="FormatCurrency(this); always_one(1); hitung_total(1);hitung_total_semua();" onchange="" id="qty_1" style="font-size: 18px; text-align:center; width: 80%;" type="text"  value="" name="qty[]">
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input onkeyup="FormatCurrency(this);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="harga_modal[]" id="harga_modal_1">
									<input type="hidden" name="total_id[]" id="total_id_1">
								</div>
							</td>

							<td style='background:#FFF; text-align:center; vertical-align: middle;'> 
								<!-- <button  style="width: 100%;" onclick="hapus_row_pertama();" type="button" class="btn btn-danger"> Hapus </button> -->
							</td>
						</tr>
					</tbody>
				</table>

				<button style="margin-bottom: 15px;" onclick="tambah_data();" type="button" class="btn btn-info"><i class="icon-plus"></i> Tambah Barais Data </button>

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

				

				

				<div class="form-actions">
					<center>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> Sub Total :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="sub_total"></h3>
							<input type="hidden" name="sub_total" id="inp_sub_total">
							<input type="hidden" name="qty_total" id="inp_qty_total">
						</div>
					</div>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> Discount :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<div class="input-append">
							<input type="text" name="discount" id="discount" onkeyup="disc_txt(this.value);">
							<span class="add-on">%</span>
						</div>
						</div>
					</div>

					

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> PBBKB :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pbbkb"></h3>
							<input type="checkbox" name="pbbkb" value="ada" style="display: none;">
							<input type="hidden" name="pajak_pbbkb_validasi" id="pajak_pbbkb_validasi">
						</div>
					</div>

					<!-- <div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> PPN :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_ppn"></h3>
							<input type="checkbox" name="ppn" value="ada" style="display: none;">
							<input type="text" name="pajak_ppn_validasi" id="pajak_ppn_validasi">
						</div>
					</div>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> PPH 21 :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pph_21"></h3>
							<input type="checkbox" name="pph_21" value="ada" style="display: none;">
							<input type="text" name="pajak_pph_21_validasi" id="pajak_pph_21_validasi">
						</div>
					</div>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> PPH 15 :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pph_15"></h3>
							<input type="checkbox" name="pph_15" value="ada" style="display: none;">
							<input type="text" name="pajak_pph_15_validasi" id="pajak_pph_15_validasi">
						</div>
					</div>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> PPH 23 :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="total_pph_23"></h3>
							<input type="checkbox" name="pph_23" value="ada" style="display: none;">
							<input type="text" name="pajak_pph_23_validasi" id="pajak_pph_23_validasi">
						</div>
					</div> -->

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> OAT :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<input type="checkbox" name="oat" value="ada">
						</div>
					</div>

					<div class="row-fluid" style="margin-top: 10px;">
						<div align="left" style="margin-bottom: 15px; color: black;" class="span2">
							<h3> Total :</h3> 
						</div>

						<div style="margin-bottom: 15px;" class="span4">
							<h3 style="color: green;" id="tot_disc"></h3>
							<input type="hidden" name="tot_disc" id="tot_disc_txt">
						</div>
					</div>

					<input type="hidden" name="sts_lunas" id="sts_lunas" value="1" />

					<input type="submit" value="Simpan Penjualan" name="simpan" class="btn btn-success">
					<button class="btn" onclick="window.location='<?=base_url();?>transaksi_penjualan_c' " type="button"> Batal dan Kembali </button>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modal_spek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Spesifikasi</h4>
      </div>
      <div class="modal-body">
        

		<div class="row-fluid">
			<div class="span12" style="font-size: 15px;">
				<address>
					<strong> Temperatur </strong><br>
					<input class="span12" type="text" name="temperatur" value="">
				</address>

				<address>
					<strong> Density </strong><br>
					<input class="span12" type="text" name="density" value="">
				</address>

				<address>
					<strong> Flash Point </strong><br>
					<input class="span12" type="text" name="flash_point" value="">
				</address>

				<address>
					<strong> Water Content </strong><br>
					<input class="span12" type="text" name="water_content" value="">
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


</form>

<!-- COPY ELEMENT -->
<div style="display:none;" id="copy_ag">
	<td align="center" style="vertical-align:middle;"> 
		<div class="control-group">
			<div class="controls">
				<select  required data-placeholder="Pilih ..." class="cek_select" tabindex="2"  name="kode_akun[]" onchange="samakan_4(this.value);">
					<option value="">Pilih ...</option>
					<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
					<?PHP 
					$sel = "";
					if('401.01.01' == $akun_all->KODE_AKUN) { 
						$sel = "selected";
					} else {
						$sel = "";
					}
					?>
					<option <?=$sel;?>  value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
					<?PHP } ?>				
				</select>
			</div>
		</div>
		</div>
	</td>
</div>
<!-- END COPY ELEMENT -->


<script type="text/javascript">

function hapus_row_pertama(){
	$('#nama_produk_1').val('');
	$('#id_produk_1').val('');
	$('#qty_1').val('');
	$('#satuan_1').val('');
	$('#harga_satuan_1').val('');
	$('#jumlah_1').val('');

	hitung_total_semua();
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

function show_pop_pelanggan(id){
    get_popup_pelanggan();
    ajax_pelanggan();
}

function show_pop_supplier(id){
    get_popup_supplier();
    ajax_supplier();
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

function ajax_produk(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_produk_popup',
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



                isine += '<tr onclick="get_produk_detail(\'' +res.ID+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.KODE_PRODUK+'</td>'+
                            '<td align="left">'+res.NAMA_PRODUK+'</td>'+
                             '<td align="center">Rp '+NumberToMoney(res.HARGA).split('.00').join('')+'</td>'+
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

function get_popup_pelanggan(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Pelanggan...">'+
                '    <div class="table-responsive" style="max-height: 500px; overflow-y: scroll;">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap;"> NAMA PELANGGAN / PERUSAHAAN </th>'+
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
        $('#popup_koang').remove();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function get_popup_supplier(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Pelanggan...">'+
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
        $('#popup_koang').remove();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_pelanggan(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_pelanggan_popup',
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
                nama_pel = res.NAMA_PELANGGAN;
                if(res.TIPE == "Perusahaan"){
                	nama_pel = res.NAMA_PELANGGAN+" <b> ("+res.NAMA_USAHA+")</b>";
                }

                isine += '<tr onclick="get_pelanggan_det('+res.ID+');" style="cursor:pointer;">'+
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

function ajax_supplier(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_supplier_popup',
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

                isine += '<tr onclick="get_supplier_det('+res.ID+');" style="cursor:pointer;">'+
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
	$('#total_id_'+id).val(profit);
	$('#inp_sub_total').val(profit);
	$('#inp_qty_total').val(qty);
	$('#sub_total').html('Rp. '+acc_format(profit, "").split('.00').join('') );
}

function disc_txt(disc){
	var sub_total = $('#inp_sub_total').val();

	var jml_pajak = $('#pajak_pbbkb_validasi').val();

	var total = parseFloat(disc/100) * parseFloat(sub_total);
	
	var total_pbbkb = (jml_pajak/100) * total ;

	var total_semua = sub_total - total - total_pbbkb;

	$('#total_pbbkb').html('Rp. '+acc_format(total_pbbkb, "").split('.00').join('') );

	$('#tot_disc').html('Rp. '+acc_format(total_semua, "").split('.00').join('') );

	$('#tot_disc_txt').val(total);

	
}

function get_produk_detail(id, no_form){
    var id_produk = id;
    $.ajax({
		url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_produk_detail',
		data : {id_produk:id_produk},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#qty_'+no_form).focus();
			$('#id_produk_'+no_form).val(id_produk);
			$('#nama_produk_'+no_form).val(result.NAMA_PRODUK);
			$('#harga_modal_'+no_form).val(result.HARGA);


			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		    $('#popup_koang').remove();
		}
	});
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
						'<input type="text" id="nama_produk_'+i+'" name="nama_produk[]" readonly style="background:#FFF; width: 60%">'+
						'<input type="hidden" id="id_produk_'+i+'" name="produk[]" readonly style="background:#FFF;">'+
						'<input type="hidden" id="jenis_produk_'+i+'" name="jenis_produk[]" readonly style="background:#FFF;" value="">'+
						'<button style="width: 30%" onclick="show_pop_produk('+i+');" type="button" class="btn">Cari</button>'+
					'</div>'+
				'</div>'+				
		'</td>'+



		'<td align="center" class="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this); always_one('+i+'); hitung_total('+i+');hitung_total_semua();" onchange="" id="qty_'+i+'" style="font-size: 18px; text-align:center; width: 80%;" type="text"  +value="" name="qty[]">'+
			'</div>'+
		'</td>'+


		'<td align="center" class="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this); hitung_total(1);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="harga_modal[]" id="harga_modal_'+i+'">'+
				'<input type="hidden" id="total_id_'+i+'" name="total_id[]">'+
		'	</div>'+
		'</td>'+

		'<td class="center" style="background:#FFF; text-align:center;">'+
			'<button style="width: 100%;" onclick="hapus_row('+i+');" type="btn-defaulton" class="btn btn-danger"> Hapus </button>'+
		'</td>'+
	'</tr>';

	$('#tes').append($isi_1);
	$('#tax_'+i).val(tax_lol);
	$('#tr_'+i).find('.cek_select').attr('class', 'cek_select_'+i);
	$('#tr_'+i).find('.cek_select2').attr('class', 'cek_select2_'+i);
	$('#tr_utama_count').val(i);
	$(".cek_select_"+i).chosen();
	$(".cek_select2_"+i).chosen();

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
			$('#pajak_pbbkb_validasi').val(result.PAJAK_PBBKB);
			// $('#pajak_pbbkb_validasi').val(result.PPN);
			// $('#pajak_pbbkb_validasi').val(result.PPH23);
			// $('#pajak_pbbkb_validasi').val(result.PPH15);
			// $('#pajak_pbbkb_validasi').val(result.PAJAK_PBBKB);
			$('#supply_point_nama').val(result.NAMA_GUDANG);
			$('#supply_pajak_nama').val(result.NAMA_BPPKB);
			$('#pajak_nama').val(result.PAJAK);
		}
	});
}

function get_supplier_det(id_pel){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_supplier_detail',
		data : {id_pel:id_pel},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();

			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		    $('#popup_koang').remove();

			$('#supplier').val(result.NAMA_SUPPLIER);
			$('#supplier_sel').val(id_pel);
		}
	});
}

function hitung_total_semua(){
	var sum = 0;
	
	console.log(pajak_prosen);
	$("input[name='total_id[]']").each(function(idx, elm) {
		var tot = elm.value.split(',').join('');
		if(tot > 0){
    		sum += parseFloat(tot);
		}
    });

    $('#sub_total').val(sum);

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

function acc_format(n, currency) {
	return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}

function samakan_1(val) {
	$('input[name="harga_modal[]"]').val(val);
}

function samakan_2(val){
	$('input[name="harga_jual[]"]').val(val);
}

function samakan_3(val){
	$('input[name="harga_invoice[]"]').val(val);
}

function samakan_4(val){
	$('input[name="kode_akun[]"]').val(val);
}

function samakan_5(){
	var vail = $('#nama_produk_1').val();
	$('input[name="nama_produk[]"]').val(vail);
}
// modal jual Invoice

 function jam_dinding(id){
   	var dateString = $('#jam_dinding_val').val();

	var startDate = new Date(dateString);

	// seconds * minutes * hours * milliseconds = 1 day 
	var day = (60 * 60 * 24 * 1000) * id;

	var endDate = new Date(startDate.getTime('dd-MM-yyyy')+ day);
	var tgl = endDate.toString("dd-MM-yyyy");
	 $('#jam_dinding_jadi').val(tgl);

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
                                    	'<input type="radio" value="'+res.ID+'" name="aksi_on">'+
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
</script>