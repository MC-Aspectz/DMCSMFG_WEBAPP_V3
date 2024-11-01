<?php require_once('./function/index_x.php');?>
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
            <input type="hidden" id="maxrow" name="maxrow" value="<?=$maxrow?>">
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full mx-2" method="POST" id="quoteentryMFG" name="quoteentryMFG" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false; }">
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
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="ESTIMATE_NO_TXT"><?=checklang('ESTIMATE_NO')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="SERESTNO1" name="SERESTNO1" value="<?=isset($data['SERESTNO1']) ? $data['SERESTNO1']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHQUOTE1">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>&ensp;→&ensp;
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    id="SERESTNO2" name="SERESTNO2" value="<?=isset($data['SERESTNO2']) ? $data['SERESTNO2']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHQUOTE2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-2 pt-1" id="INPUT_DATE_TXT"><?=checklang('QUOTE_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                               id="SERINPDATE1" name="SERINPDATE1" value="<?=!empty($data['SERINPDATE1']) ? date('Y-m-d', strtotime($data['SERINPDATE1'])) : date('Y-m-d'); ?>"/>
                                               &ensp;→&ensp;
                                        <input type="date" class="text-control text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                              id="SERINPDATE2" name="SERINPDATE2" value="<?=!empty($data['SERINPDATE2']) ? date('Y-m-d', strtotime($data['SERINPDATE2'])) : date('Y-m-d'); ?>"/>
                                    </div>

                                    <!-- <div class="flex mb-1">
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
                                    </div> -->

                                    <div class="flex mb-1">
                                        <label class="text-color block text-sm font-normal w-2/12 pr-1 pt-1" id="CUSTOMERCODE_TXT"><?=checklang('CUSTOMERCODE')?></label>
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
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ESTIMATE_NO'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INPUT_DATE'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ESTTMNAME'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELI_PLACE'); ?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700 text-center">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DELE_PLACE_NAME'); ?></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="searchdetail" class="divide-y divide-gray-200"><?php
                                    if(!empty($data['SEARCHITEM'])) { $minsearchrow = count($data['SEARCHITEM']);
                                        foreach($data['SEARCHITEM'] as $key => $value) { ?>
                                        <tr class="divide-y divide-gray-200 cursor-pointer search-id csv" id="searchrow<?=$key?>">
                                            <td class="hidden search-seq"><?=$key ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ESTNO_TD<?=$key?>"><?=isset($value['ESTNO']) ? $value['ESTNO']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="SALEISSUEDT_TD<?=$key?>"><?=isset($value['ESTENTRYDT']) ? $value['ESTENTRYDT']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="CUSTOMERNAME_TD<?=$key?>"><?=isset($value['CUSTOMERNAME']) ? $value['CUSTOMERNAME']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ESTTITLE_TD<?=$key?>"><?=isset($value['ESTTITLE']) ? $value['ESTTITLE']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="DELIVERYCD_TD<?=$key?>"><?=isset($value['DELIVERYCD']) ? $value['DELIVERYCD']: '' ?></td>
                                            <td class="h-6 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="DELIVERYNAME_TD<?=$key?>"><?=isset($value['DELIVERYNAME']) ? $value['DELIVERYNAME']: '' ?></td>
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
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="CLONEQUOTE" name="CLONEQUOTE" onclick=""><?=checklang('CLONE'); ?></button>
                        </div>

                        <div class="flex px-6 my-2">
                            <div class="right-size flex w-full">
                                <label class="text-color block text-sm font-semibold w-3/12 pl-4 pt-1"><?=checklang('ESTIMATE_NO')?></label>
                                <div class="relative w-4/12 mx-2">
                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                            id="ESTNO" name="ESTNO" value=""/>
                                    <a class="search-tag ctrl-read absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none hidden"
                                        id="SEARCHQUOTE">
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
                                            <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('QUOTE_DATE')?></label>
                                            <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                    id="ESTENTRYDT" name="ESTENTRYDT" value="<?=date('Y-m-d')?>"/>
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
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('PRICEVALIDITY')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="ESTDLVCON1" name="ESTDLVCON1" oninput="this.value = stringReplacez(this.value);" value=""/>
                                                    <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-2"><?=checklang('DAYS')?></label>
                                                </div>   

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('PAYMENTTERM')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="ESTDLVCON2" name="ESTDLVCON2" oninput="this.value = stringReplacez(this.value);" value=""/>
                                                    <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-2"><?=checklang('DAYS')?></label>
                                                </div>   

                                                <div class="flex mb-1 pl-4">
                                                    <label class="text-color block text-sm font-normal w-3/12 pr-2 pt-1"><?=checklang('ATTENTION')?></label>
                                                    <input type="text" class="text-control ctrl-read text-sm shadow-sm border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                           id="ESTCUSSTAFF" name="ESTCUSSTAFF" value=""/>
                                                    <input type="hidden" name="SALETERM" id="SALETERM" value="<?=!empty($data['SALETERM']) ? $data['SALETERM']: ''; ?>"/>
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
                                                <table id="table" class="quote_table w-full border-collapse border border-slate-500 divide-gray-200">
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
                                                                <input class="hidden" id="ESTLNQTY<?=$i?>" name="ESTLNQTYZ[]" value="">
                                                                <input class="hidden" id="ITEMUNITTYP<?=$i?>" name="ITEMUNITTYPZ[]" value="">
                                                                <input class="hidden" id="ESTLNUNITPRC<?=$i?>" name="ESTLNUNITPRCZ[]" value="">
                                                                <input class="hidden" id="ESTDISCOUNT<?=$i?>" name="ESTDISCOUNTZ[]" value="">
                                                                <input class="hidden" id="ESTLNAMTDISP<?=$i?>" name="ESTLNAMTDISPZ[]" value="">
                                                                <input class="hidden" id="ESTDISCOUNT2<?=$i?>" name="ESTDISCOUNT2Z[]" value="">
                                                                <input class="hidden" id="ESTLNVAT<?=$i?>" name="ESTLNVATZ[]" value=""></td>
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
<!-- <script src="./js/script.js" integrity="sha384-SnAIFn7crcxbw0u1fDquieu007bDVrqSJ1JXwxPDTDIzhFIgtN9HcnJIIM8cttmq" crossorigin="anonymous"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        unRequired(); // calculateDVW();
        document.getElementById('PRINT').disabled = true;
        document.getElementById('CANCEL').disabled = true;
        document.getElementById('DELITEM').disabled = true;

        let cancelled = '<?php echo (!empty($data['SYSMSG']) ? $data['SYSMSG']: 'null'); ?>';
        if(cancelled != 'null' && cancelled == 'WARN_CANCALEDQUOTE') { 
            $('.search-tag').css('pointer-events', 'none');
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
            $('.table .search-tag').css('pointer-events', 'none');
            $('.table .text-control').attr('readonly', true).css('background-color', 'whitesmoke');
            $('#ESTNO').removeAttr('disabled').css('background-color', 'white');
            $('#SEARCHQUOTE').css('pointer-events', 'auto');
        }

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 8); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[260px]');
                tablearea.classList.add('h-[356px]');
                maxrow = 12;
            } else {
                tablearea.classList.remove('h-[356px]');
                tablearea.classList.add('h-[260px]');
                maxrow = 8;
            }
            emptyRows(maxrow);
        })

        var index = 0; var id; 
        index = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        // console.log(index);
        $('#add-row').click(function() {
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr id=rowId'+index+'>');
            var cols = '';
            cols += '<td class="row-id text-center text-sm max-w-4 border border-slate-700" id="ROWNO'+index+'" name="ROWNO[]">'+index+'</td>';
            cols += '<td class="max-w-24 text-sm border border-slate-700"><div class="relative z-10">' +
                        '<input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"' +
                        'id="ITEMCD'+index+'" name="ITEMCD[]" onchange="findItemCode(event, '+index+');" onkeyup="findItemCode(event, '+index+');"/>' +
                        '<a class="search-tag absolute top-0 end-0 h-6 py-1.5 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"' +
                            'id="searchitem'+index+'" onclick="searchItemIndex('+index+');">' +
                            '<svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">' +
                                '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>' +
                            '</svg>' +
                        '</a>' +
                    '</div></td>';
            cols += '<td class="max-w-32 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"'+
                    'id="ITEMNAME'+index+'" name="ITEMNAME[]"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="ESTLNQTY'+index+'" name="ESTLNQTY[]" onchange="calculateamt('+index+'); this.value = num2digit(this.value);" '+
                    'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700">' +
                    '<input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read" id="ITEMUNITTYP2'+index+'" name="ITEMUNITTYP2[]" readonly/>' +
                    '<input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read hidden" id="ITEMUNITTYP'+index+'" name="ITEMUNITTYP[]" readonly/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="ESTLNUNITPRC'+index+'" name="ESTLNUNITPRC[]" onchange="calculateamt('+index+'); this.value = num4digit(this.value);" '+
                    'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="ESTDISCOUNT'+index+'" name="ESTDISCOUNT[] onchange="calculateamt('+index+'); this.value = num4digit(this.value);" '+
                    'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"'+
                    'id="ESTLNAMTDISP'+index+'" name="ESTLNAMTDISP[]" readonly/></td>';
            cols += '<td class="hidden"><input class="w-16 read" id="ESTDISCOUNT2'+index+'" name="ESTDISCOUNT2[]" readonly/></td>';
            cols += '<td class="hidden"><input class="w-16 read" id="ESTLNVAT'+index+'" name="ESTLNVAT[]" readonly/></td>';
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
            // $(".row-id").each(function (i) {
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

        $(document).on('click', '.quote_table tr', function(event) {
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
            $('table tbody').append('<tr Class="row-empty" id="rowId'+n+'>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
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
                return itemValidation('<?=lang('ERRO_NO_CUTOMER'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
            } else if($('#CUSCURCD').val() == '' || $('#CUSCURCD').val() == 'undefined') {
                document.getElementById('ITEMCD' + index + '').value = '';
                return itemValidation('<?=lang('ERRO_NOCURCD'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
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
            return itemValidation('<?=lang('ERRO_NO_CUTOMER'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if($('#CUSCURCD').val() == '' || $('#CUSCURCD').val() == 'undefined') {
            document.getElementById('ITEMCD' + lineIndex + '').value = '';
            return itemValidation('<?=lang('ERRO_NOCURCD'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else {
           keepData();
           return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ACC_SALEQUOTEENTRY_MFG&index=' + lineIndex, 'authWindow', 'width=1200,height=600');
        }
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        if(code == 'ESTNO' || code == 'ESTNOCLONE') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function HandlePopupItem(result, index) {
        // console.log('result of popup result: ' + result + ' : ' + index);
        return getElementIndex('ITEMCD', result, index);
        // return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEQUOTEENTRY_MFG/index.php?ITEMCD=' + result +'&index=' + index;
    }

    function commitDialog() {
       return questionDialog(3, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
    }

    function cancelDialog() {    
        if($('#ESTNO').val() == '' || $("#ESTNO").val() == 'undefined') {
            // return itemValidation('<?=lang('ERRO_ESTNO'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
            return alertValidation();
        } else {
            return questionDialog(2, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>')
        }
    }

    function actionDialog(msg) {
        return itemValidation(msg, '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
    }

    function printDialog() {
       return questionDialog(4, '<?=lang('question4')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
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
</script>
</html>
