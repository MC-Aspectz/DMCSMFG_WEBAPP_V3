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
    
    <title><?php echo $_SESSION['APPNAME'].' - '.$lang['itemcategoryindex']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="page" name="page" <?php if(!empty($_GET['page'])){ ?> value="<?=$_GET['page']; ?>" <?php } else { ?> value="" <?php }?>>
    <input type="hidden" id="index" name="index" <?php if(!empty($_GET['index'])){ ?> value="<?=$_GET['index']; ?>"<?php } else { ?> value="" <?php }?>>
    <form class="w-full h-screen p-2" style="width: 80%;" method="POST" id="bankIndex" name="bankIndex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?php echo $lang['bankcode']; ?></label>
                <input class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                       type="text" id="P1" name="P1" value="<?php echo $P1 ?>"/>
            </div>
            <div class="flex w-6/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="search" name="search" onclick="$('#loading').show();"><?=$lang['search']; ?>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="table"> 
            <table class="w-full border-collapse border border-slate-500" id="table_result">
                <thead class="w-full bg-gray-100">
                    <tr class="flex w-full divide-x">
                        <th class="w-4/12 text-center">
                            <?php echo $lang['bankcode']; ?>
                        </th>
                        <th class="w-8/12 text-center">
                            <?php echo $lang['bankname']; ?>
                        </th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]">
                <?php if (!empty($tdata)) {
                    $run = 0;
                    // BANKCD,BANKNAME,SPACE
                    foreach ($tdata as $item) { ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td style="display: none;"><?= ++$run; ?></td>
                            <td class="h-6 w-4/12 text-sm pl-1"><?php echo $item["BANKCD"] ?></td>
                            <td class="h-6 w-8/12 text-sm pl-1"><?php echo $item["BANKNAME"] ?></td>
                        </tr> <?php 
                    }
                    for ($i = count($tdata)+1; $i <= 14; $i++) { ?>
                    <tr class="flex w-full p-0 divide-x">
                        <td class="h-6 w-4/12 text-sm pl-1"></td>
                        <td class="h-6 w-8/12 text-sm pl-1"></td>
                    </tr><?php 
                    }
                    } else {
                        for ($i = 0; $i < 14; $i++) { ?>
                    <tr class="flex w-full p-0 divide-x">
                        <td class="h-6 w-4/12 text-sm pl-1"></td>
                        <td class="h-6 w-8/12 text-sm pl-1"></td>
                    </tr><?php }
                } ?>
                </tbody>
            </table>

            <div class="flex p-2">
                <label class="text-color h-6 text-[12px]"><?=$lang['rowcount']; ?>  <span id="rowcount" ><?=!empty($tdata) ? count($tdata) : 0;?></span></label>
            </div>
            
        </div>

        <div class="flex my-2">
            <div class="flex w-6/12">
                <button type="button" id="select_item" name="search" 
                        class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2">
                        <?php echo $lang['select']; ?>
                </button>
            </div>
            <div class="flex w-6/12 justify-end">
                <button type="button" id="back" 
                        class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2">
                        <?php echo $lang['back']; ?>
                </button>
            </div>
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