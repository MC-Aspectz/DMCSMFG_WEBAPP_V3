<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  Bootstrap  -->
    <link href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/sweetalert2.min.css'; ?>" rel="stylesheet">
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Script  -->
    <!-- -------------------------------------------------------------------------------- -->
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
                <p class="text-white" style="font-size: 1.0em; margin: 0.1em;"><?=$packname . ' > ' . $appname; ?></p>
            </div>
            <div class="col-2 text-end align-middle">
                <a href="<?php echo $_SESSION['APPURL'] . '/home.php'; ?>">
                    <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
                    <p class="text-white" style="font-size: 1.0em; margin: 0.1em;">[ <?=lang('close'); ?> ]</p>
                </a>
            </div> 
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------- -->
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <form class="form" method="POST" action="" id="setAccStart" name="setAccStart" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex p-2">
            <div class="flex col-100">
                <label class="label-width10"><?=$data['TXTLANG']['YEARMONTH']; ?></label>
                <select class="form-select form-select-sm option-text width15" id="ACCY" name="ACCY">
                <option value=""></option>
                    <?php foreach ($accyearvalue as $accyearkey => $accyearitem) { ?>
                        <option value="<?=$accyearkey ?>" <?=(isset($data['ACCY']) && $data['ACCY'] == $accyearkey) ? 'selected' : '' ?>><?=$accyearitem ?></option>
                    <?php } ?>
                </select>&emsp;
                <select class="form-select form-select-sm option-text width10 req" id="YEAR" name="YEAR" onchange="unRequired();" required>
                <option value=""></option>
                    <?php foreach ($yearvalue as $yearkey => $yearitem) { ?>
                        <option value="<?=$yearkey ?>" <?=(isset($data['YEAR']) && $data['YEAR'] == $yearkey) ? 'selected' : '' ?>><?=$yearitem ?></option>
                    <?php } ?>
                </select>&ensp;
                <select class="form-select form-select-sm option-text width15 req" id="MONTH" name="MONTH" onchange="unRequired();" required>
                <option value=""></option>
                    <?php foreach ($monthvalue as $monthkey => $monthitem) { ?>
                        <option value="<?=$monthkey ?>" <?=(isset($data['MONTH']) && $data['MONTH'] == $monthkey) ? 'selected' : '' ?>><?=$monthitem ?></option>
                    <?php } ?>
                </select>
                <div class="width80"></div>
            </div>
        </div>

        <div class="flex p-2">
            <div class="flex col-70">
                <label class="label-width10"><?=$data['TXTLANG']['DIVISIONCODE']; ?></label>
                <input class="form-control width10" type="text" name="DIVISIONCD" id="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>"/>
                <div class="fix-icon">
                    <a class="search-tag" href="#" id="SEARCHDIVISION"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                </div>
                <input class="form-control width20 read" type="text" id="DIVISIONNAME" name="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                <div class="width30"></div>
            </div>
            <div class="flex col-30 justify-right">
                <button type="submit" id="SEARCH" name="SEARCH" class="btn btn-outline-secondary btn-action"><?=$data['TXTLANG']['SEARCH']; ?></button> 
            </div>
        </div>

        <div class="flex">
            <div class="table" style="height: 450.0px;">
                <table class="table-head table-striped" id="table">
                    <thead>
                        <tr class="table-secondary">
                            <th class="th-class width3"><?=$data['TXTLANG']['LINE']; ?></th>
                            <th class="th-class width10"><?=$data['TXTLANG']['ACC_CODE']; ?></th>
                            <th class="th-class width20"><?=$data['TXTLANG']['ACC_NAME']; ?></th>
                            <th class="th-class width20"><?=$data['TXTLANG']['ACC_NAME2']; ?></th>
                            <th class="th-class width10"><?=$data['TXTLANG']['AMT']; ?></th>
                            <th class="th-class width10"><?=$data['TXTLANG']['DEBIT']; ?></th>
                            <th class="th-class width10"><?=$data['TXTLANG']['CREDIT']; ?></th>
                            <th class="th-class width10"><?=str_repeat('&emsp;', 1); ?></th>
                        </tr>
                    </thead>
                    <tbody id="dvwdetail">
                         <?php if(!empty($data['ITEM']))  {
                            $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="tr_border" id="rowId<?=$key?>">
                                    <td class="td-class text-center"><?=$key;?></td>
                                    <td class="td-class text-left"><pre name="ACCCD[]"><?=isset($value['ACCCD']) ? $value['ACCCD']: '' ?></pre></td>
                                    <td class="td-class text-left"><pre><?=isset($value['ACCNAME1']) ? $value['ACCNAME1']: '' ?></pre></td>
                                    <td class="td-class text-left"><pre><?=isset($value['ACCNAME2']) ? $value['ACCNAME2']: '' ?></pre></td>
                                    <td class="td-class"><input class="form-control height25 text-right" id="AMT<?=$key?>" name="AMT[]"
                                                            value="<?=!empty($value['AMT']) ? number_format(str_replace(',', '', $value['AMT']), 2): ''; ?>"
                                                            onchange="setAmount(<?=$key?>); this.value = numberWithCommas(this.value);"
                                                            oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/></td>
                                    <td class="td-class"><input class="form-control height25 text-right read" id="ACCAMT1<?=$key?>" name="ACCAMT1[]"
                                                            value="<?=!empty($value['ACCAMT1']) ? number_format(str_replace(',', '', $value['ACCAMT1']), 2): ''; ?>"
                                                            onchange="this.value = numberWithCommas(this.value);"
                                                            oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly/></td>
                                    <td class="td-class"><input class="form-control height25 text-right read" id="ACCAMT2<?=$key?>" name="ACCAMT2[]"
                                                            value="<?=!empty($value['ACCAMT2']) ? number_format(str_replace(',', '', $value['ACCAMT2']), 2): ''; ?>"
                                                            onchange="this.value = numberWithCommas(this.value);"
                                                            oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly/></td>
                                    <td class="td-class"><input class="form-control height25" id="SPACE<?=$key?>" name="SPACE[]" value="<?=isset($value['SPACE']) ? $value['SPACE']: '' ?>"/></td>
                                    <td class="td-hide"><input type="hidden" id="ACCTYP<?=$key?>" name="ACCTYP[]" value="<?=isset($value['ACCTYP']) ? $value['ACCTYP']: '' ?>"/></td>
                                </tr><?php
                            }
                            for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                                <tr class="tr_border" id="rowId<?=$i?>">
                                    <td class="td-class"></td>s
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
                                <tr class="tr_border" id="rowId<?=$i?>">
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
                    <tfoot>
                        <tr class="tr_border" style="background-color: white;">
                            <td class="td-class" colspan="8"><?=str_repeat('&emsp;', 2).$data['TXTLANG']['ROWCOUNT'].str_repeat('&ensp;', 2)?><label class="font-size14" id="rowCount"><?=$minrow;?></label></td>
                        </tr>
                        <tr class="tr_border" style="background-color: white; border: 1.0px solid white;">
                            <td class="td-class" colspan="5" style="border: none;"></td>
                            <td class="td-class" style="border: none;"><input class="form-control height25 text-right read" type="text" id="TTL_ACCAMT1" name="TTL_ACCAMT1" value="<?=isset($data['TTL_ACCAMT1']) ? $data['TTL_ACCAMT1']: ''; ?>" readonly/></td>
                            <td class="td-class" style="border: none;"><input class="form-control height25 text-right read" type="text" id="TTL_ACCAMT2" name="TTL_ACCAMT2" value="<?=isset($data['TTL_ACCAMT2']) ? $data['TTL_ACCAMT2']: ''; ?>" readonly/></td>
                            <td class="td-class" style="border: none;"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <input class="form-control height25" type="hidden" id="index" name="index" readonly/>
        <div class="flex footer">
            <div class="flex col-50">
                <button type="button" class="btn btn-outline-secondary btn-action" id="COMMIT" name="COMMIT"<?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['COMMIT']; ?></button>
            </div>
            <div class="flex col-50 justify-right">
                <button type="reset" id="CLEAR" name="CLEAR" class="btn btn-outline-secondary btn-action" onclick="unsetSession(this.form);"><?=$data['TXTLANG']['CLEAR']?></button>&emsp;&emsp;
                <button type="button" id="END" class="btn btn-outline-secondary btn-action" onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=$data['TXTLANG']['END']; ?></button>
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
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">   
    $(document).ready(function() {
        unRequired();
        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'click-row');
                $('#index').val(item.eq(0).text());
            }
        });
    });
    
    function unRequired() {
        let month = document.getElementById("MONTH");
        if(month.selectedIndex != 0) {
            month.classList.remove('req');
        } else {
            month.classList.add('req');
        }

        let year = document.getElementById("YEAR");
        if(year.selectedIndex != 0) {
            year.classList.remove('req');
        } else {
            year.classList.add('req');
        }
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            return questionDialog(type, '<?=lang('question3'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>