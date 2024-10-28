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
    
    <title><?=$_SESSION['APPNAME'].' - '.$lang['SearchSalePlanVW']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page']: ''?>">
    <form class="w-full h-screen p-2" method="POST" id="guideindex" name="guideindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-6/12 px-2">
                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ITEMCODE')?></label>
                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                        id="ITEMCD" name="ITEMCD" value="<?=!empty($_POST['ITEMCD']) ? $_POST['ITEMCD']: ''; ?>"/>
                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                        id="ITEMNAME" name="ITEMNAME" value="<?=!empty($_POST['ITEMNAME']) ? $_POST['ITEMNAME']: ''; ?>"/>
            </div>
            <div class="flex w-6/12 px-2">
                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 mr-1 py-2 px-3 text-gray-700 border-gray-300 read"
                        id="STAFFCD" name="STAFFCD" value="<?=!empty($_POST['STAFFCD']) ? $_POST['STAFFCD']: ''; ?>"/>
                <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                        id="STAFFNAME" name="STAFFNAME" value="<?=!empty($_POST['STAFFNAME']) ? $_POST['STAFFNAME']: ''; ?>"/>
            </div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-6/12 px-2">
                <label class="text-color block text-sm w-2/12 pr-2 pt-1"></label>
                <input type="date" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                    id="SALEPLANDTHD" name="SALEPLANDTHD" value="<?=!empty($_POST['SALEPLANDTHD']) ? date('Y-m-d', strtotime($_POST['SALEPLANDTHD'])): date('Y-m-d'); ?>"/>
                <input type="hidden" id="ALLOWN" name="ALLOWN" value="<?=!empty($_POST['ALLOWN']) ? $_POST['ALLOWN']: 'F'; ?>"/>
                <label class="text-color block text-sm w-2/12 pl-2 pt-1 hidden"><?=checklang('ALLOWN')?></label>
            </div>
            <div class="flex w-6/12 px-2"></div>
        </div>

        <div class="table">
            <table id="table_result" class="w-full border-collapse border border-slate-500">
                <thead class="w-full bg-gray-100">
                    <tr class="flex w-full divide-x">
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['saleorderno'];?></span>
                        </th>
                        <th class="w-1/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE'); ?></span>
                        </th>
                        <th class="w-3/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUSTOMERNAME'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY'); ?></span>
                        </th>
                        <th class="w-2/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['amount'];?></span>
                        </th>
                    </tr>
                </thead>
          
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"><?php
                    if (!empty($tdata)) { $minrow = count($tdata); $run = 0;
                        foreach ($tdata as $item) {  ?>
                            <tr class="flex w-full p-0 divide-x">
                                <td class="hidden"><?= ++$run; ?></td>
                                <td class="h-6 w-2/12 pl-2 text-sm"><?=$item['SALELNNO'] ?></td>
                                <td class="h-6 w-1/12 text-sm text-center"><?=$item['SALELN'] ?></td>
                                <td class="h-6 w-3/12 pl-2 text-sm"><?=$item['CUSTOMERNAME'] ?></td>
                                <td class="h-6 w-2/12 pl-2 text-sm"><?=$item['SALELNQTY'] ?></td>
                                <td class="h-6 w-2/12 pl-2 text-sm"><?=$item['SALELNAMT'] ?></td>
                            </tr><?php 
                        }
                    }
                    for ($i = $minrow; $i < $maxrow; $i++) {  ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-1/12"></td>
                            <td class="h-6 w-3/12"></td>
                            <td class="h-6 w-2/12"></td>
                            <td class="h-6 w-2/12"></td>
                        </tr><?php
                    } ?> 
                </tbody>
            </table>    
           
        </div>

        <div class="flex pt-2">
            <label class="text-color h-6 text-[12px]"><?=checklang('ROWCOUNT'); ?>  <span id="rowcount" ><?=$minrow ?></span></label>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12"></div>
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
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->
