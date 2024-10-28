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
    <form class="form" method="POST" id="companymaster" name="companymaster" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="col-md-12">
            <div class="flex">
                <div class="flex col-first">
                    
                    <label class="label-width27"><?php echo $data['TXTLANG']['COMPANY_NAME_TH']; ?></label>
                    <input class="width43  form-control" type="text" id="NAME" name="NAME"  <?php if(isset($data['NAME'])) { ?> value = "<?=$data['NAME']?>" <?php  } else {
                        if(isset($data['cpn']['NAME'])) { ?> value = "<?=$data['cpn']['NAME']?>" <?php  } else { ?> value = "" <?php } }?> required/>
                                      
                </div>
                <!-- <div class="flex col-second"></div> -->
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['COMPANY_NAME']; ?></label>
                    <input class="width43  form-control" type="text" id="KANA" name="KANA" 
                    <?php if(isset($data['KANA'])) { ?> value = "<?=$data['KANA']?>" <?php  } else {
                        if(isset($data['cpn']['KANA'])) { ?> value = "<?=$data['cpn']['KANA']?>" <?php  } else { ?> value = "" <?php } }?> />

                </div>                
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['POST_CODE']; ?></label>
                    <input class="width15  form-control" type="text" id="POSTCD" name="POSTCD"  
                    <?php if(isset($data['POSTCODE'])) { ?> value = "<?=$data['POSTCODE']?>" <?php  } else {
                        if(isset($data['cpn']['POSTCODE'])) { ?> value = "<?=$data['cpn']['POSTCODE']?>" <?php  } else { ?> value = "" <?php } }?> />
                    
                   
                </div>     
            </div>
            <!-- <br><br> -->

            <div class="flex">
                <div class="flex col-first">                   
                  
                    <label class="label-width27"><?php echo $data['TXTLANG']['ADDRTH']; ?></label>
                    <input class="width70  form-control" type="text" id="ADDR1" name="ADDR1" 
                    <?php if(isset($data['ADDR1'])) { ?> value = "<?=$data['ADDR1']?>" <?php  } else {
                        if(isset($data['cpn']['ADDR1'])) { ?> value = "<?=$data['cpn']['ADDR1']?>" <?php  } else { ?> value = "" <?php } }?> />
                 
                </div>
                <!-- <div class="flex col-second"></div> -->
            </div>
            
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['ADDR']; ?></label>     
                    <input class="width70  form-control" type="text" id="ADDR2" name="ADDR2"  
                    <?php if(isset($data['ADDR2'])) { ?> value = "<?=$data['ADDR2']?>" <?php  } else {
                        if(isset($data['cpn']['ADDR2'])) { ?> value = "<?=$data['cpn']['ADDR2']?>" <?php  } else { ?> value = "" <?php } }?> />
                    
                    
                           
                </div>
            
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['COUNTRY']; ?></label>
                <input class="width17 req form-control" type="text" id="COUNTRYCD" name="COUNTRYCD" 
                <?php if(isset($data['COUNTRYCD'])) { ?> value = "<?=$data['COUNTRYCD']?>" <?php  } else {
                        if(isset($data['cpn']['COUNTRYCD'])) { ?> value = "<?=$data['cpn']['COUNTRYCD']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchcountry"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&nbsp;&nbsp;&nbsp;
                    <input class="width20  form-control" type="text" id="COUNTRY" name="COUNTRY"  
                    <?php if(isset($data['COUNTRY'])) { ?> value = "<?=$data['COUNTRY']?>" <?php  } else {
                        if(isset($data['cpn']['COUNTRY'])) { ?> value = "<?=$data['cpn']['COUNTRY']?>" <?php  } else { ?> value = "" <?php } }?>readonly />
                     
                </div>
                <div class="flex col-second"></div>               
            </div>





            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['EMAIL']; ?></label>
                    <input class="width30  form-control" type="text" id="HPADDR" name="HPADDR"  
                    <?php if(isset($data['HPADDR'])) { ?> value = "<?=$data['HPADDR']?>" <?php  } else {
                        if(isset($data['cpn']['HPADDR'])) { ?> value = "<?=$data['cpn']['HPADDR']?>" <?php  } else { ?> value = "" <?php } }?> />
                    
                  
                </div>                
            </div>




            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['TEL']; ?></label>
                <input class="width25  form-control" type="text" id="TEL" name="TEL"  
                <?php if(isset($data['HPADDR'])) { ?> value = "<?=$data['TEL']?>" <?php  } else {
                        if(isset($data['cpn']['TEL'])) { ?> value = "<?=$data['cpn']['TEL']?>" <?php  } else { ?> value = "" <?php } }?> />
                
                
                </div>
                <div class="flex col-second">
                               
                <label class="label-width27"><?php echo $data['TXTLANG']['FOB4']; ?></label>
                <input class="width25  form-control" type="text" id="FOB4" name="FOB4"  
                <?php if(isset($data['FOB4'])) { ?> value = "<?=$data['FOB4']?>" <?php  } else {
                        if(isset($data['cpn']['FOB4'])) { ?> value = "<?=$data['cpn']['FOB4']?>" <?php  } else { ?> value = "" <?php } }?> />
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['FAX']; ?></label>
                <input class="width25  form-control" type="text" id="FAX" name="FAX"  
                <?php if(isset($data['FAX'])) { ?> value = "<?=$data['FAX']?>" <?php  } else {
                        if(isset($data['cpn']['FAX'])) { ?> value = "<?=$data['cpn']['FAX']?>" <?php  } else { ?> value = "" <?php } }?> />
                
                </div>
                <div class="flex col-second">
                <label class="label-width27"><?php echo $data['TXTLANG']['BRANCHTYPE']; ?></label>
                <input class="width25  form-control" type="text" id="COMBRANCH" name="COMBRANCH"  
                <?php if(isset($data['COMBRANCH'])) { ?> value = "<?=$data['COMBRANCH']?>" <?php  } else {
                        if(isset($data['cpn']['COMBRANCH'])) { ?> value = "<?=$data['cpn']['COMBRANCH']?>" <?php  } else { ?> value = "" <?php } }?> />
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['REPRENT']; ?></label>
                <input class="width25  form-control" type="text" id="REPRESENTATIVE" name="REPRESENTATIVE"  
                <?php if(isset($data['REPRESENTATIVE'])) { ?> value = "<?=$data['REPRESENTATIVE']?>" <?php  } else {
                        if(isset($data['cpn']['REPRESENTATIVE'])) { ?> value = "<?=$data['cpn']['REPRESENTATIVE']?>" <?php  } else { ?> value = "" <?php } }?> />
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['REP_NAME']; ?></label>
                <input class="width25  form-control" type="text" id="REP_NAME" name="REP_NAME"  
                <?php if(isset($data['REP_NAME'])) { ?> value = "<?=$data['REP_NAME']?>" <?php  } else {
                        if(isset($data['cpn']['REP_NAME'])) { ?> value = "<?=$data['cpn']['REP_NAME']?>" <?php  } else { ?> value = "" <?php } }?> />
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['CLOSE_MONTH']; ?></label>
                <select class="width22 option-text form-select form-select-sm" id="M_SET" name="M_SET" >


              

                
                        <option value=""></option>
                        <?php foreach ($monthvalue as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpn']['M_SET']) && $data['cpn']['M_SET'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="flex col-second">
                <button type="button" id="setacc"  class="button"><?php echo $data['TXTLANG']['SETACCYEARVAL']; ?></button>
            </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['CLOSEDAY']; ?></label>
                <input class="width10  form-control" type="text" id="D_SET" name="D_SET"  
                <?php if(isset($data['D_SET'])) { ?> value = "<?=$data['D_SET']?>" <?php  } else {
                        if(isset($data['cpn']['D_SET'])) { ?> value = "<?=$data['cpn']['D_SET']?>" <?php  } else { ?> value = "" <?php } }?> />
                    <label class="label-width15"><?php echo $data['TXTLANG']['DAY'];  ?></label>
                    <label class="label-width45"><?php echo $data['TXTLANG']['COM_MSG1']; ?></label>
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['CU_CODE']; ?></label>
                <input class="width15 form-control" type="text" id="CURRENCYCD" name="CURRENCYCD" 
                <?php if(isset($data['CURRENCY'])) { ?> value = "<?=$data['CURRENCY']?>" <?php  } else {
                        if(isset($data['cpn']['CURRENCY'])) { ?> value = "<?=$data['cpn']['CURRENCY']?>" <?php  } else { ?> value = "" <?php } }?> />
                  <div class="fix-icon">
                    <a href="#" id="searchcurrency"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                     <input class="width10  form-control" type="text" id="CURDISP" name="CURDISP"  
                     <?php if(isset($data['CURDISP'])) { ?> value = "<?=$data['CURDISP']?>" <?php  } else {
                   if(isset($data['cpn']['CURDISP'])) { ?> value = "<?=$data['cpn']['CURDISP']?>" <?php  } else { ?> value = "" <?php } }?> readonly/>                                        
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['EMPLOYEE_NUM']; ?></label>
                <input class="width10  form-control" type="text" id="EMPLOYEE_NUM" name="EMPLOYEE_NUM" 
                <?php if(isset($data['EMPLOYEE_NUM'])) { ?> value = "<?=$data['EMPLOYEE_NUM']?>" <?php  } else {
                        if(isset($data['cpn']['EMPLOYEE_NUM'])) { ?> value = "<?=$data['cpn']['EMPLOYEE_NUM']?>" <?php  } else { ?> value = "" <?php } }?> />
                <label class="label-width15"><?php echo $data['TXTLANG']['NUM_MAN']; ?></label>    
                </div>
            </div>
            
            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['CAPITAL']; ?></label>
                <input class="width17  form-control" type="text" id="CAPITAL" name="CAPITAL"  
                <?php if(isset($data['CAPITAL'])) { ?> value = "<?=$data['CAPITAL']?>" <?php  } else {
                        if(isset($data['cpn']['CAPITAL'])) { ?> value = "<?=$data['cpn']['CAPITAL']?>" <?php  } else { ?> value = "" <?php } }?> />
                <input class="width10  form-control" type="text" id="CURDISP" name="CURDISP" 
                <?php if(isset($data['CURDISP'])) { ?> value = "<?=$data['CURDISP']?>" <?php  } else {
                        if(isset($data['cpn']['CURDISP'])) { ?> value = "<?=$data['cpn']['CURDISP']?>" <?php  } else { ?> value = "" <?php } }?>readonly />
                </div>
            </div>






           
            <div class="flex footer">
                <div class="flex col-first">

                


                <button type="button" class="btn btn-outline-secondary btn-action" id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') { }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?></button>&emsp;&emsp;         
               </div>


                <div class="flex col-second" style="justify-content: right;">
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
