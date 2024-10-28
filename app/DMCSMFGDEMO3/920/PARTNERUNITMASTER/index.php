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
            <form class="w-full" method="POST" id="partnerUnitMaster" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <?php //language('development')?>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>
                                <div class="flex mb-1 py-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pt-1" id="PARTNER_TYPE_TXT"><?=checklang('PARTNER_TYPE')?></label>
                                        <select class="text-control text-[13px] shadow-md border px-3 h-7 w-4/12 mr-1 text-left text-[12px] rounded-xl border-gray-300 req"
                                                id="PARTNERTYP" name="PARTNERTYP" onchange="unRequired();">
                                            <option value=""></option>
                                            <?php foreach ($PARTNERTYP as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['PARTNERTYP']) && $data['PARTNERTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="w-5/12"></div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pl-1 pt-1" id="ITEMCODE_TXT"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                    id="ITEMCD" name="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1 py-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pt-1" id="PARTNER_CODE_TXT"><?=checklang('PARTNER_CODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300" 
                                                    id="PARTNERCD" name="PARTNERCD" value="<?=isset($data['PARTNERCD']) ? $data['PARTNERCD']: ''; ?>" onchange="unRequired();"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHPARTNER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                id="PARTNERNAME" name="PARTNERNAME" value="<?=isset($data['PARTNERNAME']) ? $data['PARTNERNAME']: ''; ?>" readonly/>
                                        <input type="text" class="hidden" id="NEXTQTY" name="NEXTQTY" value="<?=isset($data['NEXTQTY']) ? $data['NEXTQTY']: ''; ?>" readonly/>
                                        <input type="text" class="hidden" id="CMPRICETYP" name="CMPRICETYP" value="<?=isset($data['CMPRICETYP']) ? $data['CMPRICETYP']: ''; ?>" readonly/>
                                    </div>

                                    <div class="flex w-6/12 px-2">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ITEMSPEC" name="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                            id="ITEMDRAWNO" name="ITEMDRAWNO" value="<?=isset($data['ITEMDRAWNO']) ? $data['ITEMDRAWNO']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2 py-1">
                                    <div class="flex w-6/12">
                                        <label class="text-color block text-sm w-3/12 pt-1" id="EFFECTIVE_DATE_TXT"><?=checklang('EFFECTIVE_DATE')?></label>
                                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 mr-1 text-gray-700 border-gray-300"
                                                id="PARTNERPRICEDT" name="PARTNERPRICEDT" value="<?=!empty($data['PARTNERPRICEDT']) ? date('Y-m-d', strtotime($data['PARTNERPRICEDT'])): ''; ?>" onchange="unRequired();"/>
                                        <div class="flex w-5/12 justify-end">
                                           <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none font-medium rounded-lg" id="PRE"><</button>
                                        </div>
                                        <input type="text" class="hidden" id="SYSEN_PRE" name="SYSEN_PRE" value="<?=isset($data['SYSEN_PRE']) ? $data['SYSEN_PRE']: ''; ?>" readonly/>
                                        <input type="text" class="hidden" id="SYSEN_NEXT" name="SYSEN_NEXT" value="<?=isset($data['SYSEN_NEXT']) ? $data['SYSEN_NEXT']: 'F'; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12">
                                        <div class="w-5/12">
                                            <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none font-medium rounded-lg" id="NEXT">></button>
                                        </div>
                                        <div class="flex w-7/12 justify-end">
                                            <button type="button" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2" id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
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

                <!-- Table -->
                <div class="overflow-scroll px-2 block h-[290px] max-h-[290px]">
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-2 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT_PRICE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                    <td class="h-6 text-sm border border-slate-700 text-center row-id" id="PARTNERPRICELN_TD<?=$key?>"><?=isset($value['PARTNERPRICELN']) ? $value['PARTNERPRICELN']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="PARTNERPRICEQTY1_TD<?=$key?>"><?=isset($value['PARTNERPRICEQTY1']) ? $value['PARTNERPRICEQTY1']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="PARTNERPRICEQTY2_TD<?=$key?>"><?=isset($value['PARTNERPRICEQTY2']) ? $value['PARTNERPRICEQTY2']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="PARTNERPRICE_TD<?=$key?>"><?=isset($value['PARTNERPRICE']) ? $value['PARTNERPRICE']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="CMCURDISP_TD<?=$key?>"><?=isset($value['CMCURDISP']) ? $value['CMCURDISP']: '' ?></td>
                                    
                                    <input class="hidden" id="PARTNERPRICELN<?=$key?>" name="PARTNERPRICELNZ[]" value="<?=isset($value['PARTNERPRICELN']) ? $value['PARTNERPRICELN']: '' ?>">
                                    <input class="hidden" id="PARTNERPRICEQTY1<?=$key?>" name="PARTNERPRICEQTY1Z[]" value="<?=isset($value['PARTNERPRICEQTY1']) ? $value['PARTNERPRICEQTY1']: '' ?>">
                                    <input class="hidden" id="PARTNERPRICEQTY2<?=$key?>" name="PARTNERPRICEQTY2Z[]" value="<?=isset($value['PARTNERPRICEQTY2']) ? $value['PARTNERPRICEQTY2']: '' ?>">
                                    <input class="hidden" id="PARTNERPRICE<?=$key?>" name="PARTNERPRICEZ[]" value="<?=isset($value['PARTNERPRICE']) ? $value['PARTNERPRICE']: '' ?>">
                                    <input class="hidden" id="CMCURDISP<?=$key?>" name="CMCURDISPZ[]" value="<?=isset($value['CMCURDISP']) ? $value['CMCURDISP']: '' ?>">
                                    <input class="hidden" id="SYSEN_PARTNERPRICE<?=$key?>" name="SYSEN_PARTNERPRICEZ[]" value="<?=isset($value['SYSEN_PARTNERPRICE']) ? $value['SYSEN_PARTNERPRICE']: '' ?>">
                                </tr><?php
                            }
                        }
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200" id="rowId<?=$i?>">
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                            </tr> <?php
                        } ?>
                        </tbody>
                    </table>

                    <div class="sticky bottom-0 bg-white flex pt-2 px-2">
                        <div class="flex w-full">
                            <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                        </div>
                    </div>
                </div>

                <div class="flex mt-2 mb-1 px-2">
                    <div class="flex w-7/12 px-2">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                        id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']['SYSVIS_INSERT']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['SYSPVL']['SYSVIS_INS']) && $data['SYSPVL']['SYSVIS_INS'] != 'T') { ?> disabled <?php } ?>><?=checklang('INSERT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']['SYSVIS_UPDATE']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['SYSPVL']['SYSVIS_UPD']) && $data['SYSPVL']['SYSVIS_UPD'] != 'T') { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 mr-2 text-center"
                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']['SYSVIS_DELETE']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['SYSPVL']['SYSVIS_DEL']) && $data['SYSPVL']['SYSVIS_DEL'] != 'T') { ?> disabled <?php } ?>><?=checklang('DELETE'); ?></button>
                    </div>
                    <div class="flex w-5/12 px-2 justify-end">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-3/12 py-1 text-center"
                            id="ENTRY" name="ENTRY" onclick="entry();"><?=checklang('ENTRY'); ?></button>
                    </div>
                </div>
               
                <div class="flex w-full my-2 px-2">
                    <label class="text-color block text-sm w-1/12 pl-4 pt-1"><?=checklang('LINE')?></label>
                    <label class="text-color block text-sm w-2/12 pl-4 pt-1"><?=checklang('FROM')?></label>
                    <label class="w-1/12"></label>
                    <label class="text-color block text-sm w-2/12 pl-6 pt-1"><?=checklang('UNTIL')?></label>
                    <label class="text-color block text-sm w-2/12 pl-8 pt-1"><?=checklang('UNIT_PRICE')?></label>      
                </div>

                <div class="flex w-full my-2 px-2">
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                id="PARTNERPRICELN" name="PARTNERPRICELN" value="<?=isset($data['PARTNERPRICELN']) ? $data['PARTNERPRICELN']: ''; ?>" readonly/>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 mx-1 text-gray-700 border-gray-300 text-right read"
                                id="PARTNERPRICEQTY1" name="PARTNERPRICEQTY1" value="<?=isset($data['PARTNERPRICEQTY1']) ? number_format(str_replace(',', '', $data['PARTNERPRICEQTY1']), 2): ''; ?>" readonly/>
                        <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('ARROW')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 mx-1 text-gray-700 border-gray-300 text-right req"
                                id="PARTNERPRICEQTY2" name="PARTNERPRICEQTY2" value="<?=!empty($data['PARTNERPRICEQTY2']) ? number_format(str_replace(',', '', $data['PARTNERPRICEQTY2']), 2): ''; ?>" 
                                onchange="this.value = num2digit(this.value); unRequired();" oninput="this.value = stringReplacez(this.value)"/>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 mx-1 text-gray-700 border-gray-300 text-right req"
                                id="PARTNERPRICE" name="PARTNERPRICE" value="<?=!empty($data['PARTNERPRICE']) ? number_format(str_replace(',', '', $data['PARTNERPRICE']), 2): ''; ?>"
                                onchange="this.value = num2digit(this.value); unRequired();" oninput="this.value = stringReplacez(this.value)"/>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                id="CMCURDISP" name="CMCURDISP" value="<?=isset($data['CMCURDISP']) ? $data['CMCURDISP']: ''; ?>" readonly/>
                        <input type="text" class="hidden" id="SYSEN_PARTNERPRICEQTY2" name="SYSEN_PARTNERPRICEQTY2" value="<?=isset($data['SYSEN_PARTNERPRICEQTY2']) ? $data['SYSEN_PARTNERPRICEQTY2']: ''; ?>" readonly/>
                        <input type="text" class="hidden" id="SYSEN_PARTNERPRICE" name="SYSEN_PARTNERPRICE" value="<?=isset($data['SYSEN_PARTNERPRICE']) ? $data['SYSEN_PARTNERPRICE']: ''; ?>" readonly/>
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-6/12"></div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>
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
</html>
<script src="./js/script.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
        document.getElementById('INSERT').disabled = false;
        document.getElementById('UPDATE').disabled = true;
        document.getElementById('DELETE').disabled = true;
        document.getElementById('NEXT').classList.add('read');

        let SYSEN_PRE = document.getElementById('SYSEN_PRE').value;
        let SYSEN_NEXT = document.getElementById('SYSEN_NEXT').value;
        document.getElementById('PRE').classList[SYSEN_PRE != '' && SYSEN_PRE == 'F' ? 'add' : 'remove']('read');
        document.getElementById('NEXT').classList[SYSEN_NEXT != '' && SYSEN_NEXT == 'F' ? 'add' : 'remove']('read');

        $('table#table tr').click(function () {
            $('table#table tr').not(this).removeClass('selected');
            let item = $(this).closest('tr').children('td'); // $('#PARTNERPRICELN').val(''); $('#PARTNERPRICE').val(''); $('#PARTNERPRICEQTY2').val('');
            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                let rec = item.eq(0).text();
                let table = document.getElementById('table');
                if(rec != '') { 
                    table.rows[rec].classList.toggle('selected');
                }
                // console.log(rec);
                $('#PARTNERPRICELN').val($('#PARTNERPRICELN'+rec+'').val());
                $('#PARTNERPRICEQTY1').val($('#PARTNERPRICEQTY1'+rec+'').val());
                $('#PARTNERPRICEQTY2').val($('#PARTNERPRICEQTY2'+rec+'').val());
                $('#PARTNERPRICE').val($('#PARTNERPRICE'+rec+'').val());
                $('#CMCURDISP').val($('#CMCURDISP'+rec+'').val());
                $('#SYSEN_PARTNERPRICE').val($('#SYSEN_PARTNERPRICE'+rec+'').val());

                document.getElementById('INSERT').disabled = true;
                document.getElementById('UPDATE').disabled = false;
                document.getElementById('DELETE').disabled = false;

                document.getElementById('PARTNERPRICEQTY2').classList.add('read');
                let SYS_PARTNERPRICE = document.getElementById('SYSEN_PARTNERPRICE').value;
                document.getElementById('PARTNERPRICE').classList[SYS_PARTNERPRICE == 'T' ? 'remove' : 'add']('read');

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
               // 
            }
        });
    }
</script>