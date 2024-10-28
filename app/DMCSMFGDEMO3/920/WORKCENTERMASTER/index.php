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
    <form class="form" method="POST" id="workcentermaster" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">


        <!-- WC_CODE	WCCD_S	SEARCH -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">

                    <label class="label-width20"><?php echo $data['TXTLANG']['WC_CODE']; ?></label>

                    <input class="form-control width25 " type="text" id="WCCD_S" name="WCCD_S" value="<?=isset($data['WCCD_S']) ? $data['WCCD_S']: ''?>" />

                    <div class="fix-icon" >
                        <a href="#" id="guideindex1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>

                    <input class="form-control width25 " type="hidden" id="KEEPSTATUS" name="KEEPSTATUS" value="<?=isset($data['KEEPSTATUS']) ? $data['KEEPSTATUS']: 'ENT'?>" />

                </div>             
                <div class="flex .col45" style="justify-content: right;">
                    <button type="submit"  class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="$('#loading').show();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp;
                </div>
            </div>
        </div>
    
        <div class="d-flex p-2">
            <div class="table height330"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                      <tr class="table-secondary">
                        <!-- WC_CODE,WORK_CENTER_NAME,DIVISIONNAME,PERSON_RESPONSE,WC_TYPE,CHART,STD_HOUR_RATE:R,STD_EXPENSE_RATE:R,CUR_HOUR_RATE:R,CUR_EXPENSE_RATE:R,SPACE -->
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['WC_CODE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['WORK_CENTER_NAME']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['DIVISIONNAME']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['PERSON_RESPONSE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['WC_TYPE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['CHART']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['STD_HOUR_RATE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['STD_EXPENSE_RATE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['CUR_HOUR_RATE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['CUR_EXPENSE_RATE']; ?></th>
                      </tr>
                  </thead>
                  <tbody>

                  <?php if(!empty($data['WORK']))  {
                    // print_r($data['WORK']);
                        $rowno = 0;
                        foreach ($data['WORK'] as $key => $value) {
                            if(is_array($value)) {
                              $minrow = count($data['WORK']) ;
                              ++$rowno;
                            //   print_r($value);
                            
                             ?>
                             <!-- WCCD,WCNAME,DIVISIONNAME,STAFFNAME,WCTYP,WCDISPLAYFLG,WCSTDHOURRATE,WCSTDCOST,WCHOURRATE,WCCOST,SPACE --> 
                                <tr class="tr_border table-secondary">
                                    <td class="td-class"><?=isset($value['WCCD']) ? $value['WCCD']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WCNAME']) ? $value['WCNAME']: '' ?></td>
                                    <td class="td-class"><?=isset($value['DIVISIONNAME']) ? $value['DIVISIONNAME']: '' ?></td>
                                    <td class="td-class"><?=isset($value['STAFFNAME']) ? $value['STAFFNAME']: '' ?></td>
                                    <td class="td-class" style="display: none"><?=isset($value['WCTYP']) ? $value['WCTYP']: '' ?></td>                                    
                                    <td class="td-class"><?php 
                                    if(isset($value['WCTYP'])){
                                    foreach ($dd1 as $key => $item) { 
                                            if($key == $value['WCTYP'])
                                                {
                                                    echo($item);
                                                }
                                            }                                 
                                    } ?></td>
                                    <td class="td-class"><?=isset($value['WCDISPLAYFLG']) ? $value['WCDISPLAYFLG']: '' ?></td>
                                    <td class="td-class"><?=isset($value['WCSTDHOURRATE']) ? number_format(str_replace(",", "", $value['WCSTDHOURRATE']), 2): '0.00' ?></td>
                                    <td class="td-class"><?=isset($value['WCSTDCOST']) ? number_format(str_replace(",", "", $value['WCSTDCOST']), 2): '0.00' ?></td>
                                    <td class="td-class"><?=isset($value['WCHOURRATE']) ? number_format(str_replace(",", "", $value['WCHOURRATE']), 2): '0.00' ?></td>
                                    <td class="td-class"><?=isset($value['WCCOST']) ? number_format(str_replace(",", "", $value['WCCOST']), 2): '0.00' ?></td>
                                    <td class="td-hide"><?=isset($value['DIVISIONCD']) ? $value['DIVISIONCD']: '' ?></td>
                                    <td class="td-hide"><?=isset($value['STAFFCD']) ? $value['STAFFCD']: '' ?></td>

                                    <!-- type="hidden" -->
                                </tr> <?php 
                                } else {
                                    $minrow = 1; 
                                    // print_r('2'); 
                                        ?>
                                        <tr class="tr_border table-secondary">
                                        <td class="td-class"><?=$data['WORK']['WCCD'] ?></td>
                                        <td class="td-class"><?=$data['WORK']['WCNAME'] ?></td>
                                        <td class="td-class"><?=$data['WORK']['DIVISIONNAME'] ?></td>
                                        <td class="td-class"><?=$data['WORK']['STAFFNAME'] ?></td>
                                        <td class="td-class" style="display: none;"><?=$data['WORK']['WCTYP'] ?></td>
                                        <td class="td-class" ><?php 
                                            if(isset($data['WORK']['WCTYP'])){
                                                foreach ($dd1 as $key => $item) { 
                                                        if($key == $data['WORK']['WCTYP'])
                                                            {
                                                                echo($item);
                                                            }
                                                        }                                 
                                                } ?></td>
                                        <td class="td-class"><?=$data['WORK']['WCDISPLAYFLG'] ?></td>
                                        <td class="td-class"><?=isset($data['WORK']['WCSTDHOURRATE']) ? number_format(str_replace(",", "", $data['WORK']['WCSTDHOURRATE']), 2): '0.00' ?></td>
                                        <td class="td-class"><?=isset($data['WORK']['WCSTDCOST']) ? number_format(str_replace(",", "", $data['WORK']['WCSTDCOST']), 2): '0.00' ?></td>
                                        <td class="td-class"><?=isset($data['WORK']['WCHOURRATE']) ? number_format(str_replace(",", "", $data['WORK']['WCHOURRATE']), 2): '0.00' ?></td>
                                        <td class="td-class"><?=isset($data['WORK']['WCCOST']) ? number_format(str_replace(",", "", $data['WORK']['WCCOST']), 2): '0.00' ?></td>
                                        <td class="td-hide"><?=$data['WORK']['DIVISIONCD'] ?></td>
                                        <td class="td-hide"><?=$data['WORK']['STAFFCD'] ?></td>
                                    </tr><?php
                                    break;
                                    }
                            }  
                            for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                  <tr class="tr_border table-secondary">
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
                    } else {
                          for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                              <tr class="tr_border table-secondary">
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
        <div class="font-size14"><?php echo $data['TXTLANG']['ROWCOUNT']; ?>&emsp;<?=$minrow?></div>

        <!-- INSERT	UPDATE	DELETE		ENTRY	CLEAR	END -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <button type="button" class="btn btn-action" id="insertA" name="insertA" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['INSERT']; ?></button>&emsp;&emsp;

                    <button type="button" class="btn btn-action" id="updateA" name="updateA" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?></button>&emsp;&emsp;

                    <button type="button" class="btn btn-action" id="deleteA" name="deleteA" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?></button>

                </div>
                <div class="flex .col45">
                    <button type="button" class="btn btn-action" id="entry" name="entry" onclick="entry1();"><?php echo $data['TXTLANG']['ENTRY']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="end" name="end"
                    onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"
                    ><?php echo $data['TXTLANG']['END']; ?></button>
                </div>
            </div>
        </div>

        <!-- WC_CODE	WCCD -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">

                    <label class="label-width20"><?php echo $data['TXTLANG']['WC_CODE']; ?></label>

                    <input class="form-control width30 req " type="text" id="WCCD" name="WCCD" value="<?=isset($data['WCCD']) ? $data['WCCD']: ''?>" />

                </div>             
                <div class="flex .col45" style="justify-content: right;">
                </div>
            </div>
        </div>
        
        <!-- WORK_CENTER_NAME	WCNAME	WCCDID(hidden) -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">

                    <label class="label-width20"><?php echo $data['TXTLANG']['WORK_CENTER_NAME']; ?></label>

                    <input class="form-control width40 req" type="text" id="WCNAME" name="WCNAME" value="<?=isset($data['WCNAME']) ? $data['WCNAME']: ''?>" />

                </div>             
                <div class="flex .col45" style="justify-content: right;">
                </div>
            </div>
        </div>

        <!-- DIVISIONCODE	DIVISIONCD	DIVISIONNAME -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">

                    <label class="label-width20"><?php echo $data['TXTLANG']['DIVISIONCODE']; ?></label>

                    <input class="form-control width25 req" type="text" id="DIVISIONCD" name="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''?>" />

                    <div class="fix-icon" >
                        <a href="#" id="guideindex2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>

                    <input class="form-control width30 " type="text" id="DIVISIONNAME" name="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''?>" readonly/>

                </div>             
                <div class="flex .col45" style="justify-content: right;">
                </div>
            </div>
        </div>

        <!-- PERSON_RESPONSE	STAFFCD	STAFFNAME -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">

                    <label class="label-width20"><?php echo $data['TXTLANG']['PERSON_RESPONSE']; ?></label>

                    <input class="form-control width25 req" type="text" id="STAFFCD" name="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''?>" />

                    <div class="fix-icon" >
                        <a href="#" id="guideindex3"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>

                    <input class="form-control width30 " type="text" id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''?>" readonly/>

                </div>             
                <div class="flex .col45" style="justify-content: right;">
                </div>
            </div>
        </div>

        <!-- WC_TYPE	WCTYP   WCDISPLAYFLG    DISPLAY_VIEW-->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">

                    <label class="label-width20"><?php echo $data['TXTLANG']['WC_TYPE']; ?></label>

                    <select class="width25 option-text form-select form-select-sm " id="WCTYP" name="WCTYP"  >
                        <option value=""></option>
                        <?php foreach ($dd1 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['WCTYP']) && $data['WCTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>&emsp;&emsp;
                    
                    <input type="checkbox" id="WCDISPLAYFLG" name="WCDISPLAYFLG" value="" style="width: 15px"
                        <?php echo (!empty($data['WCDISPLAYFLG']) && $data['WCDISPLAYFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                    <label class="label-width20"><?php echo $data['TXTLANG']['DISPLAY_VIEW']; ?></label>

                </div>             
                <div class="flex .col45" style="justify-content: right;">
                </div>
            </div>
        </div>

        <!-- STD_HOUR_RATE	WCSTDHOURRATE	CURRENCYDISP	STD_EXPENSE_RATE	WCSTDCOST	CURRENCYDISP	COMPRICETYPE	COMAMOUNTTYPE -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">

                    <label class="label-width20"><?php echo $data['TXTLANG']['STD_HOUR_RATE']; ?></label>
                    
                    <input class="form-control width25 req"  type="text" id="WCSTDHOURRATE" name="WCSTDHOURRATE" value="<?=isset($data['WCSTDHOURRATE']) ? $data['WCSTDHOURRATE']: ''; ?>"
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>

                    <input class="form-control width10 " type="text" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=isset($data['LOAD']['CURRENCYDISP']) ? $data['LOAD']['CURRENCYDISP']: ''?>" readonly/>

                </div>             
                <div class="flex .col45">

                    <label class="label-width20"><?php echo $data['TXTLANG']['STD_EXPENSE_RATE']; ?></label>

                    <input class="form-control width25 req"  type="text" id="WCSTDCOST" name="WCSTDCOST" value="<?=isset($data['WCSTDCOST']) ? $data['WCSTDCOST']: ''; ?>"
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>

                    <input class="form-control width10 " type="text" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=isset($data['LOAD']['CURRENCYDISP']) ? $data['LOAD']['CURRENCYDISP']: ''?>" readonly/>

                    <input class="form-control width20 " type="hidden" id="COMPRICETYPE" name="COMPRICETYPE" value="<?=isset($data['LOAD']['COMPRICETYPE']) ? $data['LOAD']['COMPRICETYPE']: ''?>" />

                    <input class="form-control width20 " type="hidden" id="COMAMOUNTTYPE" name="COMAMOUNTTYPE" value="<?=isset($data['LOAD']['COMAMOUNTTYPE']) ? $data['LOAD']['COMAMOUNTTYPE']: ''?>" />

                </div>
            </div>
        </div>

        <!-- CUR_HOUR_RATE	WCHOURRATE	CURRENCYDISP	CUR_EXPENSE_RATE	WCCOST	CURRENCYDISP -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">

                    <label class="label-width20"><?php echo $data['TXTLANG']['CUR_HOUR_RATE']; ?></label>
                    
                    <input class="form-control width25 req"  type="text" id="WCHOURRATE" name="WCHOURRATE" value="<?=isset($data['WCHOURRATE']) ? $data['WCHOURRATE']: ''; ?>"
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <input class="form-control width10 " type="text" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=isset($data['LOAD']['CURRENCYDISP']) ? $data['LOAD']['CURRENCYDISP']: ''?>" readonly/>


                </div>             
                <div class="flex .col45">

                    <label class="label-width20"><?php echo $data['TXTLANG']['CUR_EXPENSE_RATE']; ?></label>

                    <input class="form-control width25 req"  type="text" id="WCCOST" name="WCCOST" value="<?=isset($data['WCCOST']) ? $data['WCCOST']: ''; ?>"
                        onchange="this.value = digitFormat(this.value);"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <input class="form-control width10 " type="text" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=isset($data['LOAD']['CURRENCYDISP']) ? $data['LOAD']['CURRENCYDISP']: ''?>" readonly/>

                </div>
            </div>
        </div>

        <!-- TIME_DIFFERENCE	TIME_DIF	SUMMER_TIME	ARROW -->
        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">

                    <!-- <label class="label-width20"><?php echo $data['TXTLANG']['TIME_DIFFERENCE']; ?></label> -->

                    <!-- <select class="width25 option-text form-select form-select-sm " id="TIME_DIF" name="TIME_DIF" style="pointer-events: none; background-color: whitesmoke !important;" >
                        <option value=""></option>
                        <?php foreach ($dd2 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['TIME_DIF']) && $data['TIME_DIF'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select> -->

                    <!-- <label class="label-width20"><?php echo $data['TXTLANG']['SUMMER_TIME']; ?></label> -->

                </div>             
                <div class="flex .col45" style="justify-content: right;">

                    <!-- <input class="form-control width20 " type="date" id="INVTRANISSUEDT" name="INVTRANISSUEDT" value="<?=isset($data['INVTRANISSUEDT']) ? date('Y-m-d', strtotime($data['INVTRANISSUEDT'])): date('Y-m-d'); ?>"/> -->

                    <!-- <label class="label-width10"><?php echo $data['TXTLANG']['ARROW']; ?></label> -->

                    <!-- <input class="form-control width20 " type="date" id="INVTRANISSUEDT" name="INVTRANISSUEDT" value="<?=isset($data['INVTRANISSUEDT']) ? date('Y-m-d', strtotime($data['INVTRANISSUEDT'])): date('Y-m-d'); ?>"/> -->

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
        console.log('ENT');
        document.getElementById("insertA").disabled = false;
        document.getElementById("updateA").disabled = true;
        document.getElementById("deleteA").disabled = true;
    }
    else if(document.getElementById('KEEPSTATUS').value == "UPD"){
        console.log('UPD');
        document.getElementById("insertA").disabled = true;
        document.getElementById("updateA").disabled = false;
        document.getElementById("deleteA").disabled = false;
    }
    else{
        document.getElementById('KEEPSTATUS').value;
        // console.log(document.getElementById('KEEPSTATUS').value);
        console.log('NONE');
        document.getElementById("updateA").disabled = true;
        document.getElementById("deleteA").disabled = true;
    }

});

$('table#search_table tr').click(function () {
        $('table#search_table tr').removeAttr('id');
    
        $(this).attr('id', 'click-row');
       
        let item = $(this).closest('tr').children('td');

        $('#KEEPSTATUS').val('UPD');

        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            document.getElementById("insertA").disabled = true;
            document.getElementById("updateA").disabled = false;
            document.getElementById("deleteA").disabled = false;
            // document.getElementById("OK").disabled = true;
            // console.log(item.eq(5).text());
    
            // WCCD WCNAME DIVISIONCD STAFFCD WCTYP WCDISPLAYFLG WCSTDHOURRATE WCSTDCOST WCHOURRATE WCCOST
            $('#WCCD').attr('readonly', true).css('background-color', 'lightgray');

            $('#WCCD').val(item.eq(0).text());//text
            $('#WCNAME').val(item.eq(1).text());//text
            $('#DIVISIONNAME').val(item.eq(2).text());//text
            $('#STAFFNAME').val(item.eq(3).text());//text
            $('#DIVISIONCD').val(item.eq(11).text());//text
            $('#STAFFCD').val(item.eq(12).text());//text
            document.getElementById("WCTYP").value = item.eq(4).text();//dd
            $('#WCDISPLAYFLG').val(item.eq(6).text());
            if (item.eq(6).text() == "T") {
                $('#WCDISPLAYFLG').val(item.eq(6).text());
                $('#WCDISPLAYFLG').prop("checked", true)
            } else {
                $('#WCDISPLAYFLG').val('F');
                $('#WCDISPLAYFLG').prop("checked", false)
            }//checkbox
            $('#WCSTDHOURRATE').val(item.eq(7).text());//text
            $('#WCSTDCOST').val(item.eq(8).text());//text
            $('#WCHOURRATE').val(item.eq(9).text());//text
            $('#WCCOST').val(item.eq(10).text());//text
    
        }
        else{
            document.getElementById("insertA").disabled = false;
            document.getElementById("updateA").disabled = true;
            document.getElementById("deleteA").disabled = true;
            // document.getElementById("OK").disabled = true;
            // console.log(item.eq(5).text());
    
            // WCCD WCNAME DIVISIONCD STAFFCD WCTYP WCDISPLAYFLG WCSTDHOURRATE WCSTDCOST WCHOURRATE WCCOST
            $('#WCCD').attr('readonly', true).css('background-color', 'lightgray');
            $('#WCCD').val('');//text
            $('#WCNAME').val('');//text
            $('#DIVISIONNAME').val('');//text
            $('#STAFFNAME').val('');//text
            $('#DIVISIONCD').val('');//text
            $('#STAFFCD').val('');//text
            document.getElementById("WCTYP").value = '';//dd
            $('#WCDISPLAYFLG').val('F');
            $('#WCDISPLAYFLG').prop("checked", false)
            $('#WCSTDHOURRATE').val('0.00');//text
            $('#WCSTDCOST').val('0.00');//text
            $('#WCHOURRATE').val('0.00');//text
            $('#WCCOST').val('0.00');//text

        }

    if(document.getElementById('KEEPSTATUS').value == "ENT"){
        console.log('ENT');
        document.getElementById("insertA").disabled = false;
        document.getElementById("updateA").disabled = true;
        document.getElementById("deleteA").disabled = true;
    }
    else if(document.getElementById('KEEPSTATUS').value == "UPD"){
        console.log('UPD');
        document.getElementById("insertA").disabled = true;
        document.getElementById("updateA").disabled = false;
        document.getElementById("deleteA").disabled = false;
    }
    else{
        document.getElementById('KEEPSTATUS').value;
        // console.log(document.getElementById('KEEPSTATUS').value);
        console.log('NONE');
        document.getElementById("updateA").disabled = true;
        document.getElementById("deleteA").disabled = true;
    }

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
