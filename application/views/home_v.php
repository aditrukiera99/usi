<?php 

	$sess_user = $this->session->userdata('sign_in');
	$nama = $sess_user['nama_user'];
	$level = $sess_user['level'];
	$id_user = $sess_user['id'];

?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $title; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link href="<?php echo base_url(); ?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo base_url(); ?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style-devan.css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css">
	.control-label{
		color: #000 !important;
	}
</style>
</head>
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo" >

<?php
function MonthToString($month){
    $string = "";
    switch ($month) {
      case '1': $string = 'Januari'; break;
      case '2': $string = 'Februari'; break;
      case '3': $string = 'Maret'; break;
      case '4': $string = 'April'; break;
      case '5': $string = 'Mei'; break;
      case '6': $string = 'Juni'; break;
      case '7': $string = 'Juli'; break;
      case '8': $string = 'Agustus'; break;
      case '9': $string = 'September'; break;
      case '10': $string = 'Oktober'; break;
      case '11': $string = 'November'; break;
      case '12': $string = 'Desember'; break;

      default: ''; break;
    }
    return $string;
}
?>
<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<!-- <div class="page-logo">
			<a href="index.html">
			<img src="<?php echo base_url(); ?>assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
			</div>
		</div> -->
		<!-- END LOGO -->
		<!-- BEGIN HORIZANTAL MENU -->
		<!-- DOC: Remove "hor-menu-light" class to have a horizontal menu with theme background instead of white background -->
		<!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) in the responsive menu below along with sidebar menu. So the horizontal menu has 2 seperate versions -->
		<div class="hor-menu hor-menu-light hidden-sm hidden-xs">
			<ul class="nav navbar-nav">
				<!-- DOC: Remove data-hover="megadropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
				<li class ="classic-menu-dropdown">
					<a href="<?php echo base_url(); ?>dashboard_c">
					Dashboard <span class="selected"></span>
					</a>
				</li>
				<li class ="mega-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
					Master Data <i class="fa fa-angle-down"></i><span class="selected"></span>
					</a>
					<ul class="dropdown-menu" style="min-width: 400px;">
						<li>
							<!-- Content container to add padding -->
							<div class="mega-menu-content">
								<div class="row">
									<div class="col-md-12">
										<ul class="mega-menu-submenu">
											<li <?php if ($menu2 == 'grub_kode_akun') { echo "class = 'active'";} ?> >
												<a href="<?php echo base_url(); ?>grub_kode_akuntansi_c">
												<i class="fa fa-bank"></i> Master Grup Kode Akun </a>
											</li>	
											<li <?php if ($menu2 == 'kode_akuntansi') { echo "class = 'active'";} ?> >
												<a href="<?php echo base_url(); ?>kode_akuntansi_c">
												<i class="fa fa-bank"></i> Master Kode Akuntansi </a>
											</li>
											<li <?php if ($menu2 == 'departemen') { echo "class = 'active'";} ?> >
												<a href="<?php echo base_url(); ?>m_departemen_c">
												<i class="fa fa-bank"></i> Master Departemen </a>
											</li>
											<li <?php if ($menu2 == 'divisi') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>divisi_c">
												<i class="fa fa-building"></i> Master Divisi </a>
											</li>
											<li <?php if ($menu2 == 'pegawai') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>pegawai_c">
												<i class="fa fa-user"></i> Master Pegawai </a>
											</li>
											<li <?php if ($menu2 == 'kategori_barang') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>kategori_barang_c">
												<i class="fa fa-tasks"></i> Master Kategori Barang </a>
											</li>
											<li <?php if ($menu2 == 'satuan') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>satuan_c">
												<i class="fa fa-th-list"></i> Master Satuan </a>
											</li>
											<li <?php if ($menu2 == 'barang') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>barang_c">
												<i class="fa fa-hdd-o"></i> Master Barang </a>
											</li>
											<li <?php if ($menu2 == 'supplier') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>supplier_c">
												<i class="fa fa-group"></i> Master Supplier </a>
											</li>
											<li <?php if ($menu2 == 'pelanggan') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>pelanggan_c">
												<i class="fa fa-paw"></i> Master Pelanggan </a>
											</li>
											<li <?php if ($menu2 == 'konversi') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>konversi_c">
												<i class="fa fa-arrows-alt"></i> Master Konversi </a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</li>

				<li class ="classic-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
					Flow Sistem<i class="fa fa-angle-down"></i><span class="selected"></span>
					</a>
					<ul class="dropdown-menu pull-left" style="min-width: 400px;">
						<li class="dropdown-submenu">
							<a href="javascript:;">
							<i class="fa fa-envelope-o"></i> Flow Sistem Barang </a>
							<ul class="dropdown-menu" style="min-width: 400px;">
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>permintaan_barang_c">
									<i class="fa fa-bank"></i> Permintaan Barang (SPB) </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'peminjaman_tools') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>peminjaman_barang_c">
									<i class="fa fa-archive"></i> Peminjaman Tools (SP1) </a>
								</li>
								<li <?php if ($menu2 == 'pengembalian_tools') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pengembalian_barang_c">
									<i class="fa fa-cube"></i> Pengembalian Tools (SP2) </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'peminjaman_tools') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>bon_gudang_c">
									<i class="fa fa-archive"></i> Pengambilan Barang Sementara (BGS) </a>
								</li>
								<li <?php if ($menu2 == 'pengembalian_tools') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>bon_gudang_final_c">
									<i class="fa fa-cube"></i> Pengambilan Barang Final (BPB) </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'order_pembelian') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>order_pembelian_c">
									<i class="fa fa-building"></i> Order Pembelian Barang (OPB) </a>
								</li>
								<li <?php if ($menu2 == 'purchase_order') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>purchase_order_c">
									<i class="fa fa-user"></i> Purchase Order (PO) </a>
								</li>
								<li <?php if ($menu2 == 'laporan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>laporan_penerimaan_c">
									<i class="fa fa-tasks"></i> Laporan Penerimaan Barang (LPB) </a>
								</li>
								<li <?php if ($menu2 == 'retur_pembelian') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>retur_pembelian_c">
									<i class="fa fa-th-list"></i> Retur Barang </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'retur_pembelian') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>surat_keluar_c">
									<i class="fa fa-th-list"></i> Surat Keluar </a>
								</li>
								<li <?php if ($menu2 == 'retur_pembelian') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>surat_penawaran_harga_c">
									<i class="fa fa-th-list"></i> Surat Penawaran Harga </a>
								</li>

								
							</ul>
						</li>
						<li class="dropdown-submenu">
							<a href="javascript:;">
							<i class="fa fa-envelope-o"></i> Flow Sistem Jasa </a>
							<ul class="dropdown-menu" style="min-width: 400px;">
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>order_pekerjaan_c">
									<i class="fa fa-bank"></i> Permintaan Jasa (SPJ) </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'peminjaman_tools') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pembelian_jasa_c">
									<i class="fa fa-archive"></i> Proses Pembelian Jasa (SPK) </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'peminjaman_tools') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>penyelesaian_jasa_c">
									<i class="fa fa-archive"></i> Penyelesaian Jasa (LPJ) </a>
								</li>

							</ul>
						</li>
						<li class="dropdown-submenu">
							<a href="javascript:;">
							<i class="fa fa-envelope-o"></i> Flow Sistem Hutang/Piutang </a>
							<ul class="dropdown-menu" style="min-width: 400px;">
								<li <?php if ($menu2 == 'pengakuan_hutang') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pengakuan_hutang_c">
									<i class="fa fa-bank"></i> Pengakuan Hutang (TTT) </a>
								</li>
								<!-- <li <?php if ($menu2 == 'perintah_membayar') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>perintah_membayar_c">
									<i class="fa fa-bank"></i> Perintah Membayar </a>
								</li> -->

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'penerima_giro') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>penerima_giro_c">
									<i class="fa fa-archive"></i> Penerima Giro </a>
								</li>
								<!-- <li <?php if ($menu2 == 'pengeluaran_giro') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pengeluaran_giro_c">
									<i class="fa fa-cube"></i> Pengeluaran Giro </a>
								</li> -->
								<li <?php if ($menu2 == 'set_tanggal_giro') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>set_tanggal_giro_c">
									<i class="fa fa-cube"></i> Set Tanggal Giro Cair </a>
								</li>
								<li <?php if ($menu2 == 'pengambilan_giro') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pengambilan_giro_c">
									<i class="fa fa-cube"></i> Pengambilan Giro </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'pemasukan_kas') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pemasukan_kas_c">
									<i class="fa fa-archive"></i> Pemasukan Kas (BKM) </a>
								</li>
								<li <?php if ($menu2 == 'pengeluaran_kas') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pengeluaran_kas_c">
									<i class="fa fa-cube"></i> Pengeluaran Kas (BKK) </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'pemasukan_bank') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pemasukan_bank_c">
									<i class="fa fa-building"></i> Pemasukan Bank (BBM) </a>
								</li>
								<li <?php if ($menu2 == 'pengeluaran_bank') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pengeluaran_bank_c">
									<i class="fa fa-building"></i> Pengeluaran Bank (BBK) </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'perintah_membayar_nota') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>perintah_membayar_nota_c">
									<i class="fa fa-th-list"></i> Perintah Membayar Nota </a>
								</li>
								<li <?php if ($menu2 == 'pengeluaran_kas_nota') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>pengeluaran_kas_nota_c">
									<i class="fa fa-th-list"></i> Pengeluaran Kas Nota </a>
								</li>
							</ul>

						</li>
						
					</ul>
				</li>

				<li class ="mega-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
					Gudang  <i class="fa fa-angle-down"></i><span class="selected"></span>
					</a>
					<ul class="dropdown-menu" style="min-width: 400px;">
						<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
							<a href="<?php echo base_url(); ?>kartu_stok_c">
							<i class="fa fa-bank"></i> Kartu Stok </a>
						</li>
						<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
							<a href="<?php echo base_url(); ?>akunting_penerimaan_barang_c">
							<i class="fa fa-bank"></i> Laporan Penerimaan Barang </a>
						</li>
						<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
							<a href="<?php echo base_url(); ?>gudang_peminjaman_barang_c">
							<i class="fa fa-bank"></i> Laporan Peminjaman Barang </a>
						</li>

						<!-- <li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
							<a href="<?php echo base_url(); ?>laporan_pemakaian_barang_c">
							<i class="fa fa-bank"></i> Laporan Pemakaian Barang </a>
						</li>
						<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
							<a href="<?php echo base_url(); ?>laporan_bgf_c">
							<i class="fa fa-bank"></i> Laporan BGF </a>
						</li> -->
						<!-- <li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
							<a href="<?php echo base_url(); ?>laporan_list_barang_c">
							<i class="fa fa-bank"></i> Laporan List Barang </a>
						</li> -->

						<!-- <li><img src="<?=base_url()?>assets/Untitled-1.png"></li> -->

						<!-- <li <?php if ($menu2 == 'peminjaman_tools') { echo "class = 'active'";}?>>
							<a href="<?php echo base_url(); ?>penyusaian_stok_c">
							<i class="fa fa-archive"></i> Penyesuaian Stok </a>
						</li> -->
					</ul>
				</li>

				<li class ="classic-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
					Akunting Sistem<i class="fa fa-angle-down"></i><span class="selected"></span>
					</a>
					<ul class="dropdown-menu pull-left" style="min-width: 400px;">
						<li class="dropdown-submenu">
							<a href="javascript:;">
							<i class="fa fa-envelope-o"></i> Umum </a>
							<ul class="dropdown-menu" style="min-width: 400px;">
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>umum_penyelesaian_jasa_c">
									<i class="fa fa-bank"></i> Laporan Penyelesaian Jasa </a>
								</li>

								<!-- <li <?php if ($menu2 == 'peminjaman_tools') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>laporan_produksi_c">
									<i class="fa fa-archive"></i> Laporan Produksi </a>
								</li> -->

							</ul>
						</li>
						<li class="dropdown-submenu">
							<a href="javascript:;">
							<i class="fa fa-envelope-o"></i> Pembelian </a>
							<ul class="dropdown-menu" style="min-width: 400px;">
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_barang_indent_c">
									<i class="fa fa-bank"></i> Laporan Barang Indent </a>
								</li>
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_opb_c">
									<i class="fa fa-bank"></i> Laporan OPB </a>
								</li>
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_pembelian_barang_c">
									<i class="fa fa-bank"></i> Laporan Pembelian Barang </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_jasa_indent_c">
									<i class="fa fa-bank"></i> Laporan Jasa Indent </a>
								</li>
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_order_pekerjaan_c">
									<i class="fa fa-bank"></i> Laporan OPEK </a>
								</li>
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_pembelian_jasa_c">
									<i class="fa fa-bank"></i> Laporan Pembelian Jasa </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a target="_blank" href="<?php echo base_url(); ?>lap_pembelian_jasa_c/cetak_supplier/">
									<i class="fa fa-bank"></i> Laporan List Supplier </a>
								</li>

								<!-- <li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_list_hutang_c">
									<i class="fa fa-bank"></i> Laporan List Hutang </a>
								</li> -->

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_pemakaian_barang_c">
									<i class="fa fa-bank"></i> Laporan Pemakaian Barang </a>
								</li>
							</ul>

						</li>

						<li class="dropdown-submenu">
							<a href="javascript:;">
							<i class="fa fa-envelope-o"></i> Keuangan </a>
							<ul class="dropdown-menu" style="min-width: 400px;">
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_keuangan_c">
									<i class="fa fa-bank"></i> Laporan Keuangan </a>
								</li>
								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_giro_keluar_c">
									<i class="fa fa-bank"></i> Laporan Giro Keluar </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_bank_harian_c">
									<i class="fa fa-bank"></i> Laporan Bank Harian </a>
								</li>

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_kas_harian_c">
									<i class="fa fa-bank"></i> Laporan Kas Harian </a>
								</li>

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_mutasi_harian_c">
									<i class="fa fa-bank"></i> Laporan Mutasi Harian </a>
								</li>

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_cash_flow_c">
									<i class="fa fa-bank"></i> Laporan Cash Flow </a>
								</li>

							</ul>

						</li>

						<li class="dropdown-submenu">
							<a href="javascript:;">
							<i class="fa fa-envelope-o"></i> Akunting </a>
							<ul class="dropdown-menu" style="min-width: 400px;">
								<!-- <li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_kartu_stok_c">
									<i class="fa fa-bank"></i> Laporan Kartu Stok </a>
								</li> -->
								
								<!-- <li><img src="<?=base_url()?>assets/Untitled-1.png"></li> -->

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>jurnal_umum_c">
									<i class="fa fa-bank"></i> Jurnal Umum </a>
								</li>

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>jurnal_sementara_c">
									<i class="fa fa-bank"></i> Jurnal Sementara </a>
								</li>

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>jurnal_final_c">
									<i class="fa fa-bank"></i> Jurnal Final </a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_akuntansi_c">
									<i class="fa fa-bank"></i> Laporan Akuntansi </a>
								</li>

								<!-- <li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>penyesuaian_stok_c">
									<i class="fa fa-bank"></i> Penyesuaian Stok </a>
								</li> -->

								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_gudang_master_c">
									<i class="fa fa-bank"></i> Laporan Gudang Master</a>
								</li>

								<li><img src="<?=base_url()?>assets/Untitled-1.png"></li>

								<!-- <li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_pemakaian_barang_c">
									<i class="fa fa-bank"></i> Laporan Pemakaian Barang</a>
								</li> -->

								<!-- <li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_penerimaan_barang_c">
									<i class="fa fa-bank"></i> Laporan Penerimaan Barang</a>
								</li> -->


								<li <?php if ($menu2 == 'permintaan') { echo "class = 'active'";}?>>
									<a href="<?php echo base_url(); ?>lap_list_akun_c">
									<i class="fa fa-bank"></i> Laporan List Akun</a>
								</li>

							</ul>

						</li>
						
						
						
					</ul>
				</li>

				<!-- <li class ="mega-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
					Penjualan <i class="fa fa-angle-down"></i><span class="selected"></span>
					</a>
					<ul class="dropdown-menu" style="min-width: 400px;">
						<li> -->
							<!-- Content container to add padding -->
							<!-- <div class="mega-menu-content">
								<div class="row">
									<div class="col-md-12">
										<ul class="mega-menu-submenu">
											<li <?php if ($menu2 == 'sales_order') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>sales_order_c">
												<i class="fa fa-bank"></i> Sales Order </a>
											</li>
											<li <?php if ($menu2 == 'invoice') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>invoice_c">
												<i class="fa fa-building"></i> Invoice </a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</li> -->
				
			</ul>
		</div>
		<!-- END HORIZANTAL MENU -->
		<!-- BEGIN HEADER SEARCH BOX -->
		<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
		<form class="search-form" action="extra_search.html" method="GET">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search..." name="query">
				<span class="input-group-btn">
				<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
				</span>
			</div>
		</form>
		<!-- END HEADER SEARCH BOX -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<!-- <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a> -->
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="<?php echo base_url(); ?>assets/admin/layout/img/avatar3_small.jpg"/>
					<span class="username username-hide-on-mobile">
					<?php echo $nama; ?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<!-- <li>
							<a href="extra_profile.html">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a href="page_calendar.html">
							<i class="icon-calendar"></i> My Calendar </a>
						</li>
						<li>
							<a href="inbox.html">
							<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
							3 </span>
							</a>
						</li>
						<li>
							<a href="page_todo.html">
							<i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
							7 </span>
							</a>
						</li>
						<li class="divider">
						</li> -->
						<?php 

							if($level == 'direktur'){

						?>
						<li>
							<a href="<?php echo base_url(); ?>user_management_c">
							<i class="icon-users"></i> User Management </a>
						</li>
						<?php } ?>
						<li>
							<a href="<?php echo base_url(); ?>login_c/logout">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content" style="margin-left:0; min-height:555px;">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title" style="color: white;">
			<?php echo $title; ?> 
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#"><?php echo $sub_menu; ?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#" style="color: #26a69a;"><?php echo $sub_menu1; ?></a>
					</li>
				</ul>
				<div class="page-toolbar">
					<div class="btn green">
						<?php 
                            $d = date('d');
                            $m = MonthToString(date('n'));
                            $y = date('Y');
                            echo $d." ".$m." ".$y;
                        ?>
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->

			<?php if ($page != '') {
				$this->load->view($page);
			}else{
			?>

			<!-- BEGIN PAGE CONTENT-->
			
			<!-- END PAGE CONTENT-->
			
			<?php }?>

		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- <div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Metronic by keenthemes. <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div> -->
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/ui-toastr.js"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/table-editable.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/components-pickers.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="<?php echo base_url(); ?>assets/js-form.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style-devan.css"/>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {    
    Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	TableEditable.init();
	UIToastr.init();
	ComponentsPickers.init();
    });
  </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>