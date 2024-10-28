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
    <form class="form" method="POST" id="staffmaster" name="staffmaster" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="col-md-12">
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['PERSON_RESPONSE']; ?></label>
                    <input class="width20 req form-control" type="text" id="STAFFCD" name="STAFFCD"  
                    required <?php if(!empty($data['STAFFCD'])){ ?> value="<?php echo $data['STAFFCD']; ?>" <?php } else { ?> value="<?php echo isset($_GET['staffcd']) ? $_GET['staffcd']: ''; ?>" <?php }?> />
                    <div class="fix-icon">
                    <a href="#" id="searchstaff"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    <label class="text-copy"><?php echo $data['TXTLANG']['PASSWORD']; ?></label>&nbsp;&nbsp;
                    <input class="width20 req form-control" type="text" id="STAFFPWD" name="STAFFPWD"  value="<?=!empty($data['STAFFPWD']) ? $data['STAFFPWD']: ''?>" required/>
                    <!-- <input type="date" id="CUSTOMERREGDT" name="CUSTOMERREGDT"  value="<?=!empty($data['CUSTOMERREGDT']) ? date('Y-m-d', strtotime($data['CUSTOMERREGDT'])): ''?>" />       -->
                </div>
                
                <div class="flex col-second"></div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['STAFF_NAME']; ?></label>
                    <input class="width30  form-control" type="text" id="STAFFNAME" name="STAFFNAME"  value="<?=!empty($data['STAFFNAME']) ? $data['STAFFNAME']: ''?>" />
                    <label class="text-copy"><?php echo $data['TXTLANG']['SEARCH_CHAR']; ?></label>&nbsp;&nbsp;
                    <input class="width20  form-control" type="text" id="STAFFSPELL" name="STAFFSPELL"  value="<?=!empty($data['STAFFSPELL']) ? $data['STAFFSPELL']: ''?>" />
                </div>                
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['DIVISIONCODE']; ?></label>
                    <input class="width20  form-control" type="text" id="DIVISIONCD" name="DIVISIONCD"  
                    required <?php if(!empty($data['DIVISIONCD'])){ ?> value="<?php echo $data['DIVISIONCD']; ?>" <?php } else { ?> value="<?php echo isset($_GET['divisioncd']) ? $_GET['divisioncd']: ''; ?>" <?php }?> />
                    <div class="fix-icon">
                    <a href="#" id="searchdivision"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&nbsp;&nbsp;                 
                    <input class="form-control width25" type="text" id="DIVISIONNAME" name="DIVISIONNAME" readonly value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''?>"  />  
                </div>     
            </div>

            <div class="flex">
                <div class="flex col-second">
                <input type="checkbox" id="STAFFDESIGNMODFLG" name="STAFFDESIGNMODFLG" value="T" style="width: 15px"
                    <?php echo (!empty($data['STAFFDESIGNMODFLG']) && $data['STAFFDESIGNMODFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width15"><?php echo $data['TXTLANG']['DESIGN']; ?></label>
                </div>     
            </div>


            <!-- <br><br> -->

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['ADDR']; ?></label>
                    <input class="width43  form-control" type="text" id="STAFFADDR1" name="STAFFADDR1"  value="<?=!empty($data['STAFFADDR1']) ? $data['STAFFADDR1']: ''?>" />
              </div>
             </div>

             <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27">  </label>
                    <input class="width43  form-control" type="text" id="STAFFADDR2" name="STAFFADDR2"  value="<?=!empty($data['STAFFADDR2']) ? $data['STAFFADDR2']: ''?>" />
              </div>
             </div>

             <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['TEL']; ?></label>
                    <input class="width15  form-control" type="text" id="STAFFTEL" name="STAFFTEL"  value="<?=!empty($data['STAFFTEL']) ? $data['STAFFTEL']: ''?>" />  
                </div>
                <div class="flex col-second">
                <label class="label-width22"><?php echo $data['TXTLANG']['FAX']; ?></label>
                
                    <input class="width22  form-control" type="text" id="STAFFFAX" name="STAFFFAX"  value="<?=!empty($data['STAFFFAX']) ? $data['STAFFFAX']: ''?>" /> 
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['MOBILE']; ?></label>                    
                    <input class="width43  form-control" type="text" id="STAFFMOB" name="STAFFMOB"  value="<?=!empty($data['STAFFMOB']) ? $data['STAFFMOB']: ''?>" />
                </div>            
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['EMAIL']; ?></label>                    
                    <input class="width43  form-control" type="text" id="STAFFEMAIL" name="STAFFEMAIL"  value="<?=!empty($data['STAFFEMAIL']) ? $data['STAFFEMAIL']: ''?>" />
                </div>            
            </div>


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['JOB_ST_DATE']; ?></label>
                    <input type="date" id="STAFFSTARTDT" name="STAFFSTARTDT"  value="<?=!empty($data['STAFFSTARTDT']) ? date('Y-m-d', strtotime($data['STAFFSTARTDT'])): date('Y-m-d')?>" />        
                </div>
                <div class="flex col-second">
                <label class="label-width22"><?php echo $data['TXTLANG']['JOB_ED_DATE']; ?></label>&nbsp;&nbsp;  
                
                <input type="date" id="STAFFRETIREDT" name="STAFFRETIREDT"  value="<?=!empty($data['STAFFRETIREDT']) ? date('Y-m-d', strtotime($data['STAFFRETIREDT'])): ''?>" /> 
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['POSITION_TITLE']; ?></label>                    
                    <input class="width43  form-control" type="text" id="STAFFTITLE" name="STAFFTITLE"  value="<?=!empty($data['STAFFTITLE']) ? $data['STAFFTITLE']: ''?>" />
                </div>            
            </div>
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['REMARK']; ?></label>                    
                    <input class="width43  form-control" type="text" id="STAFFREM" name="STAFFREM"  value="<?=!empty($data['STAFFREM']) ? $data['STAFFREM']: ''?>" />
                </div>            
            </div>
            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['IMAGE']; ?></label> 
                    <!-- &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                         -->
                    <input class="width43  form-control" type="text" id="STAFFIMGLOC" name="STAFFIMGLOC"  value="<?=!empty($data['STAFFIMGLOC']) ? $data['STAFFIMGLOC']: ''?>" />
                    <!-- <label class="label-width15">Select a file:</label>
                     <input type="file" id="MYFILE" name="MYFILE"><br><br> -->
                    
                    
                    <!-- <button type="file" id="myfile" class="btn btn-outline-secondary btn-action">...</button> -->
                </div>            
            </div>
            <!-- <div class="flex">
            <div class="flex col-second">
            <img src=<?=!empty($data['STAFFIMGLOC']) ? $data['STAFFIMGLOC']: ''?> alt="Trulli" width="150" height="175">
                </div>
            </div> -->

                  
                  
           
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
