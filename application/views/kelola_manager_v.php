<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> Kelola Manager unit <b><?=$unit->NAMA_UNIT;?></b>  </h3>

		</div>
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
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Manager untuk unit <b><?=strtoupper($unit->NAMA_UNIT);?></b> telah dibuat. Klik <a style="color: yellow;" href="<?=base_url();?>beranda_c">disini</a> untuk kembali.
</div>
<?PHP } ?>

<?PHP if($msg == 44){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> Manager untuk unit <b><?=strtoupper($unit->NAMA_UNIT);?></b> telah diubah. Klik <a style="color: yellow;" href="<?=base_url();?>beranda_c">disini</a> untuk kembali.
</div>
<?PHP } ?>


<div class="row-fluid">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> Form Manager </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
						<label class="control-label"> <b> Unit </b> </label>
						<div class="controls">
							<input type="text" readonly="" style="background: #FFF;" placeholder="" class="span4" value="<?=strtoupper($unit->NAMA_UNIT);?>" name="unit">
							<input type="hidden" class="span4" value="<?=$user_unit->ID;?>" name="id_user">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Level </b> </label>
						<div class="controls">
							<input type="text" readonly="" style="background: #FFF;"   class="span12" value="MANAGER" name="level">
						</div>
					</div>


					<div class="control-group">
						<label class="control-label"> <b> Nama Lengkap </b> </label>
						<div class="controls">
							<input type="text" required placeholder="Nama Lengkap" class="span12" value="<?=$user_unit->NAMA;?>" name="nama_lengkap">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b> Username </b> </label>
						<div class="controls">
							<input type="text" required placeholder="" class="span12" value="<?=$user_unit->USERNAME;?>" name="username">
						</div>
					</div>

					<?PHP if($user_unit){?>
					<div class="control-group">
						<label class="control-label"> <b> Password </b> </label>
						<div class="controls">
							<input type="password" placeholder="" class="span12" value="" name="password">
							<span class="help-block" style="color: blue; margin-top: 3px;">Kosongi password jika tidak ingin mengubah password untuk manager ini.</span>
							<input type="hidden" placeholder="" class="span12" value="1" name="sts">
						</div>
					</div>
					<?PHP } else { ?>

					<div class="control-group">
						<label class="control-label"> <b> Password </b> </label>
						<div class="controls">
							<input type="password" required placeholder="" class="span12" value="" name="password">
							<input type="hidden" placeholder="" class="span12" value="0" name="sts">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"> <b>Ulangi Password </b> </label>
						<div class="controls">
							<input type="password" required placeholder="" class="span12" value="" name="password2">
						</div>
					</div>

					<?PHP } ?>

					<div class="form-actions">
						<input type="submit" class="btn btn-success" name="simpan" value="Simpan Manager">
						<a href="<?=base_url();?>beranda_c" class="btn"> Batal dan Kembali </a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>