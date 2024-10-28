<?php require_once('./function/index_x.php');?>
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
        <main class="flex flex-1 overflow-y-auto paragraph">
          <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="purchaseRequisition" name="purchaseRequisition" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PR_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="PURREQNO" id="PURREQNO" value="<?=isset($data['PURREQNO']) ? $data['PURREQNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPURCHASEREQUEST">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="w-5/12">
                                            <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?><h5 class="w-4/12 pl-6 pt-1 text-red-500 font-semibold"><?=checklang('CANCELMSG')?></h5><?php } ?>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                       <label class="w-7/12"></label>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                type="date" id="INPUTDT" name="INPUTDT" value="<?=!empty($data['INPUTDT']) ? date('Y-m-d', strtotime($data['INPUTDT'])) : date('Y-m-d'); ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="DIVISIONCD" id="DIVISIONCD" value="<?=!empty($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHDIVISION">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                    name="DIVISIONNAME" id="DIVISIONNAME" value="<?=!empty($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIER_CODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SUPCD" id="SUPCD" value="<?=!empty($data['SUPCD']) ? $data['SUPCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHSUPPLIER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                    name="SUPNAME" id="SUPNAME" value="<?=!empty($data['SUPNAME']) ? $data['SUPNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="STAFFCD" id="STAFFCD" value="<?=!empty($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="STAFFNAME" id="STAFFNAME" value="<?=!empty($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                      <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                      <div class="flex w-9/12">
                                        <select id="BRANCHKBN" name="BRANCHKBN" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300 read" readonly>
                                          <option value=""></option>
                                          <?php foreach ($BRANCH_KBN as $key => $item) { ?>
                                              <option value="<?=$key ?>" <?=(!empty($data['BRANCHKBN']) && $data['BRANCHKBN'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                          <?php } ?>
                                        </select>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="TAXID" id="TAXID" value="<?=!empty($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                                      </div>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REQUEST_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 req"
                                                name="PURREQDUEDT" id="PURREQDUEDT" value="<?=!empty($data['PURREQDUEDT']) ? date('Y-m-d', strtotime($data['PURREQDUEDT'])): ''; ?>" onchange="unRequired();" required/>
                                        <div class="w-5/12"></div>
                                    </div>
                                    <div class="flex w-6/12 px-2"></div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mx-2">
                    <div class="flex w-full border border-gray-300 p-1">
                        <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="add-row">+</button>
                        <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="delete-row">x</button>
                    </div>
                </div>

                <div id="table-area" class="overflow-scroll px-2 block h-[436px]">
                    <table id="table" class="purchase_table w-full border-collapse border border-slate-500">
                        <thead class="sticky top-0 z-20 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-6 w-8 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 px-28 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PURPOSE_OF_ORDER')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARK')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 dark:divide-gray-700"><?php 
                            if(!empty($data['ITEM']))  { $minrow = count($data['ITEM']); // print_r($data['ITEM']);
                                foreach ($data['ITEM'] as $key => $value) { ?>
                                    <tr id="rowId<?=$key?>">
                                        <td class="row-id text-center max-w-4 text-sm border border-slate-700" id="ROWNO<?=$key?>" name="ROWNO[]"><?=$key?></td>
                                        <td class="max-w-24 text-sm border border-slate-700">
                                            <div class="relative z-10">
                                                <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="ITEMCD<?=$key?>" name="ITEMCD[]" onchange="findItemCode(event, <?=$key?>);" onkeyup="findItemCode(event, <?=$key?>);" value="<?=$value['ITEMCD'];?>">
                                                <a class="search-tag absolute top-0 end-0 h-6 py-1.5 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="searchitem<?=$key?>" onclick="searchItemIndex(<?=$key?>);">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="max-w-32 text-sm border border-slate-700">
                                            <input class="text-control text-[12px] shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                id="ITEMNAME<?=$key?>" name="ITEMNAME[]" value="<?=$value['ITEMNAME'] ?>"/>
                                        </td>
                                        <td class="max-w-8 text-sm border border-slate-700">
                                            <input class="text-control text-[12px] shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                id="PURPOSETYP<?=$key?>" name="PURPOSETYP[]" value="<?=$value['PURPOSETYP'] ?>"/>
                                        </td>
                                        <td class="max-w-8 text-sm border border-slate-700">
                                            <input class="text-control text-sm[12px] shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" 
                                                    id="REQQTY<?=$key?>" name="REQQTY[]"
                                                    value="<?=!empty($value['REQQTY']) ? number_format(str_replace(',', '', $value['REQQTY']), 2): '' ?>"
                                                    onchange="this.value = num2digit(this.value);"
                                                    oninput="this.value = stringReplacez(this.value);"/>
                                        </td>
                                        <td class="max-w-8 text-sm border border-slate-700">
                                            <input class="text-control text-[12px] shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read" 
                                                id="ITEMUNITTYP<?=$key?>" name="ITEMUNITTYP[]" value="<?=isset($value['ITEMUNITTYP']) ? $value['ITEMUNITTYP']: '' ?>" readonly/>
                                        </td>
                                        <td class="max-w-12 text-sm border border-slate-700">
                                            <input class="text-control text-[12px] shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                id="REM<?=$key?>" name="REM[]" value="<?=$value['REM'] ?>"/>
                                        </td>
                                        <td class="hidden"><input class="w-16 read" id="OLDLN<?=$key?>" name="OLDLN[]" value="<?=!empty($value['OLDLN']) ? $value['OLDLN'] : '' ?>" readonly/></td>
                                    </tr><?php
                                }
                            }

                            for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                <tr class="row-empty" id="rowId<?=$i?>">
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                </tr><?php
                            } ?>
                        </tbody>
                        <tfoot class="sticky bottom-0 z-20 pointer-events-none">
                            <tr>
                                <td class="text-color h-6 text-[12px]" colspan="8"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="rowcount" ><?=$minrow; ?></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <input class="hidden" name="PURREQADD01" id="PURREQADD01" value="<?=isset($data['PURREQADD01']) ? $data['PURREQADD01'] : ''; ?>" hidden/>
                <input class="hidden" name="PURREQADD02" id="PURREQADD02" value="<?=isset($data['PURREQADD02']) ? $data['PURREQADD02'] : ''; ?>" hidden/>
                <input class="hidden" name="PURREQADD03" id="PURREQADD03" value="<?=isset($data['PURREQADD03']) ? $data['PURREQADD03'] : ''; ?>" hidden/>

                <div class="flex">
                    <div class="flex w-6/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                                <?php if(!empty($data['SYSMSG'])) { ?> disabled <?php } ?>><?=checklang('COMMIT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="CANCEL" name="CANCEL" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_CANCEL'] != 'T') {?> hidden <?php }?>
                                <?php if(!empty($data['SYSMSG']) || empty($data['PURREQNO'])) { ?> disabled <?php } ?>><?=checklang('CANCEL'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="PRINT" name="PRINT" <?php if(empty($data['PURREQNO'])) {?> disabled <?php } ?>><?=$data['TXTLANG']['PRINT']; ?></button>
                    </div>
                    <div class="flex w-6/12 px-1 justify-end">
                      <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                onclick="$('#loading').show(); unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                      <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
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
<!-- <script src="./js/script.js" integrity="sha384-U3Ap9l1MWNyB+HE6fdt7quTR/6u/L6zew6TR8tceOu8tvGGMcmLhZ6VFKsDu4f7g" crossorigin="anonymous"></script> -->
<script type="text/javascript">
 $(document).ready(function() {
        unRequired();
        let cancelled = '<?php echo (!empty($data['SYSVIS_CANCELLBL']) ? $data['SYSVIS_CANCELLBL']: 'null'); ?>';
        let table = '<?php echo (isset($data['SYSEN_DVW']) ? $data['SYSEN_DVW']: 'null'); ?>';
        let commits = '<?php echo (isset($data['SYSEN_COMMIT']) ? $data['SYSEN_COMMIT']: 'null'); ?>';
        let cancels = '<?php echo (isset($data['SYSEN_CANCEL']) ? $data['SYSEN_CANCEL']: 'null'); ?>';
        let prints = '<?php echo (isset($data['SYSVIS_PRINT']) ? $data['SYSVIS_PRINT']: 'null'); ?>';
        if(cancelled != 'null' && cancelled == 'T') { 
            $('.search-tag').css('pointer-events', 'none');
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
            $('#PURREQNO').removeAttr('disabled').css('background-color', 'white');
            $('#SEARCHPURCHASEREQUEST').css('pointer-events', 'auto');
        }
        if(table == 'F') { 
            document.getElementById('add-row').classList.add('read');
            document.getElementById('delete-row').classList.add('read');
            $('.table .search-tag').css('pointer-events', 'none');
            $('.table .text-control').attr('readonly', true).css('background-color', 'whitesmoke');
        }
        if(commits == 'F') { document.getElementById('COMMIT').disabled = true; }
        if(cancels == 'F') { document.getElementById('CANCEL').disabled = true; }
        if(prints == 'F') { document.getElementById('PRINT').disabled = true; }     

        // let minrow = '<?php echo (isset($minrow) ? $minrow: 0); ?>';
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[436px]');
                tablearea.classList.add('h-[560px]');
                maxrow = 20;
            } else {
                tablearea.classList.remove('h-[560px]');
                tablearea.classList.add('h-[436px]');
                maxrow = 15;
            }
            emptyRows(maxrow);
        })

        var index = 0; var id; 
        index = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        // console.log(index);
        $('#add-row').click(function() {
            index =  $('.row-id').length || 0;
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr id=rowId'+index+'>');
            var cols = '';
            cols += '<td class="row-id text-center text-sm max-w-4 border border-slate-700" id="ROWNO'+index+'" name="ROWNO[]">'+index+'</td>';
            cols += '<td class="max-w-24 text-sm border border-slate-700"><div class="relative z-10">' +
                      '<input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"' +
                      'id="ITEMCD'+index+'" name="ITEMCD[]" onchange="findItemCode(event, '+index+');" onkeyup="findItemCode(event, '+index+');"/>' +
                      '<a class="search-tag absolute top-0 end-0 h-6 py-1.5 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"' +
                          'id="searchitem'+index+'" onclick="searchItemIndex('+index+');">' +
                          '<svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">' +
                              '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>' +
                          '</svg>' +
                      '</a>' +
                  '</div></td>';
            cols += '<td class="max-w-32 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"'+
                  'id="ITEMNAME'+index+'" name="ITEMNAME[]"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"'+
                  'id="PURPOSETYP'+index+'" name="PURPOSETYP[]"/></td>';

            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                  'id="REQQTY'+index+'" name="REQQTY[]" onchange="this.value = num2digit(this.value);" '+
                  'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read"'+
                  'id="ITEMUNITTYP'+index+'" name="ITEMUNITTYP[]" readonly/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"'+
                  'id="REM'+index+'" name="REM[]"/></td>';
            cols += '<td class="hidden"><input class="w-16 read" id="OLDLN'+index+'" name="OLDLN[]" readonly/></td>';
            // console.log($(".row-id").length);
            // console.log($('#rowId'+index+'').closest('tr').attr('id'));
            if(index <= maxrow) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').removeAttr('class', 'row-empty');
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $('table tbody').append(newRow);
            }

            document.getElementById('rowcount').innerHTML = index;
            // ----- call Class search-tag -------//
            searchIcon();
            // -----------------------------------//
            // $(".row-id").each(function (i){
            //    $(this).text(i+1);
            // });
            // keepItemData();
        });

        // Find and remove selected table rows
        $('#delete-row').click(function() {
            // console.log(id);
            if(index > 0 && id != null) {
                $('#rowId'+id).closest('tr').remove();
                if(index <= maxrow) {
                    emptyRow(index);
                }
                index --;   // index -= 1;
                $('.row-id').each(function (i) {
                    // console.log(i);
                    // rows[id].id = 'rowId' + index;
                    $(this).text(i+1);
                }); 
                changeRowIds();
                unsetSessionItem(id);
                id = null;
                // console.log(index);
                document.getElementById('rowcount').innerHTML = index;
            }
            keepItemData();
        });

        $(document).on('click', '.purchase_table tr', function(event){
            // let rowId = $(this).closest('tr').attr('id');
            // console.log(rowId);
            let item = $(this).closest('tr').children('td');
            id = item.eq(0).text();
            // console.log(id);
            let rows = document.getElementsByTagName('tr');
            $('.row-id').each(function (i) {
                rows[i+1].classList.remove('selected-row');
            }); 
            if(id != '') {
                rows[id].classList.add('selected-row'); 
            }
        });
    });
    function findItemCode(event, index) {
        if ((event.type === 'change') || (event.key === 'Enter' || event.keyCode === 13)) {
            keepData(); keepItemData();
            return getElementIndex('ITEMCD', $('#ITEMCD'+index+'').val(), index);
        }
    }

    function searchItemIndex(lineIndex) {
        // console.log(lineIndex);
        keepData(); keepItemData();
        return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ACC_PURCHASEREQUISITION_THA&index=' + lineIndex, 'authWindow', 'width=1200,height=600');
    }

    function HandlePopupResult(code, result) {
    // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'PURREQNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function HandlePopupItem(result, index) {
        // console.log('result of popup result: ' + result + ' : ' + index);
        return getElementIndex('ITEMCD', result, index);
    }

    function actionDialog(action) {
        if(action == 2) {
            return questionDialog(2, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if(action == 3) {
            return questionDialog(3, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if(action == 4) {
            return questionDialog(4, '<?=lang('question4')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>')
        } else {
            return itemValidation(action, '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        }
    }

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
            }
        });
    }
</script>
</html>