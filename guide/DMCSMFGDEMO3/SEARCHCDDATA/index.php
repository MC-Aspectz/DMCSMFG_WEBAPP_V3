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
    <title><?=$_SESSION['APPNAME'].' - '.$data['DRPLANG']['APPCODE']['SEARCHCDDATA']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="guideUrl" name="guideUrl" value="<?=$guideUrl?>">
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" value="<?=!empty($_GET['page']) ? $_GET['page']: ''; ?>">
    <form class="w-full h-screen p-2" method="POST" id="saletrans" name="saletrans" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-9/12">
                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('DESCRIPTION'); ?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="P1" id="P1" value="<?=$P1 ?>"/>
            </div>
            <div class="flex w-3/12 justify-end">
                <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH'); ?>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="overflow-scroll block h-[315px] max-h-[315px]"> 
            <table id="table_result" class="w-full border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                <thead class="sticky top-0 bg-gray-50">
                    <tr class="border border-gray-600">
                        <th class="px-6 text-left border border-slate-700">
                            <span class="text-color pl-5 text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('REMARKS')?></span>
                        </th>
                    </tr>
                </thead>
                <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                    if(!empty($tdata)) {
                      $minrow = count($tdata);
                      foreach ($tdata as $key => $item) { ?>
                          <tr class="divide-y divide-gray-200" id="rowId<?=$key?>">
                                <td class="hidden"><?=$item['ROWCOUNTER'] ?></td>
                                <td class="h-6 w-12/12 pl-1 text-sm border border-slate-700 text-left"><?=isset($item['ACCTRANREMARK']) ? $item['ACCTRANREMARK']: '' ?></td>
                          </tr><?php
                      }
                    }
                    for ($i = $minrow; $i < $maxrow; $i++) { ?>
                        <tr class="divide-y divide-gray-200">
                            <td class="h-6 border border-slate-700"></td>
                        </tr> <?php
                    } ?>
                </tbody>
            </table>
            <div class="flex p-2">
                <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
            </div>
        </div>

        <div class="flex my-2">
            <div class="flex w-7/12">
                <button type="button" id="SELECT" name="SELECT" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2">
                        <?=checklang('SELECT'); ?></button>
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