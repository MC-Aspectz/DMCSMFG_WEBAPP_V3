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
            <form class="w-full" method="POST" id="orderbmentry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="ORDER_NO_TXT"><?=checklang('ORDER_NO')?></label>
                                        <select class="text-control text-[13px] shadow-md border px-3 h-7 w-3/12 mr-1 text-left text-[12px] rounded-xl border-gray-300 req"
                                                id="ALLOCORDERTYP" name="ALLOCORDERTYP" onchange="unRequired();">
                                            <option value=""></option>
                                            <?php foreach ($ALLOCORDERTYP as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ALLOCORDERTYP']) && $data['ALLOCORDERTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="ALLOCORDERNO" name="ALLOCORDERNO" value="<?=isset($data['ALLOCORDERNO']) ? $data['ALLOCORDERNO']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPURORPRO">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input class="hidden" type="hidden" id="ORDERNO" name="ORDERNO" value="<?=isset($data['ORDERNO']) ? $data['ORDERNO']: ''?>" readonly/>
                                        <input class="hidden" type="hidden" id="ORDERLN" name="ORDERLN" value="<?=isset($data['ORDERLN']) ? $data['ORDERLN']: ''?>" readonly/>
                                        <input class="hidden" type="hidden" id="WITHDRAWDATE" name="WITHDRAWDATE" value="<?=isset($data['WITHDRAWDATE']) ? $data['WITHDRAWDATE']: ''?>" readonly/>
                                        <input class="hidden" type="hidden" id="BOMLENGTH" name="BOMLENGTH" value="<?=isset($data['BOMLENGTH']) ? $data['BOMLENGTH']: ''?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center hidden" id="BMVERSIONLBL"><?=checklang('COMBINATION')?></label>
                                    </div>
                                    <div class="flex w-6/12 justify-end">
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300 hidden" id="BMVERSION" name="BMVERSION" >
                                            <option value=""></option>
                                            <?php foreach ($BMVERSION as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['BMVERSION']) && $data['BMVERSION'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="button"class="btn text-color items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 mx-3 py-1 text-center hidden"
                                                id="REMAKE" name="REMAKE"><?=checklang('REMAKE')?></button>
                                        <div class="w-1/12"></div>
                                        <label class="text-color block text-sm w-3/12 px-2 pt-1" id="DUE_DATE_TXT"><?=checklang('DUE_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ORDERDUEDT" name="ORDERDUEDT" value="<?=!empty($data['ORDERDUEDT']) ? date('Y-m-d', strtotime($data['ORDERDUEDT'])): ''; ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="ITEM_TXT"><?=checklang('ITEM')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="ODRITEMCD" id="ODRITEMCD" value="<?=isset($data['ODRITEMCD']) ? $data['ODRITEMCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="ODRITEMNAME" name="ODRITEMNAME" value="<?=isset($data['ODRITEMNAME']) ? $data['ODRITEMNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ODRITEMSPEC" name="ODRITEMSPEC" value="<?=isset($data['ODRITEMSPEC']) ? $data['ODRITEMSPEC']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ODRITEMDRAWNO" name="ODRITEMDRAWNO" value="<?=isset($data['ODRITEMDRAWNO']) ? $data['ODRITEMDRAWNO']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="JOBPLACE_TXT"><?=checklang('JOBPLACE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="ODRPLACE" id="ODRPLACE" value="<?=isset($data['ODRPLACE']) ? $data['ODRPLACE']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="ODRPLACENAME" name="ODRPLACENAME" value="<?=isset($data['ODRPLACENAME']) ? $data['ODRPLACENAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center" id="ORDER_QTY_PRO_TXT"><?=checklang('ORDER_QTY_PRO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                            id="ODRQTY" name="ODRQTY" value="<?=!empty($data['ODRQTY']) ? number_format(str_replace(',', '',$data['ODRQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 mr-1 text-left rounded-xl border-gray-300 read"
                                                id="ORDITEMUNITTYP" name="ORDITEMUNITTYP" readonly>
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ORDITEMUNITTYP']) && $data['ORDITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="flex w-5/12 justify-end">
                                            <input type="hidden" id="SYSVIS_REMAKE" name="SYSVIS_REMAKE" value="<?=isset($data['SYSVIS_REMAKE']) ? $data['SYSVIS_REMAKE']: 'F'?>" readonly/>
                                            <input type="hidden" id="SYSVIS_BMVERSION" name="SYSVIS_BMVERSION" value="<?=isset($data['SYSVIS_BMVERSION']) ? $data['SYSVIS_BMVERSION']: 'F'?>" readonly/>
                                            <input type="hidden" id="SYSVIS_BMVERSIONLBL" name="SYSVIS_BMVERSIONLBL" value="<?=isset($data['SYSVIS_BMVERSIONLBL']) ? $data['SYSVIS_BMVERSIONLBL']: 'F'?>" readonly/>
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
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 pdb" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BASEID')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SPECIFICATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SPARE_QUANTITY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ALLOCATED_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WITHDRAWQTY')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('APPLY_PUR_PRO_ORDER')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 csv" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD<?=$key?>"><?=$key?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="ALLOCBASETYP_TD<?=$key?>"><?=isset($value['ALLOCBASETYP']) ? $value['ALLOCBASETYP']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left" id="ITEMCD_TD<?=$key?>"><?=isset($value['ITEMCD']) ? $value['ITEMCD']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMNAME_TD<?=$key?>"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMSPEC_TD<?=$key?>"><?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="ALLOCQTY_TD<?=$key?>"><?=isset($value['ALLOCQTY']) ? $value['ALLOCQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left" id="ITEMUNITTYPSTR_TD<?=$key?>"><?=isset($value['ITEMUNITTYPSTR']) ? $value['ITEMUNITTYPSTR']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="ALLOCSPAREQTY_TD<?=$key?>"><?=isset($value['ALLOCSPAREQTY']) ? $value['ALLOCSPAREQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="AQTY_TD<?=$key?>"><?=isset($value['AQTY']) ? $value['AQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="ALLOCWDQTY_TD<?=$key?>"><?=isset($value['ALLOCWDQTY']) ? $value['ALLOCWDQTY']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left" id="ALLOCPURORDERNOLN_TD<?=$key?>"><?=isset($value['ALLOCPURORDERNOLN']) ? $value['ALLOCPURORDERNOLN']: '' ?></td>
                                    
                                    <input class="hidden" id="ROWNO<?=$key?>" name="ROWNOZ[]" value="<?=$key?>">
                                    <input class="hidden" id="ALLOCLN<?=$key?>" name="ALLOCLNZ[]" value="<?=isset($value['ALLOCLN']) ? $value['ALLOCLN']: '' ?>">
                                    <input class="hidden" id="ALLOCBASETYPSTR<?=$key?>" name="ALLOCBASETYPSTRZ[]" value="<?=isset($value['ALLOCBASETYPSTR']) ? $value['ALLOCBASETYPSTR']: '' ?>">
                                    <input class="hidden" id="ALLOCBASETYP<?=$key?>" name="ALLOCBASETYPZ[]" value="<?=isset($value['ALLOCBASETYP']) ? $value['ALLOCBASETYP']: '' ?>">
                                    <input class="hidden" id="ITEMCD<?=$key?>" name="ITEMCDZ[]" value="<?=isset($value['ITEMCD']) ? $value['ITEMCD']: '' ?>">
                                    <input class="hidden" id="ITEMNAME<?=$key?>" name="ITEMNAMEZ[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?>">
                                    <input class="hidden" id="ITEMSPEC<?=$key?>" name="ITEMSPECZ[]" value="<?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?>">
                                    <input class="hidden" id="ITEMDRAWNO<?=$key?>" name="ITEMDRAWNOZ[]" value="<?=isset($value['ITEMDRAWNO']) ? $value['ITEMDRAWNO']: '' ?>">
                                    <input class="hidden" id="ALLOCQTY<?=$key?>" name="ALLOCQTYZ[]" value="<?=isset($value['ALLOCQTY']) ? $value['ALLOCQTY']: '' ?>">
                                    <input class="hidden" id="ALLOCDRAWNO<?=$key?>" name="ALLOCDRAWNOZ[]" value="<?=isset($value['ALLOCDRAWNO']) ? $value['ALLOCDRAWNO']: '' ?>">
                                    <input class="hidden" id="ALLOCORDERFLG<?=$key?>" name="ALLOCORDERFLGZ[]" value="<?=isset($value['ALLOCORDERFLG']) ? $value['ALLOCORDERFLG']: '' ?>">
                                    <input class="hidden" id="ALLOCPURORDERNOLN<?=$key?>" name="ALLOCPURORDERNOLNZ[]" value="<?=isset($value['ALLOCPURORDERNOLN']) ? $value['ALLOCPURORDERNOLN']: '' ?>">
                                    <input class="hidden" id="ALLOCREM<?=$key?>" name="ALLOCREMZ[]" value="<?=isset($value['ALLOCREM']) ? $value['ALLOCREM']: '' ?>">
                                    <input class="hidden" id="ITEMUNITTYP<?=$key?>" name="ITEMUNITTYPZ[]" value="<?=isset($value['ITEMUNITTYP']) ? $value['ITEMUNITTYP']: '' ?>"/>
                                    <input class="hidden" id="ITEMUNITTYPSTR<?=$key?>" name="ITEMUNITTYPSTRZ[]" value="<?=isset($value['ITEMUNITTYPSTR']) ? $value['ITEMUNITTYPSTR']: '' ?>">
                                    <input class="hidden" id="ALLOCSPAREQTY<?=$key?>" name="ALLOCSPAREQTYZ[]" value="<?=isset($value['ALLOCSPAREQTY']) ? $value['ALLOCSPAREQTY']: '' ?>">
                                    <input class="hidden" id="ALLOCWDQTY<?=$key?>" name="ALLOCWDQTYZ[]" value="<?=isset($value['ALLOCWDQTY']) ? $value['ALLOCWDQTY']: '' ?>">
                                    <input class="hidden" id="AQTY<?=$key?>" name="AQTYZ[]" value="<?=isset($value['AQTY']) ? $value['AQTY']: '' ?>">
                                    <input class="hidden" id="ALLOCPLANWDDT<?=$key?>" name="ALLOCPLANWDDTZ[]" value="<?=isset($value['ALLOCPLANWDDT']) ? $value['ALLOCPLANWDDT']: '' ?>">
                                    <input class="hidden" id="ALLOCDRAWDT<?=$key?>" name="ALLOCDRAWDTZ[]" value="<?=isset($value['ALLOCDRAWDT']) ? $value['ALLOCDRAWDT']: '' ?>">
                                    <input class="hidden" id="ALLOCSPECIALFLG<?=$key?>" name="ALLOCSPECIALFLGZ[]" value="<?=isset($value['ALLOCSPECIALFLG']) ? $value['ALLOCSPECIALFLG']: '' ?>">
                                    <input class="hidden" id="MATERIALCD<?=$key?>" name="MATERIALCDZ[]" value="<?=isset($value['MATERIALCD']) ? $value['MATERIALCD']: '' ?>">
                                    <input class="hidden" id="MATERIALNAME<?=$key?>" name="MATERIALNAMEZ[]" value="<?=isset($value['MATERIALNAME']) ? $value['MATERIALNAME']: '' ?>">
                                    <input class="hidden" id="PITEMCD<?=$key?>" name="PITEMCDZ[]" value="<?=isset($value['PITEMCD']) ? $value['PITEMCD']: '' ?>">
                                    <input class="hidden" id="PITEMNAME<?=$key?>" name="PITEMNAMEZ[]" value="<?=isset($value['PITEMNAME']) ? $value['PITEMNAME']: '' ?>">
                                    <input class="hidden" id="ALLOCLASTWDDT<?=$key?>" name="ALLOCLASTWDDTZ[]" value="<?=isset($value['ALLOCLASTWDDT']) ? $value['ALLOCLASTWDDT']: '' ?>">
                                    <input class="hidden" id="ITEMSERIALLFLG<?=$key?>" name="ITEMSERIALLFLGZ[]" value="<?=isset($value['ITEMSERIALLFLG']) ? $value['ITEMSERIALLFLG']: '' ?>">
                                    <input class="hidden" id="SYSEN_BOMLOADAPP<?=$key?>" name="SYSEN_BOMLOADAPPZ[]" value="<?=isset($value['SYSEN_BOMLOADAPP']) ? $value['SYSEN_BOMLOADAPP']: '' ?>">
                                    <input class="hidden" id="SYSLD_BOMLOADAPP<?=$key?>" name="SYSLD_BOMLOADAPPZ[]" value="<?=isset($value['SYSLD_BOMLOADAPP']) ? $value['SYSLD_BOMLOADAPP']: '' ?>">
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

                    <div class="sticky bottom-0 bg-white flex pt-2 px-2">
                        <div class="flex w-full">
                            <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
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
                                        <span class="text-color block text-sm pl-2 pt-1"><?=checklang('MSG_003'); ?></span>
                                    </div>
                                    <div class="flex w-5/12 px-1 justify-end">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 mr-2 text-center"
                                            id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center"
                                            id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                                    </div>
                                </summary>


                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('LINE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" readonly/>
                                        <input class="hidden" type="hidden" id="AQTY" name="AQTY" value="<?=isset($data['AQTY']) ? $data['AQTY']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="ALLOCLN" name="ALLOCLN" value="<?=isset($data['ALLOCLN']) ? $data['ALLOCLN']: ''; ?>" />
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('BASEID')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 mr-2"
                                                id="ALLOCBASETYP" name="ALLOCBASETYP" value="<?=isset($data['ALLOCBASETYP']) ? $data['ALLOCBASETYP']: ''; ?>"/>
                                        <input type="hidden" name="ALLOCSPECIALFLG" value="F" />
                                        <input type="checkbox" id="ALLOCSPECIALFLG" name="ALLOCSPECIALFLG" value="T" <?=(isset($data['ALLOCSPECIALFLG']) && $data['ALLOCSPECIALFLG'] == 'T') ? 'checked' : '' ?>/>
                                        <label class="text-color block text-sm pl-2 pt-1"><?=checklang('IS_SPECIAL'); ?></label>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" required onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>     
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ITEMDRAWNO" name="ITEMDRAWNO" value="<?=isset($data['ITEMDRAWNO']) ? $data['ITEMDRAWNO']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('MATERIAL')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="MATERIALCD" name="MATERIALCD" value="<?=isset($data['MATERIALCD']) ? $data['MATERIALCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHMATERIAL">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="MATERIALNAME" name="MATERIALNAME" value="<?=isset($data['MATERIALNAME']) ? $data['MATERIALNAME']: ''; ?>" readonly/>     
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('P_ITEMCODE')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="PITEMCODE" name="PITEMCODE" value="<?=isset($data['PITEMCODE']) ? $data['PITEMCODE']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PITEMNAME" name="PITEMNAME" value="<?=isset($data['PITEMNAME']) ? $data['PITEMNAME']: ''; ?>" readonly/>  
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('QUANTITY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                id="ALLOCQTY" name="ALLOCQTY" value="<?=!empty($data['ALLOCQTY']) ? number_format(str_replace(',', '',$data['ALLOCQTY']), 0): ''; ?>"
                                                onchange="this.value = dec2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" id="ITEMUNITTYP" name="ITEMUNITTYP">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>

                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('SPARE_QUANTITY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                id="ALLOCSPAREQTY" name="ALLOCSPAREQTY" value="<?=!empty($data['ALLOCSPAREQTY']) ? number_format(str_replace(',', '',$data['ALLOCSPAREQTY']), 0): ''; ?>"
                                                onchange="this.value = dec2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" id="ITEMUNITTYPE" name="ITEMUNITTYPE">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" id="ALLOCWDQTY" name="ALLOCWDQTY" value="<?=isset($data['ALLOCWDQTY']) ? $data['ALLOCWDQTY']: ''; ?>" />
                                        <input type="hidden" id="ALLOCLASTWDDT" name="ALLOCLASTWDDT" value="<?=isset($data['ALLOCLASTWDDT']) ? $data['ALLOCLASTWDDT']: ''; ?>" />
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('DRAWING')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 mr-2"
                                                id="ALLOCDRAWNO" name="ALLOCDRAWNO" value="<?=isset($data['ALLOCDRAWNO']) ? $data['ALLOCDRAWNO']: ''; ?>"/>
                                    </div>
                                </div>
  
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WITHDRAW_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="ALLOCPLANWDDT" name="ALLOCPLANWDDT" value="<?=!empty($data['ALLOCPLANWDDT']) ? date('Y-m-d', strtotime($data['ALLOCPLANWDDT'])) : ''; ?>"/>
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('DRAWING_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="ALLOCDRAWDT" name="ALLOCDRAWDT" value="<?=!empty($data['ALLOCDRAWDT']) ? date('Y-m-d', strtotime($data['ALLOCDRAWDT'])) : ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('MAKEORDERTYPE')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 mr-2 text-left rounded-xl border-gray-300"
                                            id="ALLOCORDERFLG" name="ALLOCORDERFLG" onchange="proOrPur();">
                                            <option value=""></option>
                                            <?php foreach ($MAKEORDERTYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ALLOCORDERFLG']) && $data['ALLOCORDERFLG'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="button" class="btn text-color items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center read"
                                                id="ORDER" name="ORDER"><?=checklang('ORDER_PUR_PRO')?></button>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('APPLY_PUR_PRO_ORDER')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ALLOCPURORDERNOLN" name="ALLOCPURORDERNOLN" value="<?=isset($data['ALLOCPURORDERNOLN']) ? $data['ALLOCPURORDERNOLN']: ''; ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('REMARK')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-10/12 py-2 px-3 text-gray-700 border-gray-300 mr-2"
                                                id="ALLOCREM" name="ALLOCREM" value="<?=isset($data['ALLOCREM']) ? $data['ALLOCREM']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-1"></div>
                                </div>   
                                <input type="hidden" id="ITEMUNITTYPSTR" name="ITEMUNITTYPSTR" value="<?=isset($data['ITEMUNITTYPSTR']) ? $data['ITEMUNITTYPSTR']: ''?>" readonly/>
                                <input type="hidden" id="SYSEN_BOMLOADAPP" name="SYSEN_BOMLOADAPP" value="<?=isset($data['SYSEN_BOMLOADAPP']) ? $data['SYSEN_BOMLOADAPP']: 'F'?>" readonly/>
                                <input type="hidden" id="SYSLD_BOMLOADAPP" name="SYSLD_BOMLOADAPP" value="<?=isset($data['SYSLD_BOMLOADAPP']) ? $data['SYSLD_BOMLOADAPP']: ''?>" readonly/>
                                <input type="hidden" id="ITEMSERIALLFLG" name="ITEMSERIALLFLG" value="<?=isset($data['ITEMSERIALLFLG']) ? $data['ITEMSERIALLFLG']: ''?>" readonly/>
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

        let SYSVIS_REMAKE = document.getElementById('SYSVIS_REMAKE').value;
        let SYSVIS_BMVERSION = document.getElementById('SYSVIS_BMVERSION').value;
        let SYSVIS_BMVERSIONLBL = document.getElementById('SYSVIS_BMVERSIONLBL').value;
        let SYSEN_BOMLOADAPP = document.getElementById('SYSEN_BOMLOADAPP').value;
        // console.log(SYSEN_BOMLOADAPP);
        document.getElementById('REMAKE').classList[SYSVIS_REMAKE == 'T' ? 'remove' : 'add']('hidden');
        document.getElementById('BMVERSION').classList[SYSVIS_BMVERSION == 'T' ? 'remove' : 'add']('hidden');
        document.getElementById('BMVERSIONLBL').classList[SYSVIS_BMVERSIONLBL == 'T' ? 'remove' : 'add']('hidden');
        document.getElementById('ORDER').classList[SYSEN_BOMLOADAPP == 'T' ? 'remove' : 'add']('read');

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 10); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[330px]');
                tablearea.classList.add('h-[440px]');
                maxrow = 15;
            } else {
                tablearea.classList.remove('h-[440px]');
                tablearea.classList.add('h-[330px]');
                maxrow = 10;
            }
            emptyRows(maxrow);
        });

        var index = 0;
        var index = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        // console.log(index);
        OK.click(function() {
            if($('#ITEMCD').val() == '' ) { validationDialog(); return false; }
            let ALLOCSPECIALFLG;
            if(document.getElementById('ALLOCSPECIALFLG').checked) { ALLOCSPECIALFLG = 'T'; } else { ALLOCSPECIALFLG = 'F'; }
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);

            var newRow = $('<tr class="divide-y divide-gray-200 csv" id=rowId'+index+'></tr>');
            var cols = '';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD'+index+'">'+index+'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center" id="ALLOCBASETYP_TD'+index+'">'+ $('#ALLOCBASETYP').val() +'</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left" id="ITEMCD_TD'+index+'">'+ $('#ITEMCD').val() +'</td>';
            cols += '<td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMNAME_TD'+index+'">'+ $('#ITEMNAME').val() +'</td>';
            cols += '<td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMSPEC_TD'+index+'">'+ $('#ITEMSPEC').val() +'</td>';
            cols += '<td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="ALLOCQTY_TD'+index+'">'+ $('#ALLOCQTY').val() +'</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left" id="ITEMUNITTYPSTR_TD'+index+'">'+ $('#ITEMUNITTYP option:selected').text() +'</td>';
            cols += '<td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="ALLOCSPAREQTY_TD'+index+'">'+ $('#ALLOCSPAREQTY').val() +'</td>';
            cols += '<td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="AQTY_TD'+index+'">'+ $('#AQTY').val() +'</td>';
            cols += '<td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="ALLOCWDQTY_TD'+index+'">'+ $('#ALLOCWDQTY').val() +'</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left" id="ALLOCPURORDERNOLN_TD'+index+'">'+ $('#ALLOCPURORDERNOLN').val() +'</td>';
            
            cols += '<td class="hidden exclude"><input id="ROWNO'+index+'" name="ROWNOZ[]" value="'+index+'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCLN'+index+'" name="ALLOCLNZ[]" value="<?=isset($value['ALLOCLN']) ? $value['ALLOCLN']: '' ?>"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCBASETYPSTR'+index+'" name="ALLOCBASETYPSTRZ[]" value="<?=isset($value['ALLOCBASETYPSTR']) ? $value['ALLOCBASETYPSTR']: '' ?>"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCBASETYP'+index+'" name="ALLOCBASETYPZ[]" value="'+ $('#ALLOCBASETYP').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ITEMCD'+index+'" name="ITEMCDZ[]" value="'+ $('#ITEMCD').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ITEMNAME'+index+'" name="ITEMNAMEZ[]" value="'+ $('#ITEMNAME').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ITEMSPEC'+index+'" name="ITEMSPECZ[]" value="'+ $('#ITEMSPEC').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ITEMDRAWNO'+index+'" name="ITEMDRAWNOZ[]" value="'+ $('#ITEMDRAWNO').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCQTY'+index+'" name="ALLOCQTYZ[]" value="'+ $('#ALLOCQTY').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCDRAWNO'+index+'" name="ALLOCDRAWNOZ[]" value="'+ $('#ALLOCDRAWNO').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCORDERFLG'+index+'" name="ALLOCORDERFLGZ[]" value="'+ $('#ALLOCORDERFLG').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCPURORDERNOLN'+index+'" name="ALLOCPURORDERNOLNZ[]" value="'+ $('#ALLOCPURORDERNOLN').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCREM'+index+'" name="ALLOCREMZ[]" value="<?=isset($value['ALLOCREM']) ? $value['ALLOCREM']: '' ?>"></td>';
            cols += '<td class="hidden exclude"><input id="ITEMUNITTYP'+index+'" name="ITEMUNITTYPZ[]" value="'+$('#ITEMUNITTYP').val()+'"/></td>';
            cols += '<td class="hidden exclude"><input id="ITEMUNITTYPSTR'+index+'" name="ITEMUNITTYPSTRZ[]" value="'+ $('#ITEMUNITTYP option:selected').text() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCSPAREQTY'+index+'" name="ALLOCSPAREQTYZ[]" value="'+ $('#ALLOCSPAREQTY').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCWDQTY'+index+'" name="ALLOCWDQTYZ[]" value="'+ $('#ALLOCWDQTY').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="AQTY'+index+'" name="AQTYZ[]" value="'+ $('#AQTY').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCPLANWDDT'+index+'" name="ALLOCPLANWDDTZ[]" value="'+ $('#ALLOCPLANWDDT').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCDRAWDT'+index+'" name="ALLOCDRAWDTZ[]" value="'+ $('#ALLOCDRAWDT').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCSPECIALFLG'+index+'" name="ALLOCSPECIALFLGZ[]" value="'+ ALLOCSPECIALFLG +'"></td>';
            cols += '<td class="hidden exclude"><input id="MATERIALCD'+index+'" name="MATERIALCDZ[]" value="'+ $('#MATERIALCD').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="MATERIALNAME'+index+'" name="MATERIALNAMEZ[]" value="'+ $('#MATERIALNAME').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="PITEMCD'+index+'" name="PITEMCDZ[]" value="'+ $('#PITEMCODE').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="PITEMNAME'+index+'" name="PITEMNAMEZ[]" value="'+ $('#PITEMNAME').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ALLOCLASTWDDT'+index+'" name="ALLOCLASTWDDTZ[]" value="'+ $('#ALLOCLASTWDDT').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="ITEMSERIALLFLG'+index+'" name="ITEMSERIALLFLGZ[]" value="'+ $('#ITEMSERIALLFLG').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="SYSEN_BOMLOADAPP'+index+'" name="SYSEN_BOMLOADAPPZ[]" value="'+ $('#SYSEN_BOMLOADAPP').val() +'"></td>';
            cols += '<td class="hidden exclude"><input id="SYSLD_BOMLOADAPP'+index+'" name="SYSLD_BOMLOADAPPZ[]" value="'+ $('#SYSLD_BOMLOADAPP').val() +'"></td>';

            if(index <= maxrow) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').removeAttr('class', 'row-empty');
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $('table tbody').append(newRow);
            }
            $('#rowCount').html(index);
            // calculateTotal();
            keepItemData();
            return entry();
        });

        UPDATE.click(async function() {
            let rowno = $('#ROWNO').val();
            if(rowno != '') {
                let ALLOCSPECIALFLG;
                if(document.getElementById('ALLOCSPECIALFLG').checked) { ALLOCSPECIALFLG = 'T'; } else { ALLOCSPECIALFLG = 'F'; }
            
                $('#ROWNO_TD'+rowno+'').html($('#ROWNO').val());
                $('#ALLOCBASETYP_TD'+rowno+'').html(document.getElementById('ALLOCBASETYP').value);
                $('#ITEMCD_TD'+rowno+'').html($('#ITEMCD').val());
                $('#ITEMNAME_TD'+rowno+'').html($('#ITEMNAME').val());
                $('#ITEMSPEC_TD'+rowno+'').html($('#ITEMSPEC').val());
                $('#ALLOCQTY_TD'+rowno+'').html($('#ALLOCQTY').val());
                $('#ITEMUNITTYPSTR_TD'+rowno+'').html($('#ITEMUNITTYP option:selected').text());
                $('#ALLOCSPAREQTY_TD'+rowno+'').html($('#ALLOCSPAREQTY').val());
                $('#AQTY_TD'+rowno+'').html($('#AQTY').val());
                $('#ALLOCWDQTY_TD'+rowno+'').html($('#ALLOCWDQTY').val());
                $('#ALLOCPURORDERNOLN_TD'+rowno+'').html($('#ALLOCPURORDERNOLN').val());

                $('#ROWNO'+rowno+'').val($('#ROWNO').val());
                $('#ALLOCLN'+rowno+'').val($('#ALLOCLN').val());
                $('#AQTY'+rowno+'').val($('#AQTY').val());
                $('#ALLOCBASETYP'+rowno+'').val(document.getElementById('ALLOCBASETYP').value);
                $('#ITEMCD'+rowno+'').val($('#ITEMCD').val());
                $('#ITEMNAME'+rowno+'').val($('#ITEMNAME').val());
                $('#ITEMSPEC'+rowno+'').val($('#ITEMSPEC').val());
                $('#ITEMDRAWNO'+rowno+'').val($('#ITEMDRAWNO').val());
                $('#MATERIALCD'+rowno+'').val($('#MATERIALCD').val());
                $('#MATERIALNAME'+rowno+'').val($('#MATERIALNAME').val());
                $('#PITEMCD'+rowno+'').val($('#PITEMCODE').val());
                $('#PITEMNAME'+rowno+'').val($('#PITEMNAME').val());
                $('#ALLOCQTY'+rowno+'').val($('#ALLOCQTY').val());
                $('#ALLOCSPAREQTY'+rowno+'').val($('#ALLOCSPAREQTY').val());
                $('#ALLOCWDQTY'+rowno+'').val($('#ALLOCWDQTY').val());
                $('#ALLOCDRAWNO'+rowno+'').val($('#ALLOCDRAWNO').val());
                $('#ALLOCLASTWDDT'+rowno+'').val(slashFormatDate($('#ALLOCLASTWDDT').val()));
                $('#ALLOCPLANWDDT'+rowno+'').val(slashFormatDate($('#ALLOCPLANWDDT').val()));
                $('#ALLOCDRAWDT'+rowno+'').val(slashFormatDate($('#ALLOCDRAWDT').val()));
                $('#ALLOCPURORDERNOLN'+rowno+'').val($('#ALLOCPURORDERNOLN').val());
                $('#ALLOCREM'+rowno+'').val($('#ALLOCREM').val());
                $('#ITEMSERIALLFLG'+rowno+'').val($('#ITEMSERIALLFLG').val());
                $('#SYSEN_BOMLOADAPP'+rowno+'').val($('#SYSEN_BOMLOADAPP').val());
                $('#SYSLD_BOMLOADAPP'+rowno+'').val($('#SYSLD_BOMLOADAPP').val());

                $('#ITEMUNITTYP'+rowno+'').val(document.getElementById('ITEMUNITTYP').value);
                $('#ITEMUNITTYPSTR'+rowno+'').val($('#ITEMUNITTYP option:selected').text());
                $('#ALLOCSPECIALFLG'+rowno+'').val(ALLOCSPECIALFLG);
                $('#ALLOCBASETYPSTR'+rowno+'').val($('#ALLOCBASETYPSTR').val());
                $('#ALLOCORDERFLG'+rowno+'').val(document.getElementById('ALLOCORDERFLG').value);

                document.getElementById('OK').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;
                // document.getElementById('ORDER').disabled = true;
                document.getElementById('ORDER').classList.add('read');

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
            unsetItemData(id);
            changeRowId();
            id = null;
            entry(); $('#loading').show();
            return window.location.href = 'index.php';
            // return window.location.reload();
        });

        // $('table#table tr').click(function () {
        $(document).on('click', '.pdb tbody tr', function(event) {
            $('table#table tbody tr').not(this).removeClass('selected'); entry();
            let item = $(this).closest('tr').children('td');
            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                let rec = item.eq(0).text();
                let table = document.getElementById('table');
                if(rec != '') { 
                    table.rows[rec].classList.toggle('selected');
                }
                // console.log(rec);
                $('#ROWNO').val($('#ROWNO'+rec+'').val());
                $('#ALLOCLN').val($('#ALLOCLN'+rec+'').val());
                $('#AQTY').val($('#AQTY'+rec+'').val());
                $('#ALLOCBASETYP').val($('#ALLOCBASETYP'+rec+'').val());
                $('#ITEMCD').val($('#ITEMCD'+rec+'').val());
                $('#ITEMNAME').val($('#ITEMNAME'+rec+'').val());
                $('#ITEMSPEC').val($('#ITEMSPEC'+rec+'').val());
                $('#ITEMDRAWNO').val($('#ITEMDRAWNO'+rec+'').val());
                $('#MATERIALCD').val($('#MATERIALCD'+rec+'').val());
                $('#MATERIALNAME').val($('#MATERIALNAME'+rec+'').val());
                $('#PITEMCODE').val($('#PITEMCD'+rec+'').val());
                $('#PITEMNAME').val($('#PITEMNAME'+rec+'').val());
                $('#ALLOCQTY').val($('#ALLOCQTY'+rec+'').val());
                $('#ALLOCSPAREQTY').val($('#ALLOCSPAREQTY'+rec+'').val());
                $('#ALLOCWDQTY').val($('#ALLOCWDQTY'+rec+'').val());
                $('#ALLOCDRAWNO').val($('#ALLOCDRAWNO'+rec+'').val());
                if($('#ALLOCLASTWDDT'+rec+'').val() != '' && $('#ALLOCLASTWDDT'+rec+'').val() != undefined) {
                    $('#ALLOCLASTWDDT').val($('#ALLOCLASTWDDT'+rec+'').val().replaceAll('/','-'));
                }
                if($('#ALLOCPLANWDDT'+rec+'').val() != '' && $('#ALLOCPLANWDDT'+rec+'').val() != undefined) {
                    $('#ALLOCPLANWDDT').val($('#ALLOCPLANWDDT'+rec+'').val().replaceAll('/','-'));
                }   
                if($('#ALLOCDRAWDT'+rec+'').val() != '' && $('#ALLOCDRAWDT'+rec+'').val() != undefined) {
                    $('#ALLOCDRAWDT').val($('#ALLOCDRAWDT'+rec+'').val().replaceAll('/','-'));
                } 
                $('#ALLOCPURORDERNOLN').val($('#ALLOCPURORDERNOLN'+rec+'').val());
                $('#ALLOCREM').val($('#ALLOCREM'+rec+'').val());
                $('#ITEMSERIALLFLG').val($('#ITEMSERIALLFLG'+rec+'').val());
                $('#SYSEN_BOMLOADAPP').val($('#SYSEN_BOMLOADAPP'+rec+'').val());
                $('#SYSLD_BOMLOADAPP').val($('#SYSLD_BOMLOADAPP'+rec+'').val());

                document.getElementById('ITEMUNITTYP').value = $('#ITEMUNITTYP'+rec+'').val();
                document.getElementById('ITEMUNITTYPE').value = $('#ITEMUNITTYP'+rec+'').val();
                document.getElementById('ALLOCORDERFLG').value = $('#ALLOCORDERFLG'+rec+'').val();

                if ($('#ALLOCSPECIALFLG'+rec+'').val() == 'T') {
                   document.getElementById('ALLOCSPECIALFLG').checked = true;
                } else {
                    document.getElementById('ALLOCSPECIALFLG').checked = false;
                }

                document.getElementById('OK').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;

                let SYSEN_BOMLOADAPP = document.getElementById('SYSEN_BOMLOADAPP').value;
                document.getElementById('ORDER').classList[SYSEN_BOMLOADAPP == 'T' ? 'remove' : 'add']('read');

                return unRequired();
            }
        });
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'ALLOCORDERNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function HandlePopupItem(result, index)   {
        $('#loading').show();
        if(index == 1) {
            return getElement('ITEMCD', result);
        } else if(index == 2) {
            return getElement('PITEMCODE', result);
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