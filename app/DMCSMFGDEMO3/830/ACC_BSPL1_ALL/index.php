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
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" action="" id="accBSPL1All" name="accBSPL1All" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300"
                                id="RPTFORMTYP" name="RPTFORMTYP" >
                            <option value=""></option>
                            <?php foreach ($rptform as $rptkey => $rptitem) { ?>
                                <option value="<?=$rptkey ?>" <?=(isset($data['RPTFORMTYP']) && $data['RPTFORMTYP'] == $rptkey) ? 'selected' : '' ?>><?=$rptitem ?></option>
                            <?php } ?>
                        </select>
                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300"
                                id="ACCY" name="ACCY" >
                            <option value=""></option>
                            <?php foreach ($accyearvalue as $accyearkey => $accyearitem) { ?>
                                <option value="<?=$accyearkey ?>" <?=(isset($data['ACCY']) && $data['ACCY'] == $accyearkey) ? 'selected' : '' ?>><?=$accyearitem ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('YEARMONTH')?></label>
                        <select id="YEAR" name="YEAR" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300">
                            <option value=""></option>
                            <?php foreach ($yearvalue as $yearkey => $yearitem) { ?>
                                <option value="<?=$yearkey ?>" <?=(isset($data['YEAR']) && $data['YEAR'] == $yearkey) ? 'selected' : '' ?>><?=$yearitem ?></option>
                            <?php } ?>
                        </select>
                        <select id="MONTH" name="MONTH" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300"
                                onchange="unRequired();" required>
                            <option value=""></option>
                            <?php foreach ($monthvalue as $monthkey => $monthitem) { ?>
                                <option value="<?=$monthkey ?>" <?=(isset($data['MONTH']) && $data['MONTH'] == $monthkey) ? 'selected' : '' ?>><?=$monthitem ?></option>
                            <?php } ?>
                        </select>
                        <label class="text-color block text-sm pt-1 w-1/12 text-center">→</label>
                        <select id="MONTH2" name="MONTH2" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300"
                                onchange="unRequired();" required>
                                <option value=""></option>
                                <?php foreach ($monthvalue as $monthkey2 => $monthitem2) { ?>
                                    <option value="<?=$monthkey2 ?>" <?=(isset($data['MONTH2']) && $data['MONTH2'] == $monthkey2) ? 'selected' : '' ?>><?=$monthitem2 ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                        <label class="text-color block text-sm w-8/12 pl-3 pt-1"><?=checklang('DMCSREM3')?></label>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex">
                    <div class="flex w-6/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="PRINT" name="PRINT"><?=checklang('PRINT');?></button>
                    </div>
                    <div class="flex w-6/12 px-1 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=checklang('END'); ?></button>
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
    });
    function unRequired() {
       let month = document.getElementById('MONTH');
        if(month.selectedIndex != 0) {
            month.classList.remove('req');
        } else {
            month.classList.add('req');
        }
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            return questionDialog(2, '<?=lang('question2'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>