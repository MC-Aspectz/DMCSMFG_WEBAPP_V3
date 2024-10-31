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
            <form class="w-full" method="POST" id="calendarMaster" name="calendarMaster" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=checklang('DEF_CAL'); ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-full px-2">
                                        <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('START_MAKING')?></label>
                                        <input type="date" class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="FROMDATE" name="FROMDATE" value="<?=!empty($load['FROMDATE']) ? date('Y-m-d', strtotime($load['FROMDATE'])) : date('Y-m-d'); ?>"/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-full px-2">
                                        <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('STD_WORKDAY')?></label><?php
                                        foreach ($DAYOFWEEK as $key => $item) { ?>
                                            <input type="hidden" name="CHKDAY<?=$key?>" value="F"/>
                                            <input type="checkbox" id="CHKDAY<?=$key?>" name="CHKDAY<?=$key?>" value="T" onchange="javascript:getElement('changeChkDay', this.value);"
                                                    <?=isset($load['CHKDAY'.$key]) && $load['CHKDAY'.$key] == 'T' ? 'checked' : '' ?> />
                                            <label class="text-color block text-sm font-normal w-1/12 pl-4 pt-1"><?=$item?></label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <button type="button" class="btn text-color inline-flex justify-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-3xl text-sm font-medium px-5 py-0.5"
                                                id="CREATE" name="CREATE"><?=checklang('CREATE')?>
                                            <svg class="w-4 h-4 ml-2 mt-0.5" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <hr class="divide-y divide-dotted my-2 mx-2">

                <div class="flex flex-col">
                    <div class="p-1.5 inline-block align-middle">
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"><?=checklang('FAC_CAL'); ?></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-full px-2">
                                        <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('START_MAKING')?></label>
                                        <select class="text-control shadow-sm border h-7 w-2/12 px-3 text-[12px] rounded-xl border-gray-300" id="FACTORYCODE" name="FACTORYCODE">
                                            <option value=""></option>
                                            <?php foreach ($FACTORY as $key => $item) { ?>
                                                <option value="<?=$key?>"><?=$item ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-full px-2">
                                        <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('MODIFY_WORKDAY')?></label>
                                        <input type="date" class="text-control text-sm shadow-sm border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                id="MONTH" name="MONTH" value=""/>
                                    </div>
                                </div>

                                <div id='calendar' class="w-full px-2 my-2">
                                    <table id="table" class="w-full border-collapse divide-gray-200">
                                        <thead>
                                            <tr class=""><?php
                                                foreach ($DAYOFWEEK as $key => $item) { ?>
                                                <th class="h-10 px-2 text-center">
                                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$item?></span>
                                                </th><?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($i = 0; $i <= 5 ; $i++) { ?>
                                            <tr class="border border-gray-600"> <?php
                                                foreach ($DAYOFWEEK as $key => $item) { ?>
                                                    <td class="h-16 w-16 pl-4 text-sm font-medium border border-slate-700 bg-[#ede9fe]" id="LBLDAY<?=$i.$key?>_TD" onclick="javascript:setHoliday('<?=$i.$key?>');"></td>
                                                    <td class="hidden"><input type="text" id="LBLDAY<?=$i.$key?>" name="LBLDAY<?=$i.$key?>" value=""></td>
                                                    <td class="hidden"><input type="text" id="RED_LBLDAY<?=$i.$key?>" name="RED_LBLDAY<?=$i.$key?>" value=""></td>
                                                <?php } ?>
                                            </tr>
                                         <?php } ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="STARTDAY" name="STARTDAY" value="<?=!empty($load['STARTDAY']) ? $load['STARTDAY']: '' ?>">
                                    <input type="hidden" id="ISHOLIDAY" name="ISHOLIDAY" value="<?=!empty($load['ISHOLIDAY']) ? $load['ISHOLIDAY']: '' ?>">
                                </div>
                            </details>
                        </div>
                    </div>
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-8/12"></div>
                    <div class="flex w-4/12 justify-end">
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
<script src="./js/script.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // 
    });
</script>
</html>
