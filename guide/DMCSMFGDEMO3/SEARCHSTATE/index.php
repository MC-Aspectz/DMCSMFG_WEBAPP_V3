<?php require_once('./function/index_x.php'); ?>
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

    <title><?=$_SESSION['APPNAME'].' - '.$lang['searchstate']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="page" name="page" <?php if(!empty($_GET['page'])){ ?> value="<?=$_GET['page']; ?>" <?php } else { ?> value="" <?php }?>>
    <form class="form" style="width: 80%;" method="POST" id="guideindex" name="guideindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['countrycode']; ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="COUNTRYCD_S" name="COUNTRYCD_S" value="<?=$COUNTRYCD_S ?>"/>
            </div>
            <div class="flex w-5/12"></div>
        </div>

         <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['statecode']; ?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="STATECD_S" name="STATECD_S" value="<?=$STATECD_S ?>"/>
            </div>
            <div class="flex w-5/12 justify-end">
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
                    <tr class="flex w-full divide-x csv-row">
                        <th class="w-3/12 text-left pl-1 csv-col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['statecode']; ?></span>
                        </th>
                        <th class="w-6/12 text-left pl-1 csv-col">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['statename']; ?></span>
                        </th>
                        <th class="w-3/12 text-center">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"><?php
                    if (!empty($tdata)) {
                    $run = 0;
                    foreach ($tdata as $item) { ?>
                        <tr class="flex w-full p-0 divide-x csv-row">
                            <td class="hidden"><?= ++$run; ?></td>
                            <td class="h-6 w-3/12 text-sm pl-1 csv-col"><?=$item['STATECD'] ?></td>
                            <td class="h-6 w-6/12 text-sm pl-1 csv-col"><?=$item['STATENAME'] ?></td>
                        </tr>
                    <?php }
                            for ($i = count($tdata)+1; $i <= 10; $i++) { ?>
                                <tr class="flex w-full p-0 divide-x">
                                    <td class="h-6 w-3/12"></td>
                                    <td class="h-6 w-6/12"></td>
                                </tr>
                            <?php }
                    } else {
                            for ($i = 0; $i < 10; $i++) { ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-3/12"></td>
                            <td class="h-6 w-6/12"></td>
                        </tr><?php }
                    } ?>
                </tbody>
            </table>
            <div class="flex p-2">
                <label class="text-color h-6 text-[12px]"><?php echo $lang['rowcount']; ?>  <span id="rowcount" ><?php echo !empty($tdata) ? count($tdata) : 0 ?></span></label>
            </div>
        </div>
            
        <div class="flex my-2">
            <div class="flex w-7/12">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                        id="select_item" name="select_item"><?=$lang['select']; ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="view_item"><?=$lang['view']; ?></button>
            </div>
            <div class="flex w-5/12 justify-end">
                <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        onclick="return clearForm(this.form);"><?=$lang['clear']; ?></button>&emsp;&emsp;
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="back"><?=$lang['back']; ?></button>
            </div>
        </div>

    </form>

    <div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="text-gray-700 text-base font-semibold"><?=$lang['detail']; ?></label>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-centere"
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
               <table class="w-full border-collapse border border-slate-500" id="tabel_modal" rules="cols" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr>
                            <th class="text-left pl-1 border border-slate-700 text-sm"><?=$lang['title']; ?></th>
                            <th class="text-center border border-slate-700 text-sm"><?=$lang['value']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?=$lang["statecode"] ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="statecd" style="background-color:#ffe6cc;"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["statename"] ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="statename"></td>
                        </tr>
                        
                    </tbody>
                </table>
                <br>
                <div class="h-6 text-[12px]"><?=$lang['rowcount']; ?> 2</div>
            </div>
            <div class="modal-footer">
               <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=$lang['end']; ?></button>
            </div>
        </div>
      </div>
    </div>
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