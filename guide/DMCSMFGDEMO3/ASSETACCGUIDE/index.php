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
    <title><?=$_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['ASSETACCGUIDE']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="guideUrl" name="guideUrl" value="<?=$guideUrl?>">
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page']: ''?>">
    <input type="hidden" id="index" name="index" value="<?=!empty($_GET['index']) ? $_GET['index']: ''?>">
    <input type="hidden" id="pageUrl" name="pageUrl" value="<?=!empty($_GET['pageUrl']) ? $_GET['pageUrl']: ''?>">
    <form class="w-full h-screen p-2" method="POST" id="assetaccguide" name="assetaccguide" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">       
        <div class="flex mb-1">
            <div class="flex w-6/12"></div>
            
            <div class="flex w-6/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=$lang['search']; ?>
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
                        <th class="w-2/12 text-left pl-1"><?=checklang('ASSETACC'); ?></th>
                        <th class="w-5/12 text-left pl-1"><?=checklang('ASSETACCNM'); ?></th>
                        <th class="w-5/12 text-left pl-1"><?=str_repeat('&emsp;', 1); ?></th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"> <?php 
                if (!empty($tdata)) { $minrow = count($tdata) + 1;
                    foreach ($tdata as $key => $item) { ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="hidden"><?=$item["ROWCOUNTER"] ?></td>
                            <td class="h-6 w-2/12 text-sm pl-1"><?=isset($item['ASSETACC']) ? $item['ASSETACC']: '' ?></td>
                            <td class="h-6 w-5/12 text-sm pl-1"><?=isset($item['ASSETACCNM']) ? $item['ASSETACCNM']: '' ?></td>
                            <td class="h-6 w-5/12 text-sm pl-1"></td>
                        </tr> <?php 
                    }  
                }

                for ($i = $minrow; $i <= $maxrow; $i++) {  ?>
                    <tr class="flex w-full p-0 divide-x">
                        <td class="h-6 w-2/12 text-sm pl-1"></td>
                        <td class="h-6 w-5/12 text-sm pl-1"></td>
                        <td class="h-6 w-5/12 text-sm pl-1"></td>
                    </tr><?php
                } ?> 
              </tbody>
            </table>
            <div class="flex p-2">
                <label class="text-color h-6 text-[12px]"><?=$lang['rowcount']; ?>  <span id="rowcount" ><?php echo !empty($tdata) ? count($tdata) : 0 ?></span></label>
            </div>
        </div>

        <div class="flex my-2">
            <div class="flex w-7/12">
                <button class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        type="button" id="SELECT" name="SELECT" ><?php echo checklang('SELECT'); ?></button>
            </div>

            <div class="flex w-5/12 justify-end">
                <button class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        type="button" id="back" ><?php echo checklang('BACK'); ?></button>
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