// search
const SEARCHITEM = $('#SEARCHITEM');
const SEARCHBOI = $('#SEARCHBOI');
const SEARCHCATALOG = $('#SEARCHCATALOG');
const SEARCHSUPPLIER = $('#SEARCHSUPPLIER');
const SEARCHSTORAGE = $('#SEARCHSTORAGE');
const SEARCHMATERIAL = $('#SEARCHMATERIAL');
const SEARCHWORKCENTER = $('#SEARCHWORKCENTER');
const SEARCHCATALOGS = $('#SEARCHCATALOGS');
const SEARCHSTORAGES = $('#SEARCHSTORAGES');

SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ITEMMASTER_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHBOI.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ITEMMASTER_CLONE', 'authWindow', 'width=1200,height=600');});
SEARCHCATALOG.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php?page=ITEMMASTER_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=ITEMMASTER_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHSTORAGE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTORAGE/index.php?page=ITEMMASTER_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHMATERIAL.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHMATERIAL/index.php?page=ITEMMASTER_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHWORKCENTER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHWORKCENTER/index.php?page=ITEMMASTER_MFG', 'authWindow', 'width=1200,height=600');});
SEARCHCATALOGS.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCATALOG/index.php?page=ITEMMASTER_MFG_SEARCH&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHSTORAGES.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTORAGE/index.php?page=ITEMMASTER_MFG_SEARCH&index=1', 'authWindow', 'width=1200,height=600');});

//input serach
const WCCD = $('#WCCD');
const ITEMCD = $('#ITEMCD');
const STORAGECD = $('#STORAGECD');
const CATALOGCD = $('#CATALOGCD');
const SUPPLIERCD = $('#SUPPLIERCD');
const MATERIALCD = $('#MATERIALCD');
const SEARCHITEMCATCD = $('#SEARCHITEMCATCD');
const SEARCHITEMSTORAGECD = $('#SEARCHITEMSTORAGECD');

// action button
const SEARCH = $('#SEARCH');
const SAVE = $('#SAVE');
const DEL = $('#DELETE');
const CSV = $('#CSV');

// form
const form = document.getElementById('itemmastermfg');

SEARCH.click(async function() {
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

SAVE.click(function () {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    action('SAVE');
});

DEL.click(function () {
    // check validate item code
    if (ITEMCD.val() == '') {
        return false;
    }
    action('DELETE');
});

CSV.click(function() {
    return exportCSV();
});

SEARCHITEMCATCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SEARCHITEMCATCD', SEARCHITEMCATCD.val());
    }
});

SEARCHITEMSTORAGECD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SEARCHITEMSTORAGECD', SEARCHITEMSTORAGECD.val());
    }
});

ITEMCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCD', ITEMCD.val());
    }
});

CATALOGCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CATALOGCD', CATALOGCD.val());
    }
});

SUPPLIERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERCD', SUPPLIERCD.val());
    }
});

STORAGECD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STORAGECD', STORAGECD.val());
    }
});

WCCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('WCCD', WCCD.val());
    }
});

MATERIALCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('MATERIALCD', MATERIALCD.val());
    }
});

function HandlePopupResult(code, result) {
    // console.log('result of popup is: ' + code + ' : ' + result);
    return getElement(code, result);
}

async function getElement(code, value) {
    $('#loading').show();
    document.getElementById('DELETE').disabled = true;
    let itemMode = sessionStorage.getItem('ITEMMODE') ? sessionStorage.getItem('ITEMMODE'): true;
    // console.log(strTobool(itemMode)); 
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ITEMMASTER_MFG/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    if (key != 'ITEMIMGLOC') {
                        document.getElementById(''+key+'').value = value;
                    }
                }

                if(key == 'ITEMSTOPDT') {
                    // document.getElementById(''+key+'').value = dateFormat(value);
                    let stopdt = moment(value, 'YYYYMMDD');
                    document.getElementById(''+key+'').value = stopdt.format('yyyy-MM-DD');
                }

                if(key == 'ITEMINVPRICE' || key == 'ITEMSTDPURPRICE' || key == 'ITEMSHOPPRICE' || key == 'ITEMFIXORDER' || key == 'ITEMMINORDER' || key == 'ITEMMINSTOCK' || key == 'ITEMSTDSALEPRICE' || key == 'ITEMSTDSUPPLYPRICE' || key == 'ITEMORDERUNIT' || key == 'ITEMWEIGHT') {
                    document.getElementById(''+key+'').value = num2digit(value);
                }

                if(key == 'ITEMIMGLOC' || key == 'ITEMIMGPREVIEW') {
                    const pathurl = document.getElementById('sessionUrl').value;
                    // document.getElementById('ITEMIMGLOC').files = value;
                    if(value != '') {
                        let imgurl = pathurl + value;
                        if(urlExists(imgurl)){
                            document.getElementById('OLDITEMIMGLOC').value = value;
                            document.getElementById('ITEMIMGPREVIEW').src = imgurl;
                        } else {
                            document.getElementById('OLDITEMIMGLOC').value = '';
                            document.getElementById('ITEMIMGPREVIEW').src = pathurl + '/img/image_mfg.png';
                        }
                    } else {
                        document.getElementById('ITEMIMGPREVIEW').src = pathurl + '/img/image_mfg.png';
                    }
                }

                if(key == 'ITEMFIFOLISTFLG' || key == 'ITEMPHANTOMFLG' || key == 'ITEMINVFLG' || key == 'ITEMMASTERPLANFLG' || key == 'ITEMSERIALLFLG') {
                    document.getElementById(''+key+'').checked = value == 'T' ? true: false;
                }
            });
            if(strTobool(itemMode)) {
                document.getElementById('DELETE').disabled = false; 
            } else {
                document.getElementById('ITEMCD').value = '';
            }
            unRequired();
        } else {
            if(strTobool(itemMode)) {
                clearForm();
            }
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function action(method) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../ITEMMASTER_MFG/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        if (response.status == '200') {
            return clearForm();
        }
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function exportCSV() {
  // Variable to store the final csv data
    let ITEMCODE_TXT = (document.getElementById('ITEMCODE_TXT').innerText || document.getElementById('ITEMCODE_TXT').textContent);
    let ITEMNAME_TXT = (document.getElementById('ITEMNAME_TXT').innerText || document.getElementById('ITEMNAME_TXT').textContent);
    let IM_TYPE_TXT = (document.getElementById('IM_TYPE_TXT').innerText || document.getElementById('IM_TYPE_TXT').textContent);
    // let CATEGORY_CODE_TXT = (document.getElementById('CATEGORY_CODE_TXT').innerText || document.getElementById('CATEGORY_CODE_TXT').textContent);
    let STRAGE_CODE_TXT = (document.getElementById('STRAGE_CODE_TXT').innerText || document.getElementById('STRAGE_CODE_TXT').textContent);
    // let SEARCHITEMTYPE = document.getElementById('SEARCHITEMTYPE');
    // let SEARCHITEMTYP = SEARCHITEMTYPE.options[SEARCHITEMTYPE.selectedIndex].text;
    var csv_data = [ITEMCODE_TXT + ',' + $('#SEARCHITEMCD1').val() + ',→,' + $('#SEARCHITEMCD2').val()];
        csv_data.push(ITEMNAME_TXT + ',' + $('#SEARCHITEMNAME').val());
        // csv_data.push(IM_TYPE_TXT + ',' + SEARCHITEMTYP);
        // csv_data.push(CATEGORY_CODE_TXT + ',' + $('#SEARCHITEMCATCD').val() + ',' + $('#SEARCHITEMCATNAME').val());
        csv_data.push(STRAGE_CODE_TXT + ',' + $('#SEARCHITEMSTORAGECD').val() + ',' + $('#SEARCHITEMSTORAGENAME').val());
    // Get each row data
    var rows = document.getElementsByClassName('csv');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
        // Stores each csv row datad
        var csvrow = [];
        for (var x = 1; x < cols.length; x++) {
            csvrow.push("\""+cols[x].innerText+"\"");
        }
        csv_data.push(csvrow.join(','));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join("\n");
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ITEMMASTER_MFG/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data)
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'ItemMaster');
    await axios.post('../ITEMMASTER_MFG/function/index_x.php', data)
    .then((response) => {
        clearForm(form);
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function clearForm() {
    // clearing inputs
    // document.getElementById('ITEMCD').value = '';
    document.getElementById('ITEMNAME').value = '';
    document.getElementById('ITEMCD').classList.remove('read');
    document.getElementById('ITEMNAME').classList.remove('read');
    const form_data = document.getElementById('form_data');
    var inputs = form_data.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        // console.log(inputs[i].type);
        switch (inputs[i].type) {
            case 'checkbox':
                inputs[i].checked = false;
                break;
            case 'radio':
                inputs[i].checked = false;
                break;                
            default:
                inputs[i].value = '';
        }
    }

    // clearing select
    var selectoption = form_data.getElementsByTagName('select');
    for (var i = 0; i < selectoption.length; i++) { selectoption[i].selectedIndex = 0; }

    // clearing textarea
    var textarea = form_data.getElementsByTagName('textarea');
    for (var i = 0; i < textarea.length; i++) { textarea[i].value = ''; }

    const pathurl = document.getElementById('sessionUrl').value;
    document.getElementById('ITEMIMGPREVIEW').src = pathurl + '/img/image_mfg.png';

    document.getElementById('ITEMCLEARANCETYP').value = 0;

    unRequired();

    return false;
}

function unRequired() {

    document.getElementById('ITEMCD').classList[document.getElementById('ITEMCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('ITEMSEARCH').classList[document.getElementById('ITEMSEARCH').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('CATALOGCD').classList[document.getElementById('CATALOGCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('ITEMPOUNITRATE').classList[document.getElementById('ITEMPOUNITRATE').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('STORAGECD').classList[document.getElementById('STORAGECD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('ITEMLEADTIME').classList[document.getElementById('ITEMLEADTIME').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('ITEMTYP').classList[document.getElementById('ITEMTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
    document.getElementById('ITEMUNITTYP').classList[document.getElementById('ITEMUNITTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
    document.getElementById('ITEMCLEARANCETYP').classList[document.getElementById('ITEMCLEARANCETYP').selectedIndex != 0 ? 'remove' : 'add']('req');
    document.getElementById('ITEMORDRULETYP').classList[document.getElementById('ITEMORDRULETYP').selectedIndex != 0 ? 'remove' : 'add']('req');
    // document.getElementById('ITEMCOSTTYP').classList[document.getElementById('ITEMCOSTTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
    // document.getElementById('ITEMPOUNITTYP').classList[document.getElementById('ITEMPOUNITTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
}

function emptySearchRows(maxrow) {
    let rowcount =  $('.search-id').length || 0;
    const searchdetail = document.getElementById('searchdetail');
    $('#table-search tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'searchrow'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        var colhide = document.createElement('td');
        colhide.setAttribute('class', 'hidden search-seq');
        row.appendChild(colhide);
        for (var z = 1; z <= 8; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        searchdetail.appendChild(row);
    }
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({
        title: '',
        text: txt,
        showCancelButton: true,
        confirmButtonText: btnyes,
        cancelButtonText: btnno,
        }).then((result) => {
        if (result.isConfirmed) {
            if (type == 1) {
                return closeApp($('#appcode').val()); 
            }
        }
    });
}
