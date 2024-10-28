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
                <form class="w-full" method="POST" id="accPurTaxInfo" name="accPurTaxInfo" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>
                    <div class="flex mb-1">
                        <div class="flex w-8/12 px-1">
                            <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('YEARMONTH'); ?></label>
                            <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300" id="YEAR" name="YEAR">
                            <option value=""></option>
                                <?php foreach ($yearvalue as $yearkey => $yearitem) { ?>
                                    <option value="<?=$yearkey ?>" <?=(isset($data['YEAR']) && $data['YEAR'] == $yearkey) ? 'selected' : '' ?>><?=$yearitem ?></option>
                                <?php } ?>
                            </select>
                            <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 req" id="MONTH" name="MONTH" onchange="unRequired();" required>
                            <option value=""></option>
                                <?php foreach ($monthvalue as $monthkey => $monthitem) { ?>
                                    <option value="<?=$monthkey ?>" <?=(isset($data['MONTH']) && $data['MONTH'] == $monthkey) ? 'selected' : '' ?>><?=$monthitem ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="flex w-4/12 justify-end">
                            <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                    id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div id="table-area" class="overflow-scroll px-2 block h-[336px]">
                        <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 recur_tb" rules="cols" cellpadding="3" cellspacing="1">
                            <thead class="sticky top-0 bg-gray-50">
                                <tr class="border border-gray-600 csv">
                                    <th class="px-2 text-center border border-slate-700"><?=str_repeat('&emsp;', 1); ?></th>
                                    <th class="px-3 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DATE'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAXINVNO'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PV_NO'); ?></span>
                                    </th>
                                    <th class="px-6 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SUPPLIER_NAME'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAX_ID'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BRANCH'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAXABLEAMOUNT'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAXABLEAMT'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TAXEXEMPTAMT'); ?></span>
                                    </th>
                                    <th class="px-10 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VAT'); ?></span>
                                    </th>
                                    <th class="px-3 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TOTAL_AMOUNT'); ?></span>
                                    </th>
                                    <th class="px-6 text-center border border-slate-700" scope="col">
                                        <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARKS'); ?></span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto">
                                <?php if(!empty($data['ITEM'])) {
                                    $minrow = count($data['ITEM']);
                                    foreach ($data['ITEM'] as $key => $value) { ?>
                                        <tr class="divide-y divide-gray-200 row-id csv" id="rowId<?=$key?>">
                                            <td class="h-6 text-sm border border-slate-700 text-center"id="ROWNO_TD<?=$key?>"><?=isset($value['ROWCOUNTER']) ? $value['ROWCOUNTER']: $key ?></td>
                                            <td class="h-6 text-sm border border-slate-700 text-center whitespace-nowrap"><?=isset($value['SUPDT']) ? date_format(date_create($value['SUPDT']),"d/m/Y"): '' ?></td>
                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['SUPNO']) ? $value['SUPNO']:'' ?></td>
                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PVNO']) ? $value['PVNO']:'' ?></td>
                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['CUSTOMERNAME']) ? $value['CUSTOMERNAME']: '' ?></td>
                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['TAXID']) ? $value['TAXID']: '' ?></td>
                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['BRANCH']) ? $value['BRANCH']: '' ?></td>
                                            <td class="h-6 pr-2 text-sm border border-slate-700 text-right"><?=isset($value['TAXABLEAMOUNT']) ? $value['TAXABLEAMOUNT']: '' ?></td>
                                            <td class="h-6 pr-2 text-sm border border-slate-700 text-right"><?=isset($value['AMOUNT']) ? $value['AMOUNT']: '' ?></td>
                                            <td class="h-6 pr-2 text-sm border border-slate-700 text-right"><?=isset($value['AMOUNT2']) ? $value['AMOUNT2']: '' ?></td>
                                            <td class="h-6 pr-2 text-sm border border-slate-700 text-right"><?=isset($value['VATAMOUNT']) ? $value['VATAMOUNT']: '' ?></td>
                                            <td class="h-6 pr-2 text-sm border border-slate-700 text-right"><?=isset($value['TOTALAMT']) ? $value['TOTALAMT']: '' ?></td>
                                            <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['REMARKS']) ? $value['REMARKS']: '' ?></td>

                                            <td class="hidden"><?=isset($value['SUPDT']) ? $value['SUPDT']: '' ?></td>
                                            <td class="hidden"><?=isset($value['CUSTOMERCD']) ? $value['CUSTOMERCD']: '' ?></td>
                                            <td class="hidden"><?=isset($value['SALEDIVCD']) ? $value['SALEDIVCD']: '' ?></td>
                                            <td class="hidden"><?=isset($value['SALEDIVNAME']) ? $value['SALEDIVNAME']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PVDT']) ? $value['PVDT']: '' ?></td>
                                            <td class="hidden"><?=isset($value['STAFFCD']) ? $value['STAFFCD']: '' ?></td>
                                            <td class="hidden"><?=isset($value['STAFFNAME']) ? $value['STAFFNAME']: '' ?></td>
                                            <td class="hidden"><?=isset($value['SVNO']) ? $value['SVNO']: '' ?></td>
                                            <td class="hidden"><?=isset($value['SVDT']) ? $value['SVDT']: '' ?></td>
                                            <td class="hidden"><?=isset($value['VTYPE']) ? $value['VTYPE']: '' ?></td>
                                            <td class="hidden"><?=isset($value['PAYTYPE']) ? $value['PAYTYPE']: '' ?></td>
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
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                
                    <div class="flex flex-col">
                        <!-- Card -->
                        <div class="p-1.5 inline-block align-middle">
                            <!-- Header -->
                            <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                                <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary>  
                                    <div class="flex mb-2 px-2">
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TAXINVNO'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   name="SUPNO" id="SUPNO" value="<?=isset($data['SUPNO']) ? $data['SUPNO']: ''; ?>" readonly/>
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1 text-center"><?=checklang('DATE'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="date" id="SUPDT" name="SUPDT" value="<?=!empty($data['SUPDT']) ? date('Y-m-d', strtotime($data['SUPDT'])): ''; ?>" readonly/>
                                        </div>
                                        <div class="flex w-6/12"></div>
                                    </div>

                                    <div class="flex mb-2 px-2">
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIERCODE'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="text" name="CUSTOMERCD" id="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>" readonly/>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-6/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="text" id="CUSTOMERNAME" name="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                        </div>
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-sm w-2/12 pl-4 pt-1"><?=checklang('TAX_ID'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="text" name="TAXID" id="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 ml-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="text" id="BRANCH" name="BRANCH" value="<?=isset($data['BRANCH']) ? $data['BRANCH']: ''; ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="flex mb-2 px-2">
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE'); ?></label>
                                            <div class="relative w-3/12">
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                        name="SALEDIVCD" id="SALEDIVCD" <?php if(!empty($data['SALEDIVCD'])){ ?> value="<?=$data['SALEDIVCD']; ?>"<?php } else { ?> value="" <?php }?>/>
                                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none pointer-events-none"
                                                    id="SEARCHDIVISION">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 ml-1 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="text" id="SALEDIVNAME" name="SALEDIVNAME" value="<?=isset($data['SALEDIVNAME']) ? $data['SALEDIVNAME']: ''; ?>" readonly/>  
                                        </div>

                                        <div class="flex w-6/12 justify-end">
                                                <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('TAXABLEAMOUNT'); ?></label>
                                                <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                       type="text" name="TTLTAXABLE" id="TTLTAXABLE" value="<?=!empty($data['TTLTAXABLE']) ? $data['TTLTAXABLE']: '0.00'; ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="flex mb-2 px-2">
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PV_NO'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="text" name="PVNO" id="PVNO" value="<?=isset($data['PVNO']) ? $data['PVNO']: ''; ?>" readonly/>
                                            <label class="text-color block text-sm w-3/12 pl-4 pt-1"><?=checklang('DOCUMENT_DATE'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="date" id="PVDT" name="PVDT" value="<?=!empty($data['PVDT']) ? date('Y-m-d', strtotime($data['PVDT'])): ''; ?>" readonly/>
                                        </div>

                                        <div class="flex w-6/12 justify-end">
                                            <label class="text-color block text-sm w-6/12 pl-4 pt-1"><?=checklang('PURTAXREFUNDABLE'); ?></label>
                                            <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('TAXABLEAMT'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                   type="text" name="TTLAMOUNT" id="TTLAMOUNT" value="<?=!empty($data['TTLAMOUNT']) ? $data['TTLAMOUNT']: '0.00'; ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="flex mb-2 px-2">
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('AMOUNT'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                type="text" name="AMOUNT" id="AMOUNT" value="<?=isset($data['AMOUNT']) ? $data['AMOUNT']: ''; ?>" readonly/>
                                            <label class="text-color block text-sm w-3/12 pl-4 pt-1"><?=checklang('TAX_AMT'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                type="text" name="VATAMOUNT" id="VATAMOUNT" value="<?=isset($data['VATAMOUNT']) ? $data['VATAMOUNT']: ''; ?>" readonly/>
                                       
                                        </div>
                                        <div class="flex w-6/12 justify-end">
                                            <label class="text-color block text-sm w-3/12 pl-4 pt-1"><?=checklang('TAXEXEMPTAMT'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                type="text" name="AMOUNT2" id="AMOUNT2" value="<?=isset($data['AMOUNT2']) ? $data['AMOUNT2']: ''; ?>" readonly/>
                                            <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('TAXEXEMPTAMT'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                   type="text" name="TTLAMOUNT2" id="TTLAMOUNT2" value="<?=!empty($data['TTLAMOUNT2']) ? $data['TTLAMOUNT2']: '0.00'; ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="flex mb-2 px-2">
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="text" name="STAFFCD" id="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" readonly/>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 ml-1 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="text" id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                        </div>

                                        <div class="flex w-6/12 justify-end">
                                            <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('VAT'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                type="text" id="TTLVATAMT" name="TTLVATAMT" value="<?=!empty($data['TTLVATAMT']) ? $data['TTLVATAMT']: '0.00'; ?>" readonly/>
                                        </div>
                                    </div>

                                    <div class="flex mb-2 px-2">
                                        <div class="flex w-6/12">
                                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REMARKS'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                   type="text" name="REMARKS" id="REMARKS" value="<?=isset($data['REMARKS']) ? $data['REMARKS']: ''; ?>" readonly/>
                                        </div>
                                
                                        <div class="flex w-6/12 justify-end">
                                            <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('TOTAL_AMOUNT'); ?></label>
                                            <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                   type="text" id="TTLTOTALAMT" name="TTLTOTALAMT" value="<?=!empty($data['TTLTOTALAMT']) ? $data['TTLTOTALAMT']: '0.00'; ?>" readonly/>
                                        </div>
                                    </div>
                                </details>
                            </div>
                            <!-- End Header -->
                        </div>
                        <!-- End Card -->
                    </div>
                
                    <div class="flex my-1 px-2">
                        <div class="flex w-6/12">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="PRINT" name="PRINT"><?=checklang('PRINT'); ?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="CSV" name="CSV"><?=checklang('BTNCSV'); ?></button>
                        </div>

                        <div class="flex w-6/12 justify-end">
                            <button type="reset" id="clear" name="clear" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    onclick="unsetSession(this.form);"><?=checklang('CLEAR')?>
                            </button>
                            <button type="button" id="back" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?>
                            </button>
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
        calculateDVW(); 
        unRequired();
        selectRow();

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 12); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[336px]');
                tablearea.classList.add('h-[600px]');
                maxrow = 23;
            } else {
                tablearea.classList.remove('h-[600px]');
                tablearea.classList.add('h-[336px]');
                maxrow = 12;
            }
            emptyRow(maxrow);
        })
    });

    function unRequired() {
        let month = document.getElementById('MONTH');
        month.classList[month.selectedIndex != 0 ? 'remove' : 'add']('req');
    }

    function calculateDVW() {
        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        let ttltaxable = 0; let ttlamount = 0; let ttlamount2 = 0; let ttlvatat = 0; let ttltotalamt = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            // console.log(paymentArray);
            $.each(itemArray, function(key, value) {
                // console.log(value);
                ttltaxable += parseFloat(value.TAXABLEAMOUNT.replace(/,/g, '')) || 0;
                ttlamount += parseFloat(value.AMOUNT.replace(/,/g, '')) || 0;
                ttlamount2 += parseFloat(value.AMOUNT2.replace(/,/g, '')) || 0;
                ttlvatat += parseFloat(value.VATAMOUNT.replace(/,/g, '')) || 0;
                ttltotalamt += parseFloat(value.TOTALAMT.replace(/,/g, '')) || 0;
            });
            $('#TTLTAXABLE').val(num2digit(ttltaxable));
            $('#TTLAMOUNT').val(num2digit(ttlamount));
            $('#TTLAMOUNT2').val(num2digit(ttlamount2));
            $('#TTLVATAMT').val(num2digit(ttlvatat));
            $('#TTLTOTALAMT').val(num2digit(ttltotalamt));
        }        
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');        
        } else if(type == 2) {
            //print
            return questionDialog(2, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');        
        }  else if(type == 3) {
            // csv
            return questionDialog(3, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');        
        }
    }
</script>
</html>