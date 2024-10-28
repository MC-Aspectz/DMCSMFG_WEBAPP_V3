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
    <form class="form" method="POST" id="companyacc" name="companyacc" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="col-md-12">

        <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['ACCOUNTGSETTING']; ?></label>
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['FISCALYEAR']; ?></label>
                    <select class="width22 option-text form-select form-select-sm" id="ACCYEAR" name="ACCYEAR" >
                        <option value=""></option>
                        <?php foreach ($accyearvalue as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnacc']['ACCYEAR']) && $data['cpnacc']['ACCYEAR'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>                               
                </div>
            </div>

            <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label>
                <!-- </div> -->
            </div>


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['DRPLANG']['COMPANYACC']['TAX_ACC']; ?></label>
                    <!-- <label class="label-width27"><< Tax Setting >></label> -->
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['VATCALCTYPE']; ?></label>
                    <select class="width22 option-text form-select form-select-sm" id="VATCALCTYP" name="VATCALCTYP" >
                        <option value=""></option>
                        <?php foreach ($vatcaltype as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnacc']['VATCALCTYP']) && $data['cpnacc']['VATCALCTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>                               
                </div>                
                <div class="flex col-second">
                <label class="label-width27"><?php echo $data['DRPLANG']['TAISYAKU'][6]; ?></label>
                <input class="width17 req form-control" type="text" id="ACCCD5" name="ACCCD5" 
                <?php if(isset($data['ACCCD5'])) { ?> value = "<?=$data['ACCCD5']?>" <?php  } else {
                        if(isset($data['cpnacc']['ACCCD5'])) { ?> value = "<?=$data['cpnacc']['ACCCD5']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccount5"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="ACCNAME5" name="ACCNAME5"  
                     <?php if(isset($data['ACCNAME5'])) { ?> value = "<?=$data['ACCNAME5']?>" <?php  } else {
                   if(isset($data['cpnacc']['ACCNAME5'])) { ?> value = "<?=$data['cpnacc']['ACCNAME5']?>" <?php  } else { ?> value = "" <?php } }?> readonly/> 
            </div>
            </div>


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['DRPLANG']['TAISYAKU'][2]; ?></label>
                <input class="width17 req form-control" type="text" id="ACCCD1" name="ACCCD1" 
                <?php if(isset($data['ACCCD1'])) { ?> value = "<?=$data['ACCCD1']?>" <?php  } else {
                        if(isset($data['cpnacc']['ACCCD1'])) { ?> value = "<?=$data['cpnacc']['ACCCD1']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccount"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="ACCNAME1" name="ACCNAME1"  
                     <?php if(isset($data['ACCNAME1'])) { ?> value = "<?=$data['ACCNAME1']?>" <?php  } else {
                   if(isset($data['cpnacc']['ACCNAME1'])) { ?> value = "<?=$data['cpnacc']['ACCNAME1']?>" <?php  } else { ?> value = "" <?php } }?> readonly/>                             
                </div>                
                <div class="flex col-second">
                <label class="label-width27"><?php echo $data['DRPLANG']['TAISYAKU'][4]; ?></label>
                <input class="width17 req form-control" type="text" id="ACCCD3" name="ACCCD3" 
                <?php if(isset($data['ACCCD3'])) { ?> value = "<?=$data['ACCCD3']?>" <?php  } else {
                        if(isset($data['cpnacc']['ACCCD3'])) { ?> value = "<?=$data['cpnacc']['ACCCD3']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccount3"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="ACCNAME3" name="ACCNAME3"  
                     <?php if(isset($data['ACCNAME3'])) { ?> value = "<?=$data['ACCNAME3']?>" <?php  } else {
                   if(isset($data['cpnacc']['ACCNAME3'])) { ?> value = "<?=$data['cpnacc']['ACCNAME3']?>" <?php  } else { ?> value = "" <?php } }?> readonly/> 
            </div>
            </div>


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['DRPLANG']['TAISYAKU'][3]; ?></label>
                <input class="width17 req form-control" type="text" id="ACCCD2" name="ACCCD2" 
                <?php if(isset($data['ACCCD2'])) { ?> value = "<?=$data['ACCCD2']?>" <?php  } else {
                        if(isset($data['cpnacc']['ACCCD2'])) { ?> value = "<?=$data['cpnacc']['ACCCD2']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccount2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="ACCNAME2" name="ACCNAME2"  
                     <?php if(isset($data['ACCNAME2'])) { ?> value = "<?=$data['ACCNAME2']?>" <?php  } else {
                   if(isset($data['cpnacc']['ACCNAME2'])) { ?> value = "<?=$data['cpnacc']['ACCNAME2']?>" <?php  } else { ?> value = "" <?php } }?> readonly/>                             
                </div>                
                <div class="flex col-second">
                <label class="label-width27"><?php echo $data['DRPLANG']['TAISYAKU'][5]; ?></label>
                <input class="width17 req form-control" type="text" id="ACCCD4" name="ACCCD4" 
                <?php if(isset($data['ACCCD4'])) { ?> value = "<?=$data['ACCCD4']?>" <?php  } else {
                        if(isset($data['cpnacc']['ACCCD4'])) { ?> value = "<?=$data['cpnacc']['ACCCD4']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccount4"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="ACCNAME4" name="ACCNAME4"  
                     <?php if(isset($data['ACCNAME4'])) { ?> value = "<?=$data['ACCNAME4']?>" <?php  } else {
                   if(isset($data['cpnacc']['ACCNAME4'])) { ?> value = "<?=$data['cpnacc']['ACCNAME4']?>" <?php  } else { ?> value = "" <?php } }?> readonly/> 
            </div>
            </div>


            <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label>
                <!-- </div> -->
            </div>


            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['DRPLANG']['COMPANYACC']['PROFITACC']; ?></label>
                </div>
            </div>

            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['PLACCOUNTTHISTERM']; ?></label>
                <input class="width17 req form-control" type="text" id="ACCCDP1" name="ACCCDP1" 
                <?php if(isset($data['ACCCDP1'])) { ?> value = "<?=$data['ACCCDP1']?>" <?php  } else {
                        if(isset($data['cpnacc']['ACCCDP1'])) { ?> value = "<?=$data['cpnacc']['ACCCDP1']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccountp1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="ACCNAMEP1" name="ACCNAMEP1"  
                     <?php if(isset($data['ACCNAMEP1'])) { ?> value = "<?=$data['ACCNAMEP1']?>" <?php  } else {
                   if(isset($data['cpnacc']['ACCNAMEP1'])) { ?> value = "<?=$data['cpnacc']['ACCNAMEP1']?>" <?php  } else { ?> value = "" <?php } }?> readonly/>                             
                </div>  
                     </div>

                     <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php echo $data['TXTLANG']['PLACCACCUMULATE']; ?></label>
                <input class="width17 req form-control" type="text" id="ACCCDP2" name="ACCCDP2" 
                <?php if(isset($data['ACCCDP2'])) { ?> value = "<?=$data['ACCCDP2']?>" <?php  } else {
                        if(isset($data['cpnacc']['ACCCDP2'])) { ?> value = "<?=$data['cpnacc']['ACCCDP2']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccountp2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="ACCNAMEP2" name="ACCNAMEP2"  
                     <?php if(isset($data['ACCNAMEP2'])) { ?> value = "<?=$data['ACCNAMEP2']?>" <?php  } else {
                   if(isset($data['cpnacc']['ACCNAMEP2'])) { ?> value = "<?=$data['cpnacc']['ACCNAMEP2']?>" <?php  } else { ?> value = "" <?php } }?> readonly/>                             
                </div>  
                     </div>


                     <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label>
                <!-- </div> -->
            </div>


            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['DRPLANG']['COMPANYACC']['INVCALCTYP']; ?></label>
                </div>
            </div>



            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['INVCALCTYP']; ?></label>
                    <select class="width22 option-text form-select form-select-sm" id="INVCALCTYP" name="INVCALCTYP" >
                        <option value=""></option>
                        <?php foreach ($invcalctype as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnacc']['INVCALCTYP']) && $data['cpnacc']['INVCALCTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>                               
                </div>
            </div>


            <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label>
                <!-- </div> -->
            </div>


            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php if (array_key_exists('WHT_ACC',$data['DRPLANG']['COMPANYACC']) ){
                    echo $data['COMPANYACC']['WHT_ACC'];
                } else {
                    echo 'COMPANYACC(WHT_ACC)';
                }; ?></label>
                </div>
            </div>


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27">WITHHOLD1</label>
                <input class="width17 req form-control" type="text" id="WHTCD1" name="WHTCD1" 
                <?php if(isset($data['WHTCD1'])) { ?> value = "<?=$data['WHTCD1']?>" <?php  } else {
                        if(isset($data['cpnacc']['WHTCD1'])) { ?> value = "<?=$data['cpnacc']['WHTCD1']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccountwht1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="WHTNAME1" name="WHTNAME1"  
                     <?php if(isset($data['WHTNAME1'])) { ?> value = "<?=$data['WHTNAME1']?>" <?php  } else {
                   if(isset($data['cpnacc']['WHTNAME1'])) { ?> value = "<?=$data['cpnacc']['WHTNAME1']?>" <?php  } else { ?> value = "" <?php } }?> readonly/>                             
                </div>  
                     </div>

                     <div class="flex">
                <div class="flex col-first">
                <label class="label-width27">WITHHOLD1</label>
                <input class="width17 req form-control" type="text" id="WHTCD2" name="WHTCD2" 
                <?php if(isset($data['WHTCD2'])) { ?> value = "<?=$data['WHTCD2']?>" <?php  } else {
                        if(isset($data['cpnacc']['WHTCD2'])) { ?> value = "<?=$data['cpnacc']['WHTCD2']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccountwht2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="WHTNAME2" name="WHTNAME2"  
                     <?php if(isset($data['WHTNAME2'])) { ?> value = "<?=$data['WHTNAME2']?>" <?php  } else {
                   if(isset($data['cpnacc']['WHTNAME2'])) { ?> value = "<?=$data['cpnacc']['WHTNAME2']?>" <?php  } else { ?> value = "" <?php } }?> readonly/>                             
                </div>  
                     </div>



                     <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label>
                <!-- </div> -->
            </div>

          

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php if (array_key_exists('STD_PAYMENT',$data['DRPLANG']['COMPANYACC']) ){
                    echo $data['COMPANYACC']['STD_PAYMENT'];
                } else {
                    echo 'COMPANYACC(STD_PAYMENT)';
                }; ?></label>
                </div>
            </div>


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php 
                if (array_key_exists(0,$data['DRPLANG']['DC_TYP']) ){
                    echo $data['DRPLANG']['DC_TYP'][0];
                } else {
                    echo 'Debit';
                };

                ?></label>
                <input class="width17 req form-control" type="text" id="STDPAYMENTCD1" name="STDPAYMENTCD1" 
                <?php if(isset($data['STDPAYMENTCD1'])) { ?> value = "<?=$data['STDPAYMENTCD1']?>" <?php  } else {
                        if(isset($data['cpnacc']['STDPAYMENTCD1'])) { ?> value = "<?=$data['cpnacc']['STDPAYMENTCD1']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccountstd1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="STDPAYMENTNAME1" name="STDPAYMENTNAME1"  
                     <?php if(isset($data['STDPAYMENTNAME1'])) { ?> value = "<?=$data['STDPAYMENTNAME1']?>" <?php  } else {
                   if(isset($data['cpnacc']['STDPAYMENTNAME1'])) { ?> value = "<?=$data['cpnacc']['STDPAYMENTNAME1']?>" <?php  } else { ?> value = "" <?php } }?> readonly/>                             
                </div>                
                <div class="flex col-second">
                <label class="label-width27"><?php if (array_key_exists(1,$data['DRPLANG']['DC_TYP']) ){
                    echo $data['DRPLANG']['DC_TYP'][1];
                } else {
                    echo 'Credit';
                }; 
                
                ?></label>
                <input class="width17 req form-control" type="text" id="STDPAYMENTCD2" name="STDPAYMENTCD2" 
                <?php if(isset($data['STDPAYMENTCD2'])) { ?> value = "<?=$data['STDPAYMENTCD2']?>" <?php  } else {
                        if(isset($data['cpnacc']['STDPAYMENTCD2'])) { ?> value = "<?=$data['cpnacc']['STDPAYMENTCD2']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccountstd2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="STDPAYMENTNAME2" name="STDPAYMENTNAME2"  
                     <?php if(isset($data['STDPAYMENTNAME2'])) { ?> value = "<?=$data['STDPAYMENTNAME2']?>" <?php  } else {
                   if(isset($data['cpnacc']['STDPAYMENTNAME2'])) { ?> value = "<?=$data['cpnacc']['STDPAYMENTNAME2']?>" <?php  } else { ?> value = "" <?php } }?> readonly/> 
            </div>
            </div>




            <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label>
                <!-- </div> -->
            </div>


            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php if (array_key_exists('STD_RECEIVE',$data['DRPLANG']['COMPANYACC']) ){
                    echo $data['COMPANYACC']['STD_RECEIVE'];
                } else {
                    echo 'COMPANYACC(STD_RECEIVE)';
                }; ?></label>
                </div>
            </div>


            <div class="flex">
                <div class="flex col-first">
                <label class="label-width27"><?php 
                if (array_key_exists(0,$data['DRPLANG']['DC_TYP']) ){
                    echo $data['DRPLANG']['DC_TYP'][0];
                } else {
                    echo 'Debit';
                };
                
                ?></label>
                <input class="width17 req form-control" type="text" id="STDRECEIVECD1" name="STDRECEIVECD1" 
                <?php if(isset($data['STDRECEIVECD1'])) { ?> value = "<?=$data['STDRECEIVECD1']?>" <?php  } else {
                        if(isset($data['cpnacc']['STDRECEIVECD1'])) { ?> value = "<?=$data['cpnacc']['STDRECEIVECD1']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccountstdrec1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="STDRECEIVENAME1" name="STDRECEIVENAME1"  
                     <?php if(isset($data['STDRECEIVENAME1'])) { ?> value = "<?=$data['STDRECEIVENAME1']?>" <?php  } else {
                   if(isset($data['cpnacc']['STDRECEIVENAME1'])) { ?> value = "<?=$data['cpnacc']['STDRECEIVENAME1']?>" <?php  } else { ?> value = "" <?php } }?> readonly/>                             
                </div>                
                <div class="flex col-second">
                <label class="label-width27"><?php if (array_key_exists(1,$data['DRPLANG']['DC_TYP']) ){
                    echo $data['DRPLANG']['DC_TYP'][1];
                } else {
                    echo 'Credit';
                };
                
                
                ?></label>
                <input class="width17 req form-control" type="text" id="STDRECEIVECD2" name="STDRECEIVECD2" 
                <?php if(isset($data['STDRECEIVECD2'])) { ?> value = "<?=$data['STDRECEIVECD2']?>" <?php  } else {
                        if(isset($data['cpnacc']['STDRECEIVECD2'])) { ?> value = "<?=$data['cpnacc']['STDRECEIVECD2']?>" <?php  } else { ?> value = "" <?php } }?> />
               <div class="fix-icon">
                    <a href="#" id="searchaccountstdrec2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>&emsp;
                    <input class="width30  form-control" type="text" id="STDRECEIVENAME2" name="STDRECEIVENAME2"  
                     <?php if(isset($data['STDRECEIVENAME2'])) { ?> value = "<?=$data['STDRECEIVENAME2']?>" <?php  } else {
                   if(isset($data['cpnacc']['STDRECEIVENAME2'])) { ?> value = "<?=$data['cpnacc']['STDRECEIVENAME2']?>" <?php  } else { ?> value = "" <?php } }?> readonly/> 
            </div>
            </div>

            <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label>
                <!-- </div> -->
            </div>


            <div class="flex">
                <div class="flex col-first">
                <input type="checkbox" id="ACCCHECKINV" name="ACCCHECKINV" value="T" style="width: 15px"
                    <?php echo (isset($data['cpnacc']['ACCCHECKINV']) && $data['cpnacc']['ACCCHECKINV'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width29"><?php echo $data['DRPLANG']['COMPANYACC']['ACCCHECKINV']; ?></label>
                </div>
            </div>
        
            


           
            <div class="flex footer">
                <div class="flex col-first">
                <button type="button" class="btn btn-outline-secondary btn-action" id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') { }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?></button>&emsp;&emsp;         
               </div>
                <div class="flex col-second" style="justify-content: right;">
                <!-- <button type="reset" id="clear" name="clear" onclick="unsetSession(this.form);" class="btn btn-outline-secondary btn-action"><?php echo $data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp; -->
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
