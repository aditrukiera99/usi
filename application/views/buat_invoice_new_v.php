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
			<h3 class="page-header"> <i class="icon-plus"></i>  Buat Invoice Baru </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Delivery Order</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li> Edit Delivery Order <span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Buat Delivery Order Baru </li>
		</ul>
	</div>
</div>

<form action="<?=base_url().$post_url;?>" method="post">

<div class="breadcrumb" style="background:#E0F7FF;">
	<div class="row-fluid">
		<div class="span5">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Delivery Order </b> </label>
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
	
	</div>
</div>

<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. DO </b> </label>
			<div class="controls">
				<input type="text" class="span12" value="" name="no_trx" id="no_trx" style="font-size: 15px;">
			</div>
		</div>

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Alamat Tujuan </b> </label>
				<div class="controls">
					
					<textarea name="alamat_tagih" class="span12" rows="5" id="alamat_tagih"></textarea>
				</div>
	
			

		</div>
	</div>


	<div class="span4">
	

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

		

	</div>


	<div class="span4">
		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> No. SO </b> </label>
			<div class="controls">
				<input type="text" class="span10" value="" name="no_solo" id="no_do" >
				<input type="hidden" class="span10" value="<?=$no_inv;?>" name="no_invoice" id="no_do" style="font-size: 15px;">
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
<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span4">
	

		<div class="control-group" style="margin-left: 10px;">
			<label class="control-label"> <b style="font-size: 14px;"> Kuantitas Diterima </b> </label>
				<div class="controls">
					<div id="datetimepicker1" class="input-append date ">
						<input type="text" class="span12" value="" name="qty_diterima" id="no_do" style="font-size: 15px;">
						
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
							

							<td style="vertical-align:middle;"> 

								<div class="control-group">
									<div class="controls">
										<div class="input-append">
											<input type="text" id="nama_produk_1" name="nama_produk" readonly style="background:#FFF; width: 60%;" >
											<input type="hidden" id="id_produk_1" name="produk" readonly style="background:#FFF;">
											<input type="hidden" id="jenis_produk_1" name="jenis_produk" readonly style="background:#FFF;" value="">
											<button style="width: 30%;" onclick="show_pop_produk(1);" type="button" class="btn">Cari</button>
										</div>
									</div>
									
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input onkeyup="FormatCurrency(this); always_one(1); hitung_total(1);hitung_total_semua();" onchange="" id="qty_1" style="font-size: 18px; text-align:center; width: 80%;" type="text"  value="" name="qty">
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="controls">
									<input onkeyup="FormatCurrency(this);" style="font-size: 18px; text-align:right; width: 80%;" type="text"  value="" name="harga_modal" id="harga_modal_1">
									<input type="hidden" name="total_id" id="total_id_1">
								</div>
							</td>

							<td style='background:#FFF; text-align:center; vertical-align: middle;'> 
								<!-- <button  style="width: 100%;" onclick="hapus_row_pertama();" type="button" class="btn btn-danger"> Hapus </button> -->
							</td>
						</tr>
					</tbody>
				</table>

				<!-- <button style="margin-bottom: 15px;" onclick="tambah_data();" type="button" class="btn btn-info"><i class="icon-plus"></i> Tambah Baris Data </button> -->

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

					

					<input type="hidden" name="sts_lunas" id="sts_lunas" value="1" />

					<input type="submit" value="Simpan Invoice" name="edit_inv" class="btn btn-success">
					<button class="btn" onclick="window.location='<?=base_url();?>transaksi_penjualan_c/buka_invoice' " type="button"> Batal dan Kembali </button>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>



</form>



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
                '                        <th style="white-space:nowrap;"> TANGGAL </th>'+
                '                        <th> NO SO </th>'+
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
        url : '<?php echo base_url(); ?>transaksi_penjualan_c/get_do_popup',
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
                

                isine += '<tr onclick="get_pelanggan_det('+res.ID+');get_sales_det('+res.ID+');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.TGL_TRX+'</td>'+
                            '<td align="center">'+res.NO_BUKTI+'</td>'+
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
		'<td>'+coa+'</td>'+
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



		'<td align="center" style="vertical-align:middle;"> '+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this); always_one('+i+'); hitung_total('+i+');hitung_total_semua();" onchange="" id="qty_'+i+'" style="font-size: 18px; text-align:center; width: 80%;" type="text"  +value="" name="qty[]">'+
			'</div>'+
		'</td>'+


		'<td align="center" style="vertical-align:middle;"> '+
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
		url : '<?php echo base_url(); ?>delivery_order_new_c/get_do_detail',
		data : {id_pel:id_pel},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();

			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		    $('#popup_koang').remove();

			$('#alamat_tagih').val(result.ALAMAT);
			$('#pelanggan').val(result.PELANGGAN);
			$('#no_trx').val(result.NO_BUKTI);
			$('#pelanggan_sel').val(id_pel);
			$('#no_do').val(result.NO_SO);
		}
	});
}

function get_sales_det(id_pel){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>delivery_order_new_c/get_do_tabel',
		data : {id_pel:id_pel},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();

			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		    $('#popup_koang').remove();

			$('#nama_produk_1').val(result.PRODUK);
			$('#qty_1').val(result.QTY);
			$('#harga_modal_1').val(result.HARGA_SATUAN);
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
</script>