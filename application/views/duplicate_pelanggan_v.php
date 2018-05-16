<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-group"></i>  Daftar Customer </h3>
			
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active">Duplicate Customer </li>
		</ul>
	</div>
</div>

<div class="row-fluid" id="add_data" >
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-plus"></i> Duplicate Data Customer </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					

					<!-- <div class="control-group usaha_show" style="display:none;">
						<label class="control-label"> <b> Nama Perusahaan </b> </label>
						<div class="controls">
							<input type="text" placeholder="Nama Perusahaan / Badan Usaha" class="span12" value="" name="nama_usaha" autocomplete="off">
						</div>
					</div> -->

					

					<div class="control-group">
						<label class="control-label"> <b>Kode SH</b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="" name="kode_pelanggan" autocomplete="off">
						</div>
					</div>

					

					<div class="control-group">
						<label class="control-label"> <b>Alamat Pengiriman Invoice</b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="" name="lokasi" autocomplete="off">
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
						<label class="control-label"> <b> Pajak PBBKB </b> </label>
						<div class="controls">
							<input type="text" class="span12" id="pajak_pbbkb_val" name="pajak_pbbkb" value="0">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Kode Costumer</b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->KODE_CUSTOMER;?>" name="kode_customer" autocomplete="off">
							<input type="hidden"  class="span12" value="<?=$dt->TIPE;?>" name="tipe" autocomplete="off">

						</div>
					</div>

					<div class="control-group">
						<label class="control-label orang_show"> <b> Nama Customer </b> </label>
						<label class="control-label usaha_show" style="display:none;"> <b> Nama Pemilik </b> </label>
						<div class="controls">
							
							<input required type="text" placeholder="Nama Pelanggan / Pemilik Usaha"  class="span12" value="<?=$dt->NAMA_PELANGGAN;?>" name="nama_pelanggan" autocomplete="off">
						</div>
					</div>

					

					<div class="control-group">
						<label class="control-label"> <b>NPWP (jika ada)</b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->NPWP;?>" name="npwp" autocomplete="off">
						</div>
					</div>

					<!-- <div class="control-group usaha_show" style="display:none;">
						<label class="control-label"> <b> No. TDP </b> </label>
						<div class="controls">
							<input type="text" class="span12" value="" name="tdp" autocomplete="off">
						</div>
					</div>

					<div class="control-group usaha_show" style="display:none;">
						<label class="control-label"> <b> No. SIUP </b> </label>
						<div class="controls">
							<input type="text" class="span12" value="" name="siup" autocomplete="off">
							
						</div>
					</div> -->

					<div class="control-group">
						<label class="control-label"> <b> Alamat Tujuan </b> </label>
						<div class="controls">
							<textarea rows="3" class="span12" name="alamat_tagih"><?=$dt->ALAMAT_TAGIH;?></textarea>
						</div>
					</div>

					

					<div class="control-group">
						<label class="control-label"> <b> No. Telepon </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->NO_TELP;?>" name="no_telp" autocomplete="off">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Handphone </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->NO_HP;?>" name="no_hp" autocomplete="off">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Email </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->EMAIL;?>" name="email" autocomplete="off">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Limit Pembelian </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->LIMIT_BIAYA;?>" name="limit_beli" autocomplete="off">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> PPN </b> </label>
						<div class="controls">
							<input type="text" class="span12" name="ppn" value="<?=$dt->PPN;?>">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> PPH 23 </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->PPH23;?>" name="pph_23" autocomplete="off">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> PPH 15 </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->PPH15;?>" name="pph_15" autocomplete="off">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> PPH 21 </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="<?=$dt->PPH_21;?>" name="pph_21" autocomplete="off">
							<span class="help-inline" style="color: red;">*Harap dikosongkan bila tidak menggunakan pajak</span>
						</div>
					</div>

					<hr style="background: #ccc; height: 1px;">

					<div style="display: none;">
					<center>
					<h4>DATA BROKER</h4>						
					</center>
					<br>
					<div class="control-group">
						<label class="control-label"> <b> Nama Broker </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="" name="broker_nama">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Alamat Broker </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="" name="broker_alamat">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> No. Telp (optional) </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="" name="broker_telp">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> No. KTP (optional) </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="" name="broker_ktp">
						</div>
					</div>


					<div class="control-group">
						<label class="control-label"> <b> No. NPWP (optional) </b> </label>
						<div class="controls">
							<input type="text"  class="span12" value="" name="broker_npwp">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Komisi (%) </b> </label>
						<div class="controls">
							<input type="text" onkeyup="FormatCurrency(this);"  class="span3" value="" name="broker_komisi">
						</div>
					</div>
					</div>



					<div class="form-actions">
                        
                        <input type="submit" class="btn btn-info" name="simpan" value="SIMPAN CUSTOMER">
                      
                        <a href="<?=base_url();?>pelanggan_c"><button type="button" class="btn"> BATAL </button>
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
                                    	'<input type="radio" onchange="ganti('+res.PAJAK+');" value="'+res.ID+'" name="aksi_on">'+
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

    function batal_klik(){
	$('#add_data').hide();
	$('.view_data').fadeIn('slow');
}

	function ganti(id){
		$('#pajak_pbbkb_val').val(id);
	}
</script>