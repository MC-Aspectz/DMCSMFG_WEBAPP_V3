<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
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
            <input type="hidden" id="maxrow" name="maxrow" value="<?=$maxrow?>">
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="soentrymfg" name="soentrymfg" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="SALEORDERNO_TXT"><?=checklang('SALEORDERNO')?></label>
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
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="INPUT_DATE_TXT"><?=checklang('INPUT_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                               id="SERINPDATE1" name="SERINPDATE1" value="<?=!empty($data['SERINPDATE1']) ? date('Y-m-d', strtotime($data['SERINPDATE1'])) : date('Y-m-d'); ?>"/>
                                               &ensp;→&ensp;
                                        <input type="date" class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                              id="SERINPDATE2" name="SERINPDATE2" value="<?=!empty($data['SERINPDATE2']) ? date('Y-m-d', strtotime($data['SERINPDATE2'])) : date('Y-m-d'); ?>"/>
                                    </div>

                                    <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="CUSTOMERCODE_TXT"><?=checklang('CUSTOMERCODE')?></label>
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
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="PERSON_RESPONSE_TXT"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="SERSTAFFCD" name="SERSTAFFCD" value="<?=isset($data['SERSTAFFCD']) ? $data['SERSTAFFCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTAFFS">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                id="SERSTAFFNAME" name="SERSTAFFNAME" value="<?=isset($data['SERSTAFFNAME']) ? $data['SERSTAFFNAME']: ''; ?>" readonly/>
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
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SALEORDERNO'); ?></span>
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

                        <div class="flex px-4">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="NEW" name="NEW" onclick="clearForm(); $('table#table-search tbody tr').not(this).removeClass('selected-row');"><?=checklang('NEW'); ?></button>
                        </div>

                        <div class="flex px-6 my-2">
                            <div class="right-size flex w-full">
                                <label class="text-color block text-sm font-semibold w-3/12 pl-4 pt-1"><?=checklang('SALEORDERNO')?></label>
                                <div class="relative w-4/12 mx-2">
                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                            id="SALEORDERNO" name="SALEORDERNO" value="" onchange="unRequired();"/>
                                    <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none hidden"
                                        id="SEARCHSALEORDER">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <h5 class="w-5/12 pl-6 pt-1 text-red-500 font-semibold hidden" id="CANCELMSG"><?=checklang('CANCELMSG')?></h5>
                                <input type="hidden" id="LINE" name="LINE" value="">
                            </div>
                        </div>

                        <article class="w-full max-h-[80%] overflow-y-auto px-2">
                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupheader')?></summary>
                                    <div class="right-size w-full">
                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                                            <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                    id="SALEISSUEDT" name="SALEISSUEDT" value="<?=date('Y-m-d')?>"/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('ESTIMATE_NO')?></label>
                                            <div class="relative w-4/12">
                                                <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="ESTNO" name="ESTNO" value=""/>
                                                <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHQUOTE">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
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
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('REFERENCE')?></label>
                                            <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   id="SALECUSMEMO" name="SALECUSMEMO" value=""/>
                                        </div>

                                        <div class="flex mb-1 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                                            <div class="relative w-4/12">
                                                <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="CUSCURCD" name="CUSCURCD" value=""/>
                                                <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                    id="SEARCHCURRENCY">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
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
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('ATTENTION')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="ESTCUSSTAFF" name="ESTCUSSTAFF" value=""/>
                                                </div>
                                            </div>
                                        </details>
                                    </div>

                                    <div class="p-2 align-middle">
                                        <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                            <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('grouprecipient')?></summary>
                                            <div class="right-size w-full">
                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DELI_PLACE')?></label>
                                                    <div class="relative w-4/12">
                                                        <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                                id="DELIVERYCD" name="DELIVERYCD" value=""/>
                                                        <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                            id="SEARCHDELIVERY">
                                                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <input type="text" class="text-control text-[12px] shadow-sm border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                        id="DELIVERYNAME" name="DELIVERYNAME" value="" readonly/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                           id="SALEDLVADDR1" name="SALEDLVADDR1" value="" readonly/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                           id="SALEDLVADDR2" name="SALEDLVADDR2" value="" readonly/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('')?></label>
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                           id="SALEPOSTCODE" name="SALEPOSTCODE" value=""/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DELE_TEL')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="SALEDLVTEL" name="SALEDLVTEL" oninput="this.value = stringReplacez(this.value);" value=""/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DELE_PLACE_STAFF')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="SALEDLVSTAFF" name="SALEDLVSTAFF" value=""/>
                                                </div>    

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('SHIP_VIA')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="SALEDIVCON4" name="SALEDIVCON4" value=""/>
                                                </div>         
                                            </div>
                                        </details>
                                    </div>

                                    <div class="right-size w-full">
                                        <div class="flex mb-1 mx-2 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('REMARKS')?></label>
                                            <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   id="ESTREM1" name="ESTREM1" value=""/>
                                        </div>  

                                        <div class="flex mb-1 mx-2 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('')?></label>
                                            <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   id="ESTREM2" name="ESTREM2" value=""/>
                                        </div>    

                                        <div class="flex mb-1 mx-2 pl-4">
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('')?></label>
                                            <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                   id="ESTREM3" name="ESTREM3" value=""/>
                                        </div>
                                    </div>
                                </details>
                            </div>

                            <div class="p-2 align-middle">
                                <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                    <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupdetail')?></summary>
                                    <div class="p-2 align-middle">
                                        <details class="border-2 border-gray-200 p-2 rounded-xl shadow-sm" open>
                                            <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=lang('groupitem')?></summary>
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
                                                            <th class="px-6 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DUE_DATE')?></span>
                                                            </th>
                                                            <th class="px-6 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELIVERY_DATE')?></span>
                                                            </th>
                                                            <th class="px-20 text-center border border-slate-700">
                                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARKS')?></span>
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
                                                                <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="DUE_DATE_TXT<?=$i?>"></td>
                                                                <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap" id="DELIVERY_DATE_TXT<?=$i?>"></td>
                                                                <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="REMARKS_TXT<?=$i?>"></td>

                                                                <td class="hidden"><input class="hidden" id="ROWNO<?=$i?>" name="ROWNOZ[]" value="">
                                                                <input class="hidden" id="ITEMCD<?=$i?>" name="ITEMCDZ[]" value="">
                                                                <input class="hidden" id="ITEMNAME<?=$i?>" name="ITEMNAMEZ[]" value="">
                                                                <input class="hidden" id="SALELNQTY<?=$i?>" name="SALELNQTYZ[]" value="">
                                                                <input class="hidden" id="ITEMUNITTYP<?=$i?>" name="ITEMUNITTYPZ[]" value="">
                                                                <input class="hidden" id="SALELNUNITPRC<?=$i?>" name="SALELNUNITPRCZ[]" value="">
                                                                <input class="hidden" id="SALELNDISCOUNT<?=$i?>" name="SALELNDISCOUNTZ[]" value="">
                                                                <input class="hidden" id="SALELNAMT<?=$i?>" name="SALELNAMTZ[]" value="">
                                                                <input class="hidden" id="SALELNDUEDT<?=$i?>" name="SALELNDUEDTZ[]" value="">
                                                                <input class="hidden" id="SALELNPLANSHIPDT<?=$i?>" name="SALELNPLANSHIPDTZ[]" value="">
                                                                <input class="hidden" id="SALELNREM<?=$i?>" name="SALELNREMZ[]" value="">
                                                                <input class="hidden" id="SALELNDISCOUNT2<?=$i?>" name="SALELNDISCOUNT2Z[]" value="">
                                                                <input class="hidden" id="SALELNTAXAMT<?=$i?>" name="SALELNTAXAMTZ[]" value=""/>
                                                                <input class="hidden" id="CUSPONO<?=$i?>" name="CUSPONOZ[]" value=""/>
                                                                <input class="hidden" id="SALELNSHIPQTY<?=$i?>" name="SALELNSHIPQTYZ[]" value="">
                                                                <input class="hidden" id="SALELNSHIPREQQTY<?=$i?>" name="SALELNSHIPREQQTYZ[]" value="">
                                                                <input class="hidden" id="SALELNSTATUS<?=$i?>" name="SALELNSTATUSZ[]" value=""></td>
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
                                                    <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                            name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly />
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

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DUE_DATE')?></label>
                                                    <input type="date" class="text-control ctrl-read text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                            id="SALELNDUEDT" name="SALELNDUEDT" value=""/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('DELIVERY_DATE')?></label>
                                                    <input type="date" class="text-control ctrl-read text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                            id="SALELNPLANSHIPDT" name="SALELNPLANSHIPDT" value=""/>
                                                </div>

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('REMARKS')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="SALELNREM" name="SALELNREM" value=""/>
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

                            <div class="flex p-2">
                                <div class="flex w-6/12">
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                            <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                                            id="COMMIT" name="COMMIT"><?=checklang('SAVE'); ?></button>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                            <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_CANCEL'] != 'T') {?> hidden <?php }?>
                                            id="CANCEL" name="CANCEL"><?=checklang('CANCEL'); ?></button>
                                </div>
                                <div class="flex w-6/12 px-1 justify-end">
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                                            id="PRINT" name="PRINT"><?=checklang('PRINT'); ?></button>
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
<!-- <script src="./js/script.js" integrity="sha384-IUGDXqlf+oGRETvGgfMzN+B1HGbm4CGrPLtrLjiC1AD2slApI84jHpKyfFnncjoE" crossorigin="anonymous"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        unRequired(); // calcTotal();
        document.getElementById('PRINT').disabled = true;
        document.getElementById('CANCEL').disabled = true;
        document.getElementById('DELITEM').disabled = true;
        const searchCondition = document.getElementById('search-condition');
        const tablesearcharea = document.getElementById('table-search-area');
        let maxsearchrow = '<?php echo (isset($maxsearchrow) ? $maxsearchrow: 16); ?>';
        searchCondition.addEventListener('toggle', function() {
            if (!searchCondition.open) {
                tablesearcharea.classList.remove('h-[56%]');
                tablesearcharea.classList.add('h-[78%]');
                maxsearchrow = 23;
            } else {
                tablesearcharea.classList.remove('h-[78%]');
                tablesearcharea.classList.add('h-[56%]');
                maxsearchrow = 16;
            }
            emptySearchRows(maxsearchrow);
        });

        $(document).on('click', '.tb-search tbody tr', async function(event) {
            $('table#table-search tbody tr').not(this).removeClass('selected-row');
            let tb_search = document.getElementById('table-search');
            let items = $(this).closest('tr').children('td');
            let rec = items.eq(0).text();
            if(rec != '') {
               // console.log(rec);
                tb_search.rows[rec].classList.toggle('selected-row');
                let SONo = items.eq(1).text();
                clearForm();
                document.getElementById('LINE').value = rec;
                await getElement('SALEORDERNO', SONo);
            }
        });

        $(document).on('click', '.so_table tbody tr', function(event) {
            $('table#table tbody tr').not(this).removeClass('selected-row');
            let tb_sale = document.getElementById('table');
            let item = $(this).closest('tr').children('td');
            let index = item.eq(0).text(); itemEntry();
            if(index != '') { 
                // console.log(index);
                tb_sale.rows[index].classList.toggle('selected-row');
                document.getElementById('ROWNO').value = document.getElementById('ROWNO'+index+'').value;
                document.getElementById('ITEMCD').value = document.getElementById('ITEMCD'+index+'').value;
                document.getElementById('ITEMNAME').value = document.getElementById('ITEMNAME'+index+'').value;
                document.getElementById('SALELNQTY').value = document.getElementById('SALELNQTY'+index+'').value ? num2digits(document.getElementById('SALELNQTY'+index+'').value): '';
                document.getElementById('ITEMUNITTYP').value = document.getElementById('ITEMUNITTYP'+index+'').value;
                document.getElementById('SALELNUNITPRC').value = document.getElementById('SALELNUNITPRC'+index+'').value ? num2digits(document.getElementById('SALELNUNITPRC'+index+'').value): '';
                document.getElementById('SALELNDISCOUNT').value = document.getElementById('SALELNDISCOUNT'+index+'').value ? num2digits(document.getElementById('SALELNDISCOUNT'+index+'').value): '';
                document.getElementById('SALELNAMT').value = document.getElementById('SALELNAMT'+index+'').value ? num2digits(document.getElementById('SALELNAMT'+index+'').value): '';
                document.getElementById('SALELNDUEDT').value = document.getElementById('SALELNDUEDT'+index+'').value ? dateFormat(document.getElementById('SALELNDUEDT'+index+'').value): '';
                document.getElementById('SALELNPLANSHIPDT').value = document.getElementById('SALELNPLANSHIPDT'+index+'').value ? dateFormat(document.getElementById('SALELNPLANSHIPDT'+index+'').value): '';
                document.getElementById('SALELNREM').value = document.getElementById('SALELNREM'+index+'').value;

                document.getElementById('DELITEM').disabled = false;
            }
        });

        SAVEITEM.click(function() {
            if(document.getElementById('ITEMCD').value == '') { return alertDialog('<?=lang('validation2'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>'); }
            let rowcount = $('.row-id').length || 0;
            let maxrowz = document.getElementById('maxrow').value;
            let rowno = document.getElementById('ROWNO').value; 
            let ITEMUNITTYP = document.getElementById('ITEMUNITTYP');
            let ITEMUNITNAME = ITEMUNITTYP.options[ITEMUNITTYP.selectedIndex].text;
            if(!rowno) { rowno = rowcount+1 }
            if(rowno > maxrowz) { return generateSaveItem(rowno, false); }
            // console.log(rowno);
            if(document.getElementById('rowId'+rowno+'')) {
                document.getElementById('rowId'+rowno+'').classList.remove('row-empty');
                document.getElementById('rowId'+rowno+'').classList.add('row-id');  
            }
            $('#LINE_TXT'+rowno+'').html(rowno);
            $('#CODE_TXT'+rowno+'').html(document.getElementById('ITEMCD').value);            
            $('#DESCRIPTION_TXT'+rowno+'').html(document.getElementById('ITEMNAME').value);      
            $('#QUANTITY_TXT'+rowno+'').html(document.getElementById('SALELNQTY').value);      
            $('#UOM_TXT'+rowno+'').html(ITEMUNITNAME);      
            $('#UNIT_PRICE_TXT'+rowno+'').html(document.getElementById('SALELNUNITPRC').value);      
            $('#DISCOUNT_TXT'+rowno+'').html(document.getElementById('SALELNDISCOUNT').value);    
            $('#AMOUNT_TXT'+rowno+'').html(document.getElementById('SALELNAMT').value);   
            $('#DUE_DATE_TXT'+rowno+'').html(document.getElementById('SALELNDUEDT').value);      
            $('#DELIVERY_DATE_TXT'+rowno+'').html(document.getElementById('SALELNPLANSHIPDT').value);   
            $('#REMARKS_TXT'+rowno+'').html(document.getElementById('SALELNREM').value);    

            document.getElementById('ROWNO'+rowno+'').value = rowno;
            document.getElementById('ITEMCD'+rowno+'').value = document.getElementById('ITEMCD').value;
            document.getElementById('ITEMNAME'+rowno+'').value = document.getElementById('ITEMNAME').value;
            document.getElementById('SALELNQTY'+rowno+'').value = document.getElementById('SALELNQTY').value;
            document.getElementById('ITEMUNITTYP'+rowno+'').value = document.getElementById('ITEMUNITTYP').value;
            document.getElementById('SALELNUNITPRC'+rowno+'').value = document.getElementById('SALELNUNITPRC').value;
            document.getElementById('SALELNDISCOUNT'+rowno+'').value = document.getElementById('SALELNDISCOUNT').value;
            document.getElementById('SALELNAMT'+rowno+'').value = document.getElementById('SALELNAMT').value;
            document.getElementById('SALELNDUEDT'+rowno+'').value = document.getElementById('SALELNDUEDT').value ? document.getElementById('SALELNDUEDT').value.replace(',', ''): '';
            document.getElementById('SALELNPLANSHIPDT'+rowno+'').value = document.getElementById('SALELNPLANSHIPDT').value ? document.getElementById('SALELNPLANSHIPDT').value.replace(',', ''): '';
            document.getElementById('SALELNREM'+rowno+'').value = document.getElementById('SALELNREM').value;

            calcTotal();

            $('#rowCount').html($('.row-id').length);

            return itemEntry();
        });

        // Find and remove selected table rows
        DELITEM.click(async function() {

            let rowcount =  $('.row-id').length || 0; // console.log(rowcount);
            if(rowcount == 1) { return emptyRows(1); }
            let itemindex = document.getElementById('ROWNO').value;
            let aftreindex = itemindex - 1;
            let table = document.getElementById('table');
            let tblenght = table.rows.length - 2;
            document.getElementById('table').deleteRow(itemindex);
            await itemEntry();
            generateSaveItem(itemindex, true); 
            // console.log(tblenght);
            if(itemindex == 1) { await $('#table tbody tr:nth-child('+tblenght+')').insertBefore('#table tbody tr:nth-child('+itemindex+')');
            } else { await $('#table tbody tr:nth-child('+tblenght+')').insertAfter('#table tbody tr:nth-child('+aftreindex+')'); }
            await shiftRowTb(itemindex, tblenght);

            $('#rowCount').html($('.row-id').length || 0);

            return calcTotal();
        });
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'SERSONO1' || code == 'SERSONO2') {
            document.getElementById(''+code+'').value = result;
            return false;
        } else {
            return getElement(code, result);
        }
    }

    function actionDialog(msg) {
        if(msg == 'COMMIT') {
            return questionDialog(2, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if(msg == 'CANCEL') {
            if(SALEORDERNO.val() == '' || SALEORDERNO.val() == 'undefined') {
                return getMessage('ERRO_SALEORDERNO');
            } else {
                return questionDialog(3, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>')
            }
        } else if(msg == 'PRINT') {
            if (SALEORDERNO.val() != '' || SALEORDERNO.val() == 'undefined') {
                return questionDialog(4, '<?=lang('question4')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
            }
        } else {
            return alertDialog(msg, '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        }
    }

    function alertValidation(msg) {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }
</script>
</html>
