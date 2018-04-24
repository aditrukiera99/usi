<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/js-form.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

	$("#no_spb").focus();

	$('#hapus').click(function(){
		$('#popup_hapus').css('display','block');
		$('#popup_hapus').show();
	});

	$('#close_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_ubah').click(function(){
		$('#popup_ubah').css('display','none');
		$('#popup_ubah').hide();
	});

	$("#tambah_penjualan").click(function(){
		$("#tambah_penjualan").fadeOut('slow');
		$("#tabel_penjualan").fadeOut('slow');
		$("#form_penjualan").fadeIn('slow');
		$("#tabel_total").fadeIn('slow');
	});

	$("#batal").click(function(){
		$("#tambah_penjualan").fadeIn('slow');
		$("#tabel_penjualan").fadeIn('slow');
		$("#form_penjualan").fadeOut('slow');
		$("#tabel_total").fadeOut('slow');
	});
});

function hapus_sales(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>sales_order_c/data_sales_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['pelanggan']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_sales(id)
{
	$("#tambah_penjualan").fadeOut('slow');
	$("#tabel_penjualan").fadeOut('slow');
	$("#form_penjualan").fadeIn('slow');

	$.ajax({
		url : '<?php echo base_url(); ?>sales_order_c/data_sales_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_sales').val(id);
			$('#pelanggan').val(row['pelanggan']);
			$('#divisi').val(row['divisi']);
			$('#alamat_penagihan').val(row['alamat_penagihan']);
			$('#tanggal_transaksi').val(row['tanggal_transaksi']);
			$('#no_transaksi').val(row['no_transaksi']);
			$('#uraian').val(row['uraian']);

			data_sales_detail(id);
		}
	});
}

function data_sales_detail(id)
{
	$.ajax({
		url : '<?php echo base_url(); ?>sales_order_c/data_sales_detail_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(result){
			var isi = '';
			var no = 0;
			$('#jml_tr').val(result.length);
			$.each(result,function(i,res){
                no++;

			isi +=
				'<tr id="tr_'+no+'">'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div class="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<select class="form-control input-medium select2me" id="kode_akun_'+no+'" class="form-control" value="'+res.kode_akun+'" name="kode_akun[]" data-placeholder="Select...">'+
											'<option value=""> </option>'+
											'<?php foreach ($lihat_kode_akuntansi as $value) 
											{
											?>'+
											'<option value="<?php echo $value->ID; ?>">(<?php echo $value->KODE_AKUN; ?>) <?php echo $value->NAMA_AKUN; ?></option>'+
											'<?php }?>'+
											
										'</select>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div class="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<input readonly type="text" id="nama_produk_'+no+'" class="form-control"  name="nama_produk[]" value="'+res.nama_produk+'" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">'+
										'<button onclick="show_pop_produk('+no+');" type="button" class="btn" style="width: 30%;">Cari</button>'+
										'<input type="hidden" id="id_produk_'+no+'" value="'+res.id_produk+'" name="produk[]" readonly style="background:#FFF;" value="0">'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input onkeyup="hitung_total('+no+');" style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.kuantitas+'" name="kuantitas[]" id="kuantitas_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.satuan+'" name="satuan[]" id="satuan_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.harga+'" name="harga[]" id="harga_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div class="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<select class="form-control input-small select2me" id="tax_'+no+'" class="form-control"  name="tax[]" value="" data-placeholder="Select...">'+
											'<option value="'+res.tax+'"><?php ?></option>'+
											'<option value="PPH">PPH</option>'+
											'<option value="PPH">PPN</option>'+
											'<option value="SERVICE">SERVICE</option>'+
										'</select>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.jumlah+'" name="jumlah[]" id="jumlah_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<button style="width: 100%;" onclick="hapus('+no+');" type="button" class="btn btn-danger"> Hapus </button>'+
						'</div>'+
					'</td>'+
				'</tr>';
			});

				$('#data_item').html(isi);
			}
		});
}

function get_kode_akuntansi()
{	
	var kode = kode;
	$.ajax({
		url : '<?php echo base_url(); ?>sales_order_c/get_kode_akuntansi',
		type : 'POST',
		dataType : 'json',
		data : {kode:kode},
		async : false,
		success : function(res){
			$('#kode_akun_'+no_form).val(res.KODE_AKUN.NAMA_AKUN);
		}
	});
}

function show_pop_pelanggan(no){
	$('#popup_koang').remove();
	get_popup_pelanggan();
    ajax_pelanggan(no);
}

function get_popup_pelanggan(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari Pelanggan...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap;"> Nama Pelanggan / Perusahaan </th>'+
                '                        <th style="white-space:nowrap;"> Alamat </th>'+
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

function ajax_pelanggan(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>sales_order_c/get_pelanggan_popup',
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

                isine += '<tr onclick="get_pelanggan_detail(\'' +res.id_pelanggan+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td text-align="center">'+no+'</td>'+
                            '<td text-align="center">'+res.nama_pelanggan+'</td>'+
                            '<td text-align="left">'+res.alamat_pelanggan+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='3' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_pelanggan(id_form);
            });
        }
    });
}

function get_pelanggan_detail(id, no_form){
	var id_pelanggan = id;
    $.ajax({
		url : '<?php echo base_url(); ?>sales_order_c/get_pelanggan_detail',
		data : {id_pelanggan:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#pelanggan').val(result.nama_pelanggan);
			
			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		}
	});
}


function show_pop_produk(no){
	$('#popup_koang').remove();
	get_popup_produk();
    ajax_produk(no);
}

function get_popup_produk(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari Produk...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>No</th>'+
                '                        <th style="white-space:nowrap;"> Kode Barang </th>'+
                '                        <th style="white-space:nowrap;"> Nama Barang </th>'+
                '                        <th style="white-space:nowrap;"> Harga Beli </th>'+
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
        url : '<?php echo base_url(); ?>sales_order_c/get_produk_popup',
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

                isine += '<tr onclick="get_produk_detail(\'' +res.id_barang+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td text-align="center">'+no+'</td>'+
                            '<td text-align="center">'+res.kode_barang+'</td>'+
                            '<td text-align="left">'+res.nama_barang+'</td>'+
                            '<td text-align="center">Rp '+NumberToMoney(res.harga_beli).split('.00').join('')+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='4' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_produk(id_form);
            });
        }
    });
}

function get_produk_detail(id, no_form){
	var id_barang = id;
    $.ajax({
		url : '<?php echo base_url(); ?>sales_order_c/get_produk_detail',
		data : {id_barang:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#kuantitas_'+no_form).val('');
			$('#id_produk_'+no_form).val(result.id_barang);
			$('#nama_produk_'+no_form).val(result.nama_barang);
			$('#kuantitas_'+no_form).focus();
			$('#satuan_'+no_form).val(result.nama_satuan);
			$('#harga_'+no_form).val(NumberToMoney(result.harga_beli).split('.00').join(''));

			// hitung_total(no_form);
			
			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		}
	});
}

function tambah_data(){
	var jml_tr = $('#jml_tr').val();
	var i = parseFloat(jml_tr) + 1;

	var isi = '<tr id="tr_'+i+'">'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div class="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<select class="form-control input-medium select2me" onchange="get_kode_akuntansi('+i+');" id="kode_akun_'+i+'"   name="kode_akun[]" data-placeholder="Select...">'+
											'<option value=""></option>'+
											'<?php foreach ($lihat_kode_akuntansi as $value) 
											{
											?>'+
											'<option value="<?php echo $value->ID; ?>">(<?php echo $value->KODE_AKUN; ?>) <?php echo $value->NAMA_AKUN; ?></option>'+
											'<?php }?>'+
										'</select>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div class="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<input readonly type="text" id="nama_produk_'+i+'" class="form-control"  name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">'+
										'<button onclick="show_pop_produk('+i+');" type="button" class="btn" style="width: 30%;">Cari</button>'+
										'<input type="hidden" id="id_produk_'+i+'" name="produk[]" readonly style="background:#FFF;" value="0">'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input onkeyup="hitung_total('+i+');" style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="kuantitas[]" id="kuantitas_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="satuan[]" id="satuan_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" onkeyup=FormatCurrency(); type="text" class="form-control" value="" name="harga[]" id="harga_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div class="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<select class="form-control input-small select2me" id="tax_'+i+'" class="form-control"  name="tax[]" data-placeholder="Select...">'+
											'<option value=""></option>'+
											'<option value="PPH">PPH</option>'+
											'<option value="PPH">PPN</option>'+
											'<option value="SERVICE">SERVICE</option>'+
										'</select>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" onkeyup=FormatCurrency(); type="text" class="form-control" value="" name="jumlah[]" id="jumlah_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<button style="width: 100%;" onclick="hapus('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
						'</div>'+
					'</td>'+
				'</tr>';

	$('#data_item').append(isi);
	$('#jml_tr').val(i);

}

function hapus(i){
	$('#tr_'+i).remove();
}

function hitung_total(id){

	var kuantitas = $('#kuantitas_'+id).val();
	kuantitas = kuantitas.split(',').join('');

	if(kuantitas == ""){
		kuantitas = 0;
	}

	var harga = $('#harga_'+id).val();
	harga = harga.split(',').join('');

	if(harga == "" || harga== null){
		harga = 0;
	}

	var total = parseFloat(kuantitas) * parseFloat(harga);

	var pajak = 0;

	total = total + pajak;

	$('#jumlah_'+id).val(acc_format(total, "").split('.00').join('') );

	hitung_total_semua();
}

function hitung_total_semua(){
	var sum = 0;
	var pajak_prosen = 0
	$("input[name='jumlah[]']").each(function(idx, elm) {
		var tot = elm.value.split(',').join('');
		if(tot > 0){
    		sum += parseFloat(tot);
		}
    });

    $('#subtotal_txt').html('Rp. '+acc_format(sum, ""));
}

function acc_format(n, currency) {
	return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}

// function simpan_add_produk(){
// 	var nama_produk = $('#nama_produk_add').val();
// 	var keterangan 	= $('#keterangan_add').val();
// 	var kuantitas   = $('#kuantitas').val();
// 	var satuan      = $('#satuan_add').val();
// 	var harga       = $('#harga_add').val();
// 	var jumlah      = $('#jumlah_add').val();

// 	if(kode_akun == ""){
// 		alert("Kode Akun Harus di isi.");
// 	} else if(keterangan == ""){
// 		alert("Nama Produk Harus di isi.");
// 	} else if(kuantitas == ""){
// 		alert("Satuan Produk Harus di isi.");
// 	} else if(satuan == ""){
// 		alert("Harga Produk Harus di isi.");
// 	}else if(harga == ""){
// 		alert("Harga Produk Harus di isi.");
// 	} else {
// 		$.ajax({
// 			url : '<?php echo base_url(); ?>sales_order_c/simpan',
// 			data : {
// 				kode_akun:kode_akun,
// 				nama_produk:nama_produk,
// 				kuantitas:kuantitas,
// 				satuan:satuan,
// 				harga:harga,
// 				tax:tax,
// 				jumlah:jumlah,
// 			},
// 			type : "POST",
// 			dataType : "json",
// 		});
// 	}

// }

function loading(){
	$('#popup_load').css('display','block');
	$('#popup_load').show();
}

function hapus_toas(){
	toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success("Data Berhasil Dihapus!", "Terhapus");
}

function berhasil(){
	toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success("Data Berhasil Disimpan!", "Berhasil");
}

</script>

<style type="text/css">
	#data_item tr td input{
		font-size: 15px !important;
	}
</style>

<form role="form" action="<?php echo $url_simpan; ?>" method="post">
<input type="hidden" id="jml_tr" value="1">
<input type="hidden" id="id_sales" name="id_sales">


<div class="row" id="form_penjualan" style="display:none; ">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-sharp hide"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Form Retur</span>
				</div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="buttons">
					</div>
				</div>
			</div>

			<div class="portlet-body">
				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-right:18px;">
					<div class="col-md-3" style="margin-left:20px; width: 23%; ">
						<label class="control-label"><b style="font-size:14px;">Pelanggan</b></label>
						<div class="input-group" style="width: 100%;">
							<input type="text" class="form-control" id="pelanggan" name="pelanggan">
							<span class="input-group-btn">
							<button class="btn green" type="button" onclick="show_pop_pelanggan();" required> Cari </button>
							</span>
						</div>
					</div>

					<div class="col-md-3" style="margin-left:20px;">
						<label class="control-label"><b style="font-size:14px;">Divisi</b></label>
						<div class="input-group" style="width: 100%;">
							<input type="text" class="form-control" id="divisi" name="divisi" value="divisi">
						</div>
					</div>
				</div>
			
				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;">
					<div class="portlet-body">
						<div class="row" style="padding-top: 15px; padding-bottom: 15px;">
							<div class="col-md-3">
								<label class="control-label"><b style="font-size:14px;">Alamat Penagihan</b></label>
								<div class="input-group" style="width: 100%;">
									<textarea rows="3" class="form-control" style="width: 301px; height: 93px;" id="alamat_penagihan" name="alamat_penagihan" required></textarea>
								</div>
							</div>

							<div class="col-md-3">
								<label class="control-label"><b style="font-size:14px;">Tanggal Transaksi</b></label>
								<div class="input-group" style="width: 100%;">
									<input type="text" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" value="<?=date('d-m-Y');?>" readonly required>
									<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
								</div>

								<label class="control-label"><b style="font-size:14px;">No. Transaksi</b></label>
								<div class="input-group" style="width: 100%;">
									<input type="text" class="form-control" id="no_transaksi" name="no_transaksi" required>
								</div>
							</div>

							<div class="col-md-6">
								<label class="control-label"><b style="font-size:14px;">Uraian</b></label>
								<div class="input-group" style="width: 100%; ">
									<textarea rows="3" id="uraian" name="uraian" class="form-control" style="width: 301px; height: 93px;" required></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;">
					<div class="portlet-body">	
						<table class="stat-table table table-stats table-bordered">
							<thead style="background: #333;">
								<tr>
									<th style="text-align: center; color:#FFF; width: 20%;">Kode Akun</th>
									<th style="text-align: center; color:#FFF; width: 20%;">Produk / Item</th>
									<th style="text-align: center; color:#FFF;">Kuantitas</th>
									<th style="text-align: center; color:#FFF;">Satuan</th>
									<th style="text-align: center; color:#FFF;">Harga</th>
									<th style="text-align: center; color:#FFF;">Tax</th>
									<th style="text-align: center; color:#FFF;">Jumlah</th>
									<th style="text-align: center; color:#FFF;">Aksi</th>
								</tr>
							</thead>
							<tbody id="data_item" style="background: #26a69a;">
								<tr id="tr_1">
									<td align="center" style="vertical-align:middle;">
										<div class="span12">
											<div class="control-group">
												<div class="controls">
													<div class="input-append" style="width: 100%;">
														<select class="form-control input-medium select2me" onchange="get_kode_akuntansi(1);" id="kode_akun_1" name="kode_akun[]" data-placeholder="Select...">
															<option value=""></option>
															<?php foreach ($lihat_kode_akuntansi as $value) {?>
																<option value="<?php echo $value->ID; ?>">(<?php echo $value->KODE_AKUN; ?>) <?php echo    $value->NAMA_AKUN; ?></option>
															<?php }?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="span12">
											<div class="control-group">
												<div class="controls">
													<div class="input-append" style="width: 100%;">
														<input readonly type="text" id="nama_produk_1" class="form-control"  name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">
														<button onclick="show_pop_produk(1);" type="button" class="btn" style="width: 30%;">Cari</button>
														<input type="hidden" id="id_produk_1" name="produk[]" readonly style="background:#FFF;" value="0">
													</div>
												</div>
											</div>
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input onkeyup="hitung_total(1);" style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="kuantitas[]" id="kuantitas_1">
										</div>
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="satuan[]" id="satuan_1">
										</div>
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="harga[]" id="harga_1">
										</div>
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="span12">
											<div class="control-group">
												<div class="controls">
													<div class="input-append" style="width: 100%;">
														<select class="form-control input-small select2me" id="tax_1" class="form-control"  name="tax[]" data-placeholder="Select...">
															<option value=""></option>
															<option value="PPH">PPH</option>
															<option value="PPH">PPN</option>
															<option value="SERVICE">SERVICE</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="jumlah[]" id="jumlah_1">
										</div>
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<button style="width: 100%;" onclick="hapus_row_pertama();" type="button" class="btn btn-danger"> Hapus </button>
										</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>

						<button style="margin-bottom: 15px; background: #26a69a;" onclick="tambah_data();" type="button" class="btn btn-info"><i class="icon-plus"></i> Tambah Baris Data </button>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row" id="tabel_total" style="display:none; ">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-body">
				<div class="row" style="padding-top: 15px;">
					<div class="col-md-12">
						<div class="col-md-2" style="width: 10%;">
							<div style="margin-bottom: 15px;" class="span3">
								<h4 class="control-label"> Sub Total :</h4> 
							</div>
						</div>

						<div class="col-md-3">
							<div style="margin-bottom: 15px;" class="span4">
								<h4 id="subtotal_txt" class="control-label"> Rp. 0.00 </h4> 
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="padding-top: 35px; padding-bottom: 15px;">
					<div class="col-md-12">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn blue">Simpan</button>
							<button type="button" id="batal" class="btn red" onclick="window.location ='<?php echo base_url(); ?>sales_order_c' ">Batal Dan Kembali</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>
</form>


<button id="tambah_penjualan" class="btn green">
Tambah Data Penjualan <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="tabel_penjualan" style="display:block;">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table Penjualan / Sales Order
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>		
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
				<thead>
				<tr>
					<th style="text-align:center;"> No</th>
					<th style="text-align:center;"> Tanggal</th>
					<th style="text-align:center;"> Nomor</th>
					<th style="text-align:center;"> Pelanggan</th>
					<th style="text-align:center;"> Aksi </th>
				</tr>
				</thead>
				<tbody>
					<?php 
					$no = 0;
					foreach ($lihat_data as $value) {
						$no++;
					?>
				<tr>
					<td style="text-align:center; vertical-align:"><?php echo $no; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->tanggal_transaksi; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->no_transaksi; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->pelanggan; ?></td>
					<td style="text-align:center; vertical-align:">
						<a class="btn default btn-xs purple" id="ubah" onclick="ubah_data_sales(<?php echo $value->id_sales?>);"><i class="fa fa-edit"></i> Ubah </a>
						<a class="btn default btn-xs red" id="hapus" onclick="hapus_sales(<?php echo $value->id_sales?>);"><i class="fa fa-trash-o"></i> Hapus </a>
					</td>
				</tr>
					<?php 
						}
					?>
				</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>

<div id="popup_ubah">
	<div class="window_ubah">
		<div class="tab-content">
			<div id="tab_0" class="tab-pane active">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-pencil"></i>Ubah Permintaan Barang
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<div class="portlet-body form">
					<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah;?>" enctype="multipart/form-data">
						<div class="form-body">
							<input type="hidden" name="id_permintaan_modal" id="id_permintaan_modal">

							<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">No SPB</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="no_spb_modal" name="no_spb_modal" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Tanggal</label>
							<div class="col-md-3">
								<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
									<input type="text" class="form-control" name="tanggal_modal" id="tanggal_modal" >
									<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Uraian</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="uraian_modal" name="uraian_modal" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Keterangan</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="keterangan_modal" name="keterangan_modal" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Kuantitas</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="kuantitas_modal" name="kuantitas_modal" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Satuan</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="satuan_modal" name="satuan_modal" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Harga</label>
								<div class="col-md-4 input-group left-addon">
									<span class="input-group-addon">Rp.</span>
									<input type="text" onkeyup="FormatCurrency(this);" class="form-control" id="harga_modal" name="harga_modal" >
									<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Jumlah</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="jumlah_modal" name="jumlah_modal" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-10">
									<button type="submit" class="btn blue">Simpan</button>
									<button type="button" id="batal_ubah" class="btn default">Batal</button>
								</div>
							</div>
						</div>
				</div>
			</form>
		</div>
										<!-- END FORM-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="popup_hapus">
	<div class="window_hapus">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button class="bootbox-close-button close" type="button" id="close_hapus">×</button>
					<div class="bootbox-body" id="msg"></div>
				</div>
				<div class="modal-footer">
					<form action="<?php echo $url_hapus; ?>" method="post">
						<input type="hidden" name="id_hapus" id="id_hapus" value="">
						<input type="button" class="btn btn-default" data-bb-handler="cancel" value="Batal" id="batal_hapus">
						<input type="submit" class="btn btn-primary" data-bb-handler="confirm" value="Hapus" id="hapus" onclick="loading();">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	<?php
		if($this->session->flashdata('sukses')){
	?>
		berhasil();
	<?php 
		}elseif($this->session->flashdata('hapus')){
	?>
		hapus_toas();
	<?php
		}
	?>
});


</script>