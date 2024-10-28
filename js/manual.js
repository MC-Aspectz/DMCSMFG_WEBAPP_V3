
function edit_manual() {
    document.getElementById('action').value = 'edit'
    document.getElementById('form_manual').submit();
}

function preview_manual() {
    document.getElementById('action').value = 'preview'
    document.getElementById('form_manual').submit();
}

function commit_manual() {
    document.getElementById('action').value = 'commit'
    document.getElementById('form_manual').submit();
}
