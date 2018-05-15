<!DOCTYPE HTML>
<?PHP
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$aktif = $this->master_model_m->get_aktif();
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

.unit_selected{
    border: 3px solid #00a4e4;
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

                <div class="nav-collapse desktop-only">
                    <ul class="nav">
                        <li class="dropdown"><a href="<?=base_url();?>beranda_c">Dashboard </a></li>
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
                    <li class="admin-username" style="color:#1B96FE;"> DIREKTUR </li>
                    <?PHP } else { ?>
                    <li class="admin-username" style="color:#1B96FE;"> <?=$user->NAMA_UNIT;?>  | <font style="color:red;"><?=$user->LEVEL;?></font></li>
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
        <div class="left-nav clearfix" style="background:#c4dff6;">
            <div class="left-primary-nav">
                <ul id="myTab">
                    <li <?PHP if($master == ""){ echo "class='active'"; } ?> ><a href="#main" onclick="window.location='<?=base_url();?>beranda_c';"  class="icon-desktop" title="Dashboard"></a></li>
                </ul>
            </div>
            <div class="responsive-leftbar">
                <i class="icon-list"></i>
            </div>
            <div class="left-secondary-nav tab-content" style="background:#c4dff6;">
                <div class="tab-pane active" id="main">
                    <h4 class="side-head">Dashboard</h4>
                                        
                    <ul class="metro-sidenav clearfix">
                        <li><a class="blue" href="<?=base_url();?>beranda_c"><i class="icon-home"></i><span> Dashboard </span></a></li>
                        <li><a class=" magenta" href="<?=base_url();?>pengaturan_akun_c"><i class="icon-pencil"></i><span>Profil Saya</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">        
        <div class="container-fluid" style="margin-top: 50px;">
        <?PHP if($page == ""){ ?>

        <!-- LAPORAN -->
        <div class="row-fluid">
            <div class="span12">
                <h3 class=" page-header"> <i class="icon-file-alt"></i> LAPORAN UMUM </h3>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="switch-board gray">
                    <center><h4>Pilih divisi untuk menampilkan laporan</h4></center>
                    <br>
                    <ul class="clearfix switch-item">
                        <?PHP foreach ($dt_unit as $key => $row) { ?>
                        <li style="width: 200px; height: 120px; padding: 10px; vertical-align: top; margin-top: 10px;">
                            <a style="width: 200px; height: 60px;  padding: 10px !important;" href="javascript:;" onclick="pilih_unit('<?=$row->ID;?>', '<?=$row->NAMA_UNIT;?>', this, '<?=$row->URL;?>');" class="white unit_box">
                                <center>
                                    <b>DIVISI</b>
                                    <span style="width: 180px; color: #666 !important; font-size: 13px !important; margin-top: 8px; font-weight: bold;"><?=$row->NAMA_UNIT;?></span>
                                </center>                          
                            </a>
                        </li>
                        <?PHP } ?>
                    </ul>
                    <br>
                </div>
            </div>
        </div>

        <!-- DAFTAR UNIT -->
        <div class="row-fluid">
            <div class="span12">
                <h3 class=" page-header"> <i class="icon-sitemap"></i> DAFTAR DIVISI </h3>
                <?PHP if(count($dt_unit) < $dt_setting->BATAS_UNIT){?>
                <span>
                    <button type="button" data-toggle="modal" data-target="#add_unit_modal" class="btn btn-inverse"> 
                        <i class="icon-plus" style="color: #FFF; font-size: 16px;"></i> Tambah Data Divisi 
                    </button>
                </span>
                <br><br>
                <?PHP } else { ?>
                <div class="alert alert-error">
                    <i class="icon-minus-sign"></i><strong>Maaf!</strong> Anda hanya dapat mempunyai <b><?=$dt_setting->BATAS_UNIT;?> UNIT.</b>
                    Hubungi developer untuk menambah batasan unit.
                </div>
                <?PHP }?>
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
                                     Manage
                                </th>
                                <th style="text-align:center;">
                                     Nama Unit
                                </th>
                                <th style="text-align:center;">
                                     Manager
                                </th>
                                <th style="text-align:center;">
                                     Login Terakhir Manager
                                </th>
                                <th style="text-align:center;">
                                     Jumlah User
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?PHP foreach ($dt_unit as $key => $row){ ?>
                            <tr>
                                <td style="text-align:center;">                                                           
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"> Aksi <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" style="background-color:rgba(255, 255, 255, 1); min-width: 120px;">
                                            <li>
                                            <a href="<?=base_url();?>beranda_c/kelola_manager/<?=$row->ID;?>">KELOLA MANAGER</a>
                                            </li>

                                            <li>
                                            <a onclick="ubah_data_unit('<?=$row->ID;?>', '<?=$row->NAMA_UNIT;?>');" href="javascript:;">UBAH</a>
                                            </li>

                                            <li>
                                            <a onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" href="javascript:;">HAPUS</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td><?=$row->NAMA_UNIT;?></td>
                                <td>
                                    <?PHP 
                                        $dt_manager = $this->model->get_data_manager_unit($row->ID);
                                        $id_manager = "";
                                        if(count($dt_manager) == 0){
                                            echo "Tidak ada manager";
                                        } else {
                                            foreach ($dt_manager as $key => $row_manager) {
                                               $id_manager = $row_manager->ID;
                                               echo $row_manager->NAMA;
                                               echo "<br>";
                                            }
                                        }
                                    ?>
                                </td>
                                <td style="text-align:center;">
                                    <?PHP 
                                    $get_last_login = $this->master_model_m->get_last_login($id_manager);
                                    if($get_last_login){
                                        echo $get_last_login->TGL."<br>".$get_last_login->JAM;
                                    } else {
                                        echo "<b style='color:red;'>Belum pernah login</b>";
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
                <h3 class=" page-header"> <i class="icon-time"></i> LOG AKTIFITAS </h3>
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

        <!-- Modal Buku Besar -->
        <button id="buku_besar_btn" data-toggle="modal" data-target="#buku_besar_row" class="btn btn-warning" style="display: none;">a</button>
        <div id="buku_besar_row" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Pilih Kolom yang ditampilkan</h4>
              </div>
              <form id="form_buku_besar">
              <div class="modal-body">

                    <div class="alert alert-error" id="err_buku_besar" style="display: none;">
                        <i class="icon-minus-sign"></i><strong>Maaf!</strong> Pilih minimal 1 kolom untuk ditampilkan
                    </div>

                    <div class="row-fluid">
                        <div class="span3">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_buku_besar[]" checked value="tanggal"> Tanggal
                            </div>
                        </div>

                        <div class="span3">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_buku_besar[]" checked value="uraian"> Uraian
                            </div> 
                        </div> 

                        <div class="span3">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_buku_besar[]" checked value="nomor_bukti"> Nomor Bukti
                            </div> 
                        </div> 

                        <div class="span3">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_buku_besar[]" checked value="debet"> Debet
                            </div> 
                        </div> 
                    </div> 

                    <div class="row-fluid">
                        <div class="span3">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_buku_besar[]" checked value="kredit"> Kredit
                            </div> 
                        </div>
                    </div>
              </div>
              </form>
              <div class="modal-footer">
                <button type="button" onclick="save_kolom_buku_besar();" class="btn btn-success">Cetak</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Laba Rugi -->
        <button id="laba_rugi_btn" data-toggle="modal" data-target="#labarugi_row" class="btn btn-warning" style="display: none;">a</button>
        <div id="labarugi_row" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Pilih Kolom yang ditampilkan</h4>
              </div>
              <form id="form_labarugi">
              <div class="modal-body">
                    <div class="alert alert-error" id="err_laba_rugi" style="display: none;">
                        <i class="icon-minus-sign"></i><strong>Maaf!</strong> Pilih minimal 1 kolom untuk ditampilkan
                    </div>
                    <div class="row-fluid">
                        <div class="span3">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_laba_rugi[]" checked value="kode_akun"> Kode Akun
                            </div>
                        </div>

                        <div class="span3">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_laba_rugi[]" checked value="nama_akun"> Nama Akun
                            </div> 
                        </div> 

                        <div class="span3">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_laba_rugi[]" checked value="total_item"> Total Item
                            </div> 
                        </div> 

                        <div class="span3">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_laba_rugi[]" checked value="sub_total"> Sub Total
                            </div> 
                        </div> 
                    </div> 
              </div>
              </form>
              <div class="modal-footer">
                <button type="button" onclick="save_kolom_labarugi();" class="btn btn-success">Cetak</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Jurnal Umum -->
        <button id="ju_btn" data-toggle="modal" data-target="#ju_row" class="btn btn-warning" style="display: none;">a</button>
        <div id="ju_row" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Pilih Kolom yang ditampilkan</h4>
              </div>
              <form id="form_ju">
              <div class="modal-body">
                    <div class="alert alert-error" id="err_ju" style="display: none;">
                        <i class="icon-minus-sign"></i><strong>Maaf!</strong> Pilih minimal 1 kolom untuk ditampilkan
                    </div>

                    <div class="row-fluid">
                        <div class="span4">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_ju[]" checked value="kode_akun"> Kode Akun
                            </div>
                        </div>

                        <div class="span4">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_ju[]" checked value="debet"> Debet
                            </div> 
                        </div> 

                        <div class="span4">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_ju[]" checked value="kredit"> Kredit
                            </div> 
                        </div> 
                    </div> 
              </div>
              </form>
              <div class="modal-footer">
                <button type="button" onclick="save_kolom_ju();" class="btn btn-success">Cetak</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Jurnal Penyesuaian -->
        <button id="jp_btn" data-toggle="modal" data-target="#jp_row" class="btn btn-warning" style="display: none;">a</button>
        <div id="jp_row" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Pilih Kolom yang ditampilkan</h4>
              </div>
              <form id="form_jp">
              <div class="modal-body">
                    <div class="alert alert-error" id="err_jp" style="display: none;">
                        <i class="icon-minus-sign"></i><strong>Maaf!</strong> Pilih minimal 1 kolom untuk ditampilkan
                    </div>

                    <div class="row-fluid">
                        <div class="span4">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_jp[]" checked value="kode_akun"> Kode Akun
                            </div>
                        </div>

                        <div class="span4">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_jp[]" checked value="debet"> Debet
                            </div> 
                        </div> 

                        <div class="span4">
                            <div class="checkbox checkbox-primary" style="font-size:14px; margin-bottom:10px;">
                              <input class="ck_kolom" type="checkbox" name="kolom_jp[]" checked value="kredit"> Kredit
                            </div> 
                        </div> 
                    </div> 
              </div>
              </form>
              <div class="modal-footer">
                <button type="button" onclick="save_kolom_jp();" class="btn btn-success">Cetak</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
              <form method="post" action="<?=base_url();?>beranda_c">
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
              </form>
            </div>
          </div>
        </div>

        <!-- MODAL ADD UNIT -->
        <div id="add_unit_modal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">TAMBAH UNIT</h4>
              </div>
              <form method="post" action="<?=base_url();?>beranda_c">
              <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" style="font-size: 15px;">
                            <div class="control-group" style="margin-left: 10px;">
                                <label class="control-label"> <b style="font-size: 14px;"> NAMA UNIT </b> </label>
                                <div class="controls">
                                    <input type="text" class="span12" value="" name="nama_unit_add" id="nama_unit_add">
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="simpan_unit" value="SIMPAN" />
                <button type="button" id="tutup_modal_appr" class="btn btn-default" data-dismiss="modal">TUTUP</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- MODAL LAPORAN -->
        <button id="modal_lap_btn" data-toggle="modal" data-target="#laporan_modal" class="btn btn-warning" style="display: none;">a</button>
        <div id="laporan_modal" class="modal fade" role="dialog" style="width: 75%;left: 30%; display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tampilkan Laporan</h4>
              </div>
              <div class="modal-body" style="height: 350px;">
              <!-- LAPORAN -->
               <div class="row-fluid">
                    <div class="span12">
                        <div class="content-widgets light-gray">
                            <form id="form_laporan" method="post" action="<?=base_url();?>beranda_c" target="_blank">
                            <div class="widget-container">
                                <div class="row-fluid">
                                    <div class="span4">
                                        <div class="control-group">
                                            <label class="control-label"> <b style="font-size: 14px;"> Divisi </b> </label>
                                            <div class="controls">
                                                <input type="text" id="unit_txt" name="unit_txt" value="<?=$user->NAMA_UNIT;?>" readonly style="background:#FFF; width: 100%;">
                                                <input type="hidden" id="unit" name="unit" value="<?=$user->UNIT;?>" readonly style="background:#FFF;">
                                                <input type="hidden" id="filter" name="filter" value="Bulanan">
                                                <input type="hidden" id="tipe_laporan" name="tipe_laporan" value="Rinci">
                                                <input type="hidden" id="url_laporan" name="url_laporan" value="http://cmjtserver.com/apotekmargahusada1/">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label"> <b style="font-size: 14px;"> Pilih Laporan </b> </label>
                                            <div class="controls">
                                                <select  required  class="chzn-select" tabindex="2"  name="laporan" id="laporan">
                                                    <option value="lap_pembelian_c"> Laporan Pembelian </option>     
                                                    <option value="lap_summary_pembelian_c"> Laporan Summary Pembelian </option>     
                                                    <option value="lap_detail_pembelian_c"> Laporan Detail Pembelian </option>     
                                                    <option value="lap_pembelian_produk_supp_c"> Laporan Pembelian Produk Detail Supplier </option>     
                                                    <option value="lap_pembelian_supp_produk_c"> Laporan Pembelian Supplier Detail Produk </option>     
                                                    <option value="lap_history_harga_c"> History Harga Pembelian </option>     
                                                    <option value="lap_sum_um_beli_c"> Summary Uang Muka Pembelian </option>     
                                                    <option value="lap_sum_po_c"> Summary Order Pembelian (PO) </option>     
                                                    <option value="lap_detail_po_c"> Laporan Detail Order Pembelian (PO) </option>     
                                                    <option value="lap_po_outstanding_c"> PO Outstanding </option>     
                                                    <option value="lap_hutang_jatuh_tempo_c"> Hutang Jatuh Tempo </option>     
                                                    <option value="lap_sum_hutang_dagang_c"> Summary Hutang Dagang </option>     
                                                    <option value="lap_kartu_hutang_c"> Kartu Hutang </option>     
                                                    <option value="lap_sisa_hutang_dagang_c"> Sisa Hutang Dagang </option>     
                                                    <option value="lap_umur_hutang_c"> Laporan Umur hutang </option>     
                                                    <option value="lap_daftar_supplier_c"> Daftar Supplier </option>     
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label"> <b style="font-size: 14px;"> Bulan </b> </label>
                                            <div class="controls">
                                                <select  required  class="chzn-select" tabindex="2" name="bulan">
                                                    <option <?PHP if(date('m') == '01' ){ echo "selected"; } ?> value="01"> Januari </option>
                                                    <option <?PHP if(date('m') == '02' ){ echo "selected"; } ?> value="02"> Februari </option>
                                                    <option <?PHP if(date('m') == '03' ){ echo "selected"; } ?> value="03"> Maret </option>
                                                    <option <?PHP if(date('m') == '04' ){ echo "selected"; } ?> value="04"> April </option>
                                                    <option <?PHP if(date('m') == '05' ){ echo "selected"; } ?> value="05"> Mei </option>
                                                    <option <?PHP if(date('m') == '06' ){ echo "selected"; } ?> value="06"> Juni </option>
                                                    <option <?PHP if(date('m') == '07' ){ echo "selected"; } ?> value="07"> Juli </option>
                                                    <option <?PHP if(date('m') == '08' ){ echo "selected"; } ?> value="08"> Agustus </option>
                                                    <option <?PHP if(date('m') == '09' ){ echo "selected"; } ?> value="09"> September </option>
                                                    <option <?PHP if(date('m') == '10' ){ echo "selected"; } ?> value="10"> Oktober </option>
                                                    <option <?PHP if(date('m') == '11' ){ echo "selected"; } ?> value="11"> November </option>
                                                    <option <?PHP if(date('m') == '12' ){ echo "selected"; } ?> value="12"> Desember </option>            
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span2">
                                        <div class="control-group">
                                            <label class="control-label"> <b style="font-size: 14px;"> Tahun </b> </label>
                                            <div class="controls">
                                                <select  required  class="chzn-select" tabindex="2" name="tahun">
                                                    <option <?PHP if(date('Y') == '2016' ){ echo "selected"; } ?> value="2016"> 2016 </option>
                                                    <option <?PHP if(date('Y') == '2017' ){ echo "selected"; } ?> value="2017"> 2017 </option>
                                                    <option <?PHP if(date('Y') == '2018' ){ echo "selected"; } ?> value="2018"> 2018 </option>
                                                    <option <?PHP if(date('Y') == '2019' ){ echo "selected"; } ?> value="2019"> 2019 </option>
                                                    <option <?PHP if(date('Y') == '2020' ){ echo "selected"; } ?> value="2020"> 2020 </option>        
                                                </select>
                                            </div>
                                        </div>
                                    </div>  
                                </div>

                                <div class="form-actions">
                                    <center>
                                        <button type="button" <?PHP if($aktif == 1){ ?> onclick="get_laporan_beranda();" <?PHP } else { echo "disabled";} ?> class="btn btn-danger" style="width: 20%;">CETAK LAPORAN PDF</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" <?PHP if($aktif == 1){ ?> onclick="get_laporan_beranda_xls();" <?PHP } else { echo "disabled";} ?> class="btn btn-success" style="width: 20%;">CETAK LAPORAN EXCEL</button>

                                        <input type="submit" name="pdf" value="pdf" id="cetak_pdf_beranda" style="display: none;" />                      
                                        <input type="submit" name="excel" value="excel" id="cetak_xls_beranda" style="display: none;" />                      
                                    </center>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
               </div>
              <!-- END LAPORAN -->
              </div>
              <div class="modal-footer">
                <button type="button" id="tutup_modal_appr" class="btn btn-default" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

        <!-- HAPUS MODAL -->
        <a id="dialog-btn" href="javascript:;" class="cd-popup-trigger" style="display:none;">View Pop-up</a>
        <div class="cd-popup" role="alert">
            <div class="cd-popup-container">

                <form id="delete" method="post" action="<?=base_url();?>beranda_c">
                    <input type="hidden" name="id_hapus" id="id_hapus" value="" />
                </form>   
                 
                <p>Apakah anda yakin ingin menghapus divisi ini?</p>
                <ul class="cd-buttons">            
                    <li><a href="javascript:;" onclick="$('#delete').submit();">Ya</a></li>
                    <li><a onclick="$('.cd-popup-close').click(); $('#id_hapus').val('');" href="javascript:;">Tidak</a></li>
                </ul>
                <a href="#0" onclick="$('#id_hapus').val('');" class="cd-popup-close img-replace">Close</a>
            </div> <!-- cd-popup-container -->
        </div> <!-- cd-popup -->
        <!-- END HAPUS MODAL -->

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

    function ubah_data_unit(id, nama_unit){

        $('#id_unit_ed').val(id);
        $('#nama_unit_ed').val(nama_unit);
        $('#ubah_unit_btn').click();
    }

    function aprroval(id, act, item, id_item, jenis){
        
        $('#apr_aksi').val(act);
        $('#id_persetujuan').val(id);
        $('#item').val(item);
        $('#id_item').val(id_item);
        $('#jenis').val(jenis);
        $('#apr_alasan').val('');

        $('#appr_btn').click();
    }

    function save_approval(){

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
                if(res == 1){
                    $('#tutup_modal_appr').click();                    
                    pesan_sukses();
                }
            }
        });
    }

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

    function pilih_unit(id, nama_unit, ele, link){
        $('#unit').val(id);
        $('#unit_txt').val(nama_unit);
        $('#url_laporan').val(link);
        $('.unit_box').removeClass('unit_selected');
        $(ele).addClass('unit_selected');
        // $('#panel_laporan').show();
        $('#modal_lap_btn').click();
    }

    function get_laporan_beranda(){
        var laporan = $('#laporan').val();
        var link  = $('#url_laporan').val();
        $('#form_laporan').attr('action', laporan);
        $('#cetak_pdf_beranda').click();
    }

    function get_laporan_beranda_xls(){
        var laporan = $('#laporan').val();
        var link  = $('#url_laporan').val();
        $('#form_laporan').attr('action', link+laporan);
        $('#cetak_xls_beranda').click();
    }

    function get_laporan_komp_neraca(){
        $('#form_laporan_kompilasi').attr('action', '<?=base_url();?>lap_komparasi_neraca_c');
        $('#cetak_xls_kompilasi').click();        
    }

    function get_laporan_komp_laba(){
        $('#form_laporan_kompilasi').attr('action', '<?=base_url();?>lap_komparasi_c');
        $('#cetak_xls_kompilasi').click()
    }
</script>
