<?php
    //--------------------------------------------------------------------------------
    // session_start();
    require_once(dirname(__FILE__, 2) . '/common/SessionStart.php');
    //--------------------------------------------------------------------------------
    //  LANGUAGE
    if (isset($_SESSION['LANG'])) {
        require_once($_SESSION['APPPATH'] . '/lang/' . strtolower($_SESSION['LANG']) . '/manual.php');
    } else {  
        require_once($_SESSION['APPPATH'] . '/lang/en/manual.php');
    }
    //--------------------------------------------------------------------------------
    require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
    require_once($_SESSION['APPPATH'] . '/common/utils.php');
    //--------------------------------------------------------------------------------
    $arydirname = explode('/', dirname(__FILE__));
    $APPCD = '';
    $APPNAME = '';
    $PACKCD = '';
    $PACKNAME = '';
    $MODE = '';
    $data = array();
    $manualdat = '';
    //--------------------------------------------------------------------------------
    // ----------     GET     ---------- //
    //--------------------------------------------------------------------------------
    if(!empty($_GET)) {
        //--------------------------------------------------------------------------------
        // Application Code
        if(!empty($_GET['appcd'])) {
            //--------------------------------------------------------------------------------
            $APPCD = $_GET['appcd'];
            // APPCD
            $Param = array('APPCD' => $APPCD);
            $cmd = GetRequestData($Param, 'gen.Manual.get', '', '');
            $data = Execute($cmd, $errorMessage);
            if (isset($data['MANTEXT'])) {
                $manualdat = $data['MANTEXT'];
            }  // if (isset($data['MANTEXT'])) {
            //--------------------------------------------------------------------------------
        }  // if(!empty($_GET['AppCd'])) {
        //--------------------------------------------------------------------------------
    }  // if(!empty($_GET)) {
    //--------------------------------------------------------------------------------
    // echo dirname(__FILE__, 2); 
    // echo $APPCD;
    // print_r($data);
    // echo $data['MANTEXT'];
    //--------------------------------------------------------------------------------
    elseif(!empty($_POST)) {
        //--------------------------------------------------------------------------------
        // if (isset($_POST['action']) && (!empty($_POST['appcd']))) {
            //--------------------------------------------------------------------------------
            $APPCD = $_POST['appcd'];
            $manualdat = $_POST['manualdat'];
            //--------------------------------------------------------------------------------
            // MODE E = EDIT, V = PREVIEW, S = COMMIT
            if ($_POST['action'] == 'edit') {
                // MODE EDIT
                $MODE = 'E';
            } elseif ($_POST['action'] == 'preview') {
                // MODE PREVIEW
                $MODE = 'V';
            } elseif ($_POST['action'] == 'commit') {
                //--------------------------------------------------------------------------------
                // MODE COMMIT
                $MODE = 'S';
                $Param = array( 'APPCD' => $APPCD,
                                'MAINTEXT' => $manualdat);
                $cmd = GetRequestData($Param, 'gen.Manual.save', '', '');
                $data = Execute($cmd, $errorMessage);
                //--------------------------------------------------------------------------------
            }  // elseif ($_POST['action'] == 'preview') {
            //--------------------------------------------------------------------------------
        // }  // if (isset($_POST['action'])) {
        //--------------------------------------------------------------------------------
    }  // elseif(!empty($_POST)) {
    //--------------------------------------------------------------------------------

    if(!empty($_SESSION['APPMOD'])) { if(empty($_SESSION['APPMANUAL']) || $_SESSION['APPMANUAL'] == '') { $_SESSION['APPMANUAL'] = $_SESSION['APPMOD']; } }
    $appmod = isset($_SESSION['APPMANUAL']) ? $_SESSION['APPMANUAL']: '';
    $findpack = array_filter($_SESSION['MENU'], function($v, $k) use ($appmod) {
      return $v['MODSEQ'] == $appmod && $v['FORMAPP'] == 10 && $v['FORMSEQ'] == 0;
    }, ARRAY_FILTER_USE_BOTH);

    if(!empty($findpack)) {
        if(empty($_SESSION['MPACKCODE'])) {
            $packdata = $findpack[array_key_first($findpack)];
            $_SESSION['MPACKCODE'] = $packdata['NODEDATA'];
            $_SESSION['MPACKNAME'] = $packdata['NODETITLE']; 
        }
        // echo '<pre>';
        // print_r($packdata);
        // echo '</pre>';
        $appdata = array_filter($_SESSION['MENU'], function($v, $k) use ($appmod) {
          return $v['MODSEQ'] == $appmod && $v['FORMAPP'] == 'APP';
        }, ARRAY_FILTER_USE_BOTH);
        // echo '<pre>';
        // print_r($appdata);
        // echo '</pre>';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMCS - Manual</title>
    
    <!--  Css  -->
    <link href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/manual.css'; ?>"> -->
    <!-- Bootstrap CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>" rel="stylesheet">
    <!-- Tailwind CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/tailwind/tailwind.min.css'; ?>" rel="stylesheet">
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Script  -->
    <!-- -------------------------------------------------------------------------------- -->
    <script type="text/javascript">var appurl = '<?php echo $_SESSION['APPURL'];?>';</script>
    <script src="<?=$_SESSION['APPURL'] . '/js/menu.js'; ?>"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>" integrity="sha384-oMQ5ko2jLSZXRA4GGPs7QohksV1sZ8/JIL8ioAdjU4XSSjvBKMoofyNrlREXWmbN" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/sweetalert2.min.js'; ?>" integrity="sha384-mngH0dsoMzHJ55nmFSRTjl5pdhgzHDeEoLOuZp2U28VrwCH0ieB9ntimtLbJm9KJ" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Tailwind -->
    <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/flowbite.js'; ?>" integrity="sha384-RNh9MdmjHSkDesPwHUG/4Q140YGzL9GCuTiMtpYulluOVVu+gspE3/FAOftffvgN" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/tailwindcss.js'; ?>" integrity="sha384-sNJWcnN52nOgm5mxSYb1UdVW1vMZVLjIKbkrw2rrr85TjQ15qeg6k9nCfKHlSD4q" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/preline.min.js'; ?>" integrity="sha384-VBNGpMG2TrGOaeXBeg0dikwcC55It+09M0Qh6iLIJ5F5FZYFLHc797aueWcxMhgj" crossorigin="anonymous"></script>

    <!-- Tiny color  -->
    <script src="<?=$_SESSION['APPURL'] . '/js/tinycolor.js'; ?>"></script>
</head>
<body>
<!-- -------------------------------------------------------------------------------- -->
<!--  MENU  -->
<div class="flex flex-col h-screen">
    <!--  start::navbar Menu -->
    <header class="flex relative top-0 text-semibold">
        <!-------------------------------------------------------------------------------------->
        <nav id="navbar" class="relative top-0 z-40 flex w-full flex-row justify-between px-4 py-2">
            <div class="flex w-8/12 justify-start">
                <!-- <span class="px-2 py-1 items-center rounded menu-hover" onclick="javascript:toggleSidebar();">
                    <img class='object-cover w-auto h-12 rounded' src='<?=$_SESSION['APPURL'] . '/img/dmcs_logo_n.png'; ?>' alt='logo'>
                </span> -->
                <span class="px-3 py-2 mx-1 [&>svg]:h-8 [&>svg]:w-8 cursor-pointer items-center rounded menu-hover" onclick="javascript:toggleSidebarManual();">
                    <svg class="h-6 w-6 stroke-current menu-h-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" clip-rule="evenodd"/>
                    </svg>
                </span><?php
                foreach ($_SESSION['MENU'] as $item) {
                    if($item['FORMAPP'] == 'MOD' && $item['FORMSEQ'] == '0' && $item['SEQ'] == '0') { ?>
                        <a class="px-3 py-2.5 mx-1 [&>svg]:h-8 [&>svg]:w-8 cursor-pointer items-center rounded menu-hover" id="mod-<?=$item['MODSEQ']?>"
                            onclick="javascript:onloadpage(); javascript:setAppManual('<?=$item['MODSEQ']?>');" data-tooltip-target="tooltip-<?=$item['MODSEQ']?>" data-tooltip-placement="bottom">
                            <img class="h-6 w-6 pt-1" src="<?=$_SESSION['APPURL'] . '/img/menubar/' . $item['NODEKEY'].'.png'; ?>" id="nav-<?=$item['MODSEQ']?>" loading="lazy">
                        </a>
                        <div id="tooltip-<?=$item['MODSEQ']?>" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-slate-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-slate-600" role="tooltip"><?=$item['NODETITLE']?>
                        </div><?php
                    }
                } ?>
            </div>

            <div class="flex w-4/12 justify-end">
                <button id="dropdown-user" data-dropdown-toggle="dropdown-choice" class="menu-h-color text-xl rounded font-semibold py-1 px-2 inline-flex items-center pt-1.5 menu-hover" 
                    type="button"><?=$_SESSION['USERCODE']?>
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <div id="dropdown-choice" class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-user">
                        <li>
                            <a class="menu-h-color flex items-center gap-x-3.5 px-2.5 py-2 rounded menu-hover" data-bs-toggle="modal" data-bs-target="#changePassword-modal" onclick="javascript:change_password();">
                                <svg class="size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z"/>
                                </svg><?=language('changepassword')?>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <a class="px-3 py-2 mx-1 [&>svg]:h-8 [&>svg]:w-8 cursor-pointer items-center rounded menu-hover"
                    onclick="javascript:onloadpage(); window.close();" data-tooltip-target="tooltip-close" data-tooltip-placement="bottom">
                    <svg class="h-6 w-6 stroke-current menu-h-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" clip-rule="evenodd"/>
                        <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" /> -->
                    </svg>
                    <div id="tooltip-close" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-slate-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-slate-600">
                        <?=language('close')?>
                    </div>
                </a>
            </div>
        </nav>
        <!-------------------------------------------------------------------------------------->
    </header>
    <!--  end::navbar Menu -->
    <!-- -------------------------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------------------------- -->
    <div class="flex flex-1 overflow-hidden">
        <!--   start::Sidebar Menu -->
        <!-------------------------------------------------------------------------------------->
        <aside class="manual-menu flex-shrink-0 w-64 flex flex-col border-r transition-all duration-300 overflow-y-auto">
            <nav class="flex flex-col flex-wrap p-2 w-full" data-hs-accordion-always-open>
                <ul class="hs-accordion-group space-y-1.5"><?php
                foreach ($findpack as $value) { if($value['NODEDATA'] == $_SESSION['MPACKCODE']) { ?>
                    <li class="hs-accordion active" id="app-<?=$value['NODEDATA']?>"><?php } else {?>
                    <li class="hs-accordion" id="app-<?=$value['NODEDATA']?>"><?php } ?>
                        <button type="button" class="maintopic hs-accordion-toggle hs-accordion-active:text-gray-100 hs-accordion-active:hover:bg-gray-600 w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 rounded-lg"
                                aria-controls="app-<?=$value['NODEDATA']?>-collapse" onclick="javascript:setMpackcode('<?=$value['NODEDATA']?>');">
                            <span class="text-sm font-semibold"><?=$value['NODETITLE']?></span> 
                            <svg class="hs-accordion-active:hidden ms-auto block size-4" width="16" height="16" viewBox="0 0 16 16" fill="none">
                              <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                        </button>
                        <?php if($value['NODEDATA'] == $_SESSION['MPACKCODE']) { ?>
                        <div id="app-<?=$value['NODEDATA']?>-collapse" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="app-<?=$value['NODEDATA']?>"><?php } else { ?>
                        <div id="app-<?=$value['NODEDATA']?>-collapse" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden" aria-labelledby="app-<?=$value['NODEDATA']?>"><?php } ?>
                            <ul class="pt-2 ps-2"><?php
                            foreach ($appdata as $item) {
                                if($item['MODSEQ'] == $value['MODSEQ'] && $item['FORMAPP'] == 'APP' && $item['SEQ'] == $value['NODEKEY']) { ?>
                                <li class="py-0.5">
                                    <a class="subtopic flex items-start gap-x-3.5 py-1 px-2.5 text-[12px] rounded-lg cursor-pointer" id="<?=$item['NODEDATA']?>" 
                                        onclick="javascript:onloadpage();" href="<?=$_SESSION['APPURL'] . '/include/manual.php?appcd='. $item['NODEDATA'] ?>"><?=$item['NODETITLE']?></a>
                                </li><?php
                                }
                            } ?>
                            </ul>
                        </div>
                    </li><?php
                } ?>
                </ul>
            </nav>
        </aside>
        <!-------------------------------------------------------------------------------------->
        <!--   end::Sideba Menu -->
        <!--   start:: Content  -->
        <?php if($APPCD == 'FLOWCHART') { ?>
        <div class="w-full h-full flex justify-center">
            <img class="object-fill max-h-full m-auto" src="<?=$_SESSION['APPURL'] . '/img/dmcs_bg.jpg'?>">
        </div><?php } ?> 
        <main class="flex flex-1 overflow-y-auto paragraph">
            <form class="w-full m-2" action="manual.php" id="form_manual" method="POST">
                <!-- -------------------------------------------------------------------------------- -->
                <input type="hidden" id="appcd" name="appcd" value="<?php echo $APPCD; ?>">
                <input type="hidden" id="action" name="action" value="">
                <!-- -------------------------------------------------------------------------------- -->
                <!-- -------------------------------------------------------------------------------- -->
                <div class="pagemanual">
                    <!-- -------------------------------------------------------------------------------- -->

                    <textarea class="inputStyle" id="editor" name="manualdat" placeholder="Write your manual.." <?php if (empty($APPNAME) || ($MODE != 'E')) { echo 'hidden'; } ?> ><?php echo $manualdat; ?></textarea>

                    <!-- -------------------------------------------------------------------------------- -->
                    <?php 
                        if (($MODE != "E") && isset($manualdat) && !empty($manualdat)) {
                            echo $manualdat;
                        }  // if (($MODE != "E") && isset($manualdat) && !empty($manualdat)) {
                    ?>
                    <!-- -------------------------------------------------------------------------------- -->
                </div>
                <!-- -------------------------------------------------------------------------------- -->
                <div class="pagecontrol">
                    <div class="row w-full">
                        <div class="col-sm-1 text-left">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="edit" name="edit" onclick="edit_manual();" <?php if(empty($APPNAME) || ($MODE == 'E')) { echo 'hidden'; } ?> ><?=language('edit'); ?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="preview" name="preview" onclick="preview_manual();" <?php if(empty($APPNAME) || ($MODE != 'E')) { echo 'hidden'; } ?> ><?=language('preview'); ?></button>
                        </div>
                        <div class="col-sm-1 text-left">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="commit" name="commit" onclick="commit_manual();" <?php if(empty($APPNAME) || ($MODE != 'E')) { echo 'hidden'; } ?> ><?=language('commit'); ?></button>
                        </div>
                        <div class="col-sm-8 text-center">
                            
                        </div>
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-1">
                            <!-- <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                    id="close" name="close" onclick="window.open('', '_self', ''); window.close();"><?php echo language('close'); ?></button> -->
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
    <!-- -------------------------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------------------------- -->
    <!-- start::footer -->
    <div class="flex bg-gray-200">
        <!-- Footer -->
        <p class="text-black text-[13px]"><?php echo 'URL : ' . $_SESSION['HOST'] . ' | Company : ' . $_SESSION['COMCD'] . ' | User : ' . $_SESSION['USERCODE']; ?></p>
    </div>
    <!-- end::footer -->
    <!-- -------------------------------------------------------------------------------- -->
    
    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
    <div id='modalchange'></div>
    <div id='modalabout'></div>
</div>
</body>
<!-- -------------------------------------------------------------------------------- -->
<script src="<?=$_SESSION['APPURL'] . '/js/manual.js' ?>" ></script>
<script src="<?=$_SESSION['APPURL'] . '/js/ckeditor4/ckeditor.js' ?>" ></script>
<script>
    $(document).ready(function() {
        const appmod = '<?php echo isset($_SESSION['APPMANUAL']) ? $_SESSION['APPMANUAL']: '';?>';
        const appmodule = '<?php echo isset($_GET['appcd']) ? $_GET['appcd']: '' ?>';
        const appcode = '<?php echo isset($APPCD) ? $APPCD: '' ?>';
        const dropdownChoice = document.getElementById('dropdown-choice');
        dropdownChoice.addEventListener('click', (e) => {
            e.preventDefault();
             dropdownChoice.classList.toggle('hidden');
        });
        if(appmodule == 'FLOWCHART') { document.querySelector('.manual-menu').classList.add('hidden'); }
        // console.log(appmodule);
        const navbgcolor = '<?php echo isset($_SESSION['NAVBARBGCOLOR']) ? $_SESSION['NAVBARBGCOLOR']: '#93c5fd';?>';
        const navtxtcolor = '<?php echo isset($_SESSION['NAVBARTXTCOLOR']) ? $_SESSION['NAVBARTXTCOLOR']: '#fefefe';?>';
        const sidebgcolor = '<?php echo isset($_SESSION['SIDEBARBGCOLOR']) ? $_SESSION['SIDEBARBGCOLOR']: '#eff6ff';?>';
        const sidetxt1color = '<?php echo isset($_SESSION['SIDEBARTXTCOLOR1']) ? $_SESSION['SIDEBARTXTCOLOR1']: '#010101';?>';
        const sidetxt2color = '<?php echo isset($_SESSION['SIDEBARTXTCOLOR2']) ? $_SESSION['SIDEBARTXTCOLOR2']: '#010101';?>';
        const mainbgtyper = '<?php echo isset($_SESSION['MAINPAGEBGTYPE']) ? $_SESSION['MAINPAGEBGTYPE']: '';?>';
        const mainbgvalue = '<?php echo isset($_SESSION['MAINPAGEBGVALUE']) ? $_SESSION['MAINPAGEBGVALUE']: '#fefefe';?>';
        const maintxtcolor = '<?php echo isset($_SESSION['MAINPAGETXTCOLOR']) ? $_SESSION['MAINPAGETXTCOLOR']: '#374151';?>';

        // const navcolor = document.querySelector('nav');
        // ------------------------------ Navbar ------------------------------ //
        const navcolor = document.getElementById('navbar');
        navcolor.classList.add('bg-['+navbgcolor+']');
        dropdownChoice.classList.add('bg-['+navbgcolor+']');
        dropdownChoice.classList.add('text-['+navtxtcolor+']');
        Array.from(document.getElementsByClassName('menu-h-color')).forEach(menuheader => {
            if(navbgcolor != '#93c5fd')
            menuheader.classList.add('text-['+navtxtcolor+']');
        });
        // -------------------------------------------------------------------- //
        let brightness = tinycolor(navbgcolor);
        if (brightness.isDark()) {
            for(var seq = 1; seq <= 13; seq++) {
                if( seq < 10 ) { seq = '0'+seq } else { seq = seq; };
                $('#nav-APPMOD'+seq+'').attr('src', appurl + '/img/menubar/' + 'APPMOD' + seq + '.png');
                $('#MANUAL').attr('src', appurl + '/img/menubar/' + 'MANUAL.png');
            }
            Array.from(document.getElementsByClassName('menu-hover')).forEach(menuhover => {
                menuhover.classList.add('hover:bg-gray-700');
                menuhover.classList.add('hover:text-gray-100');
            });
            if(appmod != '' && appcode != 'FLOWCHART') document.getElementById('mod-'+appmod+'').classList.add('bg-gray-700');
        } else {
            for(var seq = 1; seq <= 13; seq++) {
                if( seq < 10 ) { seq = '0'+seq } else { seq = seq; };
                $('#nav-APPMOD'+seq+'').attr('src', appurl + '/img/menubar/' + 'APPMOD' + seq + 'S.png');
                $('#MANUAL').attr('src', appurl + '/img/menubar/' + 'MANUALS.png');
            }
            Array.from(document.getElementsByClassName('menu-hover')).forEach(menuhover => {
                menuhover.classList.add('hover:bg-sky-100');
                menuhover.classList.add('hover:text-gray-900');

            });
            if(appmod != '' && appcode != 'FLOWCHART') document.getElementById('mod-'+appmod+'').classList.add('bg-sky-100');
        }
        // -------------------------------------------------------------------- //
        // ------------------------------ Sidebar ----------------------------- //
        // console.log(appcode);
        const sidebar = document.querySelector('aside');
        sidebar.classList.add('bg-['+sidebgcolor+']');
        Array.from(document.getElementsByClassName('maintopic')).forEach(mod => {
            if(tinycolor(sidebgcolor).isDark()) {
                mod.classList.add('hover:bg-gray-100');
                mod.classList.add('hover:text-black');
                mod.classList.add('text-['+sidetxt1color+']');
            } else {
                mod.classList.add('hover:bg-gray-900');
                mod.classList.add('hover:text-gray-100');
                mod.classList.add('text-['+sidetxt1color+']');
            }
        });
        Array.from(document.getElementsByClassName('subtopic')).forEach(app => {
            if(tinycolor(sidebgcolor).isDark()) {
                app.classList.add('hover:bg-gray-100');
                app.classList.add('hover:text-black');
                app.classList.add('text-['+sidetxt2color+']');
                if(appcode != '') {
                    document.getElementById(''+appcode+'').classList.add('bg-gray-100');
                    document.getElementById(''+appcode+'').classList.add('text-black');   
                }
            } else {
                app.classList.add('hover:bg-gray-900');
                app.classList.add('hover:text-gray-100');
                app.classList.add('text-['+sidetxt2color+']');
                if(appcode != '') {
                    document.getElementById(''+appcode+'').classList.add('bg-gray-900');
                    document.getElementById(''+appcode+'').classList.add('text-gray-100');   
                }
            }
        });
        // -------------------------------------------------------------------- //
    });

    if (<?php if (!empty($APPNAME) && ($MODE == "E")) { echo 1; } else { echo 0; } ?> == 1) {
        // Replace the <textarea id="editor"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'editor', {
            height: 490,
            // Adding Text and Background Color, Font Family and Size buttons to make sample
            // text styling more spectacular.
            // extraPlugins: 'colorbutton,font,colordialog',
            // By default, some basic text styles buttons are removed in the Standard preset.
            // Rearrange the toolbar slightly.
            // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [
                {
                "name": "clipboard",
                "groups": ["undo", "clipboard"]
                },
                {
                "name": "basicstyles",
                "groups": ["basicstyles"]
                },
                {
                "name": "styles",
                "groups": ["styles"]
                },
                {
                "name": "colors"
                },
                {
                "name": "paragraph",
                "groups": ["list", "indent", "blocks", "align", "bidi"]
                },
                {
                "name": "links",
                "groups": ["links"]
                },
                {
                "name": "insert",
                "groups": ["insert"]
                },
                {
                "name": "document",
                "groups": ["mode"]
                }
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            // removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
            removeButtons: 'Anchor,Styles,Specialchar,PasteFromWord,About'

        } );
    }  // if (<?php if (!empty($APPNAME) && ($MODE == "E")) { echo 1; } else { echo 0; } ?> == 1) {

    function toggleSidebarManual() {
        const aside = document.querySelector('.manual-menu')
        aside.classList.toggle('hidden')
    }
</script>
<!-- -------------------------------------------------------------------------------- -->
</html>

