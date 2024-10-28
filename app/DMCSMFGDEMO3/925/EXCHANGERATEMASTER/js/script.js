// icon search
const SEARCHCURRENCY = $("#SEARCHCURRENCY");

// SEARCHCURRENCY.attr('href', $('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php');
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=EXCHANGERATEMASTER&index=1', 'authWindow', 'width=1200,height=600');});
// SEARCHCURRENCY.attr('href', $('#sessionUrl').val() + '/guide/DMCSDEMO3/SEARCHCURRENCY/index.php');

//input serach
const EXRATEFR = $("#EXRATEFR");
const EXRATETODISPH = $("#EXRATETODISPH");
const EXDATE = $("#EXDATE");

const input_serach = [EXRATEFR];
// action button
const SEARCH = $("#SEARCH");
const insrts = $("#insert");
const updte = $("#UPDATE");
const deletes = $("#DELETE");
const closepage = $("#closepage");



// form
const form = document.getElementById('exchangeratemaster');



for(const input of input_serach) {
    input.change(function () {
       
        $("#loading").show();
    });

    input.keyup(function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $("#loading").show();
        }
    });
};

// EXRATEFR.change(function() {
    
//     //window.location.href="index.php?currencycd=" + EXRATEFR.val() +"&exrateto=" + EXRATETODISPH.val()+"&exdate=" + EXDATE.val();
//     //window.location.href="index.php?currencycd=" + EXRATEFR.val();
//     getCurFm(EXRATEFR.val());
//     keepData();
    
// });

// EXRATEFR.keyup(function(e) {
//     if( e.key === 'Enter' || e.keyCode === 13)  {
//        // window.location.href="index.php?currencycd=" + EXRATEFR.val() +"&exrateto=" + EXRATETODISPH.val()+"&exdate=" + EXDATE.val();
//       //  window.location.href="index.php?currencycd=" + EXRATEFR.val()
//         getCurFm(EXRATEFR.val());
//         keepData();
//     }
// })



EXRATEFR.on('keyup change', function(e) {
    if(e.type === 'change') {
        keepData();
        getCurFm(EXRATEFR.val());
    } else if( e.key === 'Enter' || e.keyCode === 13) {
        keepData();
        getCurFm(EXRATEFR.val());
    }
});



SEARCHCURRENCY.click(async function () {
  
     keepData();
});

SEARCH.click(async function() {
    // check validate form
    $("#loading").show();
    await keepData();
    // return actionDialog(2);
});

insrts.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    return commit('insert');
});

updte.click(function() {
    return commit('update');
});

deletes.click(function() {
    return commit('deletes');
});

closepage.click(function() {
    return programDelete();
});

async function searchs() {
    $('#loading').show(); 
    form.submit();
}

async function getCurFm(EXRATEFR) {
    const data = new FormData(form);
    data.append('action', 'getCurFm');
    data.append('EXRATEFR', EXRATEFR);
    //alert("Hello! I am an alert box!!")
    await axios.post('../EXCHANGERATEMASTER/function/index_x.php', data)
    .then(response => {
        console.log(response.data);
        //$("#EXRATEFR").val('55');
        //alert(response.data['EXRATEFR'])
        $("#EXRATEFR").val(response.data['EXRATEFR']);
        $("#EXRATEFRDISP").val(response.data['EXRATEFRDISP']);
        $("#EXRATE").val(response.data['EXRATE']);
        $("#loading").hide();
    })
    .catch(e => {
        // console.log(e);
    });
}




async function commit(method) {
    let data = new FormData(form);
    data.append('action', method);

    await axios.post('../EXCHANGERATEMASTER/function/index_x.php', data)
    .then(response => {
        console.log(response.data)
        window.location.href='index.php?refresh=1';
        document.getElementById("insert").hidden = true;
         clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });
}

$(document).ready(function() {
    document.getElementById("UPDATE").hidden = true;
    document.getElementById("DELETE").disabled = true;
    unRequired();
});

$('table#table_acc tbody tr').click(function () {
    $('table#table_acc tbody tr').removeAttr('id');

    $(this).attr('id', 'selected-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(1).text() != 'undefined' && item.eq(1).text() != '') {
        // console.log(item.eq(0).text());
       // $('#WHTAXTYPE').val(item.eq(0).text());
        $('#EXRATEMONTH').val(item.eq(0).text());
        $('#EXRATEFR').val(item.eq(1).text());
        $('#EXRATEFRDISP').val(item.eq(2).text());
        $('#EXRATE').val(item.eq(3).text());
        
        document.getElementById("insert").hidden = true;
        document.getElementById("UPDATE").hidden = false;
        document.getElementById("DELETE").disabled = false;
        unRequired();
      //  document.getElementById("delete").disabled = true;
        // document.getElementById("CATALOGNAME").value = item.eq(1).text();
    }
});

function unRequired() {

    let EXRATE = document.getElementById("EXRATE");
    let EXRATEFR = document.getElementById("EXRATEFR");
    let EXDATE = document.getElementById("EXDATE");

    EXRATE.classList[EXRATE.value !== '' ? 'remove' : 'add']('req');
    EXRATEFR.classList[EXRATEFR.value !== '' ? 'remove' : 'add']('req');
    EXDATE.classList[EXDATE.value !== '' ? 'remove' : 'add']('req');
}

function entry() {
    $('table#table_acc tbody tr').removeAttr('id');

    $("#EXRATEFR").val('');
    $("#EXRATEFRDISP").val('');
    $('#EXRATE').val('');
  
    document.getElementById("insert").hidden = false;
    document.getElementById("UPDATE").hidden = true;
    document.getElementById("DELETE").disabled = true;
    //  document.getElementById('DELETE').disabled = true;
    unRequired();
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../EXCHANGERATEMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function keepItemData() {
    const data = new FormData(form);
    data.append('action', 'keepItemData');
    // console.log(data);
    await axios.post('../EXCHANGERATEMASTER/function/index_x.php', data)
    .then(response => {
        $('#loading').hide();
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'EXCHANGERATEMASTER');

    await axios.post('../EXCHANGERATEMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function programDelete() {
    $("#loading").show();
    let data = new FormData();
    data.append('action', 'programDelete');

    await axios.post('../EXCHANGERATEMASTER/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        return window.location.href = $("#sessionUrl").val() + "/home.php";
    })
    .catch(e => {
        console.log(e);
    });
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        // background: '#8ca3a3',
        showCancelButton: true,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                unsetSession(form); 
                programDelete();
            }
        }
    });
}

function alertWarning(msg, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: msg,
        background: '#8ca3a3',
        showCancelButton: false,
        confirmButtonColor: 'silver',
        cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
            if (result.isConfirmed) {
        }
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
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
    
    // clearing selects
    var selectoption = form.getElementsByTagName('select');
    for (var i = 0; i < selectoption.length; i++) { selectoption[i].selectedIndex = 0; }

    // clearing textarea
    var textarea = form.getElementsByTagName('textarea');
    for (var i = 0; i < textarea.length; i++) { textarea[i].value = ''; }

    // clearing table
    // $('#table_result > tbody > tr').remove();
    emptyTable();
    document.querySelector("#record").innerText = '0';
    document.querySelector("#record2").innerText = '0';
    // refresh
    window.location.href = '../EXCHANGERATEMASTER/';
    

    return false;
}

function emptyTable() {
    $('#dvwdetail').empty();
    for (var i = 1; i <= 13; i++) {
        $('#dvwdetail').append( '<tr class="tr_border" id="rowId'+i+'">'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                  
                                '</tr>');
    }
    
    $('#dvwdetail2').empty();
    for (var x = 1; x <= 7; x++) {
        $('#dvwdetail2').append('<tr class="tr_border" id="rowIdB'+x+'">'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                '</tr>');
    }
}

function numberWithCommas(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
    return num.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');
}


function isArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}

function HandlePopupResultIndex(code, result, index) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/EXCHANGERATEMASTER/index.php?'+code+'=' + result + '&index=' + index;
}

function HandlePopupResult(code, result) {
    // console.log("result of popup is: " + code + ' : ' + result);
    $("#loading").show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/925/EXCHANGERATEMASTER/index.php?'+code+'=' + result;
}