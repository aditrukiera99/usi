<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

#tes td {
	vertical-align: middle;
}
</style>

<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-minus"></i>  Stock Opname</h3>
			<a class="btn btn-info view_data" href="<?=base_url();?>stock_opname_c/add_new" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> INPUT STOCK OPNAME 
			</a>

			<!-- <button data-toggle='modal' data-target='#laporan_modal' type="button" class="btn btn-warning view_data" style="float: right; margin-right: 10px;"> 
				<i class="icon-print" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> CETAK LAPORAN
			</button> -->
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Persediaan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Stock Opname</li>
		</ul>
	</div>
</div>


<div class="row-fluid view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="stat-table table table-hover" id="data-table">
					<thead>
						<tr>
							<th align="center"> Aksi </th>
							<th align="center"> Kode Akun </th>
							<th align="center"> No Stock Opname </th>
							<th align="center"> Tipe </th>
							<th align="center"> Tanggal </th>
							<th align="center"> No. Ref </th>
							<th align="center"> Catatan </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP foreach ($dt as $key => $row) { ?>
						<tr>
							<td style="text-align: center;">
								<a style="padding: 2px 10px;"  href="<?=base_url();?>stock_opname_c/detail/<?=$row->ID;?>" class="btn btn-small btn-info"> Detail </a>
							</td>
							<td style="text-align: left;"><?=$row->KODE_AKUN;?> <br> <?=$row->NAMA_AKUN;?></td>
							<td style="text-align: center;"><?=$row->NO_OPNAME;?></td>
							<td style="text-align: center;"><?=$row->TIPE;?></td>
							<td style="text-align: center;"><?=$row->TGL;?></td>
							<td style="text-align: center;"><?=$row->NO_REF;?></td>
							<td style="text-align: left;"><?=$row->CATATAN;?></td>
						</tr>
						<?PHP } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="laporan_modal" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	          <h4 class="modal-title">Tampilkan Laporan</h4>
	        </div>
	        <div class="modal-body">
		        <div class="row-fluid">
		            <div class="span12">
		                <div class="content-widgets light-gray">
		                    <form id="form_laporan" method="post" action="<?=base_url();?>stock_opname_c" target="_blank">
		                    	<div class="row-fluid">
                                    <div class="span5" style="margin-left: 5px;">
                                        <div class="control-group">
                                            <label class="control-label"> <b style="font-size: 14px;"> Bulan </b> </label>
                                            <div class="controls">
                                                <select  required  class="" tabindex="2" name="bulan">
                                                    <option <?PHP if(date('m') == '01' ){ echo "selected"; } ?> value="01"> Januari </option>
                                                    <option <?PHP if(date('m') == '02' ){ echo "selected"; } ?> value="02"> Februari </option>
                                                    <option <?PHP if(date('m') == '03' ){ echo "selected"; } ?> value="03"> Maret </option>
                                                    <option <?PHP if(date('m') == '04' ){ echo "selected"; } ?> value="04"> April </option>
                                                    <option <?PHP if(date('m') == '05' ){ echo "selected"; } ?> value="05"> Mei </option>
                                                    <option <?PHP if(date('m') == '06' ){ echo "selected"; } ?> value="06"> Juni </option>
                                                    <option <?PHP if(date('m') == '07' ){ echo "selected"; } ?> value="07"> Juli </option>
                                                    <option <?PHP if(date('m') == '08' ){ echo "selected"; } ?> value="08"> Agustus </option>
                                                    <option <?PHP if(date('m') == '09' ){ echo "selected"; } ?> value="09"> September </option>
                                                    <option <?PHP if(date('m') == '10' ){ echo "selected"; } ?> value="10"> Oktober </option>
                                                    <option <?PHP if(date('m') == '11' ){ echo "selected"; } ?> value="11"> November </option>
                                                    <option <?PHP if(date('m') == '12' ){ echo "selected"; } ?> value="12"> Desember </option>            
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span6">
                                        <div class="control-group">
                                            <label class="control-label"> <b style="font-size: 14px;"> Tahun </b> </label>
                                            <div class="controls">
                                                <select  required  class="" tabindex="2" name="tahun">
                                                    <option <?PHP if(date('Y') == '2016' ){ echo "selected"; } ?> value="2016"> 2016 </option>
                                                    <option <?PHP if(date('Y') == '2017' ){ echo "selected"; } ?> value="2017"> 2017 </option>
                                                    <option <?PHP if(date('Y') == '2018' ){ echo "selected"; } ?> value="2018"> 2018 </option>
                                                    <option <?PHP if(date('Y') == '2019' ){ echo "selected"; } ?> value="2019"> 2019 </option>
                                                    <option <?PHP if(date('Y') == '2020' ){ echo "selected"; } ?> value="2020"> 2020 </option>        
                                                </select>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
		                        <div class="form-actions">
		                            <center>
		                                <input class="btn btn-danger" type="submit" name="pdf" value="CETAK PDF" id="cetak_pdf_beranda"/>                      
		                                <input class="btn btn-success" type="submit" name="excel" value="CETAK EXCEL" id="cetak_xls_beranda"/>                      
		                            </center>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
	        </div>
	        <div class="modal-footer">
	      		<button type="button" id="tutup_modal_appr" class="btn btn-default" data-dismiss="modal">Tutup</button>
	        </div>
	    </div>
  	</div>
</div>

<script type="text/javascript">

function ubah_data_produk(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>produk_c/cari_produk_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#id_produk').val(result.ID);
			$('#kode_produk_ed').val(result.KODE_PRODUK);
			$('#nama_produk_ed').val(result.NAMA_PRODUK);
			$('#satuan_ed').val(result.SATUAN);
			$('#deskripsi_ed').val(result.DESKRIPSI);

			$('input[name="ppn_ed"]').val(result.PPN);
			$('input[name="pph_ed"]').val(result.PPH);
			$('input[name="service_ed"]').val(result.SERVICE);

			$('#harga_jual_ed').val(NumberToMoney(result.HARGA_JUAL).split('.00').join(''));
			$('#harga_beli_ed').val(NumberToMoney(result.HARGA).split('.00').join(''));



	        //$("#kategori_ed").chosen("destroy");

	        $('.view_data').hide();
	        $('#edit_data').fadeIn('slow');
		}
	});
}
</script>