async function toggleSidebar() {
    // const aside = document.querySelector('aside');
    const aside = document.querySelector('.side-menu')
    // aside.classList.toggle('sm:hidden');
    // aside.classList.toggle('hidden');
    var sideclass = aside.classList.contains('hidden');
    sessionStorage.setItem('SIDECTRL', sideclass);
    aside.classList.toggle('hidden');
    // const data = new FormData();
    // data.append('SIDECTRL', sideclass);
    // await axios.post(appurl + '/common/setsession.php', data)
    // .then((response) => {
    //   // console.log(response.data);
    //   // console.log(sideclass);
    //   aside.classList.toggle('hidden');
    // })
    // .catch((e) => {
    //   // console.log(e);
    // });
}

async function toggleSideForm(appcode, side) {
    const asideLeft = document.querySelector('.left-side-'+appcode+'');
    const asideRight = document.querySelector('.right-side-'+appcode+'');
    var leftClass = asideLeft.classList.contains('hidden');
    var rightClass = asideRight.classList.contains('hidden');
    if(leftClass == true && rightClass == false) {
        asideLeft.classList.toggle('hidden');
        asideRight.classList.toggle('w-full');
        Array.from(document.getElementsByClassName('right-size')).forEach(rightSize => {
            rightSize.classList.toggle('w-full');
            rightSize.classList.toggle('w-[60%]');
        });
    } else if(leftClass == false && rightClass == true) {
        asideRight.classList.toggle('hidden');
        asideLeft.classList.toggle('w-full');
        Array.from(document.getElementsByClassName('left-size')).forEach(leftSize => {
            leftSize.classList.toggle('w-[60%]');
        });
    } else {
        if(side == 'left') {
            asideLeft.classList.toggle('hidden');
            asideRight.classList.toggle('w-full');
            Array.from(document.getElementsByClassName('right-size')).forEach(rightSize => {
                rightSize.classList.toggle('w-full');
                rightSize.classList.toggle('w-[60%]');
            });
        } else {
            asideRight.classList.toggle('hidden');
            asideLeft.classList.toggle('w-full');
            Array.from(document.getElementsByClassName('left-size')).forEach(leftSize => {
                leftSize.classList.toggle('w-[60%]');
            });
        }
    }
    sessionStorage.setItem('LEFTSIDECTRL_' + appcode, asideLeft.classList.contains('hidden'));
    sessionStorage.setItem('RIGHTSIDECTRL_' + appcode, asideRight.classList.contains('hidden'));
    // const data = new FormData();
    // data.append('APPCDFORM', appcode);
    // data.append('LEFTSIDECTRL', asideLeft.classList.contains('hidden'));
    // data.append('RIGHTSIDECTRL', asideRight.classList.contains('hidden'));
    // await axios.post(appurl + '/common/setsession.php', data)
    // .then((response) => {
    //     // console.log(response.data);
    //     // console.log(asideLeft.classList.contains('hidden'));
    //     // console.log(asideRight.classList.contains('hidden'));
    // }).catch((e) => {
    //     // console.log(e);
    // });
}

async function setAppModule(appModule, comcd) {
    // console.log(appModule);
    const data = new FormData();
    data.append('APPMOD', appModule);
    await axios.post(appurl + '/common/setsession.php', data)
    .then((response) => {
        // console.log(response.data);
        return window.location.href = appurl + '/app/' + comcd + '/MAIN/' + appModule;
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function setAppManual(appModule) {
    // console.log(appModule);
    const data = new FormData();
    data.append('APPMANUAL', appModule);
    await axios.post(appurl + '/common/setsession.php', data)
    .then((response) => {
        // console.log(response.data);
        return window.location.href = appurl + '/include/manual.php?appcd=' + appModule;
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function setMpackcode(Mpackcode) {
    // console.log(Mpackcode);
    const data = new FormData();
    data.append('MPACKCODE', Mpackcode);
    await axios.post(appurl + '/common/setsession.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function setBrightness(brightness) {
    // console.log(brightness);
    const data = new FormData();
    data.append('BRIGHTNESS', brightness);
    await axios.post(appurl + '/common/setsession.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function changeApp(appcode, comcd, appsession, appname) {
    // console.log(appcode);
    const data = new FormData();
    data.append('FAPPCD', appcode.split('/').pop());
    data.append('CHANGEAPP', 'CHANGEAPP');
    await axios.post(appurl + '/common/setsession.php', data)
    .then((response) => {
        // console.log(response.data);
        let result = response.data;
        if(appsession == '') { return window.location.href = appurl + '/app/' + comcd + '/' + appcode; }

        if(result.APPCD == '') {
            setLoadApp(appcode); document.getElementById('loading').style.display = 'none';
            return window.open(appurl + '/app/' + comcd + '/' + appcode, appname, 'noopener, noreferrer'); 
        } else {
            appWarning(appcode);
        }

        // let openTab = window.open(appurl + '/app/' + comcd + '/' + appcode, appname);
        // openTab.document.title = appname; // focus Tab

        // window.open(appurl + '/app/' + comcd + '/' + appcode, appname);  // new tab    
        // window.focus(); // focus Tab
    
        // if (navigator.userAgent.indexOf('Chrome/') > 0) {
            // if (window.detwin) {
                // window.detwin.close();
                // window.detwin = null;
            // }
        // }
        // window.detwin = window.open(appurl + '/app/' + comcd + '/' + appcode, appname);
        // window.detwin.focus();
        // ------------------------------------------------------------------------------------------------------ //
        document.getElementById('loading').style.display = 'none';
    })
    .catch((e) => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function setLoadApp(appcode) {
    const data = new FormData();
    data.append('APPCODE', appcode.split('/').pop());
    data.append('SETLOADAPP', 'SETLOADAPP');
    await axios.post(appurl + '/common/setsession.php', data)
    .then((response) => {
        // console.log(response.data);
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function closeWindow() {
    let appcode = location.pathname.split('/').slice(1)[4];
    // console.log(appcode);
    const data = new FormData();
    data.append('APPCODE', appcode);
    data.append('PROGRAMRUNDELETE', 'PROGRAMRUNDELETE');
    await axios.post(appurl + '/common/setsession.php', data)
    .then((response) => {
        // console.log(response.data);
        return null;
    })
    .catch((e) => {
        // console.log(e);
    });
}

async function closeApp(appcode) {
    $('#loading').show();
    let data = new FormData();
    data.append('FAPPCD', appcode);
    data.append('PROGRAMDELETE', 'programDelete');
    await axios.post(appurl + '/common/setsession.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(result.APPOPEN > 0) {
            $('#loading').hide();
            if(result.APPOPEN > 0) {
                if(window.close()) {
                    return window.close();
                } else {
                    return window.location.href = $('#sessionUrl').val() + '/home.php';
                }
            } 
        } else {
            return window.location.href = $('#sessionUrl').val() + '/home.php';
        }
        document.getElementById('loading').style.display = 'none';   
    }).catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

function change_password() {
    $('#modalchange').html('');
    try {
        axios.get(appurl + '/include/changepassword.php', { 
            params: { btnClick:'clickmodal', id: 'changePassword-modal' },
        }).then(function (response) {
            // console.log(response.data);
            $('#modalchange').html(response.data);
            $('#changePassword-modal').modal('show', {backdrop: false, keyboard: false });
            // console.clear();
        })
    } catch (error) {
        // console.error(error);
    }
}

function about() {
  $('#modalabout').html('');
    try {
        axios.get(appurl + '/include/about.php', {
            params: { btnClick:'clickmodal', id: 'about-modal' },
        }).then(function (response) {
            // console.log(response.data);
            $('#modalabout').html(response.data);
            $('#about-modal').modal('show', {backdrop: false, keyboard: false });
            console.clear();
        })
    } catch (error) {
        // console.error(error);
    }
}

function appWarning(appcode) {
    return Swal.fire({
        text: 'This application is already open,\nPlease kill process in the menu Workstation Monitor,\n or logout and login again.',
        showCancelButton: false,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        }).then((result) => {
        if (result.isConfirmed) {
            // return closeApp(appcode);
        }
    });
}

function close_window() {
    // console.log('ConfirmLeave');
    return 'You have attempted to leave this page. Are you sure?';
}

