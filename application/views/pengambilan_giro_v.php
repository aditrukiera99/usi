<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<div class="row" id="form_kode_akun">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Set Tanggal Pengambilan Giro </span>
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
							<label class="col-md-2 control-label" for="form_control_1">No. Giro Keluar</label>
							<div class="col-md-5">
								<div class="input-append" style="width: 100%;">
									<input readonly="" type="text" id="no_pm" class="form-control" name="no_pm" required="" style="background:#FFF; width: 60%; font-size: 13px; float: left;">
									<button onclick="show_pop_bukti();" type="button" class="btn" style="width: 30%;">Cari</button>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Atas Nama</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="atas_nama" name="atas_nama" value="" readonly="" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tanggal Keluar</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="tgl_keluar" name="tgl_keluar" value="" readonly="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Atas Nama</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="atas_nama" name="atas_nama" value="" readonly="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nilai Giro</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="nilai" name="nilai" value="" readonly="">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tanggal Diambil</label>
							<div class="col-md-3">
                                <input class="form-control form-control-inline input-medium date-picker" type="text" value="<?=date('d-m-Y');?>" name="tgl_ambil" readonly style="background: #FFF; cursor: pointer;"/>
							</div>
						</div>

						
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Terbilang</label>
							<div class="col-md-5">
								<textarea  class="form-control" name="terbilang" id="terbilang" style="background: #b9dca4; resize: none; height: 100px;" readonly></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1" >Keterangan</label>
							<div class="col-md-5">
								<textarea readonly class="form-control" name="ket" style="height: 100px;"></textarea>
							</div>
						</div>

					</div>

                    <hr>

					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<input type="submit" class="btn blue" value="Set Tanggal Pengambilan Giro" name="save">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>

<script charset="utf-8" type="text/javascript">
function getTerbilang(e){

	e = e.split(',').join('');

    var bilangan = e; 
    var kalimat="";
    var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
    var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
    var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
    var panjang_bilangan = bilangan.length;
     
    /* pengujian panjang bilangan */
    if(panjang_bilangan > 15){
        kalimat = "Diluar Batas";
    }else{
        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for(i = 1; i <= panjang_bilangan; i++) {
            angka[i] = bilangan.substr(-(i),1);
        }
         
        var i = 1;
        var j = 0;
         
        /* mulai proses iterasi terhadap array angka */
        while(i <= panjang_bilangan){
            subkalimat = "";
            kata1 = "";
            kata2 = "";
            kata3 = "";
             
            /* untuk Ratusan */
            if(angka[i+2] != "0"){
                if(angka[i+2] == "1"){
                    kata1 = "Seratus";
                }else{
                    kata1 = kata[angka[i+2]] + " Ratus";
                }
            }
             
            /* untuk Puluhan atau Belasan */
            if(angka[i+1] != "0"){
                if(angka[i+1] == "1"){
                    if(angka[i] == "0"){
                        kata2 = "Sepuluh";
                    }else if(angka[i] == "1"){
                        kata2 = "Sebelas";
                    }else{
                        kata2 = kata[angka[i]] + " Belas";
                    }
                }else{
                    kata2 = kata[angka[i+1]] + " Puluh";
                }
            }
             
            /* untuk Satuan */
            if (angka[i] != "0"){
                if (angka[i+1] != "1"){
                    kata3 = kata[angka[i]];
                }
            }
             
            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
            if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
                subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
            }
             
            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
            kalimat = subkalimat + kalimat;
            i = i + 3;
            j = j + 1;
        }
         
        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
        if ((angka[5] == "0") && (angka[6] == "0")){
            kalimat = kalimat.replace("Satu Ribu","Seribu");
        }
    }
    document.getElementById("terbilang").innerHTML=kalimat;
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
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari No Bukti...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th> NO GIRO KELUAR </th>'+
                '                        <th style="white-space:nowrap;"> ATAS NAMA </th>'+
                '                        <th style="white-space:nowrap;"> NILAI </th>'+
                '                        <th style="white-space:nowrap;"> TGL KELUAR </th>'+
                '                        <th style="white-space:nowrap;"> TGL CAIR </th>'+
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
        url : '<?php echo base_url(); ?>set_tanggal_giro_c/get_data_bukti',
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
                            '<td text-align="center">'+res.nama_supplier+'</td>'+
                            '<td text-align="center">Rp '+NumberToMoney(res.NILAI).split('.00').join('')+'</td>'+
                            '<td text-align="left">'+res.TGL_KELUAR+'</td>'+
                            '<td text-align="left">'+res.TGL_CAIR+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='6' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
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
		url : '<?php echo base_url(); ?>set_tanggal_giro_c/get_bukti_detail',
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