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
            <form class="w-full" method="POST" id="acc_paymententry" name="acc_receivevoucher" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PM_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="RVNO" id="RVNO" value="<?=isset($data['RVNO']) ? $data['RVNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPAYMENT_ACC">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIERCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="SUPPLIERCD" id="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSUPPLIER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SUPPLIERNAME" id="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <select id="BRANCHKBN" name="BRANCHKBN" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($branchkbn as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['BRANCHKBN']) && $data['BRANCHKBN'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="text" class="text-control text-sm shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 read" 
                                            id="BRANCHNO" name="BRANCHNO" value="<?=isset($data['BRANCHNO']) ? $data['BRANCHNO']: ''; ?>" readonly/>
                                        <label class="text-color block text-[13px] w-1/12 pt-1 text-center"><?=checklang('TAXID')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="TAXID" id="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-3/12 hidden">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="STAFFCD" id="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-[14px] read"
                                                name="STAFFNAME" id="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>

                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('CURRENCY')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 text-[14px] req"
                                                    name="SUPCURCD" id="SUPCURCD" value="<?=isset($data['SUPCURCD']) ? $data['SUPCURCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHCURRENCY"/>
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input class="hidden" type="hidden" name="SUPCURDISP" id="SUPCURDISP" value="<?=isset($data['SUPCURDISP']) ? $data['SUPCURDISP']: ''; ?>" readonly/>
                                        <input class="hidden" type="hidden" name="SUPCURAMTTYP" id="SUPCURAMTTYP" value="<?=isset($data['SUPCURAMTTYP']) ? $data['SUPCURAMTTYP']: ''; ?>" readonly/>      
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVOICE#')?></label>
                                        <div class="relative w-4/12">
                                            <input type="text" class="text-control text-[15px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="INVOICENOFR" id="INVOICENOFR" value="<?=isset($data['INVOICENOFR']) ? $data['INVOICENOFR']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSUPPLIERINVOICE_ACC1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center">→</label>
                                        <div class="relative w-4/12">
                                            <input type="text" class="text-control text-[15px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="INVOICENOTO" id="INVOICENOTO" value="<?=isset($data['INVOICENOTO']) ? $data['INVOICENOTO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSUPPLIERINVOICE_ACC2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PAYMENTDATE')?></label>
                                        <input type="date" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="RVDATE" name="RVDATE" value="<?=!empty($data['RVDATE']) ? date('Y-m-d', strtotime($data['RVDATE'])): date('Y-m-d'); ?>"/>
                                        <div class="flex w-5/12 justify-end">
                                            <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center" id="SEARCH" name="SEARCH" onclick="// $('#loading').show();"><?=checklang('SEARCH')?>
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

                <!-- Table PAYMENT-->
                <div class="overflow-scroll mb-1 px-2 block max-h-[218px]">
                    <table id="table_payment" class="payment_table w-full border-collapse border border-slate-500 divide-gray-200">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PROJECTNO')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_PVNO')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_PVDT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_PVAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_OSTDAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_VAT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_WHT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WHTAXTYP')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_OSTDTTLAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_SEL')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_PAYAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_PAYVATAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_PAYWHTAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_PAYTTLAMT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAYMENTDV_STATUS')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="paymentdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                            if(!empty($data['ITEMPAYMENT']))  { $minrowA = count($data['ITEMPAYMENT']);
                                foreach ($data['ITEMPAYMENT'] as $key => $value) { ?>
                                <tr class="divide-x" id="rowPurId<?=$key?>">
                                    <input class="hidden" id="INVOICENO<?=$key?>" name="INVOICENO[]" value="<?=isset($value['INVOICENO']) ? $value['INVOICENO']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_PVNO<?=$key?>" name="PAYMENTDV_PVNO[]" value="<?=isset($value['PAYMENTDV_PVNO']) ? $value['PAYMENTDV_PVNO']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_PVDT<?=$key?>" name="PAYMENTDV_PVDT[]" value="<?=isset($value['PAYMENTDV_PVDT']) ? $value['PAYMENTDV_PVDT']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_PVAMT<?=$key?>" name="PAYMENTDV_PVAMT[]" value="<?=isset($value['PAYMENTDV_PVAMT']) ? $value['PAYMENTDV_PVAMT']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_OSTDAMT<?=$key?>" name="PAYMENTDV_OSTDAMT[]" value="<?=isset($value['PAYMENTDV_OSTDAMT']) ? $value['PAYMENTDV_OSTDAMT']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_VAT<?=$key?>" name="PAYMENTDV_VAT[]" value="<?=isset($value['PAYMENTDV_VAT']) ? $value['PAYMENTDV_VAT']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_WHT<?=$key?>" name="PAYMENTDV_WHT[]" value="<?=isset($value['PAYMENTDV_WHT']) ? $value['PAYMENTDV_WHT']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_OSTDTTLAMT<?=$key?>" name="PAYMENTDV_OSTDTTLAMT[]" value="<?=isset($value['PAYMENTDV_OSTDTTLAMT']) ? $value['PAYMENTDV_OSTDTTLAMT']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_WHTTYP<?=$key?>" name="PAYMENTDV_WHTTYP[]" value="<?=isset($value['PAYMENTDV_WHTTYP']) ? $value['PAYMENTDV_WHTTYP']: '' ?>"/>
                                    <input class="hidden" id="CALCBASE_OSTDAMT<?=$key?>" name="CALCBASE_OSTDAMT[]" value="<?=isset($value['CALCBASE_OSTDAMT']) ? $value['CALCBASE_OSTDAMT']: '' ?>"/>
                                    <input class="hidden" id="CALCBASE_VAT<?=$key?>" name="CALCBASE_VAT[]" value="<?=isset($value['CALCBASE_VAT']) ? $value['CALCBASE_VAT']: '' ?>"/>
                                    <input class="hidden" id="CALCBASE_WHT<?=$key?>" name="CALCBASE_WHT[]" value="<?=isset($value['CALCBASE_WHT']) ? $value['CALCBASE_WHT']: '' ?>"/>
                                    <input class="hidden" id="CALCBASE_OSTDTTLAMT<?=$key?>" name="CALCBASE_OSTDTTLAMT[]" value="<?=isset($value['CALCBASE_OSTDTTLAMT']) ? $value['CALCBASE_OSTDTTLAMT']: '' ?>"/>
                                    <input class="hidden" id="VATRATE<?=$key?>" name="VATRATE[]" value="<?=isset($value['VATRATE']) ? $value['VATRATE']: '' ?>"/>
                                    <input class="hidden" id="WHTRATE<?=$key?>" name="WHTRATE[]" value="<?=isset($value['WHTRATE']) ? $value['WHTRATE']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_PAYVATAMT<?=$key?>" name="PAYMENTDV_PAYVATAMT[]" value="<?=isset($value['PAYMENTDV_PAYVATAMT']) ? $value['PAYMENTDV_PAYVATAMT']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_PAYTTLAMT<?=$key?>" name="PAYMENTDV_PAYTTLAMT[]" value="<?=isset($value['PAYMENTDV_PAYTTLAMT']) ? $value['PAYMENTDV_PAYTTLAMT']: '' ?>"/>
                                    <input class="hidden" id="PAYMENTDV_STATUS<?=$key?>" name="PAYMENTDV_STATUS[]" value="<?=isset($value['PAYMENTDV_STATUS']) ? $value['PAYMENTDV_STATUS']: '' ?>"/>

                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-center"><?=isset($value['INVOICENO']) ? $value['INVOICENO']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-center"><?=isset($value['PAYMENTDV_PVNO']) ? $value['PAYMENTDV_PVNO']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-center"><?=isset($value['PAYMENTDV_PVDT']) ? date_format(date_create_from_format('Y-m-d', str_replace('/', '-', $value['PAYMENTDV_PVDT'])), 'd-m-Y'):'' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right"><?=isset($value['PAYMENTDV_PVAMT']) ? $value['PAYMENTDV_PVAMT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right" id="PAYMENTDV_OSTDAMT_TD<?=$key?>"><?=isset($value['PAYMENTDV_OSTDAMT']) ? $value['PAYMENTDV_OSTDAMT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right" id="PAYMENTDV_VAT_TD<?=$key?>"><?=isset($value['PAYMENTDV_VAT']) ? $value['PAYMENTDV_VAT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right" id="PAYMENTDV_WHT_TD<?=$key?>"><?=isset($value['PAYMENTDV_WHT']) ? $value['PAYMENTDV_WHT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-left"><?php foreach ($whtatyp as $idx => $wItem) { if($value['PAYMENTDV_WHTTYP'] == $idx) { echo $wItem;  } }?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right" id="PAYMENTDV_OSTDTTLAMT_TD<?=$key?>"><?=isset($value['PAYMENTDV_OSTDTTLAMT']) ? $value['PAYMENTDV_OSTDTTLAMT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700">
                                        <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="PAYMENTDV_SEL<?=$key?>" name="PAYMENTDV_SEL[]" 
                                                value="<?=isset($value['PAYMENTDV_SEL']) ? $value['PAYMENTDV_SEL']: '' ?>" maxlength="1" oninput="this.value = this.value.replace(/[^.,]/g, '*');"
                                                onchange="setSelPaid(<?=$key?>); $('#loading').show();"
                                                onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ setSelPaid(<?=$key?>); $('#loading').show(); }" /></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700">
                                        <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                id="PAYMENTDV_PAYAMT<?=$key?>" name="PAYMENTDV_PAYAMT[]" 
                                                value="<?=!empty($value['PAYMENTDV_PAYAMT']) ? number_format(str_replace(",", "", $value['PAYMENTDV_PAYAMT']), 2): '' ?>"
                                                onchange="$('#loading').show(); setCalcPaid(<?=$key?>); this.value = num2digit(this.value);"
                                                onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); setCalcPaid(<?=$key?>); this.value = num2digit(this.value); }"
                                                oninput="this.value = stringReplacez(this.value)"/></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right" id="PAYMENTDV_PAYVATAMT_TD<?=$key?>"><?=isset($value['PAYMENTDV_PAYVATAMT']) ? $value['PAYMENTDV_PAYVATAMT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700">
                                        <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                id="PAYMENTDV_PAYWHTAMT<?=$key?>" name="PAYMENTDV_PAYWHTAMT[]" 
                                                value="<?=!empty($value['PAYMENTDV_PAYWHTAMT']) ? number_format(str_replace(",", "", $value['PAYMENTDV_PAYWHTAMT']), 2): '' ?>"
                                                onchange="$('#loading').show(); setCalcPaid(<?=$key?>); this.value = num2digit(this.value);"
                                                onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); setCalcPaid(<?=$key?>); this.value = num2digit(this.value); }"
                                                oninput="this.value = stringReplacez(this.value)"/></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-right" id="PAYMENTDV_PAYTTLAMT_TD<?=$key?>"><?=isset($value['PAYMENTDV_PAYTTLAMT']) ? $value['PAYMENTDV_PAYTTLAMT']: '' ?></td>
                                    <td class="h-6 max-w-10 text-sm border border-slate-700 text-left" id="PAYMENTDV_STATUS_TD<?=$key?>"><?php if(isset($value['PAYMENTDV_STATUS'])) foreach ($paymentstatus as $n => $wItem) { if($value['PAYMENTDV_STATUS'] == $n) { echo $wItem;  } }?></td>
                                    <td class="hidden row-pur-id" id="ROWCOUNTER<?=$i?>" name="ROWCOUNTER[]"><?=$key?></td>
                                </tr><?php 
                            }
                            for ($i = $minrowA+1; $i <= $maxrow; $i++) {  ?>
                                <tr class="divide-x" id="rowPurId<?=$i?>">
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
                            }
                        } else {                            
                            for ($i = $minrowA+1; $i <= $maxrow; $i++) { ?>
                                <tr class="divide-x" id="rowPurId<?=$i?>">
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
                            }
                        } ?>
                        </tbody>
                        <tfoot class="sticky bottom-0">
                            <tr class="bg-white border-b border-slate-300">
                                <td class="h-6 px-2">
                                    <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrowA?></span></label>
                                </td><?php
                                for ($i = 0 ; $i < 15; $i++) { ?><td class="h-6"></td><?php } ?>
                            </tr>
                            <tr class="bg-white">
                                <td class="h-6"></td>
                                <td class="h-6"></td>
                                <td class="h-6"></td>
                                <td class="h-6">
                                    <input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                     id="PT_PVAMT" name="PT_PVAMT" value="<?=isset($data['PT_PVAMT']) ? $data['PT_PVAMT'] : '' ?>" readonly/></td>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="PT_OSTDAMT" name="PT_OSTDAMT" value="<?=isset($data['PT_OSTDAMT']) ? $data['PT_OSTDAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="PT_VATAMT" name="PT_VATAMT" value="<?=isset($data['PT_VATAMT']) ? $data['PT_VATAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="PT_WHTAMT" name="PT_WHTAMT" value="<?=isset($data['PT_WHTAMT']) ? $data['PT_WHTAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6"><?=str_repeat('&emsp;', 2);?></td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="PT_OSTDTTLAMT" name="PT_OSTDTTLAMT" value="<?=isset($data['PT_OSTDTTLAMT']) ? $data['PT_OSTDTTLAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6"><?=str_repeat('&emsp;', 2);?></td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="PT_PAYAMT" name="PT_PAYAMT" value="<?=isset($data['PT_PAYAMT']) ? $data['PT_PAYAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="PT_PAYVATAMT" name="PT_PAYVATAMT" value="<?=isset($data['PT_PAYVATAMT']) ? $data['PT_PAYVATAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="PT_PAYWHTAMT" name="PT_PAYWHTAMT" value="<?=isset($data['PT_PAYWHTAMT']) ? $data['PT_PAYWHTAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                        id="PT_PAYTTLAMT" name="PT_PAYTTLAMT" value="<?=isset($data['PT_PAYTTLAMT']) ? $data['PT_PAYTTLAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6">
                                    <input type="text" class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-center read" 
                                        id="SUPCURDISP" name="SUPCURDISP" value="<?=isset($data['SUPCURDISP']) ? $data['SUPCURDISP']: ''; ?>" readonly/>
                                </td>
                                <td class="hidden"><input class="hidden" id="T_PAY" name="T_PAY" value="<?=isset($data['T_PAY']) ? $data['T_PAY'] : '' ?>" readonly/></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-full pr-2 pt-1"><?=checklang('PAYACCOUNTSEGLBL');?></label>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="submit" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="SETACC" name="SETACC" onclick="// $('#loading').show();"><?=checklang('SETACC')?></button>
                    </div>
                </div>

                <!-- Table ACC-->
                <div class="overflow-scroll mb-1 px-2 block max-h-[218px]">
                    <table id="table_acc" class="acc_table w-full border-collapse border border-slate-500 divide-gray-200">
                        <thead class="sticky top-0 bg-gray-50">
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
                                <tr class="divide-x acc" id="rowId<?=$key?>">
                                    <td class="h-6 text-sm text-center row-id" id="ROWNO_TD<?=$k?>"><?=$k; ?></td>
                                    <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="ACCCD_TD<?=$k?>"><?=isset($val['ACCCD']) ? $val['ACCCD']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ACCNM_TD<?=$k?>"><?=isset($val['ACCNM']) ? $val['ACCNM']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap" id="AMT_TD<?=$k?>"><?=isset($val['AMT']) ? $val['AMT']: '' ?></td>
                                    <td class="h-6 text-sm border border-slate-700 text-center" id="INPUTCURDISP_TD<?=$k?>"><?=isset($val['INPUTCURDISP']) ? $val['INPUTCURDISP']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap" id="EXRATE_TD<?=$k?>"><?=isset($val['EXRATE']) ? $val['EXRATE']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap" id="ACCAMTC1_TD<?=$k?>"><?=isset($val['ACCAMTC1']) ? $val['ACCAMTC1']: ''; ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap" id="ACCAMTC2_TD<?=$k?>"><?=isset($val['ACCAMTC2']) ? $val['ACCAMTC2']: ''; ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="TAXINVOICENO_TD<?=$k?>"><?=isset($val['TAXINVOICENO']) ? $val['TAXINVOICENO']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="WHTAXTYP_TD<?=$k?>"><?=isset($val['WHTAXTYP']) && $val['WHTAXTYP'] != '' ? $whtatyp[$val['WHTAXTYP']]: ''?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="ACCREM_TD<?=$k?>"><?=isset($val['ACCREM']) ? $val['ACCREM']: '' ?></td>
                                    <td class="hidden" id="DCTYP_TD<?=$k?>"><?=isset($val['DCTYP']) ? $val['DCTYP']: '' ?></td>
                                    <td class="hidden" id="WHTAXTYP_TD<?=$k?>"><?=isset($val['WHTAXTYP']) ? $val['WHTAXTYP']: '' ?></td>
                                    <td class="hidden" id="CHECKNO_TD<?=$k?>"><?=isset($val['CHECKNO']) ? $val['CHECKNO']: '' ?></td>
                                    <td class="hidden" id="CHECKDT_TD<?=$k?>"><?=isset($val['CHECKDT']) ? $val['CHECKDT']: '' ?></td>

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
                                    <td class="hidden"><input class="hidden" id="CHECKDT<?=$k?>" name="CHECKDTA[]" value="<?=isset($val['CHECKDT']) ? $val['CHECKDT']: '' ?>"/>></td>
                                    <td class="hidden"><input class="hidden" id="CHECKNO<?=$k?>" name="CHECKNOA[]" value="<?=isset($val['CHECKNO']) ? $val['CHECKNO']: '' ?>"/>></td>
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
                                <td class="h-6"><input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" id="TTL_AMT1" name="TTL_AMT1" value="<?=isset($data['TTL_AMT1']) ? $data['TTL_AMT1'] : '' ?>" readonly/></td>
                                <td class="h-6"><input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-center read" value="<?=isset($data['SUPCURDISP']) ? $data['SUPCURDISP'] : '' ?>" readonly/></td>
                               <td class="h-6 text-center">
                                  
                                </td>
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
                                        id="INSERT" name="INSERT" <?php if(!empty($data['SYSVIS_INS']) && $data['SYSVIS_INS'] != 'T') {?> hidden <?php }?>><?=checklang('INSERT'); ?></button>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSVIS_UPD']) && $data['SYSVIS_UPD'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSVIS_DEL']) && $data['SYSVIS_DEL'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                                </div>
                                <div class="flex w-5/12 px-2 justify-end">
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                        id="ENTRY" name="ENTRY"><?=checklang('ENTRY'); ?></button>
                                </div>
                            </div>

                            <div class="flex mb-1">
                                <div class="flex w-12/12 px-2">
                                    <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 req" id="DCTYP" name="DCTYP" onchange="unRequired();">
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

                            <div class="flex">
                                <div class="flex w-5/12 px-2">
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 read"
                                            name="ROWNO" id="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" readonly/>
                                    <div class="relative w-3/12 ml-1 mr-1">
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
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right ml-1"
                                            id="AMT" name="AMT" value="<?=isset($data['AMT']) ? $data['AMT']: ''; ?>"
                                            onchange="$('#loading').show(); setDCTypV2(1); this.value = num2digit(this.value);"
                                            onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); setDCTypV2(1); this.value = num2digit(this.value); }"
                                            oninput="this.value = stringReplacez(this.value)"/>
                                    <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 ml-1"
                                            id="INPUTCURDISP" name="INPUTCURDISP" onchange="$('#loading').show(); setDCTypV2(2);">
                                            <option value=""></option>
                                            <?php foreach ($currebcytyp as $curr => $curritem) { ?>
                                                <option value="<?=$curr?>" <?=(isset($data['INPUTCURDISP']) && $data['INPUTCURDISP'] == $curr) ? 'selected' : '' ?>><?=$curritem ?></option>
                                            <?php } ?>
                                    </select>
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 text-right"
                                            id="EXRATE" name="EXRATE" value="<?=!empty($data['EXRATE']) ? $data['EXRATE']: '1.000000'; ?>"
                                            onchange="$('#loading').show(); setDCTypV2(3); this.value = dec6digit(this.value);"
                                            onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ $('#loading').show(); setDCTypV2(3);  this.value = dec6digit(this.value); }"
                                            oninput="this.value = stringReplacez(this.value)"/>
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 text-right"
                                            id="ACCAMTC1" name="ACCAMTC1" value="<?=isset($data['ACCAMTC1']) ? $data['ACCAMTC1']: ''; ?>" readonly/>
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 text-right"
                                            id="ACCAMTC2" name="ACCAMTC2" value="<?=isset($data['ACCAMTC2']) ? $data['ACCAMTC2']: '0.00'; ?>" readonly/>
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 ml-1 text-center"
                                            id="COMCURDISP" name="COMCURDISP" value="<?=isset($data['COMCURDISP']) ? $data['COMCURDISP']: ''; ?>" readonly/>
                                    <input class="hidden" type="hidden" id="BASEAMTC1" name="BASEAMTC1" value="<?=isset($data['BASEAMTC1']) ? $data['BASEAMTC1']: ''; ?>" readonly/>&ensp;
                                    <input class="hidden" type="hidden" id="BASEAMTC2" name="BASEAMTC2" value="<?=isset($data['BASEAMTC2']) ? $data['BASEAMTC2']: ''; ?>" readonly/>&ensp;
                                    <input type="hidden" class="hidden" id="COMCURCD" name="COMCURCD" value="<?=isset($data['COMCURCD']) ? $data['COMCURCD'] : '' ?>" readonly/>
                                </div>
                            </div>

                            <div class="flex mb-1 px-2">
                                <label class="text-color block text-sm w-3/12 pt-1"><?=checklang('CHECK_NO');?></label>
                                <label class="text-color block text-sm w-2/12 pt-1"><?=checklang('PAYMENTDATE');?></label>
                                <label class="text-color block text-sm w-4/12 pt-1"><?=checklang('REMARKS');?></label>
                                <button class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" 
                                        type="button" id="VATADD" onclick="AmtC2('1'); $('#loading').show();">+</button>&nbsp;
                                <button class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" 
                                        type="button" id="VATDIV" onclick="AmtC2('2'); $('#loading').show();">-</button>
                                <div class="w-1/12"></div>
                            </div>

                            <div class="flex mb-1 px-2">
                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 mr-2"
                                        id="CHECKNO" name="CHECKNO" value="<?=isset($data['CHECKNO']) ? $data['CHECKNO']: ''; ?>" />
                                <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 mr-2 text-center" 
                                        id="CHECKDT" name="CHECKDT" value="<?=!empty($data['CHECKDT']) ? date('Y-m-d', strtotime($data['CHECKDT'])): ''; ?>"/>
                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 ml-1"
                                        name="ACCREM" id="ACCREM" value="<?=isset($data['ACCREM']) ? $data['ACCREM']: ''; ?>"/>
                                <div class="w-3/12"></div>
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
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-1"
                                id="CANCEL" name="CANCEL" <?php if(empty($data['RVNO']) || (empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T')) {?> disabled <?php }?>
                                <?php if(!empty($data['SYSVIS_CANCEL']) && $data['SYSVIS_CANCEL'] != 'T') {?> hidden <?php }?>><?=checklang('CANCEL'); ?></button>&emsp;
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center me-2 mb-1"
                                id="PMVC" name="PMVC" <?php if(empty($data['RVNO'])) {?> disabled <?php }?>><?=checklang('PMVC'); ?></button>
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
        document.getElementById('CANCELLBL').style.visibility = 'hidden';
        document.getElementById('UPDATE').disabled = true; 
        document.getElementById('DELETE').disabled = true; 
        let cancelled = '<?php echo (!empty($data['SYSVIS_CANCELLBL']) ? $data['SYSVIS_CANCELLBL']: 'null'); ?>';
        let cancels = '<?php echo (isset($data['SYSEN_CANCEL']) ? $data['SYSEN_CANCEL']: 'null'); ?>';
        // let commits = '<?php echo (isset($data['SYSEN_COMMIT']) ? $data['SYSEN_COMMIT']: 'null'); ?>';
        if(cancelled != 'null' && cancelled == 'T') { 
            $('.search-tag').css('pointer-events', 'none');
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
            $('#RVNO').removeAttr('disabled').css('background-color', 'white');
            $('#table_payment td').attr('readonly', true).css('background-color', 'whitesmoke');
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
            document.getElementById('PMVC').disabled = true; 
        }
        if(cancels == 'T') { document.getElementById('CANCEL').disabled = false; }
        // if(commits == 'F') { document.getElementById('COMMIT').disabled = true; }

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

        // $('table#table_acc tr').click(function () {
        $(document).on('click', '.acc_table tbody tr', function(event) {
            $('table#table_acc tr').not(this).removeClass('selected-row');

            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                let accTb = document.getElementById('table_acc');  let rec = item.eq(0).text();
                if(rec != '') { 
                    accTb.rows[rec].classList.toggle('selected-row');
                }
                // console.log(item.eq(14).text());
                let date = item.eq(14).text();
                let checkdt = item.eq(14).text();
                if(!Date.parse(date) && date != '') {
                    checkdt = date.substring(0, 4) + '-' + date.substring(4, 6) + '-' + date.substring(6, 8);
                }
                $('#ROWNO').val(item.eq(0).text());
                $('#TAXINVOICENO').val(item.eq(8).text());
                $('#ACCCD').val(item.eq(1).text());
                $('#ACCNM').val(item.eq(2).text());
                $('#AMT').val(item.eq(3).text());
                $('#EXRATE').val(item.eq(5).text());
                $('#ACCAMTC1').val(item.eq(6).text());
                $('#ACCAMTC2').val(item.eq(7).text());  
                $('#BASEAMTC1').val(item.eq(6).text());
                $('#BASEAMTC2').val(item.eq(7).text());  
                $('#ACCREM').val(item.eq(10).text()); 
                $('#CHECKNO').val(item.eq(13).text());  
                $('#CHECKDT').val(checkdt); 
           
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

                // $('#TAXINVOICENO').attr('readonly', true).css('background-color', 'whitesmoke');
                // $('#DCTYP').attr('style', 'pointer-events: none').css('background-color', 'whitesmoke');
                // $('#WHTAXTYP').attr('style', 'pointer-events: none').css('background-color', 'whitesmoke');
                // $('#INPUTCURDISP').attr('style', 'pointer-events: none').css('background-color', 'whitesmoke');
            }
        });

        $(document).on('click', '.payment_table tr', function(event) {
            let items = $(this).closest('tr').children('td');
            rowId = items.eq(15).text();
            // console.log(rowId);
            let rows = document.getElementsByTagName('tr');
            $('.row-pur-id').each(function (i) {
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
            if($('#ACCCD').val() == '' || $('#DCTYP').val() == '' ) {
                return false;
            }
            index =  $('.row-id').length || 0;
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr class="tr_border acc" id=rowId'+index+'>');
            var cols = '';
            cols += '<td class="h-6 text-sm text-center row-id" id="ROWNO_TD'+index+'">'+index+'</td>';
            cols += '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="ACCCD_TD'+index+'">'+ $('#ACCCD').val() +'</td>';
            cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ACCNM_TD'+index+'">'+ $('#ACCNM').val() +'</td>';
            cols += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap" id="AMT_TD'+index+'">'+ $('#AMT').val() +'</td>';
            cols += '<td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="INPUTCURDISP_TD'+index+'">'+ document.getElementById('INPUTCURDISP').value +'</td>';
            cols += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap" id="EXRATE_TD'+index+'">'+ $('#EXRATE').val() +'</td>';
            cols += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap" id="ACCAMTC1_TD'+index+'">'+ $('#ACCAMTC1').val() +'</td>';
            cols += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap" id="ACCAMTC2_TD'+index+'">'+ $('#ACCAMTC2').val() +'</td>';
            cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="TAXINVOICENO_TD'+index+'">'+ $('#TAXINVOICENO').val() +'</td>';
            cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="WHTAXTYP_TD'+index+'">'+$("#WHTAXTYP option:selected").text()+'</td>';
            cols += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ACCREM_TD'+index+'">'+ $('#ACCREM').val() +'</td>';
            cols += '<td class="hidden text-center" id="DCTYP_TD'+index+'">'+ $('#DCTYP').val() +'</td>';
            cols += '<td class="hidden text-center" id="WHTAXTYP_TD'+index+'">'+ $('#WHTAXTYP').val() +'</td>';

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
            cols += '<td class="hidden"><input class="hidden" id="CHECKDT'+index+'" name="CHECKDTA[]" value='+ $('#CHECKDT').val() +'></td>';
            cols += '<td class="hidden"><input class="hidden" id="CHECKNO'+index+'" name="CHECKNOA[]" value='+ $('#CHECKNO').val() +'></td>';

            if(index <= maxrow) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols + '</tr>');
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
            index--;
            }
            $('.row-id').each(function (i) {
                $(this).text(i+1);
            }); 
            $('#ROWCOUNT').html(index);
            changeRowId();
            unsetAccItemData(id); 
            id = null;
            // accCalculate();
            emptyAcc(); $('#loading').show();
            return window.location.href = 'index.php';
        });
    });


    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'RVNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function HandlePopupResultIndex(code, result, index) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(index == 1) {
            document.getElementById('INVOICENOFR').value = result;
        } else {
            document.getElementById('INVOICENOTO').value = result;
        }
    }

    function saleCalculate() {
        let itempayment = '<?php echo !empty($data['ITEMPAYMENT']) ? json_encode($data['ITEMPAYMENT']): ''; ?>';
        let pt_pvamt = 0; let pb_ostdamt = 0; let pt_vatamt = 0; let pt_whtamt = 0; let pv_ostdttlamt = 0; let pt_payamt = 0; let t_pay = 0; let pt_payvatamt = 0; let pt_paywhtamt = 0; let pt_payttlamt = 0;
        if(itempayment != '') {
            let paymentArray = JSON.parse(itempayment);
            // console.log(paymentArray);
            $.each(paymentArray, function(key, value) {
                // console.log(value);
                pt_pvamt += parseFloat(value.PAYMENTDV_PVAMT.replace(/,/g, '')) || 0;
                pb_ostdamt += parseFloat(value.PAYMENTDV_OSTDAMT.replace(/,/g, '')) || 0;
                pt_vatamt += parseFloat(value.PAYMENTDV_VAT.replace(/,/g, '')) || 0;
                pt_whtamt += parseFloat(value.PAYMENTDV_WHT.replace(/,/g, '')) || 0;
                pv_ostdttlamt += parseFloat(value.PAYMENTDV_OSTDTTLAMT.replace(/,/g, '')) || 0;
                if(value.PAYMENTDV_PAYAMT != undefined) {
                    pt_payamt += parseFloat(value.PAYMENTDV_PAYAMT.replace(/,/g, '')) || 0;
                    t_pay += parseFloat(value.PAYMENTDV_PAYTTLAMT.replace(/,/g, '')) || 0;
                    pt_payvatamt += parseFloat(value.PAYMENTDV_PAYVATAMT.replace(/,/g, '')) || 0;
                    pt_paywhtamt += parseFloat(value.PAYMENTDV_PAYWHTAMT.replace(/,/g, '')) || 0;
                    pt_payttlamt += parseFloat(value.PAYMENTDV_PAYTTLAMT.replace(/,/g, '')) || 0;
                }
            });
            $('#PT_PVAMT').val(num2digit(pt_pvamt));
            $('#PT_OSTDAMT').val(num2digit(pb_ostdamt));
            $('#PT_VATAMT').val(num2digit(pt_vatamt));
            $('#PT_WHTAMT').val(num2digit(pt_whtamt));
            $('#PT_OSTDTTLAMT').val(num2digit(pv_ostdttlamt));
            $('#PT_PAYAMT').val(num2digit(pt_payamt));
            $('#T_PAY').val(num2digit(t_pay));
            $('#PT_PAYVATAMT').val(num2digit(pt_payvatamt));
            $('#PT_PAYWHTAMT').val(num2digit(pt_paywhtamt));
            $('#PT_PAYTTLAMT').val(num2digit(pt_payttlamt));
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
        }
    }

    function actionDialog(type) {
        if(type == 2) {
            return questionDialog(2, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');        
        } else if(type == 3) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if(type == 4) {
            if($("#RVNO").val() == '') {
                return alertWarning('<?=lang('validation3'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');  
            }
            return alertWarning('<?=lang('validation2'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if(type == 5) {
            return alertWarning('<?=lang('validation3'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');  
        } else if(type == 6) {
            return questionDialog(3, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');   
        } else {
            if(type == 'ERRO_NOT_EQUAL_DEBIT_AND_CREDIT') {
                return alertWarning('<?=lang('ERRO_NOT_EQUAL_DEBIT_AND_CREDIT'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
            } else if(type == 'ERRO_EXISTS_ROW_NOT_SETTING_ACCOUNT') {
                return alertWarning( '<?=lang('ERRO_EXISTS_ROW_NOT_SETTING_ACCOUNT'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
            } else {
                return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
            }
        }
    }

    function vlidationSupplier() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('validation4'); ?>',
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