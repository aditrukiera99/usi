<!DOCTYPE HTML>
<?PHP
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$dt_setting = $this->master_model_m->get_setting_app();
?>
<html lang="en">
<head>
<meta charset="utf-8">
<title> <?=$title;?> </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- styles -->
<link href="<?=$base_url2;?>material/css/bootstrap.css" rel="stylesheet">
<link href="<?=$base_url2;?>material/css/jquery.gritter.css" rel="stylesheet">
<link href="<?=$base_url2;?>material/css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="<?=$base_url2;?>material/css/font-awesome.css">
<!--[if IE 7]>
<link rel="stylesheet" href="css/font-awesome-ie7.min.css">
<![endif]-->
<link href="<?=$base_url2;?>material/css/tablecloth.css" rel="stylesheet">
<link href="<?=$base_url2;?>material/css/styles.css" rel="stylesheet">
<link href="<?=$base_url2;?>material/css/theme-default.css" rel="stylesheet">
<link href="<?=$base_url2;?>material/css/chosen.css" rel="stylesheet">
<link href="<?=$base_url2;?>material/css/style-devan.css" rel="stylesheet">
<link rel="stylesheet" href="<?=$base_url2;?>material/dialog/css/reset.css"> <!-- CSS reset -->
<link rel="stylesheet" href="<?=$base_url2;?>material/dialog/css/style.css"> <!-- Resource style -->
<link rel="stylesheet" href="<?=$base_url2;?>jgrowl/jquery.jgrowl.css" type="text/css"/>

<script src="<?=$base_url2;?>material/dialog/js/modernizr.js"></script>
<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?=$base_url2;?>material/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$base_url2;?>material/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$base_url2;?>material/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$base_url2;?>material/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?=$base_url2;?>material/ico/apple-touch-icon-57-precomposed.png">

<!--============ javascript ===========-->
<script src="<?=$base_url2;?>material/js/jquery.js"></script>
<script src="<?=$base_url2;?>material/js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?=$base_url2;?>material/js/bootstrap.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.sparkline.js"></script>
<script src="<?=$base_url2;?>material/js/bootstrap-fileupload.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.metadata.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.tablesorter.min.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.tablecloth.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.flot.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.flot.selection.js"></script>
<script src="<?=$base_url2;?>material/js/excanvas.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.flot.pie.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.flot.stack.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.flot.time.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.flot.tooltip.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.flot.resize.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.collapsible.js"></script>
<script src="<?=$base_url2;?>material/js/accordion.nav.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.gritter.js"></script>
<script src="<?=$base_url2;?>material/js/tiny_mce/jquery.tinymce.js"></script>
<script src="<?=$base_url2;?>material/js/custom.js"></script>
<script src="<?=$base_url2;?>material/js/respond.min.js"></script>
<script src="<?=$base_url2;?>material/js/ios-orientationchange-fix.js"></script>
<script src="<?=$base_url2;?>material/js/chosen.jquery.js"></script>
<script src="<?=$base_url2;?>material/dialog/js/main.js"></script>
<script src="<?=$base_url2;?>material/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?=$base_url2;?>material/js/date.js"></script>
<script src="<?=$base_url2;?>material/js/daterangepicker.js"></script>
<script src="<?=$base_url2;?>material/js/js-form.js"></script>
<script src="<?=$base_url2;?>material/js/plugin.js"></script>
<script type="text/javascript" src="<?=$base_url2;?>jgrowl/alert.js"></script>
<script type="text/javascript" src="<?=$base_url2;?>jgrowl/jquery.jgrowl.js"></script>
<script src="<?=$base_url2;?>material/canvas/canvasjs.min.js"></script>
<script src="<?=$base_url2;?>material/js/jquery.dataTables.js"></script>
<script src="<?=$base_url2;?>material/js/dataTables.bootstrap.js"></script>
<script>

<?PHP if($page == 'edit_transaksi_penjualan_v'){ ?>
$(document).ready(function() {
  // cek_islunas();

  // var id_pajak = $('#id_pajak_sel').val();
  // hitung_pajak(id_pajak);

  // var id_pel = $('#pelanggan_sel').val();
  // get_pelanggan_det(id_pel);


});
<?PHP } ?>

<?PHP if($page == 'edit_transaksi_pembelian_v'){ ?>
$(document).ready(function() {
  cek_islunas();

  var id_pajak = $('#id_pajak_sel').val();
  hitung_pajak(id_pajak);

  var id_pel = $('#pelanggan_sel').val();
  // get_supplier_detail(id_pel);

});
<?PHP } ?>

<?PHP if($page == ''){ ?>
// $(document).ready(function() {
//     transaksi_grafik();
//     laba_rugi_grafik_harian();
//     laba_rugi_grafik_bulanan();

// });
<?PHP } ?>

$(function () {
    $('#data-table').dataTable({
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>"
        /*"oTableTools": {
"aButtons": [
    "copy",
    "print",
    {
        "sExtends":    "collection",
        "sButtonText": 'Save <span class="caret" />',
        "aButtons":    [ "csv", "xls", "pdf" ]
    }
]
}*/
    });
});
/*===============================================
TEXT EDITOR
==================================================*/

        $(function() {
        $('textarea.chat-inputbox').tinymce({
            script_url : 'js/tiny_mce/tiny_mce.js',
            theme : "simple"
            });
        });

/*===============================================
TBALE THEMES
==================================================*/
$(function() {
        $(".paper-table").tablecloth({
          theme: "paper",
          striped: true,
          sortable: true,
          condensed: false
        });
      });
$(function() {
        $(".dark-table").tablecloth({
          theme: "dark",
          striped: true,
          sortable: true,
          condensed: false
        });
      });
      $(function() {
        $(".stat-table").tablecloth({
          theme: "stats",
          striped: false,
          sortable: false,
          condensed: false
        });
      });
      $(function() {
        $("table").tablecloth({
          theme: "default",
          striped: true,
          bordered: true
                  });
      });

      /*====Select Box====*/
    $(function () {
        $(".chzn-select").chosen();
        $(".chzn-select-deselect").chosen({
            allow_single_deselect: true
        });
    });

     /*====DATE Time Picker====*/
    $(function () {
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR',
            pickTime: false
        });
    });

    $(function () {
        $('#datetimepicker2').datetimepicker({
            language: 'pt-BR',
            pickTime: false
        });
    });

    $(function () {
        $('#datetimepicker4').datetimepicker({
            language: 'pt-BR',
            pickTime: false
        });
    });

    $(function () {
        $('#datetimepicker5').datetimepicker({
            language: 'pt-BR',
            pickTime: false
        });
    });

    $(function () {
        $('#datetimepicker3').datetimepicker({
            language: 'pt-BR',
            pickTime: false
        }).on('changeDate',function(event){
          var a = formatDate_adit($('#tgl_po').val());
          var b = formatDate_adit($('input[name="tgl_trx"]').val());

          if(a > b){
            alert("Tanggal tidak boleh kurang dari tanggal purchase order");
          }
        });
    });

    function formatDate_adit(date) {
      var d = new Date(date),
          month = '' + (d.getMonth() + 1),
          day = '' + d.getDate(),
          year = d.getFullYear();

      if (month.length < 2) month = '0' + month;
      if (day.length < 2) day = '0' + day;

      return [year, month, day].join('-');
  }

    /*DATE RANGE PICKER*/

    $(function () {
        $('#reservation').daterangepicker();
    });

    $(function () {
        $('#log_tgl').daterangepicker();
    });

      
$(function(){
        // global setting override
        
        $.extend($.gritter.options, {
            class_name: 'gritter-light', // for light notifications (can be added directly to $.gritter.add too)
            position: 'bottom-right', // possibilities: bottom-left, bottom-right, top-left, top-right
            fade_in_speed: 100, // how fast notifications fade in (string or int)
            fade_out_speed: 100, // how fast the notices fade out
            time: 3000 // hang on the screen for...
        });
        
/**=========================
ONLOAD NOTIFICATION 
==============================**/
    <?PHP if($msg == 1){ ?>
        pesan_sukses();
    <?PHP } ?>

    <?PHP if($msg == 2){ ?>
        pesan_hapus();
    <?PHP } ?>

    <?PHP if($msg == 3){ ?>
        pesan_tanggal();
    <?PHP } ?>
});
/**=========================
LEFT NAV ICON ANIMATION 
==============================**/
$(function () {
    $(".left-primary-nav a").hover(function () {
        $(this).stop().animate({
            fontSize: "30px"
        }, 200);
    }, function () {
        $(this).stop().animate({
            fontSize: "24px"
        }, 100);
    });
});
</script>

<style type="text/css">
.stat-table tbody tr:hover{
    background: #F5F5F5;
    cursor: pointer;
}

#popup_load {
    width: 100%;
    height: 100%;
    position: fixed;
    background: #fff;
    z-index: 9999;
    opacity:0.8;
    filter:alpha(opacity=80); /* For IE8 and earlier */
    visibility:visible;
    top: 0;
    left: 0;
}

.window_load {
    border-radius: 10px;
    height: auto;
    margin-left: 20%;
    margin-top: 20%;
    padding: 10px;
    position: relative;
    text-align: center;
    width: 60%;
}

.ck_kolom
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  padding: 10px;
}


</style>

<?PHP 
$sess_user = $this->session->userdata('masuk_akuntansi');
$id_user = $sess_user['id'];
$user = $this->master_model_m->get_user_info($id_user);

$dt_pengajuan_produk        = $this->master_model_m->get_data_pengajuan_produk($user->UNIT);
$dt_pengajuan_supplier      = $this->master_model_m->get_data_pengajuan_supplier($user->UNIT);
$dt_pengajuan_pelanggan     = $this->master_model_m->get_data_pengajuan_pelanggan($user->UNIT);
$dt_pengajuan_kode_akun     = $this->master_model_m->get_data_pengajuan_kode_akun($user->UNIT);
$dt_pengajuan_kategori_akun = $this->master_model_m->get_data_pengajuan_kategori_akun($user->UNIT);
$dt_pengajuan_kode_grup     = $this->master_model_m->get_data_pengajuan_kode_grup($user->UNIT);
$dt_pengajuan_sub_kode_grup = $this->master_model_m->get_data_pengajuan_sub_kode_grup($user->UNIT);

?>
</head>
<body>

<div id="popup_load" style="display:none;">
    <div class="window_load">
        <img src="<?=$base_url2;?>external/loading.gif" height="100" width="100">
    </div>
</div>

<div class="layout">
	<!-- Navbar
    ================================================== -->
	<div class="navbar navbar-inverse top-nav" style="position: fixed; width: 100%; z-index: 9999;">
		<div class="navbar-inner" style="background:#333;">
			<div class="container">
				<span class="home-link">
            <a href="<?=base_url();?>beranda_c" class="icon-home"></a>
        </span>
                   
				<div class="nav-collapse desktop-only">
					<ul class="nav">
           <?php if($this->master_model_m->cek_master($id_user, 'Master Data', $user->LEVEL)){ ?>
            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-globe"></i> Master Data <b class="icon-angle-down"></b></a>
            <div class="dropdown-menu">
                <ul>
                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Kategori Akun', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>grup_kode_akun_c"><i class="icon-caret-right "></i> Grup Kode Akun </a></li>
                    <?PHP } ?>
                    <!-- <li><a href="<?=base_url();?>sub_grup_kode_akun_c"><i class="icon-caret-right "></i> Sub Grup Kode Akun </a></li> -->

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Kode Akun', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>daftar_kode_akun_c"> <i class="icon-caret-right "></i> Daftar Kode Akun </a></li>
                    <?PHP } ?>

                    <li><a href="<?=base_url();?>gudang_c"><i class="icon-caret-right "></i> Supply Point </a></li>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Pelanggan', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>pelanggan_c"> <i class="icon-caret-right "></i> Customer </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Supplier', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>supplier_c"><i class="icon-caret-right "></i> Supplier </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Produk', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>produk_c"><i class="icon-caret-right "></i> Produk </a></li>
                    <?PHP } ?>
                   
                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Master Kendaraan', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>kendaraan_c"><i class="icon-caret-right "></i> Master Kendaraan </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Master Harga', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>master_harga_c"><i class="icon-caret-right "></i> Master Harga </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Master Transportir', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>master_transportir_c"><i class="icon-caret-right "></i> Master Transportir </a></li>
                    <?PHP } ?>
                </ul>
            </div>
            </li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, 'Aset', $user->LEVEL)){ ?>
            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-pushpin"></i> Aset <b class="icon-angle-down"></b></a>
            <div class="dropdown-menu">
                <ul>
                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Grup Aset', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>grup_aset_c"><i class="icon-minus"></i> Grup Aset </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Sub Grup Aset', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>sub_grup_aset_c"><i class="icon-minus"></i> Sub Grup Aset </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Aset Tetap', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>master_aset_c"><i class="icon-minus"></i> Daftar Aset Tetap </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Harga & Penyusutan', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>input_aset_harga_c"><i class="icon-minus"></i> Input Harga & Penyusutan </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Laporan Aset Tetap', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>lap_aset_tetap_c"><i class="icon-minus"></i> Laporan Aset Tetap </a></li>
                    <?PHP } ?>
                </ul>
            </div>
            </li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, 'Logistik', $user->LEVEL)){ ?>
            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-truck"></i>Armada<b class="icon-angle-down"></b></a>
            <div class="dropdown-menu">
              <ul>
                  <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Kapal', $user->LEVEL)){ ?>
                  <li class="dropdown-submenu"><a href="#"><i class="icon-truck"></i> Kapal</a>
                      <div class="dropdown-menu">
                        <ul>
                          <li><a href="<?=base_url();?>service_kendaraan_c"><i class="icon-caret-right "></i> Docking Kapal </a></li>
                          <li><a href="<?=base_url();?>order_logistik_c/new_invoice"><i class="icon-caret-right "></i> Order logistik </a></li>
                          <li><a href="<?=base_url();?>order_logistik_c/pajak_laporan"><i class="icon-caret-right "></i> Dokumen Kapal </a></li>
                          <li><a href="<?=base_url();?>order_logistik_c/gps_tracking"><i class="icon-caret-right "></i> GPS Tracking </a></li>
                          <li><a href="<?=base_url();?>order_logistik_c/gps_tracking"><i class="icon-caret-right "></i> Asuransi </a></li>
                        </ul>
                      </div>
                  </li>
                  <?PHP } ?>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Kendaraan', $user->LEVEL)){ ?>
                  <li class="dropdown-submenu"><a href="#"><i class="icon-truck"></i> Kendaraan</a>
                      <div class="dropdown-menu">
                        <ul>
                          <!-- <li><a href="<?=base_url();?>service_kendaraan_c"><i class="icon-caret-right "></i> Docking Kapal </a></li> -->
                          <li><a href="<?=base_url();?>order_logistik_c/new_invoice"><i class="icon-caret-right "></i> Order logistik </a></li>
                          <li><a href="<?=base_url();?>order_logistik_c/pajak_laporan"><i class="icon-caret-right "></i> Dokumen Kendaraan </a></li>
                          <li><a href="<?=base_url();?>order_logistik_c/gps_tracking"><i class="icon-caret-right "></i> GPS Tracking </a></li>
                          <li><a href="<?=base_url();?>order_logistik_c/gps_tracking"><i class="icon-caret-right "></i> Asuransi </a></li>
                        </ul>
                      </div>
                  </li>
                  <?PHP } ?>
                  
              </ul>
            </div>
            </li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, 'Persediaan', $user->LEVEL)){ ?>
            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-signal"></i> Persediaan <b class="icon-angle-down"></b></a>
            <div class="dropdown-menu">
                <ul>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Stock', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>stock_c"><i class="icon-minus"></i> Stock </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Stock Opname', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>stock_opname_c"><i class="icon-minus"></i> Stock Opname </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Master Persediaan', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>koreksi_persediaan_c"><i class="icon-minus"></i> Koreksi Persediaan </a></li>
                    <?PHP } ?>


                </ul>
            </div>                  

            </li>
            <?PHP } ?>

            

            <?php if($this->master_model_m->cek_master($id_user, 'Pembelian', $user->LEVEL)){ ?>
            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th-large"></i>Pembelian<b class="icon-angle-down"></b></a>
            <div class="dropdown-menu">
              <ul>
                  <!-- <li><a href="<?=base_url();?>transaksi_pembelian_c"><i class="icon-shopping-cart"></i> Transaksi Pembelian </a></li> -->
                  <!-- <li><a href="<?=base_url();?>order_pembelian_barang_c"><i class="icon-caret-right "></i> Order Pembelian Barang (OPB) </a></li> -->
                 <!--  <li><a href="<?=base_url();?>penawaran_barang_beli_c"><i class="icon-caret-right "></i> Penawaran Barang </a></li> -->
                    <?php if($this->master_model_m->cek_anak($id_user, 'Purchase Order', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>purchase_order_c"><i class="icon-caret-right "></i> Purchase Order </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Penerimaan Barang', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>penerimaan_barang_c"><i class="icon-caret-right "></i> Penerimaan Barang </a></li>
                    <?PHP } ?>


                  <!-- <li><a href="<?=base_url();?>pembelian_c"><i class="icon-caret-right "></i> Pembelian </a></li> -->
                  <!-- <li><a href="<?=base_url();?>delivery_order_beli_c"><i class="icon-caret-right "></i> Delivery Order </a></li> -->
              </ul>
            </div>
            </li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, 'Penjualan', $user->LEVEL)){ ?>
            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th-large"></i> Penjualan <b class="icon-angle-down"></b></a>
            <div class="dropdown-menu">
              <ul>
                <!--  <li><a href="<?=base_url();?>penawaran_barang_c"><i class="icon-caret-right "></i> Penawaran Barang  </a></li> -->
                    <?php if($this->master_model_m->cek_anak($id_user, 'Penjualan', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>transaksi_penjualan_c"><i class="icon-caret-right "></i> Penjualan </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Delivery Order', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>delivery_order_new_c"><i class="icon-caret-right "></i> Delivery Order </a></li>
                    <?PHP } ?>
                 <!-- <li><a href="<?=base_url();?>transaksi_penjualan_c/buka_surat_jalan"><i class="icon-caret-right "></i> Surat Jalan </a></li> -->

                    <?php if($this->master_model_m->cek_anak($id_user, 'Invoice', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>transaksi_penjualan_c/buka_invoice"><i class="icon-caret-right "></i> Invoice </a></li>
                    <?PHP } ?>
                 <!-- <li><a href="<?=base_url();?>kwitansi_c"><i class="icon-caret-right "></i> Kwitansi </a></li> -->

              </ul>
            </div>
            </li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, 'HRD', $user->LEVEL)){ ?>
            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user"></i>HRD<b class="icon-angle-down"></b></a>
            <div class="dropdown-menu">
              <ul>
                  
                  <li><a href="<?=base_url();?>pegawai_c"><i class="icon-caret-right "></i> Data Pegawai </a></li>
                  <li><a href=""><i class="icon-caret-right "></i> Set Gaji Pegawai </a></li>
                  <?php if($this->master_model_m->cek_anak($id_user, 'Master Data Pegawai', $user->LEVEL)){ ?>
                  <li class="dropdown-submenu"><a href="#"><i class="icon-caret-right"></i> Master Data</a>
                  <div class="dropdown-menu">
                    <ul>
                      <li><a href="<?=base_url();?>data_lowongan_c"><i class="icon-book"></i> Data Lowongan</a></li>
                      <li><a href="<?=base_url();?>data_sertifikat_c"><i class=" icon-briefcase"></i> Data Sertifikat</a></li>
                    </ul>
                  </div>
                  </li>
                  <?php } ?>
              </ul>
            </div>
            </li>
            <?PHP } ?>

           <!--  <?php if($this->master_model_m->cek_master($id_user, 'Input Data', $user->LEVEL)){ ?>
            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user"></i>Kepegawaian<b class="icon-angle-down"></b></a>
            <div class="dropdown-menu">
              <ul>               
                  <li><a href="<?=base_url();?>pegawai_c"><i class="icon-caret-right "></i> Data Pegawai </a></li>
                  <li><a href=""><i class="icon-caret-right "></i> Set Gaji Pegawai </a></li>
                 
              </ul>
            </div>
            </li>
            <?PHP } ?> -->

            <?php if($this->master_model_m->cek_master($id_user, 'Input Akuntansi', $user->LEVEL)){ ?>
            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-briefcase"></i> Input Akuntansi  <b class="icon-angle-down"></b></a>
            <div class="dropdown-menu">
                <ul>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Input Jurnal Umum', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>input_jurnal_umum_c"><i class="icon-plus-sign"></i> Input Jurnal Umum</a></li>
                    <?PHP } ?>
                    
                    <?php if($this->master_model_m->cek_anak($id_user, 'Input Kas Kecil', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>kas_kecil_c"><i class="icon-plus-sign"></i> Input Kas Kecil </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Bukti Kas Keluar', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>bukti_kas_keluar_c"><i class="icon-plus-sign"></i> Bukti Kas Keluar </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Bukti Kas Masuk', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>bukti_kas_masuk_c"><i class="icon-plus-sign"></i> Bukti Kas Masuk </a></li>
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Transaksi Akuntansi', $user->LEVEL)){ ?>
                    <!-- <li><a href="<?=base_url();?>input_transaksi_akuntansi_c"><i class="icon-plus-sign"></i> Transaksi Akuntansi</a></li> -->
                    <?PHP } ?>

                    <?php if($this->master_model_m->cek_anak($id_user, 'Pelunasan Hutang', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>input_jurnal_bayar_kas_c"><i class="icon-plus-sign"></i> Pelunasan Hutang </a></li>
                    <?PHP } ?>

                    <!-- <?php if($this->master_model_m->cek_anak($id_user, 'Jurnal Bayar Kas Bank', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>input_jurnal_bayar_kas_piutang_c"><i class="icon-plus-sign"></i> Pelunasan Piutang </a></li>
                    <?PHP } ?> -->

                    <!-- <?php if($this->master_model_m->cek_anak($id_user, 'Jurnal Penyesuaian', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>input_jurnal_penyesuaian_c"><i class="icon-plus-sign"></i> Jurnal Penyesuaian </a></li>
                    <?PHP } ?> -->

                    <?php if($this->master_model_m->cek_anak($id_user, 'Kas & Bank', $user->LEVEL)){ ?>
                    <li><a href="<?=base_url();?>kas_bank_c"><i class="icon-plus-sign"></i> Input Saldo Awal </a></li>
                    <li><a href="<?=base_url();?>input_rkap_c"><i class="icon-plus-sign"></i> Input Perencanaan / RKAP </a></li>
                    <?PHP } ?>
                </ul>
            </div>
            </li>
            <?PHP } ?>
						
            <?php if($this->master_model_m->cek_master($id_user, 'Laporan Akuntansi', $user->LEVEL)){ ?>
						<li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-file-alt"></i> Laporan <b class="icon-angle-down"></b></a>
						<div class="dropdown-menu">
							<ul>
                  <li class="dropdown-submenu"><a href="#"><i class="icon-book"></i> Laporan Pembelian</a>
                  <div class="dropdown-menu">
                    <ul>
                      <li><a href="<?=base_url();?>lap_pembelian_c"><i class=" icon-file-alt"></i> Laporan Pembelian</a></li>
                      <!-- <li><a href="<?=base_url();?>lap_pembelian_bulanan_c"><i class=" icon-file-alt"></i> Laporan Pembelian Bulanan</a></li> -->
                      <li><a href="<?=base_url();?>lap_summary_pembelian_c"><i class=" icon-file-alt"></i> Laporan Summary Pembelian</a></li>
                      <li><a href="<?=base_url();?>lap_detail_pembelian_c"><i class=" icon-file-alt"></i> Laporan Detail Pembelian</a></li>
                      <li><a href="<?=base_url();?>lap_pembelian_produk_supp_c"><i class=" icon-file-alt"></i> Laporan Pembelian Produk Detail Supplier</a></li>
                      <li><a href="<?=base_url();?>lap_pembelian_supp_produk_c"><i class=" icon-file-alt"></i> Laporan Pembelian Supplier Detail Produk</a></li>
                      <li><a href="<?=base_url();?>lap_history_harga_c"><i class=" icon-file-alt"></i> History Harga Pembelian</a></li>
                      <li><a href="<?=base_url();?>lap_sum_um_beli_c"><i class=" icon-file-alt"></i> Summary Uang Muka Pembelian</a></li>
                      <li><a href="<?=base_url();?>lap_sum_po_c"><i class=" icon-file-alt"></i> Summary Order Pembelian (PO)</a></li>
                      <li><a href="<?=base_url();?>lap_detail_po_c"><i class=" icon-file-alt"></i> Laporan Detail Order Pembelian (PO)</a></li>
                      <li><a href="<?=base_url();?>lap_po_outstanding_c"><i class=" icon-file-alt"></i> PO Outstanding</a></li>
                      <li><a href="<?=base_url();?>lap_hutang_jatuh_tempo_c"><i class=" icon-file-alt"></i> Hutang Jatuh Tempo</a></li>
                      <li><a href="<?=base_url();?>lap_sum_hutang_dagang_c"><i class=" icon-file-alt"></i> Summary Hutang Dagang</a></li>
                      <li><a href="<?=base_url();?>lap_kartu_hutang_c"><i class=" icon-file-alt"></i> Kartu Hutang</a></li>
                      <li><a href="<?=base_url();?>lap_sisa_hutang_dagang_c"><i class=" icon-file-alt"></i> Sisa Hutang Dagang</a></li>
                      <li><a href="<?=base_url();?>lap_umur_hutang_c"><i class=" icon-file-alt"></i> Laporan Umur hutang</a></li>
                      <li><a href="<?=base_url();?>lap_daftar_supplier_c"><i class=" icon-file-alt"></i> Daftar Supplier</a></li>
                    </ul>
                  </div>
                  </li>

                  <li class="dropdown-submenu"><a href="#"><i class="icon-book"></i> Laporan Penjualan</a>
                  <div class="dropdown-menu">
                    <ul>
                      <li><a href="<?=base_url();?>lap_penjualan_produk_detail_cust_c"><i class=" icon-file-alt"></i> Laporan Penjualan Produk Detail Customer</a></li>
                      <!-- <li><a href="<?=base_url();?>lap_nota_penjualan_c"><i class=" icon-file-alt"></i> Laporan Nota Penjualan</a></li> -->
                      <li><a href="<?=base_url();?>lap_summary_penjualan_c"><i class=" icon-file-alt"></i> Laporan Summary Penjualan</a></li>
                      <li><a href="<?=base_url();?>lap_detail_penjualan_c"><i class=" icon-file-alt"></i> Laporan Detail Penjualan</a></li>
                      <!-- <li><a href="<?=base_url();?>lap_detail_order_penjualan_c"><i class=" icon-file-alt"></i> Laporan Detail Order Penjualan</a></li> -->
                      <!-- <li><a href="<?=base_url();?>lap_surat_jalan_c"><i class=" icon-file-alt"></i> Laporan Surat Jalan</a></li> -->
                      <!-- <li><a href="<?=base_url();?>lap_nilai_surat_jalan_c"><i class=" icon-file-alt"></i> Laporan Nilai Surat Jalan</a></li> -->
                      <li><a href="<?=base_url();?>lap_penjualan_produk_cust_c"><i class=" icon-file-alt"></i> Laporan Penjualan Produk Per Customer</a></li>
                      <li><a href="<?=base_url();?>lap_penjualan_cust_produk_c"><i class=" icon-file-alt"></i> Laporan Penjualan Customer Per Produk</a></li>
                      <!-- <li><a href="<?=base_url();?>lap_det_order_penjualan_c"><i class=" icon-file-alt"></i> Laporan Detail Order Penjualan</a></li> -->
                      <li><a href="<?=base_url();?>lap_sum_order_penjualan_c"><i class=" icon-file-alt"></i> Laporan Summary Order Penjualan</a></li>
                      <li><a href="<?=base_url();?>lap_realisasi_order_penjualan_c"><i class=" icon-file-alt"></i> Laporan Realisasi Order Penjualan</a></li>
                      <li><a href="<?=base_url();?>lap_so_outstanding_c"><i class=" icon-file-alt"></i> SO Outstanding</a></li>
                      <li><a href="<?=base_url();?>lap_rincian_pelunasan_per_nota_c"><i class=" icon-file-alt"></i> Rincian Pelunasan Tiap Nota</a></li>
                      <!-- <li><a href="<?=base_url();?>lap_perbandingan_so_outstanding_dan_stok_c"><i class=" icon-file-alt"></i> Perbandingan SO Outstanding dan Stok</a></li> -->
                      <li><a href="<?=base_url();?>lap_piutang_jatuh_tempo_c"><i class=" icon-file-alt"></i> Laporan Piutang Jatuh Tempo</a></li>
                      <li><a href="<?=base_url();?>lap_summary_piutang_cust_c"><i class=" icon-file-alt"></i> Summary Piutang Customer</a></li>
                      <li><a href="<?=base_url();?>lap_summary_piutang_dagang_c"><i class=" icon-file-alt"></i> Summary Piutang Dagang</a></li>
                      <li><a href="<?=base_url();?>lap_kartu_piutang_c"><i class=" icon-file-alt"></i> Kartu Piutang</a></li>
                      <li><a href="<?=base_url();?>lap_sisa_piutang_dagang_c"><i class=" icon-file-alt"></i> Laporan Sisa Piutang Dagang </a></li>
                      <!-- <li><a href="<?=base_url();?>lap_umur_piutang_c"><i class=" icon-file-alt"></i> Laporan Umur Piutang </a></li> -->
                      <!-- <li><a href="<?=base_url();?>lap_umur_piutang_per_faktur_c"><i class=" icon-file-alt"></i> Laporan Umur Piutang per Faktur </a></li> -->
                      <!-- <li><a href="<?=base_url();?>lap_umur_piutang_per_customer_c"><i class=" icon-file-alt"></i> Laporan Umur Piutang per Customer </a></li> -->
                      <li><a href="<?=base_url();?>lap_daftar_customer_c"><i class=" icon-file-alt"></i> Daftar Customer</a></li>
                    </ul>
                  </div>
                  </li>

                  <li class="dropdown-submenu"><a href="#"><i class="icon-book"></i> Laporan Keuangan</a>
                  <div class="dropdown-menu">
                    <ul>
                      <li><a href="<?=base_url();?>lap_kas_bank_c"><i class=" icon-file-alt"></i> Laporan Kas/Bank </a></li>
                      <li><a href="<?=base_url();?>lap_kas_bank_rinci_c"><i class=" icon-file-alt"></i> Laporan Kas/Bank Rinci</a></li>
                      <li><a href="<?=base_url();?>lap_pelunasan_kas_bank_c"><i class=" icon-file-alt"></i> Laporan Pelunasan Kas/Bank</a></li>
                      <li><a href="<?=base_url();?>lap_pembayaran_ke_supplier_c"><i class=" icon-file-alt"></i> Laporan Pembayaran Ke Supplier</a></li>
                      <li><a href="<?=base_url();?>lap_penerimaan_kas_bank_c"><i class=" icon-file-alt"></i> Laporan Penerimaan Kas/Bank</a></li>
                      <li><a href="<?=base_url();?>lap_pengeluaran_kas_bank_c"><i class=" icon-file-alt"></i> Laporan Pengeluaran Kas/Bank</a></li>
                    </ul>
                  </div>
                  </li>

                  <li class="dropdown-submenu"><a href="#"><i class="icon-book"></i> Laporan Akuntansi</a>
                  <div class="dropdown-menu">
                    <ul>
                      <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Buku Besar', $user->LEVEL)){ ?>
                      <li><a href="<?=base_url();?>lap_buku_besar_c"><i class=" icon-book"></i> Laporan Buku Besar </a></li>
                      <?PHP } ?>

                      <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Laba Rugi', $user->LEVEL)){ ?>
                      <li><a href="<?=base_url();?>lap_laba_rugi_c"><i class=" icon-book"></i> Laporan Laba Rugi  </a> </li>
                      <?PHP } ?>

                      <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Jurnal Umum', $user->LEVEL)){ ?>
                      <li><a href="<?=base_url();?>lap_jurnal_umum_c"><i class=" icon-book"></i> Laporan Jurnal Akuntansi  </a></li>
                      <?PHP } ?>

                      <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Arus Kas', $user->LEVEL)){ ?>
                      <!-- <li><a href="<?=base_url();?>lap_arus_kas_c"><i class=" icon-book"></i> Laporan Arus Kas </a></li> -->
                      <?PHP } ?>

                      <?php if($this->master_model_m->cek_anak($id_user, 'Jurnal Penyesuaian', $user->LEVEL)){ ?>
                      <!-- <li><a href="<?=base_url();?>lap_jurnal_penyesuaian_c"><i class=" icon-book"></i> Jurnal Penyesuaian  </a></li> -->
                      <?PHP } ?>

                      <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Neraca', $user->LEVEL)){ ?>
                      <li><a href="<?=base_url();?>lap_neraca_c"><i class=" icon-book"></i> Laporan Neraca  </a></li>
                      <?PHP } ?>

                      <!-- <li><a href="<?=base_url();?>lap_neraca_lajur_c"><i class=" icon-book"></i> Laporan Neraca Lajur </a></li> -->
                    </ul>
                  </div>
                  </li>
                  <!-- <li <?PHP if($view == "lap_penjualan"){ echo "class='active'"; } ?>><a href="<?=base_url();?>lap_penjualan_c"><i class=" icon-book"></i> Laporan Penjualan </a></li>
                  <li <?PHP if($view == "lap_pembelian"){ echo "class='active'"; } ?>><a href="<?=base_url();?>lap_pembelian_c"><i class=" icon-book"></i> Laporan Pembelian </a></li> -->

                  <!-- <li <?PHP if($view == "lap_servis_farmasi"){ echo "class='active'"; } ?>><a href="<?=base_url();?>lap_keseluruhan_c"><i class=" icon-book"></i> Ringkasan Keseluruhan </a></li> -->
                  
                  <!-- <li <?PHP if($view == "lap_hcc"){ echo "class='active'"; } ?>><a href="<?=base_url();?>lap_hpp_c"><i class=" icon-book"></i> Laporan HPP </a></li> -->

                  
                  
                  <!-- <li <?PHP if($view == "mutasi_hutang"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_mutasi_hutang_c"><i class=" icon-book"></i> Daftar Mutasi Hutang </a> </li>
                  <li <?PHP if($view == "mutasi_piutang"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_mutasi_piutang_c"><i class=" icon-book"></i> Daftar Mutasi Piutang </a></li> -->
							</ul>
						</div>
						</li>
            <?PHP } ?>                        
					</ul>
				</div>
				<div class="btn-toolbar pull-right notification-nav">
					<div class="btn-group">
						<div class="dropdown">
							<a href="<?=base_url();?>beranda_c/sign_out" class="btn btn-notification"><i class="icon-lock"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="leftbar leftbar-close clearfix" style="margin-top: 50px; position:fixed; background:#203956;">
		<div class="admin-info clearfix">
			<div class="admin-thumb">
        <?PHP if($user->FOTO == "" || $user->FOTO== null){ ?>
        <i class="icon-user"></i>
        <?PHP } else { ?>
        <img src="<?=$base_url2;?>files/foto/<?=$user->FOTO;?>" style="padding-bottom: 5px;" />
        <?PHP } ?>
			</div>
			<div class="admin-meta">
				<ul>
          <li class="admin-username" style="color: red;"> <?=$user->NAMA;?> </li>
          <?PHP if($user->LEVEL == 'ADMIN'){ ?>
          <li class="admin-username" style="color:#FFF;"> DIREKTUR </li>
          <?PHP } else { ?>
          <li class="admin-username" style="color:#FFF;"> <font style="color:#FFF;"><?=$user->LEVEL;?></font></li>
          <?PHP } ?>

          <li>
            <?PHP if($user->LEVEL == 'ADMIN'){ ?>
            <a href="<?=base_url();?>pengaturan_akun_c"> Edit Profil </a>
            <?PHP } else { ?>
            <a href="<?=base_url();?>pengaturan_akun_c"> Edit Profil </a>
            <?PHP } ?>
            <a href="<?=base_url();?>beranda_c/sign_out"><i class="icon-lock"></i> Logout</a>
          </li>
				</ul>
			</div>
		</div>
		<div class="left-nav clearfix" style="background:#203956;">
			<div class="left-primary-nav">
				<ul id="myTab">
          <?PHP if($user->LEVEL != 'ADMIN'){ ?>
					<li <?PHP if($master == ""){ echo "class='active'"; } ?> ><a href="#main" onclick="window.location='<?=base_url();?>beranda_c';"  class="icon-desktop" title="Dashboard"></a></li>					
            <?php if($this->master_model_m->cek_master($id_user, 'Master Data', $user->LEVEL)){ ?>
            <li <?PHP if($master == "master_data"){ echo "class='active'"; } ?> ><a href="#features" class="icon-globe" title="Master Data"></a></li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, 'Logistik', $user->LEVEL)){ ?>
            <li <?PHP if($master == "logistik"){ echo "class='active'"; } ?> ><a href="#logistik" class="icon-truck" title="Logistik"></a></li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, 'Master Data', $user->LEVEL)){ ?>
            <li <?PHP if($master == "persediaan"){ echo "class='active'"; } ?> ><a href="#persediaan" class="icon-signal" title="Persediaan"></a></li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, 'Master Data', $user->LEVEL)){ ?>
            <li <?PHP if($master == "aset"){ echo "class='active'"; } ?> ><a href="#features_aset" class="icon-pushpin" title="Aset"></a></li>
            <?PHP } ?>

            <!-- <?php if($this->master_model_m->cek_master($id_user, 'Master Data', $user->LEVEL)){ ?>
            <li <?PHP if($master == "produksi"){ echo "class='active'"; } ?> ><a href="#produksi" class="icon-beaker" title="Produksi"></a></li>
            <?PHP } ?> -->

            <?php if($this->master_model_m->cek_master($id_user, 'Input Data', $user->LEVEL)){ ?>
            <li <?PHP if($master == "pembelian"){ echo "class='active'"; } ?> ><a href="#forms_penerimaan" class="icon-th-large" title="Pembelian / Penerimaan "></a></li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, '', $user->LEVEL)){ ?>
            <li <?PHP if($master == "penjualan"){ echo "class='active'"; } ?> ><a href="#forms_penerimaan_jual" class="icon-th-large" title="Penjualan "></a></li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, '', $user->LEVEL)){ ?>
            <li <?PHP if($master == "hrd"){ echo "class='active'"; } ?> ><a href="#forms_hrd" class="icon-user" title="HRD "></a></li>
            <?PHP } ?>

            <?php if($this->master_model_m->cek_master($id_user, 'Input Akuntansi', $user->LEVEL)){ ?>
            <li <?PHP if($master == "input_akuntansi"){ echo "class='active'"; } ?> ><a href="#input_akun" class="icon-briefcase" title="Input Akuntansi "></a></li>
	         <?PHP } ?>

           <!--  <?php if($this->master_model_m->cek_master($id_user, 'Laporan Akuntansi', $user->LEVEL)){ ?>
            <li <?PHP if($master == "laporan"){ echo "class='active'"; } ?> ><a href="#pages" class="icon-file-alt" title="Laporan"></a></li>
            <?PHP } ?> -->

           
            <li <?PHP if($master == "laporan_pembelian"){ echo "class='active'"; } ?> ><a href="#lap_pembelian" class="icon-file-alt" title="Laporan"></a></li>
           

             
            <li <?PHP if($master == "laporan_penjualan"){ echo "class='active'"; } ?> ><a href="#lap_penjualan" class="icon-file-alt" title="Laporan"></a></li>
           


            <li <?PHP if($master == "laporan_keuangan"){ echo "class='active'"; } ?> ><a href="#lap_keuangan" class="icon-file-alt" title="Laporan"></a></li>
           

         
            <li <?PHP if($master == "laporan_akuntansi"){ echo "class='active'"; } ?> ><a href="#lap_akuntansi" class="icon-file-alt" title="Laporan"></a></li>
           

            <?php if($this->master_model_m->cek_master($id_user, 'Pengaturan', $user->LEVEL)){ ?>
	          <li <?PHP if($master == "setting"){ echo "class='active'"; } ?> ><a href="#pengaturan" class="icon-cog" title="Pengaturan"></a></li>
            <?PHP } ?>

            <?PHP } else { ?>
            <li <?PHP if($master == ""){ echo "class='active'"; } ?> ><a href="#main" onclick="window.location='<?=base_url();?>beranda_c';"  class="icon-desktop" title="Dashboard"></a></li>
            <li <?PHP if($master == "laporan_pembelian"){ echo "class='active'"; } ?> ><a href="#lap_pembelian" class="icon-file-alt" title="Laporan"></a></li>
            <li <?PHP if($master == "laporan_penjualan"){ echo "class='active'"; } ?> ><a href="#lap_penjualan" class="icon-file-alt" title="Laporan"></a></li>
            <li <?PHP if($master == "laporan_keuangan"){ echo "class='active'"; } ?> ><a href="#lap_keuangan" class="icon-file-alt" title="Laporan"></a></li>
            <li <?PHP if($master == "laporan_akuntansi"){ echo "class='active'"; } ?> ><a href="#lap_akuntansi" class="icon-file-alt" title="Laporan"></a></li>
            <?PHP } ?>
				</ul>
			</div>
			<div class="responsive-leftbar">
				<i class="icon-list"></i>
			</div>
			<div class="left-secondary-nav tab-content" style="background:#203956;">
	        <div class="tab-pane <?PHP if($master == ""){ echo "active"; } ?>" id="main">
		          <h4 class="side-head">Dashboard</h4>
		          <ul class="metro-sidenav clearfix">
                  <?php if($this->master_model_m->cek_anak($id_user, 'Transaksi Penjualan', $user->LEVEL)){ ?>
                  <li><a class="green" href="<?=base_url();?>transaksi_penjualan_c"><i class="icon-random"></i><span> Penjualan </span></a></li>
                  <?PHP } ?>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Transaksi Pembelian', $user->LEVEL)){ ?>
                  <li><a class="brown" href="<?=base_url();?>transaksi_pembelian_c"><i class="icon-shopping-cart"></i><span>Pembelian </span></a></li>
                  <?PHP } ?>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Kas & Bank', $user->LEVEL)){ ?>
                  <!-- <li><a class="orange" href="<?=base_url();?>kas_bank_c"><i class="icon-money"></i><span> Kas & Bank </span></a></li> -->
                  <?PHP } ?>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Kode Akun', $user->LEVEL)){ ?>
                  <li><a class=" blue-violate" href="<?=base_url();?>daftar_kode_akun_c"><i class="icon-tag"></i><span> Kode Akun </span></a></li>
                  <?PHP } ?>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Produk', $user->LEVEL)){ ?>
                  <li><a class=" bondi-blue" href="<?=base_url();?>produk_c"><i class="icon-hdd"></i><span> Produk </span></a></li>
                  <?PHP } ?>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Pelanggan', $user->LEVEL)){ ?>
                  <li><a class=" dark-yellow" href="<?=base_url();?>pelanggan_c"><i class="icon-group"></i><span> Customer </span></a></li>

                  <?PHP } ?>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Supplier', $user->LEVEL)){ ?>
                  <li><a class=" blue" href="<?=base_url();?>supplier_c"><i class="icon-truck"></i><span> Supplier </span></a></li>
                  <?PHP } ?>

                  <?PHP if($user->LEVEL == 'ADMIN'){ ?>
                  <li><a class=" magenta" href="<?=base_url();?>profil_perusahaan_c"><i class="icon-pencil"></i><span>Profil Usaha</span></a></li>
                  <?PHP } else { ?>
                  <li><a class=" magenta" href="<?=base_url();?>pengaturan_akun_c"><i class="icon-pencil"></i><span>Profil Saya</span></a></li>
                  <?PHP } ?>
              </ul>
	        </div>

          <div class="tab-pane <?PHP if($master == "master_data"){ echo "active"; } ?>" id="features">
              <h4 class="side-head">Master Data</h4>
              <ul class="accordion-nav">
                  <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Kategori Akun', $user->LEVEL)){ ?>
                  <!-- <li <?PHP if($view == "daftar_kat_akun"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>daftar_kategori_akun_c"><i class="icon-bookmark"></i> Daftar Kategori Akun <span> Daftar Kategori Kode Akun Anda </span> </a></li> -->
                  <?PHP } ?>

                  <li <?PHP if($view == "grup_akun"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>grup_kode_akun_c"><i class="icon-tag"></i> Grup Kode Akun 
                        <span> Daftar Grup Kode Akuntansi anda </span> 
                        <?PHP if($user->LEVEL == 'MANAGER'){ ?>
                        <?PHP if(count($dt_pengajuan_kode_grup) > 0){ ?>
                        <span class="notify-tip"><?=count($dt_pengajuan_kode_grup);?></span> 
                        <?PHP } ?>
                        <?PHP } ?>
                      </a>
                  </li>

                  <!-- <li <?PHP if($view == "sub_grup"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>sub_grup_kode_akun_c"><i class="icon-tag"></i> Sub Grup Kode Akun 
                        <span> Daftar Sub Grup Kode Akuntansi anda </span>
                        <?PHP if($user->LEVEL == 'MANAGER'){ ?>
                        <?PHP if(count($dt_pengajuan_sub_kode_grup) > 0){ ?>
                        <span class="notify-tip"><?=count($dt_pengajuan_sub_kode_grup);?></span> 
                        <?PHP } ?>
                        <?PHP } ?>
                      </a>
                  </li> -->

                  <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Kode Akun', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "daftar_akun"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>daftar_kode_akun_c"><i class="icon-tag"></i> Daftar Kode Akun 
                          <span> Mengelola Kode Akun Anda </span> 
                          <?PHP if($user->LEVEL == 'MANAGER'){ ?>
                          <?PHP if(count($dt_pengajuan_kode_akun) > 0){ ?>
                          <span class="notify-tip"><?=count($dt_pengajuan_kode_akun);?></span> 
                          <?PHP } ?>
                          <?PHP } ?>
                      </a>
                  </li>
                  <?PHP } ?>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Daftar Kode Akun', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "divisi"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>divisi_c"><i class="icon-tag"></i> Divisi
                          <span> Mengelola Divisi </span> 
                          <?PHP if($user->LEVEL == 'MANAGER'){ ?>
                          <?PHP if(count($dt_pengajuan_kode_akun) > 0){ ?>
                          <span class="notify-tip"><?=count($dt_pengajuan_kode_akun);?></span> 
                          <?PHP } ?>
                          <?PHP } ?>
                      </a>
                  </li>
                  <?PHP } ?>

                  <li <?PHP if($view == "gudang"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>gudang_c"><i class="icon-briefcase "></i> Supply Point
                        <span> Data Supply Point</span> 
                      </a>
                  </li>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Pelanggan', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "daftar_pelanggan"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>pelanggan_c"><i class="icon-group"></i> Customer 
                      <span> Daftar Customer Anda  </span> 

                      <?PHP if($user->LEVEL == 'MANAGER'){ ?>
                      <?PHP if(count($dt_pengajuan_pelanggan) > 0){ ?>
                      <span class="notify-tip"><?=count($dt_pengajuan_pelanggan);?></span> 
                      <?PHP } ?>
                      <?PHP } ?>
                      </a>
                  </li>
                  <?PHP } ?>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Supplier', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "daftar_supplier"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>supplier_c"><i class="icon-truck"></i> Supplier 
                          <span> Kelola Daftar Supplier  </span>  
                          <?PHP if($user->LEVEL == 'MANAGER'){ ?>
                          <?PHP if(count($dt_pengajuan_supplier) > 0){ ?>
                          <span class="notify-tip"><?=count($dt_pengajuan_supplier);?></span> 
                          <?PHP } ?>
                          <?PHP } ?>
                      </a>
                  </li>
                  <?PHP } ?>

                 <!--  <li <?PHP if($view == "broker"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>broker_c"><i class="icon-tags"></i> Master Marketing
                        <span> Data broker / sales</span> 
                      </a>
                  </li> -->

                  <?php if($this->master_model_m->cek_anak($id_user, 'Produk', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "daftar_produk"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>produk_c"><i class="icon-hdd"></i> Produk 
                          <span> Daftar Produk untuk Transaksi Anda  </span> 
                          <?PHP if($user->LEVEL == 'MANAGER'){ ?>
                          <?PHP if(count($dt_pengajuan_produk) > 0){ ?>
                          <span class="notify-tip"><?=count($dt_pengajuan_produk);?></span> 
                          <?PHP } ?>
                          <?PHP } ?>
                      </a>
                  </li>
                  <?PHP } ?>

                  <!-- <li <?PHP if($view == "harga"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>harga_c"><i class="icon-money"></i> Master Harga 
                        <span> Inputkan harga jual dan beli produk anda</span> 
                      </a>
                  </li> -->

                 <!--  <li <?PHP if($view == "kategori_produk"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>kategori_produk_c"><i class="icon-tags"></i> Master Kategori Produk 
                        <span> Data kategori produk</span> 
                      </a>
                  </li> -->

                  <li <?PHP if($view == "kendaraan"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>kendaraan_c"><i class="icon-caret-right"></i> Master Kendaraan
                        <span> Data kendaraan</span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "master_harga"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>master_harga_c"><i class="icon-caret-right"></i> Master Harga
                        <span> Data Master Harga</span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "master_transportir"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>master_transportir_c"><i class="icon-truck"></i> Master Transportir
                        <span> Data Master Transportir</span> 
                      </a>
                  </li>

                  
              </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "aset"){ echo "active"; } ?>" id="features_aset">
              <h4 class="side-head">Aset</h4>
              <ul class="accordion-nav">
                  <li <?PHP if($view == "grup_aset"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>grup_aset_c"><i class="icon-minus"></i> Grup Aset 
                        <span> Daftar grup aset perusahaan </span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "sub_grup_aset"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>sub_grup_aset_c"><i class="icon-minus"></i> Sub Grup Aset 
                        <span> Daftar sub grup aset perusahaan </span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "master_aset"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>master_aset_c"><i class="icon-minus"></i> Daftar Aset Tetap 
                        <span> Data aset perusahaan</span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "input_aset_harga"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>input_aset_harga_c"><i class="icon-minus"></i> Harga & Penyusutan
                        <span> Input Harga Perolehan dan Penyusutan Aset </span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_aset_tetap"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_aset_tetap_c"><i class="icon-minus"></i> Laporan Aset Tetap
                        <span> Menampilkan Laporan Aset Tetap & Penyusutannya </span> 
                      </a>
                  </li>
              </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "logistik"){ echo "active"; } ?>" id="logistik">
              <h4 class="side-head">Logistik</h4>
              <ul class="accordion-nav">
                  <li <?PHP if($view == "service_kendaraan"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>stock_c"><i class="icon-minus"></i> Docking Kapal
                        <span> Docking Kapal Anda</span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "logistik_order"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>order_logistik_c/new_invoice"><i class="icon-minus"></i> Order Logistik
                        <span> Order barang logistik</span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "laporan_pajak"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>order_logistik_c/pajak_laporan"><i class="icon-minus"></i> Laporan Dokumen
                        <span> Laporan Dokumen Kapal Tahunan</span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "gps_tracking"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>order_logistik_c/gps_tracking"><i class="icon-minus"></i> GPS Tracking
                        <span> Tracking GPS Kendaraan</span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "asuransi"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>order_logistik_c/gps_tracking"><i class="icon-minus"></i> Asuransi
                        <span> Asuransi Kendaraan</span> 
                      </a>
                  </li>
              </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "persediaan"){ echo "active"; } ?>" id="persediaan">
              <h4 class="side-head">Persediaan</h4>
              <ul class="accordion-nav">
                  <li <?PHP if($view == "stock"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>stock_c"><i class="icon-minus"></i> Stock 
                        <span> Daftar stock barang anda</span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "stock_opname"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>stock_opname_c"><i class="icon-minus"></i> Stock Opname
                        <span> Menu untuk melakukan stock opname</span> 
                      </a>
                  </li>

                  <li <?PHP if($view == "koreksi_persediaan"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>koreksi_persediaan_c"><i class="icon-minus"></i> Koreksi Persediaan
                        <span> Koreksi persediaan barang anda</span> 
                      </a>
                  </li>
              </ul>
          </div>

  				<div class="tab-pane <?PHP if($master == "pembelian"){ echo "active"; } ?>" id="forms_penerimaan">
  					<h4 class="side-head">Pembelian / Penerimaan</h4>
  					<ul id="nav" class="accordion-nav">
                
                <!-- <li <?PHP if($view == "penawaran_barang_beli"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>penawaran_barang_beli_c">
                    <i class="icon-caret-right"></i> Penawaran Barang <span> Membuat daftar penawaran barang</span>
                  </a>
                </li> -->

                <li <?PHP if($view == "purchase_order"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>purchase_order_c">
                    <i class="icon-caret-right "></i> Purchase Order <span> Membuat daftar pembelian / purchase order</span>
                  </a>
                </li>

                <li <?PHP if($view == "penerimaan_barang"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>penerimaan_barang_c">
                    <i class="icon-caret-right "></i> Penerimaan <span> Membuat daftar penerimaan </span>
                  </a>
                </li>

                <!-- <li <?PHP if($view == "pembelian"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>pembelian_c">
                    <i class="icon-caret-right "></i> Pembelian <span> Membuat pembelian</span>
                  </a>
                </li> -->
            </ul>
  				</div>

          <div class="tab-pane <?PHP if($master == "penjualan"){ echo "active"; } ?>" id="forms_penerimaan_jual">
            <h4 class="side-head">Penjualan</h4>
            <ul id="nav" class="accordion-nav">
                <!-- <li <?PHP if($view == "penawaran_barang_v"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>penawaran_barang_c">
                    <i class="icon-caret-right"></i> Penawaran Barang <span> Membuat daftar penawaran barang </span>
                  </a>
                </li> -->

                <li <?PHP if($view == "transaksi_penjualan"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>transaksi_penjualan_c">
                    <i class="icon-caret-right"></i> Penjualan <span> Membuat daftar penjualan </span>
                  </a>
                </li>

                <li <?PHP if($view == "delivery_order"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>delivery_order_new_c">
                    <i class="icon-caret-right"></i> Delivery Order <span> Mencetak delivery order </span>
                  </a>
                </li>

                <!-- <li <?PHP if($view == "surat_jalan"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>transaksi_penjualan_c/buka_surat_jalan">
                    <i class="icon-caret-right"></i> Surat Jalan <span> Mencetak surat jalan</span>
                  </a>
                </li> -->

                <li <?PHP if($view == "invoice"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>transaksi_penjualan_c/buka_invoice">
                    <i class="icon-caret-right"></i> Invoice <span> Mencetak invoice </span>
                  </a>
                </li>

                <!-- <li <?PHP if($view == "kwitansi"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>kwitansi_c">
                    <i class="icon-caret-right"></i> Kwitansi <span> Mencetak kwitansi </span>
                  </a>
                </li> -->

            </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "hrd"){ echo "active"; } ?>" id="forms_hrd">
            <h4 class="side-head">Penjualan</h4>
            <ul id="nav" class="accordion-nav">
                

                <li <?PHP if($view == "data_pegawai"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>transaksi_penjualan_c">
                    <i class="icon-caret-right"></i> Pegawai <span> Membuat daftar pegawai </span>
                  </a>
                </li>

                <li <?PHP if($view == "set_gaji"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>delivery_order_new_c">
                    <i class="icon-caret-right"></i> Set Gaji <span> Membuat set gaji </span>
                  </a>
                </li>

                <li <?PHP if($view == "lowongan"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>data_lowongan_c">
                    <i class="icon-caret-right"></i> Lowongan <span> Master Lowongan </span>
                  </a>
                </li>

                <li <?PHP if($view == "data_sertifikat"){ echo "class='active'"; } ?>>
                  <a href="<?=base_url();?>data_sertifikat_c">
                    <i class="icon-caret-right"></i> Sertifikat <span> Master Data Sertifikat </span>
                  </a>
                </li>

            </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "input_akuntansi"){ echo "active"; } ?>" id="input_akun">
              <h4 class="side-head">Input Akuntansi</h4>
              <ul id="nav" class="accordion-nav">


                  <?php if($this->master_model_m->cek_anak($id_user, 'Transaksi Akuntansi', $user->LEVEL)){ ?>
                  <!-- <li <?PHP if($view == "input_transaksi_akuntansi"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>input_transaksi_akuntansi_c"><i class="icon-plus-sign"></i> Transaksi Akuntansi </a></li>
                  <?PHP } ?> -->

                  <?php if($this->master_model_m->cek_anak($id_user, 'Transaksi Akuntansi', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "input_jurnal_umum"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>input_jurnal_umum_c"><i class="icon-plus-sign"></i> Input Jurnal Umum </a></li>
                  <?PHP } ?>

                  <li <?PHP if($view == "kk"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>kas_kecil_c"><i class="icon-plus-sign"></i> Input Kas Kecil </a></li>
                  <li <?PHP if($view == "bkk"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>bukti_kas_keluar_c"><i class="icon-plus-sign"></i> Bukti Kas Keluar </a></li>
                  <li <?PHP if($view == "bkm"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>bukti_kas_masuk_c"><i class="icon-plus-sign"></i> Bukti Kas Masuk </a></li>

                  <?php if($this->master_model_m->cek_anak($id_user, 'Jurnal Bayar Kas Bank', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "jurnal_bayar_kas"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>input_jurnal_bayar_kas_c"><i class="icon-plus-sign"></i> Pelunasan Hutang </a></li>
                  <?PHP } ?>

                  <!-- <?php if($this->master_model_m->cek_anak($id_user, 'Jurnal Bayar Kas Bank', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "jurnal_bayar_kas_piutang"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>input_jurnal_bayar_kas_piutang_c"><i class="icon-plus-sign"></i> Pelunasan Piutang </a></li>
                  <?PHP } ?> -->

                  <!-- <?php if($this->master_model_m->cek_anak($id_user, 'Jurnal Penyesuaian', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "jp"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>input_jurnal_penyesuaian_c"><i class="icon-plus-sign"></i> Jurnal Penyesuaian </a></li>
                  <?PHP } ?> -->

                  <!-- <?php if($this->master_model_m->cek_anak($id_user, 'Hapus Transaksi Akun', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "hapus_trx_akun"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>hapus_transaksi_akun_c"><i class="icon-remove-sign"></i> Hapus Transaksi Akun </a></li>
                  <?PHP } ?> -->

                  <?php if($this->master_model_m->cek_anak($id_user, 'Kas & Bank', $user->LEVEL)){ ?>
                  <li <?PHP if($view == "kas_bank"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>kas_bank_c">
                    <i class="icon-plus-sign"></i> Input Saldo Awal <span> Tambahkan saldo awal pada kode akun</span></a>
                  </li>
                  <?PHP } ?>  

                  <li <?PHP if($view == "input_rkap"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>input_rkap_c">
                    <i class="icon-plus-sign"></i> Input RKAP <span> Input perencanaan perusahaan anda / RKAP</span></a>
                  </li>                
              </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "laporan"){ echo "active"; } ?>" id="pages">
            <h4 class="side-head"><b>Laporan Akuntansi</b></h4>
	          <ul class="accordion-nav">

                <!-- <li <?PHP if($view == "lap_penjualan"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_penjualan_c"> Laporan Penjualan </a></li>
                <li <?PHP if($view == "lap_pembelian"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_pembelian_c"> Laporan Pembelian </a></li> -->

                <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Buku Besar', $user->LEVEL)){ ?>
                <li <?PHP if($view == "buku_besar"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_buku_besar_c"> Laporan Buku Besar </a></li>
                <?PHP } ?>

                <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Laba Rugi', $user->LEVEL)){ ?>
                <li <?PHP if($view == "laba_rugi"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_laba_rugi_c"> Laporan Laba Rugi  </a> </li>
                <?PHP } ?>

                <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Jurnal Umum', $user->LEVEL)){ ?>
                <li <?PHP if($view == "jurnal_umum"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_jurnal_umum_c"> Laporan Jurnal Akuntansi  </a></li>
                <?PHP } ?>

                <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Arus Kas', $user->LEVEL)){ ?>
                <!-- <li <?PHP if($view == "arus_kas"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_arus_kas_c"> Laporan Arus Kas </a></li> -->
                <?PHP } ?>

                <?php if($this->master_model_m->cek_anak($id_user, 'Jurnal Penyesuaian', $user->LEVEL)){ ?>
                <!-- <li <?PHP if($view == "jp"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_jurnal_penyesuaian_c"> Jurnal Penyesuaian </a></li> -->
                <?PHP } ?>

                <?php if($this->master_model_m->cek_anak($id_user, 'Laporan Neraca', $user->LEVEL)){ ?>
    						<li <?PHP if($view == "neraca"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_neraca_c"> Laporan Neraca </a></li>
    					  <?PHP } ?>

                <!-- <li <?PHP if($view == "neraca_lajur"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_neraca_lajur_c"> Laporan Neraca Lajur</a></li> -->


                <!-- <li <?PHP if($view == "mutasi_hutang"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_mutasi_hutang_c"> Daftar Mutasi Hutang </a></li>
                <li <?PHP if($view == "mutasi_piutang"){ echo "class='active'"; } ?> ><a href="<?=base_url();?>lap_mutasi_piutang_c"> Daftar Mutasi Piutang </a></li> -->
            </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "laporan_pembelian"){ echo "active"; } ?>" id="lap_pembelian">
              <h4 class="side-head">Laporan Pembelian</h4>
              <ul class="accordion-nav">
                  <li <?PHP if($view == "lap_pembelian"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_pembelian_c"><i class="icon-minus"></i> Laporan Pembelian 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_summary_pembelian"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_summary_pembelian_c"><i class="icon-minus"></i> Laporan Summary Pembelian 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_detail_pembelian"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_detail_pembelian_c"><i class="icon-minus"></i> Laporan Detail Pembelian 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_pembelian_produk_supp"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_pembelian_produk_supp_c"><i class="icon-minus"></i> Laporan Pembelian Produk Detail Supplier 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_pembelian_supp_produk"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_pembelian_supp_produk_c"><i class="icon-minus"></i> Laporan Pembelian Supplier Detail Produk 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_history_harga"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_history_harga_c"><i class="icon-minus"></i> History Harga Pembelian 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_sum_um_beli"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_sum_um_beli_c"><i class="icon-minus"></i> Summary Uang Muka Pembelian 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_sum_po"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_sum_po_c"><i class="icon-minus"></i> Summary Order Pembelian (PO) 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_detail_po"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_detail_po_c"><i class="icon-minus"></i> Laporan Detail Order Pembelian (PO) 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_po_outstanding"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_po_outstanding_c"><i class="icon-minus"></i> PO Outstanding 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_hutang_jatuh_tempo"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_hutang_jatuh_tempo_c"><i class="icon-minus"></i> Hutang Jatuh Tempo 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_sum_hutang_dagang"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_sum_hutang_dagang_c"><i class="icon-minus"></i> Summary Hutang Dagang 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_kartu_hutang"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_kartu_hutang_c"><i class="icon-minus"></i> Kartu Hutang 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_sisa_hutang_dagang"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_sisa_hutang_dagang_c"><i class="icon-minus"></i> Sisa Hutang Dagang 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_umur_hutang"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_umur_hutang_c"><i class="icon-minus"></i> Laporan Umur hutang 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_daftar_supplier"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_daftar_supplier_c"><i class="icon-minus"></i> Daftar Supplier 
                      </a>
                  </li>

                  
              </ul>
          </div>

           <div class="tab-pane <?PHP if($master == "laporan_penjualan"){ echo "active"; } ?>" id="lap_penjualan">
              <h4 class="side-head">Laporan Penjualan</h4>
              <ul class="accordion-nav">
                  <li <?PHP if($view == "lap_penjualan_produk_detail_cust_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_penjualan_produk_detail_cust_c"><i class="icon-minus"></i> Laporan Penjualan Produk Detail Customer 
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_summary_penjualan_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_summary_penjualan_c"><i class="icon-minus"></i> Laporan Summary Penjualan
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_detail_penjualan_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_detail_penjualan_c"><i class="icon-minus"></i> Laporan Detail Penjualan
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_penjualan_produk_cust_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_penjualan_produk_cust_c"><i class="icon-minus"></i> Laporan Penjualan Produk Per Custom
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_penjualan_cust_produk_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_penjualan_cust_produk_c"><i class="icon-minus"></i> Laporan Penjualan Customer Per Produk
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_sum_order_penjualan_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_sum_order_penjualan_c"><i class="icon-minus"></i> Laporan Summary Order Penjualan
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_realisasi_order_penjualan_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_realisasi_order_penjualan_c"><i class="icon-minus"></i> Laporan Realisasi Order Penjualan
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_so_outstanding_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_so_outstanding_c"><i class="icon-minus"></i> SO Outstanding
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_rincian_pelunasan_per_nota_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_rincian_pelunasan_per_nota_c"><i class="icon-minus"></i>Rincian Pelunasan Tiap Nota
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_piutang_jatuh_tempo_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_piutang_jatuh_tempo_c"><i class="icon-minus"></i> Laporan Piutang Jatuh Tempo
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_summary_piutang_cust_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_summary_piutang_cust_c"><i class="icon-minus"></i> Summary Piutang Customer
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_summary_piutang_dagang_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_summary_piutang_dagang_c"><i class="icon-minus"></i> Summary Piutang Dagang
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_kartu_piutang_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_kartu_piutang_c"><i class="icon-minus"></i> Kartu Piutang
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_sisa_piutang_dagang_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_sisa_piutang_dagang_c"><i class="icon-minus"></i> Laporan Sisa Piutang Dagang
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_umur_piutang_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_umur_piutang_c"><i class="icon-minus"></i> Laporan Umur Piutang
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_daftar_customer_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_daftar_customer_c"><i class="icon-minus"></i> Daftar Customer
                      </a>
                  </li>

                  
              </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "laporan_keuangan"){ echo "active"; } ?>" id="lap_keuangan">
              <h4 class="side-head">Laporan Keuangan</h4>
              <ul class="accordion-nav">
                  <li <?PHP if($view == "lap_kas_bank_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_kas_bank_c"><i class="icon-minus"></i> Laporan Kas/Bank 
                        
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_kas_bank_rinci_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_kas_bank_rinci_c"><i class="icon-minus"></i> Laporan Kas/Bank Rinci
                        
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_pelunasan_kas_bank_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_pelunasan_kas_bank_c"><i class="icon-minus"></i> Laporan Pelunasan Kas/Bank
                        
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_pembayaran_ke_supplier_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_pembayaran_ke_supplier_c"><i class="icon-minus"></i> Laporan Pembayaran Ke Supplier
                        
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_penerimaan_kas_bank_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_penerimaan_kas_bank_c"><i class="icon-minus"></i> Laporan Penerimaan Kas/Bank
                        
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_pengeluaran_kas_bank_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_pengeluaran_kas_bank_c"><i class="icon-minus"></i> Laporan Pengeluaran Kas/Bank
                        
                      </a>
                  </li>

                 
              </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "laporan_akuntansi"){ echo "active"; } ?>" id="lap_akuntansi">
              <h4 class="side-head">Laporan Akuntansi</h4>
              <ul class="accordion-nav">
                  <li <?PHP if($view == "lap_buku_besar_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_buku_besar_c"><i class="icon-minus"></i> Laporan Buku Besar
                        
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_laba_rugi_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_laba_rugi_c"><i class="icon-minus"></i> Laporan Laba Rugi
                        
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_jurnal_umum_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_jurnal_umum_c"><i class="icon-minus"></i> Laporan Jurnal Akuntansi 
                        
                      </a>
                  </li>

                  <li <?PHP if($view == "lap_neraca_v"){ echo "class='active'"; } ?> >
                      <a href="<?=base_url();?>lap_neraca_c"><i class="icon-minus"></i> Laporan Neraca 
                        
                      </a>
                  </li>

                 

                 
              </ul>
          </div>

          <div class="tab-pane <?PHP if($master == "setting"){ echo "active"; } ?>" id="pengaturan">
            <h4 class="side-head"> Pengaturan </h4>
            <ul class="accordion-nav">
                <?php if($user->LEVEL == "ADMIN"){ ?>
                <li <?PHP if($view == "profil_usaha"){ echo "class='active'"; } ?> > <a href="<?=base_url();?>profil_perusahaan_c"><i class="icon-pencil"></i> Profil Perusahaan <span> Kelola profil perusahaan anda. </span> </a></li>
                <?PHP } ?>

                <?php if($this->master_model_m->cek_anak($id_user, 'Pengaturan Akun', $user->LEVEL)){ ?>
                <li <?PHP if($view == "pengaturan_akun"){ echo "class='active'"; } ?> > <a href="<?=base_url();?>pengaturan_akun_c"><i class="icon-user"></i> Pengaturan Akun <span> Mengatur detail akun anda </span></a></li>
                <?PHP } ?>

                <?php if($user->LEVEL == "ADMIN"){ ?>
                <li <?PHP if($view == "setting_laporan"){ echo "class='active'"; } ?> > <a href="<?=base_url();?>setting_laporan_c"><i class="icon-list-alt"></i> Pengaturan Laporan <span> Mengatur format laporan anda </span></a></li>
                <?PHP } ?>

                <?php if($this->master_model_m->cek_anak($id_user, 'User Management', $user->LEVEL)){ ?>
                <li <?PHP if($view == "user_management"){ echo "class='active'"; } ?> > <a href="<?=base_url();?>user_management_c"><i class="icon-group"></i> User Management <span> Pengelolaan user yang masuk ke aplikasi </span></a></li>
                <?PHP } ?> 

                <?php if($this->master_model_m->cek_anak($id_user, 'User Management', $user->LEVEL)){ ?>
                <li <?PHP if($view == "master_perusahaan"){ echo "class='active'"; } ?> > <a href="<?=base_url();?>master_perusahaan_c"><i class="icon-group"></i> Master Perusahaan <span> Pengelolaan perusahaan </span></a></li>
                <?PHP } ?>                
            </ul>
          </div>
			</div>
		</div>
	</div>
	<div class="main-wrapper">        
		<div class="container-fluid" style="margin-top: 50px;">
        <?PHP if($page == ""){ ?>
        <!-- LOG AKTIFITAS -->
        <div class="row-fluid">
            <div class="span12">
                <h3 class=" page-header"><i class="icon-time"></i> LOG AKTIFITAS unit <b><?=$user->NAMA_UNIT;?></b> </h3>
                <div class="control-group">
                    <label class="control-label" style="font-weight: bold; font-size: 13px;">Tampilkan berdasarkan tanggal :</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <input type="text" required="" name="tgl" id="log_tgl" value="">
                            <input type="submit" name="cari" onclick="get_log_by_tgl();" style="margin-top: 1px; height: 33px;" class="btn btn-warning" value="Cari">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="tab-widget">
                    <ul class="nav nav-tabs" id="myTab2">
                        <li class="active"><a href="#my-act"> AKTIFITAS SAYA</a></li>
                    </ul>
                    <div class="tab-content" style="overflow-y: auto; height: 500px;">
                        <div class="tab-pane active" id="my-act">
                            <div class="comment-items" id="data_log_saya">
                                <?PHP foreach ($dt_log_aktifitas_saya as $key => $row) { ?>
                                <div class="item-block clearfix">
                                    <div class="item-thumb pull-left">
                                        <ul>
                                            <li class="item-pic">
                                                <?PHP if($row->FOTO == "" || $row->FOTO== null){ ?>
                                                    <i class="icon-user" style="font-size: 40px;"></i>
                                                <?PHP } else { ?>
                                                    <img width="34" height="34" alt="User" src="<?=$base_url2;?>files/foto/<?=$row->FOTO;?>">
                                                <?PHP } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="item-intro pull-left">
                                        <b><?=$row->NAMA;?></b>
                                        <p style="font-size:13px;">
                                            <?=$row->DESKRIPSI;?>
                                        </p>
                                        <div class="item-meta">
                                            <ul>
                                                <li><i class="icon-time"></i> <?=$row->TGL;?>, <?=$row->JAM;?></li>
                                            </ul>
                                        </div>
                                    </div>                    
                                </div>
                                <?PHP } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?PHP } else { $this->load->view($page); } ?>
        </div>
	</div>
	<div class="copyright">
		<p>
         <?=$dt_setting->NAMA_APP;?> &copy; 2017
    </p>
	</div>
	<div class="scroll-top">
		<a href="#" class="tip-top" title="Go Top"><i class="icon-double-angle-up"></i></a>
	</div>
</div>



</body>
</html>

<script type="text/javascript">
    function sel_row() {
        var laporan = $('#laporan').val();
        if(laporan == "Laporan Buku Besar"){
            $('#buku_besar_btn').click();
        }

        if(laporan == "Laporan Laba Rugi"){
            $('#laba_rugi_btn').click();
        }

        if(laporan == "Laporan Jurnal Umum"){
            $('#ju_btn').click();
        }

        if(laporan == "Laporan Arus Kas"){
            $('#form_laporan').submit();
        }

        if(laporan == "Jurnal Bayar Kas Bank"){
            $('#form_laporan').submit();
        }

        if(laporan == "Jurnal Penyesuaian"){
            $('#jp_btn').click();
        }

        if(laporan == "Laporan Neraca"){
            $('#form_laporan').submit();
        }
    }

    function save_kolom_buku_besar() {

        var jml_centang = $('#form_buku_besar').find(':checkbox:checked').length;
        if(jml_centang == 0){
           $('#err_buku_besar').show();
        } else {
           $('#err_buku_besar').hide();
           $.ajax({
                type:"POST",
                url: '<?=base_url();?>beranda_c/simpan_kolom_buku_besar',
                data: $("#form_buku_besar").serialize(),
                dataType : 'json',
                success: function(res){
                    if(res == 1){
                        $('#form_laporan').submit();
                    }
                }
            }); 
        }
        
    }

    function save_kolom_labarugi() {
        var jml_centang = $('#form_labarugi').find(':checkbox:checked').length;
        if(jml_centang == 0){
           $('#err_laba_rugi').show();
        } else {
           $('#err_laba_rugi').hide();
               $.ajax({
                type:"POST",
                url: '<?=base_url();?>beranda_c/simpan_kolom_labarugi',
                data: $("#form_labarugi").serialize(),
                dataType : 'json',
                success: function(res){
                    if(res == 1){
                        $('#form_laporan').submit();
                    }
                }
            });
        }
    }

    function save_kolom_ju() {
        var jml_centang = $('#form_ju').find(':checkbox:checked').length;
        if(jml_centang == 0){
           $('#err_ju').show();
        } else {
           $('#err_ju').hide();
           $.ajax({
                type:"POST",
                url: '<?=base_url();?>beranda_c/simpan_kolom_ju',
                data: $("#form_ju").serialize(),
                dataType : 'json',
                success: function(res){
                    if(res == 1){
                        $('#form_laporan').submit();
                    }
                }
            });
        }      
    }

    function save_kolom_jp(){
        var jml_centang = $('#form_jp').find(':checkbox:checked').length;
        if(jml_centang == 0){
           $('#err_jp').show();
        } else {
            $('#err_jp').hide();
            $.ajax({
                type:"POST",
                url: '<?=base_url();?>beranda_c/simpan_kolom_jp',
                data: $("#form_jp").serialize(),
                dataType : 'json',
                success: function(res){
                    if(res == 1){
                        $('#form_laporan').submit();
                    }
                }
            });
        }  
    }

    function get_log_by_tgl(){
        $('#popup_load').show();
        var tgl = $('#log_tgl').val();
        $.ajax({
            type:"POST",
            url: '<?=base_url();?>beranda_c/get_log_by_tgl',
            data: {
                tgl:tgl,
            },
            dataType : 'json',
            success: function(res){
                var log_all = res['log_all'];
                var log_saya = res['log_saya'];
                var isi_all = "";
                var isi_saya = "";

                if(log_all.length == 0){
                    isi_all = '<div class="item-block clearfix">'+
                                    '<div class="item-intro pull-left">'+
                                        '<p>'+
                                            '<center style="font-size:18px;">TIDAK ADA AKTIFITAS UNTUK TANGGAL TERSEBUT</center>'+
                                        '</p>'+
                                    '</div>'+
                                '</div>';
                }

                if(log_saya.length == 0){
                    isi_saya = '<div class="item-block clearfix">'+
                                    '<div class="item-intro pull-left">'+
                                        '<p>'+
                                            '<center style="font-size:18px;">TIDAK ADA AKTIFITAS UNTUK TANGGAL TERSEBUT</center>'+
                                        '</p>'+
                                    '</div>'+
                                '</div>';
                }

                $.each(log_all, function(i, field){
                    var foto = "";
                    if(field.FOTO == "" || field.FOTO == null){ 
                        foto = '<i class="icon-user" style="font-size: 40px;"></i>';
                    } else { 
                        foto = '<img width="34" height="34" alt="User" src="<?=$base_url2;?>files/foto/'+field.FOTO+'">';
                    } 

                    isi_all += '<div class="item-block clearfix">'+
                                    '<div class="item-thumb pull-left">'+
                                        '<ul>'+
                                            '<li class="item-pic">'+
                                                foto+
                                            '</li>'+
                                        '</ul>'+
                                    '</div>'+
                                    '<div class="item-intro pull-left">'+
                                        '<b>'+field.NAMA+'</b>'+
                                        '<p style="font-size:13px;">'+
                                            field.DESKRIPSI+
                                        '</p>'+
                                        '<div class="item-meta">'+
                                            '<ul>'+
                                               ' <li><i class="icon-time"></i> '+field.TGL+', '+field.JAM+'</li>'+
                                            '</ul>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                });

                $('#data_log_all').html(isi_all);

                $.each(log_saya, function(i, field){
                    var foto = "";
                    if(field.FOTO == "" || field.FOTO == null){ 
                        foto = '<i class="icon-user" style="font-size: 40px;"></i>';
                    } else { 
                        foto = '<img width="34" height="34" alt="User" src="<?=$base_url2;?>files/foto/'+field.FOTO+'">';
                    } 

                    isi_saya += '<div class="item-block clearfix">'+
                                    '<div class="item-thumb pull-left">'+
                                        '<ul>'+
                                            '<li class="item-pic">'+
                                                foto+
                                            '</li>'+
                                        '</ul>'+
                                    '</div>'+
                                    '<div class="item-intro pull-left">'+
                                        '<b>'+field.NAMA+'</b>'+
                                        '<p style="font-size:13px;">'+
                                            field.DESKRIPSI+
                                        '</p>'+
                                        '<div class="item-meta">'+
                                            '<ul>'+
                                               ' <li><i class="icon-time"></i> '+field.TGL+', '+field.JAM+'</li>'+
                                            '</ul>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                });

                $('#data_log_saya').html(isi_saya);

                $('#popup_load').hide();
            }
        });
    }
</script>
