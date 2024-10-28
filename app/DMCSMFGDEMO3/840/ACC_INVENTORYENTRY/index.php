<?php 
    require_once('./function/index_x.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!--  Bootstrap  -->
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
    <form class="form" method="POST" id="acc_inventoryentry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['VOUCHER_NO']; ?></label>
                    <input class="form-control width20 " type="text" id="INVTRANNO" name="INVTRANNO" value="<?=isset($data['INVTRANNO']) ? $data['INVTRANNO']: ''?>" />
                    <div class="fix-icon" style="right: -20px;">
                        <a href="#" id="guideindex1"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                </div>
                <div class="flex .col45">
                    <label class="label-width20"><?php echo $data['TXTLANG']['V_ISSUE_DATE']; ?></label>
                    <input class="form-control width30 " type="date" id="INVTRANISSUEDT" name="INVTRANISSUEDT" value="<?=isset($data['INVTRANISSUEDT']) ? date('Y-m-d', strtotime($data['INVTRANISSUEDT'])): date('Y-m-d'); ?>"/>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['OPERATION']; ?></label>
                    <select class="width30 option-text form-select form-select-sm" id="INVTRANTYPE" name="INVTRANTYPE">
                        <option value=""></option>
                        <?php foreach ($dd1 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['INVTRANTYPE']) && $data['INVTRANTYPE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>&emsp;
                </div>             
                <div class="flex .col45">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['WITHDRAW_STORAGE']; ?></label>
                    <select class="width25 option-text form-select form-select-sm " id="LOCTYP" name="LOCTYP" style="pointer-events: none; background-color: whitesmoke !important;" readonly>
                        <option value=""></option>
                        <?php foreach ($dd2 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['LOCTYP']) && $data['LOCTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <input class="form-control width20 req" type="text" id="LOCCD" name="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''?>" />
                    <div class="fix-icon" style="right: -10px;">
                        <!--  -->
                        <a href="#" id="guideindex2"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    <input class="form-control width25 req" type="text" id="LOCNAME" name="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''?>" style="pointer-events: none; background-color: whitesmoke !important;" readonly/>

                </div>             
                <div class="flex .col45">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['WITHDRAW_PURPOSE']; ?></label>
                    <select class="width25 option-text form-select form-select-sm " id="WDPURPOSE" name="WDPURPOSE" style="pointer-events: none; background-color: whitesmoke !important;" readonly>
                        <option value=""></option>
                        <?php foreach ($dd3 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['WDPURPOSE']) && $data['WDPURPOSE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>             
                <div class="flex .col45">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['REMARK']; ?></label>
                    <input class="form-control width50 " type="text" id="INVTRANREM" name="INVTRANREM" value="<?=isset($data['INVTRANREM']) ? $data['INVTRANREM']: ''?>" />
                </div>             
                <div class="flex .col45" style="justify-content: right;">
                    <button type="submit" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="$('#loading').show();" ><?php echo $data['TXTLANG']['SEARCH']; ?></button>&emsp;&emsp;
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="table height380"> 
              <table class="table-head table-striped" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                  <thead>
                    <!-- LINE:C,ITEMCODE,ITEMNAME,SPECIFICATE,QUANTITY:R,UNIT:C,SPACE -->
                      <tr class="th-class table-secondary">
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['LINE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMCODE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['ITEMNAME']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['SPECIFICATE']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['QUANTITY']; ?></th>
                            <th style="text-align: center; "><?php echo $data['TXTLANG']['UNIT']; ?></th><!-- dropdown -->
                      </tr>
                  </thead>
                  <tbody id="dvwdetail">
                         <?php if(!empty($data['ACC'])) {
                            // ROWNO,ACC_CD,ACC_NM,ACCTRANREMARK,ACCAMT1,ACCAMT2,SECTION1,PROJECTNO,DC_TYPE,CURRENCY1,AMT,I_CURRENCY,EXRATE,WHTAXTYP,TAXINVOICENO,ADJFLAG
                            // echo "<pre>";
                            print_r($data['ACC']);
                            // echo "</pre>";
                            for ($i = 1; $i <= count($data['ACC']); $i++) { $minrow = count($data['ACC']); ?>
                                <tr class="tr_border table-secondary" id="rowId<?=$i?>">
                                    <td class="td-class" id="ROWNO_TD<?=$i?>"><?=++$rowno ?></td>
                                    <td class="td-class" id="ITEMCD_TD<?=$i?>"><?=isset($data['ACC'][$i]['ITEMCD']) ? $data['ACC'][$i]['ITEMCD']: '' ?></td>
                                    <td class="td-class" id="ITEMNAME_TD<?=$i?>"><?=isset($data['ACC'][$i]['ITEMNAME']) ? $data['ACC'][$i]['ITEMNAME']: '' ?></td>
                                    <td class="td-class" id="ITEMSPEC_TD<?=$i?>"><?=isset($data['ACC'][$i]['ITEMSPEC']) ? $data['ACC'][$i]['ITEMSPEC']: '' ?></td>
                                    <td class="td-class" id="QTY_TD<?=$i?>"><?=isset($data['ACC'][$i]['QTY']) ? $data['ACC'][$i]['QTY']: '' ?></td>
                                    <td class="td-class" id="ITEMUNITTYP_TD<?=$i?>" style="display: none"><?=isset($data['ACC'][$i]['ITEMUNITTYP']) ? $data['ACC'][$i]['ITEMUNITTYP']: '' ?></td>
                                    <td class="td-class"><?php
                                    if(isset($data['ACC'][$i]['ITEMUNITTYP'])){
                                    foreach ($dd4 as $key => $item) { 
                                        if($key == $data['ACC'][$i]['ITEMUNITTYP'])
                                            {
                                                echo($item);
                                            }
                                        }                                 
                                    } ?></td>
                                <!-- INVTRANNO,INVTRANTYPE,INVTRANISSUEDT,LOCTYP,LOCCD,LOCNAME,WDPURPOSE,INVTRANREM -->
                                <td class="td-hide"><input type="hidden" id="ROWNO<?=$i?>" name="ROWNOA[]" value="<?=$rowno?>"></td>
                                <td class="td-hide"><input type="hidden" id="INVTRANNO<?=$i?>" name="INVTRANNOA[]" value="<?=isset($data['ACC'][$i]['INVTRANNO']) ? $data['ACC'][$i]['INVTRANNO']: '' ?>"></td>
                                <td class="td-hide"><input type="hidden" id="INVTRANTYPE<?=$i?>" name="INVTRANTYPEA[]" value="<?=isset($data['ACC'][$i]['INVTRANTYPE']) ? $data['ACC'][$i]['INVTRANTYPE']: '' ?>"></td>
                                <td class="td-hide"><input type="hidden" id="INVTRANISSUEDT<?=$i?>" name="INVTRANISSUEDTA[]" value="<?=isset($data['ACC'][$i]['INVTRANISSUEDT']) ? $data['ACC'][$i]['INVTRANISSUEDT']: '' ?>"></td>
                                <td class="td-hide"><input type="hidden" id="LOCTYP<?=$i?>" name="LOCTYPA[]" value="<?=isset($data['ACC'][$i]['LOCTYP']) ? $data['ACC'][$i]['LOCTYP']: '' ?>"></td>
                                <td class="td-hide"><input type="hidden" id="LOCCD<?=$i?>" name="LOCCDA[]" value="<?=isset($data['ACC'][$i]['LOCCD']) ? $data['ACC'][$i]['LOCCD']: '' ?>"></td>
                                <td class="td-hide"><input type="hidden" id="LOCNAME<?=$i?>" name="LOCNAMEA[]" value="<?=isset($data['ACC'][$i]['LOCNAME']) ? $data['ACC'][$i]['LOCNAME']: '' ?>"></td>
                                <td class="td-hide"><input type="hidden" id="WDPURPOSE<?=$i?>" name="WDPURPOSEA[]" value="<?=isset($data['ACC'][$i]['WDPURPOSE']) ? $data['ACC'][$i]['WDPURPOSE']: '' ?>"></td>
                                <td class="td-hide"><input type="hidden" id="INVTRANREM<?=$i?>" name="INVTRANREMA[]" value="<?=isset($data['ACC'][$i]['INVTRANREM']) ? $data['ACC'][$i]['INVTRANREM']: '' ?>"></td>
 
                                <? $i++ ?>
                                </tr> <?php
                                break;
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
                                </tr><?php
                            }
                        } ?>
                    </tbody>
              </table>
            </div>
        </div>
        <div class="font-size14"><?php echo $data['TXTLANG']['ROWCOUNT']; ?>&emsp;<?=$rowno?></div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <button type="button" class="btn btn-action" id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['COMMIT']; ?></button>&emsp;&emsp;
                </div>
                <div class="flex .col45" style="justify-content: right;">
                    <button type="button" class="btn btn-action"  id="entry" name="entry" onclick="entry1();"><?php echo $data['TXTLANG']['ENTRY']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="end" name="end"
                    onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"
                    ><?php echo $data['TXTLANG']['END']; ?></button>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['LINE']; ?></label>
                    <input class="form-control width10 " type="text" id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''?>" readonly/>
                </div>             
                <div class="flex .col45">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['ITEMCODE']; ?></label>
                    <input class="form-control width20 req" type="text" id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''?>" />
                    <div class="fix-icon" style="right: -10px;">
                        <a href="#" id="guideindex3"><img style="img-height20" src="../../../../img/search.png"></a>
                    </div>
                    <input class="form-control width25 " type="text" id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''?>" readonly/>
                    <input class="form-control width25 " type="text" id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''?>" readonly/>
                </div>             
                <div class="flex .col45">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <label class="label-width20"><?php echo $data['TXTLANG']['QUANTITY']; ?></label>
                    <input class="form-control width25 req" type="text" id="QTY" name="QTY" value="<?=isset($data['QTY']) ? $data['QTY']: ''?>" />
                    <select class="width15 option-text form-select form-select-sm " id="ITEMUNITTYP" name="ITEMUNITTYP" style="pointer-events: none; background-color: whitesmoke !important;" readonly>
                        <option value=""></option>
                        <?php foreach ($dd4 as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>             
                <div class="flex .col45">
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="flex">
                <div class="flex .col55">
                    <button type="button" class="btn btn-action" id="OK" name="OK">
                    <?php echo $data['TXTLANG']['OK']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-action" id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?></button>
                </div>
                <div class="flex .col45">
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

        var index = 0;
        var index = '<?php echo (isset($data['ACC']) ? count($data['ACC']) : 0); ?>';
        // console.log(index);
        OK.click(function() {
            if($('#ACC_CD').val() == '' || $('#DC_TYPE').val() == '' ) {
                return false;
            }
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr class="tr_border" id=rowId'+index+'>');
            var cols = "";

            cols += '<td class="td-class" id="ROWNO_TD'+index+'">'+index+'</td>';
            cols += '<td class="td-class" id="ITEMCD_TD'+index+'">'+ $('#ITEMCD').val() +'</td>';
            cols += '<td class="td-class" id="ITEMNAME_TD'+index+'">'+ $('#ITEMNAME').val() +'</td>';
            cols += '<td class="td-class" id="ITEMSPEC_TD'+index+'">'+ $('#ITEMSPEC').val() +'</td>';
            cols += '<td class="td-class" id="QTY_TD'+index+'">'+ $('#QTY').val() +'</td>';
            cols += '<td class="td-class" id="ITEMUNITTYP_TD'+index+'">'+$("#ITEMUNITTYP option:selected").text()+'</td>';

            cols += '<td class="td-hide"><input type="hidden" id="ROWNO'+index+'" name="ROWNOA[]" value='+index+'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ITEMCD'+index+'" name="ITEMCDA[]"   value='+ $('#ITEMCD').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ITEMNAME'+index+'" name="ITEMNAMEA[]"   value='+ $('#ITEMNAME').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ITEMSPEC'+index+'" name="ITEMSPECA[]"   value='+ $('#ITEMSPEC').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="QTY'+index+'" name="QTYA[]"   value='+ $('#QTY').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ITEMUNITTYP'+index+'" name="ITEMUNITTYPA[]"   value='+ $('#ITEMUNITTYP').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="INVTRANNO'+index+'" name="INVTRANNOA[]"   value='+ $('#INVTRANNO').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="INVTRANTYPE'+index+'" name="INVTRANTYPEA[]" value='+ $('#INVTRANISSUEDT').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="INVTRANISSUEDT'+index+'" name="INVTRANISSUEDTA[]" value='+ $('#INVTRANISSUEDT').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="LOCTYP'+index+'" name="LOCTYPA[]" value='+ $('#LOCTYP').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="LOCCD'+index+'" name="LOCCDA[]" value='+ $('#LOCCD').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="LOCNAME'+index+'" name="LOCNAMEA[]" value='+ $('#LOCNAME').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="WDPURPOSE'+index+'" name="WDPURPOSEA[]" value='+ $('#WDPURPOSE').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="INVTRANREM'+index+'" name="INVTRANREMA[]" value='+ $('#INVTRANREM').val() +'></td>';

            if(index <= 5) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $("table tbody").append(newRow);
            }
            $('#record').html(index);
            // calculateTotal();
            keepItemData();
            return entry1();
        });

        DELETE.click(function() {
            let id = $('#ROWNO').val();
            if(id != '') {
                // console.log(id);
                document.getElementById("table").deleteRow(id);
                $('#rowId'+id).closest("tr").remove();
                index--;
                $(".row-id").each(function (i) {
                    $(this).text(i+1);
                }); 
                $('#record').html(index);
                unsetItemData(id);
                changeRowId();
                // calculateTotal();
                id = null;
                return entry1();
            }
        });

        selectRow();


});




$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id');

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');
  
    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        document.getElementById("COMMIT").disabled = false;
        document.getElementById("UPDATE").disabled = false;
        document.getElementById("DELETE").disabled = false;
        document.getElementById("OK").disabled = true;
        // console.log(item.eq(5).text());

        $('#ROWNO').val(item.eq(0).text());
        $('#ITEMCD').val(item.eq(1).text());
        $('#ITEMNAME').val(item.eq(2).text());
        $('#ITEMSPEC').val(item.eq(3).text());
        $('#QTY').val(item.eq(4).text());
        // $('#ITEMUNITTYP').val(item.eq(5).text());
        document.getElementById("ITEMUNITTYP").value = item.eq(5).text();
        // document.getElementById("ITEMUNITTYP").value = 'ST';

    }
});

// input serach INVTRANNO   LOCCD   ITEMCD
const INVTRANNO = $("#INVTRANNO");
const LOCTYP = $("#LOCTYP");
const LOCCD = $("#LOCCD");
const ITEMCD = $("#ITEMCD");

const input_serach = [INVTRANNO,LOCCD,ITEMCD];

// button search
const guideindex1 = $("#guideindex1");
const guideindex2 = $("#guideindex2");
const guideindex3 = $("#guideindex3");
const search = $("#search");

const search_icon = [guideindex1,guideindex2,search];

guideindex1.attr('href', $('#sessionUrl').val() + '/guide/DMCSMFGDEMO3/SEARCH_ACC_INVENTORYENTRY/index.php?index=1');
guideindex2.attr('href', $('#sessionUrl').val() + '/guide/DMCSMFGDEMO3/SEARCHLOC/index.php?index=2' + '&LOCTYP=' +LOCTYP.val());
guideindex3.attr('href', $('#sessionUrl').val() + '/guide/DMCSMFGDEMO3/SEARCHITEM/index.php?index=3');

for(const input of input_serach) {
    input.change(function () {
        $("#loading").show();
    });

    input.keyup(function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $("#loading").show();
        }
    });
};

for(const icon of search_icon) {
    icon.click(function () {
        keepData();
    });

};



INVTRANNO.change(function() {
    keepData();
    window.location.href="index.php?INVTRANNO=" + INVTRANNO.val();
});

INVTRANNO.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
       keepData();
       window.location.href="index.php?INVTRANNO=" + INVTRANNO.val();
    }
})

LOCCD.change(function() {
    keepData();
    window.location.href="index.php?LOCCD=" + LOCCD.val();
});

LOCCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
       keepData();
       window.location.href="index.php?LOCCD=" + LOCCD.val();
    }
})

ITEMCD.change(function() {
    keepData();
    window.location.href="index.php?ITEMCD=" + ITEMCD.val();
});

ITEMCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        window.location.href="index.php?ITEMCD=" + ITEMCD.val();
    }
})
// <!-- CURRENCYCD,CURRENCYUNITTYP,CURRENCYAMTTYP,CURRENCYDISP  -->

function entry1() {
    document.getElementById("COMMIT").disabled = false;
    document.getElementById("UPDATE").disabled = true;
    document.getElementById("DELETE").disabled = true;
    document.getElementById("OK").disabled = false;

    $('#ROWNO').val('');
    $('#ITEMCD').val('');
    $('#ITEMNAME').val('');
    $('#ITEMSPEC').val('');
    $('#QTY').val('');
    document.getElementById("ITEMUNITTYP").value = '';
    // $('#ITEMUNITTYP').val('');

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

function printDialog() {
       return questionDialog(4, '<?=$lang['question4']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
    }



</script>
</html>
     