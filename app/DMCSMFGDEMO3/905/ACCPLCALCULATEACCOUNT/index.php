<?php require_once('./function/index_x.php');?>
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
        <main class="flex flex-1 overflow-y-auto paragraph">
          <!-- Content Page -->
          <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
          <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
          <form class="w-full" method="POST" id="accplcalculate" name="accplcalculate" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
            <div class="flex mb-1 px-2">
              <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('PLACCOUNTTHISTERM')?></label>
              <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 mr-2 text-gray-700 border-gray-300 read"
                    name="PLACCCD" id="PLACCCD" value="<?=isset($data['PLACCCD']) ? $data['PLACCCD']: ''; ?>" readonly/>
              <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                    name="PLACCNAME" id="PLACCNAME" value="<?=isset($data['PLACCNAME']) ? $data['PLACCNAME']: ''; ?>" readonly/>
              <div class="w-2/12"></div>
            </div>  

            <div class="flex mb-1 px-2">
                <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('ACC_GROUP')?></label>
                <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-3/12 text-left rounded-xl border-gray-300" id="ACCGROUPS" name="ACCGROUPS">
                    <option value=""></option>
                    <?php foreach ($acc01 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['ACCGROUPS']) && $data['ACCGROUPS'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>
                <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('ACCOUNTTYP')?></label>
                <select class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-2/12 text-left rounded-xl border-gray-300 read" id="PLACCTYP" name="PLACCTYP" readonly>
                    <option value=""></option>
                    <?php foreach ($actyp as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['LOAD']['PLACCTYP']) && $data['LOAD']['PLACCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>
                <div class="w-1/12"></div>
            </div>  

            <div class="flex w-full px-2 my-2">
              <div class="flex flex-col w-6/12 overflow-scroll block">
                <div class="overflow-scroll block h-[400px] max-h-[400px]"> 
                  <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="tableDVWA" rules="cols" cellpadding="3" cellspacing="1">
                      <thead class="sticky top-0 bg-gray-50">
                          <tr class="border border-gray-600">
                              <th class="px-3 text-center border border-slate-700"><input type="checkbox" id="CHECKALL1" name="CHECKALL1" onclick="checkedAll(1);"/></th>
                              <th class="px-3 text-center border border-slate-700 whitespace-nowrap"><?=checklang('ACC_CODE'); ?></th>
                              <th class="px-6 text-center border border-slate-700 whitespace-nowrap"><?=checklang('ACC_NAME'); ?></th>
                              <th class="px-4 text-center border border-slate-700 whitespace-nowrap"><?=checklang('ACC_GROUP'); ?></th>
                              <th class="px-3 text-center border border-slate-700 whitespace-nowrap"><?=checklang('ACCOUNTTYP'); ?></th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php 
                        if(!empty($data['DVWA']))  { $minrowA = count($data['DVWA']);
                         // CHECKROW,ACCOUNTCD,ACCOUNTNAME,ACCOUNTGROUP,ACCOUNTTYP
                          foreach ($data['DVWA'] as $key => $value) { ?>
                            <tr class="border border-gray-600">
                                <td class="px-2 text-center border border-slate-700">
                                  <input type="hidden" id="CHECKROWH1<?=$key?>" name="CHECKROW1[]" value="F"/>
                                  <input type="checkbox" id="CHECKROW1<?=$key?>" name="CHECKROW1[]" value="T" onchange="chked(1, <?=$key?>);"/>
                                </td>
                                <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 whitespace-nowrap"><?=$value['ACCOUNTCD'] ?></td>
                                <td class="h-6 w-5/12 pl-1 text-sm border border-slate-700 whitespace-nowrap"><?=$value['ACCOUNTNAME'] ?></td>
                                <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 whitespace-nowrap"><?php foreach ($acc01 as $key => $item) { if($value['ACCOUNTGROUP'] == $key) echo $item; } ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 whitespace-nowrap"><?php foreach ($actyp as $key => $item) { if($value['ACCOUNTTYP'] == $key) echo $item; } ?></td>
                                <td class="hidden"><input type="text" name="ACCOUNTCD1[]" value="<?=$value['ACCOUNTCD'] ?>"></td>
                                <td class="hidden"><input type="text" name="ACCOUNTNAME1[]" value="<?=$value['ACCOUNTNAME'] ?>"></td>
                                <td class="hidden"><input type="text" name="ACCOUNTGROUP1[]" value="<?=$value['ACCOUNTGROUP'] ?>"></td>
                                <td class="hidden"><input type="text" name="ACCOUNTTYP1[]" value="<?=$value['ACCOUNTTYP'] ?>"></td>
                            </tr> <?php 
                          }
                        }
                        for ($i = $minrowA; $i < $maxrowA; $i++) { ?>
                            <tr class="border border-gray-600">
                              <td class="h-6 border border-slate-700"></td>
                              <td class="h-6 border border-slate-700"></td>
                              <td class="h-6 border border-slate-700"></td>
                              <td class="h-6 border border-slate-700"></td>
                              <td class="h-6 border border-slate-700"></td>
                            </tr><?php
                        } ?>
                      </tbody>
                  </table>
                </div>  
                <div class="flex p-2">
                  <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>&emsp;<?=$minrowA;?></label>
                </div> 
              </div>
              <div class="flex flex-col w-20 justify-center px-3">
                <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="ADDP" name="ADDP">></button>&emsp;
                <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="TAKEP" name="TAKEP"><</button>
              </div>
              <div class="flex flex-col w-6/12 overflow-scroll block">
                <div class="overflow-scroll block h-[400px] max-h-[400px]"> 
                  <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="tableDVWP" rules="cols" cellpadding="3" cellspacing="1">
                      <thead class="sticky top-0 bg-gray-50">
                          <tr class="border border-gray-600">
                            <th class="px-3 text-center border border-slate-700"><input type="checkbox" id="CHECKALL2" name="CHECKALL2" onclick="checkedAll(2);"/></th>
                            <th class="px-3 text-center border border-slate-700 whitespace-nowrap"><?=checklang('ACC_CODE'); ?></th>
                            <th class="px-6 text-center border border-slate-700 whitespace-nowrap"><?=checklang('ACC_NAME'); ?></th>
                            <th class="px-4 text-center border border-slate-700 whitespace-nowrap"><?=checklang('ACC_GROUP'); ?></th>
                            <th class="px-3 text-center border border-slate-700 whitespace-nowrap"><?=checklang('ACCOUNTTYP'); ?></th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php 
                        if(!empty($data['DVWP']))  { $minrowB = count($data['DVWP']);
                          // CHECKROW,ACCOUNTCD,ACCOUNTNAME,ACCOUNTGROUP,ACCOUNTTYP,SPACE
                          foreach ($data['DVWP'] as $key => $value) { ?>
                              <tr class="border border-gray-600">
                                <td class="px-2 text-center border border-slate-700">
                                  <input type="hidden" id="CHECKROWH2<?=$key?>" name="CHECKROW2[]" value="F"/>
                                  <input type="checkbox" id="CHECKROW2<?=$key?>" name="CHECKROW2[]" value="T" onchange="chked(2, <?=$key?>);"/>
                                </td>
                                <td class="h-6 w-2/12 pl-1 text-sm border border-slate-700 whitespace-nowrap"><?=$value['ACCOUNTCD'] ?></td>
                                <td class="h-6 w-5/12 pl-1 text-sm border border-slate-700 whitespace-nowrap"><?=$value['ACCOUNTNAME'] ?></td>
                                <td class="h-6 w-3/12 pl-1 text-sm border border-slate-700 whitespace-nowrap"><?php foreach ($acc01 as $key => $item) { if($value['ACCOUNTGROUP'] == $key) echo $item; } ?></td>
                                <td class="h-6 w-1/12 pl-1 text-sm border border-slate-700 whitespace-nowrap"><?php foreach ($actyp as $key => $item) { if($value['ACCOUNTTYP'] == $key) echo $item; } ?></td>
                                <td class="hidden"><input type="text" name="ACCOUNTCD2[]" value="<?=$value['ACCOUNTCD'] ?>"></td>
                                <td class="hidden"><input type="text" name="ACCOUNTNAME2[]" value="<?=$value['ACCOUNTNAME'] ?>"></td>
                                <td class="hidden"><input type="text" name="ACCOUNTGROUP2[]" value="<?=$value['ACCOUNTGROUP'] ?>"></td>
                                <td class="hidden"><input type="text" name="ACCOUNTTYP2[]" value="<?=$value['ACCOUNTTYP'] ?>"></td>
                              </tr> <?php 
                              } 
                          } 
                          for ($i = $minrowB; $i < $maxrowB; $i++) { ?>
                              <tr class="border border-gray-600">
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                              </tr><?php
                          } ?>
                      </tbody>
                  </table>
                </div>
                <div class="flex p-2">
                  <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>&emsp;<?=$minrowB;?></label>
                </div>
              </div>   
            </div>

            <input class="hidden" type="hidden" name="APPCD1" id="APPCD1"/>
            <input class="hidden" type="hidden" name="APPCD2" id="APPCD2"/>

            <div class="flex mt-2">
                <div class="flex w-6/12"></div>
                <div class="flex w-6/12 justify-end">
                  <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                              onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;
                  <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                          onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?=checklang('END'); ?></button>
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
<!-- <script src="./js/script.js" integrity="sha384-U3Ap9l1MWNyB+HE6fdt7quTR/6u/L6zew6TR8tceOu8tvGGMcmLhZ6VFKsDu4f7g" crossorigin="anonymous"></script> -->
<script type="text/javascript"> 
  function checkedAll(type) {
      var checkall = document.getElementById('CHECKALL'+type+'');
      if(type == 1) { var dvw = <?php echo json_encode($data['DVWA']) ?>;   
      } else { var dvw = <?php echo json_encode($data['DVWP']) ?>; }
      $.each(dvw, function(key, value) {  
          if(isInt(key)) {
            if (checkall.checked) {
                $('#CHECKROW'+type+''+key+'').prop('checked', true);
                document.getElementById('CHECKROWH'+type+''+key+'').disabled = true;
            } else {
                $('#CHECKROW'+type+''+key+'').prop('checked', false);
                document.getElementById('CHECKROWH'+type+''+key+'').disabled = false;
            }
          } else {
            if (checkall.checked) {
                $('#CHECKROW'+type+'1').prop('checked', true);
                document.getElementById('CHECKROWH'+type+'1').disabled = true;
            } else {
                $('#CHECKROW'+type+'1').prop('checked', false);
                document.getElementById('CHECKROWH'+type+'1').disabled = false;
            }
          }
      }); 
  }

  function alertValidation() {
      return Swal.fire({ 
          title: '',
          // icon: 'success',
          text: '<?=$lang['validation1']; ?>',
          // background: '#8ca3a3',
          showCancelButton: false,
          // confirmButtonColor: 'silver',
          // cancelButtonColor: 'silver',
          confirmButtonText: '<?=$lang['yes']; ?>',
          cancelButtonText: '<?=$lang['nono']; ?>'
          }).then((result) => {
              if (result.isConfirmed) { //
          }
      });
  }
</script>
</html>