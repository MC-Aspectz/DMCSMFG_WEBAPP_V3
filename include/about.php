<?php session_start(); ?>
<div class="modal fade" id="about-modal" data-bs-backdrop="false" data-bs-config={backdrop:false} tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="aboutForm" name="aboutForm" action="" method="POST">
        <div class="modal-header">
          <h5 class="text-gray-700 text-base font-semibold" id="aboutModalLabel">About</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="flex mt-2">
            <label class="w-3/12 pointer-events-none py-2" for="computerId">Computer ID</label>
            <input type="text" class="w-9/12 shadow-sm appearance-none rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none read" id="computerId" name="computerId" value="<?=isset($_SESSION['COMPNAME']) ? $_SESSION['COMPNAME'] :''?>" readonly>
          </div>
          <div class="flex mt-2">
            <label class="w-3/12 pointer-events-none py-2" for="username">User Name</label>
            <input type="text" class="w-9/12 shadow-sm appearance-none rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none read" id="Username" name="Username" value="<?=isset($_SESSION['USERCODE']) ? $_SESSION['USERCODE'] :''?>" readonly>
          </div>
          <div class="flex mt-2">
            <label class="w-3/12 pointer-events-none py-2" for="version">Version</label>
            <input type="text" class="w-9/12 shadow-sm appearance-none rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none read" id="version" name="version" value="1.0.0" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800" data-bs-dismiss="modal">End</button>
          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">End</button> -->
        </div>
      </form>
    </div>
  </div>
</div>