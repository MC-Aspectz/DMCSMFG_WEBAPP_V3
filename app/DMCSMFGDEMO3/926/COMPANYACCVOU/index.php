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
    <form class="form" method="POST" id="companyaccvou" name="companyaccvou" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="col-md-12">

        <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['ACCOUNTGSETTING']; ?></label>
                </div>
            </div>

          

            <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label>
                <!-- </div> -->
            </div>


            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><< Voucher No. Format >></label>
                </div>
            </div>



            <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label class="label-width22"></label>
                    <label class="label-width8"><?php echo $data['TXTLANG']['PREFIX']; ?></label>
                    
                    <label class="label-width8"><?php echo $data['TXTLANG']['PREFIX2']; ?></label>
                    <label class="label-width18"><?php echo $data['TXTLANG']['DIGITS']; ?></label>
                    <label class="label-width7"><?php echo $data['TXTLANG']['PREFIX']; ?></label>
                    <label class="label-width8"><?php echo $data['TXTLANG']['PREFIX2']; ?></label>
                    <label class="label-width7"><?php echo $data['TXTLANG']['DIGITS']; ?></label>
                <!-- </div> -->
            </div>



            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['ESTIMATE_NO']; ?></label>
                    <label class="label-width15"></label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXQU" name="PREFIXQU" 
                <?php if(isset($data['PREFIXQU'])) { ?> value = "<?=$data['PREFIXQU']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXQU'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXQU']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2QU" name="PREFIX2QU" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2QU']) && $data['cpnaccvou']['PREFIX2QU'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITQU" name="DIGITQU" 
                <?php if(isset($data['DIGITQU'])) { ?> value = "<?=$data['DIGITQU']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITQU'])) { ?> value = "<?=$data['cpnaccvou']['DIGITQU']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  <?php echo $data['TXTLANG']['JV_NO']; ?></label>  
                                         
                </div>                
                <div class="flex col-second">              
                <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXJV" name="PREFIXJV" 
                <?php if(isset($data['PREFIXJV'])) { ?> value = "<?=$data['PREFIXJV']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXJV'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXJV']?>" <?php  } else { ?> value = "" <?php } }?> />
             <select class="width22 option-text form-select form-select-sm" id="PREFIX2JV" name="PREFIX2JV" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2JV']) && $data['cpnaccvou']['PREFIX2JV'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <input class="width10  form-control" type="number" id="DIGITJV" name="DIGITJV" 
                <?php if(isset($data['DIGITJV'])) { ?> value = "<?=$data['DIGITJV']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITJV'])) { ?> value = "<?=$data['cpnaccvou']['DIGITJV']?>" <?php  } else { ?> value = "" <?php } }?> />
            </div>
            </div>







            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['SALEORDERNO']; ?></label>
                    <label class="label-width15">Domestic</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXSOD" name="PREFIXSOD" 
                <?php if(isset($data['PREFIXSOD'])) { ?> value = "<?=$data['PREFIXSOD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXSOD'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXSOD']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2SOD" name="PREFIX2SOD" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2SOD']) && $data['cpnaccvou']['PREFIX2SOD'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITSOD" name="DIGITSOD" 
                <?php if(isset($data['DIGITSOD'])) { ?> value = "<?=$data['DIGITSOD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITSOD'])) { ?> value = "<?=$data['cpnaccvou']['DIGITSOD']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  <?php echo $data['TXTLANG']['GV_NO']; ?></label>  
                                         
                </div>                
                <div class="flex col-second">              
                <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXGV" name="PREFIXGV" 
                <?php if(isset($data['PREFIXGV'])) { ?> value = "<?=$data['PREFIXGV']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXGV'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXGV']?>" <?php  } else { ?> value = "" <?php } }?> />
             <select class="width22 option-text form-select form-select-sm" id="PREFIX2GV" name="PREFIX2GV" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2GV']) && $data['cpnaccvou']['PREFIX2GV'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <input class="width10  form-control" type="number" id="DIGITGV" name="DIGITGV" 
                <?php if(isset($data['DIGITGV'])) { ?> value = "<?=$data['DIGITGV']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITGV'])) { ?> value = "<?=$data['cpnaccvou']['DIGITGV']?>" <?php  } else { ?> value = "" <?php } }?> />
            </div>
            </div>


            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"></label>
                    <label class="label-width15">Oversea</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXSOO" name="PREFIXSOO" 
                <?php if(isset($data['PREFIXSOO'])) { ?> value = "<?=$data['PREFIXSOO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXSOO'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXSOO']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2SOO" name="PREFIX2SOO" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2SOO']) && $data['cpnaccvou']['PREFIX2SOO'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITSOO" name="DIGITSOO" 
                <?php if(isset($data['DIGITSOO'])) { ?> value = "<?=$data['DIGITSOO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITSOO'])) { ?> value = "<?=$data['cpnaccvou']['DIGITSOO']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  <?php echo $data['TXTLANG']['DEBITNUM']; ?></label>  
                                         
                </div>                
                <div class="flex col-second">              
                <input class="width10  form-control"style="text-transform:uppercase"  type="text" id="PREFIXJVD" name="PREFIXJVD" 
                <?php if(isset($data['PREFIXJVD'])) { ?> value = "<?=$data['PREFIXJVD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXJVD'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXJVD']?>" <?php  } else { ?> value = "" <?php } }?> />
             <select class="width22 option-text form-select form-select-sm" id="PREFIX2JVD" name="PREFIX2JVD" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2JVD']) && $data['cpnaccvou']['PREFIX2JVD'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <input class="width10  form-control" type="number" id="DIGITJVD" name="DIGITJVD" 
                <?php if(isset($data['DIGITJVD'])) { ?> value = "<?=$data['DIGITJVD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITJVD'])) { ?> value = "<?=$data['cpnaccvou']['DIGITJVD']?>" <?php  } else { ?> value = "" <?php } }?> />
            </div>
            </div>
            

                 
        <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['INVOICE_NO']; ?></label>
                    <label class="label-width15">Domestic</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXSTD" name="PREFIXSTD" 
                <?php if(isset($data['PREFIXSTD'])) { ?> value = "<?=$data['PREFIXSTD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXSTD'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXSTD']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2STD" name="PREFIX2STD" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2STD']) && $data['cpnaccvou']['PREFIX2STD'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITSTD" name="DIGITSTD" 
                <?php if(isset($data['DIGITSTD'])) { ?> value = "<?=$data['DIGITSTD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITSTD'])) { ?> value = "<?=$data['cpnaccvou']['DIGITSTD']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  <?php echo $data['TXTLANG']['CREDITNUM']; ?></label>  
                                         
                </div>                
                <div class="flex col-second">              
                <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXJVC" name="PREFIXJVC" 
                <?php if(isset($data['PREFIXJVC'])) { ?> value = "<?=$data['PREFIXJVC']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXJVC'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXJVC']?>" <?php  } else { ?> value = "" <?php } }?> />
             <select class="width22 option-text form-select form-select-sm" id="PREFIX2JVC" name="PREFIX2JVC" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2JVC']) && $data['cpnaccvou']['PREFIX2JVC'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <input class="width10  form-control" type="number" id="DIGITJVC" name="DIGITJVC" 
                <?php if(isset($data['DIGITJVC'])) { ?> value = "<?=$data['DIGITJVC']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITJVC'])) { ?> value = "<?=$data['cpnaccvou']['DIGITJVC']?>" <?php  } else { ?> value = "" <?php } }?> />
            </div>
            </div>
            


            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"></label>
                    <label class="label-width15">Oversea</label>
                    <input class="width10  form-control" style="text-transform:uppercase"  type="text" id="PREFIXSTO" name="PREFIXSTO" 
                <?php if(isset($data['PREFIXSTO'])) { ?> value = "<?=$data['PREFIXSTO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXSTO'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXSTO']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2STO" name="PREFIX2STO" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2STO']) && $data['cpnaccvou']['PREFIX2STO'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITSTO" name="DIGITSTO" 
                <?php if(isset($data['DIGITSTO'])) { ?> value = "<?=$data['DIGITSTO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITSTO'])) { ?> value = "<?=$data['cpnaccvou']['DIGITSTO']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  <?php echo $data['TXTLANG']['FIXED_ASSET']; ?></label>  
                                         
                </div>                
                <div class="flex col-second">              
                <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXFA" name="PREFIXFA" 
                <?php if(isset($data['PREFIXFA'])) { ?> value = "<?=$data['PREFIXFA']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXFA'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXFA']?>" <?php  } else { ?> value = "" <?php } }?> />
             <select class="width22 option-text form-select form-select-sm" id="PREFIX2FA" name="PREFIX2FA" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2FA']) && $data['cpnaccvou']['PREFIX2FA'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <input class="width10  form-control" type="number" id="DIGITFA" name="DIGITFA" 
                <?php if(isset($data['DIGITFA'])) { ?> value = "<?=$data['DIGITFA']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITFA'])) { ?> value = "<?=$data['cpnaccvou']['DIGITFA']?>" <?php  } else { ?> value = "" <?php } }?> />
            </div>
            </div>




            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['BILL_NO']; ?></label>
                    <label class="label-width15"></label>
                    <input class="width10  form-control" style="text-transform:uppercase"  type="text" id="PREFIXBN" name="PREFIXBN" 
                <?php if(isset($data['PREFIXBN'])) { ?> value = "<?=$data['PREFIXBN']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXBN'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXBN']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2BN" name="PREFIX2BN" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2BN']) && $data['cpnaccvou']['PREFIX2BN'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITBN" name="DIGITBN" 
                <?php if(isset($data['DIGITBN'])) { ?> value = "<?=$data['DIGITBN']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITBN'])) { ?> value = "<?=$data['cpnaccvou']['DIGITBN']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  <?php echo $data['TXTLANG']['PETTY_CASH']; ?></label>  
                                         
                </div>                
                <div class="flex col-second">              
                <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXPC" name="PREFIXPC" 
                <?php if(isset($data['PREFIXPC'])) { ?> value = "<?=$data['PREFIXPC']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXPC'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXPC']?>" <?php  } else { ?> value = "" <?php } }?> />
             <select class="width22 option-text form-select form-select-sm" id="PREFIX2PC" name="PREFIX2PC" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2PC']) && $data['cpnaccvou']['PREFIX2PC'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <input class="width10  form-control" type="number" id="DIGITPC" name="DIGITPC" 
                <?php if(isset($data['DIGITPC'])) { ?> value = "<?=$data['DIGITPC']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITPC'])) { ?> value = "<?=$data['cpnaccvou']['DIGITPC']?>" <?php  } else { ?> value = "" <?php } }?> />
            </div>
            </div>



            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['RV_NO']; ?></label>
                    <label class="label-width15">Domestic</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXRVD" name="PREFIXRVD" 
                <?php if(isset($data['PREFIXRVD'])) { ?> value = "<?=$data['PREFIXRVD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXRVD'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXRVD']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2RVD" name="PREFIX2RVD" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2RVD']) && $data['cpnaccvou']['PREFIX2RVD'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITRVD" name="DIGITRVD" 
                <?php if(isset($data['DIGITRVD'])) { ?> value = "<?=$data['DIGITRVD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITRVD'])) { ?> value = "<?=$data['cpnaccvou']['DIGITRVD']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  <?php echo $data['TXTLANG']['WAGE']; ?></label>  
                                         
                </div>                
                <div class="flex col-second">              
                <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXWG" name="PREFIXWG" 
                <?php if(isset($data['PREFIXWG'])) { ?> value = "<?=$data['PREFIXWG']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXWG'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXWG']?>" <?php  } else { ?> value = "" <?php } }?> />
             <select class="width22 option-text form-select form-select-sm" id="PREFIX2WG" name="PREFIX2WG" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2WG']) && $data['cpnaccvou']['PREFIX2WG'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <input class="width10  form-control" type="number" id="DIGITWG" name="DIGITWG" 
                <?php if(isset($data['DIGITWG'])) { ?> value = "<?=$data['DIGITWG']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITWG'])) { ?> value = "<?=$data['cpnaccvou']['DIGITWG']?>" <?php  } else { ?> value = "" <?php } }?> />
            </div>
            </div>



            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"></label>
                    <label class="label-width15">Oversea</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXRVO" name="PREFIXRVO" 
                <?php if(isset($data['PREFIXRVO'])) { ?> value = "<?=$data['PREFIXRVO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXRVO'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXRVO']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2RVO" name="PREFIX2RVO" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2RVO']) && $data['cpnaccvou']['PREFIX2RVO'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITRVO" name="DIGITRVO" 
                <?php if(isset($data['DIGITRVO'])) { ?> value = "<?=$data['DIGITRVO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITRVO'])) { ?> value = "<?=$data['cpnaccvou']['DIGITRVO']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  <?php echo $data['TXTLANG']['TAX_INVOICE']; ?></label>  
                                         
                </div>                
                <div class="flex col-second">              
                <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXTXI" name="PREFIXTXI" 
                <?php if(isset($data['PREFIXTXI'])) { ?> value = "<?=$data['PREFIXTXI']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXTXI'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXTXI']?>" <?php  } else { ?> value = "" <?php } }?> />
             <select class="width22 option-text form-select form-select-sm" id="PREFIX2TXI" name="PREFIX2TXI" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2TXI']) && $data['cpnaccvou']['PREFIX2TXI'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> 
                    <input class="width10  form-control" type="number" id="DIGITTXI" name="DIGITTXI" 
                <?php if(isset($data['DIGITTXI'])) { ?> value = "<?=$data['DIGITTXI']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITTXI'])) { ?> value = "<?=$data['cpnaccvou']['DIGITTXI']?>" <?php  } else { ?> value = "" <?php } }?> />
            </div>
            </div>


            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['PR_NO']; ?></label>
                    <label class="label-width15"></label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXPR" name="PREFIXPR" 
                <?php if(isset($data['PREFIXPR'])) { ?> value = "<?=$data['PREFIXPR']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXPR'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXPR']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2PR" name="PREFIX2PR" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2PR']) && $data['cpnaccvou']['PREFIX2PR'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITPR" name="DIGITPR" 
                <?php if(isset($data['DIGITPR'])) { ?> value = "<?=$data['DIGITPR']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITPR'])) { ?> value = "<?=$data['cpnaccvou']['DIGITPR']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp; </label>  
                                         
                </div>                               
            </div>




            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['PO_NO']; ?></label>
                    <label class="label-width15">Domestic</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXPOD" name="PREFIXPOD" 
                <?php if(isset($data['PREFIXPOD'])) { ?> value = "<?=$data['PREFIXPOD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXPOD'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXPOD']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2POD" name="PREFIX2POD" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2POD']) && $data['cpnaccvou']['PREFIX2POD'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITPOD" name="DIGITPOD" 
                <?php if(isset($data['DIGITPOD'])) { ?> value = "<?=$data['DIGITPOD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITPOD'])) { ?> value = "<?=$data['cpnaccvou']['DIGITPOD']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;</label>                                       
                </div>   
            </div>

            

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"></label>
                    <label class="label-width15">Oversea</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXPOO" name="PREFIXPOO" 
                <?php if(isset($data['PREFIXPOO'])) { ?> value = "<?=$data['PREFIXPOO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXPOO'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXPOO']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2POO" name="PREFIX2POO" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2POO']) && $data['cpnaccvou']['PREFIX2POO'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITPOO" name="DIGITPOO" 
                <?php if(isset($data['DIGITPOO'])) { ?> value = "<?=$data['DIGITPOO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITPOO'])) { ?> value = "<?=$data['cpnaccvou']['DIGITPOO']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp; </label>                                       
                </div>   
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['PV_NO']; ?></label>
                    <label class="label-width15">Domestic</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXPVD" name="PREFIXPVD" 
                <?php if(isset($data['PREFIXPVD'])) { ?> value = "<?=$data['PREFIXPVD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXPVD'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXPVD']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2PVD" name="PREFIX2PVD" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2PVD']) && $data['cpnaccvou']['PREFIX2PVD'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITPVD" name="DIGITPVD" 
                <?php if(isset($data['DIGITPVD'])) { ?> value = "<?=$data['DIGITPVD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITPVD'])) { ?> value = "<?=$data['cpnaccvou']['DIGITPVD']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  </label>                                       
                </div>   
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"></label>
                    <label class="label-width15">Oversea</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXPVO" name="PREFIXPVO" 
                <?php if(isset($data['PREFIXPVO'])) { ?> value = "<?=$data['PREFIXPVO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXPVO'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXPVO']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2PVO" name="PREFIX2PVO" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2PVO']) && $data['cpnaccvou']['PREFIX2PVO'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITPVO" name="DIGITPVO" 
                <?php if(isset($data['DIGITPVO'])) { ?> value = "<?=$data['DIGITPVO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITPVO'])) { ?> value = "<?=$data['cpnaccvou']['DIGITPVO']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  </label>                                       
                </div>   
            </div>

            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['PBILL_NO']; ?></label>
                    <label class="label-width15"></label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXPB" name="PREFIXPB" 
                <?php if(isset($data['PREFIXPB'])) { ?> value = "<?=$data['PREFIXPB']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXPB'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXPB']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2PB" name="PREFIX2PB" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2PB']) && $data['cpnaccvou']['PREFIX2PB'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITPB" name="DIGITPB" 
                <?php if(isset($data['DIGITPB'])) { ?> value = "<?=$data['DIGITPB']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITPB'])) { ?> value = "<?=$data['cpnaccvou']['DIGITPB']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  </label>                                       
                </div>   
            </div>



            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"><?php echo $data['TXTLANG']['PM_NO']; ?></label>
                    <label class="label-width15">Domestic</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXPMD" name="PREFIXPMD" 
                <?php if(isset($data['PREFIXPMD'])) { ?> value = "<?=$data['PREFIXPMD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXPMD'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXPMD']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2PMD" name="PREFIX2PMD" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2PMD']) && $data['cpnaccvou']['PREFIX2PMD'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITPMD" name="DIGITPMD" 
                <?php if(isset($data['DIGITPMD'])) { ?> value = "<?=$data['DIGITPMD']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITPMD'])) { ?> value = "<?=$data['cpnaccvou']['DIGITPMD']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  </label>                                       
                </div>   
            </div>


            <div class="flex">
                <div class="flex col-first">
                    <label class="label-width27"></label>
                    <label class="label-width15">Oversea</label>
                    <input class="width10  form-control" style="text-transform:uppercase" type="text" id="PREFIXPMO" name="PREFIXPMO" 
                <?php if(isset($data['PREFIXPMO'])) { ?> value = "<?=$data['PREFIXPMO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['PREFIXPMO'])) { ?> value = "<?=$data['cpnaccvou']['PREFIXPMO']?>" <?php  } else { ?> value = "" <?php } }?> />    
                        <select class="width22 option-text form-select form-select-sm" id="PREFIX2PMO" name="PREFIX2PMO" >
                        <option value=""></option>
                        <?php foreach ($vformatm as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['cpnaccvou']['PREFIX2PMO']) && $data['cpnaccvou']['PREFIX2PMO'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>   
                    <input class="width10  form-control" type="number" id="DIGITPMO" name="DIGITPMO" 
                <?php if(isset($data['DIGITPMO'])) { ?> value = "<?=$data['DIGITPMO']?>" <?php  } else {
                        if(isset($data['cpnaccvou']['DIGITPMO'])) { ?> value = "<?=$data['cpnaccvou']['DIGITPMO']?>" <?php  } else { ?> value = "" <?php } }?> />  
                        &emsp; 
                        <label class="label-width25">| &emsp;  </label>                                       
                </div>   
            </div>






            <div class="flex">
                <!-- <div class="flex col-first"> -->
                    <label>-----------------------------------------------------------------------------------------------------------------------------</label>
                <!-- </div> -->
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
