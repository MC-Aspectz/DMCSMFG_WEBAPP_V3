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
            <form class="w-full" method="POST" action="" id="newShipRequestEntry" name="newShipRequestEntry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALES_ORDER_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SALEORDERNUMBER_S" id="SALEORDERNUMBER_S" value="<?=isset($data['SALEORDERNUMBER_S']) ? $data['SALEORDERNUMBER_S']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALEORDERDETAIL">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="w-5/12"></div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DELIVERY_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                        type="date" id="ISSUEDATE1" name="ISSUEDATE1" value="<?=!empty($data['ISSUEDATE1']) ? date('Y-m-d', strtotime($data['ISSUEDATE1'])) : ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('ARROW')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                        type="date" id="ISSUEDATE2" name="ISSUEDATE2" value="<?=!empty($data['ISSUEDATE2']) ? date('Y-m-d', strtotime($data['ISSUEDATE2'])) : ''; ?>"/>
                                        <label class="w-2/12"></label>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
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
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CATEGORY_CODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CATALOGCD" id="CATALOGCD" value="<?=isset($data['CATALOGCD']) ? $data['CATALOGCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCATALOG">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CATALOGNAME" id="CATALOGNAME" value="<?=isset($data['CATALOGNAME']) ? $data['CATALOGNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
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
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 hidden"><?=checklang('STATUS')?></label>
                                        <select id="STATUS" name="STATUS" class="hidden text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300">
                                            <option value=""></option>
                                            <?php foreach ($STATUS01 as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['STATUS']) && $data['STATUS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center" 
                                                id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SHIP_DATE')?></label>
                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                            type="date" id="DELIDATE" name="DELIDATE" value="<?=!empty($data['DELIDATE']) ? date('Y-m-d', strtotime($data['DELIDATE'])) : date('Y-m-d'); ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2 justify-end">
                        <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="up-row">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </button>
                        <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="down-row">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </div>
                </div>

                <hr class="divide-y divide-dotted my-2 mx-2">

                <!-- Table -->
                <div id="table-area" class="overflow-scroll px-2 block h-[496px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 gvc" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-3 text-center border border-slate-700">
                                    <input type="hidden" name="CHKALL" value="F"/>
                                    <input class="chkbox" type="checkbox" id="CHKALL" name="CHKALL" value="T" onclick="checkedAll(1);"/>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELIVERY_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMSPEC')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDERBALANCE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALESTAFFNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDER_NO_CUSTOMER')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE_NAME')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 row-id" id="rowId<?=$key?>">
                                    <td class="hidden"><?=$key?></td>
                                    <td class="h-6 w-16 text-sm text-center">
                                        <input type="hidden" id="CHECKROWH<?=$key?>" name="CHECKROW[]" value=""/>
                                        <input class="chkbox" type="checkbox" id="CHECKROW<?=$key?>" name="CHECKROW[]" value="T" 
                                                onchange="chked(<?=$key?>);" <?=isset($value['CHECKROW']) && $value['CHECKROW'] == 'T' ? 'checked' : '' ?>/>
                                    </td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ODRNUMLINE']) ? $value['ODRNUMLINE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALEORDERISSUEDATE']) ? $value['SALEORDERISSUEDATE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ORDERDETAILITEMCODE']) ? $value['ORDERDETAILITEMCODE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ORDERDETAILITEMNAME']) ? $value['ORDERDETAILITEMNAME']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ORDERDETAILITEMSPEC']) ? $value['ORDERDETAILITEMSPEC']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['ORDERDETAILQUANTITY']) ? $value['ORDERDETAILQUANTITY']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['ORDERDETAILBALANCEQUANTITY']) ? $value['ORDERDETAILBALANCEQUANTITY']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALEORDERCUSTOMERCODE']) ? $value['SALEORDERCUSTOMERCODE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SALEORDERCUSTOMERNAME']) ? $value['SALEORDERCUSTOMERNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALEORDERCUSTOMERSTAFF']) ? $value['SALEORDERCUSTOMERSTAFF']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ORDERDETAILCUSTOMERORDERNUMBER']) ? $value['ORDERDETAILCUSTOMERORDERNUMBER']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALEORDERDELIVERYCODE']) ? $value['SALEORDERDELIVERYCODE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALEORDERDELIVERYNAME']) ? $value['SALEORDERDELIVERYNAME']: '' ?></td>

                                    <td class="hidden"><input type="hidden" id="ODRNUMLINE<?=$key?>" name="ODRNUMLINE[]" value="<?=isset($value['ODRNUMLINE']) ? $value['ODRNUMLINE']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="SALEORDERNUMBER<?=$key?>" name="SALEORDERNUMBER[]" value="<?=isset($value['SALEORDERNUMBER']) ? $value['SALEORDERNUMBER']: '' ?>"/>
                                    <td class="hidden">
                                        <input type="hidden" id="ORDERDETAILNUMBERLINE<?=$key?>" name="ORDERDETAILNUMBERLINE[]" value="<?=isset($value['ORDERDETAILNUMBERLINE']) ? $value['ORDERDETAILNUMBERLINE']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="SALEORDERISSUEDATE<?=$key?>" name="SALEORDERISSUEDATE[]" value="<?=isset($value['SALEORDERISSUEDATE']) ? $value['SALEORDERISSUEDATE']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="SALEORDERCUSTOMERCODE<?=$key?>" name="SALEORDERCUSTOMERCODE[]" value="<?=isset($value['SALEORDERCUSTOMERCODE']) ? $value['SALEORDERCUSTOMERCODE']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="SALEORDERCUSTOMERNAME<?=$key?>" name="SALEORDERCUSTOMERNAME[]" value="<?=isset($value['SALEORDERCUSTOMERNAME']) ? $value['SALEORDERCUSTOMERNAME']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="SALEORDERCUSTOMERSTAFF<?=$key?>" name="SALEORDERCUSTOMERSTAFF[]" value="<?=isset($value['SALEORDERCUSTOMERSTAFF']) ? $value['SALEORDERCUSTOMERSTAFF']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="SALEORDERDELIVERYCODE<?=$key?>" name="SALEORDERDELIVERYCODE[]" value="<?=isset($value['SALEORDERDELIVERYCODE']) ? $value['SALEORDERDELIVERYCODE']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="SALEORDERDELIVERYNAME<?=$key?>" name="SALEORDERDELIVERYNAME[]" value="<?=isset($value['SALEORDERDELIVERYNAME']) ? $value['SALEORDERDELIVERYNAME']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="SALEORDERDELIVERYSTAFF<?=$key?>" name="SALEORDERDELIVERYSTAFF[]" value="<?=isset($value['SALEORDERDELIVERYSTAFF']) ? $value['SALEORDERDELIVERYSTAFF']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="ORDERDETAILCUSTOMERORDERNUMBER<?=$key?>" name="ORDERDETAILCUSTOMERORDERNUMBER[]" 
                                                value="<?=isset($value['ORDERDETAILCUSTOMERORDERNUMBER']) ? $value['ORDERDETAILCUSTOMERORDERNUMBER']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="ORDERDETAILITEMCODE<?=$key?>" name="ORDERDETAILITEMCODE[]" value="<?=isset($value['ORDERDETAILITEMCODE']) ? $value['ORDERDETAILITEMCODE']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="ORDERDETAILITEMNAME<?=$key?>" name="ORDERDETAILITEMNAME[]" value="<?=isset($value['ORDERDETAILITEMNAME']) ? $value['ORDERDETAILITEMNAME']: '' ?>"/>
                                    </td>
                                    <td class="hidden"><input type="hidden" id="SALETRANSTYP<?=$key?>" name="SALETRANSTYP[]" value="<?=isset($value['SALETRANSTYP']) ? $value['SALETRANSTYP']: '' ?>"/></td>
                                    <td class="hidden">
                                        <input type="hidden" id="ORDERDETAILQUANTITY<?=$key?>" name="ORDERDETAILQUANTITY[]" value="<?=isset($value['ORDERDETAILQUANTITY']) ? $value['ORDERDETAILQUANTITY']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="ORDERDETAILBALANCEQUANTITY<?=$key?>" name="ORDERDETAILBALANCEQUANTITY[]" 
                                            value="<?=isset($value['ORDERDETAILBALANCEQUANTITY']) ? $value['ORDERDETAILBALANCEQUANTITY']: '' ?>"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="hidden" id="ORDERSTATUS<?=$key?>" name="ORDERSTATUS[]" value="<?=isset($value['ORDERSTATUS']) ? $value['ORDERSTATUS']: '' ?>"/></td>
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
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>
     
                <div class="flex mt-2 px-2">
                    <div class="flex w-8/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT"><?=checklang('COMMIT'); ?></button>
                        <label class="text-color block text-sm w-10/12 px-2 pt-1"><?=checklang('DSP_MSG_01')?></label>
                    </div>
                    <div class="flex w-4/12 justify-end">
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
<script type="text/javascript">   
    $(document).ready(function() {
        const detailTb = document.getElementById('dvwdetail');
        var dataItem = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
            }
        });

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[496px]');
                tablearea.classList.add('h-[620px]');
                maxrow = 23;
            } else {
                tablearea.classList.remove('h-[620px]');
                tablearea.classList.add('h-[496px]');
                maxrow = 18;
            }
            emptyRows(maxrow);
        });

        $('#up-row').click(function() {
            upNdown('up');
        });

        $('#down-row').click(function() {
            upNdown('down');
        });
    });

    var index;  // variable to set the selected row index
    function getSelectedRow() {
        var table = document.getElementById('table');
        for(var i = 1; i < table.rows.length; i++) {
            table.rows[i].onclick = function() {
                // the first time index is undefined
                if(typeof index !== 'undefined') {
                    table.rows[index].classList.toggle('selected');
                }
                index = this.rowIndex;
                this.classList.toggle('selected');
            };
        }
    }

    getSelectedRow();
            
    function upNdown(direction) {
        var length = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        var rows = document.getElementById('table').rows,
            parent = rows[index].parentNode;
        if(direction === 'up') {
            if(index > 1) {
                parent.insertBefore(rows[index],rows[index - 1]);
                // when the row go up the index will be equal to index - 1
                index--;
            }
        }
         
        if(direction === 'down') {
            // if(index < rows.length -1) {
            if(index < length) {
                parent.insertBefore(rows[index + 1],rows[index]);
                // when the row go down the index will be equal to index + 1
                index++;
            }
        }
    }

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'SALEORDERNUMBER_S') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function checkedAll() {
        var checkall = document.getElementById('CHKALL');
        var dvw = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>'; 
        if(dvw != '') {
            let dvwArray = JSON.parse(dvw);
            $.each(dvwArray, function(key, value) {  
                // console.log(key);
                if (checkall.checked) {
                    $('#CHECKROW'+key+'').prop('checked', true);
                    document.getElementById('CHECKROWH'+key+'').disabled = true;
                } else {
                    $('#CHECKROW'+key+'').prop('checked', false);
                    document.getElementById('CHECKROWH'+key+'').disabled = false;
                }
            });
        }
    }

    function chked(index) {
      // console.log(index);
        if (document.getElementById('CHECKROW' + index + '').checked) {
            document.getElementById('CHECKROWH' + index + '').disabled = true;
        } else {
            document.getElementById('CHECKROWH' + index + '').disabled = false;
        }
    }
</script>
</html>