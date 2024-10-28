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
            <form class="w-full" method="POST" action="" id="accBOKEntry10" name="accBOKEntry10" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

            <!-- Voucher No. -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('VOUCHER_NO')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="BOOKORDERNO" id="BOOKORDERNO" value="<?=isset($data['BOOKORDERNO']) ? $data['BOOKORDERNO']: ''; ?>"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="ASSETGUIDE">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="flex w-6/12  justify-end">
                    <input class="hidden text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        type="date" id="INPDATE" name="INPDATE" value="<?=!empty($data['INPDATE']) ? date('Y-m-d', strtotime($data['INPDATE'])) : date('Y-m-d'); ?>" />
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('V_ISSUE_DATE')?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                    type="date" id="ISSUEDATE" name="ISSUEDATE" value="<?=!empty($data['ISSUEDATE']) ? date('Y-m-d', strtotime($data['ISSUEDATE'])) : date('Y-m-d'); ?>" />
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="ACCY" name="ACCY">
                        <option value=""></option>
                        <?php foreach ($yearvalue as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['ACCY']) && $data['ACCY'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>   
                </div>
            </div>

            <!-- Input Staff -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INP_STAFF')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="INP_STFCD" id="INP_STFCD" value="<?=isset($data['INP_STFCD']) ? $data['INP_STFCD']: ''; ?>"readonly/>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="INP_STFNM" id="INP_STFNM" value="<?=isset($data['INP_STFNM']) ? $data['INP_STFNM']: ''; ?>"readonly/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="DIVISIONCD" id="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHDIVISION">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="DIVISIONNAME" id="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                </div>
            </div>

            <!-- Purchase Form -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PURCHFROM')?></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="CSS_TYPE" name="CSS_TYPE" style="pointer-events: none;"> 
                        <option value=""></option>
                        <?php foreach ($csstyp as $css => $item) { ?>
                            <option value="<?=$css ?>" <?=(isset($data['CSS_TYPE']) && $data['CSS_TYPE'] == $css) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select> 
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="SUPPLIERCD" id="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: ''; ?>"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHSUPPLIER">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="SUPPLIERNAME" id="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>" readonly/> 
                </div>
                <div class="flex w-6/12">
                    <label class="invisible text-color block text-sm w-3/12 pr-2 pt-1"></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="ASSETTYP" name="ASSETTYP">
                        <option value=""></option>
                        <?php foreach ($assettype as $asset => $assetitem) { ?>
                            <option value="<?=$asset ?>" <?=(isset($data['ASSETTYP']) && $data['ASSETTYP'] == $asset) ? 'selected' : '' ?>><?=$assetitem ?></option>
                        <?php } ?>
                    </select> 
                    <label class="invisible text-color block text-sm w-1/12 pr-2 pt-1"></label>
                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('INVOICENO')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="INVOICE_NO" id="INVOICE_NO" value="<?=isset($data['INVOICE_NO']) ? $data['INVOICE_NO']: ''; ?>"/>
                </div>
            </div>

            <!-- Assest Code -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ASSETCODE')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="ASSETCD" id="ASSETCD" value="<?=isset($data['ASSETCD']) ? $data['ASSETCD']: ''; ?>"/>
                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('QTY')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="QTY" id="QTY" value="<?=!empty($data['QTY']) ? number_format(str_replace(',', '', $data['QTY']), 0): '1'; ?>"
                        onchange="this.value = numberWithCommas(parseFloat(this.value) || 0); calcsalv(); calcamt();"
                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = numberWithCommas(parseFloat(this.value) || 0); calcsalv(); }"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('UNIT_PRICE')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="UPRICE" id="UPRICE" value="<?=!empty($data['UPRICE']) ? number_format(str_replace(',', '', $data['UPRICE']), 2): ''; ?>"
                        onchange="this.value = numberWithCommas(parseFloat(this.value).toFixed(2)); calcamt();"
                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = numberWithCommas(parseFloat(this.value).toFixed(2)); calcamt(); }"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-1/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="I_CURRENCY" name="I_CURRENCY" onchange="get_exrate();">
                        <option value=""></option>
                        <?php foreach ($currencytyp as $cur1 => $curitem1) { ?>
                            <option value="<?=$cur1 ?>" <?=(isset($data['I_CURRENCY']) && $data['I_CURRENCY'] == $cur1) ? 'selected' : '' ?>><?=$curitem1 ?></option>
                        <?php } ?>
                    </select> 
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="EXRATE" id="EXRATE" value="<?=isset($data['EXRATE']) ? $data['EXRATE']: '1.000000'; ?>"
                        onchange="this.value = digitFormat(this.value); calcamt();"
                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = digitFormat(this.value); calcamt(); }"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <input type="text" class="hidden text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="DEPREC_A" value="F"/>
                    <input type="checkbox" id="DEPREC_A" name="DEPREC_A" value="T" onclick="chkDEPREC();" <?php echo (isset($data['DEPREC_A']) && $data['DEPREC_A'] == 'T') ? 'checked' : '' ?>/>
                    <label class="text-color block text-sm pt-1 w-2/12 text-center"><?=checklang('DEPREC_AUTO')?></label>
                </div>
            </div>

            <!-- Asset Name -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ASSETNM')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="ASSETNM" id="ASSETNM" value="<?=isset($data['ASSETNM']) ? $data['ASSETNM']: ''; ?>" onchange="unRequired();"/>
                </div>
                <div class="flex w-6/12">
                    <input type="text" class="hidden text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="COMCURRENCY" id="COMCURRENCY" value="<?=isset($data['COMCURRENCY']) ? $data['COMCURRENCY']: ''; ?>"/>
                    <input class="hidden text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center read"
                        type="date" id="TDATE" name="TDATE" value="<?=!empty($data['TDATE']) ? date('Y-m-d', strtotime($data['TDATE'])) : date('Y-m-d'); ?>" />
                    <input type="text"  class="invisible text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"/>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ASUNITPRC" id="ASUNITPRC" value="<?=!empty($data['ASUNITPRC']) ? number_format(str_replace(',', '', $data['ASUNITPRC']), 2): ''; ?>" readonly/>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-1/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="CURRENCY1" name="CURRENCY1" style="pointer-events: none;">
                        <option value=""></option>
                        <?php foreach ($currencytyp as $cur2 => $curitem2) { ?>
                            <option value="<?=$cur2 ?>" <?=(isset($data['CURRENCY1']) && $data['CURRENCY1'] == $cur2) ? 'selected' : '' ?>><?=$curitem2 ?></option>
                        <?php } ?>
                    </select>
                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('AMOUNT')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="AS_AMT" id="AS_AMT" value="<?=!empty($data['AS_AMT']) ? number_format(str_replace(',', '', $data['AS_AMT']), 2): '0.00'; ?>" readonly/>

                </div>
            </div>

            <!-- Asset Name(EN) -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ASSETNM_E')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="ASSETNM_E" id="ASSETNM_E" value="<?=isset($data['ASSETNM_E']) ? $data['ASSETNM_E']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SERIALNO')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SERIAL_NO" id="SERIAL_NO" value="<?=isset($data['SERIAL_NO']) ? $data['SERIAL_NO']: ''; ?>"/>
                </div>
            </div>


            <!-- Asset Group Code -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ASSETACCCD')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="ASSETACC" id="ASSETACC" value="<?=isset($data['ASSETACC']) ? $data['ASSETACC']: ''; ?>" onchange="unRequired();"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="ASSETACCGUIDE">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ASSETNA" id="ASSETNA" value="<?=isset($data['ASSETNA']) ? $data['ASSETNA']: ''; ?>" readonly/>
                </div>
                <div class="flex w-6/12">
                </div>
            </div>

            <!-- Start Date -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STARTDATE')?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                    type="date" id="STDATE" name="STDATE" value="<?=!empty($data['STDATE']) ? date('Y-m-d', strtotime($data['STDATE'])) : date('Y-m-d'); ?>" />
                    <label class="invisible text-color block text-sm w-3/12 pr-2 pt-1"></label>

                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('LIFE')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="LIFEY" id="LIFEY" value="<?=isset($data['LIFEY']) ? $data['LIFEY']: '5'; ?>" onchange="calcRatio();"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('YEAR')?></label>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('RATE')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                            name="DRATE" id="DRATE" value="<?=isset($data['DRATE']) ? $data['DRATE']: '20.00'; ?>" readonly/>
                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('%')?></label>
                    <label class="invisible text-color block text-sm w-1/12 pr-2 pt-1"></label>

                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('SALVAGEVALUE')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SOLVAGEVL" id="SOLVAGEVL" value="<?=!empty($data['SOLVAGEVL']) ? number_format(str_replace(',', '', $data['SOLVAGEVL']), 2): '1.00'; ?>"
                        onchange="this.value = numberWithCommas(parseFloat(this.value).toFixed(2));"
                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = numberWithCommas(parseFloat(this.value).toFixed(2)); }"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-scroll mb-1"> 
              <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                <thead class="sticky top-0 bg-gray-50">
                    <tr class="flex w-full divide-x csv">
                        <th class="w-1/12 text-center border border-slate-700" scope="col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                        </th>
                        <th class="w-1/12 text-center border border-slate-700" scope="col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                        </th>
                        <th class="w-2/12 text-center border border-slate-700" scope="col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAME')?></span>
                        </th>
                        <th class="w-2/12 text-center border border-slate-700" scope="col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                        </th>
                        <th class="w-1/12 text-center border border-slate-700" scope="col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DEBIT')?></span>
                        </th>
                        <th class="w-1/12 text-center border border-slate-700" scope="col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CREDIT')?></span>
                        </th>
                        <th class="w-1/12 text-center border border-slate-700" scope="col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SECTION1')?></span>
                        </th>
                        <th class="w-3/12 text-center border border-slate-700" scope="col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"></span>
                        </th>
                    </tr>
                </thead>
                <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[192px]"> <?php 
                if(!empty($data['ITEM']))  {
                    $minrow = count($data['ITEM']);
                    foreach ($data['ITEM'] as $key => $value) { ?>
                        <tr class="flex w-full p-0 divide-x csv" id="rowId<?=$key?>">
                        <td class="h-6 w-1/12 text-sm text-center border border-slate-700 row-id" id="ROWNO_TD<?=$key?>"><?=isset($value['ROWNO']) ? $value['ROWNO']: '' ?></td>
                        <td class="h-6 w-1/12 text-sm text-center border border-slate-700" id="ACC_CD_TD<?=$key?>"><?=isset($value['ACC_CD']) ? $value['ACC_CD']: '' ?></td>
                        <td class="h-6 w-2/12 text-sm text-center border border-slate-700" id="ACC_NM_TD<?=$key?>"><?=isset($value['ACC_NM']) ? $value['ACC_NM']: '' ?></td>
                        <td class="h-6 w-2/12 text-sm text-center border border-slate-700" id="ACCTRANREMARK_TD<?=$key?>"><?=isset($value['ACCTRANREMARK']) ? $value['ACCTRANREMARK']: '' ?></td>
                        <td class="h-6 w-1/12 text-sm text-center border border-slate-700" id="ACCAMT1_TD<?=$key?>"><?=isset($value['ACCAMT1']) ? $value['ACCAMT1']: '' ?></td>
                        <td class="h-6 w-1/12 text-sm text-center border border-slate-700" id="ACCAMT2_TD<?=$key?>"><?=isset($value['ACCAMT2']) ? $value['ACCAMT2']: '' ?></td>
                        <td class="h-6 w-1/12 text-sm text-center border border-slate-700" id="SECTION1_TD<?=$key?>"><?=isset($value['SECTION1']) ? $value['SECTION1']: '' ?></td>
                        <td class="h-6 w-3/12 text-sm text-center border border-slate-700"></td>

                        <td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="PROJECTNO_TD<?=$key?>"><?=isset($value['PROJECTNO']) ? $value['PROJECTNO']: '' ?></td>
                        <td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="DC_TYPE_TD<?=$key?>"><?=isset($value['DC_TYPE']) ? $value['DC_TYPE']: '' ?></td>
                        <td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="EXRATE_TD<?=$key?>"><?=isset($value['EXRATE']) ? $value['EXRATE']: '' ?></td>
                        <td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="CURRENCY1_TD<?=$key?>"><?=isset($value['CURRENCY1']) ? $value['CURRENCY1']: '' ?></td>
                        <td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="I_CURRENCY_TD<?=$key?>"><?=isset($value['I_CURRENCY']) ? $value['I_CURRENCY']: '' ?></td>
                        <td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="VOUCHERNO_TD<?=$key?>"><?=isset($value['VOUCHERNO']) ? $value['VOUCHERNO']: '' ?></td>

                        <td class="td-hide"><input type="hidden" id="ROWNO<?=$key?>" name="ROWNOA[]" value="<?=isset($value['ROWNO']) ? $value['ROWNO']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="VOUCHERNO<?=$key?>" name="VOUCHERNOA[]" value="<?=isset($value['VOUCHERNO']) ? $value['VOUCHERNO']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ACC_CD<?=$key?>" name="ACC_CDA[]" value="<?=isset($value['ACC_CD']) ? $value['ACC_CD']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ACC_NM<?=$key?>" name="ACC_NMA[]" value="<?=isset($value['ACC_NM']) ? $value['ACC_NM']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ACCTRANREMARK<?=$key?>" name="ACCTRANREMARKA[]" value="<?=isset($value['ACCTRANREMARK']) ? $value['ACCTRANREMARK']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ACCAMT1<?=$key?>" name="ACCAMT1A[]" value="<?=isset($value['ACCAMT1']) ? $value['ACCAMT1']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="ACCAMT2<?=$key?>" name="ACCAMT2A[]" value="<?=isset($value['ACCAMT2']) ? $value['ACCAMT2']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="SECTION1<?=$key?>" name="SECTION1A[]" value="<?=isset($value['SECTION1']) ? $value['SECTION1']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="PROJECTNO<?=$key?>" name="PROJECTNOA[]" value="<?=isset($value['PROJECTNO']) ? $value['PROJECTNO']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="DC_TYPE<?=$key?>" name="DC_TYPEA[]" value="<?=isset($value['DC_TYPE']) ? $value['DC_TYPE']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="CURRENCY1<?=$key?>" name="CURRENCY1A[]" value="<?=isset($value['CURRENCY1']) ? $value['CURRENCY1']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="I_CURRENCY<?=$key?>" name="I_CURRENCYA[]" value="<?=isset($value['I_CURRENCY']) ? $value['I_CURRENCY']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="EXRATE<?=$key?>" name="EXRATEA[]" value="<?=isset($value['EXRATE']) ? $value['EXRATE']: '' ?>"></td>
                        <td class="td-hide"><input type="hidden" id="AMT<?=$key?>" name="AMTA[]" value="<?=isset($value['AMT']) ? $value['AMT']: '' ?>"></td>

                        </tr><?php 
                    }
                    for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                        <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">    
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-2/12 border border-slate-700"></td>
                            <td class="h-6 w-2/12 border border-slate-700"></td>
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-3/12 border border-slate-700"></td>                            
                        </tr><?php 
                    }
                } else {                            
                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                        <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-2/12 border border-slate-700"></td>
                            <td class="h-6 w-2/12 border border-slate-700"></td>
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-1/12 border border-slate-700"></td>
                            <td class="h-6 w-3/12 border border-slate-700"></td>                            
                        </tr><?php
                    }
                } ?>
                </tbody>
              </table>
              <div class="flex p-2">
                  <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
              </div>
            </div>

            <!-- Commit -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                            id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                        <input type="text" class="hidden text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            name="VOUCHERNO" id="VOUCHERNO" value="<?=isset($data['VOUCHERNO']) ? $data['VOUCHERNO']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="button" id="ENTRY" name="ENTRY" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                            onclick="entry();"><?=checklang('ENTRY')?></button>
                    </div>

                    <!-- <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=checklang('INSERT'); ?></button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                        <?php if(empty($data['CATALOGCD'])) { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                        <?php if(empty($data['CATALOGCD'])) { ?> disabled <?php } ?>><?=checklang('DELETE'); ?></button> -->

                </div>
                <div class="flex w-6/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                            name="TTL_AMT1" id="TTL_AMT1" value="<?=isset($data['TTL_AMT1']) ? $data['TTL_AMT1']: ''; ?>" readonly/>
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                            name="TTL_AMT2" id="TTL_AMT2" value="<?=isset($data['TTL_AMT2']) ? $data['TTL_AMT2']: ''; ?>" readonly/>
                        <label class="invisible text-color block text-sm w-4/12 pr-2 pt-1"></label>
                        <button type="reset" id="CLEAR" name="CLEAR" class="justify-end btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                            onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>
                        <button type="button" id="END" class="justify-end btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                            onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=checklang('END'); ?></button>

                </div>
            </div>

            <!-- Debit -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="DC_TYPE" name="DC_TYPE" onchange="dc_type();">
                        <option value=""></option>
                        <?php foreach ($dctyp as $dc => $dcitem) { ?>
                            <option value="<?=$dc ?>" <?=(isset($data['DC_TYPE']) && $data['DC_TYPE'] == $dc) ? 'selected' : '' ?>><?=$dcitem ?></option>
                        <?php } ?>
                    </select>   
                    <input type="text" class="hidden text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="ROWNO" id="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('DEBIT')?></label>
                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('CREDIT')?></label>
                </div>
            </div>

            <!-- Acc Code -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACC_CODE')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="ACC_CD" id="ACC_CD" value="<?=isset($data['ACC_CD']) ? $data['ACC_CD']: ''; ?>"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHACCOUNT">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ACC_NM" id="ACC_NM" value="<?=isset($data['ACC_NM']) ? $data['ACC_NM']: ''; ?>" readonly/>
                </div>
                <div class="flex w-6/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ACCAMT1" id="ACCAMT1" value="<?=isset($data['ACCAMT1']) ? $data['ACCAMT1']: ''; ?>" readonly/>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ACCAMT2" id="ACCAMT2" value="<?=isset($data['ACCAMT2']) ? $data['ACCAMT2']: ''; ?>" readonly/>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-1/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="CURRENCY1x" name="CURRENCY1x">
                        <option value=""></option>
                        <?php foreach ($currencytyp as $curr => $curritem) { ?>
                            <option value="<?=$curr ?>" <?=(isset($data['CURRENCY1x']) && $data['CURRENCY1x'] == $curr) ? 'selected' : '' ?>><?=$curritem ?></option>
                        <?php } ?>
                    </select>   
                </div>
            </div>

            <!-- Department -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SECTION')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SECTION1" id="SECTION1" value="<?=isset($data['SECTION1']) ? $data['SECTION1']: ''; ?>"/>

                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('AMOUNT')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="AMT" id="AMT" value="<?=isset($data['AMT']) ? $data['AMT']: ''; ?>"
                        onchange="this.value = numberWithCommas(parseFloat(this.value).toFixed(2)); dc_type1();"
                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = numberWithCommas(parseFloat(this.value).toFixed(2)); dc_type1(); }"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-1/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="I_CURRENCYx" name="I_CURRENCYx">
                        <option value=""></option>
                        <?php foreach ($currencytyp as $curr => $curritem) { ?>
                            <option value="<?=$curr ?>" <?=(isset($data['I_CURRENCYx']) && $data['I_CURRENCYx'] == $curr) ? 'selected' : '' ?>><?=$curritem ?></option>
                        <?php } ?>
                    </select>   
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="EXRATEx" id="EXRATEx" value="<?=isset($data['EXRATE']) ? $data['EXRATE']: '1.000000'; ?>"
                        onchange="dc_type1(); this.value = digitFormat(this.value);"
                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ dc_type1(); this.value = digitFormat(this.value); }"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>

                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('PROJECTNO')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="PROJECTNO" id="PROJECTNO" value="<?=isset($data['PROJECTNO']) ? $data['PROJECTNO']: ''; ?>"/>
                </div>
            </div>

            <!-- Description -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DESCRIPTION')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="ACCTRANREMARK" id="ACCTRANREMARK" value="<?=isset($data['ACCTRANREMARK']) ? $data['ACCTRANREMARK']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                </div>
            </div>

            <!-- OK -->
            <div class="flex mb-2">   
                <div class="flex w-6/12 px-1">
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=checklang('OK'); ?></button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="ASVC" name="ASVC" ><?=checklang('ASVC'); ?></button>
                </div>
                <div class="flex w-6/12 px-1 justify-end">
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
</body><script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-54fxMsmCN6QRpByKh/g3Dxazgtnlz5oCJOM41ha17HW5WLZT6hWG1xPWLE7S0YLb" crossorigin="anonymous"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        calculateDVW(); calcamt(); unRequired(); 
        document.getElementById("ASVC").disabled = true;
        document.getElementById("UPDATE").disabled = true;
        document.getElementById("DELETE").disabled = true; 
        let print = '<?php echo (isset($data['SYSEN_PRINT']) ? $data['SYSEN_PRINT']: 'null'); ?>';
        if(print == 'T') { document.getElementById("ASVC").disabled = false; }

        var index = 0;
        var index = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        // console.log(index);
        OK.click(function() {
            if($('#ACC_CD').val() == '' || $('#DC_TYPE').val() == '' ) {
                return false;
            }
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr class="flex w-full p-0 divide-x csv" id=rowId'+index+'>');
            var cols = "";
            cols += '<td class="h-6 w-1/12 text-sm text-center border border-slate-700 row-id" id="ROWNO_TD'+index+'">'+index+'</td>';
            cols += '<td class="h-6 w-1/12 text-sm text-center border border-slate-700" id="ACC_CD_TD'+index+'">'+ $('#ACC_CD').val() +'</td>';
            cols += '<td class="h-6 w-2/12 text-sm text-center border border-slate-700"  id="ACC_NM_TD'+index+'">'+ $('#ACC_NM').val() +'</td>';
            cols += '<td class="h-6 w-2/12 text-sm text-center border border-slate-700"  id="ACCTRANREMARK_TD'+index+'">'+ $('#ACCTRANREMARK').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm text-center border border-slate-700" id="ACCAMT1_TD'+index+'">'+ $('#ACCAMT1').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm text-center border border-slate-700" id="ACCAMT2_TD'+index+'">'+ $('#ACCAMT2').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm text-center border border-slate-700" id="SECTION1_TD'+index+'">'+document.getElementById("SECTION1").value+'</td>';
            cols += '<td class="h-6 w-3/12 text-sm text-center border border-slate-700"></td>';
            cols += '<td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="PROJECTNO_TD'+index+'">'+ $('#PROJECTNO').val() +'</td>';
            cols += '<td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="DC_TYPE_TD'+index+'">'+ $('#DC_TYPE').val() +'</td>';
            cols += '<td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="EXRATE_TD'+index+'">'+ $('#EXRATEx').val() +'</td>';
            cols += '<td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="CURRENCY1_TD'+index+'">'+ $('#CURRENCY1x').val() +'</td>';
            cols += '<td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="I_CURRENCY_TD'+index+'">'+ $('#I_CURRENCYx').val() +'</td>';
            cols += '<td class="hidden h-6 w-3/12 text-sm text-center border border-slate-700" id="VOUCHERNO_TD'+index+'">'+ $('#VOUCHERNO').val() +'</td>';

            cols += '<td class="td-hide"><input type="hidden" id="ROWNO'+index+'" name="ROWNOA[]" value='+index+'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="VOUCHERNO'+index+'" name="VOUCHERNOA[]" value='+ $('#VOUCHERNO').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ACC_CD'+index+'" name="ACC_CDA[]" value='+ $('#ACC_CD').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ACC_NM'+index+'" name="ACC_NMA[]" value='+ $('#ACC_NM').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ACCTRANREMARK'+index+'" name="ACCTRANREMARKA[]" value='+ $('#ACCTRANREMARK').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ACCAMT1'+index+'" name="ACCAMT1A[]" value='+ $('#ACCAMT1').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="ACCAMT2'+index+'" name="ACCAMT2A[]" value='+ $('#ACCAMT2').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="SECTION1'+index+'" name="SECTION1A[]" value='+ document.getElementById("SECTION1").value +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="PROJECTNO'+index+'" name="PROJECTNOA[]" value='+ $('#PROJECTNO').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="DC_TYPE'+index+'" name="DC_TYPEA[]" value='+ $('#DC_TYPE').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="CURRENCY1'+index+'" name="CURRENCY1A[]" value='+ document.getElementById("CURRENCY1x").value +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="I_CURRENCY'+index+'" name="I_CURRENCYA[]" value='+ document.getElementById("I_CURRENCYx").value +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="EXRATE'+index+'" name="EXRATEA[]" value='+ $('#EXRATEx').val() +'></td>';
            cols += '<td class="td-hide"><input type="hidden" id="AMT'+index+'" name="AMTA[]" value='+ $('#AMT').val() +'></td></tr>';

            if(index <= 5) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $("table tbody").append(newRow);
            }
            $('#record').html(index);
            calculateTotal();
            keepItemData();
            return entry();
        });

        DELETE.click(function() {
            let id = $('#ROWNO').val();
            if(index > 0 && id != null) {
                // console.log(id);
                // document.getElementById("table").deleteRow(id);
                $('#rowId'+id).closest("tr").remove();
                if(index <= 5) {
                    emptyRow(index);
                }
                index--;
                $(".row-id").each(function (i) {
                    $(this).text(i+1);
                }); 
                $('#record').html(index);
                unsetItemData(id);
                changeRowId();
                // calculateTotal();
                id = null;
                return entry();
            }
        });
        selectRow();
    });

    function calculateDVW() {
        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        let accamt1 = 0; let accamt2 = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            // console.log(paymentArray);
            $.each(itemArray, function(key, value) {
                // console.log(value);
                accamt1 += parseFloat(value.ACCAMT1.replace(/,/g, '')) || 0;
                accamt2 += parseFloat(value.ACCAMT2.replace(/,/g, '')) || 0;
               
            });
            $('#TTL_AMT1').val(numberWithCommas(accamt1.toFixed(2)));
            $('#TTL_AMT2').val(numberWithCommas(accamt2.toFixed(2)));
        }        
    }

    // req ACCY DIVISIONCD ASSETTYP ASSETCD UPRICE ASSETNM ASSETACC LIFEY
    function unRequired() {
        if(ACCY.val() != '') {
        document.getElementById('ACCY').classList.remove('req');
        } else {
            document.getElementById('ACCY').classList.add('req');
        }
        if(DIVISIONCD.val() != '') {
        document.getElementById('DIVISIONCD').classList.remove('req');
        } else {
            document.getElementById('DIVISIONCD').classList.add('req');
        }
        if(ASSETTYP.val() != '') {
        document.getElementById('ASSETTYP').classList.remove('req');
        } else {
            document.getElementById('ASSETTYP').classList.add('req');
        }
        if(ASSETCD.val() != '') {
        document.getElementById('ASSETCD').classList.remove('req');
        } else {
            document.getElementById('ASSETCD').classList.add('req');
        }
        if(UPRICE.val() != '') {
        document.getElementById('UPRICE').classList.remove('req');
        } else {
            document.getElementById('UPRICE').classList.add('req');
        }
        if(ASSETNM.val() != '') {
        document.getElementById('ASSETNM').classList.remove('req');
        } else {
            document.getElementById('ASSETNM').classList.add('req');
        }
        if(ASSETACC.val() != '') {
        document.getElementById('ASSETACC').classList.remove('req');
        } else {
            document.getElementById('ASSETACC').classList.add('req');
        }
        if(LIFEY.val() != '') {
        document.getElementById('LIFEY').classList.remove('req');
        } else {
            document.getElementById('LIFEY').classList.add('req');
        }
    }

    function actionDialog(type) {
        if(type == 1) {
            //
        } else if(type == 2) {
            //commit
            return questionDialog(2, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');        
        } else if(type == 3) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 4) {
            return alertWarning('<?=lang('ERRO:ERRONOTACTIVEACC'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 5) {
            return questionDialog(3, '<?=lang('question4')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');        
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }

    function HandlePopupResultIndex(code, result, index) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/850/ACCBOK_ENTRY10/index.php?'+code+'=' + result + '&index=' + index;
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/850/ACCBOK_ENTRY10/index.php?'+code+'=' + result;
    }
</script>
</html>
