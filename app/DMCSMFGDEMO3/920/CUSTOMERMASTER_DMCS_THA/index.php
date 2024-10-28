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
    <form class="form" method="POST" id="customermaster" name="customermaster" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="col-md-12">
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['CUSTOMERCODE']; ?></label>
                    <input class="width20 req form-control" type="text" id="CUSTOMERCD" name="CUSTOMERCD"  
                    required <?php if(!empty($data['CUSTOMERCD'])){ ?> value="<?php echo $data['CUSTOMERCD']; ?>" <?php } else { ?> value="<?php echo isset($_GET['customercd']) ? $_GET['customercd']: ''; ?>" <?php }?> />
                    <div class="fix-icon">
                    <a href="#" id="searchcustomer"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    <label class="text-copy"><?php echo $data['TXTLANG']['INSERT_DATE']; ?></label>&nbsp;&nbsp;
                    <input type="date" id="CUSTOMERREGDT" name="CUSTOMERREGDT"  value="<?=!empty($data['CUSTOMERREGDT']) ? date('Y-m-d', strtotime($data['CUSTOMERREGDT'])): ''?>" />      
                </div>
                
                <div class="flex col-second"></div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['CUSTOMERNAME']; ?></label>
                    <input class="width43 req form-control" type="text" id="CUSTOMERNAME" name="CUSTOMERNAME"  value="<?=!empty($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''?>" required/>
                </div>                
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['SEARCH_CHAR']; ?></label>
                    <input class="width20 req form-control" type="text" id="CUSTOMERSEARCH" name="CUSTOMERSEARCH"  value="<?=!empty($data['CUSTOMERSEARCH']) ? $data['CUSTOMERSEARCH']: ''?>" required/>&emsp;&nbsp;
                </div>     
            </div>
            <!-- <br><br> -->

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['OWNPLACE']; ?></label>
                    &nbsp;&nbsp;&nbsp;
                    <label class="label-width30"><?php echo $data['TXTLANG']['COUNTRYCD']; ?></label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    <input class="width17 req form-control" type="text" id="COUNTRYCD" name="COUNTRYCD" 
                    required <?php if(!empty($data['COUNTRYCD'])){ ?> value="<?php echo $data['COUNTRYCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['countrycd']) ? $_GET['countrycd']: ''; ?>" <?php }?>/>
                  
                    <div class="fix-icon">
                        <a href="#" id="searchcountry"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="label-width24"><?php echo $data['TXTLANG']['STATECD']; ?></label>
                    <input class="width17 form-control" type="text" id="STATECD" name="STATECD" 
                     <?php if(!empty($data['STATECD'])){ ?> value="<?php echo $data['STATECD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['statecd']) ? $_GET['statecd']: ''; ?>" <?php }?>/>
                    <div class="fix-icon">
                    <a href="#" id="searchstate"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="label-width24"><?php echo $data['TXTLANG']['CITYCD']; ?></label>
                    <input class="width17 form-control" type="text" id="CITYCD" name="CITYCD"  
                     <?php if(!empty($data['CITYCD'])){ ?> value="<?php echo $data['CITYCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['citycd']) ? $_GET['citycd']: ''; ?>" <?php }?>/>
                    <div class="fix-icon">
                        <a href="#" id="searchcity"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="label-width24"><?php echo $data['TXTLANG']['CITYNAME']; ?></label>
                    <input class="width50 form-control" type="text" id="CITYNAME" name="CITYNAME"  value="<?=!empty($data['CITYNAME']) ? $data['CITYNAME']: ''?>" />
                </div>
                <div class="flex col-second"></div>
            </div>
            
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['ADDR']; ?></label>                    
                    <input class="width43 req form-control" type="text" id="CUSTOMERADDR1" name="CUSTOMERADDR1"  value="<?=!empty($data['CUSTOMERADDR1']) ? $data['CUSTOMERADDR1']: ''?>" required/>
                </div>
            
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['TEL']; ?></label>
                    <input class="width15 form-control" type="text" id="CUSTOMERTEL" name="CUSTOMERTEL"  value="<?=!empty($data['CUSTOMERTEL']) ? $data['CUSTOMERTEL']: ''?>" />
                    <label class="label-width22"><?php echo $data['TXTLANG']['FAX']; ?></label>
                    <input class="width22 form-control" type="text" id="CUSTOMERFAX" name="CUSTOMERFAX"  value="<?=!empty($data['CUSTOMERFAX']) ? $data['CUSTOMERFAX']: ''?>" />
                    <label class="label-width22"><?php echo $data['TXTLANG']['EMAIL']; ?></label>
                    <input class="width22 form-control" type="text" id="CUSTOMEREMAIL" name="CUSTOMEREMAIL"  value="<?=!empty($data['CUSTOMEREMAIL']) ? $data['CUSTOMEREMAIL']: ''?>" />
                </div>
                <div class="flex col-second">
                
                </div>
            </div>




          





            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['CUST_STAFF_NAME']; ?></label>
                    <input class="width43 form-control" type="text" id="CUSTOMERCONTACT" name="CUSTOMERCONTACT"  value="<?=!empty($data['CUSTOMERCONTACT']) ? $data['CUSTOMERCONTACT']: ''?>" />                   
                </div>                
            </div>




            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['TAXID']; ?></label>
                    <input class="width15 req form-control" type="text" id="CUSTOMERBKACCNO" name="CUSTOMERBKACCNO"  value="<?=!empty($data['CUSTOMERBKACCNO']) ? $data['CUSTOMERBKACCNO']: ''?>" required/>  
                </div>


                <div class="flex col-second">
                <label class="label-width22"><?php echo $data['TXTLANG']['HEADOFFICEBRANCH']; ?></label>
                <select class="width22 option-text form-select form-select-sm" id="CUSTOMERBKACCTYP" name="CUSTOMERBKACCTYP" >
                        <option value=""></option>
                        <?php foreach ($kbnbranch as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['CUSTOMERBKACCTYP']) && $data['CUSTOMERBKACCTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <input class="width22 req form-control" type="text" id="CUSTOMERBKACCNAME" name="CUSTOMERBKACCNAME"  value="<?=!empty($data['CUSTOMERBKACCNAME']) ? $data['CUSTOMERBKACCNAME']: ''?>" required/> 
                </div>
            </div>




            
        
            



            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['UNITPRICE_ACCURACY'];  ?></label>
                    <select class="width10 option-text form-select form-select-sm req" id="CUSTOMERUNITROUNDTYP" name="CUSTOMERUNITROUNDTYP" required>
                        <option value=""></option>
                        <?php foreach ($roun_d as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['CUSTOMERUNITROUNDTYP']) && $data['CUSTOMERUNITROUNDTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>    
                    <?php
                  //  print_r($data);
                    ?>
                    
                    <label class="label-width15" style="text-align: center;"><?php echo $data['TXTLANG']['AMOUNT_ACCURACY']; ?></label>
                    <select class="width10 option-text form-select form-select-sm req" id="CUSTOMERAMTROUNDTYP" name="CUSTOMERAMTROUNDTYP" required>
                        <option value=""></option>
                        <?php foreach ($roun_d1 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['CUSTOMERAMTROUNDTYP']) && $data['CUSTOMERAMTROUNDTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>  

                    
                    <label class="label-width15" style="text-align: center;"><?php echo $data['TXTLANG']['TAX_ROUND_TYPE']; ?></label>
                    <select class="width10 option-text form-select form-select-sm req" id="CUSTOMERTAXROUNDTYP" name="CUSTOMERTAXROUNDTYP" required>
                        <option value=""></option>
                        <?php foreach ($roun_d2 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['CUSTOMERTAXROUNDTYP']) && $data['CUSTOMERTAXROUNDTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>                   
                </div>                
            </div>


            


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['CU_CODE']; ?></label>                   
                    <input class="width15 req form-control" type="text" id="CURRENCYCD" name="CURRENCYCD"  
                    required <?php if(!empty($data['CURRENCYCD'])){ ?> value="<?php echo $data['CURRENCYCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['currencycd']) ? $_GET['currencycd']: ''; ?>" <?php }?>/>
                 
                    <div class="fix-icon">
                    <a href="#" id="searchcurrency"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                    <input type="checkbox" id="CUSTOMERSETOFFFLG" name="CUSTOMERSETOFFFLG" value="T" style="width: 15px"
                    <?php echo (!empty($data['CUSTOMERSETOFFFLG']) && $data['CUSTOMERSETOFFFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width15"><?php echo $data['TXTLANG']['STOP_SALES']; ?></label>


            

                    <input type="checkbox" id="CUSTOMERAFFILIATEFLG" name="CUSTOMERAFFILIATEFLG" value="T" style="width: 15px"
                    <?php echo (!empty($data['CUSTOMERAFFILIATEFLG']) && $data['CUSTOMERAFFILIATEFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width15"><?php echo $data['TXTLANG']['AFFILIATE']; ?></label>
                </div>
                <div class="flex col-second">
                <label class="label-width15"><?php echo $data['TXTLANG']['CLOSE_DAY']; ?></label>
                    <input class="width17 form-control" type="text" id="CUSTOMERCLOSEDAY" name="CUSTOMERCLOSEDAY"  value="<?=!empty($data['CUSTOMERCLOSEDAY']) ? $data['CUSTOMERCLOSEDAY']: ''?>" />
                    <label class="label-width15"><?php echo $data['TXTLANG']['DAY']; ?></label>
                    <label class="label-width15"><?php echo $data['TXTLANG']['RECEIVED_DAY']; ?></label>
                    <input class="width17 form-control" type="text" id="CUSTOMERRECDAY" name="CUSTOMERRECDAY"  value="<?=!empty($data['CUSTOMERRECDAY']) ? $data['CUSTOMERRECDAY']: ''?>" />
                    <label class="label-width27"><?php echo $data['TXTLANG']['DAY']; ?></label>
                </div>
                <!-- <div class="flex col-second"></div> -->
            </div>





           




            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['REMARK']; ?></label>
                <input class="width43 form-control" type="text" id="CUSTOMERREMARK" name="CUSTOMERREMARK"  value="<?=!empty($data['CUSTOMERREMARK']) ? $data['CUSTOMERREMARK']: ''?>" />
                   
                </div>
                <div class="flex col-second"></div>
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
