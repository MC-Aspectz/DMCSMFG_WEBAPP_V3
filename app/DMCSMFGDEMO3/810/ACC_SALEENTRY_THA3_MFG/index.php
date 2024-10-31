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
        <main class="flex flex-1 overflow-hidden paragraph px-2">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="saleentrymfg" name="saleentrymfg" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <div class="flex py-1">
                    <div class="flex w-6/12">
                        <label class="text-color block text-lg font-bold"><?=$appname;?></label>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm font-bold px-5 py-1 text-center me-2"
                            id="END" name="END" onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=lang('close')?>&nbsp;[X]</button>
                    </div>
                </div>

                <div class="flex w-full h-full">
                    <!-- Side Search -->
                    <aside class="w-[50%] h-[95%] mx-1 overflow-y-auto rounded shadow-sm border-2 border-gray-200 left-side-<?=$appcode?>">
                        <button type="button" class="p-1" id="left-side" onclick="javascript:toggleSideForm('<?=$appcode?>', 'left');">
                            <svg class="fill-current opacity-75 w-6 h-6 -mr-1 rotate-0" viewBox="0 0 256 512">
                                <path d="M9.4 278.6c-12.5-12.5-12.5-32.8 0-45.3l128-128c9.2-9.2 22.9-11.9 34.9-6.9s19.8 16.6 19.8 29.6l0 256c0 12.9-7.8 24.6-19.8 29.6s-25.7 2.2-34.9-6.9l-128-128z"></path>
                            </svg>
                        </button> 

                        <div class="p-2 align-middle">
                            <details id="search-condition" class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('searchcondition')?></summary>
                                <div class="left-size">
                                    <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="INVOICE_NO_TXT"><?=checklang('INVOICE_NO')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="SERSONO1" name="SERSONO1" value="<?=isset($data['SERSONO1']) ? $data['SERSONO1']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALEORDER1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>&ensp;→&ensp;
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="SERSONO2" name="SERSONO2" value="<?=isset($data['SERSONO2']) ? $data['SERSONO2']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALEORDER2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                   <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="SERCUSTCD" name="SERCUSTCD" value="<?=isset($data['SERCUSTCD']) ? $data['SERCUSTCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCUSTOMERS">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="SERCUSTNAME" name="SERCUSTNAME" value="<?=isset($data['SERCUSTNAME']) ? $data['SERCUSTNAME']: ''; ?>" readonly/>
                                        <div class="flex w-3/12"></div>
                                    </div>

                                    <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="INPUT_DATE_TXT"><?=checklang('INPUT_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                               id="SERINPDATE1" name="SERINPDATE1" value="<?=!empty($data['SERINPDATE1']) ? date('Y-m-d', strtotime($data['SERINPDATE1'])) : date('Y-m-d'); ?>"/>
                                               &ensp;→&ensp;
                                        <input type="date" class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                              id="SERINPDATE2" name="SERINPDATE2" value="<?=!empty($data['SERINPDATE2']) ? date('Y-m-d', strtotime($data['SERINPDATE2'])) : date('Y-m-d'); ?>"/>
                                    </div>


                                    <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="PERSON_RESPONSE_TXT"><?=checklang('STATUS')?></label>
                                        <select id="STATUYS" name="STATUYS" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300 read" readonly>
                                            <option value=""></option>
                                            <?php foreach ($BRANCH_KBN as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['STATUYS']) && $data['STATUYS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                   
                                        <div class="flex w-3/12 justify-end">
                                            <button type="button" class="btn text-color inline-flex justify-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-3xl text-sm font-medium w-9/12 py-0.5"
                                                    id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                                                <svg class="w-4 h-4 ml-2 mt-0.5" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </div>

                        <div id="table-search-area" class="overflow-scroll block mx-2 h-[58%]"> 
                            <table id="table-search" class="w-full border-collapse border border-slate-500 divide-gray-200 tb-search" rules="cols" cellpadding="3" cellspacing="1">
                                <thead class="sticky top-0 bg-gray-50">
                                    <tr class="border border-gray-600 csv">
                                        <th class="hidden"></th>
                                        <th class="px-6 text-center border border-slate-700 text-left">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INVOICE_NO'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INPUT_DATE'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RECIPIENTNAME'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ESTIMATE_NO'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DIVISIONNAME'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STAFFNAME'); ?></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="searchdetail" class="divide-y divide-gray-200"><?php
                                    if(!empty($data['SEARCHITEM'])) { $minsearchrow = count($data['SEARCHITEM']);
                                        foreach($data['SEARCHITEM'] as $key => $value) { ?>
                                        <tr class="divide-y divide-gray-200 cursor-pointer search-id csv" id="searchrow<?=$key?>">
                                            <td class="hidden search-seq"><?=$key ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="SALEORDERNO_TD<?=$key?>"><?=isset($value['SALEORDERNO']) ? $value['SALEORDERNO']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="SALEISSUEDT_TD<?=$key?>"><?=isset($value['SALEISSUEDT']) ? $value['SALEISSUEDT']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="CUSTOMERNAME_TD<?=$key?>"><?=isset($value['CUSTOMERNAME']) ? $value['CUSTOMERNAME']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="DELIVERYNAME_TD<?=$key?>"><?=isset($value['DELIVERYNAME']) ? $value['DELIVERYNAME']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="CUSCURDISP_TD<?=$key?>"><?=isset($value['CUSCURDISP']) ? $value['CUSCURDISP']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ESTNO_TD<?=$key?>"><?=isset($value['ESTNO']) ? $value['ESTNO']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="DIVISIONNAME_TD<?=$key?>"><?=isset($value['DIVISIONNAME']) ? $value['DIVISIONNAME']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="STAFFNAME_TD<?=$key?>"><?=isset($value['STAFFNAME']) ? $value['STAFFNAME']: '' ?></td>
                                        </tr><?php 
                                        }
                                    }
                                    for ($i = $minsearchrow+1; $i <= $maxsearchrow; $i++) { ?>
                                        <tr class="divide-y divide-gray-200 row-empty" id="searchrow<?=$i?>">
                                            <td class="hidden search-seq"></td>
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

                        <div class="flex p-2">
                            <div class="flex w-6/12">
                                <label class="text-color h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?>  <span id="rowCountSearch" ><?=$minsearchrow ?></span></label>
                            </div>
                            <div class="flex w-6/12 justify-end">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm font-bold px-5 py-0.5 text-center me-2"
                                    id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                            </div>
                        </div>
                    </aside>

                    <!-- Content Page -->
                    <aside class="w-[50%] h-[95%] mx-1 rounded shadow-sm border-2 border-gray-200 right-side-<?=$appcode?>" id="form_data">
                        <button type="button" class="p-1" id="right-side" onclick="javascript:toggleSideForm('<?=$appcode?>', 'right');">
                            <svg class="fill-current opacity-75 w-6 h-6 transition-all duration-300 rotate-0" viewBox="0 0 256 512">
                                <path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"></path>
                            </svg>
                        </button> 

                        <div class="flex w-full px-4">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="NEW" name="NEW" onclick="clearForm(); $('table#table-search tbody tr').not(this).removeClass('selected-row');"><?=checklang('NEW'); ?></button>
                                <h5 class="w-5/12 pl-16 pt-1 text-red-500 font-semibold hidden" id="CANCELMSG"><?=checklang('CANCELMSG')?></h5>
                        </div>

                        <div class="flex px-6 my-2">
                            <div class="right-size flex w-full">
                                <label class="text-color block text-sm font-semibold w-3/12 pl-4 pt-1"><?=checklang('INVOICE_NO')?></label>
                                <div class="relative w-4/12 mx-2">
                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                            id="SALETRANNO" name="SALETRANNO" value=""/>
                                    <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none hidden"
                                        id="SEARCHSALETRAN_ACC">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex w-5/12" id="SYSVIS_CANCELSALETRANNO">
                                    <label class="text-color block text-sm w-5/12 pt-1 text-center"><?=checklang('CANCEL_INVOICE_NO')?></label>
                                    <input type="text" class="text-control text-[14px] shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="CANCELSALETRANNO" name="CANCELSALETRANNO" value="<?=isset($data['CANCELSALETRANNO']) ? $data['CANCELSALETRANNO']: ''; ?>" readonly/>
                                    <input type="hidden" id="REPLACEMODE" name="REPLACEMODE" value="<?=!empty($data['REPLACEMODE']) ? $data['REPLACEMODE']: '0'; ?>"/>
                                    <input type="hidden" id="LOADSOFLG" name="LOADSOFLG" value="<?=!empty($data['LOADSOFLG']) ? $data['LOADSOFLG']: ''; ?>"/>
                                </div>
                               
                                <input type="hidden" id="LINE" name="LINE" value="">
                            </div>
                        </div>

                        <article class="w-full max-h-[80%] overflow-y-auto px-2">
                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupsaleheader')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('INVDATE')?></label>
                                            <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                    id="SALETRANINSPDT" name="SALETRANINSPDT" value="<?=date('Y-m-d')?>"/>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center hidden"
                                                type="date" id="SALELNDUEDT" name="SALELNDUEDT" value="" readonly/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                                            <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                    id="SALETRANSALEDT" name="SALETRANSALEDT" value="<?=date('Y-m-d')?>"/>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center hidden"
                                                type="date" id="SALELNDUEDT" name="SALELNDUEDT" value="" readonly/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('SALEORDERNO')?></label>
                                            <div class="relative w-4/12">
                                                <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="SALEORDERNO" name="SALEORDERNO" value=""/>
                                                <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHSALEORDER">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="hidden" name="SVNO" id="SVNO" value="<?=isset($data['SVNO']) ? $data['SVNO']: ''; ?>"/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                                            <div class="relative w-4/12">
                                                <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="DIVISIONCD" name="DIVISIONCD" value="" onchange="unRequired();" required/>
                                                <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHDIVISION">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="DIVISIONNAME" name="DIVISIONNAME" value="" readonly/>
                                         </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                                            <div class="relative w-4/12">
                                                <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="STAFFCD" name="STAFFCD" value="" onchange="unRequired();" required/>
                                                <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHSTAFF">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="STAFFNAME" name="STAFFNAME" value="" readonly/>
                                         </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                                            <div class="relative w-4/12">
                                                <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="CUSCURCD" name="CUSCURCD" value=""/>
                                                  <!-- <?php if(!empty($data['isPrint']) && $data['isPrint'] != 'off') { ?> id="xxx" <?php } else { ?> id="SEARCHCURRENCY" <?php } ?>> -->
                                                <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHCURRENCY">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DESCRIPTION')?></label>
                                            <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 mr-1 text-gray-700 border-gray-300"
                                                id="DESCRIPTION" name="DESCRIPTION" value=""/>
                                        </div>
                                    </div>

                                    <div class="p-2 align-middle">
                                        <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                            <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupcustomer')?></summary>
                                            <div class="right-size w-full">
                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                                    <div class="relative w-4/12">
                                                        <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                                id="CUSTOMERCD" name="CUSTOMERCD" value="" onchange="unRequired();" required/>
                                                        <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                            id="SEARCHCUSTOMER">
                                                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                        id="CUSTOMERNAME" name="CUSTOMERNAME" value="" readonly/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                           id="CUSTADDR1" name="CUSTADDR1" value="" readonly/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                           id="CUSTADDR2" name="CUSTADDR2" value="" readonly/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('BRANCH')?></label>
                                                    <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300 read" id="BRANCHKBN" name="BRANCHKBN">
                                                        <option value=""></option>
                                                        <?php foreach ($BRANCH_KBN as $key => $item) { ?>
                                                            <option value="<?=$key?>"><?=$item ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('TAXID')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                           id="TAXID" name="TAXID" value=""/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('TEL')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="ESTCUSTEL" name="ESTCUSTEL" oninput="this.value = stringReplacez(this.value);" value=""/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('FAX')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="ESTCUSFAX" name="ESTCUSFAX" oninput="this.value = stringReplacez(this.value);" value=""/>
                                                </div>    

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('CREDITTERM')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="SALETERM" name="SALETERM" onchange="unRequired();" oninput="this.value = stringReplacez(this.value);" value="" required/>
                                                    <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-2"><?=checklang('DAYS')?></label>
                                                </div>   

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('ATTENTION')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="ESTCUSSTAFF" name="ESTCUSSTAFF" value=""/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('REFERENCE')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="SALECUSMEMO" name="SALECUSMEMO" value=""/>
                                                </div>
                                            </div>
                                        </details>
                                    </div>

                                    <div class="right-size w-full">
                                        <div class="flex mb-1 mx-2 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('REMARKS')?></label>
                                            <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   id="SALEDIVCON1" name="SALEDIVCON1" value=""/>
                                        </div>  

                                        <div class="flex mb-1 mx-2 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('')?></label>
                                            <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   id="SALEDIVCON2" name="SALEDIVCON2" value=""/>
                                            <select class="text-control text-[12px] shadow-md border px-3 h-7 w-9/12 text-left rounded-xl border-gray-300 SALEDIVCON2"
                                                    id="SALEDIVCON2CBO" name="SALEDIVCON2CBO" onchange="setSaleDivCon2();">
                                                <option value=""></option>
                                                <?php foreach ($CANCELREASON as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['SALEDIVCON2CBO']) && $data['SALEDIVCON2CBO'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>    

                                        <div class="flex mb-1 mx-2 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('')?></label>
                                            <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   id="SALEDIVCON3" name="SALEDIVCON3" value=""/>
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupsaledetail')?></summary>
                                    <div class="p-2 align-middle">
                                        <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                            <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupsaleitem')?></summary>
                                            <div id="table-area" class="overflow-scroll px-2 block h-[220px]">
                                                <table id="table" class="so_table w-full border-collapse border border-slate-500 divide-gray-200">
                                                    <thead class="sticky top-0 bg-gray-50">
                                                        <tr class="border border-gray-600 ">
                                                            <th class="px-6 w-8 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                                            </th>
                                                            <th class="px-16 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CODE')?></span>
                                                            </th>
                                                            <th class="px-16 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                                                            </th>
                                                            <th class="px-6 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                                            </th>
                                                            <th class="px-6 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UOM')?></span>
                                                            </th>
                                                            <th class="px-6 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT_PRICE')?></span>
                                                            </th>
                                                            <th class="px-6 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DISCOUNT')?></span>
                                                            </th>
                                                            <th class="px-6 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AMOUNT')?></span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="dvwdetail" class="divide-y divide-gray-200"> <?php
                                                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                                            <tr class="divide-y divide-gray-200 row-empty" id="rowId<?=$i?>">
                                                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="LINE_TXT<?=$i?>"></td>
                                                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="CODE_TXT<?=$i?>"></td>
                                                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="DESCRIPTION_TXT<?=$i?>"></td>
                                                                <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="QUANTITY_TXT<?=$i?>"></td>
                                                                <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="UOM_TXT<?=$i?>"></td>
                                                                <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="UNIT_PRICE_TXT<?=$i?>"></td>
                                                                <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="DISCOUNT_TXT<?=$i?>"></td>
                                                                <td class="h-6 pr-1 text-sm border border-slate-700 text-right whitespace-nowrap" id="AMOUNT_TXT<?=$i?>"></td>

                                                                <td class="hidden"><input class="hidden" id="ROWNO<?=$i?>" name="ROWNOZ[]" value="">
                                                                <input class="hidden" id="ITEMCD<?=$i?>" name="ITEMCDZ[]" value="">
                                                                <input class="hidden" id="ITEMNAME<?=$i?>" name="ITEMNAMEZ[]" value="">
                                                                <input class="hidden" id="SALEQTY<?=$i?>" name="SALEQTYZ[]" value="">
                                                                <input class="hidden" id="ITEMUNITTYP<?=$i?>" name="ITEMUNITTYPZ[]" value="">
                                                                <input class="hidden" id="SALEUNITPRC<?=$i?>" name="SALEUNITPRCZ[]" value="">
                                                                <input class="hidden" id="SALEDISCOUNT<?=$i?>" name="SALEDISCOUNTZ[]" value="">
                                                                <input class="hidden" id="SALEAMT<?=$i?>" name="SALEAMTZ[]" value="">
                                                                <input class="hidden" id="SALELNNO<?=$i?>" name="SALELNNOZ[]" value="">
                                                                <input class="hidden" id="SALELN<?=$i?>" name="SALELNZ[]" value="">
                                                                <input class="hidden" id="SALEORDERQTY<?=$i?>" name="SALEORDERQTYZ[]" value="">
                                                                <input class="hidden" id="SHIPTRANNO<?=$i?>" name="SHIPTRANNOZ[]" value="">
                                                                <input class="hidden" id="SHIPTRANLN<?=$i?>" name="SHIPTRANLNZ[]" value=""/>
                                                                <input class="hidden" id="SALEDISCOUNT2<?=$i?>" name="SALEDISCOUNT2Z[]" value=""/>
                                                                <input class="hidden" id="SALEORDERNOLN<?=$i?>" name="SALEORDERNOLNZ[]" value="">
                                                                <input class="hidden" id="SALETAXAMT<?=$i?>" name="SALETAXAMTZ[]" value="">
                                                                <input class="hidden" id="CUSPONO<?=$i?>" name="CUSPONOZ[]" value=""/>
                                                                <input class="hidden" id="WHTTYP<?=$i?>" name="WHTTYPZ[]" value="">
                                                                <input class="hidden" id="SALETRANADD31<?=$i?>" name="SALETRANADD31Z[]" value="">
                                                                <input class="hidden" id="SALETRANADD32<?=$i?>" name="SALETRANADD32Z[]" value="">
                                                                <input class="hidden" id="SALETRANADD33<?=$i?>" name="SALETRANADD33Z[]" value=""/>
                                                                <input class="hidden" id="SALETRANADD34<?=$i?>" name="SALETRANADD34Z[]" value="">
                                                                <input class="hidden" id="SALETRANADD35<?=$i?>" name="SALETRANADD35Z[]" value=""></td>
                                                            </tr><?php
                                                        } ?>
                                                    </tbody>
                                                    <tfoot class="sticky bottom-0 z-20 pointer-events-none">
                                                        <tr>
                                                            <td class="text-color h-6 text-[12px]" colspan="11"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="rowCount"><?=$minrow;?></span></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </details>
                                    </div>

                                    <div class="p-2 align-middle">
                                        <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                            <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('grouptotal')?></summary>
                                            <div class="right-size w-full">
                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-6/12 pr-2 pt-1"><?=checklang('SUBTOTAL')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                           id="S_TTL" name="S_TTL" value=""/>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                            id="CUSCURDISP" name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly />
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DISCOUNT')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                            id="DISCRATE" name="DISCRATE" value="0" onchange="calcDiscount();" oninput="this.value = stringReplacez(this.value);"/>&nbsp;
                                                    <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                            id="DISCOUNTAMOUNT" name="DISCOUNTAMOUNT" value=""/>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                            name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly />
                                                </div>  

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-6/12 pr-2 pt-1"><?=checklang('AFTERDISCOUNT')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                           id="QUOTEAMOUNT" name="QUOTEAMOUNT" value=""/>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                            name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly />
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('VAT')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                            id="VATRATE" name="VATRATE" onchange="calcVat();" value="" oninput="this.value = stringReplacez(this.value);"/>&nbsp;
                                                    <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                            id="VATAMOUNT1" name="VATAMOUNT1" value=""/>
                                                    <input class="hidden" name="VATAMOUNT" id="VATAMOUNT" value="0.00" readonly/>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                            name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly />
                                                </div>    

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-6/12 pr-2 pt-1"><?=checklang('TOTALAMOUNT')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                           id="T_AMOUNT" name="T_AMOUNT" value=""/>
                                                    <input class="hidden" name="T_AMOUNT1" id="T_AMOUNT1" value="0.00" readonly/>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                            name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly />
                                                    <input type="hidden" class="hidden" name="GROUPRT" type="text" value=""/>
                                                </div>  
                                            </div>                                                                                    
                                        </details>
                                    </div>

                                    <div class="p-2 align-middle">
                                        <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                            <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupitementry')?></summary>
                                            <div class="right-size w-full">
                                                <div class="flex my-2 px-2">
                                                    <button type="button" class="btn text-color ctrl-read border-2 focus:ring-4 focus:outline-none font-medium rounded-3xl text-sm font-bold px-5 py-0.5 text-center me-2"
                                                            id="NEWITEM" name="NEWITEM" onclick="javascript:itemEntry();"><?=lang('newitems'); ?></button>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('LINE')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                        id="ROWNO" name="ROWNO" value="" readonly/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('ITEMCODE')?></label>
                                                    <div class="relative w-4/12">
                                                        <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                                id="ITEMCD" name="ITEMCD" value=""/>
                                                        <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                            id="SEARCHITEM">
                                                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                        id="ITEMNAME" name="ITEMNAME" value="" readonly/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('QUANTITY')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                           id="SALELNQTY" name="SALELNQTY" value="" onchange="this.value = num2digit(this.value); calcAmount();" oninput="this.value = stringReplacez(this.value);"/>
                                                    <select class="text-control shadow-sm border h-7 w-4/12 px-3 text-[12px] rounded-xl border-gray-300 read" id="ITEMUNITTYP" name="ITEMUNITTYP">
                                                        <option value=""></option><?php 
                                                        foreach ($UNIT as $key => $item) { ?>
                                                            <option value="<?=$key?>"><?=$item ?></option><?php 
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('UNIT_PRICE')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                           id="SALELNUNITPRC" name="SALELNUNITPRC" value="" onchange="this.value = num2digit(this.value); calcAmount();" oninput="this.value = stringReplacez(this.value);"/>
                                                    <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                            name="CUSCURDISP" value="" readonly />
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DISCOUNT')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                           id="SALELNDISCOUNT" name="SALELNDISCOUNT" value="" onchange="this.value = num2digit(this.value); calcAmount();" oninput="this.value = stringReplacez(this.value);"/>
                                                    <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                            name="CUSCURDISP" value="" readonly />
                                                </div>    
                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('AMOUNT')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                           id="SALELNAMT" name="SALELNAMT" value="" onchange="this.value = num2digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                                    <input class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                            name="CUSCURDISP" value="" readonly />
                                                </div>
                                            </div>
                                            
                                            <div class="flex my-2 px-2">
                                                <button type="button" class="btn text-color ctrl-read border-2 focus:ring-4 focus:outline-none font-medium rounded-3xl text-sm font-bold px-5 py-0.5 text-center me-2"
                                                        id="SAVEITEM" name="SAVEITEM"><?=lang('saveitems'); ?></button>
                                                <button type="button" class="btn text-color ctrl-read border-2 focus:ring-4 focus:outline-none font-medium rounded-3xl text-sm font-bold px-5 py-0.5 text-center me-2"
                                                        id="DELITEM" name="DELITEM"><?=lang('deleteitems'); ?></button>              
                                            </div>
                                        </details>
                                    </div>
                                </details>
                            </div>

                            <div class="flex w-full p-4" id="reprints">
                                <label class="text-color text-sm w-3/12 pr-2 pt-1"><?=checklang('REPRINT_CANCEL_REASON')?></label>
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                        id="REPRINTREASON" name="REPRINTREASON" value="<?=isset($data['REPRINTREASON'])? $data['REPRINTREASON']: ''; ?>"/>
                            </div>

                            <div class="flex p-2">
                                <div class="flex w-6/12">
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                            <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                                            id="COMMIT" name="COMMIT"><?=checklang('SAVE'); ?></button>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                            <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_CANCEL'] != 'T') {?> hidden <?php }?>
                                            id="REPLACEZ" name="REPLACEZ"><?=checklang('REPLACE'); ?></button>
                                </div>
                                <div class="flex w-6/12 justify-end">
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center me-2 mb-2" 
                                            id="INV" name="INV"><?=checklang('INV'); ?></button>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center me-2 mb-2" 
                                            id="TAXINV" name="TAXINV"><?=checklang('TAXINV'); ?></button>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center me-2 mb-2" 
                                            id="SALEV" name="SALEV"><?=checklang('SALEV'); ?></button>
                                </div>
                            </div>
                        </article>
                    </aside>
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
        unRequired(); //calculateDVW();
        document.getElementById('INV').disabled = true;
        document.getElementById('TAXINV').disabled = true;
        document.getElementById('SALEV').disabled = true;
        document.getElementById('REPLACEZ').disabled = true;
        document.getElementById('DELITEM').disabled = true;

        document.getElementById('reprints').style.display = 'none';
        // document.getElementById('reprints').style.visibility = 'hidden';
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
        let saleorder = '<?php echo (isset($data['SYSEN_SALEORDERNO']) ? $data['SYSEN_SALEORDERNO']: 'null'); ?>';
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
        let tranrecmdt = '<?php echo (isset($data['SYSEN_SALETRANPLANRECMONEYDT']) ? $data['SYSEN_SALETRANPLANRECMONEYDT']: 'null'); ?>';

        if(cancelled != 'null' && cancelled == 'T') { 
            $('.search-tag').css('pointer-events', 'none');
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
            $('#SALETRANNO').removeAttr('disabled').css('background-color', 'white');
            $('#SEARCHSALEORDER').css('pointer-events', 'auto');
            document.getElementById('INV').classList.add('hidden');
            document.getElementById('TAXINV').classList.add('hidden');
            document.getElementById('add-row').classList.add('read');
            document.getElementById('delete-row').classList.add('read');
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
        if(divicd == 'F') { document.getElementById('DIVISIONCD').classList.add('read'); document.getElementById('SEARCHDIVISION').classList.add('read'); }
        if(curcd == 'F') { document.getElementById('CUSCURCD').classList.add('read'); document.getElementById('SEARCHCURRENCY').classList.add('read'); }
        if(stafcd == 'F') { document.getElementById('STAFFCD').classList.add('read'); document.getElementById('SEARCHSTAFF').classList.add('read'); }
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
        if(customercd == 'F') {  document.getElementById('CUSTOMERCD').classList.add('read');
                                document.getElementById('ESTCUSTEL').classList.add('read');
                                document.getElementById('ESTCUSFAX').classList.add('read');
                                document.getElementById('SEARCHCUSTOMER').classList.add('read'); }
        if(saleorder == 'F') { document.getElementById('SALEORDERNO').classList.add('read'); document.getElementById('SEARCHSALEORDER').classList.add('read'); }
        if(tranrecmdt == 'F') { document.getElementById('SALETRANINSPDT').classList.add('read'); }
        if(commits == 'F') { document.getElementById('COMMIT').disabled = true; }
        if(table == 'F') { document.getElementById('table').classList.add('read');
            document.getElementById('add-row').classList.add('read');
            document.getElementById('delete-row').classList.add('read');
            document.getElementById('DISCRATE').classList.add('read');
            document.getElementById('VATRATE').classList.add('read');
            var readItem = document.getElementsByClassName('item-read');
            for(var i = 0; i < readItem.length; i++) {
                readItem[i].classList.add('read');
            }
        }

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 8); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[256px]');
                tablearea.classList.add('h-[420px]');
                maxrow = 15;
            } else {
                tablearea.classList.remove('h-[420px]');
                tablearea.classList.add('h-[256px]');
                maxrow = 8;
            }
            emptyRows(maxrow);
        });
        
        var index = 0; var id; 
        index = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        // console.log(index);
        $('#add-row').click(function() {
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr id=rowId'+index+'>');
            var cols = '';
            cols += '<td class="row-id text-center text-sm max-w-4 border border-slate-700" id="ROWNO'+index+'" name="ROWNO[]">'+index+'</td>';
            cols += '<td class="text-sm border border-slate-700"><div class="relative z-10">' +
                        '<input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"' +
                        'id="ITEMCD'+index+'" name="ITEMCD[]" onchange="findItemCode(event, '+index+');" onkeyup="findItemCode(event, '+index+');"/>' +
                        '<a class="search-tag absolute top-0 end-0 h-6 py-1.5 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"' +
                            'id="searchitem'+index+'" onclick="searchItemIndex('+index+');">' +
                            '<svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">' +
                                '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>' +
                            '</svg>' +
                        '</a>' +
                    '</div></td>';
            cols += '<td class="text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"'+
                    'id="ITEMNAME'+index+'" name="ITEMNAME[]"/></td>';
            cols += '<td class="text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="SALEQTY'+index+'" name="SALEQTY[]" onchange="calculateamt('+index+'); this.value = num2digit(this.value);" '+
                    'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read"'+
                    'id="ITEMUNITTYP'+index+'" name="ITEMUNITTYP[]" readonly/></td>';
            cols += '<td class="text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="SALEUNITPRC'+index+'" name="SALEUNITPRC[]" onchange="calculateamt('+index+'); this.value = num2digit(this.value);" '+
                    'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="SALEDISCOUNT'+index+'" name="SALEDISCOUNT[] onchange="calculateamt('+index+'); this.value = num2digit(this.value);" '+
                    'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"'+
                    'id="SALEAMT'+index+'" name="SALEAMT[]" readonly/></td>';
            cols += '<td class="hidden"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"'+
                    'id="SALELNNO'+index+'" name="SALELNNO[]"/></td>';
            cols += '<td class="hidden"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read"'+
                    'id="SALELN'+index+'" name="SALELN[]" readonly/></td>';                    
            cols += '<td class="hidden"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"'+
                    'id="SALEORDERQTY'+index+'" name="SALEORDERQTY[]" readonly/></td>';
            cols += '<td class="hidden"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 read"'+
                    'id="SHIPTRANNO'+index+'" name="SHIPTRANNO[]" readonly/></td>';
            cols += '<td class="hidden"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read"'+
                    'id="SHIPTRANLN'+index+'" name="SHIPTRANLN[]" readonly/></td>';
            cols += '<td class="hidden"><input class="read" id="SALEDISCOUNT2'+index+'" name="SALEDISCOUNT2[]" readonly/></td>';
            cols += '<td class="hidden"><input class="read" id="SALELN'+index+'" name="SALELN[]" readonly/></td>';
            cols += '<td class="hidden"><input class="read" id="SALEORDERNOLN'+index+'" name="SALEORDERNOLN[]" readonly/></td>'; 
            cols += '<td class="hidden"><input class="read" id="SALETAXAMT'+index+'" name="SALETAXAMT[]" readonly/></td>';
            cols += '<td class="hidden"><input class="read" id="CUSPONO'+index+'" name="CUSPONO[]" readonly/></td>';
            cols += '<td class="hidden"><input class="read" id="WHTTYP'+index+'" name="WHTTYP[]" readonly/></td>'; 
            cols += '<td class="hidden"><input class="read" id="SALETRANADD31'+index+'" name="SALETRANADD31[]" readonly/></td>';
            cols += '<td class="hidden"><input class="read" id="SALETRANADD32'+index+'" name="SALETRANADD32[]" readonly/></td>';
            cols += '<td class="hidden"><input class="read" id="SALETRANADD33'+index+'" name="SALETRANADD33[]" readonly/></td>'; 
            cols += '<td class="hidden"><input class="read" id="SALETRANADD34'+index+'" name="SALETRANADD34[]" readonly/></td>';         
            cols += '<td class="hidden"><input class="read" id="SALETRANADD35'+index+'" name="SALETRANADD35[]" readonly/></td>'; 

           // console.log($(".row-id").length);
           // console.log($('#rowId'+index+'').closest('tr').attr('id'));
            if(index <= maxrow) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').removeAttr('class', 'row-empty');
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $('table tbody').append(newRow);
            }

            document.getElementById('rowCount').innerHTML = index;

            // ----- call Class search-tag -------//
            searchIcon();
            // -----------------------------------//

            // $(".row-id").each(function (i){
            //    $(this).text(i+1);
            // });
        });
        // Find and remove selected table rows
        $('#delete-row').click(function() {
            // document.getElementById("table").deleteRow(index);
            // console.log(id);
            if(index > 0 && id != null) {
                // let rows = document.getElementsByTagName("tr");
                $('#rowId'+id).closest('tr').remove();
                if(index <= maxrow) {
                    emptyRow(index);
                }
                index --;   // index -= 1;
                $('.row-id').each(function (i) {
                    // console.log(i);
                    // rows[id].id = 'rowId' + index;
                    $(this).text(i+1);
                }); 
                changeRowIds();
                unsetSessionItem(id);
                id = null;
                // console.log(index);
                document.getElementById('rowCount').innerHTML = index;
            }
            keepItemData();
        });


        $(document).on('click', '.sale_table tr', function(event){
            // let rowId = $(this).closest('tr').attr('id');
            // console.log(rowId);
            let item = $(this).closest('tr').children('td');
            id = item.eq(0).text();
            // console.log($(this).closest('tr'));
            let rows = document.getElementsByTagName('tr');
            $('.row-id').each(function (i) {
                rows[i+1].classList.remove('selected-row');
            }); 
            if(id != '') {
                rows[id].classList.add('selected-row'); 
            }
        });

        function changeRowIds() {
            var elem = document.getElementsByTagName('tr');
                for (var i = 0; i < elem.length; i++) {
                // console.log(i);
                if (elem[i].id) {
                    index_x = Number(elem[i].rowIndex);
                    elem[i].id = 'rowId' + index_x;
                }
            }
        }

        function emptyRow(n) {
            $('table tbody').append('<tr class="row-empty" id="rowId'+n+'>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td></tr>');
        }
    }); 

    function findItemCode(event, index) {
        if ((event.type === 'change') || (event.key === 'Enter' || event.keyCode === 13)) {
            if($('#CUSTOMERCD').val() == '' || $('#CUSTOMERCD').val() == 'undefined') {
                document.getElementById('ITEMCD' + index + '').value = '';
                return getMessage('ERRO_NO_CUTOMER');
            } else if($('#CUSCURCD').val() == '' || $('#CUSCURCD').val() == 'undefined') {
                document.getElementById('ITEMCD' + index + '').value = '';
                return getMessage('ERRO_NOCURCD');
            } else {
                keepData();
                return getElementIndex('ITEMCD', $('#ITEMCD'+index+'').val(), index);
            }
        }
    }

    function searchItemIndex(lineIndex) {
        // console.log(lineIndex);
        if($('#CUSTOMERCD').val() == '' || $('#CUSTOMERCD').val() == 'undefined') {
            document.getElementById('ITEMCD' + lineIndex + '').value = '';
            return getMessage('ERRO_NO_CUTOMER');
        } else if($('#CUSCURCD').val() == '' || $('#CUSCURCD').val() == 'undefined') {
            document.getElementById('ITEMCD' + lineIndex + '').value = '';
            return getMessage('ERRO_NOCURCD');
        } else {
            return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ACC_SALEENTRY_THA3&index=' + lineIndex, 'authWindow', 'width=1200,height=600');
        }
    }

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'SALEORDERNO' || code == 'SALETRANNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function HandlePopupItem(result, index) {
        // console.log('result of popup result: ' + result + ' : ' + index);
        return getElementIndex('ITEMCD', result, index);
        // return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEENTRY_THA3/index.php?ITEMCD=' + result +'&index=' + index;
    }

    function commitDialog() {
       return questionDialog(3, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
    }

    function SVprint() {
       return questionDialog(4, '<?=lang('question4')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
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

    function alertValidation() {
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
            }
        });
    }

    function alertError(msg) {
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
    
    function unRequired() {
    
        document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('SALETERM').classList[document.getElementById('SALETERM').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('DIVISIONCD').classList[document.getElementById('DIVISIONCD').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('CUSTOMERCD').classList[document.getElementById('CUSTOMERCD').value !== '' ? 'remove' : 'add']('req');

    }
</script>
</html>
