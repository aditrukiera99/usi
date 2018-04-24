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

	$("#batal").click(function(){
		$('#kode_barang').val("");
		$('#nama_barang').val("");
		$("#kode_barang").focus();
		$('body,html').animate({
                scrollTop : 0 // Scroll to top of body
        }, 500);
	});

	$('#batal_ubah').click(function(){
		$('#popup_ubah').css('display','none');
		$('#popup_ubah').hide();
	});

	$("#tambah_purchase_order").click(function(){
		$("#tambah_purchase_order").fadeOut('slow');
		$("#table_purchase_order").fadeOut('slow');
		$("#form_purchase_order").fadeIn('slow');
		$("#tabel_total").fadeIn('slow');
	});

	$("#batal").click(function(){
		$("#tambah_purchase_order").fadeIn('slow');
		$("#table_purchase_order").fadeIn('slow');
		$("#form_purchase_order").fadeOut('slow');
		$("#tabel_total").fadeOut('slow');

		$("#no_spb").val('');
		$("#uraian").val('');
		$("#nama_produk_1").val('');
		$("#keterangan_1").val('');
		$("#kuantitas_1").val('');
		$("#satuan_1").val('');
		$("#harga_1").val('');
		$("#jumlah_1").val('');
		$("#subtotal_txt").val('');
	});
});

function hapus_pengembalian(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>purchase_order_c/data_purchase_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['no_po']+'</b> ini ingin dihapus ?');
		}
	});
}


function hapus_row_pertama()
{
	$('#nama_produk_1').val('');
	$('#id_produk_1').val('');
	$('#keterangan_1').val('');
	$('#kuantitas_1').val('');
	$('#satuan_1').val('');
	$('#harga_1').val('');
	$('#jumlah_1').val('');

	hitung_total_semua();
}

function ubah_data_pengembalian(id)
{
	$("#tambah_purchase_order").fadeOut('slow');
	$("#table_purchase_order").fadeOut('slow');
	$("#form_purchase_order").fadeIn('slow');
	$("#tabel_total").fadeIn('slow');

	$.ajax({
		url : '<?php echo base_url(); ?>purchase_order_c/data_pengembalian_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_purchase').val(id);
			$('#no_spb').val(row['no_spb']);
			$('#tanggal').val(row['tanggal']);
			$('#uraian').val(row['uraian']);

			ubah_detail(id);

		}
	});
}

function ubah_detail(id){
	$.ajax({
		url : '<?php echo base_url(); ?>purchase_order_c/data_pengembalian_detail_id',
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
                isi += '<tr id="tr_'+no+'">'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div class="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<input value="'+res.nama_produk+'" readonly type="text" id="nama_produk_'+no+'" class="form-control"  name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">'+
										'<button onclick="show_pop_produk('+no+');" type="button" class="btn" style="width: 30%;">Cari</button>'+
										'<input type="hidden" id="id_produk_'+no+'" name="produk[]" readonly style="background:#FFF;" value="'+res.id_produk+'">'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.keterangan+'" name="keterangan[]" id="keterangan_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input onkeyup="hitung_total('+no+');" style="font-size: 10px; text-align:center;" type="text" class="form-control" value="'+res.kuantitas+'" name="kuantitas[]" id="kuantitas_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="'+res.satuan+'" name="satuan[]" id="satuan_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:right;" type="text" class="form-control" value="'+res.harga+'" name="harga[]" id="harga_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:right;" type="text" class="form-control" value="'+res.jumlah+'" name="jumlah[]" id="jumlah_'+no+'">'+
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

	hitung_total_semua();
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
                '                        <th>NO</th>'+
                '                        <th> Kode Barang </th>'+
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
	var id_produk = id;
    $.ajax({
		url : '<?php echo base_url(); ?>purchase_order_c/get_produk_detail',
		data : {id_barang:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#kuantitas_'+no_form).val('');
			$('#id_produk_'+no_form).val(result.id_barang);
			$('#nama_produk_'+no_form).val(result.nama_barang);
			$('#satuan_'+no_form).val(result.nama_satuan);
			$('#harga_'+no_form).val(NumberToMoney(result.harga_beli).split('.00').join(''));
			$('#jumlah_'+no_form).val(NumberToMoney(result.harga_beli*1).split('.00').join(''));

			$('#kuantitas_'+no_form).focus();

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

	var isi = 	'<tr id="tr_'+i+'">'+
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
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="keterangan[]" id="keterangan_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input onkeyup="hitung_total('+i+');" style="font-size: 10px; text-align:center;" type="text" class="form-control" value="" name="kuantitas[]" id="kuantitas_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="" name="satuan[]" id="satuan_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:right;" type="text" class="form-control" value="" name="harga[]" id="harga_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:right;" type="text" class="form-control" value="" name="jumlah[]" id="jumlah_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<button style="width: 100%;" onclick="hapus_row('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
						'</div>'+
					'</td>'+
				'</tr>';

	$('#data_item').append(isi);
	$('#jml_tr').val(i);

}


function add_row(id_peminjaman_detail,nama,keterangan,no_opek,id_produk){
	var jml_tr = $('#jml_tr').val();
	var i = parseFloat(jml_tr) + 1;

	var isi = 	'<tr id="tr_'+i+'">'+
					
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+nama+'" name="nama_produk[]" id="keterangan_'+i+'">'+
							'<input type="hidden" id="id_produk_'+i+'" value="'+id_peminjaman_detail+'" name="id_peminjaman_detail[]" readonly style="background:#FFF;" value="0">'+
							'<input type="hidden" id="id_produk_'+i+'" value="'+id_produk+'" name="id_produk[]" readonly style="background:#FFF;" value="0">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="'+keterangan+'" name="keterangan[]" id="keterangan_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" onkeyup="FormatCurrency(this);"  type="text" class="form-control" value="" name="kuantitas[]" id="kuantitas_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" onkeyup="gen_harga('+i+');FormatCurrency(this);"  type="text" class="form-control" value="" name="harga[]" id="harga_awal_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" onkeyup="harga_disc('+i+');hitung_total_semua();" type="text" class="form-control" value="" name="disc[]" id="disc_'+i+'">'+
							'<input style="font-size: 10px; text-align:center;" onkeyup="" type="hidden" class="form-control" value="" name="disc[]" id="tep_harga_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="" name="total[]" id="total_disc_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="'+no_opek+'" name="no_opek[]" id="satuan_'+i+'">'+
						'</div>'+
					'</td>'+
					
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<button style="width: 100%;" onclick="hapus_row('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
						'</div>'+
					'</td>'+
				'</tr>';

	$('#data_item').append(isi);
	$('#jml_tr').val(i);

}

function hapus(i){
	$('#tr_'+i).remove();
}

function gen_harga(id){


	var harga_awal = $('#harga_awal_'+id).val();
	harga_awal = harga_awal.split(',').join('');

	if(harga_awal == ""){
		harga_awal = 0;
	}

	var kuantitas = $('#kuantitas_'+id).val();
	kuantitas = kuantitas.split(',').join('');

	if(kuantitas == "" || kuantitas== null){
		kuantitas = 0;
	}

	var total = (parseFloat(harga_awal) * parseFloat(kuantitas)) ;


	$('#tep_harga_'+id).val(acc_format(total, "").split('.00').join('') );

}

function harga_disc(id){

	var harga_awal = $('#tep_harga_'+id).val();
	harga_awal = harga_awal.split(',').join('');

	if(harga_awal == ""){
		harga_awal = 0;
	}

	var disc = $('#disc_'+id).val();
	disc = disc.split(',').join('');

	if(disc == "" || disc== null){
		disc = 0;
	}

	var total = (parseFloat(harga_awal) - (parseFloat(disc)/100) * parseFloat(harga_awal))  ;


	$('#total_disc_'+id).val(acc_format(total, "").split('.00').join('') );

	hitung_total_semua();
}

function po(disc){

	var harga_awal = $('#subtotal_txt').html();
	harga_awal = harga_awal.split(',').join('');
	harga_awal = harga_awal.split('Rp. ').join('');



	if(harga_awal == ""){
		harga_awal = 0;
	}


	var total = (parseFloat(disc)/100) * parseFloat(harga_awal)  ;
	var accu = parseFloat(harga_awal) - total;

	$('#total_po').html('Rp. '+acc_format(accu, "").split('.00').join('') );
	$('#po_text').val(total);

	
}

function ppn_ici(disc){

	var total_po = $('#total_po').html();
	total_po = total_po.split(',').join('');
	total_po = total_po.split('Rp. ').join('');


	if(total_po == ""){
		total_po = 0;
	}

	
	var total =  (parseFloat(disc)/100) * parseFloat(total_po) ;
	var accu = parseFloat(total_po) + total;

	
	$('#total_ppn').html('Rp. '+acc_format(accu, "").split('.00').join('') );
	$('#ppn_text').val(total);
	
}

function pph_ici(disc){

	var total_po = $('#total_po').html();
	total_po = total_po.split(',').join('');
	total_po = total_po.split('Rp. ').join('');

	var total_ppn = $('#total_ppn').html();
	total_ppn = total_ppn.split(',').join('');
	total_ppn = total_ppn.split('Rp. ').join('');


	if(total_po == ""){
		total_po = 0;
	}

	
	var total =  (parseFloat(disc)/100) * parseFloat(total_po) ;
	var accu = parseFloat(total_ppn) - total;

	
	$('#total_pph').html('Rp. '+acc_format(accu, "").split('.00').join('') );
	$('#pph_text').val(total);
	$('#total_semua').val(accu);
	
}

function hitung_total_semua(){
	var sum = 0;
	var pajak_prosen = 0
	$("input[name='total[]']").each(function(idx, elm) {
		var tot = elm.value.split(',').join('');
		if(tot > 0){
    		sum += parseFloat(tot);
		}
    });

    $('#subtotal_txt').html('Rp. '+acc_format(sum, ""));
    $('#subtotal_text').val(sum);
}

function acc_format(n, currency) {
	return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}

function simpan_add_produk(){
	var nama_produk = $('#nama_produk_add').val();
	var keterangan 	= $('#keterangan_add').val();
	var kuantitas   = $('#kuantitas').val();
	var satuan      = $('#satuan_add').val();
	var harga       = $('#harga_add').val();
	var jumlah      = $('#jumlah_add').val();

	if(nama_produk == ""){
		alert("Kode Produk Harus di isi.");
	} else if(keterangan == ""){
		alert("Nama Produk Harus di isi.");
	} else if(kuantitas == ""){
		alert("Satuan Produk Harus di isi.");
	} else if(satuan == ""){
		alert("Harga Produk Harus di isi.");
	}else if(harga == ""){
		alert("Harga Produk Harus di isi.");
	} else {
		$.ajax({
			url : '<?php echo base_url(); ?>purchase_order_c/simpan',
			data : {
				nama_produk:nama_produk,
				keterangan:keterangan,
				kuantitas:kuantitas,
				satuan:satuan,
				harga:harga,
				jumlah:jumlah,
			},
			type : "POST",
			dataType : "json",
		});
	}

}

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


function get_transaction(id) {
	
        $.ajax({
            url : '<?php echo base_url(); ?>purchase_order_c/get_transaction_info',
            data : {id:id},
            type : "POST",
            dataType : "json",
            success : function(result){   
                var isine = "";
                if(result.length > 0){
                    $.each(result,function(i,res){

                        isine += '<tr>'+
                                    '<td style="text-align:center;">'+res.nama_produk+'</td>'+
                                    '<td style="text-align:center;">'+res.keterangan+'</td>'+
                                    '<td style="text-align:center;">'+res.kuantitas+'</td>'+
                                    '<td style="text-align:center;">'+res.realisasi+'</td>'+
                                    '<td style="text-align:center;">'+res.no_opb+'</td>'+
                                    '<td>'+
                                    	'<button style="width: 100%;" onclick="add_row(&quot;'+res.id_peminjaman_detail+'&quot;,&quot;'+res.nama_produk+'&quot;,&quot;'+res.keterangan+'&quot;,&quot;'+res.no_opb+'&quot;,&quot;'+res.id_produk+'&quot;);" type="button" class="btn btn-success"> Tambah </button>'+
                                    '</td>'+
                                '</tr>';
                    });
                } else {
                    isine = "<tr><td colspan='6' style='text-align:center;'> There are no transaction for this data </td></tr>";
                }

                $('#data_transaction').html(isine);
            }
        });
    }

    function get_supplier(id) {

       
        $.ajax({
            url : '<?php echo base_url(); ?>purchase_order_c/get_transaction_supplier',
            data : {id:id},
            type : "POST",
            dataType : "json",
            success : function(result){
			$('#nama_supplier').val(result.nama_supplier);
			$('#alamat_supplier').val(result.alamat_supplier);
			$('#id_supplier').val(result.id_supplier);
		}
        });
    }

    function tipe_terms(val){
    	$('.cuy').hide();
        if(val == "Proses"){
            $('#prosesi').show();
        } else if(val == "Minggu"){
            $('#payment').show();
        }
    }

</script>

<style type="text/css">
	#data_item tr td input{
		font-size: 15px !important;
	}
</style>

<form role="form" action="<?php echo $url_simpan; ?>" method="post">
<input type="hidden" id="jml_tr" value="1">
<input type="hidden" id="id_purchase" name="id_purchase">

<div class="row" id="form_purchase_order" style="display:none; ">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-sharp hide"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Form Pengembalian Barang</span>
				</div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="buttons">
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="row" style="padding-top: 15px; padding-bottom: 15px;">
					<div class="col-md-12">
						
						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Departemen</b></label>
							<div class="input-group" style="width: 100%; ">
								<select name="dept" class="form-control" onchange="get_transaction(this.value);">
									<option>Pilih Departemen ......</option>
									<?php 
										foreach ($dt_dept as $key => $dt_value) {
											?>
											<option value="<?=$dt_value->id_divisi;?>"><?=$dt_value->nama_divisi;?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Tanggal</b></label>
							<div class="input-group" style="width: 100%;">
								<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?=date('d-m-Y');?>" readonly required>
								<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
							</div>
						</div>

						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Uraian</b></label>
							<div class="input-group" style="width: 100%; ">
								<textarea  rows="3" id="uraian" name="uraian" class="form-control" required></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="padding-top: 15px; padding-bottom: 15px;">
					<div class="col-md-12">
						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Supplier</b></label>
							<div class="input-group" style="width: 100%; ">
								<select name="dept" class="form-control" onchange="get_supplier(this.value);">
									<option>Pilih Supplier ......</option>
									<?php 
										foreach ($dt_supp as $key => $dt_value) {
											?>
											<option value="<?=$dt_value->id_supplier;?>"><?=$dt_value->nama_supplier;?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Nama</b></label>
							<div class="input-group" style="width: 100%;">
								<input type="text" class="form-control" name="nama_supplier" id="nama_supplier" value="">
								<input type="hidden" class="form-control" name="id_supplier" id="id_supplier" value="">
								
							</div>
						</div>
						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Alamat</b></label>
							<div class="input-group" style="width: 100%;">
								<input type="text" class="form-control" name="alamat_supplier" id="alamat_supplier">
								
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;">
					<div class="portlet-body flip-scroll">
						<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
								<tr>
									<th style="text-align: center;  width: 30%;">Nama</th>
									<th style="text-align: center; ">Keterangan</th>
									<th style="text-align: center; ">Permintaan</th>
									<th style="text-align: center; ">Realisasi</th>
									<th style="text-align: center; ">No OPB</th>
									<th style="text-align: center; ">Aksi</th>
								</tr>
							</thead>
							<tbody id="data_transaction">
								<tr>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
								</tr>
							</tbody>
						</table>

						
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<hr style="border: solid #ddd; border-width: 2px 0 0;">
					</div>
				</div>

				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;">
					<div class="portlet-body flip-scroll">
						<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
								<tr>
									<th style="text-align: center;  width: 30%;">Nama</th>
									<th style="text-align: center; ">Keterangan</th>
									<th style="text-align: center; ">Kuantitas</th>
									<th style="text-align: center; ">Harga</th>
									<th style="text-align: center; ">Disc</th>
									<th style="text-align: center; ">Total</th>
									<th style="text-align: center; ">No OPB</th>
									<th style="text-align: center; ">Aksi</th>
								</tr>
							</thead>
							<tbody id="data_item">
								<tr id="tr_1">
									
								</tr>
							</tbody>
						</table>

						
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>

<div class="row" id="tabel_total" style="display:none; ">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-body">
				<div class="row" style="padding-top: 15px;">
					<div class="col-md-12">
						<div class="col-md-3">
							<div style="margin-bottom: 15px;" class="span3">
								<h4 class="control-label"> Sub Total :</h4> 
							</div>
						</div>

						<div class="col-md-3">
							<div style="margin-bottom: 15px;" class="span4">
								<h4 id="subtotal_txt" class="control-label"> Rp. 0.00 </h4> 
								<input type="hidden" id="subtotal_text" name="subtotal_text" class="form-control">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span3">
							<h4 class="control-label"> Potongan PO :</h4> 
						</div>
					</div>
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span4">
							<input type="text" id="pot_po" onkeyup="po(this.value);" name="pot_po" class="form-control">
							<input type="hidden" id="po_text" name="po_text" class="form-control">
						</div>
					</div>
					<div class="col-md-3">
							<div style="margin-bottom: 15px;" class="span4">
								<h4 id="total_po" class="control-label"> Rp. 0.00 </h4> 
							</div>
						</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span3">
							<h4 class="control-label"> PPN :</h4> 
						</div>
					</div>
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span4">
							<input type="text" id="ppn" onkeyup="ppn_ici(this.value);" name="ppn" class="form-control">
							<input type="hidden" id="ppn_text" name="ppn_text" class="form-control">
						</div>
					</div>
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span4">
							<h4 id="total_ppn" class="control-label"> Rp. 0.00 </h4> 
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span3">
							<h4 class="control-label"> PPH :</h4> 
						</div>
					</div>
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span4">
							<input type="text" id="pph" onkeyup="pph_ici(this.value);" name="pph" class="form-control">
							<input type="hidden" id="pph_text" name="pph_text" class="form-control">
							<input type="hidden" id="total_semua" name="total_semua" class="form-control">
						</div>
					</div>
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span4">
							<h4 id="total_pph" class="control-label"> Rp. 0.00 </h4> 
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span3">
							<h4 class="control-label"> Terms Of Payment :</h4> 
						</div>
					</div>
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span4">
							<select class="form-control" name="terms" id="terms" onchange="tipe_terms(this.value);">
								<option value="Tunai">Cash</option>
								<option value="Minggu">Payment</option>
								<option value="Proses">Proses</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div style="margin-bottom: 15px;" class="span4">
							<select class="form-control cuy" name="terms_dua" id="prosesi" style="display: none;">
								<option value="Down Payment">Down Payment</option>
								<option value="Cash Of Delivery">Cash Of Delivery</option>
								<option value="Retensi">Retensi</option>
							</select>
							<input type="text" class="form-control cuy" style="display: none;" id="payment" name="terms_dua" placeholder="Minggu">
						</div>
					</div>
				</div>

				<div class="row" style="padding-top: 35px; padding-bottom: 15px;">
					<div class="col-md-12">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn blue">Simpan</button>
							<button type="button" id="batal" class="btn red" onclick="window.location = '<?php echo base_url(); ?>purchase_order_c'">Batal Dan Kembali</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>
</form>


<button id="tambah_purchase_order" class="btn green">
Tambah Data pengembalian <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="table_purchase_order" style="display:block;">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table pengembalian Barang
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
					<th style="text-align:center;"> No PO</th>
					<th style="text-align:center;"> Tanggal</th>
					<th style="text-align:center;"> Supplier</th>
					<th style="text-align:center;"> Aksi </th>
				</tr>
				</thead>
				<tbody>
					<?php 
					$no = 0 ;
					foreach ($lihat_data as $value) {
						$no++;
					if($value->status == '1'){
				?>
				<tr style="background-color: #cccbce;">
				<?php	
				}else{
				?>
				<tr>
					<?php  } ?>
					<td style="text-align:center; vertical-align:"><?php echo $no; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->no_po; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->tanggal; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->supplier; ?></td>
					<td style="text-align:center; vertical-align: middle;">
						<a class="btn default btn-xs purple" id="ubah" onclick="ubah_data_pengembalian(<?php echo $value->id_purchase?>);"><i class="fa fa-edit"></i> Ubah </a>
						<a class="btn default btn-xs red" id="hapus" onclick="hapus_pengembalian(<?php echo $value->id_purchase?>);"><i class="fa fa-trash-o"></i> Nonaktif </a>
						<a target="_blank" class="btn default btn-xs green" id="hapus" href="<?=base_url();?>purchase_order_c/cetak/<?=$value->id_purchase;?>" ><i class="fa fa-print"></i> Cetak </a>
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