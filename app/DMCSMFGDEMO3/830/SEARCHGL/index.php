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
            <form class="w-full" method="POST" action="" id="searchGL" name="searchGL" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('searchcriteria')?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLVOUCHERDATE')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="VOUCHERDATEFR" id="VOUCHERDATEFR" value="<?=!empty($data['VOUCHERDATEFR']) ? date('Y-m-d', strtotime($data['VOUCHERDATEFR'])): ''; ?>"/>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center">→<?php // checklang('LBLDASH')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="VOUCHERDATETO" id="VOUCHERDATETO" value="<?=!empty($data['VOUCHERDATETO']) ? date('Y-m-d', strtotime($data['VOUCHERDATETO'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLSUPPLIER')?></label>
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
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SUPPLIERTO" id="SUPPLIERTO" value="<?=isset($data['SUPPLIERTO']) ? $data['SUPPLIERTO']: ''; ?>"/>
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
                                                    name="VOUCHERNOFM" id="VOUCHERNOFM" value="<?=isset($data['VOUCHERNOFM']) ? $data['VOUCHERNOFM']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="ACCBOKGUIDE91">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="VOUCHERNOTO" id="VOUCHERNOTO" value="<?=isset($data['VOUCHERNOTO']) ? $data['VOUCHERNOTO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="ACCBOKGUIDE92">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12">
                                       <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLCUSTOMER')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CUSTOMERFR" id="CUSTOMERFR" value="<?=isset($data['CUSTOMERFR']) ? $data['CUSTOMERFR']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCUSTOMER1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CUSTOMERTO" id="CUSTOMERTO" value="<?=isset($data['CUSTOMERTO']) ? $data['CUSTOMERTO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCUSTOMER2">
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
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center">→</label>
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
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLDEPARTMENT')?></label>
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
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center">→</label>
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
                                </div>
    
                                <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLACCCODE')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="ACCCODEFR" id="ACCCODEFR" value="<?=isset($data['ACCCODEFR']) ? $data['ACCCODEFR']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHACCOUNT1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="ACCCODETO" id="ACCCODETO" value="<?=isset($data['ACCCODETO']) ? $data['ACCCODETO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHACCOUNT2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
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
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLTRANSACTIONTYPE')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300" 
                                                    id="TRANSACTIONTYPEFR" name="TRANSACTIONTYPEFR">
                                            <option value=""></option>
                                                <?php foreach ($acctrxtype as $trxkey => $trxitem) { ?>
                                                    <option value="<?=$trxkey ?>" <?=(isset($data['TRANSACTIONTYPEFR']) && $data['TRANSACTIONTYPEFR'] == $trxkey) ? 'selected' : '' ?>><?=$trxitem ?></option>
                                                <?php } ?>
                                            </select>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12 justify-end">
                                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
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
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV01')?></span>
                                </th>
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV02')?></span>
                                </th>
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV03')?></span>
                                </th>
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV04')?></span>
                                </th>
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV05')?></span>
                                </th>
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV06')?></span>
                                </th>
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV07')?></span>
                                </th>
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV08')?></span>
                                </th>
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV09')?></span>
                                </th><?php
                                for($i = 10; $i <= 28; $i++) { ?>
                                <th class="w-40 text-center py-2 px-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SEARCHGL_DV'.$i)?></span>
                                </th><?php
                                } ?>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[434px]"><?php
                        if(!empty($data['ITEM']))  {
                            $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="flex w-full p-0 divide-x csv row-id" id="rowId<?=$key?>">
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV01']) ? $value['SEARCHGL_DV01']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV02']) ? $value['SEARCHGL_DV02']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['SEARCHGL_DV03']) ? $value['SEARCHGL_DV03']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['SEARCHGL_DV04']) ? $value['SEARCHGL_DV04']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV05']) ? $value['SEARCHGL_DV05']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV06']) ? $value['SEARCHGL_DV06']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV07']) ? $value['SEARCHGL_DV07']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV08']) ? $value['SEARCHGL_DV08']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV09']) ? $value['SEARCHGL_DV09']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV10']) ? $value['SEARCHGL_DV10']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV11']) ? $value['SEARCHGL_DV11']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV12']) ? $value['SEARCHGL_DV12']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV13']) ? $value['SEARCHGL_DV13']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV14']) ? $value['SEARCHGL_DV14']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV15']) ? $value['SEARCHGL_DV15']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV16']) ? $value['SEARCHGL_DV16']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV17']) ? $value['SEARCHGL_DV17']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['SEARCHGL_DV18']) ? $value['SEARCHGL_DV18']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV19']) ? $value['SEARCHGL_DV19']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV20']) ? $value['SEARCHGL_DV20']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-right"><?=isset($value['SEARCHGL_DV21']) ? $value['SEARCHGL_DV21']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-right"><?=isset($value['SEARCHGL_DV22']) ? $value['SEARCHGL_DV22']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV23']) ? $value['SEARCHGL_DV23']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV24']) ? $value['SEARCHGL_DV24']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-right"><?=isset($value['SEARCHGL_DV25']) ? $value['SEARCHGL_DV25']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-right"><?=isset($value['SEARCHGL_DV26']) ? $value['SEARCHGL_DV26']: '' ?></td>
                                    <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['SEARCHGL_DV27']) ? $value['SEARCHGL_DV27']: '' ?></td>
                                    <td class="h-6 w-40 text-sm text-center"><?=isset($value['SEARCHGL_DV28']) ? $value['SEARCHGL_DV28']: '' ?></td>
                                </tr><?php 
                            }
                        }                         
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="flex w-full p-0 divide-x row-empty" id="rowId<?=$i?>"><?php
                                for($x = 1; $x <= 28; $x++) { ?>
                                <td class="h-6 w-40 py-2"></td><?php
                                } ?>
                            </tr><?php
                        } ?>
                        </tbody>
                    </table>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>
     
                <div class="flex">
                    <div class="flex w-6/12">
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
        const dvwdetail = document.getElementById('dvwdetail');
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
                dvwdetail.classList.remove('h-[434px]');
                dvwdetail.classList.add('h-[586px]');
                maxrow = 24;
            } else {
                dvwdetail.classList.remove('h-[586px]');
                dvwdetail.classList.add('h-[434px]');
                maxrow = 18;
            }
            emptyRow(maxrow);
        })
    });

    function HandlePopupResultIndex(code, result, index) {
        // console.log("result of popup is: " + code + ' : ' + result);
        return getElementIndex(code, result, index);
        // $('#loading').show();
        // return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/830/SEARCHGL/index.php?'+code+'=' + result + '&index=' + index;
    }

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getElementIndex(code, result, '');
        // return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/830/SEARCHGL/index.php?'+code+'=' + result;
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            // var item = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
            // if(item < 1)
            //     return false;
            // return questionDialog(2, '<?=lang('question4'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>