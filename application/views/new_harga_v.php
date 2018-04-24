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
			<h3 class="page-header"> <i class="icon-plus"></i> Input Harga Baru </h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Harga</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Input Harga Baru </li>
		</ul>
	</div>
</div>

<div class="row-fluid" id="add_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url();?>harga_c">
					<div class="control-group">
						<label class="control-label"> Pilih Produk / Barang </label>
							<div class="controls">
								<select required data-placeholder="Pilih item .." class="chzn-select" tabindex="2" style="width:500px;" name="item" id="item">
									<option value="">Pilih Item</option>
									<?PHP 
	                                foreach ($dt as $key => $row) {
	                                    echo "<option value='".$row->ID."'>".$row->NAMA_PRODUK."</option>";
	                                }
	                                ?>
								</select>
							</div>
					</div>


					<div class="control-group">
						<label class="control-label"> Harga Beli </label>
						<div class="controls">
							<input required type="text"  class="span4" value="" name="harga_beli" onkeyup="FormatCurrency(this);">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> Harga Jual </label>
						<div class="controls">
							<input required type="text"  class="span4" value="" name="harga_jual" onkeyup="FormatCurrency(this);">
						</div>
					</div>

					<div class="form-actions">
                        <?PHP if($user->LEVEL == "USERs"){ ?>
                        <input type="submit" class="btn btn-info" name="simpan" value="AJUKAN HARGA">
                        <?PHP } else { ?>
                        <input type="submit" class="btn btn-info" name="simpan" value="SIMPAN HARGA">
                        <?PHP } ?>
                        <a href="<?=base_url();?>harga_c" class="btn"> BATAL </a>
                    </div>

				</form>
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