<?php
    require_once('./function/index_x.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">

    <!-- -------------------------------------------------------------------------------- -->
    <!--  guide Include  -->
    <?php guideInclude(); ?>
    <!-- -------------------------------------------------------------------------------- -->
    
    <title><?php echo $_SESSION['APPNAME'].' - '.lang('googlemap'); ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" <?php if(!empty($_GET['page'])){ ?> value="<?=$_GET['page']; ?>" <?php } else { ?> value="" <?php }?>>
    <form class="w-full h-screen p-2" method="POST" id="guideindex" name="guideindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}"><?php
        if(!empty($_GET['GMAPADR'])) { ?>
            <div class="flex-col p-2">
                <label class="text-color block text-base px-2 py-2"><?=lang('googlemap');?></label>
                <iframe class="w-11/12 h-[480px] mx-auto border border-gray-400" src="https://www.google.com/maps?q={{ $_GET['GMAPADR'] }}&output=embed" allowfullscreen="" loading="lazy"></iframe>
            </div><?php
        } else { ?>
            <div class="flex-col p-2">
                <label class="text-color block text-base px-2 py-2"><?=lang('googlemap');?></label>
                <iframe class="w-11/12 h-[480px] mx-auto border border-gray-400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7961366.751750858!2d96.99460933379245!3d13.011066597376619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304d8df747424db1%3A0x9ed72c880757e802!2sThailand!5e0!3m2!1sen!2sus!4v1615958605959!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
            </div><?php
        } ?>
        <div class="flex my-2">
            <div class="flex w-full justify-center">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="back"><?=lang('back'); ?></button>
            </div>
        </div>
    </form>
    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
</main>
</body>
<script src="./js/script.js"></script>
</html>
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->