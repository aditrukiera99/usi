<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-bookmark"></i>  Master Harga </h3>
			
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Master Harga </li>
		</ul>
	</div>
</div>
<div class="row-fluid" id="add_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-plus"></i> Tambah Master Harga </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">

					
					<div class="control-group">
						<label class="control-label"> NAMA PELANGGAN </label>
						<div class="controls">
							
								<select required data-placeholder="Pilih main grup..." class="chzn-select" tabindex="2" style="width:300px;" name="kode_sh" onchange="stock(this.value);">
									<option>- Pilih Pelanggan -</option>
									<?php 

										$pel = $this->db->query("SELECT * FROM ak_pelanggan")->result();

										foreach ($pel as $key => $value) {
											?>
												<option value="<?=$value->KODE_PELANGGAN;?>"><?=$value->KODE_PELANGGAN;?> - <?=$value->NAMA_PELANGGAN;?></option>
											<?php
										}
									?>
								</select>
								
							
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> NAMA PRODUK </label>
						<div class="controls">
							
								<select required data-placeholder="Pilih main grup..." class="chzn-select" tabindex="2" style="width:300px;" name="nama_produk">
									<?php 

										$pro = $this->db->query("SELECT * FROM ak_produk")->result();

										foreach ($pro as $key => $row) {
											?>
												<option value="<?=$row->ID;?>"><?=$row->NAMA_PRODUK;?></option>
											<?php
										}
									?>
								</select>
								
							
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Stock Point </b> </label>
						<div class="controls">
							<select class="span12" name="supply_point" onchange="get_supply_point(this.value);" id="stoki">
								<option value="">- Pilih Stock Point -</option>
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
						<label class="control-label"> Periode </label>
						<div class="controls">
							<select name="periode" class="span6">
								<option value="JAN_1">Januari 1</option>
								<option value="JAN_2">Januari 2</option>
								<option value="FEB_1">Februari 1</option>
								<option value="FEB_2">Februari 2</option>
								<option value="MAR_1">Maret 1</option>
								<option value="MAR_2">Maret 2</option>
								<option value="APR_1">April 1</option>
								<option value="APR_2">April 2</option>
								<option value="MEI_1">Mei 1</option>
								<option value="MEI_2">Mei 2</option>
								<option value="JUN_1">Juni 1</option>
								<option value="JUN_2">Juni 2</option>
								<option value="JUL_1">Juli 1</option>
								<option value="JUL_2">Juli 2</option>
								<option value="AUG_1">Agustus 1</option>
								<option value="AUG_2">Agustus 2</option>
								<option value="SEP_1">September 1</option>
								<option value="SEP_2">September 2</option>
								<option value="OKT_1">Oktober 1</option>
								<option value="OKT_2">Oktober 2</option>
								<option value="NOV_1">November 1</option>
								<option value="NOV_2">November 2</option>
								<option value="DES_1">Desember 1</option>
								<option value="DES_2">Desember 2</option>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label"> Harga Beli </label>
						<div class="controls">
							<input type="text" class="span6" value="0" onkeyup="FormatCurrency(this);" name="harga_beli" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Harga Jual </label>
						<div class="controls">
							<input required type="text" class="span6" onkeyup="FormatCurrency(this);" value="0" name="harga_jual" style="font-size: 14px;">
						</div>
					</div>
					

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="simpan" value="SIMPAN MASTER HARGA">
						
						<a href="<?=base_url(); ?>master_harga_c"><button type="button" class="btn"> BATAL </button></a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function show_pop_pelanggan(id){
	    get_popup_pelanggan();
	    ajax_pelanggan();
	}

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

    function stock(id) {
		$('#stoki').html("");
        $.ajax({
            url : '<?php echo base_url(); ?>master_harga_c/get_supply_point',
            data : {id:id},
            type : "POST",
            dataType : "json",
            success : function(result){   
                var isine = "";
                if(result.length > 0){
                    $.each(result,function(i,res){

                        isine += '<option value = "'+res.ID+'">'+res.NAMA+'</option>';
                    });
                } else {
                    isine = "<tr><td colspan='6' style='text-align:center;'> There are no transaction for this data </td></tr>";
                }

                $('#stoki').html(isine);
            }
        });
    }
</script>