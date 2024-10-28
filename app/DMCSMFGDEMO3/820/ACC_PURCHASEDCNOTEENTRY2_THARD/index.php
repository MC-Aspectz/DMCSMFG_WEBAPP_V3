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
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="dcnoteentryrd" name="dcnoteentryrd" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DCVOUCHER')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="DCNO" id="DCNO" value="<?=isset($data['DCNO']) ? $data['DCNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHPURRECTRAN_ACC3">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input class="hidden" type="hidden" name="DCSVNO" value="<?=isset($data['DCSVNO']) ? $data['DCSVNO']: ''; ?>" readonly/>
                                        <input class="hidden" type="hidden" name="SVNO" value="<?=isset($data['SVNO']) ? $data['SVNO']: ''; ?>" readonly/>
                                        <div class="w-6/12">
                                            <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?><h5 class="w-full pl-6 pt-1 text-red-500 font-semibold"><?=checklang('CANCELMSG')?></h5><?php } ?>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <div class="w-7/12"></div>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('DCDATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                type="date" id="DCDATE" name="DCDATE" value="<?=!empty($data['DCDATE']) ? date('Y-m-d', strtotime($data['DCDATE'])) : date('Y-m-d'); ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PV_NO')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-2 text-gray-700 border-gray-300 mr-1 req"
                                                    name="PVNO" id="PVNO" value="<?=isset($data['PVNO']) ? $data['PVNO']: ''; ?>" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPURRECTRANFORDC2_ACC">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <select id="DCTYP" name="DCTYP" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300">
                                            <option value=""></option>
                                            <?php foreach ($dctype as $key => $item) { ?>
                                                <option value="<?=$key?>" <?=(isset($data['DCTYP']) && $data['DCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <select id="CHANGETYP" name="CHANGETYP" class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300">
                                            <option value=""></option>
                                            <?php foreach ($chamgetyp as $key => $item) { ?>
                                                <option value="<?=$key?>" <?=(isset($data['CHANGETYP']) && $data['CHANGETYP'] == $key) ? 'selected' : '' ?><?=(empty($data['CHANGETYP']) && $key == 1) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIERCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SUPPLIERCD" id="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 ml-2 read"
                                                name="SUPPLIERNAME" id="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SECTION')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="DIVISIONCD" id="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 ml-2 read"
                                                name="DIVISIONNAME" id="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SUPPLIERADDR1" id="SUPPLIERADDR1" value="<?=isset($data['SUPPLIERADDR1']) ? $data['SUPPLIERADDR1']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="STAFFCD" id="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 read"
                                                name="STAFFNAME" id="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SUPPLIERADDR2" id="SUPPLIERADDR2" value="<?=isset($data['SUPPLIERADDR2']) ? $data['SUPPLIERADDR2']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPINVNO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="ADD05" id="ADD05" value="<?=isset($data['ADD05']) ? $data['ADD05']: ''; ?>" onchange="unRequired();" required/>
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-[14px] w-6/12 pt-1 text-center"><?=checklang('INVDATE')?></label>
                                            <input class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                    type="date" id="PURRECINSPDT" name="PURRECINSPDT" value="<?=!empty($data['PURRECINSPDT']) ? date('Y-m-d', strtotime($data['PURRECINSPDT'])): ''; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TEL')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                name="SUPPLIERTEL" id="SUPPLIERTEL" oninput="this.value = stringReplacez(this.value)"
                                                value="<?=isset($data['SUPPLIERTEL']) ? $data['SUPPLIERTEL']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 text-center"><?=checklang('FAX')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SUPPLIERFAX" id="SUPPLIERFAX" oninput="this.value = stringReplacez(this.value)"
                                                value="<?=isset($data['SUPPLIERFAX']) ? $data['SUPPLIERFAX']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPDCNO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SUPPLIERCONTACT" id="SUPPLIERCONTACT" value="<?=isset($data['SUPPLIERCONTACT']) ? $data['SUPPLIERCONTACT']: ''; ?>"/>
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-[14px] w-7/12 pt-1 text-center"><?=checklang('SUPDCISSUEDATE')?></label>
                                            <input class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                    type="date" id="ADD12" name="ADD12" value="<?=!empty($data['ADD12']) ? date('Y-m-d', strtotime($data['ADD12'])): date('Y-m-d'); ?>"/>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SUPCURDISP" id="SUPCURDISP" value="<?=isset($data['SUPCURDISP']) ? $data['SUPCURDISP']: ''; ?>" readonly/>
                                        <input class="hidden" type="hidden" name="SUPCURCD" id="SUPCURCD" value="<?=isset($data['SUPCURCD']) ? $data['SUPCURCD']: ''; ?>" readonly/>
                                        <select id="BRANCHKBN" name="BRANCHKBN" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($branchkbn as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['BRANCHKBN']) && $data['BRANCHKBN'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="TAXID" id="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SHIP_VIA')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="text" id="ADD04" name="ADD04" value="<?=isset($data['ADD04']) ? $data['ADD04']: ''; ?>"/>
                                        <input class="hidden" type="text" name="ADD11" id="ADD11" value="<?=isset($data['ADD11']) ? $data['ADD11']: ''; ?>" />
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CREDITTERM')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                name="ADD03" id="ADD03" oninput="this.value = stringReplacez(this.value)"
                                                value="<?=isset($data['ADD03']) ? $data['ADD03'] : ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('DAYS')?></label>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div id="table-area" class="overflow-scroll px-2 block h-[272px]">
                    <div class="table">
                        <table id="table" class="debitnote_table w-full border-collapse border border-slate-500">
                            <thead class="sticky top-0 z-20 bg-gray-50">
                                <tr class="border border-gray-600">
                                    <th class="px-6 w-8 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                    </th>
                                     <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CODE')?></span>
                                    </th>
                                    <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                                    </th>
                                     <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                    </th>
                                     <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                    </th>
                                    <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT')?></span>
                                    </th>
                                    <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT_PRICE')?></span>
                                    </th>
                                    <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT_PRICE')?></span>
                                    </th>
                                    <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AMOUNT')?></span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="dvwdetail" class="divide-y divide-gray-200 dark:divide-gray-700">
                                 <?php if(!empty($data['ITEM']))  { $minrow = count($data['ITEM']);
                                    foreach ($data['ITEM'] as $key => $value) { ?>
                                        <tr id="rowId<?=$key?>">
                                            <td class="row-id text-center max-w-4 text-sm border border-slate-700" id="ROWNO<?=$key?>" name="ROWNO[]"><?=$value['ROWNO'];?></td>
                                            <td class="max-w-24 text-sm border border-slate-700">
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                            id="ITEMCD<?=$key?>" name="ITEMCD[]" value="<?=$value['ITEMCD'];?>" readonly>
                                            </td>
                                            <td class="max-w-32 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                        id="ITEMNAME<?=$key?>" name="ITEMNAME[]" value="<?=$value['ITEMNAME'] ?>" readonly/>
                                            </td>
                                            <td class="max-w-10 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                        id="SPURQTY<?=$key?>" name="SPURQTY[]" value="<?=isset($value['SPURQTY']) ? number_format(str_replace(',', '', $value['SPURQTY']), 2): '0.00' ?>"
                                                        oninput="this.value = stringReplacez(this.value)" readonly/>
                                            </td>
                                            <td class="max-w-10 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right <?php if($data['CHANGETYP'] != '2') { echo 'read';} ?>" id="PURQTY<?=$key?>" name="PURQTY[]" value="<?php if($data['CHANGETYP'] != '2') { echo isset($value['SPURQTY']) ? number_format(str_replace(',', '', $value['SPURQTY']), 2): ''; } else { echo isset($value['PURQTY']) ? number_format(str_replace(',', '', $value['PURQTY']), 2): ''; } ?>"
                                                    onchange="$('#loading').show(); calculateamt(<?=$key?>); this.value = num2digit(this.value);"
                                                    onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); calculateamt(<?=$key?>); this.value = num2digit(this.value); }"
                                                    oninput="this.value = stringReplacez(this.value)"/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read" 
                                                        id="ITEMUNITTYP<?=$key?>" name="ITEMUNITTYP[]" value="<?=$value['ITEMUNITTYP'] ?>" readonly/>
                                            </td>
                                            <td class="max-w-12 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                        id="SPURUNITPRC<?=$key?>" name="SPURUNITPRC[]" 
                                                        value="<?=isset($value['SPURUNITPRC']) ? number_format(str_replace(",", "", $value['SPURUNITPRC']), 2): '0.00' ?>" readonly/>
                                            </td>
                                            <td class="max-w-12 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right <?php if($data['CHANGETYP'] != '1') { echo 'read'; } ?>" id="PURUNITPRC<?=$key?>" name="PURUNITPRC[]" value="<?php if($data['CHANGETYP'] != '1') { echo isset($value['SPURUNITPRC']) ? number_format(str_replace(',', '', $value['SPURUNITPRC']), 2): '0.00'; } else { echo isset($value['PURUNITPRC']) ? number_format(str_replace(',', '', $value['PURUNITPRC']), 2): '0.00'; } ?>"
                                                    onchange="$('#loading').show(); calculateamt(<?=$key?>); this.value = num2digit(this.value);"
                                                    onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); calculateamt(<?=$key?>); this.value = num2digit(this.value); }"
                                                    oninput="this.value = stringReplacez(this.value)"/>
                                            </td>
                                            <td class="max-w-12 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                        id="PURAMT<?=$key?>" name="PURAMT[]" value="<?=isset($value['PURAMT']) ? $value['PURAMT'] : '' ?>" readonly/>
                                            </td>
                                            <td class="hidden"><input class="w-16 read" id="DISCOUNT2<?=$key?>" name="DISCOUNT2[]"
                                                value="<?=isset($value['DISCOUNT2']) ? $value['DISCOUNT2'] : '' ?>" readonly/></td>
                                            <td class="hidden"><input class="w-16 read" id="VATAMT<?=$key?>" name="VATAMT[]"
                                                value="<?=isset($value['VATAMT']) ? $value['VATAMT'] : '' ?>" readonly/></td>
                                            <td class="hidden"><input class="w-16 read" id="SYSROWCOLOR<?=$key?>" name="SYSROWCOLOR[]"
                                                value="<?=isset($value['SYSROWCOLOR']) ? $value['SYSROWCOLOR'] : '' ?>" readonly/></td>
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
                                        <td class="h-6 border border-slate-700"></td>
                                        <td class="h-6 border border-slate-700"></td>
                                    </tr><?php
                                } ?>
                            </tbody>
                            <tfoot class="sticky bottom-0 z-20 pointer-events-none">
                                <tr>
                                    <td class="text-color h-6 text-[12px]" colspan="9"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="rowcount" ><?=$minrow; ?></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary>
                                <div class="flex mb-1 px-2">
                                    <div class="flex w-7/12">
                                        <!-- <input class="hidden" id="DRMSG" name="DRMSG" value="<?=isset($data['DRMSG'])? $data['DRMSG']: ''; ?>" readonly/> -->
                                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-8/12 text-left rounded-xl border-gray-300 hidden" id="DRMSG" name="DRMSG">
                                            <option value=""></option>
                                            <?php foreach ($data['DCMESSAGE'] as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['DRMSG']) && $data['DRMSG'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-8/12 text-left rounded-xl border-gray-300 req"
                                            id="CRMSG" name="CRMSG" required>
                                            <option value=""></option>
                                            <?php foreach ($data['DCMESSAGE'] as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['CRMSG']) && $data['CRMSG'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-5/12">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('SUBTOTAL')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="S_TTL" id="S_TTL" value="<?=!empty($data['S_TTL']) ? number_format(str_replace(',', '', $data['S_TTL']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="SUPCURDISP" id="SUPCURDISP" value="<?=!empty($data['SUPCURDISP']) ? $data['SUPCURDISP']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-7/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                            name="ADD07" id="ADD07" value="<?=isset($data['ADD07']) ? $data['ADD07']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-5/12">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('OLINV')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="OLDINVAMT" id="OLDINVAMT" value="<?=!empty($data['OLDINVAMT']) ? number_format(str_replace(',', '', $data['OLDINVAMT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="SUPCURDISP" value="<?=!empty($data['SUPCURDISP']) ? $data['SUPCURDISP']: ''; ?>" disabled/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-7/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                            name="ADD08" id="ADD08" value="<?=isset($data['ADD08']) ? $data['ADD08']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-5/12">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('CORINV')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="QUOTEAMOUNT" id="QUOTEAMOUNT" value="<?=!empty($data['QUOTEAMOUNT']) ? number_format(str_replace(',', '', $data['QUOTEAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="SUPCURDISP" value="<?=!empty($data['SUPCURDISP']) ? $data['SUPCURDISP']: ''; ?>" disabled/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-7/12">
                                        <label class="text-color block text-sm w-full pr-2 pt-1">ข้อความกฎหมายตาม คำสั่ง ป.80/2542 ฯ</label>
                                    </div>
                                    <div class="flex w-5/12">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('DIFFERENCE')?></label>
                                        <input class="hidden" type="hidden" name="DIFF" id="DIFF" value="<?=isset($data['DIFF']) ? $data['DIFF']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="DIFFDISP" id="DIFFDISP" value="<?=!empty($data['DIFFDISP']) ? number_format(str_replace(',', '', $data['DIFFDISP']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="SUPCURDISP" value="<?=!empty($data['SUPCURDISP']) ? $data['SUPCURDISP']: ''; ?>" disabled/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-7/12">
                                        <div class="flex-col mb-1 w-full" id="reason">
                                            <div class="flex">
                                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('REPRINT_REASON')?></label>
                                                <textarea class="text-control block p-2.5 w-6/12 shadow-md text-sm rounded-xl text-gray-700 border border-gray-300" rows="2"
                                                        id="REPRINTREASON" name="REPRINTREASON"><?=isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: ''; ?></textarea>
                                                <div class="w-4/12"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex w-5/12">
                                        <div class="flex-col mb-1">
                                            <div class="flex">
                                                <label class="text-color block text-[12px] w-2/12 pr-2 pt-1"><?=checklang('VATAM')?></label>
                                                <input type="text" class="text-control text-sm shadow-md border text-sm rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                        name="VATRATE" id="VATRATE" onchange="vat();" value="<?=!empty($data['VATRATE']) ? number_format(str_replace(',', '', $data['VATRATE']), 2): '0.00'; ?>"
                                                        oninput="this.value = stringReplacez(this.value)" readonly/>&nbsp;
                                                <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                        name="VATAMOUNT1" id="VATAMOUNT1" value="<?=!empty($data['VATAMOUNT1']) ? number_format(str_replace(',', '', $data['VATAMOUNT1']), 2): '0.00'; ?>" readonly/>
                                                <input class="hidden" name="VATAMOUNT" id="VATAMOUNT" value="<?=!empty($data['VATAMOUNT']) ? number_format(str_replace(',', '', $data['VATAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                        name="SUPCURDISP" value="<?=!empty($data['SUPCURDISP']) ? $data['SUPCURDISP']: ''; ?>" disabled/>
                                            </div>
                                            <div class="flex">
                                                <label class="text-color text-sm w-5/12 pr-2 pt-1"><?=checklang('TOTAL_AMOUNT')?></label>
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                        name="T_AMOUNT" id="T_AMOUNT" value="<?=!empty($data['T_AMOUNT']) ? number_format(str_replace(',', '', $data['T_AMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                        name="SUPCURDISP" value="<?=!empty($data['SUPCURDISP']) ? $data['SUPCURDISP']: ''; ?>" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-2">
                    <div class="flex w-8/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2"
                                id="CANCEL" name="CANCEL" <?php if(empty($data['DCNO'])) { ?> disabled <?php } ?>><?=checklang('CANCEL'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center me-2 mb-2"
                                id="DCVC" name="DCVC"><?=checklang('DCVC'); ?></button>
                        <div class="w-1/12"></div>
                    </div>
                    <div class="flex w-4/12 px-1 justify-end">
                        <button type="reset" id="clear" name="clear" onclick="unsetSession(this.form);" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"><?=checklang('CLEAR'); ?></button>
                        <button type="button" id="end" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
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
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">   
    $(document).ready(function() {
        unRequired();
        // document.getElementById('reason').style.visibility = 'hidden';
        // document.getElementById('DCVC').style.visibility = 'hidden';
        document.getElementById('DCVC').disabled = true;
        let minrow = '<?php echo (isset($minrow) ? $minrow: 0); ?>';
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 8); ?>';
        let reprint = '<?php echo (isset($data['SYSVIS_REPRINTREASON']) ? $data['SYSVIS_REPRINTREASON']: 'null'); ?>';
        let cancelled = '<?php echo (!empty($data['SYSVIS_CANCELLBL']) ? $data['SYSVIS_CANCELLBL']: 'null'); ?>';
        let commits = '<?php echo (isset($data['SYSEN_COMMIT']) ? $data['SYSEN_COMMIT']: 'null'); ?>';
        let cancels = '<?php echo (isset($data['SYSEN_CANCEL']) ? $data['SYSEN_CANCEL']: 'null'); ?>';
        let dummyprt1 = '<?php echo (!empty($data['SYSVIS_DUMMYPRT1']) ? $data['SYSVIS_DUMMYPRT1']: 'null'); ?>';
        let dummyprt2 = '<?php echo (!empty($data['SYSVIS_DUMMYPRT2']) ? $data['SYSVIS_DUMMYPRT2']: 'null'); ?>';
        let reprintbl = '<?php echo (isset($data['SYSVIS_REPRINTLBL']) ? $data['SYSVIS_REPRINTLBL']: 'null'); ?>';
        let reason = '<?php echo (isset($data['SYSEN_REPRINTREASON']) ? $data['SYSEN_REPRINTREASON']: 'null'); ?>';
        let table = '<?php echo (isset($data['SYSEN_DVW']) ? $data['SYSEN_DVW']: 'null'); ?>';
        if((cancelled != 'null' && cancelled == 'T') || (table != 'null' && table != 'T')) { 
            $('.search-tag').css('pointer-events', 'none');
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
            $('#PVNO').removeAttr('disabled').css('background-color', 'white');
            $('.table .search-tag').css('pointer-events', 'none');
            $('.table .text-control').attr('readonly', true).css('background-color', 'whitesmoke');
        }
        if(commits == 'F') { document.getElementById('COMMIT').disabled = true; }
        if(cancels == 'F') { document.getElementById('CANCEL').disabled = true; }
        if(dummyprt2 == 'T') { document.getElementById('DCVC').disabled = false; } 
        if(reprint == 'F') { document.getElementById('reason').style.display = 'none'; } // document.getElementById('reason').style.visibility = 'hidden'; //visible
        if(reprintbl == 'F') { $('#REPRINTREASON').attr('readonly', true).css('background-color', 'whitesmoke'); }
        // if(reprintbl == 'F') { document.getElementById("REPRINTLBL").disabled = true; }
        if(reason == 'F') { $('#REPRINTREASON').attr('readonly', true).css('background-color', 'whitesmoke'); }

        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[272px]');
                tablearea.classList.add('h-[376px]');
                maxrow = 12;
            } else {
                tablearea.classList.remove('h-[376px]');
                tablearea.classList.add('h-[272px]');
                maxrow = 8;
            }
            emptyRows(maxrow);
        });
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'STAFFCD') {
            return getElement(code, result);
        } else {
            return getSearch(code, result);
        }
    }

    function actionDialog(type) {
        if(type == 2) {
            return questionDialog(2, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');        
        } else if(type == 7) {
           return questionDialog(3, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');        
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        }
    }

    function successValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('success'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                document.getElementById('COMMIT').disabled = true;
            }
        });
    }
   
    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }

    function printValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('validation2'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                    // document.getElementById('REPRINTLBL').disabled = false;
                    // document.getElementById('REPRINTREASON').disabled = false;
                    // $('#REPRINTREASON').attr('readonly', false).css('background-color', 'white');
            }
        });
    }

    function unRequired() {
        document.getElementById('PVNO').classList[document.getElementById('PVNO').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('CRMSG').classList[document.getElementById('CRMSG').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('ADD05').classList[document.getElementById('ADD05').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
    }
</script>
</html>