<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <!-- -------------------------------------------------------------------------------- -->
</head>
<body>
<div class="flex flex-col h-screen">
    <!--  start::navbar Menu -->
    <header class="flex relative top-0 text-semibold">
        <!-------------------------------------------------------------------------------------->
        <?php navBar(); ?>
        <!-------------------------------------------------------------------------------------->
    </header>
    <!--  end::navbar Menu -->

    <div class="flex flex-1 overflow-hidden">
        <!--   start::Sidebar Menu -->
        <!-------------------------------------------------------------------------------------->
        <?php sideBar(); ?>
        <!-------------------------------------------------------------------------------------->
        <!--   end::Sideba Menu -->

        <!--   start::Main Content  -->
        <main class="flex flex-1 overflow-y-auto overflow-x-hidden paragraph px-2">
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="accTrialbalanceRd" name="accTrialbalanceRd" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('YEARMONTH')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300"
                                id="YEAR" name="YEAR">
                                <option value=""></option>
                                <?php foreach ($yearvalue as $yearkey => $yearitem) { ?>
                                    <option value="<?=$yearkey ?>" <?=(isset($data['YEAR']) && $data['YEAR'] == $yearkey) ? 'selected' : '' ?>><?=$yearitem ?></option>
                                <?php } ?>
                        </select>
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 req"
                                id="MONTH" name="MONTH" onchange="unRequired();" required>
                                <option value=""></option>
                                <?php foreach ($monthvalue as $monthkey => $monthitem) { ?>
                                    <option value="<?=$monthkey ?>" <?=(isset($data['MONTH']) && $data['MONTH'] == $monthkey) ? 'selected' : '' ?>><?=$monthitem ?></option>
                                <?php } ?>
                        </select>
                        <label class="text-color block text-sm pt-1 w-1/12 text-center"><?=checklang('ARROW')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300" 
                                id="YEAR2" name="YEAR2">
                                <option value=""></option>
                                <?php foreach ($yearvalue as $yearkey2 => $yearitem2) { ?>
                                    <option value="<?=$yearkey2 ?>" <?=(isset($data['YEAR2']) && $data['YEAR2'] == $yearkey2) ? 'selected' : '' ?>><?=$yearitem2 ?></option>
                                <?php } ?>
                        </select>
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" 
                                id="MONTH2" name="MONTH2">
                                <option value=""></option>
                                <?php foreach ($monthvalue as $monthkey2 => $monthitem2) { ?>
                                    <option value="<?=$monthkey2 ?>" <?=(isset($data['MONTH2']) && $data['MONTH2'] == $monthkey2) ? 'selected' : '' ?>><?=$monthitem2 ?></option>
                                <?php } ?>
                        </select>  
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-1/12 text-left rounded-xl border-gray-300 hidden" 
                                id="RPTFORMTYP" name="RPTFORMTYP">
                                <option value=""></option>
                                <?php foreach ($rptform as $rptkey => $rptitem) { ?>
                                    <option value="<?=$rptkey ?>" <?=(isset($data['RPTFORMTYP']) && $data['RPTFORMTYP'] == $rptkey) ? 'selected' : '' ?>><?=$rptitem ?></option>
                                <?php } ?>
                        </select>    
                        <input type="hidden" name="ACCNAME2USE" value="F"/> 
                        <input type="checkbox" id="ACCNAME2USE" name="ACCNAME2USE" value="T" <?php echo (isset($data['ACCNAME2USE']) && $data['ACCNAME2USE'] == 'T') ? 'checked' : '' ?>/>
                        <label class="text-color block text-sm pt-1 w-2/12 text-center"><?=checklang('ENGLISHNAME')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" 
                                id="ACCY" name="ACCY">
                                <option value=""></option>
                                <?php foreach ($accyearvalue as $accyearkey => $accyearitem) { ?>
                                    <option value="<?=$accyearkey ?>" <?=(isset($data['ACCY']) && $data['ACCY'] == $accyearkey) ? 'selected' : '' ?>><?=$accyearitem ?></option>
                                <?php } ?>
                        </select>    
                        <button type="summit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="SEARCH" name="SEARCH" onclick="// $('#loading').show();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div> 

                <div class="flex mb-1 px-2 hidden">
                    <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('DIVISIONCODE')?></label>
                    <div class="relative w-4/12 mr-1">
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                name="DIVISIONCD" id="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHDIVISION">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                            name="DIVISIONNAME" id="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                </div>

                <div class="overflow-scroll block h-[640px]"> 
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 gvc" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACCCD')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACCNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PREBALANCE_D')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PREBALANCE_C')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('THISMONTH_D')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('THISMONTH_C')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('NEXT_BALANCE_D')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('NEXT_BALANCE_C')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACCOUNTCODE']) ? $value['ACCOUNTCODE']: '' ?></td>
                                    <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACCOUNTNAME']) ? $value['ACCOUNTNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['BIGINING_D']) ? $value['BIGINING_D']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['BIGINING_C']) ? $value['BIGINING_C']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['PERIOD_D']) ? $value['PERIOD_D']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['PERIOD_C']) ? $value['PERIOD_C']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['ENDING_D']) ? $value['ENDING_D']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['ENDING_C']) ? $value['ENDING_C']: '' ?></td>
                                </tr><?php
                            }
                        }
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200" id="rowId<?=$i?>">
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                            </tr> <?php
                        } ?>
                        </tbody>
                    </table>
                </div>
                <div class="flex p-2">
                    <div class="flex w-12/12">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="record"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex mt-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 mx-3"
                                id="PRINT" name="PRINT"><?=checklang('PRINT'); ?></button>
                        <label class="text-color block text-sm w-7/12 px-2 pt-1"><?=checklang('DMCSREM3')?></label>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=checklang('END'); ?></button>
                    </div>
                </div>
            </form>
        </main>
        <!--   end::Main Content -->
    </div>

    <!-- start::footer -->
    <div class="flex bg-gray-200">
        <!-------------------------------------------------------------------------------------->
        <?php footerBar(); ?>
        <!-------------------------------------------------------------------------------------->
    </div>
    <!-- end::footer -->

    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
</div>
</body>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">   
    $(document).ready(function() {
        unRequired();
        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(1).text() != 'undefined' && item.eq(1).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
            }
        });
    });
    
    function unRequired() {
        document.getElementById('MONTH').classList[document.getElementById('MONTH').value != 0  ? 'remove' : 'add']('req');
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            var item = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
            if(item < 1) {
                alertWarning('<?=lang('validation3'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
                return false;
            }
            return questionDialog(2, '<?=lang('question4'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 3) {
            var item = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
            if(item < 1) {
                alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
                return false;
            }
            return exportCSV();
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>