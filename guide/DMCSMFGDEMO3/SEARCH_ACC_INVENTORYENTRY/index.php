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
    <title><?=$_SESSION['APPNAME'].' - '.$lang['accinterface']; ?></title>
</head>
<body>
    <main>
        <input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
        <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
        <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
        <input type="hidden" id="page" name="page" <?php if(!empty($_GET['page'])){ ?> value="<?=$_GET['page']; ?>" <?php } else { ?> value="" <?php }?>>
        <input type="hidden" id="index" name="index" <?php if(!empty($_GET['index'])){ ?> value="<?=$_GET['index']; ?>"<?php } else { ?> value="" <?php }?>>
        <form class="w-full h-screen p-2" method="POST" id="voucherindex" name="voucherindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['voucherno']; ?></label>
                <input class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                       type="text" id="P1" name="P1" value="<?=$P1 ?>"/>
            </div>
            
            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['processtype']; ?></label>
                <select class="text-control text-sm shadow-md border mr-1 px-3 h-7 ml-1 w-4/12 text-left text-[12px] rounded-xl border-gray-300" id="P2" name="P2">
                    <option value=""></option>
                    <?php foreach ($INVPSS_TYPE as $key => $item) { ?>
                        <option value="<?=$key ?>"<?=(isset($P2) && $P2 == $key) ? 'selected' : '' ?>><?=$item?></option>
                    <?php } ?>
                </select>            
            </div>

            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['locationtype']; ?></label>
                <select class="text-control text-sm shadow-md border mr-1 px-3 h-7 ml-1 w-4/12 text-left text-[12px] rounded-xl border-gray-300" id="P3" name="P3">
                    <option value=""></option>
                    <?php foreach ($STORAGETYPE as $key => $item) { ?>
                        <option value="<?=$key ?>"<?=(isset($P3) && $P3 == $key) ? 'selected' : '' ?>><?=$item?></option>
                    <?php } ?>
                </select>            
            </div>

            <div class="flex w-5/12"></div>
        </div>

        <div class="flex mb-1">
            <div class="flex w-7/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=$lang['voucherdate']; ?></label>
                <input class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                       type="date" id="P4" name="P4" value="<?=$P4 ?>" />
                <label class="text-color block text-sm pr-2 pt-1 mx-2"><?=$lang['arrow']; ?></label>
                <input class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300"
                       type="date" id="P5" name="P5" value="<?=$P5 ?>" />
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
                <table class="w-full border-collapse border border-slate-500" id="table_result" >
                    <thead class="w-full bg-gray-100">
                        <tr class="flex w-full divide-x">
                            <th class="w-1/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['voucherno']; ?></span>
                            </th>
                            <th class="w-1/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['voucherdate']; ?></span>
                            </th>
                            <th class="w-1/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['processtype']; ?></span>
                            </th>
                            <th class="w-1/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['locationtype']; ?></span>
                            </th>
                            <th class="w-1/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['locationcode']; ?></span>
                            </th>
                            <th class="w-2/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['locationname']; ?></span>
                            </th>
                            <th class="w-1/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['itemcode']; ?></span>
                            </th>
                            <th class="w-2/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['itemname']; ?></span>
                            </th>
                            <th class="w-2/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['specification']; ?></span>
                            </th>
                            <th class="w-1/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['quantity']; ?></span>
                            </th>
                            <th class="w-1/12 text-left pl-1">
                                <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=$lang['comment']; ?></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="flex flex-col overflow-y-scroll w-full h-[250px]"><?php
                        if (!empty($tdata)) { $run = 0;
                            foreach ($tdata as $item) {  ?>
                                <tr class="flex w-full p-0 divide-x">
                                    <td class="h-6 w-1/12 text-left pl-1"><?=$item['INVTRANNO'] ?></td>
                                    <td class="h-6 w-1/12 text-left pl-1"><?=$item['INVTRANISSUEDT'] ?></td>
                                    <td class="h-6 w-1/12 text-left pl-1"><?=isset($item['INVTRANTRXTYP']) ? $INVPSS_TYPE[$item['INVTRANTRXTYP']] : '' ?></td>
                                    <td class="h-6 w-1/12 text-left pl-1"><?=isset($item['LOCTYP']) ? $STORAGETYPE[$item['LOCTYP']] : '' ?></td>
                                    <td class="h-6 w-1/12 text-left pl-1"><?=$item['LOCCD'] ?></td>
                                    <td class="h-6 w-2/12 text-left pl-1"><?=$item['LOCNAME'] ?></td>
                                    <td class="h-6 w-1/12 text-left pl-1"><?=$item['ITEMCODE'] ?></td>
                                    <td class="h-6 w-2/12 text-left pl-1"><?=$item['ITEMNAME'] ?></td>
                                    <td class="h-6 w-2/12 text-left pl-1"><?=$item['ITEMSPEC'] ?></td>
                                    <td class="h-6 w-1/12 text-left pl-1"><?=$item['INVTRANQTY'] ?></td>
                                    <td class="h-6 w-1/12 text-left pl-1"><?=$item['INVTRANREM'] ?></td>
                                </tr><?php 
                            }
                        } 
                        for ($i = 0; $i < 10; $i++) { ?>
                            <tr class="flex w-full p-0 divide-x">
                                <td class="h-6 w-1/12"></td>
                                <td class="h-6 w-1/12"></td>
                                <td class="h-6 w-1/12"></td>
                                <td class="h-6 w-1/12"></td>
                                <td class="h-6 w-1/12"></td>
                                <td class="h-6 w-2/12"></td>
                                <td class="h-6 w-1/12"></td>
                                <td class="h-6 w-2/12"></td>
                                <td class="h-6 w-2/12"></td>
                                <td class="h-6 w-1/12"></td>
                                <td class="h-6 w-1/12"></td>
                            </tr><?php 
                        }
                    } ?> 
                  </tbody>
                </table>
                <div class="flex p-2">
                    <label class="text-color h-6 text-[12px]"><?=$lang['rowcount']; ?>  <span id="rowcount" ><?=!empty($tdata) ? count($tdata) : 0 ?></span></label>
                </div>
            </div>

            <div class="flex my-2">
                <div class="flex w-7/12">
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                            id="select_item" name="search"  ><?=$lang['select']; ?></button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                            id="view_item" ><?=$lang['view']; ?></button>
                </div>

                <div class="flex w-5/12 justify-end">
                    <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                            onclick="return clearForm(this.form);"  ><?=$lang['clear']; ?></button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                            id="back"  ><?=$lang['back']; ?></button>
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
           <table class="w-full border-collapse border border-slate-500" id="tb-modal" rules="cols" cellpadding="3" cellspacing="1" >
                <thead>
                    <tr>
                        <th class="text-left pl-1 border border-slate-700 text-sm"><?=$lang['title']; ?></th>
                        <th class="text-center border border-slate-700 text-sm"><?=$lang['value']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["voucherno"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="voucherno"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["voucherdate"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="voucherdate"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["processtype"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="processtype"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["locationtype"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="locationtype"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["locationcode"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="locationcode"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["locationname"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="locationname"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["itemcode"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="itemcode"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["itemname"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="itemname"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["specification"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="specification"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["quantity"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="quantity"></td>
                    </tr>
                    <tr>
                        <td class="text-left pl-1 border border-slate-700 text-sm"><?=$lang["comment"] ?></td>
                        <td class="text-left pl-1 border border-slate-700 text-sm" id="comment"></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="h-6 text-[12px]"><?=$lang['rowcount']; ?> 11</div>
        </div>
        <div class="modal-footer">
           <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                   data-bs-dismiss="modal"><?=$lang['end']; ?></button>
        </div>
    </div>
  </div>
</div>
<div id="loading" class="on" style="display: none;">
    <div class="cv-spinner"><div class="spinner"></div></div>
</div>
</main>
</body>
<script src="./js/script.js"></script>
</html>
<!-- -------------------------------------------------------------------------------- -->
<!--  guide load Theme  -->
<?php guideloadTheme(); ?>
<!-- -------------------------------------------------------------------------------- -->