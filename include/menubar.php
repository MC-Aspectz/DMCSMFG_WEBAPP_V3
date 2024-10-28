<?php
function navBar() { 
    //--------------------------------------------------------------------------------
    // Application Module
    //--------------------------------------------------------------------------------
    // Get App Module
    // if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://"; else $url = "http://";   
    // // Append the host(domain name, ip) to the URL.   
    // $url.= $_SERVER['HTTP_HOST'];   
    // // Append the requested resource location to the URL   
    // $url.= $_SERVER['REQUEST_URI'];    
    // // echo $url;
    // $arydirname = explode('/', $url);
    // $appmod = $arydirname[array_key_last($arydirname) - 1];
    // // Set App Module
    // $_SESSION['APPMOD'] = $appmod;
    if (isset($_SESSION['LANG'])) {
        require_once($_SESSION['APPPATH'] . '/lang/' . strtolower($_SESSION['LANG']) . '/menu.php');
    } else {  
        require_once($_SESSION['APPPATH'] . '/lang/en/menu.php');
    }
    // ---------------------- APP MODULE ------------------------------------------//
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = explode('/', $path);
    $appmod = $path[array_key_last($path) - 1];
    $apppack = $path[array_key_last($path) - 2];
    if(str_contains($appmod, 'APPMOD')) {
        $_SESSION['APPMOD'] = $appmod;
    } else {
        if(!empty($_SESSION['MODCURRENT'][$apppack])) {
            $_SESSION['APPMOD'] = $_SESSION['MODCURRENT'][$apppack];
        }
    }
    //--------------------------------------------------------------------------------?>
    <!--  Css  -->
    <link href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/general.css'; ?>" rel="stylesheet">
    <!-- Bootstrap CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>" rel="stylesheet">
    <!-- Tailwind CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/tailwind/tailwind.min.css'; ?>" rel="stylesheet">
    <!-- Sort Table CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/sortable.min.css'; ?>" rel="stylesheet">
    <!-- Data Table CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/dataTables/dataTables.jquery-1.13.6.min.css'; ?>" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/dataTables/dataTables.fixedColumns-4.3.0.min.css'; ?>" rel="stylesheet">

    <!-- -------------------------------------------------------------------------------- -->
    <!--  Script  -->
    <!-- -------------------------------------------------------------------------------- -->
    <!-- <script src="<?=$_SESSION['APPURL'] . '/js/menu.js'; ?>"></script> -->
    <script src="<?=$_SESSION['APPURL'] . '/js/menu.js'; ?>" integrity="sha384-5Ji3pg/gx/YUh/RmtTQ7kDNC+GkVaafbp1L4VqyS7FM9SME+5NTSXtxczuqpERoq" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/general.js'; ?>" integrity="sha384-4qvj7RSbBEkNXfdm80r5Q3LxzKfYdB1NJR81EGcdSkceXO1/n3xVsx8ReoGB0yBO" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>" integrity="sha384-oMQ5ko2jLSZXRA4GGPs7QohksV1sZ8/JIL8ioAdjU4XSSjvBKMoofyNrlREXWmbN" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery.redirect.min.js'; ?>" integrity="sha384-erh2+1DEMpKqgBW+JGay/tUJCZQR6itzYhzgonFVvsqT14Io75HZjvkqKUrdPH1t" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/sweetalert2.min.js'; ?>" integrity="sha384-mngH0dsoMzHJ55nmFSRTjl5pdhgzHDeEoLOuZp2U28VrwCH0ieB9ntimtLbJm9KJ" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/moment.min.js'; ?>" integrity="sha384-KIix3a0qkeD2RPwPvpkJ+Knc91vkmDI+i2c7phIO+EfV3dpfDXIGSqQjpIaJXlR9" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Data Table -->
    <script src="<?=$_SESSION['APPURL'] . '/js/dataTables/dataTables.jquery-1.13.6.min.js'; ?>"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/dataTables/dataTables.fixedColumns-4.3.0.min.js'; ?>"></script>

    <!-- Tailwind -->
    <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/flowbite.js'; ?>" integrity="sha384-RNh9MdmjHSkDesPwHUG/4Q140YGzL9GCuTiMtpYulluOVVu+gspE3/FAOftffvgN" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/tailwindcss.js'; ?>" integrity="sha384-sNJWcnN52nOgm5mxSYb1UdVW1vMZVLjIKbkrw2rrr85TjQ15qeg6k9nCfKHlSD4q" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/preline.min.js'; ?>" integrity="sha384-VBNGpMG2TrGOaeXBeg0dikwcC55It+09M0Qh6iLIJ5F5FZYFLHc797aueWcxMhgj" crossorigin="anonymous"></script>

    <!-- Tiny color  -->
    <script src="<?=$_SESSION['APPURL'] . '/js/tinycolor.js'; ?>"></script>

    <!-- Sort Table  -->
    <script src="<?=$_SESSION['APPURL'] . '/js/sortable.min.js'; ?>" integrity="sha384-AdSchXgP8wvr5kTblyNHm7AmdlmQumH+1rc7OsAk7CPyNKXOywnyeISSuSoo9aYv" crossorigin="anonymous"></script>

    <nav id="navbar" class="relative top-0 z-40 flex w-full flex-row justify-between px-4 py-2">
        <div class="flex w-8/12 justify-start">
            <!-- <span class="px-2 py-1 items-center rounded menu-hover" onclick="javascript:toggleSidebar();">
                <img class='object-cover w-auto h-12 rounded' src='<?=$_SESSION['APPURL'] . '/img/dmcs_logo_n.png'; ?>' alt='logo'>
            </span> -->
            <span class="px-3 py-2 mx-1 [&>svg]:h-8 [&>svg]:w-8 cursor-pointer items-center rounded menu-hover" onclick="javascript:toggleSidebar();">
                <svg class="h-6 w-6 stroke-current menu-h-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" clip-rule="evenodd"/>
                </svg>
            </span>

            <a class="px-3 py-2 mx-1 [&>svg]:h-8 [&>svg]:w-8 cursor-pointer items-center rounded menu-hover" href="<?=$_SESSION['APPURL'] . '/home.php'?>"
                data-tooltip-target="tooltip-home" data-tooltip-placement="bottom">
                <svg class="h-6 w-6 stroke-current menu-h-color" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z"/>
                </svg>
                <div id="tooltip-home" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-slate-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-slate-600">
                    <?=language('home')?>
                </div>
            </a><?php
            // href="<?=$_SESSION['APPURL'] . '/app/' . $_SESSION['COMCD'] . '/MAIN/'. $item['MODSEQ'] 
            foreach ($_SESSION['MENU'] as $item) {
                if($item['FORMAPP'] == 'MOD' && $item['FORMSEQ'] == '0' && $item['SEQ'] == '0') {  ?>
                    <a class="px-3 py-2.5 mx-1 [&>svg]:h-8 [&>svg]:w-8 cursor-pointer items-center rounded menu-hover" id="mod-<?=$item['MODSEQ']?>"
                        onclick="javascript:onloadpage(); javascript:setAppModule('<?=$item['MODSEQ']?>', '<?=$_SESSION['COMCD']?>');" data-tooltip-target="tooltip-<?=$item['MODSEQ']?>" data-tooltip-placement="bottom">
                        <img class="h-6 w-6 pt-1" src="<?=$_SESSION['APPURL'] . '/img/menubar/' . $item['NODEKEY'].'.png'; ?>" id="nav-<?=$item['MODSEQ']?>" loading="lazy">
                    </a>
                    <div id="tooltip-<?=$item['MODSEQ']?>" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-slate-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-slate-600" role="tooltip"><?=$item['NODETITLE']?>
                    </div><?php
                }
            } ?>
        </div>

        <div class="flex w-4/12 justify-end">
            <?php if(isset($_SESSION['APPCODE']) && $_SESSION['APPCODE'] != '') { ?>
            <a class="px-3 py-2.5 mx-1 [&>svg]:h-8 [&>svg]:w-8 cursor-pointer items-center rounded menu-hover" data-tooltip-target="tooltip-manual" 
                data-tooltip-placement="bottom" href="<?=$_SESSION['APPURL'] . '/include/manual.php?appcd=' . $_SESSION['APPCODE'] ?>" target="_blank">
                <img class="h-6 w-6 pt-1" src="<?=$_SESSION['APPURL'] . '/img/menubar/MANUAL.png'; ?>" id="MANUAL" loading="lazy">
                <div id="tooltip-manual" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-slate-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-slate-600"><?=language('manual')?>
                </div>
            </a><?php } ?>

            <button id="dropdown-user" data-dropdown-toggle="dropdown-choice" class="menu-h-color text-xl rounded font-semibold py-1 px-2 inline-flex items-center pt-1.5 menu-hover" 
                    type="button"><?=$_SESSION['USERCODE']?>
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <div id="dropdown-choice" class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-user">
                    <li>
                        <a class="menu-h-color flex items-center gap-x-3.5 px-2.5 py-2 rounded menu-hover" data-bs-toggle="modal" data-bs-target="#changePassword-modal" 
                            onclick="javascript:change_password();">
                            <svg class="size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /> -->
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z"/>
                            </svg><?=language('changepassword')?>
                        </a>
                    </li>

                    <li>
                        <a class="menu-h-color flex items-center gap-x-3.5 px-2.5 py-2 rounded menu-hover" onclick="javascript:onloadpage(); window.location.href = appurl + '/include/colorsettings.php'">
                            <svg class="size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42"/>
                            </svg><?=language('colorsettings')?>
                        </a>
                    </li>

                    <li>
                        <a class="menu-h-color flex items-center gap-x-3.5 px-2.5 py-2 rounded menu-hover" onclick="javascript:onloadpage(); window.location.href = appurl + '/logout.php'">
                            <svg class="size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" clip-rule="evenodd"/>
                            </svg><?=language('logout')?>
                        </a>
                    </li>
                </ul>
            </div>

            <button id="dropdown-infomation" data-dropdown-toggle="dropdown-info" class="menu-h-color px-3 py-2 mx-1 [&>svg]:h-8 [&>svg]:w-8 cursor-pointer items-center rounded menu-hover" 
                    data-tooltip-target="tooltip-info" data-tooltip-placement="bottom">
                <svg class="h-6 w-6 stroke-current menu-h-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                </svg>
                <div id="tooltip-info" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-slate-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-slate-600">
                    <?=language('info')?>
                </div>
            </button>

            <div id="dropdown-info" class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-infomation">
                   <li>
                        <a class="menu-h-color flex items-center gap-x-3.5 px-2.5 py-2 rounded menu-hover" onclick="window.open(appurl + '/include/manual.php?appcd=FLOWCHART', '_blank')">
                            <svg class="size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" clip-rule="evenodd"/>
                            </svg><?=language('flowchart')?>
                        </a>
                    </li>

                    <li>
                        <a class="menu-h-color flex items-center gap-x-3.5 px-2.5 py-2 rounded menu-hover" data-bs-toggle="modal" data-bs-target="#about-modal" onclick="javascript:about();">
                            <svg class="size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                            </svg><?=language('about')?>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- <svg class="h-6 w-6 stroke-current menu-h-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
            </svg> -->

            <!-- <svg class="h-6 w-6 stroke-current menu-h-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
            </svg> -->
        </div>
    </nav>
    <div id='modalchange'></div>
    <div id='modalabout'></div>

    <script type="text/javascript"> 
        var appurl = '<?php echo $_SESSION['APPURL'];?>';
        const companycode = '<?php echo isset($_SESSION['COMCD']) ? $_SESSION['COMCD']: '';?>';
        const usercode = '<?php echo isset($_SESSION['USERCODE']) ? $_SESSION['USERCODE']: '';?>';
        var appmod = '<?php echo isset($_SESSION['APPMOD']) ? $_SESSION['APPMOD']: '';?>';
        // console.log(appurl); 
        $(document).ready(function() {
            const dropdownChoice = document.getElementById('dropdown-choice');
            dropdownChoice.addEventListener('click', (e) => {
                e.preventDefault();
                dropdownChoice.classList.toggle('hidden');
            });
            const dropdownInfo = document.getElementById('dropdown-info');
            dropdownInfo.addEventListener('click', (e) => {
                e.preventDefault(); dropdownInfo.classList.toggle('hidden');
            });
            const navbgcolor = '<?php echo isset($_SESSION['NAVBARBGCOLOR']) ? $_SESSION['NAVBARBGCOLOR']: '#93c5fd';?>';
            const navtxtcolor = '<?php echo isset($_SESSION['NAVBARTXTCOLOR']) ? $_SESSION['NAVBARTXTCOLOR']: '#fefefe';?>';
            const mainbgtyper = '<?php echo isset($_SESSION['MAINPAGEBGTYPE']) ? $_SESSION['MAINPAGEBGTYPE']: '';?>';
            const mainbgvalue = '<?php echo isset($_SESSION['MAINPAGEBGVALUE']) ? $_SESSION['MAINPAGEBGVALUE']: '#fefefe';?>';
            const maintxtcolor = '<?php echo isset($_SESSION['MAINPAGETXTCOLOR']) ? $_SESSION['MAINPAGETXTCOLOR']: '#374151';?>';
            // const navcolor = document.querySelector('nav');
            // ------------------------------ Navbar ------------------------------ //
            const navcolor = document.getElementById('navbar');
            navcolor.classList.add('bg-['+navbgcolor+']');
            dropdownChoice.classList.add('bg-['+navbgcolor+']');
            dropdownChoice.classList.add('text-['+navtxtcolor+']');
            dropdownInfo.classList.add('bg-['+navbgcolor+']');
            dropdownInfo.classList.add('text-['+navtxtcolor+']');
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
                if(appmod != '' && document.getElementById('mod-'+appmod+'')) document.getElementById('mod-'+appmod+'').classList.add('bg-gray-700');
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
                if(appmod != '' && document.getElementById('mod-'+appmod+'')) document.getElementById('mod-'+appmod+'').classList.add('bg-sky-100');
            }
            // -------------------------------------------------------------------- //
            // ------------------------------ Main body --------------------------- //
            const main = document.querySelector('main');
            if(mainbgtyper == 'Picture') {
                const bgImgPath = appurl + mainbgvalue;
                main.style.backgroundColor = '';
                main.style.background = "url(" + bgImgPath + ")";
                main.style.backgroundSize = 'cover';
                getImageLightness(bgImgPath ,function(brightness) {
                    // console.log(brightness);
                    Array.from(document.getElementsByClassName('btn')).forEach(btn => {
                        if(brightness < 127.5) {
                            btn.classList.remove('text-gray-900');
                            btn.classList.remove('hover:bg-gray-900');
                            btn.classList.remove('hover:text-gray-100');
                            btn.classList.remove('border-gray-900');
                            btn.classList.add('text-gray-100');
                            btn.classList.add('hover:bg-gray-100');
                            btn.classList.add('hover:text-gray-900');
                            btn.classList.add('border-gray-100');
                            // setBrightness('light');
                        } else {
                            btn.classList.remove('text-gray-100');
                            btn.classList.remove('hover:bg-gray-100');
                            btn.classList.remove('hover:text-gray-900');
                            btn.classList.remove('border-gray-100');
                            btn.classList.add('text-gray-900');
                            btn.classList.add('hover:bg-gray-900');
                            btn.classList.add('hover:text-gray-100');
                            btn.classList.add('border-gray-900');
                            // setBrightness('dark');
                        }
                    });
                });
            // } else if(mainbgtyper == 'Color') {
            } else {
                main.style.background = '';
                main.style.backgroundColor = mainbgvalue;

                Array.from(document.getElementsByClassName('btn')).forEach(btn => {
                    if (tinycolor(mainbgvalue).isDark()) {
                        btn.classList.remove('text-gray-900');
                        btn.classList.remove('hover:bg-gray-900');
                        btn.classList.remove('hover:text-gray-100');
                        btn.classList.remove('border-gray-900');
                        btn.classList.add('text-gray-100');
                        btn.classList.add('hover:bg-gray-100');
                        btn.classList.add('hover:text-gray-900');
                        btn.classList.add('border-gray-100');
                        // setBrightness('light');
                    } else {
                        btn.classList.remove('text-gray-100');
                        btn.classList.remove('hover:bg-gray-100');
                        btn.classList.remove('hover:text-gray-900');
                        btn.classList.remove('border-gray-100');
                        btn.classList.add('text-gray-900');
                        btn.classList.add('hover:bg-gray-900');
                        btn.classList.add('hover:text-gray-100');
                        btn.classList.add('border-gray-900');
                        // setBrightness('dark');
                    }
                });
            }

            Array.from(document.getElementsByClassName('text-color')).forEach(textcolor => {
                textcolor.classList.add('text-['+maintxtcolor+']');
            });
            // ----- call class search-tag -------//
            searchIcon();
            // -----------------------------------//
            // -------------------------------------------------------------------- //
        });

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

                var imageData = ctx.getImageData(0, 0 , canvas.width, canvas.height);
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

        function searchIcon() {
            Array.from(document.getElementsByClassName('search-tag')).forEach(searchcolor => {
                searchcolor.classList.add('text-gray-200');
                searchcolor.classList.add('bg-blue-500');
                searchcolor.classList.add('hover:text-gray-100');
                searchcolor.classList.add('hover:bg-blue-800');
                searchcolor.classList.add('border-blue-500');
                searchcolor.classList.add('focus:ring-blue-300');
                // searchcolor.classList.add('text-gray-200');
                // searchcolor.classList.add('bg-indigo-500');
                // searchcolor.classList.add('hover:text-gray-100');
                // searchcolor.classList.add('hover:bg-indigo-800');
                // searchcolor.classList.add('border-indigo-500');
                // searchcolor.classList.add('focus:ring-indigo-300');
            });
        } 
    </script><?php
}
//--------------------------------------------------------------------------------

function sideBar() {
    //--------------------------------------------------------------------------------
    // Application
    //--------------------------------------------------------------------------------
    // Get App Module
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = explode('/', $path);
    $appmod = $path[array_key_last($path) - 1];
    $apppack = $path[array_key_last($path) - 2];
    $_SESSION['PACKCODE'] = $apppack;
    if(str_contains($appmod, 'APPMOD')) {
        $appcode = '';
        $_SESSION['APPMOD'] = $appmod;
    } else {
        $appcode = $appmod;
        $_SESSION['APPMOD'] = $_SESSION['MODCURRENT'][$apppack];
    }
    // print_r($appcode);
    // $_SESSION['APPCURRENT'] = $appcode;
    // print_r($_SESSION['APPMOD']);
    foreach ($_SESSION['MENU'] as $item) {
        $_SESSION['APPPACK'][$_SESSION['APPMOD']] = array_filter($_SESSION['MENU'], function($v, $k) {
            return $v['MODSEQ'] == $_SESSION['APPMOD'] && $v['FORMAPP'] == 10 && $v['FORMSEQ'] == 0;
        }, ARRAY_FILTER_USE_BOTH);
    }

    if(!empty($_SESSION['APPPACK'][$_SESSION['APPMOD']])) {
        foreach ($_SESSION['APPPACK'][$_SESSION['APPMOD']] as $appmenu) {
            $_SESSION['MODCURRENT'][$appmenu['NODEDATA']] = $appmenu['MODSEQ'];
        }
        $packdata = $_SESSION['APPPACK'][$_SESSION['APPMOD']][array_key_first($_SESSION['APPPACK'][$_SESSION['APPMOD']])];
        if($_SESSION['PACKCODE'] == 'MAIN') {
            $_SESSION['PACKCODE'] = $packdata['NODEDATA'];
        }
        // $_SESSION['PACKNAME'] = $packdata['NODETITLE'];
        // echo '<pre>';
        // print_r($packdata);
        // echo '</pre>';
        $_SESSION['APPDATA'][$_SESSION['APPMOD']] = array_filter($_SESSION['MENU'], function($v, $k) {
          return $v['MODSEQ'] == $_SESSION['APPMOD'] && $v['FORMAPP'] == 'APP';
        }, ARRAY_FILTER_USE_BOTH);
        // echo '<pre>';
        // print_r($_SESSION['APPDATA']);
        // echo '</pre>';
    }
    // print_r($_SESSION['PACKCODE']);
    //--------------------------------- Appcode ---------------------------------------//
    $pathapp = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $pathTrimmed = trim($pathapp, '/');
    $pathTokens = explode('/', $pathTrimmed);
    if (substr($pathapp, -1) !== '/') { array_pop($pathTokens); }
    $appcdform = end($pathTokens); 
    // $leftsidectrl = isset($_SESSION['LEFTSIDECTRL_'.$appcdform]) ? $_SESSION['LEFTSIDECTRL_'.$appcdform]: 'false';
    // $rightsidectrl = isset($_SESSION['RIGHTSIDECTRL_'.$appcdform]) ? $_SESSION['RIGHTSIDECTRL_'.$appcdform]: 'false';
    //--------------------------------------------------------------------------------//
    //-------------------------------------------------------------------------------- ?>
    <aside class="side-menu flex-shrink-0 w-64 flex flex-col border-r transition-all ease-in-out duration-500 overflow-y-auto">
        <nav class="flex flex-col flex-wrap p-2 w-full" data-hs-accordion-always-open>
            <ul class="hs-accordion-group space-y-1.5"><?php
            foreach ($_SESSION['APPPACK'][$_SESSION['APPMOD']] as $value) {
            if($value['NODEDATA'] == $_SESSION['PACKCODE']) { ?>
                <li class="hs-accordion active" id="app-<?=$value['NODEDATA']?>"><?php } else {?>
                <li class="hs-accordion" id="app-<?=$value['NODEDATA']?>"><?php } ?>
                    <button type="button" class="maintopic hs-accordion-toggle hs-accordion-active:text-gray-100 hs-accordion-active:hover:bg-gray-600 w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 rounded-lg"
                            aria-controls="app-<?=$value['NODEDATA']?>-collapse">
                        <span class="text-sm font-semibold"><?=$value['NODETITLE']?></span> 
                        <svg class="hs-accordion-active:hidden ms-auto block size-4" width="16" height="16" viewBox="0 0 16 16" fill="none">
                          <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                    </button>
                    <?php if($value['NODEDATA'] == $_SESSION['PACKCODE']) { ?>
                    <div id="app-<?=$value['NODEDATA']?>-collapse" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="app-<?=$value['NODEDATA']?>"><?php } else {?>
                    <div id="app-<?=$value['NODEDATA']?>-collapse" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden" aria-labelledby="app-<?=$value['NODEDATA']?>"><?php } ?>
                        <ul class="pt-2 ps-2"><?php
                        foreach ($_SESSION['APPDATA'][$_SESSION['APPMOD']] as $item) {
                            if($item['MODSEQ'] == $value['MODSEQ'] && $item['FORMAPP'] == 'APP' && $item['SEQ'] == $value['NODEKEY']) { ?>
                            <li class="py-0.5">
                                <a class="subtopic flex items-start gap-x-3.5 py-1 px-2.5 text-[12px] rounded-lg cursor-pointer" id="<?=$item['NODEDATA']?>" 
                                    onclick="javascript:onloadpage(); changeApp('<?=$item['NODEKEY']?>', '<?=$_SESSION['COMCD']?>', '<?=$appcode?>', '<?=$item['NODETITLE']?>');"><?=$item['NODETITLE']?></a>
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

    <script type="text/javascript">
        $(document).ready(function() {
            // ------------------------------ event ----------------------------- //
            $('input').attr('autocomplete', 'off');
            $(window).on('mouseover', (function () {
                sessionStorage.setItem('isRefresh', false);
                window.onbeforeunload = null;
            }));

            $(document).on('keydown', function(event) {
                // console.log(event.which);
                if (event.which === 116 || (event.which === 116 && event.ctrlKey) || (event.which === 67 && event.ctrlKey) 
                    || (event.which === 86 && event.ctrlKey) || (event.which === 88 && event.ctrlKey) || (event.which === 70 && event.ctrlKey)) {
                    sessionStorage.setItem('isRefresh', false);
                    window.onbeforeunload = null;
                }
                var pageReload = ((PerformanceNavigationTiming && PerformanceNavigationTiming.TYPE === 1) || window.performance.getEntriesByType('navigation').map((nav) => nav.type).includes('reload'));
                if (!pageReload) { sessionStorage.setItem('isRefresh', false); } else { sessionStorage.setItem('isRefresh', false); }
            });

            $(window).on('mouseout keyup change click', (async function (event) {
                // console.log(event.type);
                let appcd = location.pathname.split('/').slice(1)[4];
                if ((event.type === 'change') || (event.type === 'keyup') || (event.key === 'Enter' || event.keyCode === 13) || (event.type === 'click')) {
                    sessionStorage.setItem('isRefresh', false);
                    window.onbeforeunload = null;
                }
                // console.log(sessionStorage.getItem('isRefresh'));
                $(document).mouseleave(async function () {
                    window.onbeforeunload = null;
                    // console.log(window.event.clientY);
                    if(window.event.clientY < 0 ) {
                        sessionStorage.setItem('isRefresh', true);
                        if(sessionStorage.getItem('isRefresh') && appcd != '') {
                            window.onbeforeunload = await closeWindow;
                            // window.addEventListener('beforeunload', function (e) {
                            //     e.preventDefault();
                            //     e.stopImmediatePropagation();
                            //     console.log('beforeunload');
                            //     // delete e['returnValue'];    // unshow alert
                            // });
                        }
                    }
                });
            }));
            // -------------------------------------------------------------------- //
            // ------------------------------ Sidebar ----------------------------- //
            const appcode = '<?php echo isset($appcode) ? $appcode: '' ?>';
            // console.log(appcode);
            const sidebgcolor = '<?php echo isset($_SESSION['SIDEBARBGCOLOR']) ? $_SESSION['SIDEBARBGCOLOR']: '#eff6ff';?>';
            const sidetxt1color = '<?php echo isset($_SESSION['SIDEBARTXTCOLOR1']) ? $_SESSION['SIDEBARTXTCOLOR1']: '#010101';?>';
            const sidetxt2color = '<?php echo isset($_SESSION['SIDEBARTXTCOLOR2']) ? $_SESSION['SIDEBARTXTCOLOR2']: '#010101';?>';
   
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
                    if(document.getElementById(''+appcode+'')) {
                        document.getElementById(''+appcode+'').classList.add('bg-gray-100');
                        document.getElementById(''+appcode+'').classList.add('text-black');   
                    }
                } else {
                    app.classList.add('hover:bg-gray-900');
                    app.classList.add('hover:text-gray-100');
                    app.classList.add('text-['+sidetxt2color+']');
                    if(document.getElementById(''+appcode+'')) {
                        document.getElementById(''+appcode+'').classList.add('bg-gray-900');
                        document.getElementById(''+appcode+'').classList.add('text-gray-100');   
                    }
                }
            });

            // ------------------------------ Side Menu Control ----------------------------- //
            // const sidectrl = '<?php echo isset($_SESSION['SIDECTRL']) ? $_SESSION['SIDECTRL']: 'true' ?>';
            const sidectrl = sessionStorage.getItem('SIDECTRL') ? sessionStorage.getItem('SIDECTRL'): 'true';
            // console.log(sidectrl);
            document.querySelector('.side-menu').classList[sidectrl == 'true' ? 'remove' : 'add']('hidden');
            // ------------------------------------------------------------------------------ //

            // ------------------------------ Side Left or Right Form ----------------------------- //
            const appcdform = '<?php echo isset($appcdform) ? $appcdform: '' ?>';
            const leftsidectrl = sessionStorage.getItem('LEFTSIDECTRL_' + appcdform) ? sessionStorage.getItem('LEFTSIDECTRL_' + appcdform): 'false';
            const rightsidectrl = sessionStorage.getItem('RIGHTSIDECTRL_' + appcdform) ? sessionStorage.getItem('RIGHTSIDECTRL_' + appcdform): 'false';
            // const leftsidectrl = '<?php echo isset($leftsidectrl) ? $leftsidectrl: '' ?>';
            // const rightsidectrl = '<?php echo isset($rightsidectrl) ? $rightsidectrl: '' ?>';
            // console.log(leftsidectrl);
            // console.log(rightsidectrl);

            if(document.querySelector('.left-side-'+appcode)) {
                document.querySelector('.left-side-'+appcode).classList[leftsidectrl == 'false' ? 'remove' : 'add']('hidden');
                document.querySelector('.right-side-'+appcode).classList[leftsidectrl == 'false' ? 'remove' : 'add']('w-full');

            }

            if(document.querySelector('.right-side-'+appcode)) {
                document.querySelector('.right-side-'+appcode).classList[rightsidectrl == 'false' ? 'remove' : 'add']('hidden');
                document.querySelector('.left-side-'+appcode).classList[rightsidectrl == 'false' ? 'remove' : 'add']('w-full');
            }

            if(document.querySelector('.right-size')) {
                Array.from(document.getElementsByClassName('right-size')).forEach(rightSize => {
                    rightSize.classList[leftsidectrl == 'false' ? 'add' : 'remove']('w-full');
                    rightSize.classList[leftsidectrl == 'false' ? 'remove' : 'add']('w-[60%]');
                });
            }

            if(document.querySelector('.left-size')) {
                Array.from(document.getElementsByClassName('left-size')).forEach(leftSize => {
                    leftSize.classList[rightsidectrl == 'false' ? 'remove' : 'add']('w-[60%]');
                });
            }
        // -------------------------------------------------------------------- //
        });
    </script><?php
} 
//--------------------------------------------------------------------------------

function footerBar() { ?>
    <small class="text-black text-[13px]"><?php echo 'URL : ' . $_SESSION['HOST'] . ' | Company : ' . $_SESSION['COMCD'] .' | User : ' . $_SESSION['USERCODE']; ?></small><?php
} 
//-------------------------------------------------------------------------------- ?>