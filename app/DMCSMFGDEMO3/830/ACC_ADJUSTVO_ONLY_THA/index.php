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
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="adjust_voucher_only" name="adjust_voucher_only" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details id="search-card" class="p-1.5 w-full align-middle"><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('VOUCHER_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="BOOKORDERNO" id="BOOKORDERNO" value="<?=isset($data['BOOKORDERNO']) ? $data['BOOKORDERNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="ACCBOKGUIDE9">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input class="hidden" type="hidden" name="VOUCHERNO" id="VOUCHERNO" value="<?=isset($data['VOUCHERNO']) ? $data['VOUCHERNO']: ''; ?>" />
                                        <div class="w-5/12" id="CANCELLBL">
                                            <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?><h5 class="w-full pl-6 pt-1 text-red-500 font-semibold"><?=checklang('CANCELMSG')?></h5><?php } ?>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <div class="w-3/12"></div>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ACCYEAR')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 mr-4 text-left rounded-xl border-gray-300 read"
                                                id="ACCY" name="ACCY" readonly>
                                                <option value=""></option>
                                                <?php foreach ($yearvalue as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['ACCY']) && $data['ACCY'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                        </select>
                                        <input class="hidden" type="hidden" name="COMCURRENCY" id="COMCURRENCY" value="<?=isset($data['COMCURRENCY']) ? $data['COMCURRENCY']: ''; ?>" />
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('V_ISSUE_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                type="date" id="ISSUEDATE" name="ISSUEDATE" value="<?=!empty($data['ISSUEDATE']) ? date('Y-m-d', strtotime($data['ISSUEDATE'])) : date('Y-m-d'); ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REF_VOUCHER_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="REFBOOKORDERNO" id="REFBOOKORDERNO" value="<?=isset($data['REFBOOKORDERNO']) ? $data['REFBOOKORDERNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="ACCBOKGUIDE91">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input class="hidden" type="hidden" name="REFVOUCHERNO" id="REFVOUCHERNO" value="<?=isset($data['REFVOUCHERNO']) ? $data['REFVOUCHERNO']: ''; ?>" />
                                        <div class="w-5/12"></div>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <div class="w-6/12"></div>
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 text-right"><?=checklang('REF_VOUCHER_DT')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read" id="REFISSUEDATE" name="REFISSUEDATE" value="<?=!empty($data['REFISSUEDATE']) ? date('Y-m-d', strtotime($data['REFISSUEDATE'])) : ''; ?>"/>
                                    </div>
                                </div>         

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INP_STAFF')?></label>
                                        <div class="relative w-4/12 mr-1 read">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                                    name="INP_STFCD" id="INP_STFCD" value="<?=isset($data['INP_STFCD']) ? $data['INP_STFCD']: ''; ?>" readonly/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSTFCD">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="INP_STFNM" id="INP_STFNM" value="<?=isset($data['INP_STFNM']) ? $data['INP_STFNM']: ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('DIVISIONCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="DIVISIONCD" id="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHDIVISION">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="DIVISIONNAME" id="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>
       
                                <div class="flex mb-1">
                                    <div class="flex w-8/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pt-1 mr-5 mr-1"><?=checklang('PARTNER')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 mr-4 text-left rounded-xl border-gray-300"
                                                id="CSSTYPE" name="CSSTYPE">
                                                <option value=""></option>
                                                <?php foreach ($csstyp as $css => $item) { ?>
                                                    <option value="<?=$css ?>" <?=isset($data['CSSTYPE']) && $data['CSSTYPE'] == $css ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                        </select>
                                        <div class="flex w-7/12" id="PARTNER">
                                            <?php if(!empty($data['SYSVIS_STAFFCODE']) && $data['SYSVIS_STAFFCODE'] == 'T') { ?>
                                                <div class="relative w-5/12 mr-1" id="STAFF">
                                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                            name="STAFFCODE" id="STAFFCODE" value="<?=isset($data['STAFFCODE']) ? $data['STAFFCODE']: ''; ?>"/>
                                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                        id="SEARCHSTAFF" onclick="searchPartner();">
                                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read" name="STAFFNAME" id="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                            <?php } else if(!empty($data['SYSVIS_SUPPLIERCD']) && $data['SYSVIS_SUPPLIERCD'] == 'T') { ?>
                                                <div class="relative w-5/12 mr-1" id="SUPPLIER">
                                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                            name="SUPPLIERCD" id="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: ''; ?>"/>
                                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                        id="SEARCHSUPPLIER" onclick="searchPartner();">
                                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read" name="SUPPLIERNAME" id="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>" readonly/>
                                            <?php } else { ?>
                                                <div class="relative w-5/12 mr-1" id="CUSTOMER">
                                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                            name="CUSTOMERCODE" id="CUSTOMERCODE" value="<?=isset($data['CUSTOMERCODE']) ? $data['CUSTOMERCODE']: ''; ?>"/>
                                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                        id="SEARCHCUSTOMER" onclick="searchPartner();">
                                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300 read" name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                            <?php } ?>
                                        </div>
                                        <div class="w-7/12 hidden" id="TPARTNER"></div>
                                    </div>
                                    <div class="flex w-4/12 px-2">
                                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-4/12 mr-4 text-left rounded-xl border-gray-300 read"
                                                id="BRANCHKBN" name="BRANCHKBN" readonly>
                                                <option value=""></option>
                                                <?php foreach ($branchkbn as $bkn => $bknitem) { ?>
                                                    <option value="<?=$bkn ?>" <?=isset($data['BRANCHKBN']) && $data['BRANCHKBN'] == $bkn ? 'selected' : '' ?>><?=$bknitem ?></option>
                                                <?php } ?>
                                        </select>
                                        <input type="text" class="text-control text-[12px] shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="TAXID" id="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                                        <div class="w-8/12 hidden" id="BRANCHTAX"></div>
                                        <div class="flex w-4/12 justify-end">
                                            <!-- <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center" id="SEARCH" name="SEARCH" onclick="getDetail();"><?=checklang('SEARCH')?>
                                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </button> -->
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div id="table-area" class="overflow-scroll block h-[330px]"> 
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 av" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-4 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                                </th>
                                <th class="px-8 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DEBIT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CREDIT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SECTION1')?></span>
                                </th>
                                <th class="px-4 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INVOICENO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ADJFLAG')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) {
                            $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                    <input type="hidden" name="ROWNOA[]" value="<?=isset($value['ROWNO']) ? $value['ROWNO']: '' ?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD<?=$key?>"><?=isset($value['ROWNO']) ? $value['ROWNO']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="ACC_CD_TD<?=$key?>"><?=isset($value['ACC_CD']) ? $value['ACC_CD']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ACC_NM_TD<?=$key?>"><?=isset($value['ACC_NM']) ? $value['ACC_NM']:'' ?></td>
                                    <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left whitespace-nowrap" id="ACCTRANREMARK_TD<?=$key?>"><?=isset($value['ACCTRANREMARK']) ? $value['ACCTRANREMARK']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT1_TD<?=$key?>"><?=isset($value['ACCAMT1']) ? $value['ACCAMT1']: '' ?></td>
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT2_TD<?=$key?>"><?=isset($value['ACCAMT2']) ? $value['ACCAMT2']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="SECTION1_TD<?=$key?>"><?=isset($value['SECTION1']) ? (isset($sectyp[$value['SECTION1']]) ? $sectyp[$value['SECTION1']]: ''): '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="PROJECTNO_TD<?=$key?>"><?=isset($value['PROJECTNO']) ? $value['PROJECTNO']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="ADJFLAG_TD<?=$key?>"><?=isset($value['ADJFLAG']) ? $value['ADJFLAG']: '' ?></td>
                                    <td class="hidden"><?=isset($value['DC_TYPE']) ? $value['DC_TYPE']: '' ?></td>
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
                            </tr> <?php
                        } ?>
                        </tbody>
                        <tfoot class="sticky bottom-0">
                            <tr class="bg-white pointer-events-none border-b border-slate-300">
                                <td class="h-6" colspan="4"></td>
                                <td class="h-6 text-center" colspan="1"><input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                                                            id="TTL_AMT1" name="TTL_AMT1" value="<?=isset($data['TTL_AMT1']) ? $data['TTL_AMT1'] : '' ?>" readonly/></td>
                                <td class="h-6 text-center" colspan="1"><input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" 
                                                                            id="TTL_AMT2" name="TTL_AMT2" value="<?=isset($data['TTL_AMT2']) ? $data['TTL_AMT2'] : '' ?>" readonly/></td>
                               <td class="h-6" colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="flex p-2">
                    <div class="flex w-3/12">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="record"><?=$minrow;?></span></label>
                    </div>
                    <div class="flex w-9/12">
                        <div class="flex w-9/12" id="reason">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REPRINT_REASON')?></label>
                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                id="REPRINTREASON" name="REPRINTREASON" value="<?=isset($data['REPRINTREASON']) ? $data['REPRINTREASON']: ''; ?>"/>
                        </div>
                        <div class="flex w-3/12 justify-end">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                        id="GENERALV" name="GENERALV"><?=checklang('GENERALV'); ?></button>
                            <!-- <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button> -->
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1 w-full align-middle" open><!-- open -->
                            <summary class="text-color mx-auto py-2 text-sm font-semibold"></summary> 
                                <div class="flex my-1 hidden">
                                    <div class="flex w-3/12 px-2"></div>
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pt-1"><?=checklang('RECURCODE')?></label>
                                        <div class="relative w-2/12 mr-2">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                  name="RECURCD" id="RECURCD" value="<?=isset($data['RECURCD']) ? $data['RECURCD']: ''; ?>">
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                              id="SEARCHRECUR">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center mx-2"
                                                id="RE01" name="RE01" onclick="searchRecur();"><?=checklang('CALL'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center mx-2"
                                                id="SAVEREC" name="SAVEREC" onclick="return questionDialog(3, '<?=lang('question5')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('SAVE'); ?></button>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <select class="text-control text-[12px] shadow-md border px-3 h-7 w-1/12 text-left rounded-xl border-gray-300 read"
                                        id="DC_TYPE" name="DC_TYPE" onchange="getAcc();">
                                        <option value=""></option>
                                        <?php foreach ($dctyp as $dc => $dcitem) { ?>
                                            <option value="<?=$dc?>" <?=(isset($data['DC_TYPE']) && $data['DC_TYPE'] == $dc) ? 'selected' : '' ?>><?=$dcitem ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="w-6/12"></div>
                                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('DEBIT')?></label>
                                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('CREDIT')?></label>
                                    <div class="w-1/12"></div>
                                </div>        

                                <div class="flex mb-1 px-2">
                                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('ACC_CODE')?></label>
                                    <div class="relative w-2/12 mr-2 pointer-events-none">
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                              name="ACC_CD" id="ACC_CD" value="<?=isset($data['ACC_CD']) ? $data['ACC_CD']: ''; ?>" readonly/>
                                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                          id="SEARCHACCOUNT">
                                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                        id="ACC_NM" name="ACC_NM" value="<?=isset($data['ACC_NM']) ? $data['ACC_NM']: ''; ?>" readonly/>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 text-right read"
                                        id="ACCAMT1" name="ACCAMT1" value="<?=isset($data['ACCAMT1']) ? $data['ACCAMT1']: ''; ?>" readonly/>
                                    <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 text-right read"
                                        id="ACCAMT2" name="ACCAMT2" value="<?=isset($data['ACCAMT2']) ? $data['ACCAMT2']: ''; ?>" readonly/>
                                    <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-1/12 text-center rounded-xl border-gray-300 read"
                                        id="CURRENCY1" name="CURRENCY1">
                                        <option value=""></option>
                                        <?php foreach ($currencytyp as $curr => $curritem) { ?>
                                            <option value="<?=$curr?>" <?=(isset($data['CURRENCY1']) && $data['CURRENCY1'] == $curr) ? 'selected' : '' ?>><?=$curritem ?></option>
                                        <?php } ?>
                                    </select>
                                </div>     

                                <div class="flex mb-1 px-2">
                                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('AMOUNT')?></label>
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 py-2 px-3 mr-1 w-2/12 text-gray-700 border-gray-300 text-right read" 
                                            id="AMT" name="AMT" value="<?=isset($data['AMT']) ? $data['AMT']: ''; ?>"
                                            onchange="this.value = num2digit(this.value); getAmt();"
                                            onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = num2digit(this.value); getAmt(); }"
                                            oninput="this.value = stringReplacez(this.value);" readonly/>
                                    <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-1/12 mr-1 text-center rounded-xl border-gray-300 read"
                                            id="I_CURRENCY" name="I_CURRENCY" onchange="getExRate();">
                                            <option value=""></option>
                                            <?php foreach ($currencytyp as $curr => $curritem) { ?>
                                                <option value="<?=$curr?>" <?=(isset($data['I_CURRENCY']) && $data['I_CURRENCY'] == $curr) ? 'selected' : '' ?>><?=$curritem ?></option>
                                            <?php } ?>
                                    </select>       
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 text-right read" 
                                            id="EXRATE" name="EXRATE" value="<?=isset($data['EXRATE']) ? $data['EXRATE']: '1.000000'; ?>"
                                            onchange="getAmt(); this.value = dec6digit(this.value);"
                                            onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ getAmt();  this.value = dec6digit(this.value); }"
                                            oninput="this.value = stringReplacez(this.value);" readonly/>
                                    <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('PROJECTNO')?></label>
                                    <input class="hidden" type="text" id="PROJECTNO" name="PROJECTNO" value="<?=isset($data['PROJECTNO']) ? $data['PROJECTNO']: ''; ?>" />
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read" 
                                            id="TAXINVOICENO" name="TAXINVOICENO" value="<?=isset($data['TAXINVOICENO']) ? $data['TAXINVOICENO']: ''; ?>" readonly/>
                                    <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('WHTAXTYP')?></label>    
                                    <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 rounded-xl border-gray-300 read"
                                            id="WHTAXTYP" name="WHTAXTYP" readonly>
                                            <option value=""></option>
                                            <?php foreach ($whtatyp as $wht => $whtitem) { ?>
                                                <option value="<?=$wht?>" <?=(isset($data['WHTAXTYP']) && $data['WHTAXTYP'] == $wht) ? 'selected' : '' ?>><?=$whtitem ?></option>
                                            <?php } ?>
                                    </select>   
                                </div>  

                                <div class="flex mb-1 px-2">
                                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('SECTION')?></label>
                                    <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 mr-1 rounded-xl border-gray-300 read"
                                            id="SECTION1" name="SECTION1">
                                            <option value=""></option>
                                            <?php foreach ($sectyp as $sec => $secitem) { ?>
                                                <option value="<?=$sec?>" <?=(isset($data['SECTION1']) && $data['SECTION1'] == $sec) ? 'selected' : '' ?>><?=$secitem ?></option>
                                            <?php } ?>
                                    </select>   
                                    <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('DESCRIPTION')?></label>
                                    <div class="relative w-6/12 mr-2 pointer-events-none">
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 read"
                                              name="ACCTRANREMARK" id="ACCTRANREMARK" value="<?=isset($data['ACCTRANREMARK']) ? $data['ACCTRANREMARK']: ''; ?>" readonly/>
                                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                            id="SEARCHCDDATA">
                                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center"
                                            id="SAVE" name="SAVE" onclick="return questionDialog(4, '<?=lang('question6')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('SAVE'); ?></button>
                                </div> 
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                        id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                              onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
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
        calculateDVW();
        $('#search-card').attr('open', true); // false
        document.getElementById('reason').style.visibility = 'hidden';
        // document.getElementById('reason').style.display = 'none';
        document.getElementById('RE01').style.visibility = 'hidden';
        document.getElementById('GENERALV').disabled = true;
        document.getElementById('SAVE').disabled = true;
        document.getElementById('SAVEREC').disabled = true;
        // document.getElementById('BRANCHKBN').style.visibility = 'hidden';
        // document.getElementById('TAXID').style.visibility = 'hidden';
        document.getElementById('ACC_CD').classList[ACC_CD.val() != '' ? 'remove' : 'add']('read');
        let reprintreason = '<?php echo (!empty($data['SYSVIS_REPRINTREASON']) ? $data['SYSVIS_REPRINTREASON']: 'null'); ?>';
        let issuedate = '<?php echo (!empty($data['SYSEN_ISSUEDATE']) ? $data['SYSEN_ISSUEDATE']: 'null'); ?>';
        let divisioncd = '<?php echo (!empty($data['SYSEN_DIVISIONCD']) ? $data['SYSEN_DIVISIONCD']: 'null'); ?>';
        let table = '<?php echo (!empty($data['SYSEN_DVWDETAIL']) ? $data['SYSEN_DVWDETAIL']: 'null'); ?>';
        let csstype = '<?php echo (!empty($data['SYSEN_CSSTYPE']) ? $data['SYSEN_CSSTYPE']: 'null'); ?>';
        let sysviscustomer = '<?php echo (isset($data['SYSVIS_CUSTOMERCODE']) ? $data['SYSVIS_CUSTOMERCODE']: 'null'); ?>';
        let sysvisstaff = '<?php echo (isset($data['SYSVIS_STAFFCODE']) ? $data['SYSVIS_STAFFCODE']: 'null'); ?>';
        let sysvissupplier = '<?php echo (isset($data['SYSVIS_SUPPLIERCD']) ? $data['SYSVIS_SUPPLIERCD']: 'null'); ?>';
        let saverec = '<?php echo (isset($data['SYSVIS_SAVEREC']) ? $data['SYSVIS_SAVEREC']: 'null'); ?>';
        let re01 = '<?php echo (isset($data['SYSVIS_RE01']) ? $data['SYSVIS_RE01']: 'null'); ?>';       
        let commits = '<?php echo (isset($data['SYSEN_COMMIT']) ? $data['SYSEN_COMMIT']: 'null'); ?>';
        let kbn = '<?php echo (isset($data['SYSVIS_BRANCHKBN']) ? $data['SYSVIS_BRANCHKBN']: 'null'); ?>';
        let tax = '<?php echo (isset($data['SYSVIS_TAXID']) ? $data['SYSVIS_TAXID']: 'null'); ?>';
        let refbookorderno = '<?php echo (isset($data['SYSEN_REFBOOKORDERNO']) ? $data['SYSEN_REFBOOKORDERNO']: 'null'); ?>';
        let refissuedate = '<?php echo (isset($data['SYSEN_REFISSUEDATE']) ? $data['SYSEN_REFISSUEDATE']: 'null'); ?>';
        if(reprintreason == 'T') { document.getElementById('reason').style.visibility = 'visible'; }
        document.getElementById('ISSUEDATE').classList[issuedate == 'F' ? 'add' : 'remove']('read');
        document.getElementById('DIVISIONCD').classList[divisioncd == 'F' ? 'add' : 'remove']('read');
        document.getElementById('SEARCHDIVISION').classList[divisioncd == 'F' ? 'add' : 'remove']('read');
        document.getElementById('CSSTYPE').classList[csstype == 'F' ? 'add' : 'remove']('read');
        // if(table == 'F') { $('#table td').attr('readonly', true).css('background-color', 'whitesmoke'); }
        if(csstype == 'F') { 
            document.getElementById('CSSTYPE').classList.add('read');
            if(document.getElementById('STAFF')) { document.getElementById('STAFF').classList.add('read'); document.getElementById('STAFFCODE').classList.add('read'); }
            if(document.getElementById('SUPPLIER')) { document.getElementById('SUPPLIER').classList.add('read'); document.getElementById('SUPPLIERCD').classList.add('read'); }
            if(document.getElementById('CUSTOMER')) { document.getElementById('CUSTOMER').classList.add('read'); document.getElementById('CUSTOMERCODE').classList.add('read'); }
            // document.getElementById('PARTNER').style.visibility = 'hidden'; 
        }
        if(sysviscustomer == 'F') { if($('#CSSTYPE').val() === 0 && $('#CSSTYPE').val() != '') { document.getElementById('CUSTOMER').style.visibility = 'hidden'; } }
        if(saverec == 'F') { document.getElementById('SAVEREC').style.visibility = 'hidden'; }
        if(re01 == 'T') { document.getElementById('RE01').style.visibility = 'visible'; }
        if(commits == 'F') { document.getElementById('COMMIT').disabled = true; }
        if($('#BOOKORDERNO').val() != '') { document.getElementById('GENERALV').disabled = false; }
        // if(kbn == 'T') { document.getElementById('BRANCHKBN').style.visibility = 'visible'; }
        // if(tax == 'T') { document.getElementById('TAXID').style.visibility = 'visible'; } 
        document.getElementById('REFBOOKORDERNO').classList[refbookorderno == 'F' ? 'add' : 'remove']('read');
        document.getElementById('ACCBOKGUIDE91').classList[refbookorderno == 'F' ? 'add' : 'remove']('read');   
        document.getElementById('REFISSUEDATE').classList[refissuedate == 'F' ? 'add' : 'remove']('read');  
        selectRow();

        if(sysviscustomer == 'T') {
            document.getElementById('BRANCHKBN').classList.remove('hidden');
            document.getElementById('TAXID').classList.remove('hidden');
            document.getElementById('BRANCHTAX').classList.add('hidden');
        } else if(sysvissupplier == 'T') {
            document.getElementById('BRANCHKBN').classList.remove('hidden');
            document.getElementById('TAXID').classList.remove('hidden');
            document.getElementById('BRANCHTAX').classList.add('hidden');
        } else if(sysvisstaff == 'T') {
            document.getElementById('BRANCHKBN').classList.add('hidden');
            document.getElementById('TAXID').classList.add('hidden');
            document.getElementById('BRANCHTAX').classList.remove('hidden');
        }
        if($('#CSSTYPE').val() == '') {
            document.getElementById('PARTNER').classList.add('hidden');
            document.getElementById('BRANCHKBN').classList.add('hidden');
            document.getElementById('TAXID').classList.add('hidden');
            document.getElementById('TPARTNER').classList.remove('hidden');
        }

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 10); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[330px]');
                tablearea.classList.add('h-[450px]');
                maxrow = 15;
            } else {
                tablearea.classList.remove('h-[450px]');
                tablearea.classList.add('h-[330px]');
                maxrow = 10;
            }
            emptyRows(maxrow);
        });
    });

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        if(code == 'ACC_CD') {
            return getACCCD(result);
        } else if(code == 'RECURCD' || code == 'BOOKORDERNO' || code == 'REFBOOKORDERNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);            
        }
    }

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
            $('#TTL_AMT1').val(num2digit(accamt1));
            $('#TTL_AMT2').val(num2digit(accamt2));
        }        
    }

    function actionDialog(type) {
        if(type == 1) {
            //
        } else if(type == 2) {
            //commit
            return questionDialog(2, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');        
        } else if(type == 3) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if(type == 4) {
            return alertWarning('<?=lang('validation2'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');  
        } else if(type == 5) {
            return alertWarning('<?=lang('validation3'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');  
        } else if(type == 6) {
            return alertWarning('<?=lang('validation4'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else if(type == 7) {
            // success
            return alertWarning('<?=lang('success'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        }
    }
</script>
</html>