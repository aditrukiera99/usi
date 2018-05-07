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

?>

<style type="text/css">

.btn_from_selected{
	background: #0093a8;
	color: #FFFFFF;
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
<input id="tr_utama_count2" value="0" type="hidden"/>
<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-plus"></i>  Buat Kas Kecil </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Input Akuntansi</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li>Kas Kecil <span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Buat Kas Kecil Baru </li>
		</ul>
	</div>
</div>

<form action="<?=base_url().$post_url;?>" method="post">

<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span6">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. Transaksi </b> </label>
			<div class="controls">
				<input type="text" class="span8" value="KK<?=$no_transaksi;?>" name="no_trx" id="no_trx" readonly style="font-size: 15px;">
				<input type="hidden" class="span8" value="<?=$no_transaksi;?>" name="no_trx2" id="no_trx2">
			</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Tanggal </b> </label>
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
			<label class="control-label"> <b style="font-size: 14px;"> Dibuat Oleh </b> </label>
			<div class="controls">
				<input type="text" class="span8" value=""  name="oleh" id="oleh">
			</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Untuk </b> </label>			
			<div class="controls">
				<textarea rows="4" id="untuk" name="untuk" style="resize:none; height: 87px; width: 80%;"></textarea>
			</div>
		</div>		
	</div>

	<div class="span6">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Memo (Opsional) </b> </label>
			<div class="controls">
				<textarea rows="4" id="memo" name="memo" style="resize:none; height: 87px; width: 80%;"></textarea>
			</div>
		</div> 

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Nominal </b> </label>
			<div class="controls">
				<input type="text" style="text-align: right;" class="span8" value="" onkeyup="FormatCurrency(this);" name="nilai" id="nilai">
			</div>
		</div>
	</div>
</div>

<div class="form-actions">
	<center>
	<!-- <input type="hidden" name="sts_lunas" id="sts_lunas" value="1" /> -->

	<button class="btn" onclick="window.location='<?=base_url();?>kas_kecil_c' " type="button"> Batal dan Kembali </button>
	<input type="submit" value="Simpan Kas Kecil" name="simpan" class="btn btn-success">
	</center>
</div>

</form>

<!-- COPY ELEMENT -->
<div style="display:none;" id="copy_ag">
	<td align="center" style="vertical-align:middle;"> 
		<div class="control-group">
			<div class="controls">
				<select  required data-placeholder="Pilih ..." class="cek_select" tabindex="2"  name="kode_akun[]" style="width: 100%;">
					<option value="">Pilih ...</option>
					<?PHP foreach ($get_list_akun_all as $key => $akun_all) { 
					$sel = "";
					if('501.02.01' == $akun_all->KODE_AKUN) { 
						$sel = "selected";
					} else {
						$sel = "";
					}
					?>
					<option <?=$sel;?> value="<?=$akun_all->KODE_AKUN;?>"> <?=$akun_all->KODE_AKUN;?> - <?=$akun_all->NAMA_AKUN;?></option>
					<?PHP } ?>				
				</select>
			</div>
		</div>
	</td>
</div>
<!-- END COPY ELEMENT -->


<script type="text/javascript">
function input_from(e, value){
	$('.btn_from').removeClass('btn_from_selected');
	if(value == "Manual"){
		$(e).addClass('btn_from_selected');
		$('#no_reff_txt').html('No. Reff');
		$('#cari_PO').hide();
		$('#cari_OPR').hide();
		$('#no_reff').prop('readonly', false);
	} else if(value == "PO"){
		$(e).addClass('btn_from_selected');
		$('#no_reff_txt').html('No. Order Pembelian');
		$('#cari_PO').show();
		$('#cari_OPR').hide();
		$('#no_reff').prop('readonly', true);
	} else if(value == "OPR"){
		$(e).addClass('btn_from_selected');
		$('#no_reff_txt').html('No. Bukti');
		$('#cari_PO').hide();
		$('#cari_OPR').show();
		$('#no_reff').prop('readonly', true);
	}

	$('#pelanggan').val('');
	$('#id_pelanggan').val('');
	$('#no_reff').val('');
	$('#from_trx').val(value);
}

function hapus_row_pertama(){
	$('#nama_produk_1').val('');
	$('#id_produk_1').val('');
	$('#qty_1').val('');
	$('#satuan_1').val('');
	$('#harga_satuan_1').val('');
	$('#jumlah_1').val('');

	hitung_total_semua();
}


function show_pop_PO(id){
	$('#popup_koang').remove();
    get_popup_PO();
    ajax_PO();
}

function get_popup_PO(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari...">'+
                '    <div class="table-responsive" style="max-height: 500px; overflow-y: scroll;">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO. ORDER</th>'+
                '                        <th style="white-space:nowrap;"> TANGGAL</th>'+
                '                        <th> NAMA SUPPLIER </th>'+
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

function ajax_PO(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>bukti_kas_keluar_c/get_PO',
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
                isine += '<tr onclick="get_PO_detail('+res.ID+');" style="cursor:pointer;">'+
                            '<td align="center">'+res.NO_PO+'</td>'+
                            '<td align="center">'+res.TGL_TRX+'</td>'+
                            '<td align="center">'+res.PELANGGAN+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='3' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_PO();
            });
        }
    });
}

function get_PO_detail(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>bukti_kas_keluar_c/get_PO_detail',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			// $('#alamat_tagih').val(result.ALAMAT_TAGIH);
			$('#id_pelanggan').val(result.ID_PELANGGAN);
			$('#pelanggan').val(result.PELANGGAN);
			$('#no_reff').val(result.NO_PO);
			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();

		    get_PO_detail2(id);
		}
	});
}

function get_PO_detail2(id){
	$('#tes').html('');
	$.ajax({
		url : '<?php echo base_url(); ?>bukti_kas_keluar_c/get_PO_detail2',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(result){
			var i = 0;
            $.each(result,function(i,res){
            	var coa = $('#copy_ag').html();
            	i++;
                var isine = 
                '<tr id="tr_'+i+'" class="tr_utama">'+
					'<td>'+coa+'</td>'+
					'<td style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 14px; text-align:left; width: 90%;" type="text"  value="'+res.NAMA_PRODUK+'" name="ket[]" id="ket_'+i+'">'+
						'</div>'+
					'</td>'+

					'<td align="center" style="vertical-align:middle;"> '+
						'<div class="controls">'+
							'<input onkeyup="FormatCurrency(this);" style="font-size: 14px; text-align:right; width: 80%;" type="text" readonly value="'+NumberToMoney(res.TOTAL)+'" name="nilai[]" id="nilai_'+i+'">'+
						'</div>'+
					'</td>'+

					'<td class="center" style="background:#FFF; text-align:center;">'+
						'<button style="width: 100%;" onclick="hapus_row('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
					'</td>'+
				'</tr>';

				$('#tes').append(isine);
				$('#tr_'+i).find('.cek_select').attr('class', 'cek_select_'+i);
				$(".cek_select_"+i).chosen();
            });

            $('#tr_utama_count').val(result.length);
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
		'<td>'+coa+'</td>'+
		'<td style="vertical-align:middle;">'+
			'<div class="controls">'+
				'<input style="font-size: 14px; text-align:left; width: 90%;" type="text"  value="" name="ket[]" id="ket_'+i+'">'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this);" style="font-size: 14px; text-align:right; width: 80%;" type="text" value="" name="nilai[]" id="nilai_'+i+'">'+
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
    $('#subtotal_txt').html('Rp. '+acc_format(sum, ""));
    $('#total_txt').html('Rp. '+acc_format(total_all, ""));
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
</script>