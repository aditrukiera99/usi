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
			<h3 class="page-header"> <i class="icon-minus"></i> Stock </h3>			
			<button data-toggle='modal' data-target='#laporan_modal' type="button" class="btn btn-warning view_data" style="float: right; margin-right: 10px;"> 
				<i class="icon-print" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> CETAK LAPORAN
			</button>
		</div>

		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Persediaan</a><span class="divi der"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Stock </li>
		</ul>
	</div>
</div>


<div class="row-fluid view_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="stat-table table table-hover">
					<thead>
						<tr>
							<th align="center"> Nama Item </th>
							<th align="center"> Satuan </th>
							
							<th align="center"> Penerimaan </th>
							<th align="center"> Pengeluaran </th>
							<!-- <th align="center"> Koreksi </th> -->
							<th align="center"> Saldo Akhir </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						$data_sp = $this->db->query("SELECT * FROM ak_gudang")->result();
						foreach ($data_sp as $key => $row_sp) {							
						?>
						<tr style="font-weight: bold;">
							<td align="left" style="text-align: left;" colspan="7"> SUPPLY POINT :  <?=$row_sp->NAMA;?> </td>														
						</tr>

						<?PHP 
						$no = 0;
						foreach ($dt as $key => $row) {
							$no++;

							$get_penerimaan  = $this->model->get_penerimaan_item($row->ID, $row->ID, $row_sp->ID);
							$get_pengeluaran = $this->model->get_pengeluaran_item($row->ID, $row->ID, $row_sp->ID);
							// $get_koreksi = $this->model->get_koreksi_item($row->ID, $row->NAMA_PRODUK);
							$saldo_akhir = ($get_penerimaan->TOTAL - $get_pengeluaran->TOTAL );

							if ($get_penerimaan->TOTAL == '') {
								$st = 0;
							}else{
								$st = $get_penerimaan->TOTAL;
							}

							if ($get_pengeluaran->TOTAL == '') {
								$dy = 0;
							}else{
								$dy = $get_pengeluaran->TOTAL;
							}

						?>
						<tr style="font-weight: bold;">
							<td align="left" style="text-align: left;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - <?=$row->NAMA_PRODUK;?> </td>							
							<td align="center" style="text-align: center;"> <?=$row->SATUAN;?> </td>							
														
							<td align="right" style="text-align: right;"> <?=number_format($st,2);?> <?=$row->SATUAN;?> </td>
							<td align="right" style="text-align: right;"> <?=number_format($dy,2);?> <?=$row->SATUAN;?> </td>
							<td align="right" style="text-align: right;"> <?=number_format($saldo_akhir,2);?> <?=$row->SATUAN;?> </td>							
						</tr>
						<?PHP } ?>
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
		                    <form id="form_laporan" method="post" action="<?=base_url();?>stock_c" target="_blank">
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