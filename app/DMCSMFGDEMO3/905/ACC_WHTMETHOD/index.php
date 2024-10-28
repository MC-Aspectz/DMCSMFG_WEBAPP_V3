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
            <form class="w-full" method="POST" id="accWHTMethod" name="accWHTMethod" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1 px-2">
                    <div class="flex w-8/12"></div>
                    <div class="flex w-4/12 justify-end">
                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mt-2"
                                id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>   
                <div class="overflow-scroll block h-[240px] max-h-[240px] px-2"> 
                    <table id="table" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CODE')?></span>
                                </th>
                                <th class="px-10 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MEMO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=str_repeat('&emsp;', 2)?></span>
                                </th>
                            </tr>
                        </thead>
                            <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                            if(!empty($data['ITEM'])) {
                              $minrow = count($data['ITEM']);
                              foreach ($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                    <td class="h-6 w-1/12 text-sm border border-slate-700 text-center row-id" id="ROWNO_TD<?=$key?>"><?=isset($value['ROWCOUNTER']) ? $value['ROWCOUNTER']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left" id="METHODCD_TD<?=$key?>"><?=isset($value['METHODCD']) ? $value['METHODCD']: '' ?></td>
                                    <td class="hidden" id="METHODCDID_TD<?=$key?>"><?=isset($value['METHODCDID']) ? $value['METHODCDID']:'' ?></td>
                                    <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 text-left" id="METHODNAME_TD<?=$key?>"><?=isset($value['METHODNAME']) ? $value['METHODNAME']: '' ?></td>
                                    <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 text-left" id="MEMO_TD<?=$key?>"><?=isset($value['MEMO']) ? $value['MEMO']: '' ?></td>
                                    <td class="hidden" id="PMNOTE06_TD<?=$key?>"><?=isset($value['PMNOTE06']) ? $value['PMNOTE06']: '' ?></td>
                                    <td class="hidden" id="PMNOTE02_TD<?=$key?>"><?=isset($value['PMNOTE02']) ? $value['PMNOTE02']: '' ?></td>
                                    <td class="hidden" id="PMNOTE03_TD<?=$key?>"><?=isset($value['PMNOTE03']) ? $value['PMNOTE03']: '' ?></td>
                                    <td class="hidden" id="PMNOTE04_TD<?=$key?>"><?=isset($value['PMNOTE04']) ? $value['PMNOTE04']: '' ?></td>
                                    <td class="hidden" id="PMNOTE05_TD<?=$key?>"><?=isset($value['PMNOTE05']) ? $value['PMNOTE05']: '' ?></td>
                                    <td class="hidden" id="PMNOTE01_TD<?=$key?>"><?=isset($value['PMNOTE01']) ? $value['PMNOTE01']: '' ?></td>
                                    <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 text-left"></td>
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
                                </tr> <?php
                            } ?>
                          </tbody>
                      </table>

                  </div>   
                <div class="flex p-2">
                    <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="record"><?=$minrow;?></span></label>
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
                                        id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=checklang('INSERT'); ?></button>
                                      <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=checklang('UPDATE'); ?></button>
                                      <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-4 py-1 mr-2 text-center"
                                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=checklang('DELETE'); ?></button>
                                    </div>
                                    <div class="flex w-5/12 px-2 justify-end">
                                        <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                            id="CLEAR" name="CLEAR" onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                              onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?=checklang('END'); ?></button>
                                    </div>
                                </div>
                            </summary> 


                            <div class="flex mb-1 px-2">
                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('LINE')?></label>
                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                          name="ROWNO" id="ROWNO" value="<?=isset($data['ROWNO']) ? $data['ROWNO']: ''; ?>" readonly/>
                                <input class="hidden" type="checkbox" id="PMNOTE01" name="PMNOTE01" value="T" <?php echo (isset($data['PMNOTE01']) && $data['PMNOTE01'] == 'T') ? 'checked' : '' ?>/>
                                <input type="hidden" name="PMNOTE01" value="F"/>
                                <label class="hidden text-color block text-sm w-2/12 pl-2 pt-1"><?=checklang('WHTFLG'); ?></label>
                                <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('CODE')?></label>
                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 mr-2 py-2 px-3 text-gray-700 border-gray-300 read req"
                                      name="METHODCD" id="METHODCD" value="<?=isset($data['METHODCD']) ? $data['METHODCD']: ''; ?>" onchange="unRequired();"/>
                                <input  type="hidden" name="METHODCDID" id="METHODCDID" value="<?=isset($data['METHODCDID']) ? $data['METHODCDID']: ''; ?>"/>
                            </div>   

                            <div class="flex mb-1 px-2">
                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('DESCRIPTION')?></label>
                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 req"
                                      name="METHODNAME" id="METHODNAME" value="<?=isset($data['METHODNAME']) ? $data['METHODNAME']: ''; ?>" onchange="unRequired();"/>
                                <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('MEMO')?></label>
                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                                      name="MEMO" id="MEMO" value="<?=isset($data['MEMO']) ? $data['MEMO']: ''; ?>"/>
                            </div>   

                            <div class="flex mb-1 px-2">
                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('TYPE_OF_INCOME')?></label>
                                <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300" id="PMNOTE06" name="PMNOTE06">
                                    <option value=""></option>
                                    <?php foreach ($typeofincome as $typinckey => $typincitem) { ?>
                                        <option value="<?=$typinckey?>" <?=(isset($data['PMNOTE06']) && $data['PMNOTE06'] == $typinckey) ? 'selected' : '' ?>><?=$typincitem ?></option>
                                    <?php } ?>
                                </select>
                                <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('PAYMENT_TYPE')?></label>
                                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300"
                                      name="PMNOTE02" id="PMNOTE02" value="<?=isset($data['PMNOTE02']) ? $data['PMNOTE02']: ''; ?>"/>
                                <div class="w-4/12"></div>
                            </div>  
                  
                            <div class="flex mb-1 px-2">
                                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('TAX_TYPE')?></label>
                                <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300" id="PMNOTE03" name="PMNOTE03">
                                    <option value=""></option>
                                    <?php foreach ($taxtype as $taxtypkey => $taxtypitem) { ?>
                                        <option value="<?=$taxtypkey?>" <?=(isset($data['PMNOTE03']) && $data['PMNOTE03'] == $taxtypkey) ? 'selected' : '' ?>><?=$taxtypitem ?></option>
                                    <?php } ?>
                                </select>
                                <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('TAX_CONDITION')?></label>
                                <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300" id="PMNOTE04" name="PMNOTE04">
                                    <option value=""></option>
                                    <?php foreach ($taxcondition as $taxconkey => $taxconitem) { ?>
                                        <option value="<?=$taxconkey?>" <?=(isset($data['PMNOTE04']) && $data['PMNOTE04'] == $taxconkey) ? 'selected' : '' ?>><?=$taxconitem ?></option>
                                    <?php } ?>
                                </select>
                                <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('WHTRATE')?></label>
                                <input  type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300" 
                                        name="PMNOTE05" id="PMNOTE05" value="<?=isset($data['PMNOTE05']) ? $data['PMNOTE05']: ''; ?>"  
                                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('PERCENT')?></label>        
                            </div>  
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
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
        unRequired();
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
        selectRow();
    });

    function unRequired() {
        if($('#METHODCD').val() != '') {
            document.getElementById('METHODCD').classList.remove('req');
        } else {
            document.getElementById('METHODCD').classList.add('req');
        }
        
        if($('#METHODNAME').val() != '') {
            document.getElementById('METHODNAME').classList.remove('req');
        } else {
            document.getElementById('METHODNAME').classList.add('req');
        }
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            // insert
            return questionDialog(2, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');        
        } else if(type == 3) {
            // update
            return questionDialog(3, '<?=lang('question2')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');        
        } else if(type == 4) {
            // delete
            return questionDialog(4, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');       
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>