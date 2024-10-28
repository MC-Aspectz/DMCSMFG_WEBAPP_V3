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
    <title><?=$_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['ACCBOKGUIDE9']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="guideUrl" name="guideUrl" value="<?=$guideUrl?>">
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page']: ''?>">
    <input type="hidden" id="index" name="index" value="<?=!empty($_GET['index']) ? $_GET['index']: ''?>">
    <form class="w-full h-screen p-2" method="POST" id="saletrans" name="saletrans" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-9/12">
                <label class="text-color block text-sm w-1/12 pr-2 pt-1"><?=checklang('STAFFCODE'); ?></label>
                <div class="relative w-3/12 mr-1">
                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                            name="STAFFCD" id="STAFFCD" value="<?=isset($STAFFCD) ? $STAFFCD: '' ?>"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                        id="SEARCHSTAFF">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 mr-2 text-gray-700 border-gray-300 read"
                        name="STAFFNAME" id="STAFFNAME" value="<?=isset($STAFFNAME) ? $STAFFNAME: '';?>" readonly/>
                <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                        id="S_DT" name="S_DT" value="<?=!empty($S_DT) ? date('Y-m-d', strtotime($S_DT)): '' ?>"/>
                <label class="w-1/12 text-center">&ensp;→&ensp;</label>
                <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                        id="E_DT" name="E_DT" value="<?=!empty($E_DT) ? date('Y-m-d', strtotime($E_DT)): '' ?>"/>      
            </div>
            <div class="flex w-3/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=$lang['search']; ?>
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
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('VOUCHERNO'); ?></span>
                        </th>
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INPUT_DATE'); ?></span>
                        </th>
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('INPUT_CHARGE'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STAFF_NAME'); ?></span>
                        </th>
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CODE'); ?></span>
                        </th>
                        <th class="w-3/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('NAME'); ?></span>
                        </th>
                        <th class="w-3/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION'); ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"><?php
                    if (!empty($tdata)) { $minrow = count($tdata) + 1;
                        foreach ($tdata as $item) {  ?>
                            <tr class="flex w-full p-0 divide-x">
                                <td class="hidden"><?=$item['ROWCOUNTER'] ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm"><?=$item['VOUCHERNO'] ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm"><?=$item['INPDT'] ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm"><?=$item['INPSTFCD'] ?></td>
                                <td class="h-6 w-2/12 pl-1 text-sm"><?=$item['STFNM'] ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm"><?=$item['STAFFNAME'] ?></td>
                                <td class="h-6 w-3/12 pl-1 text-sm"><?=$item['STAFFCD'] ?></td>
                                <td class="h-6 w-3/12 pl-1 text-sm"><?=$item['DESCRIPTION'] ?></td>
                            </tr><?php 
                        }
                    }
                    for ($i = $minrow; $i <= $maxrow; $i++) {  ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-1/12"></td>
                            <td class="h-6 w-1/12"></td>
                            <td class="h-6 w-1/12"></td>
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-1/12"></td>
                            <td class="h-6 w-3/12"></td>
                            <td class="h-6 w-3/12"></td>
                        </tr><?php
                    } ?> 
                </tbody>
            </table>
            <div class="flex p-2">
                <label class="text-color h-6 text-[12px]"><?php echo $lang['rowcount']; ?>  <span id="rowcount" ><?php echo !empty($tdata) ? count($tdata) : 0 ?></span></label>
            </div>
        </div>

        <div class="flex my-2">
            <div class="flex w-7/12">
                <button type="button" id="SELECT" name="SELECT" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2">
                        <?=checklang('SELECT'); ?></button>&emsp;&emsp;
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                    id="BACK" class="btn btn-outline-secondary btn-action"><?=checklang('BACK'); ?></button>
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