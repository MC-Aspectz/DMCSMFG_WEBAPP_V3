// icon
const SEARCHDIVISION = $("#SEARCHDIVISION");

SEARCHDIVISION.attr("href", $("#sessionUrl").val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php');

// input
const DIVISIONCD = $("#DIVISIONCD");

// action button
const SEARCH = $("#SEARCH");
const COMMIT = $("#COMMIT");
const CLOSEPAGE = $("#CLOSEPAGE");

// form
const form = document.getElementById('setAccStart');

CLOSEPAGE.click(function () {
  return programDelete();
});

SEARCHDIVISION.click(function () {
    keepData();
});

SEARCH.click(async function() {
    // check validate form
    if(!form.reportValidity()) {
        actionDialog(1);
        return false;
    }
    $("#loading").show();
    await keepData();
    // return actionDialog(2);
});

COMMIT.click(async function() {
    // check validate form
    return actionDialog(2);
});

DIVISIONCD.on("keyup change", function (e) {
  if (e.type === "change") {
    keepData();
    window.location.href = "index.php?DIVISIONCD=" + DIVISIONCD.val();
  } else if (e.key === "Enter" || e.keyCode === 13) {
    keepData();
    window.location.href = "index.php?DIVISIONCD=" + DIVISIONCD.val();
  }
});

async function action(method) {
    $("#loading").show();
    const data = new FormData(form);
    data.append('action', method);
    await axios.post('../SETACCSTART/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        emptyTable();
        $("#TTL_ACCAMT1").val('');
        $("#TTL_ACCAMT2").val('');
        document.getElementById("loading").style.display = "none";
    })
    .catch(e => {
        // console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

async function setAmount(index) {
    $('#loading').show();
    let AMT = $("#AMT" + index + "").val();
    let ACCTYP = $("#ACCTYP" + index + "").val();
    const data = new FormData(form);
    data.append('action', 'setAmount');
    data.append('AMTA', AMT);
    data.append('ACCTYPA', ACCTYP);
    await axios.post('../SETACCSTART/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $("#AMT" + index + "").val(response.data['AMT']);
        $("#ACCAMT1" + index + "").val(response.data['ACCAMT1']);
        $("#ACCAMT2" + index + "").val(response.data['ACCAMT2']);
        amttotal();
        document.getElementById("loading").style.display = "none";
    })
    .catch(e => {
        console.log(e);
        document.getElementById("loading").style.display = "none";
    });
}

function amttotal() {
    let accamt1 = document.getElementsByName("ACCAMT1[]");
    let accamt2 = document.getElementsByName("ACCAMT2[]");
    let ttlaccamt1 = 0; let ttlaccamt2 = 0;
    for (let i = 0; i < accamt1.length; i++) {
        ttlaccamt1 += parseFloat(accamt1[i].value.replace(/,/g, "")) || 0;
    }
    for (let i = 0; i < accamt2.length; i++) {
        ttlaccamt2 += parseFloat(accamt2[i].value.replace(/,/g, "")) || 0;
    }
    $("#TTL_ACCAMT1").val(numberWithCommas(ttlaccamt1.toFixed(2)));
    $("#TTL_ACCAMT2").val(numberWithCommas(ttlaccamt2.toFixed(2)));
}


async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');

    await axios.post('../SETACCSTART/function/index_x.php', data)
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
    await axios.post('../SETACCSTART/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        console.log(e);
        $('#loading').hide();
    });
}

async function unsetSession(form) {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'SETACCSTART');

    await axios.post('../SETACCSTART/function/index_x.php', data)
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
    let data = new FormData();
    data.append('action', 'programDelete');

    await axios.post('../SETACCSTART/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        // window.location.href = $("#sessionUrl").val() + "/home.php";
    })
    .catch(e => {
        console.log(e);
    });
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        background: '#8ca3a3',
        showCancelButton: true,
        confirmButtonColor: 'silver',
        cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                programDelete();
                unsetSession(form); 
                window.location.href="/DMCS_WEBAPP";  
            } else if(type == 2) {
                keepItemData();
                return action('commit');
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

    // refresh
    // window.location.href = '../SETACCSTART/';
    emptyTable();

    return false;
}

function emptyTable() {
    $('#dvwdetail').empty();
    for (var i = 1; i <= 18; i++) {
        $('#dvwdetail').append( '<tr class="tr_border" id="rowId'+i+'">'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                    '<td class="td-class"></td>'+
                                '</tr>');
    }
    document.querySelector("#rowCount").innerText = '0';
}

function numberWithCommas(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
    return num.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');
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