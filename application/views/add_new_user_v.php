<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-plus"></i> Tambah Data User  </h3>

		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Pengaturan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li><a href="#">User Management</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Tambah Data User  </li>
		</ul>
	</div>
</div>

<?PHP if($msg == 11){ ?>
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-minus-sign"></i><strong>Maaf!</strong> Username telah terpakai user lain.
</div>
<?PHP } ?>

<?PHP if($msg == 22){ ?>
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-minus-sign"></i><strong>Maaf!</strong> Mohon ulangi password dengan benar.
</div>
<?PHP } ?>

<?PHP if($msg == 33){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> User telah diajukan. Mohon tunggu persetujuan atasan. Klik <a style="color: yellow;" href="<?=base_url();?>user_management_c">disini</a> untuk melihat daftar user.
</div>
<?PHP } ?>


<div class="row-fluid">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> Form Data User </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> <b> Unit </b> </label>
						<div class="controls">
							<input type="text" readonly="" placeholder="" class="span4" value="<?=strtoupper($unit);?>" name="unit">
						</div>
					</div>


					<div class="control-group">
						<label class="control-label"> <b> Nama Lengkap </b> </label>
						<div class="controls">
							<input type="text" required placeholder="Nama Lengkap" class="span12" value="" name="nama_lengkap">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Username </b> </label>
						<div class="controls">
							<input type="text" required placeholder="" class="span12" value="" name="username">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Password </b> </label>
						<div class="controls">
							<input type="password" required placeholder="" class="span12" value="" name="password">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Ulangi Password </b> </label>
						<div class="controls">
							<input type="password" required placeholder="" class="span12" value="" name="password2">
						</div>
					</div>

					<div class="form-actions">
						<input type="submit" class="btn btn-success" name="simpan" value="Ajukan User Baru">
						<a href="<?=base_url();?>user_management_c" class="btn"> Batal dan Kembali </a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>