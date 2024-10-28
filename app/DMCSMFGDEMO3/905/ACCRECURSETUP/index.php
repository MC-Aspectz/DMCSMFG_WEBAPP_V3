<?php require_once('./function/index_x.php');?>
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
        <main class="flex flex-1 overflow-y-auto paragraph">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="accRecurSetup" name="accRecurSetup" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1 px-2">
                    <div class="flex w-8/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('RECURCODE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                  name="RECURCD" id="RECURCD" value="<?=isset($data['RECURCD']) ? $data['RECURCD']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHRECUR">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input class="hidden" type="hidden" name="PREFIXJV" id="PREFIXJV" value="<?=isset($data['PREFIXJV']) ? $data['PREFIXJV']: ''; ?>" />
                        <input class="hidden" type="hidden" name="COMCURRENCY" id="COMCURRENCY" value="<?=isset($data['COMCURRENCY']) ? $data['COMCURRENCY']: ''; ?>" />
                        <input class="hidden" type="date" name="INPDATE" id="INPDATE" value="<?=!empty($data['INPDATE']) ? date('Y-m-d', strtotime($data['INPDATE'])): ''; ?>"/>
                        <input class="hidden" type="date" name="ISSUEDATE" id="ISSUEDATE" value="<?=!empty($data['ISSUEDATE']) ? date('Y-m-d', strtotime($data['ISSUEDATE'])): ''; ?>"/>
                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 mr-1 text-left rounded-xl border-gray-300 hidden" id="ACCY" name="ACCY">
                            <option value=""></option>
                            <?php foreach ($yearvalue as $yearkey => $yearitem) { ?>
                                <option value="<?=$yearkey ?>" <?=(isset($data['ACCY']) && $data['ACCY'] == $yearkey) ? 'selected' : '' ?>><?=$yearitem ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-4/12 justify-end">
                        <button type="summit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div> 

                <div class="overflow-scroll block h-[228px] max-h-[315px] px-2"> 
                    <table id="table" class="recur_tb w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-4 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                                </th>
                                <th class="px-4 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DEBIT')?></span>
                                </th>
                                <th class="px-4 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CREDIT')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SECTION1')?></span>
                                </th>
                                <th class="px-4 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PROJECTNO')?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                            if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                                foreach ($data['ITEM'] as $key => $value) { ?>
                                    <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                        <td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD<?=$key?>"><?=isset($value['ROWNO']) ? $value['ROWNO']: '' ?></td>
                                        <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="ACC_CD_TD<?=$key?>"><?=isset($value['ACC_CD']) ? $value['ACC_CD']: '' ?></td>
                                        <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left" id="ACC_NM_TD<?=$key?>"><?=isset($value['ACC_NM']) ? $value['ACC_NM']:'' ?></td>
                                        <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left" id="ACCTRANREMARK_TD<?=$key?>"><?=isset($value['ACCTRANREMARK']) ? $value['ACCTRANREMARK']: '' ?></td>
                                        <td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT1_TD<?=$key?>"><?=isset($value['ACCAMT1']) ? $value['ACCAMT1']: '' ?></td>
                                        <td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT2_TD<?=$key?>"><?=isset($value['ACCAMT2']) ? $value['ACCAMT2']: '' ?></td>
                                        <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="SECTION1_TD<?=$key?>"><?=isset($value['SECTION1']) ? $value['SECTION1']: '' ?></td>
                                        <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="PROJECTNO_TD<?=$key?>"><?=isset($value['PROJECTNO']) ? $value['PROJECTNO']: '' ?></td>
                                        <td class="hidden text-left" id="DC_TYPE_TD<?=$key?>"><?=isset($value['DC_TYPE']) ? $value['DC_TYPE']: '' ?></td>

                                        <td class="hidden"><input type="hidden" id="ROWNO<?=$key?>" name="ROWNOA[]" value="<?=isset($value['ROWNO']) ? $value['ROWNO']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="ACC_CD<?=$key?>" name="ACC_CDA[]" value="<?=isset($value['ACC_CD']) ? $value['ACC_CD']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="ACC_NM<?=$key?>" name="ACC_NMA[]" value="<?=isset($value['ACC_NM']) ? $value['ACC_NM']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="ACCTRANREMARK<?=$key?>" name="ACCTRANREMARKA[]" value="<?=isset($value['ACCTRANREMARK']) ? $value['ACCTRANREMARK']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="ACCAMT1<?=$key?>" name="ACCAMT1A[]" value="<?=isset($value['ACCAMT1']) ? $value['ACCAMT1']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="ACCAMT2<?=$key?>" name="ACCAMT2A[]" value="<?=isset($value['ACCAMT2']) ? $value['ACCAMT2']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="SECTION1<?=$key?>" name="SECTION1A[]" value="<?=isset($value['SECTION1']) ? $value['SECTION1']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="PROJECTNO<?=$key?>" name="PROJECTNOA[]" value="<?=isset($value['PROJECTNO']) ? $value['PROJECTNO']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="DC_TYPE<?=$key?>" name="DC_TYPEA[]" value="<?=isset($value['DC_TYPE']) ? $value['DC_TYPE']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="CURRENCY1<?=$key?>" name="CURRENCY1A[]" value="<?=isset($value['CURRENCY1']) ? $value['CURRENCY1']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="I_CURRENCY<?=$key?>" name="I_CURRENCYA[]" value="<?=isset($value['I_CURRENCY']) ? $value['I_CURRENCY']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="EXRATE<?=$key?>" name="EXRATEA[]" value="<?=isset($value['EXRATE']) ? $value['EXRATE']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="AMT<?=$key?>" name="AMTA[]" value="<?=isset($value['AMT']) ? $value['AMT']: '' ?>"></td>
                                    </tr><?php
                                }
                            }
                            for ($i = $minrow; $i < $maxrow; $i++) { ?>
                                <tr class="divide-y divide-gray-200">
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
                            <tr class="bg-white pointer-events-none">
                                <td class="h-6 px-2" colspan="8"><label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="record"><?=$minrow;?></span></label></td>
                            </tr>
                            <tr class="bg-white pointer-events-none border-b border-slate-300">
                                <td class="h-6" colspan="4"></td>
                                <td class="h-6 text-center" colspan="1"><input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" id="TTL_AMT1" name="TTL_AMT1" value="<?=isset($data['TTL_AMT1']) ? $data['TTL_AMT1'] : '' ?>" readonly/></td>
                                <td class="h-6 text-center" colspan="1"><input class="shadow-md border rounded-xl h-6 py-1 px-2 text-gray-700 border-gray-300 text-right read" id="TTL_AMT2" name="TTL_AMT2" value="<?=isset($data['TTL_AMT2']) ? $data['TTL_AMT2'] : '' ?>" readonly/></td>
                               <td class="h-6" colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1 w-full align-middle" open><!-- open -->
                            <summary class="text-color mx-auto py-2 text-sm font-semibold">
                                <div class="flex my-1">
                                    <div class="flex w-7/12 px-2">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center mr-2"
                                            id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=checklang('OK'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                            id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                            id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                                    </div>
                                    <div class="flex w-5/12 px-2 justify-end">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                            id="ENTRY" name="ENTRY" onclick="entry(); entryUnset();"><?=checklang('ENTRY'); ?></button>
                                    </div>
                                </div>
                            </summary> 
   
                            <div class="flex mb-1 px-2">
                                <label class="text-color block text-sm w-1/12 pt-1"></label>
                                <select class="text-control text-[12px] shadow-md border px-3 h-7 w-2/12 mr-1 text-left rounded-xl border-gray-300" id="DC_TYP" name="DC_TYP" onchange="dc_type();">
                                    <option value=""></option>
                                    <?php foreach ($dctyp as $dc => $dcitem) { ?>
                                        <option value="<?=$dc?>" <?=(isset($data['DC_TYP']) && $data['DC_TYP'] == $dc) ? 'selected' : '' ?>><?=$dcitem ?></option>
                                    <?php } ?>
                                </select>
                                <input class="hidden" name="ROWNO" id="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" readonly/>
                                <div class="w-3/12"></div>
                                <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('DEBIT');?></label>
                                <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('CREDIT');?></label>
                                <div class="w-1/12"></div>
                            </div>        

                            <div class="flex mb-1 px-2">
                                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('ACC_CODE')?></label>
                                <div class="relative w-2/12 mr-1">
                                    <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                            name="ACC_CD" id="ACC_CD" value="<?=isset($data['ACC_CD']) ? $data['ACC_CD']: ''; ?>"/>
                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                        id="SEARCHACCOUNT">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <input type="text" class="text-control text-sm shadow-md border z-20 text-[14px] rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                            name="ACC_NM" id="ACC_NM" value="<?=isset($data['ACC_NM']) ? $data['ACC_NM']: ''; ?>" readonly/>
                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 mr-1 text-gray-700 border-gray-300ml-1 read"
                                            name="ACCAMT1" id="ACCAMT1" value="<?=isset($data['ACCAMT1']) ? $data['ACCAMT1']: ''; ?>" readonly/>
                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 mr-1 text-gray-700 border-gray-300ml-1 read"
                                            name="ACCAMT2" id="ACCAMT2" value="<?=isset($data['ACCAMT2']) ? $data['ACCAMT2']: ''; ?>" readonly/>
                                <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-1/12 text-left rounded-xl border-gray-300 read" id="CURRENCY1" name="CURRENCY1">
                                        <option value=""></option>
                                        <?php foreach ($currencytyp as $curr => $curritem) { ?>
                                            <option value="<?=$curr?>" <?=(isset($data['CURRENCY1']) && $data['CURRENCY1'] == $curr) ? 'selected' : '' ?>><?=$curritem ?></option>
                                        <?php } ?>
                                </select>
                                <input type="hidden" id="ROWCOUNTER" name="ROWCOUNTER" readonly>
                                <input type="hidden" id="DCACCCD" name="DCACCCD" readonly>
                                <input type="hidden" id="ACCTYP" name="ACCTYP" readonly>
                            </div>

                            <div class="flex mb-1 px-2">
                                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('AMOUNT')?></label>
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 text-right"
                                        id="AMT" name="AMT" value="<?=isset($data['AMT']) ? $data['AMT']: ''; ?>"
                                        onchange="this.value = numberWithCommas(parseFloat(this.value).toFixed(2)); dc_type1();"
                                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ this.value = numberWithCommas(parseFloat(this.value).toFixed(2)); dc_type1(); }"
                                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-1/12 mr-1 text-left rounded-xl border-gray-300" id="I_CURRENCY" name="I_CURRENCY" onchange="get_exrate();">
                                        <option value=""></option>
                                        <?php foreach ($currencytyp as $curr => $curritem) { ?>
                                            <option value="<?=$curr?>" <?=(isset($data['I_CURRENCY']) && $data['I_CURRENCY'] == $curr) ? 'selected' : '' ?>><?=$curritem ?></option>
                                        <?php } ?>
                                </select> 
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                        id="EXRATE" name="EXRATE" value="<?=isset($data['EXRATE']) ? $data['EXRATE']: '1.000000'; ?>"
                                        onchange="dc_type1(); this.value = digitFormat(this.value);"
                                        onkeyup="if(event.keyCode == 13 || event.key === 'Enter'){ dc_type1();  this.value = digitFormat(this.value); }"
                                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>   
                                <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('PROJECTNO')?></label>    
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                        id="PROJECTNO" name="PROJECTNO" value="<?=isset($data['PROJECTNO']) ? $data['PROJECTNO']: ''; ?>" />
                            </div>     

                            <div class="flex mb-1 px-2">
                                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('SECTION')?></label>
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300"
                                    name="SECTION1" id="SECTION1" value="<?=isset($data['SECTION1']) ? $data['SECTION1']: ''; ?>"/>
                                <label class="text-color block text-sm w-2/12 pt-1 text-center mx-1"><?=checklang('DESCRIPTION')?></label>  
                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300"
                                    name="ACCTRANREMARK" id="ACCTRANREMARK" value="<?=isset($data['ACCTRANREMARK']) ? $data['ACCTRANREMARK']: ''; ?>"/>
                                      
                            </div>  
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-6/12">
                        <button type="button" id="COMMIT" name="COMMIT" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                            <?php if(!empty($data['SYSPVL']['SYSVIS_COMMIT']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT')?></button>
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
        calculateDVW();
        let rw = '<?php echo (!empty($data['ROWNO']) ? $data['ROWNO']: ''); ?>';
        if(rw != '') {
            document.getElementById("INSERT").disabled = true;
            document.getElementById("UPDATE").disabled = false;
            document.getElementById("DELETE").disabled = false;
        } else {
            document.getElementById("INSERT").disabled = false;
            document.getElementById("UPDATE").disabled = true;
            document.getElementById("DELETE").disabled = true;  
        }

        var index = 0;
        var index = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        // console.log(index);
        INSERT.click(function() {
            if($('#ACC_CD').val() == '' || $('#DC_TYP').val() == '' ) {
                return false;
            }
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr class="tr_border" id="rowId'+index+'">');
            var cols = "";
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD'+index+'">'+index+'</td>';
            cols += '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="ACC_CD_TD'+index+'">'+ $('#ACC_CD').val() +'</td>';
            cols += '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left" id="ACC_NM_TD'+index+'">'+ $('#ACC_NM').val() +'</td>';
            cols += '<td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left" id="ACCTRANREMARK_TD'+index+'">'+ $('#ACCTRANREMARK').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT1_TD'+index+'">'+ $('#ACCAMT1').val() +'</td>';
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-right" id="ACCAMT2_TD'+index+'">'+ $('#ACCAMT2').val() +'</td>';
            cols += '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="SECTION1_TD'+index+'">'+ $('#SECTION1').val() +'</td>';
            cols += '<td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left" id="PROJECTNO_TD'+index+'">'+ $('#PROJECTNO').val() +'</td>';
            cols += '<td class="hidden text-left" id="DC_TYPE_TD'+index+'">'+ $('#DC_TYP').val() +'</td>';

            cols += '<td class="hidden"><input type="hidden" id="ROWNO'+index+'" name="ROWNOA[]" value='+index+'></td>';
            cols += '<td class="hidden"><input type="hidden" id="ACC_CD'+index+'" name="ACC_CDA[]" value='+ $('#ACC_CD').val() +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="ACC_NM'+index+'" name="ACC_NMA[]" value='+ $('#ACC_NM').val() +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="ACCTRANREMARK'+index+'" name="ACCTRANREMARKA[]" value='+ $('#ACCTRANREMARK').val() +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="ACCAMT1'+index+'" name="ACCAMT1A[]" value='+ $('#ACCAMT1').val() +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="ACCAMT2'+index+'" name="ACCAMT2A[]" value='+ $('#ACCAMT2').val() +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="SECTION1'+index+'" name="SECTION1A[]" value='+ document.getElementById("SECTION1").value +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="PROJECTNO'+index+'" name="PROJECTNOA[]" value='+ $('#PROJECTNO').val() +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="ADJFLAG'+index+'" name="ADJFLAGA[]" value=""></td>';
            cols += '<td class="hidden"><input type="hidden" id="DC_TYPE'+index+'" name="DC_TYPEA[]" value='+ document.getElementById("DC_TYP").value +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="CURRENCY1'+index+'" name="CURRENCY1A[]" value='+ document.getElementById("CURRENCY1").value +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="I_CURRENCY'+index+'" name="I_CURRENCYA[]" value='+ document.getElementById("I_CURRENCY").value +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="EXRATE'+index+'" name="EXRATEA[]" value='+ $('#EXRATE').val() +'></td>';
            cols += '<td class="hidden"><input type="hidden" id="AMT'+index+'" name="AMTA[]" value='+ $('#AMT').val() +'></td>';

            if(index <= 5) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $('table tbody').append(newRow);
            }
            $('#record').html(index);
            calculateTotal();
            keepItemData();
            entry();
            return entryUnset();
        });

        DELETE.click(function() {
            let id = $('#ROWNO').val();
            if(id != '') {
                // console.log(id);
                document.getElementById('table').deleteRow(id);
                $('#rowId'+id).closest('tr').remove();
                if(index <= 5) {
                    emptyRow(id);
                }
                index--;
                $('.row-id').each(function (i) {
                    $(this).text(i+1);
                }); 
                $('#record').html(index);
                unsetItemData(id);
                changeRowId();
                // calculateTotal();
                id = null;
                entry();
                return entryUnset();
            }
        });

        selectRow();
    });

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
            $('#TTL_AMT1').val(numberWithCommas(accamt1.toFixed(2)));
            $('#TTL_AMT2').val(numberWithCommas(accamt2.toFixed(2)));
        }        
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        if(code == 'RECURCD') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
        
    }

    function actionDialog(type) {
        if(type == 1) {
            //
        } else if(type == 2) {
            //commit
            return questionDialog(2, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');        
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>