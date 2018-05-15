<!DOCTYPE html>
<?PHP
$get_data_usaha = $this->master_model_m->get_data_usaha();

?>

<?PHP
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | Aplikasi Akuntansi</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?=$base_url2;?>assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?=$base_url2;?>assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=$base_url2;?>assets/css/form-elements.css">
        <link rel="stylesheet" href="<?=$base_url2;?>assets/css/style.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?=$base_url2;?>assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$base_url2;?>ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$base_url2;?>ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$base_url2;?>ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?=$base_url2;?>ico/apple-touch-icon-57-precomposed.png">
        <style type="text/css">
        .bg { 
            overflow: hidden;
            /* The image used */
            background-image: -webkit-linear-gradient(rgba(0,0,0, 0.4) 0%,rgba(0,0,0, 4) 100%), url(http://tub.tubgit.com/reimg/resize-img.php?src=http://tub.tubgit.com/images255/nkk5ycmljpy.jpg&h=1080&w=1920);
            background-image:  -moz-linear-gradient(rgba(0,0,0, 0.4) 0%,rgba(0,0,0, 4) 100%), url(http://tub.tubgit.com/reimg/resize-img.php?src=http://tub.tubgit.com/images255/nkk5ycmljpy.jpg&h=1080&w=1920);
            background-image:  -o-linear-gradient(rgba(0,0,0, 0.4) 0%,rgba(0,0,0,  4) 100%), url(http://tub.tubgit.com/reimg/resize-img.php?src=http://tub.tubgit.com/images255/nkk5ycmljpy.jpg&h=1080&w=1920);
            background-image:  -ms-linear-gradient(rgba(0,0,0, 0.4) 0%,rgba(0,0,0,  4) 100%), url(http://tub.tubgit.com/reimg/resize-img.php?src=http://tub.tubgit.com/images255/nkk5ycmljpy.jpg&h=1080&w=1920);
            background-image:  linear-gradient(rgba(0,0,0, 0.4) 0%,rgba(0,0,0,  4) 100%), url(http://tub.tubgit.com/reimg/resize-img.php?src=http://tub.tubgit.com/images255/nkk5ycmljpy.jpg&h=1080&w=1920);
            /* Full height */
            height: 100%; 

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #bg {
          position: fixed; 
          top: -50%; 
          left: -50%; 
          width: 200%; 
          height: 200%;
        }
        #bg img {
          position: absolute; 
          top: 0; 
          left: 0; 
          right: 0; 
          bottom: 0; 
          margin: auto; 
          min-width: 50%;
          min-height: 50%;
        }

        </style>
    </head>
    <body>
        <div id="bg">
          <img src="https://cdn-enterprise.discourse.org/turtlerock/uploads/default/original/3X/6/d/6d1e41aa7964ea6d7e9212d4e68a64f7ceea7e46.jpg" alt="">
        </div>
        <!-- Top content -->
        <div class="top-content">
            
            <div class="inner-bg" style="padding-top:45px;">
                <div class="container" style="position: relative;">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h2 style="margin-bottom: -20px; color: blue; font-weight: bold; color: #FFF; background: red; text-align: center; width: 50%;">DIREKTUR</h2>
                            <h1 style="color: blue; font-weight: bold; color: #FFF; background: #003666; text-align: center;">UNITED SHIPPING INDONESIA</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <p align="center">
                                    <img src="<?=$base_url2;?>/assets/img/usi Uk kecil.png" alt="" style="width: 50%;height: 50%;">
                                    </p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" method="post" action="" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn btn-success">Sign in!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script type="text/javascript">
        jQuery(document).ready(function() {
    
            /*
                Fullscreen background
            */
            // $.backstretch("https://results-software.com/wp-content/uploads/2016/08/features.jpg");
            
            /*
                Form validation
            */
            $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
                $(this).removeClass('input-error');
            });
            
            $('.login-form').on('submit', function(e) {
                
                $(this).find('input[type="text"], input[type="password"], textarea').each(function(){
                    if( $(this).val() == "" ) {
                        e.preventDefault();
                        $(this).addClass('input-error');
                    }
                    else {
                        $(this).removeClass('input-error');
                    }
                });
                
            });
            
            
        });
        </script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>