<?PHP 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
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

<input id="tr_utama_count" value="<?=count($dt_produksi_detail);?>" type="hidden"/>
<div class="row-fluid">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-plus"></i> Ubah Komposisi Produk </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Produksi</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li> Komposisi Produk <span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Ubah Komposisi Produk  </li>
		</ul>
	</div>
</div>

<form action="<?=base_url().$post_url;?>" method="post" onsubmit="return cek_form();">
<input type="hidden" name="id_produksi" value="<?=$id_produksi;?>">
<div class="row-fluid">
<div class="span12" style="background: #F5EADA">
	<div class="span6">
		<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-left: 15px;">
			<div class="span6">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Pilih Item Produksi </b> </label>
					<div class="controls">
						<input readonly class="span12" type="text" value="<?=$dt_produksi->NAMA_PRODUK;?>" name="item_txt" style="background: #FFF;"/>
						<input type="hidden" value="<?=$dt_produksi->ID_ITEM;?>" name="item"/>
					</div>
				</div>
			</div>	

			<div class="span6">
				<div class="control-group" style="margin-left: 10px;">
					<label class="control-label"> <b style="font-size: 14px;"> Pilih Kode Akun </b> </label>
					<div class="controls">
						<select  required data-placeholder="Pilih ..." class="chzn-select" tabindex="2"  name="kode_akun_utama">
							<option value="">Pilih ...</option>
							<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
							<option value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
							<?PHP } ?>				
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	
</div>
</div>

<br>
<center>
<h3 class="page-header"> BAHAN BAKU </h3>	
</center>

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
							<th align="center" style="vertical-align: middle;"> Kode Item </th>
							<th align="center" style="vertical-align: middle;"> Stok </th>
							<th align="center" style="vertical-align: middle;"> Qty for Produce </th>
							<th align="center" style="vertical-align: middle;"> Aksi </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						$no = 0;
						foreach ($dt_produksi_detail as $key => $row) {
							$no++;
						?>
						<tr id="tr_<?=$no;?>" class="tr_utama">
							<td align="left" style="vertical-align:middle;"> 
								<div class="control-group">
										<div class="controls">
											<select  required data-placeholder="Pilih ..." class="chzn-select" tabindex="2"  name="kode_akun[]">
												<option value="">Pilih ...</option>
												<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
												<option value="<?=$akun_all->KODE_AKUN;?>"> (<?=$akun_all->KODE_AKUN;?>) - <?=$akun_all->NAMA_AKUN;?></option>
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
												<input type="hidden" id="id_produk_<?=$no;?>" name="produk[]" readonly style="background:#FFF;" value="<?=$row->ID_BAHAN;?>">
											</div>
										</div>
									</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input readonly id="kode_item_<?=$no;?>" style="font-size: 15px; text-align:center; width: 50%;" type="text"  value="<?=$row->KODE_PRODUK;?>" name="kode_item[]">
								</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<input readonly id="stok_<?=$no;?>" style="font-size: 15px; text-align:center; width: 50%;" type="text"  value="<?=$row->STOK;?>" name="stok[]">
								</div>
								</div>
							</td>

							<td align="center" style="vertical-align:middle;"> 
								<div class="span12">
								<div class="controls">
									<div class="input-append">
										<input id="qty_<?=$no;?>" type="text" value="<?=$row->QTY;?>" name="qty[]" required style="font-size: 15px; text-align:center; width: 30%;" onkeyup="FormatCurrency(this);">
										<input id="satuan_item_<?=$no;?>" type="hidden" value="<?=$row->SATUAN;?>" name="satuan[]">
										<span class="add-on" id="satuan_<?=$no;?>"><?=$row->SATUAN;?></span>
									</div>
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
	<input type="submit" value="UBAH KOMPOSISI PRODUK" name="ubah" class="btn btn-info">
	<button class="btn" onclick="window.location='<?=base_url();?>barang_produksi_c' " type="button"> BATAL & KEMBALI </button>
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
			$('#stok_'+no_form).val(result.STOK+' '+result.SATUAN);
			$('#id_produk_'+no_form).val(id_produk);
			$('#nama_produk_'+no_form).val(result.NAMA_PRODUK);
			$('#kode_item_'+no_form).val(result.KODE_PRODUK);
			$('#satuan_'+no_form).html(result.SATUAN);
			$('#satuan_item_'+no_form).val(result.SATUAN);
			$('#qty_'+no_form).focus();

			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		}
	});
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
		'<td align="center" style="vertical-align:middle; text-align:center;">'+ 
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
				'<input readonly id="kode_item_'+i+'" style="text-align:center; width: 50%; font-size:15px;" type="text"  value="" name="kode_item[]">'+
			'</div>'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle; text-align:center;"> '+
			'<div class="span12">'+
			'<div class="controls">'+
				'<input readonly id="stok_'+i+'" style="text-align:center; width: 50%; font-size:15px;" type="text"  value="" name="stok[]">'+
			'</div>'+
			'</div>'+
		'</td>'+

		'<td align="center" style="vertical-align:middle; text-align:center;"> '+
			'<div class="span12">'+
			'<div class="controls">'+
				'<div class="input-append">'+
					'<input required id="qty_'+i+'" type="text" value="" name="qty[]"  style="font-size: 15px; text-align:center; width: 30%;" onkeyup="FormatCurrency(this);">'+
					'<input id="satuan_item_'+i+'" type="hidden" value="" name="satuan[]">'+
					'<span class="add-on" id="satuan_'+i+'">Kg</span>'+
				'</div>'+
			'</div>'+
			'</div>'+
		'</td>'+


		'<td style="background:#FFF; text-align:center; vertical-align: middle;"> '+
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



function hapus_row (id) {
	$('#tr_'+id).remove();
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