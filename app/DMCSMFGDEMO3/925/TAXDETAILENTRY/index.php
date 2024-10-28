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
                <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
                <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
                <form class="w-full" method="POST" id="tax_detail_entry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>
                    <div class="flex mt-1 px-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('TAXDETAILTYPE'); ?></label>
                            <select class="text-control shadow-md border mr-1 px-3 h-7 -ml-2 w-5/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                    id="PROCESSTYPE" name="PROCESSTYPE" onchange="unRequired();">
                                <option value=""></option>
                                <?php foreach ($type1 as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['PROCESSTYPE']) && $data['PROCESSTYPE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="flex w-6/12 justify-end">
                            <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                    id="search" name="search" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex mt-1 ml-1">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-1/6 pr-2 pt-1 ml-12"></label>
                            <label class="text-color block text-sm w-3/6 pr-2 pt-1 ml-2"><?=checklang('COUNTRYCD'); ?></label>
                            <label class="text-color block text-sm w-3/6 pr-2 pt-1 ml-2"><?=checklang('STATECD'); ?></label>
                            <label class="text-color block text-sm w-3/6 pr-2 pt-1 ml-2"><?=checklang('CITYCD'); ?></label>
                        </div>
                    
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('CITYNAME'); ?></label>
                        </div>
                    </div>

                    <div class="flex ml-1">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-3"><?=checklang('OWNPLACE'); ?></label>
                            <div class="relative w-4/12 mr-1">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    name="COUNTRYCD" id="COUNTRYCD" value="<?=isset($data['COUNTRYCD']) ? $data['COUNTRYCD']: ''?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="guideindex1">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="relative w-4/12 mr-1">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    name="STATECD" id="STATECD" value="<?=isset($data['STATECD']) ? $data['STATECD']: ''?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="guideindex2">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="relative w-4/12 mr-1">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    name="CITYCD" id="CITYCD" value="<?=isset($data['CITYCD']) ? $data['CITYCD']: ''?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="guideindex3">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    
                        <div class="flex w-6/12">
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" 
                                   type="text" id="CITYNAME" name="CITYNAME" readonly value="<?=isset($data['CITYNAME']) ? $data['CITYNAME']: ''?>"/>
                        </div>
                    </div>

                    <div class="overflow-scroll mb-1 mt-3">
                        <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="search_table">
                            <thead class="w-full bg-gray-100">
                                <tr class="flex w-full divide-x">
                                        <th class="w-2/12 text-center py-2" scope="col"><?=checklang('ROWNO'); ?></th>
                                        <th class="w-2/12 text-center py-2" scope="col"><?=checklang('TAXTYPECD'); ?></th>
                                        <th class="w-5/12 text-center py-2" scope="col"><?=checklang('TAXTYPENAME'); ?></th>
                                        <th class="w-2/12 text-center py-2" scope="col"><?=checklang('TAXKBN'); ?></th>
                                        <th class="w-2/12 text-center py-2" scope="col"><?=checklang('VATRATE'); ?></th>
                                        <th class="w-2/12 text-center py-2" scope="col"><?=checklang('TAXTTL'); ?></th>
                                        <th class="w-2/12 text-center py-2" scope="col"><?=checklang('EFFECTIVE_DATE'); ?></th>
                                        <th class="w-2/12 text-center py-2" scope="col"><?=checklang('EXPIRY_DATE'); ?></th>
                                </tr>
                            </thead>
                            <tbody id="DVWTAXDETAIL" class="flex-none overflow-y-auto w-full h-[240px]">
                                <?php if(!empty($data['TAX'])) { 
                                     for ($i = 1; $i <= count($data['TAX']); $i++) { $minrow = count($data['TAX']);?>
                                        <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left" id="ROWNO_TD<?=$i?>"><?=$i ?></td>
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left" id="TAXTYPECD_TD<?=$i?>"><?=isset($data['TAX'][$i]['TAXTYPECD']) ? $data['TAX'][$i]['TAXTYPECD']: '' ?></td>
                                                <td class="h-6 w-5/12 text-sm pl-1 text-left" id="TAXTYPENAME_TD<?=$i?>"><?=isset($data['TAX'][$i]['TAXTYPENAME']) ? $data['TAX'][$i]['TAXTYPENAME']: '' ?></td>
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left" id="TAXKBN_TD<?=$i?>" style="display: none"><?=isset($data['TAX'][$i]['TAXKBN']) ? $data['TAX'][$i]['TAXKBN']: '' ?></td>                                    
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left" ><?php
                                                if(isset($data['TAX'][$i]['TAXKBN'])){
                                                    foreach ($type2 as $key => $item) { 
                                                            if($key == $data['TAX'][$i]['TAXKBN'])
                                                                {
                                                                    echo($item);
                                                                }
                                                            }                                 
                                                    } ?></td>
                                                <td class="h-6 w-2/12 text-sm pr-1 text-right" id="VATRATE_TD<?=$i?>"><?=isset($data['TAX'][$i]['VATRATE']) ? $data['TAX'][$i]['VATRATE']: '' ?></td>
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left" id="TAXTTL_TD<?=$i?>" style="display: none;"><?=isset($data['TAX'][$i]['TAXTTL']) ? $data['TAX'][$i]['TAXTTL']: '' ?></td>
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left"><?php 
                                                if(isset($data['TAX'][$i]['TAXTTL'])){
                                                    foreach ($type3 as $key => $item) { 
                                                            if($key == $data['TAX'][$i]['TAXTTL'])
                                                                {
                                                                    echo($item);
                                                                }
                                                            }                                 
                                                    } ?></td>
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left" id="TDSTARTDATE_TD<?=$i?>"><?=isset($data['TAX'][$i]['TDSTARTDATE']) ? $data['TAX'][$i]['TDSTARTDATE']: '' ?></td>
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left" id="TDENDDATE_TD<?=$i?>"><?=isset($data['TAX'][$i]['TDENDDATE']) ? $data['TAX'][$i]['TDENDDATE']: '' ?></td>
                                        
                                        <td class="hidden"><input type="hidden" id="ROWNO<?=$i?>" name="ROWNOA[]" value="<?=$i?>"></td>
                                        <td class="hidden"><input type="hidden" id="TAXTYPECD<?=$i?>" name="TAXTYPECDA[]" value="<?=isset($data['TAX'][$i]['TAXTYPECD']) ? $data['TAX'][$i]['TAXTYPECD']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="TAXTYPENAME<?=$i?>" name="TAXTYPENAMEA[]" value="<?=isset($data['TAX'][$i]['TAXTYPENAME']) ? $data['TAX'][$i]['TAXTYPENAME']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="TAXKBN<?=$i?>" name="TAXKBNA[]" value="<?=isset($data['TAX'][$i]['TAXKBN']) ? $data['TAX'][$i]['TAXKBN']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="VATRATE<?=$i?>" name="VATRATEA[]" value="<?=isset($data['TAX'][$i]['VATRATE']) ? $data['TAX'][$i]['VATRATE']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="TAXTTL<?=$k?>" name="TAXTTLA[]" value="<?=isset($data['TAX'][$i]['TAXTTL']) ? $data['TAX'][$i]['TAXTTL']: '' ?>"/></td>
                                        <td class="hidden"><input type="hidden" id="TDSTARTDATE<?=$i?>" name="TDSTARTDATEA[]" value="<?=isset($data['TAX'][$i]['TDSTARTDATE']) ? $data['TAX'][$i]['TDSTARTDATE']: '' ?>"></td>
                                        <td class="hidden"><input type="hidden" id="TDENDDATE<?=$i?>" name="TDENDDATEA[]" value="<?=isset($data['TAX'][$i]['TDENDDATE']) ? $data['TAX'][$i]['TDENDDATE']: '' ?>"></td>
                                 </tr><?php 
                                 } 
                                for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                    <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                                        <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                        <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                        <td class="h-6 w-5/12 text-sm pl-1 text-left"></td>
                                        <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                        <td class="h-6 w-2/12 text-sm pr-1 text-right"></td>
                                        <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                        <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                        <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                    </tr><?php 
                                }
                                } else {
                                    for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                        <tr class="flex w-full p-0 divide-x" id="rowId<?=$i?>">
                                            <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-5/12 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-2/12 text-sm pr-1 text-right"></td>
                                            <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                            <td class="h-6 w-2/12 text-sm pl-1 text-left"></td>
                                        </tr><?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>

                    <div class="flex">
                        <div class="flex w-6/12"></div>
                        <div class="flex w-6/12 justify-end">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="commit" name="commit" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                                    <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['COMMIT']; ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex mt-3">
                        <div class="flex w-6/12">
                            <input class="hidden" name="ROWNO" id="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" readonly/>
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('TAXTYPECD'); ?></label>
                            <div class="relative w-4/12 mr-1">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                    name="TAXTYPECD" id="TAXTYPECD" value="<?=isset($data['TAXTYPECD']) ? $data['TAXTYPECD']: ''?>" onchange="unRequired();"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="guideindex4">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                   type="text" id="TAXTYPENAME" name="TAXTYPENAME" readonly value="<?=isset($data['TAXTYPENAME']) ? $data['TAXTYPENAME']: ''?>"/>
                        </div>
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-4"><?=checklang('EFFECTIVE_DATE'); ?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                   type="date" id="TDSTARTDATE" name="TDSTARTDATE" value="<?=isset($data['TDSTARTDATE']) ? date('Y-m-d', strtotime($data['TDSTARTDATE'])): date('Y-m-d'); ?>" />&emsp;
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('EXPIRY_DATE'); ?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                                   type="date" id="TDENDDATE" name="TDENDDATE" value="<?=isset($data['TDENDDATE']) ? date('Y-m-d', strtotime($data['TDENDDATE'])): date('Y-m-d'); ?>" onchange="unRequired();"/>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="flex w-6/12">
                            <select class="hidden"
                                    id="TAXKBN" name="TAXKBN" readonly>
                                <option value=""></option>
                                <?php foreach ($type2 as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['TAXKBN']) && $data['TAXKBN'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                            </select>
                            <select class="hidden"
                                    id="TAXTTL" name="TAXTTL" readonly>
                                <option value=""></option>
                                <?php foreach ($type3 as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['TAXTTL']) && $data['TAXTTL'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                            </select>
                            <input class="hidden" name="VATRATE" id="VATRATE" value="<?=isset($data['VATRATE']) ? $data['VATRATE']: ''; ?>" readonly/>
                        </div>
                    </div>

                    <div class="flex mt-4">
                            <div class="flex w-6/12">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                        id="ok" name="ok"><?php echo $data['TXTLANG']['OK']; ?>
                                </button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                                <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?>
                                </button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        id="delete" name="delete" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                                <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?></button>
                            </div>
                            <div class="flex w-6/12 justify-end">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        id="entry" name="entry" onclick="enrty();"><?php echo $data['TXTLANG']['ENTRY']; ?>
                                </button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        id="clear" name="clear" onclick="unsetSession();"><?php echo $data['TXTLANG']['CLEAR']; ?>
                                </button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');">
                                        <?php echo $data['TXTLANG']['END']; ?>
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
<script src="./js/script.js" ></script>
<script type="text/javascript">

$(document).ready(function() {
    unRequired();

    var index = 0;
    var index = '<?php echo (isset($data['TAX']) ? count($data['TAX']) : 0); ?>';

    $("#ok").click(function() {
        
        if($('#TAXTYPECD').val() == '' ) {
            validationDialog();
            return false;
        }
        // console.log('index before' + index);
        index ++;  // index += 1; 
        // console.log('index after' + index);
        var newRow = $('<tr class="flex w-full p-0 divide-x" id="rowId'+index+'">');
        var cols = "";
        cols += '<td class="h-6 w-2/12 pl-1 text-sm text-left" id="ROWNO_TD' + index + '">' + index + '</td>';
        cols += '<td class="h-6 w-2/12 pl-1 text-sm text-left" id="TAXTYPECD_TD' + index + '">' + $('#TAXTYPECD').val() + '</td>';
        cols += '<td class="h-6 w-5/12 pl-1 text-sm text-left" id="TAXTYPENAME_TD' + index + '">'+ $('#TAXTYPENAME').val() + '</td>';
        cols += '<td class="h-6 w-2/12 pl-1 text-sm text-left" id="TAXKBN_TD'+ index + '">'+ $("#TAXKBN option:selected").text() + '</td>';
        cols += '<td class="h-6 w-2/12 pl-1 text-sm text-right" id="VATRATE_TD'+ index + '">'+ $('#VATRATE').val() + '</td>';
        cols += '<td class="h-6 w-2/12 pl-1 text-sm text-left" id="TAXTTL_TD'+ index + '"> '+ $("#TAXTTL option:selected").text() + '</td>';
        cols += '<td class="h-6 w-2/12 pl-1 text-sm text-left" id="TDSTARTDATE_TD'+ index + '">'+ $('#TDSTARTDATE').val() + '</td>';
        cols += '<td class="h-6 w-2/12 pl-1 text-sm text-left" id="TDENDDATE_TD'+ index + '">'+ $('#TDENDDATE').val() + '</td>';

        cols += '<td class="hidden"><input type="hidden" id="ROWNO'+index+'" name="ROWNOA[]" value='+index+'></td>';
        cols += '<td class="hidden"><input type="hidden" id="TAXTYPECD'+index+'" name="TAXTYPECDA[]" value='+ $('#TAXTYPECD').val() +'></td>';
        cols += '<td class="hidden"><input type="hidden" id="TAXTYPENAME'+index+'" name="TAXTYPENAMEA[]" value='+ $('#TAXTYPENAME').val() +'></td>';
        cols += '<td class="hidden"><input type="hidden" id="TAXKBN'+index+'" name="TAXKBNA[]" value='+ $('#TAXKBN').val() +'></td>';
        cols += '<td class="hidden"><input type="hidden" id="VATRATE'+index+'" name="VATRATEA[]" value='+ $('#VATRATE').val() +'></td>';
        cols += '<td class="hidden"><input type="hidden" id="TAXTTL'+index+'" name="TAXTTLA[]" value='+ $('#TAXTTL').val() +'></td>';
        cols += '<td class="hidden"><input type="hidden" id="TDSTARTDATE'+index+'" name="TDSTARTDATEA[]" value='+ $('#TDSTARTDATE').val() +'></td>';
        cols += '<td class="hidden"><input type="hidden" id="TDENDDATE'+index+'" name="TDENDDATEA[]" value='+ $('#TDENDDATE').val() +'></td>';

        if(index <= 9) {
            $('#rowId'+index+'').empty();
            $('#rowId'+index+'').append(cols);
        } else {
            newRow.append(cols);
            $('table tbody').append(newRow);
        }
        $('#rowcount').html(index);
        keepItemData();
        return enrty();
    });

    $("#delete").click(function() {

        let id = $('#ROWNO').val();
        if(id != '') {
            document.getElementById("search_table").deleteRow(id);
            $('#rowId'+id).closest("tr").remove();
            index--;
            $(".row-id").each(function (i) {
                $(this).text(i+1);
            }); 
            $('#record').html(index);
            // unsetItemData(id);
            changeRowId();
            // calculateTotal();
            id = null;
            return enrty();
        }
    });
});

$('table#search_table tr').click(function () {
    $('table#search_table tr').removeAttr('id');

    $(this).attr('id', 'selected-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
        // console.log(item.eq(0).text());
        $('#ROWNO').val(item.eq(0).text());
        $('#TAXTYPECD').val(item.eq(1).text());
        $('#TAXTYPENAME').val(item.eq(2).text());
        $('#TDSTARTDATE').val(item.eq(8).text().replaceAll("/","-")); 
        $('#TDENDDATE').val(item.eq(9).text().replaceAll("/","-"));
        
        document.getElementById("commit").disabled = false;
        document.getElementById("update").disabled = false;
        document.getElementById("delete").disabled = false;
        document.getElementById("ok").disabled = true;
        // $('#TAXTYPECD').attr('readonly',true).css('background-color', 'whitesmoke');
        unRequired();
        // document.getElementById("CATALOGNAME").value = item.eq(1).text();    
    }
});

// CURRENCYCD
// input serach
const COUNTRYCD = $('#COUNTRYCD');
const STATECD = $('#STATECD');
const CITYCD = $('#CITYCD');
const TAXTYPECD = $('#TAXTYPECD');

const input_serach = [COUNTRYCD,STATECD,CITYCD,TAXTYPECD];

// button search
const guideindex1 = $("#guideindex1");
const guideindex2 = $("#guideindex2");
const guideindex3 = $("#guideindex3");
const guideindex4 = $("#guideindex4");//ทำหน้าSEARCHTAXเพิ่ม
const search = $("#search");

const search_icon = [guideindex1,guideindex2,guideindex3,guideindex4,search];

// guideindex1.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCOUNTRY/index.php');
guideindex1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCOUNTRY/index.php?page=TAXDETAILENTRY&index=1', 'authWindow', 'width=1200,height=600');});
// guideindex2.attr('href', $('#sessionUrl').val() +  '/guide/'+ $('#comcd').val() +'/SEARCHSTATE1/index.php?COUNTRYCD=' + COUNTRYCD.val());
guideindex2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTATE1/index.php?page=TAXDETAILENTRY&index=1&COUNTRYCD=' + COUNTRYCD.val(), 'authWindow', 'width=1200,height=600');});
// guideindex3.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCITY/index.php?COUNTRYCD=' + COUNTRYCD.val() +'&STATECD=' +STATECD.val());
guideindex3.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCITY/index.php?page=TAXDETAILENTRY&index=1&COUNTRYCD='+COUNTRYCD.val()+'&STATECD=' + STATECD.val(), 'authWindow', 'width=1200,height=600');});
// guideindex4.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHTAX/index.php');
guideindex4.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHTAX/index.php?page=TAXDETAILENTRY&index=1', 'authWindow', 'width=1200,height=600');});

function HandlePopupResult(code, result) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/TAXDETAILENTRY/index.php?'+code+'=' + result;
}

function HandlePopupResultMultiple(code, result,code2,result2,code3,result3) {
    // console.log("result of popup is: " + code + ' : ' + result);
    if(code3 === undefined || result3 === undefined){
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/TAXDETAILENTRY/index.php?'+code+'=' + result+'&'+code2+'='+result2;
    } else {
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/TAXDETAILENTRY/index.php?'+code+'=' + result+'&'+code2+'='+result2+'&'+code3+'='+result3;

    }
}

for(const input of input_serach) {
    input.change(function () {
        $("#loading").show();
    });

    input.keyup(function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $("#loading").show();
        }
    });
};

for(const icon of search_icon) {
    icon.click(function () {
       keepData(); 
    });
};

COUNTRYCD.change(function() {
    keepData(); 
    window.location.href="index.php?COUNTRYCD=" + COUNTRYCD.val();
});

COUNTRYCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData(); 
        window.location.href="index.php?COUNTRYCD=" + COUNTRYCD.val();
    }
})

STATECD.change(function() {
    keepData(); 
    window.location.href="index.php?STATECD=" + STATECD.val() +'&COUNTRYCD=' +COUNTRYCD.val();
});

STATECD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData(); 
        window.location.href="index.php?STATECD=" + STATECD.val() +'&COUNTRYCD=' +COUNTRYCD.val();
    }
})

CITYCD.change(function() {
    keepData(); 
    window.location.href="index.php?CITYCD=" + CITYCD.val() +'&COUNTRYCD=' +COUNTRYCD.val() +'&STATECD=' +STATECD.val();
});

CITYCD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData(); 
        window.location.href="index.php?CITYCD=" + CITYCD.val() +'&COUNTRYCD=' +COUNTRYCD.val() +'&STATECD=' +STATECD.val();
    }
})

TAXTYPECD.change(function() {
    keepData(); 
    window.location.href="index.php?TAXTYPECD=" + TAXTYPECD.val();
});

TAXTYPECD.keyup(function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        keepData(); 
        window.location.href="index.php?TAXTYPECD=" + TAXTYPECD.val();
    }
})



// <!-- CURRENCYCD,CURRENCYUNITTYP,TAXTTL,CURRENCYDISP  -->

function enrty() {
    var today = new Date().toISOString().split('T')[0];
    $('table#search_table tr').removeAttr('id');
    document.getElementById("commit").disabled = false;
    document.getElementById("update").disabled = true;
    document.getElementById("delete").disabled = true;
    document.getElementById("ok").disabled = false;
    $('#TAXTYPECD').val('');
    $('#TAXTYPENAME').val('');
    $('#TDSTARTDATE').val(today);
    $('#TDENDDATE').val('');
    unRequired();
// TDSTARTDATE  TDENDDATE
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
        if (result.isConfirmed) {
            if(type == 1) {
                window.location.href="/DMCS_WEBAPP";          
            }
        }
    });
}

</script>
</html>