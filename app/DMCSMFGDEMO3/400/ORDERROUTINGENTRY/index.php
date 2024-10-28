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
            <form class="w-full" method="POST" id="orderRoutingEntry" name="orderRoutingEntry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1 px-2">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="PRODUCTIONORDER_TXT"><?=checklang('PRODUCTIONORDER')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                                    id="PROORDERNO" name="PROORDERNO" value="<?=isset($data['PROORDERNO']) ? $data['PROORDERNO']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPRODUCTIONORDER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="w-2/12"></div>
                                        <button type="button"class="btn text-color items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 mx-3 py-1 text-center hidden"
                                                    id="REMAKE" name="REMAKE"><?=checklang('REMAKE')?></button>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('START_DATE_PRODUCE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                id="PROPLANSTARTDT" name="PROPLANSTARTDT" value="<?=!empty($data['PROPLANSTARTDT']) ? date('Y-m-d', strtotime($data['PROPLANSTARTDT'])) : ''; ?>"/>
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('PROD_DUEDATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                id="PROPLANENDDT" name="PROPLANENDDT" value="<?=!empty($data['PROPLANENDDT']) ? date('Y-m-d', strtotime($data['PROPLANENDDT'])) : ''; ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 hidden" id="PROPATTERN"><?=checklang('PROPATTERN')?></label>
                                        <div class="relative w-4/12 mr-1 hidden" id="ITEMPROPTNCODE">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                    name="ITEMPROPTNCD" id="ITEMPROPTNCD" value="<?=isset($data['ITEMPROPTNCD']) ? $data['ITEMPROPTNCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="PROCESSPATTERNGUIDE">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="hidden text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                                id="PROPTNNAME" name="PROPTNNAME" value="<?=isset($data['PROPTNNAME']) ? $data['PROPTNNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12"></div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                                name="ITEMCD" id="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                            id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                            id="ITEMDRAWNO" name="ITEMDRAWNO" value="<?=isset($data['ITEMDRAWNO']) ? $data['ITEMDRAWNO']: ''; ?>" readonly/>
                                    </div>
                                </div>


                                <div class="flex mb-1 px-2">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="WC_CODE_TXT"><?=checklang('WC_CODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                                name="WCCD" id="WCCD" value="<?=isset($data['WCCD']) ? $data['WCCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                                id="WCNAME" name="WCNAME" value="<?=isset($data['WCNAME']) ? $data['WCNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="WC_CODE_TXT"><?=checklang('ORDER_QTY_PRO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="PROQTY" name="PROQTY" value="<?=!empty($data['PROQTY']) ? number_format(str_replace(',', '',$data['PROQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-sm shadow-md border px-3 h-7 w-2/12 mr-1 text-left text-[12px] rounded-xl border-gray-300 read"
                                                id="ITEMUNITTYP" name="ITEMUNITTYP" readonly>
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="flex w-4/12 justify-end">
                                            <input type="hidden" id="SYSVIS_REMAKE" name="SYSVIS_REMAKE" value="<?=isset($data['SYSVIS_REMAKE']) ? $data['SYSVIS_REMAKE']: 'F'?>" readonly/>
                                            <input type="hidden" id="SYSVIS_PROPATTERNLBL" name="SYSVIS_PROPATTERNLBL" value="<?=isset($data['SYSVIS_PROPATTERNLBL']) ? $data['SYSVIS_PROPATTERNLBL']: 'F'?>" readonly/>
                                            <input type="hidden" id="SYSVIS_ITEMPROPTNCD" name="SYSVIS_ITEMPROPTNCD" value="<?=isset($data['SYSVIS_ITEMPROPTNCD']) ? $data['SYSVIS_ITEMPROPTNCD']: 'F'?>" readonly/>
                                            <input type="hidden" id="SYSVIS_PROPTNNAME" name="SYSVIS_PROPTNNAME" value="<?=isset($data['SYSVIS_PROPTNNAME']) ? $data['SYSVIS_PROPTNNAME']: 'F'?>" readonly/>
                                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
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
   
                <!-- Table -->
                <div id="table-area" class="overflow-scroll px-2 block h-[330px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 ppe" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ROUT_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOB_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WC_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WORK_CENTER_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOBCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOBNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PLANEDQTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOB_HOUR')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('NEXT_TYPE')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 csv" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD<?=$key?>"><?=$key?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="PROPSSNO_TD<?=$key?>"><?=isset($value['PROPSSNO']) ? $value['PROPSSNO']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="PROPSSTYP_TD<?=$key?>"><?=isset($value['PROPSSTYP']) && $value['PROPSSTYP'] != ''? $JOBTYPE[$value['PROPSSTYP']]: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMPLACECD_TD<?=$key?>"><?=isset($value['ITEMPLACECD']) ? $value['ITEMPLACECD']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMPLACENAME_TD<?=$key?>"><?=isset($value['ITEMPLACENAME']) ? $value['ITEMPLACENAME']:'' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="PROPSSJOBTYP_TD<?=$key?>"><?=isset($value['PROPSSJOBTYP']) ? $value['PROPSSJOBTYP']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="JOB_NAME_TD<?=$key?>"><?=isset($value['JOB_NAME']) ? $value['JOB_NAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="PROPSSQTY_TD<?=$key?>"><?=isset($value['PROPSSQTY']) ? $value['PROPSSQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="PROPSSPLANTIME_TD<?=$key?>"><?=isset($value['PROPSSPLANTIME']) ? $value['PROPSSPLANTIME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="PROPSSUNITTYP_TD<?=$key?>">
                                        <?=isset($value['PROPSSUNITTYP']) && $value['PROPSSUNITTYP'] != '' ? $JOBUNIT[$value['PROPSSUNITTYP']]: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left" id="PROPSSLINKTYP_TD<?=$key?>"><?=isset($value['PROPSSLINKTYP']) ? $value['PROPSSLINKTYP']: '' ?></td>
                                    
                                    <input type="hidden" id="ROWNO<?=$key?>" name="ROWNOZ[]" value="<?=$key?>">
                                    <input type="hidden" id="PROPSSNO<?=$key?>" name="PROPSSNOZ[]" value="<?=isset($value['PROPSSNO']) ? $value['PROPSSNO']: '' ?>">
                                    <input type="hidden" id="PROPSSTYPSTR<?=$key?>" name="PROPSSTYPSTRZ[]" value="<?=isset($value['PROPSSTYPSTR']) ? $value['PROPSSTYPSTR']: '' ?>">
                                    <input type="hidden" id="ITEMPLACECD<?=$key?>" name="ITEMPLACECDZ[]" value="<?=isset($value['ITEMPLACECD']) ? $value['ITEMPLACECD']: '' ?>">
                                    <input type="hidden" id="ITEMPLACENAME<?=$key?>" name="ITEMPLACENAMEZ[]" value="<?=isset($value['ITEMPLACENAME']) ? $value['ITEMPLACENAME']: '' ?>">
                                    <input type="hidden" id="PROPSSJOBTYP<?=$key?>" name="PROPSSJOBTYPZ[]" value="<?=isset($value['PROPSSJOBTYP']) ? $value['PROPSSJOBTYP']: '' ?>">
                                    <input type="hidden" id="PROPSSJOBTYPSTR<?=$key?>" name="PROPSSJOBTYPSTRZ[]" value="<?=isset($value['PROPSSJOBTYPSTR']) ? $value['PROPSSJOBTYPSTR']: '' ?>">
                                    <input type="hidden" id="PROPSSQTY<?=$key?>" name="PROPSSQTYZ[]" value="<?=isset($value['PROPSSQTY']) ? $value['PROPSSQTY']: '' ?>">
                                    <input type="hidden" id="PROPSSPLANTIME<?=$key?>" name="PROPSSPLANTIMEZ[]" value="<?=isset($value['PROPSSPLANTIME']) ? $value['PROPSSPLANTIME']: '' ?>">
                                    <input type="hidden" id="PROPSSUNITTYP<?=$key?>" name="PROPSSUNITTYPZ[]" value="<?=isset($value['PROPSSUNITTYP']) ? $value['PROPSSUNITTYP']: '' ?>">
                                    <input type="hidden" id="PROPSSUNITTYPSTR<?=$key?>" name="PROPSSUNITTYPSTRZ[]" value="<?=isset($value['PROPSSUNITTYPSTR']) ? $value['PROPSSUNITTYPSTR']: '' ?>">
                                    <input type="hidden" id="PROPSSLINKTYP<?=$key?>" name="PROPSSLINKTYPZ[]" value="<?=isset($value['PROPSSLINKTYP']) ? $value['PROPSSLINKTYP']: '' ?>">
                                    <input type="hidden" id="PROPSSLINKTYPSTR<?=$key?>" name="PROPSSLINKTYPSTRZ[]" value="<?=isset($value['PROPSSLINKTYPSTR']) ? $value['PROPSSLINKTYPSTR']: '' ?>">
                                    <input type="hidden" id="PROPSSTYP<?=$key?>" name="PROPSSTYPZ[]" value="<?=isset($value['PROPSSTYP']) ? $value['PROPSSTYP']: '' ?>">
                                    <input type="hidden" id="PROPSSFIXFLG<?=$key?>" name="PROPSSFIXFLGZ[]" value="<?=isset($value['PROPSSFIXFLG']) ? $value['PROPSSFIXFLG']: '' ?>">
                                    <input type="hidden" id="PROPSSPLANSTARTDT<?=$key?>" name="PROPSSPLANSTARTDTZ[]" value="<?=isset($value['PROPSSPLANSTARTDT']) ? $value['PROPSSPLANSTARTDT']: '' ?>">
                                    <input type="hidden" id="PROPSSPLANENDDT<?=$key?>" name="PROPSSPLANENDDTZ[]" value="<?=isset($value['PROPSSPLANENDDT']) ? $value['PROPSSPLANENDDT']: '' ?>">
                                    <input type="hidden" id="PROPSSPLANSTARTTM<?=$key?>" name="PROPSSPLANSTARTTMZ[]" value="<?=isset($value['PROPSSPLANSTARTTM']) ? $value['PROPSSPLANSTARTTM']: '' ?>">
                                    <input type="hidden" id="PROPSSPLANENDTM<?=$key?>" name="PROPSSPLANENDTMZ[]" value="<?=isset($value['PROPSSPLANENDTM']) ? $value['PROPSSPLANENDTM']: '' ?>">
                                    <input type="hidden" id="PROPSSSTARTDT<?=$key?>" name="PROPSSSTARTDTZ[]" value="<?=isset($value['PROPSSSTARTDT']) ? $value['PROPSSSTARTDT']: '' ?>">
                                    <input type="hidden" id="PROPSSENDDT<?=$key?>" name="PROPSSENDDTZ[]" value="<?=isset($value['PROPSSENDDT']) ? $value['PROPSSENDDT']: '' ?>">
                                    <input type="hidden" id="PROPSSSTARTTM<?=$key?>" name="PROPSSSTARTTMZ[]" value="<?=isset($value['PROPSSSTARTTM']) ? $value['PROPSSSTARTTM']: '' ?>">
                                    <input type="hidden" id="PROPSSENDTM<?=$key?>" name="PROPSSENDTMZ[]" value="<?=isset($value['PROPSSENDTM']) ? $value['PROPSSENDTM']: '' ?>">
                                    <input type="hidden" id="PROPSSCOMPQTY<?=$key?>" name="PROPSSCOMPQTYZ[]" value="<?=isset($value['PROPSSCOMPQTY']) ? $value['PROPSSCOMPQTY']: '' ?>">
                                    <input type="hidden" id="PROPSSALLOWANCE<?=$key?>" name="PROPSSALLOWANCEZ[]" value="<?=isset($value['PROPSSALLOWANCE']) ? $value['PROPSSALLOWANCE']: '' ?>">
                                    <input type="hidden" id="PROPSSPLANDT<?=$key?>" name="PROPSSPLANDTZ[]" value="<?=isset($value['PROPSSPLANDT']) ? $value['PROPSSPLANDT']: '' ?>">
                                    <input type="hidden" id="PROPSSREM<?=$key?>" name="PROPSSREMZ[]" value="<?=isset($value['PROPSSREM']) ? $value['PROPSSREM']: '' ?>">
                                    <input type="hidden" id="PROPSSDURATION<?=$key?>" name="PROPSSDURATIONZ[]" value="<?=isset($value['PROPSSDURATION']) ? $value['PROPSSDURATION']: '' ?>">
                                    <input type="hidden" id="PROPSSSTATUS<?=$key?>" name="PROPSSSTATUSZ[]" value="<?=isset($value['PROPSSSTATUS']) ? $value['PROPSSSTATUS']: '' ?>">
                                    <input type="hidden" id="PROPSSSTATUSSTR<?=$key?>" name="PROPSSSTATUSSTRZ[]" value="<?=isset($value['PROPSSSTATUSSTR']) ? $value['PROPSSSTATUSSTR']: '' ?>">
                                    <input type="hidden" id="JOB_NAME<?=$key?>" name="JOB_NAMEZ[]" value="<?=isset($value['JOB_NAME']) ? $value['JOB_NAME']: '' ?>">
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
                            </tr> <?php
                        } ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex pt-2 px-2">
                    <div class="flex w-full">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold flex">
                                    <div class="flex w-7/12 px-1">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                                        id="OK" name="OK" <?php if(!empty($data['SYSPVL']['SYSVIS_INSERT']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                                        <?php if(!empty($data['SYSPVL']['SYSVIS_INS']) && $data['SYSPVL']['SYSVIS_INS'] != 'T') { ?> disabled <?php } ?>><?=checklang('OK'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']['SYSVIS_UPDATE']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                                        <?php if(!empty($data['SYSPVL']['SYSVIS_UPD']) && $data['SYSPVL']['SYSVIS_UPD'] != 'T') { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']['SYSVIS_DELETE']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                                        <?php if(!empty($data['SYSPVL']['SYSVIS_DEL']) && $data['SYSPVL']['SYSVIS_DEL'] != 'T') { ?> disabled <?php } ?>><?=checklang('DELETE'); ?></button>
                                    </div>
                                    <div class="flex w-5/12 px-1 justify-end">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center"
                                            id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                                    </div>
                                </summary>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ROUT_NO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center req"
                                                id="PROPSSNO" name="PROPSSNO" value="<?=isset($data['PROPSSNO']) ? $data['PROPSSNO']: ''; ?>" onchange="unRequired();"/>
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('JOB_TYPE')?></label>
                                        <select class="text-control text-sm shadow-md border px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 req" id="PROPSSTYP" name="PROPSSTYP" onchange="unRequired();">
                                            <option value=""></option>
                                            <?php foreach ($JOBTYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['PROPSSTYP']) && $data['PROPSSTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <input class="hidden" type="hidden" id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSDURATION" name="PROPSSDURATION" value="<?=isset($data['PROPSSDURATION']) ? $data['PROPSSDURATION']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSSTARTDT" name="PROPSSSTARTDT" value="<?=isset($data['PROPSSSTARTDT']) ? $data['PROPSSSTARTDT']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSENDDT" name="PROPSSENDDT" value="<?=isset($data['PROPSSENDDT']) ? $data['PROPSSENDDT']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSSTARTTM" name="PROPSSSTARTTM" value="<?=isset($data['PROPSSSTARTTM']) ? $data['PROPSSSTARTTM']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSENDTM" name="PROPSSENDTM" value="<?=isset($data['PROPSSENDTM']) ? $data['PROPSSENDTM']: '0.00'; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSCOMPQTY" name="PROPSSCOMPQTY" value="<?=isset($data['PROPSSCOMPQTY']) ? $data['PROPSSCOMPQTY']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSPLANDT" name="PROPSSPLANDT" value="<?=isset($data['PROPSSPLANDT']) ? $data['PROPSSPLANDT']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSSTATUS" name="PROPSSSTATUS" value="<?=isset($data['PROPSSSTATUS']) ? $data['PROPSSSTATUS']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSTYPSTR" name="PROPSSTYPSTR" value="<?=isset($data['PROPSSTYPSTR']) ? $data['PROPSSTYPSTR']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSSTATUSSTR" name="PROPSSSTATUSSTR" value="<?=isset($data['PROPSSSTATUSSTR']) ? $data['PROPSSSTATUSSTR']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="PROPSSJOBTYPSTR" name="PROPSSJOBTYPSTR" value="<?=isset($data['PROPSSJOBTYPSTR']) ? $data['PROPSSJOBTYPSTR']: ''; ?>" />
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PLAN_START_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="PROPSSPLANSTARTDT" name="PROPSSPLANSTARTDT" value="<?=!empty($data['PROPSSPLANSTARTDT']) ? date('Y-m-d', strtotime($data['PROPSSPLANSTARTDT'])) : ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('START_TIME')?></label>
                                        <input type="time" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="PROPSSPLANSTARTTM" name="PROPSSPLANSTARTTM" value="<?=!empty($data['PROPSSPLANSTARTTM']) ? $data['PROPSSPLANSTARTTM']: '00:01'; ?>" />
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('WC_CODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                                    id="ITEMPLACECD" name="ITEMPLACECD" value="<?=isset($data['ITEMPLACECD']) ? $data['ITEMPLACECD']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEMPLACE">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMPLACENAME" name="ITEMPLACENAME" value="<?=isset($data['ITEMPLACENAME']) ? $data['ITEMPLACENAME']: ''; ?>" readonly/>     
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PLAN_END_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="PROPSSPLANENDDT" name="PROPSSPLANENDDT" value="<?=!empty($data['PROPSSPLANENDDT']) ? date('Y-m-d', strtotime($data['PROPSSPLANENDDT'])) : ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('FINISH_TIME')?></label>
                                        <input type="time" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 text-center"
                                                id="PROPSSPLANENDTM" name="PROPSSPLANENDTM" value="<?=!empty($data['PROPSSPLANENDTM']) ? $data['PROPSSPLANENDTM']: '00:00'; ?>" />
                                        <input type="hidden" name="PROPSSFIXFLG" value="F" />
                                        <input type="checkbox" id="PROPSSFIXFLG" name="PROPSSFIXFLG" value="T" <?=(isset($data['PROPSSFIXFLG']) && $data['PROPSSFIXFLG'] == 'T') ? 'checked' : '' ?>/>
                                        <label class="text-color block text-sm pl-2 pt-1"><?=checklang('DETAILFIX'); ?></label>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('JOBCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                                    id="PROPSSJOBTYP" name="PROPSSJOBTYP" value="<?=isset($data['PROPSSJOBTYP']) ? $data['PROPSSJOBTYP']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHJOBCODE">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="JOB_NAME" name="JOB_NAME" value="<?=isset($data['JOB_NAME']) ? $data['JOB_NAME']: ''; ?>" readonly/>       
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('NEXT_TYPE')?></label>
                                        <select class="text-control text-sm shadow-md border px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300" id="PROPSSLINKTYP" name="PROPSSLINKTYP">
                                            <option value=""></option>
                                            <?php foreach ($JOBLINKTYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['PROPSSLINKTYP']) && $data['PROPSSLINKTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('PLANEDQTY')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right req"
                                                id="PROPSSQTY" name="PROPSSQTY" value="<?=!empty($data['PROPSSQTY']) ?  number_format(str_replace(',', '',$data['PROPSSQTY']), 2): ''; ?>"
                                                onchange="this.value = num2digit(this.value); unRequired();" oninput="this.value = stringReplacez(this.value);"/>
                                        <select class="text-control text-sm shadow-md border px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 read">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('JOB_HOUR')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right"
                                                id="PROPSSPLANTIME" name="PROPSSPLANTIME" value="<?=!empty($data['PROPSSPLANTIME']) ? number_format(str_replace(',', '',$data['PROPSSPLANTIME']), 2): ''; ?>"
                                                onchange="this.value = num2digit(this.value); unRequired();" oninput="this.value = stringReplacez(this.value);"/>
                                        <select class="text-control text-sm shadow-md border px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300" id="PROPSSUNITTYP" name="PROPSSUNITTYP" onchange="unRequired();">
                                            <option value=""></option>
                                            <?php foreach ($JOBUNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['PROPSSUNITTYP']) && $data['PROPSSUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ALLOWANCE')?></label>
                                        <input type="number" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right"
                                                id="PROPSSALLOWANCE" name="PROPSSALLOWANCE" value="<?=isset($data['PROPSSALLOWANCE']) ? $data['PROPSSALLOWANCE']: ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('MINUTES')?></label>
                                    </div>
                                </div>   

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('REMARK')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-10/12 py-2 px-3 text-gray-700 border-gray-300 mr-2"
                                                id="PROPSSREM" name="PROPSSREM" value="<?=isset($data['PROPSSREM']) ? $data['PROPSSREM']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-1"></div>
                                </div>   
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-1 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1');?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
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

        let SYSVIS_REMAKE = document.getElementById('SYSVIS_REMAKE').value;
        // let SYSVIS_PROPATTERNLBL = document.getElementById('SYSVIS_PROPATTERNLBL').value;
        // let SYSVIS_ITEMPROPTNCD = document.getElementById('SYSVIS_ITEMPROPTNCD').value;
        // let SYSVIS_PROPTNNAME = document.getElementById('SYSVIS_PROPTNNAME').value;
        // console.log(SYSVIS_REMAKE);
        document.getElementById('REMAKE').classList[SYSVIS_REMAKE == 'T' ? 'remove' : 'add']('hidden');
        // document.getElementById('PROPATTERN').classList[SYSVIS_PROPATTERNLBL == 'T' ? 'remove' : 'add']('hidden');
        // document.getElementById('ITEMPROPTNCODE').classList[SYSVIS_ITEMPROPTNCD == 'T' ? 'remove' : 'add']('hidden');
        // document.getElementById('PROPTNNAME').classList[SYSVIS_PROPTNNAME == 'T' ? 'remove' : 'add']('hidden');

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 12); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[330px]');
                tablearea.classList.remove('h-[450px]');
                maxrow = 17;
            } else {
                tablearea.classList.remove('h-[450px]');
                tablearea.classList.add('h-[330px]');
                maxrow = 12;
            }
            emptyRows(maxrow);
        });
        
        var index = 0;
        var index = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        OK.click(function() {
            if($('#PROORDERNO').val() == '' ) { validationDialog(); return false; }

            if ($('#PROPSSNO').val() === '' || $('#ITEMPLACECD').val() === '' || $('#PROPSSJOBTYP').val() === '' || $('#PROPSSTYP').val() === '' || $('#PROPSSQTY').val() === '' || $('#PROPSSPLANTIME').val() === '' || $('#PROPSSUNITTYP').val() === '') {
                validationDialog();
                return false;
            }
            index ++;  // index += 1; 
            var newRow = $('<tr class="divide-y divide-gray-200 csv" id=rowId'+index+'></tr>');
            var cols = '';

            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD' + index + '">' + index + '</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="PROPSSNO_TD' + index + '">' + $('#PROPSSNO').val() + '</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="PROPSSTYP_TD' + index + '">' + $('#PROPSSTYP option:selected').text()+'</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMPLACECD_TD' + index + '">' + $('#ITEMPLACECD').val() + '</td>';
            cols += '<td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMPLACENAME_TD' + index + '">' + $('#ITEMPLACENAME').val() + '</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="PROPSSJOBTYP_TD' + index + '">' + $('#PROPSSJOBTYP').val() + '</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="JOB_NAME_TD' + index + '">' + $('#JOB_NAME').val() + '</td>';
            cols += '<td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="PROPSSQTY_TD' + index + '">' + $('#PROPSSQTY').val() + '</td>';
            cols += '<td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="PROPSSPLANTIME_TD' + index + '">' + $('#PROPSSPLANTIME').val() + '</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="PROPSSUNITTYP_TD' + index + '">' + $('#PROPSSUNITTYP option:selected').text()+'</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="PROPSSLINKTYP_TD' + index + '">' + $('#PROPSSLINKTYP option:selected').text()+'</td>';

            cols += '<input type="hidden" id="ROWNO'+index+'" name="ROWNOZ[]" value="'+index+'">';
            cols += '<input type="hidden" id="PROPSSNO'+index+'" name="PROPSSNOZ[]" value="'+ $('#PROPSSNO').val() +'">';
            cols += '<input type="hidden" id="PROPSSTYPSTR'+index+'" name="PROPSSTYPSTRZ[]" value="'+ $('#PROPSSTYP option:selected').text() +'">';
            cols += '<input type="hidden" id="ITEMPLACECD'+index+'" name="ITEMPLACECDZ[]" value="'+ $('#ITEMPLACECD').val() +'">';
            cols += '<input type="hidden" id="ITEMPLACENAME'+index+'" name="ITEMPLACENAMEZ[]" value="'+ $('#ITEMPLACENAME').val() +'">';
            cols += '<input type="hidden" id="PROPSSJOBTYP'+index+'" name="PROPSSJOBTYPZ[]" value="'+ $('#PROPSSJOBTYP').val() +'">';
            cols += '<input type="hidden" id="PROPSSJOBTYPSTR'+index+'" name="PROPSSJOBTYPSTRZ[]" value="'+ $('#PROPSSJOBTYP').val() +'">';
            cols += '<input type="hidden" id="PROPSSQTY'+index+'" name="PROPSSQTYZ[]" value="'+ $('#PROPSSQTY').val() +'">';
            cols += '<input type="hidden" id="PROPSSPLANTIME'+index+'" name="PROPSSPLANTIMEZ[]" value="'+ $('#PROPSSPLANTIME').val() +'">';
            cols += '<input type="hidden" id="PROPSSTYP'+index+'" name="PROPSSTYPZ[]" value="'+ $('#PROPSSTYP').val() +'">';
            cols += '<input type="hidden" id="PROPSSUNITTYP'+index+'" name="PROPSSUNITTYPZ[]" value="'+ document.getElementById('PROPSSUNITTYP').value +'">';
            cols += '<input type="hidden" id="PROPSSUNITTYPSTR'+index+'" name="PROPSSUNITTYPSTRZ[]" value="'+ $("#PROPSSUNITTYP option:selected").text() +'">';
            cols += '<input type="hidden" id="PROPSSLINKTYP'+index+'" name="PROPSSLINKTYPZ[]" value="'+ document.getElementById('PROPSSLINKTYP').value +'">';
            cols += '<input type="hidden" id="PROPSSLINKTYPSTR'+index+'" name="PROPSSLINKTYPSTRZ[]" value="'+  $("#PROPSSLINKTYP option:selected").text() +'">';
            cols += '<input type="hidden" id="PROPSSPLANSTARTDT'+index+'" name="PROPSSPLANSTARTDTZ[]" value="'+ $('#PROPSSPLANSTARTDT').val() +'">';
            cols += '<input type="hidden" id="PROPSSPLANENDDT'+index+'" name="PROPSSPLANENDDTZ[]" value="'+ $('#PROPSSPLANENDDT').val() +'">';
            cols += '<input type="hidden" id="PROPSSPLANSTARTTM'+index+'" name="PROPSSPLANSTARTTMZ[]" value="'+ $('#PROPSSPLANSTARTTM').val() +'">';
            cols += '<input type="hidden" id="PROPSSPLANENDTM'+index+'" name="PROPSSPLANENDTMZ[]" value="'+ $('#PROPSSPLANENDTM').val() +'">';
            cols += '<input type="hidden" id="PROPSSSTARTDT'+index+'" name="PROPSSSTARTDTZ[]" value="'+ $('#PROPSSSTARTDT').val() +'">';
            cols += '<input type="hidden" id="PROPSSENDDT'+index+'" name="PROPSSENDDTZ[]" value="'+ $('#PROPSSENDDT').val() +'">';
            cols += '<input type="hidden" id="PROPSSSTARTTM'+index+'" name="PROPSSSTARTTMZ[]" value="'+ $('#PROPSSSTARTTM').val() +'">';
            cols += '<input type="hidden" id="PROPSSENDTM'+index+'" name="PROPSSENDTMZ[]" value="'+ $('#PROPSSENDTM').val() +'">';
            cols += '<input type="hidden" id="PROPSSCOMPQTY'+index+'" name="PROPSSCOMPQTYZ[]" value="'+ $('#PROPSSCOMPQTY').val() +'">';
            cols += '<input type="hidden" id="PROPSSALLOWANCE'+index+'" name="PROPSSALLOWANCEZ[]" value="'+ $('#PROPSSALLOWANCE').val() +'">';
            cols += '<input type="hidden" id="PROPSSPLANDT'+index+'" name="PROPSSPLANDTZ[]" value="'+ $('#PROPSSPLANDT').val() +'">';
            cols += '<input type="hidden" id="PROPSSREM'+index+'" name="PROPSSREMZ[]" value="'+ $('#PROPSSREM').val() +'">';
            cols += '<input type="hidden" id="PROPSSDURATION'+index+'" name="PROPSSDURATIONZ[]" value="'+ $('#PROPSSDURATION').val() +'">';
            cols += '<input type="hidden" id="PROPSSSTATUS'+index+'" name="PROPSSSTATUSZ[]" value="'+ $('#PROPSSSTATUS').val() +'">';
            cols += '<input type="hidden" id="PROPSSSTATUSSTR'+index+'" name="PROPSSSTATUSSTRZ[]" value="'+ $('#PROPSSSTATUSSTR').val() +'">';
            cols += '<input type="hidden" id="JOB_NAME'+index+'" name="JOB_NAMEZ[]" value="'+ $('#JOB_NAME').val() +'">';
            let PROPSSFIXFLG = document.getElementById('PROPSSFIXFLG');
            cols += '<input type="hidden" id="PROPSSFIXFLG'+index+'" name="PROPSSFIXFLGZ[]" value="'+ PROPSSFIXFLG.checked ? 'T': 'F' +'">';

            if(index <= maxrow) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').removeAttr('class', 'row-empty');
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $('table tbody').append(newRow);
            }
            $('#rowCount').html(index);
            
            keepItemData();
            return entry();

        });

        UPDATE.click(async function() {
            let rowno = $('#ROWNO').val();
            if(rowno != '') {

                $('#ROWNO_TD'+rowno+'').html($('#ROWNO').val());
                $('#PROPSSNO_TD'+rowno+'').html($('#PROPSSNO').val());
                $('#PROPSSTYP_TD'+rowno+'').html($('#PROPSSTYP option:selected').text());
                $('#ITEMPLACECD_TD'+rowno+'').html($('#ITEMPLACECD').val());
                $('#ITEMPLACENAME_TD'+rowno+'').html($('#ITEMPLACENAME').val());
                $('#PROPSSJOBTYP_TD'+rowno+'').html($('#PROPSSJOBTYP').val());
                $('#JOB_NAME_TD'+rowno+'').html($('#JOB_NAME').val());
                $('#PROPSSQTY_TD'+rowno+'').html($('#PROPSSQTY').val());
                $('#PROPSSPLANTIME_TD'+rowno+'').html($('#PROPSSPLANTIME').val());
                $('#PROPSSUNITTYP_TD'+rowno+'').html($('#PROPSSUNITTYP option:selected').text());
                $('#PROPSSLINKTYP_TD'+rowno+'').html($("#PROPSSLINKTYP option:selected").text());

                $('#ROWNO'+rowno+'').val($('#ROWNO').val());
                $('#PROPSSNO'+rowno+'').val($('#PROPSSNO').val());
                $('#ITEMPLACECD'+rowno+'').val($('#ITEMPLACECD').val());
                $('#ITEMPLACENAME'+rowno+'').val($('#ITEMPLACENAME').val());
                $('#PROPSSJOBTYP'+rowno+'').val($('#PROPSSJOBTYP').val());
                $('#PROPSSJOBTYPSTR'+rowno+'').val($('#PROPSSJOBTYP').val());
                $('#PROPSSQTY'+rowno+'').val($('#PROPSSQTY').val());
                $('#PROPSSPLANTIME'+rowno+'').val($('#PROPSSPLANTIME').val());
                $('#PROPSSTYP'+rowno+'').val(document.getElementById('PROPSSTYP').value);
                $('#PROPSSTYPSTR'+rowno+'').val($('#PROPSSTYP option:selected').text());
                $('#PROPSSUNITTYP'+rowno+'').val(document.getElementById('PROPSSUNITTYP').value);
                $('#PROPSSUNITTYPSTR'+rowno+'').val($('#PROPSSUNITTYP option:selected').text());
                $('#PROPSSLINKTYP'+rowno+'').val(document.getElementById('PROPSSLINKTYP').value);
                $('#PROPSSLINKTYPSTR'+rowno+'').val($('#PROPSSLINKTYP option:selected').text());
                $('#PROPSSPLANSTARTDT'+rowno+'').val(slashFormatDate($('#PROPSSPLANSTARTDT').val()));
                $('#PROPSSPLANENDDT'+rowno+'').val(slashFormatDate($('#PROPSSPLANENDDT').val()));
                $('#PROPSSPLANSTARTTM'+rowno+'').val($('#PROPSSPLANSTARTTM').val());
                $('#PROPSSPLANENDTM'+rowno+'').val($('#PROPSSPLANENDTM').val());
                $('#PROPSSSTARTDT'+rowno+'').val($('#PROPSSSTARTDT').val());
                $('#PROPSSENDDT'+rowno+'').val($('#PROPSSENDDT').val());
                $('#PROPSSSTARTTM'+rowno+'').val($('#PROPSSSTARTTM').val());
                $('#PROPSSENDTM'+rowno+'').val($('#PROPSSENDTM').val());
                $('#PROPSSCOMPQTY'+rowno+'').val($('#PROPSSCOMPQTY').val());
                $('#PROPSSALLOWANCE'+rowno+'').val($('#PROPSSALLOWANCE').val());  
                $('#PROPSSPLANDT'+rowno+'').val($('#PROPSSPLANDT').val()); 
                $('#PROPSSREM'+rowno+'').val($('#PROPSSREM').val());
                $('#JOB_NAME'+rowno+'').val($('#JOB_NAME').val());
                $('#PROPSSDURATION'+rowno+'').val($('#PROPSSDURATION').val()); 
                $('#PROPSSSTATUS'+rowno+'').val($('#PROPSSSTATUS').val()); 
                $('#PROPSSSTATUSSTR'+rowno+'').val($('#PROPSSSTATUSSTR').val()); 
                let PROPSSFIXFLG = document.getElementById('PROPSSFIXFLG');
                $('#PROPSSFIXFLG'+rowno+'').val(PROPSSFIXFLG.checked ? 'T': 'F'); 


                document.getElementById('OK').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;
               
                await keepItemData();
                return entry();
            }
        });

        DELETE.click(function() {
            let id = $('#ROWNO').val();
            if(id == '') return false;
            document.getElementById('table').deleteRow(id);
            $('#rowId'+id).closest('tr').remove();
            if(id <= maxrow) {
                emptyRow(index);
            }
            index--;
            // console.log(key);
            $('.row-id').each(function (i) {
                $(this).text(i+1);
            }); 
            $('#rowcount').html(index);
            changeRowId();
            unsetItemData(id);
            id = null;
            return entry();
        });

        $(document).on('click', '.ppe tbody tr', function(event) {
            $('table#table tbody tr').not(this).removeClass('selected'); entry();
            let item = $(this).closest('tr').children('td');
            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                let rec = item.eq(0).text();
                let table = document.getElementById('table');
                if(rec != '') { 
                    table.rows[rec].classList.toggle('selected');
                }

                $('#ROWNO').val($('#ROWNO'+rec+'').val());
                $('#PROPSSNO').val($('#PROPSSNO'+rec+'').val());
                $('#ITEMPLACECD').val($('#ITEMPLACECD'+rec+'').val());
                $('#ITEMPLACENAME').val($('#ITEMPLACENAME'+rec+'').val());
                $('#PROPSSJOBTYP').val($('#PROPSSJOBTYP'+rec+'').val());
                $('#PROPSSJOBTYPSTR').val($('#PROPSSJOBTYPSTR'+rec+'').val());
                $('#PROPSSQTY').val($('#PROPSSQTY'+rec+'').val());
                $('#PROPSSPLANTIME').val($('#PROPSSPLANTIME'+rec+'').val());
                $('#PROPSSTYP').val($('#PROPSSTYP'+rec+'').val());
                $('#PROPSSTYPSTR').val($('#PROPSSTYPSTR'+rec+'').val());
                $('#PROPSSPLANSTARTDT').val($('#PROPSSPLANSTARTDT'+rec+'').val().replaceAll('/','-'));
                $('#PROPSSPLANENDDT').val($('#PROPSSPLANENDDT'+rec+'').val().replaceAll('/','-'));
                $('#PROPSSPLANSTARTTM').val($('#PROPSSPLANSTARTTM'+rec+'').val());
                $('#PROPSSPLANENDTM').val($('#PROPSSPLANENDTM'+rec+'').val());
                $('#PROPSSSTARTDT').val($('#PROPSSSTARTDT'+rec+'').val());
                $('#PROPSSENDDT').val($('#PROPSSENDDT'+rec+'').val());
                $('#PROPSSSTARTTM').val($('#PROPSSSTARTTM'+rec+'').val());
                $('#PROPSSENDTM').val($('#PROPSSENDTM'+rec+'').val());
                $('#PROPSSCOMPQTY').val($('#PROPSSCOMPQTY'+rec+'').val());
                $('#PROPSSALLOWANCE').val($('#PROPSSALLOWANCE'+rec+'').val());
                $('#PROPSSPLANDT').val($('#PROPSSPLANDT'+rec+'').val());
                $('#PROPSSREM').val($('#PROPSSREM'+rec+'').val());
                $('#JOB_NAME').val($('#JOB_NAME'+rec+'').val());
                $('#PROPSSDURATION').val($('#PROPSSDURATION'+rec+'').val());
                $('#PROPSSSTATUS').val($('#PROPSSSTATUS'+rec+'').val());
                $('#PROPSSSTATUSSTR').val($('#PROPSSSTATUSSTR'+rec+'').val());

                document.getElementById('PROPSSUNITTYP').value = $('#PROPSSUNITTYP'+rec+'').val();
                document.getElementById('PROPSSLINKTYP').value = $('#PROPSSLINKTYP'+rec+'').val();

                if ($('#PROPSSFIXFLG'+rec+'').val() == 'T') {
                   document.getElementById('PROPSSFIXFLG').checked = true;
                } else {
                    document.getElementById('PROPSSFIXFLG').checked = false;
                }

                document.getElementById('OK').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;
                return unRequired();
            }
        });
    })
        
    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'PROPSSJOBTYP') {
            return getElement(code, result);
        } else if(code == 'ITEMPLACECD') {
            return getPlace(result, PROPSSTYP.val());
        } else {
            return getSearch(code, result);
        }
    }

    function validationDialog() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText:  '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
            if (result.isConfirmed) {
               // 
            }
        });
    }
</script>