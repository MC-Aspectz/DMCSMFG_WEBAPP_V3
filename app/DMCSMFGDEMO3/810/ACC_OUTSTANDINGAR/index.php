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
            <form class="w-full" method="POST" action="" id="accOutStandingAR" name="accOutStandingAR" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false; }">
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
                                                id="RECEIVESTATUS" name="RECEIVESTATUS">
                                            <option value=""></option>
                                            <?php foreach ($receivestatus as $reckey => $recitem) { ?>
                                                <option value="<?=$reckey ?>" <?=isset($data['RECEIVESTATUS']) && $data['RECEIVESTATUS'] == $reckey ? 'selected' : '' ?>><?=$recitem ?></option>
                                            <?php } ?>
                                        </select>
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DUEDATE')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="DUEDATEFR" id="DUEDATEFR" value="<?=!empty($data['DUEDATEFR']) ? date('Y-m-d', strtotime($data['DUEDATEFR'])): ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 text-center">→<?php // checklang('LBLDASH')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="DUEDATETO" id="DUEDATETO" value="<?=!empty($data['DUEDATETO']) ? date('Y-m-d', strtotime($data['DUEDATETO'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DVOUTSTDAR_CUSTCD')?></label>
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
                                        <label class="text-color block text-sm w-1/12 text-center">→</label>
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('LBLINVDATE')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="INVDATEFR" id="INVDATEFR" value="<?=!empty($data['INVDATEFR']) ? date('Y-m-d', strtotime($data['INVDATEFR'])): ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 text-center">→</label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="INVDATETO" id="INVDATETO" value="<?=!empty($data['INVDATETO']) ? date('Y-m-d', strtotime($data['INVDATETO'])): ''; ?>"/>
                                    </div>
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
                                        <label class="text-color block text-sm w-1/12 text-center">→</label>
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DVOUTSTDAR_INVNO')?></label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="INVNOFR" id="INVNOFR" value="<?=isset($data['INVNOFR']) ? $data['INVNOFR']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALETRAN_ACC1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-1/12 text-center">→</label>
                                        <div class="relative w-3/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="INVNOTO" id="INVNOTO" value="<?=isset($data['INVNOTO']) ? $data['INVNOTO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALETRAN_ACC2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

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
                                        <label class="text-color block text-sm w-1/12 text-center">→</label>
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
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12"></div>
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
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LBLINVNO')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LBLINVDATE')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAR_CRTERM')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAR_DUEDT')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAR_DTOVDU')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAR_RECVDT')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCODE')?></span>
                                </th>
                                <th class="w-48 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAR_CUSTNAME')?></span>
                                </th>
                                <th class="w-24 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAR_INVAMT')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAR_OUTSTDAMT')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DVOUTSTDAR_STATUS')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[404px]"><?php
                        if(!empty($data['ITEM']))  {
                            $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="flex w-full p-0 divide-x csv row-id" id="rowId<?=$key?>" <?php if(isset($value['SYSROWCOLOR'])) { ?> style="background-color:<?=$value['SYSROWCOLOR']?>" <?php } ?>>
                                    <td class="h-6 w-32 text-sm pl-1 text-left"><?=isset($value['DVOUTSTDAR_INVNO']) ? $value['DVOUTSTDAR_INVNO']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-center"><?=isset($value['DVOUTSTDAR_INVDT']) ? $value['DVOUTSTDAR_INVDT']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-center"><?=isset($value['DVOUTSTDAR_CRTERM']) ? $value['DVOUTSTDAR_CRTERM']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-center"><?=isset($value['DVOUTSTDAR_DUEDT']) ? $value['DVOUTSTDAR_DUEDT']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-center"><?=isset($value['DVOUTSTDAR_DTOVDU']) ? $value['DVOUTSTDAR_DTOVDU']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-center"><?=isset($value['DVOUTSTDAR_RECVDT']) ? $value['DVOUTSTDAR_RECVDT']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-left"><?=isset($value['DVOUTSTDAR_CUSTCD']) ? $value['DVOUTSTDAR_CUSTCD']: '' ?></td>
                                    <td class="h-6 w-48 text-sm text-left"><?=isset($value['DVOUTSTDAR_CUSTNAME']) ? $value['DVOUTSTDAR_CUSTNAME']: '' ?></td>
                                    <td class="h-6 w-24 text-sm text-center"><?=isset($value['DVOUTSTDAR_CURRCD']) ? $value['DVOUTSTDAR_CURRCD']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-right"><?=isset($value['DVOUTSTDAR_INVAMT']) ? $value['DVOUTSTDAR_INVAMT']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-right"><?=isset($value['DVOUTSTDAR_OUTSTDAMT']) ? $value['DVOUTSTDAR_OUTSTDAMT']: '' ?></td>
                                    <td class="h-6 w-32 text-sm pl-1 text-left"><?=isset($value['DVOUTSTDAR_STATUS']) ? $value['DVOUTSTDAR_STATUS']: '' ?></td>
                                </tr><?php 
                            }
                        }                           
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="flex w-full p-0 divide-x row-empty" id="rowId<?=$i?>">
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-48 py-2"></td>
                                <td class="h-6 w-24 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                            </tr><?php
                        } ?>
                        </tbody>
                        <tfoot>
                            <tr class="flex grid grid-cols-12">
                                <td class="h-6 col-span-9"></td>
                                <td class="h-6 col-span-1">
                                    <input type="text" class="w-32 shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                            name="TTLINVAMT" id="TTLINVAMT" value="<?=isset($data['TTLINVAMT']) ? $data['TTLINVAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6 col-span-1">
                                    <input type="text" class="w-32 shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                            name="TTLOUTSTDAMT" id="TTLOUTSTDAMT" value="<?=isset($data['TTLOUTSTDAMT']) ? $data['TTLOUTSTDAMT']: ''; ?>" readonly/>
                                </td>
                                <td class="h-6 col-span-1"><?=str_repeat('&emsp;', 2);?></td>
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
<script type="text/javascript">   
    $(document).ready(function() {
        calculateDVW();
        const dvwdetail = document.getElementById('dvwdetail');
        let minrow = '<?php echo (isset($minrow) ? $minrow: 0); ?>';
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        var dataItem = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        $('#table tbody tr').click(function () {
            $('#table tbody tr').removeAttr('id');

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
                dvwdetail.classList.add('h-[536px]');
                maxrow = 22;
            } else {
                dvwdetail.classList.remove('h-[536px]');
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
        return getElementIndex(code, result, index);
        // return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_OUTSTANDINGAR/index.php?'+code+'=' + result + '&index=' + index;
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        return getElementIndex(code, result, '');
        // return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_OUTSTANDINGAR/index.php?'+code+'=' + result;
    }

    function calculateDVW() {
        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        let totalinvamt = 0; let totaloutsamt = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            $.each(itemArray, function(key, value) {
                // console.log(value);
                totalinvamt += parseFloat(value.DVOUTSTDAR_INVAMT_TTL.replace(/,/g, '')) || 0;
                totaloutsamt += parseFloat(value.DVOUTSTDAR_OUTSTDAMT_TTL.replace(/,/g, '')) || 0;
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