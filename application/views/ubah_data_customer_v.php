<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-group"></i>  Daftar Customer </h3>
			
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Customer </li>
		</ul>
	</div>
</div>

<div class="row-fluid" id="edit_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-edit"></i> Ubah Data Customer </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					
					<div class="control-group">
						<label class="control-label"> <b> Tipe Customer </b> </label>
						<div class="controls">
							<input style="float: left;" onclick="isfilter_ed();" id="perusaha_ed" type="radio" name="tipe_ed" value="Perusahaan" checked="checked"><label for="perusaha"><span><span></span></span>  Perusahaan </label>
							<input style="float: left;" onclick="isfilter_ed();" id="perorang_ed" type="radio" name="tipe_ed" value="Perorangan" ><label for="perorang"><span><span></span></span>  Perorangan </label>
                            
						</div>
					</div>

					<div class="control-group usaha_show_ed">
						<label class="control-label"> <b> Nama Perusahaan </b> </label>
						<div class="controls">
							<select class="span1 usaha_show" name="tipe_perusahaan" id="tipe_perusahaan" onchange="add_tipe_perusahaan(this.value);">
								<?php foreach ($master_tipe as $key => $value_tipe) {
									?>
									<option value="<?=$value_tipe->NAMA;?>"><?=$value_tipe->NAMA;?></option>
									<?php
								} ?>
								<option value="more">.......</option>
							</select>
							<input type="text" placeholder="Nama Perusahaan / Badan Usaha" class="span10" value="<?=$dt->NAMA_PELANGGAN;?>" id="nama_usaha_ed" name="nama_pelanggan_ed">
						</div>
					</div>

					<div class="control-group">
						<!-- <label class="control-label orang_show_ed"> <b> Nama Customer </b> </label> -->
						<label class="control-label usaha_show_ed" > <b> Nama Holding </b> </label>
						<div class="controls">
							<input required type="text" placeholder="Nama Pelanggan atau Perusahaan" class="span12" value="<?=$dt->NAMA_USAHA;?>" id="nama_pelanggan_ed" name="nama_usaha_ed">
							<input type="hidden" class="span12" value="<?=$dt->ID;?>" id="id_pelanggan" name="id_pelanggan">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Kode SH</b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->KODE_PELANGGAN;?>" id="npwp_ed" name="npwp_ed">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Alamat Pengiriman Invoice</b> </label>
						<div class="controls">
							<textarea class="span12" name="lokasi"><?=$dt->LOKASI;?></textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Kode Customer</b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->KODE_CUSTOMER;?>" id="npwp_ed" name="kode_customer_ed">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>NPWP (jika ada)</b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->NPWP;?>" id="npwp_ed" name="npwp_ed">
						</div>
					</div>

					<div class="control-group usaha_show_ed">
						<label class="control-label"> <b> No. TDP </b> </label>
						<div class="controls">
							<input type="text" class="span12" value="<?=$dt->TDP;?>" name="tdp_ed" id="tdp_ed">
						</div>
					</div>

					<div class="control-group usaha_show_ed" >
						<label class="control-label"> <b> No. SIUP </b> </label>
						<div class="controls">
							<input type="text" class="span12" value="<?=$dt->SIUP;?>" name="siup_ed" id="siup_ed">
						</div>
					</div>


					<div class="control-group">
						<label class="control-label"> <b> Alamat Tujuan </b> </label>
						<div class="controls">
							<textarea rows="3" class="span12" id="alamat_tagih_ed" name="alamat_tagih_ed"><?=$dt->ALAMAT_TAGIH;?></textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Stock Point </b> </label>
						<div class="controls">
							<select class="span12" name="supply_point" onchange="get_supply_point(this.value);">
									<option>--Supply Point--</option>
									<?php 
										foreach ($supply as $key => $sp) {
										
									?>
									<option value="<?=$sp->ID;?>"><?=$sp->NAMA;?></option>
									<?php } ?>
								</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>  </b> </label>
						<div class="controls">
						    <table class="stat-table table table-hover" style="width: 100%;">
						    	<thead>
						    		<th align="center">Nama</th>
						    		<th align="center">Pajak (%)</th>
						    		<th align="center">Aksi</th>
						    	</thead>
						    	<tbody id="data_supply">
						    		
						    	</tbody>
						    </table>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> No. Telepon </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->NO_TELP;?>" id="no_telp_ed" name="no_telp_ed">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Handphone </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->NO_HP;?>" id="no_hp_ed" name="no_hp_ed">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Email </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->EMAIL;?>" id="email_ed" name="email_ed">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Limit Pembelian </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->LIMIT_BIAYA;?>" name="limit_beli" id="limit_beli_ed" autocomplete="off">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Pajak PBBKB </b> </label>
						<div class="controls">
							<input type="text" class="span12" name="pajak_pbbkb_ed" value="<?=$dt->PAJAK_PBBKB;?>" id="pajak_pbbkb_val" readonly>
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> PPN </b> </label>
						<div class="controls">
							<input type="text" class="span12" name="ppn_ed" id="ppn_ed" value="<?=$dt->PPN;?>">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> PPH 23 </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->PPH23;?>" name="pph_23_ed" id="pph_23_ed" autocomplete="off">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> PPH 15 </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->PPH15;?>" name="pph_15_ed" id="pph_15_ed" autocomplete="off">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> PPH 21 </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->PPH_21;?>" name="pph_21_ed" id="pph_21_ed" autocomplete="off">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> OAT </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->OAT;?>" name="oat_ed" id="pph_21_ed" autocomplete="off">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>


					<div class="form-actions">
                       
                        
                       
                        <input type="submit" class="btn btn-info" name="edit" value="UBAH CUSTOMER">
                        
                        <button type="button" onclick="batal_edit_klik();" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function get_supply_point(id) {
	
        $.ajax({
            url : '<?php echo base_url(); ?>purchase_order_c/get_supply_point',
            data : {id:id},
            type : "POST",
            dataType : "json",
            success : function(result){   
                var isine = "";
                if(result.length > 0){
                    $.each(result,function(i,res){

                        isine += '<tr>'+
                                    '<td style="text-align:center;">'+res.NAMA_BPPKB+'</td>'+
                                    '<td style="text-align:center;">'+res.PAJAK+' %</td>'+
                                    '<td style="text-align:center;">'+
                                    	'<input type="radio" value="'+res.ID+'" name="aksi_on" onchange="ganti('+res.PAJAK+')">'+
                                    '</td>'+
                                '</tr>';
                    });
                } else {
                    isine = "<tr><td colspan='6' style='text-align:center;'> There are no transaction for this data </td></tr>";
                }

                $('#data_supply').html(isine);
            }
        });
    }
</script>