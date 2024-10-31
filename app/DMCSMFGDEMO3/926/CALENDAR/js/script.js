// input
const MONTH = $('#MONTH');
const FROMDATE = $('#FROMDATE');
const FACTORYCODE = $('#FACTORYCODE');

// action button
const CREATE = $('#CREATE');

// form
const form = document.getElementById('calendarMaster');

CREATE.click(async function() {
    return getElement('create', 'create');
});

FROMDATE.on('focusout keyup', function (event) {
    if((event.type === 'focusout') || (event.key === 'Enter' || event.keyCode === 13)) {
        return getElement(this.id, this.value);
    }
});

FACTORYCODE.change(async function() {
    await getElement('clearScreen', this.value);
    return getElement('getCalScreen', this.value);
});

MONTH.on('focusout keyup', async function (event) {
    if((event.type === 'focusout') || (event.key === 'Enter' || event.keyCode === 13)) {
        await getElement('clearScreen', this.value);
        return getElement('getCalScreen', this.value);
    }
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../CALENDAR/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }

                if(key == 'FROMDATE') {
                    document.getElementById(''+key+'').value = dateFormat(value);
                    // document.getElementById(''+key+'').value = moment(value, 'YYYYMMDD').format('yyyy-MM-DD');
                }

                if(key.includes('LBLDAY')) {
                    if(!key.includes('RED_') && !key.includes('SYSFC_')) {
                        // console.log(value); // console.log(key);
                        document.getElementById(''+key+'_TD'+'').innerHTML = value;
                    }
      
                    if(key.includes('SYSFC_')) {
                        // console.log(value);
                        if(document.getElementById(''+key.replace('SYSFC_', '')+'_TD'+'')) {
                            document.getElementById(''+key.replace('SYSFC_', '')+'_TD'+'').classList.add('text-'+value.toLowerCase()+'-500');
                        }
                    }
                }
            });
        }
        // unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function setHoliday(id) {
    // console.log(id);
    let LBLDAYID = 'LBLDAY' + id;
    let RED_LBLDAYID = 'RED_LBLDAY' + id;
    let LBLDAY = document.getElementById(LBLDAYID).value;
    let RED_LBLDAY = document.getElementById(RED_LBLDAYID).value;
    // console.log(document.getElementById(id).innerHTML);
    if(LBLDAY) {
        $('#loading').show();
        const data = new FormData();
        data.append(LBLDAYID, LBLDAY);
        data.append(RED_LBLDAYID, RED_LBLDAY);
        data.append('MONTH', document.getElementById('MONTH').value.replaceAll('-', ''));
        data.append('FACTORYCODE', document.getElementById('FACTORYCODE').value);
        data.append('action', 'setHoliday');
        await axios.post('../CALENDAR/function/index_x.php', data)
        .then(response => {
            // console.log(response.data);
            let result = response.data;
            if(objectArray(result)) {
                // console.log(result);
                $.each(result, function(key, value) {
                    if(document.getElementById(''+key+'')) {
                        document.getElementById(''+key+'').value = value;
                    }
                    if(key.includes('SYSFC_')) {
                        // console.log(value);
                        if(document.getElementById(''+key.replace('SYSFC_', '')+'_TD'+'')) {
                            if(value == 'BLACK') {
                                document.getElementById(''+key.replace('SYSFC_', '')+'_TD'+'').classList.remove('text-'+value.toLowerCase()+'-500');
                                document.getElementById(''+key.replace('SYSFC_', '')+'_TD'+'').classList.add('text-black');
                            } else {
                                document.getElementById(''+key.replace('SYSFC_', '')+'_TD'+'').classList.remove('text-black');
                                document.getElementById(''+key.replace('SYSFC_', '')+'_TD'+'').classList.add('text-'+value.toLowerCase()+'-500');
                            }
                        }
                    }
                });
            }
            document.getElementById('loading').style.display = 'none';
        })
        .catch(e => {
            // console.log(e);
            document.getElementById('loading').style.display = 'none';
        });
    } 
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

