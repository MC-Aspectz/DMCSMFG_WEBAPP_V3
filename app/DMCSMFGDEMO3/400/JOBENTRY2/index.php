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
            <form class="w-full" method="POST" id="jobResultEntry2" name="jobResultEntry2" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PRODUCTIONORDER')?></label>
                                        <div class="relative w-4/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="PROORDERNO" name="PROORDERNO" value="<?=isset($data['PROORDERNO']) ? $data['PROORDERNO']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPRODUCTIONORDER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input class="read" type="hidden" id="TIMESTAMP" name="TIMESTAMP" value="<?=!empty($data['TIMESTAMP']) ? $data['TIMESTAMP']: ''; ?>" />
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <hr class="divide-y divide-dotted my-2 mx-2">

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('QUANTITY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROQTY" name="PROQTY" value="<?=!empty($data['PROQTY']) ? number_format($data['PROQTY'], 2): ''; ?>" readonly/>
                                        <select class="text-control text-sm shadow-md border px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 read"
                                                id="ITEMUNITTYP" name="ITEMUNITTYP">
                                                <option value=""></option>
                                                <?php foreach ($unit as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WC_CODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROWCCD" name="PROWCCD" value="<?=isset($data['PROWCCD']) ? $data['PROWCCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROWCNAME" name="PROWCNAME" value="<?=isset($data['PROWCNAME']) ? $data['PROWCNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('START_DATE_PRODUCE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROPLANSTARTDT" name="PROPLANSTARTDT" value="<?=!empty($data['PROPLANSTARTDT']) ? date('Y-m-d', strtotime($data['PROPLANSTARTDT'])): ''; ?>"/>
                                        <label class="text-color block text-sm pt-1 w-3/12 text-center"><?=checklang('PROD_DUE_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROPLANENDDT"name="PROPLANENDDT" value="<?=!empty($data['PROPLANENDDT']) ? date('Y-m-d', strtotime($data['PROPLANENDDT'])): ''; ?>"/>
                                    </div>
                                </div>                             

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROSTAFFCD" name="PROSTAFFCD" value="<?=isset($data['PROSTAFFCD']) ? $data['PROSTAFFCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROSTAFFNAME" name="PROSTAFFNAME" value="<?=isset($data['PROSTAFFNAME']) ? $data['PROSTAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STARTDATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROSTARTDT" name="PROSTARTDT" value="<?=!empty($data['PROSTARTDT']) ? date('Y-m-d', strtotime($data['PROSTARTDT'])): ''; ?>"/>
                                        <label class="text-color block text-sm pt-1 w-3/12 text-center"><?=checklang('ENDDATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROENDDT"name="PROENDDT" value="<?=!empty($data['PROENDDT']) ? date('Y-m-d', strtotime($data['PROENDDT'])): ''; ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('LO_CODE')?></label>
                                        <select class="text-control text-sm shadow-md border mr-2 px-3 h-7 w-2/12 mr-1 text-left text-[12px] rounded-xl border-gray-300 read"
                                            id="PROLOCTYP" name="PROLOCTYP">
                                            <option value=""></option>
                                            <?php foreach ($storagetype as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['PROLOCTYP']) && $data['PROLOCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROLOCCD" name="PROLOCCD" value="<?=isset($data['PROLOCCD']) ? $data['PROLOCCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROLOCNAME" name="PROLOCNAME" value="<?=isset($data['PROLOCNAME']) ? $data['PROLOCNAME']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('MEMBERS')?></label>
                                    </div>
                                    <div class="flex w-3/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 text-right req"
                                                id="JOBPROMEMBER" name="JOBPROMEMBER" value="<?=isset($data['JOBPROMEMBER']) ? $data['JOBPROMEMBER']: ''; ?>" onchange="this.value = numberWithComma(this.value); unRequired();"
                                                oninput="this.value = stringReplacez(this.value);"/>
                                        <label class="text-color block text-sm w-6/12 pt-1 text-center"><?=checklang('NUM_MAN')?></label>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex flex-col mb-1">
                    <div class="flex w-full">
                        <div class="flex flex-col w-8/12 px-2">
                            <!-- DVWJOBPRODUCTION Table -->
                            <div id="table-areaA" class="flex overflow-scroll block h-[200px]"> 
                                <table id="tableProduct" class="w-full border-collapse border border-slate-500 divide-gray-200 prd_table" rules="cols" cellpadding="3" cellspacing="1">
                                    <thead class="sticky top-0 bg-gray-50">
                                        <tr class="border border-gray-600">
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOB_CARD_NO')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ROUT_NO')?></span>
                                            </th>
                                            <th class="px-6 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOB_INF')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STARTDATE')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('START_TIME')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FINISH_TIME')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('COMP_QTY')?></span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="dvwdetailA" class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                                    if(!empty($data['DVWJOBPRODUCTION']))  { $minrowA = count($data['DVWJOBPRODUCTION']);
                                        foreach ($data['DVWJOBPRODUCTION'] as $key => $value) { ?>
                                            <tr class="divide-y divide-gray-200 proRow" id="rowPrdId<?=$key?>">
                                                <td class="hidden proRow-id" id="ROWNO_TD<?=$key?>"><?=$key ?></td>
                                                <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="JOBPROORDERNO_TD<?=$key?>"><?=isset($value['JOBPROORDERNO']) ? $value['JOBPROORDERNO']: '' ?></td>
                                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="JOBPROLN_TD<?=$key?>"><?=isset($value['JOBPROLN']) ? $value['JOBPROLN']: '' ?></td>
                                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="PROPSSNO_TD<?=$key?>"><?=isset($value['PROPSSNO']) ? $value['PROPSSNO']: '' ?></td>
                                                <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="JOBPROJOBTYPSTR_TD<?=$key?>"><?=isset($value['JOBPROJOBTYPSTR']) ? $value['JOBPROJOBTYPSTR']: '' ?></td>
                                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="JOBPROSTARTDT_TD<?=$key?>"><?=isset($value['JOBPROSTARTDT']) ? $value['JOBPROSTARTDT']: '' ?></td>
                                                <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="JOBPROSTARTTM_TD<?=$key?>"><?=isset($value['JOBPROSTARTTM']) ? $value['JOBPROSTARTTM']: '' ?></td>
                                                <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="JOBPROENDTM_TD<?=$key?>"><?=isset($value['JOBPROENDTM']) ? $value['JOBPROENDTM']: '' ?></td>
                                                <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="JOBPROCOMQTY_TD<?=$key?>"><?=isset($value['JOBPROCOMQTY']) ? $value['JOBPROCOMQTY']: '' ?></td>
                                                <td class="hidden"></td>
                                                <td class="hidden" id="JOBPROJOBTYP_TD<?=$key?>"><?=isset($value['JOBPROJOBTYP']) ? $value['JOBPROJOBTYP']: '' ?></td>
                                                <td class="hidden" id="JOBPROENTRYDT_TD<?=$key?>"><?=isset($value['JOBPROENTRYDT']) ? $value['JOBPROENTRYDT']: '' ?></td>
                                                <td class="hidden" id="JOBPROPSSTYP_TD<?=$key?>"><?=isset($value['JOBPROPSSTYP']) ? $value['JOBPROPSSTYP']: '' ?></td>
                                                <td class="hidden" id="JOBPROPSSTYPSTR_TD<?=$key?>"><?=isset($value['JOBPROPSSTYPSTR']) ? $value['JOBPROPSSTYPSTR']: '' ?></td>
                                                <td class="hidden" id="LOCCD_TD<?=$key?>"><?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?></td>
                                                <td class="hidden" id="LOCNAME_TD<?=$key?>"><?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?></td>
                                                <td class="hidden" id="JOBPROREM_TD<?=$key?>"><?=isset($value['JOBPROREM']) ? $value['JOBPROREM']: '' ?></td>
                                                <td class="hidden" id="JOBPROHOUR_TD<?=$key?>"><?=isset($value['JOBPROHOUR']) ? $value['JOBPROHOUR']: '' ?></td>
                                                <td class="hidden" id="JOBPROTIMETYPE_TD<?=$key?>"><?=isset($value['JOBPROTIMETYPE']) ? $value['JOBPROTIMETYPE']: '' ?></td>
                                                <td class="hidden" id="JOBPROSTATUS_TD<?=$key?>"><?=isset($value['JOBPROSTATUS']) ? $value['JOBPROSTATUS']: '' ?></td>
                                                <td class="hidden" id="WCCOST_TD<?=$key?>"><?=isset($value['WCCOST']) ? $value['WCCOST']: '' ?></td>
                                                <td class="hidden" id="WCSTDCOST_TD<?=$key?>"><?=isset($value['WCSTDCOST']) ? $value['WCSTDCOST']: '' ?></td>
                                                <td class="hidden" id="IMAGEFILE_TD<?=$key?>"><?=isset($value['IMAGEFILE']) ? $value['IMAGEFILE']: '' ?></td>
                                                <td class="hidden" id="STAFFCD_TD<?=$key?>"><?=isset($value['STAFFCD']) ? $value['STAFFCD']: '' ?></td>
                                                <td class="hidden" id="STAFFNAME_TD<?=$key?>"><?=isset($value['STAFFNAME']) ? $value['STAFFNAME']: '' ?></td>
                                                <td class="hidden" id="INSSTAFFCD_TD<?=$key?>"><?=isset($value['INSSTAFFCD']) ? $value['INSSTAFFCD']: '' ?></td>
                                                <td class="hidden" id="INSTIMESTAMP_TD<?=$key?>"><?=isset($value['INSTIMESTAMP']) ? $value['INSTIMESTAMP']: '' ?></td>
                                                <td class="hidden" id="OLDCOMPQTY_TD<?=$key?>"><?=isset($value['OLDCOMPQTY']) ? $value['OLDCOMPQTY']: '' ?></td>
                                                <td class="hidden" id="PROPSSLASTFLG_TD<?=$key?>"><?=isset($value['PROPSSLASTFLG']) ? $value['PROPSSLASTFLG']: '' ?></td>
                                                <td class="hidden" id="OLDLINE_TD<?=$key?>"><?=isset($value['OLDLINE']) ? $value['OLDLINE']: '' ?></td>
                                                <td class="hidden" id="JOBPROTRANNO_TD<?=$key?>"><?=isset($value['JOBPROTRANNO']) ? $value['JOBPROTRANNO']: '' ?></td>
                                                <td class="hidden" id="PROCOMPQTY_TD<?=$key?>"><?=isset($value['PROCOMPQTY']) ? $value['PROCOMPQTY']: '' ?></td>
                                                <td class="hidden" id="WORKTIMECD_TD<?=$key?>"><?=isset($value['WORKTIMECD']) ? $value['WORKTIMECD']: '' ?></td>

                                                <input class="hidden" id="JOBPROORDERNO<?=$key?>" name="JOBPROORDERNOA[]" value="<?=isset($value['JOBPROORDERNO']) ? $value['JOBPROORDERNO']: '' ?>"/>
                                                <input class="hidden" id="JOBPROLN<?=$key?>" name="JOBPROLNA[]" value="<?=isset($value['JOBPROLN']) ? $value['JOBPROLN']: '' ?>"/>
                                                <input class="hidden" id="PROPSSNO<?=$key?>" name="PROPSSNOA[]" value="<?=isset($value['PROPSSNO']) ? $value['PROPSSNO']: '' ?>"/>
                                                <input class="hidden" id="JOBPROJOBTYPSTR<?=$key?>" name="JOBPROJOBTYPSTRA[]" value="<?=isset($value['JOBPROJOBTYPSTR']) ? $value['JOBPROJOBTYPSTR']: '' ?>"/>
                                                <input class="hidden" id="JOBPROSTARTDT<?=$key?>" name="JOBPROSTARTDTA[]" value="<?=isset($value['JOBPROSTARTDT']) ? $value['JOBPROSTARTDT']: '' ?>"/>
                                                <input class="hidden" id="JOBPROSTARTTM<?=$key?>" name="JOBPROSTARTTMA[]" value="<?=isset($value['JOBPROSTARTTM']) ? $value['JOBPROSTARTTM']: '' ?>"/>
                                                <input class="hidden" id="JOBPROENDTM<?=$key?>" name="JOBPROENDTMA[]" value="<?=isset($value['JOBPROENDTM']) ? $value['JOBPROENDTM']: '' ?>"/>
                                                <input class="hidden" id="JOBPROCOMQTY<?=$key?>" name="JOBPROCOMQTYA[]" value="<?=isset($value['JOBPROCOMQTY']) ? $value['JOBPROCOMQTY']: '' ?>"/>
                                                <input class="hidden" id="JOBPROJOBTYP<?=$key?>" name="JOBPROJOBTYPA[]" value="<?=isset($value['JOBPROJOBTYP']) ? $value['JOBPROJOBTYP']: '' ?>"/>
                                                <input class="hidden" id="JOBPROENTRYDT<?=$key?>" name="JOBPROENTRYDTA[]" value="<?=isset($value['JOBPROENTRYDT']) ? $value['JOBPROENTRYDT']: '' ?>"/>
                                                <input class="hidden" id="JOBPROPSSTYP<?=$key?>" name="JOBPROPSSTYPA[]" value="<?=isset($value['JOBPROPSSTYP']) ? $value['JOBPROPSSTYP']: '' ?>"/>
                                                <input class="hidden" id="JOBPROTIMETYPE<?=$key?>" name="JOBPROTIMETYPEA[]" value="<?=isset($value['JOBPROTIMETYPE']) ? $value['JOBPROTIMETYPE']: '' ?>"/>
                                                <input class="hidden" id="JOBPROPSSTYPSTR<?=$key?>" name="JOBPROPSSTYPSTRA[]" value="<?=isset($value['JOBPROPSSTYPSTR']) ? $value['JOBPROPSSTYPSTR']: '' ?>"/>
                                                <input class="hidden" id="LOCCD<?=$key?>" name="LOCCDA[]" value="<?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?>"/>
                                                <input class="hidden" id="LOCNAME<?=$key?>" name="LOCNAMEA[]" value="<?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?>"/>
                                                <input class="hidden" id="JOBPROREM<?=$key?>" name="JOBPROREMA[]" value="<?=isset($value['JOBPROREM']) ? $value['JOBPROREM']: '' ?>"/>
                                                <input class="hidden" id="JOBPROHOUR<?=$key?>" name="JOBPROHOURA[]" value="<?=isset($value['JOBPROHOUR']) ? $value['JOBPROHOUR']: '' ?>"/>
                                                <input class="hidden" id="JOBPROSTATUS<?=$key?>" name="JOBPROSTATUSA[]" value="<?=isset($value['JOBPROSTATUS']) ? $value['JOBPROSTATUS']: '' ?>"/>
                                                <input class="hidden" id="WCCOST<?=$key?>" name="WCCOSTA[]" value="<?=isset($value['WCCOST']) ? $value['WCCOST']: '' ?>"/>
                                                <input class="hidden" id="WCSTDCOST<?=$key?>" name="WCSTDCOSTA[]" value="<?=isset($value['WCSTDCOST']) ? $value['WCSTDCOST']: '' ?>"/>
                                                <input class="hidden" id="IMAGEFILE<?=$key?>" name="IMAGEFILEA[]" value="<?=isset($value['IMAGEFILE']) ? $value['IMAGEFILE']: '' ?>"/>
                                                <input class="hidden" id="STAFFCD<?=$key?>" name="STAFFCDA[]" value="<?=isset($value['STAFFCD']) ? $value['STAFFCD']: '' ?>"/>
                                                <input class="hidden" id="STAFFNAME<?=$key?>" name="STAFFNAMEA[]" value="<?=isset($value['STAFFNAME']) ? $value['STAFFNAME']: '' ?>"/>
                                                <input class="hidden" id="INSSTAFFCD<?=$key?>" name="INSSTAFFCDA[]" value="<?=isset($value['INSSTAFFCD']) ? $value['INSSTAFFCD']: '' ?>"/>
                                                <input class="hidden" id="INSTIMESTAMP<?=$key?>" name="INSTIMESTAMPA[]" value="<?=isset($value['INSTIMESTAMP']) ? $value['INSTIMESTAMP']: '' ?>"/>
                                                <input class="hidden" id="OLDCOMPQTY<?=$key?>" name="OLDCOMPQTYA[]" value="<?=isset($value['OLDCOMPQTY']) ? $value['OLDCOMPQTY']: '' ?>"/>
                                                <input class="hidden" id="PROPSSLASTFLG<?=$key?>" name="PROPSSLASTFLGA[]" value="<?=isset($value['PROPSSLASTFLG']) ? $value['PROPSSLASTFLG']: '' ?>"/>
                                                <input class="hidden" id="OLDLINE<?=$key?>" name="OLDLINEA[]" value="<?=isset($value['OLDLINE']) ? $value['OLDLINE']: '' ?>"/>
                                                <input class="hidden" id="JOBPROTRANNO<?=$key?>" name="JOBPROTRANNOA[]" value="<?=isset($value['JOBPROTRANNO']) ? $value['JOBPROTRANNO']: '' ?>"/>
                                                <input class="hidden" id="PROCOMPQTY<?=$key?>" name="PROCOMPQTYA[]" value="<?=isset($value['PROCOMPQTY']) ? $value['PROCOMPQTY']: '' ?>"/>
                                                <input class="hidden" id="WORKTIMECD<?=$key?>" name="WORKTIMECDA[]" value="<?=isset($value['WORKTIMECD']) ? $value['WORKTIMECD']: '' ?>"/>
                                            </tr><?php 
                                        }
                                    }         
                                    for ($i = $minrowA+1; $i <= $maxrowA; $i++) { ?>
                                        <tr class="divide-y divide-gray-200 row-empty" id="rowPrdId<?=$i?>">
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
                                </table>
                            </div>

                            <div class="flex p-2">
                                <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="procount"><?=$minrowA;?></span></label>
                            </div>
                        </div>

                        <div class="flex flex-col w-4/12 px-2">
                            <div class="flex border border-gray-300">
                                <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="ADDROW">+</button>
                                <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="DELROW">x</button>
                            </div>
                            <!-- DVWSCRAP Table -->
                            <div id="table-areaB" class="flex overflow-scroll block h-[165px]"> 
                                <table id="tableScrap" class="w-full border-collapse border border-slate-500 divide-gray-200 scrap_table" rules="cols" cellpadding="3" cellspacing="1">
                                    <thead class="sticky top-0 bg-gray-50">
                                        <tr class="border border-gray-600">
                                            <th class="px-6 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BAD_REASON')?></span>
                                            </th>
                                            <th class="px-6 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BAD_QTY')?></span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="dvwdetailB" class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                                    if(!empty($data['DVWSCRAP']))  { $minrowB = count($data['DVWSCRAP']);
                                        foreach ($data['DVWSCRAP'] as $key => $value) { ?>
                                            <tr class="divide-y divide-gray-200 scrapRow" id="rowId<?=$key?>">
                                                <td class="hidden scrapRow-id" id="ROWNO2_TD<?=$key?>"><?=$key ?></td>
                                                <td class="h-6 w-7/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">
                                                    <select class="text-control text-[12px] shadow-md border px-3 h-6 w-full text-left rounded-xl border-gray-300" id="PROSCRAPTYP<?=$key?>" name="PROSCRAPTYP[]">
                                                        <?php foreach ($badcode as $bad => $baditem) { ?>
                                                            <option value="<?=$bad ?>" <?=(isset($value['PROSCRAPTYP']) && $value['PROSCRAPTYP'] == $bad) ? 'selected' : '' ?>><?=$baditem ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td class="h-6 w-5/12 pr-1 text-sm border border-slate-700 text-right">
                                                    <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" 
                                                        id="PROSCRAPQTY<?=$key?>" name="PROSCRAPQTY[]" value="<?=isset($value['PROSCRAPQTY']) ? $value['PROSCRAPQTY']: '' ?>" 
                                                        onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                                </td>
                                            </tr><?php 
                                        }
                                    }         
                                    for ($i = $minrowB+1; $i <= $maxrow; $i++) { ?>
                                        <tr class="divide-y divide-gray-200 row-empty" id="rowId<?=$i?>">
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                        </tr><?php
                                    } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex p-0">
                                <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="scrapcount"><?=$minrowB;?></span></label>
                            </div>
                        </div>

                         <div class="hidden flex flex-col w-1/12 px-2">
                            <input type="hidden" name="PATHFILE" id="PATHFILE" value="">
                            <iframe class="m-auto px-6 py-8" id="ITEMIMGLOC" name="ITEMIMGLOC" src="<?=$_SESSION['APPURL']?>/img/csv-file.png"></iframe>
                            <?php if(isset($data['ITEMIMGLOC'])) { ?>
                                <iframe class="m-auto px-6 py-8" id="ITEMIMGLOC" name="ITEMIMGLOC" src=""></iframe>
                                <!-- <iframe class="m-auto px-6 py-8" id="ITEMIMGLOC" name="ITEMIMGLOC" src="<?=$_SESSION['APPURL']?>/img/csv-file.png"></iframe> -->
                            <?php } else { ?>
                                <iframe class="m-auto px-6 py-8" id="ITEMIMGLOC" name="ITEMIMGLOC" src=""></iframe><?php } ?>
                         </div>
                    </div>
                </div>
              
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold flex">
                                <!-- <div class="flex"> -->
                                    <div class="flex w-7/12 px-2">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center mr-2"
                                        id="OK" name="OK" <?php if(!empty($data['SYSVIS_INSERT']) && $data['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=checklang('OK'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSVIS_UPDATE']) && $data['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSVIS_DELETE']) && $data['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                                    </div>
                                    <div class="flex w-5/12 px-2 justify-end">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                        id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                                    </div>
                                <!-- </div> -->
                                </summary>

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ROUT_NO')?></label>
                                        <div class="relative w-2/12">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="PROPSSNO" name="PROPSSNO" value="<?=isset($data['PROPSSNO']) ? $data['PROPSSNO']: ''; ?>" required onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPROPSS">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('JOB_TYPE')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" id="JOBPROPSSTYP" name="JOBPROPSSTYP">
                                                <option value=""></option>
                                                <?php foreach ($jobtype as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['JOBPROPSSTYP']) && $data['JOBPROPSSTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                        </select>
                                        <input class="hidden" type="hidden" id="ROWNO" name="ROWNO" value="<?=!empty($data['ROWNO']) ? $data['ROWNO']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="JOBPROORDERNO" name="JOBPROORDERNO" value="<?=!empty($data['JOBPROORDERNO']) ? $data['JOBPROORDERNO']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSLASTFLG" name="PROPSSLASTFLG" value="<?=!empty($data['PROPSSLASTFLG']) ? $data['PROPSSLASTFLG']: ''; ?>" />
                                    </div>
                                    <div class="flex w-3/12 px-2">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="JOBPROENTRYDT" name="JOBPROENTRYDT" value="<?=!empty($data['JOBPROENTRYDT']) ? date('Y-m-d', strtotime($data['JOBPROENTRYDT'])): date('Y-m-d'); ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('WC_CODE')?></label>
                                        <div class="relative w-2/12 mr-1 pointer-events-none">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                    id="LOCCD" name="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''; ?>" readonly/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEMPLACE">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="LOCNAME" name="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('JOB_INF')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" id="JOBPROJOBTYP" name="JOBPROJOBTYP">
                                                <option value=""></option>
                                                <?php foreach ($jobcode as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['JOBPROJOBTYP']) && $data['JOBPROJOBTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-3/12 px-2">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('WORKTIMECD')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-7/12 text-left rounded-xl border-gray-300 read" id="WORKTIMECD" name="WORKTIMECD">
                                            <option value=""></option>
                                            <?php foreach ($workitemcd as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['WORKTIMECD']) && $data['WORKTIMECD'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-3/12 px-2">
                                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('COMP_QTY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 ml-2 py-2 px-3 text-gray-700 border-gray-300 text-right req"
                                                id="JOBPROCOMQTY" name="JOBPROCOMQTY" value="<?=!empty($data['JOBPROCOMQTY']) ? number_format($data['JOBPROCOMQTY'], 2): ''; ?>"
                                                onchange="this.value = numberWithComma(this.value); unRequired();" oninput="this.value = stringReplacez(this.value);" required/>
                                    </div>
                                    <div class="flex w-9/12 px-2">
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" id="ITEMUNITTYP2" name="ITEMUNITTYP2">
                                            <option value=""></option>
                                            <?php foreach ($unit as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <input class="hidden" type="text" id="PROCOMPQTY" name="PROCOMPQTY" value="<?=isset($data['PROCOMPQTY']) ? $data['PROCOMPQTY']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('REMARK')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="JOBPROREM" name="JOBPROREM" value="<?=isset($data['JOBPROREM']) ? $data['JOBPROREM']: ''; ?>"/>         
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('WORK_DAY')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-3 text-gray-700 border-gray-300"
                                                id="JOBPROSTARTDT" name="JOBPROSTARTDT" value="<?=!empty($data['JOBPROSTARTDT']) ? date('Y-m-d', strtotime($data['JOBPROSTARTDT'])): date('Y-m-d'); ?>"/>
                                        <input type="time" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="JOBPROSTARTTM" name="JOBPROSTARTTM" value="<?=!empty($data['JOBPROSTARTTM']) ? $data['JOBPROSTARTTM']: '00:00'; ?>"/>
                                        <label class="text-color block text-sm w-8 pt-1 text-center"><?=checklang('ARROW')?></label>
                                        <input type="time" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="JOBPROENDTM" name="JOBPROENDTM" value="<?=!empty($data['JOBPROENDTM']) ? $data['JOBPROENDTM']: '00:00'; ?>"/>        
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('JOB_HOUR')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="JOBPROHOUR" name="JOBPROHOUR" value="<?=isset($data['JOBPROHOUR']) ? $data['JOBPROHOUR']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-12 pt-1 text-center"><?=checklang('MINUTES')?></label>
                                    </div>
                                    <div class="flex w-3/12 px-2">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('BAD_QTY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="SUMSCRAP" name="SUMSCRAP" value="<?=isset($data['SUMSCRAP']) ? $data['SUMSCRAP']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('STATUS')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 mr-1 text-left rounded-xl border-gray-300 req" id="JOBPROSTATUS" name="JOBPROSTATUS" onchange="unRequired();" required>
                                            <option value=""></option>
                                            <?php foreach ($statusrout as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['JOBPROSTATUS']) && $data['JOBPROSTATUS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('CERTIFICATE_ATTACH')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="IMAGEFILE" name="IMAGEFILE" value="<?=isset($data['IMAGEFILE']) ? $data['IMAGEFILE']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-3/12 px-2">
                                        <input class="read" type="checkbox" id="PROMESS" name="PROMESS" value="<?=!empty($data['PROMESS']) ? $data['PROMESS']: 'T'; ?>" checked readonly/>
                                        <label class="text-color block text-sm w-11/12 pl-2 pt-1"><?=checklang('PRO_MESS')?></label>

                                    </div>
                                </div>    

                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-1 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form); clearTmp();"><?=checklang('CLEAR')?></button>&emsp;&emsp;
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
</html>
<script src="./js/script.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
        document.getElementById('OK').disabled = false;
        document.getElementById('UPDATE').disabled = true;
        document.getElementById('DELETE').disabled = true;

        let maxrowA = '<?php echo (isset($maxrowA) ? $maxrowA: 6); ?>';
        let maxrowB = '<?php echo (isset($maxrow) ? $maxrow: 5); ?>';
        const details = document.querySelector('details');
        const tableareaA = document.getElementById('table-areaA');
        const tableareaB = document.getElementById('table-areaB');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tableareaA.classList.remove('h-[200px]');
                tableareaA.classList.add('h-[340px]');
                tableareaB.classList.remove('h-[165px]');
                tableareaB.classList.add('h-[295px]');
                maxrowA = 11;
                maxrowB = 10;
            } else {
                tableareaA.classList.remove('h-[340px]');
                tableareaA.classList.add('h-[200px]');
                tableareaB.classList.remove('h-[295px]');
                tableareaB.classList.add('h-[165px]');
                maxrowA = 6;
                maxrowB = 5;
            }
            emptyRowsA(maxrowA);
            emptyRowsB(maxrowB);
        });

        // $('table#tableProduct tr').click(function () {
        $(document).on('click', '.prd_table tbody tr', function(event) {
            $('table#tableProduct tbody tr').not(this).removeClass('selected');
            let item = $(this).closest('tr').children('td');
            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                let rec = item.eq(0).text();
                let productTb = document.getElementById('tableProduct');
                if(rec != '') { 
                    productTb.rows[rec].classList.toggle('selected');
                }
                // console.log(item.eq(1).text());
                // console.log($('#JOBPROSTARTDT'+rec+'').val());
                $('#ROWNO').val(item.eq(0).text());
                $('#JOBPROORDERNO').val(item.eq(1).text());
                $('#PROPSSNO').val(item.eq(3).text());
                $('#JOBPROENTRYDT').val(dashFormatDate($('#JOBPROENTRYDT'+rec+'').val()));
                $('#PROPSSLASTFLG').val(item.eq(28).text());
                $('#LOCCD').val(item.eq(14).text());
                $('#LOCNAME').val(item.eq(15).text());
                $('#JOBPROREM').val(item.eq(16).text());
                $('#JOBPROCOMQTY').val(item.eq(8).text());
                $('#PROCOMPQTY').val(item.eq(31).text());
                $('#JOBPROSTARTDT').val(dashFormatDate($('#JOBPROSTARTDT'+rec+'').val()));
                $('#JOBPROSTARTTM').val(item.eq(6).text());
                $('#JOBPROENDTM').val(item.eq(7).text());
                let hour = item.eq(17).text();
                $('#JOBPROHOUR').val(parseFloat(hour).toFixed());
                $('#IMAGEFILE').val(item.eq(22).text());

                document.getElementById('JOBPROPSSTYP').value = item.eq(12).text();
                document.getElementById('JOBPROJOBTYP').value = item.eq(10).text();
                document.getElementById('WORKTIMECD').value = item.eq(32).text();
                document.getElementById('JOBPROSTATUS').value = item.eq(19).text();

                document.getElementById('OK').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;
                unRequired();
                searchScrap();
                // $('#SUMSCRAP').val(item.eq(1).text());
                // $('#PROMESS').val(item.eq(1).text());
            }
        });

        var index = 0;
        var index = '<?php echo (isset($data['DVWJOBPRODUCTION']) ? count($data['DVWJOBPRODUCTION']) : 0); ?>';

        OK.click(async function() {
            if($('#PROPSSNO').val() != '' && document.getElementById('JOBPROSTATUS').value != '') {
                // console.log('index before' + index);
                index ++;  // index += 1; 
                // console.log('index after' + index);
                var newRow = $('<tr class="divide-y divide-gray-200 proRow" id="rowPrdId'+index+'"></tr>');
                var cols = "";
                cols += '<td class="hidden proRow-id" id="ROWNO_TD'+index+'">'+index+'</td>';
                cols += '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="JOBPROORDERNO_TD'+index+'"></td>';
                cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="JOBPROLN_TD'+index+'">'+ index +'</td>';
                cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="PROPSSNO_TD'+index+'">'+ $('#PROPSSNO').val() +'</td>';
                cols += '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="JOBPROJOBTYPSTR_TD'+index+'">'+ $("#JOBPROJOBTYP option:selected").text() +'</td>';
                cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="JOBPROSTARTDT_TD'+index+'">'+ slashFormatDate($('#JOBPROSTARTDT').val()) +'</td>';
                cols += '<td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="JOBPROSTARTTM_TD'+index+'">'+ $('#JOBPROSTARTTM').val() +'</td>';
                cols += '<td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="JOBPROENDTM_TD'+index+'">'+ $('#JOBPROENDTM').val() +'</td>';
                cols += '<td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="JOBPROCOMQTY_TD'+index+'">'+ $('#JOBPROCOMQTY').val() +'</td>';
                cols += '<td class="hidden"></td>';
                cols += '<td class="hidden" id="JOBPROJOBTYP_TD'+index+'">'+ document.getElementById('JOBPROJOBTYP').value +'</td>';
                cols += '<td class="hidden" id="JOBPROENTRYDT_TD'+index+'">'+ slashFormatDate($('#JOBPROENTRYDT').val()) +'</td>';
                cols += '<td class="hidden" id="JOBPROPSSTYP_TD'+index+'">'+ document.getElementById('JOBPROPSSTYP').value +'</td>';
                cols += '<td class="hidden" id="JOBPROPSSTYPSTR_TD'+index+'">'+ $("#JOBPROPSSTYP option:selected").text() +'</td>';
                cols += '<td class="hidden" id="LOCCD_TD'+index+'">'+ $('#LOCCD').val() +'</td>';
                cols += '<td class="hidden" id="LOCNAME_TD'+index+'">'+ $('#LOCNAME').val() +'</td>';
                cols += '<td class="hidden" id="JOBPROREM_TD'+index+'">'+ $('#JOBPROREM').val() +'</td>';
                cols += '<td class="hidden" id="JOBPROHOUR_TD'+index+'">'+ $('#JOBPROHOUR').val() +'</td>';
                cols += '<td class="hidden" id="JOBPROTIMETYPE_TD'+index+'"></td>';
                cols += '<td class="hidden" id="JOBPROSTATUS_TD'+index+'">'+ document.getElementById('JOBPROSTATUS').value +'</td>';
                // cols += '<td class="hidden" id="WCCOST_TD'+index+'">'+ $('#WCCOST').val() +'</td>';            
                // cols += '<td class="hidden" id="WCSTDCOST_TD'+index+'">'+ $('#WCSTDCOST').val() +'</td>';
                cols += '<td class="hidden" id="IMAGEFILE_TD'+index+'">'+ $('#IMAGEFILE').val() +'</td>';
                cols += '<td class="hidden" id="STAFFCD_TD'+index+'">'+ $('#STAFFCD').val() +'</td>';
                cols += '<td class="hidden" id="STAFFNAME_TD'+index+'">'+ $('#STAFFNAME').val() +'</td>';
                cols += '<td class="hidden" id="INSSTAFFCD_TD'+index+'">'+ $('#STAFFCD').val() +'</td>';
                cols += '<td class="hidden" id="INSTIMESTAMP_TD'+index+'">'+ $('#TIMESTAMP').val() +'</td>';
                cols += '<td class="hidden" id="PROPSSLASTFLG_TD'+index+'">'+ $('#PROPSSLASTFLG').val() +'</td>';
                // cols += '<td class="hidden" id="OLDLINE_TD'+index+'">'+ $('#OLDLINE').val() +'</td>';
                // cols += '<td class="hidden" id="JOBPROTRANNO_TD'+index+'">'+ $('#JOBPROTRANNO').val() +'</td>';
                cols += '<td class="hidden" id="PROCOMPQTY_TD'+index+'">'+ $('#PROCOMPQTY').val() +'</td>';
                cols += '<td class="hidden" id="WORKTIMECD_TD'+index+'">'+ $('#WORKTIMECD').val() +'</td>';
           
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROORDERNO'+index+'" name="JOBPROORDERNOA[]" value=""></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROLN'+index+'" name="JOBPROLNA[]" value='+index+'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="PROPSSNO'+index+'" name="PROPSSNOA[]" value='+ $('#PROPSSNO').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROJOBTYPSTR'+index+'" name="JOBPROJOBTYPSTRA[]" value='+ $("#JOBPROJOBTYP option:selected").text() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROSTARTDT'+index+'" name="JOBPROSTARTDTA[]" value='+ slashFormatDate($('#JOBPROSTARTDT').val()) +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROSTARTTM'+index+'" name="JOBPROSTARTTMA[]" value='+ $('#JOBPROSTARTTM').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROENDTM'+index+'" name="JOBPROENDTMA[]" value='+ $('#JOBPROENDTM').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROCOMQTY'+index+'" name="JOBPROCOMQTYA[]" value='+ $('#JOBPROCOMQTY').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROJOBTYP'+index+'" name="JOBPROJOBTYPA[]" value='+ document.getElementById('JOBPROJOBTYP').value +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROENTRYDT'+index+'" name="JOBPROENTRYDTA[]" value='+ slashFormatDate($('#JOBPROENTRYDT').val()) +'></td>';      
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROPSSTYP'+index+'" name="JOBPROPSSTYPA[]" value='+ document.getElementById('JOBPROPSSTYP').value +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROPSSTYPSTR'+index+'" name="JOBPROPSSTYPSTRA[]" value='+ $("#JOBPROPSSTYP option:selected").text() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="LOCCD'+index+'" name="LOCCDA[]" value='+ $('#LOCCD').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="LOCNAME'+index+'" name="LOCNAMEA[]" value='+ $('#LOCNAME').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROREM'+index+'" name="JOBPROREMA[]" value='+ $('#JOBPROREM').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROHOUR'+index+'" name="JOBPROHOURA[]" value='+ $('#JOBPROHOUR').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROSTATUS'+index+'" name="JOBPROSTATUSA[]" value='+ document.getElementById('JOBPROSTATUS').value +'></td>';
                // cols += '<td class="hidden"><input class="form-control hide" id="WCCOST'+index+'" name="WCCOSTA[]" value='+ $('#WCCOST').val() +'></td>';
                // cols += '<td class="hidden"><input class="form-control hide" id="WCSTDCOST'+index+'" name="WCSTDCOSTA[]" value='+ $('#WCSTDCOST').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="JOBPROTIMETYPE'+index+'" name="JOBPROTIMETYPEA[]" value=""></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="IMAGEFILE'+index+'" name="IMAGEFILEA[]" value='+ $('#IMAGEFILE').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="STAFFCD'+index+'" name="STAFFCDA[]" value='+ $('#STAFFCD').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="STAFFNAME'+index+'" name="STAFFNAMEA[]" value='+ $('#STAFFNAME').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="INSSTAFFCD'+index+'" name="INSSTAFFCDA[]" value='+ $('#STAFFCD').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="INSTIMESTAMP'+index+'" name="INSTIMESTAMPA[]" value='+ $('#TIMESTAMP').val() +'></td>';
                // cols += '<td class="hidden"><input class="form-control hide" id="OLDCOMPQTY'+index+'" name="OLDCOMPQTYA[]" value='+ $('#OLDCOMPQTY').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="PROPSSLASTFLG'+index+'" name="PROPSSLASTFLGA[]" value='+ $('#PROPSSLASTFLG').val() +'></td>';
                // cols += '<td class="hidden"><input class="form-control hide" id="OLDLINE'+index+'" name="OLDLINEA[]" value='+ $('#OLDLINE').val() +'></td>';
                // cols += '<td class="hidden"><input class="form-control hide" id="JOBPROTRANNO'+index+'" name="JOBPROTRANNOA[]" value='+ $('#JOBPROTRANNO').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="PROCOMPQTY'+index+'" name="PROCOMPQTYA[]" value='+ $('#PROCOMPQTY').val() +'></td>';
                cols += '<td class="hidden"><input class="form-control hide" id="WORKTIMECD'+index+'" name="WORKTIMECDA[]" value='+ $('#WORKTIMECD').val() +'></td>';

                if(index <= maxrowA) {
                    $('#rowPrdId'+index+'').empty();
                    $('#rowPrdId'+index+'').removeAttr('class', 'row-empty');
                    $('#rowPrdId'+index+'').append(cols);
                } else {
                    newRow.append(cols);
                    $("#tableProduct tbody").append(newRow);
                }
                $('#procount').html(index);
                await updateTmpScrap();
                clearScrapTable();
                return entry();
            } else {
                return alertValidation();
            }
        });

        UPDATE.click(async function() {
            let rowno = $('#ROWNO').val();
            if(rowno != '') {

                $('#PROPSSNO_TD'+rowno+'').html($('#PROPSSNO').val());
                $('#JOBPROJOBTYPSTR_TD'+rowno+'').html($("#JOBPROJOBTYP option:selected").text());
                $('#JOBPROSTARTDT_TD'+rowno+'').html(slashFormatDate($('#JOBPROSTARTDT').val()));
                $('#JOBPROSTARTTM_TD'+rowno+'').html($('#JOBPROSTARTTM').val());
                $('#JOBPROENDTM_TD'+rowno+'').html($('#JOBPROENDTM').val());
                $('#JOBPROCOMQTY_TD'+rowno+'').html($('#JOBPROCOMQTY').val());
                $('#JOBPROJOBTYP_TD'+rowno+'').html(document.getElementById('JOBPROJOBTYP').value);
                $('#JOBPROENTRYDT_TD'+rowno+'').html(slashFormatDate($('#JOBPROENTRYDT').val()));
                $('#JOBPROPSSTYP_TD'+rowno+'').html(document.getElementById('JOBPROPSSTYP').value);
                $('#JOBPROPSSTYPSTR_TD'+rowno+'').html($("#JOBPROPSSTYP option:selected").text());
                $('#LOCCD_TD'+rowno+'').html($('#LOCCD').val());
                $('#LOCNAME_TD'+rowno+'').html($('#LOCNAME').val());
                $('#JOBPROREM_TD'+rowno+'').html($('#JOBPROREM').val());
                $('#JOBPROHOUR_TD'+rowno+'').html($('#JOBPROHOUR').val());
                // $('#JOBPROTIMETYPE_TD'+rowno+'').html('');
                $('#JOBPROSTATUS_TD'+rowno+'').html(document.getElementById('JOBPROSTATUS').value);
                $('#IMAGEFILE_TD'+rowno+'').html($('#IMAGEFILE').val());
                $('#STAFFCD_TD'+rowno+'').html($('#STAFFCD').val());
                $('#STAFFNAME_TD'+rowno+'').html($('#STAFFNAME').val());
                $('#INSSTAFFCD_TD'+rowno+'').html($('#STAFFCD').val());
                $('#INSTIMESTAMP_TD'+rowno+'').html($('#TIMESTAMP').val());
                $('#PROPSSLASTFLG_TD'+rowno+'').html($('#PROPSSLASTFLG').val());
                $('#PPROCOMPQTY_TD'+rowno+'').html($('#PPROCOMPQTY').val());
                $('#WORKTIMECD_TD'+rowno+'').html($('#WORKTIMECD').val());

                $('#PROPSSNO'+rowno+'').val($('#PROPSSNO').val());
                $('#JOBPROJOBTYPSTR'+rowno+'').val($("#JOBPROJOBTYP option:selected").text());
                $('#JOBPROSTARTDT'+rowno+'').val(slashFormatDate($('#JOBPROSTARTDT').val()));
                $('#JOBPROSTARTTM'+rowno+'').val($('#JOBPROSTARTTM').val().replace(':', '') + '00');
                $('#JOBPROENDTM'+rowno+'').val($('#JOBPROENDTM').val().replace(':', '') + '00');
                $('#JOBPROCOMQTY'+rowno+'').val($('#JOBPROCOMQTY').val());
                $('#JOBPROJOBTYP'+rowno+'').val(document.getElementById('JOBPROJOBTYP').value);
                $('#JOBPROENTRYDT'+rowno+'').val(slashFormatDate($('#JOBPROENTRYDT').val()).replaceAll('/', ''));
                $('#JOBPROPSSTYP'+rowno+'').val(document.getElementById('JOBPROPSSTYP').value);
                $('#JOBPROPSSTYPSTR'+rowno+'').val($("#JOBPROPSSTYP option:selected").text());
                $('#LOCCD'+rowno+'').val($('#LOCCD').val());
                $('#LOCNAME'+rowno+'').val($('#LOCNAME').val());
                $('#JOBPROREM'+rowno+'').val($('#JOBPROREM').val());
                $('#JOBPROHOUR'+rowno+'').val($('#JOBPROHOUR').val());
                // $('#JOBPROTIMETYPE'+rowno+'').val('');
                $('#JOBPROSTATUS'+rowno+'').val(document.getElementById('JOBPROSTATUS').value);
                $('#IMAGEFILE'+rowno+'').val($('#IMAGEFILE').val());
                $('#STAFFCD'+rowno+'').val($('#STAFFCD').val());
                $('#STAFFNAME'+rowno+'').val($('#STAFFNAME').val());
                $('#INSTIMESTAMP'+rowno+'').val($('#TIMESTAMP').val());
                $('#PROPSSLASTFLG'+rowno+'').val($('#PROPSSLASTFLG').val());
                $('#PROCOMPQTY'+rowno+'').val($('#PROCOMPQTY').val());
                $('#WORKTIMECD'+rowno+'').val($('#WORKTIMECD').val());

                await updateTmpScrap();
                clearScrapTable();
                return entry();
            }
        });

        DEL.click(function() {
            let id = $('#ROWNO').val();
            // console.log(id);
            if(id == '')
                return false;
            document.getElementById('tableProduct').deleteRow(id);
            $('#rowPrdId'+id).closest('tr').remove();
            index--;
            $('.proRow-id').each(function (i) {
                $(this).text(i+1);
            }); 
            $('#procount').html(index);

            changeproRowId();
            unsetJobItemData(id);
            id = null;
            clearScrapTable();
            deleteTmpScrap();
            return entry();
        });

        var idx = '';

        // $('table#tableScrap tr').click(function () {
        $(document).on('click', '.scrap_table tbody tr', function(event) {
            $('table#tableScrap tbody tr').not(this).removeClass('selected');
            let items = $(this).closest('tr').children('td');
            if(items.eq(0).text() != 'undefined' && items.eq(0).text() != '') {
                idx = items.eq(0).text();
                let scrapTb = document.getElementById('tableScrap');
                scrapTb.length;
                if(idx != '') { 
                    scrapTb.rows[idx].classList.toggle('selected');
                }
            }
        });

        var key = 0;
        var key = '<?php echo (isset($data['DVWSCRAP']) ? count($data['DVWSCRAP']) : 0); ?>';

        ADDROW.click(async function() {
            // let table = document.getElementsByClassName('scrapRow-id');
            // let totalRowCount = table.length;
            let totalRowCount =  $('.scrapRow-id').length || 0;
            key = totalRowCount;
            key ++;  // key += 1;
            // console.log(key);
            var newRows = $('<tr class="divide-y divide-gray-200 scrapRow" id="rowId'+key+'">');                      
            var colsc = '';

            colsc += '<td class="hidden scrapRow-id" id="ROWNO2_TD'+key+'">'+key+'</td>'; 
            colsc += '<td class="h-6 w-7/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">' + 
                        '<select class="text-control text-[12px] shadow-md border px-3 h-6 w-full text-left rounded-xl border-gray-300"' + 
                        'id="PROSCRAPTYP'+key+'" name="PROSCRAPTYP[]">' +
                        '<option value=""></option><?php foreach ($badcode as $key => $item) { ?><option value="<?=$key ?>"><?=$item ?></option><?php } ?></select></td>';
            colsc += '<td class="h-6 w-5/12 pr-1 text-sm border border-slate-700 text-right">' + 
                        '<input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" ' + 
                        ' id="PROSCRAPQTY'+key+'" name="PROSCRAPQTY[]" onchange="this.value = num2digit(this.value);" '+
                        'oninput="this.value = stringReplacez(this.value);"/></td></tr>';
            // console.log(key);
            if(key <= maxrowB) {
                $('#rowId'+key+'').empty();
                $('#rowId'+key+'').removeAttr('class', 'row-empty');
                $('#rowId'+key+'').append(colsc);
            } else {
                newRows.append(colsc);
                $('#tableScrap tbody').append(newRows);
            }
            $('#scrapcount').html(key);
        });

        DELROW.click(function() {
            if(idx == '')
                return false;
            document.getElementById('tableScrap').deleteRow(idx);
            // console.log(idx);
            if(idx != null) {
                $('#rowId'+idx).closest('tr').remove();
                 // console.log(key);
                if(key <= maxrowB) {
                    emptyRow(key);
                }
                key--;
                // console.log(key);
                $('.scrapRow-id').each(function (i) {
                    $(this).text(i+1);
                }); 
                $('#scrapcount').html(key);
                changeScrapRowId();
                unsetScrapItemData(idx);
                idx = null;
            }
        });
    });

    function generateScrap(scrap) {
        // clearScrapTable();
        $('#loading').hide();
        // console.log(scrap);
        let rowCount = 0;
        const details = document.querySelector('details');
        if (!details.open) { maxrow = 10; } else { maxrow = 5; }
        $.each(scrap, function(key, value) {
            // console.log(value.PROSCRAPQTY);
            var newRows = $('<tr class="divide-y divide-gray-200 scrapRow" id=rowId'+key+'>');                      
            var colsc = '';
            colsc += '<td class="hidden scrapRow-id" id="ROW_TD'+key+'">'+key+'</td>'; 
            colsc += '<td class="h-6 w-7/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">' + 
                        '<select class="text-control text-sm shadow-md border px-3 h-6 w-full text-left text-[12px] rounded-xl border-gray-300"' + 
                        'id="PROSCRAPTYP'+key+'" name="PROSCRAPTYP[]">' +
                        '<option value=""></option><?php foreach ($badcode as $key => $item) { ?><option value="<?=$key ?>"><?=$item ?></option><?php } ?></select></td>';
            colsc += '<td class="h-6 w-5/12 pr-1 text-sm border border-slate-700 text-right">' + 
                        '<input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" ' + 
                        ' id="PROSCRAPQTY'+key+'" name="PROSCRAPQTY[]" value="'+value.PROSCRAPQTY+'" onchange="this.value = num2digit(this.value);" '+
                        'oninput="this.value = stringReplacez(this.value);"/></td>';

            if(key <= maxrow) {
                $('#rowId'+key+'').empty();
                $('#rowId'+key+'').append(colsc);
            } else {
                newRows.append(cols);
                $('#tableScrap tbody').append(newRows);
            }
            document.getElementById('PROSCRAPTYP'+key+'').value = value.PROSCRAPTYP;
            rowCount++;
        });
        $('#scrapcount').html(rowCount);
    }

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);

        if(code =='PROPSSNO') {
            return getJobDetail(result);
        } else {
            return getSearch(code, result);    
        }
    }

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }
</script>