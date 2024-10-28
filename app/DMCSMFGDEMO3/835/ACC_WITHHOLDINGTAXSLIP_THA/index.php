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
                <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
                <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
                <form class="w-full" method="POST" id="accWithholdingTaxSlipTHA" name="accWithholdingTaxSlipTHA" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>    
                    <div class="flex mb-1">
                        <div class="flex w-6/12 px-2">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUBMIT_TO_MONTH'); ?></label>
                            <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 text-left rounded-xl border-gray-300"
                                    id="D3" name="D3">
                            <option value=""></option>
                                <?php foreach ($year as $yearkey => $yearitem) { ?>
                                    <option value="<?=$yearkey ?>" <?=(isset($data['D3']) && $data['D3'] == $yearkey) ? 'selected' : '' ?>><?=$yearitem ?></option>
                                <?php } ?>
                            </select>&ensp;
                            <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 req"
                                    id="D4" name="D4" onchange="unRequired();" required>
                            <option value=""></option>
                                <?php foreach ($monthvalue as $monthkey => $monthitem) { ?>
                                    <option value="<?=$monthkey ?>" <?=(isset($data['D4']) && $data['D4'] == $monthkey) ? 'selected' : '' ?>><?=$monthitem ?></option>
                                <?php } ?>
                            </select>
                            <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('TAX_TYPE'); ?></label>
                        </div>

                        <div class="flex w-6/12">
                            <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300"
                                    id="D5" name="D5">
                            <option value=""></option>
                                <?php foreach ($taxtype as $taxtypkey => $taxtypitem) { ?>
                                    <option value="<?=$taxtypkey ?>" <?=(isset($data['D5']) && $data['D5'] == $taxtypkey) ? 'selected' : '' ?>><?=$taxtypitem ?></option>
                                <?php } ?>
                            </select>
                            <div class="w-2/12"></div>
                            <div class="flex w-6/12 justify-end">
                                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                        id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                   <div id="table-area" class="overflow-scroll px-2 block h-[336px]">
                        <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 wts_tb" rules="cols" cellpadding="3" cellspacing="1">
                            <thead class="sticky top-0 bg-gray-50">
                                <tr class="border border-gray-600">
                                    <th class="px-2 text-center border border-slate-700">
                                        <input type="hidden" name="CHKALL" value="F"/>
                                        <input class="chkbox" type="checkbox" id="CHKALL" name="CHKALL" value="T" onclick="checkedAll();"/>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DATE'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAX_VOUCHER_NO'); ?></span>
                                    </th>
                                    <th class="px-4 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUPPLIER_NAME'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PAY_AMOUNT'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAX_AMT'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAX_TYPE'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUBMIT_TO_MONTH'); ?></span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto">
                                <?php if(!empty($data['ITEM'])) {
                                    $minrow = count($data['ITEM']);
                                    foreach ($data['ITEM'] as $key => $value) { ?>
                                        <tr class="border border-gray-600 row-id" id="rowId<?=$key?>">
                                            <td class="hidden" id="ROWNO_TD<?=$key?>"><?=$key?></td>
                                            <td class="px-2 text-center border border-slate-700">
                                                <input type="hidden" id="CHKROWH<?=$key?>" name="CHKROW[]" value="F"/>
                                                <input class="chkbox" type="checkbox" id="CHKROW<?=$key?>" name="CHKROW[]" value="T" onchange="chked(<?=$key?>);"/>
                                            </td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 whitespace-nowrap text-center"><?=isset($value['PAYMENTDT']) ? $value['PAYMENTDT']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 whitespace-nowrap text-left"><?=isset($value['PAYMENTADD07']) ? $value['PAYMENTADD07']:'' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 whitespace-nowrap text-left"><?=isset($value['PAYMENTSUPNAME']) ? $value['PAYMENTSUPNAME']:'' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 whitespace-nowrap text-right"><?=isset($value['PAYMENTADD03']) ? $value['PAYMENTADD03']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 whitespace-nowrap text-right"><?=isset($value['PAYMENTAMT']) ? $value['PAYMENTAMT']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 whitespace-nowrap text-left"><?php foreach ($taxtype as $tax => $taxItem) { if($value['PAYMENTADD13'] == $tax) { echo $taxItem; } }?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 whitespace-nowrap text-left"><?php foreach ($monthvalue as $month => $monthItem) { if($value['PAYMENTADD11'] == $month) { echo $monthItem; } }?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD13']) ? $value['PAYMENTADD13']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD11']) ? $value['PAYMENTADD11']: '' ?></td>
                                            <td class="hidden"><?=isset($value['TRANYEAR']) ? $value['TRANYEAR']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PURRECPAYORDERNO']) ? $value['PURRECPAYORDERNO']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PURRECPAYORDERLN']) ? $value['PURRECPAYORDERLN']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PURRECPAYORDERLN2']) ? $value['PURRECPAYORDERLN2']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTNO']) ? $value['PAYMENTNO']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTLN']) ? $value['PAYMENTLN']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTLN2']) ? $value['PAYMENTLN2']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD12']) ? $value['PAYMENTADD12']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTSUPCD']) ? $value['PAYMENTSUPCD']: '' ?></td>
                                            <td class="hidden"><?=isset($value['SUPTAXID']) ? $value['SUPTAXID']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTDIVCD']) ? $value['PAYMENTDIVCD']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTDIVNAME']) ? $value['PAYMENTDIVNAME']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTCURCD']) ? $value['PAYMENTCURCD']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PMNOTE05']) ? $value['PMNOTE05']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTTYP2']) ? $value['PAYMENTTYP2']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD07']) ? $value['PAYMENTADD07']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD08']) ? $value['PAYMENTADD08']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD13']) ? $value['PAYMENTADD13']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD14']) ? $value['PAYMENTADD14']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD15']) ? $value['PAYMENTADD15']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD09']) ? $value['PAYMENTADD09']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD10']) ? $value['PAYMENTADD10']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD16']) ? $value['PAYMENTADD16']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYMENTADD11']) ? $value['PAYMENTADD11']: '' ?></td>
                                            <td class="hidden"><?=isset($value['SYSVIS_PRINTPND3']) ? $value['SYSVIS_PRINTPND3']: '' ?></td>
                                            <td class="hidden"><?=isset($value['SYSVIS_PRINTPND53']) ? $value['SYSVIS_PRINTPND53']: '' ?></td>
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
                                    </tr><?php
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="hidden">
                        <div class="flex w-full">
                            <input class="hidden" name="TPAY" id="TPAY" value="<?=isset($data['TPAY']) ? $data['TPAY']: ''; ?>" readonly/>
                            <input class="hidden" name="TTAXM" id="TTAXM" value="<?=isset($data['TTAXM']) ? $data['TTAXM']: ''; ?>" readonly/>
                        </div>
                    </div>

                    <div class="flex p-2">
                        <div class="flex w-12/12">
                            <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="record"><?=$minrow;?></span></label>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <!-- Card -->
                        <div class="p-1.5 inline-block align-middle">
                            <!-- Header -->
                            <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                                <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary>  
                                <div class="flex">
                                    <div class="flex w-6/12">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                                id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                                                <?php if(!empty($data['SYSVIS_UPD']) && $data['SYSVIS_UPD'] != 'T') {?> disabled <?php }?>><?=checklang('UPDATE'); ?>
                                        </button>
                                    </div>
                                    <div class="flex w-6/12 justify-end"></div>
                                </div>

                                <div class="flex mb-2">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('SUPPLIERCODE'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" name="PAYMENTSUPCD" id="PAYMENTSUPCD" value="<?=isset($data['PAYMENTSUPCD']) ? $data['PAYMENTSUPCD']: ''; ?>" readonly/>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 ml-1 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" id="PAYMENTSUPNAME" name="PAYMENTSUPNAME" value="<?=isset($data['PAYMENTSUPNAME']) ? $data['PAYMENTSUPNAME']: ''; ?>" readonly/>
                                        <input type="hidden" id="ROWNO" name="ROWNO">
                                        <input type="hidden" id="TRANYEAR" name="TRANYEAR">
                                        <input type="hidden" id="PURRECPAYORDERNO" name="PURRECPAYORDERNO">
                                        <input type="hidden" id="PURRECPAYORDERLN" name="PURRECPAYORDERLN">
                                        <input type="hidden" id="PURRECPAYORDERLN2" name="PURRECPAYORDERLN2">
                                        <input type="hidden" id="PAYMENTLN" name="PAYMENTLN">
                                        <input type="hidden" id="PAYMENTLN2" name="PAYMENTLN2">
                                        <input type="hidden" id="PAYMENTCURCD" name="PAYMENTCURCD">
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TAX_ID'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" name="SUPTAXID" id="SUPTAXID" value="<?=isset($data['SUPTAXID']) ? $data['SUPTAXID']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-5/12 pl-4 pt-1"></label>
                                    </div>
                                </div>

                                <div class="flex mb-2">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('DIVISIONCODE'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read" 
                                               type="text" name="PAYMENTDIVCD" id="PAYMENTDIVCD" value="<?=isset($data['PAYMENTDIVCD']) ? $data['PAYMENTDIVCD']: ''; ?>" readonly/>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 ml-1 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" id="PAYMENTDIVNAME" name="PAYMENTDIVNAME" value="<?=isset($data['PAYMENTDIVNAME']) ? $data['PAYMENTDIVNAME']: ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TAX_VOUCHER_NO'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                                               type="text" name="PAYMENTADD07" id="PAYMENTADD07" value="<?=isset($data['PAYMENTADD07']) ? $data['PAYMENTADD07']: ''; ?>"/>
                                        <label class="text-color block text-sm w-2/12 pl-4 pt-1"><?=checklang('DATE'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                               type="date" id="PAYMENTADD08" name="PAYMENTADD08" value="<?=!empty($data['PAYMENTADD08']) ? date('Y-m-d', strtotime($data['PAYMENTADD08'])): date('Y-m-d'); ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-2">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('INVOICENO'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read" 
                                               type="text" name="PAYMENTADD12" id="PAYMENTADD12" value="<?=isset($data['PAYMENTADD12']) ? $data['PAYMENTADD12']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pl-4 pt-1"><?=checklang('WHTAXTYP'); ?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300 read" id="PAYMENTTYP2" name="PAYMENTTYP2">
                                        <option value=""></option>
                                            <?php foreach ($whtaxtyp as $whtaxkey => $whtaxitem) { ?>
                                                <option value="<?=$whtaxkey ?>" <?=(isset($data['PAYMENTTYP2']) && $data['PAYMENTTYP2'] == $whtaxkey) ? 'selected' : '' ?>><?=$whtaxitem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PM_NO'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" name="PAYMENTNO" id="PAYMENTNO" value="<?=isset($data['PAYMENTNO']) ? $data['PAYMENTNO']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pl-4 pt-1"><?=checklang('DATE'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="date" id="PAYMENTDT" name="PAYMENTDT" value="<?=!empty($data['PAYMENTDT']) ? date('Y-m-d', strtotime($data['PAYMENTDT'])): ''; ?>"/>
                                    </div>
                                </div>


                                <div class="flex mb-2">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('TAX_TYPE'); ?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="PAYMENTADD13" name="PAYMENTADD13">
                                        <option value=""></option>
                                            <?php foreach ($taxtype as $taxtkey => $taxtitem) { ?>
                                                <option value="<?=$taxtkey ?>" <?=(isset($data['PAYMENTADD13']) && $data['PAYMENTADD13'] == $taxtkey) ? 'selected' : '' ?>><?=$taxtitem ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="text-color block text-sm w-3/12 pl-4 pt-1"><?=checklang('TAX_CONDITION'); ?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="PAYMENTADD14" name="PAYMENTADD14">
                                        <option value=""></option>
                                            <?php foreach ($taxcondition as $taxcondikey => $taxcondiitem) { ?>
                                                <option value="<?=$taxcondikey ?>" <?=(isset($data['PAYMENTADD14']) && $data['PAYMENTADD14'] == $taxcondikey) ? 'selected' : '' ?>><?=$taxcondiitem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                        
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TYPE_OF_INCOME'); ?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-4/12 text-left rounded-xl border-gray-300" id="PAYMENTADD15" name="PAYMENTADD15">
                                        <option value=""></option>
                                            <?php foreach ($typeofincome as $typeofinkey => $typeofinitem) { ?>
                                                <option value="<?=$typeofinkey ?>" <?=(isset($data['PAYMENTADD15']) && $data['PAYMENTADD15'] == $typeofinkey) ? 'selected' : '' ?>><?=$typeofinitem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-2">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('PAY_AMOUNT'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" name="PAYMENTADD03" id="PAYMENTADD03" value="<?=isset($data['PAYMENTADD03']) ? $data['PAYMENTADD03']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pl-4 pt-1"><?=checklang('TAX_AMT'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" name="PAYMENTAMT" id="PAYMENTAMT" value="<?=isset($data['PAYMENTAMT']) ? $data['PAYMENTAMT']: ''; ?>" readonly/>
                                    </div>
                                        
                                    <div class="flex w-6/12 px-2">
                                
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('WHTRATE'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" id="PMNOTE05" name="PMNOTE05" value="<?=isset($data['PMNOTE05']) ? $data['PMNOTE05']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-2">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-[12px] w-2/12 pr-2 pt-1"><?=checklang('SUBMIT_TO_MONTH'); ?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 mr-2 text-left rounded-xl border-gray-300" id="PAYMENTADD16" name="PAYMENTADD16">
                                        <option value=""></option>
                                            <?php foreach ($year as $yearkey => $yearitem) { ?>
                                                <option value="<?=$yearkey ?>" <?=(isset($data['PAYMENTADD16']) && $data['PAYMENTADD16'] == $yearkey) ? 'selected' : '' ?>><?=$yearitem ?></option>
                                            <?php } ?>
                                        </select>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="PAYMENTADD11" name="PAYMENTADD11">
                                        <option value=""></option>
                                            <?php foreach ($monthvalue as $monthkey => $monthitem) { ?>
                                                <option value="<?=$monthkey ?>" <?=(isset($data['PAYMENTADD11']) && $data['PAYMENTADD11'] == $monthkey) ? 'selected' : '' ?>><?=$monthitem ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                        
                                    <div class="flex w-6/12 px-2 hidden">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('SECURITY_FUND'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" name="PAYMENTADD09" id="PAYMENTADD09" value="<?=isset($data['PAYMENTADD09']) ? $data['PAYMENTADD09']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-2/12 pt-1"><?=checklang('PROVIDED_FUND'); ?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                               type="text" id="PAYMENTADD10" name="PAYMENTADD10" value="<?=isset($data['PAYMENTADD10']) ? $data['PAYMENTADD10']: ''; ?>" readonly/>
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
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="EXPORT" name="EXPORT"><?=checklang('EXPORT')?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="WHT" name="WHT" ><?=checklang('WHT')?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="PND53" name="PND53" ><?=checklang('PND53')?></button>
                        </div>
                        <div class="flex w-6/12 justify-end">
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
<!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">   
    $(document).ready(function() {
        document.getElementById('UPDATE').disabled = true;
        calculateDVW(); 
        unRequired();
        selectRow();

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 12); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[336px]');
                tablearea.classList.add('h-[580px]');
                maxrow = 22;
            } else {
                tablearea.classList.remove('h-[580px]');
                tablearea.classList.add('h-[336px]');
                maxrow = 12;
            }
            emptyRow(maxrow);
        });
    });

    function calculateDVW() {
        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        let tpay = 0; let ttaxm = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            $.each(itemArray, function(key, value) {
                tpay += parseFloat(value.PAYMENTADD03.replace(/,/g, '')) || 0;
                ttaxm += parseFloat(value.PAYMENTAMT.replace(/,/g, '')) || 0;
            });
            if(tpay != 0) { tpay = num2digit(tpay); }
            if(ttaxm != 0) { ttaxm = num2digit(ttaxm); }
            $('#TPAY').val(tpay);
            $('#TTAXM').val(ttaxm);
        }        
    }

    function checkedAll() {
        var checkall = document.getElementById('CHKALL');
        var dvw = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>'; 
        if(dvw != '') {
            let dvwArray = JSON.parse(dvw);
            $.each(dvwArray, function(key, value) {  
                // console.log(key);
                if (checkall.checked) {
                    $('#CHKROW'+key+'').prop('checked', true);
                    document.getElementById('CHKROWH'+key+'').disabled = true;
                } else {
                    $('#CHKROW'+key+'').prop('checked', false);
                    document.getElementById('CHKROWH'+key+'').disabled = false;
                }
            });
        }
    }

    function chked(index) {
        if (document.getElementById("CHKROW" + index + "").checked) {
            document.getElementById("CHKROWH" + index + "").disabled = true;
        } else {
            document.getElementById("CHKROWH" + index + "").disabled = false;
        }
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');        
        } else if(type == 2) {
            //EXPORT
            return questionDialog(2, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>'); 
        } else if(type == 3) {
            // WHT
           return questionDialog(3, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>'); 
        } else if(type == 4) { 
            // PND53
            return questionDialog(4, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>'); 
        } else {
            return alertWarning('<?=lang('validation2')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>'); 
        }
    }

    function unRequired() {
        document.getElementById('D4').classList[document.getElementById('D4').selectedIndex != 0 ? 'remove' : 'add']('req');
    }
</script>
</html>