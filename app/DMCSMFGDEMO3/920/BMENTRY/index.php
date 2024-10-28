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
    <form class="form" method="POST" id="bmentry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

    <div class="d-flex">
        <div class="flex  p-2">
            <div class="flex col-60 flex-col">
                <!-- P_ITEMCODE BMPITEMCD PITEMNAME -->
                <div class="flex  p-2">
                    <label class="label-width23"><?php echo $data['TXTLANG']['P_ITEMCODE']; ?></label>

                    <input class="form-control width18 " type="text" id="BMPITEMCD" name="BMPITEMCD" value="<?=isset($data['BMPITEMCD']) ? $data['BMPITEMCD']: ''?>" />

                    <div class="fix-icon" >
                        <a href="#" id="guideindex1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>

                    <input class="form-control width54 " type="text" id="PITEMNAME" name="PITEMNAME" value="<?=isset($data['PITEMNAME']) ? $data['PITEMNAME']: ''?>" readonly/>

                </div>

                <!-- COMBINATION BMVERSION PITEMSPEC -->
                <div class="flex  p-2">
                    <label class="label-width23"><?php echo $data['TXTLANG']['COMBINATION']; ?></label>

                    <select class="width21 option-text form-select form-select-sm " id="BMVERSION" name="BMVERSION">
                        <option value=""></option>
                        <?php foreach ($dd1 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['BMVERSION']) && $data['BMVERSION'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>

                    <input class="form-control width54 " type="text" id="PITEMSPEC" name="PITEMSPEC" value="<?=isset($data['PITEMSPEC']) ? $data['PITEMSPEC']: ''?>" readonly/>

                </div>
            </div>
            <div class="flex col-2"></div>
            <div class="flex col-40 flex-col">
                <!-- INPUTDATE BMENTRYDT PERSON_RESPONSE STAFFCD STAFFNAME -->
                <div class="flex  p-2">
                    <label class="label-width15"><?php echo $data['TXTLANG']['INPUTDATE']; ?></label>

                    <input class="form-control width17 " type="date" id="BMENTRYDT" name="BMENTRYDT" value="<?=isset($data['BMENTRYDT']) ? date('Y-m-d', strtotime($data['BMENTRYDT'])): date('Y-m-d'); ?>"/>

                    <label class="label-width5" type="hidden"></label>
                    <label class="label-width15"><?php echo $data['TXTLANG']['PERSON_RESPONSE']; ?></label>

                    <input class="form-control width14 " type="text" id="STAFFCD" name="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''?>" />

                    <div class="fix-icon" >
                        <a href="#" id="guideindex2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>

                    <input class="form-control width25 " type="text" id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''?>" readonly/>

                </div>
                <!-- style="display: none;" -->
                <!-- PITEM SEARCH2 CLEAR1 ZRUNSEARCH SEARCH CLEAR -->
                <div class="flex  p-2" style="justify-content: right;">
                    <input class="form-control width14 " type="text" id="PITEM" name="PITEM" value="<?=isset($data['PITEM']) ? $data['PITEM']: ''?>" />
                    <button type="submit" class="btn btn-action" id="search2" name="search2" >SEARCH2</button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="clear1" name="clear1" onclick="unsetSession();">CLEAR1</button>&emsp;&emsp;
                    <input class="form-control width14 " type="text" id="ZRUNSEARCH" name="ZRUNSEARCH" value="<?=isset($data['ZRUNSEARCH']) ? $data['ZRUNSEARCH']: ''?>" />

                    <button type="submit"  class="btn btn-action" id="search" name="search" onclick="$('#loading').show();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp;
                    
                    <button type="button" class="btn btn-action" id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp;

                </div>

            </div>
        </div>
    </div>
    <!-- <?php print_r($data['BMPITEMCD']); ?> -->
    <div class="d-flex">
        <div class="flex  p-2">
            
            <div class="flex col-40 flex-col">
            <div class="table height450" id="bom_tree"><?php 

                if(!empty($data['searchTvw'])) {      
                    // print_r($data['searchTvw']);
                    // print_r(count($data['searchTvw']));
                    $strlen = count($data['searchTvw']);
                    
                    foreach ($data['searchTvw'] as $searchkey => $item) { 

                        if($item['PITEM'] == $data['BMPITEMCD']) { //1 
                            if(count($data['searchTvw'])>1){//1

                                // print_r($item['PITEM'].'</br>');
                                // print_r($data['searchTvw'][1]['PITEM'].'</br>');
                                // print_r($data['searchTvw'][2]['PITEM'].'</br>');
                                ?>
                                    <div class="title" id="title<?=$item['PITEM']?>" onclick="expanded('<?=$item['PITEM']?>', 1); searchDvw('<?=$item['PITEM']?>');">
                                    <i class="arrow-right"></i>&ensp;<i class="fa-solid fa-folder" style="color: #f7df87;"></i><label class="text-item"><?=$item['NODENAME']?></label>
                                    </div>
                                <?php  ?>
                      
                                <div class="bomView" id="bomView<?=$item['PITEM']?>"> <?php 
                                // print_r(count($data['searchTvw']));
                                // if(substr_count($item['NODEPATH'],'/')==2){
                                    $node2 = array();
                                    $node3 = array();
                                    $node4 = array();
                                    foreach ($data['searchTvw'] as $key => $value) {    
                                        // print_r(str_contains($value['NODEPATH'],$value['NODEPATH']));
                                        if(substr_count($value['NODEPATH'],'/') == 1) { // floor 2
                                            array_push($node2, $value);
                                        } 
                                        if(substr_count($value['NODEPATH'],'/') == 2) { // floor 3
                                            array_push($node3, $value);
                                        } 
                                        if(substr_count($value['NODEPATH'],'/') == 3) { // floor 4
                                            array_push($node4, $value);
                                        } 
                                    }
                                    $havechild = array();
                                    // $nochild = array();
                                    foreach($node2 as $j => $n2) {
                                        foreach($node3 as $i => $n3) {
                                            // print_r($n2.' L2'.'</br>');
                                            // print_r($n3.' L3'.'</br>');
                                        
                                            if(str_contains($n3['NODEPATH'], $n2['NODEPATH'])) {
                                                array_push($havechild, array('NODEPATH' => $n2['NODEPATH'], 'NODENAME' => $n2['NODENAME'],'PITEM' => $n2['PITEM'],'FILE' => '1'));
                                                $havechild = array_unique($havechild, SORT_REGULAR);
                                            } 
                                            // else {
                                            //     if(!str_contains($n3['NODEPATH'], $n2['NODEPATH'])) {
                                            //         array_push($havechild, array('NODEPATH' => $n2['NODEPATH'], 'NODENAME' => $n2['NODENAME'],'PITEM' => $n2['PITEM'],'FILE' => '0'));
                                            //         $havechild = array_unique($havechild, SORT_REGULAR);

                                            //     }
                                            // }
                                        }
                                    }
                                    foreach($node3 as $j => $n3) {
                                        foreach($node4 as $i => $n4) {
                                            // print_r($n2.' L2'.'</br>');
                                            // print_r($n3.' L3'.'</br>');
                                        
                                            if(str_contains($n4['NODEPATH'], $n3['NODEPATH'])) {
                                                array_push($havechild, array('NODEPATH' => $n3['NODEPATH'], 'NODENAME' => $n3['NODENAME'],'PITEM' => $n3['PITEM'], 'FILE' => '1'));
                                                $havechild = array_unique($havechild, SORT_REGULAR);
                                            } 
                                        }
                                    }   
                                    //     echo '<pre>';
                                    //    print_r($havechild);
                                    //    echo '</pre>';
                                    foreach ($data['searchTvw'] as $index => $item) { 
                                        foreach ($havechild as $key => $check) { 
                                            if($item['NODEPATH'] == $check['NODEPATH'])
                                            {
                                                $data['searchTvw'][$index]['FILE'] = '1';
                                            }
                                        }
                                    
                                    }
                                    // echo '<pre>';
                                    // print_r($data['searchTvw']);
                                    // echo '</pre>';
                                    foreach ($data['searchTvw'] as $index1 => $node) { 
                                        if(substr_count($node['NODEPATH'],'/') == 1) {
                                            if($node['FILE']==1)
                                            {
                                                ?>
                                                <div class="title1" id="title1<?=$index1?>" onclick="expanded('<?=$index1?>', 2); searchDvw('<?=$node['PITEM']?>');">
                                                    <ul id="selectView<?=$index1?>" onclick="selectView('<?=$index1?>');" >
                                                    <li class="select"><i class="arrow-right"></i>&ensp;<i class="fa-solid fa-folder" style="color: #f7df87;"></i><label class="text-item"><?=$node['NODENAME'];?></label></li>
                                                    </ul>
                                                </div>
                                                <div class="bomView1" id="bomView1<?=$index1?>"> <?php 
                                                    foreach ($data['searchTvw'] as $index2 => $node2) { 
                                                        $strcut1 = $node2['NODEPATH'];
                                                        $strcut1 = explode("/",$strcut1);
                    
                                                        $strcompair1 = $node['PITEM']."_";
                                                        if(substr_count($node2['NODEPATH'],'/') == 2 && str_contains($strcut1[1], $strcompair1)) {
                                                            if($node2['FILE'] == 1)
                                                            {
                                                                ?>
                                                                <div class="title2" id="title2<?=$index2?>" onclick="expanded('<?=$index2?>', 3); searchDvw('<?=$node2['PITEM']?>');">
                                                                <ul id="selectView<?=$index2?>" onclick="selectView('<?=$index2?>');" >
                                                                <li class="select"><i class="arrow-right"></i>&ensp;<i class="fa-solid fa-folder" style="color: #f7df87;"></i><label class="text-item"><?=$node2['NODENAME'];?></label></li>
                                                                </ul>
                                                                </div>

                                                                <div class="bomView2" id="bomView2<?=$index2?>"> <?php 
                                                                    foreach ($data['searchTvw'] as $index3 => $node3) { 
                                                                        $strcut1 = $node3['NODEPATH'];
                                                                        $strcut1 = explode("/",$strcut1);
                                    
                                                                        $strcompair1 = $node['PITEM']."_";
                                                                        if(substr_count($node3['NODEPATH'],'/') == 3 && str_contains($strcut1[1], $strcompair1)) {
                                                                            if($node3['FILE'] == 1)
                                                                            {
                                                                                ?>
                                                                                <div class="title3" id="title3<?=$index3?>" onclick="expanded('<?=$index3?>', 4); searchDvw('<?=$node3['PITEM']?>');">
                                                                                <ul id="selectView<?=$index3?>" onclick="selectView('<?=$index3?>');" >
                                                                                <li class="select"><i class="arrow-right"></i>&ensp;<i class="fa-solid fa-folder" style="color: #f7df87;"></i><label class="text-item"><?=$node3['NODENAME'];?></label></li>
                                                                                </ul>
                                                                                </div><?php

                                                                                

                                                                            }
                                                                            else{
                                                                                ?>
                                                                                <div class="title3" id="title3<?=$index3?>">
                                                                                    <ul id="selectView<?=$index3?>" onclick="selectView('<?=$index3?>'); searchDvw('<?=$node3['PITEM']?>');">
                                                                                    <li class="select"><i class="fa-regular fa-file fa-lg" style="color: #6f7276;"></i><label class="text-item"><?=$node3['NODENAME'];?></label></li>
                                                                                    </ul>
                                                                                </div><?php
                                                                            }
                                                                        }
                                                                    }?></div><?php
                                                                                
                                                                

                                                            }
                                                            else{
                                                                ?>
                                                                <div class="title2" id="title2<?=$index2?>">
                                                                    <ul id="selectView<?=$index2?>" onclick="selectView('<?=$index2?>'); searchDvw('<?=$node2['PITEM']?>');">
                                                                    <li class="select"><i class="fa-regular fa-file fa-lg" style="color: #6f7276;"></i><label class="text-item"><?=$node2['NODENAME'];?></label></li>
                                                                    </ul>
                                                                </div><?php
                                                            }
                                                        }
                                                    }?></div><?php
                                                }
                                            else{
                                                ?>
                                                <div class="title1" id="title1<?=$index1?>">
                                                    <ul id="selectView<?=$index1?>" onclick="selectView('<?=$index1?>'); searchDvw('<?=$node['PITEM']?>');">
                                                    <li class="select"><i class="fa-regular fa-file fa-lg" style="color: #6f7276;"></i><label class="text-item"><?=$node['NODENAME'];?></label></li>
                                                    </ul>
                                                </div><?php
                                            }
                                        }
                                    }
             
                    
                            ?>
                            </div> <?php 
                          
                
                        }    
                        else{
                            ?>
                            <div class="title" id="title<?=$item['PITEM']?>" onclick=" searchDvw('<?=$item['PITEM']?>');">
                            &ensp;<i class="fa-regular fa-file fa-lg" style="color: #6f7276;"></i><label class="text-item">&ensp;<?=$item['NODENAME']?></label>
                        </div><?php
                        }
                }} }
                
                
                


                ?>
              </div>   
            </div>
            <div class="flex col-2"></div>
            <div class="flex col-60 flex-col">
                <!-- DVWDETAIL -->
                <!-- LINE,ITEMCODE,ITEMNAME,SPECIFICATE,BASEID,USAGE_QTY:R,MEASURE_UNIT,PURCHASE_PRICE:R,CURRENCY,RUNNER_WGT:R,REUSE_RATE:R,SRP_G:R,SRP_U_PRICE:R,PERCENT_DEFECTIVE:R,EFFECTIVE_DATE:C,EXPIRY_DATE:C,SUPPLY_TYPE,REMARK -->
                <!-- ROWNO,BMCITEMCD,CITEMNAME,CITEMSPEC,BMBASETYP,BMQTY,ITEMUNITTYP,BMADDSTDUNITPRC,CURRENCYDISP,RUNNER_WGT,REUSE_RATE,BMADDSRPG,BMADDSRPUNITPRC,BMSCRAPRATE,BMISSUEDT,BMEXPDT,BMSUPPLYTYP,BMREM -->
                <!-- (HIDDEN)BMPHANTOMFLG,CITEMDRAWNO,BMID,ITEMIMGLOC -->
                <div class="table height230"> 
                <table class="table-head table-striped search_table" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                    <thead>
                        <tr class="table-secondary">
                        <!-- LINE,ITEMCODE,ITEMNAME,SPECIFICATE,BASEID,USAGE_QTY:R,MEASURE_UNIT,PURCHASE_PRICE:R,CURRENCY,RUNNER_WGT:R,
                        REUSE_RATE:R,SRP_G:R,SRP_U_PRICE:R,PERCENT_DEFECTIVE:R,EFFECTIVE_DATE:C,EXPIRY_DATE:C,SUPPLY_TYPE,REMARK -->
                                <th class="th-class width2" style="text-align: center; "><?php echo $data['TXTLANG']['LINE']; ?></th>
                                <th class="th-class width8" style="text-align: center; "><?php echo $data['TXTLANG']['ITEMCODE']; ?></th>
                                <th class="th-class width8" style="text-align: center; "><?php echo $data['TXTLANG']['ITEMNAME']; ?></th>
                                <th class="th-class width8" style="text-align: center; "><?php echo $data['TXTLANG']['SPECIFICATE']; ?></th>
                                <th class="th-class width5" style="text-align: center; "><?php echo $data['TXTLANG']['BASEID']; ?></th>
                                <th class="th-class width2" style="text-align: center; "><?php echo $data['TXTLANG']['USAGE_QTY']; ?></th>
                                <th class="th-class width2" style="text-align: center; "><?php echo $data['TXTLANG']['MEASURE_UNIT']; ?></th>
                                <th class="th-class width5" style="text-align: center; "><?php echo $data['TXTLANG']['PURCHASE_PRICE']; ?></th>
                                <th class="th-class width2" style="text-align: center; "><?php echo $data['TXTLANG']['CURRENCY']; ?></th>
                                <th class="th-class width5" style="text-align: center; "><?php echo $data['TXTLANG']['RUNNER_WGT']; ?></th>
                                <th class="th-class width5" style="text-align: center; "><?php echo $data['TXTLANG']['REUSE_RATE']; ?></th>
                                <th class="th-class width5" style="text-align: center; "><?php echo $data['TXTLANG']['SRP_G']; ?></th>
                                <th class="th-class width5" style="text-align: center; "><?php echo $data['TXTLANG']['SRP_U_PRICE']; ?></th>
                                <th class="th-class width2" style="text-align: center; "><?php echo $data['TXTLANG']['PERCENT_DEFECTIVE']; ?></th>
                                <th class="th-class width5" style="text-align: center; "><?php echo $data['TXTLANG']['EFFECTIVE_DATE']; ?></th>
                                <th class="th-class width5" style="text-align: center; "><?php echo $data['TXTLANG']['EXPIRY_DATE']; ?></th>
                                <th class="th-class width5" style="text-align: center; "><?php echo $data['TXTLANG']['SUPPLY_TYPE']; ?></th>
                                <th class="th-class width11" style="text-align: center; "><?php echo $data['TXTLANG']['REMARK']; ?></th>
                        </tr>
                    </thead>
                    <!-- ROWNO,BMCITEMCD,CITEMNAME,CITEMSPEC,BMBASETYP,BMQTY,ITEMUNITTYP,BMADDSTDUNITPRC,CURRENCYDISP,
                    RUNNER_WGT,REUSE_RATE,BMADDSRPG,BMADDSRPUNITPRC,BMSCRAPRATE,BMISSUEDT,BMEXPDT,BMSUPPLYTYP,BMREM -->
                    <!-- type="hidden" -->
                    <!-- (HIDDEN)BMPHANTOMFLG,CITEMDRAWNO,BMID,ITEMIMGLOC -->

                    <tbody id="DVWDETAIL">
                        <?php if(!empty($data['BM']))  {
                        // print_r($data['BM']);  
                        // print_r(count($data['BM']));
                        $minrow = count($data['BM']);
                        for ($i = 1; $i <= count($data['BM']); $i++) {  ?>
                            <!-- ROWNO,BMCITEMCD,CITEMNAME,CITEMSPEC,BMBASETYP,BMQTY,ITEMUNITTYP,BMADDSTDUNITPRC,CURRENCYDISP,
                            RUNNER_WGT,REUSE_RATE,BMADDSRPG,BMADDSRPUNITPRC,BMSCRAPRATE,BMISSUEDT,BMEXPDT,BMSUPPLYTYP,BMREM -->
                            <tr class="tr_border" id="rowId<?=$i?>">
                            <td class="td-class row-id" id="ROWNO_TD<?=$i?>" style="text-align: center; "><?=$i ?></td>
                            <td class="td-class" id="BMCITEMCD_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMCITEMCD']) ? $data['BM'][$i]['BMCITEMCD']: '' ?></td>
                            <td class="td-class" id="CITEMNAME_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['CITEMNAME']) ? $data['BM'][$i]['CITEMNAME']: '' ?></td>
                            <td class="td-class" id="CITEMSPEC_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['CITEMSPEC']) ? $data['BM'][$i]['CITEMSPEC']: '' ?></td>
                            <td class="td-class" id="BMBASETYP_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMBASETYP']) ? $data['BM'][$i]['BMBASETYP']: '' ?></td>
                            <td class="td-class" id="BMQTY_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMQTY']) ? $data['BM'][$i]['BMQTY']: '' ?></td>
                            <td class="td-class" id="ITEMUNITTYP_TD<?=$i?>" style="display: none"><?=isset($data['BM'][$i]['ITEMUNITTYP']) ? $data['BM'][$i]['ITEMUNITTYP']: '' ?></td>
                            <td class="td-class" id="ITEMUNITTYPSTR_TD<?=$i?>"><?php
                            if(isset($data['BM'][$i]['ITEMUNITTYPSTR'])){
                            foreach ($dd2 as $key => $item) { 
                                if($key == $data['BM'][$i]['ITEMUNITTYPSTR'])
                                    {
                                        echo($item);
                                    }
                                }                                 
                            } ?></td>
                            <td class="td-class" id="BMADDSTDUNITPRC_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMADDSTDUNITPRC']) ? $data['BM'][$i]['BMADDSTDUNITPRC']: '' ?></td>
                            <td class="td-class" id="CURRENCYDISP_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['CURRENCYDISP']) ? $data['BM'][$i]['CURRENCYDISP']: '' ?></td>
                            <td class="td-class" id="RUNNER_WGT_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['RUNNER_WGT']) ? $data['BM'][$i]['RUNNER_WGT']: '' ?></td>
                            <td class="td-class" id="REUSE_RATE_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['REUSE_RATE']) ? $data['BM'][$i]['REUSE_RATE']: '' ?></td>
                            <td class="td-class" id="BMADDSRPG_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMADDSRPG']) ? $data['BM'][$i]['BMADDSRPG']: '' ?></td>
                            <td class="td-class" id="BMADDSRPUNITPRC_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMADDSRPUNITPRC']) ? $data['BM'][$i]['BMADDSRPUNITPRC']: '' ?></td>
                            <td class="td-class" id="BMSCRAPRATE_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMSCRAPRATE']) ? $data['BM'][$i]['BMSCRAPRATE']: '' ?></td>
                            <td class="td-class" id="BMISSUEDT_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMISSUEDT']) ? $data['BM'][$i]['BMISSUEDT']: '' ?></td>
                            <td class="td-class" id="BMEXPDT_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMEXPDT']) ? $data['BM'][$i]['BMEXPDT']: '' ?></td>
                            <td class="td-class" id="BMSUPPLYTYP_TD<?=$i?>" style="display: none"><?=isset($data['BM'][$i]['BMSUPPLYTYP']) ? $data['BM'][$i]['BMSUPPLYTYP']: '' ?></td>
                            <td class="td-class" id="BMSUPPLYTYPSTR_TD<?=$i?>"><?php
                            if(isset($data['BM'][$i]['BMSUPPLYTYPSTR'])){
                            foreach ($dd3 as $key => $item) { 
                                if($key == $data['BM'][$i]['BMSUPPLYTYPSTR'])
                                    {
                                        echo($item);
                                    }
                                }                                 
                            } ?></td>
                            <td class="td-class" id="BMREM_TD<?=$i?>" style="text-align: center; "><?=isset($data['BM'][$i]['BMREM']) ? $data['BM'][$i]['BMREM']: '' ?></td>

                            <!-- ROWNO,BMCITEMCD,CITEMNAME,CITEMSPEC,BMBASETYP,BMQTY,ITEMUNITTYP,BMADDSTDUNITPRC,CURRENCYDISP,
                            RUNNER_WGT,REUSE_RATE,BMADDSRPG,BMADDSRPUNITPRC,BMSCRAPRATE,BMISSUEDT,BMEXPDT,BMSUPPLYTYP,BMREM -->
                            <!-- type="hidden" -->
                            <!-- (HIDDEN)BMPHANTOMFLG,CITEMDRAWNO,BMID,ITEMIMGLOC -->
                            <td class="td-hide"><input type="hidden" id="ROWNO<?=$i?>" name="ROWNOA[]" value="<?=$i?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMCITEMCD<?=$i?>" name="BMCITEMCDA[]" value="<?=isset($data['BM'][$i]['BMCITEMCD']) ? $data['BM'][$i]['BMCITEMCD']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="CITEMNAME<?=$i?>" name="CITEMNAMEA[]" value="<?=isset($data['BM'][$i]['CITEMNAME']) ? $data['BM'][$i]['CITEMNAME']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="CITEMSPEC<?=$i?>" name="CITEMSPECA[]" value="<?=isset($data['BM'][$i]['CITEMSPEC']) ? $data['BM'][$i]['CITEMSPEC']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMBASETYP<?=$i?>" name="BMBASETYPA[]" value="<?=isset($data['BM'][$i]['BMBASETYP']) ? $data['BM'][$i]['BMBASETYP']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMQTY<?=$i?>" name="BMQTYA[]" value="<?=isset($data['BM'][$i]['BMQTY']) ? $data['BM'][$i]['BMQTY']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="ITEMUNITTYP<?=$k?>" name="ITEMUNITTYPA[]" value="<?=isset($data['BM'][$i]['ITEMUNITTYP']) ? $data['BM'][$i]['ITEMUNITTYP']: '' ?>"/></td>
                            <td class="td-hide"><input type="hidden" id="BMADDSTDUNITPRC<?=$i?>" name="BMADDSTDUNITPRCA[]" value="<?=isset($data['BM'][$i]['BMADDSTDUNITPRC']) ? $data['BM'][$i]['BMADDSTDUNITPRC']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="CURRENCYDISP<?=$i?>" name="CURRENCYDISPA[]" value="<?=isset($data['BM'][$i]['CURRENCYDISP']) ? $data['BM'][$i]['CURRENCYDISP']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="RUNNER_WGT<?=$i?>" name="RUNNER_WGTA[]" value="<?=isset($data['BM'][$i]['RUNNER_WGT']) ? $data['BM'][$i]['RUNNER_WGT']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="REUSE_RATE<?=$i?>" name="REUSE_RATEA[]" value="<?=isset($data['BM'][$i]['REUSE_RATE']) ? $data['BM'][$i]['REUSE_RATE']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMADDSRPG<?=$i?>" name="BMADDSRPGA[]" value="<?=isset($data['BM'][$i]['BMADDSRPG']) ? $data['BM'][$i]['BMADDSRPG']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMADDSRPUNITPRC<?=$i?>" name="BMADDSRPUNITPRCA[]" value="<?=isset($data['BM'][$i]['BMADDSRPUNITPRC']) ? $data['BM'][$i]['BMADDSRPUNITPRC']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMSCRAPRATE<?=$i?>" name="BMSCRAPRATEA[]" value="<?=isset($data['BM'][$i]['BMSCRAPRATE']) ? $data['BM'][$i]['BMSCRAPRATE']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMISSUEDT<?=$i?>" name="BMISSUEDTA[]" value="<?=isset($data['BM'][$i]['BMISSUEDT']) ? $data['BM'][$i]['BMISSUEDT']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMEXPDT<?=$i?>" name="BMEXPDTA[]" value="<?=isset($data['BM'][$i]['BMEXPDT']) ? $data['BM'][$i]['BMEXPDT']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMSUPPLYTYP<?=$i?>" name="BMSUPPLYTYPA[]" value="<?=isset($data['BM'][$i]['BMSUPPLYTYP']) ? $data['BM'][$i]['BMSUPPLYTYP']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMREM<?=$i?>" name="BMREMA[]" value="<?=isset($data['BM'][$i]['BMREM']) ? $data['BM'][$i]['BMREM']: '' ?>"></td>
 
                            <td class="td-hide"><input type="hidden" id="BMPHANTOMFLG<?=$i?>" name="BMPHANTOMFLGA[]" value="<?=isset($data['BM'][$i]['BMPHANTOMFLG']) ? $data['BM'][$i]['BMPHANTOMFLG']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="CITEMDRAWNO<?=$i?>" name="CITEMDRAWNOA[]" value="<?=isset($data['BM'][$i]['CITEMDRAWNO']) ? $data['BM'][$i]['CITEMDRAWNO']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMID<?=$i?>" name="BMIDA[]" value="<?=isset($data['BM'][$i]['BMID']) ? $data['BM'][$i]['BMID']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="ITEMIMGLOC<?=$i?>" name="ITEMIMGLOCA[]" value="<?=isset($data['BM'][$i]['ITEMIMGLOC']) ? $data['BM'][$i]['ITEMIMGLOC']: '' ?>"></td>
                            <!-- ITEMUNITTYPSTR,BMSUPPLYTYPSTR -->
                            <td class="td-hide"><input type="hidden" id="ITEMUNITTYPSTR<?=$i?>" name="ITEMUNITTYPSTRA[]" value="<?=isset($data['BM'][$i]['ITEMUNITTYPSTR']) ? $data['BM'][$i]['ITEMUNITTYPSTR']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMSUPPLYTYPSTR<?=$i?>" name="BMSUPPLYTYPSTRA[]" value="<?=isset($data['BM'][$i]['BMSUPPLYTYPSTR']) ? $data['BM'][$i]['BMSUPPLYTYPSTR']: '' ?>"></td>
                            <!-- BMQTY2, BMCOMB, WCCD, WCNAME, DIVISIONTYP -->
                            <!-- <td class="td-hide"><input type="hidden" id="BMQTY2<?=$i?>" name="BMQTY2A[]" value="<?=isset($data['BM'][$i]['BMQTY2']) ? $data['BM'][$i]['BMQTY2']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="BMCOMB<?=$i?>" name="BMCOMBA[]" value="<?=isset($data['BM'][$i]['BMCOMB']) ? $data['BM'][$i]['BMCOMB']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="WCCD<?=$i?>" name="WCCDA[]" value="<?=isset($data['BM'][$i]['WCCD']) ? $data['BM'][$i]['WCCD']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="WCNAME<?=$i?>" name="WCNAMEA[]" value="<?=isset($data['BM'][$i]['WCNAME']) ? $data['BM'][$i]['WCNAME']: '' ?>"></td>
                            <td class="td-hide"><input type="hidden" id="DIVISIONTYP<?=$i?>" name="DIVISIONTYPA[]" value="<?=isset($data['BM'][$i]['DIVISIONTYP']) ? $data['BM'][$i]['DIVISIONTYP']: '' ?>"></td> -->
                            <!-- <td class="td-hide"><?=$i?></td> -->
                            </tr> <?php
                            // break;
                        }

                        if($minrow < $maxrow) {
                            for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                                <tr class="tr_border" id="rowId<?=$i?>">
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
                                    <td class="td-class"></td>
                                    <td class="td-class"></td>
                                    <td class="td-class"></td>
                                    <td class="td-class"></td>
                                </tr> <?php 
                            }
                        }
                    } else {                            
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="tr_border" id="rowId<?=$i?>">
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
                                <td class="td-class"></td>
                                <td class="td-class"></td>
                                <td class="td-class"></td>
                                <td class="td-class"></td>
                            </tr><?php
                        }
                    } ?>
                </tbody>

                    <!-- <tfoot>
                        <tr class="tr_border" style="background-color: white;">
                            <td class="td-class" colspan="8"><?=str_repeat('&emsp;', 2).$data['TXTLANG']['ROWCOUNT'].str_repeat('&ensp;', 2); ?><label class="font-size14" id="rowCount"><?=$minrow;?></label></td>
                        </tr>
                    </tfoot> -->
                </table>
                </div>
                <div class="font-size14"><?php echo $data['TXTLANG']['ROWCOUNT']; ?>&emsp;<label id="record"><?=$minrow?></label></div>

            </div>
        </div>
    </div>

    <div class="d-flex">
        <div class="flex  p-2">
            <div class="flex col-40 flex-col">
                <!--  ITEMIMGLOC-->

            </div>
            <div class="flex col-2"></div>
            <div class="flex col-60 flex-col">
                <!-- COMMIT UPDATE DELETE ENTRY END -->
                <div class="flex  p-2">
                    <div class="flex col-50 " style="justify-content: left;">
                        <button type="button" class="btn btn-action" id="commitA" name="commitA" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['COMMIT']; ?></button>&emsp;&emsp;

                        <button type="button" class="btn btn-action" id="updateA" name="updateA" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?></button>&emsp;&emsp;

                        <button type="button" class="btn btn-action" id="deleteA" name="deleteA" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?></button>

                    </div>
                    <div class="flex col-50 " style="justify-content: right;">
                        <button type="button" class="btn btn-action" id="entry" name="entry" onclick="entry1();"><?php echo $data['TXTLANG']['ENTRY']; ?></button>&emsp;&emsp;

                        <button type="button" class="btn btn-action" id="end" name="end"
                        onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');">
                        <?php echo $data['TXTLANG']['END']; ?></button>

                    </div>
                </div>

                <!-- BASEID BMBASETYP ITEMCLONE COPY -->
                <div class="flex  p-2">
                    <label class="label-width16"><?php echo $data['TXTLANG']['BASEID']; ?></label>
                    <input class="form-control width19 " type="text" id="BMBASETYP" name="BMBASETYP" value="<?=isset($data['BMBASETYP']) ? $data['BMBASETYP']: ''?>" />
                    <label class="label-width31" type="hidden"></label>
                    <input class="form-control width16 " type="text" id="ITEMCLONE" name="ITEMCLONE" value="<?=isset($data['ITEMCLONE']) ? $data['ITEMCLONE']: ''?>" />
                    <div class="fix-icon" >
                            <a href="#" id="guideindex3"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    <button type="submit" class="btn btn-action" id="copy" name="copy" ><?php echo $data['TXTLANG']['COPY']; ?></button>&emsp;&emsp;

                </div>

                <!-- C_ITEMCODE BMCITEMCD CITEMNAME -->
                <div class="flex  p-2">
                    <label class="label-width16"><?php echo $data['TXTLANG']['C_ITEMCODE']; ?></label>
                    <input class="form-control width16 req" type="text" id="BMCITEMCD" name="BMCITEMCD" value="<?=isset($data['BMCITEMCD']) ? $data['BMCITEMCD']: ''?>" />
                    <div class="fix-icon" >
                            <a href="#" id="guideindex4"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    <input class="form-control width43 " type="text" id="CITEMNAME" name="CITEMNAME" value="<?=isset($data['CITEMNAME']) ? $data['CITEMNAME']: ''?>" readonly/>

                </div>

                <!-- CITEMSPEC CITEMDRAWNO BMPHANTOMFLG PHANTOM -->
                <div class="flex  p-2">
                    <label class="label-width16" type="hidden"></label>
                    <input class="form-control width37 " type="text" id="CITEMSPEC" name="CITEMSPEC" value="<?=isset($data['CITEMSPEC']) ? $data['CITEMSPEC']: ''?>" readonly/>
                    <input class="form-control width24 " type="text" id="CITEMDRAWNO" name="CITEMDRAWNO" value="<?=isset($data['CITEMDRAWNO']) ? $data['CITEMDRAWNO']: ''?>" readonly/>&emsp;
                    <input type="checkbox" id="BMPHANTOMFLG" name="BMPHANTOMFLG" value="T" style="width: 15px"
                        <?php echo (!empty($data['BMPHANTOMFLG']) && $data['BMPHANTOMFLG'] == 'T') ? 'checked' : '' ?> disabled/>&emsp;
                    <label class="label-width18" style="color:gray;"><?php echo $data['TXTLANG']['PHANTOM']; ?></label>

                </div>
                <!-- USAGE_QTY BMQTY ITEMUNITTYP PURCHASE_PRICE BMADDSTDUNITPRC CURRENCYDISP -->
                <div class="flex  p-2">
                    <label class="label-width16"><?php echo $data['TXTLANG']['USAGE_QTY']; ?></label>
                    <input class="form-control width16 req" type="text" id="BMQTY" name="BMQTY" value="<?=isset($data['BMQTY']) ? $data['BMQTY']: ''?>" 
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <select class="width10 option-text form-select form-select-sm " id="ITEMUNITTYP" name="ITEMUNITTYP"> 
                        <option value=""></option>
                        <?php foreach ($dd2 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php }?>
                    </select>
                    <label class="label-width2" type="hidden"></label>
                    <label class="label-width22"><?php echo $data['TXTLANG']['PURCHASE_PRICE']; ?></label>
                    <input class="form-control width16 " type="text" id="BMADDSTDUNITPRC" name="BMADDSTDUNITPRC" value="<?=isset($data['BMADDSTDUNITPRC']) ? $data['BMADDSTDUNITPRC']: ''?>" readonly
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <input class="form-control width7 " type="text" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=isset($data['LOAD']['CURRENCYDISP']) ? $data['LOAD']['CURRENCYDISP']: ''?>" readonly/>

                </div>

                <!-- RUNNER_WGT RUNNER_WGT G REUSE_RATE REUSE_RATE % -->
                <div class="flex  p-2">
                    <label class="label-width16"><?php echo $data['TXTLANG']['RUNNER_WGT']; ?></label>
                    <input class="form-control width14 " type="text" id="RUNNER_WGT" name="RUNNER_WGT" value="<?=isset($data['RUNNER_WGT']) ? $data['RUNNER_WGT']: '0.00'?>" 
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <label class="label-width14"><?php echo $data['TXTLANG']['G']; ?></label>
                    <label class="label-width22"><?php echo $data['TXTLANG']['REUSE_RATE']; ?></label>
                    <input class="form-control width8 " type="text" id="REUSE_RATE" name="REUSE_RATE" value="<?=isset($data['REUSE_RATE']) ? $data['REUSE_RATE']: '0.00'?>" 
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <label class="label-width4">%</label>

                </div>

                <!-- SRP_G BMADDSRPG G SRP_U_PRICE BMADDSRPUNITPRC CURRENCYDISP /KG -->
                <div class="flex  p-2">
                    <label class="label-width16"><?php echo $data['TXTLANG']['SRP_G']; ?></label>
                    <input class="form-control width14 " type="text" id="BMADDSRPG" name="BMADDSRPG" value="<?=isset($data['BMADDSRPG']) ? $data['BMADDSRPG']: '0.00'?>" 
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <label class="label-width14"><?php echo $data['TXTLANG']['G']; ?></label>
                    <label class="label-width22"><?php echo $data['TXTLANG']['SRP_U_PRICE']; ?></label>
                    <input class="form-control width16 " type="text" id="BMADDSRPUNITPRC" name="BMADDSRPUNITPRC" value="<?=isset($data['BMADDSRPUNITPRC']) ? $data['BMADDSRPUNITPRC']: '0.00'?>" 
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <input class="form-control width7 " type="text" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=isset($data['LOAD']['CURRENCYDISP']) ? $data['LOAD']['CURRENCYDISP']: ''?>" readonly/>
                    <label class="label-width4"><?php echo $data['TXTLANG']['/KG']; ?></label>

                </div>

                <!-- PERCENT_DEFECTIVE BMSCRAPRATE % SUPPLY_TYPE PROCUREMENT -->
                <div class="flex  p-2">
                    <label class="label-width16"><?php echo $data['TXTLANG']['PERCENT_DEFECTIVE']; ?></label>
                    <input class="form-control width8 " type="text" id="BMSCRAPRATE" name="BMSCRAPRATE" value="<?=isset($data['BMSCRAPRATE']) ? $data['BMSCRAPRATE']: '0.00'?>" 
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <label class="label-width20">%</label>
                    <label class="label-width22"><?php echo $data['TXTLANG']['SUPPLY_TYPE']; ?></label>
                    <select class="width22 option-text form-select form-select-sm req" id="BMSUPPLYTYP" name="BMSUPPLYTYP">
                        <option value=""></option>
                        <?php foreach ($dd3 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['BMSUPPLYTYP']) && $data['BMSUPPLYTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>

                </div>

                <!-- EFFECTIVE_DATE BMISSUEDT EXPIRY_DATE BMEXPDT -->
                <div class="flex  p-2">
                    <label class="label-width16"><?php echo $data['TXTLANG']['EFFECTIVE_DATE']; ?></label>
                    <input class="form-control width14 " type="date" id="BMISSUEDT" name="BMISSUEDT" value="<?=!empty($data['BMISSUEDT']) ? date('Y-m-d', strtotime($data['BMISSUEDT'])): date('Y-m-d'); ?>"/>
                    <label class="label-width14" type="hidden"></label>
                    <label class="label-width22"><?php echo $data['TXTLANG']['EXPIRY_DATE']; ?></label>
                    <input class="form-control width16 req" type="date" id="BMEXPDT" name="BMEXPDT" value="<?=!empty($data['LOAD']['BMEXPDT']) ? date('Y-m-d', strtotime($data['LOAD']['BMEXPDT'])): date('Y-m-d'); ?>"/>

                </div>

                <!-- REMARK BMREM --> 
                <div class="flex  p-2">
                    <label class="label-width16"><?php echo $data['TXTLANG']['REMARK']; ?></label>

                    <input class="form-control width50 " type="text" id="BMREM" name="BMREM" value="<?=isset($data['BMREM']) ? $data['BMREM']: ''?>" />

                </div>

                <!-- OK -->
                <div class="flex  p-2">
                    <button type="button" class="btn btn-action" id="ok" name="ok"  >
                    <?php echo $data['TXTLANG']['OK']; ?></button>&emsp;&emsp;

                    <input class="form-control width10 " type="text" id="KEEPSTATUS" name="KEEPSTATUS" value="<?=isset($data['KEEPSTATUS']) ? $data['KEEPSTATUS']: 'ENT'?>" />
                    <input class="form-control width10 " type="text" id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''?>" readonly/>
                    <input class="form-control width10 " type="text" id="ITEMUNITTYPSTR" name="ITEMUNITTYPSTR" value="<?=isset($data['ITEMUNITTYPSTR']) ? $data['ITEMUNITTYPSTR']: ''?>" readonly/>
                    <!-- BMQTY2, BMCOMB, WCCD, WCNAME, DIVISIONTYP -->
                    <!-- <input class="form-control width10 " type="text" id="BMQTY2" name="BMQTY2" value="<?=isset($data['BMQTY2']) ? $data['BMQTY2']: ''?>" readonly/>
                    <input class="form-control width10 " type="text" id="BMCOMB" name="BMCOMB" value="<?=isset($data['BMCOMB']) ? $data['BMCOMB']: ''?>" readonly/>
                    <input class="form-control width10 " type="text" id="WCCD" name="WCCD" value="<?=isset($data['WCCD']) ? $data['WCCD']: ''?>" readonly/>
                    <input class="form-control width10 " type="text" id="WCNAME" name="WCNAME" value="<?=isset($data['WCNAME']) ? $data['WCNAME']: ''?>" readonly/>
                    <input class="form-control width10 " type="text" id="DIVISIONTYP" name="DIVISIONTYP" value="<?=isset($data['DIVISIONTYP']) ? $data['DIVISIONTYP']: ''?>" readonly/> -->

                </div>

            </div>
        </div>
    </div>

    </form>


    <!-- -------------------------------------------------------------------------------- -->
    <div id="loading" class="on" style="display: none;">
    <div class="cv-spinner"><div class="spinner"></div></div>
    </div>

</body>

<script src="./js/script.js" ></script>
<script type="text/javascript">

$(document).ready(function() {

    if(document.getElementById('KEEPSTATUS').value == "ENT"){
        // console.log('ENT');
        document.getElementById("ok").disabled = false;
        document.getElementById("updateA").disabled = true;
        document.getElementById("deleteA").disabled = true;
    }
    else if(document.getElementById('KEEPSTATUS').value == "UPD"){
        // console.log('UPD');
        document.getElementById("ok").disabled = true;
        document.getElementById("updateA").disabled = false;
        document.getElementById("deleteA").disabled = false;
    }
    else{
        document.getElementById('KEEPSTATUS').value;
        // console.log(document.getElementById('KEEPSTATUS').value);
        // console.log('NONE');
        document.getElementById("updateA").disabled = true;
        document.getElementById("deleteA").disabled = true;
    }

        var index = 0; var id;
        var index = '<?php echo (isset($data['BM']) ? count($data['BM']) : 0); ?>';
        // console.log(index);
        //BMCITEMCD BMQTY PROCUREMENT BMEXPDT
        ok.click(function() {
            if($('#BMCITEMCD').val() == '' || $('#BMQTY').val() == '' || $('#PROCUREMENT').val() == '' || $('#BMEXPDT').val() == '' ) {
                validationDialog();
                return false;
            }
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);

            // console.log($("#ITEMUNITTYP option:selected").text());
            var newRow = $('<tr class="tr_border" id=rowId'+index+'>');
            var cols = "";

            cols += '<td class="td-class row-id" id="ROWNO_TD'+index+'" style="text-align: center; ">'+index+'</td>';
            cols += '<td class="td-class" id="BMCITEMCD_TD'+index+'" style="text-align: center; ">'+ $('#BMCITEMCD').val() +'</td>';
            cols += '<td class="td-class" id="CITEMNAME_TD'+index+'" style="text-align: center; ">'+ $('#CITEMNAME').val() +'</td>';
            cols += '<td class="td-class" id="CITEMSPEC_TD'+index+'" style="text-align: center; ">'+ $('#CITEMSPEC').val() +'</td>';
            cols += '<td class="td-class" id="BMBASETYP_TD'+index+'" style="text-align: center; ">'+ $('#BMBASETYP').val() +'</td>';
            cols += '<td class="td-class" id="BMQTY_TD'+index+'" style="text-align: center; ">'+ $('#BMQTY').val() +'</td>';
            cols += '<td class="td-class" id="ITEMUNITTYP_TD'+index+'" style="display: none">'+$("#ITEMUNITTYP").val()+'</td>';//dd
            cols += '<td class="td-class" id="ITEMUNITTYPSTR_TD'+index+'"> '+ $("#ITEMUNITTYP option:selected").text() +'</td>';
            cols += '<td class="td-class" id="BMADDSTDUNITPRC_TD'+index+'" style="text-align: center; ">'+ $('#BMADDSTDUNITPRC').val() +'</td>';
            cols += '<td class="td-class" id="CURRENCYDISP_TD'+index+'" style="text-align: center; ">'+ $('#CURRENCYDISP').val() +'</td>';
            cols += '<td class="td-class" id="RUNNER_WGT_TD'+index+'" style="text-align: center; ">'+ $('#RUNNER_WGT').val() +'</td>';
            cols += '<td class="td-class" id="REUSE_RATE_TD'+index+'" style="text-align: center; ">'+ $('#REUSE_RATE').val() +'</td>';
            cols += '<td class="td-class" id="BMADDSRPG_TD'+index+'" style="text-align: center; ">'+ $('#BMADDSRPG').val() +'</td>';
            cols += '<td class="td-class" id="BMADDSRPUNITPRC_TD'+index+'" style="text-align: center; ">'+ $('#BMADDSRPUNITPRC').val() +'</td>';
            cols += '<td class="td-class" id="BMSCRAPRATE_TD'+index+'" style="text-align: center; ">'+ $('#BMSCRAPRATE').val() +'</td>';
            cols += '<td class="td-class" id="BMISSUEDT_TD'+index+'" style="text-align: center; ">'+ $('#BMISSUEDT').val().replaceAll("-","/") +'</td>';
            cols += '<td class="td-class" id="BMEXPDT_TD'+index+'" style="text-align: center; ">'+ $('#BMEXPDT').val().replaceAll("-","/") +'</td>';
            cols += '<td class="td-class" id="BMSUPPLYTYP_TD'+index+'" style="display: none">'+$("#BMSUPPLYTYP").val()+'</td>';//dd
            cols += '<td class="td-class" id="BMSUPPLYTYPSTR_TD'+index+'"> '+ $("#BMSUPPLYTYP option:selected").text() +'</td>';
            cols += '<td class="td-class" id="BMREM_TD'+index+'" style="text-align: center; ">'+ $('#BMREM').val() +'</td>';
            // cols += '<td class="td-class" id="ITEMUNITTYP_TD'+index+'">'+$("#ITEMUNITTYP option:selected").text()+'</td>';//dd
            
            cols += '<td class="td-hide"><input type="hidden" id="ROWNO'+index+'" name="ROWNOA[]" value='+index+'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMCITEMCD'+index+'" name="BMCITEMCDA[]"   value='+ $('#BMCITEMCD').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="CITEMNAME'+index+'" name="CITEMNAMEA[]"   value='+ $('#CITEMNAME').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="CITEMSPEC'+index+'" name="CITEMSPECA[]"   value='+ $('#CITEMSPEC').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMBASETYP'+index+'" name="BMBASETYPA[]"   value='+ $('#BMBASETYP').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMQTY'+index+'" name="BMQTYA[]"   value='+ $('#BMQTY').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ITEMUNITTYP'+index+'" name="ITEMUNITTYPA[]"   value='+ $('#ITEMUNITTYP').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMADDSTDUNITPRC'+index+'" name="BMADDSTDUNITPRCA[]"   value='+ $('#BMADDSTDUNITPRC').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="CURRENCYDISP'+index+'" name="CURRENCYDISPA[]"   value='+ $('#CURRENCYDISP').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="RUNNER_WGT'+index+'" name="RUNNER_WGTA[]"   value='+ $('#RUNNER_WGT').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="REUSE_RATE'+index+'" name="REUSE_RATEA[]"   value='+ $('#REUSE_RATE').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMADDSRPG'+index+'" name="BMADDSRPGA[]"   value='+ $('#BMADDSRPG').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMADDSRPUNITPRC'+index+'" name="BMADDSRPUNITPRCA[]"   value='+ $('#BMADDSRPUNITPRC').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMSCRAPRATE'+index+'" name="BMSCRAPRATEA[]"   value='+ $('#BMSCRAPRATE').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMISSUEDT'+index+'" name="BMISSUEDTA[]"   value='+ $('#BMISSUEDT').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMEXPDT'+index+'" name="BMEXPDTA[]"   value='+ $('#BMEXPDT').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMSUPPLYTYP'+index+'" name="BMSUPPLYTYPA[]"   value='+ $('#BMSUPPLYTYP').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMREM'+index+'" name="BMREMA[]"   value='+ $('#BMREM').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMPHANTOMFLG'+index+'" name="BMPHANTOMFLGA[]"   value='+ $('#BMPHANTOMFLG').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="CITEMDRAWNO'+index+'" name="CITEMDRAWNOA[]"   value='+ $('#CITEMDRAWNO').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMID'+index+'" name="BMIDA[]"   value='+ $('#BMID').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ITEMIMGLOC'+index+'" name="ITEMIMGLOCA[]"   value='+ $('#ITEMIMGLOC').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ITEMUNITTYPSTR'+index+'" name="ITEMUNITTYPSTRA[]"   value='+ $('#ITEMUNITTYPSTR').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="BMSUPPLYTYPSTR'+index+'" name="BMSUPPLYTYPSTRA[]"   value='+ $('#BMSUPPLYTYPSTR').val() +'></td>';
            //BMQTY2, BMCOMB, WCCD, WCNAME, DIVISIONTYP
            // cols += '<td class="td-hide"><input type="hidden" id="BMQTY2'+index+'" name="BMQTY2A[]"   value='+ $('#BMQTY2').val() +'></td>';
            // cols += '<td class="td-hide"><input type="hidden" id="BMCOMB'+index+'" name="BMCOMBA[]"   value='+ $('#BMCOMB').val() +'></td>';
            // cols += '<td class="td-hide"><input type="hidden" id="WCCD'+index+'" name="WCCDA[]"   value='+ $('#WCCD').val() +'></td>';
            // cols += '<td class="td-hide"><input type="hidden" id="WCNAME'+index+'" name="WCNAMEA[]"   value='+ $('#WCNAME').val() +'></td>';
            // cols += '<td class="td-hide"><input type="hidden" id="DIVISIONTYP'+index+'" name="DIVISIONTYPA[]"   value='+ $('#DIVISIONTYP').val() +'></td>';

            if(index <= 5) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $("#search_table tbody").append(newRow);
            }
            $('#record').html(index);
            // calculateTotal();
            keepBomData();
            return entry1();
        });
// TESTBOMMAIN1
// TESTBOMPRODUCT
        deleteA.click(function() {
            // let id = $('#ROWNO').val();
            // console.log(id);
            // console.log($('#BMCITEMCD'+id).val());
            // console.log($('#BMCITEMCD'+id).val());
            // if($('#BMCITEMCD'+id).val() == '' || $('#BMCITEMCD'+id).val() == undefined) 
            if(index > 0 && id != null)
            {
                console.log("deleteA else");
                // console.log(id); BMCITEMCD
                // document.getElementById("search_table").deleteRow(id);
                $('#rowId'+id).closest("tr").remove();
                 if(index <= 5) {
                    emptyRow(index);
                }
                index--;
                $(".row-id").each(function (i) {
                    $(this).text(i+1);
                }); 

                $('#record').html(index);
                changeRowId();
                unsetBomItemData(id);
                // calculateTotal();
                id = null;
                return entry1();
            }

            
        });

        $(document).on("click", ".search_table tr", function(event) {
        // $('table#search_table tbody tr').click(function () {
            // $('table#search_table tbody tr').removeAttr('id');
        
            // $(this).attr('id', 'click-row');

            let item = $(this).closest('tr').children('td');

            $('#KEEPSTATUS').val('UPD');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {

                id = item.eq(0).text();

                let rows = document.getElementsByTagName('tr');
                // let rows = document.getElementsByClassName('clickRow');
                // console.log(rows);
                $(".row-id").each(function (i) {
                    rows[i+1].classList.remove("selected-row");
                }); 
                // console.log(id);
                if(id != '') {
                    rows[id].classList.add("selected-row"); 
                }
                
                document.getElementById("ok").disabled = true;
                document.getElementById("updateA").disabled = false;
                document.getElementById("deleteA").disabled = false;
                // document.getElementById("OK").disabled = true;
                // console.log(item.eq(6).val());
                // console.log(item.eq(6).text());//BG
                // console.log(item.eq(7).val());
                // console.log(item.eq(7).text());//Bags
                // console.log(item.eq(17).val());
                // console.log(item.eq(17).text());//Bags
                // console.log(item.eq(18).val());
                // console.log(item.eq(18).text());//BG
                //        0       1         2         3         4       5        6     +1       7             8
                // <!-- ROWNO,BMCITEMCD,CITEMNAME,CITEMSPEC,BMBASETYP,BMQTY,ITEMUNITTYP,BMADDSTDUNITPRC,CURRENCYDISP,
                //      9         10        11           12             13         14      15       16    +1     17
                // RUNNER_WGT,REUSE_RATE,BMADDSRPG,BMADDSRPUNITPRC,BMSCRAPRATE,BMISSUEDT,BMEXPDT,BMSUPPLYTYP,BMREM -->17
                // <!-- type="hidden" -->
                //                    37          38      39      40
                // <!-- (HIDDEN)BMPHANTOMFLG,CITEMDRAWNO,BMID,ITEMIMGLOC -->4
                //             41             42         43      44    45      46        46
                // <!-- ITEMUNITTYPSTR,BMSUPPLYTYPSTR,BMQTY2, BMCOMB, WCCD, WCNAME, DIVISIONTYP -->


                // text BMBASETYP BMCITEMCD CITEMNAME CITEMSPEC CITEMDRAWNO BMQTY BMADDSTDUNITPRC 
                // RUNNER_WGT REUSE_RATE BMADDSRPG BMADDSRPUNITPRC BMSCRAPRATE BMISSUEDT BMEXPDT BMREM
                // dd ITEMUNITTYP BMSUPPLYTYP
                //checkbox BMPHANTOMFLG
                // $('#WCCD').attr('readonly', true).css('background-color', 'lightgray');
                // $('#ROWNO').val(item.eq(44).text());//text
                $('#ROWNO').val(item.eq(0).text());//text
                $('#BMBASETYP').val(item.eq(4).text());//text
                $('#BMCITEMCD').val(item.eq(1).text());//text
                $('#CITEMNAME').val(item.eq(2).text());//text
                $('#CITEMSPEC').val(item.eq(3).text());//text
                $('#CITEMDRAWNO').val(item.eq(38).text());//text
                $('#BMQTY').val(item.eq(5).text());//text
                $('#BMADDSTDUNITPRC').val(item.eq(8).text());//text
                $('#RUNNER_WGT').val(item.eq(10).text());//text
                $('#REUSE_RATE').val(item.eq(11).text());//text
                $('#BMADDSRPG').val(item.eq(12).text());//text
                $('#BMADDSRPUNITPRC').val(item.eq(13).text());//text
                $('#BMSCRAPRATE').val(item.eq(14).text());//text
                $('#BMREM').val(item.eq(19).text());//text
                $('#ITEMUNITTYPSTR').val(item.eq(6).text());//text

                // $('#BMQTY2').val(item.eq(43).text());//text
                // $('#BMCOMB').val(item.eq(44).text());//text
                // $('#WCCD').val(item.eq(45).text());//text
                // $('#WCNAME').val(item.eq(46).text());//text
                // $('#DIVISIONTYP').val(item.eq(47).text());//text

                // console.log(formatDate(item.eq(15).text()));
                // console.log(item.eq(6).text());
                // console.log(item.eq(17).text());

                // $('#BMISSUEDT').val(formatDate(item.eq(15).text()));//date
                // $('#BMEXPDT').val(formatDate(item.eq(16).text()));//date
                $('#BMISSUEDT').val(item.eq(15).text().replaceAll("/","-"));//date
                $('#BMEXPDT').val(item.eq(16).text().replaceAll("/","-"));//date

                
                document.getElementById("ITEMUNITTYP").value = item.eq(6).text();//dd
                document.getElementById("BMSUPPLYTYP").value = item.eq(17).text();//dd

                $('#BMPHANTOMFLG').val(item.eq(39).text());
                if (item.eq(39).text() == "T") {
                    $('#BMPHANTOMFLG').val(item.eq(39).text());
                    $('#BMPHANTOMFLG').prop("checked", true)
                } else {
                    $('#BMPHANTOMFLG').val('F');
                    $('#BMPHANTOMFLG').prop("checked", false)
                }//checkbox
            }
            else{
                document.getElementById("ok").disabled = false;
                document.getElementById("updateA").disabled = true;
                document.getElementById("deleteA").disabled = true;
                // document.getElementById("OK").disabled = true;
                // console.log(item.eq(5).text());
        
                // WCCD WCNAME DIVISIONCD STAFFCD WCTYP WCDISPLAYFLG WCSTDHOURRATE WCSTDCOST WCHOURRATE WCCOST
                // $('#WCCD').attr('readonly', true).css('background-color', 'lightgray');

                // text BMBASETYP BMCITEMCD CITEMNAME CITEMSPEC CITEMDRAWNO BMQTY BMADDSTDUNITPRC 
                // RUNNER_WGT REUSE_RATE BMADDSRPG BMADDSRPUNITPRC BMSCRAPRATE BMISSUEDT BMEXPDT BMREM
                $('#ROWNO').val('');//text 
                $('#BMBASETYP').val('');//text 
                $('#BMCITEMCD').val('');//text
                $('#CITEMNAME').val('');//text
                $('#CITEMSPEC').val('');//text
                $('#CITEMDRAWNO').val('');//text
                $('#BMQTY').val('');//text
                $('#BMADDSTDUNITPRC').val('');//text
                $('#RUNNER_WGT').val('');//text
                $('#REUSE_RATE').val('');//text
                $('#BMADDSRPG').val('');//text
                $('#BMADDSRPUNITPRC').val('');//text
                $('#BMSCRAPRATE').val('');//text
                $('#BMISSUEDT').val('');//text
                $('#BMEXPDT').val('');//text
                $('#BMREM').val('');//text

                // dd ITEMUNITTYP BMSUPPLYTYP
                document.getElementById("ITEMUNITTYP").value = '';//dd
                document.getElementById("BMSUPPLYTYP").value = '';//dd

                //checkbox BMPHANTOMFLG
                $('#BMPHANTOMFLG').val('F');//checkbox
                $('#BMPHANTOMFLG').prop("checked", false)//checkbox


            }

            if(document.getElementById('KEEPSTATUS').value == "ENT"){
                // console.log('ENT');
                document.getElementById("ok").disabled = false;
                document.getElementById("updateA").disabled = true;
                document.getElementById("deleteA").disabled = true;
            }
            else if(document.getElementById('KEEPSTATUS').value == "UPD"){
                // console.log('UPD');
                document.getElementById("ok").disabled = true;
                document.getElementById("updateA").disabled = false;
                document.getElementById("deleteA").disabled = false;
            }
            else{
                document.getElementById('KEEPSTATUS').value;
                // console.log(document.getElementById('KEEPSTATUS').value);
                // console.log('NONE');
                document.getElementById("updateA").disabled = true;
                document.getElementById("deleteA").disabled = true;
            }
        });
});

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



// function printDialog() {
//        return questionDialog(4, '<?=$lang['question4']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
//     }



</script>


</html>
