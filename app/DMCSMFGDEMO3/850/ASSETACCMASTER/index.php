<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <!-- -------------------------------------------------------------------------------- -->
</head>
<body>
<div class="flex flex-col h-screen">
    <!--  start::navbar Menu -->
    <header class="flex relative top-0 text-semibold">
        <!-------------------------------------------------------------------------------------->
        <?php navBar(); ?>
        <!-------------------------------------------------------------------------------------->
    </header>
    <!--  end::navbar Menu -->

    <div class="flex flex-1 overflow-hidden">
        <!--   start::Sidebar Menu -->
        <!-------------------------------------------------------------------------------------->
        <?php sideBar(); ?>
        <!-------------------------------------------------------------------------------------->
        <!--   end::Sideba Menu -->

        <!--   start::Main Content  -->
        <main class="flex flex-1 overflow-y-auto overflow-x-hidden paragraph px-2">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="assetacc_master" name="assetacc_master" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

                <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                <div class="flex mb-1 px-2">
                    <div class="flex w-6/12"></div>

                    <div class="flex w-6/12 justify-end">
                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="search" name="search" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="overflow-scroll mb-1 mt-3">
                    <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="search_table">
                        <thead class="w-full bg-gray-100">
                            <tr class="flex w-full divide-x">    
                                <th class="w-50 text-center py-2"><?=$data['TXTLANG']['ROWNO']; ?></th>
                                <th class="w-50 text-center py-2"><?=$data['TXTLANG']['ASSETACCCD']?></th>
                                <th class="w-50 text-center py-2"><?=$data['TXTLANG']['NAME_C']; ?></th>
                                <th class="w-50 text-center py-2"><?=$data['TXTLANG']['NAME_E']?></th>
                                <th class="w-50 text-center py-2"><?=$data['TXTLANG']['ACCASSET']?></th>
                                <th class="w-50 text-center py-2"><?=$data['TXTLANG']['DEPREXP']?></th>
                                <th class="w-50 text-center py-2"><?=$data['TXTLANG']['ACCUMDEPR']; ?></th>
                            </tr>
                        </thead>
                        <tbody class="flex flex-col w-full h-[400px]">
                        <?php if(!empty($data['ASSMAS']))  {
                                // print_r($data['ASSMAS']);  

                                foreach ($data['ASSMAS'] as $key => $value) {
                                    if(is_array($value)) {
                                    $minrow = count($data['ASSMAS']);
                                    ?>
                                    <tr class="flex w-full p-0 divide-x">
                                        <td class="h-6 w-50 text-sm pl-1 text-left"><?=isset($value['ROWCOUNTER']) ? $value['ROWCOUNTER']: '' ?></td>  
                                        <td class="h-6 w-50 text-sm pl-1 text-left"><?=isset($value['ASSETACCCD']) ? $value['ASSETACCCD']: '' ?></td>
                                        <td class="h-6 w-50 text-sm pl-1 text-left"><?=isset($value['NAME_C']) ? $value['NAME_C']: '' ?></td>
                                        <td class="h-6 w-50 text-sm pl-1 text-left"><?=isset($value['NAME_E']) ? $value['NAME_E']: '' ?></td>
                                        <td class="h-6 w-50 text-sm pl-1 text-left"><?=isset($value['ASSETACCOUNT']) ?  $value['ASSETACCOUNT']: '' ?></td>                                 
                                        <td class="h-6 w-50 text-sm pl-1 text-left"><?=isset($value['DEPLECIATION']) ? $value['DEPLECIATION']: '' ?></td> 
                                        <td class="h-6 w-50 text-sm pl-1 text-left"><?=isset($value['ACCUMULATED']) ? $value['ACCUMULATED']: '' ?></td>
                                        
                                        <td class="hidden"><?=isset($value['ASSETACCOUNTNM']) ? $value['ASSETACCOUNTNM']: '' ?></td>
                                        <td class="hidden"><?=isset($value['DEPLECIATIONNM']) ? $value['DEPLECIATIONNM']: '' ?></td>
                                        <td class="hidden"><?=isset($value['ACCUMULATEDNM']) ? $value['ACCUMULATEDNM']: '' ?></td> 

                                        
                                        
                                    </tr> <?php 
                                    } else {
                                        $minrow = 1; ?>
                                        <tr class="flex w-full p-0 divide-x">
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"><?=$data['ASSMAS']['ROWCOUNTER'] ?></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"><?=$data['ASSMAS']['ASSETACCCD'] ?></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"><?=$data['ASSMAS']['NAME_C'] ?></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"><?=$data['ASSMAS']['NAME_E'] ?></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"><?=$data['ASSMAS']['ASSETACCOUNT'] ?></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"><?=$data['ASSMAS']['DEPLECIATION'] ?></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"><?=$data['ASSMAS']['ACCUMULATED'] ?></td>                                                                 
                                            
                                            <td class="td-class"style="display:none;"><?=$data['ASSMAS']['ASSETACCOUNTNM'] ?></td>
                                            <td class="td-class"style="display:none;"><?=$data['ASSMAS']['DEPLECIATIONNM'] ?></td>
                                            <td class="td-class"style="display:none;"><?=$data['ASSMAS']['ACCUMULATEDNM'] ?></td>                                    
                                        </tr><?php
                                        break;
                                        }
                                    }  
                                    for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                        <tr class="flex w-full p-0 divide-x">
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                            <td  class="h-6 w-50 text-sm pl-1 text-left"></td>        
                                        </tr><?php 
                                    }
                            } else {
                                for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                    <tr class="flex w-full p-0 divide-x">
                                        <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                        <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                        <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                        <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                        <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                        <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                        <td  class="h-6 w-50 text-sm pl-1 text-left"></td>
                                    </tr><?php
                                }
                            } ?>
                        </tbody>
                    </table>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>                

                <div class="flex mt-2">
                    <div class="flex w-full">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['ASSETACCCD']?></label>    
                        <input class="text-control shadow-md border rounded-xl h-7 w-2/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                               type="text" id="ASSETACCCD" name="ASSETACCCD" value="<?=isset($data['ASSETACCCD']) ? $data['ASSETACCCD']: ''?>" onchange="unRequired();"/>         
                    </div>  
                </div>


                <div class="flex mt-2">
                    <div class="flex w-full">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['NAME_C']?></label>
                        <input class="text-control shadow-md border rounded-xl h-7 w-5/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                               type="text" id="NAME_C" name="NAME_C" value="<?=isset($data['NAME_C']) ? $data['NAME_C']: ''?>" onchange="unRequired();"/>    
                    </div> 
                </div>

                <div class="flex mt-2">
                    <div class="flex w-full">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['NAME_E']?></label>
                        <input class="text-control shadow-md border rounded-xl h-7 w-5/12 ml-1 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                               type="text" id="NAME_E" name="NAME_E" value="<?=isset($data['NAME_E']) ? $data['NAME_E']: ''?>" />   
                    </div>   
                </div>


                <div class="flex mt-2">
                    <div class="flex w-full">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['ACCASSET'];?></label>
                        <div class="relative w-2/12 mr-1">
                            <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                name="ASSETACCOUNT" id="ASSETACCOUNT" value="<?=isset($data['ASSETACCOUNT']) ? $data['ASSETACCOUNT']: ''?>" onchange="unRequired();"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHACCOUNT1">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" 
                               type="text" id="ASSETACCOUNTNM" name="ASSETACCOUNTNM" value="<?=isset($data['ASSETACCOUNTNM']) ? $data['ASSETACCOUNTNM'] :''?>" readonly /> 
                    </div>
                </div>


                <div class="flex mt-2">
                    <div class="flex w-full">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['DEPREXP'];?></label>
                        <div class="relative w-2/12 mr-1">
                            <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="DEPLECIATION" id="DEPLECIATION" value="<?=isset($data['DEPLECIATION']) ? $data['DEPLECIATION']: ''?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHACCOUNT2">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" 
                               type="text" id="DEPLECIATIONNM" name="DEPLECIATIONNM" value="<?=isset($data['DEPLECIATIONNM']) ? $data['DEPLECIATIONNM'] :''?>" readonly /> 
                    </div>
                </div>


                <div class="flex mt-2">
                    <div class="flex w-full">
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=$data['TXTLANG']['ACCUMDEPR'];?></label>
                        <div class="relative w-2/12 mr-1">
                            <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                name="ACCUMULATED" id="ACCUMULATED" value="<?=isset($data['ACCUMULATED']) ? $data['ACCUMULATED']: ''?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHACCOUNT3">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" 
                               type="text" id="ACCUMULATEDNM" name="ACCUMULATEDNM" value="<?=isset($data['ACCUMULATEDNM']) ? $data['ACCUMULATEDNM'] :''?>" readonly /> 
                    </div>
                </div>

                <div class="flex mt-4">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="insert" name="insert"
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['INSERT']?>
                        </button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="update" name="update"
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['MODIFY']?>
                        </button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="delete" name="delete"
                                <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['DELETE']?>
                        </button>
                    </div>

                    <div class="flex w-6/12 justify-end">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="csv" name="csv"onclick="exportCSV();">CSV
                            </button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="clear" name="clear" onclick="unsetSession();"><?=$data['TXTLANG']['CLEAR']?>
                            </button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?=$data['TXTLANG']['END']?>
                        </button>
                    </div>
                </div>
        <?php 
        if(1==1){$s =5;}?>
            </form>
        </main>
        <!--   end::Main Content -->
    </div>

    <!-- start::footer -->
    <div class="flex bg-gray-200">
        <!-------------------------------------------------------------------------------------->
        <?php footerBar(); ?>
        <!-------------------------------------------------------------------------------------->
    </div>
    <!-- end::footer -->

    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
</div>
</body>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-54fxMsmCN6QRpByKh/g3Dxazgtnlz5oCJOM41ha17HW5WLZT6hWG1xPWLE7S0YLb" crossorigin="anonymous"></script> -->

<script type="text/javascript">
  function validationDialog() {
      return Swal.fire({ 
          title: '',
          text: '<?=$lang['validation1']; ?>',
          background: '#8ca3a3',
          showCancelButton: false,
          confirmButtonColor: 'silver',
          cancelButtonColor: 'silver',
          confirmButtonText:  '<?=$lang['yes']; ?>',
          cancelButtonText: '<?=$lang['nono']; ?>'
          }).then((result) => {
          if (result.isConfirmed) {
              if(type == 1) {
                  window.location.href="/DMCS_WEBAPP";          
              }
          }
      });
  }
</script>
</html>
