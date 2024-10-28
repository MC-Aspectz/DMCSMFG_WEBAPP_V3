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
            <form class="w-full" method="POST" id="warehouseEntry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="PRODUCTIONORDER_TXT"><?=checklang('PRODUCTIONORDER')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="PROORDERNO" name="PROORDERNO" value="<?=isset($data['PROORDERNO']) ? $data['PROORDERNO']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPRODUCTIONORDER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('WC_CODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="WCCD" name="WCCD" value="<?=isset($data['WCCD']) ? $data['WCCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="WCNAME" name="WCNAME" value="<?=isset($data['WCNAME']) ? $data['WCNAME']: ''; ?>" readonly/>     
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALES_ORDER_NO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PROSALENOLN" name="PROSALENOLN" value="<?=isset($data['PROSALENOLN']) ? $data['PROSALENOLN']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('BRANCH_TYPE')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300 read" id="PROFACTYP" name="PROFACTYP" readonly>
                                            <option value=""></option>
                                            <?php foreach ($FACTORY as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['PROFACTYP']) && $data['PROFACTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="PERSON_RESPONSE_TXT"><?=checklang('PERSON_RESPONSE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="STAFFCD" name="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>  
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="ITEMCD" id="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ITEMDRAWNO" name="ITEMDRAWNO" value="<?=isset($data['ITEMDRAWNO']) ? $data['ITEMDRAWNO']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="MATERIALCODE_TXT"><?=checklang('MATERIALCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="MATERIALCD" id="MATERIALCD" value="<?=isset($data['MATERIALCD']) ? $data['MATERIALCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="MATERIALNAME" name="MATERIALNAME" value="<?=isset($data['MATERIALNAME']) ? $data['MATERIALNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="REMARK_TXT"><?=checklang('REMARK')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-9/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="PROREM" id="PROREM" value="<?=isset($data['PROREM']) ? $data['PROREM']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DESTINATE_STORAGE')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-4/12 mr-1 text-left rounded-xl border-gray-300 read" id="LOCTYP" name="LOCTYP" readonly>
                                                <option value=""></option>
                                                <?php foreach ($STORAGETYPE as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['LOCTYP']) && $data['LOCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                        </select>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                    id="LOCCD" name="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="LOCNAME" name="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center" id="REMARK_TXT"><?=checklang('STATUS')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300 read" id="PROSTATUS" name="PROSTATUS" readonly>
                                            <option value=""></option>
                                            <?php foreach ($STATUS_ORDER as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['PROSTATUS']) && $data['PROSTATUS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ORDER_QTY_PRO')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="PROQTY" name="PROQTY" value="<?=!empty($data['PROQTY']) ?  number_format(str_replace(',', '',$data['PROQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" id="ITEMUNITTYP" name="ITEMUNITTYP">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-4/12 pl-6 pt-1"><?=checklang('START_DATE_PRODUCE')?></label>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                id="PROPLANSTARTDT" name="PROPLANSTARTDT" value="<?=!empty($data['PROPLANSTARTDT']) ? date('Y-m-d', strtotime($data['PROPLANSTARTDT'])) : ''; ?>"/>
                                    </div>
                                </div>   

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REMAIN_ORDER_QTY')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="PROTRANWAITQTY" name="PROTRANWAITQTY" value="<?=!empty($data['PROTRANWAITQTY']) ?  number_format(str_replace(',', '',$data['PROTRANWAITQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 read">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-4/12 pl-6 pt-1"><?=checklang('PROD_DUEDATE')?></label>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                id="PROPLANENDDT" name="PROPLANENDDT" value="<?=!empty($data['PROPLANENDDT']) ? date('Y-m-d', strtotime($data['PROPLANENDDT'])) : ''; ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('COMP_QTY')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="PROCOMPQTY" name="PROCOMPQTY" value="<?=!empty($data['PROCOMPQTY']) ?  number_format(str_replace(',', '',$data['PROCOMPQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-4/12 pl-6 pt-1"><?=checklang('INSPECTION')?></label>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 read" id="PROINSPTYP" name="PROINSPTYP">
                                            <option value=""></option>
                                            <?php foreach ($INSPECTION as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['PROINSPTYP']) && $data['PROINSPTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>  

                <hr class="divide-y divide-dotted my-2 mx-2">


                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WAREHOUSE_ACT_DATE')?></label>
                        <input type="date" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-4/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-center"
                                id="PROTRANDT" name="PROTRANDT" value="<?=!empty($data['PROTRANDT']) ? date('Y-m-d', strtotime($data['PROTRANDT'])): date('Y-m-d'); ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('VOUCHER_NO')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                    id="PROTRANORDERNO" name="PROTRANORDERNO" value="<?=isset($data['PROTRANORDERNO']) ? $data['PROTRANORDERNO']: ''; ?>" onchange="unRequired();"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHPROTRAN">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input class="hidden" type="hidden" id="TRANID" name="TRANID" value="<?=isset($data['TRANID']) ? $data['TRANID']: ''; ?>" />
                        <input class="hidden" type="hidden" id="PROTRANBADQTY" name="PROTRANBADQTY" value="<?=isset($data['PROTRANBADQTY']) ? $data['PROTRANBADQTY']: ''; ?>" />
                        <input class="hidden" type="hidden" id="BFPROTRANQTY" name="BFPROTRANQTY" value="<?=isset($data['BFPROTRANQTY']) ? $data['BFPROTRANQTY']: ''; ?>" />
                        <input class="hidden" type="hidden" id="PROSCRAPPROORDERNO" name="PROSCRAPPROORDERNO" value="<?=isset($data['PROSCRAPPROORDERNO']) ? $data['PROSCRAPPROORDERNO']: ''; ?>" />
                        <input class="hidden" type="hidden" id="SYSMSG" name="SYSMSG" value="<?=isset($data['SYSMSG']) ? $data['SYSMSG']: ''; ?>" />
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WAREHOUSE_QTY')?></label>
                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-4/12 mr-2 py-2 px-1 text-gray-700 border-gray-300 text-right req"
                                id="PROTRANQTY" name="PROTRANQTY" value="<?=!empty($data['PROTRANQTY']) ?  number_format(str_replace(',', '',$data['PROTRANQTY']), 2): ''; ?>"
                                onchange="this.value = num2digit(this.value); unRequired();" oninput="this.value = stringReplacez(this.value);"/>
                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 read">
                            <option value=""></option>
                            <?php foreach ($UNIT as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>  

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BAD_QTY')?></label>
                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-4/12 mr-2 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                id="SUMBADQTY" name="SUMBADQTY" value="<?=!empty($data['SUMBADQTY']) ?  number_format(str_replace(',', '',$data['SUMBADQTY']), 2): ''; ?>"
                                onchange="this.value = num2digit(this.value); unRequired();" oninput="this.value = stringReplacez(this.value);" readonly/>
                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 read">
                            <option value=""></option>
                            <?php foreach ($UNIT as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>  

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INSPECTION')?></label>
                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 req" id="PROTRANINSPTYP" name="PROTRANINSPTYP" onchange="unRequired();">
                            <option value=""></option>
                            <?php foreach ($INSPECTION as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['PROTRANINSPTYP']) && $data['PROTRANINSPTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>  

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STATUS')?></label>
                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 req" id="PROTRANSTATUS" name="PROTRANSTATUS" onchange="unRequired();">
                            <option value=""></option>
                            <?php foreach ($STATUS_ORDER as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['PROTRANSTATUS']) && $data['PROTRANSTATUS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>  

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REMARK')?></label>
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                             id="PROTRANREM" name="PROTRANREM" value="<?=isset($data['PROTRANREM']) ? $data['PROTRANREM']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>  

                <div class="flex border border-gray-300 mx-2">
                    <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="ADDROW">+</button>
                    <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="DELROW">x</button>
                </div>
                <!-- DVWSCRAP Table -->
                <div id="table-area" class="flex overflow-scroll block h-[165px] mx-2"> 
                    <table id="tableScrap" class="w-full border-collapse border border-slate-500 divide-gray-200 scrap_table" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BAD_REASON')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BAD_QTY')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                        if(!empty($data['DVWSCRAP']))  { $minrow = count($data['DVWSCRAP']);
                            foreach ($data['DVWSCRAP'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 scrapRow" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center scrapRow-id" id="ROWNO_TD<?=$key?>"><?=$key ?></td>
                                    <td class="h-6 w-6/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">
                                        <select class="text-control text-[12px] shadow-md border px-3 h-6 w-full text-left rounded-xl border-gray-300"
                                            id="BADREASON<?=$key?>" name="BADREASON[]">
                                            <?php foreach ($BAD_CODE as $bad => $baditem) { ?>
                                                <option value="<?=$bad ?>" <?=(isset($value['BADREASON']) && $value['BADREASON'] == $bad) ? 'selected' : '' ?>><?=$baditem ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td class="h-6 w-5/12 pr-1 text-sm border border-slate-700 text-right">
                                        <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" 
                                            id="BADQTY<?=$key?>" name="BADQTY[]" value="<?=isset($value['BADQTY']) ? $value['BADQTY']: '' ?>" 
                                            onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                    </td>
                                </tr><?php 
                            }
                        }         
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200 row-empty" id="rowId<?=$i?>">
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                            </tr><?php
                        } ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex p-0">
                    <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="scrapcount"><?=$minrow;?></span></label>
                </div>
          
                
                <div class="flex mt-1 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                                id="INSERT" name="INSERT"><?=checklang('INSERT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?> <?php if(empty($data['PROORDERNO'])) { ?> disabled <?php } ?>
                                id="UPDATE" name="UPDATE"><?=checklang('UPDATE'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?> <?php if(empty($data['PROORDERNO']) ) { ?> disabled <?php } ?>
                                id="DELETE" name="DELETE"><?=checklang('DELETE'); ?></button>
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
        document.getElementById('INSERT').disabled = false;
        document.getElementById('UPDATE').disabled = true;
        document.getElementById('DELETE').disabled = true;

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 5); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[165px]');
                tablearea.classList.remove('h-[250px]');
                maxrow = 15;
            } else {
                tablearea.classList.remove('h-[250px]');
                tablearea.classList.add('h-[165px]');
                maxrow = 5;
            }
            emptyRows(maxrow);
        });

        var idx = '';

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
            let table = document.getElementsByClassName('scrapRow-id');
            let totalRowCount = table.length;
            key = totalRowCount;
            key ++;  // key += 1;
            // console.log(key);
            var newRows = $('<tr class="divide-y divide-gray-200 scrapRow" id="rowId'+key+'">');                      
            var colsc = '';

            colsc += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center scrapRow-id" id="ROWNO_TD'+key+'">'+key+'</td>'; 
            colsc += '<td class="h-6 w-7/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">' + 
                        '<select class="text-control text-[12px] shadow-md border px-3 h-6 w-full text-left rounded-xl border-gray-300"' + 
                        'id="BADREASON'+key+'" name="BADREASON[]">' +
                        '<option value=""></option><?php foreach ($BAD_CODE as $key => $item) { ?><option value="<?=$key ?>"><?=$item ?></option><?php } ?></select></td>';
            colsc += '<td class="h-6 w-5/12 pr-1 text-sm border border-slate-700 text-right">' + 
                        '<input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" ' + 
                        ' id="BADQTY'+key+'" name="BADQTY[]" onchange="this.value = num2digit(this.value);" '+
                        'oninput="this.value = stringReplacez(this.value);"/></td></tr>';
            // console.log(key);
            if(key <= maxrow) {
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
                if(key <= maxrow) {
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

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code =='PROTRANORDERNO') {
            return getElement(code, result); 
        } else {
            return getSearch(code, result);    
        }
    }

    function generateScrap(scrap) {
        // clearScrapTable();
        $('#loading').hide();
        // console.log(scrap);
        let rowCount = 0;
        $.each(scrap, function(key, value) {
        // console.log(value.PROSCRAPQTY);
            var newRows = $('<tr class="divide-y divide-gray-200 scrapRow" id=rowId'+key+'>');                      
            var colsc = '';
            colsc += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center scrapRow-id" id="ROWNO_TD'+key+'">'+key+'</td>';
            colsc += '<td class="h-6 w-7/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap">' + 
                        '<select class="text-control text-sm shadow-md border px-3 h-6 w-full text-left text-[12px] rounded-xl border-gray-300"' + 
                        'id="BADREASON'+key+'" name="BADREASON[]">' +
                        '<option value=""></option><?php foreach ($BAD_CODE as $key => $item) { ?><option value="<?=$key ?>"><?=$item ?></option><?php } ?></select></td>';
            colsc += '<td class="h-6 w-5/12 pr-1 text-sm border border-slate-700 text-right">' + 
                        '<input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" ' + 
                        ' id="BADQTY'+key+'" name="BADQTY[]" value="'+value.BADQTY+'" onchange="this.value = num2digit(this.value);" '+
                        'oninput="this.value = stringReplacez(this.value);"/></td>';

            if(key <= 5) {
                $('#rowId'+key+'').empty();
                $('#rowId'+key+'').append(colsc);
            } else {
                newRows.append(cols);
                $('#tableScrap tbody').append(newRows);
            }
            document.getElementById('BADREASON'+key+'').value = value.BADREASON;
            rowCount++;
        });
        $('#scrapcount').html(rowCount);
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

    function qtyDialog() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('question2'); ?>',
            showCancelButton: true,
            confirmButtonText:  '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
            if (!result.isConfirmed) {
               document.getElementById('PROTRANQTY').value = '';
            }
            unRequired();
        });
    }

    function errorDialog(txt) {
        return Swal.fire({ 
            title: '',
            text: txt,
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