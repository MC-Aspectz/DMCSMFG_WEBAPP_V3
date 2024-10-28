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
        <main class="flex flex-1 overflow-y-auto paragraph">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="mfg_plan_entry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                    id="ITEMCODE" name="ITEMCODE" value="<?=isset($data['ITEMCODE']) ? $data['ITEMCODE']: ''; ?>" onchange="unRequired();"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHITEM">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                            id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div id="table-area" class="overflow-scroll px-2 block h-[490px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200 mpn" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRODUCT_PLANID')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('BRANCH_TYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PLANEDQTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PLANED_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('COMBINATION')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARK')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 csv" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD<?=$key?>"><?=$key?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUFACTURINGPLANCODE_TD<?=$key?>"><?=isset($value['MANUFACTURINGPLANCODE']) ? $value['MANUFACTURINGPLANCODE']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="DIVISIONTYP_TD<?=$key?>"><?=isset($value['DIVISIONTYP']) && $value['DIVISIONTYP'] != ''  ? $FACTORY[$value['DIVISIONTYP']]: '' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUFACTURINGPLANQTY_TD<?=$key?>"><?=isset($value['MANUFACTURINGPLANQTY']) ? $value['MANUFACTURINGPLANQTY']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUFACTURINGPLANDUEDATE_TD<?=$key?>"><?=isset($value['MANUFACTURINGPLANDUEDATE']) ? $value['MANUFACTURINGPLANDUEDATE']:'' ?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUPLANCOMB_TD<?=$key?>"><?=isset($value['MANUPLANCOMB']) && $value['MANUPLANCOMB'] != '' ? $BMVERSION[$value['MANUPLANCOMB']]: ''?></td>
                                    <td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUFACTURINGPLANNOTE_TD<?=$key?>"><?=isset($value['MANUFACTURINGPLANNOTE']) ? $value['MANUFACTURINGPLANNOTE']: '' ?></td>
                                    <input type="hidden" id="ROWNO<?=$key?>" name="ROWNOA[]" value="<?=$key?>">
                                    <input type="hidden" id="MANUFACTURINGPLANCODE<?=$key?>" name="MANUFACTURINGPLANCODEA[]" value="<?=isset($value['MANUFACTURINGPLANCODE']) ? $value['MANUFACTURINGPLANCODE']: '' ?>">
                                    <input type="hidden" id="DIVISIONTYP<?=$key?>" name="DIVISIONTYPA[]" value="<?=isset($value['DIVISIONTYP']) ? $value['DIVISIONTYP']: '' ?>">
                                    <input type="hidden" id="MANUFACTURINGPLANQTY<?=$key?>" name="MANUFACTURINGPLANQTYA[]" value="<?=isset($value['MANUFACTURINGPLANQTY']) ? $value['MANUFACTURINGPLANQTY']: '' ?>">
                                    <input type="hidden" id="MANUFACTURINGPLANDUEDATE<?=$key?>" name="MANUFACTURINGPLANDUEDATEA[]" value="<?=isset($value['MANUFACTURINGPLANDUEDATE']) ? $value['MANUFACTURINGPLANDUEDATE']: '' ?>">
                                    <input type="hidden" id="MANUPLANCOMB<?=$key?>" name="MANUPLANCOMBA[]" value="<?=isset($value['MANUPLANCOMB']) ? $value['MANUPLANCOMB']: '' ?>">
                                    <input type="hidden" id="MANUFACTURINGPLANNOTE<?=$key?>" name="MANUFACTURINGPLANNOTEA[]" value="<?=isset($value['MANUFACTURINGPLANNOTE']) ? $value['MANUFACTURINGPLANNOTE']: '' ?>">
                                    <input type="hidden" id="MANUPLANMAKETYP<?=$key?>" name="MANUPLANMAKETYPA[]" value="<?=isset($value['MANUPLANMAKETYP']) ? $value['MANUPLANMAKETYP']: '' ?>">
                                    <input type="hidden" id="DIVISIONTYP<?=$key?>" name="DIVISIONTYPA[]" value="<?=isset($value['DIVISIONTYP']) ? $value['DIVISIONTYP']: '' ?>">
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
                            </tr> <?php
                        } ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex pt-2 px-2">
                    <div class="flex w-full">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold flex">
                                    <div class="flex w-7/12 px-1">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                                        id="OK" name="OK" <?php if(!empty($data['SYSPVL']['SYSVIS_INSERT']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                                        <?php if(!empty($data['SYSPVL']['SYSVIS_INS']) && $data['SYSPVL']['SYSVIS_INS'] != 'T') { ?> disabled <?php } ?>><?=checklang('OK'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']['SYSVIS_UPDATE']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                                        <?php if(!empty($data['SYSPVL']['SYSVIS_UPD']) && $data['SYSPVL']['SYSVIS_UPD'] != 'T') { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']['SYSVIS_DELETE']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                                        <?php if(!empty($data['SYSPVL']['SYSVIS_DEL']) && $data['SYSPVL']['SYSVIS_DEL'] != 'T') { ?> disabled <?php } ?>><?=checklang('DELETE'); ?></button>
                                    </div>
                                    <div class="flex w-5/12 px-1 justify-end">
                                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center"
                                            id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                                    </div>
                                </summary>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('BRANCH_TYPE')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="DIVISIONTYP" name="DIVISIONTYP">
                                            <option value=""></option>
                                            <?php foreach ($FACTORY as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['DIVISIONTYP']) && $data['DIVISIONTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <input class="hidden" type="hidden" id="ROWNO" name="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="MANUPLANMAKETYP" name="MANUPLANMAKETYP" value="<?=isset($data['MANUPLANMAKETYP']) ? $data['MANUPLANMAKETYP']: ''; ?>" />
                                        <input class="hidden" type="hidden" id="MANUFACTURINGPLANCODE" name="MANUFACTURINGPLANCODE" value="<?=isset($data['MANUFACTURINGPLANCODE']) ? $data['MANUFACTURINGPLANCODE']: ''; ?>" />
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DUE_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="MANUFACTURINGPLANDUEDATE" name="MANUFACTURINGPLANDUEDATE" value="<?=!empty($data['MANUFACTURINGPLANDUEDATE']) ? date('Y-m-d', strtotime($data['MANUFACTURINGPLANDUEDATE'])) : date('Y-m-d'); ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('PLANEDQTY')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 mr-2 py-2 px-3 text-gray-700 border-gray-300 req"
                                            id="MANUFACTURINGPLANQTY" name="MANUFACTURINGPLANQTY" value="<?=!empty($data['MANUFACTURINGPLANQTY']) ? number_format(str_replace(',', '',$data['MANUFACTURINGPLANQTY']), 2): ''; ?>"
                                                    onchange="this.value = dec2digit(this.value); unRequired();" oninput="this.value = stringReplacez(this.value);"/>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 read" id="ITEMUNIT" name="ITEMUNIT">
                                            <option value=""></option>
                                            <?php foreach ($UNIT as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['ITEMUNIT']) && $data['ITEMUNIT'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>    
                                    </div>
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('COMBINATION')?></label>
                                        <select class="text-control text-[12px] shadow-md border px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 read" id="MANUPLANCOMB" name="MANUPLANCOMB">
                                            <option value=""></option>
                                            <?php foreach ($BMVERSION as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['MANUPLANCOMB']) && $data['MANUPLANCOMB'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>  
                                    </div>
                                </div>
                
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-1">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('REMARK')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-10/12 py-2 px-3 text-gray-700 border-gray-300 mr-2"
                                                id="MANUFACTURINGPLANNOTE" name="MANUFACTURINGPLANNOTE" value="<?=isset($data['MANUFACTURINGPLANNOTE']) ? $data['MANUFACTURINGPLANNOTE']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-1"></div>
                                </div>   
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-1 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('COMMIT'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="$('#loading').show(); unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1'); ?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
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
</html>
<script src="./js/script.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
        document.getElementById('OK').disabled = false;
        document.getElementById('UPDATE').disabled = true;
        document.getElementById('DELETE').disabled = true;

        document.getElementById('MANUPLANCOMB').value = 0;
    
        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 18); ?>';
        const tablearea = document.getElementById('table-area');
        const details = document.querySelector('details');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[490px]');
                tablearea.classList.add('h-[600px]');
                maxrow = 23;
            } else {
                tablearea.classList.remove('h-[600px]');
                tablearea.classList.add('h-[490px]');
                maxrow = 18;
            }
            emptyRows(maxrow);
        })

        var index = 0;
        var index = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
       
        OK.click(function() {
            if($('#ITEMCODE').val() == '' || $('#MANUFACTURINGPLANQTY').val() == '') {
                validationDialog();
                return false;
            }
            index ++;  // index += 1;
            var newRow = $('<tr class="divide-y divide-gray-200 csv" id=rowId' + index + '>');
            var cols = '';
    
            cols += '<td class="h-6 w-1/12 text-sm border border-slate-700 text-center whitespace-nowrap row-id" id="ROWNO_TD' + index + '">' + index + '</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUFACTURINGPLANCODE_TD' + index + '">' + $('#MANUFACTURINGPLANCODE').val() + '</td>';//
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="DIVISIONTYP_TD' + index + '">' + $("#DIVISIONTYP option:selected").text()+'</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUFACTURINGPLANQTY_TD' + index + '">' + $('#MANUFACTURINGPLANQTY').val() + '</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUFACTURINGPLANDUEDATE_TD' + index + '">' + $('#MANUFACTURINGPLANDUEDATE').val() + '</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUPLANCOMB_TD' + index + '">' + $("#MANUPLANCOMB option:selected").text() + '</td>';
            cols += '<td class="h-6 w-1/12 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap" id="MANUFACTURINGPLANNOTE_TD' + index + '">' + $('#MANUFACTURINGPLANNOTE').val() + '</td>';

            cols += '<input type="hidden" id="ROWNO'+index+'" name="ROWNOA[]" value='+index+'>';
            cols += '<input type="hidden" id="MANUFACTURINGPLANCODE'+index+'" name="MANUFACTURINGPLANCODEA[]"   value="'+ $('#MANUFACTURINGPLANCODE').val() +'">';
            cols += '<input type="hidden" id="MANUFACTURINGPLANQTY'+index+'" name="MANUFACTURINGPLANQTYA[]"   value="'+ $('#MANUFACTURINGPLANQTY').val() +'">';
            cols += '<input type="hidden" id="MANUFACTURINGPLANDUEDATE'+index+'" name="MANUFACTURINGPLANDUEDATEA[]"   value="'+ $('#MANUFACTURINGPLANDUEDATE').val() +'">';
            cols += '<input type="hidden" id="MANUFACTURINGPLANNOTE'+index+'" name="MANUFACTURINGPLANNOTEA[]"   value="'+ $('#MANUFACTURINGPLANNOTE').val() +'">';
            cols += '<input type="hidden" id="DIVISIONTYP'+index+'" name="DIVISIONTYPA[]"   value="'+ $('#DIVISIONTYP').val() +'">';
            cols += '<input type="hidden" id="MANUPLANMAKETYP'+index+'" name="MANUPLANMAKETYPA[]"   value="'+ $('#MANUPLANMAKETYP').val() +'">';
            cols += '<input type="hidden" id="MANUPLANCOMB'+index+'" name="MANUPLANCOMBA[]"   value="'+ $('#MANUPLANCOMB').val() +'">';

            if(index <= maxrow) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').removeAttr('class', 'row-empty');
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $('table tbody').append(newRow);
            }
            $('#rowCount').html(index);
            
            keepItemData();
            return entry();
    
        });
    
        UPDATE.click(async function() {
            let rowno = $('#ROWNO').val();
            if(rowno != '') {
                $('#ROWNO_TD'+rowno+'').html($('#ROWNO').val());
                $('#MANUFACTURINGPLANCODE_TD'+rowno+'').html($('#MANUFACTURINGPLANCODE').val());
                $('#DIVISIONTYP_TD'+rowno+'').html($('#DIVISIONTYP option:selected').text());
                $('#MANUFACTURINGPLANQTY_TD'+rowno+'').html($('#MANUFACTURINGPLANQTY').val());
                $('#MANUFACTURINGPLANDUEDATE_TD'+rowno+'').html($('#MANUFACTURINGPLANDUEDATE').val());
                $('#MANUPLANCOMB_TD'+rowno+'').html($("#MANUPLANCOMB option:selected").text());
                $('#MANUFACTURINGPLANNOTE_TD'+rowno+'').html($('#MANUFACTURINGPLANNOTE').val());

                $('#ROWNO'+rowno+'').val($('#ROWNO').val());
                $('#MANUFACTURINGPLANCODE'+rowno+'').val($('#MANUFACTURINGPLANCODE').val());
                $('#MANUFACTURINGPLANQTY'+rowno+'').val($('#MANUFACTURINGPLANQTY').val());
                $('#MANUFACTURINGPLANDUEDATE'+rowno+'').val($('#MANUFACTURINGPLANDUEDATE').val());
                $('#MANUFACTURINGPLANNOTE'+rowno+'').val($('#MANUFACTURINGPLANNOTE').val());
                $('#DIVISIONTYP'+rowno+'').val(document.getElementById('DIVISIONTYP').value);
                $('#MANUPLANMAKETYP'+rowno+'').val(document.getElementById('MANUPLANMAKETYP').value);
                $('#MANUPLANCOMB'+rowno+'').val(document.getElementById('MANUPLANCOMB').value);
             
                document.getElementById('OK').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;
               
                await keepItemData();
                return entry();
            }
        });

        DELETE.click(function() {
            let id = $('#ROWNO').val();
            if(id == '') return false;
            document.getElementById('table').deleteRow(id);
            $('#rowId'+id).closest('tr').remove();
            if(id <= maxrow) {
                emptyRow(index);
            }
            index--;
            // console.log(key);
            $('.row-id').each(function (i) {
                $(this).text(i+1);
            }); 
            $('#rowcount').html(index);
            changeRowId();
            unsetItemData(id);
            id = null;
            return entry();
        });

        $(document).on('click', '.mpn tbody tr', function(event) {
            $('table#table tr').not(this).removeClass('selected'); entry();
            let item = $(this).closest('tr').children('td');
            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                let rec = item.eq(0).text();
                let table = document.getElementById('table');
                if(rec != '') { 
                    table.rows[rec].classList.toggle('selected');
                }

                $('#ROWNO').val($('#ROWNO'+rec+'').val());
                $('#MANUFACTURINGPLANCODE').val($('#MANUFACTURINGPLANCODE'+rec+'').val());
                $('#MANUFACTURINGPLANQTY').val($('#MANUFACTURINGPLANQTY'+rec+'').val());
                $('#MANUFACTURINGPLANDUEDATE').val($('#MANUFACTURINGPLANDUEDATE'+rec+'').val().replaceAll('/','-'));
                $('#MANUFACTURINGPLANNOTE').val($('#MANUFACTURINGPLANNOTE'+rec+'').val());
  
                document.getElementById('DIVISIONTYP').value = $('#DIVISIONTYP'+rec+'').val();
                document.getElementById('MANUPLANCOMB').value = $('#MANUPLANCOMB'+rec+'').val();

                document.getElementById('OK').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;
                return unRequired();
            }
        });
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getElement(code, result);
    }
    
    function validationDialog() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText:  '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
            if (result.isConfirmed) {
                if(type == 1) {
                }
            }
        });
    }

    function errorDialog() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('ERRORUNCHECK'); ?>',
            showCancelButton: false,
            confirmButtonText:  '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
            if (result.isConfirmed) {
            }
        });
    }
</script>
