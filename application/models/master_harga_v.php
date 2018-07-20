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
			<h3 class="page-header"> <i class="icon-bookmark"></i>  HARGA </h3>
			<a href="<?=base_url();?>master_harga_c/add_harga"><button type="button" class="btn btn-info view_data" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> TAMBAH HARGA
			</button>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> HARGA </li>
		</ul>
	</div>
</div>

<?PHP if($msg == 11){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Pengubahan Grup Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 22){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Penghapusan Grup Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 33){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Grup Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<div class="row-fluid" id="view_data">
	<div class="span12">
		<!-- <button type="button" class="btn btn-block btn-info" onclick="tambah_klik();"> 
			<i class="icon-plus" style="color: #FFF; font-size: 16px;"></i> TAMBAH KENDARAAN
		</button> -->
		<br>
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="stat-table table table-hover" >
					<thead>
						<tr>
							<!-- <th align="center"> NO </th> -->
							<th align="center"> Kode SH </th>
							<th align="center"> Customer </th>
							<th align="center"> Produk </th>
							<th align="center"> Harga Beli </th>							
							<th align="center"> Harga Jual </th>							
							<th align="center"> Periode </th>							
							<th align="center"> Aksi </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?php 

							$ibunda = $this->db->query("SELECT mh.ID_PELANGGAN , p.NAMA_PELANGGAN FROM ak_master_harga mh , ak_pelanggan p WHERE mh.ID_PELANGGAN = p.KODE_PELANGGAN GROUP BY mh.ID_PELANGGAN")->result();
							foreach ($ibunda as $key => $value) {
								?>
								<tr>
									<td style="background-color: #dff0d8;" ><?=$value->ID_PELANGGAN;?></td>
									<td style="background-color: #dff0d8;" ><?=$value->NAMA_PELANGGAN;?></td>
									<td style="background-color: #dff0d8;" >&nbsp;</td>
									<td style="background-color: #dff0d8;" >&nbsp;</td>
									<td style="background-color: #dff0d8;" >&nbsp;</td>
									<td style="background-color: #dff0d8;" >&nbsp;</td>
									<td style="background-color: #dff0d8;" >
										<button class="btn btn-small btn-danger" onclick="$('#dialog-btn-semua').click(); $('#id_hapus_semua').val('<?=$value->ID_PELANGGAN;?>');"> HAPUS SEMUA </button>
									</td>
								</tr>
								<?php 

									$batas = $value->ID_PELANGGAN;
									$nomer = 0;
									$anak = $this->db->query("SELECT mh.* , pr.NAMA_PRODUK as NAMPROD FROM ak_master_harga mh , ak_produk pr WHERE mh.ID_PRODUK = pr.ID AND mh.ID_PELANGGAN = '$batas' AND mh.status = '0'")->result();
									foreach ($anak as $key => $val) {
										$nomer++;
										?>
										<tr>
											<td style="background-color:#f2dede;">&nbsp;</td>
											<td style="background-color:#f2dede;"><?php echo $nomer; ?></td>
											<td style="background-color:#f2dede; "><?=$val->NAMPROD?></td>
											<td style="background-color:#f2dede; "><?php echo number_format($val->HARGA_BELI,2);?></td>
											<td style="background-color:#f2dede; "><?php echo number_format($val->HARGA_JUAL,2);?></td>
											<?php 

												if($val->CREATED_AT == ''){
													?>
													<td style="background-color:#f2dede; "><?=$val->UPDATED_AT;?></td>
													<?php
												}else{
													?>
													<td style="background-color:#f2dede; "><?=$val->CREATED_AT;?></td>
													<?php
												}

											?>
											<td style="background-color: #f2dede;">
												<a href="<?=base_url();?>master_harga_c/ubah_harga/<?=$val->ID;?>">
													<button style="padding: 2px 10px;"  type="button" class="btn btn-small btn-warning"> 
													UPDATE 
													</button>
												</a>
												<button style="padding: 2px 10px;"  onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$val->ID;?>');" type="button" class="btn btn-small btn-danger"> 
												HAPUS
												</button>
											</td>
										</tr>
										<?php 
									}
							}
						?>
						<tr></tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>





<!-- HAPUS MODAL -->
<a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>
<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete" method="post" action="<?=base_url().$post_url;?>">
            <input type="hidden" name="id_hapus" id="id_hapus" value="" />
        </form>   
         
        <p>Apakah anda yakin ingin mengajukan penghapusan data ini? </p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->

<!-- HAPUS MODAL -->
<a id="dialog-btn-semua" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>
<div class="cd-popup" role="alert">
    <div class="cd-popup-container">

        <form id="delete_semua" method="post" action="<?=base_url().$post_url;?>">
            <input type="hidden" name="id_hapus_semua" id="id_hapus_semua" value="" />
        </form>   
         
        <p>Apakah anda yakin ingin mengajukan penghapusan semua data ini? </p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete_semua').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus_semua').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('#id_hapus_semua').val('');" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<!-- END HAPUS MODAL -->


<!-- MODAL SETUJU / TIDAK -->



<script type="text/javascript">
function ubah_data_produk(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>kendaraan_c/cari_kendaraan_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#id_gr').val(result.ID);
			$('#no_polisi').val(result.NOPOL);
			$('#merk').val(result.MERK);
			$('#tahun').val(result.TAHUN);
			$('#no_rangka').val(result.NORANGKA);
			$('#no_mesin').val(result.NOMESIN);
			$('#kapasitas').val(result.KAPASITAS);
			$('#sopir').val(result.SOPIR);

	        $('#view_data').hide();
	        $('#edit_data').fadeIn('slow');
		}
	});
}

function tambah_klik(){
	$('#view_data').hide();
	$('#add_data').fadeIn('slow');
}

function batal_klik(){
	$('#add_data').hide();
	$('#view_data').fadeIn('slow');
}

function batal_edit_klik(){
	$('#edit_data').hide();
	$('#view_data').fadeIn('slow');
}

function laut(){
	$('.kendaraan_darat').hide();
	$('.kendaraan_laut').show();
	
}

function darat(){
	$('.kendaraan_laut').hide();
	$('.kendaraan_darat').show();

}

function hapus_klik(id){
	$('#dialog-btn').click(); 
	$('#id_hapus').val(id);
}

function persetujuan(id, act, item, id_item, jenis){
        
    $('#apr_aksi').val(act);
    $('#id_persetujuan').val(id);
    $('#item').val(item);
    $('#id_item').val(id_item);
    $('#jenis').val(jenis);
    $('#apr_alasan').val('');

    $('#appr_btn').click();
}

function save_persetujuan(){

    var apr_aksi = $('#apr_aksi').val();
    var id_persetujuan = $('#id_persetujuan').val();
    var item = $('#item').val();
    var id_item = $('#id_item').val();
    var jenis = $('#jenis').val();
    var apr_alasan = $('#apr_alasan').val();

    var jml_persetujuan = $('#jml_appr_'+item).html();
    var jml_now = parseFloat(jml_persetujuan) - 1;

    $('#appr_'+id_persetujuan).hide();
    if(jml_now == 0){
        var isi =  '<div class="post_list clearfix">'+
                        '<div class="post_block clearfix">'+  
                            '<h4>Tidak ada pengajuan untuk saat ini</h4>'+
                        '</div>'+
                    '</div>';
         $('#'+item).html(isi);
    }
    $('#jml_appr_'+item).html(jml_now);

    $.ajax({
        type:"POST",
        url: '<?=base_url();?>beranda_c/simpan_persetujuan',
        data: {
            apr_aksi : apr_aksi,
            id_persetujuan : id_persetujuan,
            item : item,
            id_item : id_item,
            jenis : jenis,
            apr_alasan : apr_alasan,
        },
        dataType : 'json',
        success: function(res){
            window.location.reload();
        }
    });
}

</script>