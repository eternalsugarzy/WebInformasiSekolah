<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Admin - Edusite</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="../css/style.css"/>

        <style>
            /* Custom CSS agar login box berada tepat di tengah vertikal */
            .home-wrapper {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 100%;
                left: 0;
            }
            
            /* Styling khusus kotak login agar kontras dengan background */
            .login-content {
                background-color: rgba(255, 255, 255, 0.95); /* Putih sedikit transparan */
                padding: 40px;
                border-radius: 4px;
                box-shadow: 0px 10px 30px rgba(0,0,0,0.3);
            }

            .login-header {
                text-align: center;
                margin-bottom: 30px;
            }

            .login-header img {
                height: 45px; /* Ukuran logo */
                margin-bottom: 15px;
                /* Filter agar logo putih terlihat di background putih (opsional) */
                filter: invert(1); 
            }
            
            .input-group-addon {
                background-color: #FF6700;
                border-color: #FF6700;
                color: #fff;
            }
        </style>
    </head>
    <body>

        <div id="home" class="hero-area" style="height: 100vh;">

            <div class="bg-image bg-parallax overlay" style="background-image:url('../img/home-background.jpg')"></div>

            <div class="home-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            
                            <div class="login-content">
                                <div class="login-header">
                                    <img src="../img/logo-alt.png" alt="logo">
                                    <h3 style="margin:0; font-size: 22px; text-transform: uppercase;">Admin Login</h3>
                                </div>

                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger text-center" role="alert">
                                        <i class="fa fa-exclamation-triangle"></i> <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input class="form-control" type="text" name="username" placeholder="Username" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <br>
                                    <button class="main-button icon-button pull-right" type="submit" style="width: 100%;">Masuk Dashboard</button>
                                </form>
                                
                                <div class="clearfix"></div>
                                <div class="text-center" style="margin-top: 20px;">
                                    <a href="../index.php" style="font-size: 12px; color: #666;">&larr; Kembali ke Halaman Utama</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id='preloader'><div class='preloader'></div></div>

        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>

    </body>
</html>