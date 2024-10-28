<?php require_once('./function/index_x.php');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <!-- <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/font-awesome-6.4.0-all.min.css'; ?>"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <div class="flex mb-1">
              <div class="flex w-4/12 px-2">
                <div class="flex-col w-full">
                  <div class="w-full h-[450px] border border-black overflow-auto" id="account_tree"><?php 
                    foreach ($search as $key => $item) { 
                      if($item['PATH'] != '' && $item['DATA'] == '') { ?>
                        <div class="apppack" id="apppack<?=$item['PATH']?>" onclick="expanded(<?=$item['PATH']?>);">
                            <i class="arrow-right"></i>&ensp;<i class="fa-solid fa-folder" style="color: #f7df87;"></i><label class="text-item"><?=$item['TITLE']?></label>
                        </div>
                        <div class="staffView" id="staffView<?=$item['PATH']?>"> <?php
                          foreach ($title as $key => $value) {
                            if($value['APPPACK'] == $item['PATH']) {  ?>
                              <ul class="h-8 pl-6" id="selectView<?=$value['PATH']?>" 
                                  onclick="selectView('<?=$value['PATH']?>', '<?=$value['APPPACK']?>', '<?=$value['STAFFCD']?>', '<?=$value['STAFFNAME']?>', '<?=$value['DIVISION']?>');">
                                <li class="select py-1 align-middle" onclick="searchGrant('<?=$value['APPPACK']?>', '<?=$value['STAFFCD']?>');">
                                  <i class="fa-regular fa-file fa-lg align-middle" style="color: #6f7276;"></i>&ensp;<?=$value['TITLE']?></li>
                              </ul><?php 
                            } 
                          }  ?>
                        </div> <?php
                      }
                    } ?>
                    </div>   
                  </div>
                </div>

                <div class="flex w-8/12 px-2">
                  <div class="flex-col w-full">
                    <div class="flex mb-1">
                      <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('APPPACK')?></label>
                      <select class="text-control shadow-md border mr-1 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                            id="APPPACK" name="APPPACK" onchange="unRequired();" readonly>
                            <option value=""></option>
                           <?php foreach ($apppack as $key => $item) { ?>
                                <option value="<?=$key?>" <?=(isset($data['APPPACK']) && $data['APPPACK'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                            <?php } ?>
                      </select>
                      <label class="text-color block text-sm w-2/12 pt-1 text-center"><?=checklang('DIVISION')?></label>
                      <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 mr-1 text-[12px] text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                              id="DIVISIONNAME" name="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>"/>
                      <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-[12px] text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                              id="DIVISIONCD" name="DIVISIONCD" value="<?=isset($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" readonly/>
                    </div>  
                    
                    <div class="flex mb-1">
                      <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('STAFF_NAME')?></label>
                      <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 mr-1 text-[12px] text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                              id="STAFFCD" name="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>"/>
                      <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-[12px] text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                              id="STAFFNAME" name="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                    </div>
    
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
                          <tbody id="datagrant" class="divide-y divide-gray-200 flex-none overflow-y-auto"><?php 
                              for ($i = $minrow; $i < $maxrow; $i++) { ?>
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
                    <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>&emsp;<span id="rowCount"><?=$minrow ?></span></label>
                  </div>  
                </div>
              </div>
            </div>

            <div class="flex mt-2">
                <div class="flex w-6/12">
                  <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                          id="view" name="view"><?=checklang('VIEW')?></button>
                </div>
                <div class="flex w-6/12 justify-end">
                    <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                            onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
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