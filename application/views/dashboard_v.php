<div class="row" id="form_kode_akun" >
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> DASHBOARD </span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="row" style="margin-bottom: 20px;">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue-madison">
							<div class="visual">
								<i class="fa fa-comments"></i>
							</div>
							<div class="details">
								<div class="number">

								<?php 
								$tanggal = date('d-m-Y');
									$po = $this->db->query("SELECT COUNT(*) as hitung FROM tb_purchase_order WHERE tanggal = '$tanggal'")->row();

								?>
									 <?=$po->hitung;?>
								</div>
								<div class="desc">
									 Purchase Order Hari Ini 
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat red-intense">
							<div class="visual">
								<i class="fa fa-bar-chart-o"></i>
							</div>
							<div class="details">
								<div class="number">
									 <?php 
									 	$pb = $this->db->query("SELECT COUNT(*) as hitung FROM tb_permintaan_barang WHERE tanggal = '$tanggal'")->row();

									 ?>
									 <?=$pb->hitung;?>
								</div>
								<div class="desc">
									 Permintaan Barang Hari Ini
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat green-haze">
							<div class="visual">
								<i class="fa fa-shopping-cart"></i>
							</div>
							<div class="details">
								<div class="number">
									 <?php 
									 	$opb = $this->db->query("SELECT COUNT(*) as hitung FROM tb_order_pembelian WHERE tanggal = '$tanggal'")->row();

									 ?>
									 <?=$opb->hitung;?>
								</div>
								<div class="desc">
									 Order Pembelian Barang Hari Ini
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat purple-plum">
							<div class="visual">
								<i class="fa fa-globe"></i>
							</div>
							<div class="details">
								<div class="number">
									 <?php 
									 	$pt = $this->db->query("SELECT COUNT(*) as hitung FROM tb_peminjaman_barang WHERE tanggal = '$tanggal'")->row();

									 ?>
									 <?=$pt->hitung;?>
								</div>
								<div class="desc">
									 Peminjaman Tools Hari Ini
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
				</div>

				<div class="clearfix">
				</div>

			

			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>