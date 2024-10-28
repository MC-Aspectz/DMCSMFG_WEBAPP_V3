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
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <form class="w-full" method="POST" action="" id="itemmasterinquiry" name="itemmasterinquiry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <!-- <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label> -->

            <div class="flex flex-col">
            <!-- Card -->
            <div class="p-1.5 inline-block align-middle">
                <!-- Header -->
                <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                    <details class="p-1.5 w-full align-middle" open><!-- open -->
                        <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>

                        <!-- itemcode -->
                        <div class="flex mb-1 py-1">
                            <div class="flex w-6/12">
                                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMCD')?></label>
                                <div class="relative w-3/12">
                                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            name="ITEMCD1" id="ITEMCD1" value="<?=isset($data['ITEMCD1']) ? $data['ITEMCD1']: ''; ?>"/>
                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                        id="SEARCHITEM1">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>
                                </div>                    
                                <label class="text-center text-color block text-sm w-1/12 pr-2 pt-1">-</label>
                                <div class="relative w-3/12">
                                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            name="ITEMCD2" id="ITEMCD2" value="<?=isset($data['ITEMCD2']) ? $data['ITEMCD2']: ''; ?>"/>
                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                        id="SEARCHITEM2">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="flex w-6/12">
                                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CATEGORY_CODE')?></label>
                                <div class="relative w-3/12 mr-1 ml-1">
                                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            name="CATALOGCD" id="CATALOGCD" value="<?=isset($data['CATALOGCD']) ? $data['CATALOGCD']: ''; ?>"/>
                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                        id="SEARCHCATALOG">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-10 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                name="CATALOGNAME" id="CATALOGNAME" value="<?=isset($data['CATALOGNAME']) ? $data['CATALOGNAME']: ''; ?>"readonly/>
                            </div>
                        </div>

                        <!-- itemname -->
                        <div class="flex mb-1 py-1">
                            <div class="flex w-6/12">
                                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMNAME')?></label>
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 mr-2 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="ITEMNAME" id="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>"/>

                            </div>
                            <div class="flex w-6/12">
                                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIER_CODE')?></label>
                                <div class="relative w-3/12 mr-1 ml-1">
                                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            name="SUPPLIERCD" id="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: ''; ?>"/>
                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                        id="SEARCHSUPPLIER">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                name="SUPPLIERNAME" id="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>"readonly/>
                            </div>
                        </div>
                
                        <!-- search string -->
                        <div class="flex mb-1 py-1">
                            <div class="flex w-6/12">
                                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SEARCH_CHAR')?></label>
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl mr-2 h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="ITEMSEARCH" id="ITEMSEARCH" value="<?=isset($data['ITEMSEARCH']) ? $data['ITEMSEARCH']: ''; ?>"/>

                            </div>
                            <div class="flex w-6/12">
                                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STRAGE_CODE')?></label>
                                <div class="relative w-3/12 mr-1 ml-1">
                                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            name="STORAGECD" id="STORAGECD" value="<?=isset($data['STORAGECD']) ? $data['STORAGECD']: ''; ?>"/>
                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                        id="SEARCHSTORAGE">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>

                                </div>
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                name="STORAGENAME" id="STORAGENAME" value="<?=isset($data['STORAGENAME']) ? $data['STORAGENAME']: ''; ?>"readonly/>
                            </div>
                        </div>

                        <!-- type of item -->
                        <div class="flex mb-1 py-1">
                            <div class="flex w-6/12">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('IM_TYPE')?></label>
                            <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                id="ITEMTYP" name="ITEMTYP">
                                <option value=""></option>
                                <?php foreach ($itemtype as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['ITEMTYP']) && $data['ITEMTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                            </select>   

                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BOI_TYPE')?></label>
                            <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                id="ITEMBOI" name="ITEMBOI">
                                <option value=""></option>
                                <?php foreach ($itemboitype as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['ITEMBOI']) && $data['ITEMBOI'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                            </select>   

                            </div>
                            <div class="flex w-6/12">
                                <div class="flex w-6/12">
                                    <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('MEASURE_UNIT')?></label>
                                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-6/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                    id="ITEMUNIT" name="ITEMUNIT">
                                    <option value=""></option>
                                    <?php foreach ($unit as $key => $item) { ?>
                                        <option value="<?=$key ?>" <?=(isset($data['ITEMUNIT']) && $data['ITEMUNIT'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <div class="flex w-6/12 justify-end ">
                                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mt-2"
                                            id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
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


            <div class="flex flex-col">

                            <!-- Table SALE-->
                            <div class="overflow-scroll mb-1 ">
                                <table id="search_table" class="w-full border-collapse border border-slate-500 divide-gray-200">
                                    <thead class="w-full bg-gray-100">
                                        <tr class="flex w-full divide-x">
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCH_CHAR')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SPECIFICATE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('IM_TYPE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('IM_TYPE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BOI_TYPE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BOI_TYPE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CATEGORY_CODE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CATEGORY_NAME')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WHTAXTYP')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WHTAXTYP')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MEASURE_UNIT')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MEASURE_UNIT')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('POUNIT')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('POUNIT')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRDER_RULE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRDER_RULE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUPPLIER_CODE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUPPLIER_NAME')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STRAGE_CODE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STRAGE_NAME')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LEADTIME')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap">CURRENCYDISP</span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNITPRICE_INV')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_PRICE')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FIXED_ORDER')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MIN_ORDER')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BUFFER_STOCK')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FIFO_LIST')?></span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap">Inventory</span>
                                            </th>
                                            <th class="w-40 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INVCALCTYP')?></span>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[450px]"><?php
                                        if(!empty($data['ITQ']))  { 
                                            $minrow = count($data['ITQ']);
                                            foreach ($data['ITQ'] as $key => $value) { ?>
                                            <tr class="flex w-full p-0 divide-x" id="rowId<?=$key?>">
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMCD']) ? $value['ITEMCD']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMSEARCH']) ? $value['ITEMSEARCH']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMTYP']) ? $value['ITEMTYP']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMTYPENM']) ? $value['ITEMTYPENM']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMBOI']) ? $value['ITEMBOI']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMBOINM']) ? $value['ITEMBOINM']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMCATCD']) ? $value['ITEMCATCD']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMCATNM']) ? $value['ITEMCATNM']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMMAKERTYP']) ? $value['ITEMMAKERTYP']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMMAKERTYPNM']) ? $value['ITEMMAKERTYPNM']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMUNITTYPNM']) ? $value['ITEMUNITTYPNM']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMPOUNITTYP']) ? $value['ITEMPOUNITTYP']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMPOUNITTYPNM']) ? $value['ITEMPOUNITTYPNM']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMORDRULETYP']) ? $value['ITEMORDRULETYP']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMORDRULETYPNM']) ? $value['ITEMORDRULETYPNM']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMSUPCD']) ? $value['ITEMSUPCD']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMSUPNM']) ? $value['ITEMSUPNM']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMSTGCD']) ? $value['ITEMSTGCD']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMSTGNM']) ? $value['ITEMSTGNM']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMLEADTIME']) ? $value['ITEMLEADTIME']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['CURRENCYCD']) ? $value['CURRENCYCD']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['CURRENCYDISP']) ? $value['CURRENCYDISP']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMINVPRICE']) ? $value['ITEMINVPRICE']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMSTDPURPRICE']) ? $value['ITEMSTDPURPRICE']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMSHOPPRICE']) ? $value['ITEMSHOPPRICE']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMFIXORDER']) ? $value['ITEMFIXORDER']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMMINORDER']) ? $value['ITEMMINORDER']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMMINSTOCK']) ? $value['ITEMMINSTOCK']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMFIFOLISTFLG']) ? $value['ITEMFIFOLISTFLG']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMINVCALCTYP']) ? $value['ITEMINVCALCTYP']: '' ?></td>
                                                <td class="h-6 w-40 text-sm border border-slate-700 text-center"><?=isset($value['ITEMINVCALCTYPNM']) ? $value['ITEMINVCALCTYPNM']: '' ?></td>
                                        </tr><?php 
                                        }
                                        for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                                            <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                            </tr><?php 
                                        }
                                    } else {                            
                                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                            <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                                <td class="h-6 w-40 border border-slate-700"></td>
                                            </tr><?php
                                        }
                                    } ?>
                                    </tbody>
                                </table>
                                <div class="flex p-2">
                                    <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                                </div>
                            </div>

                            <div class="flex mt-2">
                                <div class="flex w-6/12 px-1">
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                            id="csv" name="csv" onclick="exportCSV();">CSV</button>
                                </div>
                                <div class="flex w-6/12 px-1 justify-end">
                                    <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                        onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>
                                    <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                    onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=checklang('END'); ?></button>
                                </div>
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
</body><script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-54fxMsmCN6QRpByKh/g3Dxazgtnlz5oCJOM41ha17HW5WLZT6hWG1xPWLE7S0YLb" crossorigin="anonymous"></script> -->
<script type="text/javascript">
    
  function validationDialog() {
      return Swal.fire({ 
          title: '',
          text: '<?=lang('validation1'); ?>',
        //   background: '#8ca3a3',
          showCancelButton: false,
        //   confirmButtonColor: 'silver',
        //   cancelButtonColor: 'silver',
        confirmButtonText:  '<?=lang('yes'); ?>',
          cancelButtonText: '<?=lang('nono'); ?>'
          }).then((result) => {
          if (result.isConfirmed) {
              if(type == 1) {
                  window.location.href="/DMCS_WEBAPP";          
              }
          }
      });
  }

  function HandlePopupResultIndex(code, result, index) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/920/ITEMMASTERINQUIRY/index.php?'+code+'=' + result + '&index=' + index;
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/920/ITEMMASTERINQUIRY/index.php?'+code+'=' + result;
    }
</script>
</html>
