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
            <form class="w-full" method="POST" id="saleAnalyze" name="saleAnalyze" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1 px-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="ST_YYMM"><?=checklang('ST_YYMM')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 mr-1 text-left rounded-xl border-gray-300 read" id="YEARVALUE" name="YEARVALUE">
                                            <option value=""></option>
                                            <?php foreach ($yearvalue as $year => $yearitem) { ?>
                                                <option value="<?=$year ?>" <?=(isset($data['YEARVALUE']) && $data['YEARVALUE'] == $year) ? 'selected' : '' ?>><?=$yearitem ?></option>
                                            <?php } ?>
                                        </select>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 mr-1 text-left rounded-xl border-gray-300 read" id="MONTHVALUE" name="MONTHVALUE">
                                            <option value=""></option>
                                            <?php foreach ($monthvalue as $month => $monthitem) { ?>
                                                <option value="<?=$month ?>" <?=(isset($data['MONTHVALUE']) && $data['MONTHVALUE'] == $month) ? 'selected' : '' ?>><?=$monthitem ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center" id="DO_TXT"><?=checklang('DO_TXT')?></label>
                                        <input class="read pt-1" type="checkbox" id="KAKUTEITORIKOM" name="KAKUTEITORIKOM" value="T" <?=(isset($data['KAKUTEITORIKOM']) && $data['KAKUTEITORIKOM'] == 'T') ? 'checked': '';?>/>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="KAKU"><?=checklang('KAKUTEITORIKOM')?></label>
                                    </div>

                                    <div class="flex w-6/12">
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                id="PLANDT" name="PLANDT" value="<?=!empty($data['PLANDT']) ? date('Y-m-d', strtotime($data['PLANDT'])): ''; ?>"/>
                                        <label class="text-color block text-[12px] w-5/12 pt-1 text-center" id="SALE_PLAN_TXT"><?=checklang('SALE_PLAN_TXT')?></label>
                                        <label class="text-color block text-[13px] w-2/12 pt-1 text-center" id="INPUT_DATE"><?=checklang('INPUT_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="ENTRYDT" name="ENTRYDT" value="<?=!empty($data['ENTRYDT']) ? date('Y-m-d', strtotime($data['ENTRYDT'])): date('Y-m-d'); ?>"/>
                                        <input class="hidden" type="hidden" id="SYSTIMESTAMP" name="SYSTIMESTAMP" value="<?=!empty($data['SYSTIMESTAMP']) ? $data['SYSTIMESTAMP']: ''; ?>" />
                                    </div>
                                </div>

                                <div class="flex mb-1 px-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="PERSON_RESPONSE"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="STAFFCD" name="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-[12px] w-5/12 pl-2 pt-1" id="MPS_MSG"><?=checklang('MPS_MSG')?></label>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="FIXED_ORDER"><?=checklang('FIXED_ORDER')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="ITEMFIXORDER" name="ITEMFIXORDER" value="<?=!empty($data['ITEMFIXORDER']) ?  number_format(str_replace(',', '',$data['ITEMFIXORDER']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" id="ITEMUNITTYP" name="ITEMUNITTYP" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="ITEMCODE"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                        <input type="hidden" id="FIRST_PREBALANCEQTY" name="FIRST_PREBALANCEQTY" value="<?=!empty($data['FIRST_PREBALANCEQTY']) ? $data['FIRST_PREBALANCEQTY']: ''; ?>" />
                                        <input type="hidden" id="FIRST_PREORDERQTY" name="FIRST_PREORDERQTY" value="<?=!empty($data['FIRST_PREORDERQTY']) ? $data['FIRST_PREORDERQTY']: ''; ?>" />                                
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1" id="LEADTIME"><?=checklang('LEADTIME')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-center read"
                                                id="ITEMLEADTIME" name="ITEMLEADTIME" value="<?=!empty($data['ITEMLEADTIME']) ? number_format($data['ITEMLEADTIME'], 0): ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center" id="DAY"><?=checklang('DAY')?></label>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="BUFFER_STOCK"><?=checklang('BUFFER_STOCK')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="ITEMMINSTOCK" name="ITEMMINSTOCK" value="<?=!empty($data['ITEMMINSTOCK']) ?  number_format(str_replace(',', '',$data['ITEMMINSTOCK']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="flex mb-1 px-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="DRAWING"><?=checklang('DRAWING')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="ITEMDRAWNO" name="ITEMDRAWNO" value="<?=isset($data['ITEMDRAWNO']) ? $data['ITEMDRAWNO']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>                        
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-[12px] w-2/12 pl-2 pt-1" id="DAILY_QTY"><?=checklang('DAILY_QTY')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-center read"
                                                id="ITEMBADRATE" name="ITEMBADRATE" value="<?=!empty($data['ITEMBADRATE']) ? number_format($data['ITEMBADRATE'], 2): ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"></label>
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="ONH"><?=checklang('ONHAND')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="ONHAND" name="ONHAND" value="<?=!empty($data['ONHAND']) ?  number_format(str_replace(',', '',$data['ONHAND']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="flex mb-1 px-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="CATEGORY_CODE"><?=checklang('CATEGORY_CODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="CATALOGCD" name="CATALOGCD" value="<?=isset($data['CATALOGCD']) ? $data['CATALOGCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="CATALOGNAME" name="CATALOGNAME" value="<?=isset($data['CATALOGNAME']) ? $data['CATALOGNAME']: ''; ?>" readonly/>                        
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-5/12 pl-2 pt-1"></label>
                                        <label class="text-color block text-[12px] w-3/12 pl-2 pt-1" id="PROPLAN_QTY_THISMONTH"><?=checklang('PROPLAN_QTY_THISMONTH')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="PROPLANQTY" name="PROPLANQTY" value="<?=!empty($data['PROPLANQTY']) ?  number_format(str_replace(',', '',$data['PROPLANQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-1">
                                    <div class="flex w-6/12"></div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-5/12 pl-2 pt-1"></label>
                                        <label class="text-color block text-[12px] w-3/12 pl-2 pt-1" id="SHIPPING_QTY_THISMONTH"><?=checklang('SHIPPING_QTY_THISMONTH')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="SHIPPLANQTY" name="SHIPPLANQTY" value="<?=!empty($data['SHIPPLANQTY']) ?  number_format(str_replace(',', '',$data['SHIPPLANQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"></label>
                                        <label class="text-color block text-sm w-4/12 pl-2 pt-1" id="1ST_10DAYS"><?=checklang('1ST_10DAYS')?></label>
                                        <label class="text-color block text-sm w-4/12 pl-2 pt-1" id="2ND_10DAYS"><?=checklang('2ND_10DAYS')?></label>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1" id="3RD_10DAYS"><?=checklang('3RD_10DAYS')?></label>                      
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-5/12 pl-2 pt-1"></label>
                                        <label class="text-color block text-[12px] w-3/12 pl-2 pt-1" id="CARRYOVER_INV"><?=checklang('CARRYOVER_INV')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="CARRYQTY" name="CARRYQTY" value="<?=!empty($data['CARRYQTY']) ?  number_format(str_replace(',', '',$data['CARRYQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-[13px] w-2/12 pr-2 pt-1" id="PRO_PLAN_QTY"><?=checklang('PRO_PLAN_QTY')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="PROPLAN1STQTY" name="PROPLAN1STQTY" value="<?=!empty($data['PROPLAN1STQTY']) ?  number_format(str_replace(',', '',$data['PROPLAN1STQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 mr-1 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="PROPLAN2STQTY" name="PROPLAN2STQTY" value="<?=!empty($data['PROPLAN2STQTY']) ?  number_format(str_replace(',', '',$data['PROPLAN2STQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300  mr-1 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>  
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="PROPLAN3STQTY" name="PROPLAN3STQTY" value="<?=!empty($data['PROPLAN3STQTY']) ?  number_format(str_replace(',', '',$data['PROPLAN3STQTY']), 2): ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12">
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>  
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center" id="PREBALANCE"><?=checklang('PREBALANCE')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-center read"
                                                id="PREBALANCEQTY" name="PREBALANCEQTY" value="<?=!empty($data['PREBALANCEQTY']) ? number_format(str_replace(',', '',$data['PREBALANCEQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>  
                                    </div>
                                </div>

                                <div class="flex mb-1 px-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-[13px] w-2/12 pr-2 pt-1" id="SHIP_PLAN_QTY"><?=checklang('SHIP_PLAN_QTY')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="SHIPPLAN1STQTY" name="SHIPPLAN1STQTY" value="<?=!empty($data['SHIPPLAN1STQTY']) ?  number_format(str_replace(',', '',$data['SHIPPLAN1STQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 mr-1 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="SHIPPLAN2STQTY" name="SHIPPLAN2STQTY" value="<?=!empty($data['SHIPPLAN2STQTY']) ?  number_format(str_replace(',', '',$data['SHIPPLAN2STQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300  mr-1 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>  
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-right read"
                                                id="SHIPPLAN3STQTY" name="SHIPPLAN3STQTY" value="<?=!empty($data['SHIPPLAN3STQTY']) ?  number_format(str_replace(',', '',$data['SHIPPLAN3STQTY']), 2): ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12">
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>  
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center" id="PRE_ODR_QTY"><?=checklang('PRE_ODR_QTY')?></label>
                                        <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-1 text-gray-700 border-gray-300 text-center read"
                                                id="PREORDERQTY" name="PREORDERQTY" value="<?=!empty($data['PREORDERQTY']) ? number_format(str_replace(',', '',$data['PREORDERQTY']), 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($unitvalue as $unit => $unititem) { ?>
                                                <option value="<?=$unit ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unit) ? 'selected' : '' ?>><?=$unititem ?></option>
                                            <?php } ?>
                                        </select>  
                                        <div class="flex w-4/12 justify-end">
                                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                                    id="SEARCH" name="SEARCH" onclick="javascript:search();"><?=checklang('SEARCH')?>
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
                <div class="overflow-scroll block px-2" id="tableResult">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 table-fixed w-full detail_table" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="px-3 text-center border border-slate-700"><?=str_repeat('&emsp;', 5)?></th><?php
                                for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                    <th class="px-6 w-24 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap" id="DATEH<?=$i?>" name="DATEH<?=$i?>"></span>
                                    </th><?php 
                                } ?>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none">
                            <tr class="divide-y divide-gray-200 csv">
                                <td class="h-6 text-sm border border-slate-700 whitespace-nowrap"><?=checklang('ORDER_QTY_PUR'); ?></td><?php
                                for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                <td class="h-6 w-24 border border-slate-700">
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" id="SALEORDER<?=$i?>" name="SALEORDER<?=$i?>"></td><?php } ?>
                            </tr>
                            <tr class="divide-y divide-gray-200 csv">
                                <td class="h-6 text-sm border border-slate-700 whitespace-nowrap"><?=checklang('FORECAST'); ?></td><?php
                                for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                <td class="h-6 w-24 border border-slate-700">
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" id="FORCAST<?=$i?>" name="FORCAST<?=$i?>"></td><?php } ?>
                            </tr>
                            <tr class="divide-y divide-gray-200 csv">
                                <td class="h-6 text-sm border border-slate-700 whitespace-nowrap"><?=checklang('ORDER_QTY_PUR'); ?></td><?php
                                for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                <td class="h-6 w-24 border border-slate-700">
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" id="ORDER<?=$i?>" name="ORDER<?=$i?>"></td><?php } ?>
                            </tr>
                            <tr class="divide-y divide-gray-200 csv">
                                <td class="h-6 text-sm border border-slate-700 whitespace-nowrap"><?=checklang('BALANCE'); ?></td><?php
                                for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                <td class="h-6 w-24 text-sm border border-slate-700">
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" id="BALANCE<?=$i?>" name="BALANCE<?=$i?>"></td><?php } ?>
                            </tr>
                            <tr class="divide-y divide-gray-200 csv">
                                <td class="h-6 text-[12px] border border-slate-700 whitespace-nowrap"><?=checklang('PRO_PLAN_QTY'); ?></td><?php
                                for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                <td class="h-6 w-24 border border-slate-700">
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" id="PLAN<?=$i?>" name="PLAN<?=$i?>"
                                    onchange="this.value = num2digit(this.value); refreshfData(<?=$i?>);" 
                                    oninput="this.value = stringReplacez(this.value);"></td>
                                <input type="hidden" id="HOLIDAY<?=$i?>" name="HOLIDAY<?=$i?>">
                                <input type="hidden" id="DATE<?=$i?>" name="DATE<?=$i?>">
                                <input type="hidden" id="DATECD<?=$i?>" name="DATECD<?=$i?>"><?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex mt-1 px-2">
                    <div class="flex w-4/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                        <input class="hidden" type="checkbox" id="FORWARD" name="FORWARD" value="T" <?php echo (isset($data['FORWARD']) && $data['FORWARD'] == 'T') ? 'checked': '';?>/>
                        <input class="read" type="hidden" id="STARTDT" name="STARTDT" value="<?=!empty($data['STARTDT']) ? $data['STARTDT']: ''; ?>" />
                        <input class="read" type="hidden" id="TODATE" name="TODATE" value="<?=!empty($data['TODATE']) ? $data['TODATE']: ''; ?>" />
                        <input class="read" type="hidden" id="CNT" name="CNT" value="<?=!empty($data['CNT']) ? $data['CNT']: ''; ?>" />
                        <!-- <input class="read" type="hidden" id="PLAN" name="PLAN" value="<?=!empty($data['PLAN']) ? $data['PLAN']: ''; ?>" /> -->
                        <input class="read" type="hidden" id="SYSEN_SEARCHP" name="SYSEN_SEARCHP" value="<?=!empty($data['SYSEN_SEARCHP']) ? $data['SYSEN_SEARCHP']: ''; ?>" />
                        <input class="read" type="hidden" id="SYSEN_SEARCHN" name="SYSEN_SEARCHN" value="<?=!empty($data['SYSEN_SEARCHN']) ? $data['SYSEN_SEARCHN']: ''; ?>" />
                        <input class="read" type="hidden" id="SYSEN_YEAR" name="SYSEN_YEAR" value="<?=!empty($data['SYSEN_YEAR']) ? $data['SYSEN_YEAR']: ''; ?>" />
                        <input class="read" type="hidden" id="SYSEN_MONTH" name="SYSEN_MONTH" value="<?=!empty($data['SYSEN_MONTH']) ? $data['SYSEN_MONTH']: ''; ?>" />
                    </div>
                    <div class="flex w-4/12 justify-center">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-3 py-1 text-center me-2 mb-1" 
                                id="ARROWLEFT" onclick="getPreMonth();">←</button>&ensp;
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-3 py-1 text-center me-2 mb-1" 
                                id="ARROWRIGHT" onclick="getNextMonth();">→</button>
                    </div>
                    <div class="flex w-4/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="$('#loading').show(); unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;
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

        $('#table').DataTable({
            // scrollY: '350.0px',
            scrollX: true,
            scrollCollapse: true,
            processing: false,
            searching: false,
            responsive: true,
            fixedHeader: true,
            paging: false,
            ordering: false,
            info: false,
            fixedColumns:   {
                leftColumns: 1,
            },
            language: {
              emptyTable: ' ',
              infoEmpty: ' '
            },
        });
    });


    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        return getElement(code, result);
    }

</script>
