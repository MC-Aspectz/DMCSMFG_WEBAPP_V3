// search
const SEARCHITEM = $('#SEARCHITEM');
const SEARCHPARTNER = $('#SEARCHPARTNER');

SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=PARTNERUNITMASTER', 'authWindow', 'width=1200,height=600');});
SEARCHPARTNER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPARTNER/index.php?page=PARTNERUNITMASTER&PARTNERTYP=' + $('#PARTNERTYP').val(), 'authWindow', 'width=1200,height=600');});

const ITEMCD = $('#ITEMCD');
const PARTNERCD = $('#PARTNERCD');
const PARTNERTYP = $('#PARTNERTYP');
const PARTNERPRICEDT = $('#PARTNERPRICEDT');
const PARTNERPRICEQTY2 = $('#PARTNERPRICEQTY2');

const input_serach = [PARTNERTYP, PARTNERCD, ITEMCD, PARTNERPRICEDT];

// action button
const PRE = $('#PRE');
const NEXT = $('#NEXT');
const SEARCH = $('#SEARCH');
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');

// form
const form = document.getElementById('partnerUnitMaster');

const search_icon = [SEARCHPARTNER, SEARCHITEM];

for(const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
        }
    });
};

for(const icon of search_icon) {
    icon.click(function () {
        keepData();
    });
};

SEARCH.click(async function() {
    return searchPUP();
});

INSERT.click(async function() {
    if($('#PARTNERPRICEQTY2').val() == '' && $('#PARTNERPRICE').val() == '') { validationDialog(); return false; }
    return await action('INSERT');
});

UPDATE.click(async function() {
    if($('#PARTNERPRICELN').val() == '' && $('#PARTNERPRICE').val() == '') { validationDialog(); return false; }
    return await action('UPDATE');
});

DELETE.click(async function() {
    if($('#PARTNERPRICELN').val() == '' && $('#PARTNERPRICE').val() == '') { validationDialog(); return false; }
    return await action('DELETE');
});

PRE.click(function() {
    return getElement('preDate', '');
});

NEXT.click(function() {
    return getElement('nextDate', '');
});

PARTNERTYP.on('change', function (e) {
    return getElement('PARTNERTYP', PARTNERTYP.val());
});

PARTNERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('PARTNERCD', PARTNERCD.val());
    }
});

ITEMCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('ITEMCD', ITEMCD.val());
    }
});

PARTNERPRICEDT.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('PARTNERPRICEDT', PARTNERPRICEDT.val());
    }
});

PARTNERPRICEQTY2.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return currenttQty();
    }
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../PARTNERUNITMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result  = response.data;
        if(result != '') {
            // console.log(result);
             if(code == 'preDate' || code == 'nextDate') {
                document.getElementById('PARTNERPRICEDT').value = dateFormat(result['PARTNERPRICEDT']);
                document.getElementById('PRE').classList[result['SYSEN_PRE'] == 'T' ? 'remove' : 'add']('read');
                document.getElementById('NEXT').classList[result['SYSEN_NEXT'] == 'T' ? 'remove' : 'add']('read');
             } else {
                $.each(result, function(key, value) {
                    // console.log(key, '=>', value);
                    if(value != '') {
                        if(key == 'PARTNERPRICEDT') {
                            document.getElementById(''+key+'').value = dateFormat(value);
                        } else {
                            document.getElementById(''+key+'').value = value;
                        }
                    } else {
                        if(code == 'PARTNERTYP' || code == 'PARTNERCD') {
                            document.getElementById('PARTNERCD').value = '';
                            document.getElementById('PARTNERNAME').value = '';
                            document.getElementById('CMCURDISP').value = '';
                            document.getElementById('CMPRICETYP').value = '';
                        }
                    }
                });
            }
        } 
        unRequired();
        return searchPUP();
        // document.getElementById('loading').style.display = 'none';
    }).catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function searchPUP() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'SEARCH');
    await axios.post('../PARTNERUNITMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let nextQty = response.data['nextQty'];
        let searchUP = response.data['searchPUP'];
        if(nextQty != '') {
            $.each(nextQty, function(key, value) {
                if(value != '') {
                    if(key == 'PARTNERPRICEQTY1') {
                        document.getElementById(''+key+'').value = dec2digit(value); 
                    } else if(key == 'SYSEN_PARTNERPRICE') {
                        document.getElementById('PARTNERPRICE').classList[value == 'F' ? 'add' : 'remove']('read');
                    } else if(key == 'SYSEN_PARTNERPRICEQTY2') {
                        document.getElementById('PARTNERPRICEQTY2').classList[value == 'F' ? 'add' : 'remove']('read');
                    } else {
                        document.getElementById(''+key+'').value = value; 
                    }
                }
            });
        }

        if(searchUP != '') {
            // console.log(searchUP);
            let rowCount = 0; emptyRow();
            $.each(searchUP, function(key, value) {
                var newRows = $('<tr class="divide-y divide-gray-200" id=rowId'+key+'>');                      
                var colsc = '';
                colsc += '<td class="h-6 text-sm border border-slate-700 text-center row-id" id="PARTNERPRICELN_TD'+key+'">'+value.PARTNERPRICELN+'</td>'; 
                colsc += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="PARTNERPRICEQTY1_TD'+key+'">'+value.PARTNERPRICEQTY1+'</td>';
                colsc += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="PARTNERPRICEQTY2_TD'+key+'">'+value.PARTNERPRICEQTY2+'</td>';
                colsc += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="PARTNERPRICE_TD'+key+'">'+value.PARTNERPRICE+'</td>';
                colsc += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="CMCURDISP_TD'+key+'">'+value.CMCURDISP+'</td>';

                colsc += '<td class="hidden"><input class="hidden" id="PARTNERPRICELN'+key+'" name="PARTNERPRICELNZ[]" value="'+value.PARTNERPRICELN+'"/></td>';
                colsc += '<td class="hidden"><input class="hidden" id="PARTNERPRICEQTY1'+key+'" name="PARTNERPRICEQTY1Z[]" value="'+value.PARTNERPRICEQTY1+'"/></td>';
                colsc += '<td class="hidden"><input class="hidden" id="PARTNERPRICEQTY2'+key+'" name="PARTNERPRICEQTY2Z[]" value="'+value.PARTNERPRICEQTY2+'"/></td>';
                colsc += '<td class="hidden"><input class="hidden" id="PARTNERPRICE'+key+'" name="PARTNERPRICEZ[]" value="'+value.PARTNERPRICE+'"/></td>';
                colsc += '<td class="hidden"><input class="hidden" id="CMCURDISP'+key+'" name="CMCURDISPZ[]" value="'+value.CMCURDISP+'"/></td>';
                colsc += '<td class="hidden"><input class="hidden" id="SYSEN_PARTNERPRICE'+key+'" name="SYSEN_PARTNERPRICEZ[]" value="'+value.SYSEN_PARTNERPRICE+'"/></td>';

                if(key <= 9) {
                    $('#rowId'+key+'').empty();
                    $('#rowId'+key+'').append(colsc);
                } else {
                    newRows.append(colsc+'</tr>');
                    $('#table tbody').append(newRows);
                }
                rowCount++;
            });
            $('#rowcount').html(rowCount);
        } else { emptyRow(); }
        document.getElementById('loading').style.display = 'none';
    }).catch(e => {
        console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function currenttQty() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'currenttQty');
    await axios.post('../PARTNERUNITMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result  = response.data;
        if(result != '') {
            document.getElementById('PARTNERPRICEQTY2').value = num2digit(result['PARTNERPRICEQTY2']);
            document.getElementById('PARTNERPRICEQTY2').classList.add('read');
        } 
        unRequired();
        document.getElementById('loading').style.display = 'none';
    }).catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function action(method) {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', method);
    await axios.post('../PARTNERUNITMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data; //let index;
            if(result != '') {
                let rowCount = 0; emptyRow();
                $.each(result, function(key, value) {
                    var newRows = $('<tr class="divide-y divide-gray-200" id=rowId'+key+'>');                      
                    var colsc = '';
                    colsc += '<td class="h-6 text-sm border border-slate-700 text-center row-id" id="PARTNERPRICELN_TD'+key+'">'+value.PARTNERPRICELN+'</td>'; 
                    colsc += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="PARTNERPRICEQTY1_TD'+key+'">'+value.PARTNERPRICEQTY1+'</td>';
                    colsc += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="PARTNERPRICEQTY2_TD'+key+'">'+value.PARTNERPRICEQTY2+'</td>';
                    colsc += '<td class="h-6 pr-2 text-sm border border-slate-700 text-right" id="PARTNERPRICE_TD'+key+'">'+value.PARTNERPRICE+'</td>';
                    colsc += '<td class="h-6 pl-2 text-sm border border-slate-700 text-left" id="CMCURDISP_TD'+key+'">'+value.CMCURDISP+'</td>';

                    colsc += '<td class="hidden"><input class="hidden" id="PARTNERPRICELN'+key+'" name="PARTNERPRICELNZ[]" value="'+value.PARTNERPRICELN+'"/></td>';
                    colsc += '<td class="hidden"><input class="hidden" id="PARTNERPRICEQTY1'+key+'" name="PARTNERPRICEQTY1Z[]" value="'+value.PARTNERPRICEQTY1+'"/></td>';
                    colsc += '<td class="hidden"><input class="hidden" id="PARTNERPRICEQTY2'+key+'" name="PARTNERPRICEQTY2Z[]" value="'+value.PARTNERPRICEQTY2+'"/></td>';
                    colsc += '<td class="hidden"><input class="hidden" id="PARTNERPRICE'+key+'" name="PARTNERPRICEZ[]" value="'+value.PARTNERPRICE+'"/></td>';
                    colsc += '<td class="hidden"><input class="hidden" id="CMCURDISP'+key+'" name="CMCURDISPZ[]" value="'+value.CMCURDISP+'"/></td>';
                    colsc += '<td class="hidden"><input class="hidden" id="SYSEN_PARTNERPRICE'+key+'" name="SYSEN_PARTNERPRICEZ[]" value="'+value.SYSEN_PARTNERPRICE+'"/></td>';

                    if(key <= 9) {
                        $('#rowId'+key+'').empty();
                        $('#rowId'+key+'').append(colsc);
                    } else {
                        newRows.append(colsc+'</tr>');
                        $('#table tbody').append(newRows);
                    }
                    rowCount++;
                });
                $('#rowcount').html(rowCount);
                return entry();
            }
        }
        $('#loading').hide();
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../PARTNERUNITMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../PARTNERUNITMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        return clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function entry() {
    $('#loading').show();
    let data = new FormData(form);
    data.append('action', 'entry');
    await axios.post('../PARTNERUNITMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == '200') {
            let nextQty = response.data;
            if(nextQty != '') {
                $.each(nextQty, function(key, value) {
                    if(key == 'PARTNERPRICEQTY1') {
                        document.getElementById(''+key+'').value = dec2digit(value); 
                        document.getElementById('PARTNERPRICE').value = '';
                        document.getElementById('PARTNERPRICEQTY2').value = '';
                        document.getElementById('PARTNERPRICE').classList.remove('read');
                        document.getElementById('PARTNERPRICEQTY2').classList.remove('read');
                    } else if(key == 'SYSEN_PARTNERPRICE') {
                        document.getElementById('PARTNERPRICE').classList[value == 'F' ? 'add' : 'remove']('read');
                    } else if(key == 'SYSEN_PARTNERPRICEQTY2') {
                        document.getElementById('PARTNERPRICEQTY2').classList[value == 'F' ? 'add' : 'remove']('read');
                    } else {
                        document.getElementById(''+key+'').value = value; 
                    }
                });
            }
        }
        document.getElementById('PARTNERPRICELN').value = ''; 
        document.getElementById('INSERT').disabled = false;
        document.getElementById('UPDATE').disabled = true;
        document.getElementById('DELETE').disabled = true;
        $('#loading').hide();
        return unRequired();
    })
    .catch(e => {
        console.log(e);
        $('#loading').hide();
    });
}

function emptyRow() {
    $('table#table tr').not(this).removeClass('selected');
    for (var i = 1; i <= 9; i++) {
        let emptyCol = '<td class="h-6 border border-slate-700"></td>';
            emptyCol += '<td class="h-6 border border-slate-700"></td>';
            emptyCol += '<td class="h-6 border border-slate-700"></td>';
            emptyCol += '<td class="h-6 border border-slate-700"></td>';
            emptyCol += '<td class="h-6 border border-slate-700"></td>';

        $('#rowId'+i+'').empty();
        $('#rowId'+i+'').append(emptyCol);
    }
    $('#rowcount').html(0);
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        switch (inputs[i].type) {
            // case 'hidden':
            case 'text':
                inputs[i].value = '';
                break;
            case 'date':
                inputs[i].value = '';
                break;
            case 'radio':
            case 'checkbox':
                inputs[i].checked = false; 
        }
    }
    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i < selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // clearing table
    $('#table > tbody > tr').remove();

    // refresh
    window.location.href = '../PARTNERUNITMASTER/';
    //  window.location.href = 'index.php';

    return false;
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        showCancelButton: true,
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                // unsetSession(form);
                return closeApp($('#appcode').val());       
            }
        }
    });
}

function unRequired() {

    document.getElementById('PARTNERTYP').classList[document.getElementById('PARTNERTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
    document.getElementById('ITEMCD').classList[document.getElementById('ITEMCD').value != '' ? 'remove' : 'add']('req');
    document.getElementById('PARTNERCD').classList[document.getElementById('PARTNERCD').value != '' ? 'remove' : 'add']('req');
    document.getElementById('PARTNERPRICEDT').classList[document.getElementById('PARTNERPRICEDT').value != '' ? 'remove' : 'add']('req');

    document.getElementById('PARTNERPRICEQTY2').classList[document.getElementById('PARTNERPRICEQTY2').value != '' ? 'remove' : 'add']('req');
    document.getElementById('PARTNERPRICE').classList[document.getElementById('PARTNERPRICE').value != '' ? 'remove' : 'add']('req');
}