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
            <form class="w-full" method="POST" action="" id="AccRPTFormSettingInq" name="AccRPTFormSettingInq" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
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
                        <input type="hidden" id="FORMROWNUM" name="FORMROWNUM" value="<?=isset($data['FORMROWNUM']) ? $data['FORMROWNUM']: ''; ?>">
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="SEARCH" name="SEARCH"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-7/12 px-2">
                        <div class="flex-col w-full">
                            <div class="overflow-scroll block h-[426px] max-h-[426px]"> 
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
                        </div>
                    </div>
                    <div class="flex w-5/12 px-2">
                        <div class="flex-col w-full">
                            <div class="overflow-scroll block h-[426px] max-h-[426px]"> 
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
                        </div>
                    </div>
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
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
        unRequired();
        $('table#table tbody tr').click(function () {
            $('table#table tbody tr').removeAttr('id');
            let item = $(this).closest('tr').children('td');

            if(item.eq(0).text() != 'undefined' && item.eq(0).text() != '') {
                // console.log(item.eq(0).text());
                $(this).attr('id', 'click-row');

                getRptFormDtl(item.eq(0).text());
            }
        });

        $('table#tableAcc tbody tr').click(function () {
            $('table#tableAcc tbody tr').removeAttr('id');
            let itemAcc = $(this).closest('tr').children('td');

            if(itemAcc.eq(0).text() != 'undefined' && itemAcc.eq(0).text() != '') {
                // console.log(itemAcc.eq(0).text());
                $(this).attr('id', 'click-row');
            }
        });
    });

    function unRequired() {
       let month = document.getElementById('RPTFORMTYP');
        if(month.selectedIndex != 0) {
            month.classList.remove('req');
        } else {
            month.classList.add('req');
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