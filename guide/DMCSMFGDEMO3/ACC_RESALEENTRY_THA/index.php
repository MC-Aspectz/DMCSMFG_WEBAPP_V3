<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=!empty($data['DRPLANG']['APPCODE']['ACC_RESALEENTRY_THA']) ? $_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['ACC_RESALEENTRY_THA']: $_SESSION['APPNAME']; ?></title>
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
            <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="oldRouteUrl" name="oldRouteUrl" value="<?=$oldRouteUrl?>">
            <input type="hidden" id="oldRouteUrl2" name="oldRouteUrl2" value="<?=$oldRouteUrl2?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page']: ''?>">
            <form class="w-full" method="POST" id="saleentry" name="saleentry" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=!empty($data['DRPLANG']['APPCODE']['ACC_RESALEENTRY_THA']) ? $_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['ACC_RESALEENTRY_THA']: $_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CANCEL_INVOICE_NO')?></label>
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                                name="CANCELTRANNO" id="CANCELTRANNO" value="<?=isset($data['CANCELTRANNO']) ? $data['CANCELTRANNO']: ''; ?>"/>
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('INVOICE_NO')?></label>
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="SALETRANNO" id="SALETRANNO" value="<?=isset($data['SALETRANNO']) ? $data['SALETRANNO']: ''; ?>" readonly/>
                        <input type="hidden" name="CANCELSVNO" id="CANCELSVNO" value="<?=isset($data['CANCELSVNO']) ? $data['CANCELSVNO']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2 justify-end">
                       <label class="w-7/12"></label>
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                type="date" id="SALETRANSALEDT" name="SALETRANSALEDT" value="<?=!empty($data['SALETRANSALEDT']) ? date('Y-m-d', strtotime($data['SALETRANSALEDT'])) : date('Y-m-d'); ?>"/>
                        <input class="hidden" type="date" id="SALELNDUEDT" name="SALELNDUEDT" value="<?=isset($data['SALELNDUEDT']) ? date('Y-m-d', strtotime($data['SALELNDUEDT'])): date('Y-m-d'); ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALEORDERNO')?></label>
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                                name="SALEORDERNO" id="SALEORDERNO" value="<?=isset($data['SALEORDERNO']) ? $data['SALEORDERNO']: ''; ?>"/>
                        <input type="hidden" name="SVNO" id="SVNO" value="<?=isset($data['SVNO']) ? $data['SVNO']: ''; ?>"/>
                        <label class="w-5/12"></label>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    name="CUSTOMERCD" id="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHCUSTOMER">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVDATE')?></label>
                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                type="date" id="SALETRANINSPDT" name="SALETRANINSPDT" value="<?=isset($data['SALETRANINSPDT']) ? date('Y-m-d', strtotime($data['SALETRANINSPDT'])) : date('Y-m-d'); ?>"/>
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('CREDITTERM')?></label>

                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                name="SALETERM" id="SALETERM" onchange="unRequired();" oninput="this.value = stringReplacez(this.value);"
                                value="<?=isset($data['SALETERM']) ? $data['SALETERM'] : ''; ?>"/>
                        <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-1"><?=checklang('DAYS')?></label>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="CUSTADDR1" id="CUSTADDR1" value="<?=isset($data['CUSTADDR1']) ? $data['CUSTADDR1']: ''; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    name="DIVISIONCD" id="DIVISIONCD" value="<?=!empty($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" onchange="unRequired();"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                id="SEARCHDIVISION">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="DIVISIONNAME" id="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="CUSTADDR2" id="CUSTADDR2" value="<?=isset($data['CUSTADDR2']) ? $data['CUSTADDR2']: ''; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    name="STAFFCD" id="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" onchange="unRequired();"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                id="SEARCHSTAFF">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="STAFFNAME" id="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
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
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    name="CUSCURCD" id="CUSCURCD" value="<?=isset($data['CUSCURCD']) ? $data['CUSCURCD']: ''; ?>" <?php if(isset($data['SALETRANNO'])) { ?> readonly class="read" <?php } ?>/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                id="SEARCHCURRENCY"/>
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="flex w-5/12">
                            <select id="BRANCHKBN" name="BRANCHKBN" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300 read" readonly>
                                <option value=""></option>
                                <?php foreach ($branchkbn as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['BRANCHKBN']) && $data['BRANCHKBN'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                    name="TAXID" id="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                        </div>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ATTENTION')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                name="ESTCUSSTAFF" id="ESTCUSSTAFF" value="<?=isset($data['ESTCUSSTAFF']) ? $data['ESTCUSSTAFF']: ''; ?>"/>
                    </div>
                </div>


                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REFERENCE')?></label>
                        <input type="text" class="shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                        name="SALECUSMEMO" id="SALECUSMEMO" value="<?=isset($data['SALECUSMEMO']) ? $data['SALECUSMEMO']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DESCRIPTION')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                        name="DESCRIPTION" id="DESCRIPTION" value="<?=isset($data['DESCRIPTION']) ? $data['DESCRIPTION']: ''; ?>"/>
                    </div>
                </div>
            
               <div class="flex">
                    <div class="table">
                        <table id="table" class="quote_table w-full border-collapse border border-slate-500">
                            <thead class="bg-gray-50 dark:bg-slate-800">
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
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UOM')?></span>
                                    </th>
                                    <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT_PRICE')?></span>
                                    </th>

                                    <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DISCOUNT')?></span>
                                    </th>

                                    <th class="px-6 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AMOUNT')?></span>
                                    </th>
                                </tr>
                            </thead>
                  
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                 <?php if(!empty($data['ITEM']))  { $minrow = count($data['ITEM']);
                                    foreach($data['ITEM'] as $key => $value) { ?>
                                        <tr id="rowId<?=$key?>">
                                            <td class="row-id text-center max-w-4 text-sm border border-slate-700" id="ROWNO<?=$key?>" name="ROWNO[]"><?=$key?></td>
                                            <td class="max-w-24 text-sm border border-slate-700">
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                            id="ITEMCD<?=$key?>" name="ITEMCD[]" value="<?=$value['ITEMCD'];?>" readonly>
                                            </td>
                                            <td class="max-w-32 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                        id="ITEMNAME<?=$key?>" name="ITEMNAME[]" value="<?=$value['ITEMNAME'] ?>" readonly/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                        id="SALEQTY<?=$key?>" name="SALEQTY[]" value="<?=!empty($value['SALEQTY']) ? number_format(str_replace(',', '', $value['SALEQTY']), 0): '' ?>" readonly/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read" 
                                                        id="ITEMUNITTYP<?=$key?>" name="ITEMUNITTYP[]" value="<?=$value['ITEMUNITTYP'] ?>" readonly/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                        id="SALEUNITPRC<?=$key?>" name="SALEUNITPRC[]"
                                                        value="<?=!empty($value['SALEUNITPRC']) ? number_format(str_replace(',', '', $value['SALEUNITPRC']), 4): '0.0000' ?>" readonly/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                        id="SALEDISCOUNT<?=$key?>" name="SALEDISCOUNT[]"
                                                        value="<?=!empty($value['SALEDISCOUNT']) ? number_format(str_replace(',', '', $value['SALEDISCOUNT']), 4) : '0.0000' ?>" readonly/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                        id="SALEAMT<?=$key?>" name="SALEAMT[]" value="<?=isset($value['SALEAMT']) ? $value['SALEAMT'] : '' ?>" readonly/>
                                            </td>
                                            <td class="hidden"><input class="w-16 read" id="SALEDISCOUNT2<?=$key?>" name="SALEDISCOUNT2[]"
                                                value="<?=!empty($value['SALEDISCOUNT2']) ? $value['SALEDISCOUNT2'] : '' ?>" readonly/></td>
                                            <td class="hidden"><input class="w-16 read" id="SALELN<?=$key?>" name="SALELN[]"
                                                value="<?=!empty($value['SALELN']) ? $value['SALELN'] : '' ?>" readonly/></td>
                                            <td class="hidden"><input class="w-16 read" id="SALEORDERQTY<?=$key?>" name="SALEORDERQTY[]"
                                                value="<?=!empty($value['SALEORDERQTY']) ? $value['SALEORDERQTY'] : '' ?>" readonly/></td>
                                        </tr><?php
                                    }
                                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                        <tr id="rowId<?=$i?>">
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                        </tr><?php 
                                    }
                                } else {
                                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                        <tr id="rowId<?=$i?>">
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                        </tr><?php
                                    }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <td class="text-color h-6 text-[12px] p-2" colspan="8"><?=checklang('ROWCOUNT');?><span id="rowcount" ><?=$minrow;?></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-8/12">
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300 read"
                            name="SALEDIVCON1" id="SALEDIVCON1" value="<?=!empty($data['SALEDIVCON1']) ? $data['SALEDIVCON1']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('SUBTOTAL')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="S_TTL" id="S_TTL" value="<?=!empty($data['S_TTL']) ? number_format(str_replace(',', '', $data['S_TTL']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" id="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-8/12">
                        <input type="text" class="hidden" name="SALEDIVCON2" id="SALEDIVCON2" value="<?=!empty($data['SALEDIVCON2']) ? $data['SALEDIVCON2']: ''; ?>" readonly/>
                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-8/12 text-left rounded-xl border-gray-300 req"
                            id="SALEDIVCON2CBO" name="SALEDIVCON2CBO" <?php if(isset($data['SALEDIVCON2CBO']) && $data['SALEDIVCON2CBO'] == '') {?> style="color: red; outline: red solid 1px;" <?php }?> required>
                            <option value=""></option>
                            <?php foreach ($cancelreason as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['SALEDIVCON2CBO']) && $data['SALEDIVCON2CBO'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DISCOUNT')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="DISCRATE" id="DISCRATE" value="<?=!empty($data['DISCRATE']) ? $data['DISCRATE']: '0'; ?>" readonly/>&nbsp;
                        <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="DISCOUNTAMOUNT" id="DISCOUNTAMOUNT" value="<?=!empty($data['DISCOUNTAMOUNT']) ? number_format(str_replace(',', '', $data['DISCOUNTAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" <?php if(!empty($data['CUSCURDISP'])){ ?> value="<?=$data['CUSCURDISP']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-8/12">
                        <input type="text" class="shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                            name="SALEDIVCON3" id="SALEDIVCON3" value="<?=!empty($data['SALEDIVCON3']) ? $data['SALEDIVCON3']: ''; ?>"/>
                    </div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('AFTERDISCOUNT')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="QUOTEAMOUNT" id="QUOTEAMOUNT" value="<?=!empty($data['QUOTEAMOUNT']) ? number_format(str_replace(',', '', $data['QUOTEAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-8/12"></div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('VAT')?></label>
                        <input type="text" class="text-control text-sm shadow-md border text-sm rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="VATRATE" id="VATRATE" value="<?=!empty($data['VATRATE']) ? $data['VATRATE']: ''; ?>" readonly/>&nbsp;
                        <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="VATAMOUNT1" id="VATAMOUNT1" value="<?=!empty($data['VATAMOUNT1']) ? number_format(str_replace(',', '', $data['VATAMOUNT1']), 2): '0.00'; ?>" readonly/>
                        <input class="hidden" name="VATAMOUNT" id="VATAMOUNT" value="<?=!empty($data['VATAMOUNT']) ? number_format(str_replace(',', '', $data['VATAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-8/12"></div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('TOTALAMOUNT')?></label>
                        <input type="hidden" class="hidden" name="T_AMOUNT" id="T_AMOUNT" value="<?=!empty($data['T_AMOUNT']) ? number_format(str_replace(',', '', $data['T_AMOUNT']), 2): '0.00'; ?>"/>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="T_AMOUNT1" id="T_AMOUNT1" value="<?=!empty($data['T_AMOUNT1']) ? number_format(str_replace(',', '', $data['T_AMOUNT1']) + str_replace(',', '', $data['VATAMOUNT']) + str_replace(',', '', $data['VATAMOUNT1']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                        <input type="hidden" class="hidden" name="GROUPRT" type="text" value="<?=!empty($data['GROUPRT']) ? $data['GROUPRT']: ''; ?>"/>
                    </div>
                </div>

                <div class="flex mt-2">
                    <div class="flex w-8/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" id="replacez" name="replacez"><?=checklang('REPLACE'); ?></button>
                    </div>
                    <div class="flex w-4/12 px-1 justify-end">
                        <button type="button" id="back" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"><?=checklang('BACK'); ?></button>
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
        document.querySelector('.side-menu').classList.add('hidden');
        $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
        $('.table .search-tag').css('pointer-events', 'none');
        $('.table .text-control').attr('readonly', true).css('background-color', 'whitesmoke');
        // $('#CUSTOMERCD').removeAttr('disabled').css('background-color', 'white');
        // $('#DIVISIONCD').removeAttr('disabled').css('background-color', 'white');
        // $('#STAFFCD').removeAttr('disabled').css('background-color', 'white');
        // $('#CUSCURCD').removeAttr('disabled').css('background-color', 'white');
        // $('#SALEDIVCON3').removeAttr('disabled').css('background-color', 'white');
        // $('#SALEDIVCON2CBO').removeAttr('disabled').css('background-color', 'white');
        // $('#SALECUSMEMO').removeAttr('disabled').css('background-color', 'white');
    }); 

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        return getSearch(code, result);
    }

    function commitDialog() {
       return questionDialog(1, '<?=$lang['question3']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
    }

    function successValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=$lang['success']; ?>',
            // background: '#8ca3a3',
            showCancelButton: false,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                document.getElementById("replacez").disabled = true;
            }
        });
    }
   
    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=$lang['validation1']; ?>',
            // background: '#8ca3a3',
            showCancelButton: false,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }
</script>
</html>
