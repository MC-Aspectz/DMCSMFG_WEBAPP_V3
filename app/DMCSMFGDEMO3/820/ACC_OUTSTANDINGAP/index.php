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
            <form class="w-full" method="POST" action="" id="accOutStandingAP" name="accOutStandingAP" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=checklang('SEARCH')?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STATUS')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" 
                                                id="PAYMENTSTATUS" name="PAYMENTSTATUS">
                                            <option value=""></option>
                                            <?php foreach ($paymentstatus as $paykey => $payitem) { ?>
                                                <option value="<?=$paykey ?>" <?=isset($data['PAYMENTSTATUS']) && $data['PAYMENTSTATUS'] == $paykey ? 'selected' : '' ?>><?=$payitem ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('CURRENCY')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CURRENCY" id="CURRENCY" value="<?=isset($data['CURRENCY']) ? $data['CURRENCY']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCURRENCY">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DUEDATE')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="DUEDATEFR" id="DUEDATEFR" value="<?=!empty($data['DUEDATEFR']) ? date('Y-m-d', strtotime($data['DUEDATEFR'])): ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 text-center">→<?php // checklang('LBLDASH')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="DUEDATETO" id="DUEDATETO" value="<?=!empty($data['DUEDATETO']) ? date('Y-m-d', strtotime($data['DUEDATETO'])): ''; ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLVOUCHERDATE')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="VOUCHERDTFR" id="VOUCHERDTFR" value="<?=!empty($data['VOUCHERDTFR']) ? date('Y-m-d', strtotime($data['VOUCHERDTFR'])): ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 text-center">→<?php // checklang('LBLDASH')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="VOUCHERDTTO" id="VOUCHERDTTO" value="<?=!empty($data['VOUCHERDTTO']) ? date('Y-m-d', strtotime($data['VOUCHERDTTO'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIERCODE')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SUPPLIERFR" id="SUPPLIERFR" value="<?=isset($data['SUPPLIERFR']) ? $data['SUPPLIERFR']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSUPPLIER1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-2/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CUSTOMERTO" id="SUPPLIERTO" value="<?=isset($data['SUPPLIERTO']) ? $data['SUPPLIERTO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSUPPLIER2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLVOUCHERNO')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="VOUCHERNOFR" id="VOUCHERNOFR" value="<?=isset($data['VOUCHERNOFR']) ? $data['VOUCHERNOFR']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPURRECTRAN_ACC1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-2/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="VOUCHERNOTO" id="VOUCHERNOTO" value="<?=isset($data['VOUCHERNOTO']) ? $data['VOUCHERNOTO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPURRECTRAN_ACC2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIERINVOICEDATE')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="SUPPINVDTFR" id="SUPPINVDTFR" value="<?=!empty($data['SUPPINVDTFR']) ? date('Y-m-d', strtotime($data['SUPPINVDTFR'])): ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 text-center">→</label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="SUPPINVDTTO" id="SUPPINVDTTO" value="<?=!empty($data['SUPPINVDTTO']) ? date('Y-m-d', strtotime($data['SUPPINVDTTO'])): ''; ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="DEPARTMENTFR" id="DEPARTMENTFR" value="<?=isset($data['DEPARTMENTFR']) ? $data['DEPARTMENTFR']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHDIVISION1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-2/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="DEPARTMENTTO" id="DEPARTMENTTO" value="<?=isset($data['DEPARTMENTTO']) ? $data['DEPARTMENTTO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHDIVISION2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLSUPPINVNO')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SUPPINVNOFR" id="SUPPINVNOFR" value="<?=isset($data['SUPPINVNOFR']) ? $data['SUPPINVNOFR']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSUPPLIERINVOICE_ACC1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-2/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SUPPINVNOTO" id="SUPPINVNOTO" value="<?=isset($data['SUPPINVNOTO']) ? $data['SUPPINVNOTO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSUPPLIERINVOICE_ACC2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLSTAFF')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="STAFFFR" id="STAFFFR" value="<?=isset($data['STAFFFR']) ? $data['STAFFFR']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTAFF1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-2/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="STAFFTO" id="STAFFTO" value="<?=isset($data['STAFFTO']) ? $data['STAFFTO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTAFF2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="flex w-6/12 justify-end">
                                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mt-2"
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

                <!-- Table -->
                <div class="overflow-scroll mb-1">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200">
                        <thead class="w-full bg-gray-100">
                            <tr class="flex w-full divide-x csv">
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_SUPPINVNO')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_VOUCHERNO')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_SUPPINVDT')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_CRTERM')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_DUEDT')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_DAYOVERDUE')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_PAIDDT')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_SUPPCD')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_SUPPNAME')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_CURR')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_INVAMT')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_OUTSTDAMT')?></span>
                                </th>
                                <th class="w-40 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAP_STATUS')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[404px]"><?php
                        if(!empty($data['ITEM']))  {
                            $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="flex w-full p-0 divide-x csv row-id" id="rowId<?=$key?>" <?php if(isset($value['SYSROWCOLOR'])) { ?> style="background-color:<?=$value['SYSROWCOLOR']?>" <?php } ?>>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['DVOUTSTDAP_SUPPINVNO']) ? $value['DVOUTSTDAP_SUPPINVNO']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['DVOUTSTDAP_VOUCHERNO']) ? $value['DVOUTSTDAP_VOUCHERNO']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['DVOUTSTDAP_SUPPINVDT']) ? $value['DVOUTSTDAP_SUPPINVDT']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['DVOUTSTDAP_CRTERM']) ? $value['DVOUTSTDAP_CRTERM']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['DVOUTSTDAP_DUEDT']) ? $value['DVOUTSTDAP_DUEDT']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['DVOUTSTDAP_DAYOVERDUE']) ? $value['DVOUTSTDAP_DAYOVERDUE']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['DVOUTSTDAP_PAIDDT']) ? $value['DVOUTSTDAP_PAIDDT']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['DVOUTSTDAP_SUPPCD']) ? $value['DVOUTSTDAP_SUPPCD']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['DVOUTSTDAP_SUPPNAME']) ? $value['DVOUTSTDAP_SUPPNAME']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['DVOUTSTDAP_CURR']) ? $value['DVOUTSTDAP_CURR']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-right"><?=isset($value['DVOUTSTDAP_INVAMT']) ? $value['DVOUTSTDAP_INVAMT']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-right"><?=isset($value['DVOUTSTDAP_OUTSTDAMT']) ? $value['DVOUTSTDAP_OUTSTDAMT']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['DVOUTSTDAP_STATUS']) ? $value['DVOUTSTDAP_STATUS']: '' ?></td>
                                </tr><?php 
                            }
                        }      
                                      
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="flex w-full p-0 divide-x row-empty" id="rowId<?=$i?>">
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                                <td class="h-6 w-40 py-2"></td>
                            </tr><?php
                        } ?>
                        </tbody>
                        <tfoot>
                            <tr class="flex"><?php
                                for ($i = 1 ; $i <= 9; $i++) { ?><td class="h-7 w-40"></td><?php } ?>
                                <td class="h-7 w-40">
                                    <input type="text" class="w-40 shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                            name="TTLINVAMT" id="TTLINVAMT" value="<?=isset($data['TTLINVAMT']) ? $data['TTLINVAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-7 w-40">
                                    <input type="text" class="w-40 shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                            name="TTLOUTSTDAMT" id="TTLOUTSTDAMT" value="<?=isset($data['TTLOUTSTDAMT']) ? $data['TTLOUTSTDAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-7 w-40"><?=str_repeat('&emsp;', 2);?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="PRINT" name="PRINT"><?=checklang('PRINT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('BTNCLEAR'); ?></button>&emsp;&emsp;
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
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">   
    $(document).ready(function() {
        calculateDVW();
        const detailTb = document.getElementById('dvwdetail');
        let minrow = '<?php echo (isset($minrow) ? $minrow: 0); ?>';
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        var dataItem = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
            }
        });

        const details = document.querySelector('details');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                dvwdetail.classList.remove('h-[404px]');
                dvwdetail.classList.add('h-[556px]');
                maxrow = 23;
            } else {
                dvwdetail.classList.remove('h-[556px]');
                dvwdetail.classList.add('h-[404px]');
                maxrow = 16;
            }
            emptyRows(maxrow);
        })

        if(dataItem < 1) {
            document.getElementById('PRINT').disabled = true;
            document.getElementById('CSV').disabled = true;
        }
    });

    function HandlePopupResultIndex(code, result, index) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $('#loading').show();
        return getElementIndex(code, result, index);
        // return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/820/ACC_OUTSTANDINGAP/index.php?'+code+'=' + result + '&index=' + index;
    }

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        $('#loading').show();
        return getElementIndex(code, result, '');
        // return getSearch(code, result);
    }

    function calculateDVW() {
        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        let totalinvamt = 0; let totaloutsamt = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            $.each(itemArray, function(key, value) {
                // console.log(value);
                totalinvamt += parseFloat(value.DVOUTSTDAP_INVAMT_TTL.replace(/,/g, '')) || 0;
                totaloutsamt += parseFloat(value.DVOUTSTDAP_OUTSTDAMT_TTL.replace(/,/g, '')) || 0;
            });
            $('#TTLINVAMT').val(num2digit(totalinvamt));
            $('#TTLOUTSTDAMT').val(num2digit(totaloutsamt));
        }        
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            var item = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
            if(item < 1)
                return false;
            return questionDialog(2, '<?=lang('question4'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>