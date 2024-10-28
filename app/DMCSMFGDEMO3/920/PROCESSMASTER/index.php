<?php 
    require_once('./function/index_x.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
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
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/sweetalert2.min.css'; ?>">
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Script  -->
    <!-- -------------------------------------------------------------------------------- -->
    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/sweetalert2.min.js'; ?>" integrity="sha384-mngH0dsoMzHJ55nmFSRTjl5pdhgzHDeEoLOuZp2U28VrwCH0ieB9ntimtLbJm9KJ" crossorigin="anonymous"></script>
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
                    <p class="text-white" style="font-size: 1.2em; margin: 5px;">[ <?php echo $lang['close']; ?> ]</p>
                </a>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------- -->
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <form class="form" method="POST" id="routing_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col60">
                    <label class="label-width16"><?=$data['TXTLANG']['ITEMCODE']; ?></label>
                    <input class="form-control width26 req" type="text" id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''?>" onchange="unRequired();" /><!-- ITEMCD -->
                    <div class="fix-icon" style="right: -20px;">
                        <a href="#" id="SEARCHITEM"><img style="img-height20"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                    </div>
                    <input class="form-control width40" type="text" id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''?>" readonly/><!-- ITEMNAME -->
                    <select class="width20 option-text form-select form-select-sm " id="BMVERSION" name="BMVERSION">
                        <option value=""></option>
                        <?php foreach ($mbversion as $key => $item) { ?><!-- mbversion -->
                            <option value="<?php echo $key ?>" <?php echo (isset($data['BMVERSION']) && $data['BMVERSION'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div  >
                <div class="flex .col40">
                    <label class="label-width4"><?=$data['TXTLANG']['CLONE']; ?></label>
                    <div class="fix-icon">
                        <a href="#" id="ITEMCLONE"><img style="img-height20"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                    </div>
                    <div class="flex .col45" style="justify-content: right;">
                        <button type="button"  class="btn btn-outline-secondary btn-action" id="copy" name="copy" onclick="$('#loading').show();" ><?php echo $data['TXTLANG']['COPY']; ?></button>&emsp;&emsp;
                        <button type="submit"  class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="$('#loading').show();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp;
                    </div>
                </div>
            </div>
        </div><!-- first line -->

        <div class="d-flex p-2">
            <div class="flex .col60">
                <label>--------------------------------------------------------------------------------------------------------------------------------------------------</label>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex .col50">
                <label class="label-width15"><?=$data['TXTLANG']['ROUT_NO']; ?></label><!-- Operation No -->
                <input class="form-control width10 req" type="text" id="ITEMPSSNO" name="ITEMPSSNO" value="<?=isset($data['ITEMPSSNO']) ? $data['ITEMPSSNO']: ''?>"
                        onchange="unRequired();"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>&ensp;&ensp;
                <label class="label-width13"><?=$data['TXTLANG']['PROCESSTYPE']; ?></label><!-- Operation Type -->
                <select class="width20 option-text form-select form-select-sm req" id="ITEMPSSTYP" name="ITEMPSSTYP" onchange="unRequired(); clearItemplace();">
                    <option value=""></option>
                     <?php foreach ($jobtype as $key => $item) { ?><!-- jobtype -->
                        <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMPSSTYP']) && $data['ITEMPSSTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex .col50">
                <select class="width20 option-text form-select form-select-sm " style="display: none;" id="JOBCODE" name="JOBCODE" >
                    <option value=""></option>
                    <?php foreach ($jobcode as $key => $item) { ?><!-- jobcode -->
                        <option value="<?php echo $key ?>" <?php echo (isset($data['JOBCODE']) && $data['JOBCODE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                    <?php } ?>
                </select>
            </div>
        </div><!-- second line -->

        <div class="d-flex p-2">
            <div class="flex .col50">
                <label class="label-width15"><?=$data['TXTLANG']['WC_CODE']; ?></label><!-- WorkCenter -->
                <input class="form-control width20 req" type="text" id="ITEMPSSPLACE" name="ITEMPSSPLACE" value="<?=isset($data['ITEMPSSPLACE']) ? $data['ITEMPSSPLACE']: ''?>" onchange="unRequired();">
                <div class="fix-icon" style="right: -20px;">
                    <a href="#" id="SEARCHITEMPLACE"><img style="img-height20"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                </div>
                <input class="form-control width30 " type="text" id="PLACENAME" name="PLACENAME" value="<?=isset($data['PLACENAME']) ? $data['PLACENAME']: ''?>" readonly/><!-- WorkCenterName -->
            </div>
            <div class="flex .col50">
                <label class="label-width15"><?=$data['TXTLANG']['JOBCODE']; ?></label><!-- JOBCODE -->
                <input class="form-control width20" type="text" id="ITEMPSSJOBTYP" name="ITEMPSSJOBTYP" value="<?=isset($data['ITEMPSSJOBTYP']) ? $data['ITEMPSSJOBTYP']: ''?>" >
                <div class="fix-icon" style="right: -20px;">
                    <a href="#" id="SEARCHJOBCODE"><img style="img-height20"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                </div>
                <input class="form-control width30 " type="text" id="JOB_NAME" name="JOB_NAME" value="<?=isset($data['JOB_NAME']) ? $data['JOB_NAME']: ''?>" readonly/><!-- JOBNAME -->
            </div>
        </div><!-- third line -->

        <div class="d-flex p-2">
            <div class="flex .col50">
                <label class="label-width15"><?=$data['TXTLANG']['JOB_DETAIL']; ?></label><!-- Description -->
                <input class="form-control width75" type="text" id="ITEMPSSDESC" name="ITEMPSSDESC" value="<?=isset($data['ITEMPSSDESC']) ? $data['ITEMPSSDESC']: ''?>" >
            </div>
            <div class="flex .col50">
                <label class="label-width15"><?=$data['TXTLANG']['CERTIFICATE_ATTACH']; ?></label><!-- Attachment -->
                <input class="form-control width75" type="text" id="ITEMIMGLOC" name="ITEMIMGLOC" value="<?=isset($data['ITEMIMGLOC']) ? $data['ITEMIMGLOC']: ''?>" >
                <button type="button" class="btn btn-outline-secondary btn-action50" onclick="document.getElementById('ITEMIMGLOC').click()">...</button>
            </div>
        </div><!-- fourth line -->

        <div class="d-flex p-2">
            <div class="flex .col50">
                <label class="label-width15"><?=$data['TXTLANG']['PIECE_ON_BOARD']; ?></label><!-- Piece on Board -->
                <input class="form-control width10"style="text-align:left;" type="text" id="IMPSSADDBOARDQTY" name="IMPSSADDBOARDQTY" value="<?=isset($data['IMPSSADDBOARDQTY']) ? $data['IMPSSADDBOARDQTY']: ''?>"
                oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                <label class="label-width18" style="text-align:right;"><?='SPM'; ?></label>&ensp;<!-- SPM -->
                <input class="form-control width10" type="text" id="IMPSSADDSPM" name="IMPSSADDSPM" value="<?=isset($data['IMPSSADDSPM']) ? $data['IMPSSADDSPM']: ''?>"
                oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                <label class="label-width18" style="text-align:right;"><?=$data['TXTLANG']['CAP_RATIO']; ?></label>&ensp;<!-- Capacity -->
                <input class="form-control width10" type="text" id="IMPSSADDUSAGE" name="IMPSSADDUSAGE" value="<?=isset($data['IMPSSADDUSAGE']) ? $data['IMPSSADDUSAGE']: ''?>"
                onchange="this.value = digitFormat2(this.value);" 
                oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                <label class="label-width27" style="text-align:right; display: none;"><?=$data['TXTLANG']['SAME_OPE']; ?></label>&ensp;
                <input class="form-control width10" style="display: none;" type="text" id="IMPSSADDOPE" name="IMPSSADDOPE" value="<?=isset($data['IMPSSADDOPE']) ? $data['IMPSSADDOPE']: ''?>" >
            </div>
            <div class="flex .col50">
                <label class="label-width15"><?=$data['TXTLANG']['NEXT_TYPE']; ?></label><!-- Subsequent Process -->
                <select class="width17 option-text form-select form-select-sm req" id="ITEMPSSLINKTYP" name="ITEMPSSLINKTYP" onchange="unRequired();">
                        <option value=""></option>
                        <?php foreach ($joblinktype as $key => $item) { ?><!-- joblinktype -->
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMPSSLINKTYP']) && $data['ITEMPSSLINKTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                </select>
                <label class="label-width15" style="text-align:right;"><?=$data['TXTLANG']['UNIT_PRICE']; ?></label>&ensp;<!-- unit price -->
                <input class="form-control width20" type="text" id="ITEMPSSUNITPRC" name="ITEMPSSUNITPRC" value="<?=isset($data['ITEMPSSUNITPRC']) ? $data['ITEMPSSUNITPRC']: ''?>"
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                <input class="form-control width10" type="text" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=isset($data['LOAD']['CURRENCYDISP']) ? $data['LOAD']['CURRENCYDISP']: ''?>" readonly>
            </div>
        </div><!-- fifth line -->

        <div class="d-flex p-2">
            <div class="flex .col50">
                <label class="label-width18"><?=$data['TXTLANG']['PRODUCT_QTY']; ?></label><!-- Product Qty -->
                <input class="form-control width15 req" type="text" id="ITEMPSSPLANQTY" name="ITEMPSSPLANQTY" value="<?=isset($data['ITEMPSSPLANQTY']) ? $data['ITEMPSSPLANQTY']: ''?>"
                        onchange="this.value = digitFormat(this.value); unRequired();"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                <select class="width20 option-text form-select form-select-sm" id="ITEMUNITTYP" name="ITEMUNITTYP" disabled>
                    <option value=""></option>
                        <?php foreach ($unit as $key => $item) { ?><!-- unit -->
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                </select>&ensp;&ensp;
                <label class="label-width18"><?=$data['TXTLANG']['JOB_TIME']; ?></label><!-- manufacturing time -->
                <input class="form-control width20 req" type="text" id="ITEMPSSPLANTIME" name="ITEMPSSPLANTIME" value="<?=isset($data['ITEMPSSPLANTIME']) ? $data['ITEMPSSPLANTIME']: ''?>"
                        onchange="this.value = digitFormat(this.value); unRequired();"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                <select class="width20 option-text form-select form-select-sm " id="ITEMPSSPLANTIMETYP" name="ITEMPSSPLANTIMETYP" >
                    <option value=""></option>
                        <?php foreach ($jobunit as $key => $item) { ?><!-- jobunit -->
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMPSSPLANTIMETYP']) && $data['ITEMPSSPLANTIMETYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                </select>&ensp;&ensp;&ensp;
            </div>
            <div class="flex .col50">
                <label class="label-width23"><?=$data['TXTLANG']['ALLOWANCE']; ?></label>&ensp;&thinsp;<!-- Time -->
                <input class="form-control width20 req" type="text" id="ITEMPSSALLOWANCE" name="ITEMPSSALLOWANCE" value="<?=isset($data['ITEMPSSALLOWANCE']) ? $data['ITEMPSSALLOWANCE']: ''?>" onchange="unRequired();" >&ensp;
                <label class="label-width18"><?=$data['TXTLANG']['MINUTES']; ?></label>
                <!------------------------------------------------------------- Picture -------------------------------------------------------------------->
                <div class="flex" style="padding-left: -5%;">
                    <label class="label-width13">Picture : </label>
                    <input type="hidden" name="PATHFILE" id="PATHFILE" value="<?=$path_file?>">
                    <?php if(isset($data['ITEMIMGLOC'])) { ?>
                        <iframe id="ITEMIMGLOC" name="ITEMIMGLOC" src="<?=$_SESSION['APPURL']?>/img/csv-file.png" style="padding-left: 8%;"></iframe>
                    <?php } else { ?>
                        <iframe id="ITEMIMGLOC" name="ITEMIMGLOC" src="" style="padding-left: 8%;"></iframe><?php } ?>
                </div>
                <!------------------------------------------------------------- Picture -------------------------------------------------------------------->
            </div>
        </div><!-- sixth line -->

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col60">
                    <button type="button" class="btn btn-action" id="insert" name="insert" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['INSERT']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="delete" name="delete" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?></button>
                </div>
                <div class="flex .col40">
                <div class="flex" style="justify-content: right;">
                    <button type="button" class="btn btn-action" id="entry" name="entry" onclick="enrty();"><?php echo $data['TXTLANG']['ENTRY']; ?></button>&emsp;&emsp;
                    </div>
                </div>
            </div>
        </div>
        <!-- Button Line -->

        <div class="d-flex p-2">
            <div class="table height280">
                <table class="table-head table-striped" id="table" rules="cols" cellpadding="3" cellspacing="1">
                    <thead>
                        <tr class="table-secondary">
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['LINE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ROUT_NO']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['PROCESSTYPE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['WC_CODE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['JOBPLACE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['JOB_DETAIL']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['JOBCODE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['JOBNAME']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['PRODUCT_QTY']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['JOB_TIME']; ?></th>
                            <th style="text-align: center; "></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['NEXT_TYPE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ALLOWANCE']; ?></th>
                            <th style="text-align: center; "></th>
                        </tr>
                    </thead>
                    <tbody id="DVWDETAIL">
                    <?php if(!empty($data['RM']))  {
                    // print_r($data['RM']);  
                    for ($i = 1; $i <= count($data['RM']); $i++) { 
                        $minrow = count($data['RM']); ?>
                        <tr class="tr_border table-secondary" id="rowId<?=$i?>">
                        <td class="td-class" id="ROWNO_TD<?=$i?>" style="text-align: center; "><?=++$rowno ?></td>
                        <td class="td-class" id="ITEMPSSNO_TD<?=$i?>" style="text-align: center; "><?=isset($data['RM'][$i]['ITEMPSSNO']) ? $data['RM'][$i]['ITEMPSSNO']: '' ?></td>
                        <td class="td-class" id="ITEMPSSTYP_TD<?=$i?>" style="text-align: center; "><?php
                        if(isset($data['RM'][$i]['ITEMPSSTYP'])){
                            foreach ($jobtype as $key => $item) {
                                if($key == $data['RM'][$i]['ITEMPSSTYP'])
                                    {
                                        echo($item);
                                    }
                                }                                 
                            } ?></td>                        
                        <td class="td-class" id="ITEMPSSPLACE_TD<?=$i?>" style="text-align: center; "><?=isset($data['RM'][$i]['ITEMPSSPLACE']) ? $data['RM'][$i]['ITEMPSSPLACE']: '' ?></td>
                        <td class="td-class" id="PLACENAME_TD<?=$i?>" style="text-align: center; "><?=isset($data['RM'][$i]['PLACENAME']) ? $data['RM'][$i]['PLACENAME']: '' ?></td>
                        <td class="td-class" id="ITEMPSSDESC_TD<?=$i?>" style="text-align: center; "><?=isset($data['RM'][$i]['ITEMPSSDESC']) ? $data['RM'][$i]['ITEMPSSDESC']: '' ?></td>
                        <td class="td-class" id="ITEMPSSJOBTYP_TD<?=$i?>" style="text-align: center; "><?php
                        if(isset($data['RM'][$i]['ITEMPSSJOBTYPSTR'])){
                            echo($data['RM'][$i]['ITEMPSSJOBTYPSTR']);
                            // print_r($jobtype);
                            // foreach ($jobtype as $key => $item) { 
                            //     if($item == $data['RM'][$i]['ITEMPSSJOBTYPSTR'])
                            //         {
                            //             echo($item);
                            //         }
                            //     }                                 
                            } 
                            ?>
                            </td>
                        <td class="td-class" id="JOB_NAME_TD<?=$i?>" style="text-align: center; "><?=isset($data['RM'][$i]['JOB_NAME']) ? $data['RM'][$i]['JOB_NAME']: '' ?></td>
                        <td class="td-class" id="ITEMPSSPLANQTY_TD<?=$i?>" style="text-align: center; "><?=isset($data['RM'][$i]['ITEMPSSPLANQTY']) ? $data['RM'][$i]['ITEMPSSPLANQTY']: '' ?></td>
                        <td class="td-class" id="ITEMPSSPLANTIME_TD<?=$i?>" style="text-align: center; "><?=isset($data['RM'][$i]['ITEMPSSPLANTIME']) ? $data['RM'][$i]['ITEMPSSPLANTIME']: '' ?></td>
                        <td class="td-class" id="ITEMPSSPLANTIMETYP_TD<?=$i?>"style="text-align: center; "><?php
                        if(isset($data['RM'][$i]['ITEMPSSPLANTIMETYP'])){
                            foreach ($jobunit as $key => $item) { 
                                if($key == $data['RM'][$i]['ITEMPSSPLANTIMETYP'])
                                    {
                                        echo($item);
                                    }
                            }                                 
                        } ?></td>
                        <td class="td-class" style="text-align: center; "><?php
                        if(isset($data['RM'][$i]['ITEMPSSLINKTYP'])){
                            foreach ($joblinktype as $key => $item) { 
                                if($key == $data['RM'][$i]['ITEMPSSLINKTYP'])
                                    {
                                        echo($item);
                                    }
                            }                                 
                        } ?></td>
                        <td class="td-class" id="ITEMPSSALLOWANCE_TD<?=$i?>" style="text-align: center; "><?=isset($data['RM'][$i]['ITEMPSSALLOWANCE']) ? $data['RM'][$i]['ITEMPSSALLOWANCE']: '' ?></td>
                        <td class="td-class" id="SPACE_TD<?=$i?>" style="text-align: center; "><?=isset($data['RM'][$i]['SPACE']) ? $data['RM'][$i]['SPACE']: '' ?></td>

                        <!-- BMVERSION,ITEMPSSNO,ITEMPSSTYPSTR,ITEMPSSPLACE,PLACENAME,ITEMPSSDESC,ITEMPSSJOBTYPSTR,ITEMPSSPLANQTY,ITEMPSSPLANTIME,ITEMPSSPLANTIMETYPSTR,ITEMPSSLINKTYPSTR,
                        ITEMPSSALLOWANCE,ITEMPSSTYP,ITEMPSSJOBTYP,ITEMPSSPLANTIMETYP,ITEMPSSLINKTYP,ITEMPSSNOID,ITEMPSSUNITPRC,ITEMIMGLOC,ITEMCD,IMPSSADDBOARDQTY,IMPSSADDSPM,IMPSSADDUSAGE,IMPSSADDOPE -->
                        <td class="td-hide"><input type="hidden" id="ROWNO<?=$i?>" name="ROWNOA[]" value="<?=$rowno?>"></td>
                        <td class="td-hide"><input type="hidden" id="BMVERSION<?=$i?>" name="BMVERSIONA[]" value="<?=isset($data['RM'][$i]['BMVERSION']) ? $data['RM'][$i]['BMVERSION']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSNO<?=$i?>" name="ITEMPSSNOA[]" value="<?=isset($data['RM'][$i]['ITEMPSSNO']) ? $data['RM'][$i]['ITEMPSSNO']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSTYPSTR<?=$i?>" name="ITEMPSSTYPSTRA[]" value="<?=isset($data['RM'][$i]['ITEMPSSTYPSTR']) ? $data['RM'][$i]['ITEMPSSTYPSTR']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSPLACE<?=$i?>" name="ITEMPSSPLACEA[]" value="<?=isset($data['RM'][$i]['ITEMPSSPLACE']) ? $data['RM'][$i]['ITEMPSSPLACE']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="PLACENAME<?=$i?>" name="PLACENAMEA[]" value="<?=isset($data['RM'][$i]['PLACENAME']) ? $data['RM'][$i]['PLACENAME']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSDESC<?=$i?>" name="ITEMPSSDESCA[]" value="<?=isset($data['RM'][$i]['ITEMPSSDESC']) ? $data['RM'][$i]['ITEMPSSDESC']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSJOBTYPSTR<?=$i?>" name="ITEMPSSJOBTYPSTRA[]" value="<?=isset($data['RM'][$i]['ITEMPSSJOBTYPSTR']) ? $data['RM'][$i]['ITEMPSSJOBTYPSTR']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSPLANQTY<?=$i?>" name="ITEMPSSPLANQTYA[]" value="<?=isset($data['RM'][$i]['ITEMPSSPLANQTY']) ? $data['RM'][$i]['ITEMPSSPLANQTY']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSPLANTIME<?=$i?>" name="ITEMPSSPLANTIMEA[]" value="<?=isset($data['RM'][$i]['ITEMPSSPLANTIME']) ? $data['RM'][$i]['ITEMPSSPLANTIME']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSPLANTIMETYPSTR<?=$i?>" name="ITEMPSSPLANTIMETYPSTRA[]" value="<?=isset($data['RM'][$i]['ITEMPSSPLANTIMETYPSTR']) ? $data['RM'][$i]['ITEMPSSPLANTIMETYPSTR']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSLINKTYPSTR<?=$i?>" name="ITEMPSSLINKTYPSTRA[]" value="<?=isset($data['RM'][$i]['ITEMPSSLINKTYPSTR']) ? $data['RM'][$i]['ITEMPSSLINKTYPSTR']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSALLOWANCE<?=$i?>" name="ITEMPSSALLOWANCEA[]" value="<?=isset($data['RM'][$i]['ITEMPSSALLOWANCE']) ? $data['RM'][$i]['ITEMPSSALLOWANCE']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSTYP<?=$i?>" name="ITEMPSSTYPA[]" value="<?=isset($data['RM'][$i]['ITEMPSSTYP']) ? $data['RM'][$i]['ITEMPSSTYP']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSJOBTYP<?=$i?>" name="ITEMPSSJOBTYPA[]" value="<?=isset($data['RM'][$i]['ITEMPSSJOBTYP']) ? $data['RM'][$i]['ITEMPSSJOBTYP']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSPLANTIMETYP<?=$i?>" name="ITEMPSSPLANTIMETYPA[]" value="<?=isset($data['RM'][$i]['ITEMPSSPLANTIMETYP']) ? $data['RM'][$i]['ITEMPSSPLANTIMETYP']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSLINKTYP<?=$i?>" name="ITEMPSSLINKTYPA[]" value="<?=isset($data['RM'][$i]['ITEMPSSLINKTYP']) ? $data['RM'][$i]['ITEMPSSLINKTYP']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSNOID<?=$i?>" name="ITEMPSSNOIDA[]" value="<?=isset($data['RM'][$i]['ITEMPSSNOID']) ? $data['RM'][$i]['ITEMPSSNOID']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMPSSUNITPRC<?=$i?>" name="ITEMPSSUNITPRCA[]" value="<?=isset($data['RM'][$i]['ITEMPSSUNITPRC']) ? $data['RM'][$i]['ITEMPSSUNITPRC']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMIMGLOC<?=$i?>" name="ITEMIMGLOCA[]" value="<?=isset($data['RM'][$i]['ITEMIMGLOC']) ? $data['RM'][$i]['ITEMIMGLOC']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ITEMCD<?=$i?>" name="ITEMCDA[]" value="<?=isset($data['RM'][$i]['ITEMCD']) ? $data['RM'][$i]['ITEMCD']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="IMPSSADDBOARDQTY<?=$i?>" name="IMPSSADDBOARDQTYA[]" value="<?=isset($data['RM'][$i]['IMPSSADDBOARDQTY']) ? $data['RM'][$i]['IMPSSADDBOARDQTY']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="IMPSSADDSPM<?=$i?>" name="IMPSSADDSPMA[]" value="<?=isset($data['RM'][$i]['IMPSSADDSPM']) ? $data['RM'][$i]['IMPSSADDSPM']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="IMPSSADDUSAGE<?=$i?>" name="IMPSSADDUSAGEA[]" value="<?=isset($data['RM'][$i]['IMPSSADDUSAGE']) ? $data['RM'][$i]['IMPSSADDUSAGE']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="IMPSSADDOPE<?=$i?>" name="IMPSSADDOPEA[]" value="<?=isset($data['RM'][$i]['IMPSSADDOPE']) ? $data['RM'][$i]['IMPSSADDOPE']: '' ?>"></td>
                        <td class="td-hide"><?=isset($data['RM'][$i]['ITEMPSSTYP']) ? $data['RM'][$i]['ITEMPSSTYP']: '' ?></td>
                        <td class="td-hide"><?=isset($data['RM'][$i]['ITEMPSSPLANTIMETYP']) ? $data['RM'][$i]['ITEMPSSPLANTIMETYP']: '' ?></td>
                        <td class="td-hide"><?=isset($data['RM'][$i]['ITEMUNITTYP']) ? $data['RM'][$i]['ITEMUNITTYP']: '' ?></td>
                        <td class="td-hide"><?=isset($data['RM'][$i]['IMPSSADDBOARDQTY']) ? $data['RM'][$i]['IMPSSADDBOARDQTY']: '' ?></td>
                        <td class="td-hide"><?=isset($data['RM'][$i]['IMPSSADDSPM']) ? $data['RM'][$i]['IMPSSADDSPM']: '' ?></td>
                        <td class="td-hide"><?=isset($data['RM'][$i]['IMPSSADDUSAGE']) ? $data['RM'][$i]['IMPSSADDUSAGE']: '' ?></td>
                        <td class="td-hide"><?=isset($data['RM'][$i]['ITEMIMGLOC']) ? $data['RM'][$i]['ITEMIMGLOC']: '' ?></td>
                        <td class="td-hide"><?=isset($data['RM'][$i]['ITEMPSSUNITPRC']) ? $data['RM'][$i]['ITEMPSSUNITPRC']: '' ?></td>
                        <td class="td-hide"><input type="hidden" id="JOB_NAME<?=$i?>" name="JOB_NAMEA[]" value="<?=isset($data['RM'][$i]['JOB_NAME']) ? $data['RM'][$i]['JOB_NAME']: '' ?>"></td>

                        <? $i++ ?>
                        </tr> <?php
                        // break;
                    }
                    for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                        <tr class="tr_border table-secondary" id="rowId<?=$i?>">
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            
                        </tr> <?php 
                    }
                    } else {                            
                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                        <tr class="tr_border table-secondary" id="rowId<?=$i?>">
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                        </tr><?php
                    }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="font-size14"><?php echo $data['TXTLANG']['ROWCOUNT']; ?>&emsp;<label id="record"><?=$rowno?></label></div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <button type="button" class="btn btn-action" id="commit" name="commit" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['COMMIT']; ?></button>&emsp;&emsp;
                </div>
                <div class="flex .col45" style="justify-content: right;">
                    <button type="button" class="btn btn-action" id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="end" name="end"
                    onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"
                    ><?php echo $data['TXTLANG']['END']; ?></button>
                </div>
            </div>
        </div>

        <!-- required -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <input class="form-control width10 " style="display: none;" type="text" id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''?>" readonly/>
                </div>             
                <div class="flex .col45"></div>
            </div>
        </div>
    </form>

    <div id="loading" class="on" style="display: none;">
        <div class="cv-spinner">
            <div class="spinner"></div>
        </div>
    </div>

    <footer>
        <p class="text-black" style="font-size: 0.8em;"><?php echo 'URL : ' . $_SESSION['HOST'] . ' | Company : ' . $_SESSION['COMCD'] . ' | User : ' . $_SESSION['USERCODE']; ?></p>
    </footer>  
</body>

<script src="./js/script.js" ></script>
<script type="text/javascript">
$(document).ready(function() {

    // var ITEMPSSTYP = $('#ITEMPSSTYP').val();
//////////////////////////show selected row table/////////////////////////////
    var selectedRowIndex;
    var selectedRowIndex = localStorage.getItem('selectedRowIndex');

    if (selectedRowIndex !== null) {

        $('table#table tr').eq(selectedRowIndex).attr('id', 'click-row');
        document.getElementById("insert").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = true;
        document.getElementById("commit").disabled = false;

    }
    else{

        document.getElementById("insert").disabled = false;
        document.getElementById("update").disabled = true;
        document.getElementById("delete").disabled = true;
        document.getElementById("commit").disabled = false;

    }
/////////////////////////////////////////////////////////////////////////////
    $('#ITEMPSSTYP').on('change', function() {
        var ITEMPSSTYP = $(this).val();
        SEARCHITEMPLACE.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEMPLACE/index.php?ITEMPSSTYP=' + ITEMPSSTYP + '&page=PROCESSMASTER');//
    });

    unRequired();
    var index = 0;
    var index = '<?php echo (isset($data['RM']) ? count($data['RM']) : 0); ?>';
    
    // console.log(index);
    $(document).on('click', '#insert', function() {

    if($('#ITEMCD').val() != '' && $('#ITEMPSSNO').val() != '' && $('#ITEMPSSTYP').val() != '' && $('#ITEMPSSPLANQTY').val() != '' && $('#ITEMPSSPLANTIME').val() != '' && $('#ITEMPSSALLOWANCE').val() != '') {
            
        index ++;  // index += 1;
        var newRow = $('<tr class="tr_border" id=rowId' + index + '>');
        var cols = "";

        cols += '<td class="td-class" style="text-align: center; " id="ROWNO_TD' + index + '">' + index + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSNO_TD' + index + '">' + $('#ITEMPSSNO').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSTYP_TD' + index + '">' + $("#ITEMPSSTYP option:selected").text()+'</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSPLACE_TD' + index + '">' + $('#ITEMPSSPLACE').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="PLACENAME_TD' + index + '">' + $('#PLACENAME').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSDESC_TD' + index + '">' + $('#ITEMPSSDESC').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSJOBTYP_TD' + index + '">' + $('#ITEMPSSJOBTYP').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="JOB_NAME_TD' + index + '">' + $('#JOB_NAME').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSPLANQTY_TD' + index + '">' + $('#ITEMPSSPLANQTY').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSPLANTIME_TD' + index + '">' + $('#ITEMPSSPLANTIME').val() + '</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSPLANTIMETYP_TD' + index + '">' + $("#ITEMPSSPLANTIMETYP option:selected").text()+'</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSLINKTYP_TD' + index + '">' + $("#ITEMPSSLINKTYP option:selected").text()+'</td>';
        cols += '<td class="td-class" style="text-align: center; " id="ITEMPSSALLOWANCE_TD' + index + '">' + $('#ITEMPSSALLOWANCE').val() + '</td>';

        cols += '<td class="td-hide"><input type="hidden" id="ROWNO'+index+'" name="ROWNOA[]" value='+index+'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="BMVERSION'+index+'" name="BMVERSIONA[]" value='+ $('#BMVERSION').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSNO'+index+'" name="ITEMPSSNOA[]" value='+ $('#ITEMPSSNO').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSTYPSTR'+index+'" name="ITEMPSSTYPSTRA[]" value='+ $('#ITEMPSSTYP').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSPLACE'+index+'" name="ITEMPSSPLACEA[]" value='+ $('#ITEMPSSPLACE').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="PLACENAME'+index+'" name="PLACENAMEA[]" value='+ $('#PLACENAME').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSDESC'+index+'" name="ITEMPSSDESCA[]" value='+ $('#ITEMPSSDESC').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSJOBTYPSTR'+index+'" name="ITEMPSSJOBTYPSTRA[]" value='+ $('#ITEMPSSJOBTYP').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSPLANQTY'+index+'" name="ITEMPSSPLANQTYA[]" value='+ $('#ITEMPSSPLANQTY').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSPLANTIME'+index+'" name="ITEMPSSPLANTIMEA[]" value='+ $('#ITEMPSSPLANTIME').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSPLANTIMETYPSTR'+index+'" name="ITEMPSSPLANTIMETYPSTRA[]" value='+ $('#ITEMPSSPLANTIMETYP').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSLINKTYPSTR'+index+'" name="ITEMPSSLINKTYPSTRA[]" value='+ $('#ITEMPSSLINKTYP').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSALLOWANCE'+index+'" name="ITEMPSSALLOWANCEA[]" value='+ $('#ITEMPSSALLOWANCE').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSTYP'+index+'" name="ITEMPSSTYPA[]" value='+ $('#ITEMPSSTYP').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSJOBTYP'+index+'" name="ITEMPSSJOBTYPA[]" value='+ $('#ITEMPSSJOBTYP').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSPLANTIMETYP'+index+'" name="ITEMPSSPLANTIMETYPA[]" value='+ $('#ITEMPSSPLANTIMETYP').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSLINKTYP'+index+'" name="ITEMPSSLINKTYPA[]" value='+ $('#ITEMPSSLINKTYP').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSNOID'+index+'" name="ITEMPSSNOIDA[]" value='+ $('#ITEMPSSNO').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMPSSUNITPRC'+index+'" name="ITEMPSSUNITPRCA[]" value='+ $('#ITEMPSSUNITPRC').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMIMGLOC'+index+'" name="ITEMIMGLOCA[]" value='+ $('#ITEMIMGLOC').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="ITEMCD'+index+'" name="ITEMCDA[]" value='+ $('#ITEMCD').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="IMPSSADDBOARDQTY'+index+'" name="IMPSSADDBOARDQTYA[]" value='+ $('#IMPSSADDBOARDQTY').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="IMPSSADDSPM'+index+'" name="IMPSSADDSPMA[]" value='+ $('#IMPSSADDSPM').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="IMPSSADDUSAGE'+index+'" name="IMPSSADDUSAGEA[]" value='+ $('#IMPSSADDUSAGE').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="IMPSSADDOPE'+index+'" name="IMPSSADDOPEA[]"   value='+ $('#IMPSSADDOPE').val() +'></td>';
        cols += '<td class="td-hide"><input type="hidden" id="JOB_NAME'+index+'" name="JOB_NAMEA[]"   value='+ $('#JOB_NAME').val() +'></td>';

        if(index <= 9) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').append(cols);
        } else {
                newRow.append(cols);
                $("table tbody").append(newRow);
        }
        $('#record').html(index);
        
        keepItemData();
        return enrty();
    }
    else{
        validationDialog();
        return false;

    }
    });

    $(document).on('click', '#delete', function() {
        let id = $('#ROWNO').val();
        console.log(id);
        if(id != '') {
            document.getElementById("table").deleteRow(id);
            $('#rowId'+id).closest("tr").remove();
            if(index <= 5) {
                emptyRow(id);
            }
            index--;
            $(".row-id").each(function (i) {
                $(this).text(i+1);
            }); 
            $('#record').html(index);
            unsetItemData(id);
            changeRowId();
            id = null;
            return enrty();
        }
    });

    // document.getElementById("insert").disabled = false;
    // document.getElementById("update").disabled = true;
    // document.getElementById("delete").disabled = true;
    // document.getElementById("commit").disabled = false;

});

$('table#table tr').click(function () {
    $('table#table tr').removeAttr('id');

    $(this).attr('id', 'click-row');
   
    selectedRowIndex = $(this).index()+1;//////////
    localStorage.setItem('selectedRowIndex', selectedRowIndex);//////////
    // console.log(selectedRowIndex);///////////

    let item = $(this).closest('tr').children('td');

    item.each(function(index, element) {
     console.log("Index:", index, "Value:", $(element).text());
    });

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {

        $('#ROWNO').val(item.eq(0).text());
        $('#ITEMPSSNO').val(item.eq(1).text());
        document.getElementById("ITEMPSSTYP").value = item.eq(39).text();
        $('#ITEMPSSPLACE').val(item.eq(3).text());
        $('#PLACENAME').val(item.eq(4).text());
        $('#ITEMPSSJOBTYP').val(item.eq(6).text());
        $('#JOB_NAME').val(item.eq(7).text());
        $('#ITEMPSSDESC').val(item.eq(5).text());
        $('#ITEMIMGLOC').val(item.eq(45).text());
        $('#IMPSSADDBOARDQTY').val(item.eq(42).text());
        $('#IMPSSADDSPM').val(item.eq(43).text());
        $('#IMPSSADDUSAGE').val(item.eq(44).text());
        // $('#IMPSSADDOPE').val(item.eq(12).text());
        $('#ITEMPSSPLANQTY').val(item.eq(8).text());
        // document.getElementById("ITEMUNITTYP").value = item.eq(41).text();
        $('#ITEMPSSUNITPRC').val(item.eq(46).text());
        // $('#CURRENCYDISP').val(item.eq(16).text());
        $('#ITEMPSSPLANTIME').val(item.eq(9).text());
        document.getElementById("ITEMPSSPLANTIMETYP").value = item.eq(40).text();
        document.getElementById("ITEMPSSLINKTYP").value = item.eq(11).text();
        $('#ITEMPSSALLOWANCE').val(item.eq(12).text());

        document.getElementById("insert").disabled = true;
        document.getElementById("commit").disabled = false;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;

    }

    let ITEMPSSTYP = item.eq(39).text();
    if (ITEMPSSTYP !== undefined && ITEMPSSTYP !== '') {
        $("#SEARCHITEMPLACE").attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEMPLACE/index.php?ITEMPSSTYP=' + ITEMPSSTYP + '&page=PROCESSMASTER&_=' + new Date().getTime());
    }
    unRequired();
});

function unRequired() {

    let itemcd = document.getElementById("ITEMCD");
    let itemno = document.getElementById("ITEMPSSNO");
    let itemtyp = document.getElementById("ITEMPSSTYP");
    let itemplace = document.getElementById("ITEMPSSPLACE");
    let itemplanqty = document.getElementById("ITEMPSSPLANQTY");
    let itemplantime = document.getElementById("ITEMPSSPLANTIME");
    let itemlinktyp = document.getElementById("ITEMPSSLINKTYP");
    let itemallowance = document.getElementById("ITEMPSSALLOWANCE");

    itemcd.classList[itemcd.value !== '' ? 'remove' : 'add']('req');
    itemno.classList[itemno.value !== '' ? 'remove' : 'add']('req');
    itemtyp.classList[itemtyp.value !== '' ? 'remove' : 'add']('req');
    itemplace.classList[itemplace.value !== '' ? 'remove' : 'add']('req');
    itemplanqty.classList[itemplanqty.value !== '' ? 'remove' : 'add']('req');
    itemplantime.classList[itemplantime.value !== '' ? 'remove' : 'add']('req');
    itemlinktyp.classList[itemlinktyp.value !== '' ? 'remove' : 'add']('req');
    itemallowance.classList[itemallowance.value !== '' ? 'remove' : 'add']('req');

}

function clearItemplace() {

    $('#ITEMPSSPLACE').val('');
    $('#PLACENAME').val(''); 
    
}

function enrty() {

    $('table#table tr').removeAttr('id');
    var selectedRowIndex = localStorage.getItem('selectedRowIndex');
    $('table#table tr').eq(selectedRowIndex).removeAttr('id');
    localStorage.removeItem('selectedRowIndex');
    
    document.getElementById("insert").disabled = false;
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    document.getElementById("commit").disabled = false;

    $('#ROWNO').val('');
    $('#ITEMPSSNO').val('');
    $('#ITEMPSSTYP').val('');
    $('#ITEMPSSPLACE').val('');
    $('#PLACENAME').val('');
    $('#ITEMPSSJOBTYP').val('');
    $('#JOB_NAME').val('');
    $('#ITEMPSSDESC').val('');
    $('#ITEMIMGLOC').val('');
    $('#IMPSSADDBOARDQTY').val('');
    $('#IMPSSADDSPM').val('');
    $('#IMPSSADDUSAGE').val('');
    $('#IMPSSADDOPE').val('');
    $('#ITEMPSSPLANQTY').val('');
    $('#ITEMPSSUNITPRC').val('');
    $('#ITEMPSSPLANTIME').val('');
    $('#ITEMPSSLINKTYP').val('');
    $('#ITEMPSSALLOWANCE').val('');

    unRequired();
}

function validationDialog() {
    return Swal.fire({ 
        title: '',
        text: '<?=$lang['validation1']; ?>',
        background: '#8ca3a3',
        showCancelButton: false,
        confirmButtonColor: 'silver',
        cancelButtonColor: 'silver',
        confirmButtonText:  '<?=$lang['yes']; ?>',
        cancelButtonText: '<?=$lang['nono']; ?>'
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                window.location.href="/DMCS_WEBAPP";          
            }
        }
    });
}

</script>

</html>
