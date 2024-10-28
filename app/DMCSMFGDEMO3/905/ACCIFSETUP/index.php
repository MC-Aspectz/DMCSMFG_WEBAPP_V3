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
          <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
          <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
          <form class="w-full" method="POST" id="interfacesetting_acc" name="interfacesetting_acc" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
              <div class="flex mb-1 px-2">
                  <div class="flex w-8/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('OPERATION')?></label>
                    <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300" id="PROCESSTYPS" name="PROCESSTYPS">
                        <option value=""></option>
                        <?php foreach ($processtype as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['PROCESSTYPS']) && $data['PROCESSTYPS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>
                    <div class="w-6/12"></div>
                  </div>
                  <div class="flex w-4/12 justify-end">
                      <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                              id="SEARCH" name="SEARCH" onclick="searchs();"><?=checklang('SEARCH')?> <!-- $lang['search'] -->
                          <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                          </svg>
                      </button>
                  </div>
              </div>   
                            
              <!-- Table -->
              <div class="overflow-scroll mb-1 px-2">
                  <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200">
                      <thead class="w-full bg-gray-100">
                          <tr class="flex w-full divide-x">
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('OPERATION')?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('NAIGAI_TYP')?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CATALOG')?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BOI_TYP')?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AFFILIATE')?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INVCALCTYP')?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$data['DRPLANG']['ONTAX']['T']?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$data['DRPLANG']['DEBITACC'][1]?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$data['DRPLANG']['CREDITACC'][1]?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$data['DRPLANG']['DEBITACC'][2]?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$data['DRPLANG']['CREDITACC'][2]?></span>
                              </th>
                              <th class="w-40 text-center py-2" scope="col">
                                  <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MEMO')?></span>
                              </th>
                          </tr>
                      </thead>
                      <tbody id="dvwdetail" class="flex flex-col overflow-y-scroll w-full h-[240px]"><?php
                      if(!empty($data['ITEM']))  {
                          $minrow = count($data['ITEM']);
                          foreach ($data['ITEM'] as $key => $value) { ?>
                              <tr class="flex w-full p-0 divide-x" id="rowId<?=$key?>">
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['ROWCOUNTER']) ? $value['ROWCOUNTER']: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['PROCESSTYP']) ? $data['DRPLANG']['PROCESS_TYPE'][$value['PROCESSTYP']]: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['NAIGAITYP']) ? $data['DRPLANG']['NAIGAI_TYPE'][$value['NAIGAITYP']]: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['ITEMTYPNM']) ? $value['ITEMTYPNM']: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['BOITYP']) ? $data['DRPLANG']['BOI_TYPE'][$value['BOITYP']] : '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['AFFILIATEFLG']) ? (isset($data['DRPLANG']['AFFILIATEFLG'][$value['AFFILIATEFLG']]) ? $data['DRPLANG']['AFFILIATEFLG'][$value['AFFILIATEFLG']]: ''): '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['INVCALCTYP']) ? $data['DRPLANG']['INVCALC_TYPE'][$value['INVCALCTYP']]: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['TAXTYP']) ? $data['DRPLANG']['ACCTAXTYP'][$value['TAXTYP']]: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['DEBITACCCD1']) ? $value['DEBITACCCD1']: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['CREDITACCCD1']) ? $value['CREDITACCCD1']: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['DEBITACCCD2']) ? $value['DEBITACCCD2']: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['CREDITACCCD2']) ? $value['CREDITACCCD2']: '' ?></td>
                                  <td class="h-6 w-40 text-sm pl-1 text-left"><?=isset($value['MEMO']) ? $value['MEMO']: '' ?></td>
                                  <td class="hidden"><?=isset($value['ITEMTYP']) ? $value['ITEMTYP']: '' ?></td>
                                  <td class="hidden"><?=isset($value['DEBITACCNM1']) ? $value['DEBITACCNM1']: '' ?></td>
                                  <td class="hidden"><?=isset($value['CREDITACCNM1']) ? $value['CREDITACCNM1']: '' ?></td>
                                  <td class="hidden"><?=isset($value['DEBITACCNM2']) ? $value['DEBITACCNM2']: '' ?></td>
                                  <td class="hidden"><?=isset($value['CREDITACCNM2']) ? $value['CREDITACCNM2']: '' ?></td>
                                  <td class="hidden"><?=isset($value['PROCESSTYP']) ? $value['PROCESSTYP']: '' ?></td>
                                  <td class="hidden"><?=isset($value['NAIGAITYP']) ? $value['NAIGAITYP']: '' ?></td>
                                  <td class="hidden"><?=isset($value['BOITYP']) ? $value['BOITYP']: '' ?></td>
                                  <td class="hidden"><?=isset($value['INVCALCTYP']) ? $value['INVCALCTYP']: '' ?></td>
                                  <td class="hidden"><?=isset($value['TAXTYP']) ? $value['TAXTYP']: '' ?></td>
                                  <td class="hidden"><?=isset($value['KEYDATA']) ? $value['KEYDATA']: '' ?></td>
                                  <td class="hidden"><?=isset($value['AFFILIATEFLG']) ? $value['AFFILIATEFLG']: '' ?></td>
                              </tr><?php 
                          }
                          for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                              <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>"><?php
                                  for($x = 1; $x <= 13; $x++) { ?>
                                  <td class="h-6 w-40 py-2"></td><?php
                                  } ?>
                              </tr><?php 
                          }
                      } else {                            
                          for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                              <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>"><?php
                                  for($x = 1; $x <= 13; $x++) { ?>
                                  <td class="h-6 w-40 py-2"></td><?php
                                  } ?>
                              </tr><?php
                          }
                      } ?>
                      </tbody>
                  </table>
                  <div class="flex p-2">
                      <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                  </div>
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
                                  <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1r mr-2 text-cente"
                                      id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=checklang('INSERT'); ?></button>
                                  <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 mr-2 text-center"
                                      id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                  <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 mr-2 text-center"
                                      id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                              </div>
                              <div class="flex w-5/12 px-2 justify-end">
                                  <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center"
                                      id="COPY" name="COPY" onclick="copys();"><?=checklang('COPY'); ?></button>&emsp;
                                  <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center"
                                      id="ENTRY" name="ENTRY" onclick="entrys();"><?=checklang('ENTRY'); ?></button>
                              </div>
                          </div>
                        </summary> 

                        <div class="flex mb-1">
                          <div class="flex w-6/12 px-2">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CATALOG')?></label>
                            <div class="relative w-3/12 mr-1">
                                <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                        name="ITEMTYP" id="ITEMTYP" value="<?=isset($data['ITEMTYP']) ? $data['ITEMTYP']: ''; ?>" onchange="unRequired();" required/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="SEARCHACCIFCD">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input type="text" class="text-control text-sm shadow-md border z-20 text-[14px] rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                  name="ITEMTYPNM" id="ITEMTYPNM" value="<?=isset($data['ITEMTYPNM']) ? $data['ITEMTYPNM']: ''; ?>" readonly/>
                          </div>
                          <div class="flex w-6/12 px-2">
                              <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('OPERATION')?></label>
                              <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300 req" id="PROCESSTYPSS" name="PROCESSTYPSS" onchange="unRequired();">
                                  <option value=""></option>
                                  <?php foreach ($processtype as $key => $item) { ?>
                                      <option value="<?=$key ?>" <?=(isset($data['PROCESSTYPSS']) && $data['PROCESSTYPSS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                  <?php } ?>
                              </select>
                              <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('NAIGAI_TYP')?></label>
                              <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 req" id="NAIGAITYPS" name="NAIGAITYPS" onchange="unRequired();">
                                  <option value=""></option>
                                  <?php foreach ($naigaitype as $key => $item) { ?>
                                      <option value="<?=$key ?>" <?=(isset($data['NAIGAITYPS']) && $data['NAIGAITYPS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                        </div>

                        <div class="flex mb-1">
                          <div class="flex w-6/12 px-2">
                              <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BOI_TYP')?></label>
                              <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300 req" id="BOITYPS" name="BOITYPS" onchange="unRequired();">
                                  <option value=""></option>
                                  <?php foreach ($boitype as $key => $item) { ?>
                                      <option value="<?=$key ?>" <?=(isset($data['BOITYPS']) && $data['BOITYPS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                  <?php } ?>
                              </select>
                              <div class="w-2/12 text-center pt-1">
                                <input type="hidden" name="AFFILIATEFLG" value="F"/>
                                <input type="checkbox" id="AFFILIATEFLG" name="AFFILIATEFLG" value="T"/>
                              </div>
                              <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('AFFILIATE')?></label>
                          </div>
                          <div class="flex w-6/12 px-2">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVCALCTYP')?></label>
                            <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 mr-1 text-left rounded-xl border-gray-300 req" id="INVCALCTYPS" name="INVCALCTYPS" onchange="unRequired();">
                                <option value=""></option>
                                <?php foreach ($invcalctype as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['INVCALCTYPS']) && $data['INVCALCTYPS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                            </select>
                            <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=$data['DRPLANG']['ONTAX']['T']?></label>
                            <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300" id="TAXTYPS" name="TAXTYPS">
                                <option value=""></option>
                                <?php foreach ($acctaxtype as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(isset($data['TAXTYPS']) && $data['TAXTYPS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="flex mb-1 px-2">
                          <label class="text-color block text-sm w-12/12 pr-2 pt-1"><?=checklang('SPACEISDOMESTIC')?></label>
                        </div>   

                        <div class="flex mb-1">
                          <div class="flex w-6/12 px-2">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DEBITACC_TYP')?></label>
                            <div class="relative w-3/12 mr-1">
                                <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                        name="DEBITACCCD1" id="DEBITACCCD1" value="<?=isset($data['DEBITACCCD1']) ? $data['DEBITACCCD1']: ''; ?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="SEARCHACCOUNT1">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input type="text" class="text-control text-sm shadow-md border z-20 text-[14px] rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                  name="DEBITACCNM1" id="DEBITACCNM1" value="<?=isset($data['DEBITACCNM1']) ? $data['DEBITACCNM1']: ''; ?>" readonly/>
                          </div>
                          <div class="flex w-6/12 px-2">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CRDITACC_TYP')?></label>
                            <div class="relative w-3/12 mr-1">
                                <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                        name="CREDITACCCD1" id="CREDITACCCD1" value="<?=isset($data['CREDITACCCD1']) ? $data['CREDITACCCD1']: ''; ?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="SEARCHACCOUNT3">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input type="text" class="text-control text-sm shadow-md border z-20 text-[14px] rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                  name="CREDITACCNM1" id="CREDITACCNM1" value="<?=isset($data['CREDITACCNM1']) ? $data['CREDITACCNM1']: ''; ?>" readonly/>
                          </div>
                        </div>

                        <div class="flex mb-1">
                          <div class="flex w-6/12 px-2">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DEBITACC_TYP')?></label>
                            <div class="relative w-3/12 mr-1">
                                <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                        name="DEBITACCCD2" id="DEBITACCCD2" value="<?=isset($data['DEBITACCCD2']) ? $data['DEBITACCCD2']: ''; ?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="SEARCHACCOUNT2">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input type="text" class="text-control text-sm shadow-md border z-20 text-[14px] rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                  name="DEBITACCNM2" id="DEBITACCNM2" value="<?=isset($data['DEBITACCNM2']) ? $data['DEBITACCNM2']: ''; ?>" readonly/>
                          </div>
                          <div class="flex w-6/12 px-2">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CRDITACC_TYP')?></label>
                            <div class="relative w-3/12 mr-1">
                                <input type="text" class="text-control text-[14px] shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                        name="CREDITACCCD2" id="CREDITACCCD2" value="<?=isset($data['CREDITACCCD2']) ? $data['CREDITACCCD2']: ''; ?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="SEARCHACCOUNT4">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input type="text" class="text-control text-sm shadow-md border z-20 text-[14px] rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                  name="CREDITACCNM2" id="CREDITACCNM2" value="<?=isset($data['CREDITACCNM2']) ? $data['CREDITACCNM2']: ''; ?>" readonly/>
                          </div>
                        </div>

                        <div class="flex mb-1">
                          <div class="flex w-6/12 px-2">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('MEMO')?></label>
                            <input type="text" class="text-control text-sm shadow-md border z-20 text-[14px] rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                  name="MEMO" id="MEMO" value="<?=isset($data['MEMO']) ? $data['MEMO']: ''; ?>"/>
                            <input class="hidden" type="hidden" id="KEYDATA" name="KEYDATA" value="<?=isset($data['KEYDATA']) ? $data['KEYDATA']: ''; ?>"/>
                          </div>
                          <div class="flex w-6/12 px-2"></div>
                        </div>
                      </details>
                    </div>
                    <!-- End Header -->
                </div>
                <!-- End Card -->
              </div>

            <div class="flex mt-2 px-2">
              <div class="flex w-6/12"></div>
              <div class="flex w-6/12 justify-end">
                  <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                        onclick="unsetSession(this.form)"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                  <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                        onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?=checklang('END'); ?></button>
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
<script type="text/javascript">
  function HandlePopupResult(code, result) {
      // console.log("result of popup is: " + code + ' : ' + result);
      return getSearch(code, result);
  }

  function HandlePopupIndex(result, index) {
      $('#loading').show();
      return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/905/ACCIFSETUP/index.php?ACCCD=' + result +'&index=' + index;
  }

  function validationDialog() {
      return Swal.fire({ 
          title: '',
          text: '<?=$lang['validation1']; ?>',
          // background: '#8ca3a3',
          showCancelButton: false,
          // confirmButtonColor: 'silver',
          // cancelButtonColor: 'silver',
          confirmButtonText:  '<?=$lang['yes']; ?>',
          cancelButtonText: '<?=$lang['nono']; ?>'
          }).then((result) => {
          if (result.isConfirmed) {}
      });
  }

</script>
</html>
