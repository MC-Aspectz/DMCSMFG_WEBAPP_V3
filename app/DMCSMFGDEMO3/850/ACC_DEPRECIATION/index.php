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
                <form class="w-full" method="POST" action="" id="accDepeciation" name="accDepeciation" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                    <div class="flex mb-1 px-2 mt-3">
                        <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['YEARMONTH']; ?></label>
                        <select class="text-control shadow-md border mr-1 px-3 h-7 ml-1 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                id="YEAR" name="YEAR" onchange="getCalcDate(); unRequired();" required>
                        <option value=""></option>
                            <?php foreach ($yearvalue as $yearkey => $yearitem) { ?>
                                <option value="<?=$yearkey ?>" <?=(isset($data['YEAR']) && $data['YEAR'] == $yearkey) ? 'selected' : '' ?>><?=$yearitem ?></option>
                            <?php } ?>
                        </select>
                        <select class="text-control shadow-md border mr-1 px-3 h-7 ml-1 w-2/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                id="MONTH" name="MONTH" onchange="getCalcDate(); unRequired();" required>
                        <option value=""></option>
                            <?php foreach ($monthvalue as $monthkey => $monthitem) { ?>
                                <option value="<?=$monthkey ?>" <?=(isset($data['MONTH']) && $data['MONTH'] == $monthkey) ? 'selected' : '' ?>><?=$monthitem ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="flex mb-1 px-2 mt-2">
                        <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['ZENKAI_PRO']; ?></label>
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                               type="text" name="PREYYMM" id="PREYYMM" value="<?=isset($data['PREYYMM']) ? $data['PREYYMM']: ''; ?>"/>
                        <input class="hidden" type="text" name="ACCY" id="ACCY" value="<?=isset($data['ACCY']) ? $data['ACCY']: ''; ?>"/>
                        <input class="hidden" type="text" name="CURRENCY1" id="CURRENCY1" value="<?=isset($data['CURRENCY1']) ? $data['CURRENCY1']: ''; ?>"/>
                        <input class="hidden" type="date" id="ISSUEDATE" name="ISSUEDATE" value="<?=!empty($data['ISSUEDATE']) ? date('Y-m-d', strtotime($data['ISSUEDATE'])): ''; ?>"/>
                        <input class="hidden" type="text" id="CALCDATE" name="CALCDATE" value="<?=isset($data['CALCDATE']) ? $data['CALCDATE']: ''; ?>"/>
                    </div>

                    <div class="flex pt-10">
                        <div class="flex w-6/12">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['COMMIT']; ?>
                            </button>
                        </div>
                        
                        <div class="flex w-6/12">
                            <button type="reset"  class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="CLEAR" name="CLEAR" onclick="unsetSession(this.form); window.location.href = '../ACC_DEPRECIATION/';"><?=$data['TXTLANG']['CLEAR']?>
                            </button>
                            <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=$data['TXTLANG']['END']; ?>
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
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
    });
    
    function unRequired() {
        let month = document.getElementById("MONTH");
        if(month.selectedIndex != 0) {
            month.classList.remove('req');
        } else {
            month.classList.add('req');
        }
        let year = document.getElementById("YEAR");
        if(year.selectedIndex != 0) {
            year.classList.remove('req');
        } else {
            year.classList.add('req');
        }
    }

    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            return questionDialog(2, '<?=lang('question2'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 3) {
            return alertWarning('<?=lang('complete'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }
</script>
</html>