<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<div class="row" id="form_kode_akun">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Tambah Data Penerimaan Giro </span>
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
							<label class="col-md-2 control-label" for="form_control_1">No. Giro</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="no_giro" name="no_giro" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Terima Dari</label>
							<div class="col-md-5">
								<select  class="form-control input-large select2me input-sm" id="id_pelanggan" name="id_pelanggan" data-placeholder="Select..." required>
									<option value=""></option>
									<?php 
										foreach ($lihat_data_pelanggan as $value){
									?>
										<option value="<?php echo $value->id_pelanggan; ?>"><?php echo $value->kode_pelanggan; ?> - <?php echo $value->nama_pelanggan; ?></option>
									<?php	
										}
									?>
								</select>	
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nilai Giro</label>
							<div class="col-md-1">
								<select class="form-control" name="kurs" id="kurs">
									<option value="Rp">Rupiah</option>
									<option value="USD">USD</option>
								</select>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control text-right" id="nilai" name="nilai" required onkeyup="FormatCurrency(this); getTerbilang(this.value);">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Terbilang</label>
							<div class="col-md-5">
								<textarea class="form-control" name="terbilang" id="terbilang" style="background: #b9dca4; resize: none; height: 100px;" readonly></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tanggal Cair</label>
							<div class="col-md-5">
							    <input class="form-control form-control-inline input-medium date-picker" type="text" value="<?=date('d-m-Y');?>" name="tgl_cair" readonly style="background: #FFF; cursor: pointer;"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1" >Keterangan</label>
							<div class="col-md-5">
								<textarea class="form-control" name="ket" style="height: 100px;"></textarea>
							</div>
						</div>

					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<a href="<?=base_url();?>penerima_giro_c" id="batal" class="btn red">Batal Dan Kembali</a>
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
</script>