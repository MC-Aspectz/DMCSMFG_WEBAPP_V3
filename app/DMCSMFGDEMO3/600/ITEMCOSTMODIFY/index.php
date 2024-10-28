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
        <main class="flex flex-1 overflow-y-auto overflow-x-hidden paragraph px-2">
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="ItemCostModify" name="ItemCostModify" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <!-- <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label> -->
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=$_SESSION['APPNAME']; ?></summary>                
                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('COMBINATION')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 req"
                                                name="BMVERSION" id="BMVERSION" value="<?=isset($data['BMVERSION']) ? $data['BMVERSION']: ''; ?>" onchange="unRequired();" required/>
                                        <label class="text-color block text-sm w-2/12 pl-6 pt-1"><?=checklang('COSTSC')?></label>
                                        <select class="text-control text-[12px] shadow-md border mr-2 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300 req" id="COSTSC" name="COSTSC" onchange="ChkCodeTb(); unRequired();" required>
                                            <option value=""></option>
                                            <?php foreach ($COSTSC as $key => $item) { ?>
                                                <option value="<?=$key ?>" <?=(isset($data['COSTSC']) && $data['COSTSC'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="w-2/12"></div>
                                    </div>
                                    <div class="flex w-3/12 px-2 justify-end"></div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-9/12 px-2">
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ITEMCODE')?></label>
                                        <div class="relative w-3/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                                    name="ITEMCD" id="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHITEM">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <label class="text-color block text-sm w-2/12 pl-6 pt-1"><?=checklang('ITEMNAME')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="ITEMNAME" id="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME']: ''; ?>" readonly/>
                                        <input type="hidden" name="ITEMSPEC" id="ITEMSPEC" value="<?=isset($data['ITEMSPEC']) ? $data['ITEMSPEC']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-3/12 px-2"></div>
                                </div> 
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <hr class="divide-y divide-dotted my-2">
                
                <div class="flex mb-1 px-2">
                    <div class="flex w-2/12"></div>
                    <div class="flex w-10/12">
                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"></label>
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('COST_TEMP')?></label>
                        <input type="hidden" name="COMVAL" id="COMVAL" value="<?=isset($data['COMVAL']) ? $data['COMVAL']: ''; ?>" readonly/>
                        <input type="hidden" name="ROWCOUNTER" id="ROWCOUNTER" value="<?=isset($data['ROWCOUNTER']) ? $data['ROWCOUNTER']: ''; ?>" readonly/>
                        <input type="hidden" name="CURRENCYDISP" id="CURRENCYDISP" value="<?=isset($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>" readonly/>
                        <div class="w-4/12"></div>
                    </div>
                </div>

                <div class="overflow-scroll block h-[585px]"> 
                    <div class="flex flex-col mb-1 px-2"><?php $seq = 1; $line = 1;
                    if(!empty($COST_NAME)) {
                        foreach ($COST_NAME as $key => $item) { ?>
                            <div class="flex w-full">
                                <div class="flex w-2/12">
                                    <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=$seq++?></label>
                                    <label class="text-color block text-sm w-11/12 pl-4 pt-1"><?=$item?></label>
                                </div>
                               <div class="flex w-10/12">
                                    <div class="relative w-2/12 mr-1">
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 text-right read"
                                                name="COST_OLD[]" id="COST_OLD_<?=$line?>" value="<?=!empty($data['COST_OLD_'.$line]) ? number_format(str_replace(',', '', $data['COST_OLD_'.$line]), 4): ''; ?>" readonly/>
                                        <label class="absolute text-color text-sm top-0 end-0 h-7 w-12 py-1 px-2 rounded-e-xl border text-center read currencydisp">
                                            <?=isset($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>
                                        </label>
                                    </div>
                                    <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('ARROW')?></label>
                                    <div class="relative w-2/12 mr-1">
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 text-right"
                                                name="COSTNEW[]" id="COSTNEW<?=$line?>" value="<?=!empty($data['COSTNEW'.$line]) ? number_format(str_replace(',', '', $data['COSTNEW'.$line]), 4): ''; ?>"
                                                onchange="this.value = dec4digit(this.value);" oninput="this.value = stringReplacez(this.value);"/>
                                        <label class="absolute text-color text-sm top-0 end-0 h-7 w-12 py-1 px-2 rounded-e-xl border text-center read currencydisp">
                                            <?=isset($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''; ?>
                                        </label>
                                    </div>
                                    <input type="hidden" name="UPDFLG[]" id="UPDFLG<?=$line?>" value="<?=isset($data['UPDFLG'.$line]) ? $data['UPDFLG'.$line]: '0'; ?>" readonly/>
                                    <label class="text-color block text-sm w-1/12 pt-1 text-center"></label>
                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                        name="COST_TMP[]" id="COST_TMP_<?=$line?>" value="<?=!empty($data['COST_TMP_'.$line]) ? number_format(str_replace(',', '', $data['COST_TMP_'.$line]), 4): ''; ?>" readonly/>
                                    <div class="w-4/12"></div>
                               </div>
                           </div><?php $line++;
                        }
                    } ?>
                    </div> 
                </div> 
                <div class="flex mt-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> disabled <?php }?>
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
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
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
    });

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getSearch(code, result, 'getItem');
    }

    function validationDialog(type) {
        return Swal.fire({ 
            title: '',
            text: type == 1 ? '<?=lang('validation1');?>' : '<?=lang('validation2');?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes');?>',
            cancelButtonText: '<?=lang('no');?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }

    function alertDialog(error) {
        return Swal.fire({ 
            title: '',
            text: error,
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes');?>',
            cancelButtonText: '<?=lang('no');?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }
</script>
<script src="./js/script.js"></script>
</html>
