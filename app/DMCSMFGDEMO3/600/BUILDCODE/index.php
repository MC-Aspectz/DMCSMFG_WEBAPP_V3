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
            <form class="w-full" method="POST" id="buildcode" name="buildcode" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('COSTSC')?></label>
                        <select id="COSTSC" name="COSTSC" class="text-control text-sm shadow-md border mr-1 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300">
                            <option value=""></option>
                            <?php foreach ($costsc as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['COSTSC']) && $data['COSTSC'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BOMDATE')?></label>
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                name="BOMDATE" id="BOMDATE" value="<?=!empty($data['BOMDATE']) ? date('Y-m-d', strtotime($data['BOMDATE'])) : date('Y-m-d'); ?>"/>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                        <input type="hidden" name="ESTPRICEUPDATE[]" value="F"/>
                        <input class="mt-1" type="checkbox" id="ESTPRICEUPDATE" name="ESTPRICEUPDATE[]" value="T" <?=isset($value['ESTPRICEUPDATE']) && $value['ESTPRICEUPDATE'] == 'T' ? 'checked' : '' ?>/>
                        <label class="text-color block text-sm w-8/12 pl-3 pt-1"><?=checklang('ESTPRICEUPDATE')?></label>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex">
                    <div class="flex w-6/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="RUN" name="RUN" onclick="run();" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> disabled <?php }?>
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('RUN');?></button>
                    </div>
                    <div class="flex w-6/12 px-1 justify-end">
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
<script type="text/javascript">
    function alertSuccess() {
        Swal.fire({ 
            title: '',
            icon: 'success',
            text: '<?=lang('success');?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes');?>',
            cancelButtonText: '<?=lang('nono');?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }

    function alertValidation() {
        Swal.fire({ 
            title: '',
            icon: 'warning',
            text: '<?=lang('msg1');?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes');?>',
            cancelButtonText: '<?=lang('nono');?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }
</script>
<script src="./js/script.js"></script>
</html>
