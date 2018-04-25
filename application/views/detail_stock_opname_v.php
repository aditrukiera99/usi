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


$bukti_kas = 'OP'.date('y').date('m').date('d').$no_transaksi;

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

<input id="tr_utama_count" value="<?=count($dt_detail);?>" type="hidden"/>
<div class="row-fluid">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-eye-open"></i> Detail Stock Opname </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Persediaan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li> Stock Opname <span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Detail Stock Opname </li>
		</ul>
	</div>
</div>

<form action="<?=base_url().$post_url;?>" method="post" onsubmit="return cek_form();">
<input type="hidden" name="id_opname" value="<?=$id_opname;?>">
<div class="row-fluid">
<div class="span12" style="background: #F5EADA">
	<div class="span6">
		<div class="row-fluid" style="background: #F5EADA; padding-top: 15px;">
			<div class="span6">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> No Stock Opname </b> </label>
					<div class="controls">
						<input required type="text" class="span12" value="<?=$dt->NO_OPNAME;?>" name="no_stock_opname" id="no_stock_opname" style="font-size: 15px;">
						<input type="hidden" class="span8" value="<?=$no_transaksi;?>" name="no_trx2" id="no_trx2">
						<input type="hidden" class="span8" value="<?=$id_opname;?>" name="id_opname" id="id_opname">
					</div>
				</div>
			</div>	
		</div>

		<div class="row-fluid" style="background: #F5EADA;">
			<div class="span12">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Tipe </b> </label>
					<div class="controls">
						<select tabindex="2" style="width:300px; font-size: 15px;" name="tipe" id="tipe">
							<option <?PHP if($dt->TIPE == 'Quantity'){ echo "checked"; } ?>  value="Quantity">Quantity</option>
							<option <?PHP if($dt->TIPE == 'Quantity2'){ echo "checked"; } ?> value="Quantity2">Quantity & Value</option>
						</select>
					</div>
				</div>
			</div>	
		</div>

		<div class="row-fluid" style="background: #F5EADA;">
			<div class="span12">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Tanggal </b> </label>
					<div class="controls">
						<div id="datetimepicker1" class="input-append date ">
							<input style="width: 50%;" value="<?=$dt->TGL;?>" readonly name="tgl_trx" id="tgl_trx" onclick="$('#add_on_pick').click();" data-format="dd-MM-yyyy" type="text"><span class="add-on "><i id="add_on_pick" data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<div class="span6">
		<div class="row-fluid" style="background: #F5EADA; padding-top: 15px;">
			<div class="span12">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;" id="satuan_txt"> Kode Akun Koreksi </b> </label>
					<div class="controls">
						<select  data-placeholder="Pilih ..." class="chzn-select" tabindex="2" id="kode_akun" name="kode_akun" style="width: 100%;">
								<option value="">Pilih ...</option>
							<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
							<?PHP 
							$sel = "";
							if($dt->KODE_AKUN == $akun_all->KODE_AKUN) { 
								$sel = "selected";
							} else {
								$sel = "";
							}
							?>

								<option <?=$sel;?> value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
							<?PHP } ?>				
						</select>
					</div>
				</div>
			</div>	
		</div>

		<div class="row-fluid" style="background: #F5EADA;">
			<div class="span4">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> No. Ref </b> </label>
					<div class="controls">
						<input type="text" class="span12" value="<?=$dt->NO_REF;?>" name="no_ref" id="no_ref" style="font-size: 15px;">
					</div>
				</div>
			</div>	
		</div>

		<div class="row-fluid" style="background: #F5EADA;">
			<div class="span12">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Catatan </b> </label>
					<div class="controls">
						<textarea rows="4" id="catatan" name="catatan" style="resize:none; height: 87px; width: 90%;"><?=$dt->CATATAN;?></textarea>
					</div>
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
							<th align="center" style="vertical-align: middle; width: 20%;"> Kode Akun </th>
							<th align="center" style="vertical-align: middle; width: 20%;"> Item </th>
							<th align="center" style="vertical-align: middle;"> Qty On Hand </th>
							<th align="center" style="vertical-align: middle;"> Harga Jual On Hand </th>
							<th align="center" style="vertical-align: middle;"> Qty Fisik </th>
							<th align="center" style="vertical-align: middle;"> Harga Jual Fisik </th>
							<th align="center" style="vertical-align: middle;"> Selisih Qty </th>
							<th align="center" style="vertical-align: middle;"> Selisih Harga Jual</th>
							<th align="center" style="vertical-align: middle;"> Aksi </th>
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
											<select  required data-placeholder="Pilih ..." class="chzn-select" tabindex="2"  name="kode_akun_det[]">
												<option value="">Pilih ...</option>
												<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
												<?PHP 
												$sel = "";
												if($row->KODE_AKUN == $akun_all->KODE_AKUN) { 
													$sel = "selected";
												} else {
													$sel = "";
												}
												?>

												<option <?=$sel;?> value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
												<?PHP } ?>				
											</select>
										</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
									<div class="control-group">
										<div class="controls">
											<div class="input-append">
												<input readonly type="text" id="nama_produk_<?=$no;?>" name="nama_produk[]" required style="background:#FFF; width: 70%;" value="<?=$row->NAMA_PRODUK;?>">
												<button onclick="show_pop_produk(<?=$no;?>);" type="button" class="btn" style="width: 25%;">Cari</button>
												<input type="hidden" id="id_produk_<?=$no;?>" name="produk[]" readonly style="background:#FFF;" value="<?=$row->ID_PRODUK;?>">
											</div>
										</div>
									</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input readonly id="qty_<?=$no;?>" style="font-size: 18px; text-align:center; width: 50%;" type="text"  value="<?=$row->STOK;?>" name="qty[]">
								</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input readonly type="text"  value="<?=$row->HARGA_JUAL;?>" name="harga_satuan[]" id="harga_satuan_<?=$no;?>" style="font-size: 18px; text-align:right; width: 80%;">
								</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input required onkeyup="FormatCurrency(this); hitung(<?=$no;?>);" id="qty_fisik_<?=$no;?>" style="font-size: 18px; text-align:center; width: 50%;" type="text"  value="<?=$row->QTY_FISIK;?>" name="qty_fisik[]">
								</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input required onkeyup="FormatCurrency(this); hitung(<?=$no;?>);" id="harga_fisik_<?=$no;?>" type="text" value="<?=$row->HARGA_FISIK;?>" name="harga_satuan_fisik[]" style="font-size: 18px; text-align:right; width: 80%;">
								</div>
								</div>
							</td>						

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input readonly id="qty_selisih_<?=$no;?>" style="font-size: 18px; text-align:center; width: 50%;" type="text"  value="<?=$row->SELISIH_QTY;?>" name="qty_selisih[]">
								</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input readonly id="harga_selisih_<?=$no;?>" type="text" value="<?=$row->SELISIH_HARGA;?>" name="harga_satuan_selisih[]" style="font-size: 18px; text-align:right; width: 80%;">
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

<div class="form-actions">
	<center>
	<input type="submit" value="SIMPAN OPNAME" name="ubah" class="btn btn-info">
	<button class="btn" onclick="window.location='<?=base_url();?>stock_opname_c' " type="button"> BATAL & KEMBALI </button>
	<button class="btn btn-danger" onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$id_opname;?>');" type="button"> HAPUS OPNAME </button>
	</center>
</div>

</form>

<!-- COPY ELEMENT -->
<div style="display:none;" id="copy_ag">
	<td align="center" style="vertical-align:middle;"> 
		<div class="control-group">
			<div class="controls">
				<select  required data-placeholder="Pilih ..." class="cek_select" tabindex="2"  name="kode_akun_det[]" style="width: 100%;">
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

<!-- HAPUS MODAL -->
<a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>
<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete" method="post" action="<?=base_url().$post_url;?>">
            <input type="hidden" name="id_hapus" id="id_hapus" value="" />
        </form>   
         
        <p>Apakah anda yakin ingin menghapus data ini? </p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->

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
                            '<td align="center">Rp '+NumberToMoney(res.HARGA_JUAL).split('.00').join('')+'</td>'+
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
			$('#qty_'+no_form).val(result.STOK);
			$('#id_produk_'+no_form).val(id_produk);
			$('#nama_produk_'+no_form).val(result.NAMA_PRODUK);
			$('#harga_satuan_'+no_form).val(NumberToMoney(result.HARGA_JUAL).split('.00').join(''));

			$('#qty_fisik_'+no_form).val('');
			$('#harga_fisik_'+no_form).val(NumberToMoney(result.HARGA_JUAL).split('.00').join(''));
			$('#qty_selisih_'+no_form).val('');
			$('#harga_selisih_'+no_form).val(0);


			$('#qty_fisik_'+no_form).focus();

			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		}
	});
}


function show_pop_pelanggan(id){
	$('#popup_koang').remove();
    get_popup_pelanggan();
    ajax_pelanggan();
}

function get_popup_pelanggan(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari Supplier...">'+
                '    <div class="table-responsive">'+
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
                ajax_no_bukti();
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
			$('#alamat_tagih').val(result.ALAMAT_TAGIH);
			$('#pelanggan').val(result.NAMA_SUPPLIER);
			$('#pelanggan_sel').val(id_pel);

			$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();
		}
	});
}


function cek_islunas(){
	if($("#is_lunas").is(':checked')){
	    $('#hutang_row').hide(); 
	    $('#sts_lunas').val(1); 
	} else {
	    $('#hutang_row').show(); 
	    $('#sts_lunas').val(0); 
	}
}

function hitung(id){

	hitung_selisih(id);
}

function hitung_selisih(id){
	var qty_fisik = $('#qty_fisik_'+id).val().split(',').join('');
	var harga_satuan_fisik = $('#harga_fisik_'+id).val().split(',').join('');

	if(!qty_fisik){
		qty_fisik = 0;
	}

	if(!harga_satuan_fisik){
		harga_satuan_fisik = 0;
	}

	var qty = $('#qty_'+id).val().split(',').join('');
	var harga_satuan = $('#harga_satuan_'+id).val().split(',').join('');

	var s_qty = parseFloat(qty_fisik - qty);
	var s_harga_satuan = parseFloat(harga_satuan_fisik - harga_satuan);

	$('#qty_selisih_'+id).val(NumberToMoney(s_qty).split('.00').join(''));
	$('#harga_selisih_'+id).val(NumberToMoney(s_harga_satuan).split('.00').join(''));
}


function always_one(id){
	var a = $('#qty_'+id).val();
	if(a <= 0){
		$('#qty_'+id).val(1);
	}
}

function tambah_data() {
	var value =$('#copy_select').html();
	var jml_tr = $('#tr_utama_count').val();
	var i = parseInt(jml_tr) + 1;

	var coa = $('#copy_ag').html();

	$isi_1 = 
	'<tr id="tr_'+i+'" class="tr_utama">'+
		'<td>'+coa+'</td>'+
		'<td align="center" style="vertical-align:middle; text-align:center;"> '+
			'<div class="span12">'+
				'<div class="control-group">'+
					'<div class="controls">'+
						'<div class="input-append">'+
							'<input readonly type="text" id="nama_produk_'+i+'" name="nama_produk[]" required style="background:#FFF; width: 70%;">'+
							'<button onclick="show_pop_produk('+i+');" type="button" class="btn" style="width: 25%;">Cari</button>'+
							'<input type="hidden" id="id_produk_'+i+'" name="produk[]" readonly style="background:#FFF;" value="0">'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle; text-align:center;"> '+
			'<div class="span12">'+
			'<div class="controls">'+
				'<input readonly id="qty_'+i+'" style="font-size: 18px; text-align:center; width: 50%;" type="text"  value="" name="qty[]">'+
			'</div>'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle; text-align:center;">'+
			'<div class="span12">'+
			'<div class="controls">'+
				'<input readonly type="text"  value="" name="harga_satuan[]" id="harga_satuan_'+i+'" style="font-size: 18px; text-align:right; width: 80%;">'+
			'</div>'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle; text-align:center;">'+
			'<div class="span12">'+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this); hitung('+i+');" id="qty_fisik_'+i+'" style="font-size: 18px; text-align:center; width: 50%;" type="text"  value="" name="qty_fisik[]">'+
			'</div>'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle; text-align:center;">'+
			'<div class="span12">'+
			'<div class="controls">'+
				'<input onkeyup="FormatCurrency(this); hitung('+i+');" id="harga_fisik_'+i+'" type="text" value="" name="harga_satuan_fisik[]" style="font-size: 18px; text-align:right; width: 80%;">'+
			'</div>'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle; text-align:center;"> '+
			'<div class="span12">'+
			'<div class="controls">'+
				'<input readonly id="qty_selisih_'+i+'" style="font-size: 18px; text-align:center; width: 50%;" type="text"  value="" name="qty_selisih[]">'+
			'</div>'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle; text-align:center;"> '+
			'<div class="span12">'+
			'<div class="controls">'+
				'<input readonly id="harga_selisih_'+i+'" type="text" value="" name="harga_satuan_selisih[]" style="font-size: 18px; text-align:right; width: 80%;">'+
			'</div>'+
			'</div>'+
		'</td>'+


		'<td style="background:#FFF; vertical-align: middle; text-align:center;"> '+
			'<div class="span12">'+
			'<button style="width: 100%;" onclick="hapus_row('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
			'</div>'+
		'</td>'+
	'</tr>';

	$('#tes').append($isi_1);

	$('#tr_utama_count').val(i);

	$('#tr_'+i).find('.cek_select').attr('class', 'cek_select_'+i);
	$(".cek_select_"+i).chosen();

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
				$('#kode_akun_pajak').val(result.PAJAK_PEMBELIAN);
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
			url : '<?php echo base_url(); ?>transaksi_pembelian_c/simpan_add_produk',
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

function hapus_row (id) {
	$('#tr_'+id).remove();
	hitung_total_semua();
}

function cek_form() {
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
</script>