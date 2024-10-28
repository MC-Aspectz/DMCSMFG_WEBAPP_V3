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
            <form class="w-full" method="POST" id="productionOrderEntry" name="productionOrderEntry" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PRODUCT_ORDER')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    id="PROORDERNO" name="PROORDERNO" value="<?=isset($data['PROORDERNO']) ? $data['PROORDERNO']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHPRODUCTIONORDER">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input class="hidden" type="hidden" id="AUTOMANUAL" name="AUTOMANUAL" value="<?=isset($data['AUTOMANUAL']) ? $data['AUTOMANUAL']: ''; ?>" />
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('BRANCH_TYPE')?></label>
                        <select class="text-control text-[12px] shadow-md border px-2 h-7 w-3/12 text-left rounded-xl border-gray-300 req" id="PROFACTYP" name="PROFACTYP" onchange="unRequired();" required>
                            <option value=""></option>
                            <?php foreach ($branchtype as $branch => $branchitem) { ?>
                                <option value="<?=$branch ?>" <?=(isset($data['PROFACTYP']) && $data['PROFACTYP'] == $branch) ? 'selected' : '' ?>><?=$branchitem ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="w-6/12"></label>
                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('INPUT_DATE')?></label>
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                id="PROISSUEDT" name="PROISSUEDT" value="<?=!empty($data['PROISSUEDT']) ? date('Y-m-d', strtotime($data['PROISSUEDT'])) : date('Y-m-d'); ?>"/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEMCODE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                    name="ITEMCD" id="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" onchange="unRequired();" required/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHITEM">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                            id="ITEMSPEC" name="ITEMSPEC" readonly/>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                            id="ITEMDRAWNO" name="ITEMDRAWNO" readonly/>
                        <input class="hidden" type="hidden" id="PROORDERNOID" name="PROORDERNOID" value="<?=isset($data['PROORDERNOID']) ? $data['PROORDERNOID']: ''; ?>"/>
                        <input class="hidden" type="hidden" id="ITEMTAXTYP" name="ITEMTAXTYP" value="<?=isset($data['ITEMTAXTYP']) ? $data['ITEMTAXTYP']: ''; ?>"/>
                        <input class="hidden" type="hidden" id="OLDITEMCD" name="OLDITEMCD" value="<?=isset($data['OLDITEMCD']) ? $data['OLDITEMCD']: ''; ?>"/>
                        <input class="hidden" type="hidden" id="SYSMSG" name="SYSMSG" value="<?=isset($data['SYSMSG']) ? $data['SYSMSG']: ''; ?>"/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('MATERIALCODE')?></label>
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                id="MATERIALCD" name="MATERIALCD" value="<?=isset($data['MATERIALCD']) ? $data['MATERIALCD']: ''; ?>" readonly/>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                id="MATERIALNAME" name="MATERIALNAME" value="<?=isset($data['MATERIALNAME']) ? $data['MATERIALNAME']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 px-2">
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DESTINATE_STORAGE')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-4/12 mr-1 text-left rounded-xl border-gray-300 req" id="LOCTYP" name="LOCTYP" onchange="unRequired();" required>
                                <option value=""></option>
                                <?php foreach ($storagetype as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['LOCTYP']) && $data['LOCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                        </select>
                        <div class="relative w-5/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                    id="LOCCD" name="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''; ?>" onchange="unRequired();" required/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHLOC">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                            id="LOCNAME" name="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''; ?>" readonly/>
                        <label class="w-5/12"></label>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WC_CODE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                    id="WCCD" name="WCCD" value="<?=isset($data['WCCD']) ? $data['WCCD']: ''; ?>" onchange="unRequired();" required/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHWORKCENTER">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                id="WCNAME" name="WCNAME" value="<?=isset($data['WCNAME']) ? $data['WCNAME']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                    name="STAFFCD" id="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" onchange="unRequired();" required/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHSTAFF">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PRODUCT_ORDER_QTY')?></label>
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                id="PROQTY" name="PROQTY" value="<?=!empty($data['PROQTY']) ? number_format(str_replace(',', '',$data['PROQTY']), 0): ''; ?>" 
                                onchange="this.value = numberWithComma(this.value); unRequired();" oninput="this.value = stringReplacez(this.value);" required/>
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 read" id="ITEMUNITTYP" name="ITEMUNITTYP">
                                <option value=""></option>
                                <?php foreach ($unit as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                        </select>      
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PROD_DUE_DATE')?></label>
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center req"
                                id="PROPLANENDDT" name="PROPLANENDDT" value="<?=!empty($data['PROPLANENDDT']) ? date('Y-m-d', strtotime($data['PROPLANENDDT'])) : ''; ?>" onchange="unRequired();" required/>
                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('START_DATE_PRODUCE')?></label>
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center req"
                                id="PROPLANSTARTDT" name="PROPLANSTARTDT" value="<?=!empty($data['PROPLANSTARTDT']) ? date('Y-m-d', strtotime($data['PROPLANSTARTDT'])) : ''; ?>" onchange="unRequired();" required/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALES_ORDER_NO')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    name="SALEORDERNOLN" id="SALEORDERNOLN" value="<?=isset($data['SALEORDERNOLN']) ? $data['SALEORDERNOLN']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHSALEORDERDETAIL">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                id="SALELNITEMNAME" name="SALELNITEMNAME" value="<?=isset($data['SALELNITEMNAME']) ? $data['SALELNITEMNAME']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INSPECTION')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="PROINSPTYP" name="PROINSPTYP">
                                <option value=""></option>
                                <?php foreach ($inspection as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['PROINSPTYP']) && $data['PROINSPTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                        </select>
                        <label class="w-5/12"></label>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REMARK')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 mr-1 py-2 px-3 text-gray-700 border-gray-300"
                            id="PROREM" name="PROREM" value="<?=isset($data['PROREM']) ? $data['PROREM']: ''; ?>" />
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STATUS')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 read" id="PROSTATUS" name="PROSTATUS">
                                <option value=""></option>
                                <?php foreach ($statusorder as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['PROSTATUS']) && $data['PROSTATUS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                        </select>
                        <label class="w-5/12"></label>
                    </div>
                </div>
     
                <hr class="divide-y divide-dotted my-2 mx-2">

                <!-- <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PROPATTERN')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    name="ITEMPROPTNCD" id="ITEMPROPTNCD" value="<?=isset($data['ITEMPROPTNCD']) ? $data['ITEMPROPTNCD']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="PROCESSPATTERNGUIDE">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                id="PROPTNNAME" name="PROPTNNAME" value="<?=isset($data['PROPTNNAME']) ? $data['PROPTNNAME']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('COMBINATION')?></label>
                        <select class="text-control text-sm shadow-md border mr-2 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300"
                                id="BMVERSION" name="BMVERSION">
                                <option value=""></option>
                                <?php foreach ($bmversion as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['BMVERSION']) && $data['BMVERSION'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                        </select>
                        <label class="w-5/12"></label>
                    </div>
                </div>
                <hr class="divide-y divide-dotted my-2 mx-2"> -->

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ONHAND')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="ONHAND" name="ONHAND" value="<?=!empty($data['ONHAND']) ? number_format(str_replace(',', '',$data['ONHAND']), 2): ''; ?>"/>
                        <label class="text-color block text-sm w-3/12 px-2 pt-1"><?=checklang('AWAIT_TEST')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="AWAIT_TEST" name="AWAIT_TEST" value="<?=!empty($data['AWAIT_TEST']) ? number_format(str_replace(',', '',$data['AWAIT_TEST']), 2): ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INV_OF_ORDER')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="INV_OF_ORDER" name="INV_OF_ORDER" value="<?=!empty($data['INV_OF_ORDER']) ? number_format(str_replace(',', '',$data['INV_OF_ORDER']), 2): ''; ?>"/>
                        <label class="text-color block text-sm w-3/12 px-2 pt-1"><?=checklang('BACKLOG')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="BACKLOG" name="BACKLOG" value="<?=!empty($data['BACKLOG']) ? number_format(str_replace(',', '',$data['BACKLOG']), 2): ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ALLOCATE')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                id="ALLOCATE" name="ALLOCATE" value="<?=!empty($data['ALLOCATE']) ? number_format(str_replace(',', '',$data['ALLOCATE']), 2): ''; ?>"/>
                    </div>
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-8/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 hidden"
                                id="INSERTBAK"><?=checklang('INSERT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?> <?php if(!empty($data['PROORDERNO'])) { ?> disabled <?php } ?>
                                id="INSERT" name="INSERT"><?=checklang('INSERT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?> <?php if(empty($data['PROORDERNO'])) { ?> disabled <?php } ?>
                                id="UPDATE" name="UPDATE"><?=checklang('UPDATE'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?> <?php if(empty($data['PROORDERNO']) ) { ?> disabled <?php } ?>
                                id="DELETE" name="DELETE"><?=checklang('DELETE'); ?></button>
                    </div>
                    <div class="flex w-4/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
                        <button type="button" id="BACK" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 hidden"
                                onclick="return back();"><?=checklang('BACK'); ?></button>
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
        let SYSVIS_INS = '<?php echo (!empty($data['SYSVIS_INS']) ? $data['SYSVIS_INS'] : 'T'); ?>';
        let SYSVIS_UPD = '<?php echo (!empty($data['SYSVIS_UPD']) ? $data['SYSVIS_UPD'] : 'T'); ?>';
        let SYSVIS_DEL = '<?php echo (!empty($data['SYSVIS_DEL']) ? $data['SYSVIS_DEL'] : 'T'); ?>';
        let SYSVIS_CLEAR = '<?php echo (!empty($data['SYSVIS_CLEAR']) ? $data['SYSVIS_CLEAR'] : 'T'); ?>';
        let SYSVIS_END = '<?php echo (!empty($data['SYSVIS_END']) ? $data['SYSVIS_END'] : 'T'); ?>';
        let SYSVIS_BACK = '<?php echo (!empty($data['SYSVIS_BACK']) ? $data['SYSVIS_BACK'] : 'F'); ?>';
        let SYSVIS_HIDENINS = '<?php echo (!empty($data['SYSVIS_HIDENINS']) ? $data['SYSVIS_HIDENINS'] : 'F'); ?>';
        let SYSEN_PROORDERNO = '<?php echo (!empty($data['SYSEN_PROORDERNO']) ? $data['SYSEN_PROORDERNO'] : 'F'); ?>';
        let ALLOCORDERFLG = '<?php echo (!empty($_POST['ALLOCORDERFLG']) ? $_POST['ALLOCORDERFLG'] : '0'); ?>';
       
        document.getElementById('INSERT').classList[SYSVIS_INS == 'F' ? 'add' : 'remove']('hidden');
        document.getElementById('UPDATE').classList[SYSVIS_UPD == 'F' ? 'add' : 'remove']('hidden');
        document.getElementById('DELETE').classList[SYSVIS_DEL == 'F' ? 'add' : 'remove']('hidden');
        document.getElementById('CLEAR').classList[SYSVIS_CLEAR == 'F' ? 'add' : 'remove']('hidden');
        document.getElementById('END').classList[SYSVIS_END == 'F' ? 'add' : 'remove']('hidden');
        document.getElementById('BACK').classList[SYSVIS_BACK == 'T' ? 'remove' : 'add']('hidden');
        document.getElementById('INSERTBAK').classList[SYSVIS_HIDENINS == 'T' ? 'remove' : 'add']('hidden');
        document.getElementById('PROORDERNO').classList[SYSEN_PROORDERNO == 'F' && ALLOCORDERFLG == 1 ? 'add' : 'remove']('read');
        document.getElementById('SEARCHPRODUCTIONORDER').classList[SYSEN_PROORDERNO == 'F' && ALLOCORDERFLG == 1 ? 'add' : 'remove']('pointer-events-none');
    });

    function actionDialog(action) {
        return questionDialog(3, action, '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
    }

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'PROORDERNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result); 
        }  
    }

    function HandlePopupLocResult(result, type) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getLoc(result, type);    
    }

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('validation1'); ?>',
            // background: '#8ca3a3',
            showCancelButton: false,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }
</script>