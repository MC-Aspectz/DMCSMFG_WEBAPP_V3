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
            <form class="w-full" method="POST" id="inventoryrollback" name="inventoryrollback" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INT_YEAR_MONTH')?></label>
                        <select id="YEAR" name="YEAR" class="text-control shadow-md border mr-1 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            <option value=""></option>
                            <?php foreach ($yearvalue as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['YEAR']) && $data['YEAR'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('YEAR')?></label>
                        <select id="MONTH" name="MONTH" class="text-control shadow-md border mr-1 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            <option value=""></option>
                            <?php foreach ($monthvalue as $key => $item) { ?>
                                <option value="<?=$key ?>" <?=(isset($data['MONTH']) && $data['MONTH'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ZENKAI_PRO')?></label>
                        <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                name="LASTBATCHMONTH" id="LASTBATCHMONTH" value="<?=isset($data['LASTBATCHMONTH']) ? $data['LASTBATCHMONTH']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex">
                    <div class="flex w-6/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                <?php if(!empty($data['SYSVIS_COMMIT']) && $data['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                                id="RUN" name="RUN" onclick="updated();"><?=checklang('RUN');?></button>
                    </div>
                    <div class="flex w-6/12 px-1 justify-end">
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                              onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['no']; ?>');"><?=checklang('END'); ?></button>
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
            // icon: 'success',
            text: '<?=$lang['success']; ?>',
            // background: '#8ca3a3',
            showCancelButton: false,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['no']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
             }
        });
    }

    function alertValidation() {
        Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=$lang['validation1']; ?>',
            // background: '#8ca3a3',
            showCancelButton: false,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['no']; ?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }

    function errorDialog() {
        return Swal.fire({ 
            title: '',
            text: '<?=$lang['ERRORUNCHECK']; ?>',
            showCancelButton: false,
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['no']; ?>'
            }).then((result) => {
            if (result.isConfirmed) {
            }
        });
    }
</script>
<script src="./js/script.js"></script>
</html>
