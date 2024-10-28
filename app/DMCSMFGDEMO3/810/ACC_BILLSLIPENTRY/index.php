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
            <form class="w-full" method="POST" action="" id="accBilling" name="accBilling" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BILL_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="BILLNO" id="BILLNO" value="<?=isset($data['BILLNO']) ? $data['BILLNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHBILLNO">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="w-5/12">
                                            <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?><h5 class="w-4/12 pl-6 pt-1 text-red-500 font-semibold"><?=checklang('CANCELMSG')?></h5><?php } ?>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <label class="w-7/12"></label>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                type="date" id="INPUTDT" name="INPUTDT" value="<?=!empty($data['INPUTDT']) ? date('Y-m-d', strtotime($data['INPUTDT'])) : date('Y-m-d'); ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCD')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CUSTOMERCD" id="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCUSTOMER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CUSCURCD" id="CUSCURCD" value="<?=isset($data['CUSCURCD']) ? $data['CUSCURCD']: ''; ?>"/>
                                            <input class="hidden" type="hidden" name="CUSCURDISP" id="CUSCURDISP" value="<?=isset($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" id="SEARCHCURRENCY"/>
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="flex w-5/12"></div>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTADDR1" id="CUSTADDR1" value="<?=!empty($data['CUSTADDR1']) ? $data['CUSTADDR1']: ''; ?>" readonly/>
                                        <input class="hidden" type="hidden" name="BRANCHKBN" id="BRANCHKBN" value="<?=isset($data['BRANCHKBN']) ? $data['BRANCHKBN']: ''; ?>"/>
                                        <input class="hidden" type="hidden" name="ESTCUSFAX" id="ESTCUSFAX" value="<?=isset($data['ESTCUSFAX']) ? $data['ESTCUSFAX']: ''; ?>"/>
                                        <input class="hidden" type="hidden" name="ESTCUSTEL" id="ESTCUSTEL" value="<?=isset($data['ESTCUSTEL']) ? $data['ESTCUSTEL']: ''; ?>"/>
                                        <input class="hidden" type="hidden" name="ESTCUSSTAFF" id="ESTCUSSTAFF" value="<?=isset($data['ESTCUSSTAFF']) ? $data['ESTCUSSTAFF']: ''; ?>"/>
                                        <input class="hidden" type="hidden" name="SALETERM" id="SALETERM" value="<?=isset($data['SALETERM']) ? $data['SALETERM']: ''; ?>"/>
                                        <input class="hidden" type="hidden" name="TAXID" id="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>"/>
                                        <input class="hidden" type="hidden" name="VATRATE" id="VATRATE" value="<?=isset($data['VATRATE']) ? $data['VATRATE']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="DIVISIONCD" id="DIVISIONCD" value="<?=!empty($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHDIVISION">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="DIVISIONNAME" id="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTADDR2" id="CUSTADDR2" value="<?=isset($data['CUSTADDR2']) ? $data['CUSTADDR2']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INSPDATE')?></label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="P1" id="P1" value="<?=!empty($data['P1']) ? date('Y-m-d', strtotime($data['P1'])): ''; ?>"/>
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center">→</label>
                                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                                type="date" name="P2" id="P2" value="<?=!empty($data['P2']) ? date('Y-m-d', strtotime($data['P2'])): ''; ?>"/>
                                        <div class="flex w-2/12 justify-end">
                                            <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-12/12 py-1 text-center" id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>
                
                <!-- <div class="flex" style="margin-top: -0.5em; margin-bottom: 0.5em;"><div class="w-12/12"><hr style="color: black; border: 1.0px dotted;"></div></div> -->
                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PAYTERM')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                name="BILLSLIPNOTE01" id="BILLSLIPNOTE01" value="<?=!empty($data['BILLSLIPNOTE01']) ? $data['BILLSLIPNOTE01']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ISSUE_DATE')?></label>
                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                type="date" name="BILLSLIPNOTE02" id="BILLSLIPNOTE02" value="<?=!empty($data['BILLSLIPNOTE02']) ? date('Y-m-d', strtotime($data['BILLSLIPNOTE02'])): ''; ?>"/>
                        <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('APPOINTMENTDT')?></label>
                        <input class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                type="date" name="BILLSLIPNOTE03" id="BILLSLIPNOTE03" value="<?=!empty($data['BILLSLIPNOTE03']) ? date('Y-m-d', strtotime($data['BILLSLIPNOTE03'])): ''; ?>"/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REMARK')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                name="BILLSLIPNOTE04" id="BILLSLIPNOTE04" value="<?=!empty($data['BILLSLIPNOTE04']) ? $data['BILLSLIPNOTE04']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUST_STAFF_NAME')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                name="BILLSLIPNOTE05" id="BILLSLIPNOTE05" value="<?=!empty($data['BILLSLIPNOTE05']) ? $data['BILLSLIPNOTE05']: ''; ?>"/>
                        <input class="hidden" type="hidden" name="TTL_NETAMT" id="TTL_NETAMT" value="<?=isset($data['TTL_NETAMT']) ? $data['TTL_NETAMT']: ''; ?>"/>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-scroll mb-1 mx-2">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200">
                        <thead class="w-full bg-gray-100">
                            <tr class="flex w-full divide-x">
                                <th class="w-16 text-center py-2" scope="col">
                                    <input type="hidden" name="CHKALL" value="F"/>
                                    <input class="chkbox" type="checkbox" id="CHKALL" name="CHKALL" value="T" onclick="checkedAll(1);"/>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INVOICE_NO')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INVDATE')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DUEDATE2')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AMOUNT')?></span>
                                </th>
                                <th class="w-24 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AMOUNT')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VAT')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TOTAL')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('W_TAX')?></span>
                                </th>
                                <th class="w-32 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('NET_AMT')?></span>
                                </th>
                                <th class="w-24 text-center py-2" scope="col">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[434px]"><?php
                        if(!empty($data['ITEM']))  {
                            $minrow = count($data['ITEM']);
                            foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="flex w-full p-0 divide-x row-id" id="rowId<?=$key?>">
                                    <td class="h-6 w-16 text-sm text-center">
                                        <input type="hidden" id="CHECKROWH<?=$key?>" name="CHECKROW[]" value="F"/>
                                        <input class="chkbox" type="checkbox" id="CHECKROW<?=$key?>" name="CHECKROW[]" value="T" 
                                                onchange="chked(<?=$key?>);" <?=isset($value['CHECKROW']) && $value['CHECKROW'] == 'T' ? 'checked' : '' ?>/>
                                    </td>
                                    <td class="h-6 w-32 text-sm text-left"><?=isset($value['SALETRANNO']) ? $value['SALETRANNO']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-left"><?=isset($value['SALETRANINSPDT']) ? $value['SALETRANINSPDT']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-left"><?=isset($value['SALELNDUEDT']) ? $value['SALELNDUEDT']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-right"><?=isset($value['SALETRANAMT']) ? $value['SALETRANAMT']: '' ?></td>
                                    <td class="h-6 w-24 text-sm text-center"><?=isset($value['CUSDISP']) ? $value['CUSDISP']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-right"><?=isset($value['AMT']) ? $value['AMT']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-right"><?=isset($value['VAT']) ? $value['VAT']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-right"><?=isset($value['TOTAL']) ? $value['TOTAL']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-right"><?=isset($value['WTAX']) ? $value['WTAX']: '' ?></td>
                                    <td class="h-6 w-32 text-sm text-right"><?=isset($value['NETAMT']) ? $value['NETAMT']: '' ?></td>
                                    <td class="h-6 w-24 text-sm text-center"><?=isset($value['COMDISP']) ? $value['COMDISP']: '' ?></td>

                                    <td class="hidden"><input type="hidden" id="SALETRANNO<?=$key?>" name="SALETRANNO[]" value="<?=isset($value['SALETRANNO']) ? $value['SALETRANNO']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="SALETRANINSPDT<?=$key?>" name="SALETRANINSPDT[]" value="<?=isset($value['SALETRANINSPDT']) ? $value['SALETRANINSPDT']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="SALELNDUEDT<?=$key?>" name="SALELNDUEDT[]" value="<?=isset($value['SALELNDUEDT']) ? $value['SALELNDUEDT']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="SALETRANAMT<?=$key?>" name="SALETRANAMT[]" value="<?=isset($value['SALETRANAMT']) ? $value['SALETRANAMT']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="CUSDISP<?=$key?>" name="CUSDISP[]" value="<?=isset($value['CUSDISP']) ? $value['CUSDISP']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="AMT<?=$key?>" name="AMT[]" value="<?=isset($value['AMT']) ? $value['AMT']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="VAT<?=$key?>" name="VAT[]" value="<?=isset($value['VAT']) ? $value['VAT']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="TOTAL<?=$key?>" name="TOTAL[]" value="<?=isset($value['TOTAL']) ? $value['TOTAL']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="WTAX<?=$key?>" name="WTAX[]" value="<?=isset($value['WTAX']) ? $value['WTAX']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="NETAMT<?=$key?>" name="NETAMT[]" value="<?=isset($value['NETAMT']) ? $value['NETAMT']: '' ?>"/></td>
                                    <td class="hidden"><input type="hidden" id="COMDISP<?=$key?>" name="COMDISP[]" value="<?=isset($value['COMDISP']) ? $value['COMDISP']: '' ?>"/></td>
                                </tr><?php 
                            }
                        }                    
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="flex w-full p-0 divide-x row-empty" id="rowId<?=$i?>">
                                <td class="h-6 w-16 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-24 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-32 py-2"></td>
                                <td class="h-6 w-24 py-2"></td>
                            </tr><?php
                        } ?>
                        </tbody>
                    </table>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>
     
                <div class="flex mx-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="COMMIT" name="COMMIT"<?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>&emsp;
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="CANCEL" name="CANCEL"<?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_CANCEL'] != 'T') {?> hidden <?php }?>><?=checklang('CANCEL'); ?></button>&emsp;
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="PRINT" name="PRINT"><?=checklang('PRINT'); ?></button>
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
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">   
    $(document).ready(function() {
        calculateDVW(); 
        document.getElementById('CANCEL').disabled = true;
        const dvwdetail = document.getElementById('dvwdetail');
        let minrow = '<?php echo (isset($minrow) ? $minrow: 0); ?>';
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        var dataItem = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        let customer = '<?php echo (!empty($data['SYSEN_CUSTOMERCD']) ? $data['SYSEN_CUSTOMERCD']: ''); ?>';
        let cuscurcd = '<?php echo (!empty($data['SYSEN_CUSCURCD']) ? $data['SYSEN_CUSCURCD']: ''); ?>';
        let division = '<?php echo (!empty($data['SYSEN_DIVISIONCD']) ? $data['SYSEN_DIVISIONCD']: ''); ?>';
        let p1 = '<?php echo (!empty($data['SYSEN_P1']) ? $data['SYSEN_P1']: ''); ?>';
        let p2 = '<?php echo (!empty($data['SYSEN_P2']) ? $data['SYSEN_P2']: ''); ?>';
        let dvw = '<?php echo (!empty($data['SYSEN_DVW']) ? $data['SYSEN_DVW']: ''); ?>';
        let commit = '<?php echo (!empty($data['SYSEN_COMMIT']) ? $data['SYSEN_COMMIT']: ''); ?>';
        let search = '<?php echo (!empty($data['SYSEN_SEARCH']) ? $data['SYSEN_SEARCH']: ''); ?>';
        let cancelled = '<?php echo (!empty($data['SYSVIS_CANCELLBL']) ? $data['SYSVIS_CANCELLBL']: ''); ?>';
        let cancel = '<?php echo (isset($data['SYSEN_CANCEL']) ? $data['SYSEN_CANCEL']: 'null'); ?>';
        let print = '<?php echo (isset($data['SYSEN_PRINT']) ? $data['SYSEN_PRINT']: 'F'); ?>';
        let syscommit = '<?php echo (!empty($data['SYSPVL']['SYSVIS_COMMIT']) ? $data['SYSPVL']['SYSVIS_COMMIT']: 'F'); ?>';
        let syscancel = '<?php echo (isset($data['SYSPVL']['SYSVIS_CANCEL']) ? $data['SYSPVL']['SYSVIS_CANCEL']: 'F'); ?>';
        if(cancelled != 'null' && cancelled == 'T') { 
            $('.search-tag').css('pointer-events', 'none');
            $(':checkbox').bind('click', false);
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
            $('#BILLNO').removeAttr('disabled').css('background-color', 'white');
            $('#SEARCHBILLNO').css('pointer-events', 'auto');
        }
        if(syscommit == 'F') { document.getElementById('COMMIT').disabled = true; }
        if(syscancel == 'T') { document.getElementById('CANCEL').disabled = false; }
        if(commit == 'F') { document.getElementById('COMMIT').disabled = true; }
        if(cancel == 'T') { document.getElementById('CANCEL').disabled = false; }
        if(search == 'F') { document.getElementById('SEARCH').disabled = true; }
        if(print == 'F') { document.getElementById('PRINT').disabled = true; }
        if(customer == 'F') { $('#CUSTOMERCD').attr('readonly', true).css('background-color', 'whitesmoke'); $('#SEARCHCUSTOMER').css('pointer-events', 'none');  }
        if(cuscurcd == 'F') { $('#CUSCURCD').attr('readonly', true).css('background-color', 'whitesmoke');  $('#SEARCHCURRENCY').css('pointer-events', 'none'); }
        if(division == 'F') { $('#DIVISIONCD').attr('readonly', true).css('background-color', 'whitesmoke'); $('#SEARCHDIVISION').css('pointer-events', 'none'); }
        if(p1 == 'F') { $('#P1').attr('readonly', true).css('background-color', 'whitesmoke'); }
        if(p2 == 'F') { $('#P2').attr('readonly', true).css('background-color', 'whitesmoke'); }
        if(dvw == 'F') { 
            // $('.table .chkbox').attr('readonly', true).css('background-color', 'whitesmoke');
            $('#table').attr('readonly', true).css('background-color', 'whitesmoke');
            $(":checkbox").bind("click", false);
        }
        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');

            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                if(dvw != 'F') { $(this).attr('id', 'selected-row'); }
            }
        });

        const details = document.querySelector('details');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                dvwdetail.classList.remove('h-[434px]');
                dvwdetail.classList.add('h-[556px]');
                maxrow = 23;
            } else {
                dvwdetail.classList.remove('h-[556px]');
                dvwdetail.classList.add('h-[434px]');
                maxrow = 18;
            }
            emptyRows(maxrow);
        })

        if(BILLNO.val() == '') { // dataItem < 1
            document.getElementById('PRINT').disabled = true;
        }
    });

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        if(code == 'BILLNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function calculateDVW() {
        let item = '<?php echo !empty($data['ITEM']) ? json_encode($data['ITEM']): ''; ?>';
        let totalamt = 0;
        if(item != '') {
            let itemArray = JSON.parse(item);
            $.each(itemArray, function(key, value) {
                // console.log(value);
                totalamt += parseFloat(value.NETAMT.replace(/,/g, '')) || 0;
            });
            $('#TTL_NETAMT').val(totalamt.toFixed(2));
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
                    $('#CHECKROW'+key+'').prop('checked', true);
                    document.getElementById('CHECKROWH'+key+'').disabled = true;
                } else {
                    $('#CHECKROW'+key+'').prop('checked', false);
                    document.getElementById('CHECKROWH'+key+'').disabled = false;
                }
            });
        }
    }

    function chked(index) {
      // console.log(index);
        if (document.getElementById("CHECKROW" + index + "").checked) {
            document.getElementById("CHECKROWH" + index + "").disabled = true;
        } else {
            document.getElementById("CHECKROWH" + index + "").disabled = false;
        }
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            return questionDialog(type, '<?=lang('question3'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 3) {
            return questionDialog(type, '<?=lang('question2'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 4) {
            return questionDialog(type, '<?=lang('question4'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');   
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>