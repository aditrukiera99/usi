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
			<h3 class="page-header"> <i class="icon-bookmark"></i>  Daftar Kategori Akun </h3>

		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Master Data</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Daftar Kategori Akun </li>
		</ul>
	</div>
</div>

<?PHP if($msg == 11){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Pengubahan Kategori Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 22){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Penghapusan Kategori Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<?PHP if($msg == 33){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Kategori Akun telah diajukan. Mohon tunggu persetujuan atasan.
</div>
<?PHP } ?>

<div class="row-fluid" id="view_data">
	<div class="span12">
		<div class="content-widgets light-gray">

			<div class="widget-container">
				<div class="control-group">
					<label class="control-label"> Pencarian </label>
					<div class="controls input-icon">
						<i class="icon-search"></i>
						<input type="text" onkeyup="cari_produk(this.value);" class="span6" placeholder="Masukkan nama kategori disini">

						<span style="float:right;">
							<button type="button" class="btn btn-success" onclick="tambah_klik();"> 
								<i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> Tambah Data Kategori 
							</button>
						</span>
					</div>


				</div>

				<table class="stat-table table table-hover">
					<thead>
						<tr>
							<th align="center"> No </th>
							<th align="center"> Nama Kategori </th>
							<th align="center"> Deskripsi Kategori </th>
							<th align="center"> Status </th>
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
							<td align="center"> <?=$no;?> </td>
							<td align="left" > <?=$row->NAMA_KATEGORI;?> </td>
							<td> <?=$row->DESKRIPSI==""?"-":$row->DESKRIPSI;?> </td>
							<td style="text-align:center;">
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
							<td align="center">
							<?PHP if($row->APPROVE == 3){?> 								
								<button onclick="ubah_data_produk(<?=$row->ID;?>);" type="button" class="btn btn-small btn-warning"> <i class="icon-edit"></i> Ubah </button>
								<button onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" type="button" class="btn btn-small btn-danger"> <i class="icon-remove"></i> Hapus</button>
							<?PHP } else {
								echo "-";
							}?>
							</td>
						</tr>
						<?PHP } ?>

						<?PHP if(count($dt) == 0){
							echo "<tr> <td colspan='4' align='center'> <b> Tidak ada data yang ditampilkan </b>  </td> </tr>";
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
				<h3> <i class="icon-plus"></i> Tambah Kategori Akun </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> Nama Kategori </label>
						<div class="controls">
							<input required type="text"  class="span12" value="" name="nama_kat">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Deskripsi</label>
						<div class="controls">
							<textarea rows="3" class="span12" name="deskripsi"></textarea>
						</div>
					</div>

					<div class="form-actions">
						<input type="submit" class="btn btn-success" name="simpan" value="Ajukan Penambahan Kategori Akun">
						<button type="button" onclick="batal_klik();" class="btn"> Batal dan Kembali </button>
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
				<h3> <i class="icon-edit"></i> Ubah Data Kategori </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> <b> Nama Kategori </b> </label>
						<div class="controls">
							<input required type="text" class="span12" value="" name="nama_kat_ed" id="nama_kat_ed" >
							<input type="hidden" class="span12" value="" name="id_kat" id="id_kat" >
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Deskripsi Produk</b> </label>
						<div class="controls">
							<textarea rows="3" class="span12" name="deskripsi_ed" id="deskripsi_ed" ></textarea>
						</div>
					</div>


					<div class="form-actions">
						<input type="submit" class="btn btn-success" name="edit" value="Ajukan Pengubahan Kategori Akun">
						<button type="button" onclick="batal_edit_klik();" class="btn"> Batal dan Kembali </button>
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




<script type="text/javascript">
function cari_produk(keyword) {
	$.ajax({
		url : '<?php echo base_url(); ?>daftar_kategori_akun_c/cari_kat',
		data : {keyword:keyword},
		type : "GET",
		dataType : "json",
		success : function(result){
			$isi = "";
			if(result.length == 0){
				$isi = "<tr><td colspan='5' style='text-align:center;'> <b> Tidak ada data yang ditampilkan </b> </td></tr>";
			} else {
				$.each(result, function(i, field){

				var deskripsi = field.DESKRIPSI;
				if(deskripsi == "" || deskripsi == null){
					deskripsi = "-";
				}

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
								"<button onclick='ubah_data_produk("+field.ID+");' type='button' class='btn btn-small btn-warning'> <i class='icon-edit'></i> Ubah </button> &nbsp;"+
							 	"<button onclick='hapus_klik("+field.ID+");' type='button' class='btn btn-small btn-danger'> <i class='icon-remove'></i> Hapus</button>"+
							 "</td>";
				}

				$isi += 
					"<tr>"+
						"<td style='text-align:center;'>"+parseInt(i+1)+"</td>"+
						"<td style='text-align:left;'>"+field.NAMA_KATEGORI+"</td>"+
						"<td>"+deskripsi+"</td>"+
						"<td style='text-align:center;'>"+approve_txt+"</td>"+
						manage+
					"</tr>";
				});
			}

			$('#tes').html($isi);
		}
	});
}

function ubah_data_produk(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>daftar_kategori_akun_c/cari_kat_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#id_kat').val(result.ID);
			$('#nama_kat_ed').val(result.NAMA_KATEGORI);
			$('#deskripsi_ed').val(result.DESKRIPSI);
	        //$("#kategori_ed").chosen("destroy");

	        $('#view_data').hide();
	        $('#edit_data').fadeIn('slow');
		}
	});
}

function detail_supplier(id){
	$('#popup_load').show();
	$.ajax({
		url : '<?php echo base_url(); ?>produk_c/cari_supplier_by_id',
		data : {id:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#popup_load').hide();
			$('#det_nama_pelanggan').html(result.NAMA_SUPPLIER);
			$('#det_npwp').html(result.NPWP);
			$('#det_no_telp').html(result.NO_TELP);
			$('#det_no_hp').html(result.NO_HP);
			$('#det_email').html(result.EMAIL);
			
			$('#det_alamat_tagih').html(result.ALAMAT_TAGIH);
			$('#det_waktu').html(result.WAKTU);
			$('#det_waktu_edit').html(result.WAKTU_EDIT);


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
</script>