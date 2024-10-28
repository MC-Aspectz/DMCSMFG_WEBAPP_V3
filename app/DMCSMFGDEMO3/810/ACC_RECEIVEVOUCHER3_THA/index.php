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
            <form class="w-full" method="POST" id="acc_receivevoucher" name="acc_receivevoucher" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('RV_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="RVNO" id="RVNO" value="<?=isset($data['RVNO']) ? $data['RVNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHRECMONEYTRAN_ACC">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input class="hidden" type="hidden" name="RVSVNO" id="RVSVNO" value="<?=isset($data['RVSVNO']) ? $data['RVSVNO']: ''; ?>" />
                                        <div class="w-5/12" id="CANCELLBL">
                                            <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?><h5 class="w-full pl-6 pt-1 text-red-500 font-semibold"><?=checklang('CANCELMSG')?></h5><?php } ?>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <label class="w-7/12"></label>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                type="date" id="ISSUEDT" name="ISSUEDT" value="<?=!empty($data['ISSUEDT']) ? date('Y-m-d', strtotime($data['ISSUEDT'])) : date('Y-m-d'); ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCD')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="CUSTOMERCD" id="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>" onchange="unRequired();" required/>
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
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="CUSCURCD" id="CUSCURCD" value="<?=isset($data['CUSCURCD']) ? $data['CUSCURCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHCURRENCY"/>
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input class="hidden" type="hidden" name="CUSCURDISP" id="CUSCURDISP" value="<?=isset($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly/>
                                        <input class="hidden" type="hidden" name="CUSCURAMTTYP" id="CUSCURAMTTYP" value="<?=isset($data['CUSCURAMTTYP']) ? $data['CUSCURAMTTYP']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <select id="BRANCHKBN" name="BRANCHKBN" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($branchkbn as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['BRANCHKBN']) && $data['BRANCHKBN'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="flex w-5/12">
                                            <label class="text-color block text-sm w-4/12 pt-1 text-center"><?=checklang('TAXID')?></label>
                                            <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                    name="TAXID" id="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('RECEIVED_DAY')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                type="date" id="RVDATE" name="RVDATE" value="<?=!empty($data['RVDATE']) ? date('Y-m-d', strtotime($data['RVDATE'])) : date('Y-m-d'); ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="STAFFCD" id="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>"/>
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="DIVISIONCD" id="DIVISIONCD" value="<?=!empty($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>"/>
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
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=lang('paidby')?></label>
                                        <input type="radio" class="shrink-0 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                id="CASH" name="CASH" value="T" <?php if(isset($data['CASH']) && $data['CASH'] == 'T') { ?> checked <?php } ?>>
                                        <label class="text-color block text-sm w-1/12 pt-1 mx-2 text-center"><?=checklang('CASH_AMOUNT'); ?></label>
                                        <input type="radio" class="shrink-0 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                id="CHEQUE" name="CHEQUE" value="T" <?php if(isset($data['CHEQUE']) && $data['CHEQUE'] == 'T') { ?> checked <?php } ?>>
                                        <label class="text-color block text-sm w-1/12 pt-1 mx-2 text-center"><?=checklang('CHEQUE'); ?></label>
                                        <input type="radio" class="shrink-0 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                id="OTHER" name="OTHER" value="T" <?php if(isset($data['OTHER']) && $data['OTHER'] == 'T') { ?> checked <?php } ?>>
                                        <label class="text-color block text-sm w-1/12 pt-1 mx-2 text-center"><?=checklang('OTHER'); ?></label>
                                        <input class="hidden" name="OTHER2" id="OTHER2" value="<?=isset($data['OTHER2']) ? $data['OTHER2']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REMARKS')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                name="REM" id="REM" value="<?=isset($data['REM']) ? $data['REM']: ''; ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-8/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('BANK'); ?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300"
                                                name="BANK" id="BANK" value="<?=isset($data['BANK']) ? $data['BANK']: ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('BRANCH'); ?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300"
                                                name="BRANCH" id="BRANCH" value="<?=isset($data['BRANCH']) ? $data['BRANCH']: ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center">CHEQUE NO.</label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300"
                                                name="CHQNO" id="CHQNO" value="<?=isset($data['CHQNO']) ? $data['CHQNO']: ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('DATE'); ?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="CHQDT" name="CHQDT" value="<?=!empty($data['CHQDT']) ? date('Y-m-d', strtotime($data['CHQDT'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-4/12 justify-end">
                                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                                id="SEARCH" name="SEARCH" onclick="// $('#loading').show();"><?=checklang('SEARCH')?>
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

                <!-- Table SALE-->
                <div class="overflow-scroll mb-1 px-2 block max-h-[218px]">
                    <table id="table_sale" class="sale_table w-full border-collapse border border-slate-500 divide-gray-200">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_INVNO')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DCVOUCHER')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_INVDT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_INVTTLAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_OSTDAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_OSTDVAT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_OSTDWHT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WHTAXTYP')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_OSTDTTLAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_SEL')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_RECEDAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_RECFEE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_RECVAT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_RECWHT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_RECTTLAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECEIVEDV_STATUS')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="saledetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                            if(!empty($data['ITEMSALE']))  { $minrowA = count($data['ITEMSALE']);
                                foreach ($data['ITEMSALE'] as $key => $value) { ?>
                                <tr class="divide-x" id="rowSaleId<?=$key?>">
                                    <input class="hidden" id="RECEIVEDV_INVNO<?=$key?>" name="RECEIVEDV_INVNO[]" value="<?=isset($value['RECEIVEDV_INVNO']) ? $value['RECEIVEDV_INVNO']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_DCVNO<?=$key?>" name="RECEIVEDV_DCVNO[]" value="<?=isset($value['RECEIVEDV_DCVNO']) ? $value['RECEIVEDV_DCVNO']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_INVDT<?=$key?>" name="RECEIVEDV_INVDT[]" value="<?=isset($value['RECEIVEDV_INVDT']) ? $value['RECEIVEDV_INVDT']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_INVTTLAMT<?=$key?>" name="RECEIVEDV_INVTTLAMT[]" value="<?=isset($value['RECEIVEDV_INVTTLAMT']) ? $value['RECEIVEDV_INVTTLAMT']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_OSTDAMT<?=$key?>" name="RECEIVEDV_OSTDAMT[]" value="<?=isset($value['RECEIVEDV_OSTDAMT']) ? $value['RECEIVEDV_OSTDAMT']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_OSTDVAT<?=$key?>" name="RECEIVEDV_OSTDVAT[]" value="<?=isset($value['RECEIVEDV_OSTDVAT']) ? $value['RECEIVEDV_OSTDVAT']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_OSTDWHT<?=$key?>" name="RECEIVEDV_OSTDWHT[]" value="<?=isset($value['RECEIVEDV_OSTDWHT']) ? $value['RECEIVEDV_OSTDWHT']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_OSTDTTLAMT<?=$key?>" name="RECEIVEDV_OSTDTTLAMT[]" value="<?=isset($value['RECEIVEDV_OSTDTTLAMT']) ? $value['RECEIVEDV_OSTDTTLAMT']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_WHTTYP<?=$key?>" name="RECEIVEDV_WHTTYP[]" value="<?=isset($value['RECEIVEDV_WHTTYP']) ? $value['RECEIVEDV_WHTTYP']: '' ?>"/>
                                    <input class="hidden" id="CALCBASE_OSTDAMT<?=$key?>" name="CALCBASE_OSTDAMT[]" value="<?=isset($value['CALCBASE_OSTDAMT']) ? $value['CALCBASE_OSTDAMT']: '' ?>"/>
                                    <input class="hidden" id="CALCBASE_VAT<?=$key?>" name="CALCBASE_VAT[]" value="<?=isset($value['CALCBASE_VAT']) ? $value['CALCBASE_VAT']: '' ?>"/>
                                    <input class="hidden" id="CALCBASE_WHT<?=$key?>" name="CALCBASE_WHT[]" value="<?=isset($value['CALCBASE_WHT']) ? $value['CALCBASE_WHT']: '' ?>"/>
                                    <input class="hidden" id="CALCBASE_OSTDTTLAMT<?=$key?>" name="CALCBASE_OSTDTTLAMT[]" value="<?=isset($value['CALCBASE_OSTDTTLAMT']) ? $value['CALCBASE_OSTDTTLAMT']: '' ?>"/>
                                    <input class="hidden" id="VATRATE<?=$key?>" name="VATRATE[]" value="<?=isset($value['VATRATE']) ? $value['VATRATE']: '' ?>"/>
                                    <input class="hidden" id="WHTRATE<?=$key?>" name="WHTRATE[]" value="<?=isset($value['WHTRATE']) ? $value['WHTRATE']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_RECVAT<?=$key?>" name="RECEIVEDV_RECVAT[]" value="<?=isset($value['RECEIVEDV_RECVAT']) ? $value['RECEIVEDV_RECVAT']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_RECTTLAMT<?=$key?>" name="RECEIVEDV_RECTTLAMT[]" value="<?=isset($value['RECEIVEDV_RECTTLAMT']) ? $value['RECEIVEDV_RECTTLAMT']: '' ?>"/>
                                    <input class="hidden" id="RECEIVEDV_STATUS<?=$key?>" name="RECEIVEDV_STATUS[]" value="<?=isset($value['RECEIVEDV_STATUS']) ? $value['RECEIVEDV_STATUS']: '' ?>"/>

                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-center"><?=isset($value['RECEIVEDV_INVNO']) ? $value['RECEIVEDV_INVNO']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-center"><?=isset($value['RECEIVEDV_DCVNO']) ? $value['RECEIVEDV_DCVNO']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-center"><?=isset($value['RECEIVEDV_INVDT']) ? date_format(date_create_from_format('Y-m-d', str_replace('/', '-', $value['RECEIVEDV_INVDT'])), 'd-m-Y'):'' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right"><?=isset($value['RECEIVEDV_INVTTLAMT']) ? $value['RECEIVEDV_INVTTLAMT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right" id="RECEIVEDV_OSTDAMT_TD<?=$key?>"><?=isset($value['RECEIVEDV_OSTDAMT']) ? $value['RECEIVEDV_OSTDAMT']: '' ?></td>
                                    <td class="h-6 max-w-8 text-sm border border-slate-700 text-right" id="RECEIVEDV_OSTDVAT_TD<?=$key?>"><?=isset($value['RECEIVEDV_OSTDVAT']) ? $value['RECEIVEDV_OSTDVAT']: '' ?></td>
                                    <td class="h-6 max-w-8 text-sm border border-slate-700 text-right" id="RECEIVEDV_OSTDWHT_TD<?=$key?>"><?=isset($value['RECEIVEDV_OSTDWHT']) ? $value['RECEIVEDV_OSTDWHT']: '' ?></td>
                                    <td class="h-6 max-w-8 text-sm border border-slate-700 pl-1 text-left"><?php foreach ($whtatyp as $idx => $wItem) { if($value['RECEIVEDV_WHTTYP'] == $idx) { echo $wItem;  } }?></td>
                                    <td class="h-6 max-w-8 text-sm border border-slate-700 text-right" id="RECEIVEDV_OSTDTTLAMT_TD<?=$key?>"><?=isset($value['RECEIVEDV_OSTDTTLAMT']) ? $value['RECEIVEDV_OSTDTTLAMT']: '' ?></td>
                                    <td class="h-6 max-w-6 text-sm border border-slate-700">
                                        <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="RECEIVEDV_SEL<?=$key?>" name="RECEIVEDV_SEL[]" value="<?=isset($value['RECEIVEDV_SEL']) ? $value['RECEIVEDV_SEL']: '' ?>" maxlength="1" 
                                                oninput="this.value = this.value.replace(/[^.,]/g, '*');"
                                                onchange="setSelReceived(<?=$key?>); $('#loading').show();"
                                                onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ setSelReceived(<?=$key?>); $('#loading').show(); }" /></td>
                                    <td class="h-6 max-w-8 text-sm border border-slate-700">
                                        <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" 
                                                id="RECEIVEDV_RECAMT<?=$key?>" name="RECEIVEDV_RECAMT[]" value="<?=!empty($value['RECEIVEDV_RECAMT']) ? number_format(str_replace(",", "", $value['RECEIVEDV_RECAMT']), 2): '' ?>"
                                                onchange="$('#loading').show(); setCalcReceived(<?=$key?>); this.value = num2digit(this.value);"
                                                onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); setCalcReceived(<?=$key?>); this.value = num2digit(this.value); }"
                                                oninput="this.value = stringReplacez(this.value);"/></td>
                                    <td class="h-6 max-w-8 text-sm border border-slate-700">
                                        <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"
                                            id="RECEIVEDV_RECFEE<?=$key?>" name="RECEIVEDV_RECFEE[]" value="<?=!empty($value['RECEIVEDV_RECFEE']) ? number_format(str_replace(",", "", $value['RECEIVEDV_RECFEE']), 2): '' ?>"
                                            onchange="$('#loading').show(); setCalcReceived(<?=$key?>); this.value = num2digit(this.value);"
                                            onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); setCalcReceived(<?=$key?>); this.value = num2digit(this.value); }"
                                            oninput="this.value = stringReplacez(this.value);"/></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right" id="RECEIVEDV_RECVAT_TD<?=$key?>"><?=isset($value['RECEIVEDV_RECVAT']) ? $value['RECEIVEDV_RECVAT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700">
                                        <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" 
                                            id="RECEIVEDV_RECWHT<?=$key?>" name="RECEIVEDV_RECWHT[]" value="<?=!empty($value['RECEIVEDV_RECWHT']) ? number_format(str_replace(",", "", $value['RECEIVEDV_RECWHT']), 2): '' ?>"
                                            onchange="$('#loading').show(); setCalcReceived(<?=$key?>); this.value = num2digit(this.value);"
                                            onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); setCalcReceived(<?=$key?>); this.value = num2digit(this.value); }"
                                            oninput="this.value = stringReplacez(this.value);"/></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right" id="RECEIVEDV_RECTTLAMT_TD<?=$key?>"><?=isset($value['RECEIVEDV_RECTTLAMT']) ? $value['RECEIVEDV_RECTTLAMT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 pl-1 text-left" id="RECEIVEDV_STATUS_TD<?=$key?>"><?php if(isset($value['RECEIVEDV_STATUS'])) foreach ($receivestatus as $n => $wItem) { if($value['RECEIVEDV_STATUS'] == $n) { echo $wItem;  } }?></td>
                                    <td class="hidden row-sale-id" id="ROWCOUNTER<?=$i?>" name="ROWCOUNTER[]"><?=$key?></td>
                                </tr><?php 
                            }
                        }    

                        for ($i = $minrowA+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-x" id="rowSaleId<?=$i?>">
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
                            </tr><?php
                        } ?>
                        </tbody>
                        <tfoot class="sticky bottom-0">
                            <tr class="bg-white border-b border-slate-300">
                                <td class="h-6 px-2">
                                    <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrowA?></span></label>
                                </td><?php
                                for ($i = 0 ; $i < 16; $i++) { ?><td class="h-6"></td><?php } ?>
                            </tr>
                            <tr class="bg-white">
                                <td class="h-6"></td>
                                <td class="h-6"></td>
                                <td class="h-6"></td>
                                <td class="h-6 text-color block text-sm pt-1 pr-4 text-right"><?=checklang('TOTAL')?></td>
                                <td class="h-6">
                                    <input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                     id="TTLOSTDAMT" name="TTLOSTDAMT" value="<?=isset($data['TTLOSTDAMT']) ? $data['TTLOSTDAMT'] : '' ?>" readonly/></td>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="TTLOUTSTDAMT" name="TTLOUTSTDAMT" value="<?=isset($data['TTLOUTSTDAMT']) ? $data['TTLOUTSTDAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="TTLOSTDWHT" name="TTLOSTDWHT" value="<?=isset($data['TTLOSTDWHT']) ? $data['TTLOSTDWHT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6"><?=str_repeat('&emsp;', 2);?></td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="TTLOSTDTTLAMT" name="TTLOSTDTTLAMT" value="<?=isset($data['TTLOSTDTTLAMT']) ? $data['TTLOSTDTTLAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6"><?=str_repeat('&emsp;', 2);?></td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="TTLRECAMT" name="TTLRECAMT" value="<?=isset($data['TTLRECAMT']) ? $data['TTLRECAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="TTLRECFEE" name="TTLRECFEE" value="<?=isset($data['TTLRECFEE']) ? $data['TTLRECFEE']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="TTLRECVAT" name="TTLRECVAT" value="<?=isset($data['TTLRECVAT']) ? $data['TTLRECVAT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="TTLRECWHT" name="TTLRECWHT" value="<?=isset($data['TTLRECWHT']) ? $data['TTLRECWHT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="TTLRECTTLAMT" name="TTLRECTTLAMT" value="<?=isset($data['TTLRECTTLAMT']) ? $data['TTLRECTTLAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-center read" 
                                        id="COMCURDISP" name="COMCURDISP" value="<?=isset($data['COMCURDISP']) ? $data['COMCURDISP']: ''; ?>" readonly/>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-full pr-2 pt-1"><?=checklang('RECACCOUNTSEGLBL');?></label>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="submit" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="SETACC" name="SETACC" onclick="// $('#loading').show();"><?=checklang('SEATCC')?></button>
                    </div>
                </div>

                <!-- Table ACC-->
                <div class="overflow-scroll mb-1 px-2 block max-h-[218px]">
                    <table id="table_acc" class="acc_table w-full border-collapse border border-slate-500 divide-gray-200">
                        <thead class="sticky top-0 bg-gray-50">
                            <!-- SPACE:R,ACC_CODE:C,ACC_NAME,AMOUNT:R,SPACE:C,EXCHANGERATE:R,DEBIT:R,CREDIT:R,PROJECTNO,WHTAXTYP,REMARKS -->
                            <tr class="border border-gray-600">
                                <th class="px-6 w-1/12 text-center border border-slate-700"><?=str_repeat('&emsp;', 2); ?></th>
                                <th class="px-6 w-1/12 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                                </th>
                                <th class="px-6 w-2/12 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAME')?></span>
                                </th>
                                <th class="px-6 w-1/12 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AMOUNT')?></span>
                                </th>
                                <th class="px-6 w-1/12 text-center border border-slate-700"><?=str_repeat('&emsp;', 1); ?></th>
                                <th class="px-6 w-1/12 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('EXCHANGERATE')?></span>
                                </th>
                                <th class="px-6 w-1/12 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DEBIT')?></span>
                                </th>
                                <th class="px-6 w-1/12 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CREDIT')?></span>
                                </th>
                                <th class="px-6 w-1/12 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PROJECTNO')?></span>
                                </th>
                                <th class="px-6 w-1/12 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WHTAXTYP')?></span>
                                </th>
                                <th class="px-6 w-1/12 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARKS')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="accdetail" class="divide-y divide-gray-200 overflow-y-auto"><?php
                            if(!empty($data['ITEMACC']))  { $minrowB = count($data['ITEMACC']);
                                foreach ($data['ITEMACC'] as $k => $val) { ?>
                                <tr class="divide-x acc" id="rowId<?=$k?>">
                                    <td class="h-6 w-1/12 text-sm text-center row-id" id="ROWNO_TD<?=$k?>"><?=$k; ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="ACCCD_TD<?=$k?>"><?=isset($val['ACCCD']) ? $val['ACCCD']: '' ?></td>
                                    <td class="h-6 w-2/12 text-sm border border-slate-700 pl-1 text-left whitespace-nowrap" id="ACCNM_TD<?=$k?>"><?=isset($val['ACCNM']) ? $val['ACCNM']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="AMT_TD<?=$k?>"><?=isset($val['AMT']) ? $val['AMT']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="INPUTCURDISP_TD<?=$k?>"><?=isset($val['INPUTCURDISP']) ? $val['INPUTCURDISP']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="EXRATE_TD<?=$k?>"><?=isset($val['EXRATE']) ? $val['EXRATE']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMTC1_TD<?=$k?>"><?=isset($val['ACCAMTC1']) ? $val['ACCAMTC1']: ''; ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMTC2_TD<?=$k?>"><?=isset($val['ACCAMTC2']) ? $val['ACCAMTC2']: ''; ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 pl-1 text-left" id="TAXINVOICENO_TD<?=$k?>"><?=isset($val['TAXINVOICENO']) ? $val['TAXINVOICENO']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 pl-1 text-left" id="WHTAXTYP_TD<?=$k?>"><?=isset($val['WHTAXTYP']) && $val['WHTAXTYP'] != '' ? $whtatyp[$val['WHTAXTYP']]: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 pl-1 text-left" id="ACCREM_TD<?=$k?>"><?=isset($val['ACCREM']) ? $val['ACCREM']: '' ?></td>
                                    <td class="hidden" id="DCTYP_TD<?=$k?>"><?=isset($val['DCTYP']) ? $val['DCTYP']: '' ?></td>
                                    <td class="hidden" id="WHTAXTYP_TD<?=$k?>"><?=isset($val['WHTAXTYP']) ? $val['WHTAXTYP']: '' ?></td>
                                    <td class="hidden"><input class="hidden" id="DCTYP<?=$k?>" name="DCTYPA[]" value="<?=isset($val['DCTYP']) ? $val['DCTYP']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="ACCCD<?=$k?>" name="ACCCDA[]" value="<?=isset($val['ACCCD']) ? $val['ACCCD']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="ACCNM<?=$k?>" name="ACCNMA[]" value="<?=isset($val['ACCNM']) ? $val['ACCNM']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="AMT<?=$k?>" name="AMTA[]" value="<?=isset($val['AMT']) ? $val['AMT']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="AMT1<?=$k?>" name="AMT1A[]" value="<?=isset($val['AMT1']) ? $val['AMT1']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="AMT2<?=$k?>" name="AMT2A[]" value="<?=isset($val['AMT2']) ? $val['AMT2']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="INPUTCURDISP<?=$k?>" name="INPUTCURDISPA[]" value="<?=isset($val['INPUTCURDISP']) ? $val['INPUTCURDISP']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="EXRATE<?=$k?>" name="EXRATEA[]" value="<?=isset($val['EXRATE']) ? $val['EXRATE']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="ACCAMTC1<?=$k?>" name="ACCAMTC1A[]" value="<?=isset($val['ACCAMTC1']) ? $val['ACCAMTC1']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="ACCAMTC2<?=$k?>" name="ACCAMTC2A[]" value="<?=isset($val['ACCAMTC2']) ? $val['ACCAMTC2']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="BASEAMTC1<?=$k?>" name="BASEAMTC1A[]" value="<?=isset($val['BASEAMTC1']) ? $val['BASEAMTC1']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="BASEAMTC2<?=$k?>" name="BASEAMTC2A[]" value="<?=isset($val['BASEAMTC2']) ? $val['BASEAMTC2']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="TAXINVOICENO<?=$k?>" name="TAXINVOICENOA[]" value="<?=isset($val['TAXINVOICENO']) ? $val['TAXINVOICENO']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="WHTAXTYP<?=$k?>" name="WHTAXTYPA[]" value="<?=isset($val['WHTAXTYP']) ? $val['WHTAXTYP']: '' ?>"/></td>
                                    <td class="hidden"><input class="hidden" id="ACCREM<?=$k?>" name="ACCREMA[]" value="<?=isset($val['ACCREM']) ? $val['ACCREM']: '' ?>"/></td>
                                </tr><?php 
                            }
                        }           

                        for ($i = $minrowB+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-x" id="rowId<?=$i?>">
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
                            </tr><?php
                        } ?>
                        </tbody>
                        <tfoot class="sticky bottom-0">
                            <tr class="bg-white border-b border-slate-300">
                                <td class="h-6 px-2">
                                    <label class="text-color text-[11px]"><?=checklang('ROWCOUNT');?> <span id="rowcount"><?=$minrowB;?></span></label>
                                </td><?php
                                for ($i = 0 ; $i < 11; $i++) { ?><td class="h-6"></td><?php } ?>
                            </tr>
                            <tr class="bg-white">
                                <td class="h-6 text-center"></td>
                                <td class="h-6 text-center"></td>
                                <td class="h-6 text-center"></td>
                                <td class="h-6">
                                    <input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read"
                                        id="TTL_AMT1" name="TTL_AMT1" value="<?=isset($data['TTL_AMT1']) ? $data['TTL_AMT1'] : '' ?>" readonly/></td>
                                <td class="h-6">
                                    <input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-center read" v
                                        alue="<?=isset($data['COMCURDISP']) ? $data['COMCURDISP'] : '' ?>" readonly/></td>
                                <td class="h-6 text-center"></td>
                                <td class="h-6">
                                    <input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read"
                                            id="TTL_AMTC1" name="TTL_AMTC1" value="<?=isset($data['TTL_AMTC1']) ? $data['TTL_AMTC1'] : '' ?>" readonly/></td>
                                <td class="h-6">
                                    <input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read"
                                            id="TTL_AMTC2" name="TTL_AMTC2" value="<?=isset($data['TTL_AMTC2']) ? $data['TTL_AMTC2'] : '' ?>" readonly/></td>
                                <td class="h-6">
                                    <input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-center read" value="<?=isset($data['COMCURDISP']) ? $data['COMCURDISP'] : '' ?>" readonly/></td>
                                <td class="hidden">
                                    <input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read"
                                    name="COMCURAMTTYP" value="<?=isset($data['COMCURAMTTYP']) ? $data['COMCURAMTTYP'] : '' ?>" readonly/></td>
                                <td class="h-6"></td><td class="h-6"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                            <summary class="text-color mx-auto py-2 text-sm font-semibold"></summary> 
                            <div class="flex mb-1">
                                <div class="flex w-7/12 px-2">
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center mr-2"
                                    id="INSERT" name="INSERT" <?php if(!empty($data['SYSVIS_INSERT']) && $data['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=checklang('INSERT'); ?></button>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                    id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSVIS_DELETE']) && $data['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                    id="DELETE" name="DELETE" <?php if(!empty($data['SYSVIS_UPDATE']) && $data['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                                </div>
                                <div class="flex w-5/12 px-2 justify-end">
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                    id="ENTRY" name="ENTRY"><?=checklang('ENTRY'); ?></button>
                                </div>
                            </div>

                            <div class="flex mb-1">
                                <div class="flex w-12/12 px-2">
                                    <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left text-sm rounded-xl border-gray-300" id="DCTYP" name="DCTYP">
                                        <option value=""></option>
                                        <?php foreach ($dctyp as $dc => $dcitem) { ?>
                                            <option value="<?=$dc?>" <?=isset($data['DCTYP']) && $data['DCTYP'] == $dc ? 'selected' : '' ?>><?=$dcitem ?></option>
                                        <?php } ?>
                                    </select>
                                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('PROJECTNO')?></label>
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                            name="TAXINVOICENO" id="TAXINVOICENO" value="<?=isset($data['TAXINVOICENO']) ? $data['TAXINVOICENO']: ''; ?>"/>
                                    <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('WHTAXTYP')?></label>
                                    <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="WHTAXTYP" name="WHTAXTYP">
                                        <option value=""></option>
                                        <?php foreach ($whtatyp as $wht => $whtitem) { ?>
                                            <option value="<?=$wht?>" <?=(isset($data['WHTAXTYP']) && $data['WHTAXTYP'] == $wht) ? 'selected' : '' ?>><?=$whtitem ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="flex mb-1">
                                <div class="flex w-5/12 px-2">
                                    <div class="w-2/12"></div>
                                    <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('ACC_CODE');?></label>
                                    <div class="w-7/12"></div>
                                </div>
                                <div class="flex w-7/12 px-2">
                                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('AMOUNT');?></label>
                                    <div class="w-2/12"></div>
                                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('EXCHANGERATE');?></label>
                                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('DEBIT');?></label>
                                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('CREDIT');?></label>
                                </div>
                            </div>

                            <div class="flex mb-1">
                                <div class="flex w-5/12 px-2">
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 read"
                                            name="ROWNO" id="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" readonly/>
                                    <div class="relative w-3/1 ml-1 mr-1">
                                        <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                name="ACCCD" id="ACCCD" value="<?=isset($data['ACCCD']) ? $data['ACCCD']: ''; ?>"/>
                                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                            id="SEARCHACCOUNT">
                                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300ml-1 read"
                                            name="ACCNM" id="ACCNM" value="<?=isset($data['ACCNM']) ? $data['ACCNM']: ''; ?>" readonly/>
                                </div>
                                <div class="flex w-7/12 px-2">
                                    <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right ml-1"
                                            id="AMT" name="AMT" value="<?=isset($data['AMT']) ? $data['AMT']: ''; ?>"
                                            onchange="$('#loading').show(); setDCTypV2(1); this.value = num2digit(this.value);"
                                            onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); setDCTypV2(1); this.value = num2digit(this.value); }"
                                            oninput="this.value = stringReplacez(this.value);"/>
                                    <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 ml-1"
                                            id="INPUTCURDISP" name="INPUTCURDISP" onchange="$('#loading').show(); setDCTypV2(2);">
                                            <option value=""></option>
                                            <?php foreach ($currebcytyp as $curr => $curritem) { ?>
                                                <option value="<?=$curr?>" <?=(isset($data['INPUTCURDISP']) && $data['INPUTCURDISP'] == $curr) ? 'selected' : '' ?>><?=$curritem ?></option>
                                            <?php } ?>
                                    </select>
                                    <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 text-right"
                                            id="EXRATE" name="EXRATE" value="<?=!empty($data['EXRATE']) ? $data['EXRATE']: '1.000000'; ?>"
                                            onchange="$('#loading').show(); setDCTypV2(3); this.value = dec6digit(this.value);"
                                            onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); setDCTypV2(3);  this.value = dec6digit(this.value); }"
                                            oninput="this.value = stringReplacez(this.value);"/>
                                    <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 text-right read"
                                            id="ACCAMTC1" name="ACCAMTC1" value="<?=isset($data['ACCAMTC1']) ? $data['ACCAMTC1']: ''; ?>" readonly/>
                                    <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 text-right read"
                                            id="ACCAMTC2" name="ACCAMTC2" value="<?=isset($data['ACCAMTC2']) ? $data['ACCAMTC2']: ''; ?>" readonly/>
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 text-center read"
                                            id="COMCURDISP" name="COMCURDISP" value="<?=isset($data['COMCURDISP']) ? $data['COMCURDISP']: ''; ?>" readonly/>
                                    <input type="hidden" class="hidden" id="COMCURCD" name="COMCURCD" value="<?=isset($data['COMCURCD']) ? $data['COMCURCD'] : '' ?>" readonly/>
                                </div>
                            </div>
                     
                            <div class="flex mb-1">
                                <div class="flex w-8/12 px-2">
                                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DESCRIPTION');?></label>
                                    <input type="text"class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300"
                                            id="ACCREM" name="ACCREM" value="<?=isset($data['ACCREM']) ? $data['ACCREM']: ''; ?>"/>
                                    <input type="hidden" class="hidden" name="DOCTYPE" id="DOCTYPE" value="<?=isset($data['DOCTYPE']) ? $data['DOCTYPE']: ''; ?>"/>
                                </div>
                                 <div class="flex w-4/12 px-2"></div>
                            </div>

                            <div class="flex mb-1" id="reason">
                                <div class="flex w-8/12 px-2">
                                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REPRINT_REASON')?></label>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300"
                                        name="REPRINTREASON" id="REPRINTREASON" value="<?=isset($data['REPRINTREASON'])? $data['REPRINTREASON']: ''; ?>"/>
                                </div>
                                <div class="flex w-4/12 px-2"></div>
                            </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>
                
                <div class="flex mt-2">
                    <div class="flex w-8/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>&emsp;
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-1/12 py-1 text-center me-2 mb-1"
                                id="CANCEL" name="CANCEL" <?php if(empty($data['RVNO']) || $data['SYSVIS_CANCELLBL'] == 'T') {?> disabled <?php }?>
                                <?php if(!empty($data['SYSVIS_CANCEL']) && $data['SYSVIS_CANCEL'] != 'T') {?> hidden <?php }?>><?=checklang('CANCEL'); ?></button>&emsp;
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-1/12 py-1 text-center me-2 mb-1"
                                id="RECEIPT" name="RECEIPT"><?=checklang('RECEIPT'); ?></button>&emsp;
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-1"
                                id="BTNTAXINV" name="BTNTAXINV"><?=checklang('BTNTAXINV'); ?></button>&emsp;
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center me-2 mb-1"
                                id="BTNTAXINVREC" name="BTNTAXINVREC"><?=checklang('BTNTAXINVREC'); ?></button>&emsp;
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center me-2 mb-1"
                                id="RCVVC" name="RCVVC" <?php if(empty($data['RVNO'])) {?> disabled <?php }?>><?=checklang('RCVVC'); ?></button>
                    </div>
                    <div class="flex w-4/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR'); ?></button>&emsp;&emsp;
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
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">   
    $(document).ready(function() {
        unRequired();
        // document.getElementById('reason').style.visibility = 'hidden';
        document.getElementById('reason').style.display = 'none';
        document.getElementById('CANCELLBL').style.visibility = 'hidden';
        document.getElementById('UPDATE').disabled = true; 
        document.getElementById('DELETE').disabled = true; 
        let cash = '<?php echo (isset($data['CASH']) ? $data['CASH']: 'null'); ?>';
        let cheque = '<?php echo (isset($data['CHEQUE']) ? $data['CHEQUE']: 'null'); ?>';
        let other =  '<?php echo (isset($data['OTHER']) ? $data['OTHER']: 'null'); ?>';
        let reprintbl = '<?php echo (isset($data['SYSVIS_REPRINTLBL']) ? $data['SYSVIS_REPRINTLBL']: 'null'); ?>';
        let reason = '<?php echo (isset($data['SYSVIS_REPRINTREASON']) ? $data['SYSVIS_REPRINTREASON']: 'null'); ?>';
        let cancelled = '<?php echo (!empty($data['SYSVIS_CANCELLBL']) ? $data['SYSVIS_CANCELLBL']: 'null'); ?>';
        let cancels = '<?php echo (isset($data['SYSEN_CANCEL']) ? $data['SYSEN_CANCEL']: 'null'); ?>';
        let receipt = '<?php echo (isset($data['SYSEN_RECEIPT']) ? $data['SYSEN_RECEIPT']: 'null'); ?>';
        let taxinv = '<?php echo (isset($data['SYSEN_BTNTAXINV']) ? $data['SYSEN_BTNTAXINV']: 'null'); ?>';
        let taxinvrec = '<?php echo (isset($data['SYSEN_BTNTAXINVREC']) ? $data['SYSEN_BTNTAXINVREC']: 'null'); ?>';
        // let commits = '<?php echo (isset($data['SYSEN_COMMIT']) ? $data['SYSEN_COMMIT']: 'null'); ?>';
        if(cash == 'null' && cheque == 'null' && other == 'null') { $('#CASH').prop("checked", true); }
        if(reason == 'T') { document.getElementById('reason').style.display = 'block'; } //document.getElementById('reason').style.visibility = 'visible';
        if(reprintbl != 'T') { $('#REPRINTREASON').attr('readonly', true).css('background-color', 'whitesmoke'); }
        if(cancelled != 'null' && cancelled == 'T') { 
            $('.search-tag').css('pointer-events', 'none');
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
            $('#RVNO').removeAttr('disabled').css('background-color', 'white');
            $('#SEARCHRECMONEYTRAN_ACC').css('pointer-events', 'auto');
            $('#table_sale td').attr('readonly', true).css('background-color', 'whitesmoke');
            $('#table_acc td').attr('readonly', true).css('background-color', 'whitesmoke');
            document.getElementById('CANCELLBL').style.visibility = 'visible';
            document.getElementById('SEARCH').disabled = true; 
            document.getElementById('SETACC').disabled = true; 
            document.getElementById('ENTRY').disabled = true; 
            document.getElementById('INSERT').disabled = true; 
            document.getElementById('UPDATE').disabled = true; 
            document.getElementById('DELETE').disabled = true;
            document.getElementById('COMMIT').disabled = true; 
            document.getElementById('CANCEL').disabled = true; 
        }
        if(cancels == 'T') { document.getElementById('CANCEL').disabled = false; }
        if(receipt == 'F') { document.getElementById('RECEIPT').disabled = true; }
        if(taxinv == 'F') { document.getElementById('BTNTAXINV').disabled = true; }
        if(taxinvrec == 'F') { document.getElementById('BTNTAXINVREC').disabled = true; }
        // if(commits == 'F') { document.getElementById("COMMIT").disabled = true; }

        saleCalculate();
        accCalculate();

        $('div > input[type=radio]').click(function() {
            var thisParent = $(this).closest('div');
            var prevClicked = thisParent.find(':checked');
            var currentObj = $(this);
            prevClicked.each(function() {
                if (!$(currentObj).is($(this))) {
                    $(this).prop('checked', false);
                }
            });
        });

        // $('table#table_acc tbody tr').click(function () {
        $(document).on('click', '.acc_table tbody tr', function(event) {
            $('#table_acc tbody tr').not(this).removeClass('selected-row');
            let item = $(this).closest('tr').children('td');
            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                let accTb = document.getElementById('table_acc');  let rec = item.eq(0).text();
                if(rec != '') { 
                    accTb.rows[rec].classList.toggle('selected-row');
                }
                // console.log(item.eq(11).text());
                $('#ROWNO').val(item.eq(0).text());
                $('#TAXINVOICENO').val(item.eq(8).text());
                $('#ACCCD').val(item.eq(1).text());
                $('#ACCNM').val(item.eq(2).text());
                $('#AMT').val(item.eq(3).text());
                $('#EXRATE').val(item.eq(5).text());
                $('#ACCAMTC1').val(item.eq(6).text());
                $('#ACCAMTC2').val(item.eq(7).text());  
                $('#ACCREM').val(item.eq(10).text()); 
                document.getElementById('DCTYP').value = item.eq(11).text();
                document.getElementById('WHTAXTYP').value = item.eq(12).text();
                document.getElementById('INPUTCURDISP').value = item.eq(4).text();

                document.getElementById('INSERT').disabled = true; 
                document.getElementById('UPDATE').disabled = false; 
                document.getElementById('DELETE').disabled = false;

                document.getElementById('DCTYP').classList.add('read');
                document.getElementById('WHTAXTYP').classList.add('read');
                document.getElementById('INPUTCURDISP').classList.add('read');
                document.getElementById('TAXINVOICENO').classList.add('read');
                // $('#DCTYP').attr('readonly', true).css('background-color', 'whitesmoke');
                // $('#TAXINVOICENO').attr('readonly', true).css('background-color', 'whitesmoke');
                // $('#WHTAXTYP').attr('style', 'pointer-events: none').css('background-color', 'whitesmoke');
                // $('#INPUTCURDISP').attr('style', 'pointer-events: none').css('background-color', 'whitesmoke');
            }
        });

        $(document).on('click', '.sale_table tr', function(event) {
            let items = $(this).closest('tr').children('td');
            rowId = items.eq(16).text();
            // console.log(rowId);
            let rows = document.getElementsByTagName('tr');
            $('.row-sale-id').each(function (i) {
                rows[i+1].classList.remove('selected-row');
            }); 
            if(rowId != '') {
                rows[rowId].classList.add('selected-row'); 
            }
        });


        var index = 0;
        const maxrow = '<?php echo (isset($maxrow) ? $maxrow: 5); ?>';
        var index = '<?php echo (isset($data['ITEMACC']) ? count($data['ITEMACC']) : 0); ?>';
        // console.log(index);
        INSERT.click(function() {
            index =  $('.row-id').length || 0;
            if($('#ACCCD').val() == '' || $('#DCTYP').val() == '' ) {
                return false;
            }
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr class="divide-x acc" id=rowId'+index+'>');
            var cols = '';
            cols += '<td class="h-6 w-1/12 text-sm text-center row-id" id="ROWNO_TD'+index+'">'+index+'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="ACCCD_TD'+index+'">'+ $('#ACCCD').val() +'</td>';
            cols += '<td class="h-6 w-2/12 text-sm border border-slate-700 pl-1 text-left whitespace-nowrap" id="ACCNM_TD'+index+'">'+ $('#ACCNM').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="AMT_TD'+index+'">'+ $('#AMT').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="INPUTCURDISP_TD'+index+'">'+ document.getElementById('INPUTCURDISP').value +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="EXRATE_TD'+index+'">'+ $('#EXRATE').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMTC1_TD'+index+'">'+ $('#ACCAMTC1').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMTC2_TD'+index+'">'+ $('#ACCAMTC2').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 pl-1 text-left" id="TAXINVOICENO_TD'+index+'">'+ $('#TAXINVOICENO').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 pl-1 text-left" id="WHTAXTYP_TD'+index+'">'+$('#WHTAXTYP option:selected').text()+'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 pl-1 text-left" id="ACCREM_TD'+index+'">'+ $('#ACCREM').val() +'</td>';
            cols += '<td class="hidden" id="DCTYP_TD'+index+'">'+ $('#DCTYP').val() +'</td>';
            cols += '<td class="hidden" id="WHTAXTYP_TD'+index+'">'+ $('#WHTAXTYP').val() +'</td>';

            cols += '<td class="hidden"><input class="hidden" id="DCTYP'+index+'" name="DCTYPA[]" value='+ $('#DCTYP').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="ACCCD'+index+'" name="ACCCDA[]" value='+ $('#ACCCD').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="ACCNM'+index+'" name="ACCNMA[]" value='+ $('#ACCNM').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="AMT'+index+'" name="AMTA[]" value='+ $('#AMT').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="AMT1'+index+'" name="AMT1A[]" value='+ $('#AMT').val().replace(/,/g, '') +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="AMT2'+index+'" name="AMT2A[]" value="0"></td>';
            cols += '<td class="hidden"><input class="hidden" id="INPUTCURDISP'+index+'" name="INPUTCURDISPA[]" value='+ document.getElementById('INPUTCURDISP').value +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="EXRATE'+index+'" name="EXRATEA[]" value='+ $('#EXRATE').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="ACCAMTC1'+index+'" name="ACCAMTC1A[]" value='+ $('#ACCAMTC1').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="ACCAMTC2'+index+'" name="ACCAMTC2A[]" value='+ $('#ACCAMTC2').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="BASEAMTC1'+index+'" name="BASEAMTC1A[]" value='+ $('#ACCAMTC1').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="BASEAMTC2'+index+'" name="BASEAMTC2A[]" value='+ $('#ACCAMTC2').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="TAXINVOICENO'+index+'" name="TAXINVOICENOA[]" value='+ $('#TAXINVOICENO').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="WHTAXTYP'+index+'" name="WHTAXTYPA[]" value='+ $('#WHTAXTYP').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="ACCREM'+index+'" name="ACCREMA[]" value='+ $('#ACCREM').val() +'></td>';

            if(index <= maxrow) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $('#accdetail').append(newRow);
            }
            keepAccItemData();
            calculateAccTotal();
            return emptyAcc();
        });

        DELETE.click(function() {
            let id = $('#ROWNO').val();
            // console.log(id);
            // console.log($('#ACCCD'+id).val());
            if($('#ACCCD'+id).val() == '' || $('#ACCCD'+id).val() == undefined)
                return false;
            document.getElementById('table_acc').deleteRow(id);
            $('#rowId'+id).closest('tr').remove();
            if(id <= maxrow) {
                emptyRow(index);
            }
            index--;
            $('.row-id').each(function (i) {
                $(this).text(i+1);
            }); 
            $('#ROWCOUNT').html(index);
            unsetAccItemData(id); changeRowId();
            id = null;
            // accCalculate();
            emptyAcc(); $('#loading').show();
            return window.location.href = 'index.php';
        });
    });

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        if(code == 'RVNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function saleCalculate() {
        let itemsale = '<?php echo !empty($data['ITEMSALE']) ? json_encode($data['ITEMSALE']): ''; ?>';
        let ttlostdamt = 0; let ttlostdvat = 0; let ttlostdwht = 0; let ttlostdttlamt = 0; let ttlrecamt = 0; let ttlrecfee = 0; let ttlrecvat = 0; let ttlrecwht = 0; let ttlrecttlamt = 0;
        if(itemsale != '') {
            let saleArray = JSON.parse(itemsale);
            // console.log(saleArray);
            $.each(saleArray, function(key, value) {
                // console.log(value);
                ttlostdamt += parseFloat(value.RECEIVEDV_OSTDAMT.replace(/,/g, '')) || 0;
                ttlostdvat += parseFloat(value.RECEIVEDV_OSTDVAT.replace(/,/g, '')) || 0;
                ttlostdwht += parseFloat(value.RECEIVEDV_OSTDWHT.replace(/,/g, '')) || 0;
                ttlostdttlamt += parseFloat(value.RECEIVEDV_OSTDTTLAMT.replace(/,/g, '')) || 0;
                if(value.RECEIVEDV_RECAMT != undefined) {
                    ttlrecamt += parseFloat(value.RECEIVEDV_RECAMT.replace(/,/g, '')) || 0;
                    ttlrecfee += parseFloat(value.RECEIVEDV_RECFEE.replace(/,/g, '')) || 0;
                    ttlrecvat += parseFloat(value.RECEIVEDV_RECVAT.replace(/,/g, '')) || 0;
                    ttlrecwht += parseFloat(value.RECEIVEDV_RECWHT.replace(/,/g, '')) || 0;
                    ttlrecttlamt += parseFloat(value.RECEIVEDV_RECTTLAMT.replace(/,/g, '')) || 0;
                }
            });
            $('#TTLOSTDAMT').val(num2digit(ttlostdamt));
            $('#TTLOSTDVAT').val(num2digit(ttlostdvat));
            $('#TTLOSTDWHT').val(num2digit(ttlostdwht));
            $('#TTLOSTDTTLAMT').val(num2digit(ttlostdttlamt));
            $('#TTLRECAMT').val(num2digit(ttlrecamt));
            $('#TTLRECFEE').val(num2digit(ttlrecfee));
            $('#TTLRECVAT').val(num2digit(ttlrecvat));
            $('#TTLRECWHT').val(num2digit(ttlrecwht));
            $('#TTLRECTTLAMT').val(num2digit(ttlrecttlamt));
            // saledetail.classList.add('h-[164px]'); 
        }        
    }

    function accCalculate() {
        let itemacc = '<?php echo !empty($data['ITEMACC']) ? json_encode($data['ITEMACC']): ''; ?>';
        let ttlamt1 = 0; let ttlamtc1 = 0; let ttlamtc2 = 0;
        if(itemacc != '') {
            let accArray = JSON.parse(itemacc);
            // console.log(accArray);
            $.each(accArray, function(k, val) {
                // console.log(val);
                if(val.DCTYP == 0) {
                    ttlamt1 += parseFloat(val.AMT.replace(/,/g, '')) || 0;                    
                }
                ttlamtc1 += parseFloat(val.ACCAMTC1.replace(/,/g, '')) || 0;
                ttlamtc2 += parseFloat(val.ACCAMTC2.replace(/,/g, '')) || 0;
            });
            $('#TTL_AMT1').val(num2digit(ttlamt1));
            $('#TTL_AMTC1').val(num2digit(ttlamtc1));
            $('#TTL_AMTC2').val(num2digit(ttlamtc2));

            // accdetail.classList.add('h-[168px]');
        }
    }

    function actionDialog(type) {
        if(type == 2) {
            return questionDialog(2, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');        
        } else if(type == 3) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if(type == 4) {
            if($('#RVNO').val() == '') {
                return alertWarning('<?=lang('validation3'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');  
            }
            return alertWarning('<?=lang('validation2'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if(type == 5) {
            return alertWarning('<?=lang('validation3'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');  
        } else {
            if(type == 'ERRO_NOT_EQUAL_DEBIT_AND_CREDIT') {
                return alertWarning( '<?=lang('ERRO_NOT_EQUAL_DEBIT_AND_CREDIT'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
            } else if(type == 'ERRO_EXISTS_ROW_NOT_SETTING_ACCOUNT') {
                return alertWarning( '<?=lang('ERRO_EXISTS_ROW_NOT_SETTING_ACCOUNT'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
            } else {
                return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
            }
        }
    }

    function unRequired() {
        document.getElementById('CUSCURCD').classList[document.getElementById('CUSCURCD').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('CUSTOMERCD').classList[document.getElementById('CUSTOMERCD').value !== '' ? 'remove' : 'add']('req');
    }
</script>
</html>