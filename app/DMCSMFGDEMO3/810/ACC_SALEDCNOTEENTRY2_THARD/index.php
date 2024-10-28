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
                                            <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-2 text-gray-700 border-gray-300"
                                                    name="DCNO" id="DCNO" value="<?=isset($data['DCNO']) ? $data['DCNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALETRAN_ACC2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input class="hidden" type="hidden" name="DCSVNO" value="<?=isset($data['DCSVNO']) ? $data['DCSVNO']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('DCDATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                type="date" id="DCDATE" name="DCDATE" value="<?=!empty($data['DCDATE']) ? date('Y-m-d', strtotime($data['DCDATE'])) : date('Y-m-d'); ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERCD" id="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 ml-2 read"
                                                name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVOICE_NO')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-2 text-gray-700 border-gray-300 mr-1 req"
                                                    name="SALETRANNO" id="SALETRANNO" value="<?=isset($data['SALETRANNO']) ? $data['SALETRANNO']: ''; ?>" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALETRANFORDC2_ACC">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERADDR1" id="CUSTOMERADDR1" value="<?=isset($data['CUSTOMERADDR1']) ? $data['CUSTOMERADDR1']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVDATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                type="date" id="SALETRANINSPDT" name="SALETRANINSPDT" value="<?=!empty($data['SALETRANINSPDT']) ? date('Y-m-d', strtotime($data['SALETRANINSPDT'])) : date('Y-m-d'); ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 text-center"><?=checklang('CREDITTERM')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                name="SALETERM" id="SALETERM" oninput="this.value = stringReplacez(this.value);"
                                                value="<?=isset($data['SALETERM']) ? $data['SALETERM'] : ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('DAYS')?></label>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERADDR2" id="CUSTOMERADDR2" value="<?=isset($data['CUSTOMERADDR2']) ? $data['CUSTOMERADDR2']: ''; ?>" readonly/>
                                    </div>
                                </div>
                    
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SECTION')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="DIVISIONCD" id="DIVISIONCD" value="<?=!empty($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 ml-2 read"
                                                name="DIVISIONNAME" id="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TEL')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                name="ESTCUSTEL" id="ESTCUSTEL" oninput="this.value = stringReplacez(this.value);"
                                                value="<?=isset($data['ESTCUSTEL']) ? $data['ESTCUSTEL']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 text-center"><?=checklang('FAX')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="ESTCUSFAX" id="ESTCUSFAX" oninput="this.value = stringReplacez(this.value);"
                                                value="<?=isset($data['ESTCUSFAX']) ? $data['ESTCUSFAX']: ''; ?>" readonly/>
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ATTENTION')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                name="ESTCUSSTAFF" id="ESTCUSSTAFF" value="<?=isset($data['ESTCUSSTAFF']) ? $data['ESTCUSSTAFF']: ''; ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSCURCD" id="CUSCURCD" value="<?=isset($data['CUSCURCD']) ? $data['CUSCURCD']: ''; ?>" readonly/>
                                        <input class="hidden" type="hidden" name="CUSCURDISP" id="CUSCURDISP" value="<?=isset($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly/>
                                
                                        <select id="BRANCHKBN" name="BRANCHKBN" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($branchkbn as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['BRANCHKBN']) && $data['BRANCHKBN'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="TAXID" id="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REFERENCE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SALECUSMEMO" id="SALECUSMEMO" value="<?=isset($data['SALECUSMEMO']) ? $data['SALECUSMEMO']: ''; ?>" readonly/>
                                        <label class="hidden"><?=checklang('SHIP_VIA'); ?></label>
                                        <input class="hidden" type="hidden" name="SALEDIVCON4" id="SALEDIVCON4" value="<?=isset($data['SALEDIVCON4']) ? $data['SALEDIVCON4']: ''; ?>" />
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
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UOM')?></span>
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
                                        <tr class="row-id" id="rowId<?=$key?>">
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
                                                        id="SSALEQTY<?=$key?>" name="SSALEQTY[]" value="<?=isset($value['SSALEQTY']) ? number_format(str_replace(',', '', $value['SSALEQTY']), 2): '0.00' ?>"
                                                        oninput="this.value = stringReplacez(this.value);" readonly/>
                                            </td>
                                            <td class="max-w-10 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right <?php if($data['CHANGETYP'] != '2') { echo 'read';} ?>" id="SALEQTY<?=$key?>" name="SALEQTY[]" value="<?php if($data['CHANGETYP'] != '2') { echo isset($value['SSALEQTY']) ? number_format(str_replace(',', '', $value['SSALEQTY']), 2): ''; } else { echo isset($value['SALEQTY']) ? number_format(str_replace(',', '', $value['SALEQTY']), 2): '0.00'; } ?>"
                                                    onchange="$('#loading').show(); calculateamt(<?=$key?>); this.value = num2digit(this.value);"
                                                    onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); calculateamt(<?=$key?>); this.value = num2digit(this.value); }"
                                                    oninput="this.value = stringReplacez(this.value);"/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read" 
                                                        id="ITEMUNITTYP<?=$key?>" name="ITEMUNITTYP[]" value="<?=$value['ITEMUNITTYP'] ?>" readonly/>
                                            </td>
                                            <td class="max-w-12 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                        id="SSALEUNITPRC<?=$key?>" name="SSALEUNITPRC[]"
                                                        value="<?=isset($value['SSALEUNITPRC']) ? number_format(str_replace(',', '', $value['SSALEUNITPRC']), 2): '0.00' ?>" readonly/>
                                            </td>
                                            <td class="max-w-12 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right <?php if($data['CHANGETYP'] != '1') {echo 'read';} ?>" id="SALEUNITPRC<?=$key?>" name="SALEUNITPRC[]" 
                                                    value="<?php if($data['CHANGETYP'] != '1') { echo isset($value['SSALEUNITPRC']) ? number_format(str_replace(',', '', $value['SSALEUNITPRC']), 2): '0.00'; } else { echo isset($value['SALEUNITPRC']) ? number_format(str_replace(',', '', $value['SALEUNITPRC']), 2): '0.00'; } ?>"
                                                    onchange="$('#loading').show(); calculateamt(<?=$key?>); this.value = num2digit(this.value);"
                                                    onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); calculateamt(<?=$key?>); this.value = num2digit(this.value); }"
                                                    oninput="this.value = stringReplacez(this.value);"/>
                                            </td>
                                            <td class="max-w-12 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                        id="SALEAMT<?=$key?>" name="SALEAMT[]" value="<?=isset($value['SALEAMT']) ? $value['SALEAMT'] : '' ?>" readonly/>
                                            </td>
                                            <td class="hidden"><input class="w-16 read" id="SALEDISCOUNT2<?=$key?>" name="SALEDISCOUNT2[]"
                                                value="<?=isset($value['SALEDISCOUNT2']) ? $value['SALEDISCOUNT2'] : '' ?>" readonly/></td>
                                            <td class="hidden"><input class="w-16 read" id="SALETAXAMT<?=$key?>" name="SALETAXAMT[]"
                                                value="<?=isset($value['SALETAXAMT']) ? $value['SALETAXAMT'] : '' ?>" readonly/></td>
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
                                        <input type="text" class="hidden" name="SALEDIVCON1" id="SALEDIVCON1" value="<?=isset($data['SALEDIVCON1']) ? $data['SALEDIVCON1']: ''; ?>" readonly/>
                                        <select class="shadow-md text-[12px] border mr-1 px-3 h-7 w-8/12 text-left rounded-xl border-gray-300 req"
                                            id="SALEDIVCON" name="SALEDIVCON" required>
                                            <option value=""></option>
                                            <?php foreach ($data['DCMESSAGE3'] as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['SALEDIVCON']) && $data['SALEDIVCON'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?><h5 class="w-4/12 pl-6 pt-1 text-red-500 font-semibold"><?=checklang('CANCELMSG')?></h5><?php } ?>
                                    </div>
                                    <div class="flex w-5/12">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('SUBTOTAL')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="S_TTL" id="S_TTL" value="<?=!empty($data['S_TTL']) ? number_format(str_replace(',', '', $data['S_TTL']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" id="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-7/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                            name="SALEDIVCON2" id="SALEDIVCON2" value="<?=isset($data['SALEDIVCON2']) ? $data['SALEDIVCON2']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-5/12">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('OLINV')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="OLDINVAMT" id="OLDINVAMT" value="<?=!empty($data['OLDINVAMT']) ? number_format(str_replace(',', '', $data['OLDINVAMT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-7/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                            name="SALEDIVCON3" id="SALEDIVCON3" value="<?=isset($data['SALEDIVCON3']) ? $data['SALEDIVCON3']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-5/12">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('CORINV')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="QUOTEAMOUNT" id="QUOTEAMOUNT" value="<?=!empty($data['QUOTEAMOUNT']) ? number_format(str_replace(',', '', $data['QUOTEAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-7/12">
                                        <label class="text-color block text-sm w-full pr-2 pt-1">ข้อความกฎหมายตาม คำสั่ง ป.80/2542 ฯ</label>
                                    </div>
                                    <div class="flex w-5/12">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('DIFFERENCE')?></label>
                                        <input class="hidden" type="hidden" name="DIFFD" id="DIFFD" value="<?=isset($data['DIFFD']) ? $data['DIFFD']: ''; ?>" readonly/>
                                        <input class="hidden" type="hidden" name="DIFF" id="DIFF" value="<?=isset($data['DIFF']) ? $data['DIFF']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="DIFFDISP" id="DIFFDISP" value="<?=!empty($data['DIFFDISP']) ? number_format(str_replace(',', '', $data['DIFFDISP']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
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
                                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('VATAM')?></label>
                                                <input type="text" class="text-control text-sm shadow-md border text-sm rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                        name="VATRATE" id="VATRATE" onchange="vat();" value="<?=!empty($data['VATRATE']) ? number_format(str_replace(',', '', $data['VATRATE']), 2): '0.00'; ?>"
                                                        oninput="this.value = stringReplacez(this.value);" readonly/>&nbsp;
                                                <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                        name="VATAMOUNT1" id="VATAMOUNT1" value="<?=!empty($data['VATAMOUNT1']) ? number_format(str_replace(',', '', $data['VATAMOUNT1']), 2): '0.00'; ?>" readonly/>
                                                <input class="hidden" name="VATAMOUNT" id="VATAMOUNT" value="<?=!empty($data['VATAMOUNT']) ? number_format(str_replace(',', '', $data['VATAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                        name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                                            </div>
                                            <div class="flex">
                                                <label class="text-color text-sm w-5/12 pr-2 pt-1"><?=checklang('TOTAL_AMOUNT')?></label>
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                        name="T_AMOUNT" id="T_AMOUNT" value="<?=!empty($data['T_AMOUNT']) ? number_format(str_replace(',', '', $data['T_AMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                        name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
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
                                id="COMMIT" name="COMMIT"><?=checklang('COMMIT'); ?></button>
                        <div class="w-1/12"></div>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center me-2 mb-2"
                                id="DCFORM" name="DCFORM"><?=checklang('DCFORM'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center me-2 mb-2"
                                id="DCVC" name="DCVC"><?=checklang('DCVC'); ?></button>
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
        document.getElementById('reason').style.display = 'none';
        // document.getElementById('reason').style.visibility = 'hidden';
        // document.getElementById('DCFORM').style.visibility = 'hidden';
        // document.getElementById('DCVC').style.visibility = 'hidden';
        document.getElementById('DCFORM').disabled = true;
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
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke'); // $('.text-control').attr('style', 'pointer-events: none').css('background-color', 'whitesmoke');
            $('#SALETRANNO').removeAttr('disabled').css('background-color', 'white'); // $('#SALETRANNO').removeAttr('style').css('background-color', 'white');
            $('#SEARCHSALETRAN_ACC2').css('pointer-events', 'auto');
            $('.table .search-tag').css('pointer-events', 'none');
            $('.table .text-control').attr('readonly', true).css('background-color', 'whitesmoke');
        }                       
        if(commits == 'F') { document.getElementById('COMMIT').disabled = true; }
        // if(cancels == 'F') { document.getElementById("cancel").disabled = true; }
        if(dummyprt1 == 'T') { document.getElementById('DCFORM').disabled = false;  } // document.getElementById('DCFORM').style.visibility = 'visible';
        if(dummyprt2 == 'T') { document.getElementById('DCVC').disabled = false; } 
        if(reprint == 'T') { document.getElementById('reason').style.display = 'block'; } // document.getElementById('reason').style.visibility = 'visible';
        if(reprintbl == 'F') { $('#REPRINTREASON').attr('readonly', true).css('background-color', 'whitesmoke'); }
        if(reason == 'F') { $('#REPRINTREASON').attr('readonly', true).css('background-color', 'whitesmoke'); }

        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[272px]');
                tablearea.classList.add('h-[420px]');
                maxrow = 15;
            } else {
                tablearea.classList.remove('h-[420px]');
                tablearea.classList.add('h-[272px]');
                maxrow = 8;
            }
            emptyRows(maxrow);
        })
    });


    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        if(code == 'STAFFCD') {
            return getElement(code, result);
        } else {
            return getSearch(code, result);
        }
    }

    function actionDialog(type) {
        if(type == 2) {
            return questionDialog(2, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');        
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
                $('#loading').show();
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
            }
        });
    }
</script>
</html>