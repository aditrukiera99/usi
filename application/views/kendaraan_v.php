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
			<h3 class="page-header"> <i class="icon-bookmark"></i>  Kendaraan </h3>
			<button type="button" class="btn btn-info view_data" onclick="tambah_klik();" style="float: right;"> 
				<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> TAMBAH KENDARAAN
			</button>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Kendaraan </li>
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
				<table class="responsive table table-striped table-bordered" id="data-table">
					<thead>
						<tr>
							<th align="center"> NO </th>
							<th align="center"> No.Polisi </th>
							<th align="center"> Merk </th>
							<th align="center"> Tahun </th>
							<th align="center"> No Rangka </th>							
							<th align="center"> No Mesin </th>							
							<th align="center"> Kapasitas </th>							
							<th align="center"> Sopir </th>							
							<th align="center"> Aksi </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						$no = 0;
						foreach ($dt as $key => $row) { 
							$no++;
						?>
						<tr>
							<td align="center" style="text-align: center;"> <?=$no;?> </td>
							<td> <?=$row->NOPOL;?> </td>
							<td> <?=$row->MERK;?> </td>
							<td> <?=$row->TAHUN;?> </td>
							<td> <?=$row->NORANGKA;?> </td>
							<td> <?=$row->NOMESIN;?> </td>
							<td> <?=$row->KAPASITAS;?> </td>
							<td> <?=$row->SOPIR;?> </td>
							<td><button style="padding: 2px 10px;"  onclick="ubah_data_produk(<?=$row->ID;?>);" type="button" class="btn btn-small btn-warning"> 
								Ubah 
								</button>
								<button style="padding: 2px 10px;"  onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" type="button" class="btn btn-small btn-danger"> 
								Hapus
								</button>
							</td>
							

							</td>
						</tr>
						<?PHP } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid" id="add_data" style="display:none;">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-plus"></i> Tambah Kendaraan </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> No Polisi </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="no_polisi" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Merk </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="merk" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Tahun </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="tahun" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> No Rangka </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="no_rangka" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> No Mesin </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="no_mesin" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Kapasitas </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="kapasitas" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Sopir </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="sopir" style="font-size: 14px;">
						</div>
					</div>

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="simpan" value="SIMPAN KENDARAAN">
						
						<button type="button" onclick="batal_klik();" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid" id="edit_data" style="display:none;">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-edit"></i> Ubah Kendaraan </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> No Polisi </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="no_polisi" name="no_polisi" style="font-size: 14px;">
							<input required type="hidden" class="span6" value="" id="id_gr" name="id_gr" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Merk </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="merk" name="merk" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Tahun </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="tahun" name="tahun" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> No Rangka </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="no_rangka" name="no_rangka" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> No Mesin </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="no_mesin" name="no_mesin" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Kapasitas </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="kapasitas" name="kapasitas" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Sopir </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="sopir" name="sopir" style="font-size: 14px;">
						</div>
					</div>

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="edit" value="UBAH KENDARAAN">
						
						<button type="button" onclick="batal_edit_klik();" class="btn"> BATAL </button>
					</div>
				</form>
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


<!-- MODAL SETUJU / TIDAK -->
<button id="appr_btn" data-toggle="modal" data-target="#approval_modal" class="btn btn-warning" style="display: none;">a</button>
<div id="approval_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body">
            <div class="row-fluid">
                <div class="span12" style="font-size: 15px;">
                    <div class="control-group" style="margin-left: 10px;">
                        <label class="control-label"> <b style="font-size: 14px;"> AKSI </b> </label>
                        <div class="controls">
                            <input type="text" style="font-weight: bold;" class="span12" value="" readonly name="apr_aksi" id="apr_aksi">
                            <input type="hidden" class="span12" value="" readonly name="id_persetujuan" id="id_persetujuan">
                            <input type="hidden" class="span12" value="" readonly name="item" id="item">
                            <input type="hidden" class="span12" value="" readonly name="id_item" id="id_item">
                            <input type="hidden" class="span12" value="" readonly name="jenis" id="jenis">
                        </div>
                    </div>

                    <div class="control-group" style="margin-left: 10px;">
                        <label class="control-label"> <b style="font-size: 14px;"> ALASAN </b> </label>
                        <div class="controls">
                            <textarea rows="3" id="apr_alasan" name="apr_alasan" style="resize:none; height: 60px; width: 400px;"></textarea>
                        </div>
                    </div> 
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="save_persetujuan();" class="btn btn-success">Terapkan</button>
        <button type="button" id="tutup_modal_appr" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


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