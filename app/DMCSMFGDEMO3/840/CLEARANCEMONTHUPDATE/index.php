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
                <form class="w-full" method="POST" id="stockupdatemonthly" name="stockupdatemonthly" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                    
                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                    <div class="flex mb-1 px-2 mt-1">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('CLEARANCE_ID'); ?></label>
                            <select class="text-control shadow-md border mr-1 px-3 h-7 ml-4 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    id="CLEARANCE" name="CLEARANCE" >
                                <option value=""></option>
                                    <?php foreach ($clearances as $key => $item) { ?>
                                <option value="<?php echo $key ?>" <?php echo (isset($data['CMU']['CLEARANCE']) && $data['CMU']['CLEARANCE'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                <?php } ?>
                            </select>        
                        </div>

                        <div class="flex w-6/12"></div>
                    </div>

                    <div class="flex mb-1 px-2 mt-1">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('INT_YEAR_MONTH'); ?></label>
                            <select class="text-control shadow-md border mr-1 px-3 h-7 ml-4 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    id="YEAR" name="YEAR" >
                                <option value=""></option>
                                    <?php foreach ($yearvalue as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['CMU']['YEAR']) && $data['CMU']['YEAR'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                    <?php } ?>
                            </select> 
                            <label class="text-color block text-sm pr-2 pt-1 ml-2"><?=checklang('YEAR'); ?></label>
                            <select class="text-control shadow-md border mr-1 px-3 h-7 ml-4 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    id="MONTH" name="MONTH" >
                                <option value=""></option>
                                    <?php foreach ($monthvalue as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['CMU']['MONTH']) && $data['CMU']['MONTH'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                    <?php } ?>
                            </select>         
                        </div>                
                    </div>


                    <div class="flex mb-1 px-2 mt-1">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('ZENKAI_PRO'); ?></label> 
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 ml-4 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                   type="text" id="LASTBATCHMONTH" name="LASTBATCHMONTH" value="<?=isset($data['CMU']['LASTBATCHMONTH']) ? $data['CMU']['LASTBATCHMONTH']: ''?>" readonly />
                        </div>  

                        <div class="flex w-6/12">

                        </div>
                            
                    </div>

                    <div class="flex mb-1 px-2 mt-1">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2 mr-4"></label> 
                            <input type="checkbox" id="DIFFFLG" name="DIFFFLG" tyle="width: 15px" checked value="1" readonly/>&emsp;
                            
                            <!-- <?php echo (!empty($data['CMU']['DIFFFLG']) && $data['CMU']['DIFFFLG'] == 'T') ? 'checked' : '' ?>  -->
                            <label class="text-color block text-sm w-4/12 pr-2 pt-1 ml-2"><?=checklang('CLEARANCEMSGDIFF'); ?></label> 
                            </div>   

                        <div class="flex w-6/12"></div>
                            
                    </div>


                    <div class="flex mb-1 px-2 mt-1">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2 mr-4"></label> 
                            <input type="checkbox" id="ADJUSTFLG" name="ADJUSTFLG" value="T" style="width: 15px"
                            
                            <?php echo (!empty($data['CMU']['ADJUSTFLG']) && $data['CMU']['ADJUSTFLG'] == 'T') ? 'checked' : '' ?> />&emsp;
                            <label class="text-color block text-sm w-6/12 pr-2 pt-1 ml-2"><?=checklang('CLEARANCEMSGADJUST'); ?></label> 
                        </div>   

                        <div class="flex w-6/12"></div>
                            
                    </div>

                    <div class="flex mt-6">
                        <div class="flex w-3/12">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="run" name="run">Run
                            </button>    
                        </div>

                        <div class="flex w-3/12 justify-end">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="end" ><?php echo $data['TXTLANG']['END']; ?>
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
    $("#end").on('click', function() {
        Swal.fire({ 
            title: '',
            text: '<?=$lang['question1']; ?>',
            // background: '#8ca3a3',
            showCancelButton: true,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                    programDelete(); 
                }
        });
    });

    function alertValidation() {
        Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=$lang['validation1']; ?>',
            background: '#8ca3a3',
            showCancelButton: false,
            confirmButtonColor: 'silver',
            cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }
</script>
<script src="./js/script.js"></script>
</html>
