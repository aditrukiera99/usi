<!DOCTYPE HTML>
<?PHP
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
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
  cek_islunas();

  var id_pajak = $('#id_pajak_sel').val();
  hitung_pajak(id_pajak);

  var id_pel = $('#pelanggan_sel').val();
  get_pelanggan_det(id_pel);

});
<?PHP } ?>

<?PHP if($page == 'edit_transaksi_pembelian_v'){ ?>
$(document).ready(function() {
  cek_islunas();

  var id_pajak = $('#id_pajak_sel').val();
  hitung_pajak(id_pajak);

  var id_pel = $('#pelanggan_sel').val();
  get_supplier_detail(id_pel);

});
<?PHP } ?>

<?PHP if($page == ''){ ?>
$(document).ready(function() {
    // transaksi_grafik();
    // laba_rugi_grafik_harian();
    // laba_rugi_grafik_bulanan();

});
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
});
/**=========================
SPARKLINE MINI CHART
==============================**/
$(function () {
    $(".line-min-chart").sparkline([50, 10, 2, 3, 40, 5, 26, 10, 15, 20, 40, 60], {
        type: 'line',
        width: '80',
        height: '40',
        lineColor: '#2b2b2b',
        fillColor: '#e5e5e5',
        lineWidth: 2,
        highlightSpotColor: '#0e8e0e',
        spotRadius: 3,
        drawNormalOnTop: true,
        disableTooltips : true
    });
    $(".bar-min-chart").sparkline([50, 10, 2, 3, 40, 5, 26, 10, -15, 20, 40, 60], {
        type: 'bar',
        height: '40',
        barWidth: 4,
        barSpacing: 1,
        barColor: '#007f00',
        disableTooltips : true
    });
    $(".pie-min-chart").sparkline([3, 5, 2, 10, 8], {
        type: 'pie',
        width: '40',
        height: '40',
        disableTooltips : true
    });
    $(".tristate-min-chart").sparkline([1, 1, 0, 1, -1, -1, 1, -1, 0, 0, 1, 1], {
        type: 'tristate',
        height: '40',
        posBarColor: '#bf005f',
        negBarColor: '#ff7f00',
        zeroBarColor: '#545454',
        barWidth: 4,
        barSpacing: 1,
        disableTooltips : true
    });
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
<script type="text/javascript">
/*===============================================
FLOT BAR CHART
==================================================*/

    var data7_1 = [
        [1354586000000, 153],
        [1354587000000, 658],
        [1354588000000, 198],
        [1354589000000, 663],
        [1354590000000, 801],
        [1354591000000, 1080],
        [1354592000000, 353],
        [1354593000000, 749],
        [1354594000000, 523],
        [1354595000000, 258],
        [1354596000000, 688],
        [1354597000000, 364]
    ];
    var data7_2 = [
        [1354586000000, 53],
        [1354587000000, 65],
        [1354588000000, 98],
        [1354589000000, 83],
        [1354590000000, 80],
        [1354591000000, 108],
        [1354592000000, 120],
        [1354593000000, 74],
        [1354594000000, 23],
        [1354595000000, 79],
        [1354596000000, 88],
        [1354597000000, 36]
    ];
    $(function () {
        $.plot($("#visitors-chart #visitors-container"), [{
            data: data7_1,
            label: "Page View",
            lines: {
                fill: true
            }
        }, {
            data: data7_2,
            label: "Online User",
            points: {
                show: true
            },
            lines: {
                show: true
            },
            yaxis: 2
        }
        ],
        {
            series: {
                lines: {
                    show: true,
                    fill: false
                },
                points: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: "#ffffff",
                    symbol: "circle",
                    radius: 5,
                },
                shadowSize: 0,
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#f9f9f9",
                borderWidth: 1
            },
            colors: ["#b086c3", "#ea701b"],
            tooltip: true,
            tooltipOpts: {
                  shifts: { 
                      x: -100                     //10
                  },
                defaultTheme: false
            },
            xaxis: {
                mode: "time",
                timeformat: "%0m/%0d %0H:%0M"
            },
            yaxes: [{
                /* First y axis */
            }, {
                /* Second y axis */
                position: "right" /* left or right */
            }]
        }
        );
    });
</script>
<script type="text/javascript">
/*===============================================
FLOT PIE CHART
==================================================*/

    $(function () {
        var data = [{
            label: "Page View",
            data: 70
        }, {
            label: "Online User",
            data: 30
        }];
        var options = {
            series: {
                pie: {
                    show: true,
                    innerRadius: 0.5,
            show: true
                }
            },
            legend: {
                show: true
            },
            grid: {
                hoverable: true,
                clickable: true
            },
             colors: ["#b086c3", "#ea701b"],
            tooltip: true,
            tooltipOpts: {
                shifts: { 
                      x: -100                     //10
                  },
                defaultTheme: false
            }
        };
        $.plot($("#pie-chart-donut #pie-donutContainer"), data, options);
    });
</script>

<script type="text/javascript">
    

function transaksi_grafik(){
        var chart = new CanvasJS.Chart("chartContainer2",
        {
            animationEnabled: true,
            axisX:{

                gridColor: "Silver",
                tickColor: "silver",
                valueFormatString: "DD/MMM"

            },                        
                        toolTip:{
                          shared:true
                        },
            theme: "theme2",
            axisY: {
                gridColor: "Silver",
                tickColor: "silver"
            },
            legend:{
                verticalAlign: "center",
                horizontalAlign: "right"
            },
            data: [
            {        
                type: "line",
                showInLegend: true,
                lineThickness: 2,
                name: "Penjualan",
                markerType: "square",
                color: "#F08080",
                dataPoints: [
                  { label: '<?=$penjualan_grafik_harian_5->TGL;?>', y: <?PHP echo $penjualan_grafik_harian_5->TOTAL; ?> },
                  { label: '<?=$penjualan_grafik_harian_4->TGL;?>', y: <?PHP echo $penjualan_grafik_harian_4->TOTAL; ?> },
                  { label: '<?=$penjualan_grafik_harian_3->TGL;?>', y: <?PHP echo $penjualan_grafik_harian_3->TOTAL; ?> },
                  { label: '<?=$penjualan_grafik_harian_2->TGL;?>', y: <?PHP echo $penjualan_grafik_harian_2->TOTAL; ?> },
                  { label: '<?=$penjualan_grafik_harian_1->TGL;?>', y: <?PHP echo $penjualan_grafik_harian_1->TOTAL; ?> }
                ]
            },
            {        
                type: "line",
                showInLegend: true,
                name: "Pembelian / Cost",
                color: "#20B2AA",
                lineThickness: 2,

                dataPoints: [
                  { label: '<?=$pembelian_grafik_harian_5->TGL;?>', y: <?PHP echo $pembelian_grafik_harian_5->TOTAL;?> },
                  { label: '<?=$pembelian_grafik_harian_4->TGL;?>', y: <?PHP echo $pembelian_grafik_harian_4->TOTAL;?> },
                  { label: '<?=$pembelian_grafik_harian_3->TGL;?>', y: <?PHP echo $pembelian_grafik_harian_3->TOTAL;?> },
                  { label: '<?=$pembelian_grafik_harian_2->TGL;?>', y: <?PHP echo $pembelian_grafik_harian_2->TOTAL;?> },
                  { label: '<?=$pembelian_grafik_harian_1->TGL;?>', y: <?PHP echo $pembelian_grafik_harian_1->TOTAL;?> }
                ]
            }

            
            ],
          legend:{
            cursor:"pointer",
            itemclick:function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
              }
              else{
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
        });

chart.render();
}

function laba_rugi_grafik_harian(){
        var chart = new CanvasJS.Chart("chartContainer_labarugi_harian", {
            data: [{
                type: "line",
                dataPoints: [
                  { label: '<?=$laba_rugi_harian_5->TGL;?>', y: <?PHP echo $laba_rugi_harian_5->TOTAL;?> },
                  { label: '<?=$laba_rugi_harian_4->TGL;?>', y: <?PHP echo $laba_rugi_harian_4->TOTAL;?> },
                  { label: '<?=$laba_rugi_harian_3->TGL;?>', y: <?PHP echo $laba_rugi_harian_3->TOTAL;?> },
                  { label: '<?=$laba_rugi_harian_2->TGL;?>', y: <?PHP echo $laba_rugi_harian_2->TOTAL;?> },
                  { label: '<?=$laba_rugi_harian_1->TGL;?>', y: <?PHP echo $laba_rugi_harian_1->TOTAL;?> }
                ]
            }]
        });
        chart.render();
}

function laba_rugi_grafik_bulanan(){
        var chart = new CanvasJS.Chart("chartContainer_labarugi_bulanan", {
            data: [{
                type: "line",
                dataPoints: [
                  { label: '<?=$laba_rugi_bulanan_5->TGL;?>', y: <?PHP echo $laba_rugi_bulanan_5->TOTAL;?> },
                  { label: '<?=$laba_rugi_bulanan_4->TGL;?>', y: <?PHP echo $laba_rugi_bulanan_4->TOTAL;?> },
                  { label: '<?=$laba_rugi_bulanan_3->TGL;?>', y: <?PHP echo $laba_rugi_bulanan_3->TOTAL;?> },
                  { label: '<?=$laba_rugi_bulanan_2->TGL;?>', y: <?PHP echo $laba_rugi_bulanan_2->TOTAL;?> },
                  { label: '<?=$laba_rugi_bulanan_1->TGL;?>', y: <?PHP echo $laba_rugi_bulanan_1->TOTAL;?> }
                ]
            }]
        });
        chart.render();
}

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
                    <a class="brand" href="<?=base_url();?>beranda_c"><img src="<?=$base_url2;?>material/images/logo_akun.png" width="125" height="50" alt="Logo Akun" style="margin-left: 14px; margin-top: 10px;"></a>
                <div class="nav-collapse desktop-only">
                    <ul class="nav">

                        
                    </ul>
                </div>
                <div class="btn-toolbar pull-right notification-nav">
                    <div class="btn-group">
                        <div class="dropdown">
                            <a href="<?=base_url();?>beranda_c/sign_out_tambora" class="btn btn-notification"><i class="icon-lock"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="leftbar leftbar-close clearfix" style="margin-top: 50px; position:fixed; background:#c4dff6;">
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
                    <li class="admin-username"> <?=$user->NAMA;?> </li>
                    <?PHP if($user->LEVEL == 'ADMIN'){ ?>
                    <li class="admin-username" style="color:#1B96FE;"> PT. TAMBORA </li>
                    <?PHP } else { ?>
                    <li class="admin-username" style="color:#1B96FE;"> <font style="color:red;">PT. TAMBORA</font></li>
                    <?PHP } ?>

                    <li><a href="<?=base_url();?>pengaturan_akun_c"> Edit Profil </a><a href="<?=base_url();?>beranda_c/sign_out_tambora"><i class="icon-lock"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="left-nav clearfix" style="background:#c4dff6;">
            <div class="left-primary-nav">
                <ul id="myTab">
                    <li><a href="#main" onclick="window.location='<?=base_url();?>beranda_c';"  class="icon-desktop" title="Dashboard"></a></li>
                </ul>
            </div>
            <div class="responsive-leftbar">
                <i class="icon-list"></i>
            </div>
            <div class="left-secondary-nav tab-content" style="background:#c4dff6;">
                <div class="tab-pane echo active" id="main">
                    <h4 class="side-head">Dashboard</h4>                                        
                    <ul class="metro-sidenav clearfix">
                        <li><a class="bondi-blue" href="<?=base_url();?>beranda_c"><i class="icon-laptop"></i><span>Kelola App</span></a></li>
                        <li><a class="magenta" href="<?=base_url();?>pengaturan_akun_c"><i class="icon-pencil"></i><span>Profil Saya</span></a></li>
                        <li><a class="green" style="width: 180px;" href="<?=base_url();?>manage_klien_c"><i class="icon-user"></i><span> DIREKTUR & KLIEN</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">        
        <div class="container-fluid" style="margin-top: 50px;">
        <?PHP if($page == ""){ ?>

        <?PHP if($dt_setting->AKTIF == 0){ ?>
        <div class="alert alert-error">
            <i class="icon-minus-sign"></i><strong>MOHON MAAF!</strong> APLIKASI INI TELAH SHUTDOWN
        </div>
        <?PHP } ?>

        <!-- LAPORAN -->
        <div class="row-fluid">
            <div class="span12">
                <h3 class=" page-header"> <i class="icon-cogs"></i> ATUR APLIKASI 
                    <?PHP if($dt_setting->AKTIF == 1){ ?>
                    <button type="button" class="btn btn-danger" onclick="matikan_aplikasi();" style="float: right;"> 
                        <i class="icon-warning-sign" style="color: #FFF; font-size: 16px;"></i> MATIKAN APLIKASI
                    </button>
                    <?PHP } else { ?>
                    <button type="button" class="btn btn-success" onclick="nyalakan_aplikasi();" style="float: right;"> 
                        <i class="icon-unlock" style="color: #FFF; font-size: 16px;"></i> AKTIFKAN APLIKASI
                    </button>
                    <?PHP } ?>
                </h3>
                
            </div>
        </div>

        <!-- LAPORAN -->
        <div class="row-fluid">
            <div class="span12">
                <div class="content-widgets light-gray">
                    <form id="form_laporan" method="post" action="<?=base_url();?>beranda_c">
                    <div class="widget-container">
                        <div class="control-group">
                            <label class="control-label"> <b> Nama Aplikasi </b> </label>
                            <div class="controls">
                                <input required type="text" class="span6" value="<?=$dt_setting->NAMA_APP;?>" name="nama_app">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> <b> Batas unit tiap perusahaan</b> </label>
                            <div class="controls">
                                <input required type="text" class="span2" value="<?=$dt_setting->BATAS_UNIT;?>" name="batas_unit" onkeyup="FormatCurrency(this);">
                            </div>
                        </div>

                        <div class="form-actions">
                            <center>
                                <input type="submit" name="simpan_pengaturan" class="btn btn-info" style="width: 50%;" value="SIMPAN PENGATURAN" />                     
                            </center>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- DAFTAR UNIT -->
        <div class="row-fluid">
            <div class="span12">
                <h3 class=" page-header"> <i class="icon-sitemap"></i> DAFTAR UNIT (<?=count($dt_unit);?> of <?=$dt_setting->BATAS_UNIT;?>) </h3>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="content-widgets light-gray">
                    <div class="widget-container">              
                        <table class="responsive table table-striped table-bordered" id="data-table">
                            <thead>
                            <tr>
                                <th style="text-align:center;">
                                     No
                                </th>
                                <th style="text-align:center;">
                                     Nama Unit
                                </th>
                                <th style="text-align:center;">
                                     Manager
                                </th>
                                <th style="text-align:center;">
                                     Jumlah User
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?PHP foreach ($dt_unit as $key => $row){ ?>
                            <tr>
                                <td style="text-align:center;"><?=$key+1;?></td>   
                                <td><?=$row->NAMA_UNIT;?></td>
                                <td>
                                    <?PHP 
                                        $dt_manager = $this->model->get_data_manager_unit($row->ID);
                                        if(count($dt_manager) == 0){
                                            echo "Tidak ada manager";
                                        } else {
                                            foreach ($dt_manager as $key => $row_manager) {
                                               echo $row_manager->NAMA;
                                               echo "<br>";
                                            }
                                        }
                                    ?>
                                </td>
                                <td style="text-align:center;">
                                    <?PHP 
                                        $dt_user_unit = $this->model->get_data_user_unit($row->ID);
                                        echo count($dt_user_unit)." USER";
                                    ?>
                                </td>
                            </tr>
                            <?PHP } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- LOG AKTIFITAS -->
        <div class="row-fluid">
            <div class="span12">
                <h3 class=" page-header"> <i class="icon-time"></i> LOG AKTIFITAS </b> </h3>
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
                        <li class="active"><a href="#all-act"> SEMUA AKTIFITAS</a></li>
                        <li class=""><a href="#my-act"> AKTIFITAS SAYA</a></li>
                    </ul>
                    <div class="tab-content" style="overflow-y: auto; height: 500px;">
                        <div class="tab-pane active" id="all-act">
                            <div class="comment-items" id="data_log_all">
                                <?PHP foreach ($dt_log_aktifitas as $key => $row) { ?>
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

                        <div class="tab-pane" id="my-act">
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

        <!-- MODAL UBAH UNIT -->
        <button id="ubah_unit_btn" data-toggle="modal" data-target="#ubah_unit_modal" class="btn btn-warning" style="display: none;">a</button>
        <div id="ubah_unit_modal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">UBAH UNIT</h4>
              </div>
              <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" style="font-size: 15px;">
                            <div class="control-group" style="margin-left: 10px;">
                                <label class="control-label"> <b style="font-size: 14px;"> NAMA UNIT </b> </label>
                                <div class="controls">
                                    <input type="text" class="span12" value="" name="nama_unit_ed" id="nama_unit_ed">
                                    <input type="hidden" class="span12" value="" name="id_unit_ed" id="id_unit_ed">
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="ubah_unit" value="SIMPAN" />
                <button type="button" id="tutup_modal_appr" class="btn btn-default" data-dismiss="modal">TUTUP</button>
              </div>
            </div>
          </div>
        </div>

        <!-- MODAL MATIKAN APLIKASI 1 -->
        <button id="app_btn_1" data-toggle="modal" data-target="#matikan_app1" class="btn btn-warning" style="display: none;">a</button>
        <div id="matikan_app1" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">VERIFIKASI IDENTITAS</h4>
              </div>
              <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" style="font-size: 15px;">
                            <div class="control-group" style="margin-left: 10px;">
                                <label class="control-label"> <b style="font-size: 14px;"> MASUKKAN NAMA ANDA </b> </label>
                                <div class="controls">
                                    <input type="text" class="span12" value="" name="nama_anda" id="nama_anda">
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <input type="button" onclick="tahap2();" class="btn btn-success" name="simpan_unit" value="VERIFIKASI" />
                <button type="button" id="tutup_modal_tahap1" class="btn btn-default" data-dismiss="modal">TUTUP</button>
              </div>
            </div>
          </div>
        </div>

        <!-- MODAL MATIKAN APLIKASI 2 -->
        <button id="app_btn_2" data-toggle="modal" data-target="#matikan_app2" class="btn btn-warning" style="display: none;">a</button>
        <div id="matikan_app2" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">KONFIRMASI</h4>
              </div>
              <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" style="font-size: 17px;">
                            <p>Apakah anda yakin untuk mematikan aplikasi ini?</p>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <input type="button" onclick="tahap3();" class="btn btn-success" name="simpan_unit" value="IYA, SAYA YAKIN" />
                <button type="button" id="tutup_modal_tahap2" class="btn btn-default" data-dismiss="modal">BATAL</button>
              </div>
            </div>
          </div>
        </div>

        <!-- MODAL MATIKAN APLIKASI 3 -->
        <button id="app_btn_3" data-toggle="modal" data-target="#matikan_app3" class="btn btn-warning" style="display: none;">a</button>
        <div id="matikan_app3" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">KONFIRMASI LAGI</h4>
              </div>
              <form action="<?=base_url();?>beranda_c" method="POST">
              <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" style="font-size: 17px;">
                            <p>Apakah anda benar benar yakin untuk mematikan aplikasi ini? <br> Jika tidak mohon batalkan, jika iya, tekan tombol OK</p>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="matikan_aplikasi" value="OK" />
                <button type="button" id="tutup_modal_tahap3" class="btn btn-default" data-dismiss="modal">BATAL</button>
              </div>
            </form>
            </div>
          </div>
        </div>


        <!-- MODAL NYALAKAN APLIKASI 1 -->
        <button id="n_app_btn_1" data-toggle="modal" data-target="#nyalakan_app1" class="btn btn-warning" style="display: none;">a</button>
        <div id="nyalakan_app1" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">VERIFIKASI IDENTITAS</h4>
              </div>
              <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" style="font-size: 15px;">
                            <div class="control-group" style="margin-left: 10px;">
                                <label class="control-label"> <b style="font-size: 14px;"> MASUKKAN NAMA ANDA </b> </label>
                                <div class="controls">
                                    <input type="text" class="span12" value="" name="n_nama_anda" id="n_nama_anda">
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <input type="button" onclick="nyala_tahap2();" class="btn btn-success" name="simpan_unit" value="VERIFIKASI" />
                <button type="button" id="n_tutup_modal_tahap1" class="btn btn-default" data-dismiss="modal">TUTUP</button>
              </div>
            </div>
          </div>
        </div>

        <!-- MODAL MATIKAN APLIKASI 2 -->
        <button id="n_app_btn_2" data-toggle="modal" data-target="#nyalakan_app2" class="btn btn-warning" style="display: none;">a</button>
        <div id="nyalakan_app2" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">KONFIRMASI</h4>
              </div>
              <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" style="font-size: 17px;">
                            <p>Apakah anda yakin untuk mengaktifkan kembali aplikasi ini?</p>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <input type="button" onclick="nyala_tahap3();" class="btn btn-success" name="simpan_unit" value="IYA, SAYA YAKIN" />
                <button type="button" id="n_tutup_modal_tahap2" class="btn btn-default" data-dismiss="modal">BATAL</button>
              </div>
            </div>
          </div>
        </div>

        <!-- MODAL MATIKAN APLIKASI 3 -->
        <button id="n_app_btn_3" data-toggle="modal" data-target="#nyalakan_app3" class="btn btn-warning" style="display: none;">a</button>
        <div id="nyalakan_app3" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">KONFIRMASI LAGI</h4>
              </div>
              <form action="<?=base_url();?>beranda_c" method="POST">
              <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" style="font-size: 17px;">
                            <p>Apakah anda benar benar yakin untuk mengaktifkan kembali aplikasi ini? </p>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="aktifkan_aplikasi" value="OK" />
                <button type="button" id="n_tutup_modal_tahap3" class="btn btn-default" data-dismiss="modal">BATAL</button>
              </div>
            </form>
            </div>
          </div>
        </div>

        <?PHP } else { $this->load->view($page); } ?>
        </div>
    </div>
    <div class="copyright">
        <p>
             &copy; 2017
        </p>
    </div>
    <div class="scroll-top">
        <a href="#" class="tip-top" title="Go Top"><i class="icon-double-angle-up"></i></a>
    </div>
</div>



</body>
</html>

<script type="text/javascript">

    function matikan_aplikasi(){
        $('#nama_anda').val('');
        $('#app_btn_1').click();
    }

    function tahap2(){
        var nama = $('#nama_anda').val();
        if(nama == "ANDI KURNIAWAN"){
            $('#tutup_modal_tahap1').click();
            $('#app_btn_2').click();
        } else {
            alert("ANDA SALAH MEMASUKKAN NAMA !! PERMINTAAN DITOLAK.");
            $('#tutup_modal_tahap1').click();
        }
        
    }

    function tahap3(){
        $('#tutup_modal_tahap2').click();
        $('#app_btn_3').click();
    }

    function nyalakan_aplikasi(){
        $('#nama_anda_nyala').val('');
        $('#n_app_btn_1').click();
    }

    function nyala_tahap2(){
        var nama = $('#n_nama_anda').val();
        if(nama == "ANDI KURNIAWAN"){
            $('#n_tutup_modal_tahap1').click();
            $('#n_app_btn_2').click();
        } else {
            alert("ANDA SALAH MEMASUKKAN NAMA !! PERMINTAAN DITOLAK.");
            $('#n_tutup_modal_tahap1').click();
        }
        
    }

    function nyala_tahap3(){
        $('#n_tutup_modal_tahap2').click();
        $('#n_app_btn_3').click();
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
