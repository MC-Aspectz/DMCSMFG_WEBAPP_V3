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
            <form class="w-full" method="POST" id="issueSaleInvoiceByShip" name="issueSaleInvoiceByShip" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('selectshipping'); ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-5/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="CUSTOMERCD" name="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCUSTOMER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-[12px] shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="CUSTOMERNAME" name="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-7/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('SHIP_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="SHIPDATE1" name="SHIPDATE1" value="<?=!empty($data['SHIPDATE1']) ? date('Y-m-d', strtotime($data['SHIPDATE1'])) : ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center">→</label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="SHIPDATE2" name="SHIPDATE2" value="<?=!empty($data['SHIPDATE2']) ? date('Y-m-d', strtotime($data['SHIPDATE2'])) : ''; ?>"/>
                                        <div class="flex w-3/12 justify-end">
                                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center" id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table Shipping -->
                                <div class="overflow-scroll px-2 block h-[186px] max-h-[186px]">
                                    <table id="tableShip" class="ship_table w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                                        <thead class="sticky top-0 bg-gray-50">
                                            <tr class="border border-gray-600">
                                                <th class="px-3 text-center border border-slate-700">
                                                 <!--    <input type="hidden" name="CHKALL" value="F"/>
                                                    <input class="chkbox" type="checkbox" id="CHKALL" name="CHKALL" value="T" onclick="checkedAll(1);"/> -->
                                                </th>
                                                <th class="px-3 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SHIPPINGNO')?></span>
                                                </th>
                                                <th class="px-3 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SHIPPINGLN')?></span>
                                                </th>
                                                <th class="px-3 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SHIP_DATE')?></span>
                                                </th>
                                                <th class="px-3 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                                </th>
                                                <th class="px-6 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                                </th>
                                                <th class="px-6 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                                </th>
                                                <th class="px-3 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALEORDERNO')?></span>
                                                </th>
                                                <th class="px-3 text-center border border-slate-700">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALEORDERLINE')?></span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody id="dvwshipdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                                        if(!empty($data['ITEMSHIP']) && is_array($data['ITEMSHIP'])) { $minrowA = count($data['ITEMSHIP']);
                                            foreach($data['ITEMSHIP'] as $key => $value) { ?>
                                                <tr class="divide-y divide-gray-200" id="rowShipId<?=$key?>">
                                                    <td class="hidden row-shipid"><?=$key?></td>
                                                    <td class="h-6 w-16 text-sm text-center">
                                                        <input type="hidden" id="CHKH<?=$key?>" name="CHK[]" value="F" <?=isset($value['CHK']) && $value['CHK'] == 'T' ? 'disabled' : '' ?>/>
                                                        <input class="chkbox" type="checkbox" id="CHK<?=$key?>" name="CHK[]" value="T" 
                                                                onchange="chked(<?=$key?>);" <?=isset($value['CHK']) && $value['CHK'] == 'T' ? 'checked' : '' ?>/>
                                                    </td>
                                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANORDERNO']) ? $value['SHIPTRANORDERNO']: '' ?></td>
                                                    <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap"><?=isset($value['SHIPTRANORDERLN']) ? $value['SHIPTRANORDERLN']: '' ?></td>
                                                    <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap"><?=isset($value['SHIPTRANDT']) ? $value['SHIPTRANDT']: '' ?></td>
                                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANIMCD']) ? $value['SHIPTRANIMCD']: '' ?></td>
                                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANIMNAME']) ? $value['SHIPTRANIMNAME']: '' ?></td>
                                                    <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['SHIPTRANSHIPQTY']) ? $value['SHIPTRANSHIPQTY']: '' ?></td>
                                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANSALENO']) ? $value['SHIPTRANSALENO']: '' ?></td>
                                                    <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SHIPTRANSALELN']) ? $value['SHIPTRANSALELN']: '' ?></td>

                                                <input type="hidden" id="SHIPTRANORDERNO<?=$key?>" name="SHIPTRANORDERNO[]" value="<?=isset($value['SHIPTRANORDERNO']) ? $value['SHIPTRANORDERNO']: '' ?>"/>
                                                <input type="hidden" id="SHIPTRANORDERLN<?=$key?>" name="SHIPTRANORDERLN[]" value="<?=isset($value['SHIPTRANORDERLN']) ? $value['SHIPTRANORDERLN']: '' ?>"/>
                                                <input type="hidden" id="SHIPTRANDT<?=$key?>" name="SHIPTRANDT[]" value="<?=isset($value['SHIPTRANDT']) ? $value['SHIPTRANDT']: '' ?>"/>
                                                <input type="hidden" id="SHIPTRANIMCD<?=$key?>" name="SHIPTRANIMCD[]" value="<?=isset($value['SHIPTRANIMCD']) ? $value['SHIPTRANIMCD']: '' ?>"/>
                                                <input type="hidden" id="SHIPTRANIMNAME<?=$key?>" name="SHIPTRANIMNAME[]" value="<?=isset($value['SHIPTRANIMNAME']) ? $value['SHIPTRANIMNAME']: '' ?>"/>
                                                <input type="hidden" id="SHIPTRANSHIPQTY<?=$key?>" name="SHIPTRANSHIPQTY[]" value="<?=isset($value['SHIPTRANSHIPQTY']) ? $value['SHIPTRANSHIPQTY']: '' ?>"/>
                                                <input type="hidden" id="SHIPTRANSALENO<?=$key?>" name="SHIPTRANSALENO[]" value="<?=isset($value['SHIPTRANSALENO']) ? $value['SHIPTRANSALENO']: '' ?>"/>
                                                <input type="hidden" id="SHIPTRANSALELN<?=$key?>" name="SHIPTRANSALELN[]" value="<?=isset($value['SHIPTRANSALELN']) ? $value['SHIPTRANSALELN']: '' ?>"/>
                                                </tr><?php
                                            }
                                        }
                                        for ($i = $minrowA+1; $i <= $maxrowA; $i++) { ?>
                                            <tr class="divide-y divide-gray-200" id="rowShipId<?=$i?>">
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

                                        <tfoot class="sticky bottom-0 pointer-events-none">
                                            <tr>
                                            <td class="text-color h-6 text-[12px]" colspan="10"><?=str_repeat('&ensp;', 1).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="rowshipcount" ><?=$minrowA; ?></span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="flex">
                                    <div class="flex w-6/12 px-2">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center me-2 mb-2"
                                                id="MAKEINVITEMS" name="MAKEINVITEMS"><?=checklang('MAKEINVITEMS'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center me-2 mb-2"
                                                id="EDITSHIP" name="EDITSHIP"><?=checklang('EDITSHIP'); ?></button>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end"></div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 flex">
                                    <button type="button" class="mx-1">
                                        <svg class="fill-current opacity-75 w-6 h-6 -mr-1" viewBox="0 0 256 512">
                                            <path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"></path>
                                        </svg>
                                    </button> 
                                    <label class="flex w-3/12 text-lg font-semibold pointer-events-none"><?=lang('invoicesalevoucher'); ?></label>
                                    <div class="flex w-3/12 ml-2" id="SYSVIS_CANCELSALETRANNO">
                                        <label class="text-color block text-sm w-5/12 pt-1 pointer-events-none"><?=checklang('CANCEL_INVOICE_NO')?></label>
                                        <input type="text" class="text-control text-[14px] shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="CANCELSALETRANNO" name="CANCELSALETRANNO" value="<?=isset($data['CANCELSALETRANNO']) ? $data['CANCELSALETRANNO']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 pointer-events-none"></div>
                                </summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVOICE_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="SALETRANNO" name="SALETRANNO" value="<?=isset($data['SALETRANNO']) ? $data['SALETRANNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHSALETRAN_ACC">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                        type="date" id="SALETRANSALEDT" name="SALETRANSALEDT" value="<?=!empty($data['SALETRANSALEDT']) ? date('Y-m-d', strtotime($data['SALETRANSALEDT'])) : date('Y-m-d'); ?>" readonly/>
                                        <input type="hidden" id="SALEORDERNO" name="SALEORDERNO" value="<?=isset($data['SALEORDERNO']) ? $data['SALEORDERNO']: ''; ?>"/>
                                        <input type="hidden" id="SALELNDUEDT" name="SALELNDUEDT" value="<?=isset($data['SALELNDUEDT']) ? $data['SALELNDUEDT']: ''; ?>"/>
                                        <input type="hidden" id="SVNO" name="SVNO" value="<?=isset($data['SVNO']) ? $data['SVNO']: ''; ?>"/>
                                        <input type="hidden" id="REPLACEMODE" name="REPLACEMODE" value="<?=!empty($data['REPLACEMODE']) ? $data['REPLACEMODE']: '0'; ?>"/>                          
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                    id="CUSTOMERCD_S" name="CUSTOMERCD_S" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none read"
                                                id="SEARCHCUSTOMER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="CUSTOMERNAME_S" name="CUSTOMERNAME_S" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVDATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="SALETRANINSPDT" name="SALETRANINSPDT" value="<?=!empty($data['SALETRANINSPDT']) ? date('Y-m-d', strtotime($data['SALETRANINSPDT'])) : date('Y-m-d'); ?>"/>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('CREDITTERM')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center req"
                                                id="SALETERM" name="SALETERM" onchange="unRequired();" oninput="this.value = stringReplacez(this.value);"
                                                value="<?=isset($data['SALETERM']) ? $data['SALETERM'] : '0'; ?>" required/>
                                        <label class="text-color block text-sm w-1/12 pl-2 pt-1 text-center"><?=checklang('DAYS')?></label>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="CUSTADDR1" name="CUSTADDR1" value="<?=isset($data['CUSTADDR1']) ? $data['CUSTADDR1']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="DIVISIONCD" name="DIVISIONCD" value="<?=!empty($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHDIVISION">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="DIVISIONNAME" name="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="CUSTADDR2" name="CUSTADDR2" value="<?=isset($data['CUSTADDR2']) ? $data['CUSTADDR2']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    id="STAFFCD" name="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TEL')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="ESTCUSTEL" name="ESTCUSTEL" oninput="this.value = stringReplacez(this.value);"
                                                value="<?=isset($data['ESTCUSTEL']) ? $data['ESTCUSTEL']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 text-center"><?=checklang('FAX')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ESTCUSFAX" name="ESTCUSFAX" oninput="this.value = stringReplacez(this.value);"
                                                value="<?=isset($data['ESTCUSFAX']) ? $data['ESTCUSFAX']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="CUSCURCD" name="CUSCURCD" value="<?=isset($data['CUSCURCD']) ? $data['CUSCURCD']: ''; ?>" 
                                                    <?php if(isset($data['SALETRANNO'])) { ?> style="background-color: whitesmoke; pointer-events: none;" readonly <?php } ?>/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                <?php if(isset($data['SALETRANNO'])) { ?> id="xxx" <?php } else { ?> id="SEARCHCURRENCY" <?php } ?>/>
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="flex w-5/12">
                                            <select id="BRANCHKBN" name="BRANCHKBN" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300 read" readonly>
                                                <option value=""></option>
                                                <?php foreach ($BRANCH_KBN as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['BRANCHKBN']) && $data['BRANCHKBN'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                    id="TAXID" name="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ATTENTION')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="ESTCUSSTAFF" name="ESTCUSSTAFF" value="<?=isset($data['ESTCUSSTAFF']) ? $data['ESTCUSSTAFF']: ''; ?>"/>
                                    </div>
                                </div>


                                <div class="flex mb-2">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REFERENCE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="SALECUSMEMO" name="SALECUSMEMO" value="<?=isset($data['SALECUSMEMO']) ? $data['SALECUSMEMO']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DESCRIPTION')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="DESCRIPTION" name="DESCRIPTION" value="<?=isset($data['DESCRIPTION']) ? $data['DESCRIPTION']: ''; ?>"/>
                                    </div>
                                </div>             

                                <div id="table-area" class="overflow-scroll block h-[200px]"> 
                                    <div class="table">
                                        <table id="table" class="sale_table w-full border-collapse border border-slate-500">
                                            <thead class="sticky top-0 bg-gray-50">
                                                <tr class="border border-gray-600">
                                                    <th class="px-6 w-8 text-center border border-slate-700">
                                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                                    </th>
                                                    <th class="px-12 text-center border border-slate-700">
                                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CODE')?></span>
                                                    </th>
                                                    <th class="px-28 text-center border border-slate-700">
                                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                                                    </th>
                                                    <th class="px-3 text-center border border-slate-700">
                                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                                    </th>
                                                    <th class="px-6 text-center border border-slate-700">
                                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UOM')?></span>
                                                    </th>
                                                    <th class="px-3 text-center border border-slate-700">
                                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT_PRICE')?></span>
                                                    </th>
                                                    <th class="px-3 text-center border border-slate-700">
                                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DISCOUNT')?></span>
                                                    </th>
                                                    <th class="px-6 text-center border border-slate-700">
                                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AMOUNT')?></span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="dvwdetail" class="divide-y divide-gray-200">
                                                 <?php if(isset($data['ITEM'])) { $minrow = count($data['ITEM']);
                                                    foreach ($data['ITEM'] as $key => $value) { ?>
                                                        <tr id="rowId<?=$key?>">
                                                            <td class="row-id text-center max-w-4 text-sm border border-slate-700" id="ROWNO<?=$key?>" name="ROWNO[]"><?=$key?></td>
                                                            <td class="text-sm border border-slate-700">
                                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                                        id="ITEMCD<?=$key?>" name="ITEMCD[]" value="<?=isset($value['ITEMCD']) ? $value['ITEMCD']: '';?>">
                                                            </td>
                                                            <td class="text-sm border border-slate-700">
                                                                <input class="text-control text-[px12] shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 item-read"
                                                                        id="ITEMNAME<?=$key?>" name="ITEMNAME[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: ''; ?>"/>
                                                            </td>
                                                            <td class="text-sm border border-slate-700">
                                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                                        id="SALEQTY<?=$key?>" name="SALEQTY[]" value="<?=!empty($value['SALEQTY']) ? number_format(str_replace(',', '', $value['SALEQTY']), 2): '0.00' ?>"/>
                                                            </td>
                                                            <td class="text-sm border border-slate-700">
                                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read" 
                                                                        id="ITEMUNITTYP<?=$key?>" name="ITEMUNITTYP[]" value="<?=isset($value['ITEMUNITTYP']) ? $value['ITEMUNITTYP']: '' ?>" readonly/>
                                                            </td>
                                                            <td class="text-sm border border-slate-700">
                                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right item-read" 
                                                                        id="SALEUNITPRC<?=$key?>" name="SALEUNITPRC[]" onchange="calculateamt(<?=$key?>); this.value = num2digit(this.value);" 
                                                                        value="<?=!empty($value['SALEUNITPRC']) ? number_format(str_replace(',', '', $value['SALEUNITPRC']), 2): '0.00' ?>"
                                                                        oninput="this.value = stringReplacez(this.value);"/>
                                                            </td>
                                                            <td class="text-sm border border-slate-700">
                                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right item-read" 
                                                                        id="SALEDISCOUNT<?=$key?>" name="SALEDISCOUNT[]" onchange="calculateamt(<?=$key?>); this.value = num2digit(this.value);" 
                                                                        value="<?=!empty($value['SALEDISCOUNT']) ? number_format(str_replace(',', '', $value['SALEDISCOUNT']), 2): '0.00' ?>"
                                                                        oninput="this.value = stringReplacez(this.value);"/>
                                                            </td>
                                                            <td class="text-sm border border-slate-700">
                                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                                        id="SALEAMT<?=$key?>" name="SALEAMT[]" value="<?=isset($value['SALEAMT']) ? $value['SALEAMT'] : '' ?>" readonly/>
                                                            </td>
                                                            <td class="hidden"><input class="w-16 read" id="ITEMSPEC<?=$key?>" name="ITEMSPEC[]"
                                                                value="<?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC'] : '' ?>" readonly/></td>
                                                            <td class="hidden"><input class="w-16 read" id="SALEDISCOUNT2<?=$key?>" name="SALEDISCOUNT2[]"
                                                                value="<?=isset($value['SALEDISCOUNT2']) ? $value['SALEDISCOUNT2'] : '' ?>" readonly/></td>
                                                            <td class="hidden"><input class="w-16 read" id="SALETAXAMT<?=$key?>" name="SALETAXAMT[]"
                                                                value="<?=isset($value['SALETAXAMT']) ? $value['SALETAXAMT'] : '' ?>" readonly/></td>
                                                        </tr><?php
                                                    }
                                                } 
                                                for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                                    <tr class="row-empty" id="rowId<?=$i?>">
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
                                            <tfoot class="sticky bottom-0">
                                                <tr class="pointer-events-none">
                                                    <td class="text-color h-6 text-[12px]" colspan="8"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="rowcount" ><?=$minrow; ?></span></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-8/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="SALEDIVCON1" name="SALEDIVCON1" value="<?=!empty($data['SALEDIVCON1']) ? $data['SALEDIVCON1']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('SUBTOTAL')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="S_TTL" name="S_TTL" value="<?=!empty($data['S_TTL']) ? number_format(str_replace(',', '', $data['S_TTL']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                id="CUSCURDISP" name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                     <div class="flex w-8/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300 SALEDIVCON2"
                                                id="SALEDIVCON2" name="SALEDIVCON2" value="<?=!empty($data['SALEDIVCON2']) ? $data['SALEDIVCON2']: ''; ?>"/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-8/12 text-left rounded-xl border-gray-300 SALEDIVCON2"
                                                id="SALEDIVCON2CBO" name="SALEDIVCON2CBO" onchange="setSaleDivCon2();">
                                            <option value=""></option>
                                            <?php foreach ($CANCELREASON as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['SALEDIVCON2CBO']) && $data['SALEDIVCON2CBO'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?><h5 class="w-4/12 pl-6 pt-1 text-red-500 font-semibold"><?=checklang('CANCELMSG')?></h5><?php } ?>
                                    </div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DISCOUNT')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                id="DISCRATE" name="DISCRATE" value="<?=!empty($data['DISCRATE']) ? $data['DISCRATE']: '0'; ?>"
                                               onchange="discount();" oninput="this.value = stringReplacez(this.value);"/>&nbsp;
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="DISCOUNTAMOUNT" name="DISCOUNTAMOUNT" value="<?=!empty($data['DISCOUNTAMOUNT']) ? number_format(str_replace(',', '', $data['DISCOUNTAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" <?php if(!empty($data['CUSCURDISP'])){ ?> value="<?=$data['CUSCURDISP']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-8/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="SALEDIVCON3" name="SALEDIVCON3" value="<?=!empty($data['SALEDIVCON3']) ? $data['SALEDIVCON3']: ''; ?>"/>
                                        <input type="hidden" name="SALEDIVCON4" id="SALEDIVCON4" value="<?=isset($data['SALEDIVCON4']) ? $data['SALEDIVCON4']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('AFTERDISCOUNT')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="QUOTEAMOUNT" name="QUOTEAMOUNT" value="<?=!empty($data['QUOTEAMOUNT']) ? number_format(str_replace(',', '', $data['QUOTEAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-8/12">
                                        <label class="text-color text-sm w-full pr-2 pt-1 hidden" id="DMCSREM4"><?=checklang('DMCSREM4')?></label>
                                    </div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('VAT')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border text-sm rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                id="VATRATE" name="VATRATE" value="<?=!empty($data['VATRATE']) ? number_format(str_replace(',', '', $data['VATRATE']), 2): ''; ?>"
                                                onchange="vat(); this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>&nbsp;
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                id="VATAMOUNT1" name="VATAMOUNT1" value="<?=!empty($data['VATAMOUNT1']) ? number_format(str_replace(',', '', $data['VATAMOUNT1']), 2): '0.00'; ?>" readonly/>
                                        <input class="hidden" id="VATAMOUNT" name="VATAMOUNT" value="<?=!empty($data['VATAMOUNT']) ? number_format(str_replace(',', '', $data['VATAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                                    </div>
                                </div>


                                <div class="flex mb-1 px-2">
                                    <div class="flex w-8/12">
                                        <div class="flex w-full" id="reprints">
                                            <label class="text-color text-sm w-3/12 pr-2 pt-1"><?=checklang('REPRINT_CANCEL_REASON')?></label>
                                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300"
                                                id="REPRINTREASON" name="REPRINTREASON" value="<?=isset($data['REPRINTREASON'])? $data['REPRINTREASON']: ''; ?>"/>
                                        </div>
                                    </div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('TOTALAMOUNT')?></label>
                                        <input type="hidden" class="hidden" name="T_AMOUNT1" id="T_AMOUNT1"  value="<?=!empty($data['T_AMOUNT']) ? number_format(str_replace(',', '', $data['T_AMOUNT']) + str_replace(',', '', $data['VATAMOUNT']) + str_replace(',', '', $data['VATAMOUNT1']), 2): '0.00'; ?>"/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="T_AMOUNT" id="T_AMOUNT" value="<?=!empty($data['T_AMOUNT']) ? number_format(str_replace(',', '', $data['T_AMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                                        <input type="hidden" class="hidden" name="GROUPRT" type="text" value="<?=!empty($data['GROUPRT']) ? $data['GROUPRT']: ''; ?>"/>
                                    </div>
                                </div>
                           </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-2">
                    <div class="flex w-8/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2" id="COMMIT" name="COMMIT"
                        <?php if(isset($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                        <?php if(isset($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?> disabled <?php } ?>><?=checklang('COMMIT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2" 
                         id="REPLACEZ" name="REPLACEZ" <?php if(empty($data['SALETRANNO'])){ ?> disabled <?php } ?>><?=checklang('REPLACE'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2" id="INV" name="INV"
                        <?php if(empty($data['SALETRANNO'])){ ?> disabled <?php } ?>><?=checklang('INV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2" id="TAXINV" name="TAXINV"
                        <?php if(empty($data['SALETRANNO'])){ ?> disabled <?php } ?>><?=checklang('TAXINV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2" id="SALEV" name="SALEV"
                        <?php if(empty($data['SALETRANNO'])){ ?> disabled <?php } ?>><?=checklang('SALEV'); ?></button>
                    </div>
                    <div class="flex w-4/12 px-1 justify-end">
                        <button type="reset" id="CLEAR" onclick="return unsetSession(this.form);" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"><?=checklang('CLEAR'); ?></button>
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        onclick="return questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
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
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">  
    $(document).ready(function() {
        unRequired(); subtotal(); calculateDVW();
        document.getElementById('reprints').style.display = 'none';
        // VIS EN FILL
        let cancelled = '<?php echo (isset($data['SYSVIS_CANCELLBL']) ? $data['SYSVIS_CANCELLBL']: 'null'); ?>';
        let taxinv = '<?php echo (isset($data['SYSVIS_PRINTTAXINV']) ? $data['SYSVIS_PRINTTAXINV']: 'null'); ?>';
        let taxinven = '<?php echo (isset($data['SYSEN_PRINTTAXINV']) ? $data['SYSEN_PRINTTAXINV']: 'null'); ?>';
        let salev = '<?php echo (isset($data['SYSVIS_PRINTVOU']) ? $data['SYSVIS_PRINTVOU']: 'null'); ?>';
        let saleven = '<?php echo (isset($data['SYSEN_PRINTVOU']) ? $data['SYSEN_PRINTVOU']: 'null'); ?>';
        let inv = '<?php echo (isset($data['SYSVIS_PRINTINV']) ? $data['SYSVIS_PRINTINV']: 'null'); ?>';
        let invven = '<?php echo (isset($data['SYSEN_PRINTINV']) ? $data['SYSEN_PRINTINV']: 'null'); ?>';
        let reprintbl = '<?php echo (isset($data['SYSVIS_REPRINTLBL']) ? $data['SYSVIS_REPRINTLBL']: 'null'); ?>';
        let reprint = '<?php echo (isset($data['SYSVIS_REPRINTREASON']) ? $data['SYSVIS_REPRINTREASON']: 'null'); ?>';
        let reprinten = '<?php echo (isset($data['SYSEN_REPRINTREASON']) ? $data['SYSEN_REPRINTREASON']: 'null'); ?>';
        let replace = '<?php echo (isset($data['SYSVIS_REPLACE']) ? $data['SYSVIS_REPLACE']: 'F'); ?>';
        let replaceen = '<?php echo (isset($data['SYSEN_REPLACE']) ? $data['SYSEN_REPLACE']: 'null'); ?>';
        let commits = '<?php echo (isset($data['SYSEN_COMMIT']) ? $data['SYSEN_COMMIT']: 'null'); ?>';
        let table = '<?php echo (isset($data['SYSEN_DVW']) ? $data['SYSEN_DVW']: 'null'); ?>';
        let saletraninsdt = '<?php echo (isset($data['SYSEN_SALETRANINSPDT']) ? $data['SYSEN_SALETRANINSPDT']: 'null'); ?>';
        let disrate = '<?php echo (isset($data['SYSEN_DISCRATE']) ? $data['SYSEN_DISCRATE']: 'null'); ?>';
        let vatrate = '<?php echo (isset($data['SYSEN_VATRATE']) ? $data['SYSEN_VATRATE']: 'null'); ?>';
        let customercd = '<?php echo (isset($data['SYSEN_CUSTOMERCD']) ? $data['SYSEN_CUSTOMERCD']: 'null'); ?>';
        let shipdate1 = '<?php echo (isset($data['SYSEN_SHIPDATE1']) ? $data['SYSEN_SHIPDATE1']: 'null'); ?>';
        let shipdate2 = '<?php echo (isset($data['SYSEN_SHIPDATE2']) ? $data['SYSEN_SHIPDATE2']: 'null'); ?>';
        let searchen = '<?php echo (isset($data['SYSEN_SEARCH']) ? $data['SYSEN_SEARCH']: 'null'); ?>';
        let tableship = '<?php echo (isset($data['SYSEN_DSSHIP']) ? $data['SYSEN_DSSHIP']: 'null'); ?>';
        let btnmakeinv = '<?php echo (isset($data['SYSEN_MAKEINVITEM']) ? $data['SYSEN_MAKEINVITEM']: 'null'); ?>';
        let btneditship = '<?php echo (isset($data['SYSEN_EDITSHIP']) ? $data['SYSEN_EDITSHIP']: 'null'); ?>';
        let saleterm = '<?php echo (isset($data['SYSEN_SALETERM']) ? $data['SYSEN_SALETERM']: 'null'); ?>';
        let divicd = '<?php echo (isset($data['SYSEN_DIVISIONCD']) ? $data['SYSEN_DIVISIONCD']: 'null'); ?>';
        let curcd = '<?php echo (isset($data['SYSEN_CUSCURCD']) ? $data['SYSEN_CUSCURCD']: 'null'); ?>';
        let stafcd = '<?php echo (isset($data['SYSEN_STAFFCD']) ? $data['SYSEN_STAFFCD']: 'null'); ?>';
        let estcusstaf = '<?php echo (isset($data['SYSEN_ESTCUSSTAFF']) ? $data['SYSEN_ESTCUSSTAFF']: 'null'); ?>';
        let saledivc1 = '<?php echo (isset($data['SYSEN_SALEDIVCON1']) ? $data['SYSEN_SALEDIVCON1']: 'null'); ?>';
        let saledivc2 = '<?php echo (isset($data['SYSEN_SALEDIVCON2']) ? $data['SYSEN_SALEDIVCON2']: 'null'); ?>';
        let saledivc3 = '<?php echo (isset($data['SYSEN_SALEDIVCON3']) ? $data['SYSEN_SALEDIVCON3']: 'null'); ?>';
        let saledivcon2 = '<?php echo (isset($data['SYSVIS_SALEDIVCON2']) ? $data['SYSVIS_SALEDIVCON2']: 'null'); ?>';
        let saledivcon2cbo = '<?php echo (isset($data['SYSVIS_SALEDIVCON2CBO']) ? $data['SYSVIS_SALEDIVCON2CBO']: 'F'); ?>';
        let cusmemo = '<?php echo (isset($data['SYSEN_SALECUSMEMO']) ? $data['SYSEN_SALECUSMEMO']: 'null'); ?>';
        let desc = '<?php echo (isset($data['SYSEN_DESCRIPTION']) ? $data['SYSEN_DESCRIPTION']: 'null'); ?>';
        let cancelsaletranno = '<?php echo (isset($data['SYSVIS_CANCELSALETRANNO']) ? $data['SYSVIS_CANCELSALETRANNO']: 'F'); ?>';

        if(cancelled != 'null' && cancelled == 'T') { 
            $('.search-tag').css('pointer-events', 'none');
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
            $('#SALETRANNO').removeAttr('disabled').css('background-color', 'white');
            $('#SEARCHSALETRAN_ACC').css('pointer-events', 'auto');
            document.getElementById('INV').classList.add('hidden');
            document.getElementById('TAXINV').classList.add('hidden');
        }
        if(inv == 'F') { document.getElementById('INV').classList.add('hidden'); }
        if(invven == 'F') { document.getElementById('INV').classList.add('read'); }
        if(taxinv == 'F') { document.getElementById('TAXINV').classList.add('hidden'); }
        if(taxinven == 'F') { document.getElementById('TAXINV').classList.add('read'); }
        if(salev == 'F') { document.getElementById('SALEV').classList.add('hidden'); }
        if(saleven == 'F') { document.getElementById('SALEV').classList.add('read'); }
        if(reprinten == 'F') { document.getElementById('REPRINTREASON').classList.add('read'); }  else { document.getElementById('REPRINTREASON').classList.remove('read'); }
        if(reprint == 'T') { document.getElementById('reprints').style.display = 'block'; } // document.getElementById('reprints').style.visibility = 'visible';
        if(reprintbl == 'F') { document.getElementById('reprints').classList.add('hidden'); } else { document.getElementById('reprints').classList.remove('hidden'); }
        if(replaceen == 'F') { document.getElementById('REPLACEZ').disabled = true; }
        if(replace == 'F') { document.getElementById('REPLACEZ').classList.add('hidden'); } else { document.getElementById('REPLACEZ').classList.remove('hidden'); }
        if(cancelsaletranno == 'F') { document.getElementById('SYSVIS_CANCELSALETRANNO').classList.add('hidden'); } else { document.getElementById('SYSVIS_CANCELSALETRANNO').classList.remove('hidden'); }
        if(divicd == 'F') { document.getElementById('DIVISIONCD').classList.add('read'); }
        if(curcd == 'F') { document.getElementById('CUSCURCD').classList.add('read'); }
        if(stafcd == 'F') { document.getElementById('STAFFCD').classList.add('read'); }
        if(estcusstaf == 'F') { document.getElementById('ESTCUSSTAFF').classList.add('read'); }
        if(saledivc1 == 'F') { document.getElementById('SALEDIVCON1').classList.add('read'); }
        if(saledivc2 == 'F') { document.getElementById('SALEDIVCON2').classList.add('read'); }
        if(saledivc3 == 'F') { document.getElementById('SALEDIVCON3').classList.add('read'); }
        if(saledivcon2 == 'F') { document.getElementById('SALEDIVCON2').style.display = 'none'; } else { document.getElementById('SALEDIVCON2').style.display = 'block'; }
        if(saledivcon2cbo == 'F') { document.getElementById('SALEDIVCON2CBO').style.display = 'none'; } else { document.getElementById('SALEDIVCON2CBO').style.display = 'block'; }
        if(saleterm == 'F') { document.getElementById('SALETERM').classList.add('read'); }
        if(cusmemo == 'F') { document.getElementById('SALECUSMEMO').classList.add('read'); }
        if(desc == 'F') { document.getElementById('DESCRIPTION').classList.add('read'); }
        if(saletraninsdt == 'F') { document.getElementById('SALETRANINSPDT').classList.add('read'); }
        if(disrate == 'F') { document.getElementById('DISCRATE').classList.add('read'); }
        if(vatrate == 'F') { document.getElementById('VATRATE').classList.add('read'); }
        if(customercd == 'F') { document.getElementById('CUSTOMERCD').classList.add('read'); 
                                document.getElementById('SEARCHCUSTOMER').classList.add('read'); }
        if(shipdate1 == 'F') { document.getElementById('SHIPDATE1').classList.add('read'); }
        if(shipdate2 == 'F') { document.getElementById('SHIPDATE2').classList.add('read'); }
        if(searchen == 'F') { document.getElementById('SEARCH').classList.add('read'); }
        if(btnmakeinv == 'F') { document.getElementById('MAKEINVITEMS').disabled = true; }
        if(btneditship == 'F') { document.getElementById('EDITSHIP').disabled = true; }
        if(commits == 'F') { document.getElementById('COMMIT').disabled = true; }
        if(tableship == 'F') { document.getElementById('tableShip').classList.add('read'); }
        if(table == 'F') { document.getElementById('table').classList.add('read');
            var readItem = document.getElementsByClassName('item-read');
            for(var i = 0; i < readItem.length; i++) {
                readItem[i].classList.add('read');
            }
        }

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 5); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[200px]');
                tablearea.classList.add('h-[330px]');
                maxrow = 10;
            } else {
                tablearea.classList.remove('h-[330px]');
                tablearea.classList.add('h-[200px]');
                maxrow = 5;
            }
            emptyRows(maxrow);
        });

        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');
            let item = $(this).closest('tr').children('td');
            let rowItem = item.eq(0).text();
            if(rowItem != 'undefined' && rowItem != '') {
                $(this).attr('id', 'selected-row');
            }
        });

        $('table#tableShip tbody tr').click(function () {
            let itemship = $(this).closest('tr').children('td');
            let index = itemship.eq(0).text();
            // console.log($(this).closest('tr'));
            let rows = document.getElementsByTagName('tr');
            $('.row-shipid').each(function (x) {
                rows[x+1].classList.remove('selected-row');
            }); 
            if(index != '') {
                rows[index].classList.add('selected-row'); 
            }
        });
    }); 

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'SALETRANNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function commitDialog() {
       return questionDialog(2, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
    }

    function SVprint() {
       return questionDialog(3, '<?=lang('question4')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
    }

    function chked(index) {
        // console.log(index);
        let chk = 'F'; let seq;
        const shiptranordno = document.getElementsByName('SHIPTRANORDERNO[]');
        const shipselect = document.getElementById('SHIPTRANORDERNO' + index + '').value;
        for (var x = 0; x < shiptranordno.length; x++) { seq = x+1;
            // console.log(shiptranordno[x].value);
            if(shiptranordno[x].value == shipselect) {
                if (document.getElementById('CHK' + index + '').checked) {
                    chk = 'T';
                    document.getElementById('CHK' + seq + '').checked = true;
                    document.getElementById('CHKH' + seq + '').disabled = true;
                } else {
                    document.getElementById('CHK' + seq + '').checked = false;
                    document.getElementById('CHKH' + seq + '').disabled = false;
                }
            }
        }
        // return selectShip(index, chk);
    }

    function unRequired() {
    
        document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('SALETERM').classList[document.getElementById('SALETERM').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('DIVISIONCD').classList[document.getElementById('DIVISIONCD').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('CUSTOMERCD').classList[document.getElementById('CUSTOMERCD').value !== '' ? 'remove' : 'add']('req');
    }

    function reprintDialog() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('validation2'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }

    function validationDialog() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }

    function successValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('success'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                    // $('#loading').show();
                }
        });
    }

    function alertDialog(msg) {
        return Swal.fire({ 
            title: '',
            text: msg,
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }

    // function checkedAll() {
    //     var checkall = document.getElementById('CHKALL');
    //     var dvw = '<?php echo !empty($data['ITEMSHIP']) ? json_encode($data['ITEMSHIP']): ''; ?>'; 
    //     if(dvw != '') {
    //         let dvwArray = JSON.parse(dvw);
    //         $.each(dvwArray, function(key, value) {  
    //             // console.log(key);
    //             if (checkall.checked) {
    //                 $('#CHK'+key+'').prop('checked', true);
    //                 document.getElementById('CHKH'+key+'').disabled = true;
    //             } else {
    //                 $('#CHK'+key+'').prop('checked', false);
    //                 document.getElementById('CHKH'+key+'').disabled = false;
    //             }
    //         });
    //     }
    // }
</script>
</html>
