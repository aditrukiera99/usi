<?PHP 
$no_transaksi = 10001;
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
$tahun_kas = str_replace('20', '', date('Y'));

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
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  padding: 10px;
}

</style>
<input id="tr_utama_count" value="<?=count($dt_detail);?>" type="hidden"/>
<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-plus"></i>  Buat Transaksi Baru </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li> Transaksi Lainnya <span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Buat Transaksi Baru </li>
		</ul>
	</div>
</div>

<form action="<?=base_url().$post_url;?>" method="post" onsubmit="return cek_form();">

<div class="breadcrumb" style="background:#E0F7FF; display: none;">
	<div class="row-fluid">
		<div class="span5">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Pelanggan </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="pelanggan" name="pelanggan" readonly style="background:#FFF; width: 70%;">
						<input type="hidden" id="pelanggan_sel" name="pelanggan_sel" readonly style="background:#FFF;">
						<button onclick="show_pop_pelanggan();" type="button" class="btn">Cari</button>
					</div>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Unit </b> </label>
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
	<div class="span4" style="display: none;">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Alamat Penagihan </b> </label>
				<div class="controls">
					<textarea rows="4" id="alamat_tagih" name="alamat_tagih" style="resize:none; height: 87px; width: 90%;"></textarea>
				</div>
		</div>
	</div>


	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Tanggal Transaksi </b> </label>
				<div class="controls">
					<div class="input-append date ">
						<input readonly style="width: 80%;" value="<?=$dt->TGL_TRX;?>" required name="tgl_trx" onclick="$('#add_on_pick').click();" data-format="dd-MM-yyyy" type="text"><span class="add-on "><i class="icon-calendar"></i></span>
					</div>
				</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. Transaksi </b> </label>
			<div class="controls">
				<input readonly type="text" class="span12" value="<?=$dt->NO_BUKTI;?>" name="no_trx" id="no_trx" style="background: #FFF; font-size: 16px;">
			</div>
		</div>
	</div>


	<div class="span7">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Uraian </b> </label>
			<div class="controls">
				<textarea rows="4" id="memo_lunas" name="memo_lunas" style="resize:none; height: 87px; width: 80%;"><?=$dt->MEMO;?></textarea>
			</div>
		</div> 
	</div>
</div>



<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray" style="background: #F5EADA;">
			<div class="widget-head orange">
				<h3> </h3>
			</div>
			<div class="widget-container">
				<div class="control-group" style="margin-left: 20px; display: none;">
					<label class="control-label"> <b style="font-size: 14px;"> NILAI TRANSAKSI </b> </label>
					<div class="controls">
						<input style="font-size: 14px;" required  type="text" class="span6" value="<?=$dt->TOTAL;?>"" name="nilai_transaksi" id="nilai_transaksi" onkeyup="FormatCurrency(this); hitung_total_semua();">
					</div>
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
				<!-- <button style="margin-bottom: 15px;" data-toggle='modal' data-target='#modal_add_produk' type="button" class="btn btn-danger"><i class="icon-hdd"></i> Tambah Produk </button> -->
				<table class="stat-table table table-hover">
					<thead>
						<tr>
							<th align="center" style="width: 25%;"> Kode Akun </th>
							<th align="center" style="width: 20%;"> Produk / Item </th>
							<th align="center"> Kuantitas </th>
							<th align="center"> Satuan </th>
							<th align="center"> Harga Beli</th>
							<th align="center"> Jumlah</th>
							<th align="center"> Aksi</th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						$no = 0;
						foreach ($dt_detail as $key => $row) {
							$no++;
						?>
						<tr id="tr_<?=$no;?>" class="tr_utama">
							<td align="left" style="vertical-align:middle;"> 
								<div class="control-group">
										<div class="controls">
											<select  required data-placeholder="Pilih ..." class="chzn-select" tabindex="2"  name="kode_akun[]">
												<option value="">Pilih ...</option>
												<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
												<?PHP 
												$cek = "";
												if($akun_all->KODE_AKUN == $row->KODE_AKUN){
													$cek = "selected";
												} else {
													$cek = "";
												}
												?>
												<option <?=$cek;?> value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
												<?PHP } ?>				
											</select>
										</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
									<div class="control-group">
										<div class="controls">
											<div class="input-append" style="width: 100%;">
												<input readonly type="text" id="nama_produk_<?=$no;?>" value="<?=$row->NAMA_PRODUK;?>" name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 10px;">
												<button onclick="show_pop_produk(<?=$no;?>);" type="button" class="btn" style="width: 30%;">Cari</button>
												<input type="hidden" id="id_produk_<?=$no;?>" name="produk[]" readonly style="background:#FFF;" value="0">
											</div>
										</div>
									</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input onkeyup="always_one(<?=$no;?>);" onchange="always_one(<?=$no;?>); hitung_total(<?=$no;?>);" id="qty_<?=$no;?>" style="font-size: 18px; text-align:center; width: 80%;" type="number"  value="<?=$row->QTY;?>" name="qty[]">
								</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input style="font-size: 18px; text-align:left; width: 90px;" type="text"  value="<?=$row->SATUAN;?>" name="satuan[]" id="satuan_<?=$no;?>">
								</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input required onkeyup="FormatCurrency(this); hitung_total(<?=$no;?>);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="<?=number_format($row->HARGA_SATUAN);?>" name="harga_satuan[]" id="harga_satuan_<?=$no;?>">
								</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input readonly onkeyup="FormatCurrency(this);" style="font-size: 18px; text-align:right; width: 80%; background:#FFF;" type="text"  value="<?=number_format($row->TOTAL);?>" name="jumlah[]" id="jumlah_<?=$no;?>">
								</div>
								</div>
							</td>

							<td style='background:#FFF; text-align:center; vertical-align: middle;'> 
								<div class="span12">
								<button style="width: 100%;" onclick="hapus_row(<?=$no;?>);" type="button" class="btn btn-danger"> Hapus </button>
								</div>
							</td>
						</tr>
						<?PHP } ?>
					</tbody>
				</table>

				<button style="margin-bottom: 15px;" onclick="tambah_data();" type="button" class="btn btn-info"><i class="icon-plus"></i> Tambah Baris Data </button>

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
				<div class="row-fluid" style="display: none;">
					<div style="margin-bottom: 15px; display: none;" class="span3">
						<h4> Sub Total :</h4> 
					</div>

					<div style="margin-bottom: 15px; display: none;" class="span4">
						<h4 id="subtotal_txt"> Rp. 0.00 </h4> 
					</div>

					<div style="margin-bottom: 15px; margin-left: 7px;" class="span4">
						<div class="controls">
							<label class="checkbox" style="font-size: 14px;">
							<input type="checkbox" checked name="is_lunas" id="is_lunas" value="" onclick="cek_islunas();">
							Sudah Membayar</label>
						</div>
					</div>
				</div>

				<div class="row-fluid" style="display: none;">
					<div class="span3">
						<div class="control-group">
							<label class="control-label"> <b style="font-size: 14px;"> Pajak </b> </label>
								<div class="controls">
									<select required data-placeholder="Pilih Pajak ..." class="chzn-select" tabindex="2" style="width:150px;" name="id_pajak" onchange="hitung_pajak(this.value);">
											<option value="0" style="font-weight:bold;"> Tanpa Pajak </option>
										<?PHP foreach ($get_pajak as $key => $pajak) { ?>
											<option value="<?=$pajak->ID;?>"> <?=$pajak->NAMA_PAJAK;?> </option>
										<?PHP } ?>				
									</select>
									<input name="pajak_prosen" id="pajak_prosen" type="hidden" value="0" />
									<input name="kode_akun_pajak" id="kode_akun_pajak" type="hidden" value="" />
								</div>
						</div>
					</div>

					<div class="span4" style="margin-top: 18px;">
						<input style="font-size: 16px;" type="text" name="pajak_all" id="pajak_all" onkeyup="FormatCurrency(this); hitung_total_semua();"  placeholder="Isikan nilai pajak" />
					</div>

					<div class="span4" id="piutang_row" style="display:none;">
						<div class="control-group">
							<label class="control-label"> <b style="font-size: 14px;"> Pilih Kategori Piutang </b> </label>
							<div class="controls">
								<select class="span12" name="akun_piutang">
									<option value="1-1200"> Piutang Usaha </option>
									<option value="1-1210"> Piutang Lainnya </option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid" style="margin-top: 10px;">
					<div style="margin-bottom: 15px;" class="span3">
						<h3> Total :</h3> 
					</div>

					<div style="margin-bottom: 15px;" class="span4">
						<h3 id="total_txt" style="color:green;"> Rp. <?=number_format($dt->TOTAL);?> </h3> 
					</div>
				</div>

				

				<div class="form-actions">
					<center>
					<input type="hidden" name="sub_total" id="sub_total" value="" />
					
					<input type="hidden" name="total_all" id="total_all" value="" />
					<input type="hidden" name="sts_lunas" id="sts_lunas" value="1" />

					<input type="submit" value="Simpan Transaksi" name="ubah" class="btn btn-info">
					<button class="btn" onclick="window.location='<?=base_url();?>transaksi_lainnya_c' " type="button"> Batal dan Kembali </button>
					</center>
				</div>
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
				<select  required data-placeholder="Pilih ..." class="cek_select" tabindex="2"  name="kode_akun[]" style="width: 100%;">
					<option value="">Pilih ...</option>
					<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
					<option value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
					<?PHP } ?>				
				</select>
			</div>
		</div>
	</td>
</div>
<!-- END COPY ELEMENT -->


<script type="text/javascript">

function show_pop_produk(no){
	$('#popup_koang').remove();
	get_popup_produk();
    ajax_produk(no);
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
                '                        <th> STOK </th>'+
                '                        <th> HARGA BELI</th>'+
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

function ajax_produk(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>transaksi_pembelian_c/get_produk_popup',
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

                isine += '<tr onclick="get_produk_detail(\'' +res.ID+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.KODE_PRODUK+'</td>'+
                            '<td align="left">'+res.NAMA_PRODUK+'</td>'+
                            '<td align="center">'+res.STOK+' '+res.SATUAN+'</td>'+
                            '<td align="center">Rp '+NumberToMoney(res.HARGA).split('.00').join('')+'</td>'+
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

function get_produk_detail(id, no_form){
	var id_produk = id;
    $.ajax({
		url : '<?php echo base_url(); ?>transaksi_pembelian_c/get_produk_detail',
		data : {id_produk:id_produk},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#qty_'+no_form).val(1);
			$('#id_produk_'+no_form).val(id_produk);
			$('#satuan_'+no_form).val(result.SATUAN);
			$('#nama_produk_'+no_form).val(result.NAMA_PRODUK);
			$('#harga_satuan_'+no_form).val(NumberToMoney(result.HARGA).split('.00').join(''));
			$('#jumlah_'+no_form).val(NumberToMoney(result.HARGA*1).split('.00').join(''));


			var isi =   '<option value="0">None</option>'+
						'<option value="'+result.PPH+'">PPH</option>'+
						'<option value="'+result.PPN+'">PPN</option>'+
						'<option value="'+result.SERVICE+'">SERVICE</option>';

			$('#tax_'+no_form).html(isi);

			$('#harga_satuan_'+no_form).focus();

			hitung_total(no_form);

			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
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

function always_one(id){
	var a = $('#qty_'+id).val();
	if(a <= 0){
		$('#qty_'+id).val(1);
	}

	var max = parseInt($('#qty_max_'+id).val());
	if(a > max){
		$('#qty_'+id).val(max);
	}
}


function hitung_total_semua(){
	var sum = $('#nilai_transaksi').val();
	sum = sum.split(',').join('');
	sum = parseFloat(sum);

	var pajak_prosen = $('#pajak_prosen').val();

	var pajak = $('#pajak_all').val().split(',').join('');
	if(pajak == ""){
		pajak = 0;
	}
	
	var total_all = parseFloat(sum) + parseFloat(pajak) ;

    $('#sub_total').val(sum);
    //$('#pajak_all').val(pajak);
    $('#total_all').val(total_all);

    $('#pajak_txt').html('Rp. '+NumberToMoney(pajak));
    $('#subtotal_txt').html('Rp. '+NumberToMoney(sum));
    $('#total_txt').html('Rp. '+NumberToMoney(total_all));
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

function  cek_form() {
	var jml_bahan = $('.tr_utama').length;
	var a = true;
	if(jml_bahan > 0){
		a = true;
	} else {
		alert('Bahan baku tidak boleh kosong !');
		a = false;
	}

	return a;
}

function tambah_data() {
	var jml_tr = $('#tr_utama_count').val();
	var i = parseInt(jml_tr) + 1;

	var coa = $('#copy_ag').html();

	$isi_1 = 
	'<tr id="tr_'+i+'" class="tr_utama">'+
		'<td>'+coa+'</td>'+
		'<td class="center" style="vertical-align:middle;" id="td_chos_'+i+'">'+
			'<div class="control-group">'+
				'<div class="controls">'+
					'<div class="input-append">'+
						'<input type="text" id="nama_produk_'+i+'" name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 10px;">'+
						'<input type="hidden" id="id_produk_'+i+'" name="produk[]" readonly style="background:#FFF;">'+
						'<button style="width: 30%;" onclick="show_pop_produk('+i+');" type="button" class="btn">Cari</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</td>'+

		'<td class="center" align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input onkeyup="always_one('+i+');" onchange="always_one('+i+'); hitung_total('+i+');" style="font-size: 18px; text-align:center; width: 80%;" type="number"  value="0" name="qty[]" id="qty_'+i+'">'+
			'</div>'+
		'</td>'+

		'<td class="center" align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input style="font-size: 18px; text-align:left; width: 80%;" type="text"  value="" name="satuan[]" id="satuan_'+i+'">'+
			'</div>'+
		'</td>'+

		'<td class="center" align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input required onkeyup="FormatCurrency(this); hitung_total('+i+');" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="harga_satuan[]" id="harga_satuan_'+i+'">'+
			'</div>'+
		'</td>'+

		'<td class="center" align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input readonly onkeyup="FormatCurrency(this);" style="font-size: 18px; text-align:right; width: 80%; background:#FFF;" type="text"  value="" name="jumlah[]" id="jumlah_'+i+'">'+
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


function hitung_total(id){

	var qty = $('#qty_'+id).val();
	var harga_satuan = $('#harga_satuan_'+id).val();
	harga_satuan = harga_satuan.split(',').join('');

	if(harga_satuan == "" || harga_satuan == null){
		harga_satuan = 0;
	}

	var total = parseFloat(qty) * parseFloat(harga_satuan);

	$('#jumlah_'+id).val(NumberToMoney(total).split('.00').join(''));

	hitung_total_semua();
}


function always_one(id){
	var a = $('#qty_'+id).val();
	if(a <= 0){
		$('#qty_'+id).val(1);
	}
}
function hitung_total_semua(){
	var sum = 0;
	var pajak_prosen = $('#pajak_prosen').val();
	console.log(pajak_prosen);
	$("input[name='jumlah[]']").each(function(idx, elm) {
		var tot = elm.value.split(',').join('');
		if(tot > 0){
    		sum += parseFloat(tot);
		}
    });

	var pajak = $('#pajak_all').val().split(',').join('');
	if(pajak == ""){
		pajak = 0;
	}

	var total_all = parseFloat(sum) + parseFloat(pajak) ;

    $('#sub_total').val(sum);
    //$('#pajak_all').val(pajak);
    $('#total_all').val(total_all);

    $('#pajak_txt').html('Rp. '+NumberToMoney(pajak));
    $('#subtotal_txt').html('Rp. '+NumberToMoney(sum));
    $('#total_txt').html('Rp. '+NumberToMoney(total_all));
    $('#nilai_transaksi').val(total_all);
}
</script>