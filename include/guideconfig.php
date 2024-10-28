<?php
function guideInclude() { ?>
    <!--  Css  -->
    <link href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>" rel="stylesheet">
    <link href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>" rel="stylesheet">
    <!-- Bootstrap CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>" rel="stylesheet">
    <!-- Tailwind CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/tailwind/tailwind.min.css'; ?>" rel="stylesheet">
    <!-- Sort Table CSS Links -->
    <link href="<?=$_SESSION['APPURL'] . '/css/sortable.min.css'; ?>" rel="stylesheet">
    
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Script  -->
    <!-- -------------------------------------------------------------------------------- -->
    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>" integrity="sha384-oMQ5ko2jLSZXRA4GGPs7QohksV1sZ8/JIL8ioAdjU4XSSjvBKMoofyNrlREXWmbN" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/general.js'; ?>" integrity="sha384-4qvj7RSbBEkNXfdm80r5Q3LxzKfYdB1NJR81EGcdSkceXO1/n3xVsx8ReoGB0yBO" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/sweetalert2.min.js'; ?>" integrity="sha384-mngH0dsoMzHJ55nmFSRTjl5pdhgzHDeEoLOuZp2U28VrwCH0ieB9ntimtLbJm9KJ" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Tailwind -->
    <script src="<?=$_SESSION['APPURL'] . '/js/tailwind/tailwindcss.js'; ?>" integrity="sha384-sNJWcnN52nOgm5mxSYb1UdVW1vMZVLjIKbkrw2rrr85TjQ15qeg6k9nCfKHlSD4q" crossorigin="anonymous"></script>
    
    <!-- Tiny color  -->
    <script src="<?=$_SESSION['APPURL'] . '/js/tinycolor.js'; ?>"></script>

    <!-- Sort Table  -->
    <script src="<?=$_SESSION['APPURL'] . '/js/sortable.min.js'; ?>" integrity="sha384-AdSchXgP8wvr5kTblyNHm7AmdlmQumH+1rc7OsAk7CPyNKXOywnyeISSuSoo9aYv" crossorigin="anonymous"></script>
<?php
} 
//--------------------------------------------------------------------------------// 
function guideloadTheme() { ?>
    <script type="text/javascript">  
        $(document).mouseleave(function () {
            window.onbeforeunload = null;
            sessionStorage.setItem('isRefresh', false);
        });

        $(document).mouseenter(function () {
            window.onbeforeunload = null;
            sessionStorage.setItem('isRefresh', false);
        });

        window.addEventListener('beforeunload', function (event) {
            delete event['returnValue']; // unshow alert
        });
        var appurl = '<?php echo $_SESSION['APPURL'];?>';
        const companycode = '<?php echo isset($_SESSION['COMCD']) ? $_SESSION['COMCD']: '';?>';
        const usercode = '<?php echo isset($_SESSION['USERCODE']) ? $_SESSION['USERCODE']: '';?>';
        var appmod = '<?php echo isset($_SESSION['APPMOD']) ? $_SESSION['APPMOD']: '';?>';
        // console.log(appurl); 
        const mainbgtyper = '<?php echo isset($_SESSION['MAINPAGEBGTYPE']) ? $_SESSION['MAINPAGEBGTYPE']: '';?>';
        const mainbgvalue = '<?php echo isset($_SESSION['MAINPAGEBGVALUE']) ? $_SESSION['MAINPAGEBGVALUE']: '#fefefe';?>';
        const maintxtcolor = '<?php echo isset($_SESSION['MAINPAGETXTCOLOR']) ? $_SESSION['MAINPAGETXTCOLOR']: '#374151';?>';
        // ------------------------------ Main body --------------------------- //
        const main = document.querySelector('main');
        if(mainbgtyper == 'Picture') {
            const bgImgPath = appurl +  mainbgvalue;
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
        }

        Array.from(document.getElementsByClassName('text-color')).forEach(textcolor => {
            textcolor.classList.add('text-['+maintxtcolor+']');
        });
        // -------------------------------------------------------------------- //
        // ----- call class search-tag -------//
        searchIcon();
        // -----------------------------------//
        // -------------------------------------------------------------------- //

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
//--------------------------------------------------------------------------------// ?>