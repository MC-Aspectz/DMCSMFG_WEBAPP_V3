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
            <form class="w-full" method="POST" action="" id="exchangeratemaster" name="exchangeratemaster" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
 
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DESTINATE_CURRENCY'); ?></label>
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" 
                               type="text" id="EXRATETO" name="EXRATETO" value="<?=isset($data['EXRATETO']) ? $data['EXRATETO']: ''; ?>"readonly/>&emsp;
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 " 
                               type="hidden" id="EXRATETODISPH" name="EXRATETODISPH" value="<?=isset($data['EXRATETODISPH']) ? $data['EXRATETODISPH']: ''; ?>"readonly/>
                    </div>

                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('EXCHANGE_MONTH'); ?></label>
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                            type="date" id="EXDATE" name="EXDATE" <?php if(isset($data['EXDATE'])){ ?> value="<?=date('Y-m-d', strtotime($data['EXDATE'])); ?>"<?php } else { ?> value="" <?php }?> onchange="unRequired();"/>

                        <div class="flex w-6/12 justify-end">
                            <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                    id="SEARCH" name="SEARCH" onclick="searchs();"><?=checklang('SEARCH')?>
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>  
                </div>

                <div class="flex w-full px-2 my-2">
                    <div class="flex flex-col w-6/12 overflow-scroll block">
                        <div class="overflow-scroll block h-[400px] max-h-[400px]">
                            <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="table" rules="cols" cellpadding="3" cellspacing="1">
                                <thead class="sticky top-0 bg-gray-50">
                                    <tr class="border border-gray-600">
                                        <th class="px-3 text-center border border-slate-700 whitespace-nowrap"><?=checklang('EXCHANGE_MONTH'); ?></th>
                                        <th class="px-3 text-center border border-slate-700 whitespace-nowrap"><?=checklang('EXCHANGESOURCE'); ?></th>
                                        <th class="px-3 text-center border border-slate-700 whitespace-nowrap"><?=checklang('EXCHANGE_RATE'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto">
                                    <?php if(!empty($data['CUR']))  {
                                        foreach ($data['CUR'] as $key => $value) { 
                                        if(is_array($value)) {
                                        $minrow = count($data['CUR']);
                                        ?>
                                            <tr class="border border-gray-600" id="rowId<?=$key?>">
                                            
                                                <td class="h-6 w-2/12 pl-1 text-center text-sm border border-slate-700 whitespace-nowrap"><?=isset($value['EXRATEMONTHCUR']) ? $value['EXRATEMONTHCUR']: '' ?></td>
                                                <td class="h-6 w-2/12 pl-1 text-center text-sm border border-slate-700 whitespace-nowrap"><?=isset($value['EXRATEFRCUR']) ? $value['EXRATEFRCUR']: '' ?></td>
                                                <td class="h-6 w-2/12 pl-1 text-right text-sm border border-slate-700 whitespace-nowrap"><?=isset($value['EXRATECUR']) ? $value['EXRATECUR']:'' ?></td>
                                                
                                
                                                <!-- <input type="hidden" name="FORMROWNUMA" value="<?=isset($value['FORMROWNUM']) ? $value['FORMROWNUM']: '' ?>">
                                                <input type="hidden" name="FORMLEVELA" value="<?=isset($value['FORMLEVEL']) ? $value['FORMLEVEL']: '' ?>"> -->
                                            
                                            </tr><?php 
                                        }
                                        else {
                                            $minrowB = 1; ?>
                                            <tr class="border border-gray-600">
                                                <td class="h-6 border border-slate-700"><?=$data['CUR']['EXRATEMONTHCUR'] ?></td>
                                                <td class="h-6 border border-slate-700"><?=$data['CUR']['EXRATEFRCUR'] ?></td>
                                                <td class="h-6 border border-slate-700"><?=$data['CUR']['EXRATECUR'] ?></td>
                                                
                                                
                                                <!-- <td class="td-class"style="display:none;"><?=$data['DET']['WHTAXTYPE'] ?></td> -->  
                                            </tr><?php
                                            break;
                                            }
                                    }
                                        for ($i = $minrow+1; $i <= $maxrow; $i++) {  ?>
                                            <tr class="border border-gray-600" id="rowId<?=$i?>">
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                                
                                            </tr> <?php 
                                        }
                                    } else {                            
                                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                            <tr class="border border-gray-600" id="rowId<?=$i?>">
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                            
                                            </tr><?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
                            <div class="flex p-2">
                                <label class="text-color text-[12px]"><?=str_repeat('&emsp;', 1).$data['TXTLANG']['ROWCOUNT'].str_repeat('&ensp;', 1); ?><label id="record"><?=$minrow; ?></label>
                            </div>
                        </div>
                    </div>
                    

                    <div class="flex flex-col w-6/12 overflow-scroll block">
                        <div class="overflow-scroll block h-[200px] max-h-[200px]">
                            <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="table_acc" rules="cols" cellpadding="3" cellspacing="1">
                                <thead class="sticky top-0 bg-gray-50">
                                    <tr class="border border-gray-600">
                                        <th class="px-6 text-center border border-slate-700 whitespace-nowrap"><?=checklang('EXCHANGE_MONTH'); ?></th>
                                        <th class="px-3 text-center border border-slate-700 whitespace-nowrap"><?=checklang('EXCHANGESOURCE'); ?></th>
                                        <th class="px-3 text-center border border-slate-700 whitespace-nowrap"><?=checklang('EXCHANGEDESTINATION'); ?></th>
                                        <th class="px-6 text-center border border-slate-700 whitespace-nowrap"><?=checklang('EXCHANGE_RATE'); ?></th>
                                    </tr>
                                </thead>
                                <?php  //print_r($data['DET']); ?>
                                <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto" id="dvwdetail2">
                                <?php if(!empty($data['DET']))  {
                                foreach ($data['DET'] as $key => $value) {
                                // print_r($data['DET']);
                                    if(is_array($value)) {
                                        
                                    $minrowB = count($data['DET']) ;
                                    ?>
                                            <tr class="border border-gray-600" id="rowIdB<?=$key?>">
                                                <td class="h-6 w-3/12 pl-1 text-center text-sm border border-slate-700 whitespace-nowrap"><?=isset($value['EXRATEMONTH']) ? $value['EXRATEMONTH']: '77777' ?></td>
                                                <td class="h-6 w-3/12 pl-1 text-center text-sm border border-slate-700 whitespace-nowrap"><?=isset($value['EXRATEFR']) ? $value['EXRATEFR']:'' ?></td>                                        
                                                <td class="h-6 w-3/12 pl-1 text-center text-sm border border-slate-700 whitespace-nowrap"><?=isset($value['EXRATEFRDISP']) ? $value['EXRATEFRDISP']:'' ?></td>
                                                <td class="h-6 w-3/12 pl-1 text-right text-sm border border-slate-700 whitespace-nowrap"><?=isset($value['EXRATE']) ? $value['EXRATE']:'' ?></td>  
                                            </tr><?php 
                                        }
                                        else {
                                            $minrowB = 1; ?>
                                            <tr class="border border-gray-600">
                                                <td class="h-6 border border-slate-700 text-center"><?=$data['DET']['EXRATEMONTH'] ?></td>
                                                <td class="h-6 border border-slate-700 text-center"><?=$data['DET']['EXRATEFR'] ?></td>
                                                <td class="h-6 border border-slate-700 text-center"><?=$data['DET']['EXRATEFRDISP'] ?></td>
                                                <td class="h-6 border border-slate-700 text-right"><?=$data['DET']['EXRATE'] ?></td>
                                                
                                                <!-- <td class="td-class"style="display:none;"><?=$data['DET']['WHTAXTYPE'] ?></td> -->  
                                            </tr><?php
                                            break;
                                            }
                                    }
                                        for ($i = $minrowB+1; $i <= $maxrowB; $i++) {  ?>
                                            <tr class="border border-gray-600" id="rowIdB<?=$i?>">
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                            </tr> <?php 
                                        }
                                    } else {                            
                                        for ($i = $minrowB+1; $i <= $maxrowB; $i++) { ?>
                                            <tr class="border border-gray-600" id="rowIdB<?=$i?>">
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                                <td class="h-6 border border-slate-700"></td>
                                            </tr><?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
                            <div class="flex p-2">
                                <label class="text-color text-[12px]"><?=str_repeat('&emsp;', 2).$data['TXTLANG']['ROWCOUNT'].str_repeat('&ensp;', 2); ?><label id="record2"><?=$minrowB; ?></label>
                            </div>
                        </div>

                        <div class="flex mt-2 ml-1">
                            <div class="flex w-full">
                                <label class="text-color block text-sm w-4/12 pr-2 pt-1 ml-2"><?=checklang('SOURCE_CURRENCY'); ?></label>
                                <div class="relative w-4/12 mr-1">
                                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                        name="EXRATEFR" id="EXRATEFR" value="<?=isset($data['EXRATEFR']) ? $data['EXRATEFR']: ''?>" onchange="unRequired();"/>
                                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                        id="SEARCHCURRENCY">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <input class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" 
                                       type="text" name="EXRATEFRDISP" id="EXRATEFRDISP" value="<?=isset($data['EXRATEFRDISP']) ? $data['EXRATEFRDISP']: ''; ?>" readonly/>
                            </div>
                        </div>

                        <div class="flex mt-2 ml-1">
                            <div class="flex w-10/12">
                                <label class="text-color block text-sm w-4/12 pr-2 pt-1 ml-2 mr-1"><?=checklang('EXCHANGE_RATE'); ?></label>
                                <input class="text-control shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                       type="text" name="EXRATE" id="EXRATE" value="<?=isset($data['EXRATE']) ? $data['EXRATE']: ''; ?>" onchange="unRequired();"/>
                                <button type="reset" id="CLEAR" hidden ="true" name="CLEAR" class="btn btn-outline-secondary btn-action" onclick="unsetSession(this.form);"><?=$data['TXTLANG']['CLEAR']?></button>&emsp;&emsp;
                            
                                
                                <!-- <div class="width30"></div> -->
                            </div>
                        </div>

                        <div class="flex mt-12">
                            <div class="flex w-8/12">

                                <?php $checkexratefr = isset($data['SYSVIS_INS']) ? $data['SYSVIS_INS'] :'' ?>
                                <input class="form-control width10" type="hidden" id="SYSVIS_INS" name="SYSVIS_INS" value="<?php isset($data['SYSVIS_INS']) ? $data['SYSVIS_INS'] :''?>"readonly/>&emsp;

                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                        id="insert" name="insert"
                                    <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['INSERT']?>
                                </button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        id="UPDATE" name="UPDATE"
                                    <?php if(!empty($data['SYSVIS_UPDATE']) && $data['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['UPDATE']; ?>
                                </button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                        id="DELETE" name="DELETE"
                                    <?php if(!empty($data['SYSVIS_DELETE']) && $data['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['DELETE']; ?>
                                </button>
                            </div>

                            <div class="flex w-3/12 justify-right">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                        id="ENT" name="ENT" onclick="entry();"><?=$data['TXTLANG']['ENTRY']; ?></button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                        id="end" name="end" onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=$data['TXTLANG']['END']?></button>
                            </div>
                        </div>


                    

                        <!-- <div class="flex col-100 justify-right" style="margin-top: auto;">
                            <button type="reset" id="CLEAR" name="CLEAR" class="btn btn-outline-secondary btn-action" onclick="unsetSession(this.form);"><?=$data['TXTLANG']['CLEAR']?></button>&emsp;&emsp;
                            <button type="button" id="END" class="btn btn-outline-secondary btn-action"
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=$data['TXTLANG']['END']; ?></button>
                        </div> -->
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

</html>