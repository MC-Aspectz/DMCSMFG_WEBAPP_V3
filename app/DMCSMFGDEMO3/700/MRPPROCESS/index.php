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
            <form class="w-full" method="POST" id="MRPProcess" name="MRPProcess" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('PLANDATE')?></label>
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                name="FROMDATE" id="FROMDATE" value="<?=!empty($data['FROMDATE']) ? date('Y-m-d', strtotime($data['FROMDATE'])) : date('Y-m-d'); ?>"/>
                        <label class="text-color block text-sm w-1/12 text-center"><?=checklang('ARROW')?></label>
                        <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                name="TODATE" id="TODATE" value="<?=!empty($data['TODATE']) ? date('Y-m-d', strtotime($data['TODATE'])) : date('Y-m-d'); ?>"/>
                        <input class="read" type="hidden" id="SYSTIMESTAMP" name="SYSTIMESTAMP" value="<?=!empty($data['SYSTIMESTAMP']) ? $data['SYSTIMESTAMP']: ''; ?>" />
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('FACTORYNAME')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300" id="FACTORYCODE" name="FACTORYCODE">
                            <option value=""></option>
                            <?php foreach ($factory as $fac => $factoryitem) { ?>
                                <option value="<?=$fac ?>" <?php echo (isset($data['FACTORYCODE']) && $data['FACTORYCODE'] == $fac) ? 'selected' : '' ?>><?=$factoryitem ?></option>
                            <?php } ?>
                        </select>
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('MRPTYPE')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 req" id="MANUFACTURINGPRO" name="MANUFACTURINGPRO" onchange="unRequired();" required>
                            <option value=""></option>
                            <?php foreach ($manufacturingpro as $facturingpro => $facturingproitem) { ?>
                                <option value="<?=$facturingpro ?>" <?php echo (isset($data['MANUFACTURINGPRO']) && $data['MANUFACTURINGPRO'] == $facturingpro) ? 'selected' : '' ?>><?=$facturingproitem ?></option>
                            <?php } ?>
                        </select>
                        <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('MRPINV')?></label>
                        <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 req" id="MANUFACTURINGTYPE" name="MANUFACTURINGTYPE" onchange="unRequired();" required>
                            <option value=""></option>
                            <?php foreach ($manufacturingtype as $facturingtype => $facturingtypeitem) { ?>
                                <option value="<?=$facturingtype ?>" <?php echo (isset($data['MANUFACTURINGTYPE']) && $data['MANUFACTURINGTYPE'] == $facturingtype) ? 'selected' : '' ?>><?=$facturingtypeitem ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12 px-2">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"></label>
                        <input type="checkbox" class="mt-1" id="BMREPLACE" name="BMREPLACE" value="T"/>
                        <label class="text-color block text-sm w-8/12 pl-2 pt-1"><?=checklang('BMREPLACE')?></label>
                    </div>
                    <div class="flex w-4/12 px-2"></div>
                </div>

                <div class="flex">
                    <div class="flex w-6/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                                id="RUN" name="RUN" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> disabled <?php }?>
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>><?=checklang('RUN');?></button>
                    </div>
                    <div class="flex w-6/12 px-1 justify-end">
                        <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CLEAR" onclick="clearForm(this.form);"><?=checklang('CLEAR'); ?></button>
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
</html>
<script src="./js/script.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
    });

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=$lang['validation1']; ?>',
            showCancelButton: false,
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['no']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }
</script>