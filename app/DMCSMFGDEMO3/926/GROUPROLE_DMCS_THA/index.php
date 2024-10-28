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
          <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
          <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
          <form class="w-full" method="POST" id="grouprole" name="grouprole" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
            <div class="flex mb-1 px-2">
                <div class="flex w-5/12">
                  <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('GROUPNAME')?></label>
                  <select class="text-control shadow-md border mr-1 px-3 h-7 w-5/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                        id="GROUPCD" name="GROUPCD" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($groupcode as $key => $item) { ?>
                          <option value="<?=$key ?>" <?=(isset($data['GROUPCD']) && $data['GROUPCD'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                  </select>
                </div>
                <div class="flex w-5/12">
                  <label class="text-color block text-sm w-4/12 pt-1 text-center"><?=checklang('APPPACK')?></label>
                  <select class="text-control shadow-md border mr-1 px-3 h-7 w-6/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                        id="APPPACK" name="APPPACK" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($apppack as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['APPPACK']) && $data['APPPACK'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                  </select>
                </div>
                <div class="flex w-2/12 justify-end">
                  <button type="summit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                          id="SEARCH" name="SEARCH" onclick="return searchs();"><?=checklang('SEARCH')?>
                      <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                      </svg>
                  </button>
              </div>
            </div> 

            <div class="flex w-full px-2 my-2">
              <div class="flex flex-col w-5/12 overflow-scroll block">
                <label class="text-color block text-sm w-12/12 pr-2 py-2"><?=checklang('AVAILABLEAPP')?></label>
                <div class="overflow-scroll block h-[400px] max-h-[400px]"> 
                  <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="tableAvilavle" rules="cols" cellpadding="3" cellspacing="1">
                      <thead class="sticky top-0 bg-gray-50">
                          <tr class="border border-gray-600">
                              <th class="px-3 text-center text-sm border border-slate-700 whitespace-nowrap"><?=checklang('APPCD'); ?></th>
                              <th class="px-6 text-center text-sm border border-slate-700 whitespace-nowrap"><?=checklang('APPNAME'); ?></th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php 
                        if(!empty($data['AVAILABLE']))  { $minrowA = count($data['AVAILABLE']);
                         // CHECKROW,ACCOUNTCD,ACCOUNTNAME,ACCOUNTGROUP,ACCOUNTTYP
                          foreach ($data['AVAILABLE'] as $key => $value) { ?>
                            <tr class="border border-gray-600">
                                <td class="h-6 w-4/12 pl-1 text-[12px] border border-slate-700 whitespace-nowrap"><?=isset($value['APPCD1']) ? $value['APPCD1']: ''; ?></td>
                                <td class="h-6 w-8/12 pl-1 text-[12px] border border-slate-700 whitespace-nowrap"><?=isset($value['APPNAME1']) ? $value['APPNAME1']: ''; ?></td>
                               
                            </tr> <?php 
                          }
                        }
                        for ($i = $minrowA; $i < $maxrowA; $i++) { ?>
                            <tr class="border border-gray-600">
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
                <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 my-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="grant" name="grant">></button>
                <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 my-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="grant-all" name="grant-all">>></button>
                <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 my-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="revoke-all" name="revoke-all"><<</button>
                <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 my-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="revoke" name="revoke"><</button>
              </div>
              <div class="flex flex-col w-7/12 overflow-scroll block">
                <label class="text-color block text-sm w-12/12 pr-2 py-2"><?=checklang('GRANT')?></label>
                <div class="overflow-scroll block h-[400px] max-h-[400px]"> 
                  <table class="w-full border-collapse border border-slate-500 divide-gray-200" id="tableGrant" rules="cols" cellpadding="3" cellspacing="1">
                      <thead class="sticky top-0 bg-gray-50">
                          <tr class="border border-gray-600">
                              <th class="px-6 text-center text-sm border border-slate-700 whitespace-nowrap"><?=checklang('APPCD'); ?></th>
                              <th class="px-10 text-center text-sm border border-slate-700 whitespace-nowrap"><?=checklang('APPNAME'); ?></th>
                              <th class="px-3 text-center text-sm border border-slate-700 whitespace-nowrap"><?=checklang('COMMIT'); ?></th>
                              <th class="px-3 text-center text-sm border border-slate-700 whitespace-nowrap"><?=checklang('MODIFY'); ?></th>
                              <th class="px-3 text-center text-sm border border-slate-700 whitespace-nowrap"><?=checklang('DELETE'); ?></th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php 
                        if(!empty($data['GRANT']))  { $minrowB = count($data['GRANT']);
                          // CHECKROW,ACCOUNTCD,ACCOUNTNAME,ACCOUNTGROUP,ACCOUNTTYP,SPACE
                          foreach ($data['GRANT'] as $key => $value) { ?>
                              <tr class="border border-gray-600">
                                <td class="h-6 w-3/12 pl-1 text-[12px] border border-slate-700 whitespace-nowrap"><?=isset($value['APPCD2']) ? $value['APPCD2']: ''; ?></td>
                                <td class="h-6 w-6/12 pl-1 text-[12px] border border-slate-700 whitespace-nowrap"><?=isset($value['APPNAME2']) ? $value['APPNAME2']: ''; ?></td>
                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-center">
                                  <input type="hidden" id="APPCOMMITH<?=$key?>" name="APPCOMMIT[]" value="F" <?=$value['APPCOMMIT'] == 'T' ? 'disabled' :'';?>/>
                                  <input type="checkbox" id="APPCOMMIT<?=$key?>" name="APPCOMMIT[]" value="T" onchange="chked(1, <?=$key?>);" <?=$value['APPCOMMIT'] == 'T' ? 'checked' :'';?>/>
                                </td>
                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-center">
                                  <input type="hidden" id="APPMODIFYH<?=$key?>" name="APPMODIFY[]" value="F" <?=$value['APPMODIFY'] == 'T' ? 'disabled' :'';?>/>
                                  <input type="checkbox" id="APPMODIFY<?=$key?>" name="APPMODIFY[]" value="T" onchange="chked(2, <?=$key?>);" <?=$value['APPMODIFY'] == 'T' ? 'checked' :'';?>/>
                                </td>
                                <td class="h-6 w-1/12 text-sm border border-slate-700 text-center">
                                  <input type="hidden" id="APPDELETEH<?=$key?>" name="APPDELETE[]" value="F" <?=$value['APPDELETE'] == 'T' ? 'disabled' :'';?>/>
                                  <input type="checkbox" id="APPDELETE<?=$key?>" name="APPDELETE[]" value="T" onchange="chked(3, <?=$key?>);" <?=$value['APPDELETE'] == 'T' ? 'checked' :'';?>/>
                                </td>
                                <td class="hidden"><input type="text" name="APPCODE2[]" value="<?=$value['APPCD2'] ?>"></td>
                                <td class="hidden"><input type="text" name="APPNAME2[]" value="<?=$value['APPNAME2'] ?>"></td>
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

            <input class="hidden" type="text" name="APPCD1" id="APPCD1"/>
            <input class="hidden" type="text" name="APPCD2" id="APPCD2"/>

            <div class="flex mt-2 px-2">
                <div class="flex w-5/12">
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                            id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                    <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                          onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>
                </div>
                <div class="flex w-7/12 justify-between">
                  <button type="button" id="reflect" name="reflect" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 ml-12">
                          <?=checklang('REFLECT')?></button>
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
  $(document).ready(function() {
    unRequired();
  });

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
  
  function unRequired() {
    if (GROUPCD.val() != '') {
        document.getElementById('GROUPCD').classList.remove('req');
    } else {
        document.getElementById('GROUPCD').classList.add('req');
    }
    let APPPACK = document.getElementById('APPPACK');
    if (APPPACK.value != '') {
        document.getElementById('APPPACK').classList.remove('req');
    } else {
        document.getElementById('APPPACK').classList.add('req');
    }
  }
</script>
</html>