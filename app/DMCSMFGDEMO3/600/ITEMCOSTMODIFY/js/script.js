// icon search
const SEARCHITEM = $('#SEARCHITEM');

SEARCHITEM.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ITEMCOSTMODIFY', 'authWindow', 'width=1200,height=600');});

//input serach
const ITEMCD = $('#ITEMCD'); 

// action button
const UPDATE = $('#UPDATE');

// form
const form = document.getElementById('ItemCostModify');

// const serach_icon = [SEARCHITEM];

// for(const icon of serach_icon) {
//     icon.click(async function () {
//         await keepData();
//     });
// };

UPDATE.click(function() {
    if (!form.reportValidity()) {
        validationDialog(1);
        return false;
    }
    return update();
});

ITEMCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('ITEMCD', ITEMCD.val(), 'getItem');
    }
});

async function update() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'update');
    await axios.post('../ITEMCOSTMODIFY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        if(response.data.includes('ERRO')) {
            alertDialog(response.data);
        } else {
            return window.location.reload();
        }
    })
    .catch(e => {
        $('#loading').hide();
        // console.log(e);
    });
}

function ChkCodeTb() {
    $('#loading').show(); // keepData();
    const data = new FormData(form);
    data.append('action', 'ChkCodeTb');
    axios.post('../ITEMCOSTMODIFY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        $('#COMVAL').val(result['COMVAL']);
        $('#ROWCOUNTER').val(result['ROWCOUNTER']);
        if(result['SYSEN_COSTNEW1'] != undefined) {
            for (var i = 1; i <= 20; i++) {
                // console.log(result['SYSEN_COSTNEW'+i]);
                if(result['SYSEN_COSTNEW'+i] != 'T') {
                    $('#COSTNEW'+i+'').attr('class','text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-right read');
                } else {
                    $('#COSTNEW'+i+'').attr('class','text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 pr-12 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-right');
                }
            }
        }
        $('#loading').hide();  
    })
    .catch(e => {
        console.log(e);
        $('#loading').hide();
    });
}

async function getSearch(code, value, action) {
    $('#loading').show(); // keepData();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', action);
    var currdisp = document.getElementsByClassName('currencydisp');
    await axios.post('../ITEMCOSTMODIFY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let currencydisp = '';
        let result = response.data;
        if(result != 'ERRO:ERRO_ERRITEMCD') {
            currencydisp = result['CURRENCYDISP'];
            $('#COMVAL').val(result['COMVAL']);
            $('#ITEMCD').val(result['ITEMCD']);
            $('#ITEMNAME').val(result['ITEMNAME']);
            $('#ITEMSPEC').val(result['ITEMSPEC']);
            $('#ROWCOUNTER').val(result['ROWCOUNTER']);
            $('#CURRENCYDISP').val(result['CURRENCYDISP']);
            // document.getElementById('COSTSC').value = result['COSTSC'];
            // COST_NEW_T  //  COST_OLD_T
            for (var i = 1; i <= 20; i++) {
                // console.log(result['COSTNEW'+i]);
                if(result['COST_OLD_'+i] != '') {  $('#COST_OLD_'+i+'').val(result['COST_OLD_'+i]); } else { $('#COST_OLD_'+i+'').val(''); }
                if(result['COSTNEW'+i] != '') {  $('#COSTNEW'+i+'').val(result['COSTNEW'+i]); } else { $('#COSTNEW'+i+'').val(''); }
                if(result['COST_TMP_'+i] != '') {  $('#COST_TMP_'+i+'').val(result['COST_TMP_'+i]); } else { $('#COST_TMP_'+i+'').val(''); }
                if(result['UPDFLG'+i] != '') {  $('#UPDFLG'+i+'').val(result['UPDFLG'+i]); } else { $('#UPDFLG'+i+'').val('0'); }
            }
        } else{
            $('#COMVAL').val('');
            $('#ITEMCD').val('');
            $('#ITEMNAME').val('');
            $('#ITEMSPEC').val('');
            $('#ROWCOUNTER').val(''); 
            $('#CURRENCYDISP').val('');
            validationDialog(2);
        }
        for (var i = 0; i < currdisp.length; i++) {
          currdisp[i].innerHTML = currencydisp;
        }
        // window.location.reload();
        $('#loading').hide(); unRequired();  
    })
    .catch(e => {
        $('#loading').hide();
    });
}

async function keepData() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ITEMCOSTMODIFY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        // $('#loading').hide();        
    })
    .catch(e => {
        $('#loading').hide();
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../ITEMCOSTMODIFY/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
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
    for (var i = 0; i<selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

	window.location.href = '../ITEMCOSTMODIFY/';

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
                return closeApp($('#appcode').val());    
            }
        }
    });
}

function unRequired() {
    let ITEMCD = document.getElementById('ITEMCD');
    let COSTSC = document.getElementById('COSTSC');
    let BMVERSION = document.getElementById('BMVERSION');

    ITEMCD.classList[ITEMCD.value !== '' ? 'remove' : 'add']('req');
    BMVERSION.classList[BMVERSION.value !== '' ? 'remove' : 'add']('req');

    if(COSTSC.selectedIndex != 0) {
        COSTSC.classList.remove('req');
    } else {
        COSTSC.classList.add('req');
    }
}