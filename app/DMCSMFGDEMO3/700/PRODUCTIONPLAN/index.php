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
            <form class="w-full" method="POST" id="productionplan" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="FACTORYNAME_TXT"><?=checklang('FACTORYNAME')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="FACTORYCODE" name="FACTORYCODE">
                            <option value=""></option>
                            <?php foreach ($FACTORY as $fac => $factoryitem) { ?>
                                <option value="<?=$fac ?>" <?=(isset($data['FACTORYCODE']) && $data['FACTORYCODE'] == $fac) ? 'selected' : '' ?>><?=$factoryitem ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" id="SYSTIMESTAMP" name="SYSTIMESTAMP" value="<?=isset($data['SYSTIMESTAMP'])? $data['SYSTIMESTAMP']: ''?>">
                    </div>
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="DUE_DATE_TXT"><?=checklang('DUE_DATE')?></label>
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                name="DUEDATES" id="DUEDATES" value="<?=!empty($data['DUEDATES']) ? date('Y-m-d', strtotime($data['DUEDATES'])) : ''; ?>"/>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="IM_TYPE_TXT"><?=checklang('IM_TYPE')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="COSTTYPES" name="COSTTYPES">
                            <option value=""></option>
                            <?php foreach ($COSTTYPE as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['COSTTYPES']) && $data['COSTTYPES'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
 
                <!-- Table -->
                <div id="table-area" class="overflow-scroll px-2 block h-[450px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 pdp" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('NEED_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AS_REQUIRED')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MEASURE_UNIT')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PURCHASE_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOBPLACE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOBPLACENAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STORAGE_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LO_NAME')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 csv" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD<?=$key?>"><?=$key?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="DUEDATE_TD<?=$key?>"><?=isset($value['DUEDATE']) ? $value['DUEDATE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMCODE_TD<?=$key?>"><?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMNAME_TD<?=$key?>"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="QTY_TD<?=$key?>"><?=isset($value['QTY']) ? $value['QTY']:'' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMUNITSTR_TD<?=$key?>"><?=isset($value['ITEMUNIT']) ? $UNIT[$value['ITEMUNIT']]: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="COSTTYPE_TD<?=$key?>"><?=isset($value['COSTTYPE']) ? $COSTTYPE[$value['COSTTYPE']]: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="SUPPLIERCODE_TD<?=$key?>"><?=isset($value['SUPPLIERCODE']) ? $value['SUPPLIERCODE']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="SUPPLIERNAME_TD<?=$key?>"><?=isset($value['SUPPLIERNAME']) ? $value['SUPPLIERNAME']:'' ?></td>  
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCTYP_TD<?=$key?>"><?=isset($value['LOCTYP']) ? $LOCTYP[$value['LOCTYP']]: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCCD_TD<?=$key?>"><?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCNAME_TD<?=$key?>"><?=isset($value['LOCNAME']) ? $value['LOCNAME']:'' ?></td> 

                                    <input type="hidden" id="ROWNO<?=$key?>" name="ROWNOA[]" value="<?=$key?>">
                                    <input type="hidden" id="DUEDATE<?=$key?>" name="DUEDATEA[]" value="<?=isset($value['DUEDATE']) ? $value['DUEDATE']: '' ?>">
                                    <input type="hidden" id="ITEMCODE<?=$key?>" name="ITEMCODEA[]" value="<?=isset($value['ITEMCODE']) ? $value['ITEMCODE']: '' ?>">
                                    <input type="hidden" id="ITEMNAME<?=$key?>" name="ITEMNAMEA[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?>">
                                    <input type="hidden" id="QTY<?=$key?>" name="QTYA[]" value="<?=isset($value['QTY']) ? $value['QTY']: '' ?>">
                                    <input type="hidden" id="ITEMUNIT<?=$key?>" name="ITEMUNITA[]" value="<?=isset($value['ITEMUNIT']) ? $value['ITEMUNIT']: '' ?>">
                                    <input type="hidden" id="ITEMUNITSTR<?=$key?>" name="ITEMUNITSTRA[]" value="<?=isset($value['ITEMUNITSTR']) ? $value['ITEMUNITSTR']: '' ?>">
                                    <input type="hidden" id="COSTTYPE<?=$key?>" name="COSTTYPEA[]" value="<?=isset($value['COSTTYPE']) ? $value['COSTTYPE']: '' ?>">
                                    <input type="hidden" id="COSTTYPESTR<?=$key?>" name="COSTTYPESTRA[]" value="<?=isset($value['COSTTYPESTR']) ? $value['COSTTYPESTR']: '' ?>">
                                    <input type="hidden" id="SUPPLIERCODE<?=$key?>" name="SUPPLIERCODEA[]" value="<?=isset($value['SUPPLIERCODE']) ? $value['SUPPLIERCODE']: '' ?>">
                                    <input type="hidden" id="SUPPLIERNAME<?=$key?>" name="SUPPLIERNAMEA[]" value="<?=isset($value['SUPPLIERNAME']) ? $value['SUPPLIERNAME']: '' ?>">
                                    <input type="hidden" id="LOCTYP<?=$key?>" name="LOCTYPA[]" value="<?=isset($value['LOCTYP']) ? $value['LOCTYP']: '' ?>">
                                    <input type="hidden" id="LOCTYPSTR<?=$key?>" name="LOCTYPSTRA[]" value="<?=isset($value['LOCTYPSTR']) ? $value['LOCTYPSTR']: '' ?>">
                                    <input type="hidden" id="LOCCD<?=$key?>" name="LOCCDA[]" value="<?=isset($value['LOCCD']) ? $value['LOCCD']: '' ?>">
                                    <input type="hidden" id="LOCNAME<?=$key?>" name="LOCNAMEA[]" value="<?=isset($value['LOCNAME']) ? $value['LOCNAME']: '' ?>">
                                    <input type="hidden" id="SYSVIS_LOADAPP<?=$key?>" name="SYSVIS_LOADAPPA[]" value="<?=isset($value['SYSVIS_LOADAPP']) ? $value['SYSVIS_LOADAPP']: '' ?>">
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
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 mr-2 py-1 text-center"
                                            id="PLANVIEW1" name="PLANVIEW1"><?=checklang('PLANVIEW'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center"
                                            id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                                    </div>
                                </summary>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="ITEMCODE" name="ITEMCODE" value="<?=isset($data['ITEMCODE']) ? $data['ITEMCODE']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEMPROPLAN">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                        <input class="hidden" type="hidden" id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="SYSVIS_LOADAPP" name="SYSVIS_LOADAPP" value="<?=isset($data['SYSVIS_LOADAPP']) ? $data['SYSVIS_LOADAPP']: ''; ?>" />
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DUE_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center req"
                                                id="DUEDATE" name="DUEDATE" value="<?=!empty($data['DUEDATE']) ? date('Y-m-d', strtotime($data['DUEDATE'])) : ''; ?>" onchange="unRequired();"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ORDER_QTY_PUR')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-4/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right req"
                                                id="QTY" name="QTY" value="<?=!empty($data['QTY']) ?  number_format(str_replace(',', '',$data['QTY']), 2): ''; ?>"
                                                onchange="this.value = number2digit(this.value); unRequired();" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                        <select class="text-control text-sm shadow-md border px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 read" id="ITEMUNIT" name="ITEMUNIT">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNIT']) && $data['ITEMUNIT'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12 px-2"></div>
                                </div>  

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DESTINATE_STORAGE')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 mr-1 text-left rounded-xl border-gray-300 req" id="LOCTYP" name="LOCTYP" onchange="unRequired();">
                                            <option value=""></option>
                                            <?php foreach ($STORAGETYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['LOCTYP']) && $data['LOCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="relative w-5/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req" id="LOCCD" name="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHLOC">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read" id="LOCNAME" name="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ORDER_COM')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 mr-1 text-left rounded-xl border-gray-300 read" id="COSTTYPE" name="COSTTYPE">
                                            <option value=""></option>
                                            <?php foreach ($COSTTYPE as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['COSTTYPE']) && $data['COSTTYPE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="relative w-5/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="SUPPLIERCODE" name="SUPPLIERCODE" value="<?=isset($data['SUPPLIERCODE']) ? $data['SUPPLIERCODE']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHOFFER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="SUPPLIERNAME" name="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>" readonly/>
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
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;
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
    document.getElementById('OK').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;
    document.getElementById('PLANVIEW1').disabled = true;

    let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 17); ?>';
    const tablearea = document.getElementById('table-area');
    const details = document.querySelector('details');
    details.addEventListener('toggle', function() {
        if (!details.open) {
            tablearea.classList.remove('h-[450px]');
            tablearea.classList.add('h-[570px]');
            maxrow = 22;
        } else {
            tablearea.classList.remove('h-[570px]');
            tablearea.classList.add('h-[450px]');
            maxrow = 17;
        }
        emptyRows(maxrow);
    })

    var index = 0;
    var index = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
   
    OK.click(function() {
        if($('#ITEMCODE').val() == '' || $('#QTY').val() == '' || $('#DUEDATE').val() == '' || $('#SUPPLIERCODE').val() == '' || $('#LOCTYP').val() == '' || $('#LOCCD').val() == '' ) {
            validationDialog();
            return false;
        }
        // console.log('index before' + index);
        index ++;  // index += 1;
        var newRow = $('<tr class="divide-y divide-gray-200 csv" id=rowId'+index+'></tr>');
        var cols = "";

        cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD' + index + '">' + index + '</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="DUEDATE_TD'+index+'">'+ $('#DUEDATE').val() +'</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMCODE_TD'+index+'">'+ $('#ITEMCODE').val() +'</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMNAME_TD'+index+'">'+ $('#ITEMNAME').val() +'</td>';
        cols += '<td class="h-6 w-1/12 pr-2 text-sm border border-slate-700 text-right" id="QTY_TD'+index+'">'+ $('#QTY').val() +'</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="ITEMUNIT_TD'+index+'"> '+ $("#ITEMUNIT option:selected").text() +'</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="COSTTYPE_TD'+index+'"> '+ $("#COSTTYPE option:selected").text() +'</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="SUPPLIERCODE_TD'+index+'">'+ $('#SUPPLIERCODE').val() +'</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="SUPPLIERNAME_TD'+index+'">'+ $('#SUPPLIERNAME').val() +'</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCTYP_TD'+index+'"> '+ $("#LOCTYP option:selected").text() +'</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCCD_TD'+index+'">'+ $('#LOCCD').val() +'</td>';
        cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="LOCNAME_TD'+index+'">'+ $('#LOCNAME').val() +'</td>';

        cols += '<input type="hidden" id="ROWNO'+index+'" name="ROWNOA[]" value="'+index+'">';
        cols += '<input type="hidden" id="DUEDATE'+index+'" name="DUEDATEA[]" value="'+ $('#DUEDATE').val() +'">';
        cols += '<input type="hidden" id="ITEMCODE'+index+'" name="ITEMCODEA[]" value="'+ $('#ITEMCODE').val() +'">';
        cols += '<input type="hidden" id="ITEMNAME'+index+'" name="ITEMNAMEA[]" value="'+ $('#ITEMNAME').val() +'">';
        cols += '<input type="hidden" id="QTY'+index+'" name="QTYA[]" value="'+ $('#QTY').val() +'">';
        cols += '<input type="hidden" id="ITEMUNIT'+index+'" name="ITEMUNITA[]" value="'+ document.getElementById('ITEMUNIT').value +'">';
        cols += '<input type="hidden" id="ITEMUNITSTR'+index+'" name="ITEMUNITSTRA[]" value="'+ $('#ITEMUNIT option:selected').text() +'">';
        cols += '<input type="hidden" id="COSTTYPE'+index+'" name="COSTTYPEA[]" value="'+ document.getElementById('COSTTYPE').value +'">';
        cols += '<input type="hidden" id="COSTTYPESTR'+index+'" name="COSTTYPESTRA[]" value="'+ $('#COSTTYPE option:selected').text() +'">';
        cols += '<input type="hidden" id="SUPPLIERCODE'+index+'" name="SUPPLIERCODEA[]" value="'+ $('#SUPPLIERCODE').val() +'">';
        cols += '<input type="hidden" id="SUPPLIERNAME'+index+'" name="SUPPLIERNAMEA[]" value="'+ $('#SUPPLIERNAME').val() +'">';
        cols += '<input type="hidden" id="LOCTYP'+index+'" name="LOCTYPA[]" value="'+ document.getElementById('LOCTYP').value +'">';
        cols += '<input type="hidden" id="LOCTYPSTR'+index+'" name="LOCTYPSTRA[]" value="'+ $('#LOCTYP option:selected').text() +'">';
        cols += '<input type="hidden" id="LOCCD'+index+'" name="LOCCDA[]" value="'+ $('#LOCCD').val() +'">';
        cols += '<input type="hidden" id="LOCNAME'+index+'" name="LOCNAMEA[]" value="'+ $('#LOCNAME').val() +'">';
        cols += '<input type="hidden" id="SYSVIS_LOADAPP'+index+'" name="SYSVIS_LOADAPPA[]" value="'+ $('#SYSVIS_LOADAPP').val() +'">';

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
            $('#DUEDATE_TD'+rowno+'').html($('#DUEDATE').val());
            $('#ITEMCODE_TD'+rowno+'').html($('#ITEMCODE').val());
            $('#ITEMNAME_TD'+rowno+'').html($('#ITEMNAME').val());
            $('#QTY_TD'+rowno+'').html($('#QTY').val());
            $('#ITEMUNITSTR_TD'+rowno+'').html($('#ITEMUNIT option:selected').text());
            $('#COSTTYPE_TD'+rowno+'').html($("#COSTTYPE option:selected").text());
            $('#SUPPLIERCODE_TD'+rowno+'').html($('#SUPPLIERCODE').val());
            $('#SUPPLIERNAME_TD'+rowno+'').html($('#SUPPLIERNAME').val());
            $('#LOCTYP_TD'+rowno+'').html($('#LOCTYP option:selected').text());
            $('#LOCCD_TD'+rowno+'').html($('#LOCCD').val());
            $('#LOCNAME_TD'+rowno+'').html($('#LOCNAME').val());
         
            $('#ROWNO'+rowno+'').val($('#ROWNO').val());
            $('#DUEDATE'+rowno+'').val($('#DUEDATE').val());
            $('#ITEMCODE'+rowno+'').val($('#ITEMCODE').val());
            $('#ITEMNAME'+rowno+'').val($('#ITEMNAME').val());
            $('#QTY'+rowno+'').val($('#QTY').val());
            $('#ITEMUNIT'+rowno+'').val(document.getElementById('ITEMUNIT').value);
            $('#ITEMUNITSTR'+rowno+'').val($('#ITEMUNIT option:selected').text());
            $('#COSTTYPE'+rowno+'').val($('#COSTTYPE').val());
            $('#COSTTYPESTR'+rowno+'').val($('#COSTTYPE option:selected').text());
            $('#SUPPLIERCODE'+rowno+'').val($('#SUPPLIERCODE').val());
            $('#SUPPLIERNAME'+rowno+'').val($('#SUPPLIERNAME').val());
            $('#LOCTYP'+rowno+'').val(document.getElementById('LOCTYP').value);
            $('#LOCTYPSTR'+rowno+'').val($('#LOCTYP option:selected').text());
            $('#LOCCD'+rowno+'').val($('#LOCCD').val());
            $('#LOCNAME'+rowno+'').val($('#LOCNAME').val());
            // $('#SYSVIS_LOADAPP'+rowno+'').val($('#SYSVIS_LOADAPP').val());

            document.getElementById('OK').disabled = true;
            document.getElementById('UPDATE').disabled = false;
            document.getElementById('DELETE').disabled = false;
            document.getElementById('PLANVIEW1').disabled = true;

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

    $(document).on('click', '.pdp tbody tr', function(event) {
        $('table#table tr').not(this).removeClass('selected'); entry();
        let item = $(this).closest('tr').children('td');
        if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
            let rec = item.eq(0).text();
            let table = document.getElementById('table');
            if(rec != '') { 
                table.rows[rec].classList.toggle('selected');
            }

            $('#ROWNO').val($('#ROWNO'+rec+'').val());
            $('#ITEMCODE').val($('#ITEMCODE'+rec+'').val());
            $('#ITEMNAME').val($('#ITEMNAME'+rec+'').val());
            $('#DUEDATE').val($('#DUEDATE'+rec+'').val().replaceAll('/','-'));
            $('#QTY').val($('#QTY'+rec+'').val());
            $('#SUPPLIERCODE').val($('#SUPPLIERCODE'+rec+'').val());
            $('#SUPPLIERNAME').val($('#SUPPLIERNAME'+rec+'').val());
            $('#LOCCD').val($('#LOCCD'+rec+'').val());
            $('#LOCNAME').val($('#LOCNAME'+rec+'').val());
            $('#SYSVIS_LOADAPP').val($('#SYSVIS_LOADAPP'+rec+'').val());

            document.getElementById('ITEMUNIT').value = $('#ITEMUNIT'+rec+'').val();
            document.getElementById('LOCTYP').value = $('#LOCTYP'+rec+'').val();
            document.getElementById('COSTTYPE').value = $('#COSTTYPE'+rec+'').val();

            document.getElementById('OK').disabled = true;
            document.getElementById('UPDATE').disabled = false;
            document.getElementById('DELETE').disabled = false;
            document.getElementById('PLANVIEW1').disabled = false;
           // document.getElementById('PLANVIEW1').classList.add('hidden');
            return unRequired();
        }
    });
});

function HandlePopupResult(code, result) {
    // console.log('result of popup is: ' + code + ' : ' + result);
    if(code == 'SUPPLIERCODE') {
        return getSW(result, $('#COSTTYPE').val());
    } else if(code == 'LOCCD') {
        return getLoc(result, $('#LOCTYP').val());
    } else {
        return getElement('ITEMCODE', result);
    }
}

function validationDialog() {
    return Swal.fire({ 
        title: '',
        text: '<?=$lang['validation1']; ?>',
        showCancelButton: false,
        confirmButtonText:  '<?=$lang['yes']; ?>',
        cancelButtonText: '<?=$lang['no']; ?>'
        }).then((result) => {
        if (result.isConfirmed) {
         //
        }
    });
}
</script>