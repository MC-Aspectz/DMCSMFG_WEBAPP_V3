<?php 
    require_once('./function/index_x.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  Bootstrap  -->
    <link rel="stylesheet" href="<?php echo $_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>">
    <!--  Load Google Fonts  -->
    <link href="<?php echo $_SESSION['APPURL'] . '/font/google/montserrat.css'; ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo $_SESSION['APPURL'] . '/font/google/lato.css'; ?>" type="text/css">
    <!-- -------------------------------------------------------------------------------- -->
    <script src="<?php echo $_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>"></script>
    <script src="<?php echo $_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>"></script>
    <!-- -------------------------------------------------------------------------------- -->
    <!--  CSS  -->
    <!-- <link rel="stylesheet" href="./css/index.css"> -->
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Script  -->
    <!-- -------------------------------------------------------------------------------- -->
</head>
<body>
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Menu  -->
    <?php doMenu(); ?>
    <!-- -------------------------------------------------------------------------------- -->
    <div class="container-fluid bg-primary" style="height: auto;">
        <div class="row justify-content-between">
            <div class="col-10">
                <p class="text-white" style="font-size: 1.2em; margin: 5px;"><?php echo $packname . ' > ' . $appname; ?></p>
            </div>
            <div class="col-2 text-end align-middle">
                <a href="<?php echo $_SESSION['APPURL'] . '/home.php'; ?>">
                    <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
                    <p class="text-white" style="font-size: 1.2em; margin: 5px;">[ <?php echo $txtbylang['close']; ?> ]</p>
                </a>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------- -->
</body>
</html>
