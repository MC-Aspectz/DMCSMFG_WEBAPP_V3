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
            <form class="w-full" method="POST" id="scrapView" name="scrapView" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                id="PROORDERNO" name="PROORDERNO" value="<?=isset($data['PROORDERNO']) ? $data['PROORDERNO']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPRODUCTIONORDER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('ITEMCODE')?></label>
                                        <input type="text" class="text-control text-[14px] shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMNAME')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WC_CODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"  id="WCCD" name="WCCD" value="<?=isset($data['WCCD']) ? $data['WCCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="WCNAME" name="WCNAME" value="<?=isset($data['WCNAME']) ? $data['WCNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PRODUCT_QTY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROQTY" name="PROQTY" value="<?=!empty($data['PROQTY']) ? number_format($data['PROQTY'], 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" id="ITEMUNITTYP" name="ITEMUNITTYP">
                                                <option value=""></option>
                                                <?php foreach ($unit as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                        </select>
                                        <input type="hidden" id="CMPRICETYPE" name="CMPRICETYPE" value="<?=!empty($data['CMPRICETYPE']) ? $data['CMPRICETYPE']: ''; ?>" />
                                        <input type="hidden" id="CMAMOUNTTYPE" name="CMAMOUNTTYPE" value="<?=!empty($data['CMAMOUNTTYPE']) ? $data['CMAMOUNTTYPE']: ''; ?>" />
                                        <input type="hidden" id="COMPRICETYPE" name="COMPRICETYPE" value="<?=!empty($data['COMPRICETYPE']) ? $data['COMPRICETYPE']: ''; ?>" />
                                        <input type="hidden" id="COMAMOUNTTYPE" name="COMAMOUNTTYPE" value="<?=!empty($data['COMAMOUNTTYPE']) ? $data['COMAMOUNTTYPE']: ''; ?>" />
                                        <input type="hidden" id="CURRENCY" name="CURRENCY" value="<?=!empty($data['CURRENCY']) ? $data['CURRENCY']: ''; ?>" />
                                        <input type="hidden" id="CUSTOMERCURRENCY" name="CUSTOMERCURRENCY" value="<?=!empty($data['CUSTOMERCURRENCY']) ? $data['CUSTOMERCURRENCY']: ''; ?>" />
                                    </div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STARTDATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROSTARTDT" name="PROSTARTDT" value="<?=!empty($data['PROSTARTDT']) ? date('Y-m-d', strtotime($data['PROSTARTDT'])): ''; ?>"/>
                                        <label class="text-color block text-sm pt-1 w-3/12 text-center"><?=checklang('ENDDATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROENDDT"name="PROENDDT" value="<?=!empty($data['PROENDDT']) ? date('Y-m-d', strtotime($data['PROENDDT'])): ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALES_ORDER_NO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"  id="PROSALENOLN" name="PROSALENOLN" value="<?=isset($data['PROSALENOLN']) ? $data['PROSALENOLN']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm pt-1 w-1/12 text-center"><?=checklang('STATUS')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 read" id="PROSTATUS" name="PROSTATUS" >
                                            <option value=""></option>
                                            <?php foreach ($statusorder as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['PROSTATUS']) && $data['PROSTATUS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read" id="CUSTOMERCD" name="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('CUSTOMERNAME')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read" id="CUSTOMERNAME" name="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-3/12 px-2">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('DELIVERY_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="DELIVERYDATE" name="DELIVERYDATE" value="<?=!empty($data['DELIVERYDATE']) ? date('Y-m-d', strtotime($data['DELIVERYDATE'])): ''; ?>"/>
                                    </div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('DELE_PLACE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read" id="DELIVERYCD" name="DELIVERYCD" value="<?=isset($data['DELIVERYCD']) ? $data['DELIVERYCD']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('DELE_PLACE_NAME')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read" id="DELIVERYNAME" name="DELIVERYNAME" value="<?=isset($data['DELIVERYNAME']) ? $data['DELIVERYNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-3/12 px-2">
                                        <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('DUE_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="DUEDATE" name="DUEDATE" value="<?=!empty($data['DUEDATE']) ? date('Y-m-d', strtotime($data['DUEDATE'])): ''; ?>"/>
                                    </div>
                                </div> 

                                <hr class="divide-y divide-dotted my-2 mx-2">
                       
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALES_ORDER_AMOUNT')?></label>
                                        <div class="relative w-5/12 mr-1 justify-between">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-20 text-gray-700 border-gray-300 text-right read" 
                                                id="SALELNAMT" name="SALELNAMT" value="<?=!empty($data['SALELNAMT']) ? number_format(str_replace(',', '', $data['SALELNAMT']), 2): ''; ?>"/>
                                            <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-16 rounded-e-xl border text-center read">
                                                <?=!empty($data['CMCURDISP']) ? $data['CMCURDISP']: ''; ?>
                                            </label>
                                        </div>
                                        <input type="text" class="hidden" id="CMCURDISP" name="CMCURDISP" value="<?=!empty($data['CMCURDISP']) ? $data['CMCURDISP']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-4/12 pl-1 pt-1"></label>
                                    </div>
                                    <div class="flex w-6/12 px-2"></div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <div class="relative w-5/12 mr-1 justify-between">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-20 text-gray-700 border-gray-300 text-right read" 
                                                id="SALELNEXAMT" name="SALELNEXAMT" value="<?=!empty($data['SALELNEXAMT']) ? number_format(str_replace(',', '', $data['SALELNEXAMT']), 2): ''; ?>"/>
                                            <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-16 rounded-e-xl border text-center read">
                                                <?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>
                                            </label>
                                        </div>
                                        <input type="text" class="hidden" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-4/12 pl-1 pt-1"></label>
                                    </div>
                                    <div class="flex w-6/12 px-2"></div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PLAN_COST')?></label>
                                        <div class="relative w-5/12 mr-1 justify-between">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-20 text-gray-700 border-gray-300 text-right read" 
                                                id="PLANCOST" name="PLANCOST" value="<?=!empty($data['PLANCOST']) ? number_format(str_replace(',', '', $data['PLANCOST']), 2): ''; ?>"/>
                                            <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-16 rounded-e-xl border text-center read">
                                                <?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>
                                            </label>
                                        </div>
                                        <label class="text-color block text-sm w-4/12 pl-1 pt-1"></label>
                                    </div>
                                    <div class="flex w-6/12 px-2"></div>
                                </div> 
                 
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACT_COST')?></label>
                                        <div class="relative w-5/12 mr-1 justify-between">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-20 text-gray-700 border-gray-300 text-right read" 
                                                id="ACTUALCOST" name="ACTUALCOST" value="<?=!empty($data['ACTUALCOST']) ? number_format(str_replace(',', '', $data['ACTUALCOST']), 2): ''; ?>"/>
                                            <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-16 rounded-e-xl border text-center read">
                                                <?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>
                                            </label>
                                        </div>
                                        <label class="text-color block text-sm w-4/12 pt-1 text-center"><?=checklang('DIFFERENCE')?></label>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                id="ACTUALCOSTDIFF" name="ACTUALCOSTDIFF" value="<?=!empty($data['ACTUALCOSTDIFF']) ? number_format(str_replace(',', '', $data['ACTUALCOSTDIFF']), 2): ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-8/12 pl-1 pt-1"></label>
                                    </div>
                                </div> 

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pt-1 text-right">(</label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 mx-2 py-2 pr-8 text-gray-700 border-gray-300 text-right read" 
                                                id="ACT_PARTS_AMT" name="ACT_PARTS_AMT" value="<?=!empty($data['ACT_PARTS_AMT']) ? number_format(str_replace(',', '', $data['ACT_PARTS_AMT']), 2): ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-5/12 pt-1">)</label>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
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

                <div class="flex flex-col mb-1">
                    <div class="flex w-full">
                        <div class="flex flex-col w-7/12 px-2">
                            <!-- DVWPRODUCTION Table -->
                            <div class="flex overflow-scroll block h-[180px]"> 
                                <table id="tableProduct" class="w-full border-collapse border border-slate-500 divide-gray-200 prd_table" rules="cols" cellpadding="3" cellspacing="1">
                                    <thead class="sticky top-0 bg-gray-50">
                                        <tr class="border border-gray-600">
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ROUT_NO')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOB_DETAIL')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARK')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PLAN_HOUR')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACT_HOUR')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('COMP_QTY')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BAD_QTY')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RATE')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap">&emsp;&emsp;</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                                    if(!empty($data['DVWPRODUCTION']))  { $minrowA = count($data['DVWPRODUCTION']);
                                        foreach ($data['DVWPRODUCTION'] as $key => $value) { ?>
                                            <tr class="divide-y divide-gray-200 jobRow" id="rowPrdId<?=$key?>">
                                                <td class="hidden prdRow-id" id="ROWNO1_TD<?=$key?>"><?=$key ?></td>
                                                <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="ROUTNO_TD<?=$key?>"><?=isset($value['ROUTNO']) ? $value['ROUTNO']: ''?></td>
                                                <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="JOBDETAIL_TD<?=$key?>"><?=isset($value['JOBDETAIL']) ? $value['JOBDETAIL']: ''?></td>
                                                <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-lef whitespace-nowrapt" id="JOBREM_TD<?=$key?>"><?=isset($value['JOBREM']) ? $value['JOBREM']: ''?></td>
                                                <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="PLANTIME_TD<?=$key?>"><?=isset($value['PLANTIME']) ? $value['PLANTIME']: ''?></td>
                                                <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="ACTTIME_TD<?=$key?>"><?=isset($value['ACTTIME']) ? $value['ACTTIME']: ''?></td>
                                                <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="COMPQTY_TD<?=$key?>"><?=isset($value['COMPQTY']) ? $value['COMPQTY']: ''?></td>
                                                <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="BADQTY_TD<?=$key?>"><?=isset($value['BADQTY']) ? $value['BADQTY']: ''?></td>
                                                <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="RATE_TD<?=$key?>"><?=isset($value['RATE']) ? $value['RATE']: ''?></td>
                                                <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"></td>
                                                <td class="hidden" id="ROW_TOTAL_STD_TD<?=$key?>"><?=isset($value['ROW_TOTAL_STD']) ? $value['ROW_TOTAL_STD']: '' ?></td>
                                                <td class="hidden" id="ROW_TOTAL_CUR_TD<?=$key?>"><?=isset($value['ROW_TOTAL_CUR']) ? $value['ROW_TOTAL_CUR']: '' ?></td>
                                            </tr><?php 
                                        }
                                    }         
                                    for ($i = $minrowA+1; $i <= $maxrow; $i++) { ?>
                                        <tr class="divide-y divide-gray-200" id="rowPrdId<?=$i?>">
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
                                </table>
                            </div>

                            <div class="flex p-2">
                                <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="jobcount"><?=$minrowA;?></span></label>
                            </div>
                        </div>

                        <div class="flex flex-col w-5/12 px-2">
                            <!-- DVWSCRAP Table -->
                            <div class="flex overflow-scroll block h-[180px]"> 
                                <table id="tableScrap" class="w-full border-collapse border border-slate-500 divide-gray-200 scrap_table" rules="cols" cellpadding="3" cellspacing="1">
                                    <thead class="sticky top-0 bg-gray-50">
                                        <tr class="border border-gray-600">
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ROUT_NO')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BAD_REASON')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RATE')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap">&emsp;&emsp;</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                                    if(!empty($data['DVWSCRAP']))  { $minrowB = count($data['DVWSCRAP']);
                                        foreach ($data['DVWSCRAP'] as $key => $value) { ?>
                                            <tr class="divide-y divide-gray-200 scrapRow" id="rowScrapId<?=$key?>">
                                                <td class="hidden scrapRow-id" id="ROWNO2_TD<?=$key?>"><?=$key ?></td>
                                                <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left" id="PROSCRAPPSSNO_TD<?=$key?>"><?=isset($value['PROSCRAPPSSNO']) ? $value['PROSCRAPPSSNO']: '' ?></td>
                                                <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="REASON_TD<?=$key?>"><?=isset($value['REASON']) ? $value['REASON']: '' ?></td>
                                                <td class="h-6 w-3/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="QUANTITY_TD<?=$key?>"><?=isset($value['QUANTITY']) ? $value['QUANTITY']: '' ?></td>
                                                <td class="h-6 w-2/12 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="BADPERCENT_TD<?=$key?>"><?=isset($value['BADPERCENT']) ? $value['BADPERCENT']: '' ?></td>
                                                <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"></td>
                                            </tr><?php 
                                        }
                                    }         
                                    for ($i = $minrowB+1; $i <= $maxrow; $i++) { ?>
                                        <tr class="divide-y divide-gray-200" id="rowScrapId<?=$i?>">
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
                                <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="scrapcount"><?=$minrowB;?></span></label>
                            </div>
                        </div>
                    </div>
                </div>
              
                <!-- DVWPRICE Table -->
                <div id="table-area" class="overflow-scroll block h-[180px] px-2"> 
                    <table id="tablePrice" class="w-full border-collapse border border-slate-500 divide-gray-200 price_table" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
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
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AS_REQUIRED')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TOTAL_WITH_DRAW')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LAST_WITH_DRAW')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNITPRICE_INV')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MATERIALCODE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STD_PARTSCOST')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap">&emsp;</span>
                                </th>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['DVWPRICE'])) { $minrowC = count($data['DVWPRICE']);
                            foreach($data['DVWPRICE'] as $key => $item) { ?>
                                <tr class="divide-y divide-gray-200 priceRow" id="rowPriceId<?=$key?>">
                                    <td class="hidden priceRow-id" id="ROWNO3_TD<?=$key?>"><?=$key;?></td>

                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="PRITEMCD_TD<?=$key?>"><?=isset($value['PRITEMCD']) ? $value['PRITEMCD']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="PRITEMNAME_TD<?=$key?>"><?=isset($value['PRITEMNAME']) ? $value['PRITEMNAME']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="PRITEMSPEC_TD<?=$key?>"><?=isset($value['PRITEMSPEC']) ? $value['PRITEMSPEC']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="ASREQUIRED_TD<?=$key?>"><?=isset($value['ASREQUIRED']) ? $value['ASREQUIRED']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="WITHDRAWQTY_TD<?=$key?>"><?=isset($value['WITHDRAWQTY']) ? $value['WITHDRAWQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="WITHDRAWACTDATE_TD<?=$key?>"><?=isset($value['WITHDRAWACTDATE']) ? $value['WITHDRAWACTDATE']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="PARTSUNITPRICE_TD<?=$key?>"><?=isset($value['PARTSUNITPRICE']) ? $value['PARTSUNITPRICE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="MATERIALCODE_TD<?=$key?>"><?=isset($value['MATERIALCODE']) ? $value['MATERIALCODE']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-1 text-sm border border-slate-700 text-right" id="MATERIALAMOUNT_TD<?=$key?>"><?=isset($value['MATERIALAMOUNT']) ? $value['MATERIALAMOUNT']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"></td>
                                    <td class="hidden" id="UNITWEIGHT_TD<?=$key?>"><?=isset($value['UNITWEIGHT']) ? $value['UNITWEIGHT']: '' ?></td>
                                    <td class="hidden" id="WEIGHTUNITPRICE_TD<?=$key?>"><?=isset($value['WEIGHTUNITPRICE']) ? $value['WEIGHTUNITPRICE']: '' ?></td>
                                    <td class="hidden" id="ROW_TOTAL_AMT1_TD<?=$key?>"><?=isset($value['ROW_TOTAL_AMT1']) ? $value['ROW_TOTAL_AMT1']: '' ?></td>
                                    <td class="hidden" id="ROW_TOTAL_AMT2_TD<?=$key?>"><?=isset($value['ROW_TOTAL_AMT2']) ? $value['ROW_TOTAL_AMT2']: '' ?></td>
                                </tr><?php
                            }
                        }
                        for ($i = $minrowC+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200 row-empty" id="rowPriceId<?=$i?>">
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
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="priceCount"><?=$minrowC;?></span></label>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STD_LABORCOST')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="TOTAL_A" name="TOTAL_A" value="<?=!empty($data['TOTAL_A']) ? number_format(str_replace(',', '', $data['TOTAL_A']), 2): ''; ?>" readonly/>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="TOTAL_E" name="TOTAL_E" value="<?=!empty($data['TOTAL_E']) ? number_format(str_replace(',', '', $data['TOTAL_E']), 2): ''; ?>" readonly/>
                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('CRT_LABORCOST')?></label>
                    </div>
                    <div class="flex w-6/12">
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="TOTAL_B" name="TOTAL_B" value="<?=!empty($data['TOTAL_B']) ? number_format(str_replace(',', '', $data['TOTAL_B']), 2): ''; ?>" readonly/>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="TOTAL_F" name="TOTAL_F" value="<?=!empty($data['TOTAL_F']) ? number_format(str_replace(',', '', $data['TOTAL_F']), 2): ''; ?>" readonly/>
                        <input type="hidden" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="TOTAL_C" name="TOTAL_C" value="<?=!empty($data['TOTAL_C']) ? number_format(str_replace(',', '', $data['TOTAL_C']), 2): ''; ?>" readonly/>
                        <input type="hidden" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="TOTAL_D" name="TOTAL_D" value="<?=!empty($data['TOTAL_D']) ? number_format(str_replace(',', '', $data['TOTAL_D']), 2): ''; ?>" readonly/>
                    </div>
                </div> 

                <div class="flex mt-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-12/12 pl-3 pt-1"><?=checklang('EXP_MEMO01')?></label>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
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
</body>
</html>
<script src="./js/script.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
        $('table#tableProduct tr').click(function () {
            $('table#tableProduct tbody tr').removeAttr('id');
            let pitem = $(this).closest('tr').children('td');
            if(pitem.eq(0).text() != 'undefined' && pitem.eq(0).text() != '') {
                $(this).attr('id', 'selected-row');
            }
        });

        $('table#tableScrap tr').click(function () {
            $('table#tableScrap tbody tr').removeAttr('id');
            let sitem = $(this).closest('tr').children('td');
            if(sitem.eq(0).text() != 'undefined' && sitem.eq(0).text() != '') {
                $(this).attr('id', 'selected-row');
            }
        });

        $('table#tablePrice tr').click(function () {
            $('table#tablePrice tbody tr').removeAttr('id');
            let pritem = $(this).closest('tr').children('td');
            if(pritem.eq(0).text() != 'undefined' && pritem.eq(0).text() != '') {
                $(this).attr('id', 'selected-row');
            }
        });

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 5); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[180px]');
                tablearea.classList.add('h-[340px]');
                maxrow = 12;
            } else {
                tablearea.classList.remove('h-[340px]');
                tablearea.classList.add('h-[180px]');
                maxrow = 5;
            }
            emptyRows(maxrow);
        });
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getSearch(code, result);    
    }
</script>