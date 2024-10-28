<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$_SESSION['APPNAME']; ?></title>
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
            <form class="w-full" method="POST" action="" id="shipmentEntry" name="shipmentEntry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary>                
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('VOUCHER_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="SHIPTRANORDERNO" id="SHIPTRANORDERNO" value="<?=isset($data['SHIPTRANORDERNO']) ? $data['SHIPTRANORDERNO']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSHIPTRAN">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 text-center req"
                                                id="SHIPTRANORDERLN" name="SHIPTRANORDERLN" value="<?=isset($data['SHIPTRANORDERLN']) ? $data['SHIPTRANORDERLN']: ''; ?>" onchange="unRequired();" required/>
                                        <div class="w-4/12"></div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="w-6/12"></label>
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SHIP_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="SHIPTRANDT" name="SHIPTRANDT" value="<?=!empty($data['SHIPTRANDT']) ? date('Y-m-d', strtotime($data['SHIPTRANDT'])) : date('Y-m-d'); ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALES_ORDER_NO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="SALELNNO" id="SALELNNO" value="<?=isset($data['SALELNNO']) ? $data['SALELNNO']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                id="SALELN" name="SALELN" value="<?=isset($data['SALELN']) ? $data['SALELN']: ''; ?>" readonly/>
                                        <div class="w-4/12"></div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERCD" id="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-[14px] text-gray-700 border-gray-300 read"
                                                name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                        <input type="text" class="hidden" id="CUSTOMERSALERULEFLG" name="CUSTOMERSALERULEFLG" value="<?=isset($data['CUSTOMERSALERULEFLG']) ? $data['CUSTOMERSALERULEFLG']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ITEM')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ITEMSPEC" name="ITEMSPEC" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ITEMDRAWNO" name="ITEMDRAWNO" readonly/>
                                        <input type="hidden" name="SALES_INSPE_TIME" value="F"/>
                                        <input class="hidden" type="checkbox" id="SALES_INSPE_TIME" name="SALES_INSPE_TIME" value="T" <?php echo (isset($data['SALES_INSPE_TIME']) && $data['SALES_INSPE_TIME'] == 'T') ? 'checked': '';?>/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('UNIT_PRICE')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 text-right read"
                                                    name="SALELNUNITPRC" id="SALELNUNITPRC" value="<?=!empty($data['SALELNUNITPRC']) ? number_format($data['SALELNUNITPRC'], 2): ''; ?>"
                                                    onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                            <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-10 rounded-e-xl border read">
                                                <?=isset($data['CMCURDISP']) ? $data['CMCURDISP']: ''; ?>
                                            </label>
                                            <input type="hidden" id="CMCURDISP" name="CMCURDISP" value="<?=isset($data['CMCURDISP']) ? $data['CMCURDISP']: ''; ?>"/>
                                        </div>
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('AMOUNT')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 text-right read"
                                                    name="SALELNAMT" id="SALELNAMT" value="<?=!empty($data['SALELNAMT']) ? number_format($data['SALELNAMT'], 2): ''; ?>"
                                                    onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                            <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-10 rounded-e-xl border read">
                                                <?=isset($data['CMCURDISP']) ? $data['CMCURDISP']: ''; ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ORDER_QTY_PRO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-3 text-[14px] text-gray-700 border-gray-300 text-right read"
                                            id="SALELNQTY" name="SALELNQTY" value="<?=!empty($data['SALELNQTY']) ? number_format($data['SALELNQTY'], 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-2 h-7 w-2/12 text-left rounded-xl border-gray-300 read"
                                            id="ITEMUNITTYP" name="ITEMUNITTYP">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('BACKLOG')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 mr-1 py-2 px-3 text-[14px] text-gray-700 border-gray-300 text-right read"
                                            id="BACKLOG" name="BACKLOG" value="<?=!empty($data['BACKLOG']) ? number_format($data['BACKLOG'], 2): ''; ?>" readonly/>
                                        <select class="text-control text-[12px] shadow-md border px-2 h-7 w-2/12 text-left rounded-xl border-gray-300 read">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 text-right read"
                                                    name="SALELNEXUNITPRC" id="SALELNEXUNITPRC" value="<?=!empty($data['SALELNEXUNITPRC']) ? number_format($data['SALELNEXUNITPRC'], 2): ''; ?>"
                                                    onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                            <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-10 rounded-e-xl border read">
                                                <?=isset($data['CMCURDISP']) ? $data['CMCURDISP']: ''; ?>
                                            </label>
                                            <input type="hidden" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=isset($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>"/>
                                        </div>
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center"></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 text-right read"
                                                    name="SALELNEXAMT" id="SALELNEXAMT" value="<?=!empty($data['SALELNEXAMT']) ? number_format($data['SALELNEXAMT'], 2): ''; ?>"
                                                    onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                            <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-10 rounded-e-xl border read">
                                                <?=isset($data['CMCURDISP']) ? $data['CMCURDISP']: ''; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('TAX_AMOUNT')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 text-right read"
                                                    name="SALELNTAXAMT" id="SALELNTAXAMT" value="<?=!empty($data['SALELNTAXAMT']) ? number_format($data['SALELNTAXAMT'], 2): ''; ?>"
                                                    onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                            <label class="absolute text-sm top-0 end-0 h-7 py-1 px-2 w-10 rounded-e-xl border read">
                                                <?=isset($data['CMCURDISP']) ? $data['CMCURDISP']: ''; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <hr class="divide-y divide-dotted my-2 mx-2">

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary>   
                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ORDER_QTY_PRO')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-2 mr-1 text-[14px] text-gray-700 border-gray-300 text-right req"
                                                id="SHIPTRANSHIPQTY" name="SHIPTRANSHIPQTY" value="<?=!empty($data['SHIPTRANSHIPQTY']) ? number_format($data['SHIPTRANSHIPQTY'], 2): ''; ?>"
                                                onchange="this.value = number2digit(this.value); unRequired();" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" required/>
                                        <select class="text-control text-[12px] shadow-md border px-2 h-7 w-2/12 text-left rounded-xl border-gray-300 read">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" id="OLD_QTY" name="OLD_QTY" value="<?=isset($data['OLD_QTY']) ? $data['OLD_QTY']: ''; ?>"/>
                                        <input type="hidden" id="CURRENCY" name="CURRENCY" value="<?=isset($data['CURRENCY']) ? $data['CURRENCY']: ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('STATUS');?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-2/12 mr-1 text-left rounded-xl border-gray-300 req"
                                            id="SHIPTRANSTATUS" name="SHIPTRANSTATUS" onchange="unRequired();" required>
                                            <option value=""></option>
                                            <?php foreach ($STATUS_SALES as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['SHIPTRANSTATUS']) && $data['SHIPTRANSTATUS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>              
                                    </div>
                                    <div class="flex w-3/12 px-2"></div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-2/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="STAFFCD" id="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-3/12 px-2"></div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('SOURCE_STORAGE');?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-2/12 mr-1 text-left rounded-xl border-gray-300 req"
                                                id="LOCTYP" name="LOCTYP" onchange="unRequired();" required>
                                                <option value=""></option>
                                                <?php foreach ($STORAGETYPE as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['LOCTYP']) && $data['LOCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                        </select>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="LOCCD" name="LOCCD" value="<?=isset($data['LOCCD']) ? $data['LOCCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHLOC">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="LOCNAME" name="LOCNAME" value="<?=isset($data['LOCNAME']) ? $data['LOCNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-3/12 px-2"></div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('REMARK');?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-10/12 py-2 px-3 text-gray-700 border-gray-300"
                                             name="SHIPTRANREM" id="SHIPTRANREM" value="<?=isset($data['SHIPTRANREM']) ? $data['SHIPTRANREM']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-3/12 px-2"></div>
                                </div>

                                <div class="flex p-2">
                                    <div class="flex w-12/12">
                                        <label class="text-color text-sm text-green-500 hidden" id="MSG"><?=$MSG['ERROREXITSDATA'];?></label>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-8/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="UPDATE" name="UPDATE"><?=checklang('UPDATE'); ?></button>
                        <button type="button" class="hidden btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="DELETE" name="DELETE"><?=checklang('DELETE'); ?></button>
                    </div>
                    <div class="flex w-4/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
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
</body>
<script src="./js/script.js" ></script>
<script type="text/javascript">   
    $(document).ready(function() {
        unRequired();
        let SYSVIS_MSG = '<?php echo !empty($data['SYSVIS_MSG']) ? $data['SYSVIS_MSG']: 'F'; ?>';
        let SYSEN_UPDATE = '<?php echo !empty($data['SYSEN_UPDATE']) ? $data['SYSEN_UPDATE']: 'F'; ?>';
        let SYSVIS_UPDATE = '<?php echo !empty($data['SYSPVL']) ? $data['SYSPVL']['SYSVIS_UPDATE']: 'F'; ?>';
        // let SYSEN_DELETE = '<?php echo !empty($data['SYSEN_DELETE']) ? $data['SYSEN_DELETE']: 'F'; ?>';
        // let SYSVIS_DELETE = '<?php echo !empty($data['SYSPVL']) ? $data['SYSPVL']['SYSVIS_DELETE']: 'F'; ?>';
        document.getElementById('MSG').classList[SYSVIS_MSG !== 'F' ? 'remove' : 'add']('hidden');
        document.getElementById('UPDATE').classList[SYSEN_UPDATE !== 'F' ? 'remove' : 'add']('disabled');
        document.getElementById('UPDATE').classList[SYSVIS_UPDATE !== 'F' ? 'remove' : 'add']('hidden');
        // document.getElementById('DELETE').classList[SYSEN_DELETE !== 'F' ? 'remove' : 'add']('disabled');
        // document.getElementById('DELETE').classList[SYSVIS_DELETE !== 'F' ? 'remove' : 'add']('hidden');
    });
   
    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getSearch(code, result);
    }

    function HandlePopupLocResult(result, type) {
        return getLoc(result, type);    
    }

    function HandleResultLN(SHIPTRANORDERNO, SHIPTRANORDERLN) {
        return getShipTran(SHIPTRANORDERNO, SHIPTRANORDERLN);
    }
</script>
</html>