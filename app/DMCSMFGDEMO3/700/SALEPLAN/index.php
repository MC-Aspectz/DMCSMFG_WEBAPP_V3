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
            <form class="w-full" method="POST" id="salePlan" name="salePlan" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="INPUT_DATE"><?=checklang('INPUT_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="ENTRYDT" name="ENTRYDT" value="<?=!empty($data['ENTRYDT']) ? date('Y-m-d', strtotime($data['ENTRYDT'])) : date('Y-m-d'); ?>"/>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center" id="ST_YYMM"><?=checklang('ST_YYMM')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 mr-1 text-left rounded-xl border-gray-300 req" id="YEARVALUE" name="YEARVALUE"  onchange="unRequired();" required>
                                            <option value=""></option>
                                            <?php foreach ($YEARVALUE as $year => $yearitem) { ?>
                                                <option value="<?=$year ?>" <?=(isset($data['YEARVALUE']) && $data['YEARVALUE'] == $year) ? 'selected' : '' ?>><?=$yearitem ?></option>
                                            <?php } ?>
                                        </select>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300 req" id="MONTHVALUE" name="MONTHVALUE" onchange="unRequired();" required>
                                            <option value=""></option>
                                            <?php foreach ($MONTHVALUE as $month => $monthitem) { ?>
                                                <option value="<?=$month ?>" <?=(isset($data['MONTHVALUE']) && $data['MONTHVALUE'] == $month) ? 'selected' : '' ?>><?=$monthitem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="SALEREP_CODE"><?=checklang('SALEREP_CODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SALEDIVCD" id="SALEDIVCD" value="<?=isset($data['SALEDIVCD']) ? $data['SALEDIVCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="SALEDIVNAME" name="SALEDIVNAME" value="<?=isset($data['SALEDIVNAME']) ? $data['SALEDIVNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
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
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="DIVISIONCODE"><?=checklang('DIVISIONCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="DIVISIONCD" id="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="DIVISIONNAME" name="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
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
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-[13px] shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 text-center text-gray-700 border-gray-300 read"
                                                id="ITEMLEADTIME" name="ITEMLEADTIME" value="<?=!empty($data['ITEMLEADTIME']) ? number_format($data['ITEMLEADTIME'], 0): ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center" id="DAY"><?=checklang('DAY')?></label>
                                        <input type="hidden" name="ALLOWN" value="F" />
                                        <input type="checkbox" id="ALLOWN" name="ALLOWN" value="T" <?=(!empty($data['ALLOWN']) && $data['ALLOWN'] == 'T') ? 'checked': '';?> onchange="All(); ctrlAllOwn();"/>
                                        <label class="text-color block text-sm w-1/12 pl-2 pt-1" id="ALL"><?=checklang('ALL')?></label>
                                        <input class="hidden" type="hidden" id="ITEMTYP" name="ITEMTYP" value="<?=!empty($data['ITEMTYP']) ? $data['ITEMTYP']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="ITEMSTDSALEPRICE" name="ITEMSTDSALEPRICE" value="<?=!empty($data['ITEMSTDSALEPRICE']) ? $data['ITEMSTDSALEPRICE']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="CATALOGCD" name="CATALOGCD" value="<?=!empty($data['CATALOGCD']) ? $data['CATALOGCD']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="SYSTIMESTAMP" name="SYSTIMESTAMP" value="<?=!empty($data['SYSTIMESTAMP']) ? $data['SYSTIMESTAMP']: ''; ?>" />
                                        <div class="flex w-10/12 justify-end">
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

                <div class="overflow-scroll block h-[188px] max-h-[188px]"> 
                    <table id="mounth_table" class="w-full border-collapse border border-slate-500 divide-gray-200 mounth_table table-fixed w-full" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <?php for ($i = 0; $i <= 5; $i++) { ?>
                                    <th class="px-3 w-32 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$days[$i]['mon'] ?></span>
                                    </th>
                                    <th class="px-3 w-32 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$days[$i]['tue'] ?></span>
                                    </th>
                                    <th class="px-3 w-32 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$days[$i]['wed'] ?></span>
                                    </th>
                                    <th class="px-3 w-32 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$days[$i]['thu'] ?></span>
                                    </th>
                                    <th class="px-3 w-32 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$days[$i]['fri'] ?></span>
                                    </th>
                                    <th class="px-3 w-32 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$days[$i]['sat'] ?></span>
                                    </th>
                                    <th class="px-3 w-32 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$days[$i]['sun'] ?></span>
                                    </th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto">
                            <tr class="divide-y divide-gray-200">
                                <?php for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                    <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read-background text-center" 
                                        type="text" id="LBLDATE<?=$i?>" name="LBLDATE<?=$i?>" onclick="getDetailDT(<?=$i?>);" onfocus="this.blur()" readonly>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr class="divide-y divide-gray-200">
                                <?php for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                    <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 border-gray-300 read-background text-right text-orange-400" 
                                        type="text" id="FIXQTY<?=$i?>" name="FIXQTY<?=$i?>" onclick="getDetailDT(<?=$i?>);" onfocus="this.blur()" readonly>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr class="divide-y divide-gray-200">
                                <?php for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                    <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 border-gray-300 read-background text-right text-green-400" 
                                        type="text" id="PLANQTY<?=$i?>" name="PLANQTY<?=$i?>" onclick="getDetailDT(<?=$i?>);" onfocus="this.blur()" readonly>
                                    </td>
                                <?php } ?>
                            </tr>

                            <tr class="divide-y divide-gray-200">
                                <?php for($i = $minrow; $i <= $maxrow; $i++ ) { ?>
                                    <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read-background text-right" 
                                        type="text" id="PLANRATE<?=$i?>" name="PLANRATE<?=$i?>" onclick="getDetailDT(<?=$i?>);" onfocus="this.blur()" readonly>
                                    </td>
                                    <input type="hidden" id="LBLDATECD<?=$i?>" name="LBLDATECD<?=$i?>">
                                    <input type="hidden" id="LBLDATEFLG<?=$i?>" name="LBLDATEFLG<?=$i?>">
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col mb-1">
                    <div class="flex w-full">
                        <div class="flex flex-col w-5/12 px-1">
                            <div class="flex overflow-scroll block h-[200px] max-h-[200px]"> 
                                <table id="total_table" class="w-full border-collapse border border-slate-500 divide-gray-200 total_table" rules="cols" cellpadding="3" cellspacing="1">
                                    <thead class="sticky top-0 bg-gray-50">
                                        <tr class="border border-gray-600">
                                            <th class="px-3 text-center border border-slate-700"><?=str_repeat('&emsp;', 2)?></th>
                                            <th class="px-6 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['1st10days']; ?></span>
                                            </th>
                                            <th class="px-6 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['2nd10days']; ?></span>
                                            </th>
                                            <th class="px-6 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['3rd10days']; ?></span>
                                            </th>
                                            <th class="px-6 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap">&emsp;<?=$lang['total']; ?>&emsp;</span>
                                            </th>
                                            <th class="px-6 text-center border border-slate-700"><?=str_repeat('&emsp;', 4)?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto">
                                        <tr class="divide-y divide-gray-200">
                                            <td class="h-6 pl-2 text-sm border border-slate-700 whitespace-nowrap text-orange-400" id="DETAILFIX"><?=$lang['fixed'] ?></td>
                                            <?php for($i = 1; $i <= 3; $i++ ) { ?>
                                                <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                                    <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 border-gray-300 read text-right text-orange-400" 
                                                    id="FIXQTYST<?=$i?>" name="FIXQTYST<?=$i?>"readonly>
                                                </td>
                                            <?php } ?>
                                            <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                                <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 border-gray-300 read text-right text-orange-400" 
                                                id="TOTAL01" name="TOTAL01" value="0.00" readonly>
                                            </td>
                                            <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                                <select class="text-control text-[12px] shadow-md border px-3 h-6 w-full text-left rounded-xl border-gray-300 text-orange-400 read" id="ITEMUNITTYP" name="ITEMUNITTYP" readonly>
                                                    <option value=""></option>
                                                    <?php foreach ($UNIT as $unt => $unititem) { ?>
                                                        <option value="<?=$unt ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $unt) ? 'selected' : '' ?>><?=$unititem ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="divide-y divide-gray-200">
                                            <td class="h-6 pl-2 text-sm border border-slate-700 whitespace-nowrap text-green-400" id="PLANNING"><?=$lang['plan'] ?></td>
                                            <?php for($i = 1; $i <= 3; $i++ ) { ?>
                                                <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                                    <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 border-gray-300 read text-right text-green-400" 
                                                    id="PLANQTYST<?=$i?>" name="PLANQTYST<?=$i?>"readonly>
                                                </td>
                                            <?php } ?>
                                            <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                                <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 border-gray-300 read text-right text-green-400" 
                                                id="TOTAL02" name="TOTAL02" value="0.00" readonly>
                                            </td>
                                            <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap"><?=str_repeat('&emsp;', 2)?></td>
                                        </tr>

                                        <tr class="divide-y divide-gray-200">
                                            <td class="h-6 pl-2 text-sm border border-slate-700 whitespace-nowrap" id="UNIT_SENEN"><?=$lang['amount'] ?></td>
                                            <?php for($i = 1; $i <= 3; $i++ ) { ?>
                                                <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                                    <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                    id="PLANRATEST<?=$i?>" name="PLANRATEST<?=$i?>"readonly>
                                                </td>
                                            <?php } ?>
                                            <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap">
                                                <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read" 
                                                id="TOTAL03" name="TOTAL03" value="0.00" readonly>
                                            </td>
                                            <td class="h-6 w-32 pl-2 text-sm border border-slate-700 whitespace-nowrap"><?=str_repeat('&emsp;', 2)?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex flex-col w-7/12 px-1">
                            <div class="flex overflow-scroll block h-[200px] max-h-[200px]"> 
                                <table id="plan_table" class="w-full border-collapse border border-slate-500 divide-gray-200 plan_table" rules="cols" cellpadding="3" cellspacing="1">
                                    <thead class="sticky top-0 bg-gray-50">
                                        <tr class="border border-gray-600">
                                            <th class="sticky-col first-col px-3 text-center border border-slate-700"><?=str_repeat('&emsp;', 2)?></th>
                                            <input type="hidden" id="MONTHCODE0" name="MONTHCODE0">
                                            <?php for($i = 1; $i <= 5; $i++ ) { ?>
                                                <th colspan="3" class="px-2 text-center border border-slate-700">
                                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read text-center"
                                                        id="MONTHCODE<?=$i?>" name="MONTHCODE<?=$i?>">
                                                </th>
                                                <input type="hidden" id="MONTHD<?=$i?>" name="MONTHD<?=$i?>"/>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                                        for($tr = 1; $tr <= 3; $tr++ ) { ?>
                                            <tr> <?php if($tr == 1) { ?>
                                                <td class="sticky-col first-col h-6 pl-2 text-sm font-bold border border-slate-700 whitespace-nowrap" id="1ST10DAYS"><?=$lang['1st10days'] ?></td> <?php 
                                            } else if ($tr == 2) { ?>
                                                <td class="sticky-col first-col h-6 pl-2 text-sm font-bold border border-slate-700 whitespace-nowrap" id="2ND10DAYS"><?=$lang['2nd10days'] ?></td> <?php 
                                            } else if ($tr == 3) { ?>
                                                <td class="sticky-col first-col h-6 pl-2 text-sm font-bold border border-slate-700 whitespace-nowrap" id="3RD10DAYS"><?=$lang['3rd10days'] ?></td> <?php 
                                            }
                                            for($td = 1; $td <= 5; $td++ ) { ?>
                                                <td class="h-6 pl-2 w-100 text-sm border border-slate-700 whitespace-nowrap">
                                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read text-right text-orange-400" 
                                                        id="FIXQTY<?=$td?>ST<?=$tr?>" name="FIXQTY<?=$td?>ST<?=$tr?>" readonly>
                                                </td>
                                                <td class="h-6 pl-2 w-100 text-sm border border-slate-700 whitespace-nowrap">
                                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read text-right text-green-400" 
                                                        id="PLANQTY<?=$td?>ST<?=$tr?>" name="PLANQTY<?=$td?>ST<?=$tr?>" readonly>
                                                </td>
                                                <td class="h-6 pl-2 w-100 text-sm border border-slate-700 whitespace-nowrap">
                                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read text-right" 
                                                        id="PLANRATE<?=$td?>ST<?=$tr?>" name="PLANRATE<?=$td?>ST<?=$tr?>" readonly>
                                                </td><?php
                                            } ?>
                                            </tr><?php
                                        } ?>
                                        <tr>
                                            <td class="sticky-col first-col bg-white z-20"><?=str_repeat('&emsp;', 2)?></td>
                                            <?php for($z = 1; $z <= 5; $z++ ) { ?>
                                                <td colspan="2" class="text-center">
                                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center" 
                                                      id="MONTH_DETAIL<?=$z?>" onclick="salePlanDetail('<?=$z?>');"><?=checklang('MONTH_DETAIL'); ?></button>
                                                </td>
                                                <td class="h-6 pl-2 w-100 text-sm border border-slate-700 whitespace-nowrap">
                                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read text-right" 
                                                        id="SUM<?=$z?>" name="SUM<?=$z?>" readonly>
                                                </td><?php 
                                            } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex mb-1 px-2">
                    <div class="flex w-5/12">
                        <input class="hidden" type="hidden" id="STARTDT" name="STARTDT"/>
                        <input class="hidden" type="hidden" id="ENDDT" name="ENDDT"/>
                        <input class="hidden" type="hidden" id="DATEIDX" name="DATEIDX"/>
                        <input class="hidden" type="hidden" id="SALEPLANTODO6FLG" name="SALEPLANTODO6FLG"/>
                        <input class="hidden" type="hidden" id="SALEPLANTODO7FLG" name="SALEPLANTODO7FLG"/>
                        <input class="hidden" type="hidden" id="SALEPLANTODO8FLG" name="SALEPLANTODO8FLG"/>
                        <input class="hidden" type="hidden" id="SALEPLANTODO9FLG" name="SALEPLANTODO9FLG"/>
                        <input class="hidden" type="hidden" id="SYSVIS_MEMO" name="SYSVIS_MEMO"/>
                        <input class="hidden" type="hidden" id="SYSVIS_LBLMEMO" name="SYSVIS_LBLMEMO"/>
                        <?php for($i = 1; $i <= 4; $i++ ) { ?>
                            <input class="hidden" type="hidden" id="START<?=$i?>" name="START<?=$i?>"/>
                        <?php } ?>
                    </div>
                    <div class="flex w-7/12">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1" id="ST_DATE"><?=checklang('ST_DATE')?></label>
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                id="SALEPLANDTHD" name="SALEPLANDTHD" value=""/>
                    </div>
                </div>

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary> 
                                <div class="flex mb-1">
                                <div class="flex flex-col mb-1">
                                    <div class="flex w-full">
                                        <div class="flex flex-col w-5/12 px-1">
                                            <div class="flex mb-1 px-1">
                                                <input type="hidden" id="ROWNO" name="ROWNO"/>
                                                <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="CUSTOMERCODE"><?=checklang('CUSTOMERCODE')?></label>
                                                <div class="relative w-4/12 mr-1">
                                                    <input type="text" class="text-control text-[13px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                            id="CUSTOMERCD" name="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>"/>
                                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                        id="SEARCHCUSTOMER">
                                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-5/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                        id="CUSTOMERNAME" name="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                            </div>

                                            <div class="flex mb-1 px-1">
                                                <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="END_USER"><?=checklang('END_USER')?></label>
                                                <div class="relative w-4/12 mr-1">
                                                    <input type="text" class="text-control text-[13px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="ENDUSERCD" name="ENDUSERCD" value="<?=isset($data['ENDUSERCD']) ? $data['ENDUSERCD']: ''; ?>"/>
                                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                        id="SEARCHENDUSER">
                                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-5/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                        id="ENDUSERNAME" name="ENDUSERNAME" value="<?=isset($data['ENDUSERNAME']) ? $data['ENDUSERNAME']: ''; ?>" readonly/>
                                            </div>

                                            <div class="flex mb-1 px-1">
                                                <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="MARKET_CODE"><?=checklang('MARKET_CODE')?></label>
                                                <div class="relative w-4/12 mr-1">
                                                    <input type="text" class="text-control text-[13px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="MARKETCD" name="MARKETCD" value="<?=isset($data['MARKETCD']) ? $data['MARKETCD']: ''; ?>"/>
                                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                        id="SEARCHMARKET">
                                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-5/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                        id="MARKETNAME" name="MARKETNAME" value="<?=isset($data['MARKETNAME']) ? $data['MARKETNAME']: ''; ?>" readonly/>
                                            </div>

                                            <div class="flex mb-1 px-1">
                                                <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="PROBABILITY"><?=checklang('PROBABILITY')?></label>
                                                <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-2/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                        id="SALEPLANPOS" name="SALEPLANPOS" value="<?=!empty($data['SALEPLANPOS']) ? $data['SALEPLANPOS']: ''; ?>"
                                                        maxlength="3" onchange="percentLimit(this);" oninput="this.value = stringReplacez(this.value);" />
                                                <label class="text-color block text-sm w-1/12 pt-1 text-center" id="PERCENT"><?=checklang('PERCENT')?></label>
                                                <label class="text-color block text-sm w-3/12 pt-1 text-center" id="PURCHASE_ALLOW"><?=checklang('PURCHASE_ALLOW')?></label>
                                                <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300" id="SALEPLANREQTYP" name="SALEPLANREQTYP">
                                                    <option value=""></option>
                                                    <?php foreach ($PURCHASE_ALLOW as $purchase => $purchaseitem) { ?>
                                                        <option value="<?=$purchase ?>" <?=(isset($data['SALEPLANREQTYP']) && $data['SALEPLANREQTYP'] == $purchase) ? 'selected' : '' ?>><?=$purchaseitem ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="flex mb-1 px-1">
                                                <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="QUANTITY"><?=checklang('QUANTITY')?></label>
                                                <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-2/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                        id="SALEPLANQTY" name="SALEPLANQTY" value="<?=!empty($data['SALEPLANPOS']) ? $data['SALEPLANPOS']: ''; ?>"
                                                        onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);" />
                                                <label class="text-color block text-sm w-4/12 pt-1 text-center" id="SALES_PRICE"><?=checklang('SALES_PRICE')?></label>
                                                <div class="relative w-3/12 mr-1 justify-between">
                                                    <input type="text" class="text-control text-[12px] shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 text-right"
                                                            name="SALEPLANPRC" id="SALEPLANPRC" value="<?=!empty($data['SALEPLANPRC']) ? $data['SALEPLANPRC']: ''; ?>"
                                                            onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                                    <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-10 rounded-e-xl border read">
                                                        <?=isset($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>
                                                    </label>
                                                </div>
                                                <input class="hidden" type="hidden" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=!empty($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>"/>
                                                <input class="hidden" type="hidden" id="COMPRICETYPE" name="COMPRICETYPE" value="<?=!empty($data['COMPRICETYPE']) ? $data['COMPRICETYPE']: ''; ?>"/>
                                                <input class="hidden" type="hidden" id="COMAMOUNTTYPE" name="COMAMOUNTTYPE" value="<?=!empty($data['COMAMOUNTTYPE']) ? $data['COMAMOUNTTYPE']: ''; ?>"/>
                                            </div>

                                            <div class="flex mb-1 px-1">
                                                <div class="w-5/12">
                                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                            id="MEMO" name="MEMO" value="<?=!empty($data['MEMO']) ? $data['MEMO']: ''; ?>" />
                                                </div>
                                                <label class="text-color block text-sm w-4/12 pt-1 text-center" id="SALES_AMOUNT"><?=checklang('SALES_AMOUNT')?></label>
                                                <div class="relative w-3/12 mr-1 justify-between">
                                                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 text-right read"
                                                            name="SALETOTALPRC" id="SALETOTALPRC" value="<?=!empty($data['SALETOTALPRC']) ? $data['SALETOTALPRC']: ''; ?>"
                                                            onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                                    <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-10 rounded-e-xl border read">
                                                        <?=isset($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="flex mb-1 px-1">
                                                <input class="mt-1" type="checkbox" id="SALEPLANTODO1FLG" name="SALEPLANTODO1FLG" value="T" <?=(isset($data['SALEPLANTODO1FLG']) && $data['SALEPLANTODO1FLG'] == 'T') ? 'checked': '';?>/>
                                                <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="TODOLIST01"><?=checklang('TODOLIST01')?></label>
                                                <input class="mt-1" type="checkbox" id="SALEPLANTODO2FLG" name="SALEPLANTODO2FLG" value="T" <?=(isset($data['SALEPLANTODO2FLG']) && $data['SALEPLANTODO2FLG'] == 'T') ? 'checked': '';?>/>
                                                <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="TODOLIST02"><?=checklang('TODOLIST02')?></label>
                                                <input class="mt-1" type="checkbox" id="SALEPLANTODO3FLG" name="SALEPLANTODO3FLG" value="T" <?=(isset($data['SALEPLANTODO3FLG']) && $data['SALEPLANTODO3FLG'] == 'T') ? 'checked': '';?>/>
                                                <label class="text-color block text-sm w-3/12 pl-2 pt-1" id="TODOLIST03"><?=checklang('TODOLIST03')?></label>
                                                <input class="mt-1" type="checkbox" id="SALEPLANTODO4FLG" name="SALEPLANTODO4FLG" value="T" <?=(isset($data['SALEPLANTODO4FLG']) && $data['SALEPLANTODO4FLG'] == 'T') ? 'checked': '';?> 
                                                        onchange="ctrlMemoOnClick();"/>
                                                <label class="text-color block text-sm w-2/12 pl-2 pt-1" id="TODOLIST04"><?=checklang('TODOLIST04')?></label>
                                            </div>

                                            <div class="flex p-1">
                                                <div class="flex w-7/12 px-1">
                                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-4/12 py-1 mr-2 text-center"
                                                    id="OK" name="OK" <?php if(!empty($data['SYSPVL']['SYSVIS_INS']) && $data['SYSPVL']['SYSVIS_INS'] != 'T') {?> hidden <?php }?>><?=checklang('OK'); ?></button>
                                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-4/12 py-1 mr-2 text-center"
                                                    id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']['SYSVIS_UPD']) && $data['SYSPVL']['SYSVIS_UPD'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-4/12 py-1 mr-2 text-center"
                                                    id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']['SYSVIS_DEL']) && $data['SYSPVL']['SYSVIS_DEL'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                                                </div>
                                                <div class="flex w-5/12 px-1 justify-end">
                                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-5/12 py-1 text-center"
                                                        id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col w-7/12 px-1">
                                            <div class="flex overflow-scroll block h-[160px] max-h-[160px]"> 
                                                <table id="table_customer" class="w-full border-collapse border border-slate-500 divide-gray-200 table_customer" rules="cols" cellpadding="3" cellspacing="1">
                                                    <thead class="sticky top-0 bg-gray-50">
                                                        <tr class="border border-gray-600">
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                                            </th>
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERCODE')?></span>
                                                            </th>
                                                            <th class="px-6 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME')?></span>
                                                            </th>
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('END_USER')?></span>
                                                            </th>
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('END_USERNAME')?></span>
                                                            </th>
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MARKET_CODE')?></span>
                                                            </th>
                                                            <th class="px-6 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MARKETNAME')?></span>
                                                            </th>
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PROBABILITY')?></span>
                                                            </th>
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                                            </th>
                                                            <th class="px-3 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALES_AMOUNT')?></span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php
                                                    for ($i = 1; $i <= 5; $i++) { ?>
                                                        <tr class="divide-y divide-gray-200 row-customer" id="rowId<?=$i?>">
                                                            <td class="h-6 text-sm border border-slate-700 text-center row-id index" id="LINE_TD<?=$i?>"></td>
                                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="CUSTOMERCD_TD<?=$i?>"></td>
                                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="CUSTOMERNAME_TD<?=$i?>"></td>
                                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="ENDUSERCD_TD<?=$i?>"></td>
                                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="ENDUSERNAME_TD<?=$i?>"></td>
                                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="MARKETCD_TD<?=$i?>"></td>
                                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="MARKETNAME_TD<?=$i?>"></td>
                                                            <td class="h-6 pr-1 text-sm border border-slate-700 text-right" id="SALEPLANPOS_TD<?=$i?>"></td>
                                                            <td class="h-6 pr-1 text-sm border border-slate-700 text-right" id="SALEPLANQTY_TD<?=$i?>"></td>
                                                            <td class="h-6 pr-1 text-sm border border-slate-700 text-right" id="SALETOTALPRC_TD<?=$i?>"></td>

                                                            <td class="hidden"><input class="form-control read" type="hidden" id="ROWNO<?=$i?>" name="ROWNO_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="CUSTOMERCD<?=$i?>" name="CUSTOMERCD_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="CUSTOMERNAME<?=$i?>" name="CUSTOMERNAME_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="ENDUSERCD<?=$i?>" name="ENDUSERCD_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="ENDUSERNAME<?=$i?>" name="ENDUSERNAME_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="MARKETCD<?=$i?>" name="MARKETCD_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="MARKETNAME<?=$i?>" name="MARKETNAME_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANPOS<?=$i?>" name="SALEPLANPOS_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANREQTYP<?=$i?>" name="SALEPLANREQTYP_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANTODO1FLG<?=$i?>" name="SALEPLANTODO1FLG_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANTODO2FLG<?=$i?>" name="SALEPLANTODO2FLG_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANTODO3FLG<?=$i?>" name="SALEPLANTODO3FLG_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANTODO4FLG<?=$i?>" name="SALEPLANTODO4FLG_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANTODO5FLG<?=$i?>" name="SALEPLANTODO5FLG_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANTODO6FLG<?=$i?>" name="SALEPLANTODO6FLG_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANTODO7FLG<?=$i?>" name="SALEPLANTODO7FLG_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANTODO8FLG<?=$i?>" name="SALEPLANTODO8FLG_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANTODO9FLG<?=$i?>" name="SALEPLANTODO9FLG_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANQTY<?=$i?>" name="SALEPLANQTY_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALEPLANPRC<?=$i?>" name="SALEPLANPRC_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="MEMO<?=$i?>" name="MEMO_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SALETOTALPRC<?=$i?>" name="SALETOTALPRC_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SYSVIS_MEMO<?=$i?>" name="SYSVIS_MEMO_I[]"/></td>
                                                            <td class="hidden"><input class="form-control read" type="hidden" id="SYSVIS_LBLMEMO<?=$i?>" name="SYSVIS_LBLMEMO_I[]"/></td>
                                                        </tr><?php
                                                    } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="flex p-2">
                                                <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowCount">0</span></label>
                                            </div>

                                            <div class="flex">
                                                <div class="flex w-6/12">
                                                    <input type="checkbox" id="SALEPLANTODO5FLG" name="SALEPLANTODO5FLG" value="T" <?=(isset($data['SALEPLANTODO5FLG']) && $data['SALEPLANTODO5FLG'] == 'T') ? 'checked': '';?>/>
                                                    <label class="text-color block text-sm w-6/12 pl-2 pt-1" id="TODOLIST05"><?=checklang('TODOLIST05')?></label>
                                                </div>
                                                <div class="flex w-6/12 px-1 justify-end">
                                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                                            id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                                            id="VIEWSALE" name="VIEWSALE"><?=checklang('VIEWSALE'); ?></button>
                                                </div>
                                            </div>
                                        </div>
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
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']['SYSVIS_INS']) && $data['SYSPVL']['SYSVIS_INS'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 hidden"
                                id="MEMO" name="MEMO"><?=checklang('MEMO'); ?></button>&emsp;
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
        unRequired(); All();
        // document.getElementById('COMMIT').disabled = false;
        document.getElementById('MEMO').type = 'hidden';
        document.getElementById('UPDATE').disabled = true;
        document.getElementById('DELETE').disabled = true;
        for (var t = 1; t <= 5; t++) { document.getElementById('MONTH_DETAIL'+t+'').disabled = true; }

        $('table#table_customer tr').click(function () {
            $('table#table_customer tr').not(this).removeClass('selected');
            let index = ''
            let item = $(this).closest('tr').children('td');
            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                index = item.eq(0).text();
                let tb = document.getElementById('table_customer');
                let row = tb.getElementsByTagName('tr');
                $('.row-id').each(function (i) {
                    row[i+1].classList.remove('selected-row');
                }); 
                // console.log(index);
                if(index != '') { row[index].classList.add('selected-row'); selectRow(index); }
            }
        });
    });

    function calculateTotal() {
        let quantity = document.getElementById('SALEPLANQTY').value || 0.00;
        let price = document.getElementById('SALEPLANPRC').value || 0.00;
        let total = 0.00;
        if(quantity == '') { return false; }
        // console.log(quantity);
        // console.log(price);
        total = quantity.replaceAll(',', '') * price.replaceAll(',', '');
        // console.log(total);
        document.getElementById('SALETOTALPRC').value = num2digit(total);
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        if(code == 'STAFFCD' || code == 'ITEMCD') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function All() {
        document.getElementById('OK').classList[document.getElementById('ALLOWN').checked ? 'add' : 'remove']('hidden');
        document.getElementById('UPDATE').classList[document.getElementById('ALLOWN').checked ? 'add' : 'remove']('hidden');
        document.getElementById('DELETE').classList[document.getElementById('ALLOWN').checked ? 'add' : 'remove']('hidden');
        document.getElementById('ENTRY').classList[document.getElementById('ALLOWN').checked ? 'add' : 'remove']('hidden');
        document.getElementById('COMMIT').classList[document.getElementById('ALLOWN').checked ? 'add' : 'remove']('hidden');
    }

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=$lang['validation1']; ?>',
            // background: '#8ca3a3',
            showCancelButton: false,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['no']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }
</script>