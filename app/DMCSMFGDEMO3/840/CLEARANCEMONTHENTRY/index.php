<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$_SESSION['APPNAME']; ?></title>
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
            <form class="w-full" method="POST" action="" id="clearanceMonthEntry" name="clearanceMonthEntry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INT_YEAR_MONTH')?></label>
                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 mr-1 text-left rounded-xl border-gray-300" id="YEARVALUE" name="YEARVALUE">
                            <option value=""></option>
                            <?php foreach ($YEAR as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['YEARVALUE']) && $data['YEARVALUE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="MONTHVALUE" name="MONTHVALUE">
                            <option value=""></option>
                            <?php foreach ($MONTH as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['MONTHVALUE']) && $data['MONTHVALUE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INT_YEAR_MONTH')?></label>
                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="CLEARANCE" name="CLEARANCE">
                            <option value=""></option>
                            <?php foreach ($CLEARANCE as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['CLEARANCE']) && $data['CLEARANCE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                        <div class="flex w-5/12 justify-end">
                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                    id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div id="table-area" class="overflow-scroll px-2 block h-[480px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINR')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STORAGE_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CLEARANCE_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CLEARANCE_ACT_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                    <td class="h-6 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD<?=$key?>"><?=isset($value['ROWNO']) ? $value['ROWNO']:$key?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMCODE_TD<?=$key?>"><?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMNAME_TD<?=$key?>"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCTYP_TD<?=$key?>"><?=isset($value['LOCTYP']) ? $STORAGETYPE[$value['LOCTYP']]: '' ?></td>
                                    <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCCD_TD<?=$key?>"><?=isset($value['LOCCD']) ? $value['LOCCD']:'' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCNAME_TD<?=$key?>"><?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="CLEARANCEDATE_TD<?=$key?>"><?=isset($value['CLEARANCEDATE']) ? $value['CLEARANCEDATE']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap" id="CLEARANCEQUANTITY_TD<?=$key?>"><?=isset($value['CLEARANCEQUANTITY']) ? $value['CLEARANCEQUANTITY']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMUNIT_TD<?=$key?>"><?=isset($value['ITEMUNIT']) ? $UNIT[$value['ITEMUNIT']]: '' ?></td>

                                    <input type="hidden" id="ROWNO<?=$key?>" name="ROWNOZ[]" value="<?=$key?>">
                                    <input type="hidden" id="ITEMCODE<?=$key?>" name="ITEMCODEZ[]" value="<?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?>">
                                    <input type="hidden" id="ITEMNAME<?=$key?>" name="ITEMNAMEZ[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?>">
                                    <input type="hidden" id="LOCTYP<?=$key?>" name="LOCTYPZ[]" value="<?=isset($value['LOCTYP']) ? $value['LOCTYP']: '' ?>">
                                    <input type="hidden" id="LOCCD<?=$key?>" name="LOCCDZ[]" value="<?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?>">
                                    <input type="hidden" id="LOCNAME<?=$key?>" name="LOCNAMEZ[]" value="<?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?>">
                                    <input type="hidden" id="CLEARANCEDATE<?=$key?>" name="CLEARANCEDATEZ[]" value="<?=isset($value['CLEARANCEDATE']) ? $value['CLEARANCEDATE']: '' ?>">
                                    <input type="hidden" id="CLEARANCEQUANTITY<?=$key?>" name="CLEARANCEQUANTITYZ[]" value="<?=isset($value['CLEARANCEQUANTITY']) ? $value['CLEARANCEQUANTITY']: '' ?>">
                                    <input type="hidden" id="ITEMUNIT<?=$key?>" name="ITEMUNITZ[]" value="<?=isset($value['ITEMUNIT']) ? $value['ITEMUNIT']: '' ?>">
                                    <input type="hidden" id="ITEMUNITSTR<?=$key?>" name="ITEMUNITSTRZ[]" value="<?=isset($value['ITEMUNITSTR']) ? $value['ITEMUNITSTR']: '' ?>">
                                    <input type="hidden" id="ITEMSPEC<?=$key?>" name="ITEMSPECZ[]" value="<?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?>">
                                    <input type="hidden" id="ITEMDRAWNUMBER<?=$key?>" name="ITEMDRAWNUMBERZ[]" value="<?=isset($value['ITEMDRAWNUMBER']) ? $value['ITEMDRAWNUMBER']: '' ?>">
                                </tr><?php
                            }
                        }
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200 row-empty" id="rowId<?=$i?>">
                                <td class="h-6 border border-slate-700"></td>
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

                <div class="flex py-2 px-2">
                    <div class="flex w-full">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowCount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold flex">
                                    <div class="flex w-7/12 px-1">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                                        id="OK" name="OK" <?php if(!empty($data['SYSPVL']['SYSVIS_INSERT']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                                        <?php if(!empty($data['SYSPVL']['SYSVIS_INS']) && $data['SYSPVL']['SYSVIS_INS'] != 'T') { ?> disabled <?php } ?>><?=checklang('OK'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']['SYSVIS_UPDATE']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                                        <?php if(!empty($data['SYSPVL']['SYSVIS_UPD']) && $data['SYSPVL']['SYSVIS_UPD'] != 'T') { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']['SYSVIS_DELETE']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                                        <?php if(!empty($data['SYSPVL']['SYSVIS_DEL']) && $data['SYSPVL']['SYSVIS_DEL'] != 'T') { ?> disabled <?php } ?>><?=checklang('DELETE'); ?></button>
                                    </div>
                                    <div class="flex w-5/12 px-1 justify-end">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center"
                                            id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                                    </div>
                                </summary>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CLEARANCE_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center req" 
                                                id="CLEARANCEDATE" name="CLEARANCEDATE" 
                                                value="<?=!empty($data['CLEARANCEDATE']) ? date('Y-m-d', strtotime($data['CLEARANCEDATE'])) : ''; ?>" onchange="unRequired();"/>
                                        <input class="hidden" type="hidden" id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" />
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                      
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" id="ITEMCODE" name="ITEMCODE" value="<?=isset($data['ITEMCODE']) ? $data['ITEMCODE']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" id="ITEMDRAWNUMBER" name="ITEMDRAWNUMBER" value="<?=isset($data['ITEMDRAWNUMBER']) ? $data['ITEMDRAWNUMBER']: ''; ?>" readonly/>
                                    </div>                                    
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SOURCE_STORAGE')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 mr-1 text-left rounded-xl border-gray-300 req"
                                                id="LOCTYP" name="LOCTYP" onchange="unRequired();">
                                            <option value=""></option>
                                            <?php foreach ($STORAGETYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['LOCTYP']) && $data['LOCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="relative w-5/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" id="LOCCD" name="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHLOC">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                                id="LOCNAME" name="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CLEARANCE_ACT_QTY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"id="CLEARANCEQUANTITY" name="CLEARANCEQUANTITY" 
                                                value="<?=!empty($data['CLEARANCEQUANTITY']) ? number_format(str_replace(',', '',$data['CLEARANCEQUANTITY']), 2): ''; ?>"
                                                onchange="this.value = num2digit(this.value); unRequired();" oninput="this.value = stringReplacez(this.value);"/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 read" id="ITEMUNIT" name="ITEMUNIT">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNIT']) && $data['ITEMUNIT'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>    
                                    </div>
                                    <div class="flex w-6/12 px-2"></div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
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
</html>
<script src="./js/script.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
    unRequired();
    document.getElementById('OK').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;

    let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
    const details = document.querySelector('details');
    const tablearea = document.getElementById('table-area');
    details.addEventListener('toggle', function() {
        if (!details.open) {
            tablearea.classList.remove('h-[480px]');
            tablearea.classList.add('h-[600px]');
            maxrow = 23;
        } else {
            tablearea.classList.remove('h-[600px]');
            tablearea.classList.add('h-[480px]');
            maxrow = 18;
        }
        emptyRows(maxrow);
    })

    var index = 0;
    var index = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
   
    OK.click(function() {
        if($('#ITEMCODE').val() == '' || $('#CLEARANCEDATE').val() == '' || $('#LOCTYP').val() == '' || $('#LOCCD').val() == '' || $('#CLEARANCEQUANTITY').val() == '' ) {
            errorDialog(2);
            return false;
        }
        // console.log('index before' + index);
        index ++;  // index += 1;
        var newRow = $('<tr class="divide-y divide-gray-200" id=rowId'+index+'></tr>');
        var cols = '';
        cols += '<td class="h-6 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD' + index + '">' + index + '</td>';
        cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMCODE_TD'+index+'">'+ $('#ITEMCODE').val() +'</td>';
        cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMNAME_TD'+index+'">'+ $('#ITEMNAME').val() +'</td>';
        cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCTYP_TD'+index+'"> '+ $("#LOCTYP option:selected").text() +'</td>';
        cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCCD_TD'+index+'">'+ $('#LOCCD').val() +'</td>';
        cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCNAME_TD'+index+'">'+ $('#LOCNAME').val() +'</td>';
        cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="CLEARANCEDATE_TD'+index+'">'+ slashFormatDate($('#CLEARANCEDATE').val()) +'</td>';
        cols += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="CLEARANCEQUANTITY_TD'+index+'">'+ $('#CLEARANCEQUANTITY').val() +'</td>';
        cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMUNIT_TD'+index+'"> '+ $("#ITEMUNIT option:selected").text() +'</td>';

        cols += '<input type="hidden" id="ROWNO'+index+'" name="ROWNOZ[]" value="'+index+'">';
        cols += '<input type="hidden" id="ITEMCODE'+index+'" name="ITEMCODEZ[]" value="'+ $('#ITEMCODE').val() +'">';
        cols += '<input type="hidden" id="ITEMNAME'+index+'" name="ITEMNAMEZ[]" value="'+ $('#ITEMNAME').val() +'">';
        cols += '<input type="hidden" id="LOCTYP'+index+'" name="LOCTYPZ[]" value="'+ document.getElementById('LOCTYP').value +'">';
        cols += '<input type="hidden" id="LOCCD'+index+'" name="LOCCDZ[]" value="'+ $('#LOCCD').val() +'">';
        cols += '<input type="hidden" id="LOCNAME'+index+'" name="LOCNAMEZ[]" value="'+ $('#LOCNAME').val() +'">';
        cols += '<input type="hidden" id="CLEARANCEDATE'+index+'" name="CLEARANCEDATEZ[]" value="'+ $('#CLEARANCEDATE').val() +'">';
        cols += '<input type="hidden" id="CLEARANCEQUANTITY'+index+'" name="CLEARANCEQUANTITYZ[]" value="'+ $('#CLEARANCEQUANTITY').val() +'">';
        cols += '<input type="hidden" id="ITEMUNIT'+index+'" name="ITEMUNITZ[]" value="'+ document.getElementById('ITEMUNIT').value +'">';
        cols += '<input type="hidden" id="ITEMUNITSTR'+index+'" name="ITEMUNITSTRZ[]" value="'+ $('#ITEMUNIT option:selected').text() +'">';
        cols += '<input type="hidden" id="ITEMSPEC'+index+'" name="ITEMSPECZ[]" value="'+ document.getElementById('ITEMSPEC').value +'">';
        cols += '<input type="hidden" id="ITEMDRAWNUMBER'+index+'" name="ITEMDRAWNUMBERZ[]" value="'+ $('#ITEMDRAWNUMBER').val() +'">';

        if(index <= maxrow) {
            $('#rowId'+index+'').empty();
            $('#rowId'+index+'').removeAttr('class', 'row-empty');
            $('#rowId'+index+'').append(cols);
        } else {
            newRow.append(cols);
            $('table tbody').append(newRow);
        }

        $('#rowCount').html(index);
        keepItemData();
        return entry();
    });

    UPDATE.click(async function() {
        let rowno = $('#ROWNO').val();
        if(rowno != '') {

            $('#ROWNO_TD'+rowno+'').html($('#ROWNO').val());
            $('#ITEMCODE_TD'+rowno+'').html($('#ITEMCODE').val());
            $('#ITEMNAME_TD'+rowno+'').html($('#ITEMNAME').val());
            $('#LOCTYP_TD'+rowno+'').html($('#LOCTYP option:selected').text());
            $('#LOCCD_TD'+rowno+'').html($('#LOCCD').val());
            $('#LOCNAME_TD'+rowno+'').html($('#LOCNAME').val());
            $('#CLEARANCEDATE_TD'+rowno+'').html(slashFormatDate($('#CLEARANCEDATE').val()));
            $('#CLEARANCEQUANTITY_TD'+rowno+'').html($('#CLEARANCEQUANTITY').val());
            $('#ITEMUNIT_TD'+rowno+'').html($('#ITEMUNIT option:selected').text());

            $('#ROWNO'+rowno+'').val($('#ROWNO').val());
            $('#ITEMCODE'+rowno+'').val($('#ITEMCODE').val());
            $('#ITEMNAME'+rowno+'').val($('#ITEMNAME').val());
            $('#LOCTYP'+rowno+'').val(document.getElementById('LOCTYP').value);
            $('#LOCCD'+rowno+'').val($('#LOCCD').val());
            $('#LOCNAME'+rowno+'').val($('#LOCNAME').val());
            $('#CLEARANCEDATE'+rowno+'').val($('#CLEARANCEDATE').val());
            $('#CLEARANCEQUANTITY'+rowno+'').val($('#CLEARANCEQUANTITY').val());
            $('#ITEMUNIT'+rowno+'').val(document.getElementById('ITEMUNIT').value);
            $('#ITEMUNITSTR'+rowno+'').val($('#ITEMUNIT option:selected').text());
            $('#ITEMSPEC'+rowno+'').val($('#ITEMSPEC').val());
            $('#ITEMDRAWNUMBER'+rowno+'').val($('#ITEMDRAWNUMBER').val());

            document.getElementById('OK').disabled = true;
            document.getElementById('UPDATE').disabled = false;
            document.getElementById('DELETE').disabled = false;

            await keepItemData();
            return entry();
        }
    });

    DELETE.click(function() {
        let id = $('#ROWNO').val();
        if(id == '') return false;
        document.getElementById('table').deleteRow(id);
        $('#rowId'+id).closest('tr').remove();
        if(id <= maxrow) {
            emptyRow(index);
        }
        index--;
        // console.log(key);
        $('.row-id').each(function (i) {
            $(this).text(i+1);
        }); 
        $('#rowCount').html(index);
        changeRowId();
        unsetItemData(id);
        id = null;
        return entry();
    });


    $('table#table tbody tr').click(function () {
        $('table#table tr').not(this).removeClass('selected'); entry();
        let item = $(this).closest('tr').children('td');
        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            let rec = item.eq(0).text();
            let table = document.getElementById('table');
            if(rec != '') { 
                table.rows[rec].classList.toggle('selected');
            }

            $('#ROWNO').val($('#ROWNO'+rec+'').val());
            $('#ITEMCODE').val($('#ITEMCODE'+rec+'').val());
            $('#ITEMNAME').val($('#ITEMNAME'+rec+'').val());
            $('#LOCCD').val($('#LOCCD'+rec+'').val());
            $('#LOCNAME').val($('#LOCNAME'+rec+'').val());
            $('#CLEARANCEDATE').val($('#CLEARANCEDATE'+rec+'').val().replaceAll('/','-'));
            $('#CLEARANCEQUANTITY').val($('#CLEARANCEQUANTITY'+rec+'').val());
            $('#ITEMSPEC').val($('#ITEMSPEC'+rec+'').val());
            $('#ITEMDRAWNUMBER').val($('#ITEMDRAWNUMBER'+rec+'').val());

            document.getElementById('LOCTYP').value = $('#LOCTYP'+rec+'').val();
            document.getElementById('ITEMUNIT').value = $('#ITEMUNIT'+rec+'').val();
 
            document.getElementById('OK').disabled = true;
            document.getElementById('UPDATE').disabled = false;
            document.getElementById('DELETE').disabled = false;
    
            return unRequired();
        }
    });
});

function HandlePopupResult(code, result) {
    // console.log('result of popup is: ' + code + ' : ' + result);
    return getElement(code, result);
}

function errorDialog(type, msg) {
    return Swal.fire({ 
        title: '',
        text: type == 1 ? msg: '<?=lang('validation1'); ?>',
        showCancelButton: false,
        confirmButtonText:  '<?=lang('yes'); ?>',
        cancelButtonText: '<?=lang('no'); ?>'
        }).then((result) => {
        if (result.isConfirmed) {
        }
    });
}
</script>