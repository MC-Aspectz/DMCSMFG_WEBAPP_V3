const SALETRANNO = $('#SALETRANNO');
const CANCELTRANNO = $('#CANCELTRANNO'); 
const DIVISIONCD = $('#DIVISIONCD');
const CUSTOMERCD = $('#CUSTOMERCD');
const CUSCURCD = $('#CUSCURCD');
const STAFFCD = $('#STAFFCD');
const SVNO = $('#SVNO');
const SALEDIVCON2CBO = $('#SALEDIVCON2CBO');
const input_serach = [SALETRANNO, CANCELTRANNO, DIVISIONCD, CUSTOMERCD, CUSCURCD, STAFFCD, SALEDIVCON2CBO];

// search
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const back = $('#back');
const page = $('#page').val();

//input serach
SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_RESALEENTRY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_RESALEENTRY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_RESALEENTRY_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_RESALEENTRY_THA', 'authWindow', 'width=1200,height=600');});

const serach_icon = [SEARCHCUSTOMER, SEARCHDIVISION, SEARCHCURRENCY, SEARCHSTAFF];

// form
const form = document.getElementById('saleentry');

// action button
const replacez = $('#replacez');

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            keepData();
            $('#loading').show();
        }
    });
}

for(const input of serach_icon){
    input.click(function () {
        keepData();
    });
};

replacez.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return commitDialog();
    // form.submit();
});

back.click(function() {
    $('#loading').show();
    return  window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/' + page + '/index.php?SALETRANNO=' + CANCELTRANNO.val();
});

DIVISIONCD.on('keyup change', function (e) {
    if((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('DIVISIONCD', DIVISIONCD.val());
    }
});

CUSTOMERCD.on('keyup change', function (e) {
    if((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('CUSTOMERCD', CUSTOMERCD.val());
    }
});

CUSCURCD.on('keyup change', function (e) {
    if((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('CUSCURCD', CUSCURCD.val());
    }
});

STAFFCD.on('keyup change', function (e) {
    if((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('STAFFCD', STAFFCD.val());
    }
});

SALEDIVCON2CBO.change(function() {
    keepData();
    return getSearch('SALEDIVCON2CBO', SALEDIVCON2CBO.val());
});

async function getSearch(code, value) {
    $('#loading').show();
    keepData();
    return window.location.href = $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/ACC_RESALEENTRY_THA/index.php?'+code+'=' + value;
}

async function commited() {
    const data = new FormData(form);
    data.append('action', 'commit');
    await axios.post('../ACC_RESALEENTRY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        if(response.status == '200') {
            $('#SALETRANNO').val(response.data['SALETRANNO']);
             successValidation();
        }
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../ACC_RESALEENTRY_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
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
                $('#loading').show();
                return commited();
            }
        }
    });
}

function numberWithCommas(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function stringReplace(num) {
    return num.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');
}
