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
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="com_operation_setting" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

                <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                    <div class="flex mt-1 mb-1">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-6/12 pr-2 pt-1 ml-2"><?=checklang('TITLE_PROD_MT'); ?></label>
                        </div>
                    </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('FORM_ORDER'); ?></label>
                        <select class="text-control shadow-md border mr-1 px-3 h-7 ml-3 w-5/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="PRODUCTION_ORDER_NO" name="PRODUCTION_ORDER_NO">
                            <option value=""></option>
                                <?php foreach ($set_order as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['cos']['PRODUCTION_ORDER_NO']) && $data['cos']['PRODUCTION_ORDER_NO'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                        </select>
                    </div>

                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('BOMLENGTH'); ?></label>
                        <select class="text-control shadow-md border mr-1 px-3 h-7 ml-3 w-5/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="BOMLENGTH" name="BOMLENGTH">
                            <option value=""></option>
                                <?php foreach ($set_bomlength as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['cos']['BOMLENGTH']) && $data['cos']['BOMLENGTH'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('KEY_ORDER_PROD'); ?></label>
                        <select class="text-control shadow-md border mr-1 px-3 h-7 ml-3 w-5/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="KEY_PRODUCTION" name="KEY_PRODUCTION">
                            <option value=""></option>
                                <?php foreach ($set_purchrule as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['cos']['KEY_PRODUCTION']) && $data['cos']['KEY_PRODUCTION'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12">
                        <label>----------------------------------------------------------------------------------------------</label>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('TITLE_INV_MT'); ?></label>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['WITHDRAWTYPE']; ?></label>
                        <select class="text-control shadow-md border mr-1 px-3 h-7 ml-3 w-5/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="AUTOWD_PRODUCT" name="AUTOWD_PRODUCT">
                            <option value=""></option>
                                <?php foreach ($withdraw_produ as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['cos']['AUTOWD_PRODUCT']) && $data['cos']['AUTOWD_PRODUCT'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="flex pt-12">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                            <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?></button>
                    </div>

                    <div class="flex w-6/12 justify-end">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="end" name="end" ><?=$data['TXTLANG']['END']; ?></button>
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
<script type="text/javascript">

    $("#end").on('click', function() {
        Swal.fire({ 
            title: '',
            text: '<?=$lang['question1']; ?>',
            // background: '#8ca3a3',
            showCancelButton: true,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['no']; ?>'
            }).then((result) => {
            if (result.isConfirmed) {
                programDelete();
            }
        });
    });

</script>
</html>
