<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

.chzn-container {
    width: 30% !important;
}
</style>

<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-tag"></i> Daftar Kode Akuntansi </h3>

		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active">Daftar Kode Akun</li>
		</ul>
	</div>
</div>

<?PHP if($msg == 11){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Pengubahan Kode Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 22){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Penghapusan Kode Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 33){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Kode Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<div class="row-fluid" id="view_data">
	<div class="span12">
		<button type="button" class="btn btn-block btn-info" onclick="tambah_klik();"> 
			<i class="icon-plus" style="color: #FFF; font-size: 16px;"></i> TAMBAH KODE AKUN
		</button>
		<br>
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3>List Kode Akuntansi </h3>
			</div>	

			<div class="widget-container">
				<table class="responsive table table-striped table-bordered" id="data-table">
					<thead>
						<tr>
							<th align="center"> NO </th>
							<th align="center"> KODE AKUN </th>
							<th align="center"> NAMA AKUN </th>
							<th align="center"> TIPE</th>
							<th align="center"> STATUS</th>
							<th align="center"> AKSI </th>
						</tr>						
					</thead>
					<tbody id="tes">
						<?PHP 
						foreach ($dt as $key => $row) { ?>
						<tr>
							<td <?PHP if($nomor_akun == $row->KODE_AKUN){ echo "style='background: #CDE69C;'"; } ?> ><?=$key+1;?></td>
							<td align="center" <?PHP if($nomor_akun == $row->KODE_AKUN){ echo "style='background: #CDE69C;'"; } ?> style="text-align:center;"> 
								<b> <?=$row->KODE_AKUN;?> </b> 
							</td>
							<td <?PHP if($nomor_akun == $row->KODE_AKUN){ echo "style='background: #CDE69C;'"; } ?> > <b> <?=$row->NAMA_AKUN;?> </b> </td>
							<td <?PHP if($nomor_akun == $row->KODE_AKUN){ echo "style='background: #CDE69C;'"; } ?> >  <b> <?=$row->NAMA_GRUP;?> </b> </td>
							<td <?PHP if($nomor_akun == $row->KODE_AKUN){ echo "style='background: #CDE69C;'"; } ?>>
								<?PHP if($row->APPROVE == 0){
									echo "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan</font>";
								} else if($row->APPROVE == 1){
									echo "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan Edit</font>";
								} else if($row->APPROVE == 2){
									echo "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan Hapus</font>";
								} else {
									echo "<font style='color:green; font-weight:bold;'>Approved</font>";
								} ?>
							</td>	
							<td align="center" <?PHP if($nomor_akun == $row->KODE_AKUN){ echo "style='background: #CDE69C; text-align:center;'"; } ?> style="text-align:center;">
							<?PHP if($row->APPROVE == 3){?> 															
								<button style="padding: 2px 10px;"  onclick="ubah_data_akun(<?=$row->ID;?>);" type="button" class="btn btn-small btn-warning"> Ubah </button>
								<button style="padding: 2px 10px;"  onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" type="button" class="btn btn-small btn-danger"> Hapus</button>
							<?PHP } else { ?>
								<?PHP if($user->LEVEL == "MANAGER"){ ?>
									<?PHP $appr = $this->master_model_m->get_data_persetujuan('kode_akun', $row->ID); ?>
									<div class="btn-group">
										<button style="padding: 2px 10px;"  data-toggle="dropdown" class="btn btn-info dropdown-toggle"> Authorize <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" style="background-color:rgba(255, 255, 255, 1); min-width: 120px;">
											<li>
											<a href="javascript:;" onclick="persetujuan('<?=$appr->ID;?>', 'SETUJU', '<?=$appr->ITEM;?>', '<?=$appr->ID_ITEM;?>', '<?=$appr->JENIS;?>');">Setuju</a>
											</li>
											<li>
											<a href="javascript:;" onclick="persetujuan('<?=$appr->ID;?>', 'TIDAK SETUJU', '<?=$appr->ITEM;?>', '<?=$appr->ID_ITEM;?>', '<?=$appr->JENIS;?>');">Tidak Setuju</a>
											</li>
										</ul>
									</div>
								<?PHP } else {
									echo "-";
								} ?>
							<?PHP } ?>
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
				<h3> <i class="icon-plus"></i> Tambah Kode Akun </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url();?>daftar_kode_akun_c">
					<div class="control-group">
						<label class="control-label"> Kode Grup </label>
							<div class="controls">
								<select onchange="get_sub(this.value);" required data-placeholder="Pilih kode grup..." class="chzn-select" tabindex="2" style="width:500px;" name="kode_grup" id="kode_grup">
									<option value="00"></option>
									<?PHP 
	                                foreach ($dt_grup as $key => $row) {
	                                    echo "<option value='".$row->KODE_GRUP."'>".$row->KODE_GRUP." : ".$row->NAMA_GRUP."</option>";
	                                }
	                                ?>
								</select>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Kode Sub </label>
							<div class="controls">
								<select onchange="$('#kode_sub_inp').val(this.value);" required data-placeholder="Pilih sub grup..." tabindex="2" style="width:300px;" name="kode_sub" id="kode_sub">
									<option value=""></option>
								</select>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Nomor Akun </label>
						<div class="controls">
							<input readonly type="text" style="background: #FFF;" class="span1" value="" name="kode_grup_inp" id="kode_grup_inp">
							<input readonly type="text" style="background: #FFF;" class="span1" value="" name="kode_sub_inp" id="kode_sub_inp">
							<input required type="text"  class="span2" value="" name="no_akun" id="no_akun">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Nama Akun </label>
						<div class="controls">
							<input required type="text"  class="span12" value="" name="nama_akun">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Tipe Akun </label>
							<div class="controls">
								<select required data-placeholder="Pilih tipe..." class="chzn-select" tabindex="2" name="tipe">
									<option value=""></option>
									<option value="Kas">Kas</option>
									<option value="Bank">Bank</option>
									<option value="Akun Piutang">Akun Piutang</option>
									<option value="Akun Hutang">Akun Hutang</option>
									<option value="Lainnya">Lainnya</option>
								</select>
							</div>
					</div>

					<div class="form-actions">
                        <?PHP if($user->LEVEL == "USER"){ ?>
                        <input type="submit" class="btn btn-info" name="simpan" value="AJUKAN KODE AKUN">
                        <?PHP } else { ?>
                        <input type="submit" class="btn btn-info" name="simpan" value="SIMPAN KODE AKUN">
                        <?PHP } ?>
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
				<h3> <i class="icon-edit"></i> Ubah Kode Akun </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url();?>daftar_kode_akun_c">
					<div class="control-group">
						<label class="control-label"> Nama Akun </label>
						<div class="controls">
							<input type="text" required class="span12" value="" id="nama_akun_ed" name="nama_akun_ed">
							<input type="hidden"  class="span12" value="" id="id_akun_ed" name="id_akun_ed">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Nomor Akun </label>
						<div class="controls">
							<input type="text" readonly class="span12" value="" id="nomor_akun_ed" name="nomor_akun_ed">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Tipe Akun </label>
						<div class="controls">
							<select required data-placeholder="Pilih tipe..." class="chzn-select" tabindex="2" name="tipe_ed" id="tipe_ed">
								<option value=""></option>
								<option value="Kas">Kas</option>
								<option value="Bank">Bank</option>
								<option value="Akun Piutang">Akun Piutang</option>
								<option value="Akun Hutang">Akun Hutang</option>
								<option value="Lainnya">Lainnya</option>
							</select>
						</div>
					</div>

					<div class="control-group" style="display: none;">
						<label class="control-label">Deskripsi</label>
						<div class="controls">
							<textarea rows="3" class="span12" id="deskripsi_ed" name="deskripsi_ed"></textarea>
						</div>
					</div>

					<div class="form-actions">
                        <?PHP if($user->LEVEL == "USER"){ ?>
                        <input type="submit" class="btn btn-info" name="edit" value="AJUKAN PENGUBAHAN">
                        <?PHP } else { ?>
                        <input type="submit" class="btn btn-info" name="edit" value="SIMPAN PENGUBAHAN">
                        <?PHP } ?>
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
function cari_kode(keyword) {
	$.ajax({
		url : '<?php echo base_url(); ?>daftar_kode_akun_c/cari_kode',
		data : {keyword:keyword},
		type : "GET",
		dataType : "json",
		success : function(result){
			$isi = "";
			if(result.length == 0){
				$isi = "<tr><td colspan='5' style='text-align:center;'> <b> Tidak ada data yang ditampilkan </b> </td></tr>";
			} else {
				$.each(result, function(i, field){

				var approve = field.APPROVE;
				var approve_txt = "";
				var manage = "";
				if(approve == 0){
					approve_txt = "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan</font>";
					manage = "<td style='text-align:center;'>-</td>";
				} else if(approve == 1){
					approve_txt = "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan Edit</font>";
					manage = "<td style='text-align:center;'>-</td>";
				} else if(approve == 2){
					approve_txt = "<font style='color:#e88a05; font-weight:bold;'>Menunggu Persetujuan Hapus</font>";
					manage = "<td style='text-align:center;'>-</td>";
				} else {
					approve_txt = "<font style='color:green; font-weight:bold;'>Approved</font>";
					manage = "<td style='text-align:center;'>"+
								"<button onclick='ubah_data_akun("+field.ID+");' type='button' class='btn btn-small btn-warning'> <i class='icon-edit'></i> Ubah </button> &nbsp;"+
								"<button onclick='hapus_klik("+field.ID+");' type='button' class='btn btn-small btn-danger'> <i class='icon-remove'></i> Hapus</button>"+
							"</td>";
				}

				$isi += 
					"<tr>"+
						"<td style='text-align:center;'> <b> "+field.KODE_AKUN+" </b> </td>"+
						"<td><b>"+field.NAMA_AKUN+"</b></td>"+
						"<td><b>"+field.KATEGORI+"</b></td>"+
						"<td style='text-align:center;'>"+approve_txt+"</td>"+
						manage+
					"</tr>";
				});
			}

			$('#tes').html($isi);
		}
	});
}

function ubah_data_akun(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>daftar_kode_akun_c/cari_kode_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#id_akun_ed').val(result.ID);
			$('#nama_akun_ed').val(result.NAMA_AKUN);
			$('#nomor_akun_ed').val(result.KODE_AKUN);
			$('#deskripsi_ed').val(result.DESKRIPSI);
			$('#kategori_ed').val(result.KATEGORI);
			$('#tipe_ed').val(result.KATEGORI);

	        $("#tipe_ed").trigger("liszt:updated");

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

function get_sub(kode_grup){
	$.ajax({
		url : '<?php echo base_url(); ?>daftar_kode_akun_c/cari_sub_by_id',
		data : {kode_grup:kode_grup},
		type : "GET",
		dataType : "json",
		success : function(result){
			var isi = "<option value=''>PILIH SUB</option>";
			$.each(result, function(i, field){
				isi+= '<option value="'+field.KODE_SUB+'">'+field.KODE_SUB+' : '+field.NAMA_SUB+'</option>';
			});
			$('#kode_sub').html(isi);

			$('#kode_grup_inp').val('');
			$('#kode_sub_inp').val('00');
			$('#no_akun').val('');

			$('#kode_grup_inp').val(kode_grup);
		}
	});
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