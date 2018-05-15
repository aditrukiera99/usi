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
			<h3 class="page-header"> <i class="icon-bookmark"></i>  SUPPLY POINT </h3>

		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> SUPPLY POINT </li>
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
		<button type="button" class="btn btn-block btn-info" onclick="tambah_klik();"> 
			<i class="icon-plus" style="color: #FFF; font-size: 16px;"></i> TAMBAH SUPPLY POINT
		</button>
		<br>
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<table class="stat-table table table-hover">
					<thead>
						<tr>
							<th align="center" style="width: 5%;"> No </th>
							<th align="center" style="width: 20%"> Nama </th>
							<th align="center" style="width: 10%"> Kapasitas </th>
							<th align="center" style="width: 10%"> Isi </th>						
							<th align="center" style="width: 20%"> Penaggung Jawab </th>						
							<th align="center" style="width: 30%"> Aksi </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?php
						$no = 0;
						$gudang = $this->db->query("SELECT * FROM ak_gudang")->result();
						foreach ($gudang as $key => $row) { 
							$no++;
						?>
						<tr >
							<td align="center" style="text-align: center;background-color: #dff0d8;" > <?=$no;?> </td>
							<td align="center" style="text-align: center;background-color: #dff0d8;"> <?=$row->NAMA;?> </td>
							<td align="center" style="text-align: center;background-color: #dff0d8;"> <?=$row->KAPASITAS;?> L </td>
							<td align="center" style="text-align: center;background-color: #dff0d8;"> <?=$row->ISI;?> L </td>
							<td align="center" style="text-align: center;background-color: #dff0d8;"> <?=$row->PENANGGUNG_JAWAB;?> </td>
							<td align="center" style="text-align: center;background-color: #dff0d8;"><button style="padding: 2px 10px;"  onclick="ubah_data_produk(<?=$row->ID;?>);" type="button" class="btn btn-small btn-warning"> <i class="icon-edit"></i>
								Ubah 
								</button>
								<button style="padding: 2px 10px;"  onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" type="button" class="btn btn-small btn-danger"> <i class="icon-trash"></i>
								Hapus
								</button>
								<button style="padding: 2px 10px;"   onclick="tambah_bppkb('<?=$row->ID;?>');" type="button" class="btn btn-small btn-success"> 
								<i class="icon-plus"></i>		Tambah PBBKB
										</button>
							</td>
						</tr>

						<?php 
							$id_gudang = $row->ID;
							$pbbkb = $this->db->query("SELECT * FROM ak_pajak_supply WHERE ID_SUPPLY = '$id_gudang' ")->result();
							$nmr = 0;	
							foreach ($pbbkb as $key => $value) {
								$nmr++;
							?>
								<tr >
									<td align="center" style="text-align: center;background-color: #f2dede;" ><?=$no;?>.<?=$nmr;?> </td>
									<td align="center" colspan="3" style="text-align: center;background-color: #f2dede;" > <?=$value->NAMA_BPPKB;?> </td>
									
									<td align="center" style="text-align: center;background-color: #f2dede;" >PAJAK : <?=$value->PAJAK;?> %</td>
									<td align="center" style="text-align: center;background-color: #f2dede;"><button style="padding: 2px 10px;"  onclick="ubah_data_pajak(<?=$value->ID;?>);" type="button" class="btn btn-small btn-inverse"> <i class="icon-edit"></i>
										Ubah 
										</button>
										<button style="padding: 2px 10px;"  onclick="$('#dialog-btn').click(); $('#id_hapus_pajak').val('<?=$value->ID;?>');" type="button" class="btn btn-small btn-info"> <i class="icon-trash"></i>
										Hapus
										</button>
										
									</td>
								</tr>
						<?php 
							}
						} ?>
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
				<h3> <i class="icon-plus"></i> Tambah Supply Point </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> NAMA </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="nama" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> KAPASITAS </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="kapasitas" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> PENANGGUNG_JAWAB </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="penanggung_jawab" style="font-size: 14px;">
						</div>
					</div>

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="simpan" value="SIMPAN SUPPLY POINT">
						
						<button type="button" onclick="batal_klik();" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid" id="tambah_bppkb" style="display:none;">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-plus"></i> Tambah BPPKB </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> NAMA BPPKB </label>
						<div class="controls">
							<input required type="hidden" class="span6" value="" id="id_supply" name="id_supply" style="font-size: 14px;">
							<input required type="text" class="span6" value="" name="nama_bppkb" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> PROSENTASE </label>
						<div class="controls">
							<input required type="text" class="span6" value="" name="prosentase" style="font-size: 14px;">
						</div>
					</div>


					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="simpan_bppkb" value="SIMPAN PAJAK">
						
						<button type="button" onclick="batal_klik_bppkb();" class="btn"> BATAL </button>
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
				<h3> <i class="icon-edit"></i> Ubah Gudang </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> Nama </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="nama" name="nama" style="font-size: 14px;">
							<input required type="hidden" class="span6" value="" id="id_gr" name="id_gr" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Kapasitas </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="kapasitas" name="kapasitas" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Penanggung Jawab </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="penanggung_jawab" name="penanggung_jawab" style="font-size: 14px;">
						</div>
					</div>

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="edit" value="UBAH Gudang">
						
						<button type="button" onclick="batal_edit_klik();" class="btn"> BATAL </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid" id="edit_data_pajak" style="display:none;">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> <i class="icon-edit"></i> Ubah Data Pajak </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> Nama </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="nama_pajak" name="nama_pajak" style="font-size: 14px;">
							<input required type="hidden" class="span6" value="" id="id_gr_pajak" name="id_gr_pajak" style="font-size: 14px;">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Prosentase </label>
						<div class="controls">
							<input required type="text" class="span6" value="" id="prosentase_pajak" name="prosentase_pajak" style="font-size: 14px;">
						</div>
					</div>

					<div class="form-actions">
						
						<input type="submit" class="btn btn-info" name="edit_pajak" value="UBAH PAJAK">
						
						<button type="button" onclick="batal_edit_klik_pajak();" class="btn"> BATAL </button>
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
            <input type="hidden" name="id_hapus_pajak" id="id_hapus_pajak" value="" />
        </form>   
         
        <p>Apakah anda yakin ingin mengajukan penghapusan data ini? </p>
        <ul class="cd-buttons">            
            <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
            <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val(''); $('#id_hapus_pajak').val('');" href="javascript:;">Tidak</a></li>
        </ul>
        <a href="#0" onclick="$('.cd-popup-close').click();$('#id_hapus').val('');$('#id_hapus_pajak').val('');" class="cd-popup-close img-replace">Close</a>
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
		url : '<?php echo base_url(); ?>Gudang_c/cari_Gudang_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#id_gr').val(result.ID);
			$('#nama').val(result.NAMA);
			$('#kapasitas').val(result.KAPASITAS);
			$('#penanggung_jawab').val(result.PENANGGUNG_JAWAB);

	        $('#view_data').hide();
	        $('#edit_data').fadeIn('slow');
		}
	});
}

function ubah_data_pajak(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>Gudang_c/cari_pajak_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#id_gr_pajak').val(result.ID);
			$('#nama_pajak').val(result.NAMA_BPPKB);
			$('#prosentase_pajak').val(result.PAJAK);

	        $('#view_data').hide();
	        $('#edit_data_pajak').fadeIn('slow');
		}
	});
}

function tambah_klik(){
	$('#view_data').hide();
	$('#add_data').fadeIn('slow');
}

function tambah_bppkb(id){
	$('#id_supply').val(id);
	$('#view_data').hide();
	$('#tambah_bppkb').fadeIn('slow');
}

function batal_klik(){
	$('#add_data').hide();
	$('#view_data').fadeIn('slow');
}

function batal_klik_bppkb(){
	$('#tambah_bppkb').hide();
	$('#view_data').fadeIn('slow');
}

function batal_edit_klik(){
	$('#edit_data').hide();
	$('#view_data').fadeIn('slow');
}

function batal_edit_klik_pajak(){
	$('#edit_data_pajak').hide();
	$('#view_data').fadeIn('slow');
}

function hapus_klik(id){
	$('#dialog-btn').click(); 
	$('#id_hapus').val(id);
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