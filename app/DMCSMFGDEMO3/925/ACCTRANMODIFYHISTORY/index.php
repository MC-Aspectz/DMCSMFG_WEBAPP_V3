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
    <link rel="stylesheet" href="./css/style.css">
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

    <form method="POST" id="form1">

        <div class="flex">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">Logging History</div>
                </div>
            </div>
        </div>
        
        <div class="d-flex p-2">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-1">
                        <label>Start Date</label>
                    </div>
                    <div class="col-md-1">
                        <input type="date"  id="" name="" />&emsp;
                    </div>
                    <div class="col-md-1">
                        <label>-></label>
                    </div>
                    <div class="col-md-1">
                        <input type="date"  id="" name="" />&emsp;
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-1">
                        <label>Staff</label>
                    </div>
                    <div class="col-md-1">
                        <input class="form-control" type="text" id="" name="" />
                    </div>
                    <div class=" col-md-1" style="right: 10px;">
                        <a href="#" id=""><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    <div class="col-md-1">
                        <label>Programe Code</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" id="" name="" />
                    </div>
                    <div class="col-md-3">
                        <label> </label>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-action" id="" name="">Search</button>&emsp;&emsp;
                    </div>

                </div>
            </div>
        </div>


        <div class="d-flex p-2">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-10">
                    <div class="table height400"> 
                    <table class="table-head" rules="cols" id="table_result" cellpadding="3" cellspacing="1" >
                        <thead>
                        <tr class="th-class table-secondary">
                            <th style="text-align: left; padding-left: 1%;">Date Modified</th>
                            <th style="text-align: left; padding-left: 1%;">Staff Code</th>
                            <th style="text-align: left; padding-left: 1%;">Staff Name</th>
                            <th style="text-align: left; padding-left: 1%;">Department</th>
                            <th style="text-align: left; padding-left: 1%;">Department Name</th>
                            <th style="text-align: left; padding-left: 1%;">Program ID</th>
                            <th style="text-align: left; padding-left: 1%;">Program Name</th>
                            <th style="text-align: left; padding-left: 1%;">Voucher No.</th>
                            <th style="text-align: left; padding-left: 1%;">Insert</th>
                            <th style="text-align: left; padding-left: 1%;">Update</th>
                            <th style="text-align: left; padding-left: 1%;">Cancle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-warning">
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                            <td class="td-class"> </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-1">
                        <button type="button" class="btn btn-action" id="" name="">CSV</button>&emsp;&emsp;
                    </div>
                    
                    <div class="col-md-8">
                        <label > </label>
                    </div>

                    <div class="col-md-1">
                        <button type="button" class="btn btn-action" id="" name="">End</button>&emsp;&emsp;
                    </div>

                </div>
            </div>
        </div>

        

    </form>
    <!-- -------------------------------------------------------------------------------- -->
    </body>

</html>