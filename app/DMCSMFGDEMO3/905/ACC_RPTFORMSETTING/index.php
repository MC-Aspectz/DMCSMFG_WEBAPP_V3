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
            <form class="w-full" method="POST" action="" id="AccRPTFormSetting" name="AccRPTFormSetting" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('RPTFORM_TYP')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300 req" id="RPTFORMTYP" name="RPTFORMTYP" onchange="unRequired();" required>
                            <option value=""></option>
                            <?php foreach ($rptform as $rptkey => $rptitem) { ?>
                                <option value="<?=$rptkey ?>" <?=(isset($data['RPTFORMTYP']) && $data['RPTFORMTYP'] == $rptkey) ? 'selected' : '' ?>><?=$rptitem ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="SEARCH" name="SEARCH" onclick="onSearch();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-7/12 px-2">
                        <div class="flex-col w-full">
                            <div class="overflow-scroll block h-[310px] max-h-[310px]"> 
                                <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                                    <thead class="sticky top-0 bg-gray-50">
                                        <tr class="border border-gray-600">
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ROWNO')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LEVEL')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINEFLG')?></span>
                                            </th>
                                            <th class="px-3 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ZEROFLG')?></span>
                                            </th>
                                            <th class="px-10 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RPTTEXT1')?></span>
                                            </th>
                                            <th class="px-10 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('RPTTEXT2')?></span>
                                            </th>
                                            <th class="px-6 text-center border border-slate-700">
                                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('TEXTALIGNE')?></span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                                    if(!empty($data['ITEM'])) {
                                        $minrow = count($data['ITEM']);
                                        foreach ($data['ITEM'] as $key => $value) { ?>
                                            <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['FORMROWNUM']) ? $value['FORMROWNUM']: '' ?></td>
                                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-right"><?=isset($value['FORMLEVEL']) ? $value['FORMLEVEL']: '' ?></td>
                                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=isset($value['FORMLINEFLG']) ? $value['FORMLINEFLG']:'' ?></td>
                                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?=isset($value['FORMZEROFLG']) ? $value['FORMZEROFLG']: '' ?></td>
                                                <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['FORMTEXT1']) ? $value['FORMTEXT1']: '' ?></td>
                                                <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['FORMTEXT2']) ? $value['FORMTEXT2']: '' ?></td>
                                                <td class="h-6 w-2/12 text-sm border border-slate-700 text-center"><?=isset($value['FORMTEXTAL']) ? $value['FORMTEXTAL']: '' ?></td>
                                                <input type="hidden" name="FORMROWNUMA" value="<?=isset($value['FORMROWNUM']) ? $value['FORMROWNUM']: '' ?>">
                                                <input type="hidden" name="FORMLEVELA" value="<?=isset($value['FORMLEVEL']) ? $value['FORMLEVEL']: '' ?>">
                                                <input type="hidden" name="FORMLINEFLGA" value="<?=isset($value['FORMLINEFLG']) ? $value['FORMLINEFLG']: '' ?>">
                                                <input type="hidden" name="FORMZEROFLGA" value="<?=isset($value['FORMZEROFLG']) ? $value['FORMZEROFLG']: '' ?>">
                                                <input type="hidden" name="FORMTEXT1A" value="<?=isset($value['FORMTEXT1']) ? $value['FORMTEXT1']: '' ?>">
                                                <input type="hidden" name="FORMTEXT2A" value="<?=isset($value['FORMTEXT2']) ? $value['FORMTEXT2']: '' ?>">
                                                <input type="hidden" name="FORMTEXTALA" value="<?=isset($value['FORMTEXTAL']) ? $value['FORMTEXTAL']: '' ?>">

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
                                            </tr> <?php
                                        } ?>
                                    </tbody>
                                    <tfoot class="sticky bottom-0">
                                        <tr class="pointer-events-none">
                                            <td class="text-color h-6 text-[12px]" colspan="11"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="record" ><?=$minrow; ?></span></td>
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
                                        <summary class="text-color mx-auto py-2 text-sm font-semibold"></summary> 
                                        <div class="flex my-1">
                                            <div class="flex w-7/12 px-2">
                                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center mr-2"
                                                  id="INS" name="INS" <?php if(!empty($data['SYSVIS_INS']) && $data['SYSVIS_INS'] != 'T') {?> hidden <?php }?>><?=checklang('INSERT'); ?></button>
                                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                                  id="UPD" name="UPD" <?php if(!empty($data['SYSVIS_UPD']) && $data['SYSVIS_UPD'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                                  id="DEL" name="DEL" <?php if(!empty($data['SYSVIS_DEL']) && $data['SYSVIS_DEL'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                                            </div>
                                            <div class="flex w-5/12 px-2 justify-end">
                                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                                  id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                                            </div>
                                        </div> 

                                        <div class="flex mb-1">
                                            <div class="flex w-full px-2">
                                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ROWNO')?></label>
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-2 py-2 px-3 text-gray-700 border-gray-300 req"
                                                        name="FORMROWNUM" id="FORMROWNUM" value="<?=isset($data['FORMROWNUM']) ? $data['FORMROWNUM']: ''; ?>" onchange="unRequired();"/>
                                                <input type="checkbox" id="FORMLINEFLG" name="FORMLINEFLG" value="T" <?php echo (isset($data['FORMLINEFLG']) && $data['FORMLINEFLG'] == 'T') ? 'checked' : '' ?>/>
                                                <input type="hidden" name="FORMLINEFLG" value="F"/>
                                                <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('LINEFLG'); ?></label>
                                            </div>
                                        </div>

                                        <div class="flex mb-1">
                                            <div class="flex w-full px-2">
                                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('LEVEL')?></label>
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-2 py-2 px-3 text-gray-700 border-gray-300"
                                                        name="FORMLEVEL" id="FORMLEVEL" value="<?=isset($data['FORMLEVEL']) ? $data['FORMLEVEL']: ''; ?>"/>
                                                <input type="checkbox" id="FORMZEROFLG" name="FORMZEROFLG" value="T" <?php echo (isset($data['FORMZEROFLG']) && $data['FORMZEROFLG'] == 'T') ? 'checked' : '' ?>/>
                                                <input type="hidden" name="FORMZEROFLG" value="F"/>
                                                <label class="text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('ZEROFLG'); ?></label>
                                            </div>
                                        </div>

                                        <div class="flex mb-1">
                                            <div class="flex w-full px-2">
                                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('RPTTEXT1')?></label>
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-8/12 mr-2 py-2 px-3 text-gray-700 border-gray-300 req"
                                                        name="FORMTEXT1" id="FORMTEXT1" value="<?=isset($data['FORMTEXT1']) ? $data['FORMTEXT1']: ''; ?>" onchange="unRequired();"/>
                                                <div class="w-2/12"></div>
                                            </div>
                                        </div>

                                        <div class="flex mb-1">
                                            <div class="flex w-full px-2">
                                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('RPTTEXT2')?></label>
                                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-8/12 mr-2 py-2 px-3 text-gray-700 border-gray-300"
                                                        name="FORMTEXT2" id="FORMTEXT2" value="<?=isset($data['FORMTEXT2']) ? $data['FORMTEXT2']: ''; ?>"/>
                                                <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300" id="FORMTEXTAL" name="FORMTEXTAL">
                                                        <option value=""></option>
                                                        <?php foreach ($textaligne as $alignkey => $alignitem) { ?>
                                                            <option value="<?=$alignkey ?>" <?=(isset($data['FORMTEXTAL']) && $data['FORMTEXTAL'] == $alignkey) ? 'selected' : '' ?>><?=$alignitem ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        </details>
                                    </div>
                                    <!-- End Header -->
                                </div>
                                <!-- End Card -->
                            </div>
                        </div>
                    </div>
                    <div class="flex w-5/12 px-2">
                        <div class="flex-col w-full">
                            <div class="overflow-scroll block h-[310px] max-h-[310px]"> 
                                <table id="table_acc" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                                  <thead class="sticky top-0 bg-gray-50">
                                    <tr class="border border-gray-600">
                                        <th class="px-3 text-center border border-slate-700">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CALC_TYP')?></span>
                                        </th>
                                        <th class="px-6 text-center border border-slate-700">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_CODE')?></span>
                                        </th>
                                        <th class="px-14 text-center border border-slate-700">
                                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ACC_NAACC_NAMEME')?></span>
                                        </th>
                                      </tr>
                                    </thead>
                                    <tbody id="dvwdetail2" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                                    if(!empty($data['ITEMACC'])) {
                                        // print_r($data['ITEMACC']);
                                        $minrowB = count($data['ITEMACC']);
                                        foreach ($data['ITEMACC'] as $key => $value) { ?>
                                        <tr class="divide-y divide-gray-200" id="rowIdB<?=$key?>">
                                            <td class="h-6 w-1/12 text-sm border border-slate-700 text-center"><?php foreach ($calctyp as $calckey => $calctypitem) { if(isset($value['CALC_TYP']) && $value['CALC_TYP'] == $calckey) { echo $calctypitem; } }?></td>
                                            <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACC_CD']) ? $value['ACC_CD']: '' ?></td>
                                            <td class="h-6 w-6/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($value['ACC_NM']) ? $value['ACC_NM']:'' ?></td>
                                            <td class="hidden"><?=isset($value['ACCSEQ']) ? $value['ACCSEQ']:'' ?></td>
                                            <td class="hidden"><?=isset($value['ACC_NM2']) ? $value['ACC_NM2']:'' ?></td>
                                            <input type="hidden" name="CALC_TYPA" value="<?=isset($value['CALC_TYP']) ? $value['CALC_TYP']: '' ?>">
                                            <input type="hidden" name="ACC_CDA" value="<?=isset($value['ACC_CD']) ? $value['ACC_CD']: '' ?>">
                                            <input type="hidden" name="ACC_NMA" value="<?=isset($value['ACC_NM']) ? $value['ACC_NM']: '' ?>">
                                            <input type="hidden" name="ACCSEQA" value="<?=isset($value['ACCSEQ']) ? $value['ACCSEQ']: '' ?>">
                                            <input type="hidden" name="ACC_NM2A" value="<?=isset($value['ACC_NM2']) ? $value['ACC_NM2']: '' ?>">
                                        </tr><?php
                                        }
                                    }
                                    for ($i = $minrowB+1; $i <= $maxrowB; $i++) { ?>
                                        <tr class="divide-y divide-gray-200" id="rowIdB<?=$i?>">
                                          <td class="h-6 border border-slate-700"></td>
                                          <td class="h-6 border border-slate-700"></td>
                                          <td class="h-6 border border-slate-700"></td>
                                        </tr> <?php
                                    } ?>
                                    </tbody>
                                        <tfoot class="sticky bottom-0">
                                          <tr class="pointer-events-none">
                                            <td class="text-color h-6 text-[12px]" colspan="11"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="record2" ><?=$minrowB; ?></span></td>
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
                                        <summary class="text-color mx-auto py-2 text-sm font-semibold"></summary> 
                                        <div class="flex my-1">
                                            <div class="flex w-7/12 px-2">
                                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center mr-2"
                                                  id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=checklang('INSERT'); ?></button>
                                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                                  id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                                  id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                                            </div>
                                            <div class="flex w-5/12 px-2 justify-end">
                                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 text-center"
                                                  id="ENT" name="ENT" onclick="entryAcc();"><?=checklang('ENTRY'); ?></button>
                                            </div>
                                        </div>

                                        <div class="flex mb-1">
                                            <div class="flex w-full px-2">
                                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('CALC_TYP')?></label>
                                                <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="CALC_TYP" name="CALC_TYP">
                                                    <option value=""></option>
                                                    <?php foreach ($calctyp as $calkey => $calitem) { ?>
                                                        <option value="<?=$calkey ?>" <?=(isset($data['CALC_TYP']) && $data['CALC_TYP'] == $calkey) ? 'selected' : '' ?>><?=$calitem ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="w-7/12"></div>
                                            </div>
                                        </div>   

                                        <div class="flex mb-1">
                                            <div class="flex w-full px-2">
                                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ACC_CODE')?></label>
                                                <div class="relative w-4/12 mr-2">
                                                      <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                              name="ACC_CD" id="ACC_CD" value="<?=isset($data['ACC_CD']) ? $data['ACC_CD']: ''; ?>" onchange="unRequired();"/>
                                                      <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                          id="SEARCHACCOUNT">
                                                          <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                          </svg>
                                                      </a>
                                                </div>
                                                <input type="hidden" id="ACCSEQ" name="ACCSEQ" value="<?=isset($data['ACCSEQ']) ? $data['ACCSEQ']: ''; ?>">
                                                <div class="w-6/12"></div>
                                            </div>
                                        </div>   

                                        <div class="flex mb-1">
                                            <div class="flex w-full px-2">
                                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"></label>
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                        name="ACC_NM" id="ACC_NM" value="<?=isset($data['ACC_NM']) ? $data['ACC_NM']: ''; ?>" readonly/>
                                                <div class="w-2/12"></div>
                                            </div>
                                        </div>   
                                        </details>
                                    </div>
                                    <!-- End Header -->
                                </div>
                                <!-- End Card -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex mt-2">
                    <div class="flex w-6/12"></div>
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
        unRequired();
        document.getElementById('UPD').disabled = true;
        document.getElementById('DEL').disabled = true;
        document.getElementById('UPDATE').disabled = true;
        document.getElementById('DELETE').disabled = true;
        let accseq = '<?php echo (isset($data['ACCSEQ']) ? $data['ACCSEQ']: ''); ?>';
        if(accseq != '') {
            document.getElementById('INSERT').disabled = true;
            document.getElementById('UPDATE').disabled = false;
            document.getElementById('DELETE').disabled = false;
        }

        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');
            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'selected-row');
                $('#FORMROWNUM').val(item.eq(0).text());
                $('#FORMLEVEL').val(item.eq(1).text());
                if(item.eq(2).text() == 'T') { $('#FORMLINEFLG').prop('checked', true);
                } else { $('#FORMLINEFLG').prop('checked', false); }
                if(item.eq(3).text() == 'T') { $('#FORMZEROFLG').prop('checked', true);
                } else { $('#FORMZEROFLG').prop('checked', false); }               
                $('#FORMTEXT1').val(item.eq(4).text());
                $('#FORMTEXT2').val(item.eq(5).text());
                document.getElementById('FORMTEXTAL').value = item.eq(6).text();
                document.getElementById('INS').disabled = true;
                document.getElementById('UPD').disabled = false;
                document.getElementById('DEL').disabled = false;
                getRptFormDtl(item.eq(0).text());
                unRequired();
            }
        })

        $('#table_acc').on('click', 'tr', function(e) { e.preventDefault();
            changeRowId();
            let itemacc = $(this).closest('tr').children('td');
            // console.log($(this));
            // console.log(itemacc.eq(0).text());
            if(itemacc.eq(0).text() != 'undefined' && itemacc.eq(0).text() != '') {
                // console.log(itemacc.eq(0).text());
                $(this).attr('id', 'selected-row');
                // $(this).addClass('clickRow');
                if(itemacc.eq(0).text() == '+') {
                    document.getElementById('CALC_TYP').value = 1;
                } else if(itemacc.eq(0).text() == '-') {
                    document.getElementById('CALC_TYP').value = 2;
                } else {
                    document.getElementById('CALC_TYP').value = 0;
                }
                $('#ACC_CD').val(itemacc.eq(1).text());
                $('#ACC_NM').val(itemacc.eq(2).text());
                $('#ACCSEQ').val(itemacc.eq(3).text());
                document.getElementById('INSERT').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;
                unRequired();
            }
        });
    });

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        return getACCCD(result);
    }

    function unRequired() {
        let RPTTYP = document.getElementById('RPTFORMTYP');
        if(RPTTYP.selectedIndex != 0) {
            RPTTYP.classList.remove('req');
        } else {
            RPTTYP.classList.add('req');
        }

        if($('#FORMROWNUM').val() != '') {
            document.getElementById('FORMROWNUM').classList.remove('req');
        } else {
            document.getElementById('FORMROWNUM').classList.add('req');
        }
        
        if($('#FORMTEXT1').val() != '') {
            document.getElementById('FORMTEXT1').classList.remove('req');
        } else {
            document.getElementById('FORMTEXT1').classList.add('req');
        }

        if($('#ACC_CD').val() != '') {
            document.getElementById('ACC_CD').classList.remove('req');
        } else {
            document.getElementById('ACC_CD').classList.add('req');
        }
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
        }
    }
</script>
</html>