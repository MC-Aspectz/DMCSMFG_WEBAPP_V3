// icon
const SEARCHSHIPTRAN = $('#SEARCHSHIPTRAN');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHLOC = $('#SEARCHLOC');
const GMAPVIEW = $('#GMAPVIEW');

SEARCHSHIPTRAN.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSHIPTRAN/index.php?page=SHIPMENTENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=SHIPMENTENTRY', 'authWindow', 'width=1200,height=600');});
SEARCHLOC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHLOC/index.php?page=SHIPREQUESTCANCEL&LOCTYP=' + $('#LOCTYP').val(), 'authWindow', 'width=1200,height=600');});
GMAPVIEW.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/GMAPVIEW/index.php?page=SHIPMENTENTRY&GMAPADR=' + $('#GMAPADR').val(), 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHSHIPTRAN, SEARCHSTAFF, SEARCHLOC];

// input
const SHIPTRANORDERNO = $('#SHIPTRANORDERNO');
const SHIPTRANORDERLN = $('#SHIPTRANORDERLN');
const STAFFCD = $('#STAFFCD');
const LOCCD = $('#LOCCD');
const LOCTYP = $('#LOCTYP');

const input_serach = [ SHIPTRANORDERNO, SHIPTRANORDERLN, STAFFCD, LOCCD];

// action button
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');

// form
const form = document.getElementById('shipmentEntry');

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            $('#loading').show();
        }
    });
}

for (const input of serach_icon) {
    input.click(function () {
        keepData();
    });
}

UPDATE.click(async function() {
    return action('update');
});

SHIPTRANORDERNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getShipTran(SHIPTRANORDERNO.val(), SHIPTRANORDERLN.val());
    }
});

SHIPTRANORDERLN.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getShipTran(SHIPTRANORDERNO.val(), SHIPTRANORDERLN.val());
    }
});

STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getSearch('STAFFCD', STAFFCD.val());
    }
});

LOCCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        keepData();
        return getLoc(LOCCD.val(), LOCTYP.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/200/SHIPMENTENTRY/index.php?'+code+'=' + value;
}


async function getShipTran(SHIPTRANORDERNO, SHIPTRANORDERLN) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/200/SHIPMENTENTRY/index.php?SHIPTRANORDERNO='+SHIPTRANORDERNO+'&SHIPTRANORDERLN=' + SHIPTRANORDERLN;
}

async function action(method) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', method);
    await axios.post('../SHIPMENTENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if (response.status == '200') {
           return unsetSession(form);
            // window.location.reload();
        }
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function getLoc(LOCCD, LOCTYP) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('LOCCD', LOCCD);
    data.append('LOCTYP', LOCTYP);
    data.append('action', 'getLoc');
    await axios.post('../SHIPMENTENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            document.getElementById('LOCCD').value = result.LOCCD;
            document.getElementById('LOCNAME').value = result.LOCNAME;           
        } else {
            document.getElementById('LOCCD').value = '';
            document.getElementById('LOCNAME').value = ''; 
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}


function unRequired() {
    
    let SHIPTRANORDERNO = document.getElementById('SHIPTRANORDERNO');
    let SHIPTRANORDERLN = document.getElementById('SHIPTRANORDERLN');
    let LOCCD = document.getElementById('LOCCD');
    let SHIPTRANSHIPQTY = document.getElementById('SHIPTRANSHIPQTY');
    let SHIPTRANSTATUS = document.getElementById('SHIPTRANSTATUS');
    let LOCTYP = document.getElementById('LOCTYP');
    
    LOCCD.classList[LOCCD.value !== '' ? 'remove' : 'add']('req');
    SHIPTRANSHIPQTY.classList[SHIPTRANSHIPQTY.value !== '' ? 'remove' : 'add']('req');
    SHIPTRANORDERNO.classList[SHIPTRANORDERNO.value !== '' ? 'remove' : 'add']('req');
    SHIPTRANORDERLN.classList[SHIPTRANORDERLN.value !== '' ? 'remove' : 'add']('req');

    SHIPTRANSTATUS.classList[SHIPTRANSTATUS.selectedIndex != 0 ? 'remove' : 'add']('req');
    LOCTYP.classList[LOCTYP.selectedIndex != 0 ? 'remove' : 'add']('req');
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../SHIPMENTENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'SHIPMENTENTRY');

    await axios.post('../SHIPMENTENTRY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
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
                return closeApp($('#appcode').val()); 
            }
        }
    });
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

    // refresh
    window.location.href = '../SHIPMENTENTRY/';
    // emptyTable();
    // $(":checkbox").bind("click", true);

    return false;
}

function numberWithCommas(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
    return num.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');
}

function number2digit(num) {
    if (isNaN(num) || num == '' || num == null) {
        return '';
    }
    return numberWithCommas(parseFloat(num).toFixed(2));
}

function digitFormat(num) {
    while (num.search(",") >= 0) {
        num = (num + "").replace(',', '');
    }
    return parseFloat(num).toFixed(6);
};

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

function isArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}