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
            <form class="w-full" method="POST" action="" id="newShipEntryMFG" name="newShipEntryMFG" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CUSTOMERCD_S" id="CUSTOMERCD_S" value="<?=isset($data['CUSTOMERCD_S']) ? $data['CUSTOMERCD_S']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCUSTOMER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-[14px] text-gray-700 border-gray-300 read"
                                                name="CUSTOMERNAME_S" id="CUSTOMERNAME_S" value="<?=isset($data['CUSTOMERNAME_S']) ? $data['CUSTOMERNAME_S']: ''; ?>" readonly/>
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TRANSPORTER')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300"
                                            id="TRANSPORT_S" name="TRANSPORT_S">
                                            <option value=""></option>
                                            <?php foreach ($TRANSPORT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['TRANSPORT_S']) && $data['TRANSPORT_S'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('BRANCH_TYPE')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300"
                                            id="FACTYP" name="FACTYP">
                                            <option value=""></option>
                                            <?php foreach ($FACTORY as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['FACTYP']) && $data['FACTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
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

                <div class="flex mb-1 px-4">
                    <div class="flex w-6/12 px-1">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SHIP_DATE')?></label>
                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                            type="date" id="DELIDATE" name="DELIDATE" value="<?=!empty($data['DELIDATE']) ? date('Y-m-d', strtotime($data['DELIDATE'])) : date('Y-m-d'); ?>"/>
                        <label class="text-color block text-sm w-6/12 px-2 pt-1"><?=checklang('DSP_MSG_03')?></label>
                    </div>
                    <div class="flex w-6/12 px-2 justify-end"></div>
                </div>

                <hr class="divide-y divide-dotted my-2 mx-2">

                <!-- Table -->
                <div id="table-area" class="overflow-scroll px-2 block h-[496px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-3 text-center border border-slate-700">
                                    <input type="hidden" name="CHKALL" value="F"/>
                                    <input class="chkbox" type="checkbox" id="CHKALL" name="CHKALL" value="T" onclick="checkedAll(1);"/>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHER_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STRAGE_CODE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STORAGE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
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
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SHIP_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BRANCH_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang(' ')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STAFF_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ORDER_NO_CUSTOMER')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CATEGORY_CODE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CATEGORY_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE_NAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TRANSPORTER')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUSPEND_FLG')?></span>
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
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?></td>
                                    <td class="h-6 w-2/12 text-sm border border-slate-700 text-center"><?=isset($value['SHIPDT']) ? $value['SHIPDT']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right"><?=isset($value['SHIPQTY']) ? $value['SHIPQTY']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SALELNFACTYP']) ? $value['SALELNFACTYP']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALEODRLN']) ? $value['SALEODRLN']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SALELNSTATUS']) ? $STATUS_SALES[$value['SALELNSTATUS']]: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['CUSTOMERCD']) ? $value['CUSTOMERCD']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['CUSTOMERNAME']) ? $value['CUSTOMERNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['STAFFNAME']) ? $value['STAFFNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['SALECUSORDERNO']) ? $value['SALECUSORDERNO']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ITEMCATCD']) ? $value['ITEMCATCD']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['ITEMCATNAME']) ? $value['ITEMCATNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['DELIVERYCODE']) ? $value['DELIVERYCODE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['DELIVERYNAME']) ? $value['DELIVERYNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=!empty($value['SHIPREQTRANSTYP']) ? $TRANSPORT[$value['SHIPREQTRANSTYP']]: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPREQSUSPENDTYP']) ? $SUSPEND_SEL[$value['SHIPREQSUSPENDTYP']]: '' ?></td>

                                    <input type="hidden" id="ODRNUMLINE<?=$key?>" name="ODRNUMLINE[]" value="<?=isset($value['ODRNUMLINE']) ? $value['ODRNUMLINE']: '' ?>"/>
                                    <input type="hidden" id="LOCCD<?=$key?>" name="LOCCD[]" value="<?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?>"/>
                                    <input type="hidden" id="LOCNAME<?=$key?>" name="LOCNAME[]" value="<?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?>"/>
                                    <input type="hidden" id="SHIPDT<?=$key?>" name="SHIPDT[]" value="<?=isset($value['SHIPDT']) ? $value['SHIPDT']: '' ?>"/>
                                    <input type="hidden" id="ITEMCODE<?=$key?>" name="ITEMCODE[]" value="<?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?>"/>
                                    <input type="hidden" id="ITEMNAME<?=$key?>" name="ITEMNAME[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?>"/>
                                    <input type="hidden" id="ITEMSPEC<?=$key?>" name="ITEMSPEC[]" value="<?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?>"/>
                                    <input type="hidden" id="SHIPQTY<?=$key?>" name="SHIPQTY[]" value="<?=isset($value['SHIPQTY']) ? $value['SHIPQTY']: '' ?>"/>
                                    <input type="hidden" id="SALELNFACTYP<?=$key?>" name="SALELNFACTYP[]" value="<?=isset($value['SALELNFACTYP']) ? $value['SALELNFACTYP']: '' ?>"/>
                                    <input type="hidden" id="SALEODRLN<?=$key?>" name="SALEODRLN[]" value="<?=isset($value['SALEODRLN']) ? $value['SALEODRLN']: '' ?>"/>
                                    <input type="hidden" id="SALELNSTATUS<?=$key?>" name="SALELNSTATUS[]" value="<?=isset($value['SALELNSTATUS']) ? $value['SALELNSTATUS']: '' ?>"/>
                                    <input type="hidden" id="CUSTOMERCD<?=$key?>" name="CUSTOMERCD[]" value="<?=isset($value['CUSTOMERCD']) ? $value['CUSTOMERCD']: '' ?>"/>
                                    <input type="hidden" id="CUSTOMERNAME<?=$key?>" name="CUSTOMERNAME[]" value="<?=isset($value['CUSTOMERNAME']) ? $value['CUSTOMERNAME']: '' ?>"/>
                                    <input type="hidden" id="STAFFNAME<?=$key?>" name="STAFFNAME[]" value="<?=isset($value['STAFFNAME']) ? $value['STAFFNAME']: '' ?>"/>
                                    <input type="hidden" id="SALECUSORDERNO<?=$key?>" name="SALECUSORDERNO[]" value="<?=isset($value['SALECUSORDERNO']) ? $value['SALECUSORDERNO']: '' ?>"/>
                                    <input type="hidden" id="ITEMCATCD<?=$key?>" name="ITEMCATCD[]"     value="<?=isset($value['ITEMCATCD']) ? $value['ITEMCATCD']: '' ?>"/>
                                    <input type="hidden" id="ITEMCATNAME<?=$key?>" name="ITEMCATNAME[]" value="<?=isset($value['ITEMCATNAME']) ? $value['ITEMCATNAME']: '' ?>"/>
                                    <input type="hidden" id="DELIVERYCODE<?=$key?>" name="DELIVERYCODE[]" value="<?=isset($value['DELIVERYCODE']) ? $value['DELIVERYCODE']: '' ?>"/>
                                    <input type="hidden" id="DELIVERYNAME<?=$key?>" name="DELIVERYNAME[]" value="<?=isset($value['DELIVERYNAME']) ? $value['DELIVERYNAME']: '' ?>"/>
                                    <input type="hidden" id="SHIPREQTRANSTYP<?=$key?>" name="SHIPREQTRANSTYP[]" value="<?=isset($value['SHIPREQTRANSTYP']) ? $value['SHIPREQTRANSTYP']: '' ?>"/>
                                    <input type="hidden" id="SHIPREQSUSPENDTYP<?=$key?>" name="SHIPREQSUSPENDTYP[]" value="<?=isset($value['SHIPREQSUSPENDTYP']) ? $value['SHIPREQSUSPENDTYP']: '' ?>"/>
                                    <input type="hidden" id="SHIPREQNO<?=$key?>" name="SHIPREQNO[]" value="<?=isset($value['SHIPREQNO']) ? $value['SHIPREQNO']: '' ?>"/>
                                    <input type="hidden" id="SHIPREQLN<?=$key?>" name="SHIPREQLN[]" value="<?=isset($value['SHIPREQLN']) ? $value['SHIPREQLN']: '' ?>"/>
                                    <input type="hidden" id="LOCTYP<?=$key?>" name="LOCTYP[]" value="<?=isset($value['LOCTYP']) ? $value['LOCTYP']: '' ?>"/>
                                    <input type="hidden" id="ITEMUNITTYP<?=$key?>" name="ITEMUNITTYP[]" value="<?=isset($value['ITEMUNITTYP']) ? $value['ITEMUNITTYP']: '' ?>"/>
                                    <input type="hidden" id="GMAPADR<?=$key?>" name="GMAPADR[]" value="<?=isset($value['GMAPADR']) ? $value['GMAPADR']: '' ?>"/>
                                    <input type="hidden" id="SALEODR<?=$key?>" name="SALEODR[]" value="<?=isset($value['SALEODR']) ? $value['SALEODR']: '' ?>"/>
                                    <input type="hidden" id="SALELNE<?=$key?>" name="SALELNE[]" value="<?=isset($value['SALELNE']) ? $value['SALELNE']: '' ?>"/>
                                    <input type="hidden" id="SALELNINSPTYP<?=$key?>" name="SALELNINSPTYP[]" value="<?=isset($value['SALELNINSPTYP']) ? $value['SALELNINSPTYP']: '' ?>"/>
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
                        <label class="text-color block text-sm w-4/12 px-2 pt-1"><?=checklang('')?></label>
                        <input type="hidden" id="GMAPADR" name="GMAPADR">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="GMAPVIEW" name="GMAPVIEW"><?=checklang('MAP_RECIPIENT'); ?></button>
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
                let index = item.eq(0).text(); $('#GMAPADR').val('');
                $('#GMAPADR').val($('#GMAPADR'+index+'').val());
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
    });
   
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