<?PHP 
$no_transaksi = 1;
$no_transaksi2 = 1;
if($get_no_trx_akun->NEXT != "" || $get_no_trx_akun->NEXT != null ){
	$no_transaksi = $get_no_trx_akun->NEXT+1;
	$no_transaksi2 = $get_no_trx_akun->NEXT+1;
}

$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$no_transaksi = str_pad($no_transaksi, 3, '0', STR_PAD_LEFT);

?>

<style type="text/css">

input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1); /* IE */
  -moz-transform: scale(1); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  padding: 10px;
}

#is_showed
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 10px;
}

</style>



<form class="" method="post" action="<?=base_url().$post_url;?>" onsubmit = "return cek_balance();";>

<input type="hidden" id="total_debet_all" name="total_debet_all" value="0">
<input type="hidden" id="total_kredit_all" name="total_kredit_all" value="0">
<input type="hidden" id="no_trx_akun2" name="no_trx_akun2" value="<?=$no_transaksi2;?>">

<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-plus-sign"></i>  Input Transaksi Akuntansi </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Input Akuntansi</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Input Transaksi Akuntansi </li>
		</ul>
	</div>
</div>

<div class="breadcrumb" style="display: none;">
	<center>
		<button onclick="window.location='<?=base_url();?>input_transaksi_akuntansi_c/ubah';" class="btn btn-warning" type="button"> <i class="icon-pencil"></i> Ubah Transaksi Akuntansi </button>
	</center>
</div>


<div class="row-fluid form-horizontal" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Unit </b> </label>
				<div class="controls">
					<div class="input-append">
						<input style="width: 90%;" type="text" id="unit_txt" name="unit_txt" value="<?=$user->NAMA_UNIT;?>" readonly>
						<input style="width: 90%;" type="hidden" id="unit" name="unit" value="<?=$user->UNIT;?>">
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> No. Bukti Kas </b> </label>
				<div class="controls">
					<input type="text" id="no_trx_akun" name="no_trx_akun" value="<?=$no_transaksi.".".date('m').".".date('Y')."/TA";?>" readonly style="background:#FFF; width: 90%;">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> </b> </label>
				<div class="controls">
					<label class="radio inline">
					<input type="radio" value="BELI" id="chk_BELI" name="tipe_bukti" checked onclick="$('#kode_akun_add').val('501.02.01'); updated_ll();">
					Pembelian </label>
					<label class="radio inline">
					<input type="radio" value="JUAL" id="chk_JUAL" name="tipe_bukti" onclick="$('#kode_akun_add').val('110.02.01'); updated_ll();">
					Penjualan </label>
					<!-- <label class="radio inline">
					<input type="radio" value="LAIN" id="chk_LAIN" name="tipe_bukti">
					Transaksi Lainnya </label> -->
				</div>
			</div>


			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> No. Transaksi </b> </label>
				<div class="controls">
					<div class="input-append">
						<input style="width: 90%;" type="text" id="no_bukti" name="no_bukti" readonly style="background:#FFF;">
						<button onclick="show_pop_no_bukti();" type="button" class="btn">Cari</button>
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Tanggal Transaksi </b> </label>
					<div class="controls">
						<div id="datetimepicker1" class="input-append date ">
							<input style="width: 90%;" value="<?=date('d-m-Y');?>" readonly name="tgl_trx" id="tgl_trx" onclick="$('#add_on_pick').click();" data-format="dd-MM-yyyy" type="text"><span class="add-on "><i id="add_on_pick" data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
						</div>
					</div>
			</div>

			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Tipe </b> </label>
				<div class="controls">
					<div class="input-append">
						<input style="width: 90%;" type="text" id="tipe" name="tipe" value="" readonly>
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Rekanan </b> </label>
				<div class="controls">
					<div class="input-append">
						<input style="width: 90%;" type="text" id="kontak" name="kontak" value="" readonly>
					</div>
				</div>
			</div>

			<div class="control-group" style="display: none;">
				<label class="control-label"> <b style="font-size: 14px;"> Alamat </b> </label>
					<div class="controls">
						<textarea readonly rows="4" id="alamat_kontak" name="alamat_kontak" style="resize:none; height: 87px; width: 80%;"></textarea>
					</div>
			</div> 			
		</div>

		<div class="span6">
			<div class="control-group" style="display: none;">
				<label class="control-label"> <b style="font-size: 14px;"> Pajak </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="pajak" name="pajak" value="" readonly style="width: 90%;">
					</div>
				</div>
			</div>

			<div class="control-group" style="display: none;">
				<label class="control-label"> <b style="font-size: 14px;"> Nilai Pajak </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="nilai_pajak" name="nilai_pajak" value="" readonly style="width: 90%;">
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Total Transaksi </b> </label>
				<div class="controls">
					<div class="input-append">
						<input type="text" id="nilai_total" name="nilai_total" value="" readonly style="width: 90%;">
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label"> <b style="font-size: 14px;"> Uraian </b> </label>
					<div class="controls">
						<textarea rows="4" id="uraian" name="uraian" style="resize:none; height: 87px; width: 80%;"></textarea>
					</div>
			</div>

			<div class="control-group" style="display: none;">
				<label class="control-label"> <b style="font-size: 14px;"> Status </b> </label>
				<div class="controls">
					<label class="control-label" style="text-align:left;"> 
						<b id="lunas_sts" style="display:none; font-size: 17px; color:green;"> Lunas </b> 
						<b id="gak_lunas_sts" style="display:none; font-size: 17px; color:red;"> Belum Lunas </b> 
					</label>
				</div>
			</div>

		</div>
	</div>
</div>

<div style="margin-bottom: 15px;" class="span4 detail_transaksi">
	<div class="controls">
		<label class="checkbox" style="font-size: 16px;">
		<input type="checkbox" checked name="is_showed" id="is_showed" value="" onclick="show_detail();">
		Tampilkan Detail </label>
	</div>
</div>

<div class="row-fluid detail_transaksi" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span12" id="detail_view">
		<div class="widget-head orange">
			<h3> Detail Transaksi </h3>
		</div>
		<table class="stat-table table table-hover">
			<thead>
				<tr>
					<th align="center"> No </th>
					<th align="center"> Item </th>
					<th align="center"> Volume </th>
					<th align="center"> Satuan </th>
					<th align="center"> Harga Satuan (Rp) </th>
					<th align="center"> Total (Rp) </th>
				</tr>						
			</thead>
			<tbody id="tes" style="font-size: 13px;">
				<tr> <td colspan="6" align="center"> <b> Silahkan pilih Nomor Bukti terlebih dahulu untuk melihat detail transaksi </b> </td> </tr>
			</tbody>

			<tfoot>
				<tr>
					<td style="background:#F1F1F1;" colspan="5" align="center"> <b style="font-size:14px;"> TOTAL </b> </td>
					<td style="background:#F1F1F1; font-size:15px; color: green;" align="right" id="sub_total_trx_detail2">  </td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<div class="row-fluid" style="background: #F5EADA;">
	<div class="span3" style="margin-left: 10px;">
		<div class="control-group">
		    <label class="control-label"> <b style="font-size: 14px;"> Kode Akun </b> </label>
			<div class="controls">
				<select  data-placeholder="Pilih ..." class="chzn-select" tabindex="2" id="kode_akun_add" name="kode_akun_add" style="width: 100%;">
					<?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
						<?PHP 
						$sel = "";
						if($akun_all->KODE_AKUN == "501.02.01"){
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
	</div>

	<div class="span3" style="margin-left: 10px;">
		<div class="control-group">
			<label class="control-label"> <b style="font-size: 14px;"> Debet </b> </label>
			<div class="controls">
				<div class="input-append">
					<input style="width: 80%;"  onkeyup="FormatCurrency(this);" type="text" id="debet_add" name="debet_add" value="">
				</div>
			</div>
		</div>
	</div>

	<div class="span3" style="margin-left: 10px;">
		<div class="control-group">
			<label class="control-label"> <b style="font-size: 14px;"> Kredit </b> </label>
			<div class="controls">
				<div class="input-append">
					<input style="width: 80%;"  onkeyup="FormatCurrency(this);" type="text" id="kredit_add" name="kredit_add" value="">
				</div>
			</div>
		</div>
	</div>

	<div class="span3" style="margin-left: 10px; margin-top: 20px;">
		<button style="width: 80%;" onclick="add_row();" class="btn btn-info" type="button"> <i class="icon-plus"></i> Tambahkan </button>
	</div>
</div>



<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
	<div class="span12">
		<div class="widget-head blue">
			<h3> Input Transaksi </h3>
		</div>

		<table class="stat-table table table-hover">
			<thead>
				<tr>
					<th align="center"> Kode Akun </th>
					<th align="center"> Nama Akun </th>
					<th align="center"> Debet (Rp) </th>
					<th align="center"> Kredit (Rp) </th>
					<th align="center"> Aksi </th>
				</tr>						
			</thead>
			<tbody id="tes_row" style="font-size: 13px;">
				<tr> <td colspan="6" align="center"> <b> </b> </td> </tr>
			</tbody>

			<tfoot>
				<tr>
					<td style="background:#F1F1F1;" colspan="2" align="center"> <b> TOTAL </b> </td>
					<td style="background:#F1F1F1;" align="right"> <b style="font-size: 13px;" id="tot_debet_txt"> 0 </b> </td>
					<td style="background:#F1F1F1;" align="right"> <b style="font-size: 13px;" id="tot_kredit_txt"> 0 </b> </td>
					<td style="background:#F1F1F1;" align="right">  </td>
				</tr>

				<tr>
					<td style="background:#F1F1F1;" colspan="2" align="center"> <b> SELISIH DEBET & KREDIT </b> </td>
					<td style="background:#F1F1F1;" colspan="2"  align="center"> <b style="color:red; font-size: 13px;" id="tot_debet_sel"> 0 </b> </td>
					<td style="background:#F1F1F1;" align="right">  </td>
				</tr>
			</tfoot>
		</table>
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
					<input type="hidden" name="total_all" id="total_all" value="" />
					<input type="submit" value="Simpan Transaksi" name="simpan" class="btn btn-success">
					<button class="btn" onclick="window.location='<?=base_url();?>input_transaksi_akuntansi_c' " type="button"> Batal dan Kembali </button>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>

</form>



<!-- COPY ELEMENT -->
<div style="display:none;">
	<select  data-placeholder="Pilih ..." class="chzn-select3" tabindex="2" style="width:300px;" name="kode_akun[]" id="copy_select_jual">
	<?PHP
		$sel = ""; 
		foreach ($get_list_akun_all as $key => $akun_all) { 
			if($akun_all->KODE_AKUN == "4-4000" ){
				$sel = "selected";
			} else {
				$sel = "";
			}
	?>
		<option <?=$sel;?> value="<?=$akun_all->KODE_AKUN;?>"> <?=$akun_all->KODE_AKUN;?> - <?=$akun_all->NAMA_AKUN;?></option>
	<?PHP } ?>					
	</select>

	<select  data-placeholder="Pilih ..." class="chzn-select3" tabindex="2" style="width:300px;" name="kode_akun[]" id="copy_select_beli">
	<?PHP
		$sel = ""; 
		foreach ($get_list_akun_all as $key => $akun_all) { 
			if($akun_all->KODE_AKUN == "5-5900" ){
				$sel = "selected";
			} else {
				$sel = "";
			}
	?>
		<option <?=$sel;?> value="<?=$akun_all->KODE_AKUN;?>"> <?=$akun_all->KODE_AKUN;?> - <?=$akun_all->NAMA_AKUN;?></option>
	<?PHP } ?>					
	</select>
</div>

<!-- END COPY ELEMENT -->

<script type="text/javascript">
<?PHP if($tipe_1 != "" && $id_bukti != ""){ ?>
$( document ).ready(function() {
    get_transaksi('<?=$id_bukti;?>', '<?=$tipe_1;?>');

});
<?PHP } ?>


function show_pop_no_bukti(id){
    get_popup_no_bukti();
    ajax_no_bukti();
}

function get_popup_no_bukti(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari No. Bukti...">'+
                '    <div class="table-responsive" style="overflow-y: auto; height: 500px;">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap;">NO TRANSAKSI</th>'+
                // '                        <th>TOTAL (Rp)</th>'+
                '                        <th>TIPE</th>'+
                '                        <th style="width: 20%;">TOTAL</th>'+
                '                        <th style="width: 20%;">URAIAN</th>'+
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

function ajax_no_bukti(){
    var keyword = $('#search_koang').val();
    var tipe_bukti = $('input[name=tipe_bukti]:checked').val();
    $.ajax({
        url : '<?php echo base_url(); ?>input_transaksi_akuntansi_c/get_no_bukti',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
            tipe_bukti : tipe_bukti,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;
                tipe_data = "Penjualan";
                if(res.TIPE == "BELI"){
                	tipe_data = "Pembelian / Biaya";
                } else if(res.TIPE == "LAIN"){
                	tipe_data = "Transaksi Lainnya";
                }

                isine += '<tr onclick="get_transaksi(\'' +res.ID+ '\',\'' +res.TIPE+ '\');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.NO_BUKTI+'</td>'+
                            '<td align="center">'+tipe_data+'</td>'+
                            '<td align="right" style="text-align:left;">Rp '+NumberToMoney(res.TOTAL).split('.00').join('')+'</td>'+
                            '<td align="center">'+res.MEMO+'</td>'+
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

function get_transaksi(id , tipe){

	if(tipe == "b"){
		tipe = "BELI";
		$('#chk_BELI').attr('checked', true);
	} else if(tipe == "j"){
		tipe = "JUAL";
		$('#chk_JUAL').attr('checked', true);
	} else if(tipe == "l"){
		tipe = "LAIN";
		$('#chk_LAIN').attr('checked', true);
	}

	$('#tes_row').html('');
	$.ajax({
        url : '<?php echo base_url(); ?>input_transaksi_akuntansi_c/get_transaksi',
        type : "POST",
        dataType : "json",
        data : {
            id : id,
            tipe : tipe,
        },
        success : function(res){

        	// var pajak = res.NAMA_PAJAK+" ("+res.PROSEN+"%)";
        	// if(res.NAMA_PAJAK == null){
        	// 	pajak = "-";
        	// }

        	var no_akun_pajak = "";
        	if(res.TIPE_TRX == "JUAL"){
        		$('#tipe').val('Penjualan');
        		// no_akun_pajak = res.PAJAK_PENJUALAN;
        	} else if(res.TIPE_TRX == "BELI"){
        		$('#tipe').val('Pembelian');
        		// no_akun_pajak = res.PAJAK_PEMBELIAN;
        	}

        	$('#no_bukti').val(res.NO_BUKTI);
        	$('#tgl_trx').val(res.TGL_TRX);
        	$('#kontak').val(res.PELANGGAN);
        	$('#alamat_kontak').val(res.ALAMAT_TUJUAN);
        	$('#uraian').val(res.KETERANGAN);
        	// $('#pajak').val(pajak);
        	// $('#nilai_pajak').val(NumberToMoney(res.NILAI_PAJAK).split('.00').join(''));
        	$('#nilai_total').val(NumberToMoney(res.HARGA_INVOICE).split('.00').join(''));
        	$('#sub_total_trx_detail').html("<b style='font-size:15px; color:green;'>"+NumberToMoney(res.HARGA_INVOICE).split('.00').join('')+"</b>");

        	$('#search_koang').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide();

		    if(tipe != "LAIN"){
		    	// $('.detail_transaksi').show();
		    	get_transaksi_detail(id, tipe);
		    } else {
		    	// $('.detail_transaksi').hide();
		    	get_transaksi_detail(id, tipe);
		    }

		    // get_transaksi_detail_akuntansi(id, tipe);

		    //get_row_trx(res.TIPE_TRX, res.SUB_TOTAL);

		    //   if(res.NAMA_PAJAK != null){
            //   	get_pajak_row(res.TIPE_TRX, no_akun_pajak, res.NILAI_PAJAK);
            //   }

        	hitung_total_row();
        }
    });


}

function get_transaksi_detail(id, tipe){
	$.ajax({
        url : '<?php echo base_url(); ?>input_transaksi_akuntansi_c/get_transaksi_detail',
        type : "POST",
        dataType : "json",
        data : {
            id : id,
            tipe : tipe,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var total = 0;            
            $.each(result,function(i,res){
                no++;
                if(tipe == "BELI"){
                	isine += '<tr>'+
                            '<td style="text-align:center;">'+no+'</td>'+
                            '<td style="text-align:left;">'+res.NAMA_PRODUK+'</td>'+
                            '<td style="text-align:center;">'+res.QTY+'</td>'+
                            '<td style="text-align:center;">'+res.SATUAN+'</td>'+
                            '<td style="text-align:right;">'+NumberToMoney(res.MODAL).split('.00').join('')+'</td>'+
                            '<td style="text-align:right;"><b>'+NumberToMoney(parseFloat(res.MODAL) * parseFloat(res.QTY)).split('.00').join('')+'</b></td>'+
                        '</tr>';
                 	total += parseFloat(res.MODAL) * parseFloat(res.QTY);

                } else {
                	isine += '<tr>'+
                            '<td style="text-align:center;">'+no+'</td>'+
                            '<td style="text-align:left;">'+res.NAMA_PRODUK+'</td>'+
                            '<td style="text-align:center;">'+res.QTY+'</td>'+
                            '<td style="text-align:center;">'+res.SATUAN+'</td>'+
                            '<td style="text-align:right;">'+NumberToMoney(res.HARGA_INVOICE).split('.00').join('')+'</td>'+
                            '<td style="text-align:right;"><b>'+NumberToMoney(parseFloat(res.HARGA_INVOICE) * parseFloat(res.QTY)).split('.00').join('')+'</b></td>'+
                        '</tr>';
                 	total += parseFloat(res.HARGA_INVOICE) * parseFloat(res.QTY);
                }
                
            });
            $('#tes').html(isine); 
            $('#nilai_total').val(NumberToMoney(total).split('.00').join('')); 
            $('#sub_total_trx_detail2').html(NumberToMoney(total).split('.00').join('')); 

        }
    });
}

function get_transaksi_detail_akuntansi(id, tipe){
	$.ajax({
        url : '<?php echo base_url(); ?>input_transaksi_akuntansi_c/get_transaksi_detail',
        type : "POST",
        dataType : "json",
        data : {
            id : id,
            tipe : tipe,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){

            	if(tipe == "BELI"){
					var kredit = 0;
            	    var debet  = res.TOTAL;
				} else if(tipe == "JUAL"){
					var kredit = res.TOTAL;
            		var debet  = 0;
				} else if(tipe == "LAIN"){
					
            		if(res.KATEGORI == 'Akun Hutang'){
            			var kredit = res.TOTAL;
            			var debet  = 0;
            		} else if(res.KATEGORI == 'Akun Piutang'){
            			var kredit = 0;
            	    	var debet  = res.TOTAL;
            		} else {
            			var kredit = 0;
            	    	var debet  = res.TOTAL;
            		}
				}           	
            	

                no++;
                isine += 
					"<tr class='tr_row' id='tr_"+no+"'>"+
						"<td style='background:#FFF; text-align:center'><input type='hidden' name='kode_akun_row[]' value='"+res.KODE_AKUN+"'/> "+res.KODE_AKUN+"</td>"+
						"<td style='background:#FFF; text-align:left'>"+res.NAMA_AKUN+"</td>"+
						"<td style='background:#FFF; text-align:right;'> <input type='hidden' class='deb_row' name='debet_row[]' value='"+debet+"'/> "+NumberToMoney(debet).split('.00').join('')+"</td>"+
						"<td style='background:#FFF; text-align:right;'> <input type='hidden' class='kre_row' name='kredit_row[]' value='"+kredit+"'/>"+NumberToMoney(kredit).split('.00').join('')+"</td>"+
						"<td style='background:#FFF; text-align:center;'> <button onclick='hapus_row("+no+");' type='button' class='btn btn-danger'> Hapus </button> </td>"+
					"</tr>";

			 	$('#debet_add').val("");
			 	$('#kredit_add').val("");
            });

            $('#tes_row').html(isine); 
            hitung_total_row();
        }
    });
}

function get_row_trx(tipe, sub_total){
	
	var debet = 0;
	var kredit = 0;
	var value = "";
	var nama_akun = "";

	if(tipe == "JUAL"){
		debet  = 0;
		kredit = sub_total;
		var value = $('#copy_select_jual').html();
		var nama_akun = "Penjualan";
	} else if(tipe == "BELI"){
		debet  = sub_total;
		kredit = 0;
		var value = $('#copy_select_beli').html();
		var nama_akun = "Biaya Produksi";
	}

	var i = $('.tr_row').length + 1;

	$isi = 
	"<tr class='tr_row' id='tr_"+i+"'>"+
	 	"<td style='background:#FFF; text-align:left; width: 255px;' align='center'>"+
	 		"<select onchange='get_kode_akun_rinci(this.value);'  data-placeholder='Pilih ...' class='chzn-select_1' tabindex='2' style='width:250px;' name='kode_akun_row[]' id='sel_chos_1'>"+
			"</select>"+
	 	"</td>"+
	 	"<td style='background:#FFF; text-align:left' id='nama_akun_row' >"+nama_akun+"</td>"+
	 	"<td style='background:#FFF; text-align:right;'> <input type='hidden' class='deb_row' name='debet_row[]' value='"+debet+"'/> "+NumberToMoney(debet).split('.00').join('')+"</td>"+
	 	"<td style='background:#FFF; text-align:right;'> <input type='hidden' class='kre_row' name='kredit_row[]' value='"+kredit+"'/>"+NumberToMoney(kredit).split('.00').join('')+"</td>"+
	 	"<td style='background:#FFF; text-align:center;'> <button onclick='hapus_row("+i+");' type='button' class='btn btn-danger'> Hapus </button> </td>"+
	"</tr>";

	$('#tes_row').html($isi);

	$("#sel_chos_1").html(value);
	$(".chzn-select_1").chosen();

    $(".chzn-select-deselect").chosen({
        allow_single_deselect: true
    });

    hitung_total_row();
}

function get_pajak_row(tipe, no_akun, nilai_pajak){
	$.ajax({
        url : '<?php echo base_url(); ?>input_transaksi_akuntansi_c/get_pajak_row',
        type : "POST",
        dataType : "json",
        data : {
            no_akun : no_akun,
        },
        success : function(result){

		 var nama_akun = result.NAMA_AKUN;
		 var debet = 0;
		 var kredit = 0;

		 if(tipe == "JUAL"){
		 	debet  = 0;
		 	kredit = nilai_pajak;
    	 } else if(tipe == "BELI"){
    	 	debet  = nilai_pajak;
    	 	kredit = 0;
    	 }
    	 var i = $('.tr_row').length + 1;

		 $isi = 
		 "<tr class='tr_row' id='tr_"+i+"'>"+
		 	"<td style='background:#FFF; text-align:center'><input type='hidden' name='kode_akun_row[]' value='"+no_akun+"'/> "+no_akun+"</td>"+
		 	"<td style='background:#FFF; text-align:left'>"+nama_akun+"</td>"+
		 	"<td style='background:#FFF; text-align:right;'> <input type='hidden' class='deb_row' name='debet_row[]' value='"+debet+"'/> "+NumberToMoney(debet).split('.00').join('')+"</td>"+
		 	"<td style='background:#FFF; text-align:right;'> <input type='hidden' class='kre_row' name='kredit_row[]' value='"+kredit+"'/>"+NumberToMoney(kredit).split('.00').join('')+"</td>"+
		 	"<td style='background:#FFF; text-align:center;'> <button onclick='hapus_row("+i+");' type='button' class='btn btn-danger'> Hapus </button> </td>"+
		 "</tr>";

		 $('#tes_row').append($isi);
		 hitung_total_row();

        }
    });
}

function get_kode_akun_rinci(no_akun){
	$.ajax({
        url : '<?php echo base_url(); ?>input_transaksi_akuntansi_c/get_kode_akun_rinci',
        type : "POST",
        dataType : "json",
        data : {
            no_akun : no_akun,
        },
        success : function(result){
        	$('#nama_akun_row').html(result.NAMA_AKUN);
        }
    });
}

function hitung_total_row(){
	var tot_deb = 0;
	$(".deb_row").each(function(idx, elm) {
		var tot = elm.value.split(',').join('');
		if(tot > 0){
    		tot_deb += parseFloat(tot);
		}
    });

    var tot_kre = 0;
	$(".kre_row").each(function(idx, elm) {
		var tot2 = elm.value.split(',').join('');
		if(tot2 > 0){
    		tot_kre += parseFloat(tot2);
		}
    });

    var selisih = 0;
    selisih = parseFloat(tot_deb) - parseFloat(tot_kre);


    if(selisih < 0){
    	$('#tot_debet_sel').html(NumberToMoney(selisih*-1).split('.00').join(''));
    } else if(selisih > 0){
    	$('#tot_debet_sel').html(NumberToMoney(selisih).split('.00').join(''));
    } else {
    	$('#tot_debet_sel').html(0);
    }

    $('#total_debet_all').val(tot_deb);
    $('#total_kredit_all').val(tot_kre);

    $('#tot_debet_txt').html(NumberToMoney(tot_deb).split('.00').join(''));
    $('#tot_kredit_txt').html(NumberToMoney(tot_kre).split('.00').join(''));
}

function add_row(){
	var no_bukti  = $('#no_bukti').val();
	var no_akun  = $('#kode_akun_add').val();
	var debet  = $('#debet_add').val();
	var kredit = $('#kredit_add').val();

	if(no_bukti == ""){
		alert("Silahkan pilih nomor bukti terlebih dahulu");
	} else if(debet != "" && kredit != ""){
		alert("Debet dan Kredit tidak bisa di isi bersamaan");
	} else {

		if(debet == "" && kredit == ""){
			alert('Mohon isikan nilai debet atau kredit');
		} else {

		debet  = debet.split(',').join('');
		kredit = kredit.split(',').join('');

		if(debet == ""){
			debet = 0;
		}

		if(kredit == ""){
			kredit = 0;
		}

		var i = $('.tr_row').length + 1;
		$.ajax({
	        url : '<?php echo base_url(); ?>input_transaksi_akuntansi_c/get_kode_akun_rinci',
	        type : "POST",
	        dataType : "json",
	        data : {
	            no_akun : no_akun,
	        },
	        success : function(result){
	        	$isi = 
				 "<tr class='tr_row' id='tr_"+i+"'>"+
				 	"<td style='background:#FFF; text-align:center'><input type='hidden' name='kode_akun_row[]' value='"+no_akun+"'/> "+no_akun+"</td>"+
				 	"<td style='background:#FFF; text-align:left'>"+result.NAMA_AKUN+"</td>"+
				 	"<td style='background:#FFF; text-align:right;'> <input type='hidden' class='deb_row' name='debet_row[]' value='"+debet+"'/> "+NumberToMoney(debet).split('.00').join('')+"</td>"+
				 	"<td style='background:#FFF; text-align:right;'> <input type='hidden' class='kre_row' name='kredit_row[]' value='"+kredit+"'/>"+NumberToMoney(kredit).split('.00').join('')+"</td>"+
				 	"<td style='background:#FFF; text-align:center;'> <button onclick='hapus_row("+i+");' type='button' class='btn btn-danger'> Hapus </button> </td>"+
				 "</tr>";

			 $('#tes_row').append($isi);
			 hitung_total_row();

			 $('#debet_add').val("");
			 $('#kredit_add').val("");

	        }
	    });

	    }
    }
}

function hapus_row (id) {
	$('#tr_'+id).remove();
	hitung_total_row();
}

function show_detail(){
	if($("#is_showed").is(':checked')){
	    $('#detail_view').show(); 
	} else {
	    $('#detail_view').hide(); 
	}
}

function cek_balance(){
	$deb = $('#total_debet_all').val();
	$kre = $('#total_kredit_all').val();
	$nobuk = $('#no_bukti').val();

	$kon = false;
	if($nobuk == "" || $nobuk == null){
		alert('No. Bukti tidak boleh kosong !!');
		$kon = false;
	} else {		
		if(parseFloat($deb) != parseFloat($kre)){
			alert('Debet dan Kredit harus Balance !!');
			$kon = false;
		} else {
			$kon = true;
		}
	}

	return $kon;
}

function updated_ll(){
	$('#kode_akun_add').trigger("liszt:updated");
}

</script>