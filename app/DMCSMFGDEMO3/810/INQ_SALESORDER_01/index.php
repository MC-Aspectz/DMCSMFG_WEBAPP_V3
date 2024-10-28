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
        <main class="flex flex-1 overflow-y-auto paragraph">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="inqSaleOrder" name="inqSaleOrder" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <?php // language('development')?>
                <div class="flex flex-col mx-1">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="CUSTOMERCODE_TXT"><?=checklang('CUSTOMERCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                    id="CUSTOMERCD" name="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCUSTOMER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="CUSTOMERNAME_S" name="CUSTOMERNAME_S" value="<?=isset($data['CUSTOMERNAME_S']) ? $data['CUSTOMERNAME_S']: ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                    id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                        <input type="text" class="hidden" id="PURORDERNOID" name="PURORDERNOID" value="<?=isset($data['PURORDERNOID']) ? $data['PURORDERNOID']: ''; ?>" readonly/>
                                        <input type="text" class="hidden" id="ITEMQTYINCASE" name="ITEMQTYINCASE" value="<?=isset($data['ITEMQTYINCASE']) ? $data['ITEMQTYINCASE']: ''; ?>" readonly/>
                                        <input type="text" class="hidden" id="ITEMTAXTYP" name="ITEMTAXTYP" value="<?=isset($data['ITEMTAXTYP']) ? $data['ITEMTAXTYP']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="CATEGORY_CODE_TXT"><?=checklang('CATEGORY_CODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                    id="CATALOGCD" name="CATALOGCD" value="<?=isset($data['CATALOGCD']) ? $data['CATALOGCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCATALOG">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="CATALOGNAME" name="CATALOGNAME" value="<?=isset($data['CATALOGNAME']) ? $data['CATALOGNAME']: ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="PERSON_RESPONSE_TXT"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                    id="STAFFCD" name="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="DUE_DATE_CUSTOM_TXT"><?=checklang('DUE_DATE_CUSTOM')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="P1" name="P1" value="<?=!empty($data['P1']) ? date('Y-m-d', strtotime($data['P1'])): ''; ?>"/>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center" id="ARROW_TXT"><?=checklang('ARROW')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="P2"name="P2"  value="<?=!empty($data['P2']) ? date('Y-m-d', strtotime($data['P2'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="SALESCONFIRM_TXT"><?=checklang('SALESCONFIRM')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="SALESCONFIRM" name="SALESCONFIRM" >
                                            <option value=""></option>
                                            <?php foreach ($CONFIRM_TYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['SALESCONFIRM']) && $data['SALESCONFIRM'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center" id="FACTORYCONFIRM_TXT"><?=checklang('FACTORYCONFIRM')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="FACTORYCONFIRM" name="FACTORYCONFIRM" >
                                            <option value=""></option>
                                            <?php foreach ($CONFIRM_TYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['FACTORYCONFIRM']) && $data['FACTORYCONFIRM'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <!-- <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('摘要')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="CATALOGNAME" name="CATALOGNAME" value="<?=isset($data['CATALOGNAME']) ? $data['CATALOGNAME']: ''; ?>"/> -->
                                    </div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="DELIVERY_DATE_TXT"><?=checklang('DELIVERY_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="P3" name="P3" value="<?=!empty($data['P3']) ? date('Y-m-d', strtotime($data['P3'])): ''; ?>"/>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center" id="ARROW_TXT"><?=checklang('ARROW')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="P4"name="P4"  value="<?=!empty($data['P4']) ? date('Y-m-d', strtotime($data['P4'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="STATUS_TXT"><?=checklang('STATUS')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="P5" name="P5">
                                            <option value=""></option>s
                                            <?php foreach ($ORDERSEARCHTYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['P5']) && $data['P5'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="flex w-6/12 justify-end">
                                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div id="table-area" class="overflow-scroll block mx-2 h-[540px]"> 
                    <table id="table" class="w-full sortable n-last border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="hidden"></th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALESORDERTYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STATUS')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DUE_DATE_CUSTOM')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME')?></span>
                                </th>
                                <th class="px-10 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TEL')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUST_STAFF_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELIVERY_ORDER')?></span>
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
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DISTRICT_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DISTRICT_NAME')?></span>
                                </th>
                                <th class="px-10 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TEL')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE_STAFF')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INPUT_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BRANCH_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PERSON_RESPONSE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STAFF_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SPECIFICATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_PRICE')?></span>
                                </th>  
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_ORDER_AMOUNT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MYCURRENCY_PRICE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MYCURRENCY_PRICE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>  
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TEMPORARY_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAX_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAX_RATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAX_AMOUNT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALESCONFIRM')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FACTORYCONFIRM')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELIVERY_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INSPECTION')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STORAGE_TYPE')?></span>
                                </th>  
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SOURCE_STORAGE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LAST_SHIP_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TOTAL_SHIP')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARK')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $item) { ?>
                                <tr class="divide-y divide-gray-200 csv row-id" id="rowId<?=$key?>" style="background-color: <?=$item['SYSROWCOLOR'];?>">
                                    <td class="hidden rowSeq"><?=$key; // $key+1?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALEORDERNO'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELN'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNTYP'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNSTATUS'] ?></td>
                                    <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap"><?=$item['SALELNDUEDT'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALECUSCD'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['CUSTOMERNAME'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALECUSTEL'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALECUSSTAFF'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNNOTE'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALECUSORDERNO'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALEDLVCD'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['DELIVERYNAME'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['DIRECTCD'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['DIRECTNAME'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALEDLVTEL'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALEDLVSTAFF'] ?></td>
                                    <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap"><?=$item['SALEISSUEDT'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALEFACTYP'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALESTAFFCD'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALESTAFFNAME'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNITEMCD'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNITEMNAME'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNITEMSPEC'] ?></td>
                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=$item['SALELNQTY'] ?></td>
                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=$item['SALELNUNITPRC'] ?></td>
                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=$item['SALELNAMT'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['CMCURRENCY'] ?></td>
                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=$item['SALELNEXUNITPRC'] ?></td>
                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=$item['SALELNEXAMT'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['COMCURRENCY'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNTEMPFLG'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNTAXTYP'] ?></td>    
                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=$item['SALELNTAXRATE'] ?></td>
                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=$item['SALELNTAXAMT'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALESTAFFCFMTYP'] ?></td> 
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNCONFIRMFLG'] ?></td> 
                                    <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap"><?=$item['SALELNPLANSHIPDT'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNINSPTYP'] ?></td> 
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNLOCTYP'] ?></td> 
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNLOCCD'] ?></td> 
                                    <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap"><?=$item['SALELNLASTSHIPDT'] ?></td>
                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=$item['SALELNSHIPQTY'] ?></td>
                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=$item['SALELNREM'] ?></td>
                                </tr><?php
                            }
                        }
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200 row-empty" id="rowId<?=$i?>">
                                <td class="hidden rowSeq"><?=$i;?></td>
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
                    <div class="flex w-full">
                        <!-- <label class="text-color text-[12px]"><?=checklang('FILTER');?></label>&emsp; -->
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="record"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex mt-2 mx-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CSV"><?=checklang('CSV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 mx-3"
                                id="DETAIL" onclick="$('#modal-view').modal('show');"><?=checklang('DETAIL'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['no']; ?>');"><?=checklang('END'); ?></button>
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

<!-- start::modal -->
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="item_view" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="text-gray-700 text-base font-semibold"><?=checklang('DETAIL'); ?></label>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-centere"
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <table class="w-full border-collapse border border-slate-500" id="tb-modal" rules="cols" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr>
                            <th class="text-left pl-1 border border-slate-700 text-sm bg-yellow-100"><?=checklang('TITLE'); ?></th>
                            <th class="text-center border border-slate-700 text-sm bg-yellow-100"><?=checklang('VALUE'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALES_ORDER_NO') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SALES_ORDER_NO"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('LINE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="LINE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALESORDERTYPE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SALESORDERTYPE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STATUS') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="STATUS"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DUE_DATE_CUSTOM') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DUE_DATE_CUSTOM"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CUSTOMERCODE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="CUSTOMERCODE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CUSTOMERNAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="CUSTOMERNAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TEL') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="TEL"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CUST_STAFF_NAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="CUST_STAFF_NAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELIVERY_ORDER') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DELIVERY_ORDER"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ORDER_NO_CUSTOMER') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="ORDER_NO_CUSTOMER"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELE_PLACE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DELE_PLACE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELE_PLACE_NAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DELE_PLACE_NAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DISTRICT_CODE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DISTRICT_CODE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DISTRICT_NAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DISTRICT_NAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TEL') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="TEL1"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELE_PLACE_STAFF') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DELE_PLACE_STAFF"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('INPUT_DATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="INPUT_DATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('BRANCH_TYPE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="BRANCH_TYPE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PERSON_RESPONSE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="PERSON_RESPONSE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STAFF_NAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="STAFF_NAME"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMCODE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMCODE1"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMNAME') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="ITEMNAME1"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SPECIFICATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SPECIFICATE"></td>
                    </tr>                 
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALES_ORDER_QTY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SALES_ORDER_QTY"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALES_ORDER_PRICE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SALES_ORDER_PRICE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALES_ORDER_AMOUNT') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SALES_ORDER_AMOUNT"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CURRENCY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="CURRENCY"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('MYCURRENCY_PRICE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="MYCURRENCY_PRICE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('MYCURRENCY_PRICE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="MYCURRENCY_PRICE2"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CURRENCY') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="CURRENCY1"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TEMPORARY_TYPE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="TEMPORARY_TYPE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TAX_TYPE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="TAX_TYPE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TAX_RATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="TAX_RATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TAX_AMOUNT') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="TAX_AMOUNT"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SALESCONFIRM') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SALESCONFIRM2"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('FACTORYCONFIRM') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="FACTORYCONFIRM2"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('DELIVERY_DATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="DELIVERY_DATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('INSPECTION') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="INSPECTION"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STORAGE_TYPE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="STORAGE_TYPE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SOURCE_STORAGE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="SOURCE_STORAGE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('LAST_SHIP_DATE') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="LAST_SHIP_DATE"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TOTAL_SHIP') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="TOTAL_SHIP"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('REMARK') ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="REMARK"></td>
                    </tr>
                </tbody>
                </table>
                <div class="h-6 text-[12px] mt-2"><?=checklang('ROWCOUNT'); ?> 44</div>
            </div>
            <div class="modal-footer">
               <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=checklang('END'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- end::modal -->
</body>
</html>
<script src="./js/script.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('DETAIL').disabled = true;
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        let minrow = '<?php echo (isset($minrow) ? $minrow: 0); ?>';
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 20); ?>';
        // const dataItem = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[540px]');
                tablearea.classList.add('h-[660px]');
                maxrow = 25;
            } else {
                tablearea.classList.remove('h-[660px]');
                tablearea.classList.add('h-[540px]');
                maxrow = 20;
            }
            emptyRows(maxrow);
        })

        if(minrow > 0) {
            $('#table').DataTable({
                // scrollX: true,
                // scrollCollapse: true,
                processing: false,
                searching: true,
                responsive: true,
                fixedHeader: false,
                paging: false,
                ordering: false,
                info: false,
                language: {
                    emptyTable: ' ',
                    infoEmpty: ' ',
                    search: ''
                    // search: '<?=checklang('SEARCH')?>'
                },
            });
        }
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getElement(code, result);    
    }
</script>