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
    
    <title><?=$_SESSION['APPNAME'].' - '.$lang['taxindex']; ?></title>
</head>
<body>
<main>
    <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <input type="hidden" id="page" name="page" <?php if(!empty($_GET['page'])){ ?> value="<?=$_GET['page']; ?>" <?php } else { ?> value="" <?php }?>>
    <input type="hidden" id="index" name="index" <?php if(!empty($_GET['index'])){ ?> value="<?=$_GET['index']; ?>"<?php } else { ?> value="" <?php }?>>
    <form class="w-full h-screen p-2" method="POST" id="taxindex" name="taxindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

        <div class="flex mb-1">
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['taxcode']; ?></label>
                <input class="text-control shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                       type="text" id="TAXCODE" name="TAXCODE" value="<?=isset($data['TAXCODE']) ? $data['TAXCODE']: ''?>"/>
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
            <table class="w-full border-collapse border border-slate-500" id="search_table">
                <thead class="w-full bg-gray-100">
                    <tr class="flex w-full divide-x">
                        <th class="w-1/6 text-center pl-1">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['taxcode']; ?></span>
                        </th>
                        <th class="w-2/6 text-center pl-1">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['taxname']; ?></span>
                        </th>
                        <th class="w-1/6 text-center pl-1">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['taxtype']; ?></span>
                        </th>
                        <th class="w-1/6 text-center pl-1">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['taxrate']; ?></span>
                        </th>
                        <th class="w-1/6 text-center pl-1">
                            <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['taxcat']; ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]">
                <?php if (!empty($tdata)) {
                    // print_r($typeItem2);
                    foreach ($tdata as $item) {  
                        if(is_array($item)) {
                            ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-1/6 text-sm pl-1 csv"><?php echo $item["TAXTYPECD"] ?></td>
                            <td class="h-6 w-2/6 text-sm pl-1 csv"><?php echo $item["TAXTYPENAME"] ?></td>
                            <td class="h-6 w-1/6 text-sm pl-1 csv"><?php 
                                    if(isset($item['TAXKBN'])){
                                        foreach ($typeItem2 as $key2 => $item2) { 
                                                if($key2 == $item['TAXKBN'])
                                                    {
                                                        echo($item2);
                                                    }
                                                }                                 
                                        } ?></td>
                            <td class="h-6 w-1/6 text-sm pl-1 csv"><?php echo $item["VATRATE"] ?></td>
                            <td class="h-6 w-1/6 text-sm pl-1 csv"><?php 
                                    if(isset($item['TAXTTL'])){
                                        foreach ($typeItem1 as $key1 => $item1) { 
                                                if($key1 == $item['TAXTTL'])
                                                    {
                                                        echo($item1);
                                                    }
                                                }                                 
                                        } ?></td>
                        </tr>
                        <?php } else { ?>
                            <tr class="table-warning">
                                <td class="h-6 w-1/6 text-sm pl-1 csv"><?php echo $tdata["TAXTYPECD"] ?></td>
                                <td class="h-6 w-2/6 text-sm pl-1 csv"><?php echo $tdata["TAXTYPENAME"] ?></td>
                                <td class="h-6 w-1/6 text-sm pl-1 csv"><?php 
                                        if(isset($tdata['TAXKBN'])){
                                            foreach ($typeItem2 as $key2 => $item2) { 
                                                    if($key2 == $tdata['TAXKBN'])
                                                        {
                                                            echo($item2);
                                                        }
                                                    }                                 
                                            } ?></td>
                                <td class="h-6 w-1/6 text-sm pl-1 csv"><?php echo $tdata["VATRATE"] ?></td>
                                <td class="h-6 w-1/6 text-sm pl-1 csv"><?php 
                                        if(isset($tdata['TAXTTL'])){
                                            foreach ($typeItem1 as $key1 => $item1) { 
                                                    if($key1 == $tdata['TAXTTL'])
                                                        {
                                                            echo($item1);
                                                        }
                                                    }                                 
                                            } ?></td>
                            </tr><?php
                            break;
                        }
                    }
                    for ($i = count($tdata)+1; $i <= 10; $i++) { ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-1/6"></td>
                            <td class="h-6 w-2/6"></td>
                            <td class="h-6 w-1/6"></td>
                            <td class="h-6 w-1/6"></td>
                            <td class="h-6 w-1/6"></td>
                        </tr><?php 
                    }
                } else {
                    for ($i = 0; $i < 10; $i++) { ?>
                        <tr class="flex w-full p-0 divide-x">
                            <td class="h-6 w-1/6"></td>
                            <td class="h-6 w-2/6"></td>
                            <td class="h-6 w-1/6"></td>
                            <td class="h-6 w-1/6"></td>
                            <td class="h-6 w-1/6"></td>
                        </tr><?php 
                    }
                } ?> 
              </tbody>
            </table>
            <div class="flex p-2">
                <label class="text-color h-6 text-[12px]"><?php echo $lang['rowcount']; ?>  <span id="rowcount" ><?php echo !empty($tdata) ? count($tdata) : 0 ?></span></label>
            </div>
        </div>

        <div class="flex my-2">
            <div class="flex w-6/12">
                <button type="button" id="select_item" name="select" 
                        class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2">
                        <?php echo $lang['select']; ?>
                </button>
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="view_item"><?=$lang['view']; ?>
                </button>
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                        id="csv" name="csv"><?=$lang['csv']; ?>
                </button>
            </div>
            <div class="flex w-6/12 justify-end">
                <button type="button" id="back" 
                        class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2">
                        <?php echo $lang['back']; ?>
                </button>
            </div>
        </div>
    </form>
    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->

    <div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="text-gray-700 text-base font-semibold"><?=$lang['detail']; ?></label>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-centere mt-4" 
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
                                <th class="text-left pl-1 border border-slate-700 text-sm"><?php echo $lang['title']; ?></th>
                                <th class="text-center border border-slate-700 text-sm"><?php echo $lang['value']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?php echo $lang["taxcode"] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="taxcd"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?php echo $lang["taxname"] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="taxnm" style="background-color:#ffe6cc;"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?php echo $lang["taxtype"] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="taxty"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm" style="background-color:#ffe6cc;"><?php echo $lang["taxrate"] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="taxra" style="background-color:#ffe6cc;"></td>
                            </tr>
                            <tr>
                                <td class="text-left pl-1 border border-slate-700 text-sm"><?php echo $lang["taxcat"] ?></td>
                                <td class="text-left pl-1 border border-slate-700 text-sm" id="taxca"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="font-size14"><?php echo $lang['rowcount']; ?> 5</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                        data-bs-dismiss="modal"><?php echo $lang['end']; ?>
                    </button>       
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<script src="./js/script.js"></script>
</html>
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->