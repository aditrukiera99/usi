<!DOCTYPE HTML>
<?PHP
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$aktif = $this->master_model_m->get_aktif();
?>
<html lang="en" style="height: 100%;">
<head>
<meta charset="utf-8">
<title> E-AKUNTANSI</title>
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
<style type="text/css">
    .main-wrapper{
        background: url(<?=$base_url2;?>assets/img/bkg-win8.jpg) !important;
    }

    .layout{
        background: url(<?=$base_url2;?>assets/img/bkg-win8.jpg) !important;
    }

    .unit_box:hover{
        border: 3px solid #00a4e4;
    }
</style>
</head>
<body style="height: 100%;">

<div class="layout" style="height: 100%;">
    <div class="main-wrapper" style="margin-left:0px; height: auto;">        
        <div class="container-fluid" style="margin-top: 30px;">

        <center>
            <img src="<?=$base_url2;?>material/images/logo_akun.png" width="300" height="200" alt="Logo Akun" style="margin-left: 14px; margin-top: 10px;">
        </center>
        <br><br>
        <div class="row-fluid">
            <div class="span12">
                <div class="switch-board" style="padding-top: 8px; background: #146eb4">
                    <center><h4 style="color:#c4dff6;">PILIH UNIT ANDA UNTUK LOGIN </h4></center>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="switch-board">
                    <ul class="clearfix switch-item">
                        <?PHP foreach ($dt_unit as $key => $row) { ?>
                        <li style="width: auto; height: auto; padding: 10px">
                            <a style="width: auto; height: auto; padding: 10px !important;" href="<?=$base_url2;?>login/<?=str_replace(' ', '-',strtolower($row->NAMA_UNIT));?>"  class="white unit_box">_
                                <?PHP if($row->LOGO == ""){ ?>
                                <img src="<?=$base_url2;?>files/logo.png" style="width: 180px; min-height: 100px; max-height: 100px;">
                                <?PHP } else { ?>
                                <img src="<?=$base_url2;?>files/logo.png" style="width: 180px; min-height: 100px; max-height: 100px;">
                                <?PHP } ?>                                
                                <span style="color: #333 !important; font-size: 12px !important; margin-top: 8px; font-weight: bold;"><?=strtoupper($row->NAMA_UNIT);?></span>
                            </a>
                        </li>
                        <?PHP } ?>
                    </ul>
                </div>
            </div>
        </div>

        <br><br>

        </div>
    </div>
</div>



</body>
</html>

