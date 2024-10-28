<?php require_once('./function/index_x.php');?>
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
    <title><?=$_SESSION['APPNAME'].' - '.$lang['accinterfacecodemaster']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="page" name="page" <?php if(!empty($_GET['page'])){ ?> value="<?=$_GET['page']; ?>" <?php } else { ?> value="" <?php }?>>
    <input type="hidden" id="index" name="index" <?php if(!empty($_GET['index'])){ ?> value="<?=$_GET['index']; ?>"<?php } else { ?> value="" <?php }?>>
    <form class="w-full h-screen p-2" method="POST" id="accountIfcdmaster" name="accountIfcdmaster" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-4/12 px-2">
                <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=$lang['ACCIFCD']; ?></label>
                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300"
                        id="ACCIFCDS" name="ACCIFCDS" value="<?=$ACCIFCDS ?>"/>
            </div>
            <div class="flex w-6/12 px-2">
                <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=$lang['ACCIFNAME']; ?></label>
                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300"
                        id="ACCIFNAMES" name="ACCIFNAMES" value="<?=$ACCIFNAMES ?>"/>
            </div>
            <div class="flex w-2/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="search" name="search" onclick="$('#loading').show();"><?=$lang['search']; ?>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="table">
            <table id="table_result" class="w-full border-collapse border border-slate-500">
                <thead class="w-full bg-gray-100">
                    <tr class="flex w-full divide-x">
                        <th class="w-3/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['ACCIFCD']; ?></span>
                        </th>
                        <th class="w-9/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['ACCIFNAME']; ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"><?php
                    if (!empty($tdata)) { $minrow = count($tdata); $run = 0;
                        foreach ($tdata as $item) {  ?>
                            <tr class="flex w-full p-0 divide-x">
                                <td class="hidden"><?=++$run ?></td>
                                <td class="h-6 w-3/12 pl-1 text-sm"><?=isset($item['ACCIFCD']) ? $item['ACCIFCD'] : '' ?></td>
                                <td class="h-6 w-9/12 pl-1 text-sm"><?=isset($item['ACCIFNAME']) ? $item['ACCIFNAME']: '' ?></td>
                            </tr><?php 
                        }
                    }
                        
                    for ($i = $minrow; $i < $maxrow; $i++) { ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-3/12"></td>
                            <td class="h-6 w-9/12"></td>
                        </tr><?php
                    } ?> 
                </tbody>
            </table>
            <div class="flex p-2">
                <label class="text-color h-6 text-[12px]"><?=$lang['rowcount']; ?>  <span id="rowcount" ><?=$minrow ?></span></label>
            </div>
        </div>

        <div class="flex my-2">
            <div class="flex w-7/12">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        id="select_item" name="search"><?=$lang['select']; ?></button>
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="back"><?=$lang['back']; ?></button>
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