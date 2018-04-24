<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<div class="row" id="form_kode_akun">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Ubah Data Bukti Bank Masuk </span>
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
								<input type="text" class="form-control" id="no_bukti" name="no_bukti" readonly value="<?=$dt->NO_BUKTI;?>">
								<input type="hidden" class="form-control" id="id_edit" name="id_edit"  value="<?=$dt->ID;?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tanggal</label>
							<div class="col-md-5">
							    <input class="form-control form-control-inline input-medium" type="text" value="<?=$dt->TGL;?>" name="tgl" readonly >
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Bukti Bank</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="bukti_bank" name="bukti_bank"  value="<?=$dt->BUKTI_BANK;?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Telah Terima Dari</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="dari" name="dari"  value="<?=$dt->DARI;?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nilai</label>
							<div class="col-md-3">
								<input type="text" class="form-control text-right" id="nilai" name="nilai" required onkeyup="FormatCurrency(this); getTerbilang(this.value);" value="<?=number_format($dt->NILAI);?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tanggal Cair</label>
							<div class="col-md-5">
							    <input class="form-control form-control-inline input-medium date-picker" type="text" value="<?=$dt->TGL_CAIR;?>" name="tgl_cair" readonly style="background: #FFF; cursor: pointer;"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Terbilang</label>
							<div class="col-md-5">
								<textarea class="form-control" name="terbilang" id="terbilang" style="background: #b9dca4; resize: none; height: 100px;" readonly><?=$dt->TERBILANG;?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1" >Penerimaan Untuk</label>
							<div class="col-md-5">
								<textarea class="form-control" name="ket" style="height: 100px;"><?=$dt->UNTUK;?></textarea>
							</div>
						</div>

					</div>

					<hr>

					<div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr style="background: #333; color: #FFF;">
                                    <th style="text-align: center; width: 20%;"> Kode Perkiraan </th>
                                    <th style="text-align: center;"> Debet </th>
                                    <th style="text-align: center;"> Kredit </th>
                                    <th style="text-align: center;"> Keterangan </th>
                                    <th style="text-align: center;">  </th>
                                </tr>
                            </thead>
                            <tbody id="dataAkun">
                                <tr id="tr_1">
                                    <td>
                                    	<select  class="form-control input-large select2me input-sm" name="kode_akun[]" id="kode_akun_1" data-placeholder="Pilih Kode Perkiraan..." required>
												<option value=""></option>
												<?php 
													foreach ($lihat_data_akun as $value){
												?>
													<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->KODE_AKUN; ?> - <?php echo $value->NAMA_AKUN; ?></option>
												<?php	
													}
												?>
											</select>	
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:right;" type="text" class="form-control" value="" name="debet[]" id="debet_1" onkeyup="FormatCurrency(this); hitung_debkre();">
										</div>
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:right;" type="text" class="form-control" value="" name="kredit[]" id="kredit_1" onkeyup="FormatCurrency(this); hitung_debkre();">
										</div>
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:left;" type="text" class="form-control" value="" name="keterangan[]" id="keterangan_1">
										</div>
                                    </td>
                                    <td>
                                    
                                    </td>
                                </tr>
                                <tr id="tr_2">
                                    <td>
                                    	<select  class="form-control input-large select2me input-sm" name="kode_akun[]" id="kode_akun_2" data-placeholder="Pilih Kode Perkiraan..." required>
												<option value=""></option>
												<?php 
													foreach ($lihat_data_akun as $value){
												?>
													<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->KODE_AKUN; ?> - <?php echo $value->NAMA_AKUN; ?></option>
												<?php	
													}
												?>
											</select>	
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:right;" type="text" class="form-control" value="" name="debet[]" id="debet_2" onkeyup="FormatCurrency(this); hitung_debkre();">
										</div>
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:right;" type="text" class="form-control" value="" name="kredit[]" id="kredit_2" onkeyup="FormatCurrency(this); hitung_debkre();">
										</div>
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:left;" type="text" class="form-control" value="" name="keterangan[]" id="keterangan_2">
										</div>
                                    </td>
                                    <td>
                                    
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                            	<tr>
                            		<td style="text-align: center;"><b>TOTAL</b></td>
                            		<td style="text-align: right;"><b id="total_debet_txt">0</b></td>
                            		<td style="text-align: right;"><b id="total_kredit_txt">0</b></td>
                            		<td style="text-align: right;" colspan="2"><b></b></td>
                            	</tr>
                            </tfoot>
                        </table>                        
                    </div>

                    <button type="button" class="btn btn-primary" onclick="add_row();"><i class="icon-plus"></i> Tambah Baris</button>

                    <hr>

					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<a href="<?=base_url();?>pemasukan_bank_c" id="batal" class="btn red">Batal Dan Kembali</a>
								<input type="submit" class="btn blue" value="Simpan" name="edit">
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

function add_row(){
	var jml = $('#total_row').val();
	var i = parseFloat(jml) + 1;

	var isi =   '<tr id="tr_'+i+'">'+
                    '<td>'+
                    	'<select  class="form-control input-large select2me input-sm" name="kode_akun[]" id="kode_akun_'+i+'" data-placeholder="Pilih Kode Perkiraan..." required>'+
							'<option value=""></option>'+
							<?php 
								foreach ($lihat_data_akun as $value){
							?>
								'<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->KODE_AKUN; ?> - <?php echo $value->NAMA_AKUN; ?></option>'+
							<?php	
								}
							?>
						'</select>'+
                    '</td>'+
                    '<td>'+
                    	'<div class="controls">'+
							'<input style="text-align:right;" type="text" class="form-control" value="" name="debet[]" id="debet_'+i+'" onkeyup="FormatCurrency(this); hitung_debkre();">'+
						'</div>'+
                    '</td>'+
                    '<td>'+
                    	'<div class="controls">'+
							'<input style="text-align:right;" type="text" class="form-control" value="" name="kredit[]" id="kredit_'+i+'" onkeyup="FormatCurrency(this); hitung_debkre();">'+
						'</div>'+
                    '</td>'+
                    '<td>'+
                    	'<div class="controls">'+
							'<input style="text-align:left;" type="text" class="form-control" value="" name="keterangan[]" id="keterangan_'+i+'">'+
						'</div>'+
                    '</td>'+
                    '<td style="text-align:center;">'+
                    	'<button class="btn btn-danger" type="button" onclick="hapus('+i+');">Hapus</button>'+
                    '</td>'+
                '</tr>';


	$('#dataAkun').append(isi);
	$('#kode_akun_'+i).select2();
	$('#total_row').val(i);
}

function hapus(id){
	$('#tr_'+id).remove();
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
</script>