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
                <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
                <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
                <form class="w-full" method="POST" id="application" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                    
                    <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('APPPACK');?></label>
                            <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-sm rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    id="APPPACK_S" name="APPPACK_S" >
                                <option value=""></option>
                                    <?php foreach ($apppackse as $key => $item) { ?>
                                    <option value="<?php echo $key ?>" <?php echo (isset($data['APPPACK_S']) && $data['APPPACK_S'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        
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
                        <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="search_table" rules="cols" cellpadding="3" cellspacing="1">
                            <thead class="w-full bg-gray-100">
                                <tr class="flex w-full divide-x">
                                    <th class="w-1/12 text-center py-2" scope="col">
                                        <?=checklang('APPSEQ'); ?>
                                    </th>
                                    <th class="w-2/12 text-center py-2" scope="col">
                                        <?=checklang('FORM_NO')?>
                                    </th>
                                    <th class="w-4/12 text-center py-2" scope="col">
                                        <?=checklang('FORM_TITLE')?>
                                    </th>
                                    <th class="w-4/12 text-center py-2" scope="col">
                                        <?=checklang('APPNAME')?>
                                    </th>
                                    <th class="w-2/12 text-center py-2" scope="col">
                                        <?=checklang('FORM_APP')?>
                                    </th>
                                    <th class="w-2/12 text-center py-2" scope="col">
                                        <?=checklang('APPPACK')?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="flex flex-col overflow-y-scroll w-full h-[400px]">
                            <?php if(!empty($data['APP']))  {
                                    foreach ($data['APP'] as $key => $value) {
                                        if(is_array($value)) {
                                        $minrow = count($data['APP']) + 1;
                                        ?>
                                        <tr class="flex w-full p-0 divide-x">
                                        
                                            <td class="h-6 w-1/12 text-sm pl-1 text-left"><?=isset($value['FORMSEQ']) ? $value['FORMSEQ']: '' ?></td>
                                            <td class="h-6 w-2/12 text-sm pl-1 text-left"><?=isset($value['FORMNO']) ? $value['FORMNO']: '' ?></td>
                                            <td class="h-6 w-4/12 text-sm pl-1 text-left"><?=isset($value['FORMTITLETYP']) ? $value['FORMTITLETYP']: ''?></td>
                                            <td class="h-6 w-4/12 text-sm pl-1 text-left"><?=isset($value['APPNAME']) ? $value['APPNAME']: '' ?></td>
                                            <td class="h-6 w-2/12 text-sm pl-1 text-left"><?=isset($value['FORMAPP']) ? $value['FORMAPP']: ''?></td>
                                            <td class="h-6 w-2/12 text-sm pl-1 text-left"><?=isset($value['FORMPACKTYP']) ? $value['FORMPACKTYP']: '' ?></td>
                                            
                                        </tr> <?php 
                                        } else {
                                            
                                            $minrow = 1; ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-1/12 text-sm pl-1 text-left"><?=$data['APP']['FORMSEQ'] ?></td>
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left"><?=$data['APP']['FORMNO'] ?></td>
                                                <td class="h-6 w-4/12 text-sm pl-1 text-left"><?=$data['APP']['FORMTITLETYP'] ?></td>
                                                <td class="h-6 w-4/12 text-sm pl-1 text-left"><?=$data['APP']['APPNAME'] ?></td>
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left"><?=$data['APP']['FORMAPP'] ?></td>
                                                <td class="h-6 w-2/12 text-sm pl-1 text-left"><?=$data['APP']['FORMPACKTYP'] ?></td>
                                                
                                                
                                            </tr><?php
                                            break;
                                            }
                                        }  
                                        for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                            <tr class="flex w-full p-0 divide-x">
                                                <td class="h-6 w-1/12"></td>
                                                <td class="h-6 w-2/12"></td>
                                                <td class="h-6 w-4/12"></td>
                                                <td class="h-6 w-4/12"></td>
                                                <td class="h-6 w-2/12"></td>
                                                <td class="h-6 w-2/12"></td>
                                                
                                            </tr><?php 
                                        }
                                } else {
                                    for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                        <tr class="flex w-full p-0 divide-x">
                                            <td class="h-6 w-1/12"></td>
                                            <td class="h-6 w-2/12"></td>
                                            <td class="h-6 w-4/12"></td>
                                            <td class="h-6 w-4/12"></td>
                                            <td class="h-6 w-2/12"></td>
                                            <td class="h-6 w-2/12"></td>
                                            
                                        </tr><?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex p-2">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('APPSEQ'); ?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-4/12 ml-2 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                   type="number" id="FORMSEQ" name="FORMSEQ" value="<?=isset($data['FORMSEQ']) ? $data['FORMSEQ']: ''?>" />
                        </div>
                        
                        <div class="flex w-6/12"></div>
                    </div>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('FORM_NO')?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-4/12 ml-2 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                   type="text" id="FORMNO" name="FORMNO" value="<?=isset($data['FORMNO']) ? $data['FORMNO']: ''?>" readonly />
                        </div>
                        
                        <div class="flex w-6/12"></div>
                    </div>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('FORM_APP')?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 w-4/12 ml-2 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                   style="text-transform:uppercase" type="text" id="FORMAPP" name="FORMAPP" value=<?php echo "APP"?> />
                            <!-- value="<?=isset($data['FORMAPP']) ? $data['FORMAPP']: ''?>" required /> -->
                        </div>
                        
                        <div class="flex w-6/12"></div>
                    </div>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('APPPACK')?></label>
                            <select class="text-control shadow-md border mr-1 px-3 h-7 ml-2 w-4/12 text-left text-sm rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                    id="FORMPACKTYP" name="FORMPACKTYP" onchange="unRequired();" >
                                <option value=""></option>
                                    <?php foreach ($apppackse as $key => $item) { ?>
                                        <option value ="<?php echo $key ?>" <?php echo (isset($data['FORMPACKTYP']) && $data['FORMPACKTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        
                         <div class="flex w-6/12">
                        </div>
                    </div>

                    <div class="flex mb-1 px-2 mt-2">
                        <div class="flex w-6/12">
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 ml-2"><?=checklang('FORM_TITLE')?></label>&emsp;
                            <div class="relative w-5/12 mr-1 ml-4">
                                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                    name="FORMTITLETYP" id="FORMTITLETYP" value="<?=isset($data['FORMTITLETYP']) ? $data['FORMTITLETYP']: ''?>" onchange="unRequired();"/>
                                <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                    id="searchapp">
                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </a>
                            </div>
                            <input class="text-control shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                                   type="text" id="APPNAME" name="APPNAME" readonly value="<?=isset($data['APPNAME']) ? $data['APPNAME']: ''?>" readonly />         
                        </div>
                            
                        <div class="flex w-6/12"></div>
                    </div>
                    
                    <div class="flex mt-8">
                        <div class="flex w-6/12">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="insert" name="insert"
                            <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['INSERT']?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="update" name="update"
                            <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['UPDATE']?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="delete" name="delete"
                            <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>><?=$data['TXTLANG']['DELETE']?></button>
                        </div>

                        <div class="flex w-6/12 justify-end">
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="entry" name="entry" onclick="enrty();"><?=$data['TXTLANG']['ENTRY']?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="clear" name="clear" onclick="unsetSession();"><?=$data['TXTLANG']['CLEAR']?></button>
                            <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                    id="end" name="end" onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?=$data['TXTLANG']['END']?></button>
                        </div>
                    </div>

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
