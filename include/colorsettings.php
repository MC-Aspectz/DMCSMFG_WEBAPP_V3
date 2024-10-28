<?php // session_start();
require_once(dirname(__FILE__, 2) . '/common/SessionStart.php');
require_once(dirname(__FILE__, 2) . '/common/javaFunction.php'); 
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
$_SESSION['APPMOD'] = '';
$_SESSION['APPCODE'] = ''; // APPMOD13

//--------------------------------------------------------------------------------
if (isset($_SESSION['LANG'])) {
    require_once($_SESSION['APPPATH'] . '/lang/' . strtolower($_SESSION['LANG']) . '/colorsettings.php');
} else {  
    require_once($_SESSION['APPPATH'] . '/lang/en/colorsettings.php');
}
//--------------------------------------------------------------------------------
$javafunc = new javaFunction;;
$filetype = 'background';
$usercode = $_SESSION['USERCODE'];
$target_dir = '../storage/'.$_SESSION['COMCD'].'/'.$filetype.'/'.$usercode.'/';
// print_r($_SESSION['SIDEBARBGCOLOR']);
if(isset($_POST['action'])) {
    if($_POST['action'] == 'savStaffConfig') {
        $MAINPAGEBGTYPE = 'Color'; $check = false;
        // print_r($_POST);
        if(isset($_POST['MAINPAGEBGTYPE'])) { 
            if($_POST['MAINPAGEBGTYPE'] == 1) {
                $MAINPAGEBGTYPE = 'Color'; $MAINPAGEBGVALUE = $_POST['bgColor'];
            } else {
                // print_r($_FILES['bgImage']['error']);
                if($_FILES['bgImage']['error'] != 4) {
                    if(!file_exists($target_dir)) {
                        $old = umask(0);
                        $mk = mkdir($target_dir, 0755, true);
                        umask($old);
                        if (!$mk) { chmod($target_dir, 0755); }
                    }
                    $files = glob($target_dir.'*');  
                    // Deleting all the files in the list 
                    foreach($files as $file) { 
                        if(is_file($file)) unlink($file);  
                    } 
                    $filename = basename($_FILES['bgImage']['name']);
                    $target_file = $target_dir.$filename;
                    $typefile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES['bgImage']['tmp_name']);
                    $MAINPAGEBGTYPE = 'Picture'; $MAINPAGEBGVALUE = '/storage/'.$_SESSION['COMCD'].'/'.$filetype.'/'.$usercode.'/'.$filename;
                } else {
                    $MAINPAGEBGTYPE = 'Picture'; $MAINPAGEBGVALUE = isset($_POST['oldbgImage']) ? $_POST['oldbgImage']: '';
                }
            }
        } 

        $param = array( 'STAFFCD' => $_SESSION['USERCODE'],
                        'NAVBARBGCOLOR' => isset($_POST['NAVBARBGCOLOR']) ? $_POST['NAVBARBGCOLOR']: '',
                        'NAVBARTXTCOLOR' => isset($_POST['NAVBARTXTCOLOR']) ? $_POST['NAVBARTXTCOLOR']: '',
                        'SIDEBARBGCOLOR' => isset($_POST['SIDEBARBGCOLOR']) ? $_POST['SIDEBARBGCOLOR']: '',
                        'SIDEBARTXTCOLOR1' => isset($_POST['SIDEBARTXTCOLOR1']) ? $_POST['SIDEBARTXTCOLOR1']: '',
                        'SIDEBARTXTCOLOR2' => isset($_POST['SIDEBARTXTCOLOR2']) ? $_POST['SIDEBARTXTCOLOR2']: '',
                        'MAINPAGEBGTYPE' => $MAINPAGEBGTYPE,
                        'MAINPAGEBGVALUE' => $MAINPAGEBGVALUE,
                        'MAINPAGETXTCOLOR' => isset($_POST['MAINPAGETXTCOLOR']) ? $_POST['MAINPAGETXTCOLOR']: '');
        // print_r($param);
        $savStaffConfig = $javafunc->savStaffConfig($param);
        if($check !== false) { move_uploaded_file($_FILES['bgImage']['tmp_name'], $target_file); }
        if($savStaffConfig == '') {
            $_SESSION['NAVBARBGCOLOR'] = isset($_POST['NAVBARBGCOLOR']) ? $_POST['NAVBARBGCOLOR']: '';
            $_SESSION['NAVBARTXTCOLOR'] = isset($_POST['NAVBARTXTCOLOR']) ? $_POST['NAVBARTXTCOLOR']: '';
            $_SESSION['SIDEBARBGCOLOR'] = isset($_POST['SIDEBARBGCOLOR']) ? $_POST['SIDEBARBGCOLOR']: '';
            $_SESSION['SIDEBARTXTCOLOR1'] = isset($_POST['SIDEBARTXTCOLOR1']) ? $_POST['SIDEBARTXTCOLOR1']: '';
            $_SESSION['SIDEBARTXTCOLOR2'] = isset($_POST['SIDEBARTXTCOLOR2']) ? $_POST['SIDEBARTXTCOLOR2']: '';
            $_SESSION['MAINPAGEBGTYPE'] = $MAINPAGEBGTYPE;
            $_SESSION['MAINPAGEBGVALUE'] = $MAINPAGEBGVALUE;
            $_SESSION['MAINPAGETXTCOLOR'] = isset($_POST['MAINPAGETXTCOLOR']) ? $_POST['MAINPAGETXTCOLOR']: '';
        }
        echo json_encode($savStaffConfig);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=lang('colorsettings')?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <?php // sideBar(); ?>
        <aside class="side-menu flex-shrink-0 w-64 flex flex-col border-r transition-all duration-300 overflow-y-auto">
            <nav class="flex flex-col flex-wrap p-2 w-full" data-hs-accordion-always-open>
                <ul class="hs-accordion-group space-y-1.5">
                    <li class="hs-accordion active" id="app-child">
                        <button type="button" class="maintopic hs-accordion-toggle hs-accordion-active:text-gray-100 hs-accordion-active:hover:bg-gray-600 w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 rounded-lg"
                                aria-controls="app-child-collapse">
                            <span class="text-sm font-semibold"><?=lang('module')?></span> 
                            <svg class="hs-accordion-active:hidden ms-auto block size-4" width="16" height="16" viewBox="0 0 16 16" fill="none">
                              <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                        </button>
                        <div id="app-child-collapse" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="app-child"><!-- hidden -->
                            <ul class="pt-2 ps-2">
                                <li class="py-0.5">
                                    <a class="subtopic flex items-start gap-x-3.5 py-1 px-2.5 text-[12px] rounded-lg"><?=lang('applicationI')?></a>
                                </li>
                                <li class="py-0.5">
                                    <a class="subtopic flex items-start gap-x-3.5 py-1 px-2.5 text-[12px] rounded-lg"><?=lang('applicationII')?></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </aside>
        <!-------------------------------------------------------------------------------------->
        <!--   end::Sideba Menu -->

        <!--   start::Main Content  -->
        <main class="flex flex-1 overflow-y-auto paragraph">
            <form class="w-full m-2" id="colorConfig" enctype="multipart/form-data">
                <div class="flex mb-2">
                    <div class="flex w-4/12">
                        <label class="text-color block text-base font-semibold pr-2 pt-1"><?=lang('navbarcolor')?></label>
                    </div>
                    <div class="flex w-8/12">
                        <input type="color" class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" id="NAVBARBGCOLOR" name="NAVBARBGCOLOR" value="<?=isset($_SESSION['NAVBARBGCOLOR']) ? $_SESSION['NAVBARBGCOLOR']: '#90CDF4'?>" 
                        title="<?=lang('chooseyourcolor')?>">
                        <input type="hidden" id="NAVBARTXTCOLOR" name="NAVBARTXTCOLOR" value="<?=isset($_SESSION['NAVBARTXTCOLOR']) ? $_SESSION['NAVBARTXTCOLOR']: '#010101'?>"/>
                    </div>
                </div>

                <div class="flex mb-2">
                    <div class="flex w-4/12">
                        <label class="text-color block text-base font-semibold pr-2 pt-1"><?=lang('sidebarcolor')?></label>
                    </div>
                    <div class="flex w-8/12">
                        <input type="color" class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" id="SIDEBARBGCOLOR" name="SIDEBARBGCOLOR" value="<?=isset($_SESSION['SIDEBARBGCOLOR']) ? $_SESSION['SIDEBARBGCOLOR']: '#eff6ff'?>" 
                        title="<?=lang('chooseyourcolor')?>"/>
                    </div>
                </div>

                <div class="flex mb-2">
                    <div class="flex w-4/12">
                        <label class="text-color block text-base font-semibold pr-2 pt-1"><?=lang('sidebartextcolor')?></label>
                    </div>
                    <div class="flex w-8/12">
                        <input type="color" class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" id="SIDEBARTXTCOLOR1" name="SIDEBARTXTCOLOR1" value="<?=isset($_SESSION['SIDEBARTXTCOLOR1']) ? $_SESSION['SIDEBARTXTCOLOR1']: '#010101'?>" 
                        title="<?=lang('chooseyourcolor')?>"/>&ensp;
                        <input type="color" class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" id="SIDEBARTXTCOLOR2" name="SIDEBARTXTCOLOR2" value="<?=isset($_SESSION['SIDEBARTXTCOLOR2']) ? $_SESSION['SIDEBARTXTCOLOR2']: '#010101'?>" 
                        title="<?=lang('chooseyourcolor')?>"/>
                    </div>
                </div>

                <div class="flex mb-2">
                    <div class="flex w-4/12">
                        <label class="text-color block text-base font-semibold pr-2 pt-1"><?=lang('background')?></label>
                    </div>
                    <div class="flex w-8/12">
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 w-4/12" onclick="backgroundChange(1);">
                            <input id="bgcolor-radio" type="radio" value="1" name="MAINPAGEBGTYPE" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="MAINPAGEBGTYPE-1" class="text-color w-full py-4 ms-2 text-sm font-medium"><?=lang('color')?></label>
                        </div>
                        <div class="w-1/12"></div>
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 w-4/12" onclick="backgroundChange(2);">
                            <input id="bgimage-radio" type="radio" value="2" name="MAINPAGEBGTYPE" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="MAINPAGEBGTYPE-2" class="text-color w-full py-4 ms-2 text-sm font-medium"><?=lang('image')?></label>
                        </div>
                    </div>
                </div>

                <div class="flex mb-2 hidden" id="backgroundcolor">
                    <div class="flex w-4/12"></div>
                    <div class="flex w-8/12">
                        <input type="color" class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" id="bgColor" name="bgColor" value="#fefefe" title="<?=lang('chooseyourcolor')?>"/>
                    </div>
                </div>

                <div class="flex mb-2 hidden" id="backgroundimage">
                    <div class="flex w-4/12"></div>
                    <div class="flex w-8/12">
                        <input type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" id="bgImage" name="bgImage" />
                        <input type="hidden" id="oldbgImage" name="oldbgImage">
                    </div>
                </div>

                <div class="flex mb-2">
                    <div class="flex w-4/12">
                        <label class="text-color block text-base font-semibold pr-2 pt-1"><?=lang('backgroundtextcolor')?></label>
                    </div>
                    <div class="flex w-8/12">
                        <input type="color" class="p-1 h-10 w-14 block bg-white border-2 border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" id="MAINPAGETXTCOLOR" name="MAINPAGETXTCOLOR" value="<?=isset($_SESSION['MAINPAGETXTCOLOR']) ? $_SESSION['MAINPAGETXTCOLOR']: '#374151'?>"  
                        title="<?=lang('chooseyourcolor')?>"/>
                    </div>
                </div>


                <div class="flex mt-2">
                    <div class="flex w-6/12"></div>
                    <div class="flex w-6/12 justify-end">
                        <button type="button" id="apply" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('okay')?>', '<?=lang('cancel')?>' );"><?=lang('apply')?></button>&ensp;

                        <button type="button" id="cancel" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        onclick="window.location.href = '<?=$_SESSION['APPURL'] . '/home.php'?>';"><?=lang('cancel')?></button>
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
    const sidebgcolor = '<?php echo isset($_SESSION['SIDEBARBGCOLOR']) ? $_SESSION['SIDEBARBGCOLOR']: '#eff6ff';?>';
    const sidetxt1color = '<?php echo isset($_SESSION['SIDEBARTXTCOLOR1']) ? $_SESSION['SIDEBARTXTCOLOR1']: '#010101';?>';
    const sidetxt2color = '<?php echo isset($_SESSION['SIDEBARTXTCOLOR2']) ? $_SESSION['SIDEBARTXTCOLOR2']: '#010101';?>';
    const mainbgtyper = '<?php echo isset($_SESSION['MAINPAGEBGTYPE']) ? $_SESSION['MAINPAGEBGTYPE']: '';?>';
    const mainbgvalue = '<?php echo isset($_SESSION['MAINPAGEBGVALUE']) ? $_SESSION['MAINPAGEBGVALUE']: '#fefefe';?>';
    const bgcolor_radio = document.getElementById('bgcolor-radio');
    const bgimage_radio = document.getElementById('bgimage-radio');

    // document.getElementById('app-child').classList.remove('hidden');

    if(mainbgtyper == 'Color') {
        bgcolor_radio.checked = true;
        backgroundcolor.classList.remove('hidden');
        document.getElementById('bgColor').value = mainbgvalue;
    } else if(mainbgtyper == 'Picture') {
        bgimage_radio.checked = true;
        backgroundimage.classList.remove('hidden');
        document.getElementById('oldbgImage').value = mainbgvalue;
    } else {
        bgcolor_radio.checked = true;
        backgroundcolor.classList.remove('hidden');
        document.getElementById('bgColor').value = mainbgvalue;
    }

    // const NAVBARBGCOLOR = document.getElementById('NAVBARBGCOLOR');
    const navbars = document.getElementById('navbar');
    const dropdownChoices = document.getElementById('dropdown-choice');
    const dropdownInfos = document.getElementById('dropdown-info');

    NAVBARBGCOLOR.addEventListener('input', () => {
        navbars.classList.remove('bg-blue-300');
        dropdownChoices.classList.remove('bg-blue-300');
        dropdownInfos.classList.remove('bg-blue-300');
        navbars.classList.add('bg-['+NAVBARBGCOLOR.value+']');
        dropdownChoices.classList.add('bg-['+NAVBARBGCOLOR.value+']');
        dropdownInfos.classList.add('bg-['+NAVBARBGCOLOR.value+']');
        // console.log(brightness(NAVBARBGCOLOR.value));
        let nbrightness = tinycolor(NAVBARBGCOLOR.value);
        if (nbrightness.isDark()) {
            // console.log('dark');
            dropdownChoices.classList.add('text-[#fefefe]');
            dropdownInfos.classList.add('text-[#fefefe]');
            document.getElementById('NAVBARTXTCOLOR').value = '#fefefe';
                // dropdownChoices.classList.add('text-['+SIDEBARTXTCOLOR1.value+']');
            Array.from(document.getElementsByClassName('menu-h-color')).forEach(menu => {
                // e.style.setProperty('color', '#fefefe', 'important');
                menu.classList.remove('text-[#010101]');
                menu.classList.add('text-[#fefefe]');
            });
            for(var seq = 1; seq <= 13; seq++) {
                if( seq < 10 ) { seq = '0'+seq } else { seq = seq; };
                $('#nav-APPMOD'+seq+'').attr('src', appurl + '/img/menubar/' + 'APPMOD' + seq + '.png');
                $('#MANUAL').attr('src', appurl + '/img/menubar/' + 'MANUAL.png');
            }
            Array.from(document.getElementsByClassName('menu-hover')).forEach(e => {
                e.classList.remove('hover:bg-sky-100');
                e.classList.remove('hover:text-gray-900');
                e.classList.add('hover:bg-gray-700');
                e.classList.add('hover:text-gray-100');
            });
        } else {
            // console.log('light');
            dropdownChoices.classList.add('text-[#010101]');
            dropdownInfos.classList.add('text-[#010101]');
            document.getElementById('NAVBARTXTCOLOR').value = '#010101';
            Array.from(document.getElementsByClassName('menu-h-color')).forEach(menu => {
                // e.style.setProperty('color', '#010101', 'important');
                menu.classList.remove('text-[#fefefe]');
                menu.classList.add('text-[#010101]');
            });
            for(var seq = 1; seq <= 13; seq++) {
                if( seq < 10 ) { seq = '0'+seq } else { seq = seq; };
                $('#nav-APPMOD'+seq+'').attr('src', appurl + '/img/menubar/' + 'APPMOD' + seq + 'S.png');
                $('#MANUAL').attr('src', appurl + '/img/menubar/' + 'MANUALS.png');
            }
            Array.from(document.getElementsByClassName('menu-hover')).forEach(e => {
                e.classList.remove('hover:bg-gray-700');
                e.classList.remove('hover:text-gray-100');
                e.classList.add('hover:bg-sky-100');
                e.classList.add('hover:text-gray-900');
            });
        }
    });

    // const SIDEBARBGCOLOR = document.getElementById('SIDEBARBGCOLOR');
    const sidebars = document.querySelector('aside');
    sidebars.classList.add('bg-['+sidebgcolor+']');
    if(tinycolor(sidebgcolor).isDark()) {
        Array.from(document.getElementsByClassName('maintopic')).forEach(mod => {
            mod.classList.add('hover:bg-gray-100');
            mod.classList.add('hover:text-black');
            mod.classList.add('text-['+sidetxt1color+']');
        });
        Array.from(document.getElementsByClassName('subtopic')).forEach(app => {
            app.classList.add('hover:bg-gray-100');
            app.classList.add('hover:text-black');
            app.classList.add('text-['+sidetxt2color+']');
        });
    } else {
        Array.from(document.getElementsByClassName('maintopic')).forEach(mod => {
            mod.classList.add('hover:bg-gray-900');
            mod.classList.add('hover:text-gray-100');
            mod.classList.add('text-['+sidetxt1color+']');
        });
        Array.from(document.getElementsByClassName('subtopic')).forEach(app => {
            app.classList.add('hover:bg-gray-900');
            app.classList.add('hover:text-gray-100');
            app.classList.add('text-['+sidetxt2color+']');
        });
    }

    SIDEBARBGCOLOR.addEventListener('input', () => {
        sidebars.classList.add('bg-['+SIDEBARBGCOLOR.value+']');
        let sbrightness = tinycolor(SIDEBARBGCOLOR.value);
        if (sbrightness.isDark()) {
            Array.from(document.getElementsByClassName('maintopic')).forEach(mod => {
                mod.classList.remove('hover:bg-gray-900');
                mod.classList.remove('hover:text-gray-100');
                mod.classList.remove('text-gray-900');
                mod.classList.add('text-gray-100');
                mod.classList.add('hover:bg-gray-200');
                mod.classList.add('hover:text-black');
            });
            Array.from(document.getElementsByClassName('subtopic')).forEach(app => {
                app.classList.remove('hover:bg-gray-900');
                app.classList.remove('hover:text-gray-100');
                app.classList.remove('text-gray-900');
                app.classList.add('text-gray-100');
                app.classList.add('hover:bg-gray-200');
                app.classList.add('hover:text-black');
            });
            document.getElementById('SIDEBARTXTCOLOR1').value = '#fefefe';
            document.getElementById('SIDEBARTXTCOLOR2').value = '#fefefe';
        } else {
            Array.from(document.getElementsByClassName('maintopic')).forEach(mod => {
                mod.classList.remove('hover:bg-gray-100');
                mod.classList.remove('hover:text-black');
                mod.classList.remove('text-gray-100');
                mod.classList.add('text-gray-900');
                mod.classList.add('hover:bg-gray-900');
                mod.classList.add('hover:text-gray-100');
            });
            Array.from(document.getElementsByClassName('subtopic')).forEach(app => {
                app.classList.remove('hover:bg-gray-100');
                app.classList.remove('hover:text-black');
                app.classList.remove('text-gray-100');
                app.classList.add('text-gray-900');
                app.classList.add('hover:bg-gray-900');
                app.classList.add('hover:text-gray-100');
            });
            document.getElementById('SIDEBARTXTCOLOR1').value = '#010101';
            document.getElementById('SIDEBARTXTCOLOR2').value = '#010101';
        }
    });

    // const SIDEBARTXTCOLOR1 = document.getElementById('SIDEBARTXTCOLOR1');
    SIDEBARTXTCOLOR1.addEventListener('input', () => {
        Array.from(document.getElementsByClassName('maintopic')).forEach(mod => {
            mod.classList.remove('text-gray-900');
            mod.classList.remove('text-gray-100');
            mod.classList.add('text-['+SIDEBARTXTCOLOR1.value+']');
            if (brightness(SIDEBARTXTCOLOR1.value)) {
                mod.classList.remove('hover:bg-gray-900');
                mod.classList.remove('hover:text-gray-100');
                mod.classList.add('hover:bg-gray-200');
                mod.classList.add('hover:text-black');
            } else {
                mod.classList.remove('hover:bg-gray-200');
                mod.classList.remove('hover:text-black');
                mod.classList.add('hover:bg-gray-900');
                mod.classList.add('hover:text-gray-100');
            }
        });
    });

    // const SIDEBARTXTCOLOR2 = document.getElementById('SIDEBARTXTCOLOR2');
    SIDEBARTXTCOLOR2.addEventListener('input', () => {
        Array.from(document.getElementsByClassName('subtopic')).forEach(app => {
            app.classList.remove('text-gray-900');
            app.classList.remove('text-gray-100');
            app.classList.add('text-['+SIDEBARTXTCOLOR2.value+']');
            if (brightness(SIDEBARTXTCOLOR2.value)) {
                app.classList.remove('hover:bg-gray-900');
                app.classList.remove('hover:text-gray-100');
                app.classList.add('hover:bg-gray-200');
                app.classList.add('hover:text-black');
            } else {
                app.classList.remove('hover:bg-gray-200');
                app.classList.remove('hover:text-black');
                app.classList.add('hover:bg-gray-900');
                app.classList.add('hover:text-gray-100');
            }
        });
    });

    MAINPAGETXTCOLOR.addEventListener('input', () => {
        Array.from(document.getElementsByClassName('text-color')).forEach(textcolor => {
            textcolor.classList.add('text-['+MAINPAGETXTCOLOR.value+']');
        });
    });

    const main = document.querySelector('main');
    const bgColors = document.getElementById('bgColor');
    bgColors.addEventListener('input', () => {
        main.style.background = '';
        main.style.backgroundColor = bgColors.value;
        var colorbrightness = tinycolor(bgColors.value);
        Array.from(document.getElementsByClassName('text-color')).forEach(textcolor => {
            if (colorbrightness.isDark()) {
                textcolor.classList.remove('text-[#010101]');
                textcolor.classList.add('text-[#fefefe]');
                document.getElementById('MAINPAGETXTCOLOR').value = '#fefefe';
            } else {
                textcolor.classList.remove('text-[#fefefe]');
                textcolor.classList.add('text-[#010101]');
                document.getElementById('MAINPAGETXTCOLOR').value = '#010101';
            }
        });

        Array.from(document.getElementsByClassName('btn')).forEach(btn => {
            if (colorbrightness.isDark()) {
                btn.classList.remove('text-gray-900');
                btn.classList.remove('hover:bg-gray-900');
                btn.classList.remove('hover:text-gray-100');
                btn.classList.remove('border-gray-900');
                btn.classList.add('text-gray-100');
                btn.classList.add('hover:bg-gray-100');
                btn.classList.add('hover:text-gray-900');
                btn.classList.add('border-gray-100');
            } else {
                btn.classList.remove('text-gray-100');
                btn.classList.remove('hover:bg-gray-100');
                btn.classList.remove('hover:text-gray-900');
                btn.classList.remove('border-gray-100');
                btn.classList.add('text-gray-900');
                btn.classList.add('hover:bg-gray-900');
                btn.classList.add('hover:text-gray-100');
                btn.classList.add('border-gray-900');
            }
        });
    });

    document.getElementById('bgImage').onchange = function() {
        var imgurl = URL.createObjectURL(this.files[0]);
        main.style.backgroundColor = '';
        main.style.background = 'url(' + imgurl + ')';
        main.style.backgroundSize = 'cover';

        getImageLightness(imgurl ,function(brightness) {
            // console.log(brightness);
            if(brightness < 127.5){
                // console.log('dark');
                Array.from(document.getElementsByClassName('text-color')).forEach(textcolor => {
                    textcolor.classList.remove('text-[#010101]');
                    textcolor.classList.add('text-[#fefefe]');
                });

                document.getElementById('MAINPAGETXTCOLOR').value = '#fefefe';

                Array.from(document.getElementsByClassName('btn')).forEach(btn => {
                    btn.classList.remove('text-gray-900');
                    btn.classList.remove('hover:bg-gray-900');
                    btn.classList.remove('hover:text-gray-100');
                    btn.classList.remove('border-gray-900');
                    btn.classList.add('text-gray-100');
                    btn.classList.add('hover:bg-gray-100');
                    btn.classList.add('hover:text-gray-900');
                    btn.classList.add('border-gray-100');
                });
            } else {
                // console.log('light');
                Array.from(document.getElementsByClassName('text-color')).forEach(textcolor => {
                    textcolor.classList.remove('text-[#fefefe]');
                    textcolor.classList.add('text-[#010101]');
                });

                document.getElementById('MAINPAGETXTCOLOR').value = '#010101';

                Array.from(document.getElementsByClassName('btn')).forEach(btn => {
                    btn.classList.remove('text-gray-100');
                    btn.classList.remove('hover:bg-gray-100');
                    btn.classList.remove('hover:text-gray-900');
                    btn.classList.remove('border-gray-100');
                    btn.classList.add('text-gray-900');
                    btn.classList.add('hover:bg-gray-900');
                    btn.classList.add('hover:text-gray-100');
                    btn.classList.add('border-gray-900');
                });
            }
        });
    }

    async function savStaffConfig() {
        $('#loading').show();
        const form = document.getElementById('colorConfig');
        const backgroundImage = document.querySelector('#bgImage').files[0];
        const data = new FormData(form);
        data.append('action', 'savStaffConfig');
        data.append('bgImage', backgroundImage);
        await axios.post(appurl + '/include/colorsettings.php', data, { headers: {'Content-Type': 'multipart/form-data'} })
        .then(response => {
            // console.log(response.data);
            $('#loading').hide();
            return questionDialog(2, '<?=lang('success')?>', '<?=lang('okay'); ?>', '<?=lang('no'); ?>'); 
        })
        .catch(e => {
            console.log(e);
            document.getElementById('loading').style.display = 'none';
            return questionDialog(3, '<?=lang('fail')?>', '<?=lang('okay'); ?>', '<?=lang('no'); ?>'); 
        });
    }

    function questionDialog(type, msg, btnyes, btnno) {
        return Swal.fire({ 
            title: '',
            text: msg,
            showCancelButton: type == 1 ? true: false,
            confirmButtonText: btnyes,
            cancelButtonText: btnno
            }).then((result) => {
            if (result.isConfirmed) {
                if(type == 1) {
                    return savStaffConfig();
                } else if(type == 2) {
                    // return
                } else {
                    
                }
            }
        });
    }

    function backgroundChange(check) {
        if(check == 1) {
            bgcolor_radio.checked = true;
            backgroundimage.classList.add('hidden');
            backgroundcolor.classList.remove('hidden');
        } else if(check == 2) {
            bgimage_radio.checked = true;
            backgroundcolor.classList.add('hidden');
            backgroundimage.classList.remove('hidden');
        }
    }

    function getImageLightness(imageSrc, callback) {
        var img = document.createElement('img');
        img.src = imageSrc;
        img.style.display = 'none';
        document.body.appendChild(img);

        var colorSum = 0;

        img.onload = function() {
            // create canvas
            var canvas = document.createElement('canvas');
            canvas.width = this.width;
            canvas.height = this.height;

            var ctx = canvas.getContext('2d');
            ctx.drawImage(this,0,0);

            var imageData = ctx.getImageData(0,0,canvas.width,canvas.height);
            var data = imageData.data;
            var r,g,b,avg;

            for(var x = 0, len = data.length; x < len; x+=4) {
                r = data[x];
                g = data[x+1];
                b = data[x+2];

                avg = Math.floor((r+g+b)/3);
                colorSum += avg;
            }

            var brightness = Math.floor(colorSum / (this.width*this.height));
            callback(brightness);
        }
    }

    function brightness(colorpicker) {
        let brightness = tinycolor(colorpicker);
        return brightness.isDark() ? true : false;  // true = dark; false = light;
    }

    // function detectDarkLight(hex) {
        // var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        // var brightness = result ? parseInt(result[1], 16) + parseInt(result[2], 16) + parseInt(result[3], 16)/1000 : null;
        // if(brightness < 127.5){
        //     console.log('dark');
        // }else{
        //     console.log('light');
        // }
        // return brightness;
    // }

    // function hexToRgb(hex) {
        // var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        // return result ? {
        // r: parseInt(result[1], 16),
        // g: parseInt(result[2], 16),
        // b: parseInt(result[3], 16)
        // } : null;
    // }
</script>
</html>