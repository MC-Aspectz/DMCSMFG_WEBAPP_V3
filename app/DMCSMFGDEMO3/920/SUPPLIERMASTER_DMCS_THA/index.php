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

    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/sweetalert2.min.js'; ?>" integrity="sha384-mngH0dsoMzHJ55nmFSRTjl5pdhgzHDeEoLOuZp2U28VrwCH0ieB9ntimtLbJm9KJ" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <title><?php echo $appname; ?></title>
</head>
<body>
    <!-- ---------------------------------------------------------------------------------->
    <!--  Menu -->
    <?php doMenu(); ?>
    <!-- ---------------------------------------------------------------------------------->
    <div class="container-fluid bg-primary" style="height: auto;">
        <div class="row justify-content-between">
            <div class="col-10">
                <p class="text-white" style="font-size: 1.2em; margin: 5px;"><?php echo $_SESSION['PACKNAME'] . ' > ' . $_SESSION['APPNAME']; ?></p>
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
    <form class="form" method="POST" id="suppliermaster" name="suppliermaster" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="col-md-12">
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['SUPPLIER_CODE']; ?></label>&nbsp;
                    <input class="width20 req form-control" type="text" id="SUPPLIERCD" name="SUPPLIERCD"  
                    required  value="<?php echo isset($data['SUPPLIERCD'])?$data['SUPPLIERCD']:''; ?>"  />
                    <div class="fix-icon">
                    <a href="#" id="searchsupplier"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    
                   
                    <label class="text-copy"><?php echo $data['TXTLANG']['INSERT_DATE']; ?></label><!--&nbsp;&nbsp;-->&emsp;
                    <input type="date" id="SUPPLIERREGDT" name="SUPPLIERREGDT"  value="<?=!empty($data['SUPPLIERREGDT']) ? date('Y-m-d', strtotime($data['SUPPLIERREGDT'])): ''?>" />    
                    </div>
                
                
                <!-- <div class="flex col-second"></div> -->
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['SUPPLIER_NAME']; ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="width43 req form-control" type="text" id="SUPPLIERNAME" name="SUPPLIERNAME"  value="<?=!empty($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''?>" required/>&nbsp;
                    <label class="label-width15"><?php echo $data['TXTLANG']['SEARCH_CHAR']; ?></label>
                    <input class="width20  form-control" type="text" id="SUPPLIERSEARCH" name="SUPPLIERSEARCH"  value="<?=!empty($data['SUPPLIERSEARCH']) ? $data['SUPPLIERSEARCH']: ''?>" />
                </div>                
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['TAXID']; ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="width20 req form-control" type="text" id="SUPPLIERSHORTNAME" name="SUPPLIERSHORTNAME"  value="<?=!empty($data['SUPPLIERSHORTNAME']) ? $data['SUPPLIERSHORTNAME']: ''?>" required/>&emsp;&nbsp;
                    <label class="label-width24"><?php echo $data['TXTLANG']['HEADOFFICEBRANCH']; ?></label>
                    <select class="width22 option-text form-select form-select-sm" id="FACTORYCODE" name="FACTORYCODE" >
                        <option value=""></option>
                        <?php foreach ($kbnbranch as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['FACTORYCODE']) && $data['FACTORYCODE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <input class="width20 req form-control" type="text" id="SUPPLIERADD01" name="SUPPLIERADD01" required value="<?=!empty($data['SUPPLIERADD01']) ? $data['SUPPLIERADD01']: ''?>" />
                  
                </div>     
            </div>
            <!-- <br><br> -->

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['OWNPLACE']; ?></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="label-width30"><?php echo $data['TXTLANG']['COUNTRYCD']; ?></label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
                    <input class="width17 req form-control" type="text" id="COUNTRYCD" name="COUNTRYCD" 
                    required <?php if(!empty($data['COUNTRYCD'])){ ?> value="<?php echo $data['COUNTRYCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['countrycd']) ? $_GET['countrycd']: ''; ?>" <?php }?>/>
                  
                    <div class="fix-icon">
                        <a href="#" id="searchcountry"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="label-width24"><?php echo $data['TXTLANG']['STATECD']; ?></label>
                    <input class="width17 req form-control" type="text" id="STATECD" name="STATECD" required
                     <?php if(!empty($data['STATECD'])){ ?> value="<?php echo $data['STATECD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['statecd']) ? $_GET['statecd']: ''; ?>" <?php }?>/>
                    <div class="fix-icon">
                    <a href="#" id="searchstate"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="label-width24"><?php echo $data['TXTLANG']['CITYCD']; ?></label>
                    <input class="width17 req form-control" type="text" id="CITYCD" name="CITYCD"required  
                     <?php if(!empty($data['CITYCD'])){ ?> value="<?php echo $data['CITYCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['citycd']) ? $_GET['citycd']: ''; ?>" <?php }?>/>
                    <div class="fix-icon">
                        <a href="#" id="searchcity"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="label-width24"><?php echo $data['TXTLANG']['CITYNAME']; ?></label>
                    <input class="width50 form-control" type="text" id="CITYNAME" name="CITYNAME"  value="<?=!empty($data['CITYNAME']) ? $data['CITYNAME']: ''?>"readonly />
                </div>
                <div class="flex col-second"></div>
            </div>
            



            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['POST_CODE']; ?></label>&nbsp;                    
                    <input class="width15  form-control" type="text" id="SUPPLIERZIPCODE" name="SUPPLIERZIPCODE"  value="<?=!empty($data['SUPPLIERZIPCODE']) ? $data['SUPPLIERZIPCODE']: ''?>" />
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['ADDR']; ?></label>&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    
                    <input class="width43  form-control" type="text" id="SUPPLIERADDR1" name="SUPPLIERADDR1"  value="<?=!empty($data['SUPPLIERADDR1']) ? $data['SUPPLIERADDR1']: ''?>" />
                    <input class="width43  form-control" type="text" id="SUPPLIERADDR2" name="SUPPLIERADDR2"  value="<?=!empty($data['SUPPLIERADDR2']) ? $data['SUPPLIERADDR2']: ''?>" />
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['TEL']; ?></label>&nbsp;
                    <input class="width15 form-control" type="text" id="SUPPLIERTEL" name="SUPPLIERTEL"  value="<?=!empty($data['SUPPLIERTEL']) ? $data['SUPPLIERTEL']: ''?>" />
                    <label class="label-width22"><?php echo $data['TXTLANG']['FAX']; ?></label>&emsp;
                    <input class="width22 form-control" type="text" id="SUPPLIERFAX" name="SUPPLIERFAX"  value="<?=!empty($data['SUPPLIERFAX']) ? $data['SUPPLIERFAX']: ''?>" />
                   
                </div>
                <div class="flex col-second">
                
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['EMAIL']; ?></label>&nbsp;
                <input class="width22 form-control" type="text" id="SUPPLIEREMAIL" name="SUPPLIEREMAIL"  value="<?=!empty($data['SUPPLIEREMAIL']) ? $data['SUPPLIEREMAIL']: ''?>" />                  
                </div>  
                <div class="flex col-second">
                    <label class="text-copy"><?php echo $data['TXTLANG']['SUPPLIER_STAFF_NAME']; ?></label><!--&nbsp;&nbsp;-->
                    <input class="width20  form-control" type="text" id="SUPPLIERCONTACT" name="SUPPLIERCONTACT"  value="<?=!empty($data['SUPPLIERCONTACT']) ? $data['SUPPLIERCONTACT']: ''?>" />   
                </div>               
            </div>


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['BANK_CODE']; ?></label>&nbsp;
                <input class="width22 form-control" type="text" id="BANKNAME" name="BANKNAME"  value="<?=!empty($data['BANKNAME']) ? $data['BANKNAME']: ''?>" />                  
                </div>  
                <div class="flex col-second">
                    <label class="text-copy"><?php echo $data['TXTLANG']['BRANCH_NAME']; ?></label><!--&nbsp;&nbsp;-->
                    <input class="width20  form-control" type="text" id="BRANCHNAME" name="BRANCHNAME"  value="<?=!empty($data['BRANCHNAME']) ? $data['BRANCHNAME']: ''?>" />   
                </div>               
            </div>



            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['BANK_ACC_TYPE']; ?></label>&nbsp;
                <select class="width22 option-text form-select form-select-sm" id="SUPPLIERBKACCTYP" name="SUPPLIERBKACCTYP" >
                        <option value=""></option>
                        <?php foreach ($bkacctype as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['SUPPLIERBKACCTYP']) && $data['SUPPLIERBKACCTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <label class="text-copy"><?php echo $data['TXTLANG']['BANK_ACC_NO']; ?></label><!--&nbsp;&nbsp;-->
                    <input class="width20  form-control" type="text" id="SUPPLIERBKACCNO" name="SUPPLIERBKACCNO"  value="<?=!empty($data['SUPPLIERBKACCNO']) ? $data['SUPPLIERBKACCNO']: ''?>" />               
                </div>  

                <div class="flex col-second">
                    <label class="text-copy"><?php echo $data['TXTLANG']['NOMINAL_PERSON']; ?></label><!--&nbsp;&nbsp;-->
                    <input class="width20  form-control" type="text" id="SUPPLIERBKACCNAME" name="SUPPLIERBKACCNAME"  value="<?=!empty($data['SUPPLIERBKACCNAME']) ? $data['SUPPLIERBKACCNAME']: ''?>" />   
                </div>               
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['UNITPRICE_ACCURACY']; ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select class="width22 req option-text form-select form-select-sm" id="SUPPLIERUNITROUNDTYP" name="SUPPLIERUNITROUNDTYP" required>
                        <option value=""></option>
                        <?php foreach ($roun_d1 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['SUPPLIERUNITROUNDTYP']) && $data['SUPPLIERUNITROUNDTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <label class="label-width20"><?php echo $data['TXTLANG']['AMOUNT_ACCURACY']; ?></label>  
                    <select class="width22 req option-text form-select form-select-sm" id="SUPPLIERAMTROUNDTYP" name="SUPPLIERAMTROUNDTYP" required>
                        <option value=""></option>
                        <?php foreach ($roun_d2 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['SUPPLIERAMTROUNDTYP']) && $data['SUPPLIERAMTROUNDTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                     <label class="label-width20"><?php echo $data['TXTLANG']['TAX_ROUND_TYPE']; ?></label>  
                    <select class="width22 req option-text form-select form-select-sm" id="SUPPLIERTAXROUNDTYP" name="SUPPLIERTAXROUNDTYP" required>
                        <option value=""></option>
                        <?php foreach ($roun_d3 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['SUPPLIERTAXROUNDTYP']) && $data['SUPPLIERTAXROUNDTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                </div>
            </div>







            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['PAY_TSCODE']; ?></label>
                <input class="width17  form-control" type="text" id="SUPBILLCD" name="SUPBILLCD"   
                     <?php if(!empty($data['SUPBILLCD'])){ ?> value="<?php echo $data['SUPBILLCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['supbillcd']) ? $_GET['supbillcd']: ''; ?>" <?php }?>/>
                     <div class="fix-icon">
                    <a href="#" id="searchsupplier1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <input class="width30 form-control" type="text" id="SUPBILLNAME" name="SUPBILLNAME"  value="<?=!empty($data['SUPBILLNAME']) ? $data['SUPBILLNAME']: ''?>"readonly />  
                </div>
             </div>

                <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['CU_CODE']; ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;
                <input class="width15 req form-control" type="text" id="CURRENCYCD" name="CURRENCYCD"  
                 required <?php if(!empty($data['CURRENCYCD'])){ ?> value="<?php echo $data['CURRENCYCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['currencycd']) ? $_GET['currencycd']: ''; ?>" <?php }?>/>
                 <div class="fix-icon">
               <a href="#" id="searchcurrency"><img style="img-height20" src="../../../../img/search.png"></a>
               </div>      &emsp;&emsp;&emsp;
               
               
                <label class="label-width15"><?php echo $data['TXTLANG']['PAY_DAY']; ?></label>
                    <input class="width10 form-control" type="text" id="SUPPLIERRECDAY" name="SUPPLIERRECDAY"  value="<?=!empty($data['SUPPLIERRECDAY']) ? $data['SUPPLIERRECDAY']: ''?>" />
                    <label class="label-width15"><?php echo $data['TXTLANG']['DAY']; ?></label>&nbsp;&nbsp;&nbsp;  

                    <label class="label-width15"><?php echo $data['TXTLANG']['CLOSE_DAY']; ?></label>
                    <input class="width10 form-control" type="text" id="SUPPLIERCLOSEDAY" name="SUPPLIERCLOSEDAY"  value="<?=!empty($data['SUPPLIERCLOSEDAY']) ? $data['SUPPLIERCLOSEDAY']: ''?>" />
                    <label class="label-width15"><?php echo $data['TXTLANG']['DAY']; ?></label>
                    </div>
                <!-- <div class="flex col-second"></div> -->
                  </div>


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['REMARK']; ?></label>
                <input class="width43 form-control" type="text" id="SUPPLIERREMARK" name="SUPPLIERREMARK"  value="<?=!empty($data['SUPPLIERREMARK']) ? $data['SUPPLIERREMARK']: ''?>" />
           </div>
           <div class="flex col-second"></div>
                
            </div>



            <div class="flex">
                <div class="flex col-first">
            &emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;
            &emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;
            &emsp13;&emsp13;
                        
                <input type="checkbox" id="SUPPLIEROFFFLG" name="SUPPLIEROFFFLG" value="T" style="width: 15px"
                    <?php echo (!empty($data['SUPPLIEROFFFLG']) && $data['SUPPLIEROFFFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width15"><?php echo $data['TXTLANG']['STOP_PURCHASE']; ?></label>
                    <input type="checkbox" id="SUPPLIERAFFILIATEFLG" name="SUPPLIERAFFILIATEFLG" value="T" style="width: 15px"
                    <?php echo (!empty($data['SUPPLIERAFFILIATEFLG']) && $data['SUPPLIERAFFILIATEFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width15"><?php echo $data['TXTLANG']['AFFILIATE']; ?></label>
                </div>
                
            </div>
                </div>
                        
           
            <div class="flex footer">
            <div class="flex footer">
                <div class="flex col-first">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="insert" name="insert" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['INSERT'];?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="delete" name="delete" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?></button>
                </div>
                <div class="flex col-second" style="justify-content: right;">
                <button type="reset" id="clear" name="clear" onclick="unsetSession(this.form);" class="btn btn-outline-secondary btn-action"><?php echo $data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp;
                    <button type="button" id="end" class="btn btn-outline-secondary btn-action"><?php echo $data['TXTLANG']['END']; ?></button>
                </div>
            </div>
        </div>
    </form>
    <div id="loading" class="on" style="display: none;">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
</body>
<script type="text/javascript">
    $("#end").on('click', function() {
        Swal.fire({ 
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
                    window.location.href="/DMCS_WEBAPP";
            }
        });
    });

    function alertValidation() {
        Swal.fire({ 
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
<script src="./js/script.js"></script>
</html>
