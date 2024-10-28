<?php 
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
require_once(dirname(__FILE__,1) . '/common/SessionStart.php'); 

if (isset($_SESSION['LANG'])) {
    require_once($_SESSION['APPPATH'] . '/lang/' . strtolower($_SESSION['LANG']) . '/menu.php');
} else {  
    require_once($_SESSION['APPPATH'] . '/lang/en/menu.php');
}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DMCS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  Css  -->
    <link href="<?=$_SESSION['APPURL'] . '/css/home.css'; ?>" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>" rel="stylesheet">
    <!-- Tailwind CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/tailwind/tailwind.min.css'; ?>" rel="stylesheet">
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Script  -->
    <!-- -------------------------------------------------------------------------------- -->
    <!-- <script src="<?=$_SESSION['APPURL'] . '/js/menu.js'; ?>"></script> -->
    <script src="<?=$_SESSION['APPURL'] . '/js/menu.js'; ?>" integrity="sha384-4I8W0PzQNnfhpMueEF9fvQBgth3rNJjl5U6opxRw2jrBFtyPC/G6Qp9cQKu+PoH7" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>" integrity="sha384-oMQ5ko2jLSZXRA4GGPs7QohksV1sZ8/JIL8ioAdjU4XSSjvBKMoofyNrlREXWmbN" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Flowbite -->
    <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/flowbite.js'; ?>" integrity="sha384-RNh9MdmjHSkDesPwHUG/4Q140YGzL9GCuTiMtpYulluOVVu+gspE3/FAOftffvgN" crossorigin="anonymous"></script>
    <!-- AlpineJS -->
    <script defer src="<?=$_SESSION['APPURL'] . '/js/tailwind/alpinejs-3.13.8.min.js'; ?>"integrity="sha384-MGt/yQlIAvCVZEB4PNx8b9JxEfqFXemRJcpH6AIHAxDt1bRfYFeOnv3HJMW0LVD3" crossorigin="anonymous"></script>
    <!-- Tailwind -->
    <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/tailwindcss-3.4.3.js'; ?>" integrity="sha384-6TINTfz7HsxvzWYBsZvQCgB4WC6Xut9d7NAvf74UZ/f6hTtS2+wdcsg3m+rhpj4g" crossorigin="anonymous"></script>
    <!-- <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/tailwindcss.js'; ?>" integrity="sha384-sNJWcnN52nOgm5mxSYb1UdVW1vMZVLjIKbkrw2rrr85TjQ15qeg6k9nCfKHlSD4q" crossorigin="anonymous"></script> -->
    <!-- Tiny color  -->
    <script src="<?=$_SESSION['APPURL'] . '/js/tinycolor.js'; ?>"></script>
</head>
<body>
<div class="flex flex-col h-screen w-full">
    <!--  start::navbar -->
    <header class="flex relative top-0 text-semibold">
        <nav id="navbar" class="relative top-0 z-40 flex w-full flex-row justify-between px-4 py-2">
            <div class="flex w-6/12 justify-start">
                <span class="px-2 py-1 items-center cursor-pointer rounded" onclick="javascript:window.location.reload();">
                    <img class='object-cover w-auto h-12 rounded' src='<?=$_SESSION['APPURL'] . '/img/dmcs_logo_n.png'; ?>' alt='logo'>
                </span>
                <span class="px-3 py-2.5 mx-1 [&>svg]:h-8 [&>svg]:w-8 cursor-pointer items-center rounded menu-hover" onclick="javascript:window.location.reload();">
                    <svg class="h-6 w-6 stroke-current menu-h-color" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                        <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z"/>
                    </svg>
                </span>
                <span class="menu-h-color text-lg font-semibold py-2.5 pt-4 items-center cursor-pointer" onclick="javascript:window.location.reload();"><?=language('home')?></span>
            </div>

            <div class="flex w-6/12 justify-end">
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
                        <li>
                            <a class="menu-h-color flex items-center gap-x-3.5 px-2.5 py-2 rounded menu-hover" 
                            onclick="javascript:onloadpage(); window.location.href = appurl + '/include/colorsettings.php'">
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
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
            </div>
        </nav>
    </header>
    <!--  end::navbar -->

    <div class="flex flex-1 overflow-hidden">
        <!--   start::Main Content  -->
        <main class="flex-1 overflow-y-auto paragraph justify-center items-center"><!-- flex -->
            <!-- Grid -->
            <div class="grid gap-1 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 p-2 md:p-2 xl:p-2 grid-flow-row-dense"><?php
            foreach ($_SESSION['MENU'] as $item) {
                if($item['FORMAPP'] == 'MOD' && $item['FORMSEQ'] == '0' && $item['SEQ'] == '0') { ?>
                <!-- Card List Section -->
                <section class="py-5 px-5">
                    <!-- Card Grid --> <!-- bg-white bg-transparent -->
                    <div class="relative bg-transparent border-2 rounded-3xl shadow-md dark:border-gray-700 transform transition duration-500 hover:scale-125 hover:bg-amber-50">
                        <!-- Clickable Area -->
                        <a class="cursor-pointer group/item" onclick="javascript:onloadpage(); javascript:setAppModule('<?=$item['MODSEQ']?>', '<?=$_SESSION['COMCD']?>');">
                            <!-- Card Item -->
                            <div class="flex px-4 pt-2 sm:px-6 sm:pt-4 md:px-8 md:pt-6 lg:px-14 lg:pt-10 xl:px-14 xl:pt-6 justify-center">
                                <!-- Image -->
                                <div class="shrink-0">
                                    <!-- duration-300 filter grayscale hover:grayscale-0 -->
                                    <img class="h-20 w-20 object-fill md:object-scale-down rounded-md transition-all duration-300 filter"
                                        src="<?=$_SESSION['APPURL'] . '/img/menu/' . $item['NODEKEY'].'.png'; ?>" loading="lazy">
                                </div>
                            </div>

                            <div class="px-2 py-4">
                                <p class="text-color text-base font-medium tracking-tight group-hover/item:text-gray-700 text-center line-clamp-2"><?=$item['NODETITLE']?></p>
                            </div>
                        </a>
                    </div>
                </section><?php
                }
            } ?></div>
        </main>
        <!--   end::Main Content -->
    </div>

    <!-- start::footer -->
    <div class="flex bg-gray-200">
        <!-- Footer -->
        <p class="text-black text-[13px]"><?php echo 'URL : ' . $_SESSION['HOST'] . ' | Company : ' . $_SESSION['COMCD'] . ' | User : ' . $_SESSION['USERCODE']; ?></p>
    </div>
    <!-- end::footer -->

    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
    <div id='modalchange'></div>
    <div id='modalabout'></div>
</div>
</body>
<script type="text/javascript">
    var appurl = '<?php echo $_SESSION['APPURL'];?>';
    const companycode = '<?php echo isset($_SESSION['COMCD']) ? $_SESSION['COMCD']: '';?>';
    const usercode = '<?php echo isset($_SESSION['USERCODE']) ? $_SESSION['USERCODE']: '';?>';
    // console.log(appurl);
    $(document).ready(function() {
        const navbgcolor = '<?php echo isset($_SESSION['NAVBARBGCOLOR']) ? $_SESSION['NAVBARBGCOLOR']: '#93c5fd';?>';
        const navtxtcolor = '<?php echo isset($_SESSION['NAVBARTXTCOLOR']) ? $_SESSION['NAVBARTXTCOLOR']: '#fefefe';?>';
        const mainbgtyper = '<?php echo isset($_SESSION['MAINPAGEBGTYPE']) ? $_SESSION['MAINPAGEBGTYPE']: '';?>';
        const mainbgvalue = '<?php echo isset($_SESSION['MAINPAGEBGVALUE']) ? $_SESSION['MAINPAGEBGVALUE']: '#fefefe';?>';
        const maintxtcolor = '<?php echo isset($_SESSION['MAINPAGETXTCOLOR']) ? $_SESSION['MAINPAGETXTCOLOR']: '#374151';?>';

        const dropdownChoice = document.getElementById('dropdown-choice');
        dropdownChoice.addEventListener('click', (e) => {
            e.preventDefault(); dropdownChoice.classList.toggle('hidden');
        });

        const dropdownInfo= document.getElementById('dropdown-info');
        dropdownInfo.addEventListener('click', (e) => {
            e.preventDefault(); dropdownInfo.classList.toggle('hidden');
        });
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
        }
        // -------------------------------------------------------------------- //

        // ------------------------------ Main body --------------------------- //
        const main = document.querySelector('main');
        if(mainbgtyper == 'Color') {
            main.style.background = '';
            main.style.backgroundColor = mainbgvalue;
        } else if(mainbgtyper == 'Picture') {
            const bgImgPath = appurl + mainbgvalue;
            main.style.backgroundColor = '';
            main.style.background = "url(" + bgImgPath + ")";
            main.style.backgroundSize = 'cover';
        } else {
            main.style.background = '';
            main.style.backgroundColor = mainbgvalue;
        }

        Array.from(document.getElementsByClassName('text-color')).forEach(textcolor => {
            textcolor.classList.add('text-['+maintxtcolor+']');
        });

        // Array.from(document.getElementsByClassName('btn')).forEach(btn => {
        //     if (tinycolor(mainbgvalue).isDark()) {
        //         btn.classList.remove('text-gray-900');
        //         btn.classList.remove('hover:bg-gray-900');
        //         btn.classList.remove('hover:text-gray-100');
        //         btn.classList.add('text-gray-100');
        //         btn.classList.add('hover:bg-gray-100');
        //         btn.classList.add('hover:text-gray-900');
        //         btn.classList.add('border-gray-100');
        //     } else {
        //         btn.classList.remove('text-gray-100');
        //         btn.classList.remove('hover:bg-gray-100');
        //         btn.classList.remove('hover:text-gray-900');
        //         btn.classList.add('text-gray-900');
        //         btn.classList.add('hover:bg-gray-900');
        //         btn.classList.add('hover:text-gray-100');
        //         btn.classList.add('border-gray-900');
        //     }
        // });
        // -------------------------------------------------------------------- //
    });
</script>
</html>