<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?= $title; ?></title>

    <!-- Styles -->
    <link rel="shortcut icon" href="/tema/user/template/assets/images/logo/fav.jpg" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="/tema/admin/circl/theme/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tema/admin/circl/theme/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="/tema/admin/circl/theme/assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <!-- Theme Styles -->
    <link href="/tema/admin/circl/theme/assets/css/main.min.css" rel="stylesheet">
    <link href="/tema/admin/circl/theme/assets/css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="login-page">
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-4">
                <div class="card login-box-container">
                    <div class="card-body">
                        <div class="authent-logo">
                            <img src="/tema/admin/circl/theme/assets/images/logo.png" alt="">
                        </div>
                        <div class="authent-text">
                            <p>Selamat Datang di Halaman Login!</p>
                            <?php if (session()->getFlashdata('danger')) { ?>
                                <div class="alert alert-danger fade show" role="alert">
                                    <span><?= session()->getFlashdata('danger'); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <form action="/login" method="post">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" name="login" value="<?= old('login'); ?>" class="form-control <?= $validation->hasError('login') ? 'is-invalid' : '' ?>" placeholder="Email / Username">
                                    <label>Email atau Username</label>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('login'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="password" name="password" value="<?= old('password'); ?>" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" placeholder="Password">
                                    <label for="password">Password</label>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Javascripts -->
    <script src="/tema/admin/circl/theme/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="/tema/admin/circl/theme/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/tema/admin/circl/theme/assets/js/feather.min.js"></script>
    <script src="/tema/admin/circl/theme/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="/tema/admin/circl/theme/assets/js/main.min.js"></script>


</body>

</html>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        })
    }, 3000);
</script>