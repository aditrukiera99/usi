<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<div class="row" id="form_kode_akun">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Tambah Data Pengakuan Hutang </span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">No. Dokumen</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="no_bukti" name="no_bukti" readonly value="<?=$get_nomor;?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tanggal</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="tgl" name="tgl" readonly value="<?=date('d-m-Y');?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Supplier / Penagih</label>
							<div class="col-md-5">
								<select  class="form-control input-large select2me input-sm" id="id_supplier" name="id_supplier" data-placeholder="Select..." required>
									<option value=""></option>
									<?php 
										foreach ($lihat_data_supp as $value){
									?>
										<option value="<?php echo $value->id_supplier; ?>"><?php echo $value->kode_supplier; ?> - <?php echo $value->nama_supplier; ?></option>
									<?php	
										}
									?>
								</select>	
							</div>
						</div>

						<hr>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tanggal Nota</label>
							<div class="col-md-2">
								<input class="form-control form-control-inline input-medium date-picker" type="text" value="<?=date('d-m-Y');?>" name="tgl_nota" readonly style="background: #FFF; cursor: pointer;"/>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control" id="no_nota" name="no_nota" value="" placeholder="No. Nota">
							</div>
						</div>

						<!-- <div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Cari No. PM</label>
							<div class="col-md-5">
								<div class="input-append" style="width: 100%;">
									<input readonly="" type="text" id="no_pm" class="form-control" name="no_pm" required="" style="background:#FFF; width: 60%; font-size: 13px; float: left;">
									<button onclick="show_pop_bukti();" type="button" class="btn" style="width: 30%;">Cari</button>
									<input type="hidden" id="id_produk_1" name="produk[]" readonly="" style="background:#FFF;">
								</div>
							</div>
						</div> -->

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Untuk Pembayaran</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="untuk" name="untuk">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Mata Uang</label>
							<div class="col-md-3">
								<select class="form-control" name="kurs" id="kurs">
									<option value="Rp">Rupiah</option>
									<option value="USD">USD</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nilai Tagihan</label>
							<div class="col-md-2">
								<input type="text" class="form-control text-right" id="nilai" name="nilai" onkeyup="FormatCurrency(this); hitung_bayar();">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Biaya Materai</label>
							<div class="col-md-2">
								<input type="text" class="form-control text-right" id="nilai_materai" name="nilai_materai" onkeyup="FormatCurrency(this); hitung_bayar();">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Total Pembayaran</label>
							<div class="col-md-2">
								<input type="text" class="form-control text-right text-right" id="total" name="total" readonly>
							</div>
						</div>

						<hr>
					</div>

					<hr>

					<div class="form-group">
						<label class="col-md-3 control-label" for="form_control_1">Harap Menghubungi pada Tanggal</label>
						<div class="col-md-2">
							<input class="form-control form-control-inline input-medium date-picker" type="text" value="<?=date('d-m-Y');?>" name="tgl_hubungi" readonly style="background: #FFF; cursor: pointer;"/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label" for="form_control_1">Tanggal Pengakuan TTT</label>
						<div class="col-md-2">
							<input class="form-control form-control-inline input-medium date-picker" type="text" value="<?=date('d-m-Y');?>" name="tgl_pengakuan" readonly style="background: #FFF; cursor: pointer;"/>
						</div>
					</div>

					<hr> 
					
                    <div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<a href="<?=base_url();?>pengakuan_hutang_c" id="batal" class="btn red">Batal Dan Kembali</a>
								<input type="submit" class="btn blue" value="Simpan" name="save">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>

<input type="hidden" name="total_row" id="total_row" value="2">
<script charset="utf-8" type="text/javascript">

function hapus(id){
	$('#tr_'+id).remove();
}

function hitung_bayar(){
	var a = $('#nilai').val().split(',').join('');
	var b = $('#nilai_materai').val().split(',').join('');

	if(a == ""){
		a = 0;
	}

	if(b == ""){
		b = 0;
	}

	var nilai = parseFloat(a) - parseFloat(b);
	$('#total').val(NumberToMoney(nilai).split('.00').join(''));
}

function hitung_debkre(){
	var tot_deb = 0;
	$("input[name='debet[]']").each(function(idx, elm) {
		if(elm.value == ""){
			var tot = 0;
		} else {
			var tot = elm.value.split(',').join('');
		}

		if(tot > 0){
    		tot_deb += parseFloat(tot);
		}
    });

    var tot_kre = 0;
    $("input[name='kredit[]']").each(function(idx, elm) {
		if(elm.value == ""){
			var tot2 = 0;
		} else {
			var tot2 = elm.value.split(',').join('');
		}
		
		if(tot2 > 0){
    		tot_kre += parseFloat(tot2);
		}
    });

    $('#total_debet_txt').html(NumberToMoney(tot_deb).split('.00').join(''));
    $('#total_kredit_txt').html(NumberToMoney(tot_kre).split('.00').join(''));

}

function show_pop_bukti(no){
	$('#popup_koang').remove();
	get_popup_bukti();
    ajax_bukti(no);
}

function get_popup_bukti(){
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
                '                        <th> NO PM </th>'+
                '                        <th style="white-space:nowrap;"> KEPADA </th>'+
                '                        <th style="white-space:nowrap;"> NILAI </th>'+
                '                        <th style="white-space:nowrap;"> KETERANGAN </th>'+
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

function ajax_bukti(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>pengeluaran_kas_nota_c/get_data_bukti',
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

                isine += '<tr onclick="get_bukti_detail('+res.ID+');" style="cursor:pointer;">'+
                            '<td text-align="center">'+no+'</td>'+
                            '<td text-align="center">'+res.NO_BUKTI+'</td>'+
                            '<td text-align="center">'+res.KEPADA+'</td>'+
                            '<td text-align="center">Rp '+NumberToMoney(res.NILAI).split('.00').join('')+'</td>'+
                            '<td text-align="left">'+res.UNTUK+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='5' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_bukti(id_form);
            });
        }
    });
}

function get_bukti_detail(id){
    $.ajax({
		url : '<?php echo base_url(); ?>pengeluaran_kas_nota_c/get_bukti_detail',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(result){

			$('#no_pm').val(result.NO_BUKTI);
			$('#kepada').val(result.KEPADA);
			$('#untuk').val(result.UNTUK);
			$('#nilai').val(NumberToMoney(result.NILAI));
			
			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		}
	});
}

</script>