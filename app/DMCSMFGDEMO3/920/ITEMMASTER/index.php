
<?php 
    require_once('./function/index_x.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/sweetalert2.min.css'; ?>">

    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>" integrity="sha384-acDbhlvH9DufvmCPyS1tyL7yeN0gBK4eOA4kh7+XrtCoCSp9/1NtYoxVTq9MZRy0" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/sweetalert2.min.js'; ?>" integrity="sha384-mngH0dsoMzHJ55nmFSRTjl5pdhgzHDeEoLOuZp2U28VrwCH0ieB9ntimtLbJm9KJ" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <title><?=$_SESSION['APPNAME']; ?></title>
</head>
<body>
    <!-- ---------------------------------------------------------------------------------->
    <!--  Menu -->
    <?php doMenu(); ?>
    <!-- ---------------------------------------------------------------------------------->
    <div class="container-fluid bg-primary" style="height: auto;">
        <div class="row justify-content-between">
            <div class="col-8">
                <p class="text-white" style="font-size: 1.0em; margin: 0.1em;"><?php echo $_SESSION['PACKNAME'] . ' > ' . $_SESSION['APPNAME']; ?></p>
            </div>
            <div class="col-2 text-end align-middle">
                <a href="<?php echo $_SESSION['APPURL'] . '/home.php'; ?>" id="CLOSEPAGE">
                    <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
                    <p class="text-white" style="font-size: 1.0em; margin: 0.1em;">[ <?php echo $lang['close']; ?> ]</p>
                </a>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------- -->
    <!-- action="./function/item_master_x.php" -->
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <form class="form" method="POST" id="itemmaster" name="itemmaster" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="col-md-12">
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('ITEMCODE'); ?></label>
                    <input class="width20 req form-control" type="text" id="ITEMCD" name="ITEMCD" required onchange="unRequired();" <?php if(!empty($data['ITEMCD'])){ ?> value="<?php echo $data['ITEMCD']; ?>" <?php } else { ?> value="<?php echo isset($_GET['itemcd']) ? $_GET['itemcd']: ''; ?>" <?php }?> />
                    <div class="fix-icon">
                        <a href="#" id="searchitem"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                    </div>
                    <label class="text-copy"><?=checklang('CLONE'); ?></label>
                    <div class="fix-icon">
                        <a href="#" id="searchboi"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                    </div>
                    <label class="label-width15" style="text-align: center;"><?=checklang('BOI_PRJCD'); ?></label>&emsp;
                    <input class="width17 form-control" type="text" id="ITEMBOI" name="ITEMBOI" value="" <?php if(!empty($data['ITEMBOI'])){ ?> value="<?php echo $data['ITEMBOI']; ?>" <?php } else { ?> value="" <?php }?> />
                </div>
                <div class="flex col-second"></div>
            </div>
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('ITEMNAME'); ?></label>
                    <input class="width70 form-control" type="text" id="ITEMNAME" name="ITEMNAME" <?php if(!empty($data['ITEMNAME'])){ ?> value="<?php echo $data['ITEMNAME']; ?>" <?php } else { ?> value="" <?php }?>/>
                </div>
                <div class="flex col-second">
                    <label class="label-width27"><?=checklang('SEARCH_CHAR'); ?></label>
                    <input class="width75 req form-control" type="text" id="ITEMSEARCH" name="ITEMSEARCH" required onchange="unRequired();" <?php if(!empty($data['ITEMSEARCH'])){ ?> value="<?php echo $data['ITEMSEARCH']; ?>" <?php } else { ?> value="" <?php }?> />
                </div>
            </div>
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('SPECIFICATE'); ?></label>
                    <input class="width70 form-control" type="text" id="ITEMSPEC" name="ITEMSPEC" <?php if(!empty($data['ITEMSPEC'])){ ?> value="<?php echo $data['ITEMSPEC']; ?>"<?php } else { ?> value="" <?php }?>/>&emsp;&nbsp;
                </div>
                <div class="flex col-second">
                    <label class="label-width27"><?=checklang('IM_TYPE'); ?></label>
                    <select class="width24 option-text form-select form-select-sm req" id="ITEMTYP" name="ITEMTYP" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($typeItem as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMTYP']) && $data['ITEMTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <label class="label-width27" style="text-align: center;"><?=checklang('BOI_TYPE'); ?></label>
                    <select class="width24 option-text form-select form-select-sm"id="ITEMBOITYP" name="ITEMBOITYP">
                        <option value=""></option>
                        <?php foreach ($typeboi as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMBOITYP']) && $data['ITEMBOITYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br><br>
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('CATEGORY_CODE'); ?></label>
                    <input class="width20 req form-control" type="text" id="CATALOGCD" name="CATALOGCD" onchange="unRequired();" required <?php if(!empty($data['CATALOGCD'])){ ?> value="<?php echo $data['CATALOGCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['categorycd']) ? $_GET['categorycd']: ''; ?>" <?php }?>/>
                    <div class="fix-icon" style="right: -20px;">
                        <a href="#" id="searchcategory"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                    </div>&emsp;
                    <input class="width43 form-control" type="text" id="CATALOGNAME" name="CATALOGNAME" <?php if(!empty($data['CATALOGNAME'])){ ?> value="<?php echo $data['CATALOGNAME']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                </div>
                <div class="flex col-second">
                    <label class="label-width27"><?=checklang('WHTAXTYP'); ?></label>
                    <select class="width26 option-text form-select form-select-sm" id="ITEMMAKERTYP" name="ITEMMAKERTYP">
                        <option value=""></option>
                         <?php foreach ($whtaxtyp as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMMAKERTYP']) && $data['ITEMMAKERTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('MEASURE_UNIT'); ?></label>
                    <select class="width24 option-text form-select form-select-sm req" id="ITEMUNITTYP" name="ITEMUNITTYP" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($unit as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <label class="label-width15" style="text-align: center;"><?php echo $lang['po_unit']; ?></label>
                    <select class="width15 option-text form-select form-select-sm req" id="ITEMPOUNITTYP" name="ITEMPOUNITTYP" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($unit as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMPOUNITTYP']) && $data['ITEMPOUNITTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>&emsp;
                    <input class="width10 form-control req" type="text" id="ITEMPOUNITRATE" name="ITEMPOUNITRATE" onchange="unRequired();" required <?php if(!empty($data)){ ?> value="0.00"<?php } else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                </div>
                <div class="flex col-second">
                <label class="label-width27"><?=checklang('PRDER_RULE'); ?></label>
                <select class="width26 option-text form-select form-select-sm req" id="ITEMORDRULETYP" name="ITEMORDRULETYP" onchange="unRequired();" required>
                    <option value=""></option>
                    <?php foreach ($itemOrder as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMORDRULETYP']) && $data['ITEMORDRULETYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('SUPPLIER_CODE'); ?></label>
                    <input class="width20 form-control" type="text" id="SUPPLIERCD" name="SUPPLIERCD" <?php if(!empty($data['SUPPLIERCD'])){ ?> value="<?php echo $data['SUPPLIERCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['suppliercd']) ? $_GET['suppliercd']: ''; ?>" <?php }?> />
                    <div class="fix-icon" style="right: -20px;">
                        <a href="#" id="searchsupplier"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                    </div>&emsp;
                    <input class="width43 form-control" type="text" id="SUPPLIERNAME" name="SUPPLIERNAME" <?php if(!empty($data['SUPPLIERNAME'])){ ?> value="<?php echo $data['SUPPLIERNAME']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                </div>
                <div class="flex col-second"></div>
            </div>
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('STRAGE_CODE'); ?></label>
                    <input class="width20 req form-control" type="text" id="STORAGECD" name="STORAGECD" onchange="unRequired();" required <?php if(!empty($data['STORAGECD'])){ ?> value="<?php echo $data['STORAGECD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['locationcd']) ? $_GET['locationcd']: ''; ?>" <?php }?> />
                    <div class="fix-icon" style="right: -20px;">
                        <a href="#" id="searchlocation"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                    </div>&emsp;
                    <input class="width30 form-control" type="text" id="STORAGENAME" name="STORAGENAME" <?php if(!empty($data['STORAGENAME'])){ ?> value="<?php echo $data['STORAGENAME']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                </div>
                <div class="flex col-second"></div>
            </div>
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('LEADTIME'); ?></label>
                    <input class="width10 req form-control" type="text" id="ITEMLEADTIME" name="ITEMLEADTIME" onchange="unRequired();" required <?php if(!empty($data['ITEMLEADTIME'])){ ?> value="<?php echo number_format($data['ITEMLEADTIME'], 0); ?>"<?php } else { ?> value="" <?php }?> oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>&emsp;
                    <label class="label-width27"><?=checklang('DAYS'); ?></label>
                </div>
                <div class="flex col-second"></div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('UNITPRICE_INV'); ?></label>
                    <input class="width17 form-control" type="text" id="ITEMINVPRICE" name="ITEMINVPRICE" <?php if(!empty($data['ITEMINVPRICE'])){ ?> value="<?php echo number_format($data['ITEMINVPRICE'], 2); ?>"<?php } else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <label class="text-thb"><?php echo $lang['thb']; ?></label>
                    <label class="label-width24" style="text-align: center;"><?=checklang('PURCHASE_PRICE'); ?></label>
                    <input class="width17 form-control" type="text" id="ITEMSTDPURPRICE" name="ITEMSTDPURPRICE" <?php if(!empty($data['ITEMSTDPURPRICE'])){ ?> value="<?php echo number_format($data['ITEMSTDPURPRICE'], 2); ?>"<?php } else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <label class="text-thb"><?php echo $lang['thb']; ?></label>
                </div>
                <div class="flex col-second">
                    <label class="label-width27"><?=checklang('SALES_PRICE'); ?></label>
                    <input class="width17 form-control" type="text" id="ITEMSHOPPRICE" name="ITEMSHOPPRICE" <?php if(!empty($data['ITEMSHOPPRICE'])){ ?> value="<?php echo number_format($data['ITEMSHOPPRICE'],2); ?>"<?php } else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <label class="text-thb" ><?php echo $lang['thb']; ?></label>
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('FIXED_ORDER'); ?></label>
                    <input class="width22 form-control" type="text" id="ITEMFIXORDER" name="ITEMFIXORDER" <?php if(!empty($data['ITEMFIXORDER'])){ ?> value="<?php echo number_format($data['ITEMFIXORDER'], 2); ?>"<?php } else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <label class="label-width24" style="text-align: center;"><?=checklang('MIN_ORDER'); ?></label>
                    <input class="width22 form-control" type="text" id="ITEMMINORDER" name="ITEMMINORDER" <?php if(!empty($data['ITEMMINORDER'])){ ?> value="<?php echo number_format($data['ITEMMINORDER'], 2); ?>"<?php } else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                </div>
                <div class="flex col-second">
                    <label class="label-width27"><?=checklang('BUFFER_STOCK'); ?></label>
                    <input class="width22 form-control" type="text" id="ITEMMINSTOCK" name="ITEMMINSTOCK" <?php if(!empty($data['ITEMMINSTOCK'])){ ?> value="<?php echo number_format($data['ITEMMINSTOCK'], 2); ?>"<?php } else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"></label>
                    <input type="checkbox" id="fifo_list" id="ITEMFIFOLISTFLG" name="ITEMFIFOLISTFLG" value="T" style="width: 15px"
                    <?php echo (!empty($data['ITEMFIFOLISTFLG']) && $data['ITEMFIFOLISTFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width15"><?=checklang('FIFO_LIST'); ?></label>
                </div>
                <div class="flex col-second"></div>
            </div>

             <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?=checklang('INVCALCTYP'); ?></label>
                    <select class="width30 option-text form-select form-select-sm" id="ITEMINVCALCTYP" name="ITEMINVCALCTYP">
                        <option value=""></option>
                        <?php foreach ($invcalc as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMINVCALCTYP']) && $data['ITEMINVCALCTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="flex col-second"></div>
            </div>
            
            <div class="flex footer">
                <div class="flex col-first">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="insert" name="insert" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?=checklang('INSERT');?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="delete" name="delete" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?=checklang('DELETE'); ?></button>
                </div>
                <div class="flex col-second" style="justify-content: right;">
                    <button type="reset" id="clear" name="clear" onclick="unsetSession(this.form);" class="btn btn-outline-secondary btn-action"><?=checklang('CLEAR'); ?></button>&emsp;&emsp;
                    <button type="button" id="end" class="btn btn-outline-secondary btn-action"><?=checklang('END'); ?></button>
                </div>
            </div>
        </div>
    </form>
    <div id="loading" class="on" style="display: none;">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <footer>
        <p class="text-black" style="font-size: 0.8em;"><?php echo 'URL : ' . $_SESSION['HOST'] . ' | Company : ' . $_SESSION['COMCD'] . ' | User : ' . $_SESSION['USERCODE']; ?></p>
    </footer>
</body>
<script type="text/javascript">
    $(document).ready(function() {
      unRequired();
    });

    $("#end").on('click', function() {
        return Swal.fire({ 
            title: '',
            text: '<?=$lang['question1']; ?>',
            background: '#8ca3a3',
            showCancelButton: true,
            confirmButtonColor: 'silver',
            cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                    programDelete();
                    window.location.href="/DMCS_WEBAPP";
            }
        });
    });

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=$lang['validation1']; ?>',
            background: '#8ca3a3',
            showCancelButton: false,
            confirmButtonColor: 'silver',
            cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }
</script>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-A3vXOKIrkMcrKsobnbxRhUvBm4TBNCUoP7PyO022w/8qTRX5Bw2m65sn3gEGXTUw" crossorigin="anonymous"></script> -->
</html>
