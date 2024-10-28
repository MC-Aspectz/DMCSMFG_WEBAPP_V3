<?php
session_start();
require_once($_SESSION['APPPATH'] . '/common/RTNServer.php');
  //--------------------------------------------------------------------------------
  if (isset($_SESSION['LANG'])) {
      require_once($_SESSION['APPPATH'] . '/lang/' . strtolower($_SESSION['LANG']) . '/changepassword.php');
  } else {  
      require_once($_SESSION['APPPATH'] . '/lang/en/changepassword.php');
  }
  //--------------------------------------------------------------------------------
  //------------------------------ Change Password --------------------------------------//
  if(!empty($_POST)) {
    if($_POST['action'] == 'changePassword') {
        $Param = array( 'STAFFCODE' => $_SESSION['USERCODE'],
                        'NEWPWD' => $_POST['newPassword']);
        $cmd = GetRequestData($Param, 'gen.StaffMaster.changePwd', '', '');
        $data = Execute($cmd, $errorMessage);
        echo json_encode($data);
    }
  }
?>
<div class="modal fade" id="changePassword-modal" data-bs-backdrop="false" data-bs-config={backdrop:false} tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="changePasswordForm" name="changePasswordForm" action="" method="POST">
        <div class="modal-header">
          <h5 class="text-gray-700 text-base font-semibold" id="changePasswordModalLabel"><?=lang('changepassword'); ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="inline-flex flex-col w-full">
            <label for="currentPassword" class="block text-gray-700 text-base w-12/12 m-2"><?=lang('existingpassword'); ?></label>
            <input type="hidden" id="action" name="action" value="CHANGEPASSWORD">
            <input type="password" class="shadow-sm appearance-none border rounded w-12/12 mx-2 py-2 px-3 text-gray-700 leading-tight" id="currentPassword" name="currentPassword" required/>
            <label for="newPassword" class="block text-gray-700 text-base w-12/12 m-2"><?=lang('newpassword'); ?></label>
            <input type="password" class="shadow-sm appearance-none border rounded w-12/12 mx-2 py-2 px-3 text-gray-700 leading-tight" id="newPassword" name="newPassword" required/>
            <label for="confirmPassword" class="block text-gray-700 text-base w-12/12 m-2"><?=lang('confirmpassword'); ?></label>
            <input type="password" class="shadow-sm appearance-none border rounded w-12/12 mx-2 py-2 px-3 text-gray-700 leading-tight" id="confirmPassword" name="confirmPassword" required/>
          </div>
          <p id="warningValidate" class="text-red-500 mx-2 pt-4"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800" id="submit" onclick="validatePassword();"><?=lang('savechanges'); ?></button>
          <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800" data-bs-dismiss="modal"><?=lang('close'); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  function validatePassword() {
    let currentPassword = $('#currentPassword').val();
    let newPassword = $('#newPassword').val();
    let confirmPassword = $('#confirmPassword').val();
    if(currentPassword == '') {
      document.getElementById('warningValidate').innerHTML = '<?=lang('validation1'); ?>';
    } else if (newPassword == '') {
      document.getElementById('warningValidate').innerHTML = '<?=lang('validation2'); ?>';
    } else if (newPassword !== confirmPassword) {
      document.getElementById('warningValidate').innerHTML = '<?=lang('validation3'); ?>';
    } else {
      document.getElementById('warningValidate').innerHTML = '';
      changePassword();
    }
  }

  async function changePassword() {
    let appurl = '<?php echo $_SESSION['APPURL'];?>';
    var form = document.getElementById('changePasswordForm');
    const data = new FormData(form);
    data.append('action', 'changePassword');
    await axios.post(appurl + '/include/changepassword.php', data)
      .then((response) => {
        if (response.status == 200) {
          // console.log(response.data);
          $('#changePassword-modal').hide();
        }
      }).catch((e) => {
        // console.log(e);
      });
  }
</script>