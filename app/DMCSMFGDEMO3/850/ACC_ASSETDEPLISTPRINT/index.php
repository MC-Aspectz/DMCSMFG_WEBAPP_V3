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
                <form class="w-full" method="POST" id="reportassetdepreciationlist" name="reportassetdepreciationlist" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                    <div class="flex mb-1 px-2 mt-3">
                        <div class="flex w-8/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['YEARMONTH']; ?></label>
                            <select class="text-control shadow-md border mr-1 px-3 h-7 ml-1 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    id="YEAR" name="YEAR" >
                                <option value=""></option>
                                <?php foreach ($yearvalue as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['YEAR']) && $data['YEAR'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                            </select>                      
                        </div>
                    </div>

                    <div class="flex mb-1 px-2">
                        <div class="flex w-full">
                            <label class="text-color block text-sm w-4/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['ASSETACCCD'];?></label>
                            <div class="relative w-8/12 mr-1">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    name="GA1" id="GA1" value="<?=isset($data['GA1']) ? $data['GA1']: ''?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="assetaccguide">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>   
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                   type="text" id="GANAME1" name="GANAME1" value="<?=isset($data['GANAME1']) ? $data['GANAME1'] :'' ?>" />

                            <label class="text-color block text-sm pr-2 pt-1 ml-2"><?=$data['TXTLANG']['ARROW'];?></label>
                            <div class="relative w-6/12 mr-1">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    name="GA2" id="GA2" value="<?=isset($data['GA2']) ? $data['GA2']: ''?>"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="assetaccguide2">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>    
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                   type="text" id="GANAME2" name="GANAME2" value="<?=isset($data['GANAME2']) ? $data['GANAME2'] :'' ?>" />                           
                        </div>
                    </div>

                    

                    
                    <div class="flex pt-10">
                        <div class="flex w-6/12">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="PRINT" name="PRINT"><?php echo $data['TXTLANG']['PRINT']; ?>
                                </button>
                        </div>

                        <div class="flex w-6/12 justify-end">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="clear" name="clear" onclick="unsetSession();"><?=$data['TXTLANG']['CLEAR']?>
                            </button>
                            <button type="button" id="end" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?php echo $data['TXTLANG']['END']; ?>
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
<script type="text/javascript">
    function actionDialog(type) {
        if(type == 1) {
            return alertWarning('<?=lang('validation1'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 2) {
            return questionDialog(type, '<?=lang('question3'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 3) {
            return questionDialog(type, '<?=lang('question2'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        } else if(type == 4) {
            return questionDialog(type, '<?=lang('question4'); ?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');   
        } else {
            return alertWarning(type, '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');
        }
    }

    
</script>
<script src="./js/script.js"></script>



</html>
