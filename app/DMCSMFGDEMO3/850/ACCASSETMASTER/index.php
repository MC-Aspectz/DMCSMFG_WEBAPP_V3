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
            <form class="w-full" method="POST" action="" id="accAssetMaster" name="accAssetMaster" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

            <!-- asset code -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ASSETCODE')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="ASSETCD" id="ASSETCD" value="<?=isset($data['ASSETCD']) ? $data['ASSETCD']: ''; ?>"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="ASSETGUIDE02">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="ASSETTYP" name="ASSETTYP">
                        <option value=""></option>
                        <?php foreach ($assettype as $asset => $assetitem) { ?>
                            <option value="<?=$asset ?>" <?=(isset($data['ASSETTYP']) && $data['ASSETTYP'] == $asset) ? 'selected' : '' ?>><?=$assetitem ?></option>
                        <?php } ?>
                    </select>  
                    <input class="hidden text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        type="date" id="TDATE" name="TDATE" value="<?=!empty($data['TDATE']) ? date('Y-m-d', strtotime($data['TDATE'])) : date('Y-m-d'); ?>" />
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PURCHASEPLACE')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SUPPLIERNM" id="SUPPLIERNM" value="<?=isset($data['SUPPLIERNM']) ? $data['SUPPLIERNM']: ''; ?>"/>
                    <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('PURCHASEDATE')?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                        type="date" id="PURCH_DT" name="PURCH_DT" value="<?=!empty($data['PURCH_DT']) ? date('Y-m-d', strtotime($data['PURCH_DT'])) : date('Y-m-d'); ?>" />
                </div>
            </div>

            <!-- asset name -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ASSETNM')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="ASSETNM" id="ASSETNM" value="<?=isset($data['ASSETNM']) ? $data['ASSETNM']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PURCHASEPRICE')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="PURCHPRC" id="PURCHPRC" value="<?=!empty($data['PURCHPRC']) ? number_format(str_replace(',', '', $data['PURCHPRC']), 2): ''; ?>"
                        onchange="this.value = numberWithCommas(parseFloat(this.value).toFixed(2) || 0); calcamt();"
                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = numberWithCommas(parseFloat(this.value).toFixed(2) || 0); calcamt(); }"
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
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="PURCHAMT" id="PURCHAMT" value="<?=!empty($data['PURCHAMT']) ? number_format(str_replace(',', '', $data['PURCHAMT']), 2): ''; ?>" readonly/> 
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="COMCURRENCYNM" id="COMCURRENCYNM" value="<?=!empty($data['COMCURRENCYNM']) ?$data['COMCURRENCYNM']: ''; ?>" readonly/> 
                    <input type="text" class="hidden text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="COMCURRENCY" id="COMCURRENCY" value="<?=!empty($data['COMCURRENCY']) ?$data['COMCURRENCY']: 'THB'; ?>" readonly/> 
                </div>
            </div>

            <!-- asset name(eng) -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ASSETNM_E')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="ASSETNM_E" id="ASSETNM_E" value="<?=isset($data['ASSETNM_E']) ? $data['ASSETNM_E']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVOICENO')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="INVOICE_NO" id="INVOICE_NO" value="<?=isset($data['INVOICE_NO']) ? $data['INVOICE_NO']: ''; ?>"/>
                    <label class="invisible text-color block text-sm w-1/12 pr-2 pt-1"></label>
                    <input type="hidden" name="DEPREC_A" value="F"/>
                    <input type="checkbox" id="DEPREC_A" name="DEPREC_A" value="T" onclick="chkDEPREC();" <?php echo (isset($data['DEPREC_A']) && $data['DEPREC_A'] == 'T') ? 'checked' : '' ?>/>
                    <label class="text-color block text-sm pt-1 w-2/12 text-center"><?=checklang('DEPREC_AUTO')?></label>
                </div>
            </div>

            <!-- asset group code -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ASSETACCCD')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="ASSETACC" id="ASSETACC" value="<?=isset($data['ASSETACC']) ? $data['ASSETACC']: ''; ?>"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="ASSETACCGUIDE">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ASSETACCNM" id="ASSETACCNM" value="<?=isset($data['ASSETACCNM']) ? $data['ASSETACCNM']: ''; ?>" readonly/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SERIALNO')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SERIAL_NO" id="SERIAL_NO" value="<?=isset($data['SERIAL_NO']) ? $data['SERIAL_NO']: ''; ?>"/>
                </div>
            </div>

            <!-- asset account -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACCASSET')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ACCCD1" id="ACCCD1" value="<?=isset($data['ACCCD1']) ? $data['ACCCD1']: ''; ?>" readonly/>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ACCNM1" id="ACCNM1" value="<?=isset($data['ACCNM1']) ? $data['ACCNM1']: ''; ?>" readonly/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DEPREXP')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ACCCD2" id="ACCCD2" value="<?=isset($data['ACCCD2']) ? $data['ACCCD2']: ''; ?>" readonly/>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ACCNM2" id="ACCNM2" value="<?=isset($data['ACCNM2']) ? $data['ACCNM2']: ''; ?>" readonly/>
                </div>
            </div>

            <!-- monthly -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="invisible text-color block text-sm w-3/12 pr-2 pt-1"></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="DEPRTYP" name="DEPRTYP">
                        <option value=""></option>
                        <?php foreach ($deprtype as $depr => $depritem) { ?>
                            <option value="<?=$depr ?>" <?=(isset($data['DEPRTYP']) && $data['DEPRTYP'] == $depr) ? 'selected' : '' ?>><?=$depritem ?></option>
                        <?php } ?>
                    </select> 
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ACCUMDEPR')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ACCCD3" id="ACCCD3" value="<?=isset($data['ACCCD3']) ? $data['ACCCD3']: ''; ?>" readonly/>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="ACCNM3" id="ACCNM3" value="<?=isset($data['ACCNM3']) ? $data['ACCNM3']: ''; ?>" readonly/>
                </div>
            </div>

            <!-- start date -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STARTDATE')?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                    type="date" id="STDATE" name="STDATE" value="<?=!empty($data['STDATE']) ? date('Y-m-d', strtotime($data['STDATE'])) : date('Y-m-d'); ?>" />
                    <label class="invisible text-color block text-sm w-3/12 pr-2 pt-1"></label>

                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('LIFE')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="LIFEY" id="LIFEY" value="<?=isset($data['LIFEY']) ? $data['LIFEY']: '5'; ?>"
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
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SOLVAGEVL" id="SOLVAGEVL" value="<?=!empty($data['SOLVAGEVL']) ? number_format(str_replace(',', '', $data['SOLVAGEVL']), 2): ''; ?>"
                        onchange="this.value = numberWithCommas(parseFloat(this.value).toFixed(2));"
                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = numberWithCommas(parseFloat(this.value).toFixed(2)); }"
                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="COMCURRENCYNM1" id="COMCURRENCYNM1" value="<?=!empty($data['COMCURRENCYNM1']) ?$data['COMCURRENCYNM1']: ''; ?>" readonly/> 
                </div>
            </div>

            <div class="divide-y-2 divide-dotted"></div>
            <br>                
            <br>                
            <!-- current value -->
            <div class="flex mb-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BOKA')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="BOOKVALUE" id="BOOKVALUE" value="<?=!empty($data['BOOKVALUE']) ? number_format(str_replace(',', '', $data['BOOKVALUE']), 2): ''; ?>" readonly/>
                    <label class="invisible text-color block text-sm w-2/12 pr-2 pt-1"></label>
                    <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?=checklang('JIKOSYOKYAKU')?></label>
                </div>
                <div class="flex w-6/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="LOSTVL" id="LOSTVL" value="<?=isset($data['LOSTVL']) ? $data['LOSTVL']: ''; ?>"/>
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BAIKYAKU')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SOLDVL" id="SOLDVL" value="<?=isset($data['SOLDVL']) ? $data['SOLDVL']: ''; ?>"/>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center read"
                        type="date" id="EDDATE" name="EDDATE" value="<?=!empty($data['EDDATE']) ? date('Y-m-d', strtotime($data['EDDATE'])) : date('Y-m-d'); ?>" />
                </div>
            </div>

            <div class="inline-flex flex-row w-full">
                <!-- table -->
                <div class="flex-col w-6/12">
                    <div class="overflow-scroll mb-1"> 
                        <table id="table" class="w-11/12 border-collapse border border-slate-500 divide-gray-200 asset_tb" rules="cols" cellpadding="3" cellspacing="1">
                            <thead class="sticky top-0 bg-gray-50">
                                <tr class="flex w-full divide-x csv">
                                    <th class="w-2/12 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ROWNO')?></span>
                                    </th>
                                    <th class="w-2/12 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('YYMM')?></span>
                                    </th>
                                    <th class="w-2/12 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VALUE')?></span>
                                    </th>
                                    <th class="w-2/12 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DEPARFLG')?></span>
                                    </th>
                                    <th class="w-4/12 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"></span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[360px]"> <?php 
                            if(!empty($data['ITEM']))  {
                                $minrow = count($data['ITEM']);
                                foreach ($data['ITEM'] as $key => $value) { ?>
                                    <tr class="flex w-full p-0 divide-x csv" id="rowId<?=$key?>">
                                        <td class="h-10 w-2/12 text-sm text-left border border-slate-700 row-id"><?=$key?></td>
                                    
                                        <td class="h-10 w-2/12 text-sm text-left border border-slate-700"><input class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-left" 
                                            type="text" id="YYMM<?=$key?>" name="YYMM[]" value="<?=isset($value['YYMM']) ? date('m/Y', strtotime(strtr($value['YYMM'], '/', '-'))): '' ?>"></td>

                                        <td class="h-10 w-2/12 text-sm text-right border border-slate-700"><input class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-right"
                                            type="text" id="D_VALUE<?=$key?>" name="D_VALUE[]" value="<?=isset($value['D_VALUE']) ? $value['D_VALUE']: '' ?>" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>

                                        <td class="h-10 w-2/12 text-sm text-center border border-slate-700">
                                            <input type="hidden" id="DEPARFLGH<?=$key?>" name="DEPARFLG[]" value="F" <?php if($value['DEPARFLG'] == 'T') { ?> disabled <?php } ?> />
                                            <input type="checkbox" id="DEPARFLG<?=$key?>" name="DEPARFLG[]" value="T" onchange="chked(<?=$key?>);" <?=$value['DEPARFLG'] == 'T' ? 'checked' :''?>/>
                                        </td>

                                        <td class="h-10 w-4/12 text-sm text-left border border-slate-700"></td>

                                        <td class="hidden"><input type="hidden" id="ROWNO<?=$key?>" name="ROWNO[]" value="<?=$key;?>"></td>
                                    </tr><?php 
                                }
                                for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                                    <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">    
                                        <td class="h-10 w-2/12 border border-slate-700"></td>
                                        <td class="h-10 w-2/12 border border-slate-700"></td>
                                        <td class="h-10 w-2/12 border border-slate-700"></td>
                                        <td class="h-10 w-2/12 border border-slate-700"></td>
                                        <td class="h-10 w-4/12 border border-slate-700"></td>
                                    </tr><?php 
                                }
                            } else {                            
                                for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                    <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                                        <td class="h-10 w-2/12 border border-slate-700"></td>
                                        <td class="h-10 w-2/12 border border-slate-700"></td>
                                        <td class="h-10 w-2/12 border border-slate-700"></td>
                                        <td class="h-10 w-2/12 border border-slate-700"></td>
                                        <td class="h-10 w-4/12 border border-slate-700"></td>
                                    </tr><?php
                                }
                            } ?>
                            </tbody>
                        </table>
                        <div class="flex p-2">
                            <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                        </div>
                    </div>
                </div>
                <div class="flex-col w-6/12">
                    <div class="flex mb-2">   
                        <input type="hidden" id="DOCALH" name="DOCAL" value="F"/>
                        <input type="checkbox" id="DOCAL" name="DOCAL" value="T" onchange="docal();" <?php echo (isset($data['DOCAL']) && $data['DOCAL'] == 'T') ? 'checked' : '' ?>/>
                        <label class="text-color block text-sm pt-1 w-3/12 text-center"><?=checklang('DOCALCULATE')?></label>
                        <label class="invisible text-color block text-sm w-6/12 pr-2 pt-1"></label>
                        <button type="button" id="CALCULATE" name="CALCULATE" class="justify-end btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                            ><?=checklang('CALCULATE')?></button>
                    </div>
                    <div class="flex mb-2">   
                        <!-- picture -->
                        <input type="hidden" name="PATHFILE" id="PATHFILE" value="<?=$path_file?>">
                        <?php if(isset($data['PICTURECD'])) { ?>
                            <iframe id="ITEMIMGLOCVIEW" name="ITEMIMGLOCVIEW" src="<?=$_SESSION['APPURL']?>/img/csv-file.png" style="padding-left: 8%;"></iframe>
                        <?php } else { ?>
                            <iframe id="ITEMIMGLOCVIEW" name="ITEMIMGLOCVIEW" src="" style="padding-left: 8%;"></iframe><?php } ?>
                    </div>
                    <div class="flex mb-2"> 
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-10/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            name="PICTURECD" id="PICTURECD" value="<?=isset($data['PICTURECD']) ? $data['PICTURECD']: ''; ?>"/>
                        <input class="hidden" type="file" name="SELECTFILE" id="SELECTFILE" accept=".csv" onchange="disp_photo();"/>
                        <button type="button"class="justify-end btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        onclick="document.getElementById('SELECTFILE').click()" />...</button>
                    </div>
                </div>
            </div>
            
            <!-- commit -->
            <div class="flex mb-2">   
                <div class="flex w-6/12 px-1">
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                </div>
                <div class="flex w-6/12 px-1 justify-end">
                    <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>
                    <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=checklang('END'); ?></button>
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
        unRequired(); selectRow(); 
        document.getElementById('CALCULATE').disabled = true;
        let docal = '<?php echo (!empty($data['DOCAL']) ? $data['DOCAL']: 'null'); ?>';
        if(docal == 'T') {
            document.getElementById('CALCULATE').disabled = false;  
        }
    });

    function unRequired() {
        let assetcd = document.getElementById("ASSETCD");
        if(assetcd.value != '') {
            assetcd.classList.remove('req');
        } else {
            assetcd.classList.add('req');
        }
    }

    function chked(index) {
        if (document.getElementById("DEPARFLG" + index + "").checked) {
            document.getElementById("DEPARFLGH" + index + "").disabled = true;
        } else {
            document.getElementById("DEPARFLGH" + index + "").disabled = false;
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
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }

    function HandlePopupResultIndex(code, result, index) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/850/ACCASSETMASTER/index.php?'+code+'=' + result + '&index=' + index;
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/850/ACCASSETMASTER/index.php?'+code+'=' + result;
    }
</script>
</html>
