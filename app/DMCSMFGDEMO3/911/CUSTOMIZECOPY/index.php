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
                <form class="w-full" method="POST" id="customizecopy" name="customizecopy" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                    
                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2">PROGRAMID</label>
                            <div class="relative w-4/12 mr-1 ml-5">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                    name="APPID" id="APPID" value="<?=isset($data['APPID']) ? $data['APPID']: ''?>" onchange="unRequired();" required/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="SEARCHPROGRAM">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input class="text-control shadow-md border rounded-xl h-7 w-7/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                   type="text" id="APPNM" name="APPNM"  value="<?=isset($data['APPNM']) ? $data['APPNM']: ''?>" readonly />  
                                                                        
                        </div>

                        <div class="flex w-6/12"></div>
                    </div>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2">NEW_PROGRAMID</label>          
                            <input class="text-control shadow-md border rounded-xl h-7 w-10/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                   type="text" id="NEWAPPID" name="NEWAPPID" value="<?php echo $NEWAPPID ?>" onchange="unRequired();" required/>                                           
                        </div>

                        <div class="flex w-6/12"></div>
                    </div>


                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2">NEW_PGNAME</label>          
                            <input class="text-control shadow-md border rounded-xl h-7 w-10/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                   type="text" id="NEWAPPNM" name="NEWAPPNM" value="<?php echo $NEWAPPNM ?>" onchange="unRequired();" required/>                                          
                        </div>

                        <div class="flex w-6/12"></div>
                    </div>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm pr-2 pt-1 ml-2"></label>   
                            <input type="checkbox" id="SERLOGFLG" name="SERLOGFLG" value="T" style="width: 15px"
                                <?php echo (isset($data['SERLOGFLG']) && $data['SERLOGFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                            <label class="text-color block text-sm w-4/12 pr-2 pt-1 ml-2">COPY WITH SYSLOGIC</label>
                        </div>
                        
                        <div class="flex w-6/12"></div>
                    </div>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm pr-2 pt-1 ml-2"></label>   
                            <input type="checkbox" id="MANFLG" name="MANFLG" value="T" style="width: 15px"
                                <?php echo (isset($data['MANFLG']) && $data['MANFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                            <label class="text-color block text-sm w-4/12 pr-2 pt-1 ml-2">COPY WITH MANUAL</label>
                        </div> 
                            
                        <div class="flex w-6/12"></div>
                    </div>
                    

                    <div class="flex mb-1 px-2 mt-4">
                        <div class="flex w-6/12">
                            <div class="flex w-6/12">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="copy" name="copy"><?=$data['TXTLANG']['COPY']?></button>
                            </div>

                            <div class="flex w-6/12 justify-end">
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        id="clear" name="clear" onclick="unsetSession();"><?=$data['TXTLANG']['CLEAR']?></button>
                                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                        id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?=$data['TXTLANG']['END']?></button>
                            </div>
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

var langs = <?php echo json_encode($langs); ?>;
const SEARCHPROGRAM = $("#SEARCHPROGRAM");

SEARCHPROGRAM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPROGRAM/index.php?page=CUSTOMIZECOPY&LANG_S='+ langs , 'authWindow', 'width=1200,height=600');});

    $(document).ready(function() {
        unRequired();
    });
    
    $("#end").on('click', function() {
        Swal.fire({ 
            title: '',
            text: '<?=$lang['question1']; ?>',
            // background: '#8ca3a3',
            showCancelButton: true,
            // // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                    unsetSession(form); 
                    programDelete();
                }
        });
    });

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
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }
</script>
<script src="./js/script.js"></script>
</html>
